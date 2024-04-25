<?php
class civilCaseAssetsStockResponse extends civilCaseAssetsStockJson {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAssetsStockJson::getJson();
		$this->jsonPerson = civilCaseAssetsStockJson::getJsonPerson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
				$filter = "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		//$sql = "SELECT CC.CIVIL_CODE, CC.COURT_CODE, CC.COURT_NAME, CC.DEPT_CODE, CC.DEPT_NAME, CC.PREFIX_BLACK_CASE, CC.BLACK_CASE, CC.BLACK_YY, CC.PREFIX_RED_CASE, CC.RED_CASE, CC.RED_YY, CAS.ASSET_CODE, CAS.ASSET_ID, CAS.ASSET_STATUS, CAS.STOCK_TYPE, CAS.STOCK_NO, CAS.STOCK_NO_TO, CAS.STOCK_NAME, CAS.STOCK_QTY, CAS.STOCK_DATE, CAS.COMPANY_GEN, CAS.STOCK_IN_OUT, CAS.STOCK_COMMENT, CAS.ACCOUNT_TYPE, CAS.MARKET_CAPITALIZATION, 'Price' AS Price, CAS.HOLDING_GROUP, CAS.HOLDING_TYPE, CAS.HOLDING_AMOUNT FROM WH_CIVIL_CASE CC INNER JOIN WH_CIVIL_MAP_CASE_ASSET CA ON CC.CIVIL_CODE = CA.CIVIL_CODE INNER JOIN WH_CIVIL_CASE_ASSETS_STOCK CAS ON CAS.ASSET_CODE = CA.ASSET_CODE WHERE 1 = 1 { $filter } ";
		
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
                    stock.CFC_STOCK_GEN,
                    stock.CFC_CIVIL_GEN,
                    stock.CFC_STOCK_REQ_GEN,
                    stock.SEQ_NO,
                    stock.STOCK_TYPE,
                    stock.COMPANY_GEN,
                    stock.STOCK_NAME,
                    stock.MANAGER_STOCK_NAME,
                    stock.UNIT_AMOUNT,
                    stock.STOCK_NO,
                    stock.TOTAL_AMOUNT,
                    stock.PAID_AMOUNT,
                    stock.HOLDER_LICENSE_NO,
                    stock.STOCK_QTY,
                    stock.STOCK_ID_FROM,
                    stock.STOCK_ID_TO,
                    stock.STOCK_DATE,
                    stock.STOCK_IN_OUT,
                    stock.STOCK_RIGHT,
                    stock.EST_PRICE_AMOUNT,
                    stock.STOCK_COMMENT,
                    stock.R_SELL_TYPE,
                    stock.ASSET_STATUS,
                    stock.CENT_DEPT_GEN,
                    stock.CREATE_BY_USERID,
                    stock.CREATE_DATE,
                    stock.UPDATE_BY_USERID,
                    stock.UPDATE_DATE,
                    stock.CREATE_BY_PROGID,
                    stock.UPDATE_BY_PROGID,
                    stock.VERSION,
                    stock.DATA_ID,
                    stock.COPY_FLAG,
                    stock.STOCK_COPY_FLAG,
                    stock.USER_DEPT_CODE,
                    stock.DPD_STRUCTURE_GEN,
                    stock.STOCK_REGISTRATION_FLAG,
                    stock.WH_CIVIL_ID
                FROM
                    WH_CIVIL_CASE wh_case
                LEFT JOIN WH_CIVIL_CASE_ASSETS_STOCK stock ON wh_case.WH_CIVIL_ID = stock.WH_CIVIL_ID
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
		  $data[$rec['CFC_STOCK_GEN']] = $data_res;	
		
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