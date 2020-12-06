<?php
if(!class_exists('WP_List_Table')){
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Zendvn_Sp_Manufacturer_Model extends WP_List_Table {
	private $_per_page = 5;
	
	private $_sql;
    
    //1.1 Xay dung ham construct
	public function __construct(){
		parent::__construct(array(
			'plural' => 'id',
			'singular' => 'id',
			'ajax' => false,
			'screen' => null,
		));
	}

    //1.2 Xay dung ham construct
	public function prepare_items(){
		
		$columns 	= $this->get_columns();		
		$hidden 	= $this->get_hidden_columns();
		$sortable 	= $this->get_sortable_columns();
		
		$this->_column_headers = array($columns,$hidden,$sortable);
		$this->items = $this->table_data();

		$total_items 	= $this->total_items();
		$per_page 		= $this->_per_page;
		$total_pages 	= ceil($total_items/$per_page);

		$this->set_pagination_args(array(
			'total_items' 	=> $total_items,
			'per_page' 		=> $per_page,
			'total_pages' 	=> $total_pages
		));
	}

	public function get_bulk_actions(){
		$actions = array(
				'delete' => 'Delete',
				'active' => 'Active',
				'inactive' => 'Inactive'
		);
		return $actions;
	}

	public function column_status($item){
		global $zController;
			
		if($item['status'] == 1 ){
			$action = 'inactive';
			$src = $zController->getImageUrl('/icons/active.png');
		}else{
			$action = 'active';
			$src = $zController->getImageUrl('/icons/inactive.png');
		}
		$paged = max(1,@$_REQUEST['paged']);
			
		$name 		= 'security_code';
		$lnkStatus 	= add_query_arg(array('action'=>$action,'id'=>$item['id'],'paged'=> $paged));
		$action 	= $action . '_id_' . $item['id'];
		$lnkStatus 	= wp_nonce_url($lnkStatus,$action,$name);
			
		$html = '<img alt="" src="' . $src . '">';
		$html = '<a href="' . $lnkStatus . '">' . $html . '</a>';
		return $html;
	}

	protected function extra_tablenav($which){
		
		if($which == 'top'){
			$htmlObj =  new ZendvnHtml();
				
			$filterVal = @$_REQUEST['filter_status'];
			$options['data'] = array(
					'0' => 'Status filter',
					'active' => 'Active',
					'inactive' => 'Inactive'
			);
				
			$slbFilter 	= $htmlObj->selectbox('filter_status',$filterVal,array(),$options);
				
			$attr 		= array('id'=>'filter_action','class'=>'button');
			$btnFilter 	= $htmlObj->button('filter_action','Filter',$attr);
				
			echo '<div class="alignleft actions bulkactions">'
				 . $slbFilter . $btnFilter
				 .'</div>';
		}
	}

	public function column_name($item){
		
		global $zController;
		
		$page = $zController->getParams('page');
	
		$name = 'security_code';
	
		$lnkDelete =  add_query_arg(array('action'=>'delete','id'=>$item['id']));
		$action 	= 'delete_id_' . $item['id'];
		$lnkDelete = wp_nonce_url($lnkDelete,$action,$name);
	
		$actions = array(
				'edit' 		=> '<a href="?page=' . $page . '&action=edit&id=' . $item['id'] . '">Edit</a>',
				'delete' 	=> '<a href="' . $lnkDelete . '">Delete</a>',
				'view' 		=> '<a href="#">View</a>'
		);
	
		$html = '<strong><a href="?page=' . $page . '&action=edit&id=' . $item['id'] . '">' . $item['name'] .'</a></strong>'
				. $this->row_actions($actions);
		return $html;
	}

	public function column_cb($item){
		$singular = $this->_args['singular'];
		$html = '<input id="cb-select-' . $item['id'] . '" type="checkbox" name="' . $singular .'[]" value="' . $item['id'] .'" />';
		return $html;
	}
	
	public function column_default($item, $column_name){
	
		return $item[$column_name];
	}

	private function total_items(){
		global $wpdb;
		return $wpdb->query($this->_sql);
	}

	private function table_data() {
        $data = array();
        $whereArr = array();
	
		global $wpdb,$zController;
	
		//&orderby=title&order=asc
		$orderby 	= ($zController->getParams('orderby') == '')? 'id' : $_GET['orderby'];
		$order		= ($zController->getParams('order') == '')? 'DESC' : $_GET['order'];
		$tblManufacturer = $wpdb->prefix . 'zendvn_sp_manufacturer';
		$sql = 'SELECT m.*
				FROM ' . $tblManufacturer . ' AS m ';
	
		if($zController->getParams('filter_status') != ''){
			$status = ($zController->getParams('filter_status') == 'active')? 1:0;
			$whereArr[] = " (m.status = $status) ";
		}
	
		if($zController->getParams('s') != ''){
			$s = esc_sql($zController->getParams('s'));
			$whereArr[] = " (m.name LIKE '%$s%') ";
		}
	
		if(count($whereArr)>0){
			$sql .= " WHERE " . join(" AND ", $whereArr);
				
		}
	
		$sql .= ' ORDER BY m.' . esc_sql($orderby) . ' ' . esc_sql($order);
		$this->_sql  = $sql;
	
		$paged 		= max(1, @$_REQUEST['paged']);
		$offset 	= ($paged - 1) * $this->_per_page;
		$sql .= ' LIMIT ' . $this->_per_page . ' OFFSET ' . $offset;
	
		$data = $wpdb->get_results($sql,ARRAY_A);
	
		return $data;
	}

	public function get_sortable_columns(){
		return array(
				'name' => array('name',true),
				'id'	=> array('id', true)
		);
	}
    
	public function get_columns(){
		$arr = array(
            'cb'		=> '<input type="checkbox" />',
            'name' 		=> 'Name',
            'slug'		=> 'Slug',
            'status' 	=> 'Status',
            'id'		=> 'ID'
        );
        return $arr;
    }
    
	public function get_hidden_columns(){
		return array();
	}

	public function save_item($arrData = array(), $options = array()) {
		global $zController, $wpdb;
		$action = $arrData['action'];
		$slug = '';
		if(empty($arrData['slug'])){
			$slug = sanitize_title($arrData['name']);
		}else{
			$slug = sanitize_title($arrData['slug']);
		}

		$slugHelper = $zController->getHelper('CreateSlug');
		if($action == 'add'){
			$optionSlug = array('table'=>'zendvn_sp_manufacturer','field'=>'slug');
		}else if($action == 'edit'){

		}
		$slug 		= $slugHelper->getSlug($slug, $optionSlug);
	}
}