<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

if($POST["registerCode"]!=""){
	
	$fieldCountNotice 	= "";
	$fieldUrlNotice 	= "";
	$fieldCountWork 	= "";
	$fieldUrlWork 		= "";
	
	
	if($POST["systemType"]==1){
		$fieldCountNotice 	= "COUNT_NOTICE1";
		$fieldUrlNotice 	= "URL_NOTICE1";
		$fieldCountWork 	= "COUNT_WORK1";
		$fieldUrlWork 		= "URL_WORK1";
	}else if($POST["systemType"]==2){
		$fieldCountNotice 	= "COUNT_NOTICE2";
		$fieldUrlNotice 	= "URL_NOTICE2";
		$fieldCountWork 	= "COUNT_WORK2";
		$fieldUrlWork 		= "URL_WORK2";
	}else if($POST["systemType"]==3){
		$fieldCountNotice 	= "COUNT_NOTICE3";
		$fieldUrlNotice 	= "URL_NOTICE3";
		$fieldCountWork 	= "COUNT_WORK3";
		$fieldUrlWork 		= "URL_WORK3";
	}else if($POST["systemType"]==4){
		$fieldCountNotice 	= "COUNT_NOTICE4";
		$fieldUrlNotice 	= "URL_NOTICE4";
		$fieldCountWork 	= "COUNT_WORK4";
		$fieldUrlWork 		= "URL_WORK4";
	}else if($POST["systemType"]==5){
		$fieldCountNotice 	= "COUNT_NOTICE5";
		$fieldUrlNotice 	= "URL_NOTICE5";
		$fieldCountWork 	= "COUNT_WORK5";
		$fieldUrlWork 		= "URL_WORK5";
	}
	
	$sqlSelectAlert 	= "SELECT {$fieldCountNotice},{$fieldUrlNotice},{$fieldCountWork},{$fieldUrlWork} FROM WH_ALERT_DATA WHERE REGISTER_CODE = '".$POST["registerCode"]."' ";
	$querySelectAlert 	= db::query($sqlSelectAlert);
	$dataSelectAlert 	= db::fetch_array($querySelectAlert);
	
	$obj["countNotice"] = $dataSelectAlert[$fieldCountNotice];
	$obj["urlNotice"] 	= $dataSelectAlert[$fieldUrlNotice];
	$obj["urlNotice2"] 	= 'http://103.208.27.224:81/led_service_api/public/show_cmd_disp.php?TO_PERSON_ID='.$POST["registerCode"].'&SEND_TO='.$POST["systemType"].'&cmd_show_type=1';
	$obj["countWork"] 	= $dataSelectAlert[$fieldCountWork];
	$obj["urlWork"] 	= $dataSelectAlert[$fieldUrlWork];
	$obj["urlWork2"] 	= 'http://103.208.27.224:81/led_service_api/public/show_cmd_disp.php?TO_PERSON_ID='.$POST["registerCode"].'&SEND_TO='.$POST["systemType"].'&cmd_show_type=2';
	
}

$num = count($obj);

if($num > 0){
	$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
	$row['Data'] = $obj;
}else{
	$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");	

}

echo json_encode($row); 
?>