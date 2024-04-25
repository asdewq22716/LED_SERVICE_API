<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

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

$sqlSelectDataPer 		= "SELECT ORG_ID,LINE_ID FROM WH_BACKOFFICE_PERSON WHERE REGISTER_CODE = '".$POST["userIdCard"]."' ";
$querySelectDataPer 	= db::query($sqlSelectDataPer);
$recSelectDataPer 		= db::fetch_array($querySelectDataPer);

$sqlSelectStep 			= "SELECT STEP_NO,STEP_NAME FROM M_WORKLOAD_STEP WHERE STER_REF_ID = '".$POST["stepRef"]."' AND STEP_SYSTEM_ID = '".$POST["systemType"]."' ";
$querySelectStep 		= db::query($sqlSelectStep);
$recSelectStep			= db::fetch_array($querySelectStep);

unset($fields);
	$fields["PREFIX_BLACK_CASE"] 	= $POST["prefixBlackCase"];
	$fields["BLACK_CASE"]		 	= $POST["blackCase"];
	$fields["BLACK_YY"] 			= $POST["blackYy"];
	$fields["PREFIX_RED_CASE"] 		= $POST["prefixRedCase"];
	$fields["RED_CASE"] 			= $POST["redCase"];
	$fields["RED_YY"]	 			= $POST["redYy"];
	$fields["USER_IDCARD"] 			= $POST["userIdCard"];
	$fields["USER_NAME"] 			= $POST["userName"];
	$fields["WORK_DATE"] 			= $POST["workDate"];
	$fields["WORK_TIME"] 			= $POST["workTime"];	
	$fields["WORK_STATUS_TEXT"] 	= $recSelectStep["STEP_NAME"];
	$fields["WORK_STATUS_CODE"] 	= $recSelectStep["STEP_NO"];	
	$fields["USER_ORG_ID"] 			= $recSelectDataPer["ORG_ID"];
	$fields["USR_LINE_ID"] 			= $recSelectDataPer["LINE_ID"];
	$fields["PROCESS_SYSTEM_ID"] 	= $POST["processSystemId"];
db::db_insert($tableName,$fields,$PktableName);

?>