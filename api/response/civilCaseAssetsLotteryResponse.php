<?php
class civilCaseAssetsLotteryResponse extends civilCaseAssetsLotteryJson {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAssetsLotteryJson::getJson();
		$this->jsonPerson = civilCaseAssetsLotteryJson::getJsonPerson();
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
					lottery.CFC_SAVE_GEN,
					lottery.CFC_CIVIL_GEN,
					lottery.SEQ_NO,
					lottery.SAVE_ORG_GEN,
					lottery.SAVE_NO_FR,
					lottery.SAVE_NO_TO,
					lottery.SAVE_UNIT,
					lottery.SAVE_UNIT_PRI,
					lottery.SAVE_AMT,
					lottery.SAVE_OFFICE,
					lottery.SAVE_BOOK_NO,
					lottery.SAVE_RECV_DATE,
					lottery.SAVE_START_DATE,
					lottery.SAVE_END_DATE,
					lottery.SAVE_DEAD_LINE_DATE,
					lottery.SAVE_VALUE,
					lottery.SAVE_RUN_NO,
					lottery.SAVE_DESC_OTH,
					lottery.CREATE_BY_USERID,
					lottery.CREATE_DATE,
					lottery.UPDATE_BY_USERID,
					lottery.UPDATE_DATE,
					lottery.CREATE_BY_PROGID,
					lottery.UPDATE_BY_PROGID,
					lottery.VERSION,
					lottery.DATA_ID ,
					lottery.CENT_DEPT_GEN,
					lottery.CFC_SAVE_REQ_GEN,
					lottery.EST_PRICE_AMOUNT,
					lottery.COPY_FLAG,
					lottery.SAVE_NAME,
					lottery.USER_DEPT_CODE,
					lottery.DPD_STRUCTURE_GEN,
					lottery.ALIAS_NAME,
					lottery.PRE_SAVE_NO_FROM,
					lottery.PRE_SAVE_NO_TO,
					lottery.SAVE_REGISTRATION_FLAG,
					lottery.WH_CIVIL_ID
				FROM
					WH_CIVIL_CASE wh_case
				LEFT JOIN WH_CIVIL_CASE_ASSETS_LOTTERY lottery ON wh_case.WH_CIVIL_ID = lottery.WH_CIVIL_ID
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
		  $data[$rec['ASSET_CODE']] = $data_res;	
		
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