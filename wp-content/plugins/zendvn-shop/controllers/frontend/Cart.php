<?php
class Zendvn_Sp_Cart_Controller{
	
	public function __construct(){
		$this->display();
	}
	
	public function display(){
		global $zController;
		
		$zController->getView('cart/display.php','/frontend' );
	}
}