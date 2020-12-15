<?php
class Zendvn_Sp_Cart_Controller{
	
	public function __construct(){
		$this->dispath_function();
	}

	public function dispath_function(){
		global $zController;
		
		$action = $zController->getParams('action');
		$payment = $zController->getParams('payment');

		if($action == '' && $payment !=''){
			$action = $payment;
		}
		
		switch ($action){
			case 'add_to_cart'	: $this->add_to_cart(); break;

			case 'update_cart'	: $this->update_cart(); break;

			case 'delete_cart'	: $this->delete_cart(); break;

			case 'send_mail'	: $this->send_mail(); break;

			case 'paypal'		: $this->paypal(); break;

			case 'alert'		: $this->alert(); break;
			
			default: $this->display(); break;
		}
	}
	
	public function display(){
		global $zController;
		
		$zController->getView('cart/display.php','/frontend' );
		$zController->getView('cart/payment.php','/frontend' );
	}

	public function send_mail(){
		global $zController, $zendvn_sp_settings;
		$type = $zController->getParams('type');
		
		if($type == 'send'){		
			$ss = $zController->getHelper('Session');
			$mailHTML =  $ss->get('zcart_mail','');
			
			$content = 'We have received your order. 
						We\'ll get back to you within 24 hours. 
						Thank you very much<br/>';
			$content .= '<br><h3>Your information';
			$content .= '<br/>===============================</h3>';
			$content .= 'Full name: ' 			. $zController->getParams('full_name');
			$content .= '<br/>Phone: ' 				. $zController->getParams('phone');
			$content .= '<br/>Email: ' 				. $zController->getParams('email');
			$content .= '<br/>Bill address: ' 		. $zController->getParams('bill_address');
			$content .= '<br/>Shipping address: ' 	. $zController->getParams('shipping_address');
			$content .= '<br/>Comment: ' 			. $zController->getParams('comment');			
			$content .= '<br><br><h3>Your cart';
			$content .= '<br/>===============================</h3>';
			$content .=  '<div id="zendvn_sp_cart_table">' . $mailHTML . '</div>';
			
			$flagSend = false;
			if($zendvn_sp_settings['select_type'] == 'system'){
				$flagSend = $this->mail_system($content);
			}else{
				$flagSend = $this->mail_shopping($content);
			}
			
			if($flagSend == true){
				$invoiceModel = $zController->getModel('Invoices');
				$invoiceModel->save_item($zController->getParams(),array('action'=>'add'));
			} 
			
			// $url = site_url('?page_id=' . get_query_var('page_id') . '&action=alert&msg=' . $flagSend);
			$url = site_url(get_post_field( 'post_name') . '?action=alert&msg=' . $flagSend);
			wp_redirect($url);
		}
		
		$zController->getView('cart/display.php','/frontend' );
		$zController->getView('cart/send_mail.php','/frontend' );
	}

	public function alert(){
		global $zController;
		$msg = $zController->getParams('msg');
		if($msg == 1){
			echo '<div>Đơn đặt hàng của bạn đã được gửi. Chúng tôi sẽ liên lạc lại với bạn sớm nhất';
		}else{
			echo '<div> Hệ thống đang có vấn đề. Xin bạn vui lòng thử lại sau</div>';
		}
	}

	public function mail_system($content = null){
		echo '<br/>' . __METHOD__;
		global $zController, $zendvn_sp_settings;
		
		$to 		= $zController->getParams('email');
		$subject 	= 'Dead ' . $zController->getParams('full_name') . '! From zShopping ';
		$message	= $content;
		$headers[]  = 'Content-Type: text/html; charset=UTF-8';
		$headers[]  = 'From: zShopping <no-reply@abc.com>';
		$headers[]  = 'Cc: Vu Khanh <vukhanh2212@abc.com>';
		$headers[]  = 'Bcc: Vu Khanh <' . $zendvn_sp_settings['alert_to_email'] . '>';
		
		$attachments[] = ZENDVN_SP_PUBLIC_PATH . '/files/contract.zip';
		
		return wp_mail($to, $subject, $message, $headers, $attachments);//mail()
	}	

	public function mail_shopping($content = null){
		//echo '<br/>' . __METHOD__;
		global $zController, $zendvn_sp_settings;
		
		require_once ABSPATH . WPINC . '/class-phpmailer.php';
		require_once ABSPATH . WPINC . '/class-smtp.php';
		
		$mail = new PHPMailer();
		
		$mail->isSMTP();
		
		$mail->SMTPDebug 	= 1;
		
		$mail->SMTPAuth 	= true;
		$mail->SMTPSecure 	= $zendvn_sp_settings['encription'];
		$mail->Host 		= $zendvn_sp_settings['smtp_host'];
		$mail->Port 		= $zendvn_sp_settings['smpt_port'];
		$mail->Password 	= $zendvn_sp_settings['smtp_password'];
		$mail->Username 	= $zendvn_sp_settings['smtp_username'];
		
		$mail->setFrom('no-reply@abc.com','zShopping');
		$mail->addAddress($zController->getParams('email'),$zController->getParams('full_name'));
		$mail->addReplyTo($zendvn_sp_settings['alert_to_email']);
		$mail->addAttachment(ZENDVN_SP_PUBLIC_PATH . '/files/contract.zip');
		
		$mail->Subject = 'Dead ' . $zController->getParams('full_name') . '! From zShopping ';
		$mail->CharSet = 'utf-8';
		$mail->msgHTML($content);
		
		return $mail->send();	
	}

	public function paypal(){
		echo '<br/>' . __METHOD__;
	}

	public function delete_cart() {
		check_ajax_referer('ajax-security-code','security');
		global $zController;
		$postID 	= $zController->getParams('value');
	
		if(absint($postID) > 0){
			$ss 	= $zController->getHelper('Session');
			$ssCart = $ss->get('zcart',array());
			unset($ssCart[$postID]);

			$ss->set('zcart',$ssCart);
		}
	
		wp_die();
	}

	public function update_cart(){
	
		check_ajax_referer('ajax-security-code','security');
	
		global $zController;
	
		$postID 	= $zController->getParams('value');
		$quality 	= $zController->getParams('quality');
		$price 		= $zController->getParams('price');
	
		if(absint($postID) > 0){
			$ss 	= $zController->getHelper('Session');
			$ssCart = $ss->get('zcart',array());
			$ssCart[$postID] = $quality;
				
			$ss->set('zcart',$ssCart);
		}
		echo ($price * $quality);
	
		wp_die();
	}

	public function add_to_cart(){
	
		check_ajax_referer('ajax-security-code','security');
		global $zController;

		$id 	= (int)$zController->getParams('value');
		if($id > 0){
			$ss 	= $zController->getHelper('Session');
			$ssCart = $ss->get('zcart',array());
	
			if(count($ssCart) == 0){
				$ssCart[$id] = 1;
			}else{
				if(!isset($ssCart[$id])){
					$ssCart[$id] = 1;
				}else{
					$ssCart[$id] = $ssCart[$id] + 1;
				}
			}
	
			$ss->set('zcart',$ssCart);
		}

		$ssCart = $ss->get('zcart',array());
		$total_item = 0;
		if(count($ssCart) > 0){
			foreach ($ssCart as $key => $val){
				$total_item += $val;
			}
		}
	
		$str_item = $total_item . ' product';
		if($total_item > 1){
			$str_item = $total_item . ' products';
		}
		echo $str_item;

		wp_die();
	}
}