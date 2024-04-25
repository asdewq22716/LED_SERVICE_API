<?php

class civilCaseOrderResponse extends civilCaseOrderJson {
	
	
	private $resPonse;		
	private $json;

	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseOrderJson::getJson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter .= "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		$sql = "SELECT WH_CIVIL_CASE.CIVIL_CODE, WH_CIVIL_CASE.COURT_CODE, WH_CIVIL_CASE.COURT_NAME, WH_CIVIL_CASE.DEPT_CODE, WH_CIVIL_CASE.DEPT_NAME, WH_CIVIL_CASE.PREFIX_BLACK_CASE, WH_CIVIL_CASE.BLACK_CASE, WH_CIVIL_CASE.BLACK_CASE, WH_CIVIL_CASE.BLACK_YY, WH_CIVIL_CASE.PREFIX_RED_CASE, WH_CIVIL_CASE.RED_CASE, WH_CIVIL_CASE.RED_YY, 
		WH_CIVIL_CASE_ORDER.DOC_DATE, WH_CIVIL_CASE_ORDER.RECORD_COUNT, WH_CIVIL_ORDER_LIST.CHECK_NAME, WH_CIVIL_ORDER_TYPE.ORDER_SEQ, 
		WH_CIVIL_ORDER_TYPE.ORDER_REC_GEN, WH_CIVIL_ORDER_TYPE.ORDER_NAME, WH_CIVIL_ORDER_TYPE.ORDER_MONEY 
		FROM WH_CIVIL_CASE 
		INNER JOIN WH_CIVIL_CASE_ORDER ON WH_CIVIL_CASE.CIVIL_CODE = WH_CIVIL_CASE_ORDER.CIVIL_CODE 
		INNER JOIN WH_CIVIL_ORDER_LIST ON WH_CIVIL_CASE_ORDER.ORDER_NO = WH_CIVIL_ORDER_LIST.ORDER_NO 
		INNER JOIN WH_CIVIL_ORDER_TYPE ON WH_CIVIL_CASE_ORDER.ORDER_NO = WH_CIVIL_ORDER_TYPE.ORDER_NO 
		WHERE 1 = 1 {$filter}";
		

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