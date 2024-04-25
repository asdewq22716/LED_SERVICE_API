<?php
class debtRehabilitationCaseDebtorJson
{

	private $objJson;
	private $objJsonPerson;

	public function getJson()
	{

		$this->objJson = array(
			"code" => "",
			"service_name" => "debtRehabilitationCaseDebtor",
			"service_info" => "รายละเอียดข้อมูลลูกหนี้ ",
			"request" => array(

				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
					"EX" => "0111111111111"
				),
				"FIRST_NAME" => array(
					"FIELD" => "firstName",
					"TYPE" => "number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อ",
					"EX" => "ทดสอบ"
				),
				"LAST_NAME" => array(
					"FIELD" => "lastName",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "นามสกุล",
					"EX" => "ทดสอบ "
				),
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "044"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลล้มละลายกลาง"
				),
				"DEPT_NAME" => array(
					"FIELD" => "deptName",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อสำนักงาน",
					"EX" => "กองฟื้นฟูกิจการลูกหนี้"
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ฟ."
				),
				"BLACK_CASE" => array(
					"FIELD" => "blackCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"BLACK_YY" => array(
					"FIELD" => "blackYY",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำปีที่",
					"EX" => "2563"
				),
				"PREFIX_RED_CASE" => array(
					"FIELD" => "prefixRedCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ผบ."
				),
				"RED_CASE" => array(
					"FIELD" => "redCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "1111"
				),
				"RED_YY" => array(
					"FIELD" => "redYY",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
				)
			),
			"response" => array(

				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "044"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลล้มละลายกลาง"
				),
				"DEPT_CODE" => array(
					"FIELD" => "deptCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสสำนักงาน",
					"EX" => "01"
				),
				"DEPT_NAME" => array(
					"FIELD" => "deptName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสำนักงาน",
					"EX" => "กองฟื้นฟูกิจการลูกหนี้"
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ฟ."
				),
				"BLACK_CASE" => array(
					"FIELD" => "blackCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"BLACK_YY" => array(
					"FIELD" => "blackYY",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำปีที่",
					"EX" => "2563"
				),
				"PREFIX_RED_CASE" => array(
					"FIELD" => "prefixRedCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ฟ."
				),
				"RED_CASE" => array(
					"FIELD" => "redCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "1111"
				),
				"RED_YY" => array(
					"FIELD" => "redYY",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
				),
				"DEFFENDANT1" => array(
					"FIELD" => "deffendant1",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CAPITAL_AMOUNT" => array(
					"FIELD" => "capitalAmount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ทุนทรัพย์",
					"EX" => "100,000"
				),
				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
					"EX" => "0111111111111"
				),
				"ADDRESS_DEFFENDANT" => array(
					"FIELD" => "addressDeffendant",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => " "
				),
				/* "CASE_OWNER_NAME" => array(
					"FIELD" => "caseOwnerName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => " ",
					"EX" => ""
				),
				"COURT_ORDER_NAME" => array(
					"FIELD" => "courtName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"COURT_ORDER_DATE" => array(
					"FIELD" => "courtDate",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"COURT_LEVEL" => array(
					"FIELD" => "courtLevel",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ANC_DOC_NO" => array(
					"FIELD" => "ancdocNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ANC_DOC_DATE" => array(
					"FIELD" => "ancdocDate",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ANC_DETAILS" => array(
					"FIELD" => "ancDetail",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ANC_NUM_1" => array(
					"FIELD" => "ancNum1",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ANC_NUM_2" => array(
					"FIELD" => "ancNum2",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ANC_NUM_3" => array(
					"FIELD" => "ancNum3",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				) */
			),
		);

		return $this->objJson;
	}
}
