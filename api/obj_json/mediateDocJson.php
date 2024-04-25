<?php
class mediateDocJson{

	private $objJson;

	public function getJson(){

		$this->objJson = array(

			"code" => "",
			"service_name" => "mediateDoc",
			"service_info" => "ข้อมูลเอกสารภายในคดี",
			"request" => array(

				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลแพ่ง"
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ผบ."
				),
				"BLACK_CASE" => array(
					"FIELD" => "blackCase",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"BLACK_YY" => array(
					"FIELD" => "blackYY",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำปีที่",
					"EX" => "2563"
				),
				"PREFIX_RED_CASE" => array(
					"FIELD" => "prefixRedCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ผบ."
				),
				"RED_CASE" => array(
					"FIELD" => "redCase",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "111"
				),
				"RED_YY" => array(
					"FIELD" => "redYY",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
				),
				"DOC_DATE" => array(
					"FIELD" => "docDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "วันที่เอกสาร",
					"EX" => "43906"
				),
				"DOC_NAME" => array(
					"FIELD" => "docName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเอกสาร",
					"EX" => "สำเนาโฉนดที่ดิน"
				)

			),
			"response" => array(

				"CIVIL_CODE" => array(
					"FIELD" => "civilCode",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสหมายบังคับคดี",
					"EX" => "1026833"
				),
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลแพ่ง"
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ผบ."
				),
				"BLACK_CASE" => array(
					"FIELD" => "blackCase",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"BLACK_YY" => array(
					"FIELD" => "blackYY",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำปีที่",
					"EX" => "2563"
				),
				"PREFIX_RED_CASE" => array(
					"FIELD" => "prefixRedCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ผบ."
				),
				"RED_CASE" => array(
					"FIELD" => "redCase",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "111"
				),
				"RED_YY" => array(
					"FIELD" => "redYY",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
				),
				"DOC_DATE" => array(
					"FIELD" => "docDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่เอกสาร",
					"EX" => "43906"
				),
				"DOC_NAME" => array(
					"FIELD" => "docName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเอกสาร",
					"EX" => "สำเนาโฉนดที่ดิน"
				)

            )

        );

		return $this->objJson;

    }


  }

?>
