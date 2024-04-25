<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = conText($_POST['process']);
$table = "WF_DETAIL_GROUP";
$pk_name = "DETAIL_G_ID";

$pk_id = conText($_POST['id']);
$W = conText($_POST['W']);
$url_back = "workflow_detail_group_list.php?W=".$W;

$DETAIL_G_NAME = conText($_POST['DETAIL_G_NAME']);
$DETAIL_G_ORDER = conText($_POST['DETAIL_G_ORDER']);
$DETAIL_G_NUMDAY = conText($_POST['DETAIL_G_NUMDAY']);
$DETAIL_G_WEIGHT = conText($_POST['DETAIL_G_WEIGHT']);


if($process == "add")
{
	$a_data['WF_MAIN_ID'] = $W;
	$a_data['DETAIL_G_NAME'] = $DETAIL_G_NAME;
	$a_data['DETAIL_G_ORDER'] = $DETAIL_G_ORDER;
	$a_data['DETAIL_G_NUMDAY'] = $DETAIL_G_NUMDAY;
	$a_data['DETAIL_G_WEIGHT'] = $DETAIL_G_WEIGHT;

	db::db_insert($table, $a_data, $pk_name);
}
elseif($process == "edit")
{
	$a_data['DETAIL_G_NAME'] = $DETAIL_G_NAME;
	$a_data['DETAIL_G_ORDER'] = $DETAIL_G_ORDER;
	$a_data['DETAIL_G_NUMDAY'] = $DETAIL_G_NUMDAY;
	$a_data['DETAIL_G_WEIGHT'] = $DETAIL_G_WEIGHT;

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
	for($i=1; $i<$_POST['group_total_row']; $i++)
	{
		$DETAIL_G_ORDER = conText($_POST['DETAIL_G_ORDER'.$i]);
		$DETAIL_G_NUMDAY = conText($_POST['DETAIL_G_NUMDAY'.$i]);
		$DETAIL_G_WEIGHT = conText($_POST['DETAIL_G_WEIGHT'.$i]);

		$a_data['DETAIL_G_ORDER'] = $DETAIL_G_ORDER;
		$a_data['DETAIL_G_NUMDAY'] = $DETAIL_G_NUMDAY;
		$a_data['DETAIL_G_WEIGHT'] = $DETAIL_G_WEIGHT;

		$a_cond[$pk_name] = $_POST['id'.$i];

		db::db_update($table, $a_data, $a_cond);
	}
	echo 'Y'; 
	db::db_close();
	exit;
}

db::db_close();
if($process != "re_order"){
redirect($url_back);
}
?>