<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = $_REQUEST['process'];
$table = "USR_POSITION";
$pk_name = "POS_ID";
$pk_id = $_REQUEST['id'];
$url_back = "position_list.php";


$POS_ORDER = conText($_POST['POS_ORDER']);
$POS_NAME = conText($_POST['POS_NAME']);
$POS_SHORT_NAME = conText($_POST['POS_SHORT_NAME']);
$POS_CODE = conText($_POST['POS_CODE']);
$POS_STATUS = conText($_POST['POS_STATUS']);

$POS_STATUS = $POS_STATUS == "" ? "N" : $POS_STATUS;

if($process == "add")
{
	$a_data['POS_ORDER'] = $POS_ORDER;
	$a_data['POS_NAME'] = $POS_NAME;
	$a_data['POS_SHORT_NAME'] = $POS_SHORT_NAME;
	$a_data['POS_CODE'] = $POS_CODE;
	$a_data['POS_STATUS'] = $POS_STATUS;

	db::db_insert($table, $a_data, $pk_name);
}
elseif($process == "edit")
{
	$a_data['POS_ORDER'] = $POS_ORDER;
	$a_data['POS_NAME'] = $POS_NAME;
	$a_data['POS_SHORT_NAME'] = $POS_SHORT_NAME;
	$a_data['POS_CODE'] = $POS_CODE;
	$a_data['POS_STATUS'] = $POS_STATUS;

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
		$GROUP_STATUS = conText($_POST['POS_STATUS'.$i]);
		$GROUP_ORDER = conText($_POST['POS_ORDER'.$i]);

		$GROUP_STATUS = $GROUP_STATUS == "" ? "N" : $GROUP_STATUS;

		$a_data['POS_STATUS'] = $GROUP_STATUS;
		$a_data['POS_ORDER'] = $GROUP_ORDER;

		$a_cond[$pk_name] = $_POST['id'.$i];

		db::db_update($table, $a_data, $a_cond);
	}
}

db::db_close();
redirect($url_back);
?>