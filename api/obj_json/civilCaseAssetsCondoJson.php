<?php
class civilCaseAssetsCondoJson{

	private $objJson;
	private $objJsonPerson;

	public function getJson(){

		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsCondo",
			  "service_info" => "รายละเอียดข้อมูลห้องชุด ",
			  "request" => array(

				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"BUILDING_VILLAGE" => array(
				  "FIELD" => "condoName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อคอนโด",
				  "EX" => "0012/234"
				),
				"CONDO_REGIS_NO" => array(
				  "FIELD" => "condoRegisNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขทะเบียนห้องชุด",
				  "EX" => "0012/234"
				),
				"DEED_NO" => array(
				  "FIELD" => "deedNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขที่ดิน",
				  "EX" => "0012/234"
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
				  "DESC" => "รหัสเขต/อำเภอ",
				  "EX" => "01"
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
				  "DESC" =>"ชื่อตำบลตามเอกสารสิทธิ์",
				  "EX" => "บางคอแหลม"
				  ),
				"OLD_AMP_NAME" => array(
				  "FIELD" => "oldAmpName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" =>"ชื่ออำเภอตามเอกสารสิทธิ์",
				  "EX" => "บางคอแหลม"
				  ),
				"OLD_PRO_NAME" => array(
				  "FIELD" => "oldProvName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC"=>"ชื่อจังหวัดตามเอกสารสิทธิ์",
				  "EX" => "กรุงเทพมหานคร"
				)
			),
			"response" => array(

				/*"COURT_CODE" => array(
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
                    "DESC" => "เลขทะเบียนทรัพย์",
                    "EX" => "0345"
                ),
                "ASSET_STATUS" => array(
                    "FIELD" => "assetStatus",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "รหัสทรัพย์",
                    "EX" => "1234"
                ),
                "CONDO_FLOOR" => array(
                    "FIELD" => "CondoFloor",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เลขยานพาหนะ",
                    "EX" => "1กก 4444"
                ),
                "CONDO_REGIS_NO" => array(
                    "FIELD" => "CondoRegisNo",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "จังหวัดยานพาหนะ",
                    "EX" => "กรุงเทพมหานคร"
                ),
                "BUILDING_VILLAGE" => array(
                    "FIELD" => "CondoName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อยานพาหนะ",
                    "EX" => "USS ENTERPRISE"
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
                "EST_PRICE_AMOUNT" => array(
                    "FIELD" => "assetEstPrice1",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => ""
                ),
                "EST_DOL" => array(
                    "FIELD" => "assetEstPrice2",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => ""
                ),
                "EST_VANG_SUB" => array(
                    "FIELD" => "assetEstPrice3",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => ""
                ),
                "EST_GROUP_AMOUNT" => array(
                    "FIELD" => "assetEstPrice4",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => ""
                ),
                "EST_SUB_AMOUNT" => array(
                    "FIELD" => "assetEstPrice5",
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
                "DOSS_OWNER_NAME" => array(
                    "FIELD" => "ownerName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => ""
                ),
                "WH_CIVIL_ID" => array(
                    "FIELD" => "civilCode",
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
                "FULL_NAME" => array(
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
                )*/
                "CFC_BUILDING_GEN" => array(
                  "FIELD" => "cfcBuildingGen",
                  "TYPE" => "number",
                  "FIELD_TYPE" => "M", // M/O
                  "DESC" => "เลขห้องชุด",
                  "EX" => ""
                ),
                "CFC_CIVIL_GEN" => array(
                    "FIELD" => "cfcCivilGen",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "อ้างอิงเลขสำนวนยึด",
                    "EX" => ""
                ),
                "CFC_BUILDING_REQ_GEN" => array(
                    "FIELD" => "cfcBuildingReqGen",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เลขห้องชุดทื่ขอยึด",
                    "EX" => ""
                ),
                "SEQ_NO" => array(
                    "FIELD" => "seqNo",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ลำดับที่",
                    "EX" => ""
                ),
                "ADDR_NO" => array(
                    "FIELD" => "addrNo",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ห้องชุดเลขที่",
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
                    "DESC" => "ทะเบียนอาคารชุดเลขที่",
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
                
                "CENT_LOC_GEN" => array(
                    "FIELD" => "centLocGen",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เลขรหัสพื้นที่",
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
                "EST_AREA" => array(
                    "FIELD" => "estArea",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เนื้อที่ประมาณ(ตารางเมตร)",
                    "EX" => ""
                ),
                "HIGHT" => array(
                    "FIELD" => "hight",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "สูง(เมตร)",
                    "EX" => ""
                ),
                "R_SELL_TYPE" => array(
                    "FIELD" => "rSellType",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "วิธีขาย",
                    "EX" => ""
                ),
                "OWNER_DIVIDEND" => array(
                    "FIELD" => "ownerDividend",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "อัตราส่วนแห่งกรรมสิทธิ์ในทรัพย์ส่วนกลาง(จำนวนส่วน)",
                    "EX" => ""
                ),
                "OWNER_DIVISOR" => array(
                    "FIELD" => "ownerDivisor",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "อัตราส่วนแห่งกรรมสิทธิ์ในทรัพย์ส่วนกลาง(ในส่วน)",
                    "EX" => ""
                ),
                "CENTER_AMOUNT" => array(
                    "FIELD" => "centerAmount",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "อัตราค่าใช้จ่ายส่วนกลาง",
                    "EX" => ""
                ),
                "CENTER_METR_AMOUNT" => array(
                    "FIELD" => "centerMetrAmount",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ค่าใช้จ่ายส่วนกลางต่อตารางเมตรละ(บาท)",
                    "EX" => ""
                ),
                "CENTER_PERIOD" => array(
                    "FIELD" => "centerPeriod",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ค่าใช้จ่ายส่วนกลางต่องวด",
                    "EX" => ""
                ),
                "CENTER_DEBT_DATE" => array(
                    "FIELD" => "centerDebtDate",
                    "TYPE" => "date",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "วันที่ค้างชำระของหนี้ส่วนกลาง",
                    "EX" => ""
                ),
                "CENTER_EXPENSE_AMOUNT" => array(
                    "FIELD" => "centerExpenseAmount",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ภาระหนี้ส่วนกลางค้างชำระ",
                    "EX" => ""
                ),
                "CENTER_DEBT_PERIOD" => array(
                    "FIELD" => "centerDebtPeriod",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ภาระหนี้ค้างส่วนกลางต่องวด",
                    "EX" => ""
                ),
                "PER_METR_AMOUNT" => array(
                    "FIELD" => "perMetrAmount",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ราคาต่อตารางเมตร",
                    "EX" => ""
                ),
                "ADD_PERCENT" => array(
                    "FIELD" => "addPercent",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ปรับเพิ่มร้อยละ",
                    "EX" => ""
                ),
                "ADD_AMOUNT" => array(
                    "FIELD" => "addAmount",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ปรับเพิ่มเป็นเงิน",
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
                "EST_ASS_AMOUNT" => array(
                    "FIELD" => "estAssAmount",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ราคาประเมินสำนักงานวางทรัพย์",
                    "EX" => ""
                ),
                "EST_GOV_AMOUNT" => array(
                    "FIELD" => "estGovAmount",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ราคารประเมินของทางราชการ",
                    "EX" => ""
                ),
                "EST_PRICE_AMOUNT" => array(
                    "FIELD" => "estPriceAmount",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ราคาประเมินเจ้าพนักงานบังคับคดีขณะยึด",
                    "EX" => ""
                ),
                "BUILDING_DESC" => array(
                    "FIELD" => "buildingDesc",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "หมายเหตุ",
                    "EX" => ""
                ),
                "NEARLY_AREA" => array(
                    "FIELD" => "nearlyArea",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "พื้นที่ใกล้เคียง",
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
                            07 = ขออนุญาตศาลขาย
                            90 = รวบรวม"
                ),
                "CENT_DEPT_GEN" => array(
                    "FIELD" => "centDeptGen",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เลขรหัสหน่วยงาน",
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
                "CREATE_DATE" => array(
                    "FIELD" => "createDate",
                    "TYPE" => "date",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "วันที่สร้างข้อมูล",
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
                "CREATE_BY_USERID" => array(
                    "FIELD" => "createByUserid",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "รหัสผู้สร้างข้อมูล",
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
                    "EX" => ""
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
                "BUILDING_AGE" => array(
                    "FIELD" => "buildingAge",
                    "TYPE" => "number",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ปลูกสร้างมาแล้วกี่ปี",
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
                )
			  )
			);

			return $this->objJson;

	}
	public function getJsonPerson(){
		/*$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsCondo",
			  "service_info" => "รายละเอียดข้อมูลห้องชุด",
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

			return $this->objJson;*/
	}
}
?>
