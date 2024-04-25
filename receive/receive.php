<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include "../include/config.php";
ob_start();
if($_POST['line_message'] != "" AND $_POST['line_user_id'] != "")
{
$sql_usr = db::query("SELECT USR_ID FROM USR_MAIN WHERE USR_LINE_API_KEY = '".$_POST['line_user_id']."' AND USR_STATUS = 'Y' ");
$G = db::fetch_array($sql_usr);

if($G["USR_ID"] != ''){
	$msg = substr($_POST['line_message'],1);
	$code = explode("::",$msg);
	if(trim($code[0]) != ""){
		$sql_main = db::query("select * from WF_MAIN where WF_LINE_CODE = '".strtoupper(trim($code[0]))."'");
		$rec_main = db::fetch_array($sql_main);
		$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
		$pk_name = "WFR_ID";
	 
		$sql_detail = db::query("select * from WF_DETAIL where WF_MAIN_ID = '".$rec_main["WF_MAIN_ID"]."' AND WFD_TYPE = 'S' ");
		$rec_detail = db::fetch_array($sql_detail);
		
		$insert_wf = array();
		$col = explode(',',$rec_main["WF_LINE_COL"]);
		$i=1;
		foreach($col as $val){
			$insert_wf[$val] = trim($code[$i]);
			$i++;
		}
		
		$insert_wf['WFR_TIMESTAMP'] = date2db(date("d/m/").(date("Y")+543));
		$insert_wf['WF_DET_STEP'] = $rec_detail["WFD_ID"];
		$insert_wf['WF_DET_NEXT'] = $rec_detail["WFD_DEFAULT_STEP"];
		$insert_wf['WFR_UID'] = $G["USR_ID"];
		$WFR = db::db_insert($wf_table, $insert_wf, $pk_name);
		unset($insert_wf);
		
			$insert_step = array();
			$insert_step['WFR_ID'] = $WFR;
			$insert_step['WFD_ID'] = $rec_detail["WFD_ID"];
			$insert_step['WF_MAIN_ID'] = $rec_main["WF_MAIN_ID"];
			$insert_step['WF_DATE_SAVE'] = date2db(date("d/m/").(date("Y")+543));
			$insert_step['WF_TIME_SAVE'] = date("H:i:s");
			$insert_step['WF_DATE_LOAD'] = date2db(date("d/m/").(date("Y")+543));
			$insert_step['WF_TIME_LOAD'] = date("H:i:s");
			$insert_step['USR_ID'] = $G["USR_ID"];
			$insert_step['WF_STEP_STAUS'] = 'Y';
			$insert_step['WFD_NEXT'] = $rec_detail["WFD_DEFAULT_STEP"];
			db::db_insert('WF_STEP', $insert_step, 'WF_STEP_ID');
			unset($insert_step);
	}
}
}
db::db_close();

    $file_name = "receive_txt.txt";

    $content = date('H:i:s').": Token-> ".$_POST['line_token']." | User-> ".$_POST['line_user_id']." | Message-> ".$_POST['line_message']."\n";
    $handle = fopen($file_name, 'a');

    fwrite($handle, $content);
    fclose($handle);

	
	
	$save_data=ob_get_contents();
	ob_end_flush();
	$fp = fopen('error.txt', 'w');
	fwrite($fp, $save_data);
	fclose($fp);
?>