<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$POST['proc'] = '';
if($POST['proc']=='active' ||$POST['proc']==''){
	
	$sql = "SELECT
				PER_IDCARD
			FROM
				WH_BACK_OFFICE_USER
			WHERE
				ACTIVE_STATUS = '1'
				--AND PER_IDCARD = '1101500478188'
			--AND (
				
			--	PER_IDCARD = '3341500075746'
			--	OR PER_IDCARD = '3800500118342'
			--	OR PER_IDCARD = '1670200167122'
			--	OR PER_IDCARD = '3102000266774'
			--	OR PER_IDCARD = '3730300643932'
			--  OR PER_IDCARD IS NOT NULL
			--)
			--AND ROWNUM <= 150
			ORDER BY
			--CASE
			--WHEN PER_IDCARD = '3341500075746' THEN
			--	0
			--WHEN PER_IDCARD = '3800500118342' THEN
			--	0
			--WHEN PER_IDCARD = '1670200167122' THEN
			--	0
			--WHEN PER_IDCARD = '3102000266774' THEN
			--	0
			--WHEN PER_IDCARD = '3730300643932' THEN
			--	0
			--WHEN PER_IDCARD = '0103537024648' THEN
			--	0
			--ELSE
			--	1
			--END,
			 PER_FIRST_NAME_TH,
			 PER_LAST_NAME_TH ASC";
	
	$query = db::query($sql);
	$array_idcard = array(); 
	while($rec = db::fetch_array($query)){	
		array_push($array_idcard,$rec['PER_IDCARD']);
	}

	$request_contents = array();
	$urls = array();
	$chs = array();
	$row = array();
	$RegisterCode = $array_idcard; 

	$request_contents = array(
		'userName' => 'BankruptDt',
		'passWord' => 'Debtor4321',
		'RegisterCode' => $RegisterCode,
		'personType' => '02'
	);

	$data_string = json_encode($request_contents);

	if(!empty($POST['systemType'])){
		
		if($POST['systemType']=='1'){
			$urls['Civil'] = connect_api_civil('CivilCheckPersonWh');
		}
		if($POST['systemType']=='3'){
			$urls['Revive'] = connect_api_revive('DebtRehabilitationAllPersonWh.php');
		}
		if($POST['systemType']=='4'){
			$urls['Mediate'] = connect_api_mediate('MediatePersonApiWh.php');
		}
		if($POST['systemType']=='2'){
			$urls['Bankrupt'] = 'http://103.40.146.180/api/public/CheckPersonWh';
		}
	}else{
	 
		// $urls['Civil'] = connect_api_civil('CivilCasePerson');
		$urls['Civil'] = connect_api_civil('CivilCheckPersonWh');
		$urls['Revive'] = connect_api_revive('DebtRehabilitationAllPersonWh.php');
		$urls['Mediate'] = connect_api_mediate('MediatePersonApiWh.php');
		$urls['Bankrupt'] = 'http://103.40.146.180/api/public/CheckPersonWh';
		
	}


	// $urls['Bankrupt'] = 'http://10.1.10.80/api/public/CheckPerson';

	//create the array of cURL handles and add to a multi_curl
	$mh = curl_multi_init();
	foreach ($urls as $key => $url) {
		$chs[$key] = curl_init($url);
		curl_setopt($chs[$key], CURLOPT_RETURNTRANSFER, true);
		curl_setopt($chs[$key], CURLOPT_POST, true);
		curl_setopt($chs[$key], CURLOPT_POSTFIELDS, $data_string);

		curl_multi_add_handle($mh, $chs[$key]);
	}
	$running = null;
	do {
	  curl_multi_exec($mh, $running);
	} while ($running);

	//getting the responses
	$i = 0;
	foreach(array_keys($chs) as $key){
		// print_pre($key);
		$error = curl_error($chs[$key]);
		$last_effective_URL = curl_getinfo($chs[$key], CURLINFO_EFFECTIVE_URL);
		$time = curl_getinfo($chs[$key], CURLINFO_TOTAL_TIME);
		$response = curl_multi_getcontent($chs[$key]);  // get results
		
		$data = json_decode($response, true);

		
		if($data['ResponseCode']['ResCode'] == '000' || $data['statusCode'] == '200'){
			
			if($key == 'Civil'){

				$data2 = $data['Data'];

				// foreach($data2 as $k2 => $v2){	
					
					foreach($data2 as $k => $v){
						
						if($v['PERSON_TYPE'] != 'null'){
							$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_LAW = '".$v['PERSON_TYPE']."'";
							$qry = db::query($sql);
							$res = db::fetch_array($qry);
						}

						$ROOM_NO = $v['ROOM_NO']!=''?'ห้อง '.$v['ROOM_NO']:'';
						$MOO = $v['MOO']!=''?'หมู่ '.$v['MOO']:''; 
						$SOI = $v['SOI']!=''?'ซอย '.$v['SOI']:'';
						$MAIN_STREET = $v['MAIN_STREET']!=''?'ถนน '.$v['MAIN_STREET']:'';
					
						$fullname = $v['TITLE_NAME'].$v['FIRSTNAME']."  ".$v['LNAME'];
						$address = $v['NAME_HOUSE']." ".$v['HOUSE_NO']." ".$ROOM_NO." ".$MOO." ".$SOI." ".$MAIN_STREET;
						$obj[$i]['systemType'] = 'Civil';
						$obj[$i]['prefixBlackCase'] = $v['PREFIX_BLACK_CASE'];
						$obj[$i]['blackCase'] = $v['BLACK_CASE'];
						$obj[$i]['blackYy'] =  $v['BLACK_YY'];
						$obj[$i]['prefixRedCase'] = $v['PREFIX_RED_CASE'];
						$obj[$i]['redCase'] = $v['RED_CASE'];
						$obj[$i]['redYy'] = $v['RED_YY'];
						$obj[$i]['courtName'] = $v['COURT_NAME'];
						$obj[$i]['registerCode'] = $v['REGISTERCODE'];
						$obj[$i]['prefixName'] = $v['TITLE_NAME'];
						$obj[$i]['firstName'] = $v['FIRSTNAME'];
						$obj[$i]['lastName'] = $v['LNAME'];
						$obj[$i]['fullName'] = $v['PERSON_FULL_NAME'];
						$obj[$i]['personType'] = $res['PERSON_MAP_CODE'];
						$obj[$i]['concernName'] = $v['CONCERN'];
						$obj[$i]['address'] =  $v['ADDR'];
						$obj[$i]['tumName'] = $v['TUM_NAME'];
						$obj[$i]['ampName'] = $v['AMP_NAME'];
						$obj[$i]['provName'] = $v['PRV_NAME'];
						$obj[$i]['zipCode'] = $v['POSTCODE'];
						
						if($v['STATUS_CODE']==1){
							$obj[$i]['orderStatus'] = "บังคับคดี";
						}else{
							$obj[$i]['orderStatus'] = "ไม่ถูกบังคับคดี";
						}
						
						// $obj[$i]['CIVIL_CODE'] = $v['CIVIL_CODE'];
						$i++;
					} 
				// }

			}else if($key == 'Mediate'){

				$data2 = $data['Data'];
				// print_pre($data2);
				foreach($data2 as $k => $v){
					
					$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_MD = '".$v['PERSON_TYPE']."'";
					$qry = db::query($sql);
					$res = db::fetch_array($qry);
					
					$fullname = $v['PREFIX_NAME'].$v['FIRST_NAME']."  ".$v['LAST_NAME'];
					
					$obj[$i]['systemType'] = 'Mediate';
					$obj[$i]['prefixBlackCase'] = $v['PREFIX_BLACK_CASE'];
					$obj[$i]['blackCase'] = $v['BLACK_CASE'];
					$obj[$i]['blackYy'] = $v['BLACK_YY'];
					$obj[$i]['prefixRedCase'] = $v['PREFIX_RED_CASE'];
					$obj[$i]['redCase'] = $v['RED_CASE'];
					$obj[$i]['redYy'] = $v['RED_YY'];
					$obj[$i]['courtName'] = $v['COURT_NAME'];
					$obj[$i]['registerCode'] = $v['REGISTER_CODE'];
					$obj[$i]['prefixName'] = $v['PREFIX_NAME'];
					$obj[$i]['firstName'] = $v['FIRST_NAME'];
					$obj[$i]['lastName'] = $v['LAST_NAME'];
					$obj[$i]['fullName'] = $fullname;
					$obj[$i]['personType'] = $res['PERSON_MAP_CODE'];
					$obj[$i]['concernName'] = $v['CONCERN_NAME'];
					$obj[$i]['address'] = $v['ADDRESS'];
					$obj[$i]['tumName'] = $v['TUM_NAME'];
					$obj[$i]['ampName'] = $v['AMP_NAME'];
					$obj[$i]['provName'] = $v['PROV_NAME'];
					$obj[$i]['zipCode'] = $v['ZIP_CODE'];
					$i++;
				}
			}
			else if($key == 'Revive'){
				
				$data2 = $data['Data'];
				// print_pre($data2);
				foreach($data2 as $k => $v){	
					
					// if($v['conernName'] =='ลูกหนี้'){
						// $obj[$i]['personType'] = '1';
					// }
					$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_RV = '".$v['personType']."'";
					$qry = db::query($sql);
					$res = db::fetch_array($qry);
					
					
					$fullname = $v['PREFIX_NAME'].$v['FIRST_NAME']."  ".$v['LAST_NAME'];
					
					$obj[$i]['systemType'] = 'Revive';
					$obj[$i]['prefixBlackCase'] = $v['prefixBlackCase'];
					$obj[$i]['blackCase'] = $v['blackCase'];
					$obj[$i]['blackYy'] = $v['blackYY'];
					$obj[$i]['prefixRedCase'] = $v['prefixRedCase'];
					$obj[$i]['redCase'] = $v['redCase'];
					$obj[$i]['redYy'] = $v['redYY']; 
					$obj[$i]['courtName'] = $v['courtName'];
					$obj[$i]['registerCode'] = $v['registerCode'];
					$obj[$i]['prefixName'] = $v['prefixName'];
					$obj[$i]['firstName'] = $v['FIRST_NAME'];
					$obj[$i]['lastName'] = $v['LAST_NAME'];
					$obj[$i]['fullName'] = $v['fullName'];
					$obj[$i]['personType'] = $res['PERSON_MAP_CODE'];
					$obj[$i]['personType222'] = $v['personType'];
					$obj[$i]['concernName'] = $v['conernName'];
					$obj[$i]['conernNo'] = $v['CONCERN_NO'];
					$obj[$i]['address'] = $v['address'];
					$obj[$i]['tumName'] = $v['tumName'];
					$obj[$i]['ampName'] = $v['ampName'];
					$obj[$i]['provName'] = $v['provName'];
					$obj[$i]['zipCode'] = $v['zipCode'];
					$i++;
				}
			}
			else if($key == 'Bankrupt'){
				
				$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_BR = '".$v['personType']."'";
				$qry = db::query($sql);
				$res = db::fetch_array($qry);
				
				$sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COURT_CODE_REF ='".$v['courtCode']."'");
				$rec_map_status = db::fetch_array($sql_map_status);	
					
				$data2 = $data['data']['Data'];
				
				foreach($data2 as $k => $v){	
				
					
					$fullname = $v['PREFIX_NAME'].$v['FIRST_NAME']."  ".$v['LAST_NAME'];
					
					$obj[$i]['systemType'] = 'Bankrupt';
					$obj[$i]['prefixBlackCase'] = $v['prefixBlackCase'];
					$obj[$i]['blackCase'] = $v['blackCase'];
					$obj[$i]['blackYy'] = $v['blackYY'];
					$obj[$i]['prefixRedCase'] = $v['prefixRedCase'];
					$obj[$i]['redCase'] = $v['redCase'];
					$obj[$i]['redYy'] = $v['redYY'];
					$obj[$i]['courtName'] = $v['courtName'];
					$obj[$i]['registerCode'] = $v['registerCode'];
					$obj[$i]['prefixName'] = $v['PREFIX_NAME'];
					$obj[$i]['firstName'] = $v['FIRST_NAME'];
					$obj[$i]['lastName'] = $v['LAST_NAME'];
					$obj[$i]['fullName'] = $v['fullName'];
					$obj[$i]['personType'] = $res['PERSON_MAP_CODE'];
					$obj[$i]['concernName'] = $v['conernName'];
					$obj[$i]['conernNo'] = $v['CONCERN_NO'];
					$obj[$i]['address'] = $v['address'];
					$obj[$i]['tumName'] = $v['tumName'];
					$obj[$i]['ampName'] = $v['ampName'];
					$obj[$i]['provName'] = $v['provName'];
					$obj[$i]['zipCode'] = $v['zipCode'];
					
					// if($rec_map_status['ACT_FLAG_1'] == 1){
						// $obj[$i]['orderStatus'] = "บังคับคดี";
						// $obj[$i]['orderCode'] = "1";
					  // }
					  // if($rec_map_status['ACT_FLAG_1'] == 0){
						// $obj[$i]['orderStatus'] = "ไม่ถูกบังคับคดี";
						// $obj[$i]['orderCode'] = "0";
					  // }
					$i++;
				}
			}
		}
		
		
		curl_multi_remove_handle($mh, $chs[$key]);
	}

	$num = count($obj);
		
		if($num > 0){

			$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
			$row['Data'] = $obj;
				
		}else{
				
			$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");	

		}
	// close current handler
	curl_multi_close($mh);

	echo json_encode($row); 
}
 ?>