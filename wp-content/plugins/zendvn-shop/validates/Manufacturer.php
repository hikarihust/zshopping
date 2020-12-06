<?php
class Zendvn_Sp_Manufacturer_Validate {
	private $_errors = array();
	
    private $_data = array();
    
    public function isValidate($options = array()) {
        global $zController;

        $flag = false;

        $action = $zController->getParams('action');

        if(check_admin_referer($action,'security_code')) {
            
        }

        return $flag;
    }
}