<?php

$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_POST['W']);
$WG_ID = conText($_POST['WG']);
$WF_TYPE = conText($_POST['WF_TYPE']);
$back_page_old = conText($_POST['back_page_old']); 

$a_data = array();
$a_cond = array();

$url_back = "report_setting.php?W=".$W;
$url_back2 = "report_setting_edit.php?process=add&W=".$W;
 

$table_wfr = $rec['WF_MAIN_SHORTNAME'];
$process = conText($_REQUEST['process']);
$table = "WF_WIDGET";
$pk_name = "WG_ID";
$pk_id = conText($_REQUEST['WG']);

 
$WG_TYPE = conText($_POST['WG_TYPE']); 
$WG_NAME = conText($_POST['WG_NAME']); 
$WG_REPORT_ID = conText($_POST['WG_REPORT_ID']);
$WG_HIDE_HEADER = conText($_POST['WG_HIDE_HEADER']);
$WG_ICON = conText($_POST['WG_ICON']);
$WG_BG = conText($_POST['WG_BG']);
$WG_GRAPH_TYPE = conText($_POST['WG_GRAPH_TYPE']);
$WG_GRAPH_COLOR = conText($_POST['WG_GRAPH_COLOR']);
$WG_CODING_INCLUDE = conText($_POST['WG_CODING_INCLUDE']);
$WG_CODING_AJAX = conText($_POST['WG_CODING_AJAX']);
$WG_PIE_SELECT = conText($_POST['WG_PIE_SELECT']);
$WG_DRILLDOWN = conText($_POST['WG_DRILLDOWN']);
$WG_SUMMARY_COL = conText($_POST['WG_SUMMARY_COL']);
$WG_SUMMARY_FOOTER = conText($_POST['WG_SUMMARY_FOOTER']);
$WG_SUMMARY_TYPE = conText($_POST['WG_SUMMARY_TYPE']);
$WG_GRAPH_STACK = conText($_POST['WG_GRAPH_STACK']);
$WG_GRAPH_OPP = conText($_POST['WG_GRAPH_OPP']);
$WG_GRAPH_DONUT = conText($_POST['WG_GRAPH_DONUT']);

$allM = conText($_POST['allM']);
$WG_MIXED_COL = "";
if($allM > 0){
	for($m=0;$m<=$allM;$m++){
		$WG_MIXED_COL .= conText($_POST['mix'.$m])."|";
	}
}

## Upload Files
if($_FILES["WG_CODING_INCLUDE_FILE"]["size"] > 0)
{
	$file_name = $_FILES["WG_CODING_INCLUDE_FILE"]["name"];
	copy($_FILES["WG_CODING_INCLUDE_FILE"]["tmp_name"], "../dashboard/".strtolower($_FILES["WG_CODING_INCLUDE_FILE"]["name"]));
	@chmod("../form/".strtolower($_FILES["WG_CODING_INCLUDE_FILE"]["name"]),0777);

	$WG_CODING_INCLUDE = $file_name;
}

## array ที่ใช้ร่วมกัน
$a_data['WF_MAIN_ID'] =$W;
$a_data['WG_NAME'] =$WG_NAME;
$a_data['WG_TYPE'] =$WG_TYPE;
$a_data['WG_REPORT_ID'] =$WG_REPORT_ID;
$a_data['WG_HIDE_HEADER'] =$WG_HIDE_HEADER;
$a_data['WG_ICON'] =$WG_ICON;
$a_data['WG_BG'] =$WG_BG;
$a_data['WG_GRAPH_TYPE'] =$WG_GRAPH_TYPE;
$a_data['WG_GRAPH_COLOR'] =$WG_GRAPH_COLOR;
$a_data['WG_CODING_INCLUDE'] =$WG_CODING_INCLUDE;
$a_data['WG_CODING_AJAX'] =$WG_CODING_AJAX;
$a_data['WG_PIE_SELECT'] =$WG_PIE_SELECT;
$a_data['WG_MIXED_COL'] =$WG_MIXED_COL;
$a_data['WG_DRILLDOWN'] =$WG_DRILLDOWN;
$a_data['WG_SUMMARY_COL'] =$WG_SUMMARY_COL;
$a_data['WG_SUMMARY_FOOTER'] =$WG_SUMMARY_FOOTER;
$a_data['WG_SUMMARY_TYPE'] =$WG_SUMMARY_TYPE;
$a_data['WG_GRAPH_STACK'] =$WG_GRAPH_STACK;
$a_data['WG_GRAPH_OPP'] =$WG_GRAPH_OPP;
$a_data['WG_GRAPH_DONUT'] =$WG_GRAPH_DONUT;

if($process == "add")
{
$sql_def = db::query("select WGT_DEFAULT_H ,WGT_DEFAULT_W from WF_WIDGET_TYPE where WGT_ID = '".$WG_TYPE."'   ");
$rec_def = db::fetch_array($sql_def);
$sql_max = db::query_limit("select WG_POS_Y ,WG_POS_H from WF_WIDGET where WF_MAIN_ID = '".$W."'   ORDER BY WG_POS_Y DESC,WG_POS_H DESC",0,1);
$rec_max = db::fetch_array($sql_max);
if($rec_max['WG_POS_Y'] > 0 AND $rec_max['WG_POS_H'] > 0){
	$POS_X = 0;
	$POS_Y = $rec_max['WG_POS_Y']+$rec_max['WG_POS_H'];
	$POS_H = $rec_def['WGT_DEFAULT_H'];
	$POS_W = $rec_def['WGT_DEFAULT_W'];
}else{
	$POS_X = 0;
	$POS_Y = 0;
	$POS_H = $rec_def['WGT_DEFAULT_H'];
	$POS_W = $rec_def['WGT_DEFAULT_W'];
}
 
	$a_data['WG_POS_X'] =$POS_X;
	$a_data['WG_POS_Y'] =$POS_Y;
	$a_data['WG_POS_W'] =$POS_W;
	$a_data['WG_POS_H'] =$POS_H;
	
	$WFG_ID = db::db_insert($table, $a_data, $pk_name, $pk_name);


}elseif($process == "edit"){

	
	$a_cond[$pk_name] = $pk_id;

	db::db_update($table, $a_data, $a_cond);
	$WFG_ID = $pk_id;
}elseif($process == "delete" AND $_GET['WG'] != ""){

	$W = conText($_GET['W']);
	$WG = conText($_GET['WG']);
	if(file_exists("../widget/w".$WG.".tmp")){ unlink("../widget/w".$WG.".tmp"); }
	db::db_delete("WF_WIDGET", array('WG_ID' => $WG));
	echo "Y";
	exit;
}
if($WFG_ID != ""){
//$file = fopen($WF_URL."process/load_widget.php?WG=".$WFG_ID, 'r');
//fclose($file);
}
db::db_close();
if($back_page_old == 'Y'){
	if($process == 'add'){
		$url_back = $url_back2;	
	}else{
		$url_back = $_SERVER["HTTP_REFERER"];
	}
	
}
if($url_back != ""){
redirect($url_back);
}
?>