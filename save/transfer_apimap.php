<?php 
// include '../include/include.php';
// print_pre($WF['PRIVILEGE_GROUP_ID']);
// exit;
	$field = array();
	$field['MAPPING_API_CODE'] = $WF['PRIVILEGE_GROUP_ID'];
	$field['MAPPING_API_STATUS'] = 0;
	db::db_insert('M_MAPPING_API', $field, 'MAPPING_API_ID', 'MAPPING_API_ID');
?>

