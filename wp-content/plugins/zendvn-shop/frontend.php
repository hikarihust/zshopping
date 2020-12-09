<?php
class Zendvn_Sp_Frontend{
	
	public function __construct(){
		global $zController;
		add_action('init', array($zController->getModel('Category'),'create'));
		add_action('init', array($zController->getModel('Product'),'create'));
	}
}
