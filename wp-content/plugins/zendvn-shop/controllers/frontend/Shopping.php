<?php
class Zendvn_Sp_Shopping_Controller{
	
	public function __construct(){
		$this->display();
	}
	
	public function display(){
		global $zController;
		
		$zController->getView('shopping/display.php','/frontend' );
	}
}