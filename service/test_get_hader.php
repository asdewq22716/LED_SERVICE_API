<?php
function checkauthorizedApi(){
	global $_SERVER,$db;
	$header 	= apache_request_headers();

	$str_json 	= file_get_contents("php://input");
	$POST 		= json_decode($str_json, true);
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
		//query Ip,token
		$sql 	= "";
		$query 	= "";
		$rec 	= "";
	
		if($header["Tokenapi"]=='asndex12456789'){
			$row['responseCode'] 	= array('resCode'=>'000','resMeassage'=>"Success");
			$row['DataPost'] 		= $POST;
		}else{
			$row['responseCode'] 	= array('resCode'=>'401','resMeassage'=>"Unauthorized");	
		}
		
	}else{
		
		$row['responseCode'] = array('resCode'=>'405','resMeassage'=>"Method not allowed. Must be one of: POST, OPTIONS");	
	
	}
	
	return $row;
}


$get_data =  checkauthorizedApi();

if($get_data["responseCode"]["resCode"]=='000'){
	
	//Data ที่ส่งมา ดึงจาก $get_data["DataPost"]
	
	
	
	//Data ที่ส่งกลับ
	$get_data["Data"]			= array(
										"bookId"	=>	1,
										"bookTitle"	=>	'test'
										);
										
	
	//Status ที่ return กลับ
	$get_data['responseCode'] 	= array('resCode'=>'200','resMeassage'=>"Success");	
	unset($get_data["DataPost"]);
										
}

echo json_encode($get_data);

?>