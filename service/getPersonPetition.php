<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;

$form_field['USERNAME'] 			= 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง

$filter = "";

if($POST["registerCode"]!=""){
	$filter .= " and REGISTER_CODE = '".$POST['registerCode']."'	";
}
if($POST["courtCode"]!=""){
	$filter .= " and SOURCE_COURT_CODE = '".$POST['courtCode']."'	";
}
if($POST["courtName"]!=""){
	$filter .= " and SOURCE_COURT_NAME = '".$POST['courtName']."'	";
}
if($POST["prefixBlackCase"]!=""){
	$filter .= " and SOURCE_PREFIX_BLACK_CASE = '".$POST['prefixBlackCase']."'	";
}
if($POST["blackCase"]!=""){
	$filter .= " and SOURCE_BLACK_CASE = '".$POST['blackCase']."'	";
}
if($POST["blackYy"]!=""){
	$filter .= " and SOURCE_BLACK_YY = '".$POST['blackYy']."'	";
}
if($POST["prefixRedCase"]!=""){
	$filter .= " and SOURCE_PREFIX_RED_CASE = '".$POST['prefixRedCase']."'	";
}
if($POST["redCase"]!=""){
	$filter .= " and SOURCE_RED_CASE = '".$POST['redCase']."'	";
}
if($POST["redYy"]!=""){
	$filter .= " and SOURCE_RED_YY = '".$POST['redYy']."'	";
}

if($filter!=""){
	$sqlSelectData = "	select 	* 
						from 	WH_CIVIL_PETITION
						where 	rownum < 1"; 
	$arrFieldsPetition = db::query_field($sqlSelectData);
	
	$sqlSelectData = "	select 	* 
						from 	WH_CIVIL_PETITION
						where 	1=1 {$filter}"; 
	$querySelectData = db::query($sqlSelectData);
	$i = 1;
	while($dataSelectData = db::fetch_array($querySelectData)){
		foreach($arrFieldsPetition as $key => $val){
			$obj[$i][underToCamel($val)] = $dataSelectData[$val];
		}
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
