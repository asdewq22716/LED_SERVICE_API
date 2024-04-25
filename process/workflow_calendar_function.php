<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = conText($_POST['process']);
$table = "WF_CALENDAR";
$pk_name = "CAL_ID";

$pk_id = conText($_POST['id']);
$W = conText($_POST['W']);
$url_back = "workflow_calendar_list.php?W=".$W;

$a_data['CAL_CHOOSE_TYPE'] = conText($_POST['CAL_CHOOSE_TYPE']);
$a_data['CAL_W_ID'] = conText($_POST['CAL_W_ID']);
$a_data['CAL_MORE_SQL'] = conText($_POST['CAL_MORE_SQL']);
$a_data['CAL_MAIN_SQL'] = conText($_POST['CAL_MAIN_SQL']);
$a_data['CAL_SHOW'] = conText($_POST['CAL_SHOW']);
$a_data['CAL_TAG_COLOR'] = conText($_POST['CAL_TAG_COLOR']);
$a_data['CAL_BG_COLOR'] = conText($_POST['CAL_BG_COLOR']);
$a_data['CAL_START_DATE'] = strtoupper(conText($_POST['CAL_START_DATE']));
$a_data['CAL_START_TIME'] = strtoupper(conText($_POST['CAL_START_TIME']));
$a_data['CAL_END_DATE'] = strtoupper(conText($_POST['CAL_END_DATE']));
$a_data['CAL_END_TIME'] = strtoupper(conText($_POST['CAL_END_TIME']));
$a_data['CAL_TEXT_COLOR'] = conText($_POST['CAL_TEXT_COLOR']);
$a_data['CAL_LINK'] = conText($_POST['CAL_LINK']);

if($process == "add")
{
	$a_data['WF_MAIN_ID'] = $W;
	$a_data['CAL_STATUS'] = "Y";
	db::db_insert($table, $a_data, $pk_name);
}
elseif($process == "edit")
{

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
/*	for($i=1; $i<$_POST['group_total_row']; $i++)
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
	exit;*/
}

db::db_close();
if($process != "re_order"){
redirect($url_back);
}
?>