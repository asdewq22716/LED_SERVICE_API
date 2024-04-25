<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
$obj = array();

$registerCode	 = $res['registerCode'];
$prefixBlackCase = $res['prefixBlackCase'];
$blackCase	 	 = $res['blackCase'];
$blackYy		 = $res['blackYy'];
$prefixRedCase	 = $res['prefixRedCase'];
$redCase		 = $res['redCase'];
$redYy			 = $res['redYy'];
$courtName		 = $res['courtName'];

$request = array(
    'userName' 		  => 'BankruptDt',
    'passWord'        => 'Debtor4321',
	'registerCode' 	  => $registerCode,
	'prefixBlackCase' => $prefixBlackCase,
	'blackCase'       => $blackCase,
	'blackYy'         => $blackYy,
	'prefixRedCase'   => $prefixRedCase,
	'redCase' 		  => $redCase,
	'redYy' 		  => $redYy,
	'courtName' 	  => $courtName
);

$url = connect_bankrupt('checkDebtCreditor');
$creditor = curl($url,$request);

foreach($creditor['data']['Data'] as $key => $value){
	
	$temp = array(
		'totalAmount'  => $value['totalAmount'],
		'votingAmount' => $value['votingAmount'],
		'totalBalance' => $value['totalBalance']
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
	// print_pre($row);
echo json_encode($row); 
?>