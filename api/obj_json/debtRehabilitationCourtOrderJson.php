<?php
class debtRehabilitationCourtOrderJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
			  "code" => "",
			  "service_name" => "debtRehabilitationCourtOrder",
			  "service_info" => "รายละเอียดข้อมูลคำสั่งศาล ",
			  "request" => array(

				"COURT_DATE" => array(
				  "FIELD" => "courtDate",
				  "TYPE" => "date",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "วันที่ศาลมีคำสั่ง",
				  "EX" => "2020-03-16"
				),
				"COURT_NAME" => array(
				  "FIELD" => "courtName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อศาล",
				  "EX" => "ศาลล้มละลายกลาง"
				),
				"COURT_LEVEL" => array(
				  "FIELD" => "courtLevel",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชั้นศาล",
				  "EX" => "01=ชั้นต้น "
				),
				"COURT_TYPENAME" => array(
				  "FIELD" => "courtTypeName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อศาลที่มีคำสั่ง",
				  "EX" => "ขอกันส่วน "
				 ),
				"COURT_APPNAME" => array(
				  "FIELD" => "courtAppName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อผลการพิจารณา",
				  "EX" => "อนุญาตตามคำร้อง "
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
				  "EX" => "กองบังคับคดีล้มละลาย 1"
				),
				"PREFIX_BLACK_CASE" => array(
				  "FIELD" => "prefixBlackCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีดำ",
				  "EX" => "ล."
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
				  "EX" => "ล."
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
				"COURT_ORDER_LIST" => array(
				  "FIELD" => "courtOrderList",
				  "TYPE" => "List",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รายการคำสั่งศาล",
				  "EX" => " "
				),
				"SEQ" => array(
				  "FIELD" => "seq",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ลำดับ",
				  "EX" => "0001"
				),
				"COURT_DATE" => array(
				  "FIELD" => "courtDate",
				  "TYPE" => "date",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "วันที่ศาลมีคำสั่ง",
				  "EX" => "2020-03-16"
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
				"COURT_LEVEL" => array(
				  "FIELD" => "courtLevel", 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ศาลชั้น",
				  "EX" => "01=ชั้นต้น,02=อุทธรณ์, 03=ฎีกา"
				),
				"COURT_TYPECODE" => array(
				  "FIELD" => "courtTypeCode", 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสคำสั่งศาล",
				  "EX" => "001"
				),
				"COURT_TYPENAME" => array(
				  "FIELD" => "courtTypeName", 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อคำสั่งศาล",
				  "EX" => "ขอกันส่วน"
				),
				"COURT_APPCODE" => array(
				  "FIELD" => "courtAppCode", 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสผลการพิจารณา",
				  "EX" => "01"
				),
				"COURT_APPNAME" => array(
				  "FIELD" => "courtAppName", 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อผลการพิจารณา",
				  "EX" => "อนุญาตตามคำร้อง"
				),
				"COURT_DETAIL" => array(
				  "FIELD" => "courtDetail", 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รายละเอียดคำสั่ง",
				  "EX" => "ส่งทรัพย์ให้เจ้าพนักงาน"
				),
				"COURT_SDATE" => array(
				  "FIELD" => "courtSdate", 
				  "TYPE" => "Date",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "วันที่มีผลบังคับ",
				  "EX" => "2020-03-01"
				),
			  ),
			);
			
			return $this->objJson;
	}
}
?>