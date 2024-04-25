<?php
class debtRehabilitationCaseCreditorResponse extends debtRehabilitationCaseCreditor {
	
	
	private $resPonse;		
	private $json;

	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = debtRehabilitationCaseCreditor::getJson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter .= "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		$sql = "SELECT BANKRUPT_CODE,COURT_CODE,COURT_NAME,DEPT_CODE,DEPT_NAME,PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,
		PREFIX_RED_CASE,RED_CASE,RED_YY,COURT_DATE,CAPITAL_AMOUNT,PLAINTIFF1,PLAINTIFF2,PLAINTIFF3,DEFFENDANT1,
		DEFFENDANT2,DEFFENDANT3,RECORD_COUNT,PERSON_LIST,REQ,PERSON_CODE,REGISTER_CODE,PREFIX_CODE,PREFIX_NAME,
		FIRST_NAME,LAST_NAME,MONEY_DEBT,CONCERN_NO,ADDRESS,TUM_CODE
		FROM WH_REHABILITATION_CREDITOR WHERE 1 = 1 {$filter}";
		

		$objResponse = $this->json['response'];
		
		$this->response = array();
		$data = array();
		
		$query = db::query($sql);	
		while($rec = db::fetch_array($query)){ 
		
		  $data_res = array();
		  foreach((array)$objResponse as $_key=>$_item) {
			$data_res[$_item['FIELD']] = $rec[$_key];
		  }
		  $data[$rec['BANKRUPT_CODE']] = $data_res;	
		
		}
		
		$this->response = $data;
		
		
		return $this->response; 
		
		
		
	}
			

		
  }

?>