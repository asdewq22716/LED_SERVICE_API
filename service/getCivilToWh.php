<?php
include '../include/include.php';

$str_json 	= file_get_contents("php://input");
$POST 		= json_decode($str_json, true);

$h = fopen("log_file/json_GetCivilTowh" . date('YmdHis'). '.txt', "w");
fwrite($h, json_encode($POST,JSON_UNESCAPED_UNICODE));
fclose($h);

if($_GET["pccCivilGen"]!=""){
	$POST["pccCivilGen"] = $_GET["pccCivilGen"]; 
}
$GET_WH_CIVIL_ID = getCivilToWh($POST["pccCivilGen"],$_GET["show_data"]);

if($GET_WH_CIVIL_ID>0){
	$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS","GET_WHC_CIL"=>$GET_WH_CIVIL_ID);
}else{
	$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");
}

echo json_encode($row);
