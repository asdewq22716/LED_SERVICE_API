<?php
class civilCaseAssetsLandResponse extends civilCaseAssetsLandJson {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAssetsLandJson::getJson();
		$this->jsonPerson = civilCaseAssetsLandJson::getJsonPerson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter = "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}
	
		$sql = "SELECT CC.CIVIL_CODE, CC.COURT_CODE, CC.COURT_NAME, CC.DEPT_CODE, CC.DEPT_NAME, CC.PREFIX_BLACK_CASE, CC.BLACK_CASE, CC.BLACK_YY, CC.PREFIX_RED_CASE, CC.RED_CASE, CC.RED_YY, CAL.ASSET_CODE, CAL.ASSET_ID, CAL.ASSET_DOC_TYPE, CAL.ASSET_STATUS, CAL.BOOK_NO, CAL.PAGE_NO, CAL.FREIGHT, CAL.LAND_NO, CAL.SURVEY_PAGE, CAL.TUM_CODE, CAL.TUM_NAME, CAL.AMP_CODE, CAL.AMP_NAME, CAL.PROV_CODE, CAL.PROV_NAME, CAL.ZIP_CODE, CAL.OLD_TUM_NAME, CAL.OLD_AMP_NAME, CAL.OLD_PROV_NAME, CAL.AREA_RAI, CAL.AREA_NGAN, CAL.AREA_WA, CAL.AREA_FRACTION_WA, CAL.LAND_PRICE_PER_WA, CAL.LAND_PRICE, CAL.DETAIL, CAL.RECORD_COUNT, CAL.SEQ, CAL.HOLDING_GROUP, CAL.HOLDING_TYPE, CAL.HOLDING_AMOUNT FROM WH_CIVIL_CASE CC INNER JOIN WH_CIVIL_MAP_CASE_ASSET CA ON CC.CIVIL_CODE = CA.CIVIL_CODE INNER JOIN WH_CIVIL_CASE_ASSETS_LAND CAL ON CAL.ASSET_CODE = CA.ASSET_CODE WHERE 1 = 1 {$filter}";
			
							
				
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
		
			$sql_sub = "SELECT 
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
				
				
			}
			 
		
			
		 
		}
		
		$this->response = $data;
		
		
		return $this->response; 
		
		
		
	}
			

		
}

?>