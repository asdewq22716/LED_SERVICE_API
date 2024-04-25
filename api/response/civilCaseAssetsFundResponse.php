<?php
class civilCAFeAssetsFundResponse extends civilCAFeAssetsFundJson {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCAFeAssetsFundJson::getJson();
		$this->jsonPerson = civilCAFeAssetsFundJson::getJsonPerson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
				$filter = "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		//$sql = "SELECT CC.CIVIL_CODE, CC.COURT_CODE, CC.COURT_NAME, CC.DEPT_CODE, CC.DEPT_NAME, CC.PREFIX_BLACK_CAFE, CC.BLACK_CAFE, CC.BLACK_YY, CC.PREFIX_RED_CAFE, CC.RED_CAFE, CC.RED_YY, CAF.ASSET_CODE, CAF.ASSET_ID, CAF.ASSET_STATUS, CAF.FUND_NO, CAF.FUND_AMOUNT, CAF.PRICE FROM WH_CIVIL_CAFE CC INNER JOIN WH_CIVIL_MAP_CAFE_ASSET CA ON CC.CIVIL_CODE = CA.CIVIL_CODE INNER JOIN WH_CIVIL_CAFE_ASSETS_FUND CAF ON CAF.ASSET_CODE = CA.ASSET_CODE WHERE 1 = 1 {$filter}";
		$sql = "SELECT
					A.PREFIX_BLACK_CASE,
					A.BLACK_CASE,
					A.BLACK_YY,
					A.PREFIX_RED_CASE,
					A.RED_CASE,
					A.RED_YY,
					B.CFC_FUND_GEN,
					B.FUND_TYPE,
					B.COMPANY_GEN,
					B.FUND_NAME,
					B.MANAGER_FUND_NAME,
					B.HOLDER_LICENSE_NO,
					B.FUND_QTY,
					B.FUND_DATE,
					B.FUND_RIGHT,
					B.FUND_COMMENT,
					B.EST_PRICE_AMOUNT,
					B.KEEP_PERSON_GEN,
					B.COMMIT_FLAG,
					B.COMMIT_DESC,
					B.CENT_DEPT_GEN,
					B.CREATE_BY_USERID,
					B.CREATE_DATE,
					B.UPDATE_BY_USERID,
					B.UPDATE_DATE,
					B.CREATE_BY_PROGID,
					B.UPDATE_BY_PROGID,
					B.VERSION,
					B.DATA_ID,
					B.USER_DEPT_CODE,
					B.DPD_STRUCTURE_GEN,
					B.LICENSE_FLAG,
					B.DIAGRAM_FLAG,
					B.B_RIGHT_FLAG,
					B.MAP_FLAG,
					B.ESTIMATE_COST_FLAG,
					B.CONTRACT_FLAG,
					B.PICTURE_FLAG,
					B.B_CONTRACT_FLAG,
					B.OTHER_DOC_FLAG,
					B.OTHER_DOC_DESC,
					B.FUND_VALUE,
					B.FUND_REGISTRATION_FLAG,
					B.HOLDER_NAME,
					B.WH_CIVIL_ID
				FROM
					WH_CIVIL_CASE A
				LEFT JOIN WH_CIVIL_CASE_ASSETS_FUND B ON A .WH_CIVIL_ID = B.WH_CIVIL_ID
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

		  	$data[$rec['CFC_FUND_GEN']] = $data_res;	
		
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
						LEFT JOIN WH_CIVIL_CAFE_PERSON CP ON CP.PERSON_CODE = AO.PERSON_CODE
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