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
            
            add_action('edited_zs_category', array($this,'save'));
            add_action('create_zs_category', array($this,'save'));
        }
    }

    public function display($term) {
        global $zController;

		if(is_object($term)){
			$option_name = $this->_prefix_id . $term->term_id;
			$option_value = get_option($option_name);	
		}
        $tagID = ($zController->getParams('tag_ID') !='' ) ? $zController->getParams('tag_ID') : '';
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
		$inputValue = esc_url(@$option_value['picture']);
        $arr 		= array('size' =>'40','id' => $inputID);
        
        if(!$tagID) {
            $html 		= 	'<div class="form-field">'
            . $htmlObj->label(translate('Picture'),array('for'=>"tag-name"))
            . $htmlObj->textbox($inputName,$inputValue,$arr) 
            . ' ' . $btnMedia
            . $htmlObj->pTag(esc_html__('Upload image for ZS category'))
            . '</div>';
            echo $html;	

            echo $htmlObj->btn_media_script($this->create_id('button'), $this->create_id('picture'));
        }else if($tagID != '') {
			$lblPicture 	= $htmlObj->label(esc_html__('Picture'),array('for'=>$inputID));
			$inputPicture 	= $htmlObj->textbox($inputName,$inputValue,$arr);
			$pPicture		= $htmlObj->pTag(esc_html__('Upload image for ZS category'),array('class'=>'description'));
			$jsMedia		= $htmlObj->btn_media_script($this->create_id('button'),$this->create_id('picture'));
			
			$data = array();
			$data['lblPicture'] 	= $lblPicture;
			$data['input'] 			= $inputPicture . $btnMedia . $jsMedia;
			$data['pPicture'] 		= $pPicture;
			
			$zController->_data = $data;
			
			$zController->getView('category/display.php','/backend');
        }
    }

	public function save($term_id){
		global $zController;
		
		if($zController->isPost()){
			$option_name = $this->_prefix_id . $term_id;
			update_option($option_name, $zController->getParams($this->_prefix_name));
		}
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