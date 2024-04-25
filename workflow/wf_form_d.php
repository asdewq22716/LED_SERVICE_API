<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 
$W = conText($_POST['W']);
$process = conText($_POST['process']);
$f = conText($_POST['f']);
 
if($process == "d" AND is_numeric($f))
{
	
$sql = db::query("SELECT WF_MAIN_SHORTNAME,WF_MAIN_DEL_INCLUDE,WF_FIELD_PK,WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID='".$W."'");
$rec = db::fetch_array($sql);

if($rec["WF_MAIN_DEL_INCLUDE"] != ''){
	if(file_exists('../plugin/'.$rec["WF_MAIN_DEL_INCLUDE"])){
		include('../plugin/'.$rec["WF_MAIN_DEL_INCLUDE"]);
		
	}
}

//delete Form
$sql_frm = db::query("SELECT WF_MAIN_SHORTNAME FROM WF_STEP_FORM JOIN WF_MAIN ON WFS_FORM_SELECT=WF_MAIN.WF_MAIN_ID WHERE WF_STEP_FORM.WF_MAIN_ID='".$W."' AND FORM_MAIN_ID='16' GROUP BY WF_MAIN_SHORTNAME");
$num_rows_frm = db::num_rows($sql_frm);
if($num_rows_frm > 0){
	while($frm = db::fetch_array($sql_frm)){
		$a_condf["WF_MAIN_ID"] = $W;
		$a_condf["WFR_ID"] = $f;
		db::db_delete($frm["WF_MAIN_SHORTNAME"], $a_condf);
		unset($a_condf);
	}
}

//delete WF_CHECKBOX
$a_cond_c["W_ID"] = $W;
$a_cond_c["WFR_ID"] = $f;
db::db_delete('WF_CHECKBOX', $a_cond_c);
unset($a_cond_c);

//delete WF_FILE
$a_cond_f["WF_MAIN_ID"] = $W;
$a_cond_f["WFR_ID"] = $f;
db::db_delete('WF_FILE', $a_cond_f);
unset($a_cond_f);

	$sql = db::query("select WF_MAIN_SHORTNAME,WF_FIELD_PK from WF_MAIN where WF_MAIN_ID = '".$W."'");
	$rec_main = db::fetch_array($sql); 
	$a_cond[$rec_main['WF_FIELD_PK']] = $f;

	db::db_delete($rec_main['WF_MAIN_SHORTNAME'], $a_cond);
}

db::db_close();
?>