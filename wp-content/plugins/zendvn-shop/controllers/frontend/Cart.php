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

			case 'paypal'		: $this->paypal(); break;
			
			default: $this->display(); break;
		}
	}
	
	public function display(){
		global $zController;
		
		$zController->getView('cart/display.php','/frontend' );
		$zController->getView('cart/payment.php','/frontend' );
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