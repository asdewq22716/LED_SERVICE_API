<?php
include '../include/include.php';
$WF_USER = conText($_GET["WF_USER"]);
$WF_PASS = conText($_GET["WF_PASS"]);
$arr_data = array();
if($WF_USER != '' AND $WF_PASS != ''){
	$sql_wf = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W'");
	$i=1;
	while($rec_wf = db::fetch_array($sql_wf)){
		$sql_group = db::query("SELECT GROUP_NAME FROM WF_GROUP WHERE GROUP_ID = '".$rec_wf["WF_GROUP_ID"]."'");
		$rec_g = db::fetch_array($sql_group);
		
		$arr_data[$i]["WF_MAIN_ID"] = $rec_wf["WF_MAIN_ID"];
		$arr_data[$i]["WF_MAIN_NAME"] = $rec_wf["WF_MAIN_NAME"];
		$arr_data[$i]["WF_GROUP_NAME"] = $rec_g["GROUP_NAME"];
		$arr_data[$i]["WF_TYPE"] = 'W';
		$arr_data[$i]["WF_JOB"] = '';	
		$i++;

	}
	//print_pre($arr_data);
}

echo  json_encode($arr_data, JSON_UNESCAPED_UNICODE);

?>