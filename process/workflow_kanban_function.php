<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$proc = conText($_POST['process']);
$table = "WF_KANBAN_GROUP";
$pk_name = "K_ID";

$pk_id = conText($_POST['id']);
$W = conText($_POST['W']);
$url_back = "workflow_kanban.php?W=".$W;

$a_data['K_ORDER'] = conText($_POST['K_ORDER']);
$a_data['K_NAME'] = conText($_POST['K_NAME']);
$a_data['K_STATUS'] = conText($_POST['K_STATUS']);

if($proc == "add")
{
	$a_data['WF_MAIN_ID'] 	= 	$W;
	db::db_insert($table, $a_data, $pk_name);
}
elseif($proc == "edit")
{
	$a_cond[$pk_name] = $pk_id;
	db::db_update($table, $a_data, $a_cond);
}
elseif($proc == "delete")
{
	$a_cond[$pk_name] = $pk_id;

	db::db_delete($table, $a_cond);
}
elseif($proc == "re_order")
{
	for($i=1; $i<$_POST['group_total_row']; $i++)
	{
		$a_data = array();
		$K_ORDER = conText($_POST['K_ORDER'.$i]);
		$a_data['K_ORDER'] = $K_ORDER;

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