<?php
class debtRehabilitationDocJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
			  "code" => "",
			  "service_name" => "debtRehabilitationDoc",
			  "service_info" => "รายละเอียดข้อมูลเอกสารภายในคดี ",
			  "request" => array(

				"COURT_NAME" => array(
				  "FIELD" => "courtName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อศาล",
				  "EX" => "ศาลแพ่ง"
				),
				"DEPT_NAME" => array(
				  "FIELD" => "deptName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
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
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีแดง",
				  "EX" => "ผบ."
				),
				"RED_CASE" => array(
				  "FIELD" => "redCase",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขแดงที่",
				  "EX" => "1111"
				),
				"RED_YY" => array(
				  "FIELD" => "redYY",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขแดงปีที่",
				  "EX" => "2563"
				),
				"DOC_DATE" => array(
				  "FIELD" => "docDate",
				  "TYPE" => "date",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "วันที่เอกสาร",
				  "EX" => "2020-03-16"
				),
				"DOC_NAME" => array(
				  "FIELD" => "docName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อเอกสาร",
				  "EX" => "สำเนาโฉนดที่ดิน"
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
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "จำนวนรายการ",
				  "EX" => "10"
				),
				"COURT_ORDER_LIST" => array(
				  "FIELD" => "courtDocList",				  
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
				"DOC_DATE" => array(
				  "FIELD" => "docDate",				  
				  "TYPE" => "date",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "วันที่เอกสาร",
				  "EX" => "2020-03-16"
				),
				"DOC_NAME" => array(
				  "FIELD" => "docName",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อเอกสาร",
				  "EX" => "สำเนาโฉนดที่ดิน"
				),
				"DOC_FILE" => array(
				  "FIELD" => "deffendant3",				  
				  "TYPE" => "Base64",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ไฟล์เอกสาร",
				  "EX" => " "
				),
			  ),
			);
			
			return $this->objJson;
	}
}
?>