<?php
class Zendvn_Sp_Cart_Controller{
	
	public function __construct(){
		$this->dispath_function();
	}

	public function dispath_function(){
		global $zController;
		
		$action = $zController->getParams('action');
		
		switch ($action){
			case 'add_to_cart'	: $this->add_to_cart(); break;
			
			default: $this->display(); break;
		}
	}
	
	public function display(){
		global $zController;
		
		$zController->getView('cart/display.php','/frontend' );
	}

	public function add_to_cart(){
	
		check_ajax_referer('ajax-security-code','security');
	}
}