<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$request_contents = array();
$urls = array();
$chs = array();
$row = array();
 
 
if(!empty($POST['registerCode'])){
	$RegisterCode = $POST['registerCode'];
}

$request_contents = array(
    'userName' => 'BankruptDt',
    'passWord' => 'Debtor4321',
    'RegisterCode' => $RegisterCode
);
// print_pre($request_contents);
$data_string = json_encode($request_contents);
//set the urls

if(!empty($POST['systemType'])){
	 
	if($POST['systemType']=='1'){
		// $urls['Civil'] = connect_api_civil('CivilCasePerson');
		$urls['Civil'] = connect_api_civil('CivilCheckPerson');
	}
	if($POST['systemType']=='3'){
		$urls['Revive'] = connect_api_revive('DebtRehabilitationAllPerson.php');
	}
	if($POST['systemType']=='4'){
		$urls['Mediate'] = connect_api_mediate('MediatePersonApi.php');
	}
	if($POST['systemType']=='2'){
		$urls['Bankrupt'] = 'http://103.40.146.180/api/public/CheckPerson';
	}
}else{
 
	// $urls['Civil'] = connect_api_civil('CivilCasePerson');
	$urls['Revive'] = connect_api_revive('DebtRehabilitationAllPerson.php');
	$urls['Mediate'] = connect_api_mediate('MediatePersonApi.php');
	$urls['Bankrupt'] = 'http://103.40.146.180/api/public/CheckPerson';
	
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
			
			foreach($data2 as $k2 => $v2){	
				
				foreach($v2 as $k => $v){
					
					if(empty($LAST_CIVIL) || $LAST_CIVIL != $v['CIVIL_CODE']){
						$LAST_CIVIL = $v['CIVIL_CODE'];
						
						
						$case_data['CIVIL_CASE'] = $v['CIVIL_CODE'];
						$case_data['USERNAME'] = "BankruptDt";
						$case_data['PASSWORD'] = "Debtor4321";
						$case_data = json_encode($case_data);
						$curl = curl_init();
						curl_setopt_array($curl, array(
								CURLOPT_URL => 'http://103.40.146.73/ledservicelaw.php/civilCaseDetail',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => '',
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => 'POST',
								CURLOPT_POSTFIELDS =>$case_data,
								CURLOPT_HTTPHEADER => array(
									'Content-Type: application/json'
								),
							)	
						);
						$response2 = curl_exec($curl);
		
						$data_curl = json_decode($response2, true);
						
						curl_close($curl);
						$PrefixBlackCase = $data_curl['Data'][0]['PrefixBlackCase'];
						$BlackCase = $data_curl['Data'][0]['BlackCase'];
						$BlackYY = $data_curl['Data'][0]['BlackYY'];
						$PrefixRedCase = $data_curl['Data'][0]['PrefixRedCase'];
						$RedCase = $data_curl['Data'][0]['RedCase'];
						$RedYY = $data_curl['Data'][0]['RedYY'];
						$CourtName = $data['Data'][0]['CourtName'];		
					}
					
					$ROOM_NO = $v['ROOM_NO']!=''?'ห้อง '.$v['ROOM_NO']:'';
					$MOO = $v['MOO']!=''?'หมู่ '.$v['MOO']:'';
					$SOI = $v['SOI']!=''?'ซอย '.$v['SOI']:'';
					$MAIN_STREET = $v['MAIN_STREET']!=''?'ถนน '.$v['MAIN_STREET']:'';
				
					$fullname = $v['TITLE_NAME'].$v['FIRSTNAME']."  ".$v['LNAME'];
					$address = $v['NAME_HOUSE']." ".$v['HOUSE_NO']." ".$ROOM_NO." ".$MOO." ".$SOI." ".$MAIN_STREET;
					$obj[$i]['systemType'] = 'Civil';
					$obj[$i]['prefixBlackCase'] = $PrefixBlackCase;
					$obj[$i]['blackCase'] = $BlackCase;
					$obj[$i]['blackYY'] = $BlackYY;
					$obj[$i]['prefixRedCase'] = $PrefixRedCase;
					$obj[$i]['redCase'] = $RedCase;
					$obj[$i]['redYY'] = $RedYY;
					$obj[$i]['courtName'] = $CourtName;
					$obj[$i]['registerCode'] = $v['REGISTERCODE'];
					$obj[$i]['preFixName'] = $v['TITLE_NAME'];
					$obj[$i]['firstName'] = $v['FIRSTNAME'];
					$obj[$i]['lastName'] = $v['LNAME'];
					$obj[$i]['fullName'] = $fullname;
					$obj[$i]['conernName'] = $v['CONCERN_NAME'];
					$obj[$i]['address'] = $address;
					$obj[$i]['tumName'] = $v['TUM_NAME'];
					$obj[$i]['ampName'] = $v['AMP_NAME'];
					$obj[$i]['provName'] = $v['PRV_NAME'];
					$obj[$i]['zipCode'] = $v['POSTCODE'];
					$obj[$i]['CIVIL_CODE'] = $v['CIVIL_CODE'];
					$i++;
				}
			}
		
		}else if($key == 'Mediate'){

			$data2 = $data['Data'];
			// print_pre($data2);
			foreach($data2 as $k => $v){	
				
				$fullname = $v['PREFIX_NAME'].$v['FIRST_NAME']."  ".$v['LAST_NAME'];
				
				$obj[$i]['systemType'] = 'Mediate';
				$obj[$i]['prefixBlackCase'] = $v['PREFIX_BLACK_CASE'];
				$obj[$i]['blackCase'] = $v['BLACK_CASE'];
				$obj[$i]['blackYY'] = $v['BLACK_YY'];
				$obj[$i]['prefixRedCase'] = $v['PREFIX_RED_CASE'];
				$obj[$i]['redCase'] = $v['RED_CASE'];
				$obj[$i]['redYY'] = $v['RED_YY'];
				$obj[$i]['courtName'] = $v['COURT_NAME'];
				$obj[$i]['registerCode'] = $v['REGISTER_CODE'];
				$obj[$i]['preFixName'] = $v['PREFIX_NAME'];
				$obj[$i]['firstName'] = $v['FIRST_NAME'];
				$obj[$i]['lastName'] = $v['LAST_NAME'];
				$obj[$i]['fullName'] = $fullname;
				$obj[$i]['conernName'] = $v['CONCERN_NAME'];
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
				
				$fullname = $v['PREFIX_NAME'].$v['FIRST_NAME']."  ".$v['LAST_NAME'];
				
				$obj[$i]['systemType'] = 'Revive';
				$obj[$i]['prefixBlackCase'] = $v['prefixBlackCase'];
				$obj[$i]['blackCase'] = $v['blackCase'];
				$obj[$i]['blackYY'] = $v['blackYY'];
				$obj[$i]['prefixRedCase'] = $v['prefixRedCase'];
				$obj[$i]['redCase'] = $v['redCase'];
				$obj[$i]['redYY'] = $v['redYY']; 
				$obj[$i]['courtName'] = $v['courtName'];
				$obj[$i]['registerCode'] = $v['registerCode'];
				$obj[$i]['preFixName'] = $v['prefixName'];
				$obj[$i]['firstName'] = $v['FIRST_NAME'];
				$obj[$i]['lastName'] = $v['LAST_NAME'];
				$obj[$i]['fullName'] = $v['fullName'];
				$obj[$i]['conernName'] = $v['conernName'];
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
			// print_pre($data);
			$data2 = $data['data']['Data'];
			
			foreach($data2 as $k => $v){	
				
				$fullname = $v['PREFIX_NAME'].$v['FIRST_NAME']."  ".$v['LAST_NAME'];
				
				$obj[$i]['systemType'] = 'Bankrupt';
				$obj[$i]['prefixBlackCase'] = $v['prefixBlackCase'];
				$obj[$i]['blackCase'] = $v['blackCase'];
				$obj[$i]['blackYY'] = $v['blackYY'];
				$obj[$i]['prefixRedCase'] = $v['prefixRedCase'];
				$obj[$i]['redCase'] = $v['redCase'];
				$obj[$i]['redYY'] = $v['redYY'];
				$obj[$i]['courtName'] = $v['courtName'];
				$obj[$i]['registerCode'] = $v['registerCode'];
				$obj[$i]['preFixName'] = $v['PREFIX_NAME'];
				$obj[$i]['firstName'] = $v['FIRST_NAME'];
				$obj[$i]['lastName'] = $v['LAST_NAME'];
				$obj[$i]['fullName'] = $v['fullName'];
				$obj[$i]['conernName'] = $v['conernName'];
				$obj[$i]['conernNo'] = $v['CONCERN_NO'];
				$obj[$i]['address'] = $v['address'];
				$obj[$i]['tumName'] = $v['tumName'];
				$obj[$i]['ampName'] = $v['ampName'];
				$obj[$i]['provName'] = $v['provName'];
				$obj[$i]['zipCode'] = $v['zipCode'];
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
 ?>