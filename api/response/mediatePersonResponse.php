<?php
class mediatePersonResponse extends mediatePerson {
	
	
	private $resPonse;		
	private $json;

	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = mediatePerson::getJson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter .= "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		 $sql = "SELECT CIVIL_CODE,COURT_CODE,COURT_NAME,DEPT_CODE,DEPT_NAME,PREFIX_BLACK_CASE,BLACK_CASE,
		BLACK_YY,PREFIX_RED_CASE,RED_CASE,RED_YY,RECORD_COUNT,PERSON_LIST,
		REQ,PERSON_CODE,REGISTER_CODE,PREFIX_CODE,
		PREFIX_NAME,FIRST_NAME,LAST_NAME,CONCERN_CODE,CONCERN_NAME,CONCERN_NO,ADDRESS,TUM_CODE,TUM_NAME,AMP_CODE,
		AMP_NAME,PROV_CODE,PROV_NAME,ZIP_CODE
		FROM WH_MEDIATE_PERSON WHERE 1 = 1 {$filter}";
		

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