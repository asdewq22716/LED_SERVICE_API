<?php
$_GET["show__query"] = 'Y';

include '../include/include.php';



$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

// $h = fopen("log_file/json_" . $POST["systemType"].'-' .$POST["processSystemId"].'-'.date('Ymdhis'). '.txt', "w");
// fwrite($h, json_encode($POST,JSON_UNESCAPED_UNICODE));
// fclose($h);

$tableName = "";
$PktableName = "";

if($POST["systemType"]=='4'){
	$tableName = "WH_MEDIATE_WORKLOAD";
	$PktableName = "WH_MEDIATE_WORKLOAD_ID";
}else if($POST["systemType"]=='2'){
	$tableName = "WH_BANKRUPT_WORKLOAD";
	$PktableName = "WH_BANKRUPT_WORKLOAD_ID";
}else if($POST["systemType"]=='3'){
	$tableName = "WH_REHABILITATION_WORKLOAD";
	$PktableName = "WH_REHABILITATION_WORKLOAD_ID";
}else if($POST["systemType"]=='1'){
	$tableName = "WH_CIVIL_WORKLOAD";
	$PktableName = "WH_CIVIL_WORKLOAD_ID";
}

$sqlSelectStep 			= "	SELECT 	STEP_NO 
							FROM 	M_WORKLOAD_STEP 
							WHERE 	STER_REF_ID = '".$POST["stepRef"]."' 
									AND STEP_SYSTEM_ID = '".$POST["systemType"]."' ";
$querySelectStep 		= db::query($sqlSelectStep);
$recSelectStep			= db::fetch_array($querySelectStep);

unset($fields);
	$fields["WORK_DATE_END"] 	= $POST["workDateEnd"];
	$fields["WORK_TIME_END"] 	= $POST["workTimeEnd"];	
db::db_update($tableName, $fields, array("PROCESS_SYSTEM_ID"=>$POST["processSystemId"],"WORK_STATUS_CODE"=>$recSelectStep["STEP_NO"]));


?>
