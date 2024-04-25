<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_POST['W']);
$WFR = conText($_POST['WFR']);
$SAVE_STEP = conText($_POST['SAVE_STEP']); //เป็น Y แปลว่าบันทึกชั่วคราว

$WF_REF_URL = conText($_POST['WF_REF_URL']);

if($W != ""){

$sql_main = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql_main);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
$pk_name = $rec_main["WF_FIELD_PK"];
$WF_TYPE = $rec_main["WF_TYPE"];
$update_wf = array();
$wf_cond = array();
 
if($WFR == ""){ //new step
	$sql_detail = db::query("select * from WF_DETAIL where WF_MAIN_ID = '".$W."' AND WFD_TYPE = 'S' ");
	$rec_detail = db::fetch_array($sql_detail);
	
	$insert_wf = array();
	$insert_wf['WFR_TIMESTAMP'] = date2db(date("d/m/").(date("Y")+543));
	$insert_wf['WF_DET_STEP'] = $rec_detail["WFD_ID"];
	$insert_wf['WF_DET_NEXT'] = $rec_detail["WFD_ID"];
	$insert_wf['WFR_UID'] = $_SESSION['WF_USER_ID'];
	$WFR = db::db_insert($wf_table, $insert_wf, $pk_name);
	unset($insert_wf);
	$WFD = $rec_detail["WFD_ID"]; 					//detail ที่จะ save
	$NEXT_STEP = $rec_detail["WFD_DEFAULT_STEP"]; 	//detail ถัดไป (default)
	$FLAG_ADD = "Y";
	
}else{ //process step
	$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WF_NEXT_STEP."' ");
	$rec_detail = db::fetch_array($sql_detail);
	$WFD = $rec_detail["WFD_ID"];
	$NEXT_STEP = $rec_detail["WFD_DEFAULT_STEP"];
	$FLAG_ADD = "N";
}
if($rec_detail["WFD_CONTINUE_NEXT_STEP"] == "Y"){

}else{

	if($WF_REF_URL != ""){
		$d = explode('?',$WF_REF_URL);
		if($d[1]!=""){
		$wf_link = str_replace('&amp;','&',$WF_REF_URL);
		}else{
		$wf_link = "workflow_step.php?W=".$W."&WFR=".$WFR;			
		}
	}else{
	//$wf_link = "workflow.php?W=".$W;
	$wf_link = "workflow_step.php?W=".$W."&WFR=".$WFR;	
	}
	
	
}

	$insert_step = array();
	$insert_step['WFR_ID'] = $WFR;
	$insert_step['WFD_ID'] = $WFD;
	$insert_step['WF_MAIN_ID'] = $W;
	$insert_step['WF_DATE_SAVE'] = date2db(date("d/m/").(date("Y")+543));
	$insert_step['WF_TIME_SAVE'] = date("H:i:s");
	$insert_step['WF_DATE_LOAD'] = date2db(conText($_POST['WF_LOAD_DATE']));
	$insert_step['WF_TIME_LOAD'] = conText($_POST['WF_LOAD_TIME']);
	$insert_step['USR_ID'] = $_SESSION['WF_USER_ID'];
	if($SAVE_STEP ==""){ 
	$insert_step['WF_STEP_STAUS'] = 'Y';
	}else{
	$insert_step['WF_STEP_STAUS'] = 'T';	
	}
	
	$WFD = conText($_POST['WFD']);
	$update_wf = bsf_save_form($W,$WFD,$WFR,$WF_TYPE,$update_wf,'N');
	$wf_cond[$pk_name] = $WFR;
	db::db_update($wf_table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
	
//$wf_link = "workflow_step.php?W=".$W."&WFR=".$WFR;
db::db_close();
redirect($wf_link);
}
?>