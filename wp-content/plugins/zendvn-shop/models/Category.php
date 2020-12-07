<?php
class Zendvn_Sp_Category_Model{
	
    public function create(){
		$labels = array(
            'name'				=> 'ZS categories',
            'singular' 			=> 'ZS category',
            'menu_name'			=> 'Categories',
            //'all_items'		=> chua xac dinh
            //'view_item'		=> chua xac dinh
            'edit_item'			=> 'Edit zs category',
            'update_item'		=> 'Update zs categor',
            'add_new_item'		=> 'Add new zs category',
            //'new_item_name'	=> chua xac dinh
            //'parent_item'		=> chua xac dinh
            //'parent_item_colon'	=> chua xac dinh
            'search_items'		=> 'Search zs categories',
            'popular_items'		=> 'zs categories are using',
            'separate_items_with_commas' => 'Separate tags with commas',
            'choose_from_most_used' => 'Choose from the most used tags',
            'not_found'			=> 'No zs category found',
        );

		$args = array(
            'labels' 				=> $labels,
            'public'				=> true,
            'show_in_rest'          => true,
            // 'show_ui'				=> false,
            // 'show_in_nav_menus'	    => false,
            'show_tagcloud'			=> true,
            'hierarchical'			=> true,
            'show_admin_column'		=> false,
            'query_var'				=> true,
            'rewrite'				=> array('slug' => 'zs_category'),
        );

        register_taxonomy('zs_category', 'zsproduct',$args);
    }
}