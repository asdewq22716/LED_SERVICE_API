<?php
class civilCaseAssetsFirearmJson{

	private $objJson;
	private $objJsonPerson;

	public function getJson(){

		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsFirearm",
			  "service_info" => "รายละเอียดทรัพย์อาวุปืน",
			  "request" => array(
				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"GUN_NO" => array(
				  "FIELD" => "gunNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขทะเบียนปืน",
				  "EX" => "37-111-308-0003"
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
				"GUN_NO" => array(
					"FIELD" => "gunNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=>"เลขทะเบียนปืน ",
					"EX" => "37-111-308-0003"
				),
				"GUN_TYPE" => array(
					"FIELD" => "gunType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทปืน",
					"EX" => "สั้น"
				),
				"MODEL" => array(
					"FIELD" => "model",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "โมเดล",
					"EX" => "B"
				),				
				"BRAND" => array(
					"FIELD" => "brand",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ยี่ห้อ",
					"EX" => "C"
				),
				"AMMUNITION_SIZE" => array(
					"FIELD" => "ammunitionSize",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เครื่องกระสุนปืนขนาด",
					"EX" => "1"
				),
				"COLOR" => array(
					"FIELD" => "color",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สี",
					"EX" => "D"
				),
				"SIZE" => array(
					"FIELD" => "size",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ขนาด",
					"EX" => "123"
				),
				"BARREL_SIZE" => array(
					"FIELD" => "barrelSize",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ขนาดลำกล้องยาว",
					"EX" => "13"
				),
				"BULLET_SIZE" => array(
					"FIELD" => "bulletSize",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "BULLET_SIZE",
					"EX" => "6"
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
				) */
				"CFC_GUN_GEN" => array(
					"FIELD" => "cfcGunGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขปืน",
					"EX" => ""
				),
				"CFC_CIVIL_GEN" => array(
					"FIELD" => "cfcCivilGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อ้างอิงเลขสำนวนยึด",
					"EX" => ""
				),
				"CFC_GUN_REQ_GEN" => array(
					"FIELD" => "cfcGunReqGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขปืนที่ขอยึด",
					"EX" => ""
				),
				"SEQ_NO" => array(
					"FIELD" => "seqNo",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับที่",
					"EX" => ""
				),
				"LICENSE_NO" => array(
					"FIELD" => "licenseNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ใบอนุญาตที่",
					"EX" => ""
				),
				"LICENSE_YR" => array(
					"FIELD" => "licenseYr",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ใบอนุญาตปี",
					"EX" => ""
				),
				"LICENSE_PLACE" => array(
					"FIELD" => "licensePlace",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานที่ออกใบอนุญาต",
					"EX" => ""
				),
				"LICENSE_DATE" => array(
					"FIELD" => "licenseDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันเดือนปีที่ออกใบอนุญาต",
					"EX" => ""
				),
				"TYPE_DESC" => array(
					"FIELD" => "typeDesc",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชนิด",
					"EX" => ""
				),
				"GUN_SIZE" => array(
					"FIELD" => "gunSize",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ขนาด",
					"EX" => ""
				),
				"GUN_NO" => array(
					"FIELD" => "gunNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเลขประจำปืน",
					"EX" => ""
				),
				"MAKE_PERSON" => array(
					"FIELD" => "makePerson",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อผู้ทำปืน",
					"EX" => ""
				),
				"GUN_SIGN" => array(
					"FIELD" => "gunSign",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เครื่องหมายทะเบียน",
					"EX" => ""
				),
				"FROM_PERSON" => array(
					"FIELD" => "fromPerson",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ได้มาจาก",
					"EX" => ""
				),
				"BULLET_DESC" => array(
					"FIELD" => "bulletDesc",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "พร้อมเครื่องกระสุน",
					"EX" => ""
				),
				"ACCESSORY_DESC" => array(
					"FIELD" => "accessoryDesc",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "พร้อมอุปกรณ์",
					"EX" => ""
				),
				"FEE_AMOUNT" => array(
					"FIELD" => "feeAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ค่าธรรมเนียม",
					"EX" => ""
				),
				"EST_PRICE_AMOUNT" => array(
					"FIELD" => "estPriceAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินเจ้าพนักงานบังคับคดีขณะยึด",
					"EX" => ""
				),
				"KEEP_PERSON_GEN" => array(
					"FIELD" => "keepPersonGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขผู้รักษาทรัพย์",
					"EX" => ""
				),
				"KEEP_LOCATION" => array(
					"FIELD" => "keepLocation",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่สถานที่เก็บรักษาทรัพย์",
					"EX" => ""
				),
				"KEEP_CENT_LOC_GEN" => array(
					"FIELD" => "keepCentLocGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จังหวัดอำเภอตำบลสถานที่รักษาทรัพย์",
					"EX" => ""
				),
				"R_SELL_TYPE" => array(
					"FIELD" => "rSellType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วิธีขาย",
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
					"DESC" => "รหัสหน่วยงาน",
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
							2  = สำเนา 
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
				"BRAND_NAME" => array(
					"FIELD" => "brandName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ยี่ห้อ",
					"EX" => ""
				),
				"GUN_COMMENT" => array(
					"FIELD" => "gunComment",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียดอื่นๆ",
					"EX" => ""
				),
				"GUN_REGISTRATION_FLAG" => array(
					"FIELD" => "gunRegistrationFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภททรํพย์",
					"EX" => "ว่าง = ไม่ระบุ 
							1 = ไม่มีทะเบียน 
							2 = มีทะเบียน"
				)
			  )
			);

			return $this->objJson;

	}
	public function getJsonPerson(){
		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsFirearm",
			  "service_info" => "รายละเอียดทรัพย์อาวุธปืน",
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
