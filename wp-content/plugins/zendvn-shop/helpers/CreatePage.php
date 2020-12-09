<?php
class Zendvn_Sp_CreatePage_Helper{
	
	private $_templatePage;
	
	public function __construct(){
		
		add_filter('page_attributes_dropdown_pages_args', array($this,'register_template'));
		
		$this->_templatePage = array(
					'page-zshopping.php' => 'Show all products',
					'page-zcart.php' => 'ZShopping cart'
				);	
	}
	
	public function register_template($attrs){		
		$cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());

		return $attrs;
	}
}