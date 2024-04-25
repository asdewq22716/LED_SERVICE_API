<?php
class civilCaseCourtOrderJson{

	private $objJson;
	private $objJsonPerson;

	public function getJson(){

		$this->objJson = array(
			  "code" => "",
			  "service_name" => "CivilCaseCourtOrder",
			  "service_info" => "รายละเอียดคำสั่งศาล",
			  "request" => array(

				"COURT_CODE" => array(
				  "FIELD" => "courtCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสศาล",
				  "EX" => "01"
				),
				"PREFIX_BLACK_CASE" => array(
				  "FIELD" => "prefixBlackCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีดำ",
				  "EX" => "ผบ."
				),
				"BLACK_CASE" => array(
				  "FIELD" => "blackCase",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขดำที่",
				  "EX" => "1111"
				),
				"BLACK_YY" => array(
				  "FIELD" => "blackYY",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขดำปีที่",
				  "EX" => "2563"
				),
				"PREFIX_RED_CASE" => array(
				  "FIELD" => "prefixRedCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีแดง",
				  "EX" => "ผบ."
				),
				"RED_CASE" => array(
				  "FIELD" => "redCase",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขแดงที่",
				  "EX" => "1111"
				),
				"RED_YY" => array(
				  "FIELD" => "redYY",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขแดงปีที่",
				  "EX" => "2563"
				)
			  ),
			  	"response" => array(

					"CIVIL_CODE" => array(
						"FIELD" => "civilCode",
						"TYPE" => "string",
						"FIELD_TYPE" => "M", // M/O
						"DESC" => "รหัสหมายบังคับคดี",
						"EX" => "1026833"
					),
					"COURT_CODE" => array(
						"FIELD" => "courtCode",
						"TYPE" => "string",
						"FIELD_TYPE" => "M", // M/O
						"DESC" => "รหัสศาล",
						"EX" => "001"
					),
					"COURT_NAME" => array(
						"FIELD" => "courtName",
						"TYPE" => "string",
						"FIELD_TYPE" => "M", // M/O
						"DESC" => "ชื่อศาล",
						"EX" => "ศาลแพ่ง"
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
						"EX" => "สำนักงานบังคับคดีแพ่งกรุงเทพมหานคร 1"
					),
					"PREFIX_BLACK_CASE" => array(
						"FIELD" => "prefixBlackCase",
						"TYPE" => "string",
						"FIELD_TYPE" => "M", // M/O
						"DESC" => "คำนำหน้าหมายเลขคดีดำ",
						"EX" => "ผบ."
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
						"EX" => "ผบ."
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
					"RECORD_COUNT" => array(
						"FIELD" => "recodeCount",
						"TYPE" => "string",
						"FIELD_TYPE" => "M", // M/O
						"DESC" => "จำนวนรายการ",
						"EX" => "10"
					)
			  	),
			);

			return $this->objJson;
	}
}
?>
