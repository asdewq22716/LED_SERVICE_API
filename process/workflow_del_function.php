<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$table = "WF_MAIN";
$pk_name = "WF_MAIN_ID";
$pk_id = conText($_GET['id']);
$drop = conText($_GET['drop']);


if($process == "delete")
{
	$a_cond[$pk_name] = $pk_id;

	$sql_main = db::query("select WF_MAIN_SHORTNAME, WF_TYPE from WF_MAIN where WF_MAIN_ID = '".$pk_id."'");
	$rec_main = db::fetch_array($sql_main);

	if($drop == "Y" && $rec_main['WF_MAIN_SHORTNAME'] != "")
	{
		drop_table($rec_main['WF_MAIN_SHORTNAME']);
	}

	if($rec_main['WF_TYPE'] == 'W')
	{
		$sql_detail = db::query("SELECT WFD_ID FROM WF_DETAIL WHERE WF_MAIN_ID = '".$pk_id."'");
		while($rec_detail = db::fetch_array($sql_detail))
		{
			delete_wf_detail($rec_detail['WFD_ID']);
		}
	}
	else
	{
		$sql_detail = db::query("SELECT WFS_ID FROM WF_STEP_FORM WHERE WF_MAIN_ID = '".$pk_id."'");
		while($rec_detail = db::fetch_array($sql_detail))
		{
			delete_wf_step_form($rec_detail['WFS_ID']);
		}
	}

	delete_wf_main($pk_id);

	db::db_close();
	exit;
}


?>