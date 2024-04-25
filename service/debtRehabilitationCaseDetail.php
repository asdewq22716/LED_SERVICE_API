<?php
include '../include/include.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$url = connect_api_revive('DebtRehabilitationCaseDetailApi.php');

$form_field['USERNAME'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง
$data = curl($url,$form_field);

if($data['ResponseCode']['ResCode'] == '000') {	

		
	// $loop = count($data['Data']);
	foreach($data['Data'] as $k => $v){
		unset($field);
				// $field['BANKRUPT_CODE'] = $v['BANKRUPT_CODE'];
				$field['COURT_CODE'] = $v['COURT_CODE'];
				$field['COURT_NAME'] = $v['COURT_NAME'];
				$field['DEPT_CODE'] = '902001300000';
				$field['DEPT_NAME'] = 'สำนักฟื้นฟูกิจการของลูกหนี้';

				$field['PREFIX_BLACK_CASE'] = $v['PREFIX_BLACK_CASE'];
				$field['BLACK_CASE'] = $v['BLACK_CASE'];
				$field['BLACK_YY'] = $v['BLACK_YY'];
				$field['PREFIX_RED_CASE'] = $v['PREFIX_RED_CASE'];
				$field['RED_CASE'] = $v['RED_CASE'];

				$field['RED_YY'] = $v['RED_YY'];
				$field['COURT_DATE'] = $v['COURT_DATE'];
				$field['CAPITAL_AMOUNT'] =  $v['CAPITAL_AMOUNT'];
				// $field['PLAINTIFF1'] = $v['PLAINTIFF1'];
				$field['PLAINTIFF2'] = $v['PLAINTIFF2'];
				$field['PLAINTIFF3'] = $v['PLAINTIFF3'];
				
				$field['DEFFENDANT1'] = $v['DEFFENDANT1'];
				$field['DEFFENDANT2'] = $v['DEFFENDANT2'];
				$field['DEFFENDANT3'] = $v['DEFFENDANT3'];
				$field['REGISTER_CODE'] = $v['REGISTER_CODE'];
 
		$WH_REHAB_ID = db::db_insert('WH_REHABILITATION_CASE_DETAIL', $field, "WH_REHAB_ID", "WH_REHAB_ID");
		
		$url_ps = connect_api_revive('DebtRehabilitationAllPerson.php');
		$request_ps['userName'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
		$request_ps['passWord'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง
		$request_ps['wfrId'] = $v['WFR_ID'];// เปลี่ยนเป็นค่าที่จะส่ง 
		$data_ps = curl($url_ps, $request_ps);
		if($data_ps['ResponseCode']['ResCode'] == '000') {
		
			foreach($data_ps['Data'] as $k_ps => $v_ps){
				
					
					unset($field_ps);
					// $field_ps['WH_REHAB_ID'] 		= 	$WH_REHAB_ID;
					$field_ps['REGISTER_CODE'] 		= 	$v_ps['registerCode'];
					$field_ps['PREFIX_CODE'] 		= 	'';
					$field_ps['PREFIX_NAME'] 		= 	$v_ps['prefixName'];
					$field_ps['FIRST_NAME'] 		= 	$v_ps['fullName'];
					$field_ps['LAST_NAME'] 			= 	'';
					$field_ps['PERSON_TYPE'] 		= 	$v_ps['personType'];
					$field_ps['CONCERN_NAME'] 		= 	$v_ps['conernName'];

					$WH_PERSON_ID = db::db_insert('WH_REHABILITATION_PERSON', $field_ps ,"WH_PERSON_ID","WH_PERSON_ID");
					
					unset($map_ps);
					$map_ps['WH_REHAB_ID'] 		= 	$WH_REHAB_ID;
					$map_ps['WH_PERSON_ID'] 		= 	$WH_PERSON_ID;
					$map_ps['PERSON_TYPE'] 		= 	$v_ps['personType'];
					$map_ps['CONCERN_NAME'] 		= 	$v_ps['conernName'];
					$map_ps['CONCERN_NO'] 		= 	$v_ps['concernNo'];
					
					db::db_insert('WH_REHABILITATION_MAP_GEN', $map_ps ,"WH_REB_MAP_GEN_ID","WH_REB_MAP_GEN_ID"); 
					
					unset($field_add);
					$sql = "SELECT * FROM G_TAMBON WHERE TAMBON_NAME LIKE '%".$v_ps['tumName']."%' AND AMPHUR_NAME LIKE '%".$v_ps['ampName']."%' AND PROVINCE_NAME LIKE '%".$v_ps['provName']."%'";
					$query = db::query($sql);
					$res = db::fetch_array($query);
					$field_add['WH_PERSON_ID'] 		= 	$WH_PERSON_ID;
					$field_add['ADDRESS'] 			= 	$v_ps['address'];
					$field_add['TUM_CODE'] 			= 	$res['TAMBON_CODE'];
					$field_add['TUM_NAME'] 			= 	$v_ps['tumName']; 
					$field_add['AMP_CODE'] 			= 	$res['AMPHUR_CODE'];
					$field_add['AMP_NAME'] 			= 	$v_ps['ampName'];
					$field_add['PROV_CODE'] 		= 	$res['PROVINCE_CODE'];
					$field_add['PROV_NAME'] 		= 	$v_ps['provName'];
					$field_add['ZIP_CODE'] 			= 	$v_ps['zipCode'];
					$field_add['REQ'] 				= 	"";
					$field_add['ADDR_SEQ'] 			= 	"1";
					$field_add['ADDR_FINAL_FLAG'] 	= 	"";

					db::db_insert('WH_REHABILITATION_PER_ADDR', $field_add ,"WH_PER_ADDR_ID","WH_PER_ADDR_ID");
					
				
 
			}
			
		}
		 
	}
}


?>
