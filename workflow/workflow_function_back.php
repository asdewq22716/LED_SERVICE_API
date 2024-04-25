<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$arr_id = array();

$W = conText($_POST["W"]);
$WFR = conText($_POST["WFR"]);

$sql_wf = db::query("SELECT WF_MAIN_SHORTNAME FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
$rec_wf = db::fetch_array($sql_wf);

$sql_wfr = db::query("SELECT * FROM ".$rec_wf["WF_MAIN_SHORTNAME"]." WHERE WFR_ID = '".$WFR."' ");
$rec_wfr = db::fetch_array($sql_wfr);

$sql_form = db::query("SELECT WF_STEP.WF_STEP_ID,WF_DETAIL.WFD_ID,WF_DETAIL.WFD_AUTO_SUBMIT,WFD_TYPE FROM WF_STEP INNER JOIN WF_DETAIL ON WF_STEP.WFD_ID = WF_DETAIL.WFD_ID WHERE WF_STEP.WFR_ID = '".$WFR."' AND WF_DETAIL.WF_MAIN_ID = '".$W."' AND WF_STEP_STAUS='Y' ORDER BY WF_STEP.WF_STEP_ID DESC");

while($F=db::fetch_array($sql_form)){
	$last = $F["WF_STEP_ID"];
	$last_det = $F["WFD_ID"];
	if($F["WFD_AUTO_SUBMIT"] == "Y" OR $F["WFD_TYPE"] == 'T'){
		$sql_step_pre = db::query("SELECT WF_STEP_ID,WFD_ID FROM WF_STEP WHERE WF_MAIN_ID='".$W."' AND WF_STEP_STAUS='Y' AND WFR_ID='".$WFR."' AND WFD_NEXT='".$F["WFD_ID"]."' ");
		$s_pre = db::fetch_array($sql_step_pre);
		if($s_pre["WF_STEP_ID"] != ''){
			$a_data_t['WF_STEP_STAUS'] = 'N';
			$a_cond_t['WF_STEP_ID'] = $F["WF_STEP_ID"];

			db::db_update('WF_STEP', $a_data_t, $a_cond_t);
			unset($a_data_t);
			unset($a_cond_t);

		}
	}else{
		
		$last = $F["WF_STEP_ID"];
		$last_det = $F["WFD_ID"];
		break;
	}
}

//Delete Step ที่เป็น Auto Submit
/*foreach($arr_id as $value){
	
	$a_cond['WF_STEP_ID'] = $value;
	db::db_delete('WF_STEP', $a_cond);
	unset($a_cond);
}*/

	$a_data1['WF_STEP_STAUS'] = 'N';
	$a_cond1['WF_STEP_ID'] = $last;

	db::db_update('WF_STEP', $a_data1, $a_cond1);
	unset($a_cond1);
	
	
	$a_data['WF_DET_NEXT'] = $last_det;
	$a_cond['WFR_ID'] = $WFR;

	db::db_update($rec_wf["WF_MAIN_SHORTNAME"], $a_data, $a_cond);
	unset($a_cond);

db::db_close();
//redirect($url_back);
?>