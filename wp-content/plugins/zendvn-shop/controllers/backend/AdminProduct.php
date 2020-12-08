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

			if($zController->isPost()){
				add_action('save_post', array($this,'save'));
			}
		}
	}

	public function display(){
		add_meta_box($this->_meta_box_id, 'Images of product', array($this,'product_images'),'zsproduct');
		add_meta_box($this->_meta_box_id .'-detail', 'Detail product', array($this,'detail_product'),'zsproduct');
	}

	public function save($post_id) {
		global $zController;

		$arrParam = $zController->getParams();
		$wpnonce_name = $this->_meta_box_id . '-nonce';
		$wpnonce_action = $this->_meta_box_id;

		//zendvn-sp-zsproduct-nonce
		if(!isset($arrParam[$wpnonce_name])) return $post_id;
		
		if(!wp_verify_nonce($arrParam[$wpnonce_name],$wpnonce_action)) return $post_id;
		
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

		if(!current_user_can('edit_post')) return $post_id;

		$arrData =  array(
					'img-ordering' 	=> array_map('absint',$arrParam[$this->create_id('img-ordering')]),
					'img-url' 		=> $arrParam[$this->create_id('img-url')],
					'rotate360' 	=> esc_textarea($arrParam[$this->create_id('rotate360')]),
					'price' 		=> filter_var($arrParam[$this->create_id('price')],FILTER_VALIDATE_FLOAT),
					'sale-off' 		=> filter_var($arrParam[$this->create_id('sale-off')],FILTER_VALIDATE_FLOAT),
					'manufacturer' 	=> absint($arrParam[$this->create_id('manufacturer')]),
					'gift' 			=> esc_textarea($arrParam[$this->create_id('gift')]),
				);

		foreach ($arrData as $key => $val){
			update_post_meta($post_id, $this->create_key($key), $val);
		}
	}

	public  function detail_product(){
		global $zController;
		wp_nonce_field($this->_meta_box_id,$this->_meta_box_id . '-nonce');
	
		$zController->_data['controller'] = $this;
		$zController->getView('product/detail_product.php','/backend');
	}

	public function product_images(){
		global $zController;
		wp_nonce_field($this->_meta_box_id,$this->_meta_box_id . '-nonce');

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