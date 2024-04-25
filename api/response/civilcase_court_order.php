<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "WS-01-002",
  "service_name" => "civilCaseCourtOrder",
  "service_info" => "ข้อมูลคำสั่งศาล",
  "table" => "WH_CIVIL_CASE_COURT_ORDER",
  "request" => array(
    "courtDate" => array(
      "TYPE" => "date",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "วันที่ศาลมีคำสั่ง",
      "EX" => "2020-03-16"
    ),    
	"courtName" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อศาล",
      "EX" => "ศาลแพ่ง"
    ),    
	"courtLevel" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชั้นศาล",
      "EX" => "01"
    ),    
	"courtTypeName" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อศาลที่มีคำสั่ง",
      "EX" => "ขอกันส่วน"
    ),    
	"courtAppName" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อผลการพิจารณา",
      "EX" => "อนุญาติตามคำร้อง"
    ),
	"courtDetail" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รายละเอียดคำสั่ง",
      "EX" => "ส่งทรัพย์ให้เจ้าพนักงาน"
    ),
	"courtSdate" => array(
      "TYPE" => "date",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "วันที่มีผลบังคับ",
      "EX" => "2020-0"
    ),
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
    "courtDate" => array(
	  "NAME" => "COURT_DATE",
      "TYPE" => "date",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "วันที่ศาลมีคำสั่ง",
      "EX" => "2020-03-16"
    ),    
	"courtName" => array(
	  "NAME" => "COURT_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อศาล",
      "EX" => "ศาลแพ่ง"
    ),    
	"courtLevel" => array(
	  "NAME" => "COURT_LEVEL",      
	  "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชั้นศาล",
      "EX" => "01"
    ),    
	"courtTypeCode" => array(
	  "NAME" => "COURT_TYPE_CODE",	
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสศาลที่มีคำสั่ง",
      "EX" => "001"
    ),     
	"courtTypeName" => array(
	  "NAME" => "COURT_TYPE_NAME",	
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อศาลที่มีคำสั่ง",
      "EX" => "ขอกันส่วน"
    ),    
	"courtAppCode" => array(
	  "NAME" => "COURT_APP_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสผลการพิจารณา",
      "EX" => "01"
    ),    
	"courtAppName" => array(
	  "NAME" => "COURT_APP_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อผลการพิจารณา",
      "EX" => "อนุญาติตามคำร้อง"
    ),
	"courtDetail" => array(
	  "NAME" => "COURT_DETAIL",	
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รายละเอียดคำสั่ง",
      "EX" => "ส่งทรัพย์ให้เจ้าพนักงาน"
    ),
	"courtSdate" => array(
	  "NAME" => "COURT_SDATE",	
      "TYPE" => "date",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "วันที่มีผลบังคับ",
      "EX" => "2020-0"
    ),  
  ),
);

echo json_encode($service, JSON_UNESCAPED_UNICODE);

?>