<?php
class Zendvn_Sp_Frontend{
	
	public function __construct(){
		global $zController;
		add_action('init', array($zController->getModel('Category'),'create'));
		add_action('init', array($zController->getModel('Product'),'create'));
		add_filter('template_include', array($this,'load_template'));
	}

	public function load_template($templates) {
		global $post;

		if(is_page() == 1){
			$page_template = get_post_meta($post->ID,'_wp_page_template', true);
			
			$file = ZENDVN_SP_TEMPLATE_PATH . DS . 'frontend' . DS . $page_template;
			if(file_exists($file)){
				return $file;
			}
		}
		
		return $templates;
	}
}
