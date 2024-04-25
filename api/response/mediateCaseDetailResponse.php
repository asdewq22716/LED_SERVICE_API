<?php
class mediateCaseDetailResponse extends mediateCaseDetail {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = mediateCaseDetail::getJson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter .= "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		$sql = "SELECT CIVIL_CODE,COURT_CODE,COURT_NAME,DEPT_CODE,DEPT_NAME,CASE_TYPE_CODE,CASE_TYPE_NAME,CASE_LAWS_CODE,
		CASE_LAWS_NAME,PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,PREFIX_RED_CASE,RED_CASE,RED_YY,
		COURT_DATE,CAPITAL_AMOUNT,PLAINTIFF1,PLAINTIFF2,PLAINTIFF3,
		DEFFENDANT1,DEFFENDANT2,DEFFENDANT3,IMAGE_COURT 
		FROM WH_MEDIATE_CASE_DETAIL WHERE 1 = 1 {$filter}";

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
		  $data[$rec['CIVIL_CODE']] = $data_res;	
		
		}
		
		$this->response = $data;
		
		
		return $this->response; 
		
		
		
	}
			

		
  }

?>