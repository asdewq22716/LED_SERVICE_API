<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "",
  "service_name" => "civilCaseAssetsBuilding",
  "service_info" => "รายละเอียดทรัพย์สิ่งปลูกสร้าง",
  "table" => "WH_CIVIL_CASE_ASSETS_BUILDING",
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
      "EX" => "02"
    ),
    "assetStatus" => array(
      "NAME" => "ASSET_STATUS",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "สถานะทรัพย์",
      "EX" => "01"
    ),
	"buildingStyle" => array(
      "NAME" => "BUILDING_STYLE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ประเภทสิ่งปลูกสร้าง",
      "EX" => "01"
    ),
    "buildingAreaAmount" => array(
      "NAME" => "BUILDING_AREA_AMOUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รวมพื้นที่สิ่งปลูกสร้าง/ตารางเมตร",
      "EX" => "1234"
    ),
    "priceSquareMater" => array(
      "NAME" => "PRICE_SQUARE_MATER",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ราคาตารางเมตรละ",
      "EX" => "12"
    ),
    "priceBuilding" => array(
      "NAME" => "PRICE_BUILDING",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ราคาสิ่งปลูกสร้าง",
      "EX" => "14808"
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
      "EX" => "บางคอแหลม"
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
      "EX" => "บางคอแหลม"
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
      "EX" => "1000"
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