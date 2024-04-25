<?php

include '../include/include.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$filter = "";
if($POST["registerCode"]!=""){
	
	$sqlSelectData = "	select 		a.CONCERN_NO,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'' as LOCK_PERSON_STATUS,'' as LOCK_PERSON_STATUS_TEXT,PER_ORDER_STATUS
						from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
						where 		1=1 and CONCERN_CODE = '02' 
									and WH_CIVIL_ID in (select 		WH_CIVIL_ID
														from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
														where 		REGISTER_CODE = '".str_replace('-','',$POST["registerCode"])."'
																	and CONCERN_CODE = '01')";
	$querySelectData = db::query($sqlSelectData);
	while($recSelectData = db::fetch_array($querySelectData)){
		$obj[$i]['prefixBlackCase'] 			= $recSelectData['PREFIX_BLACK_CASE'];
		$obj[$i]['blackCase'] 					= $recSelectData['BLACK_CASE'];
		$obj[$i]['blackYy'] 					= $recSelectData['BLACK_YY'];
		$obj[$i]['prefixRedCase'] 				= $recSelectData['PREFIX_RED_CASE'];
		$obj[$i]['redCase'] 					= $recSelectData['RED_CASE'];
		$obj[$i]['redYy'] 						= $recSelectData['RED_YY'];
		$obj[$i]['CourtCode'] 					= $recSelectData['COURT_CODE'];
		$obj[$i]['courtName'] 					= $recSelectData['COURT_NAME'];		
		$obj[$i]['registerCode'] 				= $recSelectData['REGISTER_CODE'];
		$obj[$i]['prefixName'] 					= $recSelectData['PREFIX_NAME'];
		$obj[$i]['firstName'] 					= $recSelectData['FIRST_NAME'];
		$obj[$i]['lastName'] 					= $recSelectData['LAST_NAME'];
		$obj[$i]['fullName'] 					= $recSelectData['PREFIX_NAME'].$recSelectData['FIRST_NAME']." ".$recSelectData['LAST_NAME'];
		$obj[$i]['personType'] 					= $recSelectData['CONCERN_CODE'];
		$obj[$i]['concernName'] 				= $recSelectData['CONCERN_NAME'];
		$obj[$i]['address'] 					= $recSelectData['ADDRESS'];
		$obj[$i]['tumName'] 					= $recSelectData['TUM_NAME'];
		$obj[$i]['ampName'] 					= $recSelectData['AMP_NAME'];
		$obj[$i]['provName'] 					= $recSelectData['PROV_NAME'];
		$obj[$i]['zipCode'] 					= $recSelectData['ZIP_CODE'];
		$obj[$i]['concernNo'] 					= $recSelectData['CONCERN_NO'];
		$obj[$i]['lockPersonStatus'] 			= $recSelectData['LOCK_PERSON_STATUS'];
		$obj[$i]['lockPersonStatusText'] 		= $recSelectData['LOCK_PERSON_STATUS_TEXT'];
		$obj[$i]['orderStatus'] 				= $recSelectData['PER_ORDER_STATUS'];
		$i++;
	}
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