<?php
	global $zController, $zendvn_sp_settings;
	
	$paymentDefault = array(
				'send_mail' => 'Send mail',
				'paypal' 	=> 'Paypal',
				'vcb' 		=> 'Vietcombank pay online',
				'vietin' 	=> 'Vietinbank pay online',
			);
	$paymentSetting = $zendvn_sp_settings['payment'];
?>
<div id="payment">
	<form method="post" id="paymentform" name="paymentform" action="">
		<select name="payment" id="zendvn_sp_settings_payment">
			<?php 
				foreach ($paymentDefault as $key => $val){
					echo '<option value="' . $key . '">' . $paymentDefault[$key] . '</option>';
				}
			?>
		</select>
	
	<input type="submit" name="submit" id="submit" value="Payment">
	</form>
</div>