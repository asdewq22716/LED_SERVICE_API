<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "WS-01-002",
  "service_name" => "civilCaseAccount",
  "service_info" => "ข้อมูลบัญชีรับ-จ่าย",
  "table" => "WH_CIVIL_CASE_ACCOURT",
  "request" => array(
    "accountNo" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ครั้งที่ทำบัญชี",
      "EX" => ""
    ),    
	"courtName" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อศาล",
      "EX" => "ศาลแพ่ง"
    ),    
	"deptCode" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสสำนักงาน",
      "EX" => "01"
    ),    
	"deptName" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อสำนักงาน",
      "EX" => "สำนักงานบังคับคดีแพ่ง กรุงเทพมหานคร 1"
    ),    
	"prefixBlackCase" => array(
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คำนำหน้าหมายเลขคดีดำ",
      "EX" => "ผบ."
    ),
	"blackCase" => array(
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คดีหมายเลขดําที่",
      "EX" => "1111"
    ),
	"blackYY" => array(
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คดีหมายเลขดําปีที่",
      "EX" => "2563"
    ),
  ),
  "response" => array(
    "accountNo" => array(
      "NAME" => "ACCOUNT_NO",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ครั้งที่ทำบัญชี",
      "EX" => ""
    ),
    "accountDate" => array(
      "NAME" => "ACCOUNT_DATE",
      "TYPE" => "date",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "วันที่ทำบัญชี",
      "EX" => ""
    ),
    "accountSdate" => array(
      "NAME" => "ACCOUNT_SDATE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "คิดบัญชีถึงวันที่",
      "EX" => ""
    ),
    "countCode" => array(
      "NAME" => "COUNT_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสศาล",
      "EX" => "001"
    ),
    "countName" => array(
      "NAME" => "COUNT_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อศาล",
      "EX" => "ศาลแพ่ง"
    ),
    "deptCode" => array(
      "NAME" => "DEPT_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสสำนักงาน",
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
    "officeIdcard" => array(
      "NAME" => "OFFICE_IDCARD",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขประจำตัวประชาชนนิติกร ผู้ออกคำสั่ง",
      "EX" => ""
    ),
    "officeName" => array(
      "NAME" => "OFFICE_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อนิติกรผู้ออกคำสั่ง",
      "EX" => ""
    ),
    "accountIdcard" => array(
	  "NAME" => "ACCOUNT_IDCARD",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขประจำตัวประชาชนนิติกร ผู้คิดบัญชี",
      "EX" => ""
    ),    
	"accountName" => array(
	  "NAME" => "ACCOUNT_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อนิติกรผู้คิดบัญชี",
      "EX" => ""
    ),    
	"apporveName" => array(
	  "NAME" => "APPROVE_NAME",      
	  "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อนิติกรผู้ตรวจสอบ",
      "EX" => ""
    ),    
  ),
);

echo json_encode($service, JSON_UNESCAPED_UNICODE);

?>