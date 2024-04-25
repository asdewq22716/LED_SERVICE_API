<?php
include '../include/include.php';

// print_r($_GET );
if($_GET['cmdId'] != '' ){
 
	$sql = "SELECT
				PERSON_REF_ID,PCC_CASE_GEN
			FROM WH_REHABILITATION_CMD_OFFICE A
			WHERE 1=1 AND CMD_ID = '".$_GET['cmdId']."'
			ORDER BY CMD_ID";
			
	$query = db::query($sql);
	$i = 0;
	while($rec = db::fetch_array($query)){
		
		
		$con = curl_init();
		curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($con, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
		curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($con, CURLOPT_HEADER, 0);
		curl_setopt($con, CURLOPT_TIMEOUT, 120);

		//SERVICE
		$ch = $con; 
		$form_field['USERNAME'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
		$form_field['PASSWORD'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง
		$form_field['SHR_PERSON_MAP_GEN'] = $rec['PERSON_REF_ID'];
		$form_field['PCC_CASE_GEN'] = $rec['PCC_CASE_GEN'];

		curl_setopt($ch, CURLOPT_URL, 'http://103.40.146.73/ledservicelaw.php/RehabilitationCmdOfficeAsset');
		curl_setopt($ch, CURLOPT_POST, 1);

		$data_string = json_encode($form_field);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		$data = curl_exec($ch);
		$data = json_decode($data, true);

	$obj = $data['Data'];
	$i++;
	}

	$num = count($obj);
	
	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
		$row['Data'] = $obj;
			
	}else{
			
		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");	

	}
	
	echo json_encode($row);
	
}
?>
