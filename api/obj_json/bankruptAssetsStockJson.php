<?php
class bankruptAssetsStockJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankruptAssetsStock",
			"service_info" => "ข้อมูลหุ้น",	
			"request" => array(
				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"STOCK_TYPE" => array(
				  "FIELD" => "stockType",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ประเภทหุ้น",
				  "EX" => "001"
				),
				"STOCK_NAME" => array(
				  "FIELD" => "stockName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อหุ้น",
				  "EX" => "37-111-308-0003"
				),
				"STOCK_NO" => array(
				  "FIELD" => "stockNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขหุ้น ตั้งแต่",
				  "EX" => "0012/234"
				),
				"STOCK_NO_TO" => array(
				  "FIELD" => "stockNoTo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขหุ้น ถึง",
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
				"ASSET_TYPE" => array(
					"FIELD" => "stockType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทหุ้น",
					"EX" => "01 = เงินค่าหุ้นบริษัท
							02 = เงินค่าหุ้นสหกรณ์"
				),
				"STOCK_NO" => array(
					"FIELD" => "stockNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเลขหุ้น",
					"EX" => "2"
				),
				"STOCK_NO_TO" => array(
					"FIELD" => "stockNoTo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเลขหุ้นถึง",
					"EX" => "5"
				),
				"STORCK_COUNT" => array(
					"FIELD" => "stockCount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนหุ้น",
					"EX" => "3"
				),
				"ACCOUNT_TYPE" => array(
					"FIELD" => "accountType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทบัญชี",
					"EX" => "CC"
				),
				"MARKET_CAPITALIZATION" => array(
					"FIELD" => "marketCapitalization",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคา Par",
					"EX" => "7"
				),
				"STOCK_NAME" => array(
					"FIELD" => "stockName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"STOCK_NAME" => array(
					"FIELD" => "stockName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อหุ้น",
					"EX" => "37-111-308-0003"
				),
				"STOCK_ISSUE" => array(
					"FIELD" => "stockIssue",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"MEMBER_NO" => array(
					"FIELD" => "memberNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BANK_NAME" => array(
					"FIELD" => "bankName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BRANCH" => array(
					"FIELD" => "branch",
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
				"ASH_ACCT_NO" => array(
					"FIELD" => "ashAcctNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่บัญชี",
					"EX" => ""
				),
				"ASH_ACCT_TYP" => array(
					"FIELD" => "ashAcctTyp",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทบัญชี",
					"EX" => ""
				),
				"ASH_AMOUNT" => array(
					"FIELD" => "ashAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนหุ้น",
					"EX" => ""
				),
				"ASH_BROKER" => array(
					"FIELD" => "ashBroker",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ผู้แนะนำการลงทุน",
					"EX" => ""
				),
				"ASH_CREATE_DATE" => array(
					"FIELD" => "ashCreateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_CREATOR" => array(
					"FIELD" => "ashCreator",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_CREATOR_ID" => array(
					"FIELD" => "ashCreatorId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_DATA_DATE" => array(
					"FIELD" => "ashDataDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ข้อมูล ณ วันที่",
					"EX" => ""
				),
				"ASH_DISTRICT" => array(
					"FIELD" => "ashDistrict",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ บริษัทผู้ออกหุ้น (ชื่อเขต/อำเภอ)",
					"EX" => ""
				),
				"ASH_DISTRICT_CODE" => array(
					"FIELD" => "ashDistrictCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ บริษัทผู้ออกหุ้น (รหัสเขต/อำเภอ)",
					"EX" => ""
				),
				"ASH_MAR_NAME" => array(
					"FIELD" => "ashMarName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_MAR_PRC" => array(
					"FIELD" => "ashMarPrc",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "มูลค่าตลาด (บาท)",
					"EX" => ""
				),
				"ASH_MEET_RES" => array(
					"FIELD" => "ashMeetRes",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_OWN_COMP_ADDR" => array(
					"FIELD" => "ashOwnCompAddr",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ บริษัทผู้ออกหุ้น",
					"EX" => ""
				),
				"ASH_OWN_COMP_NAME" => array(
					"FIELD" => "ashOwnCompName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อบริษัทผู้ออกหุ้น",
					"EX" => ""
				),
				"ASH_OWN_NAME" => array(
					"FIELD" => "ashOwnName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อผู้ถือหุ้น",
					"EX" => ""
				),
				"ASH_OWN_REG_NO" => array(
					"FIELD" => "ashOwnRegNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียนผู้ถือหุ้น",
					"EX" => ""
				),
				"ASH_POSTCODE" => array(
					"FIELD" => "ashPostcode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ บริษัทผู้ออกหุ้น (รหัสไปรษณีย์)",
					"EX" => ""
				),
				"ASH_PRICE" => array(
					"FIELD" => "ashPrice",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "มูลค่าต่อหน่วย (บาท) กรณีหุ้นนอกตลาดฯ",
					"EX" => ""
				),
				"ASH_PROVINCE_CODE" => array(
					"FIELD" => "ashProvinceCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ บริษัทผู้ออกหุ้น (รหัสจังหวัด)",
					"EX" => ""
				),
				"ASH_PROVINCE" => array(
					"FIELD" => "ashProvince",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ บริษัทผู้ออกหุ้น(ชื่อจังหวัด)",
					"EX" => ""
				),
				"ASH_REG_DOC_TYPE_REF" => array(
					"FIELD" => "ashRegDocTypeRef",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_REMARK" => array(
					"FIELD" => "ashRemark",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเหตุ",
					"EX" => ""
				),
				"ASH_SHR_CAT" => array(
					"FIELD" => "ashShrCat",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "แบบหุ้น",
					"EX" => "1 = หุ้นสามัญ
							2 = หุ้นบุริมสิทธิ์
							3 = หุ้นก"
				),
				"ASH_STATUS" => array(
					"FIELD" => "ashStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะ",
					"EX" => "O=ใช้งาน
							C=ยกเลิก"
				),
				"ASH_STK_CER" => array(
					"FIELD" => "ashStkCer",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเลขหุ้น (เริ่ม)",
					"EX" => ""
				),
				"ASH_STK_NO" => array(
					"FIELD" => "ashStkNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ใบหุ้นเลขที่",
					"EX" => ""
				),
				"ASH_STK_TYPE" => array(
					"FIELD" => "ashStkType",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทหุ้น",
					"EX" => "1 = หุ้นในตลาดหลักทรัพย์
							2 = หุ้นนอกตลาดหลักทรัพย์"
				),
				"ASH_SUBDISTRICT_CODE" => array(
					"FIELD" => "ashSubdistrictCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ บริษัทผู้ออกหุ้น (รหัสแขวง/ตำบล)",
					"EX" => ""
				),
				"ASH_SUBDISTRICT" => array(
					"FIELD" => "ashSubdistrict",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ บริษัทผู้ออกหุ้น (ชื่อแขวง/ตำบล)",
					"EX" => ""
				),
				"ASH_TO" => array(
					"FIELD" => "ashTo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเลขหุ้น (สิ้นสุด)",
					"EX" => ""
				),
				"ASH_UPDATE_DATE" => array(
					"FIELD" => "ashUpdateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_UPDATER" => array(
					"FIELD" => "ashUpdater",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_UPDATER_ID" => array(
					"FIELD" => "ashUpdaterId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_ASS_ID_FK" => array(
					"FIELD" => "ashAssIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อ้างอิง ตารางทรัพย์หลัก",
					"EX" => ""
				),
				"ASH_BANK_BRANCH_NAME" => array(
					"FIELD" => "ashBankBranchName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสาขาธนาคาร",
					"EX" => ""
				),
				"ASH_BANK_NAME" => array(
					"FIELD" => "ashBankName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อธนาคาร",
					"EX" => ""
				),
				"ASH_SECURITIES_NAME" => array(
					"FIELD" => "ashSecuritiesName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อหลักทรัพย์ (ชื่อเต็ม)",
					"EX" => ""
				),
				"ASH_SECURITIES_SHORT_NAME" => array(
					"FIELD" => "ashSecuritiesShortName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อหลักทรัพย์ (ชื่อย่อ)",
					"EX" => ""
				),
				"ASH_BANK_ADDR" => array(
					"FIELD" => "ashBankAddr",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_BANK_SUBDISTRICT_CODE" => array(
					"FIELD" => "ashBankSubdistrictCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_BANK_DISTRICT_CODE" => array(
					"FIELD" => "ashBankDistrictCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_BANK_PROVINCE_CODE" => array(
					"FIELD" => "ashBankProvinceCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ASH_BANK_POSTCODE" => array(
					"FIELD" => "ashBankPostcode",
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
				"FIND_STOCK_TYPE" => array(
					"FIELD" => "findStockType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"FIND_STOCK_FORM" => array(
					"FIELD" => "findStockForm",
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
			"service_name" => "bankrupAssetsStock",
			"service_info" => "ข้อมูลหุ้น",			  
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