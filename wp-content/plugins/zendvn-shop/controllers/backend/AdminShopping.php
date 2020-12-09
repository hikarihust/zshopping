<?php
class Zendvn_Sp_AdminShopping_Controller{
	
	public function __construct(){
		$this->display();
	}
	
	public function display(){
		global $zController;
		$zController->getView('/shopping/display.php','/backend');
	}
}