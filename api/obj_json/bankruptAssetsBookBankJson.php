<?php
class bankruptAssetsBookBankJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankruptAssetsBookBank",
			"service_info" => "ข้อมูลบัญชีเงินฝากธนาคาร ",
			"request" => array(
			"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"BANK_ACC_NO" => array(
				  "FIELD" => "bankAccNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขบัญชี",
				  "EX" => "37-111-308-0003"
				),
				"START_NO" => array(
				  "FIELD" => "bankName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อสมุดบัญชี",
				  "EX" => "ธนาคารกรุงไทย จำกัด (มหาชน)"
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
                /* "COURT_NAME" => array(
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
				"WH_ASS_BANK_ACC_ID" => array(
					"FIELD" => "assetId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียนทรัพย์",
					"EX" => ""
				),
				"BANK_ACC_TYPE" => array(
					"FIELD" => "bookBankType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BANK_ACC_NO" => array(
					"FIELD" => "bankAccNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BANK_ACC_NAME" => array(
					"FIELD" => "acountName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BANK_ACC_AMOUNT" => array(
					"FIELD" => "moneyAmount",
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
				"BANK_BRANCH_NAME" => array(
					"FIELD" => "branchName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ADDRESS" => array(
					"FIELD" => "address",
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
				"BKA_BANK_ACCOUNT_AMOUNT" => array(
					"FIELD" => "bkaBankAccountAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนเงินคงเหลือในบัญชี",
					"EX" => ""
				),
				"BKA_BANK_ACCOUNT_NAME" => array(
					"FIELD" => "bkaBankAccountName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อบัญชี",
					"EX" => ""
				),
				"BKA_BANK_ACCOUNT_NO" => array(
					"FIELD" => "bkaBankAccountNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่บัญชี",
					"EX" => ""
				),
				"BKA_BANK_ACC_TYPE_OTH_NAME" => array(
					"FIELD" => "bkaBankAccTypeOthName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทบัญชี กรณีระบุอื่น ๆ",
					"EX" => ""
				),
				"BKA_CREATE_DATE" => array(
					"FIELD" => "bkaCreateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BKA_CREATOR" => array(
					"FIELD" => "bkaCreator",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BKA_CREATOR_ID" => array(
					"FIELD" => "bkaCreatorId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BKA_REG_DOC_TYPE_REF" => array(
					"FIELD" => "bkaRegDocTypeRef",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BKA_STATUS" => array(
					"FIELD" => "bkaStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะ",
					"EX" => "O=ใช้งาน
							C=ยกเลิก"
				),
				"BKA_UPDATE_DATE" => array(
					"FIELD" => "bkaUpdateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BKA_UPDATER" => array(
					"FIELD" => "bkaUpdater",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BKA_UPDATER_ID" => array(
					"FIELD" => "bkaUpdaterId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"BKA_ASS_ID_FK" => array(
					"FIELD" => "bkaAssIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "Id ข้อมูลทรัพย์หลัก",
					"EX" => ""
				),
				"BKA_BNK_ID_FK" => array(
					"FIELD" => "bkaBnkIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "Id ชื่อธนาคาร",
					"EX" => ""
				),
				"BKA_ATD_ID_FK" => array(
					"FIELD" => "bkaAtdIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "Id ประเภทบัญชี",
					"EX" => ""
				),
				"BKA_ADDRESS_NO" => array(
					"FIELD" => "bkaAddressNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ธนาคาร",
					"EX" => ""
				),
				"BKA_DISTRICT" => array(
					"FIELD" => "bkaDistrict",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ธนาคาร (เขต/อำเภอ)",
					"EX" => ""
				),
				"BKA_DISTRICT_CODE" => array(
					"FIELD" => "bkaDistrictCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ธนาคาร (รหัสเขต/อำเภอ)",
					"EX" => ""
				),
				"BKA_PROVINCE" => array(
					"FIELD" => "bkaProvince",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ธนาคาร (จังหวัด)",
					"EX" => ""
				),
				"BKA_PROVINCE_CODE" => array(
					"FIELD" => "bkaProvinceCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ธนาคาร (รหัสจังหวัด)",
					"EX" => ""
				),
				"BKA_SUBDISTRICT" => array(
					"FIELD" => "bkaSubdistrict",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ธนาคาร (แขวง/ตำบล)",
					"EX" => ""
				),
				"BKA_SUBDISTRICT_CODE" => array(
					"FIELD" => "bkaSubdistrictCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ธนาคาร (รหัสแขวง/ตำบล)",
					"EX" => ""
				),
				"BKA_ZIPCODE" => array(
					"FIELD" => "bkaZipcode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ธนาคาร (รหัสไปรษณีย์)",
					"EX" => ""
				),
				"BKA_BANK_BRANCH_NAME" => array(
					"FIELD" => "bkaBankBranchName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสาขาธนาคาร",
					"EX" => ""
				),
				"BKA_REMARK" => array(
					"FIELD" => "bkaRemark",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ข้อความหมายเหตุ",
					"EX" => ""
				),
				"FIND_ACCOUNT_TYPE" => array(
					"FIELD" => "findAccountType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"FIND_BANK_NAME" => array(
					"FIELD" => "findBankName",
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
			"service_name" => "bankrupAssetsBookBank",
			"service_info" => "ข้อมูลบัญชีเงินฝากธนาคาร ",			  
			"response" => array(
                "bankruptCode" => array(
					"FIELD" => "bankruptCode",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสหมายบังคับคดี",
					"EX" => "1026833"
				),
				"courtCode" => array(
					"FIELD" => "courtCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
				),
				"courtName" => array(
					"FIELD" => "courtName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลแพ่ง"
				),
				"deptCode" => array(
					"FIELD" => "deptCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสสำนักงาน",
					"EX" => "1"
				),
				"deptName" => array(
					"FIELD" => "deptName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสำนักงาน",
					"EX" => "สำนักงานบังคับคดีแพ่งกรุงเทพมหานคร 1"
				),
				"prefixBlackCase" => array(
					"FIELD" => "prefixBlackCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ผบ."
				),
				"blackCase" => array(
					"FIELD" => "blackCase",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"blackYY" => array(
					"FIELD" => "blackYY",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำปีที่",
					"EX" => "2563"
				),
				"prefixRedCase" => array(
					"FIELD" => "prefixRedCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ผบ."
				),
				"redCase" => array(
					"FIELD" => "redCase",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "111"
				),
				"redYY" => array(
					"FIELD" => "redYY",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
				),
				"recordCount" => array(
					"FIELD" => "recordCount",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนรายการ",
					"EX" => "10"
				),
				"assetDetial" => array(
					"FIELD" => "assetDetial",
					"NAME" => "",
					"TYPE" => "List",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียดทรัพย์",
					"EX" => "รายละเอียด ตามตารางรายละเอียดทรัพย์ "
				),
				"assetCode" => array(
					"FIELD" => "assetCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสทรัพย์",
					"EX" => "1234"
				),
				"assetId" => array(
					"FIELD" => "assetId",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียน",
					"EX" => "345"
				),
				"assetStatus" => array(
					"FIELD" => "assetStatus",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะทรัพย์",
					"EX" => "
						00= งดยึด
						01= ยึด
						02= ศาลอนุญาตขาย
						03= ส่งงานจำหน่าย
						04= ขายได้
						05= ถอนยึด
						06= โอนไปล้มละลาย
						07= อนุญาตศาล
						90= รวบรวม
						13= หลักประกันทางธุรกิจ
					"
				),
				"bookBankType" => array(
					"FIELD" => "bookBankType",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทบัญชี",
					"EX" => "
						01 = ออมทรัพย์
						02 = ฝากประจำ
						03 = กระแสรายวัน
						04 = ตั๋วแลกเงิน
						05 = สกุลเงินต่างประเทศ
						06 = อื่นๆ
					"
				),
				"bankTypeDetails" => array(
					"FIELD" => "bankTypeDetails",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ระบุประเภทบัญชี",
					"EX" => "บัญชีทดสอบ"
				),
				"bankNo" => array(
					"FIELD" => "bankNo",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่บัญชี",
					"EX" => "111-111111-2"
				),
				"acountName" => array(
					"FIELD" => "acountName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อบัญชี",
					"EX" => "นายทดสอบ ทดสอบ"
				),
				"money" => array(
					"FIELD" => "money",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนเงิน",
					"EX" => "100000"
				),
				"bankName" => array(
					"FIELD" => "bankName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ธนาคาร",
					"EX" => "ธนาคารกสิกรไทย"
				),
				"branchName" => array(
					"FIELD" => "branchName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สาขาธนาคาร",
					"EX" => "สาขาราษฎร์บูรณะ"
				),
				"address" => array(
					"FIELD" => "address",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ธนาคาร",
					"EX" => "32"
				),
				"tumCode" => array(
					"FIELD" => "tumCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสแขวง/ตำบล",
					"EX" => "1"
				),
				"tumName" => array(
					"FIELD" => "tumName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อแขวง/ตำบล",
					"EX" => "บางคอแหลม"
				),
				"ampCode" => array(
					"FIELD" => "ampCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสเขต/อำเภอ",
					"EX" => "1"
				),
				"ampName" => array(
					"FIELD" => "ampName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเขต/อำเภอ",
					"EX" => "บางคอแหลม"
				),
				"provCode" => array(
					"FIELD" => "provCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสจังหวัด",
					"EX" => "1"
				),
				"provName" => array(
					"FIELD" => "provName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจังหวัด",
					"EX" => "กรุงเทพมหานคร"
				),
				"zipCode" => array(
					"FIELD" => "zipCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสไปรษณีย์",
					"EX" => "10000"
				),
				"ownerList" => array(
					"FIELD" => "ownerList",
					"NAME" => "",
					"TYPE" => "",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "List",
					"EX" => ""
				),
				"seq" => array(
					"FIELD" => "seq",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับ",
					"EX" => "1"
				),
				"personCode" => array(
					"FIELD" => "personCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสบุคคล",
					"EX" => "1234"
				),
				"registerCode" => array(
					"FIELD" => "registerCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
					"EX" => "111111111111"
				),
				"prefixCode" => array(
					"FIELD" => "prefixCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสคำนำหน้า",
					"EX" => "1"
				),
				"prefixName" => array(
					"FIELD" => "prefixName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อคำนำหน้า",
					"EX" => "นาย"
				),
				"firstName" => array(
					"FIELD" => "firstName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อ",
					"EX" => "ทดสอบ"
				),
				"lastName" => array(
					"FIELD" => "lastName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "นามสกุล",
					"EX" => "ทดสอบ (กรณีนิติบุคคลไม่ระบุ)"
				),
				"concernCode" => array(
					"FIELD" => "concernCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสเกี่ยวข้องเป็น",
					"EX" => "2"
				),
				"concernName" => array(
					"FIELD" => "concernName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเกี่ยวข้องเป็น",
					"EX" => "จำเลย"
				),
				"concernNo" => array(
					"FIELD" => "concernNo",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับที่",
					"EX" => "1"
				),
				"holdingGroup" => array(
					"FIELD" => "holdingGroup",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "กลุ่มผู้มีส่วนได้เสียในทรัพย์",
					"EX" => "
						01=ผู้ถือกรรมสิทธิ์/ผู้ถือกรรมสิทธิ์ร่วม
						02=ทายาท/ผู้จัดการมรดก
						03=ผู้รับจำนอง
					"
				),
				"holdingType" => array(
					"FIELD" => "holdingType",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อัตราส่วน",
					"EX" => "
						01=ร้อยละ
						02=สัดส่วน
					"
				),
				"holdingAmount" => array(
					"FIELD" => "holdingAmount",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวน",
					"EX" => "1"
				)
				
            )

        );
            
    }
    
}

?>