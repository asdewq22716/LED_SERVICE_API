<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);


$REQUEST_DATA = "";
foreach($res as $key => $val){
	$REQUEST_DATA .= $key."=".$val;
}
$field = array();
$field['IP_ADDRESS'] = $ip ;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'bankruptCourtOrderHis';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '' ;
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1' ;
$field['REQUEST_DATA'] = $REQUEST_DATA;

db::db_insert('M_LOG',$field,'LOG_ID');	

$result = array();
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
  //$obj['courtCode'] = $res['courtCode'];
  $obj['systemType'] = 2;
  
  
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
			
			$BOOK_NO="";	
			$LESSON_NO="";	
			$PAGE_NO="";	
			
			if($value["annBookNo"]!=''){
				$BOOK_NO = "เล่มที่ ".$value["annBookNo"];
			}
			if($value["annLessonNo"]!=''){
				$LESSON_NO = "ตอนที่ ".$value["annLessonNo"];
			}
			if($value["annPageNo"]!=''){
				$PAGE_NO = "หน้าที่ ".$value["annPageNo"];
			}

			$result[$key]['prefixBlackCase'] 	= $value['prefixBlackCase'];
			$result[$key]['blackCase'] 			= $value['blackCase'];
			$result[$key]['blackYy'] 			= $value['blackYy'];
			$result[$key]['prefixRedCase'] 		= $value['prefixRedCase'];
			$result[$key]['redCase'] 			= $value['redCase'];
			$result[$key]['redYy'] 				= $value['redYy'];

			$result[$key]['courtOrder'] 		= $value['CourtDetail'];
			$result[$key]['courtOrderDate'] 	= $value['CourtDate'];

			$result[$key]['orderCode'] 			= $value['orderCode'];
			$result[$key]['courtOrderDesc'] 	= $BOOK_NO." ".$LESSON_NO." ".$PAGE_NO;
			$result[$key]['ACT_FLAG_1'] 		= $BOOK_NO." ".$LESSON_NO." ".$PAGE_NO;
			$result[$key]['orderStatus'] 		= $value['ordStatus'];
			
		} 
 
  
  
  
 /* --------KC backup 20220526----------
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
		$response = curl_exec($curl);
		$resp = json_decode($response, true);
		$resp_data = $resp['data']['Data'];
		// print_pre($resp_data);  
		foreach ($resp_data as $key => $value) {
		  $sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COURT_CODE_REF ='".$value['orderCode']."' OR COT_CODE = '".$value['orderCode']."'");
		  $rec_map_status = db::fetch_array($sql_map_status);
			 
			$BOOK_NO="";	
			$LESSON_NO="";	
			$PAGE_NO="";	
			
			if($value["ANN_BOOK_NO"]!=''){
				$BOOK_NO = "เล่มที่ ".$value["ANN_BOOK_NO"];
			}
			if($value["ANN_LESSON_NO"]!=''){
				$LESSON_NO = "ตอนที่ ".$value["ANN_LESSON_NO"];
			}
			if($value["ANN_PAGE_NO"]!=''){
				$PAGE_NO = "หน้าที่ ".$value["ANN_PAGE_NO"];
			}
			
		  $courtOrderDate = explode(' ',$value['courtOrderDate']);	
		  $result[$key]['prefixBlackCase'] = $value['prefixBlackCase'];
		  $result[$key]['blackCase'] = $value['blackCase'];
		  $result[$key]['blackYy'] = $value['blackYY'];
		  $result[$key]['prefixRedCase'] = $value['prefixRedCase'];
		  $result[$key]['redCase'] = $value['redCase'];
		  $result[$key]['redYy'] = $value['redYY'];
		  $result[$key]['courtOrder'] = $value['annName'];
		  $result[$key]['courtOrderDate'] = $courtOrderDate[0];
		  $result[$key]['orderCode'] = $value['orderCode'];
		  $result[$key]['courtOrderDesc'] = $BOOK_NO." ".$LESSON_NO." ".$PAGE_NO;
		  $result[$key]['ACT_FLAG_1'] = $BOOK_NO." ".$LESSON_NO." ".$PAGE_NO;
		  if($rec_map_status['ACT_FLAG_1'] == 1){
			$result[$key]['orderStatus'] = "บังคับคดี";
		  }
		  if($rec_map_status['ACT_FLAG_1'] == 0){
			$result[$key]['orderStatus'] = "ไม่ถูกบังคับคดี";
		  } 
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
	
	
	$h    = fopen("temp_request/".date('YmdHis').".txt", "w");
	fwrite($h, $str_json);
	fclose($h);
	
	$h    = fopen("temp_response/".date('YmdHis').".txt", "w");
	fwrite($h, json_encode($row));
	fclose($h);
	
	
	// print_pre($row);
	echo json_encode($row);

?>
