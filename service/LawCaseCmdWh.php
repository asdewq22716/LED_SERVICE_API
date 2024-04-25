<?php
include '../include/include.php';
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

curl_setopt($ch, CURLOPT_URL, 'http://103.40.146.73/ledservicelaw.php/RehabilitationCmdOffice');
curl_setopt($ch, CURLOPT_POST, 1);

$data_string = json_encode($form_field);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($ch);
$data = json_decode($data, true);

 if($data['ResponseCode']['ResCode'] == '000') {	
		
	$loop = count($data['Data']);
	
	for($i=0 ; $i < $loop ; $i++){
			
			$Field = array();
						
			// $Field['PREFIX_CODE'] = $data['Data'][$i]['CENT_CMD_SYS_GEN'];				
			// $Field['PREFIX_NAME'] = $data['Data'][$i]['CENT_CMD_TYPE_GEN'];				
			// $Field['FIRST_NAME'] = $data['Data'][$i]['CENT_CMD_TYPE_CODE'];				
			// $Field['LAST_NAME'] = $data['Data'][$i]['PCC_CASE_GEN'];				
							
			// $Field['CONCERN_NAME'] = $data['Data'][$i]['PCC_CASE_RECV_GEN'];				
			// $Field['CONCERN_NO'] = $data['Data'][$i]['PCC_DOSS_CONTROL_GEN'];				
			// $Field['ADDRESS'] = $data['Data'][$i]['AUD_PRIVATE_GEN'];			

			// $Field['AMP_CODE'] = $data['Data'][$i]['SHR_CIVIL_PERSON_MAP_GEN'];				
			// $Field['PROV_CODE'] = $data['Data'][$i]['AUD_REQ_GEN'];				 				
			// $Field['TUM_NAME'] = $data['Data'][$i]['SHR_TODOLIST_GEN'];	 			
			// $Field['AMP_NAME'] = $data['Data'][$i]['SHR_E_DOCUMENT_GEN'];										
			// $Field['PROV_NAME'] = $data['Data'][$i]['DOC_MAS_ID'];							
			$Field['DOSS_ID'] = $data['Data'][$i]['CENT_DEPT_GEN'];				
			
			$Field['CIVIL_CODE'] = $data['Data'][$i]['PCC_CIVIL_GEN'];
			$Field['CMD_REF_SYS'] = $data['Data'][$i]['SHR_CMD_OFFICE_GEN'];	
			$Field['PREFIX_BLACK_CASE'] = $data['Data'][$i]['PREFIX_BLACK_CASE'];			
			$Field['BLACK_CASE'] = $data['Data'][$i]['BLACK_CASE'];			
			$Field['BLACK_YY'] = $data['Data'][$i]['BLACK_YY'];			
			$Field['PREFIX_RED_CASE'] = $data['Data'][$i]['PREFIX_RED_CASE'];			
			$Field['RED_CASE'] = $data['Data'][$i]['RED_CASE'];			
			$Field['RED_YY'] = $data['Data'][$i]['RED_YY'];			
			$Field['COURT_CODE'] = $data['Data'][$i]['COURT_CODE'];			
			$Field['CMD_STATUS'] = $data['Data'][$i]['ACTIVE_FLAG'];
			$Field['CMD_SYSTEM'] = $data['Data'][$i]['CENT_CMD_SYS_NAME'];				
			$Field['CMD_TYPE_NAME'] = $data['Data'][$i]['CENT_CMD_TYPE_NAME'];				
			$Field['CMD_TYPE'] = '1';
			$Field['CMD_DETAIL'] = $data['Data'][$i]['REMARK'];
			$Field['CMD_TYPE_CODE'] = $data['Data'][$i]['CENT_CMD_TYPE_CODE'];	
			
			
			
					
			
					
						
echo Json_encode($Field);		 
			// db::db_insert("WH_CIVIL_CASE_CMD_OFFICE",$Field,'CMD_OFFICE_ID','CMD_OFFICE_ID');
	}		 
 } 
 
 ?>