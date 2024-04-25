<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);

if($data['userName'] == "BankruptDt" && $data['passWord'] == "Debtor4321"){
	
		
		$url = connect_api_civil('getAverageRequester');
		$form_field = array( 
						'userName' => 'BankruptDt',
						'passWord' => 'Debtor4321',
						'registerCode' => $data['registerCode']
					  );
		
		$res = curl($url,$form_field);
		
		if($res['ResponseCode']['ResCode'] == '000' || $data['statusCode'] == '200'){
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
	if(!empty($filter)){
		$filter = "OR( 1=1 {$filter})";
	}

	$sql = "SELECT * FROM M_PERSONAL_INFO_CASE WHERE 1=0 {$filter}";
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
			$obj[$i]['personType'] = $rec['PERSON_TYPE_RE'];
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
  