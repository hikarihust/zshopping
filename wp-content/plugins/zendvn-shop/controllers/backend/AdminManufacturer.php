<?php
class Zendvn_Sp_AdminManufacturer_Controller{
	
	public function __construct(){
		$this->dispatch_function();
	}
	
	public function dispatch_function() {
		global $zController;
		$action = $zController->getParams('action');

		switch ($action){
			case 'add'		: $this->add(); break;
			
			case 'edit'		: $this->edit(); break;
			
			case 'delete'	: $this->delete(); break;
			
			case 'active'	: 
			case 'inactive'	:
							  $this->status(); break;
							
			default			: $this->display(); break;
		}
	}

	public function display(){
		global $zController;

		if($zController->getParams('action') == -1){
			$url = $this->createUrl();
			wp_redirect($url);
		}
		
		$zController->getView('/manufacturer/display.php','/backend');
	}

	public function createUrl(){
		global $zController;
		
		$url = 'admin.php?page=' . $zController->getParams('page');
		
		//filter_status
		if($zController->getParams('filter_status') !== '0'){
			$url .= '&filter_status=' . $zController->getParams('filter_status');
		}
		
		if(mb_strlen($zController->getParams('s'))){
			$url .= '&s=' . $zController->getParams('s');
		}
		
		return $url;
	}

	public function add() {
		global $zController;

		if($zController->isPost()){
			$validate = $zController->getValidate('Manufacturer');
			if($validate->isValidate() == false) {
				$zController->_error = $validate->getError();
				$zController->_data = $validate->getData();
			} else {
				// Luu vao database
				$model = $zController->getModel('Manufacturer');
				$model->save_item($validate->getData());
				$url = 'admin.php?page=' . $_REQUEST['page'] . '&msg=1';
				wp_redirect($url);
			}
		}
		
		$zController->getView('/manufacturer/data_form.php','/backend');
	}

	public function edit() {
		global $zController;
		if($zController->isPost() == false){
			$model = $zController->getModel('Manufacturer');
			$zController->_data = $model->getItem($zController->getParams());		
		}else{
			$validate = $zController->getValidate('Manufacturer');
			if($validate->isValidate() == false) {
				$zController->_error = $validate->getError();
				$zController->_data = $validate->getData();
			} else {
				// Luu vao database
				$model = $zController->getModel('Manufacturer');
				$model->save_item($validate->getData());
				$url = 'admin.php?page=' . $_REQUEST['page'] . '&msg=1';
				wp_redirect($url);
			}
		}
		$zController->getView('/manufacturer/data_form.php','/backend');
	}

	public function delete() {
		global $zController;
		$arrParam = $zController->getParams();

		if(!is_array($arrParam['id'])){
			$action 	= 'delete_id_' . $arrParam['id'];
			check_admin_referer($action,'security_code');
		}else{
			wp_verify_nonce('_wpnonce');
		}
		
		$model = $zController->getModel('Manufacturer');
		$model->deleteItem($arrParam);
		
		$url = 'admin.php?page=' . $_REQUEST['page']. '&msg=1';
		wp_redirect($url);
	}

	public function status() {
		global $zController;
		$arrParam = $zController->getParams();

		if(!is_array($arrParam['id'])){
			$action 	= $arrParam['action'] . '_id_' . $arrParam['id'];
			check_admin_referer($action,'security_code');
		}else{
			wp_verify_nonce('_wpnonce');
		}
		
		$model = $zController->getModel('Manufacturer');
		$model->changeStatus($arrParam);
		
		$paged = max(1, $arrParam['paged']);
		$url = 'admin.php?page=' . $_REQUEST['page'] . '&paged=' . $paged . '&msg=1';
		wp_redirect($url);
	}

	public function no_access() {

	}
}