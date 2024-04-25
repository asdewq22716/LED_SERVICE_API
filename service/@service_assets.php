<?php
//BFYBxh
include '../include/include.php';
$con = curl_init();
curl_setopt($con, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($con, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
curl_setopt($con, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($con, CURLOPT_HEADER, 0);
curl_setopt($con, CURLOPT_TIMEOUT, 120);

//SERVICE
$ch = $con; 
$form_field['USERNAME'] = 'BankruptDt';// เปลี่ยนเป็นค่าที่จะส่ง
$form_field['PASSWORD'] = 'Debtor4321';// เปลี่ยนเป็นค่าที่จะส่ง

curl_setopt($ch, CURLOPT_URL, 'http://103.40.146.73/ledservicelaw.php/civilCaseAssets');
curl_setopt($ch, CURLOPT_POST, 1);

$data_string = json_encode($form_field); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
$data = curl_exec($ch);
$data = json_decode($data, true); 

 if($data['ResponseCode']['ResCode'] == '000') {	

		if(count($data['Data']['01']) > 0 ){ //ที่ดิน
			
			$land = $data['Data']['01']['asset'];
			$loop = count($land);

			for( $i = 0 ; $i < $loop ; $i++ ){
				$Field = array();
					
					$Field["CFC_CAPTION_GEN"] = $land[$i]["CFC_CAPTION_GEN"];
					$Field["ASSET_CODE"] = $land[$i]["CFC_LAND_GEN"];
					$Field["ASSET_ID"] = $land[$i]["DEED_NO"];
					$Field["CIVIL_CODE"] = $land[$i]["PCC_CIVIL_GEN"];
					$Field["ASSET_TYPE"] = '01';
					$Field["ASSET_DOC_TYPE"] = $land[$i]["LAND_TYPE"];
					$Field["ASSET_STATUS"] = $land[$i]["ASSET_STATUS"];
                    $Field["BOOK_NO"] = $land[$i]["BOOK_NO"];
                    $Field["PAGE_NO"] = $land[$i]["PAGE_NO"];
                    // $Field["FREIGHT"] = $land[$i]["PAGE_NO"];
					$Field["LAND_NO"] = $land[$i]["LAND_NO"];
                    $Field["SURVEY_PAGE"] = $land[$i]["SURVEY"];
					$Field["SEQ"] = $land[$i]["SEQ_NO"];
					$Field["AREA_RAi"] = $land[$i]["FARM"];
					$Field["AREA_NGAN"] = $land[$i]["NGAN"];
					$Field["AREA_WA"] = $land[$i]["VA"];
					$Field["AREA_FRACTION_WA"] = $land[$i]["REMAIN_VA"];					
					$Field["LAND_PRICE_PER_WA"] = $land[$i]["EST_PER_VA_AMOUNT"];
					$Field["LAND_PRICE"] = $land[$i]["EST_PRICE_AMOUNT"];
					$Field["DETAIL"] = $land[$i]["LAND_DESC"];
					$Field["TUM_CODE"] = $land[$i]["CENT_LOC_GEN"];
					$Field["TUM_NAME"] = $land[$i]["DISTRICT_NAME"];
					$Field["AMP_CODE"] = $land[$i]["LOC_GEN_AMP"];
					$Field["AMP_NAME"] = $land[$i]["AMPHUR_NAME"];
                    $Field["PROV_CODE"] = $land[$i]["LOC_GEN_PRV"];
					$Field["PROV_NAME"] = $land[$i]["PROVINCE_NAME"];
					$Field["ZIP_CODE"] = $land[$i]["POSTCODE"];
					$Field["DOSS_ID"] = $land[$i]["DOSS_ID"]; 
					
					// print_pre($Field);
					db::db_insert('WH_CIVIL_CASE_ASSETS_LAND', $Field);
					
					$Field2 = array();
					$Field2["ASSET_CODE"] = $land[$i]["CFC_LAND_GEN"];
					$Field2["ASSET_TYPE"] = '01';
					$Field2["CIVIL_CODE"] = $land[$i]["PCC_CIVIL_GEN"];
					$Field2["DOSS_ID"] = $land[$i]["DOSS_ID"]; 
					db::db_insert('WH_CIVIL_MAP_CASE_ASSET', $Field2, 'MAP_ASSET_ID','MAP_ASSET_ID');
				
			}
		}
		
		if(count($data['Data']['02']) > 0 ){ //สิ่งปลูกสร้าง
			
			$building = $data['Data']['02']['asset'];
			$loop = count($building);

			for( $i = 0 ; $i < $loop ; $i++ ){
				echo "aaaaaaaaaaaaaaa";
				 	$Field = array();
					$Field["ASSET_CODE"] = $building[$i]["CFC_HOUSE_GEN"];
       				$Field["ASSET_ID"] = $building[$i]["LICENSE_NO"];
					$Field["CIVIL_CODE"] = $building[$i]["CFC_CIVIL_GEN"];
					$Field["ASSET_TYPE"] = '02';
                    $Field["SEQ"] = $building[$i]["SEQ_NO"];
					$Field["ASSET_STATUS"] = $building[$i]["ASSET_STATUS"];
                   	$Field["BUILDING_STYLE"] = $building[$i]["HOUSE_TYPE"];
                   	$Field["BUILDING_AREA_AMOUNT"] = $building[$i]["AREA"];
                   	$Field["PRICE_BUILDING"] = $building[$i]["EST_PRICE_AMOUNT"];
					$Field["TUM_CODE"] = $building[$i]["CENT_LOC_GEN"];
					$Field["TUM_NAME"] = $building[$i]["TUM_NAME"];
					$Field["AMP_CODE"] = $building[$i]["LOC_GEN_AMP"]; 
					$Field["AMP_NAME"] = $building[$i]["AMP_NAME"];
                    $Field["PROV_CODE"] = $building[$i]["LOC_GEN_PRV"];
					$Field["PROV_NAME"] = $building[$i]["PRV_NAME"];
					$Field["ZIP_CODE"] = $building[$i]["POSTCODE"]; 
					
					db::db_insert('WH_CIVIL_CASE_ASSETS_BUILDING', $Field, 'ASSET_CODE');
					
			}
			
			
		}
		
		if(count($data['Data']['03']) > 0 ){ //ห้องชุด
			
			$condo = $data['Data']['03']['asset'];
			$loop = count($condo);
			
			for( $i = 0 ; $i < $loop ; $i++ ){
					
					$Field = array();
					$Field["ASSET_CODE"] = $condo[$i]["CFC_BUILDING_GEN"];
       				$Field["ASSET_ID"] = $condo[$i]["ADDR_NO"];
					$Field["CIVIL_CODE"] = $condo[$i]["CFC_CIVIL_GEN"];
					$Field["ASSET_TYPE"] = '03';
					$Field["SEQ"] = $condo[$i]["SEQ_NO"];
					$Field["ASSET_STATUS"] = $condo[$i]["ASSET_STATUS"];
					$Field["BUILDING_VILLAGE"] = '';
					$Field["BUILDING_NO"] = $condo[$i]["BUILDING_NO"];
					$Field["CONDO_FLOOR"] = $condo[$i]["FLOOR"];
					$Field["CONDO_REGIS_NO"] = $condo[$i]["LICENSE_NO"];
					$Field["CONDO_NAME"] = $condo[$i]["BUILDING_NAME"];
					$Field["TUM_CODE"] = $condo[$i]["CENT_LOC_GEN"];
					$Field["TUM_NAME"] = $condo[$i]["TUM_NAME"];
					$Field["AMP_CODE"] = $condo[$i]["LOC_GEN_AMP"];
					$Field["AMP_NAME"] = $condo[$i]["AMP_NAME"];
                    $Field["PROV_CODE"] = $condo[$i]["LOC_GEN_PRV"];
					$Field["PROV_NAME"] = $condo[$i]["PRV_NAME"];
					$Field["ZIP_CODE"] = $condo[$i]["POSTCODE"];
					
					db::db_insert('WH_CIVIL_CASE_ASSETS_CONDO', $Field, 'ASSET_CODE');
                
					
			}
			
			
		}
		
		if(count($data['Data']['13']) > 0 ){  //เครื่องจักร
			
			$machine = $data['Data']['13']['asset'];
			$loop = count($machine);
			
			for( $i = 0 ; $i < $loop ; $i++ ){

					$Field = array();
					$Field["ASSET_CODE"] = $machine[$i]["CFC_MACHINE_GEN"];
       				$Field["ASSET_ID"] = $machine[$i]["LICENSE_NO"];
					$Field["CIVIL_CODE"] = $machine[$i]["CFC_CIVIL_GEN"];
					$Field["ASSET_TYPE"] = '13';
					$Field["SEQ"] = $machine[$i]["SEQ_NO"];
					$Field["ASSET_STATUS"] = $machine[$i]["ASSET_STATUS"];				
					$Field["MODEL"] = $machine[$i]["MACHINE_MODEL"];
					$Field["GENERATE"] = $machine[$i]["CLASS_DESC"];
					$Field["ENGINE_NO"] = $machine[$i]["ENGINE_NO"];
					$Field["MACHINE_SIZE"] = $machine[$i]["MACHINE_SIZE"];
					$Field["USEDLN"] = '';
					$Field["CAPACITY"] =  '';
					$Field["ENERGY"] = '';
					$Field["PRODUCER"] = '';
					$Field["MACHINE_COMPONENT"] = '';		
					$Field["TUM_CODE"] = $machine[$i]["CENT_LOC_GEN"];
					$Field["TUM_NAME"] = $machine[$i]["TUM_NAME"];
					$Field["AMP_CODE"] = $machine[$i]["LOC_GEN_AMP"];
					$Field["AMP_NAME"] = $machine[$i]["AMP_NAME"];
                    $Field["PROV_CODE"] = $machine[$i]["LOC_GEN_PRV"];
					$Field["PROV_NAME"] = $machine[$i]["PRV_NAME"];
					$Field["ZIP_CODE"] = $machine[$i]["POSTCODE"];
					
					db::db_insert('WH_CIVIL_CASE_ASSETS_MACHINE', $Field, 'ASSET_CODE');
                
					
			}
		
		}	
		
		if(count($data['Data']['09']) > 0 ){ //พันธบัตร
			
			$bonds = $data['Data']['09']['asset'];
			$loop = count($bonds);
			
			for( $i = 0 ; $i < $loop ; $i++ ){

					$Field = array();
					$Field["ASSET_CODE"] = $bonds[$i]["CFC_BONDS_GEN"];
       				$Field["ASSET_ID"] = '';
					$Field["CIVIL_CODE"] = $bonds[$i]["CFC_CIVIL_GEN"];
					$Field["ASSET_TYPE"] = '09';
					$Field["SEQ"] = $bonds[$i]["SEQ_NO"];
					$Field["ASSET_STATUS"] = $bonds[$i]["ASSET_STATUS"];				
					$Field["BOND_NAME"] = $bonds[$i]["BONDS_NAME"];
					$Field["START_NO"] = $bonds[$i]["BONDS_NO"];
					$Field["TO"] = $bonds[$i]["BONDS_NO_TO"];
					$Field["DUEDATE"] = "";
					$Field["PRICE_UNIT"] = $bonds[$i]["UNIT_AMOUNT"];
					$Field["PRICE_SUM"] = $bonds[$i]["EST_PRICE_AMOUNT"];
					$Field["BOND_ISSUER"] = $bonds[$i]["BONDS_PERSON_GEN"];	
					$Field["TUM_CODE"] = $bonds[$i]["CENT_LOC_GEN"];
					$Field["TUM_NAME"] = $bonds[$i]["TUM_NAME"];
					$Field["AMP_CODE"] = $bonds[$i]["LOC_GEN_AMP"];
					$Field["AMP_NAME"] = $bonds[$i]["AMP_NAME"];
                    $Field["PROV_CODE"] = $bonds[$i]["LOC_GEN_PRV"];
					$Field["PROV_NAME"] = $bonds[$i]["PRV_NAME"];
					$Field["ZIP_CODE"] = $bonds[$i]["POSTCODE"];
					
					db::db_insert('WH_CIVIL_CASE_ASSETS_BOND', $Field, 'ASSET_CODE');
                
					 
			}
		
		}	
		
		if(count($data['Data']['10']) > 0 ){ //สลากออมทรัพย์
			
			$lottery = $data['Data']['10']['asset'];
			$loop = count($lottery);
			
			for( $i = 0 ; $i < $loop ; $i++ ){

					$Field = array();
					$Field["ASSET_CODE"] = $lottery[$i]["CFC_SAVE_GEN"];
       				$Field["ASSET_ID"] = '';
					$Field["CIVIL_CODE"] = $lottery[$i]["CFC_CIVIL_GEN"];
					$Field["ASSET_TYPE"] = '10';
					$Field["SEQ"] = $lottery[$i]["SEQ_NO"];
					$Field["ASSET_STATUS"] = $lottery[$i]["ASSET_STATUS"];				
					$Field["LOTTERY_NAME"] = $lottery[$i]["SAVE_NAME"];
					$Field["BRANCE"] = '';
					$Field["START_NO"] = $lottery[$i]["SAVE_NO_FR"];
					$Field["TO"] = $lottery[$i]["SAVE_NO_TO"];
					$Field["DUEDATE"] = '';
					$Field["NO_UNIT"] = $lottery[$i]["SAVE_UNIT"];
					$Field["PRICE_UNIT"] = $lottery[$i]["SAVE_UNIT_PRI"];
					$Field["PRICE_SUM"] = $lottery[$i]["SAVE_AMT"];
					
					db::db_insert('WH_CIVIL_CASE_ASSETS_LOTTERY', $Field, 'ASSET_CODE');
                
					
			}
		
		}
		
		if(count($data['Data']['14']) > 0 ){ //ปืน
			
			$gun = $data['Data']['14']['asset'];
			$loop = count($gun);
			
			for( $i = 0 ; $i < $loop ; $i++ ){

					$Field = array();
					$Field["ASSET_CODE"] = $gun[$i]["CFC_GUN_GEN"];
       				$Field["ASSET_ID"] = $gun[$i]["LICENSE_NO"];
					$Field["CIVIL_CODE"] = $gun[$i]["CFC_CIVIL_GEN"];
					$Field["ASSET_TYPE"] = '14';
					$Field["SEQ"] = $gun[$i]["SEQ_NO"];
					$Field["ASSET_STATUS"] = $gun[$i]["ASSET_STATUS"];				
					$Field["GUN_TYPE"] = $gun[$i]["TYPE_DESC"];
					$Field["TYPE"] = $gun[$i]["GUN_SIZE"];
					$Field["MODEL"] = '';
					$Field["BRAND"] = $gun[$i]["BRAND_NAME"];
					$Field["AMMUNITION_SIZE"] = '';
					$Field["COLOR"] = '';
					$Field["SIZE"] = '';
					$Field["BARREL_SIZE"] = '';
					$Field["BULLET_SIZE"] = $gun[$i]["GUN_SIZE"];

					
					db::db_insert('WH_CIVIL_CASE_ASSETS_GUN', $Field, 'ASSET_CODE');
                
					
			}
		
		}	
		
		if(count($data['Data']['11']) > 0 ){  //รถ
			
			$car = $data['Data']['11']['asset'];
			$loop = count($car);
			
			for( $i = 0 ; $i < $loop ; $i++ ){

					$Field = array();
					$Field["ASSET_CODE"] = $car[$i]["CFC_VEHICLE_GEN"];
       				$Field["ASSET_ID"] = $car[$i]["PLATE_NO1"].$car[$i]["PLATE_NO2"];
					$Field["CIVIL_CODE"] = $car[$i]["CFC_CIVIL_GEN"];
					$Field["ASSET_TYPE"] = '11';
					$Field["SEQ"] = $car[$i]["SEQ_NO"];
					$Field["ASSET_STATUS"] = $car[$i]["ASSET_STATUS"];				
					$Field["VEHICLE_TYPE"] = $car[$i]["VEHICLE_TYPE"];
					$Field["TYPE"] =  '';
					$Field["NATURE"] = '';
					$Field["BRAND"] = $car[$i]["BRAND_NAME"];
					$Field["AMMUNITION_SIZE"] = '';
					$Field["COLOR"] = '';
					$Field["SIZE"] = '';
					$Field["BARREL_SIZE"] = '';
					$Field["BULLET_SIZE"] = $car[$i]["GUN_SIZE"];

					
					db::db_insert('WH_CIVIL_CASE_ASSETS_CAR', $Field, 'ASSET_CODE');
                
					
			}
		
		}	

 }		
 
 ?>