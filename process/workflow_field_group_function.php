<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = conText($_POST['process']);
$table = "WF_FIELD_GROUP";
$pk_name = "FIELD_G_ID";

$pk_id = conText($_POST['id']);
$W = conText($_POST['W']);
$WFD = conText($_POST['WFD']);

$url_back = "workflow_step_form.php?W=".$W.'&WFD='.$WFD;

$FIELD_G_NAME = conText($_POST['FIELD_G_NAME']);
$FIELD_G_ORDER = conText($_POST['FIELD_G_ORDER']);
$FIELD_G_TYPE = conText($_POST['WF_TYPE']);

if($process == "add")
{
	$a_data['WFD_ID'] = $WFD;
	$a_data['FIELD_G_NAME'] = $FIELD_G_NAME;
	$a_data['FIELD_G_ORDER'] = $FIELD_G_ORDER;
	$a_data['WF_TYPE'] = $FIELD_G_TYPE;
	$a_data['WF_MAIN_ID'] = $W;
	

  

	db::db_insert($table, $a_data, $pk_name);
}
elseif($process == "edit")
{
	$a_data['FIELD_G_NAME'] = $FIELD_G_NAME;
	$a_data['FIELD_G_ORDER'] = $FIELD_G_ORDER;
  

	$a_cond[$pk_name] = $pk_id;

	db::db_update($table, $a_data, $a_cond);
}
elseif($process == "DEL")
{
	$a_cond[$pk_name] = $pk_id; 

	db::db_delete($table, $a_cond);
}

if($process != "DEL"){
redirect($url_back);
}
?>