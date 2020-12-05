<?php
class Zendvn_Sp_Backend{

    private $_menuSlug = 'zendvn-sp-manager';

    public function __construct() {
        add_action('admin_menu', array($this,'menus'));
    }

	public function menus(){
		add_menu_page('ZShopping', 'ZShopping', 'manage_options', $this->_menuSlug,
						array($this,'dispatch_function'),'',3);						
    }
    
    public function dispatch_function() {

    }
}
