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
						from 		WH_CIVIL_PAYMENT
						where 		1=1 {$filter}
						order by	CONCERN_CODE asc"; 


	$querySelectData = db::query($sqlSelectData);
	while($dataSelectData = db::fetch_array($querySelectData)){
		$obj[$i]['personFullName'] 		= $dataSelectData['PERSON_FULL_NAME'];		
		$obj[$i]['executionStatus'] 	= $dataSelectData['EXECUTION_STATUS'];
		$obj[$i]['capitalAmount'] 		= $dataSelectData['CAPITAL_AMOUNT'];
		$obj[$i]['capitalAmount2'] 		= number_format($dataSelectData['CAPITAL_AMOUNT'],2);
		$obj[$i]['assetAmountRemain'] 	= $dataSelectData['ASSET_AMOUNT_REMAIN'];
		$obj[$i]['assetAmountRemain2'] 	= number_format($dataSelectData['ASSET_AMOUNT_REMAIN'],2);
		$obj[$i]['concernName'] 		= $dataSelectData['CONCERN_NAME'];
		$i++;
	}

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
