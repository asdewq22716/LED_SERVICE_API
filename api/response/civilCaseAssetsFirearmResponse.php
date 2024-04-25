<?php
class civilCaseAssetsFirearmResponse extends civilCaseAssetsFirearmJson {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAssetsFirearmJson::getJson();
		$this->jsonPerson = civilCaseAssetsFirearmJson::getJsonPerson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
				$filter = "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		//$sql = "SELECT CC.CIVIL_CODE, CC.COURT_CODE, CC.COURT_NAME, CC.DEPT_CODE, CC.DEPT_NAME, CC.PREFIX_BLACK_CASE, CC.BLACK_CASE, CC.BLACK_YY, CC.PREFIX_RED_CASE, CC.RED_CASE, CC.RED_YY, CAL.ASSET_CODE, CAL.ASSET_ID, CAL.ASSET_STATUS, CAL.LOTTERY_NAME, CAL.BRANCE, CAL.START_NO, CAL.DUEDATE, CAL.NO_UNIT, CAL.PRICE_UNIT, CAL.PRICE_SUM, CAL.HOLDING_GROUP, CAL.HOLDING_TYPE, CAL.HOLDING_AMOUNT FROM WH_CIVIL_CASE CC INNER JOIN WH_CIVIL_MAP_CASE_ASSET CA ON CC.CIVIL_CODE = CA.CIVIL_CODE INNER JOIN WH_CIVIL_CASE_ASSETS_LOTTERY CAL ON CAL.ASSET_CODE = CA.ASSET_CODE WHERE 1 = 1 {$filter}";
		$sql = "SELECT
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
					gun.CFC_GUN_GEN AS cfcGunGen,
					gun.CFC_CIVIL_GEN AS cfcCivilGen,
					gun.CFC_GUN_REQ_GEN AS cfcGunReqGen,
					gun.SEQ_NO AS seqNo,
					gun.LICENSE_NO AS licenseNo,
					gun.LICENSE_YR AS licenseYr,
					gun.LICENSE_PLACE AS licensePlace,
					gun.LICENSE_DATE AS licenseDate,
					gun.TYPE_DESC AS typeDesc,
					gun.GUN_SIZE AS gunSize,
					gun.GUN_NO AS gunNo,
					gun.MAKE_PERSON AS makePerson,
					gun.GUN_SIGN AS gunSign,
					gun.FROM_PERSON AS fromPerson,
					gun.BULLET_DESC AS bulletDesc,
					gun.ACCESSORY_DESC AS accessoryDesc,
					gun.FEE_AMOUNT AS feeAmount,
					gun.EST_PRICE_AMOUNT AS estPriceAmount,
					gun.KEEP_PERSON_GEN AS keepPersonGen,
					gun.KEEP_LOCATION AS keepLocation,
					gun.KEEP_CENT_LOC_GEN AS keepCentLocGen,
					gun.R_SELL_TYPE AS rSellType,
					gun.ASSET_STATUS AS assetStatus,
					gun.CENT_DEPT_GEN AS centDeptGen,
					gun.CREATE_BY_USERID AS createByUserid,
					gun.CREATE_DATE AS createDate,
					gun.UPDATE_BY_USERID AS updateByUserid,
					gun.UPDATE_DATE AS updateDate,
					gun.CREATE_BY_PROGID AS createByProgid,
					gun.UPDATE_BY_PROGID AS updateByProgid,
					gun.VERSION AS version,
					gun.DATA_ID AS dataId,
					gun.COPY_FLAG AS copyFlag,
					gun.USER_DEPT_CODE AS userDeptCode,
					gun.DPD_STRUCTURE_GEN AS dpdStructureGen,
					gun.BRAND_NAME AS brandName,
					gun.GUN_COMMENT AS gunComment,
					gun.GUN_REGISTRATION_FLAG AS gunRegistrationFlag,
					gun.WH_CIVIL_ID AS whCivilId
				FROM
					WH_CIVIL_CASE wh_case
				LEFT JOIN WH_CIVIL_CASE_ASSETS_GUN gun ON wh_case.WH_CIVIL_ID = gun.WH_CIVIL_ID
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
		  $data[$rec['CFC_GUN_GEN']] = $data_res;	
		/* 
			$sql_sub = "SELECT 
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