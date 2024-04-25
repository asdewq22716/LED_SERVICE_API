<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);
$i=0;

$form_field['USERNAME'] 			= 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] 			= 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง


$arrDataAssetDetail = array();
$sqlSelectData = "	select 		HOLDING_GROUP,HOLDING_TYPE,PERSON_NAME
					from 		WH_CIVIL_CASE_ASSET_OWNER
					where 		WH_CIVIL_CASE_ASSET_OWNER.ASSET_ID = '".$POST['assetId']."' 
					order by 	HOLDING_GROUP asc";
$querySelectData = db::query($sqlSelectData);
while($dataSelectData = db::fetch_array($querySelectData)){
	$arrDataAssetDetail[$dataSelectData["HOLDING_GROUP"]][] = array(
	                                                               "HOLDING_TYPE" => $dataSelectData["HOLDING_TYPE"],
	                                                               "PERSON_NAME"  => $dataSelectData["PERSON_NAME"]
																   );
}


$num = count($arrDataAssetDetail);

	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $arrDataAssetDetail;
		
		$data = $row;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");
		$data = $row;
	}

echo json_encode($data);

 ?>
