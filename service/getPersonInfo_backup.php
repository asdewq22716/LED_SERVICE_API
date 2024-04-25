<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);


if ($res['ip'])
{
    $ip = $res['ip'];
}
else
{
    $ip = get_client_ip();
}

$field = array();
$field['IP_ADDRESS'] = $ip ;
$field['DEP_ID'] = $POST['depId'];
$field['REQUEST'] = 'getPersonInfo';
$field['LOG_DATE'] = date("Y-m-d");
$field['LOG_TIME'] = date("H:i:s");
$field['USR_ID'] = '' ;
$field['REQUEST_STATUS'] = '200';
$field['USR_IDCARD'] = $POST['idCard'];
$field['LOG_TYPE'] = '1' ;
//$field['REQUEST_DATA'] = $str_json;

$LOG_ID = db::db_insert('M_LOG', $field, 'LOG_ID','LOG_ID');

// $h = fopen("log_file/" . $LOG_ID . '.txt', "w");
// fwrite($h, $REQUEST_DATA);
// fclose($h);

$h = fopen("log_file/getPersonInfo-json_" . $LOG_ID . '.txt', "w");
fwrite($h, json_encode($data,JSON_UNESCAPED_UNICODE));
fclose($h);


if($data['userName'] == "BankruptDt" && $data['passWord'] == "Debtor4321"){
	
	$filter ="";
	
	if(!empty($data['registerCode'])){
		$filter .= "AND (REPLACE(REGISTERCODE,'-','') = '".$data['registerCode']."' OR REGISTERCODE = '".$data['registerCode']."')";
	}
	if(!empty($data['prefixBlackCase']) && !empty($data['blackCase']) && !empty($data['blackYy'])){
		$filter .= "AND (T_NO_BLACK = '".$data['prefixBlackCase']."' AND NO_BLACK_CASE = '".$data['blackCase']."' AND BLACK_YEAR = '".$data['blackYy']."')";
	}
	if(!empty($data['prefixRedCase']) && !empty($data['redCase']) && !empty($data['redYy'])){
		$filter .= "AND (T_NO_RED = '".$data['prefixRedCase']."' AND NO_RED_CASE = '".$data['redCase']."' AND RED_YEAR = '".$data['redYy']."')";
	}
	if(!empty($data['brcId'])){
		$filter .= "AND BRC_ID = '".$data['brcId']."' ";
		
		$url = connect_bankrupt('CheckCase');
		$form_field['userName'] = 'BankruptDt';
		$form_field['passWord'] = 'Debtor4321';
		$form_field['brcId'] = $data['brcId'];
		$data_string = json_encode($form_field);

		$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
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
		$res = json_decode($response, true);
		curl_close($curl);
		
		if($res['statusCode'] == '200'){
			foreach($res['data']['Data'] as $k => $v){
				
				$br_prefixBlackCase = $v['prefixBlackCase'];
				$br_blackCase = $v['blackCase'];
				$br_blackYY = $v['blackYY'];
				$br_prefixRedCase = $v['prefixRedCase'];
				$br_redCase = $v['redCase'];
				$br_redYY = $v['redYY'];
					
			}
		}

	}
	

	$sql = "SELECT * FROM M_PERSONAL_INFO_CASE WHERE 1=1 {$filter}";
	$query = db::query($sql);
	$nums = db::num_rows($query);
	
	if($nums > 0){
		$i = 0;
		while($rec = db::fetch_array($query)){

			$obj[$i]['brcId'] = $rec['BRC_ID'];
			$obj[$i]['prefixBlackCaseBr'] = $br_prefixBlackCase;
			$obj[$i]['blackCaseBr'] = $br_blackCase;
			$obj[$i]['blackYyBr'] = $br_blackYY;
			$obj[$i]['prefixRedCaseBr'] = $br_prefixRedCase;
			$obj[$i]['redCaseBr'] = $br_redCase;
			$obj[$i]['redYyBr'] = $br_redYY;	
			
			$obj[$i]['prefixBlackCase'] = $rec['T_NO_BLACK'];
			$obj[$i]['blackCase'] = $rec['NO_BLACK_CASE'];
			$obj[$i]['blackYy'] = $rec['BLACK_YEAR'];
			$obj[$i]['prefixRedCase'] = $rec['T_NO_RED'];
			$obj[$i]['redCase'] = $rec['NO_RED_CASE'];
			$obj[$i]['redYy'] = $rec['RED_YEAR'];
			$obj[$i]['systemType'] = $rec['SYSTEM_TYPE'];
			$obj[$i]['courtName'] = $rec['COURT_NAME'];
			$obj[$i]['registerCode'] = str_replace('-','',$rec['REGISTERCODE']);
			$obj[$i]['fullName'] = $rec['F_NAME'];
			$obj[$i]['concernName'] = $rec['CONERNNAME'];
			$obj[$i]['personType'] = $rec['PERSON_TYPE_CODE'];
			$obj[$i]['address'] = $rec['ADDRESS'];
			$obj[$i]['orderStatus'] = $rec['ORDER_STATUS'];
			$obj[$i]['bankruptCode'] = $rec['BANKRUPT_CODE'];
			$i++;
		}
	}
}
$num = count($obj);
	
	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
		$row['Data'] = $obj;
			
	}else{
			
		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");	
		// $row['Data'] = $sql;
			

	}



echo json_encode($row); 
 ?>
  