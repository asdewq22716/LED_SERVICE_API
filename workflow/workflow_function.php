<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_POST['W']);
$WFR = conText($_POST['WFR']);
$WFD = conText($_POST['WFD']);
$SAVE_STEP = conText($_POST['SAVE_STEP']); //เป็น Y แปลว่าบันทึกชั่วคราว
$WF_NEXT_STEP = conText($_POST['WF_NEXT_STEP']);
$WF_REF_URL = conText($_POST['WF_REF_URL']);
$WF_DET_STEP = conText($_POST['WF_DET_STEP']);
if($W != ""){

$sql_main = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql_main);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
$pk_name = $rec_main["WF_FIELD_PK"];
$WF_TYPE = $rec_main["WF_TYPE"];
$update_wf = array();
$wf_cond = array();
 
if($WFR == ""){ //new step
	if($WFD==""){
	$sql_detail = db::query("select * from WF_DETAIL where WF_MAIN_ID = '".$W."' AND WFD_TYPE = 'S' ");
	}else{
	$sql_detail = db::query("select * from WF_DETAIL where WF_MAIN_ID = '".$W."' AND WFD_ID = '".$WFD."' ");
	}
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
	$WF_DET_STEP = $rec_detail["WFD_ID"]; 
	$FLAG_ADD = "Y";
	if($rec_detail["WFD_AFTER_SAVE"] != ""){
	$WF_REF_URL = $rec_detail["WFD_AFTER_SAVE"];
	}
	
}else{ //process step
	$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WF_NEXT_STEP."' ");
	$rec_detail = db::fetch_array($sql_detail);
	$WFD = $rec_detail["WFD_ID"];
	$NEXT_STEP = $rec_detail["WFD_DEFAULT_STEP"];
	$FLAG_ADD = "N";
	if($rec_detail["WFD_AFTER_SAVE"] != ""){
	$WF_REF_URL = $rec_detail["WFD_AFTER_SAVE"];
	}
}
if($rec_detail["WFD_CONTINUE_NEXT_STEP"] == "Y"){
$wf_link = "workflow_process.php?W=".$W."&WFR=".$WFR;
}else{
	if($WF_REF_URL != ""){
		$d = explode('?',$WF_REF_URL);
		if($d[1]!=""){
		$wf_link = str_replace('&amp;','&',$WF_REF_URL);
		}else{
		$wf_link = "workflow.php?W=".$W;	
		}
	}else{
	$wf_link = "workflow.php?W=".$W;
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

	$update_wf = bsf_save_form($W,$WFD,$WFR,$WF_TYPE,$update_wf,$FLAG_ADD);
	$wf_cond[$pk_name] = $WFR;
	db::db_update($wf_table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
	
if($SAVE_STEP ==""){ //บันทึก next step
	$sql_workflow = "select * from ".$wf_table." where WFR_ID = '".$WFR."' ";
	$query_workflow = db::query($sql_workflow);
	$WF = db::fetch_array($query_workflow);
	$wf_link = bsf_show_field($W,$WF,$wf_link,'W');
$sql_step_c_change = db::query("SELECT COUNT(WFSC_ID) AS C FROM WF_STEP_CON WHERE WFD_ID = '".$WFD."'");
$COUNT = db::fetch_array($sql_step_c_change);
	if($COUNT["C"]>0){
	//หลัง update เรียกขเอมูลมาหา Next Step

	$sql_step_change = db::query("SELECT * FROM WF_STEP_CON WHERE WFD_ID = '".$WFD."' ORDER BY WFSC_ID");
		while($O = db::fetch_array($sql_step_change)){
			$data_compare = bsf_show_text($W,$WF,$O["WFSC_VALUE"]);
			if($O["WFSC_OPERATE"] == "1" OR $O["WFSC_OPERATE"] == ""){ //เท่ากับ
				 if($WF[$O["WFSC_VAR"]] == $data_compare AND array_key_exists($O["WFSC_VAR"], $WF)){  
					$NEXT_STEP = $O["WFSC_STEP"]; 
				}
			}elseif($O["WFSC_OPERATE"] == "2"){ //มากกว่า
				 if($WF[$O["WFSC_VAR"]] > $data_compare AND array_key_exists($O["WFSC_VAR"], $WF)){ 
					$NEXT_STEP = $O["WFSC_STEP"]; 
				}
			}elseif($O["WFSC_OPERATE"] == "3"){ //มากกว่าเท่ากับ
				 if($WF[$O["WFSC_VAR"]] >= $data_compare AND array_key_exists($O["WFSC_VAR"], $WF)){ 
					$NEXT_STEP = $O["WFSC_STEP"]; 
				}
			}elseif($O["WFSC_OPERATE"] == "4"){ //น้อยกว่า
				 if($WF[$O["WFSC_VAR"]] < $data_compare AND array_key_exists($O["WFSC_VAR"], $WF)){ 
					$NEXT_STEP = $O["WFSC_STEP"]; 
				}
			}elseif($O["WFSC_OPERATE"] == "5"){ //น้อยกว่าเท่ากับ
				 if($WF[$O["WFSC_VAR"]] <= $data_compare AND array_key_exists($O["WFSC_VAR"], $WF)){ 
					$NEXT_STEP = $O["WFSC_STEP"]; 
				}
			}elseif($O["WFSC_OPERATE"] == "6"){ //ไม่เท่ากับ
				 if($WF[$O["WFSC_VAR"]] != $data_compare AND array_key_exists($O["WFSC_VAR"], $WF)){ 
					$NEXT_STEP = $O["WFSC_STEP"]; 
				}
			}
		}
	}
	
	$update_wf = array();
	$wf_cond = array();
	$update_wf['WF_DET_STEP'] = $rec_detail["WFD_ID"];
	$update_wf['WF_DET_NEXT'] = $NEXT_STEP;
	$insert_step['WFD_NEXT'] = $NEXT_STEP;
	$wf_cond[$pk_name] = $WFR;
	db::db_update($wf_table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
} 
	db::db_insert('WF_STEP', $insert_step, 'WF_STEP_ID');
	unset($insert_step);
if($SAVE_STEP ==""){
	//if($WF_NEXT_STEP != ''){
		$update_wf = array();
		$wf_cond = array();
		$update_wf['A_STATUS'] = 'N'; 
		$wf_cond['WF_MAIN_ID'] = $W; 
		$wf_cond['WFD_ID'] = $WF_NEXT_STEP;
		$wf_cond['WFR_ID'] = $WFR;
 
		db::db_update("WF_ALERT", $update_wf, $wf_cond);
		//print_r($wf_cond);
		unset($update_wf);
		unset($wf_cond);
	//}
	$sql_step = db::query("SELECT WFD_ALERT_STEP FROM WF_DETAIL WHERE WFD_ID = '".$NEXT_STEP."'");
	$rec_step = db::fetch_array($sql_step);
	$line = 'N';
	if($rec_step["WFD_ALERT_STEP"] == "Y"){
		$line = 'Y';
		/*$f = fopen($WF_URL."workflow/send_line.php?WFR=".$WFR."&W=".$W."&U=".$_SESSION["WF_USER_NAME"],'r');
		fclose($f);*/
	}
	if($FLAG_ADD == "Y"){
		$CSTEP = $WFD;
	}else{
		$CSTEP = $WF_NEXT_STEP;
	}
	bsf_alert($W,$WFR,$NEXT_STEP,$line,'W',$CSTEP);

}
db::db_close();
redirect($wf_link);
}
?>