<?php
class mediatePersonJson{

	private $objJson;

	public function getJson(){

		$this->objJson = array(

			"code" => "",
			"service_name" => "MediatePerson",
			"service_info" => "ข้อมูลบุคคลในคดี",
			"request" => array(

				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
					"EX" => "111111111111"
				),
				"FIRST_NAME" => array(
					"FIELD" => "firstName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อ",
					"EX" => "ทดสอบ"
				),
				"LAST_NAME" => array(
					"FIELD" => "lastName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "นามสกุล",
					"EX" => "ทดสอบ "
				),
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "O", // M/O
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
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ผบ."
				),
				"BLACK_CASE" => array(
					"FIELD" => "blackCase",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"BLACK_YY" => array(
					"FIELD" => "blackYY",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "O", // M/O
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
					"FIELD" => "refMediateID",
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
				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=>" ",
					"EX" => ""
				),			
				"PREFIX_NAME" => array(
					"FIELD" => "prefixName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อคำนำหน้า",
					"EX" => ""
				),
				"FIRST_NAME" => array(
					"FIELD" => "fullName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อ-นามสกุล",
					"EX" => ""
				),
				"CONCERN_CODE" => array(
					"FIELD" => "personType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสเกี่ยวข้องเป็น",
					"EX" => ""
				),
				"CONCERN_NAME" => array(
					"FIELD" => "conernName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเกี่ยวข้องเป็น",
					"EX" => ""
				),
				"CONCERN_NO" => array(
					"FIELD" => "concernNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับที่",
					"EX" => ""
				),
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DEPT_CODE" => array(
					"FIELD" => "deptCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DEPT_NAME" => array(
					"FIELD" => "deptName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ADDRESS" => array(
					"FIELD" => "address",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ ",
					"EX" => ""
				),
				"TUM_NAME" => array(
					"FIELD" => "tumName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อแขวง/ตำบล",
					"EX" => "บางคอแหลม"
				),
				"AMP_NAME" => array(
					"FIELD" => "ampName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเขต/อำเภอ",
					"EX" => "บางคอแหลม"
				),
				"PROV_NAME" => array(
					"FIELD" => "provName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจังหวัด",
					"EX" => "กรุงเทพมหานคร"
				),
				"ZIP_CODE" => array(
					"FIELD" => "zipCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสไปรษณีย์",
					"EX" => "10000"
				)
            )
        );

		return $this->objJson;

    }

	public function getJsonPerson(){

		$this->objJson = array(

			"code" => "",
			"service_name" => "MediatePerson",
			"service_info" => "ข้อมูลบุคคลในคดี",
			"request" => array(

				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
					"EX" => "111111111111"
				),
				"FIRST_NAME" => array(
					"FIELD" => "firstName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อ",
					"EX" => "ทดสอบ"
				),
				"LAST_NAME" => array(
					"FIELD" => "lastName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "นามสกุล",
					"EX" => "ทดสอบ "
				),
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
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
				"RED_YY " => array(
					"FIELD" => "redYY ",
					"NAME" => "",
					"TYPE" => "Number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
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
				"DEPT_CODE" => array(
					"FIELD" => "deptCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รหัสสำนักงาน",
					"EX" => "1"
				),
				"DEPT_NAME" => array(
					"FIELD" => "deptName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อสำนักงาน",
					"EX" => "สำนักงานบังคับคดีแพ่งกรุงเทพมหานคร 1"
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
				"RECORD_COUNT" => array(
					"FIELD" => "recordCount",
					"NAME" => "",
					"TYPE" => "Number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "จำนวนรายการ",
					"EX" => "10"
				),
				"PERSON_LIST" => array(
					"FIELD" => "personList",
					"NAME" => "",
					"TYPE" => "Number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รายการบุคคลในคดี",
					"EX" => ""
				),
				"REQ" => array(
					"FIELD" => "req",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ลำดับ",
					"EX" => "1"
				),
				"PERSON_CODE" => array(
					"FIELD" => "personCode",
					"NAME" => "",
					"TYPE" => "Number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รหัสบุคคล",
					"EX" => "1234"
				),
				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
					"EX" => "111111111111"
				),
				"PREFIX_CODE" => array(
					"FIELD" => "prefixCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รหัสคำนำหน้า",
					"EX" => "1"
				),
				"PREFIX_NAME" => array(
					"FIELD" => "prefixName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อคำนำหน้า",
					"EX" => "นาย"
				),
				"FIRST_NAME" => array(
					"FIELD" => "firstName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อ",
					"EX" => "ทดสอบ"
				),
				"LAST_NAME" => array(
					"FIELD" => "lastName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "นามสกุล",
					"EX" => "ทดสอบ "
				),
				"CONCERN_CODE" => array(
					"FIELD" => "concernCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รหัสเกี่ยวข้องเป็น",
					"EX" => "1"
				),
				"CONCERN_NAME" => array(
					"FIELD" => "concernName",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเกี่ยวข้องเป็น",
					"EX" => "โจทก์ "
				),
				"CONCERN_NO" => array(
					"FIELD" => "concernNo",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ลำดับที่",
					"EX" => "1"
				),
				"ADDRESS" => array(
					"FIELD" => "address",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่",
					"EX" => "98"
				),
				"TUM_CODE" => array(
					"FIELD" => "tumCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสแขวง/ตำบล",
					"EX" => "1"
				),
				"TUM_NAME" => array(
					"FIELD" => "tumName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อแขวง/ตำบล",
					"EX" => "บางโพงพาง"
				),
				"AMP_CODE" => array(
					"FIELD" => "ampCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสเขต/อำเภอ",
					"EX" => "1"
				),
				"AMP_NAME" => array(
					"FIELD" => "ampName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเขต/อำเภอ",
					"EX" => "ยานนาวา"
				),
				"PROV_CODE" => array(
					"FIELD" => "provCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสจังหวัด",
					"EX" => "1"
				),
				"PROV_NAME" => array(
					"FIELD" => "provName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจังหวัด",
					"EX" => "กรุงเทพทหานคร"
				),
				"ZIP_CODE" => array(
					"FIELD" => "zipCode",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสไปรษณีย์",
					"EX" => "10120"
				)

            )

        );

    }

}

?>
