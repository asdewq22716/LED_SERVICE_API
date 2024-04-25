<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "WS-01-003",
  "service_name" => "civilCaseAssets",
  "service_info" => "ข้อมูลทรัพย์ในคดี",
  "table" => "WH_CIVIL_CASE_ASSETS",
  "request" => array(
    "registerCode" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
      "EX" => "0111111111111"
    ),    
	"firstName" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อ",
      "EX" => "ทดสอบ"
    ),    
	"lastName" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "นามสกุล",
      "EX" => "ทดสอบ (กรณีนิติบุคคลไม่ระบุ)"
    ),    
	"courtName" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อศาล",
      "EX" => "ศาลแพ่ง"
    ),    
	"deptName" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อสำนักงาน",
      "EX" => "สำนักงานบังคับคดีแพ่ง กรุงเทพมหานคร 1"
    ),    
	"locution" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ข้อมูลสำนวน",
      "EX" => "ยึด,อายัด"
    ),    
	"caseType" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ประเภทคดี",
      "EX" => "คดีแพ่ง,อาญา"
    ),    
    "prefixBlackCase" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คํานําหน้าหมายเลข คดีดํา",
      "EX" => "ผบ."
    ),
    "blackCase" => array(
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "คดีหมายเลขดําที่",
      "EX" => "1111"
    ),
    "blackYY" => array(
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "คดีหมายเลขดําปีที่",
      "EX" => "2563"
    ),
    "prefixRedCase" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คํานําหน้าหมายเลข คดีแดง",
      "EX" => "ผบ."
    ),
    "redCase" => array(
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "คดีหมายเลขแดงที่",
      "EX" => "111"
    ),
    "redYY" => array(
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "คดีหมายเลขแดงปี ที่",
      "EX" => "2563"
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
	"locution" => array(
      "NAME" => "LOCUTION",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ข้อมูลสำนวน",
      "EX" => "ยึด,อายัด"
    ),
    "caseType" => array(
      "NAME" => "CASE_TYPE",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ประเภทคดี",
      "EX" => "คดีแพ่ง,อาญา"
    ),
    "prefixBlackCase" => array(
      "NAME" => "PREFIX_BLACK_CASE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คํานําหน้าหมายเลข คดีดํา",
      "EX" => "ผบ."
    ),
    "blackCase" => array(
      "NAME" => "BLACK_CASE",
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "คดีหมายเลขดําที่",
      "EX" => "1111"
    ),
    "blackYY" => array(
      "NAME" => "BLACK_YY",
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
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
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "คดีหมายเลขแดงที่",
      "EX" => "111"
    ),
    "redYY" => array(
      "NAME" => "RED_YY",
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
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
    "document" => array(
      "NAME" => "DOCUMENT",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เอกสารในคดี",
      "EX" => "image.led.go.th"
    ),
  ),
);

echo json_encode($service, JSON_UNESCAPED_UNICODE);

?>