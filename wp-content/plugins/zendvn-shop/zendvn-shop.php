<?php
/*
Plugin Name: ZendVN Shopping
Plugin URI: http://www.zend.vn
Description: Xay dung shopping don gian WP
Author: ZendVN group
Version: 1.0
Author URI: http://www.zend.vn
*/

require_once 'define.php';

require_once ZENDVN_SP_INCLUDE_PATH . '/Controller.php';
global $zController;
$zController = new zController();

if(is_admin()){
	if(!class_exists('ZendvnHtml')){
		require_once ZENDVN_SP_INCLUDE_PATH . '/html.php';
	}
	
	require_once 'backend.php';
	new Zendvn_Sp_Backend();

	$zController->getHelper('AdminMenu');
} else {
	require_once 'frontend.php';
	new Zendvn_Sp_Frontend();
}

$zController->getController('AdminProduct','/backend');
$zController->getController('AdminCategory','/backend');