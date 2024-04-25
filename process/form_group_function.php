<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = $_REQUEST['process'];
$table = "FORM_GROUP";
$pk_name = "GROUP_ID";
$pk_id = $_REQUEST['id'];
$url_back = "form_group_list.php";


$GROUP_NAME = conText($_POST['GROUP_NAME']);
$GROUP_STATUS = conText($_POST['GROUP_STATUS']);
$GROUP_ORDER = conText($_POST['GROUP_ORDER']);

$GROUP_STATUS = $GROUP_STATUS == "" ? "N" : $GROUP_STATUS;

if($process == "add")
{
	$a_data['GROUP_NAME'] = $GROUP_NAME;
	$a_data['GROUP_STATUS'] = $GROUP_STATUS;
	$a_data['GROUP_ORDER'] = $GROUP_ORDER;

	db::db_insert($table, $a_data, $pk_name);
}
elseif($process == "edit")
{
	$a_data['GROUP_NAME'] = $GROUP_NAME;
	$a_data['GROUP_STATUS'] = $GROUP_STATUS;
	$a_data['GROUP_ORDER'] = $GROUP_ORDER;

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
		$GROUP_STATUS = conText($_POST['GROUP_STATUS'.$i]);
		$GROUP_ORDER = conText($_POST['GROUP_ORDER'.$i]);

		$GROUP_STATUS = $GROUP_STATUS == "" ? "N" : $GROUP_STATUS;

		$a_data['GROUP_STATUS'] = $GROUP_STATUS;
		$a_data['GROUP_ORDER'] = $GROUP_ORDER;

		$a_cond[$pk_name] = $_POST['id'.$i];

		db::db_update($table, $a_data, $a_cond);
	}
}

db::db_close();
redirect($url_back);
?>