<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$proc = conText($_POST['process']);
$table = "WF_KANBAN_LIST";
$pk_name = "K_LIST_ID";

$pk_id = conText($_POST['id']);
$k_id = conText($_POST['k_id']);
$W = conText($_POST['W']);
$url_back = "workflow_kanban.php?W=".$W;

$a_data['KAN_LIST_NAME'] = conText($_POST['KAN_LIST_NAME']);
$a_data['KAN_CHOOSE_TYPE'] = conText($_POST['KAN_CHOOSE_TYPE']);
$a_data['KAN_W_ID'] = conText($_POST['KAN_W_ID']);
$a_data['KAN_MORE_SQL'] = conText($_POST['KAN_MORE_SQL']);
$a_data['KAN_MAIN_SQL'] = conText($_POST['KAN_MAIN_SQL']);
$a_data['KAN_SHOW'] = conText($_POST['KAN_SHOW']);
$a_data['KAN_LINK'] = conText($_POST['KAN_LINK']);
$a_data['K_ID']	= $k_id;

if($proc == "add")
{
	$a_data['WF_MAIN_ID'] = $W;
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

db::db_close();
redirect($url_back);
?>