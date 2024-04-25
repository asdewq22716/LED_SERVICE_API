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


if($filter!=""){
	$sqlSelectData = "	select 	MEDIATE_NO,MEDIATOR_NAME,MEDIATE_RESULT,PAYMENT_AMOUNT_DEF 
						from 	WH_MEDIATE_CASE_DETAIL
						where 	1=1 {$filter}"; 


	$querySelectData = db::query($sqlSelectData);
	while($dataSelectData = db::fetch_array($querySelectData)){
		$obj[$i]['mediateNo'] 			= $dataSelectData['MEDIATE_NO'];
		$obj[$i]['mediatorname'] 		= $dataSelectData['MEDIATOR_NAME'];
		$obj[$i]['fullName'] 			= $dataSelectData['MEDIATOR_NAME'];
		$obj[$i]['mediateResult'] 		= $dataSelectData['MEDIATE_RESULT'];
		$obj[$i]['paymentAmountDef'] 	= $dataSelectData['PAYMENT_AMOUNT_DEF'];
		$obj[$i]['paymentAmount'] 		= $dataSelectData['PAYMENT_AMOUNT_DEF'];
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
