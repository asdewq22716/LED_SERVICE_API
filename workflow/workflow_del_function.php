<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 

$W = conText($_POST["W"]);
$WFR = conText($_POST["WFR"]);

$sql = db::query("SELECT WF_MAIN_SHORTNAME,WF_MAIN_DEL_INCLUDE,WF_FIELD_PK,WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID='".$W."'");
$rec = db::fetch_array($sql);

if($rec["WF_MAIN_DEL_INCLUDE"] != ''){
	if(file_exists('../plugin/'.$rec["WF_MAIN_DEL_INCLUDE"])){
		include('../plugin/'.$rec["WF_MAIN_DEL_INCLUDE"]);
		
	}
}
//delete FRM
$sql_frm = db::query("SELECT WF_MAIN_SHORTNAME FROM WF_STEP_FORM JOIN WF_MAIN ON WFS_FORM_SELECT=WF_MAIN.WF_MAIN_ID WHERE WF_STEP_FORM.WF_MAIN_ID='".$W."' AND FORM_MAIN_ID='16' GROUP BY WF_MAIN_SHORTNAME");
$num_rows_frm = db::num_rows($sql_frm);
if($num_rows_frm > 0){
	while($frm = db::fetch_array($sql_frm)){
		$a_condf["WF_MAIN_ID"] = $W;
		$a_condf["WFR_ID"] = $WFR;
		db::db_delete($frm["WF_MAIN_SHORTNAME"], $a_condf);
		unset($a_condf);
	}
}

//delete WF_CHECKBOX
$a_cond_c["W_ID"] = $W;
$a_cond_c["WFR_ID"] = $WFR;
db::db_delete('WF_CHECKBOX', $a_cond_c);
unset($a_cond_c);

//delete WF_FILE
$a_cond_f["WF_MAIN_ID"] = $W;
$a_cond_f["WFR_ID"] = $WFR;
db::db_delete('WF_FILE', $a_cond_f);
unset($a_cond_f); 

//delete Control Version
$a_cond_v["WF_MAIN_ID"] = $W;
$a_cond_v["WFR_ID"] = $WFR;
db::db_delete('DOC_VERSION', $a_cond_v);
unset($a_cond_v);

//delete WF_STEP
if($rec["WF_TYPE"] == 'W'){
	
	//delete WF_MESSAGE
	$a_cond_m["WF_MAIN_ID"] = $W;
	$a_cond_m["WFR_ID"] = $WFR;
	db::db_delete('WF_MESSAGE', $a_cond_m);
	unset($a_cond_m);
	
	$a_cond1["WF_MAIN_ID"] = $W;
	$a_cond1["WFR_ID"] = $WFR;
	db::db_delete('WF_STEP', $a_cond1);
	unset($a_cond1);
	
	$a_cond2["WF_MAIN_ID"] = $W;
	$a_cond2["WFR_ID"] = $WFR;
	db::db_delete('WF_ALERT', $a_cond2);
	unset($a_cond2);
}
//delete WFR
$a_cond[$rec["WF_FIELD_PK"]] = $WFR;
db::db_delete($rec["WF_MAIN_SHORTNAME"], $a_cond);


db::db_close();
//redirect($url_back);
?>