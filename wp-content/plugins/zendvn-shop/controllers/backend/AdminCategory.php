<?php
class Zendvn_Sp_AdminCategory_Controller{
    
	private $_prefix_name 	= 'zendvn-sp-zscategory';
	
    private $_prefix_id 	= 'zendvn-sp-zscategory-';
    
	public function __construct(){
        global $zController;
        
        $model = $zController->getModel('Category');
        add_action('init',array($model,'create'));

        if($zController->getParams('taxonomy') == 'zs_category') {
            add_action('zs_category_add_form_fields', array($this,'display'));
            add_action('zs_category_edit_form_fields', array($this,'display'));

			add_action('admin_enqueue_scripts', array($this,'add_js_file'));
			add_action('admin_enqueue_scripts', array($this,'add_css_file'));
        }
    }

    public function display() {
        $htmlObj = new ZendvnHtml();
		//Tao phan tu chua Button
		$inputID 	= $this->create_id('button');
		$inputName 	= $this->create_id('button');
		$inputValue = esc_attr__('Media Library Image');
		$arr 		= array('class' =>'button-secondary','id' => $inputID);
		$options	= array('type'=>'button');		
		$btnMedia	= $htmlObj->button($inputName,$inputValue,$arr,$options);

		//Tao phan tu chua file
		$inputID 	= $this->create_id('picture');
		$inputName 	= $this->create_name('picture');
		$inputValue = '';
		$arr 		= array('size' =>'40','id' => $inputID);
		$html 		= 	'<div class="form-field">'
						. $htmlObj->label(translate('Picture'),array('for'=>"tag-name"))
						. $htmlObj->textbox($inputName,$inputValue,$arr) 
						. ' ' . $btnMedia
                        . $htmlObj->pTag(esc_html__('Upload image for ZS category'))
                        . '</div>';
        echo $html;	
    }

	public function add_js_file(){
		global $zController;
		wp_register_script("zendvn_sp_btn_media", $zController->getJsUrl('/zendvn-media-button.js'),
						array('jquery','media-upload','thickbox'),'1.0');
		wp_enqueue_script("zendvn_sp_btn_media");
			
	}
	
	public function add_css_file(){
		wp_enqueue_style('thickbox');
	}

	private function create_name($val){
		return $this->_prefix_name . '[' . $val . ']';
	}
	
	private function create_id($val){
		return $this->_prefix_id . $val;
	}
}