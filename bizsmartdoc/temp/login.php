<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '0');
include "../include/config.php";

$USER_NAME = conText($_POST['USER_NAME']);
$PASSWORD = conText($_POST['USER_PASSWORD']);
$PASSWORD = hash('sha1',$PASSWORD);
$date = date('d/m/').(date('Y')+543);

$sql_usr = db::query("SELECT * FROM USR_MAIN WHERE USR_USERNAME = '".$USER_NAME."' AND USR_PASSWORD = '".$PASSWORD."' AND USR_STATUS = 'Y' ");
$G = db::fetch_array($sql_usr);

if($G["USR_ID"] != '')
{
	$sql_set = db::query("SELECT * FROM USR_SETTING WHERE ((FIELD_TYPE='O') OR (FIELD_TYPE='S' AND (FIELD_NAME = 'DEP_ID' OR FIELD_NAME='POS_ID')))  ORDER BY FIELD_ID");

	$_SESSION["WF_USER_ID"] = $G["USR_ID"];
	$_SESSION["WF_USERNAME"] = $G["USR_USERNAME"];
	$_SESSION["WF_USER_NAME"] = $G["USR_PREFIX"].$G["USR_FNAME"]." ".$G["USR_LNAME"];
	$_SESSION["WF_ADMIN"] = $G['USR_ADM'];
	while($rec_o = db::fetch_array($sql_set))
	{
		$_SESSION[$rec_o["FIELD_NAME"]] = $G[$rec_o["FIELD_NAME"]];
	}

	$sql_permission = db::query("SELECT * FROM PERMISSION_INSTEAD WHERE USR_ID='".$G["USR_ID"]."' AND '".date2db($date)."' BETWEEN PI_STARTDATE AND PI_ENDDATE");
	$num_rows = db::num_rows($sql_permission);

	if($num_rows > 0)
	{
		$_SESSION["TEMP_WF_USER_ID"] = $G["USR_ID"];
		echo "instead";
	}
	else
	{


		echo "success";

	}
}
else
{
	echo "error";
}
db::db_close();
?>