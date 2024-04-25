<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "",
  "service_name" => "bankruptCmdOffice",
  "service_info" => "ข้อมูลบุคคลล้มละลาย",
  "table" => "WH_BANKRUPT_CMD_OFFICE",
  "response" => array(
    "bankruptCode" => array(
      "NAME" => "BANKRUPT_CODE",
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
    "recordCount" => array(
      "NAME" => "RECORD_COUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "จำนวนรายการ",
      "EX" => "10"
    ),
    "seq" => array(
      "NAME" => "REQ",
      "TYPE" => "number",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ลำดับ",
      "EX" => "0001"
    ),
    "cmdDate" => array(
      "NAME" => "CMD_DATE",
      "TYPE" => "date",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "วันที่สั่ง",
      "EX" => "2020-03-16"
    ),
    "officeIdcard" => array(
      "NAME" => "OFFICE_IDCARD",
      "TYPE" => "String",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "เลขประจำตัวประชาชนนิติกร ผู้ออกคำสั่ง",
      "EX" => "0111111111111"
    ),
    "officeName" => array(
      "NAME" => "OFFICE_NAME",
      "TYPE" => "String",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อนิติกรผู้ออกคำสั่ง",
      "EX" => "นายทดสอบ ทดสอบ"
    ),
    "cmdTypeCode" => array(
      "NAME" => "CMD_TYPE_CODE",
      "TYPE" => "String",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "รหัสคำสั่งเจ้าพนักงาน",
      "EX" => "001"
    ),
    "cmdTypeName" => array(
      "NAME" => "CMD_TYPE_NAME",
      "TYPE" => "String",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "ชื่อคำสั่งเจ้าพนักงาน",
      "EX" => "นำส่งทรัพย์ให้เจ้าพนักงาน"
    ),
    "cmdDetail" => array(
      "NAME" => "CMD_DETAIL",
      "TYPE" => "String",
      "FIELD_TYPE" => "M", // M/O
      "DESC" => "รายละเอียดคำสั่ง",
      "EX" => "ส่งทรัพย์ให้เจ้าพนักงาน"
    ),
  ),
);

echo json_encode($service, JSON_UNESCAPED_UNICODE);

?>