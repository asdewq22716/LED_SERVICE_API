<?php
class mediateCaseResponse extends mediateCaseJson {
	
	
	private $resPonse;		
	private $json;

	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = mediateCaseJson::getJson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter .= "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		$sql = "SELECT REF_MEDIATE_ID,RECEIVE_DATE,REQ_FNAME,PLAINTIFF_FNAME,DEFENDANT_FNAME,COURT_ID,COURT_NAME,
		CHANNEL_ID,CHANNEL_NAME,TYPE_MEDIATE_ID,TYPE_MEDIATE_NAME
		FROM WH_MEDIATE_CASE WHERE 1 = 1 {$filter}";
		

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