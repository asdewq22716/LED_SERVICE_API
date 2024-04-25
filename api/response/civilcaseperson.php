<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "WS-01-002",
  "service_name" => "civilCasePerson",
  "service_info" => "ข้อมูลบุคคลในคดี",
  "table" => "WH_CIVIL_CASE_PERSON",
  "request" => array(
    "RegisterCode" => array(
	  "NAME" => "REGISTER_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
      "EX" => "0111111111111"
    ),
	"CourtCode" => array(	
	  "NAME" => "COURT_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสศาล",
      "EX" => "0111111111111"
    ),
	"PrefixBlackCase" => array(	
	  "NAME" => "PREFIX_BLACK_CASE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คำนำหน้าหมายเลขคดีดำ",
      "EX" => "0111111111111"
    ),
	"BlackCase" => array(	
	  "NAME" => "BLACK_CASE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คดีหมายเลขดำที่",
      "EX" => "0111111111111"
    ),
	"BlackYY" => array(	
	  "NAME" => "BLACK_YY",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คดีหมายเลขดำปีที่",
      "EX" => "0111111111111"
    ),
	"PrefixRedCase" => array(	
	  "NAME" => "PREFIX_RED_CASE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คำนำหน้าหมายเลขคดีแดง",
      "EX" => "0111111111111"
    ),
	"RedCase" => array(	
	  "NAME" => "RED_CASE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คดีหมายเลขแดง",
      "EX" => "0111111111111"
    ),
	"RedYY" => array(	
	  "NAME" => "RED_YY",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คดีหมายเลขแดงปีที่",
      "EX" => "0111111111111"
    )
  ),
  "response" => array(
    "civilCode" => array(
      "NAME" => "CIVIL_CODE",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสหมายบังคับคดี",
      "EX" => "1026833"
    ),
    "courtCode" => array(
      "NAME" => "COURT_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสศาล",
      "EX" => "001"
    ),
    "courtName" => array(
      "NAME" => "COURT_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อศาล",
      "EX" => "ศาลแพ่ง"
    ),
    "deptCode" => array(
      "NAME" => "DEPT_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสสํานักงาน",
      "EX" => "01"
    ),
    "deptName" => array(
      "NAME" => "DEPT_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อสำนักงาน",
      "EX" => "สำนักงานบังคับคดีแพ่ง กรุงเทพมหานคร 1"
    ),
    "prefixBlackCase" => array(
      "NAME" => "PREFIX_BLACK_CASE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คำนำหน้าหมายเลขคดีดำ",
      "EX" => "ผบ."
    ),
    "blackCase" => array(
      "NAME" => "BLACK_CASE",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คดีหมายเลขดําที่",
      "EX" => "1111"
    ),
    "blackYY" => array(
      "NAME" => "BLACK_YY",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คดีหมายเลขดําปีที่",
      "EX" => "2563"
    ),
    "prefixRedCase" => array(
      "NAME" => "PREFIX_RED_CASE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คํานําหน้าหมายเลข คดีแดง",
      "EX" => "ผบ."
    ),
    "redCase" => array(
      "NAME" => "RED_CASE",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คดีหมายเลขแดงที่",
      "EX" => "111"
    ),
    "redYY" => array(
      "NAME" => "RED_YY",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คดีหมายเลขแดงปี ที่",
      "EX" => "2563"
    ),
    "recordCount" => array(
      "NAME" => "RECORD_COUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "จำนวนรายการ",
      "EX" => "10"
    ),
    "req" => array(
      "NAME" => "REQ",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ลำดับ",
      "EX" => "001"
    ),
    "personCode" => array(
      "NAME" => "PERSON_CODE",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสบุคคล",
      "EX" => "1234"
    ),
    "registerCode" => array(
      "NAME" => "REGISTER_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
      "EX" => "0111111111111"
    ),
    "prefixCode" => array(
      "NAME" => "PREFIX_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสคำนำหน้า",
      "EX" => "01"
    ),
    "prefixName" => array(
      "NAME" => "PREFIX_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อคำนำหน้า",
      "EX" => "นาย"
    ),
    "firstName" => array(
      "NAME" => "FIRST_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อ",
      "EX" => "ทดสอบ"
    ),   
	"lastName" => array(
      "NAME" => "LAST_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "นามสกุล",
      "EX" => "ทดสอบ (กรณีนิติบุคคลไม่ระบุ)"
    ),   
	"concernCode" => array(
      "NAME" => "CONCERN_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสเกี่ยวข้องเป็น",
      "EX" => "01"
    ),   
	"concernName" => array(
      "NAME" => "CONCERN_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อเกี่ยวข้องเป็น",
      "EX" => "โจทก์"
    ),   
	"concernNo" => array(
      "NAME" => "CONCERN_NO",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ลำดับที่",
      "EX" => "1"
    ),   
	"address" => array(
      "NAME" => "ADDRESS",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ที่อยู่",
      "EX" => "98 ถนนพระรามสาม"
    ),  
	"tumCode" => array(
      "NAME" => "TUM_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสแขวง/ตำบล",
      "EX" => "01"
    ),  
	"tumName" => array(
      "NAME" => "TUM_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อแขวง/ตำบล",
      "EX" => "บางโพงพาง"
    ),  
	"ampCode" => array(
      "NAME" => "AMP_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสเขต/อำเภอ",
      "EX" => "01"
    ),  
	"ampName" => array(
      "NAME" => "AMP_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อเขต/อำเภอ",
      "EX" => "ยานนาวา"
    ),  
	"provCode" => array(
      "NAME" => "PROV_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสจังหวัด",
      "EX" => "01"
    ),  
	"provName" => array(
      "NAME" => "PROV_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อจังหวัด",
      "EX" => "กรุงเทพมหานคร"
    ),  
	"zipCode" => array(
      "NAME" => "ZIP_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสไปรษณีย์",
      "EX" => "10120"
    ),
  ),
);

echo json_encode($service, JSON_UNESCAPED_UNICODE);

?>