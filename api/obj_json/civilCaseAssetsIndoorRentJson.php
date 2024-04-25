<?php
class civilCaseAssetsIndoorRentJson{

	private $objJson;
	private $objJsonPerson;

	public function getJson(){

		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsIndoorRent",
			  "service_info" => "รายละเอียดทรัพย์สิทธิการเช่า (พื้นที่ในอาคาร)",
			  "request" => array(


				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"DEED_NO" => array(
				  "FIELD" => "deedNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC"=>"เลขที่โฉนด",
				  "EX" => "1"
				),
				"ADDR_NO" => array(
				  "FIELD" => "addrNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขที่ดิน",
				  "EX" => "4"
				),
				"BUILDING_NO" => array(
				  "FIELD" => "buildingNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC"=>"เล่ม ",
				  "EX" => "1"
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
				)
			),
			"response" => array(

				/* "CIVIL_CODE" => array(
					"FIELD" => "civilCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสหมายบังคับคดี",
					"EX" => "1026833"
				),
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "001"
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
					"EX" => "01"
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
					"EX" => "2563"
				),
				"PLAINTIFF1" => array(
					"FIELD" => "plaintiff1",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"PLAINTIFF2" => array(
					"FIELD" => "plaintiff2",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"PLAINTIFF3" => array(
					"FIELD" => "plaintiff3",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DEFFENDANT1" => array(
					"FIELD" => "deffendant1",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DEFFENDANT2" => array(
					"FIELD" => "deffendant2",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DEFFENDANT3" => array(
					"FIELD" => "deffendant3",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASSET_ID" => array(
					"FIELD" => "assetId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASSET_CODE" => array(
				  "FIELD" => "assetCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสทรัพย์",
				  "EX" => "1234"
				),
				"ASSET_STATUS" => array(
					"FIELD" => "assetStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะทรัพย์",
					"EX" => "00= งดยึด
							01= ยึด
							02= ศาลอนุญาตขาย
							03= ส่งงานจำหน่าย
							04= ขายได้
							05= ถอนยึด
							06= โอนไปล้มละลาย
							07= ขออนุญาตศาลขาย
							90= รวบรวม
							13= ติดหลักประกัน"
				),
				"BOOK_NO" => array(
					"FIELD" => "bookNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=>"เล่ม ",
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
					"DESC" => "เลขระวาง",
					"EX" => "3"
				),
				"LAND_NO" => array(
					"FIELD" => "landNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่ดิน",
					"EX" => "4"
				),
				"SURVEY_PAGE" => array(
					"FIELD" => "surveyPage",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หน้าสำรวจ",
					"EX" => "5"
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
					"FIELD_TYPE" => "M", // M/O
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
					"FIELD_TYPE" => "M", // M/O
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
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจังหวัด",
					"EX" => "กรุงเทพมหานคร"
				),
				"ZIP_CODE" => array(
					"FIELD" => "zipCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสไปรษณีย์",
					"EX" => "10000"
				),
				"OLD_TUM_NAME" => array(
					"FIELD" => "oldTumName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อตำลบตามเอกสารสิทธิ์",
					"EX" => "บางคอแหลม"
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
					"DESC" => "เนื้อที่/ตารางวา",
					"EX" => "10"
				),
				"AREA_FRACTION_WA" => array(
					"FIELD" => "areaFractionWa",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เนื้อที่/เศษวา/10่",
					"EX" => "9"
				),
				"DETAIL" => array(
					"FIELD" => "detail",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียดที่นิติกรบรรยาย",
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
				"EST_PRICE_AMOUNT" => array(
					"FIELD" => "assetEstPrice1",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินเจ้าพนักงานบังคับคดี",
					"EX" => "100000"
				),
				"EST_DOL" => array(
					"FIELD" => "assetEstPrice2",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินกรมธนารักษ์",
					"EX" => "100000"
				),
				"EST_VANG_SUB" => array(
					"FIELD" => "assetEstPrice3",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินของเจ้าพนักงานประเมินราคาทรัพย์",
					"EX" => "100000"
				),
				"EST_GROUP_AMOUNT" => array(
					"FIELD" => "assetEstPrice4",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินโดยคณะกรรมการกำหนดราคา",
					"EX" => "100000"
				),
				"EST_SUB_AMOUNT" => array(
					"FIELD" => "assetEstPrice5",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินโดยคณะอนุกรรมการ",
					"EX" => "100000"
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
				"DOSS_OWNER_NAME" => array(
					"FIELD" => "ownerName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				) */
				"CFC_BUILDING_RENT_RIGHT_GEN" => array(
					"FIELD" => "cfcBuildingRentRightGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขสิทธิการเช่าพื้นที่ในอาคาร",
					"EX" => ""
				),
				"CFC_BD_RENT_RIGHT_REQ_GEN" => array(
					"FIELD" => "cfcBdRentRightReqGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขสิทธิการเช่าพื้นที่ในอาคารที่ขอยึด",
					"EX" => ""
				),
				"CFC_CIVIL_GEN" => array(
					"FIELD" => "cfcCivilGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อ้างอิงเลขสำนวนยึด",
					"EX" => ""
				),
				"SEQ_NO" => array(
					"FIELD" => "seqNo",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับที่",
					"EX" => ""
				),
				"RENT_TYPE" => array(
					"FIELD" => "rentType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภททรัพย์ที่เช่า ",
					"EX" => ""
				),
				"VILLAGE_NAME" => array(
					"FIELD" => "villageName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมู่บ้าน/โครงการ/อาคาร",
					"EX" => ""
				),
				"ADDR_NO" => array(
					"FIELD" => "addrNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "พื้นที่ในอาคารเลขที่",
					"EX" => ""
				),
				"FLOOR" => array(
					"FIELD" => "floor",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชั้นที่",
					"EX" => ""
				),
				"BUILDING_NO" => array(
					"FIELD" => "buildingNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อาคารเลขที่",
					"EX" => ""
				),
				"BUILDING_NAME" => array(
					"FIELD" => "buildingName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่ออาคาร",
					"EX" => ""
				),
				"LICENSE_NO" => array(
					"FIELD" => "licenseNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ทะเบียนพื้นที่ในอาคารเลขที่",
					"EX" => ""
				),
				"DEED_NO" => array(
					"FIELD" => "deedNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่โฉนด",
					"EX" => ""
				),
				"DISTRICT_NAME" => array(
					"FIELD" => "districtName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ตำบล/แขวง(ตามเอกสารสิทธิ์)",
					"EX" => ""
				),
				"AMPHUR_NAME" => array(
					"FIELD" => "amphurName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อำเภอ/เขต(ตามเอกสารสิทธิ์)",
					"EX" => ""
				),
				"PROVINCE_NAME" => array(
					"FIELD" => "provinceName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จังหวัด(ตามเอกสารสิทธิ์)",
					"EX" => ""
				),
				"SOI" => array(
					"FIELD" => "soi",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ซอย",
					"EX" => ""
				),
				"MOO_NO" => array(
					"FIELD" => "mooNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมู่ที่",
					"EX" => ""
				),				
				"ROAD" => array(
					"FIELD" => "road",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ถนน",
					"EX" => ""
				),
				"CENT_LOG_GEN" => array(
					"FIELD" => "centLogGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งทรัพย์",
					"EX" => ""
				),
				"FARM" => array(
					"FIELD" => "farm",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ไร่",
					"EX" => ""
				),
				"NGAN" => array(
					"FIELD" => "ngan",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "งาน",
					"EX" => ""
				),
				"VA" => array(
					"FIELD" => "va",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วา",
					"EX" => ""
				),
				"REMAIN_VA" => array(
					"FIELD" => "remainVa",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เนื้อที่(เศษวา)",
					"EX" => ""
				),
				"REMAIN_BASE" => array(
					"FIELD" => "remainBase",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เนื้อที่(ส่วนวา)",
					"EX" => ""
				),
				"CONTACT_NO" => array(
					"FIELD" => "contactNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สัญญาเช่าเลขที่",
					"EX" => ""
				),
				"CONTACT_DATE" => array(
					"FIELD" => "contactDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ทำสัญญา",
					"EX" => ""
				),
				"START_DATE" => array(
					"FIELD" => "startDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่เริ่มต้นสัญญา",
					"EX" => ""
				),
				"EXPIRE_DATE" => array(
					"FIELD" => "expireDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่สิ้นสุดสัญญา",
					"EX" => ""
				),
				"RENT_QTY" => array(
					"FIELD" => "rentQty",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ระยะเวลาการเช่า",
					"EX" => ""
				),
				"RENT_UNIT" => array(
					"FIELD" => "rentUnit",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หน่วยเวลา",
					"EX" => ""
				),
				"REMAIN_DAY" => array(
					"FIELD" => "remainDay",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนวันที่เหลือของสัญญา",
					"EX" => ""
				),
				"RATE_AMOUNT" => array(
					"FIELD" => "rateAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อัตราค่าเช่า",
					"EX" => ""
				),
				"UNIT_AMOUNT" => array(
					"FIELD" => "unitAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ค่าเช่า ตารางเมตรละ",
					"EX" => ""
				),
				"UNIT_PERIOD" => array(
					"FIELD" => "unitPeriod",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ค่าเช่า ต่อเดือน ต่อปี",
					"EX" => ""
				),
				"REMAIN_YR" => array(
					"FIELD" => "remainYr",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คิดเป็นจำนวนคงเหลือ(ปี)",
					"EX" => ""
				),
				"REMAIN_MM" => array(
					"FIELD" => "remainMm",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คิดเป็นจำนวนคงเหลือ(เดือน)",
					"EX" => ""
				),
				"REMAIN_DD" => array(
					"FIELD" => "remainDd",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คิดเป็นจำนวนคงเหลือ(วัน)",
					"EX" => ""
				),
				"EST_UNIT_AMOUNT" => array(
					"FIELD" => "estUnitAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินตารางเมตรละ",
					"EX" => ""
				),
				"EST_RENT_AMOUNT" => array(
					"FIELD" => "estRentAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินอัตราเช่า*ระยะสัญญาที่เหลือ",
					"EX" => ""
				),
				"START_AMOUNT" => array(
					"FIELD" => "startAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เงินกินเปล่า",
					"EX" => ""
				),
				"EST_START_AMOUNT" => array(
					"FIELD" => "estStartAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินเงินกินเปล่า*ระยะสัญญาที่เหลือ/ระยะตามสัญญา",
					"EX" => ""
				),
				"ADD_PERCENT" => array(
					"FIELD" => "addPercent",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ปรับเพิ่มร้อยละ",
					"EX" => ""
				),
				"MINUS_PERCENT" => array(
					"FIELD" => "minusPercent",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ปรับลดร้อยละ",
					"EX" => ""
				),
				"MINUS_AMOUNT" => array(
					"FIELD" => "minusAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ปรับลดเป็นเงิน",
					"EX" => ""
				),
				"RENT_COMMENT" => array(
					"FIELD" => "rentComment",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เงื่อนไขการเช่า",
					"EX" => ""
				),
				"EST_PRICE_AMOUNT" => array(
					"FIELD" => "estPriceAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินเจ้าพนักงานบังคับคดีขณะยึด",
					"EX" => ""
				),
				"ASSET_STATUS" => array(
					"FIELD" => "assetStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะทรัพย์",
					"EX" => "00 = งดยึด  
							01 = ยึด  
							02 = ศาลอนุญาตขาย  
							03 = ส่งจำหน่าย  
							04 = ขายได้  
							05 = ถอนยึด  
							06 = โอนไปล้มละลาย  
							90 = รวบรวม"
				),
				"CENT_DEPT_GEN" => array(
					"FIELD" => "centDeptGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขรหัสหน่วยงาน",
					"EX" => ""
				),
				"CREATE_BY_USERID" => array(
					"FIELD" => "createByUserid",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสผู้สร้างข้อมูล",
					"EX" => ""
				),
				"CREATE_DATE" => array(
					"FIELD" => "createDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่สร้างข้อมูล",
					"EX" => ""
				),
				"UPDATE_BY_USERID" => array(
					"FIELD" => "updateByUserid",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสผู้แก้ไขล่าสุด",
					"EX" => ""
				),
				"UPDATE_DATE" => array(
					"FIELD" => "updateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่แก้ไขล่าสุด",
					"EX" => ""
				),
				"CREATE_BY_PROGID" => array(
					"FIELD" => "createByProgid",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "โปรแกรมที่สร้างข้อมูล",
					"EX" => ""
				),
				"UPDATE_BY_PROGID" => array(
					"FIELD" => "updateByProgid",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "โปรแกรมที่ปรับปรุงข้อมูล",
					"EX" => ""
				),
				"VERSION" => array(
					"FIELD" => "version",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "version ของข้อมูล",
					"EX" => ""
				),
				"DATA_ID" => array(
					"FIELD" => "dataId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ID ของข้อมูลสำหรับ security",
					"EX" => ""
				),
				"COPY_FLAG" => array(
					"FIELD" => "copyFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ยึดตาม",
					"EX" => "1 = ต้นฉบับ 
							2 = สำเนา 
							3 = สำเนา(ต้นฉบับชำรุด)"
				),
				"USER_DEPT_CODE" => array(
					"FIELD" => "userDeptCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสหน่วยงานผู้สร้างข้อมูล",
					"EX" => ""
				),
				"DPD_STRUCTURE_GEN" => array(
					"FIELD" => "dpdStructureGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสโครงสร้างสายงาน",
					"EX" => ""
				),
				"WIDE" => array(
					"FIELD" => "wide",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "กว้าง",
					"EX" => ""
				),
				"LONGS" => array(
					"FIELD" => "longs",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ยาว",
					"EX" => ""
				),
				"VERANDA_WIDE" => array(
					"FIELD" => "verandaWide",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ระเบียงกว้าง",
					"EX" => ""
				),
				"AREA" => array(
					"FIELD" => "area",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เนื้อที่รวม",
					"EX" => ""
				),
				"BUILDING_REGISTRATION_FLAG" => array(
					"FIELD" => "buildingRegistrationFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภททรํพย์",
					"EX" => "ว่าง = ไม่ระบุ 
							1 = ไม่มีทะเบียน 
							2 = มีทะเบียน"
				),
				"BUILDING_TRAIN_FLAG" => array(
					"FIELD" => "buildingTrainFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ติดแนวรถไฟฟ้า",
					"EX" => "1 = ติดรถไฟฟ้า 
							2 = ไม่ติดรถไฟฟ้า"
				),
				"WH_CIVIL_ID" => array(
					"FIELD" => "whCivilId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				)
			)
		);

			return $this->objJson;

	}
	public function getJsonPerson(){
		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsIndoorRent",
			  "service_info" => "รายละเอียดทรัพย์สิทธิการเช่า",
			  "response" => array(

				"SEQ" => array(
				  "FIELD" => "Seq",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ลำดับ",
				  "EX" => "0001"
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
				  "EX" => "0111111111111"
				),
				"PREFIX_CODE" => array(
				  "FIELD" => "prefixCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสคำนำหน้า",
				  "EX" => "01"
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
				  "EX" => "02"
				),
				"CONCERN_NAME" => array(
				  "FIELD" => "concernName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อเกี่ยวข้องเป็น",
				  "EX" => "จำเลย"
				),
				"CONCERN_NO" => array(
				  "FIELD" => "concernNo",
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
				  "EX" => "01=ผู้ถือกรรมสิทธิ์/ผู้ถือกรรมสิทธิ์ร่วม02=ทายาท/ผู้จัดการมรดก03=ผู้รับจำนอง"
				),
				"HOLDING_TYPE" => array(
				  "FIELD" => "holdingType",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "",
				  "EX" => "01=ร้อยละ 02=สัดส่วน"
				),
				"HOLDING_AMOUNT" => array(
				  "FIELD" => "holdingAmount",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "จำนวน",
				  "EX" => "100%"
				),
			  ),
			);

			return $this->objJson;
	}
}
?>
