<?php
class Zendvn_Sp_AdminCategory_Controller{
	
	public function __construct(){
		
	}
	
	public function display(){
		global $zController;
		$zController->getView('/category/display.php','/backend');
	}
}