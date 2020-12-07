<?php
class Zendvn_Sp_AdminProduct_Controller{
	private $_meta_box_id = 'zendvn-sp-zsproduct';

	public function __construct(){
		global $zController;
		$model = $zController->getModel('Product');
		add_action('init', array($model,'create'));
		add_filter( 'post_updated_messages', array($model,'zsproduct_updated_messages'));
		add_filter( 'bulk_post_updated_messages', array($model,'filter_bulk_zsproduct_updated_messages'), 10, 2  ); 
		add_action('add_meta_boxes', array($this,'display'));
	}

	public function display(){
		add_meta_box($this->_meta_box_id, 'Images of product', array($this,'product_images'),'zsproduct');
	}

	public function product_images(){
		global $zController;
		$zController->getView('product/product_images.php','/backend');
	}
}