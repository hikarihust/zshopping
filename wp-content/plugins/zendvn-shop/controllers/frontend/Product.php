<?php
class Zendvn_Sp_Product_Controller{
	
	public function __construct(){
		$this->dispath_function();
	}

	public function dispath_function(){
		global $zController;
		$action = $zController->getParams('action');
		
		switch ($action){
			default			: $this->display(); break;
			case 'add_cart'	: $this->add_cart(); break;
		}
	}

	public function add_cart() {
		global $zController;

		$id 	= (int)$zController->getParams('id');
		if($id > 0){
			$ss 	= $zController->getHelper('Session');
			$ssCart = $ss->get('zcart',array());
			
			if(count($ssCart) == 0){
				$ssCart[$id] = 1;
			}else{
				if(!isset($ssCart[$id])){
					$ssCart[$id] = 1;
				}else{
					$ssCart[$id] = $ssCart[$id] + 1;
				}
			}
			
			$ss->set('zcart',$ssCart);
		}
	}
	
	public function display(){
		global $zController;
		
		$zController->getView('product/display.php','/frontend' );
	}
}