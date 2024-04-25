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
				
				// $Field = array();
				// foreach($land[$i] as $key => $val){	
				
					// if(strpos( $key,'DATE')){
						// $Field[$key] = date_format($val,"Y/m/d H:i:s");
					// }else{
						// $Field[$key] = $val;
					// }
				
				// }
				$Field['ASSET_CODE'] = '';
				$Field['ASSET_ID']= '';
				$Field['ASSET_TYPE']= '';
				$Field['ASSET_DOC_TYPE']= '';
				$Field['ASSET_STATUS']= '';
				$Field['BOOK_NO']= $land['BOOK_NO'];
				$Field['PAGE_NO']=  $land['PAGE_NO'];
				$Field['FREIGHT']= '';
				$Field['LAND_NO']= $land['LAND_NO']; 
				$Field['SURVEY_PAGE']= '';
				$Field['TUM_CODE']= '';
				$Field['TUM_NAME']= $land['DISTRICT_NAME']; 
				$Field['AMP_CODE']= '';
				$Field['AMP_NAME']= $land['AMPHUR_NAME']; 
				$Field['PROV_CODE']= '';
				$Field['PROV_NAME']= $land['PROVINCE_NAME']; 
				$Field['ZIP_CODE']= '';
				$Field['OLD_TUM_NAME']= '';
				$Field['OLD_AMP_NAME']= '';
				$Field['OLD_PROV_NAME']= '';
				$Field['AREA_RAI']= '';
				$Field['AREA_NGAN']= '';
				$Field['AREA_WA']= $land['VA']; 
				$Field['AREA_FRACTION_WA']= '';
				$Field['LAND_PRICE_PER_WA']= '';
				$Field['LAND_PRICE']= '';
				$Field['DETAIL']= '';
				$Field['RECORD_COUNT']= '';
				$Field['SEQ']= $land['SEQ_NO'];
				$Field['PERSON_CODE']= '';
				$Field['REGISTER_CODE']= '';
				$Field['PREFIX_CODE']= '';
				$Field['PREFIX_NAME']= '';
				$Field['FIRST_NAME']= '';
				$Field['LAST_NAME']= '';
				$Field['CONCERN_CODE']= '';
				$Field['CONCERN_NAME']= '';
				$Field['CONCERN_NO']= '';
				$Field['HOLDING_GROUP']= '';
				$Field['HOLDING_TYPE']= '';
				$Field['HOLDING_AMOUNT']= '';

				$sql = "SELECT CFC_LAND_GEN FROM WH_CIVIL_CASE_ASSETS_LAND WHERE CFC_LAND_GEN = '".$Field['CFC_LAND_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_LAND', $Field, 'CFC_LAND_GEN');
				}
				
			}
		}

		if(count($data['Data']['02']) > 0 ){ //สิ่งปลูกสร้าง
			
			$building = $data['Data']['02']['asset'];
			$loop = count($building);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($building[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$sql = "SELECT CFC_HOUSE_GEN FROM WH_CIVIL_CASE_ASSETS_BUILDING WHERE CFC_HOUSE_GEN = '".$Field['CFC_HOUSE_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_BUILDING', $Field, 'CFC_HOUSE_GEN');
				}
				
			}
		}
		exit;
		
		if(count($data['Data']['03']) > 0 ){ //ห้องชุด
			
			$condo = $data['Data']['03']['asset'];
			$loop = count($condo);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($condo[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$Field['AssetCode'] = $data['Data']['03']['asset'][$i]['CFC_BUILDING_GEN'];
				$Field['AssetId']= $data['Data']['03']['asset'][$i]['LICENSE_NO'];
				$sql = "SELECT CFC_BUILDING_GEN FROM WH_CIVIL_CASE_ASSETS_CONDO WHERE CFC_BUILDING_GEN = '".$Field['CFC_BUILDING_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_CONDO', $Field, 'CFC_BUILDING_GEN');
				}
				
				
			}
		}
		
		if(count($data['Data']['04']) > 0 ){ //สิทธิการเช่า ที่ดินและสิ่งปลูกสร้าง
			
			$land_rent = $data['Data']['04']['asset'];
			$loop = count($land_rent);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($land_rent[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$sql = "SELECT CFC_LAND_RENT_RIGHT_GEN FROM WH_CIVIL_CASE_ASSETS_LAND_RENT WHERE CFC_LAND_RENT_RIGHT_GEN = '".$Field['CFC_LAND_RENT_RIGHT_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_LAND_RENT', $Field, 'CFC_LAND_RENT_RIGHT_GEN');
				}
				
				
			}
		}
		
		if(count($data['Data']['05']) > 0 ){ //สิทธิการเช่า ห้องชุด
			
			$building_rent = $data['Data']['05']['asset'];
			$loop = count($building_rent);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($building_rent[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$sql = "SELECT CFC_BUILDING_RENT_RIGHT_GEN FROM WH_CIVIL_CASE_ASSETS_BUIL_RENT WHERE CFC_BUILDING_RENT_RIGHT_GEN = '".$Field['CFC_BUILDING_RENT_RIGHT_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_BUIL_RENT', $Field, 'CFC_BUILDING_RENT_RIGHT_GEN');
				}
				
				
			}
		}
		
		if(count($data['Data']['06']) > 0 ){ //สิทธิการเช่า พื้นที่ในอาคาร
			
			$building_rent2 = $data['Data']['06']['asset'];
			$loop = count($building_rent2);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($building_rent2[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$sql = "SELECT CFC_BUILDING_RENT_RIGHT_GEN FROM WH_CIVIL_CASE_ASSETS_BUIL_RENT WHERE CFC_BUILDING_RENT_RIGHT_GEN = '".$Field['CFC_BUILDING_RENT_RIGHT_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_BUIL_RENT', $Field, 'CFC_BUILDING_RENT_RIGHT_GEN');
				}				
				
				
			}
		}
		
		if(count($data['Data']['07']) > 0 ){ //สิทธิการเช่า พื้นที่ในอาคาร
			
			$land_rent2 = $data['Data']['07']['asset'];
			$loop = count($land_rent2);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($land_rent2[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$sql = "SELECT CFC_LAND_RENT_RIGHT_GEN FROM WH_CIVIL_CASE_ASSETS_LAND_RENT WHERE CFC_LAND_RENT_RIGHT_GEN = '".$Field['CFC_LAND_RENT_RIGHT_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_LAND_RENT', $Field, 'CFC_LAND_RENT_RIGHT_GEN');
				}	
				
				
			}
		}	
		
		if(count($data['Data']['08']) > 0 ){ //หุ้น
			
			$stock = $data['Data']['08']['asset'];
			$loop = count($stock);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($stock[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}	
				$sql = "SELECT CFC_STOCK_GEN FROM WH_CIVIL_CASE_ASSETS_STOCK WHERE CFC_STOCK_GEN = '".$Field['CFC_STOCK_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_STOCK', $Field, 'CFC_STOCK_GEN');
				}	
				
				
			}
		}	
		
		if(count($data['Data']['09']) > 0 ){ //พันธบัตร
			
			$bond = $data['Data']['09']['asset'];
			$loop = count($bond);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($bond[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$Field['AssetCode'] = $data['Data']['09']['asset'][$i]['CFC_BONDS_GEN'];
				$Field['AssetId']= $data['Data']['09']['asset'][$i]['BONDS_ID'];
				$sql = "SELECT CFC_BONDS_GEN FROM WH_CIVIL_CASE_ASSETS_BOND WHERE CFC_BONDS_GEN = '".$Field['CFC_BONDS_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_BOND', $Field, 'CFC_BONDS_GEN');
				}				
				
				
			}
		}	
		
		if(count($data['Data']['10']) > 0 ){ //สลากออมทรัพย์
			
			$lottery = $data['Data']['10']['asset'];
			$loop = count($lottery);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($lottery[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$sql = "SELECT CFC_SAVE_SAVE FROM WH_CIVIL_CASE_ASSETS_LOTTERY WHERE CFC_SAVE_SAVE = '".$Field['CFC_SAVE_SAVE']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_LOTTERY', $Field, 'CFC_SAVE_SAVE');
				}				
				
				
			}
		}
		
		if(count($data['Data']['11']) > 0 ){ //รถ
			
			$car = $data['Data']['11']['asset'];
			$loop = count($car);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($car[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$Field['AssetCode'] = $data['Data']['13']['asset'][$i]['CFC_VEHICLE_GEN'];
				$Field['AssetId']= $data['Data']['13']['asset'][$i]['BODY_NO'];
				$sql = "SELECT CFC_VEHICLE_GEN FROM WH_CIVIL_CASE_ASSETS_CAR WHERE CFC_VEHICLE_GEN = '".$Field['CFC_VEHICLE_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_CAR', $Field, 'CFC_VEHICLE_GEN');
				}		
				
				
			}
		}
		
		if(count($data['Data']['12']) > 0 ){ //เรือ
			
			$boat = $data['Data']['12']['asset'];
			$loop = count($boat);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($boat[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$Field['AssetCode'] = $data['Data']['12']['asset'][$i]['CFC_BOAT_GEN'];
				$Field['AssetId']= $data['Data']['12']['asset'][$i]['BOAT_ID'];
				$sql = "SELECT CFC_BOAT_GEN FROM WH_CIVIL_CASE_ASSETS_BOAT WHERE CFC_BOAT_GEN = '".$Field['CFC_BOAT_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_BOAT', $Field, 'CFC_BOAT_GEN');
				}
				
				
			}
		}	
		
		if(count($data['Data']['13']) > 0 ){ //เครื่องจักร
			
			$machine = $data['Data']['13']['asset'];
			$loop = count($machine);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($machine[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$Field['AssetCode'] = $data['Data']['13']['asset'][$i]['CFC_MACHINE_GEN'];
				$Field['AssetId']= $data['Data']['13']['asset'][$i]['LICENSE_NO'];
				$sql = "SELECT CFC_MACHINE_GEN FROM WH_CIVIL_CASE_ASSETS_MACHINE WHERE CFC_MACHINE_GEN = '".$Field['CFC_MACHINE_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_MACHINE', $Field, 'CFC_MACHINE_GEN');
				}
				
				
			}
		}
		
		if(count($data['Data']['14']) > 0 ){ //ปืน
			
			$gun = $data['Data']['14']['asset'];
			$loop = count($gun);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($gun[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$Field['AssetCode'] = $data['Data']['14']['asset'][$i]['CFC_GUN_GEN'];
				$Field['AssetId']= $data['Data']['14']['asset'][$i]['GUN_NO'];
				$sql = "SELECT CFC_GUN_GEN FROM WH_CIVIL_CASE_ASSETS_GUN WHERE CFC_GUN_GEN = '".$Field['CFC_GUN_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_GUN', $Field, 'CFC_GUN_GEN');
				}				
				
				
			}
		}
		
		if(count($data['Data']['14']) > 0 ){ //หน่วยลงทุน
			
			$fund = $data['Data']['14']['asset'];
			$loop = count($fund);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($fund[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$sql = "SELECT CFC_FUND_GEN FROM WH_CIVIL_CASE_ASSETS_FUND WHERE CFC_FUND_GEN = '".$Field['CFC_FUND_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_FUND', $Field, 'CFC_FUND_GEN');
				}
				
				
			}
		}
		
		if(count($data['Data']['99']) > 0 ){ //ทรัพย์สินต่างๆ
			
			$other = $data['Data']['99']['asset'];
			$loop = count($other);

			for( $i = 0 ; $i < $loop ; $i++ ){
				
				$Field = array();
				foreach($other[$i] as $key => $val){	
				
					if(strpos( $key,'DATE')){
						$Field[$key] = date_format($val,"Y/m/d H:i:s");
					}else{
						$Field[$key] = $val;
					}
				
				}
				$sql = "SELECT CFC_OTHER_CAPTION_GEN FROM WH_CIVIL_CASE_ASSETS_OTHER WHERE CFC_OTHER_CAPTION_GEN = '".$Field['CFC_OTHER_CAPTION_GEN']."'";
				$query = db::query($sql);
				$num_rows = db::num_rows($query);
				
				if($num_rows == 0){
					db::db_insert('WH_CIVIL_CASE_ASSETS_OTHER', $Field, 'CFC_OTHER_CAPTION_GEN');
				}
				
				
			}
		}	

 }		
 
 ?>