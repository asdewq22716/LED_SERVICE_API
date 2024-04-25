<?php


$obj['userName'] = 'BankruptDt';
  $obj['passWord'] = 'Debtor4321';
  $obj['registerCode'] = '0103537024648';
  $obj['prefixBlackCase'] = 'ล';
  $obj['blackCase'] = '6101';
  $obj['blackYy'] = '2565';
  $obj['prefixRedCase'] = $res['prefixRedCase'];


 $data_string = json_encode($obj);
  $curl = curl_init();
  curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://103.40.146.180/api/public/CourtOrderHis',
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
echo $response = curl_exec($curl);
$resp = json_decode($response, true);
$resp_data = $resp['data']['Data'];

print_r($resp_data);
?>