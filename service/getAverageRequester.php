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

	
	if($res['ResponseCode']['ResCode'] == '000' || $res['statusCode'] == '200'){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $res['Data'];
			
	}else{
			
		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");	
			

	}
	
	echo json_encode($row);
}
 ?>
  