<?php
class Zendvn_Sp_AdminMenu_Helper{

	public function __construct(){
        add_action("admin_menu", array($this,'modify_admin_menus'));
		if(isset($_GET['post_type']) && $_GET['post_type'] == 'zsproduct'){
			add_action('admin_enqueue_scripts', array($this,'add_js'));
		}
    }
    
	public function add_js(){
		global $zController;
		
		wp_enqueue_script('zendvn_sp_admin_menu',$zController->getJsUrl('admin_menu.js'),
						array('jquery'),'1.0.0',false);
	}

    function modify_admin_menus(){
        global $menu, $submenu;
    
        $zendvn_sp_manager = $submenu['zendvn-sp-manager'];
        foreach ($zendvn_sp_manager as $key => $val){
            if($val[2] == 'zendvn-sp-manager-categories') {
                $zendvn_sp_manager[$key][2] = 'edit-tags.php?taxonomy=zs_category&post_type=zsproduct';
            }
                
            if($val[2] == 'zendvn-sp-manager-products') {
                $zendvn_sp_manager[$key][2] = 'edit.php?post_type=zsproduct';
            }
        }
        $submenu['zendvn-sp-manager'] = $zendvn_sp_manager;
        remove_menu_page('edit.php?post_type=zsproduct');
    }

}