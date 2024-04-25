<?php
class bankruptAssetsLandJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
			"code" => "",
			"service_name" => "bankruptAssetsLand",
			"service_info" => "ข้อมูลที่ดิน",
			"request" => array(
				
				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"LAND_TYPE" => array(
				  "FIELD" => "landType",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC"=>"ประเภทเอกสารสิทธิ์",
				  "EX" => "1"
				),
				"DEED_NO" => array(
				  "FIELD" => "deedNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC"=>"เลขที่โฉนด",
				  "EX" => "1"
				),
				"LAND_NO" => array(
				  "FIELD" => "landNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขที่ดิน",
				  "EX" => "4"
				),
				"BOOK_NO" => array(
				  "FIELD" => "bookNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC"=>"เล่ม ",
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
				"SURVEY_PAGE" => array(
				  "FIELD" => "surveyPage",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "หน้าสำรวจ",
				  "EX" => "5"
				),
				"COURT_CODE" => array(
				  "FIELD" => "courtCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสศาล",
				  "EX" => "01"
				),
				"DEPT_CODE" => array(
				  "FIELD" => "deptCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสสำนักงาน",
				  "EX" => "01"
				),
				"PREFIX_BLACK_CASE" => array(
				  "FIELD" => "prefixBlackCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีดำ",
				  "EX" => "ล."
				),
				"BLACK_CASE" => array(
				  "FIELD" => "blackCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขดำที่",
				  "EX" => "1111"
				),
				"BLACK_YY" => array(
				  "FIELD" => "blackYY",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขดำปีที่",
				  "EX" => "2563"
				),
				"PREFIX_RED_CASE" => array(
				  "FIELD" => "prefixRedCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีแดง",
				  "EX" => "ล."
				),
				"RED_CASE" => array(
				  "FIELD" => "redCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขแดงที่",
				  "EX" => "1111"
				),
				"RED_YY" => array(
				  "FIELD" => "redYY",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขแดงปีที่",
				  "EX" => "2563"
				),
				"TUM_CODE" => array(
				  "FIELD" => "tumCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
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
				  "FIELD_TYPE" => "M", // M/O
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
				  "FIELD_TYPE" => "M", // M/O
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
				  "EX" => "10000"
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
				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"LAND_TYPE" => array(
				  "FIELD" => "landType",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC"=>"ประเภทเอกสารสิทธิ์",
				  "EX" => "1"
				),
				"DEED_NO" => array(
				  "FIELD" => "deedNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC"=>"เลขที่โฉนด",
				  "EX" => "1"
				),
				"LAND_NO" => array(
				  "FIELD" => "landNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขที่ดิน",
				  "EX" => "4"
				),
				"BOOK_NO" => array(
				  "FIELD" => "bookNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC"=>"เล่ม ",
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
				"SURVEY_PAGE" => array(
				  "FIELD" => "surveyPage",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "หน้าสำรวจ",
				  "EX" => "5"
				),
				"COURT_CODE" => array(
				  "FIELD" => "courtCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสศาล",
				  "EX" => "01"
				),
				"DEPT_CODE" => array(
				  "FIELD" => "deptCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสสำนักงาน",
				  "EX" => "01"
				),
				"PREFIX_BLACK_CASE" => array(
				  "FIELD" => "prefixBlackCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีดำ",
				  "EX" => "ผบ."
				),
				"BLACK_CASE" => array(
				  "FIELD" => "blackCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขดำที่",
				  "EX" => "1111"
				),
				"BLACK_YY" => array(
				  "FIELD" => "blackYY",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขดำปีที่",
				  "EX" => "2563"
				),
				"PREFIX_RED_CASE" => array(
				  "FIELD" => "prefixRedCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีแดง",
				  "EX" => "ผบ."
				),
				"RED_CASE" => array(
				  "FIELD" => "redCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขแดงที่",
				  "EX" => "1111"
				),
				"RED_YY" => array(
				  "FIELD" => "redYY",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขแดงปีที่",
				  "EX" => "2563"
				),
				"TUM_CODE" => array(
				  "FIELD" => "tumCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
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
				  "FIELD_TYPE" => "M", // M/O
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
				  "FIELD_TYPE" => "M", // M/O
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
				  "EX" => "10000"
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
				)
			),
			"response" => array(
				/* "COURT_CODE" => array(
					"FIELD" => "courtCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "01"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลแพ่ง"
				),
				"DEPT_CODE" => array(
					"FIELD" => "deptCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสสำนักงาน",
					"EX" => ""
				),
				"DEPT_NAME" => array(
					"FIELD" => "deptName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสำนักงาน",
					"EX" => ""
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ล."
				),
				"BLACK_CASE" => array(
					"FIELD" => "blackCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"BLACK_YY" => array(
					"FIELD" => "blackYY",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำปีที่",
					"EX" => "2564"
				),
				"PREFIX_RED_CASE" => array(
					"FIELD" => "prefixRedCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ล."
				),
				"RED_CASE" => array(
					"FIELD" => "redCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "1111"
				),
				"RED_YY" => array(
					"FIELD" => "redYY",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2564"
				),
				"PLAINTIFF1" => array(
					"FIELD" => "plaintiff",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DEFFENDANT1" => array(
					"FIELD" => "deffendant",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASSET_DOC_TYPE" => array(
					"FIELD" => "assetDocType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASSET_CODE" => array(
					"FIELD" => "assetId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียนทรัพย์",
					"EX" => "345"
				),
				"LAND_NO" => array(
					"FIELD" => "landNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่ดิน",
					"EX" => "4"
				),
				"BOOK_NO" => array(
					"FIELD" => "bookNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เล่ม",
					"EX" => "1"
				),
				"PAGE_NO" => array(
					"FIELD" => "pageNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หน้า",
					"EX" => "2"
				),
				"FREIGHT" => array(
					"FIELD" => "freight",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DEED_NO" => array(
					"FIELD" => "deedNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่โฉนด",
					"EX" => "1"
				),
				"SURVEY_PAGE" => array(
					"FIELD" => "surveyPage",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หน้าสำรวจ",
					"EX" => "5"
				),
				"AREA_RAI" => array(
					"FIELD" => "areaRai",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เนื้อที่/ไร่",
					"EX" => "7"
				),
				"AREA_NGAN" => array(
					"FIELD" => "areaNgan",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เนื้อที่/งาน",
					"EX" => "2"
				),
				"AREA_WA" => array(
					"FIELD" => "areaWa",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "นื้อที่/ตารางวา",
					"EX" => "10"
				),
				"AREA_FRACTION_WA" => array(
					"FIELD" => "areaFractionWa",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เนื้อที่/เศษวา/10",
					"EX" => "9"
				),
				"LAND_PRICE_PER_WA" => array(
					"FIELD" => "landPricePerWa",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"TUM_CODE" => array(
					"FIELD" => "tumCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสตำบล",
					"EX" => "01"
				),
				"TUM_NAME" => array(
					"FIELD" => "tumName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อตำบล",
					"EX" => "บางแก้ว"
				),
				"AMP_CODE" => array(
					"FIELD" => "ampCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสอำเภอ",
					"EX" => "02"
				),
				"AMP_NAME" => array(
					"FIELD" => "ampName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่ออำเภอ",
					"EX" => "บางพลี"
				),
				"PROV_CODE" => array(
					"FIELD" => "provCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสจังหวัด",
					"EX" => ""
				),
				"PROV_NAME" => array(
					"FIELD" => "provName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจังหวัด",
					"EX" => "สมุทรปราการ"
				),
				"ZIP_CODE" => array(
					"FIELD" => "zipCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสไปรษณีย์",
					"EX" => "10540"
				),
				"OLD_TUM_NAME" => array(
					"FIELD" => "oldTumName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อตำบลตามเอกสารสิทธิ์",
					"EX" => ""
				),
				"OLD_AMP_NAME" => array(
					"FIELD" => "oldAmpName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่ออำเภอตามเอกสารสิทธิ์",
					"EX" => "บางคอแหลม"
				),
				"OLD_PROV_NAME" => array(
					"FIELD" => "oldProvName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจังหวัดตามเอกสารสิทธิ์",
					"EX" => "กรุงเทพมหานคร"
				),
				"LAND_STATE" => array(
					"FIELD" => "landState",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สภาพที่ดิน",
					"EX" => ""
				),
				"LAND_NEARBY" => array(
					"FIELD" => "landNearby",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานที่ใกล้เคียง",
					"EX" => ""
				),
				"LAND_ADDITIONAL" => array(
					"FIELD" => "landAdditional",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่เพิ่มเติม",
					"EX" => ""
				),
				"DETAIL" => array(
					"FIELD" => "landDetail",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียด",
					"EX" => "รายละเอียดที่นิติกรบรรยาย"
				),
				"PROP_TITLE" => array(
					"FIELD" => "propTitle",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"PROP_STATUS" => array(
					"FIELD" => "propStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"PROP_STATUS_NAME" => array(
					"FIELD" => "propStatusName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"COMMIT_TYPE" => array(
					"FIELD" => "commitType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"EST_ASSET_PRICE1" => array(
					"FIELD" => "assetEstPrice1",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"EST_ASSET_PRICE2" => array(
					"FIELD" => "assetEstPrice2",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"EST_ASSET_PRICE3" => array(
					"FIELD" => "assetEstPrice3",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"EST_ASSET_PRICE4" => array(
					"FIELD" => "assetEstPrice4",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"EST_ASSET_PRICE5" => array(
					"FIELD" => "assetEstPrice5",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"EST_ASSET_PRICE6" => array(
					"FIELD" => "assetEstPrice6",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"SALE_PRICE" => array(
					"FIELD" => "salePrice",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DATE_SALE" => array(
					"FIELD" => "dateSale",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DOCKET_OWNER" => array(
					"FIELD" => "ownerName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CONCERN_NAME" => array(
					"FIELD" => "concernName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"HOLDING_TYPE" => array(
					"FIELD" => "holdingType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"PREFIX_NAME" => array(
					"FIELD" => "holdingName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"FIRST_NAME" => array(
					"FIELD" => "holdingName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LAST_NAME" => array(
					"FIELD" => "holdingName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"HOLDING_AMOUNT" => array(
					"FIELD" => "holdingAmount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				) */ 
				"LAD_CREATE_DATE" => array(
					"FIELD" => "ladCreateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LAD_CREATOR" => array(
					"FIELD" => "ladCreator",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LAD_CREATOR_ID" => array(
					"FIELD" => "ladCreatorId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LAD_UPDATE_DATE" => array(
					"FIELD" => "ladUpdateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LAD_UPDATER" => array(
					"FIELD" => "ladUpdater",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LAD_UPDATER_ID" => array(
					"FIELD" => "ladUpdaterId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LAD_ASS_ID_FK" => array(
					"FIELD" => "ladAssIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "Id ข้อมูลทรัพย์หลัก",
					"EX" => ""
				),
				"LAD_STATUS" => array(
					"FIELD" => "ladStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะ",
					"EX" => "O= ใช้งาน
							C= ยกเลิก"
				),
				"LAD_AREA_NGAN" => array(
					"FIELD" => "ladAreaNgan",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เนื้อที่/งาน",
					"EX" => ""
				),
				"LAD_AREA_RAI" => array(
					"FIELD" => "ladAreaRai",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เนื้อที่/ไร่",
					"EX" => ""
				),
				"LAD_AREA_SQWAH" => array(
					"FIELD" => "ladAreaSqwah",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เนื้อที่/ตารางวา",
					"EX" => ""
				),
				"LAD_ATD_NAME" => array(
					"FIELD" => "ladAtdName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ระบุประเภทเอกสารสิทธิ์ กรณี อื่น ๆ",
					"EX" => ""
				),
				"LAD_DEALING_FILE_NUMBER" => array(
					"FIELD" => "ladDealingFileNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขหน้าสำรวจ",
					"EX" => ""
				),
				"LAD_MAP_SHEET_NUMBER" => array(
					"FIELD" => "ladMapSheetNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LAD_PARCEL_NUMBER" => array(
					"FIELD" => "ladParcelNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขระวาง",
					"EX" => ""
				),
				"LAD_SUBDISTRICT" => array(
					"FIELD" => "ladSubdistrict",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้ง (ชื่อแขวง/ตำบล)",
					"EX" => ""
				),
				"LAD_SUBDISTRICT_CODE" => array(
					"FIELD" => "ladSubdistrictCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้ง (รหัสแขวง/ตำบล)",
					"EX" => ""
				),
				"LAD_DISTRICT" => array(
					"FIELD" => "ladDistrict",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้ง (ชื่ออำเภอ/เขต)",
					"EX" => ""
				),
				"LAD_DISTRICT_CODE" => array(
					"FIELD" => "ladDistrictCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้ง (รหัสอำเภอ/เขต)",
					"EX" => ""
				),
				"LAD_PROVINCE" => array(
					"FIELD" => "ladProvince",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้ง (ชื่อจังหวัด)",
					"EX" => ""
				),
				"LAD_PROVINCE_CODE" => array(
					"FIELD" => "ladProvinceCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้ง (รหัสจังหวัด)",
					"EX" => ""
				),
				"LAD_REG_DATE" => array(
					"FIELD" => "ladRegDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่เอกสารสิทธิ์ (เอกสารออก ณ วันที่)",
					"EX" => ""
				),
				"LAD_REG_NUMBER" => array(
					"FIELD" => "ladRegNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เอกสารเลขที่",
					"EX" => ""
				),
				"LAD_REG_PAGE" => array(
					"FIELD" => "ladRegPage",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เอกสารหน้าที่",
					"EX" => ""
				),
				"LAD_REG_VOLUME" => array(
					"FIELD" => "ladRegVolume",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เอกสารเล่มที่",
					"EX" => ""
				),
				"LAD_ATD_ID_FK" => array(
					"FIELD" => "ladAtdIdFk",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อ้างอิง ชนิดเอกสารสิทธิ์",
					"EX" => ""
				),
				"LAD_ADDITIONAL" => array(
					"FIELD" => "ladAdditional",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่เพิ่มเติม",
					"EX" => ""
				),
				"LAD_AREA_PIECE_OF_WAH" => array(
					"FIELD" => "LadAreaPieceOfWah",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "พื้นที่ (ตารางวา)",
					"EX" => ""
				),
				"LAD_LAND_NUMBER" => array(
					"FIELD" => "ladLandNumber",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LAD_LAND_STATE" => array(
					"FIELD" => "ladLandState",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สภาพที่ดิน",
					"EX" => ""
				),
				"LAD_NEARBY" => array(
					"FIELD" => "ladNearby",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานที่ใกล้เคียง",
					"EX" => ""
				),
				"LAD_PRICE_PER_UNIT" => array(
					"FIELD" => "ladPricePerUnit",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาต่อตารางวา",
					"EX" => ""
				),
				"LAD_REMARK" => array(
					"FIELD" => "ladRemark",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเหตุ",
					"EX" => ""
				),
				"LAD_SUBDISTRICT_REG_DOC" => array(
					"FIELD" => "ladSubdistrictRegDoc",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งตามเอกสารสิทธิ์ (แขวง/ตำบล)",
					"EX" => ""
				),
				"LAD_DISTRICT_REG_DOC" => array(
					"FIELD" => "LadDistrictRegDoc",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งตามเอกสารสิทธิ์ (อำเภอ/เขต)",
					"EX" => ""
				),
				"LAD_PROVINCE_REG_DOC" => array(
					"FIELD" => "LadProvinceRegDoc",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งตามเอกสารสิทธิ์ (จังหวัด)",
					"EX" => ""
				),
				"LAD_TOTAL_PRICE" => array(
					"FIELD" => "ladTotalPrice",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาทั้งแปลง",
					"EX" => ""
				),
				"LAD_ADP_ID_FK" => array(
					"FIELD" => "ladAdpIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อ้างอิง ที่ดิน (ประวัติเอกสารสิทธิ์)",
					"EX" => ""
				),
				"FIND_DOCUMENT_TYPE" => array(
					"FIELD" => "findDocumentType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				)
			)
		);
			
		return $this->objJson;
	
	}
	//bankrupt_owner,bankrupt_case_person
	public function getJsonPerson(){
		$this->objJson = array(
			"code" => "",
			"service_name" => "bankrupAssetsLand",
			"service_info" => "ข้อมูลที่ดิน",		  
			"response" => array(				
				"BANKRUPT_CODE" => array(
					"FIELD" => "bankruptCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสหมายบังคับคดี",
					"EX" => "1026833"
				),
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลแพ่ง"
				),
				"DEPT_CODE" => array(
					"FIELD" => "deptCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสสำนักงาน",
					"EX" => "1"
				),
				"DEPT_NAME" => array(
					"FIELD" => "deptName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสำนักงาน",
					"EX" => "สำนักงานบังคับคดีแพ่งกรุงเทพมหานคร 1"
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ผบ."
				),
				"BLACK_CASE" => array(
					"FIELD" => "blackCase",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"BLACK_YY" => array(
					"FIELD" => "blackYY",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำปีที่",
					"EX" => "2563"
				),
				"PREFIX_RED_CASE" => array(
					"FIELD" => "prefixRedCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ผบ."
				),
				"RED_CASE" => array(
					"FIELD" => "redCase",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "111"
				),
				"RED_YY" => array(
					"FIELD" => "redYY",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
				),
				"PERSON_CODE" => array(
					"FIELD" => "personCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสบุคคล",
					"EX" => "1234"
				),
				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
					"EX" => "111111111111"
				),
				"PREFIX_CODE" => array(
					"FIELD" => "prefixCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสคำนำหน้า",
					"EX" => "1"
				),
				"PREFIX_NAME" => array(
					"FIELD" => "prefixName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อคำนำหน้า",
					"EX" => "นาย"
				),
				"FIRST_NAME" => array(
					"FIELD" => "firstName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อ",
					"EX" => "ทดสอบ"
				),
				"LAST_NAME" => array(
					"FIELD" => "lastName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "นามสกุล",
					"EX" => "ทดสอบ (กรณีนิติบุคคลไม่ระบุ)"
				),
				"CONCERN_CODE" => array(
					"FIELD" => "concernCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสเกี่ยวข้องเป็น",
					"EX" => "2"
				),
				"CONCERN_NAME" => array(
					"FIELD" => "concernName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเกี่ยวข้องเป็น",
					"EX" => "จำเลย"
				),
				"CONCERN_NO" => array(
					"FIELD" => "ConcernNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับที่",
					"EX" => "1"
				),
				"HOLDING_GROUP" => array(
					"FIELD" => "holdingGroup",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "กลุ่มผู้มีส่วนได้เสียในทรัพย์",
					"EX" => "01=ผู้ถือกรรมสิทธิ์/ผู้ถือกรรมสิทธิ์ร่วม
							02=ทายาท/ผู้จัดการมรดก
							03=ผู้รับจำนอง"
				),
				"HOLDING_TYPE" => array(
					"FIELD" => "holdingType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => "01=ร้อยละ
							02=สัดส่วน"
				),
				"HOLDING_AMOUNT" => array(
					"FIELD" => "holdingAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวน",
					"EX" => "1"
				) 
			),
		);
			
			return $this->objJson;
	}
}
?>