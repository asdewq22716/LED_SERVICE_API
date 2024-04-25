<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$W = conText($_POST['W']);
$WFR = conText($_POST['WFR']);
if($W != ""){

$sql_main = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql_main);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
$pk_name = $rec_main["WF_FIELD_PK"];
$WF_TYPE = $rec_main["WF_TYPE"];
$update_wf = array();
$wf_cond = array();
 
if($WFR == ""){ //new step
	$insert_wf = array();
	$WFR = db::db_insert($wf_table, $insert_wf, $pk_name);
	unset($insert_wf);	
	$FLAG_ADD = "Y";
}

$wf_link = "master_main.php?W=".$W;


	$insert_step = array();

	$update_wf = bsf_save_form($W,'0',$WFR,$WF_TYPE,$update_wf,$FLAG_ADD);

	$wf_cond[$pk_name] = $WFR;
	db::db_update($wf_table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
 
db::db_close();
if(conText($_POST['WF_REF_URL']) != ''){
	$wf_link = $_POST['WF_REF_URL'];
}
redirect($wf_link);

}
?>