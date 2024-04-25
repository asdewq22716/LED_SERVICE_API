<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;

$form_field['USERNAME'] 			= 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://103.40.146.180/api/public/Approvement',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 300,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "IDCard":"'.$POST['idCard'].'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$dataJson = json_decode($response,true);

db::db_delete("WH_CALENDAR",array('SYSTEM_ID'=>2,"WH_CALENDAR_USER"=>$POST['idCard']));

if(count($dataJson["data"]["Data"])>0){
	foreach($dataJson["data"]["Data"] as $key => $data){
		
		unset($fields);
			$fields["WH_CALENDAR_START_DATE"] 	= substr($data['APP_DATE'],0,10);
			$fields["WH_CALENDAR_START_TIME"] 	= $data["APP_TIME"];
			$fields["WH_CALENDAR_END_DATE"] 	= substr($data['APP_DATE'],0,10);
			$fields["WH_CALENDAR_END_TIME"] 	= '';
			$fields["WH_CALENDAR_TOPIC"] 		= $data['APT_NAME'];
			$fields["WH_CALENDAR_PLACE"] 		= $data['DEP_NAME'].$data["APP_PLT_DESC"];
			$fields["WH_CALENDAR_DETAIL"] 		= $data['APP_REMARK'];
			$fields["WH_CALENDAR_USER"] 		= $POST['idCard'];
			$fields["WH_MEETING_TYPE"] 			= 5;
			$fields["SYSTEM_ID"] 				= 2;
		$WH_CALENDAR_ID = db::db_insert('WH_CALENDAR',$fields,'WH_CALENDAR_ID','WH_CALENDAR_ID');	
	}
}



$obj = array();

if($POST['idCard']!=""){
	
	$filter = "";
	if($POST["sDate"]!=""){
		$filter .= " and TO_CHAR(WH_CALENDAR_START_DATE,'YYYY-MM-DD') >= '".$POST["sDate"]."'";
	}
	if($POST["eDate"]!=""){
		$filter .= " and TO_CHAR(WH_CALENDAR_START_DATE,'YYYY-MM-DD') <= '".$POST["eDate"]."'";
	}
	
	$sqlSelectData = "	SELECT 		WH_MEETING_TYPE,WH_CALENDAR_START_DATE,WH_CALENDAR_START_TIME,WH_CALENDAR_END_DATE,WH_CALENDAR_END_TIME,WH_CALENDAR_TOPIC,WH_CALENDAR_PLACE,WH_CALENDAR_DETAIL
						FROM 		WH_CALENDAR
						WHERE		WH_CALENDAR_USER = '".$POST['idCard']."' {$filter}"; 


	$querySelectData = db::query($sqlSelectData);
	$i = 1;
	while($dataSelectData = db::fetch_array($querySelectData)){
		if(trim($dataSelectData['WH_CALENDAR_START_DATE'])!=""){		
			$obj[$i]['carlendarSdate'] 			= $dataSelectData['WH_CALENDAR_START_DATE'];
			$obj[$i]['carlendarStime'] 			= $dataSelectData['WH_CALENDAR_START_TIME'];
			$obj[$i]['carlendarEdate'] 			= $dataSelectData['WH_CALENDAR_END_DATE'];
			$obj[$i]['carlendarEtime'] 			= $dataSelectData['WH_CALENDAR_END_TIME'];
			$obj[$i]['carlendarTopic'] 			= $dataSelectData['WH_CALENDAR_TOPIC'];
			$obj[$i]['carlendarPlace'] 			= $dataSelectData['WH_CALENDAR_PLACE'];
			$obj[$i]['carlendarDetail'] 		= $dataSelectData['WH_CALENDAR_DETAIL'];
			$obj[$i]['carlendarMeetType'] 		= $dataSelectData['WH_MEETING_TYPE'];
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
