<?php

class civilCaseAssetsCondoResponse extends civilCaseAssetsCondoJson {
	
	
	private $resPonse;		
	private $json;

	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAssetsCondoJson::getJson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter .= "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		/* $sql = "SELECT WH_CIVIL_CASE.CIVIL_CODE, WH_CIVIL_CASE.COURT_CODE, WH_CIVIL_CASE.COURT_NAME, WH_CIVIL_CASE.DEPT_CODE, WH_CIVIL_CASE.DEPT_NAME, WH_CIVIL_CASE.PREFIX_BLACK_CASE, WH_CIVIL_CASE.BLACK_CASE, WH_CIVIL_CASE.BLACK_YY, WH_CIVIL_CASE.PREFIX_RED_CASE, WH_CIVIL_CASE.RED_CASE, WH_CIVIL_CASE.RED_YY, WH_CIVIL_MAP_CASE_ASSET.ASSET_DETAIL, WH_CIVIL_CASE_ASSETS_CONDO.ASSET_CODE, WH_CIVIL_CASE_ASSETS_CONDO.ASSET_ID, WH_CIVIL_CASE_ASSETS_CONDO.ASSET_STATUS, WH_CIVIL_CASE_ASSETS_CONDO.BUILDING_VILLAGE, WH_CIVIL_CASE_ASSETS_CONDO.BUILDING_NO, WH_CIVIL_CASE_ASSETS_CONDO.CONDO_FLOOR, WH_CIVIL_CASE_ASSETS_CONDO.CONDO_REGIS_NO, WH_CIVIL_CASE_ASSETS_CONDO.CONCERN_NAME, WH_CIVIL_CASE_ASSETS_CONDO.LAND_DETAIL, WH_CIVIL_CASE_ASSETS_CONDO.PRICE, WH_CIVIL_CASE_ASSETS_CONDO.TUM_CODE, WH_CIVIL_CASE_ASSETS_CONDO.TUM_NAME, WH_CIVIL_CASE_ASSETS_CONDO.AMP_CODE, WH_CIVIL_CASE_ASSETS_CONDO.AMP_NAME, WH_CIVIL_CASE_ASSETS_CONDO.PROV_CODE, WH_CIVIL_CASE_ASSETS_CONDO.PROV_NAME, WH_CIVIL_CASE_ASSETS_CONDO.ZIP_CODE, WH_CIVIL_CASE_PERSON.REQ, WH_CIVIL_ASSET_OWNER.PERSON_CODE, WH_CIVIL_CASE_PERSON.REGISTER_CODE, WH_CIVIL_CASE_PERSON.PREFIX_CODE, WH_CIVIL_CASE_PERSON.PREFIX_NAME, WH_CIVIL_CASE_PERSON.FIRST_NAME, WH_CIVIL_CASE_PERSON.LAST_NAME, WH_CIVIL_CASE_PERSON.CONCERN_CODE, WH_CIVIL_CASE_PERSON.CONCERN_NAME, WH_CIVIL_CASE_PERSON.CONCERN_NO, WH_CIVIL_CASE_ASSETS_CONDO.HOLDING_GROUP, WH_CIVIL_CASE_ASSETS_CONDO.HOLDING_TYPE, WH_CIVIL_CASE_ASSETS_CONDO.HOLDING_AMOUNT FROM WH_CIVIL_CASE INNER JOIN WH_CIVIL_MAP_CASE_ASSET ON WH_CIVIL_CASE.CIVIL_CODE = WH_CIVIL_MAP_CASE_ASSET.CIVIL_CODE INNER JOIN WH_CIVIL_CASE_ASSETS_CONDO ON WH_CIVIL_MAP_CASE_ASSET.ASSET_CODE = WH_CIVIL_CASE_ASSETS_CONDO.ASSET_CODE INNER JOIN WH_CIVIL_ASSET_OWNER ON WH_CIVIL_CASE_ASSETS_CONDO.ASSET_CODE = WH_CIVIL_ASSET_OWNER.ASSET_CODE INNER JOIN WH_CIVIL_CASE_PERSON ON WH_CIVIL_ASSET_OWNER.PERSON_CODE = WH_CIVIL_CASE_PERSON.PERSON_CODE
		WHERE 1 = 1 {$filter}"; */
		$sql = "SELECT
					wh_civil.CIVIL_CODE,
					wh_civil.COURT_CODE,
					wh_civil.COURT_NAME,
					wh_civil.DEPT_CODE,
					wh_civil.DEPT_NAME,
					wh_civil.PREFIX_BLACK_CASE,
					wh_civil.BLACK_CASE,
					wh_civil.BLACK_YY,
					wh_civil.PREFIX_RED_CASE,
					wh_civil.RED_CASE,
					wh_civil.RED_YY,
					condo.CFC_BUILDING_GEN,
					condo.CFC_CIVIL_GEN,
					condo.CFC_BUILDING_REQ_GEN,
					condo.SEQ_NO,
					condo.ADDR_NO,
					condo.FLOOR,
					condo.BUILDING_NO,
					condo.BUILDING_NAME,
					condo.LICENSE_NO,
					condo.DEED_NO,
					condo.DISTRICT_NAME,
					condo.AMPHUR_NAME,
					condo.PROVINCE_NAME,
					condo.SOI,
					condo.MOO_NO,
					condo.ROAD,
					condo.CENT_LOC_GEN,
					condo.FARM,
					condo.NGAN,
					condo.VA,
					condo.REMAIN_VA,
					condo.REMAIN_BASE,
					condo.EST_AREA,
					condo.HIGHT,
					condo.R_SELL_TYPE,
					condo.OWNER_DIVIDEND,
					condo.OWNER_DIVISOR,
					condo.CENTER_AMOUNT,
					condo.CENTER_METR_AMOUNT,
					condo.CENTER_PERIOD,
					condo.CENTER_DEBT_DATE,
					condo.CENTER_EXPENSE_AMOUNT,
					condo.CENTER_DEBT_PERIOD,
					condo.PER_METR_AMOUNT,
					condo.ADD_PERCENT,
					condo.ADD_AMOUNT,
					condo.MINUS_PERCENT,
					condo.MINUS_AMOUNT,
					condo.EST_ASS_AMOUNT,
					condo.EST_GOV_AMOUNT,
					condo.EST_PRICE_AMOUNT,
					condo.BUILDING_DESC,
					condo.NEARLY_AREA,
					condo.ASSET_STATUS,
					condo.CENT_DEPT_GEN,
					condo.UPDATE_BY_USERID,
					condo.UPDATE_DATE,
					condo.CREATE_DATE,
					condo.CREATE_BY_PROGID,
					condo.UPDATE_BY_PROGID,
					condo.CREATE_BY_USERID,
					condo.VERSION ,
					condo.DATA_ID,
					condo.COPY_FLAG,
					condo.USER_DEPT_CODE,
					condo.DPD_STRUCTURE_GEN,
					condo.BUILDING_AGE,
					condo.BUILDING_REGISTRATION_FLAG,
					condo.BUILDING_TRAIN_FLAG,
					condo.WH_CIVIL_ID
				FROM
					WH_CIVIL_CASE wh_civil
				INNER JOIN WH_CIVIL_CASE_ASSETS_CONDO condo ON wh_civil.WH_CIVIL_ID = condo.WH_CIVIL_ID
				WHERE
					1 = 1 {$filter}";

		$objResponse = $this->json['response'];
		
		$this->response = array();
		$data = array();
		
		$query = db::query($sql);	
		while($rec = db::fetch_array($query)){ 
		
		  $data_res = array();
		  foreach((array)$objResponse as $_key=>$_item) {
			$data_res[$_item['FIELD']] = $rec[$_key];
		  }
		  $data[$rec['CIVIL_CODE']] = $data_res;	
		
		}
		
		$this->response = $data;
		
		
		return $this->response; 
		
		
		
	}
			

		
  }

?>