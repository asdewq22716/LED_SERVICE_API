<?php
class debtRehabilitationCmdOfficeJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
			  "code" => "",
			  "service_name" => "debtRehabilitationCmdOffice",
			  "service_info" => "รายละเอียดข้อมูลคำสั่งเจ้าพนักงาน",
			  "request" => array(

				"CMD_TYPE_NAME" => array(
				  "FIELD" => "cmdTypeName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อคำสั่งเจ้าพนักงาน",
				  "EX" => "ส่งทรัพย์ให้คดีล้มละลาย"
				),
				"OFFICE_IDCARD" => array(
				  "FIELD" => "officeIdcard",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขประจำตัวประชาชนนิติกร ผู้ออกคำสั่ง",
				  "EX" => "1111110011111"
				),
				"OFFICE_NAME" => array(
				  "FIELD" => "officeName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อนิติกรผู้ออกคำสั่ง",
				  "EX" => " "
				),
				"CMD_DATE" => array(
				  "FIELD" => "cmdDate",
				  "TYPE" => "date",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "วันที่สั่ง",
				  "EX" => "2020-03-16"
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
				  "FIELD" => "CourtName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อศาล",
				  "EX" => "ศาลล้มละลายกลาง"
				),
				"DEPT_CODE" => array(
				  "FIELD" => "DeptCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสสำนักงาน",
				  "EX" => "01"
				),
				"DEPT_NAME" => array(
				  "FIELD" => "DeptName",
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
				  "EX" => "ฟ."
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
				  "EX" => "100,000"				
				),
				"PLAINTIFF1" => array(
				  "FIELD" => "plaintiff1",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อผู้ร้อง (บรรทัดที่ 1)",
				  "EX" => "นายทดสอบ ทดสอบ ที่ 1"
				),
				"PLAINTIFF2" => array(
				  "FIELD" => "plaintiff2",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อผู้ร้อง (บรรทัดที่ 2)",
				  "EX" => "นายทดสอบ ทดสอบ"
				),
				"PLAINTIFF3" => array(
				  "FIELD" => "plaintiff3",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อผู้ร้อง (บรรทัดที่ 3)",
				  "EX" => "นายทดสอบ ทดสอบ"
				),
				"DEFFENDANT1" => array(
				  "FIELD" => "deffendant1",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อลูกหนี้ (บรรทัดที่ 1)",
				  "EX" => "บริษัท ทดสอบ"
				),
				"DEFFENDANT2" => array(
				  "FIELD" => "deffendant2",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อลูกหนี้ (บรรทัดที่ 2)",
				  "EX" => "บริษัท ทดสอบ"
				),
				"DEFFENDANT3" => array(
				  "FIELD" => "deffendant3",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อลูกหนี้ (บรรทัดที่ 3)",
				  "EX" => "บริษัท ทดสอบ"
				),
				"RECORD_COUNT" => array(
				  "FIELD" => "recordCount",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "จำนวนรายการ",
				  "EX" => "10"
				),
				"CMD_OFFICE_LIST" => array(
				  "FIELD" => "cmdOfficeList",				  
				  "TYPE" => "List",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รายการคำสั่งเจ้าพนักงาน",
				  "EX" => " "
				),
				"REQ" => array(
				  "FIELD" => "req",				  
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
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขประจำตัวประชาชนนิติกร ผู้ออกคำสั่ง",
				  "EX" => " "
				),
				"OFFICE_NAME" => array(
				  "FIELD" => "officeName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อนิติกรผู้ออกคำสั่ง",
				  "EX" => "  "
				),
				"CMD_TYPE_CODE" => array(
				  "FIELD" => "cmdTypeCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสคำสั่งเจ้าพนักงาน",
				  "EX" => "001"
				),
				"CMD_TYPE_NAME" => array(
				  "FIELD" => "cmdTypeName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อคำสั่งเจ้าพนักงาน",
				  "EX" => "นำส่งทรัพย์ให้เจ้าพนักงาน"
				),
				"CMD_DETAIL" => array(
				  "FIELD" => "cmdDetail",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รายละเอียดคำสั่ง",
				  "EX" => "ส่งทรัพย์ให้เจ้าพนักงาน"
				),
				"CMD_ID" => array(
				  "FIELD" => "cmdId",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "Pk รายละเอียดคำสั่ง",
				  "EX" => "1"
				),
				"CMD_SYSTEM" => array(
				  "FIELD" => "cmdSystem",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "Pk รายละเอียดคำสั่ง",
				  "EX" => "1"
				),
			  ),
			);
			
			return $this->objJson;
	}
}
?>