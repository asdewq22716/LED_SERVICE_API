<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
$obj = array();

// $prefixBlackCase = 'ล.';
// $blackCase		 = '1212';
// $blackYy		 = '2020';
// $prefixRedCase	 = 'ล.';
// $redCase		 = '1213';
// $redYy			 = '2020'; 
// $courtName		 = 'ศาลล้มละลายกลาง';

$prefixBlackCase = $res['prefixBlackCase'];
$blackCase		 = $res['blackCase'];
$blackYy		 = $res['blackYy'];
$prefixRedCase	 = $res['prefixRedCase'];
$redCase		 = $res['redCase'];
$redYy			 = $res['redYy'];
$courtName		 = $res['courtName'];

$request = array(
    'userName' => 'BankruptDt',
    'passWord' => 'Debtor4321',
	'prefixBlackCase' => $prefixBlackCase,
	'blackCase' => $blackCase,
	'blackYy' => $blackYy,
	'prefixRedCase' => $prefixRedCase,
	'redCase' => $redCase,
	'redYy' => $redYy,
	'personTypeBr' => 06,
);

$url = connect_bankrupt('CheckPerson');
$personDetail = curl($url,$request);

foreach($personDetail['data']['Data'] as $key => $value){
	
	$request = array(
		'userName' => 'BankruptDt',
		'passWord' => 'Debtor4321',
		'prefixBlackCase' => $prefixBlackCase,
		'blackCase' => $blackCase,
		'blackYy' => $blackYy,
		'prefixRedCase' => $prefixRedCase,
		'redCase' => $redCase,
		'redYy' => $redYy,
		'registerCode' => $value['registerCode']
	);
	$url = connect_bankrupt('CourtOrderHis');
	$courtOrder = curl($url,$request);
	
	$temp = array(
		'registerCode' => $value['registerCode'],
		'fullName'	   => $value['fullName'],
		'conernName'   => $value['conernName'],
		'conernSeq'    => $value['conernSeq'],
		'courtOrder'   => "sssss",//$courtOrder['data']['Data'][0]['annName'],
	);
	array_push($obj,$temp);
	
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