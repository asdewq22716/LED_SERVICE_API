<?php
class civilCaseAssetsBuildingResponse extends civilCaseAssetsLandJson
{
	private $resPonse;
	private $json;
	private $jsonPerson;
	private $request;

	public function __construct($request)
	{
		$this->request = $request;
	}

	public function getResponse()
	{
		$this->resPonse = false;
		$this->json = civilCaseAssetsLandJson::getJson();
		$this->jsonPerson = civilCaseAssetsLandJson::getJsonPerson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		
		$filter = "";
		foreach ($objRequest as $k => $v) {
			if ($request[$v['FIELD']]) {
				$filter = "AND " . $k . " = '" . $request[$v['FIELD']] . "' ";
			}
		}

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
					CAB.CFC_LAND_GEN,
					CAB.CFC_CIVIL_GEN,
					CAB.CFC_LAND_REQ_GEN,
					CAB.SEQ_NO,
					CAB.LAND_TYPE,
					CAB.DEED_NO,
					CAB.LAND_NO,
					CAB.PAGE_NO,
					CAB.SURVE,
					CAB.DOC_BOOK_NO,
					CAB.DOC_PAGE_NO,
					CAB.MOO_NO,
					CAB.DISTRICT_NAME,
					CAB.AMPHUR_NAME,
					CAB.PROVINCE_NAME,
					CAB.CENT_LOC_GEN,
					CAB.COMMIT_TYPE,
					CAB.COMMIT_DESC,
					CAB.FARM,
					CAB.NGAN,
					CAB.VA,
					CAB.REMAIN_VA,
					CAB.REMAIN_BASE,
					CAB.SURRENDER_FARM,
					CAB.SURRENDER_NGAN,
					CAB.SURRENDER_VA,
					CAB.SURRENDER_REMAIN_VA,
					CAB.SURRENDER_REMAIN_BASE,
					CAB.PART_FARM,
					CAB.PART_NGAN,
					CAB.PART_VA,
					CAB.PART_REMAIN_VA,
					CAB.PART_REMAIN_BASE,
					CAB.EST_PER_FARM_AMOUNT,
					CAB.EST_PER_VA_AMOUNT,
					CAB.EST_AREA_AMOUNT,
					CAB.ADD_PERCENT,
					CAB.ADD_AMOUNT,
					CAB.MINUS_PERCENT,
					CAB.MINUS_AMOUNT,
					CAB.EST_ASS_AMOUNT,
					CAB.EST_GOV_AMOUNT,
					CAB.EST_PRICE_AMOUNT,
					CAB.LAND_DESC,
					CAB.LAND_COMMENT,
					CAB.NEARLY_AREA,
					CAB.R_SELL_TYPE,
					CAB.ASSET_STATUS,
					CAB.CENT_DEPT_GEN,
					CAB.CREATE_BY_USERID,
					CAB.CREATE_DATE,
					CAB.UPDATE_BY_USERID,
					CAB.UPDATE_DATE,
					CAB.CREATE_BY_PROGID,
					CAB.UPDATE_BY_PROGID,
					CAB.VERSION,
					CAB.DATA_ID,
					CAB.HOUSE_FLAG,
					CAB.PLOT_SEQ,
					CAB.COPY_FLAG,
					CAB.USER_DEPT_CODE,
					CAB.DPD_STRUCTURE_GEN,
					CAB.LAND_FOR_ID,
					CAB.LAND_REGISTRATION_FLAG,
					CAB.LAND_TRAIN_FLAG,
					CAB.SOME_PART_FLAG,
					CAB.WH_CIVIL_ID
				FROM 
					WH_CIVIL_CASE CC 
					INNER JOIN WH_CIVIL_CASE_ASSETS_LAND CAB ON CAB.WH_CIVIL_ID = CC.WH_CIVIL_ID
				WHERE 
					1 = 1 
					{$filter}";
		$objResponse = $this->json['response'];
		$objResPerson = $this->jsonPerson['response'];

		$this->response = array();
		$data = array();

		$query = db::query($sql);
		while ($rec = db::fetch_array($query)) {

			$data_res = array();
			foreach ((array)$objResponse as $_key => $_item) {
				$data_res[$_item['FIELD']] = $rec[$_key];
			}

			$data[$rec['CFC_LAND_GEN']] = $data_res;
			
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
						FROM 
							WH_CIVIL_ASSET_OWNER AO
							LEFT JOIN WH_CIVIL_CASE_PERSON CP ON CP.PERSON_CODE = AO.PERSON_CODE
						WHERE 
							AO.ASSET_CODE = '" . $rec['CFC_LAND_GEN'] . "'";
			$q_sub = db::query($sql_sub);
			$i = 1;
			while ($r_sub = db::fetch_array($q_sub)) {

				$data_res = array();
				$data_res['SEQ'] = $i;
				foreach ((array)$objResPerson as $_key => $_item) {
					if ($_key != 'SEQ') {
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
