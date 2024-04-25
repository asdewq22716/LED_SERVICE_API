<?php
class mediateCmdOfficeJson{

	private $objJson;

	public function getJson(){

		$this->objJson = array(

			"code" => "",
			"service_name" => "MediateCmdOffice",
			"service_info" => "ข้อมูลคำสั่งเจ้าพนักงาน",
			"request" => array(

				"CMD_TYPE_NAME" => array(
					"FIELD" => "cmdTypeName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อคำสั่งเจ้าพนักงาน",
					"EX" => "ส่งทรัพย์ให้คดีล้มละลาย"
				),
				"OFFICE_ID_CARD" => array(
					"FIELD" => "officeIdcard",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชนนิติกร ผู้ออกคำสั่ง",
					"EX" => "1111110011111"
				),
				"OFFICE_NAME" => array(
					"FIELD" => "officeName",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อนิติกรผู้ออกคำสั่ง",
					"EX" => ""
				),
				"CMD_DATE" => array(
					"FIELD" => "cmdDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่สั่ง",
					"EX" => "43906"
				)

			),
			"response" => array(

				"CIVI_CODE" => array(
					"FIELD" => "civilCode",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสคดี",
					"EX" => "1026833"
				),
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลล้มละลายกลาง"
				),
				"DEPT_CODE" => array(
					"FIELD" => "deptCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสสำนักงาน",
					"EX" => "1"
				),
				"DEPT_NAME" => array(
					"FIELD" => "deptName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสำนักงาน",
					"EX" => "กองฟื้นฟูกิจการลูกหนี้"
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ฟ."
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
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ฟ."
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
				"COURT_DATE" => array(
					"FIELD" => "courtDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ในหมาย",
					"EX" => "242189"
				),
				"CAPITAL_AMOUNT" => array(
					"FIELD" => "capitalAmount",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ทุนทรัพย์",
					"EX" => "100000"
				),
				"PLAINTIFF1" => array(
					"FIELD" => "plaintiff1",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อผู้ร้อง (บรรทัดที่ 1)",
					"EX" => "นายทดสอบ ทดสอบ ที่ 1"
				),
				"PLAINTIFF2" => array(
					"FIELD" => "plaintiff2",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อผู้ร้อง (บรรทัดที่ 2)",
					"EX" => "นายทดสอบ ทดสอบ"
				),
				"PLAINTIFF3" => array(
					"FIELD" => "plaintiff3",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อผู้ร้อง (บรรทัดที่ 3)",
					"EX" => "นายทดสอบ ทดสอบ"
				),
				"DEFFENDANT1" => array(
					"FIELD" => "deffendant1",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อลูกหนี้ (บรรทัดที่ 1)",
					"EX" => "บริษัท ทดสอบ"
				),
				"DEFFENDANT2" => array(
					"FIELD" => "deffendant2",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อลูกหนี้ (บรรทัดที่ 2)",
					"EX" => "บริษัท ทดสอบ"
				),
				"DEFFENDANT3" => array(
					"FIELD" => "deffendant3",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อลูกหนี้ (บรรทัดที่ 3)",
					"EX" => "บริษัท ทดสอบ"
				),
				"RECORD_COUNT" => array(
					"FIELD" => "recordCount",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนรายการ",
					"EX" => "10"
				),
				"CMD_OFFICE_LIST" => array(
					"FIELD" => "cmdOfficeList",
					"NAME" => "",
					"TYPE" => "List",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายการคำสั่งเจ้าพนักงาน",
					"EX" => "1"
				),
				"SEQ" => array(
					"FIELD" => "seq",
					"NAME" => "",
					"TYPE" => "",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับ",
					"EX" => "1"
				),
				"CMD_DATE" => array(
					"FIELD" => "cmdDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่สั่ง",
					"EX" => "43906"
				),
				"OFFICE_ID_CARD" => array(
					"FIELD" => "officeIdcard",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชนนิติกร ผู้ออกคำสั่ง",
					"EX" => "11001211111211"
				),
				"OFFICE_NAME" => array(
					"FIELD" => "officeName",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อนิติกรผู้ออกคำสั่ง",
					"EX" => "ทดสอบ ทดสอบ"
				),
				"CMD_TYPE_CODE" => array(
					"FIELD" => "cmdTypeCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสคำสั่งเจ้าพนักงาน",
					"EX" => "1"
				),
				"CMD_TYPE_NAME" => array(
					"FIELD" => "cmdTypeName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อคำสั่งเจ้าพนักงาน",
					"EX" => "นำส่งทรัพย์ให้เจ้าพนักงาน"
				),
				"CMD_DETAIL" => array(
					"FIELD" => "cmdDetail",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียดคำสั่ง",
					"EX" => "ส่งทรัพย์ให้เจ้าพนักงาน"
				)

            )

        );

		return $this->objJson;

    }


 }

?>
