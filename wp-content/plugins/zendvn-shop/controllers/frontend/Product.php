<?php
class Zendvn_Sp_Product_Controller{
	
	public function __construct(){
		$this->display();
	}
	
	public function display(){
		global $zController;
		
		$zController->getView('product/display.php','/frontend' );
	}
}