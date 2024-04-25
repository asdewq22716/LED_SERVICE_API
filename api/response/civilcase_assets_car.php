<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "",
  "service_name" => "civilCaseAssetsCar",
  "service_info" => "รายละเอียดทรัพย์รถยนต์",
  "table" => "WH_CIVIL_CASE_ASSETS_CAR",
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
      "EX" => "05"
    ),
    "assetStatus" => array(
      "NAME" => "ASSET_STATUS",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "สถานะทรัพย์",
      "EX" => "01"
    ),
	"vehicleType" => array(
      "NAME" => "VEHICLE_TYPE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ประเภทพาหนะ",
      "EX" => "01"
    ),
    "type" => array(
      "NAME" => "TYPE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ประเภท",
      "EX" => "AA"
    ),
    "nature" => array(
      "NAME" => "NATURE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ลักษณะ",
      "EX" => "BB"
    ),
    "brand" => array(
      "NAME" => "BRAND",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ยี่ห้อ",
      "EX" => "CC"
    ),
    "model" => array(
      "NAME" => "MODEL",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "แบบ",
      "EX" => "DD"
    ),
    "tankNo" => array(
      "NAME" => "TANK_NO",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขที่ตัวถัง",
      "EX" => "1123"
    ),
    "fuel" => array(
      "NAME" => "FUEL",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เชื้อเพลิง",
      "EX" => "EE"
    ),
    "pumpingCount" => array(
      "NAME" => "PUMPING_COUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "จำนวนสูบ",
      "EX" => "2"
    ),
    "horsePowerCount" => array(
      "NAME" => "HORSE_POWER_COUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "จำนวนแรงม้า",
      "EX" => "3"
    ),
    "axlesCount" => array(
      "NAME" => "AXLES_COUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "จำนวนเพลา",
      "EX" => "4"
    ),
    "wheelsCount" => array(
      "NAME" => "WHEELS_COUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "จำนวนล้อ",
      "EX" => "5"
    ),
    "tireCount" => array(
      "NAME" => "TIRE_COUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "จำนวนยาง",
      "EX" => "6"
    ),
    "province" => array(
      "NAME" => "PROVINCE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "จังหวัด",
      "EX" => ""
    ),
    "owner" => array(
      "NAME" => "OWNER",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ผู้ครอบครอง",
      "EX" => "นาย ดดดก พพพส"
    ),
    "generationYear" => array(
      "NAME" => "GENERTION_YEAR",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รุ่นปี พ.ศ.",
      "EX" => "2560"
    ),
    "color" => array(
      "NAME" => "COLOR",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "สี",
      "EX" => "เทา"
    ),
    "engineBrand" => array(
      "NAME" => "ENGINE_BRAND",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ยี่ห้อเครื่องยนต์",
      "EX" => "FFF"
    ),
    "engineNo" => array(
      "NAME" => "ENGINE_NO",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขเครื่องยนต์",
      "EX" => "3334"
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