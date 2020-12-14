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
	$zController->getController('AdminProduct','/backend');
	$zController->getController('AdminCategory','/backend');
} else {
	global $zendvn_sp_settings;

	$zendvn_sp_settings = get_option('zendvn_sp_setting',array());
	if(count($zendvn_sp_settings) == 0){
		$zendvn_sp_settings = $zController->getConfig('Setting')->get();
	}
	
	require_once 'frontend.php';
	new Zendvn_Sp_Frontend();
}

//Add our custom template to the admin's templates dropdown
add_filter( 'theme_page_templates', 'pluginname_template_as_option', 10, 3 );
function pluginname_template_as_option( $page_templates, $theme, $post ){
	$templatePage = array(
		'page-zshopping.php' => 'Show all products',
		'page-zcart.php' => 'ZShopping cart'
	);	
	$page_templates = array_merge($page_templates,$templatePage);

    return $page_templates;
}

add_action('init','zendvn_sp_session_start',1);

function zendvn_sp_session_start(){
	if(!session_id()){
		session_start();
	}
}

$zController->getController('Ajax','/frontend');
