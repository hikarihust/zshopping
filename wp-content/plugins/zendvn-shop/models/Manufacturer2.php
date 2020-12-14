<?php
class Zendvn_Sp_Manufacturer2_Model{
	
	public function getItem($arrData = array(), $options = array()){
		global $wpdb;
		$table = $wpdb->prefix . 'zendvn_sp_manufacturer';

		if(isset($options['type']) && $options['type'] == 'all') {
			$status = isset($arrData['status']) ? absint($arrData['status']) : 'all';
			$sql = "SELECT * FROM $table";
			if($status != 'all'){
				$sql .= " WHERE status = $status ORDER BY name ASC ";
			}
			$result = $wpdb->get_results($sql,ARRAY_A);
		} else {
			$id = absint($arrData['id']);
			$sql = "SELECT * FROM $table WHERE id = $id";
			$result = $wpdb->get_row($sql, ARRAY_A);
		}
		
		return $result;
	}
}