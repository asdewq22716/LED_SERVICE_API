<?php
class civilCaseAssetsBuildingResponse extends civilCaseAssetsBuildingJson {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAssetsBuildingJson::getJson();
		$this->jsonPerson = civilCaseAssetsBuildingJson::getJsonPerson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter = "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		//$sql = "SELECT CC.CIVIL_CODE, CC.COURT_CODE, CC.COURT_NAME, CC.DEPT_CODE, CC.DEPT_NAME, CC.PREFIX_BLACK_CASE, CC.BLACK_CASE, CC.BLACK_YY, CC.PREFIX_RED_CASE, CC.RED_CASE, CC.RED_YY, CAB.ASSET_CODE, CAB.ASSET_ID, CAB.ASSET_STATUS, CAB.BUILDING_STYLE, CAB.LAND_TYPE, CAB.VILLAGE_NAME, CAB.ADDR_NO, CAB.MOO_NO, CAB.SOI, CAB.ROAD, CAB.HOUSE_DESC, CAB.WIDE, CAB.HOUSE_LONG, CAB.BUILDING_AREA_AMOUNT, CAB.PRICE_SQUARE_MATER, CAB.PRICE_BUILDING, CAB.TUM_CODE, CAB.TUM_NAME, CAB.AMP_CODE, CAB.AMP_NAME, CAB.PROV_CODE, CAB.PROV_NAME, CAB.ZIP_CODE, CAB.SEQ, CAB.HOLDING_GROUP, CAB.HOLDING_TYPE, CAB.HOLDING_AMOUNT FROM WH_CIVIL_CASE CC INNER JOIN WH_CIVIL_MAP_CASE_ASSET CA ON CC.CIVIL_CODE = CA.CIVIL_CODE INNER JOIN WH_CIVIL_CASE_ASSETS_BUILDING CAB ON CAB.ASSET_CODE = CA.ASSET_CODE WHERE 1 = 1 { $filter } ";
		$sql = "SELECT
					CC.CIVIL_CODE,
					CC.COURT_CODE,
					CC.COURT_NAME,
					CC.DEPT_CODE,
					CC.DEPT_NAME,
					CC.PREFIX_BLACK_CASE,
					CC.BLACK_CASE,
					CC.BLACK_YY,
					CC.PREFIX_RED_CASE,
					CC.RED_CASE,
					CC.RED_YY,
					CAB.CFC_HOUSE_GEN,
					CAB.CFC_HOUSE_REQ_GEN,
					CAB.CFC_CIVIL_GEN,
					CAB.SEQ_NO,
					CAB.HOUSE_TYPE,
					CAB.LAND_TYPE,
					CAB.VILLAGE_NAME,
					CAB.ADDR_NO,
					CAB.MOO_NO,
					CAB.SOI,
					CAB.ROAD,
					CAB.SOI,
					CAB.ROAD,
					CAB.CENT_LOC_GEN,
					CAB.POST_CODE,
					CAB.HOUSE_DESC,
					CAB.WIDE,
					CAB.HOUSE_LONG,
					CAB.FLOOR,
					CAB.AREA,
					CAB.EST_PER_METR_AMOUNT,
					CAB.ADD_PERCENT,
					CAB.ADD_AMOUNT,
					CAB.MINUS_PERCENT,
					CAB.MINUS_AMOUNT,
					CAB.EST_ASS_AMOUNT,
					CAB.EST_GOV_AMOUNT,
					CAB.EST_PRICE_AMOUNT,
					CAB.HOUSE_COMMENT,
					CAB.NEARLY_AREA,
					CAB.R_SELL_TYPE,
					CAB.ASSET_STATUS,
					CAB.CENT_DEPT_GEN,
					CAB.LAND_FLAG,
					CAB.LAND_DESC,
					CAB.LAND_OWNER,
					CAB.HOUSE_AGE,
					CAB.RELETE_TYPE,
					CAB.UPDATE_DATE,
					CAB.CREATE_DATE,
					CAB.CREATE_BY_PROGID,
					CAB.UPDATE_BY_PROGID,
					CAB.DATA_ID,
					CAB.VERSION,
					CAB.COPY_FLAG,
					CAB.USER_DEPT_CODE,
					CAB.DPD_STRUCTURE_GEN,
					CAB.HOUSE_REGISTRATION_FLAG,
					CAB.HOUSE_TRAIN_FLAG,
					CAB.UPDATE_BY_USERID,
					CAB.CREATE_BY_USERID,
					CAB.WH_CIVIL_ID
				FROM
					WH_CIVIL_CASE CC
				INNER JOIN WH_CIVIL_CASE_ASSETS_BUILDING CAB ON CAB.WH_CIVIL_ID = CC.WH_CIVIL_ID
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
		  $data[$rec['CFC_HOUSE_GEN']] = $data_res;	
		
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