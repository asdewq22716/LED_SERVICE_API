<?php
class bankruptAssetsVechicleJson{

	private $objJson;
	private $objJsonPerson;

	public function getJson(){

		$this->objJson = array(

			"code" => "",
			"service_name" => "bankruptAssetsVechicle",
			"service_info" => "ข้อมูลยานพาหนะ ",
			"request" => array(
				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"ASSET_TYPE" => array(
				  "FIELD" => "vehicleType",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ประเภทยานพาหนะ",
				  "EX" => "01"
				),
				"VEHICLE_NO" => array(
				  "FIELD" => "vehicleNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขทะเบียนยานพาหนะ",
				  "EX" => "4JA1-BU8690"
				),
				"ENGINE_NO" => array(
				  "FIELD" => "engineNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขเครื่องยานพาหนะ",
				  "EX" => "MP1TFR54H4T105366"
				),
				"COURT_CODE" => array(
				  "FIELD" => "courtCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสศาล",
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
				
				"ASSET_TYPE" => array(
					"FIELD" => "assetType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภททรัพย์",
					"EX" => "01= รถยนต์ 4 ที่นั่ง
							02 = รถจักรยานยนต์
							03 = เครื่องบิน
							04 = เรือ
							05 = ส่วนพ่วง
							06 = อื่นๆ"
				),
				"WH_ASS_STOCK_ID" => array(
					"FIELD" => "assetId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียนทรัพย์",
					"EX" => "0345"
				),
				"ASSET_CODE" => array(
					"FIELD" => "assetCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสทรัพย์",
					"EX" => "1234"
				),
				"VEHICLE_NO" => array(
					"FIELD" => "vehicleNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขยานพาหนะ",
					"EX" => "1กก 4444"
				),
				"STOCK_NO" => array(
					"FIELD" => "vehicleprov",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จังหวัดยานพาหนะ",
					"EX" => "กรุงเทพมหานคร"
				),
				"VEHICLE_NAME" => array(
					"FIELD" => "vehicleName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อยานพาหนะ",
					"EX" => "USS ENTERPRISE"
				),
				"VEHICLE_TYPE" => array(
					"FIELD" => "vehicleType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทพาหนะ",
					"EX" => "มอเตอร์ไซค์"
				),
				"VEHICLE_DETAIL" => array(
					"FIELD" => "vehicleDetail",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ระบุรายละเอียดทรัพย์",
					"EX" => "ทรัพย์ทดสอบ"
				),
				"VEHICLE_CRAFTER" => array(
					"FIELD" => "vehicleCrafter",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ผู้สร้างยานพาหนะ",
					"EX" => "นายผู้สร้าง ยานพาหนะ"
				),
				"VEHICLE_OFFICER" => array(
					"FIELD" => "vehicleOfficer",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "พนักงานเจ้าหน้าที่ประจำยานพาหนะ",
					"EX" => "นายประจำ ยานพาหนะ"
				),
				"MOTOR_NAME" => array(
					"FIELD" => "motorName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเครื่อง",
					"EX" => "ซูซูกิ"
				),
				"BUSINESS_TYPE" => array(
					"FIELD" => "businessType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทการใช้งาน",
					"EX" => "พาณิชย์"
				),
				"REGIS_DATE" => array(
					"FIELD" => "regisDate",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ลงทะเบียน",
					"EX" => "2020-11-12"
				),
				"CRAFT_DATE" => array(
					"FIELD" => "craftDate",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่สร้าง",
					"EX" => "2020-11-12"
				),
				"MATERIAL" => array(
					"FIELD" => "material",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วัสดุ",
					"EX" => "ไฟเบอร์"
				),
				"TYPE" => array(
					"FIELD" => "type",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภท",
					"EX" => "AA"
				),
				"NATURE" => array(
					"FIELD" => "nature",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลักษณะ",
					"EX" => "BB"
				),
				"BRAND" => array(
					"FIELD" => "brand",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ยี่ห้อ",
					"EX" => "1234"
				),
				"MODEL" => array(
					"FIELD" => "model",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "แบบ",
					"EX" => "DD"
				),
				"DIMENSION" => array(
					"FIELD" => "dimension",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "มิติ",
					"EX" => "3"
				),
				"LENGTH" => array(
					"FIELD" => "length",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ความยาว",
					"EX" => "3"
				),
				"WIDTH" => array(
					"FIELD" => "width",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ความกว้าง",
					"EX" => "3"
				),
				"DEEP" => array(
					"FIELD" => "deep",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ความกว้าง",
					"EX" => "2"
				),
				"TANK_NO" => array(
					"FIELD" => "tankNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่ตัวถัง",
					"EX" => "1123"
				),
				"FUEL" => array(
					"FIELD" => "fuel",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เชื้อเพลิง",
					"EX" => "EE"
				),
				"PUMPING_COUNT" => array(
					"FIELD" => "pumpingCount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนสูบ",
					"EX" => "3"
				),
				"HORSE_POWER_COUNT" => array(
					"FIELD" => "horsePowerCount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนแรงม้า",
					"EX" => ""
				),
				"CC_COUNT" => array(
					"FIELD" => "ccCount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนซีซี",
					"EX" => "3"
				),
				"AXLES_COUNT" => array(
					"FIELD" => "axlesCount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนเพลา",
					"EX" => "4"
				),
				"WHEELS_COUNT" => array(
					"FIELD" => "wheelsCount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนล้อ",
					"EX" => "5"
				),
				"TIRE_COUNT" => array(
					"FIELD" => "tireCount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"WAT_COUNT" => array(
					"FIELD" => "watCount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนกิโลวัตต์",
					"EX" => "9"
				),
				"VEHICLE_PRICE" => array(
					"FIELD" => "vehiclePrice",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"PROVINCE" => array(
					"FIELD" => "province",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OWNER" => array(
					"FIELD" => "owner",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"GENERTION_YEAR" => array(
					"FIELD" => "generationYear",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"COLOR" => array(
					"FIELD" => "color",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ENGINE_BRAND" => array(
					"FIELD" => "engineBrand",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ENGINE_NO" => array(
					"FIELD" => "engineNo",
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
				"VECL_ADDRESS_NO" => array(
					"FIELD" => "veclAddressNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้ง (ที่อยู่)",
					"EX" => ""
				),
				"VECL_APPEARANCE" => array(
					"FIELD" => "veclAppearance",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลักษณะ",
					"EX" => ""
				),
				"VECL_AXLE" => array(
					"FIELD" => "veclAxle",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนเพล",
					"EX" => ""
				),
				"VECL_BRAND" => array(
					"FIELD" => "veclBrand",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ยี่ห้อ",
					"EX" => ""
				),
				"VECL_CAR_NUMBER" => array(
					"FIELD" => "veclCarNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขตัวรถ",
					"EX" => ""
				),
				"VECL_COLOR" => array(
					"FIELD" => "veclColor",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สี",
					"EX" => ""
				),
				"VECL_CREATE_DATE" => array(
					"FIELD" => "veclCreateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_CREATOR" => array(
					"FIELD" => "vclCreator",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_CREATOR_ID" => array(
					"FIELD" => "veclCreatorId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_DEPTH" => array(
					"FIELD" => "veclDepth",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ความลึก (เรือ)",
					"EX" => ""
				),
				"VECL_FUEL" => array(
					"FIELD" => "veclFuel",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เชื้อเพลิง",
					"EX" => ""
				),
				"VECL_GAS_TANK_NUMBER" => array(
					"FIELD" => "veclGasTankNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_HEAD_SHIP" => array(
					"FIELD" => "veclHeadShip",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_HOURSEPOWER" => array(
					"FIELD" => "veclHoursepower",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนแรงม้า",
					"EX" => ""
				),
				"VECL_LENGTH" => array(
					"FIELD" => "veclLength",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ความยาว (เรือ)",
					"EX" => ""
				),
				"VECL_LENGTH_SCENE" => array(
					"FIELD" => "veclLengthScene",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ความกว้าง (เรือ)",
					"EX" => ""
				),
				"VECL_MACHINE_AMOUNT" => array(
					"FIELD" => "veclMachineAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนเครื่องจักร",
					"EX" => ""
				),
				"VECL_MACHINE_NAME" => array(
					"FIELD" => "vclMachineName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเครื่อง",
					"EX" => ""
				),
				"VECL_MACHINE_TYPE" => array(
					"FIELD" => "veclMachineType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_MATERIAL" => array(
					"FIELD" => "veclMaterial",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วัสดุเรือ",
					"EX" => ""
				),
				"VECL_MODEL" => array(
					"FIELD" => "veclModel",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "แบบ",
					"EX" => ""
				),
				"VECL_MOTOR_BRAND" => array(
					"FIELD" => "veclMotorBrand",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ยี่ห้อเครื่องยนต์",
					"EX" => ""
				),
				"VECL_MOTOT_NUMBER" => array(
					"FIELD" => "veclMototNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขเครื่องยนต์",
					"EX" => ""
				),
				"VECL_NAME" => array(
					"FIELD" => "veclName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเรือ",
					"EX" => ""
				),
				"VECL_OFFICER" => array(
					"FIELD" => "veclOfficer",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "พนักงานเจ้าหน้าที่ (เครื่องบิน)",
					"EX" => ""
				),
				"VECL_OTHER_TEXT" => array(
					"FIELD" => "veclOtherText",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภททรัพย์ อื่น ๆ (ระบุ)",
					"EX" => ""
				),
				"VECL_OWNER" => array(
					"FIELD" => "veclOwner",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ผู้สร้างและชื่อแบบอากาศยานโดยผู้สร้าง",
					"EX" => ""
				),
				"VECL_POST_CODE" => array(
					"FIELD" => "veclPostCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งทรัพย์ (รหัสไปรษณีย์)",
					"EX" => ""
				),
				"VECL_POST_REGISTRATION" => array(
					"FIELD" => "veclPostRegistration",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เมืองท่าขึ้นทะเบียน",
					"EX" => ""
				),
				"VECL_POWER" => array(
					"FIELD" => "veclPower",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนกิโลวัตต์ (เรือ), จำนวน ซีซี (จักรยานยนต์)",
					"EX" => ""
				),
				"VECL_PUMP" => array(
					"FIELD" => "veclPump",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนสูบ",
					"EX" => ""
				),
				"VECL_REASON" => array(
					"FIELD" => "veclReason",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเหตุ",
					"EX" => ""
				),
				"VECL_REG_DOC_TYPE_REF" => array(
					"FIELD" => "veclRegDocTypeRef",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_REGISTER_DATE" => array(
					"FIELD" => "veclRegisterDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ออกเอกสาร,วันที่ลงทะเบียน",
					"EX" => ""
				),
				"VECL_REGISTER_NUMBER" => array(
					"FIELD" => "veclRegisterNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียน, สัญชาติและเครื่องหมายทะเบียน",
					"EX" => ""
				),
				"VECL_SERIE_NUMBER" => array(
					"FIELD" => "veclSerieNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขหมายชุดทางอากาศยาน",
					"EX" => ""
				),
				"VECL_STATUS" => array(
					"FIELD" => "veclStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะ",
					"EX" => "O=ใช้งาน
							C=ยกเลิก"
				),
				"VECL_STERN" => array(
					"FIELD" => "veclStern",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_TANK_NUMBER" => array(
					"FIELD" => "veclTankNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขตัวรถ",
					"EX" => ""
				),
				"VECL_TIRES" => array(
					"FIELD" => "veclTires",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_TONGOSS" => array(
					"FIELD" => "veclTongoss",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "น้ำหนัก (ตันกรอส)",
					"EX" => ""
				),
				"VECL_TONNAGE" => array(
					"FIELD" => "veclTonnage",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ตันเนต",
					"EX" => ""
				),
				"VECL_TYPE" => array(
					"FIELD" => "veclType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภท",
					"EX" => ""
				),
				"VECL_UPDATE_DATE" => array(
					"FIELD" => "veclUpdateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_UPDATER" => array(
					"FIELD" => "veclUpdater",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_UPDATER_ID" => array(
					"FIELD" => "veclUpdaterId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_USE_TYPE" => array(
					"FIELD" => "veclUseType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทการใช้",
					"EX" => ""
				),
				"VECL_VOLUMN_YEAR" => array(
					"FIELD" => "veclVolumnYear",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รุ่น ค.ศ.",
					"EX" => ""
				),
				"VECL_WHEEL" => array(
					"FIELD" => "veclWheel",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_WIDTH" => array(
					"FIELD" => "veclWidth",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_DIS_ID_FK" => array(
					"FIELD" => "veclDisIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ (อ้างอิงตารางเขต/อำเภอ)",
					"EX" => ""
				),
				"VECL_SDI_ID_FK" => array(
					"FIELD" => "veclSdiIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ (อ้างอิงตารางแขวง/ตำบล)",
					"EX" => ""
				),
				"VECL_ASS_ID_FK" => array(
					"FIELD" => "veclAssIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อ้างอิง ตารางทรัพย์หลัก",
					"EX" => ""
				),
				"VECL_ATD_ID_FK" => array(
					"FIELD" => "vclAtdIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อ้างอิง ประเภททรัพย์",
					"EX" => ""
				),
				"VECL_PRV_ID_FK" => array(
					"FIELD" => "veclPrvIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ (อ้างอิงตารางจังหวัด)",
					"EX" => ""
				),
				"VECL_VEHICLE_STYLE" => array(
					"FIELD" => "veclVehicleStyle",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลักษณะ",
					"EX" => ""
				),
				"VECL_STORE_ADDRESS_NO" => array(
					"FIELD" => "veclStoreAddressNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (ที่อยู่)",
					"EX" => ""
				),
				"VECL_STORE_POST_CODE" => array(
					"FIELD" => "veclStorePostCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (รหัสไปรษณีย์)",
					"EX" => ""
				),
				"VECL_STORE_PRV_ID_FK" => array(
					"FIELD" => "veclStorePrvIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (อ้างอิงตารางจังหวัด)",
					"EX" => ""
				),
				"VECL_STORE_DIS_ID_FK" => array(
					"FIELD" => "veclStoreDisIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (อ้างอิงตารางเขต/อำเภอ)",
					"EX" => ""
				),
				"VECL_STORE_SDI_ID_FK" => array(
					"FIELD" => "veclStoreSdiIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (อ้างอิงตารางแขวง/ตำบล)",
					"EX" => ""
				),
				"VECL_DISTRICT_NAME" => array(
					"FIELD" => "veclDistrictName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (ที่อยู่)",
					"EX" => ""
				),
				"VECL_PROVINCE_NAME" => array(
					"FIELD" => "veclProvinceName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งทรัพย์ (ชื่อจังหวัด)",
					"EX" => ""
				),
				"VECL_STORE_DISTRICT_NAME" => array(
					"FIELD" => "veclStoreDistrictName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (ชื่อเขต/อำเภอ)",
					"EX" => ""
				),
				"VECL_STORE_PROVINCE_NAME" => array(
					"FIELD" => "veclStoreProvinceName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (ชื่อจังหวัด)",
					"EX" => ""
				),
				"VECL_STORE_SUBDISTRICT_NAME" => array(
					"FIELD" => "veclStoreSubdistrictName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (ชื่อแขวง/ตำบล)",
					"EX" => ""
				),
				"VECL_DEPTH_UNIT" => array(
					"FIELD" => "veclDepthUnit",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หน่วยความลึก (เรือ)",
					"EX" => ""
				),
				"VECL_LENGTH_SCENE_UNIT" => array(
					"FIELD" => "veclLengthSceneUnit",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หน่วยความกว้าง (เรือ)",
					"EX" => ""
				),
				"VECL_LENGTH_UNIT" => array(
					"FIELD" => "veclLengthUnit",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หน่วยความยาว (เรือ)",
					"EX" => ""
				),
				"VECL_WIDTH_UNIT" => array(
					"FIELD" => "veclWidthUnit",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VECL_STORE_ADDRESS_FLAG" => array(
					"FIELD" => "veclStoreAddressFlag",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "1 = ที่เก็บรักษาที่เดียวกับที่ตั้งทรัพย์/ที่ยึดทรัพย์",
					"EX" => ""
				),
				"VECL_REG_PRV_ID_FK" => array(
					"FIELD" => "veclRegPrvIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียน-จังหวัด อ้างอิง ตารางจังหวัด",
					"EX" => ""
				),
				"VECL_SUBDISTRICT_NAME" => array(
					"FIELD" => "veclSubdistrictName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASS_ASSET_GROUP" => array(
					"FIELD" => "assAssetGroup",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"FIND_VEHICLE_TYPE" => array(
					"FIELD" => "findVehicleType",
					"TYPE" => "string",
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
			"service_name" => "bankrupAssetsVechicle",
			"service_info" => "ข้อมูลยานพาหนะ ",
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
					"EX" => "01=ผู้ถือกรรมสิทธิ์/ผู้ถือกรรมสิทธิ์ร่วม
							 02=ทายาท/ผู้จัดการมรดก
							 03=ผู้รับจำนอง"
				),
				"HOLDING_TYPE" => array(
					"FIELD" => "holdingType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อัตราส่วน",
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
            )
        );
        return $this->objJson;
    }

}

?>
