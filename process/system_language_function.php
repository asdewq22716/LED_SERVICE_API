<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = $_REQUEST['process'];
$table = "WF_LANGUAGE";
$pk_name = "LANG_ID";
$pk_id =  conText($_REQUEST['id']);
$WF_TYPE = conText($_REQUEST['WF_TYPE']);

if($WF_TYPE == 'W'){
	$url_back = "system_language.php";
	
}

$LANG_NAME = conText($_POST['LANG_NAME']);
$LANG_STATUS = conText($_POST['LANG_STATUS']);
$LANG_ORDER = conText($_POST['LANG_ORDER']);
$LANG_ICON = conText($_REQUEST['LANG_ICON']);

$LANG_STATUS = $LANG_STATUS == "" ? "N" : $LANG_STATUS;

if($process == "add")
{
	$a_data['LANG_NAME'] = $LANG_NAME;
	$a_data['LANG_STATUS'] = $LANG_STATUS;
	$a_data['LANG_ORDER'] = $LANG_ORDER;
	$a_data['LANG_ICON'] = $LANG_ICON;
	
	db::db_insert($table, $a_data, $pk_name);
}
elseif($process == "edit")
{
	$a_data['LANG_NAME'] = $LANG_NAME;
	$a_data['LANG_STATUS'] = $LANG_STATUS;
	$a_data['LANG_ORDER'] = $LANG_ORDER;
	$a_data['LANG_ICON'] = $LANG_ICON;

	$a_cond[$pk_name] = $pk_id;

	db::db_update($table, $a_data, $a_cond);
}
elseif($process == "delete")
{
	$a_cond[$pk_name] = $pk_id;

	db::db_delete($table, $a_cond);
}
elseif($process == "re_order")
{
	
	for($i=1; $i<$_POST['total_row']; $i++)
	{
		$LANG_STATUS = conText($_POST['LANG_STATUS'.$i]);
		$LANG_ORDER = conText($_POST['LANG_ORDER'.$i]);

		$LANG_STATUS = $LANG_STATUS == "" ? "N" : $LANG_STATUS;

		$a_data['LANG_STATUS'] = $LANG_STATUS;
		$a_data['LANG_ORDER'] = $LANG_ORDER;

		$a_cond[$pk_name] = $_POST['id'.$i];

		db::db_update($table, $a_data, $a_cond);
	}
}

db::db_close();
redirect($url_back);
?>