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
if($POST["idCard"]!=""){
	$filter .= " and DEFENDANT_IDCARD = '".$POST['idCard']."'	";
}

$sqlSelectRec = "	select 	* 
					from 	WH_RECEIVING_ORDER
					where 	rownum < 1"; 
$arrFieldsRec = db::query_field($sqlSelectRec);

$sqlSelectData = "	select 	* 
					from 	WH_RECEIVING_ORDER
					where 	1=1 {$filter}"; 
$querySelectData = db::query($sqlSelectData);
$dataSelectData = db::fetch_array($querySelectData);
foreach($arrFieldsRec as $key => $val){
	$obj["main"][underToCamel($val)] = $dataSelectData[$val];
}

$sqlSelectRecDet = "	select 	* 
						from 	WH_RECEIVING_ORDER_DETAIL
						where 	rownum < 1"; 
$arrFieldsRecRecDet = db::query_field($sqlSelectRecDet);

$sqlSelectDataDet = "	select 	* 
						from 	WH_RECEIVING_ORDER_DETAIL
						where 	1=1 AND WH_RECEIVING_ORDER_ID = '".$dataSelectData["WH_RECEIVING_ORDER_ID"]."' "; 
$querySelectDataDet = db::query($sqlSelectDataDet);
while($dataSelectDataDet = db::fetch_array($querySelectDataDet)){
	foreach($arrFieldsRecRecDet as $key => $val){
		$obj["detail"][$i][underToCamel($val)] = $dataSelectDataDet[$val];
	}
	$i++;
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
