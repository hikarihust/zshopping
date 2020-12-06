<?php
class Zendvn_Sp_AdminMenu_Helper{

	public function __construct(){
        add_action("admin_menu", array($this,'modify_admin_menus'));
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