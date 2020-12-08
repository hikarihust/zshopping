<?php
class Zendvn_Sp_AdminProduct_Controller{
	private $_meta_box_id = 'zendvn-sp-zsproduct';
	private $_prefix_id = 'zendvn-sp-zsproduct-';
	private $_prefix_key = '_zendvn_sp_zsproduct_';

	public function __construct(){
		global $zController;
		$model = $zController->getModel('Product');
		add_action('init', array($model,'create'));
		add_filter( 'post_updated_messages', array($model,'zsproduct_updated_messages'));
		add_filter( 'bulk_post_updated_messages', array($model,'filter_bulk_zsproduct_updated_messages'), 10, 2  ); 
		if($zController->getParams('post_type') === 'zsproduct') {
			add_action('add_meta_boxes', array($this,'display'));

			add_action('admin_enqueue_scripts', array($this,'add_css_file'));
			add_action('admin_enqueue_scripts', array($this,'media_button_js_file'));
		}
	}

	public function display(){
		add_meta_box($this->_meta_box_id, 'Images of product', array($this,'product_images'),'zsproduct');
	}

	public function product_images(){
		global $zController;
		$zController->_data['controller'] = $this;
		$zController->getView('product/product_images.php','/backend');
	}

	public function media_button_js_file(){
		global $zController;
		
		wp_enqueue_media();
		wp_register_script('zendvn_sp_product_media_button', $zController->getJsUrl('media_button.js'),
							array('jquery'),'1.0',true);
		wp_enqueue_script('zendvn_sp_product_media_button');							
	}

	public function add_css_file(){
		global $zController;
		
		wp_register_style('zendvn_sp_product_product_bk', $zController->getCssUrl('product-bk.css'), array(),'1.0');
		wp_enqueue_style('zendvn_sp_product_product_bk');
	}

	public function create_id($val){
		return $this->_prefix_id . $val;
	}
	
	public function create_key($val){
		return $this->_prefix_key . $val;
	}
}