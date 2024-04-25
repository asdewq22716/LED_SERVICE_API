<?php
header('Content-Type: application/json');
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_POST['W']);
$WFR = conText($_POST['WFR']);
$TARGET = conText($_POST['TARGET']);
if($W != ""){

$sql_main = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql_main);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
$pk_name = $rec_main["WF_FIELD_PK"];
$WF_TYPE = $rec_main["WF_TYPE"];
$update_wf = array();
$wf_cond = array();
$FLAG_ADD = "Y";
if($WFR == ""){ //new step
	$insert_wf = array();
	$WFR = db::db_insert($wf_table, $insert_wf, $pk_name);
	unset($insert_wf);	
$FLAG_ADD = "N";
}

$wf_link = "master_main.php?W=".$W;

	$insert_step = array();

	$update_wf = bsf_save_form($W,'0',$WFR,$WF_TYPE,$update_wf,$FLAG_ADD);

	$wf_cond[$pk_name] = $WFR;
	db::db_update($wf_table, $update_wf, $wf_cond);
	unset($wf_cond);
	$update_wf[$pk_name] = $WFR;
	$query_step = db::query("SELECT WFS_FIELD_NAME,WFS_OPTION_SHOW_VALUE FROM WF_STEP_FORM WHERE WFS_ID = '".$TARGET."'");
	$BSF_DET = db::fetch_array($query_step);
	$WF = array();
	if($BSF_DET["WFS_OPTION_SHOW_VALUE"] !=""){
	$data = bsf_show_text($W,$update_wf,$BSF_DET["WFS_OPTION_SHOW_VALUE"],$WF_TYPE); 
	}else{
	$data = $WFR;
	}
	$WF[$BSF_DET["WFS_FIELD_NAME"]] = $data;
 
	$data_list = wf_call_relation($TARGET,'',$WF);

echo json_encode($data_list,JSON_NUMERIC_CHECK);
db::db_close();
}
?>