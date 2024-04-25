<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "",
  "service_name" => "civilCaseAssetsLottery",
  "service_info" => "รายละเอียดทรัพย์สลากออมทรัพย์",
  "table" => "WH_CIVIL_CASE_ASSETS_LOTTERY",
  "response" => array(
    "assetCode" => array(
      "NAME" => "ASSET_CODE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รหัสทรัพย์",
      "EX" => "1234"
    ),
    "assetId" => array(
      "NAME" => "ASSET_ID",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขที่",
      "EX" => "0345"
    ),
    "assetType" => array(
      "NAME" => "ASSET_TYPE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ประเภททรัพย์",
      "EX" => "04"
    ),
    "assetStatus" => array(
      "NAME" => "ASSET_STATUS",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "สถานะทรัพย์",
      "EX" => "01"
    ),
	"lotteryName" => array(
      "NAME" => "LOTTERY_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อสลาก",
      "EX" => "AA"
    ),
    "brance" => array(
      "NAME" => "BRANCE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "สาขา",
      "EX" => "BB"
    ),
    "startNo" => array(
      "NAME" => "START_NO",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขที่",
      "EX" => "120"
    ),
    "to" => array(
      "NAME" => "TO",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ถึง",
      "EX" => "123"
    ),
    "dueDate" => array(
      "NAME" => "DUEDATE",
      "TYPE" => "date",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "วันที่ครบกำหนด",
      "EX" => "09/02/2561"
    ),
    "noUnit" => array(
      "NAME" => "NO_UNIT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "จำนวน/หน่วย",
      "EX" => "3"
    ),
    "priceUnit" => array(
      "NAME" => "PRICE_UNIT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ราคาต่อหน่วย",
      "EX" => "2"
    ),
    "priceSum" => array(
      "NAME" => "PRICE_SUM",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เป็นเงิน",
      "EX" => "6"
    ),
    "seq" => array(
      "NAME" => "SEQ",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ลำดับ",
      "EX" => "0001"
    ),
    "personCode" => array(
      "NAME" => "PERSON_CODE",
      "TYPE" => "string",
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
      "EX" => "02"
    ),   
	"concernName" => array(
      "NAME" => "CONCERN_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อเกี่ยวข้องเป็น",
      "EX" => "จำเลย"
    ),   
	"concernNo" => array(
      "NAME" => "CONCERN_NO",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ลำดับที่",
      "EX" => "1"
    ),     
	"holdingGroup" => array(
      "NAME" => "HOLDING_GROUP",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "กลุ่มผู้มีส่วนได้เสียในทรัพย์",
      "EX" => "01"
    ),      
	"holdingType" => array(
      "NAME" => "HOLDING_TYPE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "",
      "EX" => "01"
    ),       
	"holdingAmount" => array(
      "NAME" => "HOLDING_AMOUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "จำนวน",
      "EX" => "100%"
    ),   
  ),
);

echo json_encode($service, JSON_UNESCAPED_UNICODE);

?>