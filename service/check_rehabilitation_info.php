<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321'){

  $obj['userName'] = $res['userName'];
  $obj['passWord'] = $res['passWord'];
  if($res['blackCase'] != ''){
	  $obj['prefixBlackCase'] = $res['prefixBlackCase'];
	  $obj['blackCase'] = $res['blackCase'];
	  $obj['blackYy'] = $res['blackYy'];
  }
  if($res['redCase'] != ''){
	  $obj['prefixRedCase'] = $res['prefixRedCase'];
	  $obj['redCase'] = $res['redCase'];
	  $obj['redYy'] = $res['redYy'];
  }
  $obj['type'] = $res['type'];
  $obj['registerCode'] = $res['registerCode'];

  $data_string = json_encode($obj);
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://103.208.27.224/led_revive/service/check_rehabilitation_info.php',
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

$obj = $resp['Data'];
}
  // $num = count($obj);
  $num = count($obj);
  if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		// $row['Data'] = $obj;
    $row['Data'] = $obj;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}

	// print_pre($row);
	echo json_encode($row);

?>
