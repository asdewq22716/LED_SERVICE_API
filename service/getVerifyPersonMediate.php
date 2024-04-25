<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$request_contents = array();
$urls  = array(); 
$chs   = array();
$row   = array();
$obj   = array();
$loop2 = array();
  
if(!empty($POST['registerCode'])){
	$RegisterCode = str_replace('-','',$POST['registerCode']);
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
if(!empty($POST['courtName'])){
	$courtName = $POST['courtName'];
}
if(empty($POST['companyCode']) && empty($POST['registerCode'])){
	
	$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");
	echo json_encode($row);
	exit;
	
}

if(!empty($POST['systemType'])){ 
	$urlLoop2 = '';
	if($POST['systemType']=='1'){
		$urlLoop2 = connect_api_civil('CivilCheckPerson');
	}
	if($POST['systemType']=='3'){
		$urlLoop2 = connect_api_revive('DebtRehabilitationAllPerson.php');
	}
	if($POST['systemType']=='4'){
		$urlLoop2 = connect_api_mediate('MediatePersonApi.php'); 
	}
	if($POST['systemType']=='2'){
		$urlLoop2 = 'http://103.40.146.180/api/public/CheckCase';
	}
}

$request_contents = array(
			'userName' 		  => 'BankruptDt',
			'passWord' 		  => 'Debtor4321',
			'prefixBlackCase' => $prefixBlackCase,
			'blackCase' 	  => $blackCase,
			'blackYy' 		  => $blackYy,
			'prefixRedCase'   => $prefixRedCase,
			'redCase' 		  => $redCase,
			'redYy' 		  => $redYy,
			'courtName' 	  => $courtName,
			'getRegister'	  => '1'
		);
	
$data = curl($urlLoop2,$request_contents); 

	if($data['ResponseCode']['ResCode'] == '000' || $data['statusCode'] == '200'){	
		if($POST['systemType'] == '1'){
			$data2 = $data['Data'];
			foreach($data2 as $k2 => $v2){	
				foreach($v2 as $k => $v){
					$tempLoop2 = array();
					$tempLoop2['registerCode'] = $v['REGISTERCODE'];
					if($v['PERSON_TYPE'] == '02' && $v['REGISTERCODE'] != $POST['registerCode']){
						array_push($loop2,$tempLoop2);
					}
				} 
			}
		}else if($POST['systemType']== '4'){
			$data2 = $data['Data'];
			foreach($data2 as $k => $v){
				$tempLoop2 = array();
				$tempLoop2['registerCode'] = $v['REGISTER_CODE'];
				if($v['PERSON_TYPE'] == '02' && $v['REGISTERCODE'] != $POST['registerCode']){
					array_push($loop2,$tempLoop2);
				}
			}
		}else if($POST['systemType'] == '3'){
			$data2 = $data['Data'];
			foreach($data2 as $k => $v){
				$tempLoop2 = array();
				$tempLoop2['registerCode'] = $v['REGISTERCODE'];
				if($v['PERSON_TYPE'] == '06' && $v['REGISTERCODE'] != $POST['registerCode']){
					array_push($loop2,$tempLoop2);
				}
			}
		}else if($POST['systemType'] == '2'){
			$data2 = $data['data']['Data'];
			foreach($data2 as $k => $v){
				
				foreach($v['deffendant'] as $k2 => $v2){
					// echo json_encode($v2['registerCode']);
					$tempLoop2 = array();
					if($v2['REGISTERCODE'] != $POST['registerCode']){
						$tempLoop2['registerCode'] = $v2['registerCode'];
					// if($v['PERSON_TYPE'] == '06' ){
						array_push($loop2,$tempLoop2);
					// }
					}
				}
			}
		}
	}

if(count($loop2) > 0 ){
	$loop3 = array();
	$urls['Civil'] = connect_api_civil('CivilCheckPerson');
	$urls['Revive'] = connect_api_revive('DebtRehabilitationAllPerson.php');
	$urls['Mediate'] = connect_api_mediate('MediatePersonApi.php');
	$urls['Bankrupt'] = 'http://103.40.146.180/api/public/CheckPerson';
	foreach($loop2 as $k => $v){
		$request_contents = array(
			'userName' => 'BankruptDt',
			'passWord' => 'Debtor4321',
			'RegisterCode' => $v['registerCode']
		);
		$data_string = json_encode($request_contents);
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
							// if(($prefixBlackCase != $v['PREFIX_BLACK_CASE'] || $blackCase != $v['BLACK_CASE'] || $blackYy != $v['BLACK_YY']) && ($prefixRedCase != $v['PREFIX_RED_CASE'] || $redCase != $v['RED_CASE'] || $redYy != $v['RED_YY'] || $courtName !=  $v['COURT_NAME'])){ ### Comment 21/03/2022 เนื่องจากให้ตรวจคดีตัวเองด้วย
								$temp = array(
											'prefixBlackCase' => $v['PREFIX_BLACK_CASE']
										   ,'blackCase' => $v['BLACK_CASE']
										   ,'blackYy' => $v['BLACK_YY']
										   ,'prefixRedCase' => $v['PREFIX_RED_CASE']
										   ,'redCase' => $v['RED_CASE']
										   ,'redYy' => $v['RED_YY']
										   ,'courtName' => $v['COURT_NAME']
								);
								if($v['PREFIX_BLACK_CASE'] != ''){
									array_push($loop3,$temp);
								}
							// }
						} 
					}
				}else if($key == 'Mediate'){
					
					$data2 = $data['Data'];
					foreach($data2 as $k => $v){
						// if(($prefixBlackCase != $v['PREFIX_BLACK_CASE'] || $blackCase != $v['BLACK_CASE'] || $blackYy != $v['BLACK_YY']) && ($prefixRedCase != $v['PREFIX_RED_CASE'] || $redCase != $v['RED_CASE'] || $redYy != $v['RED_YY'] || $courtName !=  $v['COURT_NAME'])){ ### Comment 21/03/2022 เนื่องจากให้ตรวจคดีตัวเองด้วย
								$temp = array(
											'prefixBlackCase' => $v['PREFIX_BLACK_CASE']
										   ,'blackCase' => $v['BLACK_CASE']
										   ,'blackYy' => $v['BLACK_YY']
										   ,'prefixRedCase' => $v['PREFIX_RED_CASE']
										   ,'redCase' => $v['RED_CASE']
										   ,'redYy' => $v['RED_YY']
										   ,'courtName' => $v['COURT_NAME']
								);
								array_push($loop3,$temp);
						// } 
					}
				}
				else if($key == 'Revive'){
					
					$data2 = $data['Data'];
					foreach($data2 as $k => $v){	
						// if(($prefixBlackCase != $v['prefixBlackCase'] || $blackCase != $v['blackCase'] || $blackYy != $v['blackYY']) && ($prefixRedCase != $v['prefixRedCase'] || $redCase != $v['redCase'] || $redYy != $v['redYY'] || $courtName !=  $v['courtName'])){ ### Comment 21/03/2022 เนื่องจากให้ตรวจคดีตัวเองด้วย
								$temp = array(
											'prefixBlackCase' => $v['prefixBlackCase']
										   ,'blackCase' => $v['blackCase']
										   ,'blackYy' => $v['blackYY']
										   ,'prefixRedCase' => $v['prefixRedCase']
										   ,'redCase' => $v['redCase']
										   ,'redYy' => $v['redYY']
										   ,'courtName' => $v['courtName']
								);
								array_push($loop3,$temp);
						// }
					}
				}
				else if($key == 'Bankrupt'){
					$data2 = $data['data']['Data'];
					foreach($data2 as $k => $v){
						// if(($prefixBlackCase != $v['prefixBlackCase'] || $blackCase != $v['blackCase'] || $blackYy != $v['blackYY']) && ($prefixRedCase != $v['prefixRedCase'] || $redCase != $v['redCase'] || $redYy != $v['redYY'] || $courtName !=  $v['courtName'])){ ### Comment 21/03/2022 เนื่องจากให้ตรวจคดีตัวเองด้วย
								$temp = array(
											'prefixBlackCase' => $v['prefixBlackCase']
										   ,'blackCase' => $v['blackCase']
										   ,'blackYy' => $v['blackYY']
										   ,'prefixRedCase' => $v['prefixRedCase']
										   ,'redCase' => $v['redCase']
										   ,'redYy' => $v['redYY']
										   ,'courtName' => $v['courtName']
								);
								array_push($loop3,$temp);
							// }
					
					}
				}
			}
			curl_multi_remove_handle($mh, $chs[$key]);
		}
	}
}
	
	// exit;
	if(count($loop3) > 0 ){
		foreach($loop3 as $k => $v){
			$request_contents = array(
				'userName' 		  => 'BankruptDt',
				'passWord' 		  => 'Debtor4321',
				'RegisterCode'    => $RegisterCode,
				'prefixBlackCase' => $v['prefixBlackCase'],
				'blackCase' 	  => $v['blackCase'],
				'blackYy' 		  => $v['blackYy'],
				'prefixRedCase'   => $v['prefixRedCase'],
				'redCase' 		  => $v['redCase'],
				'redYy' 		  => $v['redYy'],
				'courtName' 	  => $v['courtName']
			);
			$request_contents['personTypeLaw'] = '01';	
			$request_contents['personTypeBr']  = '01';	
			$request_contents['personTypeRv']  = '01';	
			$request_contents['personTypeMd']  = '01';	
			$data_string = json_encode($request_contents);
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
								
								$temp = array();
								$tempLoop2 = array();
								$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_LAW = '".$v['PERSON_TYPE']."'";
								$qry = db::query($sql);
								$res = db::fetch_array($qry);

								$ROOM_NO = $v['ROOM_NO']!=''?'ห้อง '.$v['ROOM_NO']:'';
								$MOO = $v['MOO']!=''?'หมู่ '.$v['MOO']:'';
								$SOI = $v['SOI']!=''?'ซอย '.$v['SOI']:'';
								$MAIN_STREET = $v['MAIN_STREET']!=''?'ถนน '.$v['MAIN_STREET']:'';
							
								$fullname = $v['TITLE_NAME'].$v['FIRSTNAME']."  ".$v['LNAME'];
								$address = $v['NAME_HOUSE']." ".$v['HOUSE_NO']." ".$ROOM_NO." ".$MOO." ".$SOI." ".$MAIN_STREET;
								$temp['systemType'] = 'Civil';
								$temp['prefixBlackCase'] = $v['PREFIX_BLACK_CASE'];
								$temp['blackCase'] = $v['BLACK_CASE'];
								$temp['blackYy'] =  $v['BLACK_YY'];
								$temp['prefixRedCase'] = $v['PREFIX_RED_CASE'];
								$temp['redCase'] = $v['RED_CASE'];
								$temp['redYy'] = $v['RED_YY'];
								$temp['courtName'] = $v['COURT_NAME'];
								$temp['registerCode'] = $v['REGISTERCODE'];
								$temp['prefixName'] = $v['TITLE_NAME'];
								$temp['firstName'] = $v['FIRSTNAME'];
								$temp['lastName'] = $v['LNAME'];
								$temp['fullName'] = $v['PERSON_FULL_NAME'];
								$temp['personType'] = $res['PERSON_MAP_CODE'];
								$temp['concernName'] = $v['CONCERN'];
								$temp['address'] =  $v['ADDR'];
								$temp['tumName'] = $v['TUM_NAME'];
								$temp['ampName'] = $v['AMP_NAME'];
								$temp['provName'] = $v['PRV_NAME'];
								$temp['zipCode'] = $v['POSTCODE'];
								
								if($v['STATUS_CODE']==1){
									$temp['orderStatus'] = "บังคับคดี";
								}else{
									$temp['orderStatus'] = "ไม่ถูกบังคับคดี";
								}
								
								$temp['dossId'] = $v['DOSS_ID'];
								$temp['concernList'] = $v['concernList'];
								
								array_push($obj,$temp);
								
							} 
						}

					}else if($key == 'Mediate'){

						$data2 = $data['Data'];

						foreach($data2 as $k => $v){
							
							$temp = array();
							$tempLoop2 = array();
							$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_MD = '".$v['personType']."'";
							$qry = db::query($sql);
							$res = db::fetch_array($qry);
							$sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COURT_CODE_REF ='".$v['orderCode']."'");
							$rec_map_status = db::fetch_array($sql_map_status);	
							
							$fullname = $v['PREFIX_NAME'].$v['FIRST_NAME']."  ".$v['LAST_NAME'];
							
							$temp['systemType'] = 'Mediate';
							$temp['prefixBlackCase'] = $v['PREFIX_BLACK_CASE'];
							$temp['blackCase'] = $v['BLACK_CASE'];
							$temp['blackYy'] = $v['BLACK_YY'];
							$temp['prefixRedCase'] = $v['PREFIX_RED_CASE'];
							$temp['redCase'] = $v['RED_CASE'];
							$temp['redYy'] = $v['RED_YY'];
							$temp['courtName'] = $v['COURT_NAME'];
							$temp['registerCode'] = $v['REGISTER_CODE'];
							$temp['prefixName'] = $v['PREFIX_NAME'];
							$temp['firstName'] = $v['FIRST_NAME'];
							$temp['lastName'] = $v['LAST_NAME'];
							$temp['fullName'] = $fullname;
							$temp['personType'] = $res['PERSON_MAP_CODE'];
							$temp['concernName'] = $v['CONCERN_NAME'];
							$temp['address'] = $v['ADDRESS'];
							$temp['tumName'] = $v['TUM_NAME'];
							$temp['ampName'] = $v['AMP_NAME'];
							$temp['provName'] = $v['PROV_NAME'];
							$temp['zipCode'] = $v['ZIP_CODE'];
							if($rec_map_status['ACT_FLAG_1'] == 1){
								$temp['orderStatus'] = "บังคับคดี";
							  }
							  if($rec_map_status['ACT_FLAG_1'] == 0){
								$temp['orderStatus'] = "ไม่ถูกบังคับคดี";
							  }
							array_push($obj,$temp);
						}
					}
					else if($key == 'Revive'){
						
						$data2 = $data['Data'];
						foreach($data2 as $k => $v){	
							
							$temp = array();
							$tempLoop2 = array();
							$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_RV = '".$v['personType']."'";
							$qry = db::query($sql);
							$res = db::fetch_array($qry);
							$sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COURT_CODE_REF ='".$v['orderCode']."'");
							$rec_map_status = db::fetch_array($sql_map_status);	
							
							
							$fullname = $v['PREFIX_NAME'].$v['FIRST_NAME']."  ".$v['LAST_NAME'];
							
							$temp['systemType'] = 'Revive';
							$temp['prefixBlackCase'] = $v['prefixBlackCase'];
							$temp['blackCase'] = $v['blackCase'];
							$temp['blackYy'] = $v['blackYY'];
							$temp['prefixRedCase'] = $v['prefixRedCase'];
							$temp['redCase'] = $v['redCase'];
							$temp['redYy'] = $v['redYY']; 
							$temp['courtName'] = $v['courtName'];
							$temp['registerCode'] = $v['registerCode'];
							$temp['prefixName'] = $v['prefixName'];
							$temp['firstName'] = $v['FIRST_NAME'];
							$temp['lastName'] = $v['LAST_NAME'];
							$temp['fullName'] = $v['fullName'];
							$temp['personType'] = $res['PERSON_MAP_CODE'];
							$temp['concernName'] = $v['conernName'];
							$temp['conernNo'] = $v['CONCERN_NO'];
							$temp['address'] = $v['address'];
							$temp['tumName'] = $v['tumName'];
							$temp['ampName'] = $v['ampName'];
							$temp['provName'] = $v['provName'];
							$temp['zipCode'] = $v['zipCode'];  
							if($rec_map_status['ACT_FLAG_1'] == 1){
								$temp['orderStatus'] = "บังคับคดี";
							  }
							  if($rec_map_status['ACT_FLAG_1'] == 0){
								$temp['orderStatus'] = "ไม่ถูกบังคับคดี";
							  }
							array_push($obj,$temp);
						}
					}
					else if($key == 'Bankrupt'){
						$data2 = $data['data']['Data'];
						foreach($data2 as $k => $v){
						
						$temp = array();
						$tempLoop2 = array();
						$sql = "SELECT PERSON_MAP_CODE FROM M_MAP_PERSON_TYPE WHERE PERSON_CODE_BR = '".$v['personType']."'";
						$qry = db::query($sql);
						$res = db::fetch_array($qry);
						
						$sql_map_status = db::query("SELECT * FROM M_COURT_MAP WHERE COT_CODE ='".$v['orderCode']."'");
						$rec_map_status = db::fetch_array($sql_map_status);
							 
							$temp['systemType'] = 'Bankrupt';
							$temp['prefixBlackCase'] = $v['prefixBlackCase'];
							$temp['blackCase'] = $v['blackCase'];
							$temp['blackYy'] = $v['blackYY'];
							$temp['prefixRedCase'] = $v['prefixRedCase'];
							$temp['redCase'] = $v['redCase'];
							$temp['redYy'] = $v['redYY'];
							$temp['courtName'] = $v['courtName'];
							$temp['registerCode'] = $v['registerCode'];
							$temp['prefixName'] = $v['PREFIX_NAME'];
							$temp['firstName'] = $v['firstName'];
							$temp['lastName'] = $v['lastName'];
							$temp['fullName'] = $v['fullName'];
							$temp['personType'] = $res['PERSON_MAP_CODE'];
							$temp['concernName'] = $v['conernName']; 
							$temp['conernNo'] = $v['CONCERN_NO'];
							$temp['address'] = $v['address'];
							$temp['tumName'] = $v['tumName'];
							$temp['ampName'] = $v['ampName'];
							$temp['provName'] = $v['provName'];
							$temp['zipCode'] = $v['zipCode'];
							$temp['personStatus'] = $v['personStatus'];
							$temp['bankruptCode'] = $v['bankruptCode'];
							
							if($rec_map_status['ACT_FLAG_1'] == 1){ 
								$temp['orderStatus'] = "บังคับคดี";
							  }
							  if($rec_map_status['ACT_FLAG_1'] == 0){
								$temp['orderStatus'] = "ไม่ถูกบังคับคดี";
							  }
							$temp['concernList'] = $v['concernList'];
							array_push($obj,$temp);
						
						}
					}
				}
				
				
				curl_multi_remove_handle($mh, $chs[$key]);
			}
		}
	}
	if($POST['systemCode'] != ''){
		$arr = array(
				"1" => "Civil",
				"2" => "Bankrupt",
				"3" => "Revive",
				"4" => "Mediate",
			   );
		$arrTemp = array();
		foreach($obj as $key => $value){
			
			if($value['systemType'] == $arr[$POST['systemCode']]){
				
				array_push($arrTemp,$obj[$key]);
			}
			
		}
		$obj = $arrTemp;
	}

$num = count($obj);
	
	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
		$row['Data'] = $obj;
			
	}else{
			
		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");	

	}
curl_multi_close($mh);

echo json_encode($row); 
?>