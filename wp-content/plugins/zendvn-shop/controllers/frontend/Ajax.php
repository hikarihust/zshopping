<?php
class Zendvn_Sp_Ajax_Controller{
	
	public function __construct(){
		/*==============Ajax Frontend========*/
		add_action('wp_ajax_add_to_cart',array($this,'add_to_cart'));
		add_action('wp_ajax_nopriv_add_to_cart', array($this,'add_to_cart'));

		add_action('wp_ajax_update_cart',array($this,'update_cart'));
		add_action('wp_ajax_nopriv_update_cart', array($this,'update_cart'));
        
        add_action('wp_enqueue_scripts',array($this,'add_js_file'));
        add_action('wp_head',array($this,'add_ajax_library'));
	}
	
	public function update_cart(){
		global $zController;
		$zController->getController('Cart','/frontend');
		
		wp_die();
	}
    
	public function add_to_cart(){
		global $zController;
        $zController->getController('Cart','/frontend');
        
        wp_die();
    }
    
	public function add_js_file(){
		global $zController;
		$pageID = $zController->getHelper('GetPageId')->get('_wp_page_template','page-zcart.php');
		
		if(get_query_var('zsproduct') != '' || $pageID != false){
			wp_register_script('zendvn_sp_ajax_add_cart', $zController->getJsUrl('ajax_add_cart.js'),
			array('jquery'),'1.0',true);
			wp_enqueue_script('zendvn_sp_ajax_add_cart');
		}
    }
    
	public function add_ajax_library(){	
        $ajax_nonce = wp_create_nonce('ajax-security-code');

		$html = '<script type="text/javascript">';
        $html .= ' var ajaxurl = "' . admin_url('admin-ajax.php') . '"; ';
        $html .= ' var security_code = "' . $ajax_nonce . '"; ';
		$html .= '</script>';
	
		echo $html;
	}
}
