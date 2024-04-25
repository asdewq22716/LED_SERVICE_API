<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include "../include/config.php";
$W = conText($_POST['W']);
$FIELD_N = conText($_POST['FIELD_N']);
$val = conText(trim($_POST['val']));
$WFR = conText($_POST['WFR']); 

if($W != "" AND $FIELD_N != "" AND $val != "")
{

	$sql_m = db::query("select WF_MAIN_SHORTNAME,WF_FIELD_PK from WF_MAIN where WF_MAIN_ID = '".$W."'");
	$rec_m = db::fetch_array($sql_m);
	if($WFR != ""){
	$con = " AND ".$rec_m["WF_FIELD_PK"]." != '".$WFR."'";
	}	
	$sql_workflow = "select COUNT(".$rec_m["WF_FIELD_PK"].") as ".$rec_m["WF_FIELD_PK"]." from ".$rec_m["WF_MAIN_SHORTNAME"]." where ".$FIELD_N." = '".$val."' ".$con;
	$query_workflow = db::query($sql_workflow);
	$R = db::fetch_array($query_workflow);
	if($R[$rec_m["WF_FIELD_PK"]] > 0){
		echo "D";
	}else{
		echo "N";
	}
	
}

db::db_close();
?>