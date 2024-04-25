<?php
class mediateCaseDetailJson{

	private $objJson;

	public function getJson(){

		$this->objJson = array(

			"code" => "",
			"service_name" => "MediateCaseDetail",
			"service_info" => "ข้อมูลคดี",
			"request" => array(

				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "23213"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "1"
				),
				"DEPT_CODE" => array(
					"FIELD" => "deptCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รหัสหน่วยงาน",
					"EX" => "2"
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ผบ."
				),
				"BLACK_CASE" => array(
					"FIELD" => "blackCase",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"BLACK_YY" => array(
					"FIELD" => "blackYY",
					"NAME" => "",
					"TYPE" => "String",
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
					"TYPE" => "String",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "111"
				),
				"RED_YY" => array(
					"FIELD" => "redYY",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
				)

			),
			"response" => array(

				"REF_MEDIATE_ID" => array(
					"FIELD" => "refMediateId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่ไกล่เกลี่ย",
					"EX" => ""
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
				"CASE_TYPE_CODE" => array(
					"FIELD" => "caseTypeCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสประเภทความ",
					"EX" => ""
				),
				"CASE_TYPE_NAME" => array(
					"FIELD" => "caseTypeName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อประเภทความ",
					"EX" => ""
				),
				"CASE_LAWS_NAME" => array(
					"FIELD" => "caseLawsName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทคดี",
					"EX" => ""
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
				"COURT_DATE" => array(
					"FIELD" => "courtDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ในหมาย",
					"EX" => ""
				),
				"CAPITAL_AMOUNT" => array(
					"FIELD" => "capitalAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ทุนทรัพย์ตามหมาย",
					"EX" => ""
				),
				"PLAINTIFF1" => array(
					"FIELD" => "plaintiff1",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 1)",
					"EX" => ""
				),
				"PLAINTIFF2" => array(
					"FIELD" => "plaintiff2",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 2)",
					"EX" => ""
				),
				"PLAINTIFF3" => array(
					"FIELD" => "plaintiff3",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 3)",
					"EX" => ""
				),
				"DEFFENDANT1" => array(
					"FIELD" => "deffendant1",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 1)",
					"EX" => ""
				),
				"DEFFENDANT2" => array(
					"FIELD" => "deffendant2",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 2)",
					"EX" => ""
				),
				"DEFFENDANT3" => array(
					"FIELD" => "deffendant3",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 3)",
					"EX" => ""
				),
				"CHANNEL_ID" => array(
					"FIELD" => "channelId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=> "รหัสช่องทางการยื่นคำร้อง",
					"EX" => ""
				),
				"TYPE_MEDIATE_ID" => array(
					"FIELD" => "typeMediateID",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสประเภทไกล่เกลี่ย",
					"EX" => ""
				),
				"CHANNEL_NAME" => array(
					"FIELD" => "channelName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=> "ช่องทางการยื่นคำร้อง",
					"EX" => ""
				),
				"TYPE_MEDIATE_NAME" => array(
					"FIELD" => "typeMediateName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทไกล่เกลี่ย",
					"EX" => ""
				),				
				"MEDIATE_HANDLE_NAME" => array(
					"FIELD" => "mediateHandleName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ผลการไกล่เกลี่ย",
					"EX" => ""
				),
				"MEDIATE_RESULT" => array(
					"FIELD" => "mediateResult",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"PAYMENT_AMOUNT_DEF" => array(
					"FIELD" => "paymentAmountDef",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"MEDIATOR_NAME" => array(
					"FIELD" => "mediatorName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"MEDIATE_NO" => array(
					"FIELD" => "mediateNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				)
            )

        );

		return $this->objJson;

    }

  }

?>
