<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = $_REQUEST['process'];
$TABLE_NAME_OLD = conText($_POST['TABLE_NAME_OLD']);
$TABLE_NAME_NEW = conText($_POST['TABLE_NAME_NEW']);
$WF_TYPE = conText($_POST['WF_TYPE']);
$id = conText($_POST['W']);

if($WF_TYPE == 'W'){
	$str = "WFR_";
	$table = "WF_MAIN";
	$pk_name = 'WF_MAIN_ID';
}elseif($WF_TYPE == 'F'){
	$str = "FRM_";
	$table = "WF_MAIN";
	$pk_name = 'WF_MAIN_ID';
}elseif($WF_TYPE == 'M'){
	$str = "M_";
	$table = "WF_MAIN";
	$pk_name = 'WF_MAIN_ID';
}



if($process == 'EDIT_TABLENAME'){
	
	$TABLE_NAME_NEW = $str.$TABLE_NAME_NEW;
	rename_table($TABLE_NAME_OLD,$TABLE_NAME_NEW);
	$a_data['WF_MAIN_SHORTNAME'] = $TABLE_NAME_NEW;
	$a_cond[$pk_name] = $id;
	
	db::db_update($table, $a_data, $a_cond);

	echo '.';
}
db::db_close();
?>