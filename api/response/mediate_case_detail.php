<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "",
  "service_name" => "MediateCaseDetail",
  "service_info" => "ข้อมูลคดี ",
  "table" => "WH_MEDIATE_CASE_DETAIL",
  "response" => array(
    "civilCode" => array(
      "NAME" => "CIVIL_CODE",
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "รหัสคดี",
      "EX" => "1026833"
    ),
    "courtCode" => array(
      "NAME" => "COURT_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "รหัสศาล",
      "EX" => "001"
    ),
    "courtName" => array(
      "NAME" => "COURT_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อศาล",
      "EX" => "ศาลล้มละลายกลาง"
    ),
    "deptCode" => array(
      "NAME" => "DEPT_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "รหัสสำนักงาน",
      "EX" => "01"
    ),
    "deptName" => array(
      "NAME" => "DEPT_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อสำนักงาน",
      "EX" => "กองบังคับคดีล้มละลาย 1"
    ),
	"caseTypeCode" => array(
      "NAME" => "CASE_TYPE_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "รหัสประเภทความ",
      "EX" => "001"
    ),
	"caseTypeName" => array(
      "NAME" => "CASE_TYPE_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อประเภทความ",
      "EX" => "คดีแพ่ง"
    ),
	"caseLawsCode" => array(
      "NAME" => "CASE_LAWS_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ประเภทคดี",
      "EX" => "001"
    ),
	"caseLawsName" => array(
      "NAME" => "CASE_LAWS_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อประเภท",
      "EX" => "คดีทางปกครอง"
    ),
	"prefixBlackCase" => array(
      "NAME" => "PREFIX_BLACK_CASE",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "คำนำหน้าหมายเลขคดีแดง",
      "EX" => "ล."
    ),
    "blackCase" => array(
      "NAME" => "BLACK_CASE",
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "คดีหมายเลขแดงที่",
      "EX" => "1111"
    ),
    "blackYY" => array(
      "NAME" => "BLACK_YY",
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "คดีหมายเลขแดงปีที่",
      "EX" => "2563"
    ),
	"prefixRedCase" => array(
      "NAME" => "PREFIX_RED_CASE",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "คำนำหน้าหมายเลขคดีแดง",
      "EX" => "ล."
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
      "DESC" => "คดีหมายเลขแดงปีที่",
      "EX" => "2563"
    ),
    "courtDate" => array(
      "NAME" => "COURT_DATE",
      "TYPE" => "date",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "วันที่ในหมาย",
      "EX" => "01/02/2563"
    ),
    "capitalAmount" => array(
      "NAME" => "CAPITAL_AMOUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ทุนทรัพย์",
      "EX" => "100,000"
    ),
    "plaintiff1" => array(
      "NAME" => "PLAINTIFF1",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อโจทก์ (บรรทัดที่ 1)",
      "EX" => "นายทดสอบ ทดสอบ ที่ 1"
    ),
    "plaintiff2" => array(
      "NAME" => "PLAINTIFF2",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อโจทก์ (บรรทัดที่ 2)",
      "EX" => "นายทดสอบ ทดสอบ"
    ),
    "plaintiff3" => array(
      "NAME" => "PLAINTIFF3",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อโจทก์ (บรรทัดที่ 3)",
      "EX" => "นายทดสอบ ทดสอบ"
    ),
    "defendant1" => array(
      "NAME" => "DEFFENDANT1",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อจำเลย (บรรทัดที่ 1)",
      "EX" => "นายจำเลย จำเลย ที่ 1"
    ),
    "defendant2" => array(
      "NAME" => "DEFFENDANT2",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อจำเลย (บรรทัดที่ 2)",
      "EX" => "นายจำเลย จำเลย"
    ),
    "defendant3" => array(
      "NAME" => "DEFFENDANT3",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อจำเลย (บรรทัดที่ 3)",
      "EX" => "นายจำเลย จำเลย"
    ), 
	"image_Court" => array(
      "NAME" => "IMAGE_COURT",
      "TYPE" => "string",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "",
      "EX" => ""
    ),
  ),
);

echo json_encode($service, JSON_UNESCAPED_UNICODE);

?>