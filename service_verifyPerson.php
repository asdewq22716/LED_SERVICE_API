<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

if($POST['ip']){
	$ip = $POST['ip'];
}
// if($POST['ip']){
	// $ip = $POST['ip'];
// }else{
	// $ip = get_client_ip();
// }

$REQUEST_DATA = "";
foreach($POST as $key => $val){
	$REQUEST_DATA .= $key."=".$val;
}
$field = array();
$field['IP_ADDRESS'] = $ip ;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'verifyPerson';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '' ;
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1' ;
$field['REQUEST_DATA'] = $str_json;

//db::db_insert('M_LOG',$field,'LOG_ID');	

$request_contents = array();
$urls = array(); 
$chs = array();
$row = array();
 

if(!empty($POST['registerCode'])){
	$RegisterCode = $POST['registerCode'];
	$RegisterCode2 = $POST['registerCode2'];

	if(!empty($POST['companyCode'])){
		$companyCode = $POST['companyCode'];
	}
	if(!empty($POST['prefixBlackCase'])){ 
		$prefixBlackCase = $POST['prefixBlackCase'];
	}
	if(!empty($POST['blackCase'])){
		$blackCase = $POST['blackCase'];
	}
	if(!empty($POST['blackYy'])){
		$blackYy = $POST['blackYy'];
	}
	if(!empty($POST['prefixRedCase'])){
		$prefixRedCase = $POST['prefixRedCase'];
	}
	if(!empty($POST['redCase'])){
		$redCase = $POST['redCase'];
	}
	if(!empty($POST['redYy'])){
		$redYy = $POST['redYy'];
	}

	$request_contents = array(
		'userName' => 'BankruptDt',
		'passWord' => 'Debtor4321',
		'registerCode' => $RegisterCode,
		'registerCode2' => $RegisterCode2,
		'companyCode'=> $companyCode,
		'prefixBlackCase' => $prefixBlackCase,
		'blackCase' => $blackCase,
		'blackYy' => $blackYy,
		'prefixRedCase' => $prefixRedCase,
		'redCase' => $redCase,
		'redYy' => $redYy,
		'getSystemType' => $POST['systemType'],
		'systemType' => $POST['systemType'],
		'fromSystemType' => $POST['fromSystemType'],
		'fromService' => 'verifyPerson',
	);//'getSystemType' => $POST['systemType'],
	if($POST['systemType']!=""){
		$request_contents["systemType"] = 2;
	}
//set the urls


	$curl = curl_init();
	$data_string = json_encode($request_contents);

	curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/GetPersonCaseList.php',
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
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataReturn = json_decode($response,true);
	
	$obj = array();
	if($dataReturn['ResponseCode']['ResCode'] == '000'){
		foreach($dataReturn['Data'] as $key => $data){
			foreach($data as $no => $v){			
				if($POST['systemType']!=""){
					
					if($POST['systemType']==1 && $key=='Civil'){
						$obj_temp['systemType'] 		= $key;
						$obj_temp['prefixBlackCase'] 	= $v['prefixBlackCase'];
						$obj_temp['blackCase'] 			= $v['blackCase'];
						$obj_temp['blackYy'] 			= $v['blackYy'];
						$obj_temp['prefixRedCase'] 		= $v['prefixRedCase'];
						$obj_temp['redCase'] 			= $v['redCase'];
						$obj_temp['redYy'] 				= $v['redYy'];
						$obj_temp['courtCode'] 			= $v['CourtCode'];
						$obj_temp['courtName'] 			= $v['courtName'];
						$obj_temp['cardType'] 			= $v['cardType'];
						$obj_temp['registerCode'] 		= $v['registerCode'];
						$obj_temp['prefixName'] 		= $v['prefixName'];
						$obj_temp['firstName'] 			= $v['firstName'];
						$obj_temp['lastName'] 			= $v['lastName'];
						$obj_temp['fullName'] 			= $v['fullName'];
						$obj_temp['personType'] 		= $v['personType'];
						$obj_temp['concernName'] 		= $v['concernName'];
						$obj_temp['address'] 			= $v['address'];
						$obj_temp['tumName'] 			= $v['tumName'];
						$obj_temp['ampName'] 			= $v['ampName'];
						$obj_temp['provName'] 			= $v['provName'];
						$obj_temp['zipCode'] 			= $v['zipCode'];
						$obj_temp['orderStatus'] 		= $v['orderStatus'];
						$obj_temp['excutionStatus'] 	= $v['orderStatus'];
						$obj_temp['comPayDeptDate'] 	= $v['comPayDeptDate'];
						array_push($obj,$obj_temp);
					}else if($POST['systemType']==2 && $key=='Bankrupt'){
						$obj_temp['systemType'] 		= $key;
						$obj_temp['prefixBlackCase'] 	= $v['prefixBlackCase'];
						$obj_temp['blackCase'] 			= $v['blackCase'];
						$obj_temp['blackYy'] 			= $v['blackYy'];
						$obj_temp['prefixRedCase'] 		= $v['prefixRedCase'];
						$obj_temp['redCase'] 			= $v['redCase'];
						$obj_temp['redYy'] 				= $v['redYy'];
						$obj_temp['courtCode'] 			= $v['CourtCode'];
						$obj_temp['courtName'] 			= $v['courtName'];
						$obj_temp['cardType'] 			= $v['cardType'];
						$obj_temp['registerCode'] 		= $v['registerCode'];
						$obj_temp['prefixName'] 		= $v['prefixName'];
						$obj_temp['firstName'] 			= $v['firstName'];
						$obj_temp['lastName'] 			= $v['lastName'];
						$obj_temp['fullName'] 			= $v['fullName'];
						$obj_temp['personType'] 		= $v['personType'];
						$obj_temp['concernName'] 		= $v['concernName'];
						$obj_temp['address'] 			= $v['address'];
						$obj_temp['tumName'] 			= $v['tumName'];
						$obj_temp['ampName'] 			= $v['ampName'];
						$obj_temp['provName'] 			= $v['provName'];
						$obj_temp['zipCode'] 			= $v['zipCode'];
						$obj_temp['orderStatus'] 		= $v['orderStatus'];
						$obj_temp['excutionStatus'] 	= $v['orderStatus'];
						$obj_temp['comPayDeptDate'] 	= $v['comPayDeptDate'];
						$obj_temp['deptName'] 			= $v['deptName'];
						array_push($obj,$obj_temp);
					}else if($POST['systemType']==3 && $key=='Revive'){
						$obj_temp['systemType'] 		= $key;
						$obj_temp['prefixBlackCase'] 	= $v['prefixBlackCase'];
						$obj_temp['blackCase'] 			= $v['blackCase'];
						$obj_temp['blackYy'] 			= $v['blackYy'];
						$obj_temp['prefixRedCase'] 		= $v['prefixRedCase'];
						$obj_temp['redCase'] 			= $v['redCase'];
						$obj_temp['redYy'] 				= $v['redYy'];
						$obj_temp['courtCode'] 			= $v['CourtCode'];
						$obj_temp['courtName'] 			= $v['courtName'];
						$obj_temp['cardType'] 			= $v['cardType'];
						$obj_temp['registerCode'] 		= $v['registerCode'];
						$obj_temp['prefixName'] 		= $v['prefixName'];
						$obj_temp['firstName'] 			= $v['firstName'];
						$obj_temp['lastName'] 			= $v['lastName'];
						$obj_temp['fullName'] 			= $v['fullName'];
						$obj_temp['personType'] 		= $v['personType'];
						$obj_temp['concernName'] 		= $v['concernName'];
						$obj_temp['address'] 			= $v['address'];
						$obj_temp['tumName'] 			= $v['tumName'];
						$obj_temp['ampName'] 			= $v['ampName'];
						$obj_temp['provName'] 			= $v['provName'];
						$obj_temp['zipCode'] 			= $v['zipCode'];
						$obj_temp['orderStatus'] 		= $v['orderStatus'];
						$obj_temp['excutionStatus'] 	= $v['orderStatus'];
						$obj_temp['comPayDeptDate'] 	= $v['comPayDeptDate'];
						array_push($obj,$obj_temp);
					}else if($POST['systemType']==4 && $key=='Mediate'){
						$obj_temp['systemType'] 		= $key;
						$obj_temp['prefixBlackCase'] 	= $v['prefixBlackCase'];
						$obj_temp['blackCase'] 			= $v['blackCase'];
						$obj_temp['blackYy'] 			= $v['blackYy'];
						$obj_temp['prefixRedCase'] 		= $v['prefixRedCase'];
						$obj_temp['redCase'] 			= $v['redCase'];
						$obj_temp['redYy'] 				= $v['redYy'];
						$obj_temp['courtCode'] 			= $v['CourtCode'];
						$obj_temp['courtName'] 			= $v['courtName'];
						$obj_temp['cardType'] 			= $v['cardType'];
						$obj_temp['registerCode'] 		= $v['registerCode'];
						$obj_temp['prefixName'] 		= $v['prefixName'];
						$obj_temp['firstName'] 			= $v['firstName'];
						$obj_temp['lastName'] 			= $v['lastName'];
						$obj_temp['fullName'] 			= $v['fullName'];
						$obj_temp['personType'] 		= $v['personType'];
						$obj_temp['concernName'] 		= $v['concernName'];
						$obj_temp['address'] 			= $v['address'];
						$obj_temp['tumName'] 			= $v['tumName'];
						$obj_temp['ampName'] 			= $v['ampName'];
						$obj_temp['provName'] 			= $v['provName'];
						$obj_temp['zipCode'] 			= $v['zipCode'];
						$obj_temp['orderStatus'] 		= $v['orderStatus'];
						$obj_temp['excutionStatus'] 	= $v['orderStatus'];
						$obj_temp['comPayDeptDate'] 	= $v['comPayDeptDate'];
						array_push($obj,$obj_temp);
					}
					
				}else{
					$obj_temp['systemType'] 		= $key;
					$obj_temp['prefixBlackCase'] 	= $v['prefixBlackCase'];
					$obj_temp['blackCase'] 			= $v['blackCase'];
					$obj_temp['blackYy'] 			= $v['blackYy'];
					$obj_temp['prefixRedCase'] 		= $v['prefixRedCase'];
					$obj_temp['redCase'] 			= $v['redCase'];
					$obj_temp['redYy'] 				= $v['redYy'];
					$obj_temp['courtCode'] 			= $v['CourtCode'];
					$obj_temp['courtName'] 			= $v['courtName'];
					$obj_temp['cardType'] 			= $v['cardType'];
					$obj_temp['registerCode'] 		= $v['registerCode'];
					$obj_temp['prefixName'] 		= $v['prefixName'];
					$obj_temp['firstName'] 			= $v['firstName'];
					$obj_temp['lastName'] 			= $v['lastName'];
					$obj_temp['fullName'] 			= $v['fullName'];
					$obj_temp['personType'] 		= $v['personType'];
					$obj_temp['concernName'] 		= $v['concernName'];
					$obj_temp['address'] 			= $v['address'];
					$obj_temp['tumName'] 			= $v['tumName'];
					$obj_temp['ampName'] 			= $v['ampName'];
					$obj_temp['provName'] 			= $v['provName'];
					$obj_temp['zipCode'] 			= $v['zipCode'];
					$obj_temp['orderStatus'] 		= $v['orderStatus'];
					$obj_temp['excutionStatus'] 	= $v['lockPersonStatusText'];
					$obj_temp['comPayDeptDate'] 	= $v['comPayDeptDate'];
					$obj_temp['deptName'] 			= $v['deptName'];
					array_push($obj,$obj_temp);
				}
			}
		}
	}
}


	/* Start Backuo 2022-05-21 */
	/*
	if(!empty($POST['systemType'])){
		
		if($POST['systemType']=='1'){

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
	 
		$urls['Civil'] = connect_api_civil('CivilCheckPerson');
		$urls['Revive'] = connect_api_revive('DebtRehabilitationAllPerson.php');
		$urls['Mediate'] = connect_api_mediate('MediatePersonApi.php');
		$urls['Bankrupt'] = 'http://103.40.146.180/api/public/CheckPerson';
		
	}

	if(!empty($POST['personType'])){
		$sql = "SELECT PERSON_CODE_LAW,PERSON_CODE_BR,PERSON_CODE_RV,PERSON_CODE_MD FROM M_MAP_PERSON_TYPE WHERE PERSON_MAP_CODE = '".$POST['personType']."'";
		$qry = db::query($sql);
		$res = db::fetch_array($qry);

		$request_contents['personTypeLaw'] = $res['PERSON_CODE_LAW'];	
		$request_contents['personTypeBr'] = $res['PERSON_CODE_BR'];
		$request_contents['personTypeRv'] = $res['PERSON_CODE_RV'];
		$request_contents['personTypeMd'] = $res['PERSON_CODE_MD'];
	}

	$data_string = json_encode($request_contents);
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
						
						$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_LAW = '".$v['PERSON_TYPE']."'";
						$qry = db::query($sql);
						$res = db::fetch_array($qry);

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
						$obj[$i]['cardType'] = $v['CARD_TYPE'];
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
						
						$obj[$i]['dossId'] = $v['DOSS_ID'];
						$obj[$i]['concernList'] = $v['concernList'];
						
						// $obj[$i]['CIVIL_CODE'] = $v['CIVIL_CODE'];
						$i++;
					} 
				}

			}else if($key == 'Mediate'){

				$data2 = $data['Data'];

				foreach($data2 as $k => $v){
					
					$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_MD = '".$v['PERSON_TYPE']."'";
					$qry = db::query($sql);
					$res = db::fetch_array($qry);
					$sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COURT_CODE_REF ='".$v['orderCode']."'");
					$rec_map_status = db::fetch_array($sql_map_status);	
					
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
					// $obj[$i]['personType'] = $v['PERSON_TYPE'];
					$obj[$i]['concernName'] = $v['CONCERN_NAME'];
					$obj[$i]['address'] = $v['ADDRESS'];
					$obj[$i]['tumName'] = $v['TUM_NAME'];
					$obj[$i]['ampName'] = $v['AMP_NAME'];
					$obj[$i]['provName'] = $v['PROV_NAME'];
					$obj[$i]['zipCode'] = $v['ZIP_CODE'];
					if($rec_map_status['ACT_FLAG_1'] == 1){
						$obj[$i]['orderStatus'] = "บังคับคดี";
						
					  }
					  if($rec_map_status['ACT_FLAG_1'] == 0){
						$obj[$i]['orderStatus'] = "ไม่ถูกบังคับคดี";
						
					  }
					$i++;
				}
			}
			else if($key == 'Revive'){
				
				$data2 = $data['Data'];
				foreach($data2 as $k => $v){	
					
					$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_RV = '".$v['personType']."'";
					$qry = db::query($sql);
					$res = db::fetch_array($qry);
					$sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COURT_CODE_REF ='".$v['orderCode']."'");
					$rec_map_status = db::fetch_array($sql_map_status);	
					
					
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
					// $obj[$i]['personType'] = $v['personType'];
					$obj[$i]['concernName'] = $v['conernName'];
					$obj[$i]['conernNo'] = $v['CONCERN_NO'];
					$obj[$i]['address'] = $v['address'];
					$obj[$i]['tumName'] = $v['tumName'];
					$obj[$i]['ampName'] = $v['ampName'];
					$obj[$i]['provName'] = $v['provName'];
					$obj[$i]['zipCode'] = $v['zipCode'];
					if($rec_map_status['ACT_FLAG_1'] == 1){
						$obj[$i]['orderStatus'] = "บังคับคดี";
						
					  }
					  if($rec_map_status['ACT_FLAG_1'] == 0){
						$obj[$i]['orderStatus'] = "ไม่ถูกบังคับคดี";
						
					  }
					$i++;
				}
			} 
			else if($key == 'Bankrupt'){
				$data2 = $data['data']['Data'];
				foreach($data2 as $k => $v){
				
				$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_BR = '".$v['personType']."'";
				$qry = db::query($sql);
				$res = db::fetch_array($qry);
				
				$sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COT_CODE ='".$v['orderCode']."'");
				$rec_map_status = db::fetch_array($sql_map_status);
					 
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
					$obj[$i]['firstName'] = $v['firstName'];
					$obj[$i]['lastName'] = $v['lastName'];
					$obj[$i]['fullName'] = $v['fullName'];
					$obj[$i]['personType'] = $res['PERSON_MAP_CODE'];
					$obj[$i]['concernName'] = $v['conernName']; 
					$obj[$i]['conernNo'] = $v['CONCERN_NO'];
					$obj[$i]['address'] = $v['address'];
					$obj[$i]['tumName'] = $v['tumName'];
					$obj[$i]['ampName'] = $v['ampName'];
					$obj[$i]['provName'] = $v['provName'];
					$obj[$i]['zipCode'] = $v['zipCode'];
					$obj[$i]['personStatus'] = $v['personStatus'];
					$obj[$i]['bankruptCode'] = $v['bankruptCode'];
					
					if($rec_map_status['ACT_FLAG_1'] == 1){ 
						$obj[$i]['orderStatus'] = "บังคับคดี";
						 
					  }
					  if($rec_map_status['ACT_FLAG_1'] == 0){
						$obj[$i]['orderStatus'] = "ไม่ถูกบังคับคดี";
						
					  }
					$obj[$i]['concernList'] = $v['concernList'];
					$i++;
				}
			}
		}
		
		
			curl_multi_remove_handle($mh, $chs[$key]);
	}
}


*/

/* End Backuo 2022-05-21 */

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