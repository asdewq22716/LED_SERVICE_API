<?php
class civilCaseAssetsCarResponse extends civilCaseAssetsCarJson {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAssetsCarJson::getJson();
		$this->jsonPerson = civilCaseAssetsCarJson::getJsonPerson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
				$filter = "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		//$sql = "SELECT CC.CIVIL_CODE, CC.COURT_CODE, CC.COURT_NAME, CC.DEPT_CODE, CC.DEPT_NAME, CC.PREFIX_BLACK_CASE, CC.BLACK_CASE, CC.BLACK_YY, CC.PREFIX_RED_CASE, CC.RED_CASE, CC.RED_YY, CAC.ASSET_CODE, CAC.ASSET_ID, CAC.ASSET_STATUS, CAC.VEHICLE_TYPE, CAC. TYPE, CAC.NATURE, CAC.BRAND, CAC. MODEL, CAC.TANK_NO, CAC.FUEL, CAC.PUMPING_COUNT, CAC.HORSE_POWER_COUNT, CAC.AXLES_COUNT, CAC.WHEELS_COUNT, CAC.TIRE_COUNT, CAC.PROVINCE, CAC. OWNER, CAC.GENERTION_YEAR, CAC.COLOR, CAC.ENGINE_BRAND, CAC.ENGINE_NO, 'Price' AS Price, CAC.HOLDING_GROUP, CAC.HOLDING_TYPE, CAC.HOLDING_AMOUNT FROM WH_CIVIL_CASE CC INNER JOIN WH_CIVIL_MAP_CASE_ASSET CA ON CC.CIVIL_CODE = CA.CIVIL_CODE INNER JOIN WH_CIVIL_CASE_ASSETS_CAR CAC ON CAC.ASSET_CODE = CA.ASSET_CODE WHERE 1 = 1 {$filter}";
		$sql = "SELECT DISTINCT
					wh_case.CIVIL_CODE,
					wh_case.COURT_CODE,
					wh_case.COURT_NAME,
					wh_case.DEPT_CODE,
					wh_case.DEPT_NAME,
					wh_case.PREFIX_BLACK_CASE,
					wh_case.BLACK_CASE,
					wh_case.BLACK_YY,
					wh_case.PREFIX_RED_CASE,
					wh_case.RED_CASE,
					wh_case.RED_YY,
					car.CFC_VEHICLE_GEN,
					car.CFC_CIVIL_GEN,
					car.CFC_VEHICLE_REQ_GEN,
					car.SEQ_NO,
					car.VEHICLE_TYPE,
					car.PLATE_NO1,
					car.PLATE_NO2,
					car.CENT_LOC_GEN,
					car.LICENSE_PLACE,
					car.LICENSE_DATE,
					car.BRAND_TYPE,
					car.MODEL,
					car.BODY_NO,
					car.ENGINE_BRAND,
					car.ENGINE_NO,
					car.FUEL_NAME,
					car.SOOP_QTY,
					car.HORSE_POWER,
					car.AXLE_QTY,
					car.WHEEL_QTY,
					car.TUBE_QTY,
					car.SEAT_QTY,
					car.STAND_QTY,
					car.BODY_WEIGHT,
					car.CARRY_WEIGHT,
					car.TOTAL_WEIGHT,
					car.DOOR_QTY,
					car.EST_PRICE_AMOUNT,
					car.ACCESSORY_DESC,
					car.VEHICLE_DESC,
					car.OTH_DESC,
					car.KEEP_PERSON_GEN,
					car.KEEP_LOCATION,
					car.KEEP_CENT_LOC_GEN,
					car.R_SELL_TYPE,
					car.ASSET_STATUS,
					car.CENT_DEPT_GEN,
					car.CREATE_BY_USERID,
					car.CREATE_DATE,
					car.UPDATE_BY_USERID,
					car.UPDATE_DATE,
					car.CREATE_BY_PROGID,
					car.UPDATE_BY_PROGID,
					car.VERSION,
					car.DATA_ID,
					car.COPY_FLAG,
					car.USER_DEPT_CODE,
					car.DPD_STRUCTURE_GEN,
					car.TUBE_WHEEL,
					car.STARDARD_DESC,
					car.CLASS_DESC,
					car.VEHICLE_REGISTRATION_FLAG,
					car.VEHICLE_COMMENT,
					car.WH_CIVIL_ID
				FROM
					WH_CIVIL_CASE wh_case
				LEFT JOIN WH_CIVIL_CASE_ASSETS_CAR car ON wh_case.WH_CIVIL_ID = car.WH_CIVIL_ID
				WHERE
					1 = 1 {$filter}";
		$objResponse = $this->json['response'];
		$objResPerson = $this->jsonPerson['response'];
		$this->response = array();
		$data = array();
		
		$query = db::query($sql);	
		while($rec = db::fetch_array($query)){ 
		
		  	$data_res = array();
		  	foreach((array)$objResponse as $_key=>$_item) {
				$data_res[$_item['FIELD']] = $rec[$_key];
		  	}
			
			$data[$rec['CFC_VEHICLE_GEN']] = $data_res;	
		
			/* $sql_sub = "SELECT 
							CP.PERSON_CODE,
							CP.REGISTER_CODE,
							CP.PREFIX_CODE,
							CP.PREFIX_NAME,
							CP.FIRST_NAME,
							CP.LAST_NAME,
							CP.CONCERN_CODE,
							CP.CONCERN_NAME,
							CP.CONCERN_NO 
						FROM WH_CIVIL_ASSET_OWNER AO
						LEFT JOIN WH_CIVIL_CASE_PERSON CP ON CP.PERSON_CODE = AO.PERSON_CODE
						WHERE AO.ASSET_CODE = '".$rec['ASSET_CODE']."'";
			$q_sub = db::query($sql_sub);
			$i=1;
			while($r_sub = db::fetch_array($q_sub)){ 
				
				  $data_res = array();
				  $data_res['SEQ'] = $i;
				  foreach((array)$objResPerson as $_key=>$_item) {
					if($_key != 'SEQ'){
						$data_res[$_item['FIELD']] = $r_sub[$_key];
					}
				  }
				  $data[$rec['ASSET_CODE']]['ownerList'] = $data_res;
				  
				$i++;
				
				
			} */
			 
 
		}
		
		$this->response = $data;
				
		return $this->response; 
		

	}
	
}

?>