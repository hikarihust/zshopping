<?php
class Zendvn_Sp_Category_Controller{
	
	public function __construct(){
		$this->display();
	}
	
	public function display(){
		global $zController;
		
		$zController->getView('category/display.php','/frontend' );
	}
}