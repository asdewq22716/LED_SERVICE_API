<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "",
  "service_name" => "civilCaseAssetsMachine",
  "service_info" => "รายละเอียดทรัพย์เครื่องจักร",
  "table" => "WH_CIVIL_CASE_ASSETS_MACHINE",
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
      "EX" => "03"
    ),
    "assetStatus" => array(
      "NAME" => "ASSET_STATUS",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "สถานะทรัพย์",
      "EX" => "01"
    ),
	"engineName" => array(
      "NAME" => "ENGINE_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อเครื่องจักร",
      "EX" => "เครื่องทำขนม"
    ),
    "model" => array(
      "NAME" => "MODEL",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "แบบ",
      "EX" => "แบบ"
    ),
    "generate" => array(
      "NAME" => "GENERATE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รุ่น",
      "EX" => "รุ่น"
    ),
    "engineNo" => array(
      "NAME" => "ENGINE_NO",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "หมายเลขเครื่องจักร",
      "EX" => ""
    ),
    "machineSize" => array(
      "NAME" => "MACHINE_SIZE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ขนาดเครื่อง",
      "EX" => "ขนาดเครื่อง"
    ),
    "usedln" => array(
      "NAME" => "USEDLN",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ใช้ในการ",
      "EX" => "ใช้ในการ"
    ),
    "capacity" => array(
      "NAME" => "CAPACITY",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ขนาดความสามารถ",
      "EX" => "ใช้ในการ"
    ),
    "energy" => array(
      "NAME" => "ENERGY",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "พลังงานที่ใช้",
      "EX" => "พลังงานที่ใช้"
    ),
    "producer" => array(
      "NAME" => "PRODUCER",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ผู้ผลิต",
      "EX" => "ผู้ผลิต"
    ),
    "machineComponent" => array(
      "NAME" => "MACHINE_COMPONENT",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ส่วนประกอบของเครื่องจักร",
      "EX" => ""
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