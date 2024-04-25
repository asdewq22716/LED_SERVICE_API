<?php

class civilCasePersonResponse extends civilCasePersonJson {
	
	
	private $resPonse;		
	private $json;

	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
	
		$this->resPonse = false;		
		$this->json = civilCasePersonJson::getJson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']] != '' && $request[$v['FIELD']] != '?'){ 
			$filter .= "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		 $sql = "SELECT WH_CIVIL_CASE.CIVIL_CODE, WH_CIVIL_CASE.COURT_CODE, WH_CIVIL_CASE.COURT_NAME, WH_CIVIL_CASE.DEPT_CODE, WH_CIVIL_CASE.DEPT_NAME, WH_CIVIL_CASE.PREFIX_BLACK_CASE, WH_CIVIL_CASE.BLACK_CASE, WH_CIVIL_CASE.BLACK_YY, WH_CIVIL_CASE.PREFIX_RED_CASE, WH_CIVIL_CASE.RED_CASE, WH_CIVIL_CASE.RED_YY, WH_CIVIL_DOSS.DOSS_ID, WH_CIVIL_DOSS.DOSS_CONTROL,WH_CIVIL_CASE_PERSON.PERSON_CODE, WH_CIVIL_CASE_PERSON.REGISTER_CODE, WH_CIVIL_CASE_PERSON.PREFIX_CODE, WH_CIVIL_CASE_PERSON.PREFIX_NAME, WH_CIVIL_CASE_PERSON.FIRST_NAME, WH_CIVIL_CASE_PERSON.LAST_NAME FROM WH_CIVIL_CASE LEFT JOIN WH_CIVIL_DOSS ON WH_CIVIL_CASE.CIVIL_CODE = WH_CIVIL_DOSS.CIVIL_CODE LEFT JOIN WH_CIVIL_CASE_PERSON ON WH_CIVIL_CASE.CIVIL_CODE = WH_CIVIL_CASE_PERSON.CIVIL_CODE WHERE 1 = 1 ".$filter; 
		// exit;
		// $sql = "SELECT WH_CIVIL_CASE.CIVIL_CODE, WH_CIVIL_CASE.COURT_CODE, WH_CIVIL_CASE.COURT_NAME, WH_CIVIL_CASE.DEPT_CODE, WH_CIVIL_CASE.DEPT_NAME, WH_CIVIL_CASE.PREFIX_BLACK_CASE, WH_CIVIL_CASE.BLACK_CASE, WH_CIVIL_CASE.BLACK_YY, WH_CIVIL_CASE.PREFIX_RED_CASE, WH_CIVIL_CASE.RED_CASE, WH_CIVIL_CASE.RED_YY, WH_CIVIL_DOSS.DOSS_ID, WH_CIVIL_DOSS.DOSS_CONTROL, WH_CIVIL_CASE_PERSON.RECORD_COUNT, WH_CIVIL_CASE_PERSON.REQ, WH_CIVIL_CASE_PERSON.PERSON_CODE, WH_CIVIL_CASE_PERSON.REGISTER_CODE, WH_CIVIL_CASE_PERSON.PREFIX_CODE, WH_CIVIL_CASE_PERSON.PREFIX_NAME, WH_CIVIL_CASE_PERSON.FIRST_NAME, WH_CIVIL_CASE_PERSON.LAST_NAME FROM WH_CIVIL_CASE INNER JOIN WH_CIVIL_DOSS ON WH_CIVIL_CASE.CIVIL_CODE = WH_CIVIL_DOSS.CIVIL_CODE INNER JOIN WH_CIVIL_CASE_PERSON ON WH_CIVIL_CASE.CIVIL_CODE = WH_CIVIL_CASE_PERSON.CIVIL_CODE
		// WHERE 1 = 1 {$filter}";
		

		$objResponse = $this->json['response'];
		
		$this->response = array();
		$data = array();
		$aa = 'aaaaaaaaaa';
		
		$query = db::query($sql);	
		while($rec = db::fetch_array($query)){ 
		
		  $data_res = array();
		  foreach((array)$objResponse as $_key=>$_item) {
			$data_res[$_item['FIELD']] = $rec[$_key];
			$aa = $_item['FIELD'];
		  }
		  $data[] = $data_res;	
		
		}
		
		$this->response = $data;
		
		return $this->response; 
		
		
		
	}
			

		
  }

?>