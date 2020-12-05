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
    
	public function getModel($filename = '', $dir = ''){

		$obj = new stdClass();
		
		$file =  ZENDVN_SP_MODELS_PATH . $dir . DS . $filename . '.php';
		
		if(file_exists($file)){
			require_once $file;
			$modelName = ZENDVN_SP_PREFIX . $filename . '_Model';
			$obj = new $modelName ();
		}
		return $obj;
	}
    
	public function getHelper(){

    }
    
	public function getView($filename = '', $dir = ''){
		
		$file =  ZENDVN_SP_TEMPLATE_PATH . $dir . DS . $filename;
		
		if(file_exists($file)){
			require_once $file;		
		}
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
