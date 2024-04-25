<?php
class civilCaseAssetsBondJson{

	private $objJson;
	private $objJsonPerson;

	public function getJson(){

		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsBond",
			  "service_info" => "รายละเอียดทรัพย์สิ่งปลูกสร้าง",
			  "request" => array(
				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"BONDS_ID" => array(
				  "FIELD" => "bondId",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขทะเบียนพันธบัตร",
				  "EX" => "37-111-308-0003"
				),
				"START_NO" => array(
				  "FIELD" => "bondNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขพันธบัตร ตั้งแต่",
				  "EX" => "0012/234"
				),
				"END_NO" => array(
				  "FIELD" => "toNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขพันธบัตร ถึง",
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
				"BOND_NAME" => array(
					"FIELD" => "bondName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=>"ชื่อพันธบัตร ",
					"EX" => "สลากออมสิน"
				),
				"BONDS_NO" => array(
					"FIELD" => "bondNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "พันธบัตรเลขที่",
					"EX" => "212311"
				),
				"END_NO" => array(
					"FIELD" => "toNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขพันธบัตร ถึง",
					"EX" => "0012/234"
				),				
				"BONDS_ID" => array(
					"FIELD" => "bondId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียน",
					"EX" => "123123121"
				),
				"PRICE_UNIT" => array(
					"FIELD" => "unitPrice",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"PRICE_SUM" => array(
					"FIELD" => "totalPrice",
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
				"CFC_BONDS_GEN" => array(
					"FIELD" => "cfcBondsGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขพันธบัตร",
					"EX" => ""
				),
				"CFC_BONDS_REQ_GEN" => array(
					"FIELD" => "cfcBondsReqGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขพันธบัตรที่ขอยึด",
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
				"BONDS_PERSON_GEN" => array(
					"FIELD" => "bondsPersonGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หน่วยงานที่ออกพันธบัตร",
					"EX" => ""
				),
				"UNIT_AMOUNT" => array(
					"FIELD" => "unitAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หน่วยละ(บาท)",
					"EX" => ""
				),
				"BONDS_ID" => array(
					"FIELD" => "bondsId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียน",
					"EX" => ""
				),
				"BONDS_NO" => array(
					"FIELD" => "bondsNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "พันธบัตรเลขที่",
					"EX" => ""
				),
				"RECEIVE_AMOUNT" => array(
					"FIELD" => "receiveAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สิทธิ์ที่จะได้รับชำระต้นเงินกู้",
					"EX" => ""
				),
				"RECEIVE_PERIOD" => array(
					"FIELD" => "receivePeriod",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ภายใน(ปี)",
					"EX" => ""
				),
				"FROM_DATE" => array(
					"FIELD" => "fromDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "นับแต่วันที่",
					"EX" => ""
				),
				"INTEREST_RATE" => array(
					"FIELD" => "interestRate",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "อัตราดอกเบี้ยร้อยละ",
					"EX" => ""
				),
				"RECEIVE_DATE1" => array(
					"FIELD" => "receiveDate1",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ได้รับชำระในวันที่",
					"EX" => ""
				),
				"RECEIVE_DATE2" => array(
					"FIELD" => "receiveDate2",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ได้รับชำระถึงวันที่",
					"EX" => ""
				),
				"BONDS_RIGHT" => array(
					"FIELD" => "bondsRight",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทสิทธิ์(มีสิทธิโอน,มีสิทธิ์จำนำ)",
					"EX" => ""
				),
				"EST_PRICE_AMOUNT" => array(
					"FIELD" => "estPriceAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินเจ้าพนักงานบังคับคดีขณะยึด",
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
				"CENT_DEPT_GEN" => array(
					"FIELD" => "centDeptGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=>"เลขรหัสหน่วยงาน ",
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
				"BONDS_NAME" => array(
					"FIELD" => "bondsName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อพันธบัตร",
					"EX" => ""
				),
				"DPD_STRUCTURE_GEN" => array(
					"FIELD" => "dpdStructureGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสโครงสร้างสายงาน",
					"EX" => ""
				),
				"BONDS_NO_TO" => array(
					"FIELD" => "bondsNoTo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "พันธบัตรเลขท้าย",
					"EX" => ""
				),
				"ISIN_CODE" => array(
					"FIELD" => "isinCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ISIN CODE",
					"EX" => ""
				),
				"BOND_AMT" => array(
					"FIELD" => "bondAmt",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาตรา",
					"EX" => ""
				),
				"BONDS_REGISTRATION_FLAG" => array(
					"FIELD" => "bondsRegistrationFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภททรํพย์",
					"EX" => "ว่าง = ไม่ระบุ 
							1 = ไม่มีทะเบียน 
							2 = มีทะเบียน"
				),
				"BONDS_COMMENT" => array(
					"FIELD" => "bondsComment",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียดอื่นๆ",
					"EX" => ""
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
				  "FIELD" => "seq",
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
				)
			  ),
			);

			return $this->objJson;
	}
}
?>
