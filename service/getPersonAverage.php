<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;

$form_field['USERNAME'] 			= 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง


if($POST["prefixBlackCase"]!=""){
	$filter .= " and PREFIX_BLACK_CASE = '".$POST['prefixBlackCase']."'	";
}
if($POST["blackCase"]!=""){
	$filter .= " and BLACK_CASE = '".$POST['blackCase']."'	";
}
if($POST["blackYy"]!=""){
	$filter .= " and BLACK_YY = '".$POST['blackYy']."'	";
}
if($POST["prefixRedCase"]!=""){
	$filter .= " and PREFIX_RED_CASE = '".$POST['prefixRedCase']."'	";
}
if($POST["redCase"]!=""){
	$filter .= " and RED_CASE = '".$POST['redCase']."'	";
}
if($POST["redYy"]!=""){
	$filter .= " and RED_YY = '".$POST['redYy']."'	";
}
if($POST["CourtCode"]!=""){
	$filter .= " and COURT_CODE = '".$POST['CourtCode']."'	";
}
if($POST["registerCode"]!=""){
	$filter .= " and REGISTER_CODE = '".$POST['registerCode']."'	";
}


if($filter!=""){
	$sqlSelectData = "	select 		*
						from 		WH_CIVIL_CASE_PERSON_AVERAGE
						where 		1=1 {$filter}"; 


	$querySelectData = db::query($sqlSelectData);
	$dataSelectData = db::fetch_array($querySelectData);
	$obj['aveCourtCode'] 			= $dataSelectData['AVE_COURT_CODE'];		
	$obj['aveCourtName'] 			= $dataSelectData['AVE_COURT_NAME'];
	$obj['avePrefixBlackCase'] 		= $dataSelectData['AVE_PREFIX_BLACK_CASE'];
	$obj['aveBlackCase'] 			= $dataSelectData['AVE_BLACK_CASE'];
	$obj['aveBlackYy'] 				= $dataSelectData['AVE_BLACK_YY'];
	$obj['avePrefixRedCase'] 		= $dataSelectData['AVE_PREFIX_RED_CASE'];
	$obj['aveRedCase'] 				= $dataSelectData['AVE_RED_CASE'];
	$obj['aveRedYy'] 				= $dataSelectData['AVE_RED_YY'];
	$obj['avePlaintiff'] 			= $dataSelectData['AVE_PLAINTIFF'];
	$obj['aveDefendant'] 			= $dataSelectData['AVE_DEFFENDANT'];

}
$num = count($obj);

	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $obj;
		
		$data = $row;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");
		$data = $row;
	}

echo json_encode($data);

 ?>
