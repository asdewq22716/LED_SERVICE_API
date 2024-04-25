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

curl_setopt($ch, CURLOPT_URL, connect_api_civil('civilCaseDetail'));
curl_setopt($ch, CURLOPT_POST, 1);

$data_string = json_encode($form_field);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($ch);
$data = json_decode($data, true);
// print_pre($data);
 if($data['ResponseCode']['ResCode'] == '000') {	
		
	$loop = count($data['Data']);
	for($i=0;$i < $loop;$i++){
		$Field['PCC_CASE_GEN'] = $data['Data'][$i]['PCC_CASE_GEN'];				
		$Field['SHR_CASE_GEN'] = $data['Data'][$i]['SHR_CASE_GEN'];				
		$Field['CIVIL_CODE'] = $data['Data'][$i]['CivilCode'];				
		$Field['COURT_CODE'] = $data['Data'][$i]['CourtCode'];				
		$Field['COURT_NAME'] = $data['Data'][$i]['CourtName'];				
		$Field['DEPT_CODE'] = $data['Data'][$i]['DeptCode'];				
		$Field['DEPT_NAME'] = $data['Data'][$i]['DeptName'];				
		$Field['CASE_TYPE'] = $data['Data'][$i]['CaseTypeCode'];				
		$Field['CASE_TYPE_NAME'] = $data['Data'][$i]['CaseTypeName'];				
		$Field['CASE_LAWS_CODE'] = $data['Data'][$i]['CaseLawsCode'];	
		$Field['CASE_LAWS_NAME'] = $data['Data'][$i]['CaseLawsName'];				
		$Field['PREFIX_BLACK_CASE'] = $data['Data'][$i]['PrefixBlackCase'];			 	
		$Field['BLACK_CASE'] = $data['Data'][$i]['BlackCase'];				
		$Field['BLACK_YY'] = $data['Data'][$i]['BlackYY'];				
		$Field['PREFIX_RED_CASE'] = $data['Data'][$i]['BlackYY'];	 			
		$Field['RED_CASE'] = $data['Data'][$i]['RedCase'];				
		$Field['RED_YY'] = $data['Data'][$i]['RedYY'];				
		$Field['COURT_DATE'] = date_format($data['Data'][$i]['CourtDate'],"Y/m/d H:i:s");				
		$Field['CAPITAL_AMOUNT'] = $data['Data'][$i]['CapitalAmount'];				
		$Field['PLAINTIFF1'] = $data['Data'][$i]['Plaintiff1'];				
		$Field['PLAINTIFF2'] = $data['Data'][$i]['Plaintiff2'];				
		$Field['PLAINTIFF3'] = $data['Data'][$i]['Plaintiff3'];				
		$Field['DEFFENDANT1'] = $data['Data'][$i]['Deffendant1'];				
		$Field['DEFFENDANT2'] = $data['Data'][$i]['Deffendant2'];				
		$Field['DEFFENDANT3'] = $data['Data'][$i]['Deffendant3'];				
		$Field['IMAGE_COURT'] = $data['Data'][$i]['Image_Court'];	
		
		// db::db_insert("WH_CIVIL_CASE",$Field);
		// db::db_insert('WH_CIVIL_CASE', $Field);
	}		
 } 
 
 ?>