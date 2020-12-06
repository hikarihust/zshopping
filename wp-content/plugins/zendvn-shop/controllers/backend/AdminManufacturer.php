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
		
		$zController->getView('/manufacturer/display.php','/backend');
	}

	public function add() {

	}

	public function edit() {

	}

	public function delete() {

	}

	public function status() {

	}

	public function no_access() {

	}
}