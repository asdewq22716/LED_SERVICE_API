<?php

class civilCaseAccountResponse extends civilCaseAccountJson {
	
	
	private $resPonse;		
	private $json;

	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAccountJson::getJson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter .= "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		$sql = "SELECT WH_CIVIL_CASE_ACCOUNT.ACCOUNT_NO, WH_CIVIL_CASE_ACCOUNT.ACCOUNT_DATE, WH_CIVIL_CASE_ACCOUNT.ACCOUNT_SDATE, WH_CIVIL_CASE.COURT_CODE, WH_CIVIL_CASE.COURT_NAME, WH_CIVIL_CASE.DEPT_CODE, WH_CIVIL_CASE.DEPT_NAME, WH_CIVIL_CASE.PREFIX_BLACK_CASE, WH_CIVIL_CASE.BLACK_CASE, WH_CIVIL_CASE.BLACK_YY, WH_CIVIL_CASE.PREFIX_RED_CASE, WH_CIVIL_CASE.RED_CASE, WH_CIVIL_CASE.RED_YY, WH_CIVIL_CASE_ACCOUNT.DOSS_ID, WH_CIVIL_CASE_ACCOUNT.DOSS_NAME, WH_CIVIL_CASE_ACCOUNT.OFFICE_IDCARD, WH_CIVIL_CASE_ACCOUNT.OFFICE_NAME, WH_CIVIL_CASE_ACCOUNT.ACCOUNT_IDCARD, WH_CIVIL_CASE_ACCOUNT.ACCOUNT_NAME, WH_CIVIL_CASE_ACCOUNT.APPROVE_NAME, WH_CIVIL_CASE_ACCOUNT.CHARGE_INT_DATE, WH_CIVIL_CASE_ACCOUNT.END_INT_DATE, WH_CIVIL_CASE_ACCOUNT.ADJUST_DATE, WH_CIVIL_CASE_ACCOUNT.END_ACCOUNT_COMMENT, WH_CIVIL_ACC_REC.SEQ_NO, WH_CIVIL_ACC_REC.REC_DATE, WH_CIVIL_ACC_REC.REC_DETAIL, WH_CIVIL_ACC_REC.AMOUNT, WH_CIVIL_ACC_ORDER.SEQ_NO, WH_CIVIL_ACC_ORDER.ORDER_DATE, WH_CIVIL_ACC_ORDER.ORDER_DETAIL, WH_CIVIL_ACC_ORDER.AMOUNT, WH_CIVIL_ACC_CHARGE.SEQ_NO, WH_CIVIL_ACC_CHARGE.CHARGE_DETAL, WH_CIVIL_ACC_CHARGE.CHARGE_TYPE, WH_CIVIL_ACC_CHARGE.CHARGE_AMOUNT FROM WH_CIVIL_CASE INNER JOIN WH_CIVIL_CASE_ACCOUNT ON WH_CIVIL_CASE.CIVIL_CODE = WH_CIVIL_CASE_ACCOUNT.CIVIL_CODE INNER JOIN WH_CIVIL_ACC_REC ON WH_CIVIL_CASE_ACCOUNT.ACCOUNT_ID = WH_CIVIL_ACC_REC.ACCOUNT_ID INNER JOIN WH_CIVIL_ACC_ORDER ON WH_CIVIL_ACC_REC.ACCOUNT_ID = WH_CIVIL_ACC_ORDER.ACCOUNT_ID INNER JOIN WH_CIVIL_ACC_CHARGE ON WH_CIVIL_ACC_ORDER.ACCOUNT_ID = WH_CIVIL_ACC_CHARGE.ACCOUNT_ID
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