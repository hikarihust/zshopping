<?php
class Zendvn_Sp_Backend{

	private $_menuSlug = 'zendvn-sp-manager';
	
	private $_page = '';

    public function __construct() {
		if(isset($_GET['page'])) $this->_page = $_GET['page'];
		add_action('admin_menu', array($this,'menus'));
		if($this->_page == 'zendvn-sp-manager-manufacturer'){
			add_action('admin_init', array($this,'do_output_buffer'));
		}
	}
	
	public function do_output_buffer(){
		ob_start();
	}

	public function menus(){
		global $zController;
		$iconUrl = $zController->getImageUrl('/icons/shopping.png');
		add_menu_page('ZShopping', 'ZShopping', 'manage_options', $this->_menuSlug,
						array($this,'dispatch_function'),$iconUrl,3);		
						
		//Dashboard
		add_submenu_page($this->_menuSlug, 'Dashboard', 'Dashboard', 'manage_options',
						$this->_menuSlug,array($this,'dispatch_function'));
                        
        add_submenu_page($this->_menuSlug, 'Categories', 'Categories', 'manage_options', 
						$this->_menuSlug . '-categories',array($this,'dispatch_function'));						

		add_submenu_page($this->_menuSlug, 'Products ', 'Products ', 'manage_options',
						$this->_menuSlug . '-products',array($this,'dispatch_function'));
						
		add_submenu_page($this->_menuSlug, 'Manufacturer', 'Manufacturer', 'manage_options',
						$this->_menuSlug . '-manufacturer',array($this,'dispatch_function'));
						
		add_submenu_page($this->_menuSlug, 'Invoices', 'Invoices', 'manage_options',
						$this->_menuSlug . '-invoices',array($this,'dispatch_function'));

		add_submenu_page($this->_menuSlug, 'Settings', 'Settings', 'manage_options',
						$this->_menuSlug . '-settings',array($this,'dispatch_function'));
    }
    
    public function dispatch_function() {
		global $zController;
		$page = $this->_page;

		if($page == 'zendvn-sp-manager'){			
			$obj = $zController->getController('AdminShopping','/backend');		
			$obj->display();
		}

		if($page == 'zendvn-sp-manager-categories'){
			$obj = $zController->getController('AdminCategory','/backend');
		}

		if($page == 'zendvn-sp-manager-products'){
			$obj = $zController->getController('AdminProduct','/backend');
		}
		
		if($page == 'zendvn-sp-manager-manufacturer'){
			$obj = $zController->getController('AdminManufacturer','/backend');
		}
		
		if($page == 'zendvn-sp-manager-invoices'){
			$obj = $zController->getController('AdminInvoices','/backend');
		}		

		if($page == 'zendvn-sp-manager-settings'){
			$obj = $zController->getController('AdminSetting','/backend');
			$obj->display();
		}
    }
}
