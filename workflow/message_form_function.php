<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_user.php'; 

$W = conText($_POST['W']);
$WFR = conText($_POST['WFR']);
$WFD_ID = conText($_POST['WFD_ID']);
$process = conText($_REQUEST['process']);
$WF_TYPE = conText($_POST['WF_TYPE']);
$USR_ID = conText($_SESSION['WF_USER_ID']);
$MESSAGE_DETAIL = conText($_POST['MESSAGE_DETAIL']);

$table = 'WF_MESSAGE';
$pk_name = 'MESSAGE_ID';

if($process == "add")
{
	$a_data['WF_MAIN_ID'] = $W;
	$a_data['WFD_ID'] = $WFD_ID;
	$a_data['WFR_ID'] = $WFR;
	$a_data['USR_ID'] = $USR_ID;
	$a_data['MESSAGE_DETAIL'] = $MESSAGE_DETAIL;
	$a_data['MESSAGE_DATE'] = date2db(date("d/m/").(date("Y")+543));
	$a_data['MESSAGE_TIME'] = date('H:i:s');
	
	db::db_insert($table, $a_data, $pk_name);
	echo '.';
}elseif($process == "del")
{
	
	$id = conText($_GET['MS_ID']);
	$a_cond[$pk_name] = $id;
	db::db_delete($table, $a_cond);
	echo ".";
}

db::db_close(); ?>
