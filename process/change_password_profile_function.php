<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = conText($_POST['process']);
$table = "USR_MAIN";
$pk_name = "USR_ID";
$USR_PW_NEW = conText($_POST['USR_PW_NEW']);
$USR_PW_OLD = conText($_POST['USR_PW_OLD']);

$USR_PASSWORD = hash('sha1', $USR_PW_NEW);
$USR_PASSWORD_OLD = hash('sha1', $USR_PW_OLD);

if($process == "change_password")
{

	$sql_usr = db::query("SELECT * FROM USR_MAIN WHERE USR_ID = '".$_SESSION["WF_USER_ID"]."' AND USR_PASSWORD = '".$USR_PASSWORD_OLD."' AND USR_STATUS = 'Y' ");
	$G = db::fetch_array($sql_usr);

	if($G["USR_ID"] == ''){
		echo 'N';
		
	}else{
	
		$a_data['USR_PASSWORD'] = $USR_PASSWORD;
		$a_cond[$pk_name] = $_SESSION["WF_USER_ID"];
		db::db_update($table, $a_data, $a_cond);
		echo 'Y';
	}
}

db::db_close();
//redirect($url_back);
?>