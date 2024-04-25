<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321'){

	$obj['userName'] = $res['userName'];
	$obj['passWord'] = $res['passWord'];
	$obj['registerCode'] = $res['registerCode'];
	$obj['prefixBlackCase'] = $res['prefixBlackCase'];
	$obj['blackCase'] = $res['blackCase'];
	$obj['blackYy'] = $res['blackYy'];
	$obj['prefixRedCase'] = $res['prefixRedCase'];
	$obj['redCase'] = $res['redCase'];
	$obj['redYy'] = $res['redYy'];
	$obj['systemType'] = 3;
	
	
	$data_string = json_encode($obj);
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/getCourtLog.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>$data_string,
		CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json'
		),
		)
	);
	$response = curl_exec($curl);
	$resp = json_decode($response, true);

	foreach ($resp["Data"] as $key => $value) {


	$result[$key]['prefixBlackCase'] 	= $value['prefixBlackCase'];
	$result[$key]['blackCase'] 			= $value['blackCase'];
	$result[$key]['blackYy'] 			= $value['blackYy'];
	$result[$key]['prefixRedCase'] 		= $value['prefixRedCase'];
	$result[$key]['redCase'] 			= $value['redCase'];
	$result[$key]['redYy'] 				= $value['redYy'];

	$result[$key]['courtOrder'] 		= $value['CourtDetail'];
	$result[$key]['courtOrderDate'] 	= $value['CourtDate'];
	$result[$key]['courtDate'] 			= $value['CourtDate'];

	$result[$key]['orderCode'] 			= $value['orderCode'];
	$result[$key]['orderStatus'] 		= $value['ordStatus'];

	} 
	
	
	
	/* --------KC backup 20220526----------
	 
	$data_string = json_encode($obj);
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://103.208.27.224/led_revive/service/checkCourtOrderHistory.php',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS =>$data_string,
	CURLOPT_HTTPHEADER => array(
	'Content-Type: application/json'
	),
	)
	);
	$response = curl_exec($curl);
	$resp = json_decode($response, true);

	$resp_data = $resp['Data'];
	foreach ($resp_data as $key => $value) {
	$sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COURT_CODE_REF ='".$value['orderCode']."'");
	$rec_map_status = db::fetch_array($sql_map_status);
	$result[$key]['date'] = $value['date'];
	$result[$key]['time'] = $value['time'];
	$result[$key]['prefixBlackCase'] = $value['prefixBlackCase'];
	$result[$key]['blackCase'] = $value['blackCase'];
	$result[$key]['blackYy'] = $value['blackYy'];
	$result[$key]['prefixRedCase'] = $value['prefixRedCase'];
	$result[$key]['redCase'] = $value['redCase'];
	$result[$key]['redYy'] = $value['redYy'];
	$result[$key]['courtOrder'] = $value['courtOrder'];
	$result[$key]['courtOrderDate'] = $value['courtOrderDate'];
	$result[$key]['orderCode'] = $value['orderCode'];
	if($rec_map_status['ACT_FLAG_1'] == 1){
	$result[$key]['orderStatus'] = "บังคับคดี";
	}
	if($rec_map_status['ACT_FLAG_1'] == 0){
	$result[$key]['orderStatus'] = "ไม่ถูกบังคับคดี";
	}
	$result[$key]['courtLevel'] = $value['courtLevel'];
	}
	*/
}
  // $num = count($obj);
  $num = count($result);
  if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		// $row['Data'] = $obj;
    $row['Data'] = $result;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}

	// print_pre($row);
	echo json_encode($row);

?>
