<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
$i=0;

$form_field['userName'] = 'BankruptDt';
$form_field['passWord'] = 'Debtor4321';
$form_field['prefixBlackCase'] = $res['prefixBlackCase'];
$form_field['blackCase'] = $res['blackCase'];
$form_field['blackYY'] = $res['blackYy'];

	$url = connect_bankrupt('CheckCase');

	$data = curl($url, $request);
 
    if($data['data']['ResponseCode']['ResCode'] == '000' ){
	 
	    $brcId = $data['data']['Data'][0]['bankruptCode'];
	    if(!empty($brcId)){
			$request_contents = array(
				'userName' => 'BankruptDt',
				'passWord' => 'Debtor4321',
				'RegisterCode' => $RegisterCode,
				'companyCode'=> $companyCode
			);	 
	    } 
	 
    }
	 

if(!empty($POST['assetType'])){
	
	if($POST['assetType']=='001'){
		$url = connect_bankrupt('CheckAssetLand');
	}
	if($POST['assetType']=='002'){
		$url = connect_bankrupt('CheckAssetBuilding');
	}
	if($POST['assetType']=='0003'){
		$url = connect_bankrupt('CheckAssetCondo'); 
	}
	if($POST['assetType']=='0004'){
		$url = connect_bankrupt('CheckAssetMachine');
	}
	if($POST['assetType']=='0005'){
		// $url = connect_bankrupt('CheckAssetMachine');
	}
	if($POST['assetType']=='0006'){
		// $url = connect_bankrupt('CheckAssetMachine');
	}
	if($POST['assetType']=='0007'){
		$url = connect_bankrupt('CheckAssetFirearm');
	}
	if($POST['assetType']=='0008'){
		// $url = connect_bankrupt('CheckAssetMachine');
	}
	if($POST['assetType']=='0009'){
		$url = connect_bankrupt('CheckAssetOther');
	}
	if($POST['assetType']=='0010'){
		$url = connect_bankrupt('CheckAssetRent');
	}
	if($POST['assetType']=='0011'){
		$url = connect_bankrupt('CheckAssetMachine');
	}
	if($POST['assetType']=='0012'){
		$url = connect_bankrupt('CheckAssetStock');
	}
	if($POST['assetType']=='0013'){
		// $url = connect_bankrupt('CheckAssetMachine');
	}
	
}

$con = curl_init();
curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($con, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($con, CURLOPT_HEADER, 0);
curl_setopt($con, CURLOPT_TIMEOUT, 120);

curl_setopt($con, CURLOPT_URL, $url);
curl_setopt($con, CURLOPT_POST, 1);

$data_string = json_encode($form_field);
curl_setopt($con, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($con);
$data = json_decode($data, true);
$i = 0;
	if($data['data']['ResponseCode']['ResCode'] == '000'){

			$data2 = $data['data']['Data'];
			foreach($data2 as $k => $v){

				$obj[$i][$k] = $v;
			
				$i++;
			}


}

$num = count($obj);

	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $obj;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}

echo json_encode($data);

 ?>
