<?php
class civilCaseAssetsLandJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsLand",
			  "service_info" => "รายละเอียดทรัพย์ที่ดิน",
			  "request" => array(
				"ASSET_ID" => array(
				  "FIELD" => "AssetId",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขที่",
				  "EX" => "0345"
				)
			  ),
			  "response" => array(
				"ASSET_CODE" => array(
				  "FIELD" => "assetCode",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสทรัพย์",
				  "EX" => "1234"
				),
				"ASSET_ID" => array(
				  "FIELD" => "assetCode",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขที่",
				  "EX" => "0345"
				),
				"ASSET_TYPE" => array(
				  "FIELD" => "assetType",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ประเภททรัพย์",
				  "EX" => "01"
				),
				"ASSET_DOC_TYPE" => array(
				  "FIELD" => "assetDocType",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ประเภทเอกสารสิทธิ์",
				  "EX" => "01"
				),
				"ASSET_STATUS" => array(
				  "FIELD" => "assetStatus",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "สถานะทรัพย์",
				  "EX" => "01"
				),
				"BOOK_NO" => array(
				  "FIELD" => "bookNo",				 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เล่ม",
				  "EX" => "1"
				),
				"PAGE_NO" => array(
				  "FIELD" => "pageNo",				 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "หน้า",
				  "EX" => "2"
				),
				"FREIGHT" => array(
				  "FIELD" => "freight",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขระวาง",
				  "EX" => "3"
				),
				"LAND_NO" => array(
				  "FIELD" => "landNo",				 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขที่ดิน",
				  "EX" => "4"
				),
				"SURVEY_PAGE" => array(
				  "FIELD" => "surveyPage",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "หน้าสำรวจ",
				  "EX" => "5"
				),
				"TUM_CODE" => array(
				  "FIELD" => "tumCode",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสแขวง/ตำบล",
				  "EX" => "01"
				),
				"TUM_NAME" => array(
				  "FIELD" => "tumName",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อแขวง/ตำบล",
				  "EX" => "บางคอแหลม"
				),
				"AMP_CODE" => array(
				  "FIELD" => "ampCode",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสเขต/อำเภอ",
				  "EX" => "01"
				),
				"AMP_NAME" => array(
				  "FIELD" => "ampName",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อเขต/อำเภอ",
				  "EX" => "บางคอแหลม"
				),
				"PROV_CODE" => array(
				  "FIELD" => "provCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสจังหวัด",
				  "EX" => "01"
				),
				"PROV_NAME" => array(
				  "FIELD" => "provName",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อจังหวัด",
				  "EX" => "กรุงเทพมหานคร"
				),
				"ZIP_CODE" => array(
				  "FIELD" => "zipCode",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสไปรษณีย์",
				  "EX" => "1000"
				),
				"OLD_TUM_NAME" => array(
				  "FIELD" => "oldTumName",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อตำบลตามเอกสารสิทธิ์",
				  "EX" => "บางคอแหลม"
				),
				"OLD_AMP_NAME" => array(
				  "FIELD" => "oldAmpName",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่ออำเภอตามเอกสารสิทธิ์",
				  "EX" => "บางคอแหลม"
				),
				"OLD_PROV_NAME" => array(
				  "FIELD" => "oldProvName",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อจังหวัดตามเอกสารสิทธิ์",
				  "EX" => "กรุงเทพมหานคร"
				),
				"AREA_RAI" => array(
				  "FIELD" => "areaRai",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เนื้อที่/ไร่",
				  "EX" => "7"
				),
				"AREA_NGAN" => array(
				  "FIELD" => "areaNgan",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เนื้อที่/งาน",
				  "EX" => "2"
				),
				"AREA_WA" => array(
				  "FIELD" => "areaWa",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เนื้อที่/วา",
				  "EX" => "10"
				),
				"AREA_FRACTION_WA" => array(
				  "FIELD" => "areaFractionWa",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เนื้อที่/เศษวา/10",
				  "EX" => "9"
				),
				"LAND_PRICE_PER_WA" => array(
				  "FIELD" => "landPricePerWa",				  
				  "TYPE" => "number",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ราคาที่ดินประมาณตารางวาละ",
				  "EX" => "12,000"
				),
				"LAND_PRICE" => array(
				  "FIELD" => "landPrice",				 
				  "TYPE" => "number",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รวมทั้งแปลงเป็นเงิน",
				  "EX" => "37306800"
				),
				"DETAIL" => array(
				  "FIELD" => "detail",				 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รายละเอียด",
				  "EX" => "รายละเอียดที่นิติกร บรรยาย"
				),
				"RECORD_COUNT" => array(
				  "FIELD" => "recodeCount",				 
				  "TYPE" => "number",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "จำนวนรายการ",
				  "EX" => "10"
				)				
			  )
			);
			
			return $this->objJson;
	
	}
	public function getJsonPerson(){
		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsLand",
			  "service_info" => "รายละเอียดทรัพย์ที่ดิน",			  
			  "response" => array(				
				"SEQ" => array(
				  "FIELD" => "SEQ",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ลำดับ",
				  "EX" => "0001"
				),
				"PERSON_CODE" => array(
				  "FIELD" => "personCode",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสบุคคล",
				  "EX" => "1234"
				),
				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"PREFIX_CODE" => array(
				  "FIELD" => "prefixCode",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสคำนำหน้า",
				  "EX" => "01"
				),
				"PREFIX_NAME" => array(
				  "FIELD" => "prefixName",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อคำนำหน้า",
				  "EX" => "นาย"
				),
				"FIRST_NAME" => array(
				  "FIELD" => "firstName",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อ",
				  "EX" => "ทดสอบ"
				),   
				"LAST_NAME" => array(
				  "FIELD" => "lastName",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "นามสกุล",
				  "EX" => "ทดสอบ (กรณีนิติบุคคลไม่ระบุ)"
				),   
				"CONCERN_CODE" => array(
				  "FIELD" => "concernCode",				  
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสเกี่ยวข้องเป็น",
				  "EX" => "02"
				),   
				"CONCERN_NAME" => array(
				  "FIELD" => "concernName",				 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อเกี่ยวข้องเป็น",
				  "EX" => "จำเลย"
				),   
				"CONCERN_NO" => array(
				  "FIELD" => "concernNo",				 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ลำดับที่",
				  "EX" => "1"
				),     
				"HOLDING_GROUP" => array(
				  "FIELD" => "holdingGroup",				 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "กลุ่มผู้มีส่วนได้เสียในทรัพย์",
				  "EX" => "01"
				),      
				"HOLDING_TYPE" => array(
				  "FIELD" => "holdingType",				 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "",
				  "EX" => "01"
				),       
				"HOLDING_AMOUNT" => array(
				  "FIELD" => "holdingAmount",				 
				  "TYPE" => "number",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "จำนวน",
				  "EX" => "100%"
				),   
			  ),
			);
			
			return $this->objJson;
	}
}
?>