<?php
class civilCaseAssetsBoatResponse extends civilCaseAssetsBoatJson {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAssetsBoatJson::getJson();
		$this->jsonPerson = civilCaseAssetsBoatJson::getJsonPerson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
				$filter = "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		//$sql = "SELECT CC.CIVIL_CODE, CC.COURT_CODE, CC.COURT_NAME, CC.DEPT_CODE, CC.DEPT_NAME, CC.PREFIX_BLACK_CASE, CC.BLACK_CASE, CC.BLACK_YY, CC.PREFIX_RED_CASE, CC.RED_CASE, CC.RED_YY, CAB.ASSET_CODE, CAB.ASSET_ID, CAB.ASSET_STATUS, CAB.BOAT_NO, CAB.BOAT_NAME, CAB.BOAT_ID, CAB.BOAT_TYPE, CAB.FLAG_NAME, CAB.PORT_NAME, CAB.BOAT_COMMENT, CAB.CHECK_COMMENT, CAB.PRICE, CAB.SEQ, CAB.HOLDING_GROUP, CAB.HOLDING_TYPE, CAB.HOLDING_AMOUNT FROM WH_CIVIL_CASE CC INNER JOIN WH_CIVIL_MAP_CASE_ASSET CA ON CC.CIVIL_CODE = CA.CIVIL_CODE INNER JOIN WH_CIVIL_CASE_ASSETS_BOAT CAB ON CAB.ASSET_CODE = CA.ASSET_CODE WHERE 1 = 1 { $filter } ";
		$sql = "SELECT
					A.PREFIX_BLACK_CASE,
					A.BLACK_CASE,
					A.BLACK_YY,
					A.PREFIX_RED_CASE,
					A.RED_CASE,
					A.RED_YY,
					B.CFC_BOAT_GEN,
					B.CFC_BOAT_REQ_GEN,
					B.CFC_CIVIL_GEN,
					B.SEQ_NO,
					B.BOAT_TYPE,
					B.BOAT_LOC_GEN,
					B.BOAT_NAME,
					B.BOAT_ID ,
					B.FLAG_NAME,
					B.PORT_NAME,
					B.BOAT_COMMENT,
					B.CHECK_COMMENT,
					B.EST_PRICE_AMOUNT,
					B.KEEP_PERSON_GEN,
					B.KEEP_LOCATION,
					B.KEEP_CENT_LOC_GEN,
					B.ASSET_STATUS ,
					B.CENT_DEPT_GEN,
					B.R_SELL_TYPE,
					B.CREATE_BY_USERID,
					B.CREATE_DATE,
					B.UPDATE_BY_USERID,
					B.UPDATE_DATE,
					B.CREATE_BY_PROGID,
					B.UPDATE_BY_PROGID,
					B.VERSION,
					B.DATA_ID,
					B.COPY_FLAG,
					B.USER_DEPT_CODE,
					B.DPD_STRUCTURE_GEN,
					B.BOAT_REGISTRATION_FLAG,
					B.WH_CIVIL_ID
				FROM
					WH_CIVIL_CASE A
				LEFT JOIN WH_CIVIL_CASE_ASSETS_BOAT B ON A.WH_CIVIL_ID = B.WH_CIVIL_ID
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
		  $data[$rec['CFC_BOAT_GEN']] = $data_res;	
		
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