<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = conText($_POST['process']);
$table = "USR_MAIN";
$pk_name = "USR_ID";
$pk_id = conText($_POST['id']);


$USR_PW_NEW = conText($_POST['USR_PW_NEW']);
$USR_PASSWORD = hash('sha1', $USR_PW_NEW);
if($process == "change_password")
{
	$a_data['USR_PASSWORD'] = $USR_PASSWORD;
	$a_cond[$pk_name] = $pk_id;

	db::db_update($table, $a_data, $a_cond);
	echo 'Y';
}

db::db_close();
//redirect($url_back);
?>