<?php
class getAnnounceCivilCaseJson{

	private $objJson;

	public function getJson(){

		$this->objJson = array(
			  "code" => "",
			  "service_name" => "getAnnounceCivilCase",
			  "service_info" => "ประกาศขายทอดตลาด",
			  "request" => array(
				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"S_DATE" => array(
				  "FIELD" => "sDate",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC"=>"วันที่เริ่มต้น",
				  "EX" => "1"
				),
				"E_DATE" => array(
				  "FIELD" => "eDate",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "วันที่สิ้นสุด",
				  "EX" => "4"
				)
			),
			"response" => array(

				"NOTICE_TITLE" => array(
					"FIELD" => "noticeTitle",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เรื่อง(ประกาศขายทอดตลาด)",
					"EX" => "1026833"
				),
				"DF_BELONG" => array(
					"FIELD" => "dfBelong",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เป็นทรัพย์ของจำเลย",
					"EX" => "001"
				),
				"ASSET_FOR_SALE" => array(
					"FIELD" => "assetForSale",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายการทรัพย์ที่จะขาย",
					"EX" => "ศาลแพ่ง"
				),
				"JUM_NONG" => array(
					"FIELD" => "jumNong",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ภาระหนี้จำนอง/ภาระหนี้ส่วนกลาง",
					"EX" => "01"
				),
				"HOW_TO_BUY" => array(
					"FIELD" => "howToBuy",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วิธีการขาย",
					"EX" => "สำนักงานบังคับคดีแพ่งกรุงเทพมหานคร 1"
				),
				"CONDITION" => array(
					"FIELD" => "condition",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เงื่อนไข",
					"EX" => "ผบ."
				),
				"SUM_ESTIMATE" => array(
					"FIELD" => "sumEstimate",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สรุปราคาประเมิน",
					"EX" => "1111"
				),
				"SUM_GUARANTEE" => array(
					"FIELD" => "sumGuarantee",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สรุปวางหลักประกัน",
					"EX" => "2563"
				),
				"AUC_ASSET_DETAIL" => array(
					"FIELD" => "assetDetail",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียดทรัพย์",
					"EX" => ""
				)
			)
		);

			return $this->objJson;

	}
}
?>
