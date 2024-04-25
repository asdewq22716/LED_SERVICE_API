<?php
class civilCaseAssetsBondResponse extends civilCaseAssetsBondJson {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}	
	
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAssetsBondJson::getJson();
		$this->jsonPerson = civilCaseAssetsBondJson::getJsonPerson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter = "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		//$sql = "SELECT CC.CIVIL_CODE, CC.COURT_CODE, CC.COURT_NAME, CC.DEPT_CODE, CC.DEPT_NAME, CC.PREFIX_BLACK_CASE, CC.BLACK_CASE, CC.BLACK_YY, CC.PREFIX_RED_CASE, CC.RED_CASE, CC.RED_YY, CAB.ASSET_CODE, CAB.ASSET_ID, CAB.ASSET_TYPE, CAB.ASSET_STATUS, CAB.BOND_NAME, CAB.START_NO, CAB. TO, CAB.BOND_ISSUER, CAB.BONDS_ID, CAB.ISIN_CODE, CAB.BONDS_NO, CAB.BOND_PERSON_NAME, CAB.NO_UNIT, CAB.PRICE_UNIT, CAB.PRICE_SUM, CAB.SEQ, CAB.HOLDING_GROUP, CAB.HOLDING_TYPE, CAB.HOLDING_AMOUNT FROM WH_CIVIL_CASE CC INNER JOIN WH_CIVIL_MAP_CASE_ASSET CA ON CC.CIVIL_CODE = CA.CIVIL_CODE INNER JOIN WH_CIVIL_CASE_ASSETS_BOND CAB ON CAB.ASSET_CODE = CA.ASSET_CODE WHERE 1 = 1 { $filter } ";
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
					bond.CFC_BONDS_GEN,
					bond.CFC_BONDS_REQ_GEN,
					bond.CFC_CIVIL_GEN,
					bond.SEQ_NO,
					bond.BONDS_PERSON_GEN,
					bond.UNIT_AMOUNT,
					bond.BONDS_ID,
					bond.BONDS_NO,
					bond.RECEIVE_AMOUNT,
					bond.RECEIVE_PERIOD,
					bond.FROM_DATE,
					bond.INTEREST_RATE,
					bond.RECEIVE_DATE1,
					bond.RECEIVE_DATE2,
					bond.BONDS_RIGHT,
					bond.EST_PRICE_AMOUNT,
					bond.R_SELL_TYPE,
					bond.ASSET_STATUS,
					bond.CENT_DEPT_GEN,
					bond.CREATE_BY_USERID,
					bond.CREATE_DATE,
					bond.UPDATE_BY_USERID,
					bond.UPDATE_DATE,
					bond.CREATE_BY_PROGID,
					bond.UPDATE_BY_PROGID,
					bond.VERSION,
					bond.DATA_ID,
					bond.COPY_FLAG,
					bond.BONDS_NAME,
					bond.DPD_STRUCTURE_GEN,
					bond.BONDS_NO_TO,
					bond.ISIN_CODE,
					bond.BOND_AMT,
					bond.BONDS_REGISTRATION_FLAG,
					bond.BONDS_COMMENT,
					bond.WH_CIVIL_ID
				FROM
					WH_CIVIL_CASE wh_case
				LEFT JOIN WH_CIVIL_CASE_ASSETS_BOND bond ON wh_case.WH_CIVIL_ID = bond.WH_CIVIL_ID
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
		  $data[$rec['CFC_BONDS_GEN']] = $data_res;	
		
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