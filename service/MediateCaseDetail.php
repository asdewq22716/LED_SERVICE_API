<?php
include '../include/include.php'; 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	set_time_limit(0);
$url = connect_api_mediate('MediateCaseDetailApi.php');
$request['USERNAME'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$request['PASSWORD'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง
$data = curl($url, $request);


if($data['ResponseCode']['ResCode'] == '000') {	

	// $loop = count($data['Data']);
	// for($i=0;$i < $loop;$i++){
	$data2 = $data['Data'];
	foreach($data2 as $k => $v){	
		unset($field);
		$field['CIVIL_CODE'] 		= 	$v['CIVIL_CODE'];
		$field['COURT_CODE'] 		= 	$v['COURT_CODE'];
		$field['COURT_NAME'] 		= 	$v['COURT_NAME'];
		$field['DEPT_CODE'] 		= 	$v['DEPT_CODE'];
		$field['DEPT_NAME'] 		= 	$v['DEPT_NAME'];
		$field['CASE_TYPE_CODE'] 	= 	'';
		$field['CASE_TYPE_NAME'] 	= 	$v['CASE_TYPE_NAME'];
		$field['PREFIX_BLACK_CASE'] = 	$v['PREFIX_BLACK_CASE'];
		$field['BLACK_CASE'] 		= 	$v['BLACK_CASE'];
		$field['BLACK_YY'] 			= 	$v['BLACK_YY'];
		$field['PREFIX_RED_CASE'] 	= 	$v['PREFIX_RED_CASE'];
		$field['RED_CASE'] 			= 	$v['RED_CASE'];
		$field['RED_YY'] 			= 	$v['RED_YY'];
		$field['COURT_DATE'] 		= 	$v['COURT_DATE'];
		$field['CAPITAL_AMOUNT'] 	=  	$v['CAPITAL_AMOUNT'];
		
		$field['REF_MEDIATE_ID'] 		= 	$v['REF_MEDIATE_ID'];
		$field['CHANNEL_ID'] 			= 	$v['CHANNEL_ID'];
		$field['CHANNEL_NAME'] 		    = 	$v['CHANNEL_NAME'];
		$field['TYPE_MEDIATE_ID'] 	    = 	$v['TYPE_MEDIATE_ID'];
		$field['TYPE_MEDIATE_NAME']     = 	$v['TYPE_MEDIATE_NAME'];
		$field['MEDIATE_HANDLE_NAME'] 	= 	$v['MEDIATE_HANDLE_PREFIX'].$v['MEDIATE_HANDLE_FNAME'].'  '.$v['MEDIATE_HANDLE_LNAME'];
		$field['MEDIATE_WFR_REF'] 		= 	$v['MEDIATE_WFR_REF'];
		$field['MEDIATE_RESULT'] 		= 	$v['MEDIATE_RESULT'];
		
		
		$cp = count($v['PLAINTIFF']);
		for($j=1; $j<=$cp; $j++){
			$field['PLAINTIFF'.$j] = $v['PLAINTIFF']['PLAINTIFF'.$j];
		}
		
		$cd = count($v['DEFFENDANT']);
		for($k=1; $k<=$cd; $k++){
			$field['DEFFENDANT'.$k] = $v['DEFFENDANT']['DEFFENDANT'.$k];
		}

		// $field['IMAGE_COURT'] = '';
		// print_pre($field);
		$WH_MEDIATE_ID = db::db_insert('WH_MEDIATE_CASE_DETAIL', $field ,"WH_MEDIATE_ID","WH_MEDIATE_ID");
		
		///------------------ PERSON -----------------///
		$url_ps = connect_api_mediate('MediatePersonApi.php');
		$request_ps['userName'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
		$request_ps['passWord'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง
		$request_ps['wfrId'] = $v['MEDIATE_WFR_REF'];// เปลี่ยนเป็นค่าที่จะส่ง
		$data_ps = curl($url_ps, $request_ps);
			
		if($data_ps['ResponseCode']['ResCode'] == '000') {
		
			$data_ps2 = $data_ps['Data'];
			foreach($data_ps2 as $k_ps => $v_ps){
				
				$sql = "SELECT WH_PERSON_ID FROM WH_MEDIATE_PERSON WHERE REGISTER_CODE ='".$v_ps['REGISTER_CODE']."'";
				$query = db::query($sql);
				$num = db::num_rows($query);
				$res = db::fetch_array($query);
				
				if($num > 0){
					unset($map_ps);
					$map_ps['WH_MEDIATE_ID'] 		= 	$WH_MEDIATE_ID;
					$map_ps['WH_PERSON_ID'] 		= 	$res['WH_PERSON_ID'];
					$map_ps['CONCERN_CODE'] 		= 	$v_ps['PERSON_TYPE'];
					$map_ps['CONCERN_NAME'] 		= 	$v_ps['CONCERN_NAME'];
					
					db::db_insert('WH_MEDIATE_MAP_GEN', $map_ps ,"WH_MD_MAP_GEN_ID","WH_MD_MAP_GEN_ID");
					
					
					$ADDR_SEQ = db::get_max("WH_MEDIATE_PERSON_ADDR", "ADDR_SEQ", $cond = array("WH_PERSON_ID" => $WH_PERSON_ID));
					
					unset($field_add);
					$field_add['WH_PERSON_ID'] 		= 	$WH_PERSON_ID;
					$field_add['ADDRESS'] 			= 	$v_ps['ADDRESS_NO'];
					$field_add['TUM_CODE'] 			= 	$v_ps['TUM_CODE'];
					$field_add['TUM_NAME'] 			= 	$v_ps['TUM_NAME'];
					$field_add['AMP_CODE'] 			= 	$v_ps['AMP_CODE'];
					$field_add['AMP_NAME'] 			= 	$v_ps['AMP_NAME'];
					$field_add['PROV_CODE'] 		= 	$v_ps['PROV_CODE'];
					$field_add['PROV_NAME'] 		= 	$v_ps['PROV_NAME'];
					$field_add['ZIP_CODE'] 			= 	$v_ps['ZIP_CODE'];
					$field_add['REQ'] 				= 	"";
					$field_add['MOO'] 				= 	$v_ps['MOO'];
					$field_add['SOI'] 				= 	$v_ps['SOI'];
					$field_add['ROAD'] 				= 	$v_ps['ROAD'];
					$field_add['ADDR_SEQ'] 			= 	$ADDR_SEQ + 1;
					$field_add['ADDR_FINAL_FLAG'] 	= 	"";

					db::db_insert('WH_MEDIATE_PERSON_ADDR', $field_add ,"WH_PER_ADDR_ID","WH_PER_ADDR_ID");
					
				}else{
					
					unset($field_ps);
					$field_ps['WH_MEDIATE_ID'] 		= 	$WH_MEDIATE_ID;
					// $field_ps['PERSON_CODE'] 		= 	$v['WH_MEDIATE_ID'];
					$field_ps['REGISTER_CODE'] 		= 	$v_ps['REGISTER_CODE'];
					$field_ps['PREFIX_CODE'] 		= 	$v_ps['PREFIX_CODE'];
					$field_ps['PREFIX_NAME'] 		= 	$v_ps['PREFIX_NAME'];
					$field_ps['FIRST_NAME'] 		= 	$v_ps['FIRST_NAME'];
					$field_ps['LAST_NAME'] 			= 	$v_ps['LAST_NAME'];
					$field_ps['CONCERN_CODE'] 		= 	$v_ps['PERSON_TYPE'];
					$field_ps['CONCERN_NAME'] 		= 	$v_ps['CONCERN_NAME'];
					// $field_ps['CONCERN_NO'] 		= 	$v['WH_MEDIATE_ID'];
					
					$WH_PERSON_ID = db::db_insert('WH_MEDIATE_PERSON', $field_ps ,"WH_PERSON_ID","WH_PERSON_ID");
					
					unset($map_ps);
					$map_ps['WH_MEDIATE_ID'] 		= 	$WH_MEDIATE_ID;
					$map_ps['WH_PERSON_ID'] 		= 	$WH_PERSON_ID;
					$map_ps['CONCERN_CODE'] 		= 	$v_ps['PERSON_TYPE'];
					$map_ps['CONCERN_NAME'] 		= 	$v_ps['CONCERN_NAME'];
					
					db::db_insert('WH_MEDIATE_MAP_GEN', $map_ps ,"WH_MD_MAP_GEN_ID","WH_MD_MAP_GEN_ID"); 
					
					unset($field_add);
					$field_add['WH_PERSON_ID'] 		= 	$WH_PERSON_ID;
					$field_add['ADDRESS'] 			= 	$v_ps['ADDRESS_NO'];
					$field_add['TUM_CODE'] 			= 	$v_ps['TUM_CODE'];
					$field_add['TUM_NAME'] 			= 	$v_ps['TUM_NAME'];
					$field_add['AMP_CODE'] 			= 	$v_ps['AMP_CODE'];
					$field_add['AMP_NAME'] 			= 	$v_ps['AMP_NAME'];
					$field_add['PROV_CODE'] 		= 	$v_ps['PROV_CODE'];
					$field_add['PROV_NAME'] 		= 	$v_ps['PROV_NAME'];
					$field_add['ZIP_CODE'] 			= 	$v_ps['ZIP_CODE'];
					$field_add['REQ'] 				= 	"";
					$field_add['MOO'] 				= 	$v_ps['MOO'];
					$field_add['SOI'] 				= 	$v_ps['SOI'];
					$field_add['ROAD'] 				= 	$v_ps['ROAD'];
					$field_add['ADDR_SEQ'] 			= 	"1";
					$field_add['ADDR_FINAL_FLAG'] 	= 	"";

					db::db_insert('WH_MEDIATE_PERSON_ADDR', $field_add ,"WH_PER_ADDR_ID","WH_PER_ADDR_ID");
					
				}
 
			}
			
		}
		
	} 
}
?>