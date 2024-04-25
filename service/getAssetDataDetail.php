<?php
include '../include/include.php';

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'http://103.40.146.73/LedServiceCivilById.php/getCivilAsset',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS =>'{
		"USERNAME":"BankruptDt",
		"PASSWORD":"Debtor4321",
		"pccCivilGen":"'.$_GET["pccCivilGen"].'"
	}',
CURLOPT_HTTPHEADER => array(
'Content-Type: application/x-www-form-urlencoded'
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$dataReturn = json_decode($response,true);


$sqlSelectData = "	select 		WH_CIVIL_ID,PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,PREFIX_RED_CASE,RED_CASE,RED_YY,COURT_CODE
					from 		WH_CIVIL_CASE
					where 		CIVIL_CODE = '".$_GET["pccCivilGen"]."' "; 
$querySelectData = db::query($sqlSelectData);
$dataSelectData = db::fetch_array($querySelectData);


$dataAsset = $dataReturn["Data"]["asset"];

db::db_delete("WH_CIVIL_CASE_ASSETS_LAND",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_BUILDING",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_BUIL_RENT ",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_CONDO",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_LAND_RENT",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_STOCK",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_BOND",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_LOTTERY",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_CAR",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_GUN",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_MACHINE",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_OTHER",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

db::db_delete("WH_CIVIL_CASE_ASSETS_BOAT",array('ASSET_PREFIX_BLACK_CASE'=>$dataSelectData["PREFIX_BLACK_CASE"],'ASSET_BLACK_CASE'=>$dataSelectData["BLACK_CASE"],'ASSET_PBLACK_YY'=>$dataSelectData["BLACK_YY"],'ASSET_PREFIX_RED_CASE'=>$dataSelectData["PREFIX_RED_CASE"],'ASSET_RED_CASE'=>$dataSelectData["RED_CASE"],'ASSET_RED_YY'=>$dataSelectData["RED_YY"],'ASSET_COURT_CODE'=>$dataSelectData["COURT_CODE"]));

foreach($dataAsset as $key => $data){
	if($data["typeCode"]=='01'){
		$sqlSelectWhAsset = "	SELECT 	WH_ASSET_ID 
								FROM 	WH_CIVIL_CASE_ASSETS 
								WHERE 	ASSET_ID = '".$data["assetId"]."' 
										and TYPE_CODE = '".$data["typeCode"]."' ";
		$querySelectWhAsset = db::query($sqlSelectWhAsset);
		$dataSelectWhAsset = db::fetch_array($querySelectWhAsset);
		
		
		unset($fields);
			$fields["ASSET_CODE"] 		= $data["assetId"];
			$fields["ASSET_TYPE"] 		= $data["typeCode"];
			$fields["ASSET_DOC_TYPE"] 	= $data["detail"]["landType"];
			$fields["ASSET_STATUS"] 	= $data["propStatus"];
			$fields["BOOK_NO"] 			= $data["detail"]["bookNo"];
			$fields["PAGE_NO"] 			= $data["detail"]["pageNo"];
			$fields["FREIGHT"] 			= "";
			$fields["LAND_NO"] 				= $data["detail"]["landNo"];
			$fields["SURVEY_PAGE"] 			= $data["detail"]["survey"];
			$fields["TUM_NAME"] 			= $data["detail"]["districtName"];
			$fields["AMP_NAME"] 			= $data["detail"]["amphurName"];
			$fields["PROV_NAME"] 			= $data["detail"]["provinceName"];
			$fields["ZIP_CODE"] 			= "";
			
			$fields["AREA_RAI"] 			= $data["detail"]["farm"];
			$fields["AREA_NGAN"] 			= $data["detail"]["ngan"];
			$fields["AREA_WA"] 				= $data["detail"]["va"];
			
			$fields["AREA_FRACTION_WA"] 				= "";
			$fields["LAND_PRICE_PER_WA"] 				= "";
			$fields["LAND_PRICE"] 						= $data["detail"]["estPriceAmount"];
			$fields["DETAIL"] 							= $data["detail"]["landDesc"];
			$fields["RECORD_COUNT"] 					= "";
			$fields["DEED_NO"] 							= $data["detail"]["deedNo"];
			$fields["CENT_LOC_GEN"] 					= $data["detail"]["centLocGen"];
			$fields["MOO_NO"] 							= $data["detail"]["mooNo"];
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_LAND",$fields,'ASSET_ID','ASSET_ID');
		
		
		// echo $dataSelectWhAsset["WH_ASSET_ID"];
		// print_pre($data);
		// exit();
	}else if($data["typeCode"]=='02'){
		unset($fields);
			$fields["ASSET_CODE"] 						= $data["assetId"];
			$fields["ASSET_TYPE"] 						= $data["typeCode"];
			
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			
			//$fields["BUILDING_STYLE"] 					= $data["typeCode"];
			$fields["BUILDING_AREA_AMOUNT"] 			= $data["detail"]["area"];
			$fields["PRICE_SQUARE_MATER"] 				= $data["typeCode"];
			$fields["PRICE_BUILDING"] 					= $data["detail"]["estPriceAmount"];
			
			$fields["TUM_NAME"] 						= $data["detail"]["tumName"];
			$fields["AMP_NAME"] 						= $data["detail"]["ampName"];
			$fields["PROV_NAME"] 						= $data["detail"]["prvName"];
			
			$fields["LAND_TYPE"] 						= $data["detail"]["landType"];
			$fields["VILLAGE_NAME"] 					= $data["detail"]["villageName"];
			$fields["ADDR_NO"] 							= $data["detail"]["addrNo"];
			$fields["MOO_NO"] 							= $data["detail"]["mooNo"];
			$fields["SOI"] 								= $data["detail"]["soi"];
			$fields["ROAD"] 							= $data["detail"]["road"];
			$fields["CENT_LOC_GEN"] 					= $data["detail"]["centLocGen"];
			$fields["POST_CODE"] 						= $data["detail"]["postcode"];
			$fields["HOUSE_DESC"] 						= $data["detail"]["houseDesc"];
			$fields["WIDE"] 							= $data["detail"]["wide"];
			$fields["HOUSE_LONG"] 						= $data["detail"]["houseLong"];
			$fields["FLOOR"] 							= $data["detail"]["floor"];
		
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_BUILDING",$fields,'ASSET_ID','ASSET_ID');		
		
	}else if($data["typeCode"]=='03'){
		unset($fields);
			$fields["ASSET_CODE"] 						= $data["assetId"];
			$fields["ASSET_TYPE"] 						= $data["typeCode"];
			
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			
			$fields["BUILDING_VILLAGE"] 				= $data["detail"]["buildingName"];
			$fields["BUILDING_NO"] 						= $data["detail"]["buildingNo"];
			$fields["CONDO_FLOOR"] 						= $data["detail"]["floor"];
			$fields["CONDO_REGIS_NO"] 					= $data["detail"]["licenseNo"];
			$fields["CONDO_ADDR"] 						= $data["detail"]["addrNo"];
			$fields["TUM_NAME"] 						= $data["detail"]["tumName"];
			$fields["AMP_NAME"] 						= $data["detail"]["ampName"];
			$fields["PROV_NAME"] 						= $data["detail"]["prvName"];
			$fields["ZIP_CODE"] 						= $data["detail"]["postcode"];
			$fields["SOI"] 								= $data["detail"]["soi"];
			$fields["MOO_NO"] 							= $data["detail"]["mooNo"];
			$fields["ROAD"] 							= $data["detail"]["road"];
			$fields["FARM"] 							= $data["detail"]["farm"];
			$fields["NGAN"] 							= $data["detail"]["ngan"];
			$fields["VA"] 								= $data["detail"]["va"];
			$fields["REMAIN_VA"] 						= $data["detail"]["remainVa"];
			$fields["REMAIN_BASE"] 						= $data["detail"]["remainBase"];
			$fields["EST_AREA"] 						= $data["detail"]["estArea"];
			$fields["HIGHT"] 							= $data["detail"]["hight"];
			$fields["DEED_NO"] 							= $data["detail"]["deedNo"];
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_CONDO",$fields,'ASSET_ID','ASSET_ID');
			
	}else if($data["typeCode"]=='04'){
		unset($fields);
			$fields["ASSET_CODE"] 						= $data["assetId"];
			$fields["ASSET_TYPE"] 						= $data["typeCode"];
			
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			
			$fields["ASSET_DOC_TYPE"] 					= $data["detail"]["buildingName"];
			$fields["BOOK_NO"] 							= $data["detail"]["bookNo"];
			$fields["PAGE_NO"] 							= $data["detail"]["pageNo"];
			//$fields["FREIGHT"] 							= $data["detail"]["licenseNo"];
			$fields["LAND_NO"] 							= $data["detail"]["landNo"];
			$fields["SURVEY_PAGE"] 						= $data["detail"]["tumName"];
			$fields["TUM_NAME"] 						= $data["detail"]["survey"];
			$fields["AMP_NAME"] 						= $data["detail"]["ampName"];
			$fields["PROV_NAME"] 						= $data["detail"]["prvName"];
			$fields["ZIP_CODE"] 						= $data["detail"]["postcode"];
			$fields["AREA_RAI"] 						= $data["detail"]["farm"];
			$fields["AREA_NGAN"] 						= $data["detail"]["ngan"];
			$fields["AREA_WA"] 							= $data["detail"]["va"];
			$fields["AREA_FRACTION_WA"] 				= ($data["detail"]["remainVa"]/10);
			//$fields["LAND_PRICE_PER_WA"] 				= $data["detail"]["va"];
			$fields["LAND_PRICE"] 						= $data["detail"]["estPriceAmount"];
			$fields["DETAIL"] 							= $data["detail"]["rentComment"];
			//$fields["RECORD_COUNT"] 					= $data["detail"]["estArea"];
			$fields["LAND_TYPE"] 						= $data["detail"]["landType"];
			$fields["CONTACT_NO"] 						= $data["detail"]["contactNo"];
			$fields["DEED_NO"] 							= $data["detail"]["deedNo"];
			$fields["WIDE"] 							= $data["detail"]["wide"];
			$fields["HOUSE_LONG"] 						= $data["detail"]["houseLong"];
			$fields["FLOOR"] 							= $data["detail"]["floor"];
			$fields["AREA"] 							= $data["detail"]["area"];
			$fields["RENT_QTY"] 						= $data["detail"]["rentQty"];
			$fields["RENT_UNIT"] 						= $data["detail"]["rentUnit"];
			$fields["REMAIN_DAY"] 						= $data["detail"]["remainDay"];
			$fields["RATE_AMOUNT"] 						= $data["detail"]["rateAmount"];
			$fields["HOUSE_TYPE"] 						= $data["detail"]["houseType"];
			$fields["VILAGE_NAME2"] 					= $data["detail"]["villageName1"];
			$fields["SOI"] 								= $data["detail"]["soi"];
			$fields["MOO_NO"] 							= $data["detail"]["mooNo"];
			$fields["ROAD"] 							= $data["detail"]["road"];
			$fields["HOUSE_DESC"] 						= $data["detail"]["houseDesc"];
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_LAND_RENT",$fields,'ASSET_ID','ASSET_ID');
		
	}else if($data["typeCode"]=='05'){
		unset($fields);
			//$fields["ASSET_ID"] 						= $data["assetId"];
			$fields["ASSET_CODE"] 						= $data["assetId"];
			$fields["ASSET_TYPE"] 						= $data["typeCode"];
			
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			
			$fields["SEQ_NO"] 							= $data["detail"]["seqNo"];
			$fields["VILLAGE_NAME"] 					= $data["detail"]["villageName"];
			$fields["ADDR_NO"] 							= $data["detail"]["addrNo"];
			$fields["FLOOR"] 							= $data["detail"]["floor"];
			$fields["BUILDING_NO"] 						= $data["detail"]["buildingNo"];
			$fields["BUILDING_NAME"] 					= $data["detail"]["buildingName"];
			$fields["LICENSE_NO"] 						= $data["detail"]["licenseNo"];
			$fields["DEED_NO"] 							= $data["detail"]["deedNo"];
			$fields["SOI"] 								= $data["detail"]["soi"];
			$fields["MOO_NO"] 							= $data["detail"]["mooNo"];
			$fields["ROAD"] 							= $data["detail"]["road"];
			$fields["FARM"] 							= $data["detail"]["farm"];
			$fields["NGAN"] 							= $data["detail"]["ngan"];
			$fields["VA"] 								= $data["detail"]["va"];
			$fields["REMAIN_VA"] 						= $data["detail"]["remainVa"];
			$fields["REMAIN_BASE"] 						= $data["detail"]["remainBase"];
			$fields["CONTACT_NO"] 						= $data["detail"]["contactNo"];
			$fields["CONTACT_DATE"] 					= substr($data["detail"]["contactDate"],0,10);
			$fields["EXPIRE_DATE"] 						= substr($data["detail"]["expireDate"],0,10);
			$fields["RENT_QTY"] 						= $data["detail"]["rentQty"];
			$fields["RENT_UNIT"] 						= $data["detail"]["rentUnit"];
			$fields["REMAIN_DAY"] 						= $data["detail"]["remainDay"];
			$fields["RATE_AMOUNT"] 						= $data["detail"]["rateAmount"];
			$fields["UNIT_AMOUNT"] 						= $data["detail"]["unitAmount"];
			$fields["UNIT_PERIOD"] 						= $data["detail"]["unitPeriod"];
			$fields["REMAIN_YR"] 						= $data["detail"]["remainYr"];
			$fields["REMAIN_MM"] 						= $data["detail"]["remainMm"];
			$fields["REMAIN_DD"] 						= $data["detail"]["remainDd"];
			$fields["EST_UNIT_AMOUNT"] 					= $data["detail"]["estUnitAmount"];
			$fields["EST_RENT_AMOUNT"] 					= $data["detail"]["estRentAmount"];
			$fields["START_AMOUNT"] 					= $data["detail"]["startAmount"];
			$fields["EST_START_AMOUNT"] 				= $data["detail"]["estStartAmount"];
			$fields["ADD_PERCENT"] 						= $data["detail"]["addPercent"];
			$fields["ADD_AMOUNT"] 						= $data["detail"]["addAmount"];
			$fields["MINUS_PERCENT"] 					= $data["detail"]["minusPercent"];
			$fields["RENT_COMMENT"] 					= $data["detail"]["rentComment"];
			$fields["EST_PRICE_AMOUNT"] 				= $data["detail"]["estPriceAmount"];
			$fields["WIDE"] 							= $data["detail"]["wide"];
			$fields["LONGS"] 							= $data["detail"]["longs"];
			$fields["VERANDA_WIDE"] 					= $data["detail"]["verandaWide"];
			$fields["AREA"] 							= $data["detail"]["area"];
			$fields["BUILDING_REGISTRATION_FLAG"] 		= $data["detail"]["buildingRegistrationFlag"];
			$fields["BUILDING_TRAIN_FLAG"] 				= $data["detail"]["buildingTrainFlag"];
			$fields["TUM_NAME"] 						= $data["detail"]["districtName"];
			$fields["AMP_NAME"] 						= $data["detail"]["amphurName"];
			$fields["PROV_NAME"] 						= $data["detail"]["provinceName"];
			$fields["ZIP_CODE"] 						= $data["detail"]["postcode"];
			$fields["HOUSE_DESC"] 						= $data["detail"]["houseDesc"];
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_BUIL_RENT",$fields,'ASSET_ID','ASSET_ID');
		
	}else if($data["typeCode"]=='08'){
		unset($fields);
			//$fields["ASSET_ID"] 						= $data["assetId"];
			$fields["ASSET_CODE"] 						= $data["assetId"];
			$fields["ASSET_TYPE"] 						= $data["typeCode"];
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			
			$fields["STOCK_TYPE"] 						= $data["detail"]["stockType"];
			$fields["STOCK_NO"] 						= $data["detail"]["stockNo"];
			
			$fields["STOCK_NO_TO"] 						= $data["detail"]["addrNo"];
			
			$fields["COMPANY_GEN"] 						= $data["detail"]["companyGen"];
			$fields["STOCK_NAME"] 						= $data["detail"]["stockName"];
			$fields["MARKET_CAPITALIZATION"] 			= $data["detail"]["unitAmount"];
			$fields["MANAGER_STOCK_NAME"] 				= $data["detail"]["managerStockName"];
			$fields["STOCK_QTY"] 						= $data["detail"]["stockQty"];
			$fields["STOCK_DATE"] 						= substr($data["detail"]["stockDate"],0,10);
			$fields["STOCK_IN_OUT"] 					= $data["detail"]["stockInOut"];
			$fields["STOCK_COMMENT"] 					= $data["detail"]["stockComment"];
			$fields["STOCK_ID"] 						= $data["detail"]["stockNo"];
			$fields["HOLDER_LICENSE_NO"] 				= $data["detail"]["holderLicenseNo"];
			$fields["UNIT_AMOUNT"] 						= $data["detail"]["unitAmount"];
			$fields["TOTAL_AMOUNT"] 					= $data["detail"]["totalAmount"];
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_STOCK",$fields,'ASSET_ID','ASSET_ID');
		
	}else if($data["typeCode"]=='09' || $data["tableName"]=='CFC_BONDS'){
		unset($fields);
			$fields["ASSET_CODE"] 						= $data["assetId"];
			$fields["BOND_NAME"] 						= $data["detail"]["bondsName"];
			$fields["START_NO"] 						= $data["detail"]["bondsNo"];
			$fields["END_NO"] 							= $data["detail"]["bondsNoTo"];
			$fields["DUEDATE"] 							= substr($data["detail"]["fromDate"],0,10);
			$fields["NO_UNIT"] 							= $data["detail"]["unitAmount"];
			$fields["PRICE_UNIT"] 						= $data["detail"]["estPriceAmount"];
			$fields["PRICE_SUM"] 						= ($data["detail"]["unitAmount"]*$data["detail"]["estPriceAmount"]);
			//$fields["BOND_ISSUER"] 						= $data["detail"]["bondsId"];
			$fields["BONDS_ID"] 						= $data["detail"]["bondsId"];
			$fields["BONDS_NO"] 						= $data["detail"]["bondsNo"];
			//$fields["BONDS_PERSON_GEN"] 				= $data["detail"]["bondsNo"];
			$fields["ISIN_CODE"] 						= $data["detail"]["isinCode"];
			$fields["BOND_PERSON_NAME"] 				= $data["owner"][0]["personFullName"];
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_BOND",$fields,'ASSET_ID','ASSET_ID');
	}else if($data["typeCode"]=='10'){
		unset($fields);
			$fields["ASSET_CODE"] 						= $data["assetId"];
			$fields["ASSET_TYPE"] 						= $data["typeCode"];
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			$fields["LOTTERY_NAME"] 					= $data["detail"]["saveName"];
			$fields["BRANCE"] 							= $data["detail"]["saveOffice"];
			$fields["START_NO"] 						= $data["detail"]["saveNoFr"];
			$fields["END_NO"] 							= $data["detail"]["saveNoTo"];
			$fields["DUEDATE"] 							= substr($data["detail"]["saveDeadLineDate"],0,10);
			$fields["NO_UNIT"] 							= $data["detail"]["saveUnit"];
			$fields["PRICE_UNIT"] 						= $data["detail"]["saveUnitPri"];
			$fields["PRICE_SUM"] 						= $data["detail"]["saveAmt"];
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_LOTTERY",$fields,'ASSET_ID','ASSET_ID');
		
	}else if($data["typeCode"]=='11'){
		unset($fields);
			$fields["ASSET_CODE"]						= $data["assetId"];
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			
			$fields["TUM_NAME"] 						= $data["detail"]["tumName"];
			$fields["AMP_NAME"] 						= $data["detail"]["ampName"];
			$fields["PROV_NAME"] 						= $data["detail"]["prvName"];
			$fields["ZIP_CODE"] 						= $data["detail"]["postcode"];
			$fields["VEHICLE_TYPE"] 					= $data["detail"]["vehicleType"];
			//$fields["TYPE"] 						= $data["detail"]["saveNoTo"];
			$fields["NATURE"] 							= $data["detail"]["stardardDesc"];
			$fields["BRAND"] 							= $data["detail"]["brandType"];
			$fields["MODEL"] 							= $data["detail"]["model"];
			$fields["TANK_NO"] 							= $data["detail"]["bodyNo"];
			$fields["FUEL"] 							= $data["detail"]["fuelName"];
			$fields["PUMPING_COUNT"] 					= $data["detail"]["soopQty"];
			$fields["HORSE_POWER_COUNT"] 				= $data["detail"]["horsePower"];
			$fields["AXLES_COUNT"] 						= $data["detail"]["axleQty"];
			$fields["WHEELS_COUNT"] 					= $data["detail"]["wheelQty"];
			$fields["TIRE_COUNT"] 						= $data["detail"]["wheelQty"];
			$fields["PROVINCE"] 						= $data["detail"]["licensePlace"];
			$fields["OWNER"] 							= $data["detail"]["classDesc"];
			//$fields["GENERTION_YEAR"] 						= $data["detail"]["saveNoTo"];
			$fields["COLOR"] 							= $data["detail"]["colour"];
			$fields["ENGINE_BRAND"] 					= $data["detail"]["engineBrand"];
			$fields["ENGINE_NO"] 						= $data["detail"]["engineNo"];
			$fields["PLATE_NO1"] 						= $data["detail"]["plateNo1"];
			$fields["PLATE_NO2"] 						= $data["detail"]["plateNo2"];
			
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_CAR",$fields,'ASSET_ID','ASSET_ID');
		
	}else if($data["typeCode"]=='12'){
		print_pre($data);
		unset($fields);
			$fields["ASSET_CODE"]						= $data["assetId"];
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			$fields["ASSET_TYPE"] 						= $data["typeCode"];
			
			//$fields["BOAT_NO"] 							= $data["detail"]["tumName"];
			$fields["BOAT_NAME"] 						= $data["detail"]["boatName"];
			$fields["PRICE"] 							= $data["detail"]["estPriceAmount"];
			$fields["BOAT_ID"] 							= $data["detail"]["boatId"];
			$fields["BOAT_TYPE"] 						= $data["detail"]["boatType"];
			$fields["FLAG_NAME"] 						= $data["detail"]["flagName"];
			$fields["PORT_NAME"] 						= $data["detail"]["portName"];
			$fields["BOAT_COMMENT"] 					= $data["detail"]["boatComment"];
			$fields["CHECK_COMMENT"] 					= $data["detail"]["checkComment"];
					
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_BOAT",$fields,'ASSET_ID','ASSET_ID');
		
	
	}else if($data["typeCode"]=='13'){
		
		unset($fields);
			$fields["ASSET_CODE"]						= $data["assetId"];
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			
			$fields["TUM_NAME"] 						= $data["detail"]["tumName"];
			$fields["AMP_NAME"] 						= $data["detail"]["ampName"];
			$fields["PROV_NAME"] 						= $data["detail"]["prvName"];
			$fields["ZIP_CODE"] 						= $data["detail"]["postcode"];
			$fields["MACHINE_NAME"] 					= $data["detail"]["machineName"];
			$fields["MACHINE_SIZE"] 					= $data["detail"]["machineSize"];
			$fields["BRAND_NAME"] 						= $data["detail"]["brandName"];
			$fields["COLOUR"] 							= $data["detail"]["colour"];
			$fields["MACHINE_MODEL"] 					= $data["detail"]["machineModel"];
			$fields["ENGINE_NO"] 						= $data["detail"]["engineNo"];
			$fields["LICENSE_NO"] 						= $data["detail"]["licenseNo"];
			$fields["MACHINE_COMMENT"] 					= $data["detail"]["machineComment"];
			$fields["ADDR_NO"] 							= $data["detail"]["addrNo"];
			$fields["MOO_NO"] 							= $data["detail"]["mooNo"];
			$fields["PROJECT_NAME"] 					= $data["detail"]["projectName"];
			$fields["FLOOR"] 							= $data["detail"]["floor"];
			$fields["SOI"] 								= $data["detail"]["soi"];
			$fields["ROAD"] 							= $data["detail"]["road"];			
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_MACHINE",$fields,'ASSET_ID','ASSET_ID');
		
	}else if($data["typeCode"]=='14'){
		unset($fields);
			$fields["ASSET_CODE"]						= $data["assetId"];
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			$fields["GUN_TYPE"] 						= $data["detail"]["typeDesc"];
			//$fields["GUN_MODEL"] 						= $data["detail"]["colour"];
			$fields["GUN_BRAND"] 						= $data["detail"]["brandName"];
			$fields["AMMUNITION_SIZE"] 					= $data["detail"]["bulletDesc"];
			//$fields["GUN_COLOR"] 						= $data["detail"]["colour"];
			$fields["GUN_SIZE"] 						= $data["detail"]["gunSize"];
			//$fields["BARREL_SIZE"] 						= $data["detail"]["colour"];
			$fields["BULLET_SIZE"] 						= $data["detail"]["accessoryDesc"];
			$fields["GUN_NO"] 							= $data["detail"]["gunNo"];
			
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_GUN",$fields,'ASSET_ID','ASSET_ID');
	}else if($data["typeCode"]=='99'){
		unset($fields);
			$fields["ASSET_CODE"]						= $data["assetId"];
			$fields["ASSET_STATUS"] 					= $data["propStatus"];
			
			$fields["TUM_NAME"] 						= $data["detail"]["tumName"];
			$fields["AMP_NAME"] 						= $data["detail"]["ampName"];
			$fields["PROV_NAME"] 						= $data["detail"]["prvName"];
			$fields["ZIP_CODE"] 						= $data["detail"]["postcode"];
			$fields["ASSET_NAME"] 						= $data["detail"]["capName"];
			$fields["ASSET_AMOUNT"] 					= $data["detail"]["capQty"];
			$fields["ADDRESS"] 							= $data["detail"]["addrNo"];
			
			
			$fields["ASSET_PREFIX_BLACK_CASE"] 			= $dataSelectData["PREFIX_BLACK_CASE"];
			$fields["ASSET_BLACK_CASE"] 				= $dataSelectData["BLACK_CASE"];
			$fields["ASSET_PBLACK_YY"] 					= $dataSelectData["BLACK_YY"];
			$fields["ASSET_PREFIX_RED_CASE"] 			= $dataSelectData["PREFIX_RED_CASE"];
			$fields["ASSET_RED_CASE"] 					= $dataSelectData["RED_CASE"];
			$fields["ASSET_RED_YY"] 					= $dataSelectData["RED_YY"];
			$fields["ASSET_COURT_CODE"] 				= $dataSelectData["COURT_CODE"];
		$ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS_OTHER",$fields,'ASSET_ID','ASSET_ID');
	}
	
	
}

?>