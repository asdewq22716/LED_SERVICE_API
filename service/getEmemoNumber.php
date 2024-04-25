<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$rowNum = $POST["rowNum"];

$obj = array();
for($i=0;$i<$rowNum;$i++){
	$request_contents = array(
								'OrgId' => 49,
								"book_title" => "หนังสือเชิญไกล่เกลี่ย"
							);

	$curl = curl_init();
	$data_string = json_encode($request_contents);

	curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://103.40.146.152/LED_DOC/LED_DOC_FLOW/webservice/get_book_number_out.php',
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
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataReturn = json_decode($response,true);
	
	$obj[$i]["docBookNumber"] = $dataReturn["docBookNumber"];
}


$num = count($obj);
	
	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
		$row['Data'] = $obj;
			
	}else{
			
		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");	

	}
curl_multi_close($mh);

echo json_encode($row); 
?>