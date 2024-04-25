<?php
	//header('Content-Type: application/json');

	$service = array(
	"code" => "WS-01-002",
	"service_name" => "debtMediatecmdoffice",
	"service_info" => "ข้อมูลคำสั่งเจ้าพนักงาน",
	"table" => "WH_REHABILITATION_CMD_OFFICE",
	"request" => array(
	"cmdDate" => array(
	"TYPE" => "date",
	"FIELD_TYPE" => "O", // M/O
	"DESC" => "วันที่สั่ง",
	"EX" => "2020-03-16"
	),
	"officeIdcard" => array(
	"TYPE" => "number",
	"FIELD_TYPE" => "O", // M/O
	"DESC" => "เลขประจำตัวประชาชนนิติกรผู้ออกคำสั่ง",
	"EX" => ""
	),
	"officeName" => array(
	"TYPE" => "string",
	"FIELD_TYPE" => "O", // M/O
	"DESC" => "ชื่อนิติกรผู้ออกคำสั่ง",
	"EX" => ""
	),
	"cmdTypeName" => array(
	"TYPE" => "string",
	"FIELD_TYPE" => "O", // M/O
	"DESC" => "ชื่อคำสั่งเจ้าพนักงาน",
	"EX" => "ส่งทรัพย์ให้คดีส้มละลาย"
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
	"cmdDate" => array(
	"NAME" => "CMD_DATE",
	"TYPE" => "date",
	"FIELD_TYPE" => "O", // M/O
	"DESC" => "วันที่สั่ง",
	"EX" => "2020-03-16"
	),
	"officeIdcard" => array(
	"NAME" => "OFFICE_IDCARD",
	"TYPE" => "number",
	"FIELD_TYPE" => "O", // M/O
	"DESC" => "เลขประจำตัวประชาชนนิติกรผู้ออกคำสั่ง",
	"EX" => ""
	),
	"officeNamr" => array(
	"NAME" => "OFFICE_NAME",
	"TYPE" => "string",
	"FIELD_TYPE" => "O", // M/O
	"DESC" => "ชื่อนิติกรผู้ออกคำสั่ง",
	"EX" => ""
	),
	"cmdTypeCode" => array(
	"NAME" => "CMD_TYPE_CODE",
	"TYPE" => "string",
	"FIELD_TYPE" => "O", // M/O
	"DESC" => "รหัสคำสั่งเจ้าพนักงาน",
	"EX" => "ส่งทรัพย์ให้คดีส้มละลาย"
	),
	"cmdDetail" => array(
	"NAME" => "CMD_DETAIL",
	"TYPE" => "string",
	"FIELD_TYPE" => "O", // M/O
	"DESC" => "รายละเอียดคำสั่ง",
	"EX" => "ส่งทรัพย์ให้เจ้าพนักงาน"
	),
	),
	);

	// echo json_encode($service, JSON_UNESCAPED_UNICODE);

?>
