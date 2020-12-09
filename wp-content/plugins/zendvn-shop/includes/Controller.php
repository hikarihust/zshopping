<?php
class zController {
	public $_error = array();
	
	public $_data = array();
	
	public function __construct($options = array()){
		
	}

	public function isPost(){
		$flag = ($_SERVER['REQUEST_METHOD']=='POST') ? true : false;
		return $flag;
	}
	
	public function getParams($name = null){
		
		if($name == null || empty($name)){
			return $_REQUEST;
		}else{
			$val = (isset($_REQUEST[$name]) && !empty($_REQUEST[$name])) ? $_REQUEST[$name] : '';
			return $val;
		}
	}

	public function getConfig($filename = '', $dir = ''){
	
		$obj = new stdClass();
	
		$file =  ZENDVN_SP_CONFIG_PATH . $dir . DS . $filename . '.php';
	
		if(file_exists($file)){
			require_once $file;
			$controllerName = ZENDVN_SP_PREFIX . $filename . '_Config';
			$obj = new $controllerName ();
		}
		return $obj;
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
    
	public function getHelper($filename = '', $dir = ''){
		$obj = new stdClass();
		
		$file =  ZENDVN_SP_HELPER_PATH . $dir . DS . $filename . '.php';
		
		if(file_exists($file)){
			require_once $file;
			$helperName = ZENDVN_SP_PREFIX . $filename . '_Helper';
			$obj = new $helperName ();
		}
		return $obj;
    }
    
	public function getView($filename = '', $dir = ''){
		
		$file =  ZENDVN_SP_TEMPLATE_PATH . $dir . DS . $filename;
		
		if(file_exists($file)){
			require_once $file;		
		}
	}
    
	public function getValidate($filename = '', $dir = ''){
		$obj = new stdClass();
		
		$file =  ZENDVN_SP_VALIDATE_PATH . $dir . DS . $filename . '.php';
		
		if(file_exists($file)){
			require_once $file;
			$validateName = ZENDVN_SP_PREFIX . $filename . '_Validate';
			$obj = new $validateName ();
		}
		return $obj;
	}
    
	public function getCssUrl($filename = '', $dir = ''){
		$url = ZENDVN_SP_CSS_URL . $dir . '/' . $filename;
		$headers = @get_headers($url);
		$flag = stripos($headers[0], "200 OK")?true:false;
		if($flag == true){
			return $url;
		}
		
		return false;
	}
    
	public function getImageUrl($filename = '', $dir = ''){
		$url = ZENDVN_SP_IMAGES_URL . $dir . '/' . $filename;
		$headers = @get_headers($url);
		$flag = stripos($headers[0], "200 OK")?true:false;
		if($flag == true){
			return $url;
		}
		
		return false;
	}
    
	public function getJsUrl($filename = '', $dir = ''){
		$url = ZENDVN_SP_JS_URL . $dir . '/' . $filename;
		$headers = @get_headers($url);
		$flag = stripos($headers[0], "200 OK")?true:false;
		if($flag == true){
			return $url;
		}
		
		return false;
	}
}
