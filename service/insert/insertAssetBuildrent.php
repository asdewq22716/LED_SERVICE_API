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
	
	
	$sql = "SELECT COUNT(*) AS NR FROM WH_CIVIL_CASE_ASSETS_BUIL_RENT WHERE ASSET_CODE = '".$data['cfcBuildingRentRightGen']."'";
	$query = db::query($sql);
	$rec = db::fetch_array($query);
	
	if($rec['NR'] > 0){
		
		$update = array();
		
     
        $update['ASSET_STATUS']   	            =  $data['assetStatus'];
        $update['TUM_CODE'] 	  	            =  $data['tumCode'];	 
		$update['TUM_NAME'] 	  	            =  $data['tumName'];
		$update['AMP_CODE'] 	  	            =  $data['ampCode'];
		$update['AMP_NAME'] 	  	            =  $data['ampName'];
		$update['PROV_CODE'] 	  	            =  $data['provCode'];
		$update['PROV_NAME'] 	  	            =  $data['provName'];
		$update['ZIP_CODE'] 	  	            =  $data['zipCode'];
        $insert['OLD_TUM_NAME']   	            = 	$data['districtName'];
		$insert['OLD_AMP_NAME']   	            = 	$data['amphurName'];
		$insert['OLD_PROV_NAME']  	            = 	$data['provinceName'];    
        $update['WIDE']                         =  $data['wide'];
        $update['SOI']                          =  $data['soi'];
        $update['MOO_NO']                       =  $data['mooNo'];
        $update['ROAD']                         =  $data['road'];
        $update['CFC_BD_RENT_RIGHT_REQ_GEN']    =  $data['cfcBdRentRightReqGen'];
        $update['SEQ_NO']                       =  $data['seqNo'];
        $update['ASSET_TYPE']                   =  $data['assetType'];     
        $update['VILLAGE_NAME']                 =  $data['villageName'];
        $update['ADDR_NO']                      =  $data['addrNo'];
        $update['FLOOR']                        =  $data['floor'];
        $update['BUILDING_NO']                  =  $data['buildingNo'];
        $update['BUILDING_NAME']                =  $data['buildingName'];
        $update['LICENSE_NO']                   =  $data['licenseNo'];
        $update['FARM']                         =  $data['farm'];    
        $update['NGAN']                         =  $data['ngan'];
        $update['VA']                           =  $data['va'];
        $update['REMAIN_VA']                    =  $data['remainVa'];    
        $update['REMAIN_BASE']                  =  $data['remainBase'];
        $update['CONTACT_NO']                   =  $data['contactNo'];
        $update['CONTACT_DATE']                 =  $data['contactDate'];
        $update['START_DATE']                   =  $data['startDate'];
        $update['EXPIRE_DATE']                  =  $data['expireDate'];
        $update['RENT_QTY']                     =  $data['rentQty'];
        $update['RENT_UNIT']                    =  $data['rentUnit'];     
        $update['REMAIN_DAY']                   =  $data['remainDay'];
        $update['RATE_AMOUNT']                  =  $data['rateAmount'];
        $update['UNIT_AMOUNT']                  =  $data['unitAmount'];
        $update['UNIT_PERIOD']                  =  $data['unitPeriod'];
        $update['REMAIN_YR']                    =  $data['remainYr'];
        $update['REMAIN_MM']                    =  $data['remainMm'];
        $update['REMAIN_DD']                    =  $data['remainDd'];    
        $update['EST_UNIT_AMOUNT']              =  $data['estUnitAmount'];
        $update['EST_RENT_AMOUNT']              =  $data['estRentAmount'];
        $update['START_AMOUNT']                 =  $data['startAmount'];    
        $update['EST_START_AMOUNT']             =  $data['estStartAmount'];
        $update['ADD_PERCENT']                  =  $data['addPercent'];
        $update['ADD_AMOUNT']                   =  $data['addAmount'];
        $update['MINUS_PERCENT']                =  $data['minusPercent'];
        $update['MINUS_AMOUNT']                 =  $data['minusAmount'];
        $update['RENT_COMMENT']                 =  $data['rentComment'];
        $update['EST_PRICE_AMOUNT']             =  $data['estPriceAmount'];     
        $update['CENT_DEPT_GEN']                =  $data['centDeptGen'];
        $update['CREATE_BY_USERID']             =  $data['createByUserid'];
        $update['CREATE_DATE']                  =  $data['createDate'];
        $update['UPDATE_BY_USERID']             =  $data['updateByUserid'];
        $update['UPDATE_DATE']                  =  $data['updateDate'];
        $update['CREATE_BY_PROGID']             =  $data['createByProgid'];    
        $update['UPDATE_BY_PROGID']             =  $data['updateByProgid'];
        $update['VERSION']                      =  $data['version'];
        $update['DATA_ID']                      =  $data['dataId'];    
        $update['COPY_FLAG']                    =  $data['copyFlag'];
        $update['USER_DEPT_CODE']               =  $data['userDeptCode'];
        $update['DPD_STRUCTURE_GEN']            =  $data['dpdStructureGen'];
        $update['LONGS']                        =  $data['longs'];
        $update['VERANDA_WIDE']                 =  $data['verandaWide'];    
        $update['AREA']                         =  $data['area'];
        $update['BUILDING_REGISTRATION_FLAG']   =  $data['buildingRegistrationFlag'];
        $update['BUILDING_TRAIN_FLAG']          =  $data['buildingTrainFlag'];



		$cond = array();
		
		$cond['ASSET_CODE']			 = $data['cfcBuildingRentRightGen'];
		
		db::db_update("WH_CIVIL_CASE_ASSETS_BUIL_RENT",$update,$cond);
		
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

		$insert['ASSET_CODE']	                = $data['cfcBuildingRentRightGen'];
        $insert['ASSET_STATUS']   	            =  $data['assetStatus'];
        $insert['TUM_CODE'] 	  	            =  $data['tumCode'];	 
		$insert['TUM_NAME'] 	  	            =  $data['tumName'];
		$insert['AMP_CODE'] 	  	            =  $data['ampCode'];
		$insert['AMP_NAME'] 	  	            =  $data['ampName'];
		$insert['PROV_CODE'] 	  	            =  $data['provCode'];
		$insert['PROV_NAME'] 	  	            =  $data['provName'];
		$insert['ZIP_CODE'] 	  	            =  $data['zipCode'];
        $insert['OLD_TUM_NAME']   	            =  $data['districtName'];
		$insert['OLD_AMP_NAME']   	            =  $data['amphurName'];
		$insert['OLD_PROV_NAME']  	            =  $data['provinceName'];    
        $insert['WIDE']                         =  $data['wide'];
        $insert['SOI']                          =  $data['soi'];
        $insert['MOO_NO']                       =  $data['mooNo'];
        $insert['ROAD']                         =  $data['road'];
        $insert['CFC_BD_RENT_RIGHT_REQ_GEN']    =  $data['cfcBdRentRightReqGen'];
        $insert['SEQ_NO']                       =  $data['seqNo'];
        $insert['ASSET_TYPE']                   =  $data['assetType'];     
        $insert['VILLAGE_NAME']                 =  $data['villageName'];
        $insert['ADDR_NO']                      =  $data['addrNo'];
        $insert['FLOOR']                        =  $data['floor'];
        $insert['BUILDING_NO']                  =  $data['buildingNo'];
        $insert['BUILDING_NAME']                =  $data['buildingName'];
        $insert['LICENSE_NO']                   =  $data['licenseNo'];
        $insert['FARM']                         =  $data['farm'];    
        $insert['NGAN']                         =  $data['ngan'];
        $insert['VA']                           =  $data['va'];
        $insert['REMAIN_VA']                    =  $data['remainVa'];    
        $insert['REMAIN_BASE']                  =  $data['remainBase'];
        $insert['CONTACT_NO']                   =  $data['contactNo'];
        $insert['CONTACT_DATE']                 =  $data['contactDate'];
        $insert['START_DATE']                   =  $data['startDate'];
        $insert['EXPIRE_DATE']                  =  $data['expireDate'];
        $insert['RENT_QTY']                     =  $data['rentQty'];
        $insert['RENT_UNIT']                    =  $data['rentUnit'];     
        $insert['REMAIN_DAY']                   =  $data['remainDay'];
        $insert['RATE_AMOUNT']                  =  $data['rateAmount'];
        $insert['UNIT_AMOUNT']                  =  $data['unitAmount'];
        $insert['UNIT_PERIOD']                  =  $data['unitPeriod'];
        $insert['REMAIN_YR']                    =  $data['remainYr'];
        $insert['REMAIN_MM']                    =  $data['remainMm'];
        $insert['REMAIN_DD']                    =  $data['remainDd'];    
        $insert['EST_UNIT_AMOUNT']              =  $data['estUnitAmount'];
        $insert['EST_RENT_AMOUNT']              =  $data['estRentAmount'];
        $insert['START_AMOUNT']                 =  $data['startAmount'];    
        $insert['EST_START_AMOUNT']             =  $data['estStartAmount'];
        $insert['ADD_PERCENT']                  =  $data['addPercent'];
        $insert['ADD_AMOUNT']                   =  $data['addAmount'];
        $insert['MINUS_PERCENT']                =  $data['minusPercent'];
        $insert['MINUS_AMOUNT']                 =  $data['minusAmount'];
        $insert['RENT_COMMENT']                 =  $data['rentComment'];
        $insert['EST_PRICE_AMOUNT']             =  $data['estPriceAmount'];     
        $insert['CENT_DEPT_GEN']                =  $data['centDeptGen'];
        $insert['CREATE_BY_USERID']             =  $data['createByUserid'];
        $insert['CREATE_DATE']                  =  $data['createDate'];
        $insert['UPDATE_BY_USERID']             =  $data['updateByUserid'];
        $insert['UPDATE_DATE']                  =  $data['updateDate'];
        $insert['CREATE_BY_PROGID']             =  $data['createByProgid'];    
        $insert['UPDATE_BY_PROGID']             =  $data['updateByProgid'];
        $insert['VERSION']                      =  $data['version'];
        $insert['DATA_ID']                      =  $data['dataId'];    
        $insert['COPY_FLAG']                    =  $data['copyFlag'];
        $insert['USER_DEPT_CODE']               =  $data['userDeptCode'];
        $insert['DPD_STRUCTURE_GEN']            =  $data['dpdStructureGen'];
        $insert['LONGS']                        =  $data['longs'];
        $insert['VERANDA_WIDE']                 =  $data['verandaWide'];    
        $insert['AREA']                         =  $data['area'];
        $insert['BUILDING_REGISTRATION_FLAG']   =  $data['buildingRegistrationFlag'];
        $insert['BUILDING_TRAIN_FLAG']          =  $data['buildingTrainFlag'];

   
		
		db::db_insert("WH_CIVIL_CASE_ASSETS_BUIL_RENT",$insert,'ASSET_ID','ASSET_ID');
		
		
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
  