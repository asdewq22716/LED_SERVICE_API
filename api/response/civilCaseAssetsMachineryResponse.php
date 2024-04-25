<?php
class civilCaseAssetsMachineryResponse extends civilCaseAssetsMachineryJson {
	
	
	private $resPonse;		
	private $json;
	private $jsonPerson;
	private $request;
	
	public function __construct ($request){
		$this->request = $request;	
	}
			
	public function getResponse(){
		
		$this->resPonse = false;		
		$this->json = civilCaseAssetsMachineryJson::getJson();
		$this->jsonPerson = civilCaseAssetsMachineryJson::getJsonPerson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach($objRequest as $k => $v){
			
			if($request[$v['FIELD']]){ 
			$filter = "AND ". $k ." = '".$request[$v['FIELD']]."' ";
			}	
		}

		//$sql = "SELECT CC.CIVIL_CODE, CC.COURT_CODE, CC.COURT_NAME, CC.DEPT_CODE, CC.DEPT_NAME, CC.PREFIX_BLACK_CASE, CC.BLACK_CASE, CC.BLACK_YY, CC.PREFIX_RED_CASE, CC.RED_CASE, CC.RED_YY, CAM.ASSET_CODE, CAM.ASSET_ID, CAM.ASSET_STATUS, CAM.MACHINE_NAME, CAM.MACHINE_SIZE, CAM.BRAND_NAME, CAM.COLOUR, CAM.MACHINE_MODEL, CAM.ENGINE_NO, CAM.LICENSE_NO, CAM.MACHINE_COMMENT, CAM.ADDR_NO, CAM.MOO_NO, CAM.PROJECT_NAME, CAM. FLOOR, CAM.SOI, CAM.ROAD, CAM.TUM_CODE, CAM.TUM_NAME, CAM.AMP_CODE, CAM.AMP_NAME, CAM.PROV_CODE, CAM.PROV_NAME, CAM.ZIP_CODE, CAM.SEQ, CAM.HOLDING_GROUP, CAM.HOLDING_TYPE, CAM.HOLDING_AMOUNT FROM WH_CIVIL_CASE CC INNER JOIN WH_CIVIL_MAP_CASE_ASSET CA ON CC.CIVIL_CODE = CA.CIVIL_CODE INNER JOIN WH_CIVIL_CASE_ASSETS_MACHINE CAM ON CAM.ASSET_CODE = CA.ASSET_CODE WHERE 1 = 1 { $filter } ";
		$sql = "SELECT
					CC.CIVIL_CODE,
					CC.COURT_CODE,
					CC.COURT_NAME,
					CC.DEPT_CODE,
					CC.DEPT_NAME,
					CC.PREFIX_BLACK_CASE,
					CC.BLACK_CASE,
					CC.BLACK_YY,
					CC.PREFIX_RED_CASE,
					CC.RED_CASE,
					CC.RED_YY,
					machine.CFC_MACHINE_GEN,
					machine.CFC_CIVIL_GEN,
					machine.SEQ_NO,
					machine.MACHINE_NAME,
					machine.MACHINE_SIZE,
					machine.BRAND_NAME,
					machine.COLOUR,
					machine.MACHINE_MODEL,
					machine.ENGINE_NO,
					machine.LICENSE_NO,
					machine.MACHINE_COMMENT,
					machine.ADDR_NO,
					machine.MOO_NO,
					machine.PROJECT_NAME,
					machine.FLOOR,
					machine.SOI,
					machine.ROAD,
					machine.CENT_LOC_GEN,
					machine.POST_CODE,
					machine.EST_PRICE_AMOUNT,
					machine.KEEP_PERSON_GEN,
					machine.KEEP_LOCATION,
					machine.KEEP_CENT_LOC_GEN,
					machine.R_SELL_TYPE,
					machine.ASSET_STATUS,
					machine.CENT_DEPT_GEN,
					machine.CREATE_BY_USERID,
					machine.CREATE_DATE,
					machine.UPDATE_BY_USERID,
					machine.UPDATE_DATE,
					machine.CREATE_BY_PROGID,
					machine.UPDATE_BY_PROGID,
					machine.VERSION,
					machine.DATA_ID,
					machine.CFC_MACHINE_REQ_GEN,
					machine.COPY_FLAG,
					machine.USER_DEPT_CODE,
					machine.DPD_STRUCTURE_GEN,
					machine.MODEL_DESC,
					machine.CLASS_DESC,
					machine.MACHINE_REGISTRATION_FLAG,
					machine.WH_CIVIL_ID
				FROM
					WH_CIVIL_CASE CC
				INNER JOIN WH_CIVIL_CASE_ASSETS_MACHINE machine ON machine.WH_CIVIL_ID = CC.WH_CIVIL_ID
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
		  $data[$rec['CFC_MACHINE_GEN']] = $data_res;	
		
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