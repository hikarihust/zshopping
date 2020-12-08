<?php
class Zendvn_Sp_AdminSetting_Controller{
	
	public function __construct(){
		$this->display();
	}
	
	public function display(){
		global $zController;
		$zController->getView('setting/display.php','/backend');
	}
}