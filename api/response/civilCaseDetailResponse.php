<?php

class civilCaseDetailResponse extends civilCaseDetailJson
{

	private $resPonse;
	private $json;

	private $request;

	public function __construct($request)
	{
		$this->request = $request;
	}

	public function getResponse()
	{

		$this->resPonse = false;
		$this->json = civilCaseDetailJson::getJson();
		$objRequest = $this->json['request'];
		$request = $this->request;
		$filter = "";
		foreach ($objRequest as $k => $v) {
			if ($request[$v['FIELD']]) {
				$filter .= "AND " . $k . " = '" . $request[$v['FIELD']] . "' ";
			}
		}

		$sql = "SELECT 
					WH_CIVIL_CASE.CIVIL_CODE, WH_CIVIL_CASE.COURT_CODE,
					WH_CIVIL_CASE.COURT_NAME, WH_CIVIL_CASE.DEPT_CODE, 
					WH_CIVIL_CASE.DEPT_NAME, WH_CIVIL_CASE.CASE_TYPE_CODE, 
					WH_CIVIL_CASE.CASE_TYPE_NAME, WH_CIVIL_CASE.CASE_LAWS_CODE, 
					WH_CIVIL_CASE.CASE_LAWS_NAME, WH_CIVIL_CASE.PREFIX_BLACK_CASE, 
					WH_CIVIL_CASE.BLACK_CASE, WH_CIVIL_CASE.BLACK_YY, 
					WH_CIVIL_CASE.PREFIX_RED_CASE, WH_CIVIL_CASE.RED_CASE, 
					WH_CIVIL_CASE.RED_YY, WH_CIVIL_CASE.COURT_DATE, 
					WH_CIVIL_CASE.CAPITAL_AMOUNT, WH_CIVIL_CASE.PLAINTIFF1, 
					WH_CIVIL_CASE.PLAINTIFF2, WH_CIVIL_CASE.PLAINTIFF3, 
					WH_CIVIL_CASE.DEFFENDANT1, WH_CIVIL_CASE.DEFFENDANT2, 
					WH_CIVIL_CASE.DEFFENDANT3, WH_CIVIL_CASE.IMAGE_COURT 
				FROM 
					WH_CIVIL_CASE
				WHERE 
					1 = 1 
					and rownum<10";
				/*	{$filter}";*/

		$objResponse = $this->json['response'];

		$this->response = array();
		$data = array();

		$query = db::query($sql);
		while ($rec = db::fetch_array($query)) {

			$data_res = array();
			foreach ((array)$objResponse as $_key => $_item) {
				$data_res[$_item['FIELD']] = $rec[$_key];
			}
			$data[$rec['CIVIL_CODE']] = $data_res;
		}

		$this->response = $data;

		return $this->response;
	}
}
