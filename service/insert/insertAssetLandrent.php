<?php
include '../include/include.php';
 

$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);

	
	$sql = "SELECT DOSS_ID FROM WH_CIVIL_DOSS WHERE DOSS_CONTROL_GEN = '".$data['pccDossControlGen']."'";
	$query = db::query($sql);
	$rec = db::fetch_array($query);
 
	$DOSS_ID = $rec['DOSS_ID'];
	
	$sql = "SELECT WH_CIVIL_ID FROM WH_CIVIL_CASE WHERE CIVIL_CODE = '".$data['civilCode']."'";
	$query = db::query($sql);
	$rec = db::fetch_array($query);
 
	$WH_CIVIL_ID = $rec['WH_CIVIL_ID'];
	
	
	$sql = "SELECT COUNT(*) AS NR FROM WH_CIVIL_CASE_ASSETS_LAND_RENT WHERE ASSET_CODE = '".$data['cfcLandRentRightGen']."'";
	$query = db::query($sql);
	$rec = db::fetch_array($query);
	
	if($rec['NR'] > 0){
		
		$update = array();
		
     
        $update['ASSET_TYPE'] 	        =  $data['rentType'];
        $update['ASSET_DOC_TYPE'] 	    =  $data['assetDocType'];
		$update['ASSET_STATUS']   	    =  $data['assetStatus'];
        $update['BOOK_NO']              =  $data['bookNo'];    	
        $update['PAGE_NO']              =  $data['pageNo'];	
        $update['FREIGHT']              =  $data['freight'];	
        $update['LAND_NO']              =  $data['landNo'];	
        $update['SURVEY_PAGE']          =  $data['survey'];
        $update['TUM_CODE'] 	  	    =  $data['tumCode'];	 
		$update['TUM_NAME'] 	  	    =  $data['tumName'];
		$update['AMP_CODE'] 	  	    =  $data['ampCode'];
		$update['AMP_NAME'] 	  	    =  $data['ampName'];
		$update['PROV_CODE'] 	  	    =  $data['provCode'];
		$update['PROV_NAME'] 	  	    =  $data['provName'];
		$update['ZIP_CODE'] 	  	    =  $data['zipCode'];
        $update['OLD_TUM_NAME']         =  $data['districtName'];    
        $update['OLD_AMP_NAME']         =  $data['amphurName'];
        $update['OLD_PROV_NAME']        =  $data['provinceName'];
        $update['AREA_RAI']             =  $data['farm'];
        $update['AREA_NGAN']            =  $data['ngan'];
        $update['AREA_WA']              =  $data['wa'];
        $update['AREA_FRACTION_WA']     =  $data['areaFractionWa'];
        $update['LAND_PRICE_PER_WA']    =  $data['estUnitAmount'];    
        $update['LAND_PRICE']           =  $data['landPrice'];
        $update['DETAIL']               =  $data['propDet'];
        $update['RECORD_COUNT']         =  $data['recordCount'];
        $update['LAND_TYPE']            =  $data['landType'];
        $update['CONTACT_NO']           =  $data['contactNo'];
        $update['DEED_NO']              =  $data['deedNo'];    
        $update['WIDE']                 =  $data['wide'];
        $update['HOUSE_LONG']           =  $data['houseLong'];
        $update['FLOOR']                =  $data['floor'];
        $update['AREA']                 =  $data['area'];
        $update['RENT_QTY']             =  $data['rentQty'];
        $update['RENT_UNIT']            =  $data['rentUnit'];
        $update['REMAIN_DAY']           =  $data['remainDay'];    
        $update['RATE_AMOUNT']          =  $data['rateAmount'];
        $update['HOUSE_TYPE']           =  $data['houseType'];
        $update['VILAGE_NAME2']         =  $data['vilageName2'];
        $update['SOI']                  =  $data['soi'];
        $update['MOO_NO']               =  $data['mooNo'];
        $update['ROAD']                 =  $data['road'];
        $update['HOUSE_DESC']           =  $data['houseDesc']; 

		$cond = array();
		
		$cond['ASSET_CODE']			 = $data['cfcLandRentRightGen'];
		
		db::db_update("WH_CIVIL_CASE_ASSETS_LAND_RENT",$update,$cond);
		
		$personMapArr = $data['personMap'];
		
		if(isset($personMapArr)){
			
			foreach($personMapArr as $key => $value){
		
				$sql = "SELECT WH_PERSON_ID FROM WH_CIVIL_CASE_PERSON WHERE PERSON_CODE = '".$value['personCode']."'";
				$query = db::query($sql);
				$countPerson = db::num_rows($query);
				
				if( $countPerson > 0 ){
					
					$rec = db::fetch_array($query);
					
					$WH_PERSON_ID = $rec['WH_PERSON_ID'];
					
					$personMap = array();
			
					$personMap['PREFIX_NAME']		= $value['prefixName'];
					$personMap['FIRST_NAME']		= $value['firstName'];
					$personMap['LAST_NAME']			= $value['lastName'];
					$personMap['FULLNAME']			= $value['fullName'];
					$personMap['PERSONTYPE']		= $value['personType'];
					$personMap['SEX']				= $value['sex'];
					$personMap['RACE']				= $value['race'];
					$personMap['NATIONALITY']		= $value['nationality'];
					
					$cond = array();
				
					$cond['WH_PERSON_ID']			= $WH_PERSON_ID;
					
					db::db_update("WH_CIVIL_CASE_PERSON",$personMap,$cond);
					
				}else{
					
					$personMap = array();
			
					$personMap['PREFIX_NAME']		= $value['prefixName'];
					$personMap['FIRST_NAME']		= $value['firstName'];
					$personMap['LAST_NAME']			= $value['lastName'];
					$personMap['FULLNAME']			= $value['fullName'];
					$personMap['PERSONTYPE']		= $value['personType'];
					$personMap['SEX']				= $value['sex'];
					$personMap['RACE']				= $value['race'];
					$personMap['NATIONALITY']		= $value['nationality'];
					$personMap['PERSON_CODE']		= $value['personCode'];
					
					$WH_PERSON_ID = db::db_update("WH_CIVIL_CASE_PERSON",$personMap,'WH_PERSON_ID','WH_PERSON_ID');  
					
				}
				
				$cond = array();
				
				$cond['WH_PERSON_ID']			= $WH_PERSON_ID;
					
				db::db_delete("WH_CIVIL_CASE_PERSON_ADDR",$cond);
				
				$personMapAddrArr = $value['addressMap'];
				
				if(isset($personMapAddrArr)){
					
					foreach($personMapAddrArr as $key2 => $value2){
						
						$personMapAddr = array();
						
						$personMapAddr['ADDRESS']			= $value2['address'];
						$personMapAddr['TUM_CODE']			= $value2['tumCode'];
						$personMapAddr['TUM_NAME']			= $value2['tumName'];
						$personMapAddr['AMP_CODE']			= $value2['ampCode'];
						$personMapAddr['AMP_CODE']			= $value2['ampName'];
						$personMapAddr['PROV_CODE']			= $value2['provCode'];
						$personMapAddr['PROV_NAME']			= $value2['provName'];
						$personMapAddr['ZIP_CODE']			= $value2['zipCode'];
						$personMapAddr['REQ']				= '';
						$personMapAddr['MOO']				= $value2['moo'];
						$personMapAddr['SOI']				= '';
						$personMapAddr['ROAD']				= '';
						$personMapAddr['ADDR_REQ']			= '';
						$personMapAddr['ADDR_FINAL_FLAG']	= $value2['addrFinalFlag'];
						$personMapAddr['WH_PERSON_ID']		= $WH_PERSON_ID;
						$personMapAddr['CENT_LOC_GEN']		= $value2['centLocGen'];
						
						$WH_PER_ADDR_ID = db::db_insert("WH_CIVIL_CASE_PERSON_ADDR",$personMapAddr,'WH_PER_ADDR_ID','WH_PER_ADDR_ID');
					}
				}
				
				$sql = "SELECT WH_MAP_CASE_GEN_ID FROM WH_CIVIL_CASE_MAP_GEN WHERE WH_MAP_CASE_GEN_ID = '".$WH_MAP_CASE_GEN_ID."' AND WH_PERSON_ID = '".$WH_PERSON_ID."' ";
				$query = db::query($sql);
				$countCivilMap = db::num_rows($query);
				
				if($countCivilMap > 0 ){
					
					$rec = db::fetch_array($query);
					
					$WH_MAP_CASE_GEN_ID = $rec['WH_MAP_CASE_GEN_ID'];
					
					$civilMapCase = array();
					
					$civilMapCase['CONCERN_CODE']	= $value['concernCode'];
					$civilMapCase['CONCERN_NAME']	= $value['concernName'];
					$civilMapCase['CONCERN_NO']		= '';
					
					$cond = array();
					
					$cond['WH_MAP_CASE_GEN_ID']		= $WH_MAP_CASE_GEN_ID;
					
					db::update("WH_CIVIL_CASE_MAP_GEN",$civilMapCase,$cond);
				
				}else{
					
					$civilMapCase = array();
					
					$civilMapCase['CONCERN_CODE']	= $value['concernCode'];
					$civilMapCase['CONCERN_NAME']	= $value['concernName'];
					$civilMapCase['CONCERN_NO']		= '';
					$civilMapCase['WH_CIVIL_ID']	= $WH_CIVIL_ID;
					$civilMapCase['WH_PERSON_ID']	= $WH_PERSON_ID;
					
					$WH_MAP_CASE_GEN_ID = db::update("WH_CIVIL_CASE_MAP_GEN",$civilMapCase,'WH_MAP_CASE_GEN_ID','WH_MAP_CASE_GEN_ID');
					
				}
				
				$cond = array();
			
				$cond['WH_MAP_CASE_GEN_ID']		= $WH_MAP_CASE_GEN_ID;
				$cond['WH_ASSET_ID']			= $WH_ASSET_ID;
				
				db::db_delete("WH_CIVIL_CASE_ASSET_OWNER",$cond);
					
				$ownerAsset = array();
				
				$ownerAsset['WH_MAP_CASE_GEN_ID']	= $WH_MAP_CASE_GEN_ID;
				$ownerAsset['WH_ASSET_ID']			= $WH_ASSET_ID;
				$ownerAsset['HOLDING_GROUP']		= $value['holdingGroup'];
				$ownerAsset['HOLDING_TYPE']			= $value['holdingType'];
				$ownerAsset['HOLDING_AMOUNT']		= $value['holdingAmount'];
				
				db::db_insert("WH_CIVIL_CASE_ASSET_OWNER",$ownerAsset,'WH_OWNER_ASSET_ID');
						
			}

		}	
		
	}else{
		
		
		$insert = array();

		$insert['ASSET_CODE']	        = $data['cfcLandRentRightGen'];
        $insert['ASSET_TYPE'] 	        =  $data['rentType'];
        $insert['ASSET_DOC_TYPE'] 	    =  $data['assetDocType'];
		$insert['ASSET_STATUS']   	    =  $data['assetStatus'];
        $insert['BOOK_NO']              =  $data['bookNo'];    	
        $insert['PAGE_NO']              =  $data['pageNo'];	
        $insert['FREIGHT']              =  $data['freight'];	
        $insert['LAND_NO']              =  $data['landNo'];	
        $insert['SURVEY_PAGE']          =  $data['survey'];
        $insert['TUM_CODE'] 	  	    =  $data['tumCode'];	 
		$insert['TUM_NAME'] 	  	    =  $data['tumName'];
		$insert['AMP_CODE'] 	  	    =  $data['ampCode'];
		$insert['AMP_NAME'] 	  	    =  $data['ampName'];
		$insert['PROV_CODE'] 	  	    =  $data['provCode'];
		$insert['PROV_NAME'] 	  	    =  $data['provName'];
		$insert['ZIP_CODE'] 	  	    =  $data['zipCode'];
        $insert['OLD_TUM_NAME']         =  $data['districtName'];    
        $insert['OLD_AMP_NAME']         =  $data['amphurName'];
        $insert['OLD_PROV_NAME']        =  $data['provinceName'];
        $insert['AREA_RAI']             =  $data['farm'];
        $insert['AREA_NGAN']            =  $data['ngan'];
        $insert['AREA_WA']              =  $data['wa'];
        $insert['AREA_FRACTION_WA']     =  $data['areaFractionWa'];
        $insert['LAND_PRICE_PER_WA']    =  $data['estUnitAmount'];    
        $insert['LAND_PRICE']           =  $data['landPrice'];
        $insert['DETAIL']               =  $data['propDet'];
        $insert['RECORD_COUNT']         =  $data['recordCount'];
        $insert['LAND_TYPE']            =  $data['landType'];
        $insert['CONTACT_NO']           =  $data['contactNo'];
        $insert['DEED_NO']              =  $data['deedNo'];    
        $insert['WIDE']                 =  $data['wide'];
        $insert['HOUSE_LONG']           =  $data['houseLong'];
        $insert['FLOOR']                =  $data['floor'];
        $insert['AREA']                 =  $data['area'];
        $insert['RENT_QTY']             =  $data['rentQty'];
        $insert['RENT_UNIT']            =  $data['rentUnit'];
        $insert['REMAIN_DAY']           =  $data['remainDay'];    
        $insert['RATE_AMOUNT']          =  $data['rateAmount'];
        $insert['HOUSE_TYPE']           =  $data['houseType'];
        $insert['VILAGE_NAME2']         =  $data['vilageName2'];
        $insert['SOI']                  =  $data['soi'];
        $insert['MOO_NO']               =  $data['mooNo'];
        $insert['ROAD']                 =  $data['road'];
        $insert['HOUSE_DESC']           =  $data['houseDesc'];    
		
		db::db_insert("WH_CIVIL_CASE_ASSETS_LAND_RENT",$insert,'ASSET_ID','ASSET_ID');
		
		
		$insertMap = array();
		
		$insertMap['ASSET_ID']			= $data['assetMap']['cfcTypeCodeGen'];
		$insertMap['PROP_TITLE']		= $data['assetMap']['propDet'];
		$insertMap['PROP_STATUS']		= $data['assetMap']['assetStatus'];
		$insertMap['PROP_STATUS_NAME']	= $data['assetMap']['propStatusName'];
		$insertMap['EST_VANG_SUB']		= $data['assetMap']['estVangSub'];
		$insertMap['EST_GROUP_AMOUNT']	= $data['assetMap']['estGroupAmount'];
		$insertMap['EST_SUB_AMOUNT']	= $data['assetMap']['estSubAmount'];
		$insertMap['EST_DOL']			= $data['assetMap']['estDol'];
		$insertMap['EST_PRICE_AMOUNT']	= $data['assetMap']['estPriceAmount'];
		$insertMap['SALE_PRICE']		= $data['assetMap']['salePrice'];
		$insertMap['COMMIT_TYPE']		= $data['assetMap']['commitType'];
		$insertMap['DATE_SALE']			= $data['assetMap']['dateSale'];
		$insertMap['ADDRESS']			= $data['assetMap']['centDept']['addr'];
		$insertMap['TYPE_CODE']			= $data['assetMap']['cfctType']['typeCode'];
		$insertMap['CFC_CAPTION_GEN']	= $data['assetMap']['cfcCaptionGen'];
		$insertMap['DOSS_ID']			= $DOSS_ID;
		$insertMap['WH_CIVIL_ID']		= $WH_CIVIL_ID;
		
		db::db_insert("WH_CIVIL_CASE_ASSETS",$insertMap,'WH_ASSET_ID','WH_ASSET_ID');
		
		$personMapArr = $data['personMap'];
		
		if(isset($personMapArr)){
			
			foreach($personMapArr as $key => $value){
		
				$sql = "SELECT WH_PERSON_ID FROM WH_CIVIL_CASE_PERSON WHERE PERSON_CODE = '".$value['personCode']."'";
				$query = db::query($sql);
				$countPerson = db::num_rows($query);
				
				if( $countPerson > 0 ){
					
					$rec = db::fetch_array($query);
					
					$WH_PERSON_ID = $rec['WH_PERSON_ID'];
					
					$personMap = array();
			
					$personMap['PREFIX_NAME']		= $value['prefixName'];
					$personMap['FIRST_NAME']		= $value['firstName'];
					$personMap['LAST_NAME']			= $value['lastName'];
					$personMap['FULLNAME']			= $value['fullName'];
					$personMap['PERSONTYPE']		= $value['personType'];
					$personMap['SEX']				= $value['sex'];
					$personMap['RACE']				= $value['race'];
					$personMap['NATIONALITY']		= $value['nationality'];
					
					$cond = array();
				
					$cond['WH_PERSON_ID']			= $WH_PERSON_ID;
					
					db::db_update("WH_CIVIL_CASE_PERSON",$personMap,$cond);
					
				}else{
					
					$personMap = array();
			
					$personMap['PREFIX_NAME']		= $value['prefixName'];
					$personMap['FIRST_NAME']		= $value['firstName'];
					$personMap['LAST_NAME']			= $value['lastName'];
					$personMap['FULLNAME']			= $value['fullName'];
					$personMap['PERSONTYPE']		= $value['personType'];
					$personMap['SEX']				= $value['sex'];
					$personMap['RACE']				= $value['race'];
					$personMap['NATIONALITY']		= $value['nationality'];
					$personMap['PERSON_CODE']		= $value['personCode'];
					
					$WH_PERSON_ID = db::db_update("WH_CIVIL_CASE_PERSON",$personMap,'WH_PERSON_ID','WH_PERSON_ID');  
					
				}
				
				$cond = array();
				
				$cond['WH_PERSON_ID']			= $WH_PERSON_ID;
					
				db::db_delete("WH_CIVIL_CASE_PERSON_ADDR",$cond);
				
				$personMapAddrArr = $value['addressMap'];
				
				if(isset($personMapAddrArr)){
					
					foreach($personMapAddrArr as $key2 => $value2){
						
						$personMapAddr = array();
						
						$personMapAddr['ADDRESS']			= $value2['address'];
						$personMapAddr['TUM_CODE']			= $value2['tumCode'];
						$personMapAddr['TUM_NAME']			= $value2['tumName'];
						$personMapAddr['AMP_CODE']			= $value2['ampCode'];
						$personMapAddr['AMP_CODE']			= $value2['ampName'];
						$personMapAddr['PROV_CODE']			= $value2['provCode'];
						$personMapAddr['PROV_NAME']			= $value2['provName'];
						$personMapAddr['ZIP_CODE']			= $value2['zipCode'];
						$personMapAddr['REQ']				= '';
						$personMapAddr['MOO']				= $value2['moo'];
						$personMapAddr['SOI']				= '';
						$personMapAddr['ROAD']				= '';
						$personMapAddr['ADDR_REQ']			= '';
						$personMapAddr['ADDR_FINAL_FLAG']	= $value2['addrFinalFlag'];
						$personMapAddr['WH_PERSON_ID']		= $WH_PERSON_ID;
						$personMapAddr['CENT_LOC_GEN']		= $value2['centLocGen'];
						
						$WH_PER_ADDR_ID = db::db_insert("WH_CIVIL_CASE_PERSON_ADDR",$personMapAddr,'WH_PER_ADDR_ID','WH_PER_ADDR_ID');
					}
				}
				
				$sql = "SELECT WH_MAP_CASE_GEN_ID FROM WH_CIVIL_CASE_MAP_GEN WHERE WH_MAP_CASE_GEN_ID = '".$WH_MAP_CASE_GEN_ID."' AND WH_PERSON_ID = '".$WH_PERSON_ID."' ";
				$query = db::query($sql);
				$countCivilMap = db::num_rows($query);
				
				if($countCivilMap > 0 ){
					
					$rec = db::fetch_array($query);
					
					$WH_MAP_CASE_GEN_ID = $rec['WH_MAP_CASE_GEN_ID'];
					
					$civilMapCase = array();
					
					$civilMapCase['CONCERN_CODE']	= $value['concernCode'];
					$civilMapCase['CONCERN_NAME']	= $value['concernName'];
					$civilMapCase['CONCERN_NO']		= '';
					
					$cond = array();
					
					$cond['WH_MAP_CASE_GEN_ID']		= $WH_MAP_CASE_GEN_ID;
					
					db::update("WH_CIVIL_CASE_MAP_GEN",$civilMapCase,$cond);
				
				}else{
					
					$civilMapCase = array();
					
					$civilMapCase['CONCERN_CODE']	= $value['concernCode'];
					$civilMapCase['CONCERN_NAME']	= $value['concernName'];
					$civilMapCase['CONCERN_NO']		= '';
					$civilMapCase['WH_CIVIL_ID']	= $WH_CIVIL_ID;
					$civilMapCase['WH_PERSON_ID']	= $WH_PERSON_ID;
					
					$WH_MAP_CASE_GEN_ID = db::update("WH_CIVIL_CASE_MAP_GEN",$civilMapCase,'WH_MAP_CASE_GEN_ID','WH_MAP_CASE_GEN_ID');
					
				}
				
				$cond = array();
			
				$cond['WH_MAP_CASE_GEN_ID']		= $WH_MAP_CASE_GEN_ID;
				$cond['WH_ASSET_ID']			= $WH_ASSET_ID;
				
				db::db_delete("WH_CIVIL_CASE_ASSET_OWNER",$cond);
					
				$ownerAsset = array();
				
				$ownerAsset['WH_MAP_CASE_GEN_ID']	= $WH_MAP_CASE_GEN_ID;
				$ownerAsset['WH_ASSET_ID']			= $WH_ASSET_ID;
				$ownerAsset['HOLDING_GROUP']		= $value['holdingGroup'];
				$ownerAsset['HOLDING_TYPE']			= $value['holdingType'];
				$ownerAsset['HOLDING_AMOUNT']		= $value['holdingAmount'];
				
				db::db_insert("WH_CIVIL_CASE_ASSET_OWNER",$ownerAsset,'WH_OWNER_ASSET_ID');
						
			}

		}	
		
	}
	$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
	
echo json_encode($row); 
 ?>
  