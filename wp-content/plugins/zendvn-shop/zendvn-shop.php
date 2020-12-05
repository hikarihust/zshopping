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
	require_once 'backend.php';
	new Zendvn_Sp_Backend();
} else {
	require_once 'frontend.php';
	new Zendvn_Sp_Frontend();
}
