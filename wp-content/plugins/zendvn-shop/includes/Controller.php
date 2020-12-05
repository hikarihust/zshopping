<?php
class zController {
	public function __construct($options = array()){
		
    }
    
	public function getController($filename = '', $dir = ''){
		
		$obj = new stdClass();
		
		$file =  ZENDVN_SP_CONTROLLER_PATH . $dir . DS . $filename . '.php';
		
		if(file_exists($file)){
			require_once $file;
			$controllerName = ZENDVN_SP_PREFIX . $filename . '_Controller';
			$obj = new $controllerName ();
		}
		return $obj;
	}
    
	public function getModel(){

    }
    
	public function getHelper(){

    }
    
	public function getView(){

    }
    
	public function getValidate(){

    }
    
	public function getCssUrl(){

    }
    
	public function getImageUrl(){

    }
    
	public function getJsUrl(){

	}
}
