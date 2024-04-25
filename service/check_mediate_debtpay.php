<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321'){

  if(!empty($res['courtName'])){
    $qry = db::query("SELECT COURT_CODE_MD FROM M_COURT_CODE_MAP WHERE COURT_NAME_LAW = '".$res['courtName']."'");
    $rec = db::fetch_array($qry);
    $obj['courtCode'] = $rec['COURT_CODE_MD'];
  }

  $obj['userName'] = $res['userName'];
  $obj['passWord'] = $res['passWord'];
  $obj['prefixBlackCase'] = $res['prefixBlackCase'];
  $obj['blackCase'] = $res['blackCase'];
  $obj['blackYy'] = $res['blackYy'];
  $obj['prefixRedCase'] = $res['prefixRedCase'];
  $obj['redCase'] = $res['redCase'];
  $obj['redYy'] = $res['redYy'];


  $data_string = json_encode($obj);
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://103.208.27.224/ega_led_mediate/service/check_Mediate_Debtpay.php',
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
