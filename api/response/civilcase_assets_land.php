<?php
//header('Content-Type: application/json');

$service = array(
  "code" => "",
  "service_name" => "civilCaseAssetsLand",
  "service_info" => "รายละเอียดทรัพย์ที่ดิน",
  "table" => "WH_CIVIL_CASE_ASSETS_LAND",
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
      "EX" => "01"
    ),
    "assetDocType" => array(
      "NAME" => "ASSET_DOC_TYPE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ประเภทเอกสารสิทธิ์",
      "EX" => "01"
    ),
    "assetStatus" => array(
      "NAME" => "ASSET_STATUS",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "สถานะทรัพย์",
      "EX" => "01"
    ),
	"bookNo" => array(
      "NAME" => "BOOK_NO",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เล่ม",
      "EX" => "1"
    ),
    "pageNo" => array(
      "NAME" => "PAGE_NO",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "หน้า",
      "EX" => "2"
    ),
    "freight" => array(
      "NAME" => "FREIGHT",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขระวาง",
      "EX" => "3"
    ),
    "landNo" => array(
      "NAME" => "LAND_NO",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เลขที่ดิน",
      "EX" => "4"
    ),
    "surveyPage" => array(
      "NAME" => "SURVEY_PAGE",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "หน้าสำรวจ",
      "EX" => "5"
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
    "oldTumName" => array(
      "NAME" => "OLD_TUM_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อตำบลตามเอกสารสิทธิ์",
      "EX" => "บางคอแหลม"
    ),
    "oldAmpName" => array(
      "NAME" => "OLD_AMP_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่ออำเภอตามเอกสารสิทธิ์",
      "EX" => "บางคอแหลม"
    ),
    "oldProvName" => array(
      "NAME" => "OLD_PROV_NAME",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ชื่อจังหวัดตามเอกสารสิทธิ์",
      "EX" => "กรุงเทพมหานคร"
    ),
    "areaRai" => array(
      "NAME" => "AREA_RAI",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เนื้อที่/ไร่",
      "EX" => "7"
    ),
    "areaNgan" => array(
      "NAME" => "AREA_NGAN",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เนื้อที่/งาน",
      "EX" => "2"
    ),
    "areaWa" => array(
      "NAME" => "AREA_WA",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เนื้อที่/วา",
      "EX" => "10"
    ),
    "areaFractionWa" => array(
      "NAME" => "AREA_FRACTION_WA",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "เนื้อที่/เศษวา/10",
      "EX" => "9"
    ),
    "landPricePerWa" => array(
      "NAME" => "LAND_PRICE_PER_WA",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "ราคาที่ดินประมาณตารางวาละ",
      "EX" => "12,000"
    ),
    "landPrice" => array(
      "NAME" => "LAND_PRICE",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รวมทั้งแปลงเป็นเงิน",
      "EX" => "37306800"
    ),
    "detail" => array(
      "NAME" => "DETAIL",
      "TYPE" => "string",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "รายละเอียด",
      "EX" => "รายละเอียดที่นิติกร บรรยาย"
    ),
    "recodeCount" => array(
      "NAME" => "RECORD_COUNT",
      "TYPE" => "number",
      "FIELD_TYPE" => "O", // M/O
      "DESC" => "จำนวนรายการ",
      "EX" => "10"
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