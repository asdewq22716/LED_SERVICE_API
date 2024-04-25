<?php
include "../include/include.php";

if($_POST["SYS_NAME"]==1){
	
	//ข้อมูลคำสั่ง
	$sqlSelectCmd = "	SELECT 	TO_T_BLACK_CASE,TO_BLACK_CASE,TO_BLACK_YY,TO_T_RED_CASE,TO_RED_CASE,TO_RED_YY,TO_COURT_CODE,TO_COURT_NAME,
								T_BLACK_CASE,BLACK_CASE,BLACK_YY,T_RED_CASE,RED_CASE,RED_YY,COURT_NAME
						FROM 	M_DOC_CMD 
						WHERE 	ID = '".$_POST['ID']."'";
	$querySelectCmd 	= db::query($sqlSelectCmd);
	$recSelectSelectCmd = db::fetch_array($querySelectCmd);
		
	//รหัส PK คดีล้ม
	$sqlSelectCase = "	select 	BANKRUPT_CODE
						from 	WH_BANKRUPT_CASE_DETAIL 
						where 	PREFIX_BLACK_CASE = '".$recSelectSelectCmd["TO_T_BLACK_CASE"]."'
								AND BLACK_CASE = '".$recSelectSelectCmd["TO_BLACK_CASE"]."'
								AND BLACK_YY = '".$recSelectSelectCmd["TO_BLACK_YY"]."'
								AND PREFIX_RED_CASE = '".$recSelectSelectCmd["TO_T_RED_CASE"]."'
								AND RED_CASE = '".$recSelectSelectCmd["TO_RED_CASE"]."'
								AND RED_YY = '".$recSelectSelectCmd["TO_RED_YY"]."'";
	$querySelectCase = db::query($sqlSelectCase);
	$recSelectCase 	 = db::fetch_array($querySelectCase);
	
	
	$sqlSelectAssetMain = "	select 		b.*
							from 		M_CMD_ASSET a 
							inner join 	WH_CIVIL_CASE_ASSETS b on a.ASSET_ID = b.ASSET_ID
							inner join 	M_SERVICE_CMD  c on a.ASSET_CASE_TYPE = c.CMD_TYPE_CODE
							where 		CMD_ID = '".$_POST['ID']."'";
	$querySelectAssetMain 	= db::query($sqlSelectAssetMain);
	while($recSelectAssetMain = db::fetch_array($querySelectAssetMain)){
		
		$brcId = $recSelectCase["BANKRUPT_CODE"];

		$datacase['systemType']      =  '1';
		$datacase['blackCaseCode']   =  $recSelectSelectCmd["T_BLACK_CASE"].$recSelectSelectCmd["BLACK_CASE"]."/".$recSelectSelectCmd["BLACK_YY"];
		$datacase['redCaseCode']     =  $recSelectSelectCmd["T_RED_CASE"].$recSelectSelectCmd["RED_CASE"]."/".$recSelectSelectCmd["RED_YY"];
		$datacase['courtName']       =  $recSelectSelectCmd["COURT_NAME"];
		
		$datacase['propTitle']       =  $recSelectAssetMain["PROP_TITLE"];
		$datacase['propStatusCode']  =  $recSelectAssetMain["PROP_STATUS"];
		$datacase['propStatusName']  =  $recSelectAssetMain["PROP_STATUS_NAME"];
		$datacase['dossId']          =  $recSelectAssetMain['DOSS_ID'];
		$datacase['assetId']         =  $recSelectAssetMain['ASSET_ID'];
		
		if($recSelectAssetMain["TYPE_CODE"]=='01'){
			
			$sqlSelectDataAssetDetail 		= "	SELECT 	* 
												FROM 	WH_CIVIL_CASE_ASSETS_LAND 
												WHERE 	ASSET_CODE = '".$recSelectAssetMain["ASSET_ID"]."'";
			$querySelectDataAssetDetail 	= db::query($sqlSelectDataAssetDetail);
			$recSelectDataAssetDetail 		= db::fetch_array($querySelectDataAssetDetail);
			
			$dataAssetMain["assetTypeCode"] = '01';
			$dataAssetMain["assetLandBean"]["assetTypeDetailCode"] 	= '001';//$recSelectDataAssetDetail["ASSET_DOC_TYPE"];
			
			$dataAssetMain["assetLandBean"]["landNumber"] 			= $recSelectDataAssetDetail["LAND_NO"];
			$dataAssetMain["assetLandBean"]["regNumber"] 			= $recSelectDataAssetDetail["BOOK_NO"];
			$dataAssetMain["assetLandBean"]["regVolumn"] 			= $recSelectDataAssetDetail["BOOK_NO"];
			
			$dataAssetMain["assetLandBean"]["regPage"] 				= $recSelectDataAssetDetail["PAGE_NO"];
			
			// $dataAssetMain["assetLandBean"]["regDate"] 				= $recSelectDataAssetDetail[""];
			// $dataAssetMain["assetLandBean"]["parcelNumber"] 		= $recSelectDataAssetDetail[""];
			
			$dataAssetMain["assetLandBean"]["dealingFileNumber"] 	= $recSelectDataAssetDetail["SURVEY_PAGE"];
			//$dataAssetMain["assetLandBean"]["landAdditional"] 		= $recSelectDataAssetDetail[""];
			$dataAssetMain["assetLandBean"]["areaRai"] 				= $recSelectDataAssetDetail["AREA_RAI"];
			$dataAssetMain["assetLandBean"]["areaNgan"] 			= $recSelectDataAssetDetail["AREA_NGAN"];
			$dataAssetMain["assetLandBean"]["areaSqwah"] 			= $recSelectDataAssetDetail["AREA_WA"];
			$dataAssetMain["assetLandBean"]["areaPieceOfWah"] 		= $recSelectDataAssetDetail["AREA_FRACTION_WA"];
			$dataAssetMain["assetLandBean"]["landState"] 			= $recSelectDataAssetDetail["DETAIL"];
			//$dataAssetMain["assetLandBean"]["nearBy"] 				= $recSelectDataAssetDetail[""];
			$dataAssetMain["assetLandBean"]["remark"] 				= $recSelectDataAssetDetail["DETAIL"];
			$dataAssetMain["assetLandBean"]["pricePerUnit"] 		= $recSelectDataAssetDetail["LAND_PRICE_PER_WA"];
			$dataAssetMain["assetLandBean"]["totalPrice"] 			= $recSelectDataAssetDetail["LAND_PRICE"];
			
			$dataAssetMain["assetLandBean"]["provinceCode"] 		= '24';//$recSelectDataAssetDetail[""];
			$dataAssetMain["assetLandBean"]["districtCode"] 		= '2403';//$recSelectDataAssetDetail[""];
			$dataAssetMain["assetLandBean"]["subDistrictCode"] 		= '240308';//$recSelectDataAssetDetail[""];
			
			$dataAssetMain["assetLandBean"]["regProvince"] 			= $recSelectDataAssetDetail["PROV_NAME"];
			$dataAssetMain["assetLandBean"]["regDistric"] 			= $recSelectDataAssetDetail["AMP_NAME"];
			$dataAssetMain["assetLandBean"]["regSubDistric"] 		= $recSelectDataAssetDetail["TUM_NAME"];
			
		}else if($recSelectAssetMain["TYPE_CODE"]=='01'){
			
		}
		
		$datacase 		= json_encode($datacase);
		$array_asset 	= json_encode($dataAssetMain);

		$dataAsset 		= "brcaseId=".$brcId."&userDisplayName=aaaaaaaaa&proxyAssetBeanJson=".$datacase."&assetDocumentBeanJson=".$array_asset;

		$arrDataSend["data"] = $dataAsset;

		$data_string 	= json_encode($arrDataSend);

		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://103.40.146.73/LedService.php/sendAssetBankrupt',
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
		
		
		
	}
	
}else{

	$brcId = "21962";

	$datacase['systemType']      =  '6';
	$datacase['blackCaseCode']   =  'ล.3096/2562';
	$datacase['redCaseCode']     =  'ล.4467/2562';
	$datacase['courtName']       =  'ศาลล้มละลายกลาง';
	$datacase['propTitle']       =  'หุ้น ของ ธนาคารกรุงไทย จำกัด (มหาชน) จำนวน 50 หุ้น หุ้นละ 5.15 บาท';
	$datacase['propStatusCode']  =  '';//$query['PROP_STATUS'];
	$datacase['propStatusName']  =  '';//$query['PROP_STATUS_NAME'];

	$dataAssetMain["assetTypeCode"] = '09';
	$dataAssetMain['assetShareBean']['stockType']          =  '1';//$v['stockType'];
	$dataAssetMain['assetShareBean']['shareCategory']      =  '';//'$v['stockName'];
	$dataAssetMain['assetShareBean']['stockCer']           =  '01500100036990';//$v['stockNo'];
	$dataAssetMain['assetShareBean']['ownerRegNo']         =  '0009007257';//$v['holderLicenseNo'];
	$dataAssetMain['assetShareBean']['ownerCompanyname']   =  'ธนาคารกรุงไทย จำกัด (มหาชน)';//$v['holderLicenseNo'];
	$dataAssetMain['assetShareBean']['stockNo']            =  '';//$v['stockIdFrom'];
	$dataAssetMain['assetShareBean']['toTxt']              =  '';//$v['stockIdTo'];
	$dataAssetMain['assetShareBean']['amount']             =  '50';//$v['unitAmount'];
	$dataAssetMain['assetShareBean']['provinceCode']       =  '';//$v['provCode'];
	$dataAssetMain['assetShareBean']['districtCode']       =  '';//$v['ampCode'];
	$dataAssetMain['assetShareBean']['subDistrictCode']    =  '';//$v['tumCode'];
	$dataAssetMain['assetShareBean']['postCode']           =  '';//$v['postCode'];
	$dataAssetMain['assetShareBean']['remark']             =  '';//$v['propDet'];
	
	$datacase 		= json_encode($datacase);
	$array_asset 	= json_encode($dataAssetMain);

	$dataAsset 		= "brcaseId=".$brcId."&userDisplayName=aaaaaaaaa&proxyAssetBeanJson=".$datacase."&assetDocumentBeanJson=".$array_asset;

	$arrDataSend["data"] = $dataAsset;

	$data_string 	= json_encode($arrDataSend);

	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://103.40.146.73/LedService.php/sendAssetBankrupt',
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
	
}



?>