<?php
class Zendvn_Sp_CreateSlug_Helper {
	/* $options: 
	 * array[
	 * 		'table' => 'wp_zendvn_sp_manufacturer',
	 * 		'field' => 'slug',
	 * 		'exception' => array('field' => 'id', 'value'=> 2)  
	 *  ]
	 */
    public function getSlug($val = '', $options = array()) {
        global $wpdb, $zController;

        $newVal = $val;
        $table 	= $wpdb->prefix . $options['table'];
        $field 	= $options['field'];

		for($i=0; $i < 999; $i++) {
			if($i > 0) {
				$newVal = $val . '-' . $i;
			}
			if(!isset($options['exception'])){
				
				$sql = "SELECT COUNT(id) 
						FROM $table 
						WHERE $field = '$newVal'";
				$sql = $wpdb->prepare($sql, '%s','%s','%s');
				$result = $wpdb->get_col($sql);
			}else{
				
			}
			if($result[0] == 0) return $newVal;
		}
    }
}