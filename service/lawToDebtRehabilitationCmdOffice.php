<?php
include '../include/include.php';

// $url = connect_api_revive('DebtRehabilitationCmdOfficeApi.php');

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
print_pre($data);
if($data['ResponseCode']['ResCode'] == '000') {	

		
	$loop = count($data['Data']);
	for($i=0;$i < $loop;$i++){
		
		if( $data['Data'][$i]['CENT_CMD_SYS_NAME'] == 'ระบบงานฟื้นฟูกิจการของลูกหนี้'){
			
			$court = db::query("SELECT * FROM M_COURT_CODE_MAP WHERE COURT_CODE_LAW = '".$data['Data'][$i]['COURT_CODE']."'");
			$data_court = db::fetch_array($court);
			
			$dep = db::query("SELECT * FROM M_DEPARTMENT_MAPP WHERE DEPT_CODE_LAW = '".$data['Data'][$i]['USER_DEPT_CODE']."'");
			$data_dep = db::fetch_array($dep);
			
			$civil =  db::query("SELECT PLAINTIFF1,PLAINTIFF2,PLAINTIFF3,DEFFENDANT1,DEFFENDANT2,DEFFENDANT3 FROM WH_CIVIL_CASE WHERE CIVIL_CODE = '". $data['Data'][$i]['PCC_CIVIL_GEN']."'");
			$data_civil = db::fetch_array($dep);
		// $data['Data'][$i]['CENT_CMD_SYS_NAME']
			unset($field);
			$field['CIVIL_CODE'] = $data['Data'][$i]['PCC_CIVIL_GEN'];
			$field['COURT_CODE'] = $data_court['COURT_CODE_LAW'];
			$field['COURT_NAME'] = $data_court['COURT_NAME_LAW'];
			$field['DEPT_CODE'] = $data_dep['DEPT_CODE_BR'];
			$field['DEPT_NAME'] = $data_dep['DEPT_NAME_LAW'];
			$field['PREFIX_BLACK_CASE'] = $data['Data'][$i]['PREFIX_BLACK_CASE'];
			$field['BLACK_CASE'] = $data['Data'][$i]['BLACK_CASE'];
			$field['BLACK_YY'] = $data['Data'][$i]['BLACK_YY'];
			$field['PREFIX_RED_CASE'] = $data['Data'][$i]['PREFIX_RED_CASE'];
			$field['RED_CASE'] = $data['Data'][$i]['RED_CASE'];
			$field['RED_YY'] = $data['Data'][$i]['RED_YY'];
			$field['CMD_DATE'] = date('Y-m-d');
			$field['OFFICE_IDCARD'] = $data['Data'][$i]['PERSON_CODE'];
			// $field['OFFICE_NAME'] = $obj[$i]['OFFICE_NAME'];
			$field['CMD_TYPE_CODE'] = $data['Data'][$i]['CENT_CMD_TYPE_CODE'];
			$field['CMD_TYPE_NAME'] = $data['Data'][$i]['CENT_CMD_TYPE_NAME'];
			$field['CMD_DETAIL'] = $data['Data'][$i]['CENT_CMD_TYPE_NAME'];		
			$field['CMD_SYSTEM'] = 'ระบบงานแพ่ง';		
			$field['CMD_STATUS'] = 1;		
			$field['DEFFENDANT1'] = $data_civil['DEFFENDANT1'];		
			$field['DEFFENDANT2'] = $data_civil['DEFFENDANT2'];	
			$field['DEFFENDANT3'] = $data_civil['DEFFENDANT3'];		
			$field['PLAINTIFF1'] = $data_civil['PLAINTIFF1'];		
			$field['PLAINTIFF2'] = $data_civil['PLAINTIFF2'];		
			$field['PLAINTIFF3'] = $data_civil['PLAINTIFF3'];		
			$field['PERSON_REF_ID'] = $data['Data'][$i]['SHR_PERSON_MAP_GEN'];		
			$field['PCC_CASE_GEN'] = $data['Data'][$i]['PCC_CASE_GEN'];		

			db::db_insert('WH_REHABILITATION_CMD_OFFICE', $field,"CMD_ID");
		}
		 
	}

}

?>