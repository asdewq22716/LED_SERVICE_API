<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = $_REQUEST['process'];
$table = "USR_DEPARTMENT";
$pk_name = "DEP_ID";
$pk_id = $_REQUEST['id'];
$url_back = "department_list.php";


$DEP_ORDER = conText($_POST['DEP_ORDER']);
$DEP_NAME = conText($_POST['DEP_NAME']);
$DEP_SHORT_NAME = conText($_POST['DEP_SHORT_NAME']);
$DEP_CODE = conText($_POST['DEP_CODE']);
$DEP_STATUS = conText($_POST['DEP_STATUS']);

$DEP_STATUS = $DEP_STATUS == "" ? "N" : $DEP_STATUS;

if($process == "add")
{
	$a_data['DEP_ORDER'] = $DEP_ORDER;
	$a_data['DEP_NAME'] = $DEP_NAME;
	$a_data['DEP_SHORT_NAME'] = $DEP_SHORT_NAME;
	$a_data['DEP_CODE'] = $DEP_CODE;
	$a_data['DEP_STATUS'] = $DEP_STATUS;

	db::db_insert($table, $a_data, $pk_name);
}
elseif($process == "edit")
{
	$a_data['DEP_ORDER'] = $DEP_ORDER;
	$a_data['DEP_NAME'] = $DEP_NAME;
	$a_data['DEP_SHORT_NAME'] = $DEP_SHORT_NAME;
	$a_data['DEP_CODE'] = $DEP_CODE;
	$a_data['DEP_STATUS'] = $DEP_STATUS;

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
		$GROUP_STATUS = conText($_POST['DEP_STATUS'.$i]);
		$GROUP_ORDER = conText($_POST['DEP_ORDER'.$i]);

		$GROUP_STATUS = $GROUP_STATUS == "" ? "N" : $GROUP_STATUS;

		$a_data['DEP_STATUS'] = $GROUP_STATUS;
		$a_data['DEP_ORDER'] = $GROUP_ORDER;

		$a_cond[$pk_name] = $_POST['id'.$i];

		db::db_update($table, $a_data, $a_cond);
	}
}

db::db_close();
redirect($url_back);
?>