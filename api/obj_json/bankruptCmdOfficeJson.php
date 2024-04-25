<?php
class bankruptCmdOfficeJson{
	
	private $objJson;
	
	public function getJson(){
		
		$this->objJson = array(
			"code" => "",
			"service_name" => "bankruptCmdOffice",
			"service_info" => "ข้อมูลคำสั่งเจ้าพนักงาน",
			"request" => array(
				"CMD_DATE" => array(
					"FIELD" => "cmdDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่สั่ง",
					"EX" => "2020-03-16"
				),
				"OFFICE_IDCARD" => array(
					"FIELD" => "officeIdcard",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชนนิติกร ผู้ออกคำสั่ง",
					"EX" => "1212"
				),
				"OFFICE_NAME" => array(
					"FIELD" => "officeName",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อนิติกรผู้ออกคำสั่ง",
					"EX" => "ล."
				),
				"CMD_TYPE_CODE" => array(
					"FIELD" => "cmdTypeName",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อคำสั่งเจ้าพนักงาน",
					"EX" => "ส่งทรัพย์ให้คดีล้มละลาย"
				)
			),	
			"response" => array(
				"BANKRUPT_CODE" => array(
				  "FIELD" => "bankruptCode",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสคดี",
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
				  "EX" => "กองบังคับคดีล้มละลาย 1"
				),
				"PREFIX_BLACK_CASE" => array(
				  "FIELD" => "prefixBlackCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีแดง",
				  "EX" => "ล."
				),
				"BLACK_CASE" => array(
				  "FIELD" => "blackCase",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขแดงที่",
				  "EX" => "1111"
				),
				"BLACK_YY" => array(
				  "FIELD" => "blackYY",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขแดงปีที่",
				  "EX" => "2563"
				),
				"PREFIX_RED_CASE" => array(
				  "FIELD" => "prefixRedCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีแดง",
				  "EX" => "ล."
				),
				"RED_CASE" => array(
				  "FIELD" => "redCase",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขแดงที่",
				  "EX" => "111"
				),
				"RED_YY" => array(
				  "FIELD" => "redYY",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขแดงปีที่",
				  "EX" => "2563"
				),
				"COURT_DATE" => array(
				  "FIELD" => "courtDate",
				  "TYPE" => "date",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "วันที่ในหมาย",
				  "EX" => "01/02/2563"
				),
				"CAPITAL_AMOUNT" => array(
				  "FIELD" => "capitalAmount",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ทุนทรัพย์",
				  "EX" => "100000.00"
				),
				"PLAINTIFF1" => array(
				  "FIELD" => "plaintiff1",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อโจทก์ (บรรทัดที่ 1)",
				  "EX" => "นายทดสอบ ทดสอบ ที่ 1"
				),
				"PLAINTIFF2" => array(
				  "FIELD" => "plaintiff2",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อโจทก์ (บรรทัดที่ 2)",
				  "EX" => "นายทดสอบ ทดสอบ"
				),
				"PLAINTIFF3" => array(
				  "FIELD" => "plaintiff3",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อโจทก์ (บรรทัดที่ 3)",
				  "EX" => "นายทดสอบ ทดสอบ"
				),
				"DEFFENDANT1" => array(
				  "FIELD" => "defendant1",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อจำเลย (บรรทัดที่ 1)",
				  "EX" => "นายจำเลย จำเลย ที่ 1"
				),
				"DEFFENDANT2" => array(
				  "FIELD" => "defendant2",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อจำเลย (บรรทัดที่ 2)",
				  "EX" => "นายจำเลย จำเลย"
				),
				"DEFFENDANT3" => array(
				  "FIELD" => "defendant3",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อจำเลย (บรรทัดที่ 3)",
				  "EX" => "นายจำเลย จำเลย"
				),
				"RECORD_COUNT" => array(
				  "FIELD" => "recordCount",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "จำนวนรายการ",
				  "EX" => "10"
				),
				"REQ" => array(
				  "FIELD" => "seq",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ลำดับ",
				  "EX" => "0001"
				),
				"CMD_DATE" => array(
				  "FIELD" => "cmdDate",
				  "TYPE" => "date",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "วันที่สั่ง",
				  "EX" => "2020-03-16"
				),
				"OFFICE_IDCARD" => array(
				  "FIELD" => "officeIdcard",
				  "TYPE" => "String",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขประจำตัวประชาชนนิติกร ผู้ออกคำสั่ง",
				  "EX" => "0111111111111"
				),
				"OFFICE_NAME" => array(
				  "FIELD" => "officeName",
				  "TYPE" => "String",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อนิติกรผู้ออกคำสั่ง",
				  "EX" => "นายทดสอบ ทดสอบ"
				),
				"CMD_TYPE_CODE" => array(
				  "FIELD" => "cmdTypeCode",
				  "TYPE" => "String",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสคำสั่งเจ้าพนักงาน",
				  "EX" => "001"
				),
				"CMD_TYPE_NAME" => array(
				  "FIELD" => "cmdTypeName",
				  "TYPE" => "String",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อคำสั่งเจ้าพนักงาน",
				  "EX" => "นำส่งทรัพย์ให้เจ้าพนักงาน"
				),
				"CMD_DETAIL" => array(
				  "FIELD" => "cmdDetail",
				  "TYPE" => "String",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รายละเอียดคำสั่ง",
				  "EX" => "ส่งทรัพย์ให้เจ้าพนักงาน"
				),
			  ),
			);
			
			return $this->objJson;
	
	}
}
?>