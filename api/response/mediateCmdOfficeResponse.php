<?php
class mediateCmdOfficeResponse extends mediateCmdOfficeJson {
	
	
	private $resPonse;		
	private $json;

	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = mediateCmdOfficeJson::getJson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter .= "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		$sql = "SELECT CIVIL_CODE,COURT_CODE,COURT_NAME,DEPT_CODE,DEPT_NAME,PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,
		PREFIX_RED_CASE,RED_CASE,RED_YY,COURT_DATE,CAPITAL_AMOUNT,PLAINTIFF1,PLAINTIFF2,PLAINTIFF3,DEFFENDANT1,
		DEFFENDANT2,DEFFENDANT3,RECORD_COUNT,CMD_OFFICE_LIST,SEQ,CMD_DATE,OFFICE_IDCARD,OFFICE_NAME,CMD_TYPE_CODE,
		CMD_TYPE_NAME,CMD_DETAIL
		FROM WH_MEDIATE_CMD_OFFICE WHERE 1 = 1 {$filter}";


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