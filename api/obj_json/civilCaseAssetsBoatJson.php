<?php
class civilCaseAssetsBoatJson{

	private $objJson;
	private $objJsonPerson;

	public function getJson(){

		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsBoat",
			  "service_info" => "รายละเอียดทรัพย์ประเภทเรือ",
			  "request" => array(

				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"ASSET_ID" => array(
				  "FIELD" => "assetId",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขทะเบียนทรัพย์",
				  "EX" => "0012/234"
				),
				"ASSET_NAME" => array(
				  "FIELD" => "assetName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขทะเบียนทรัพย์",
				  "EX" => "0012/234"
				),
				"COURT_CODE" => array(
				  "FIELD" => "courtCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสศาล",
				  "EX" => "01"
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
				"PROV_CODE" => array(
				  "FIELD" => "provCode",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสจังหวัด",
				  "EX" => "01"
				)
			  ),
			  "response" => array(

				/* "CIVIL_CODE" => array(
				  "FIELD" => "civilCode",
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
				"RECORD_COUNT" => array(
				  "FIELD" => "recodeCount",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "จำนวนรายการ",
				  "EX" => "10"
				),
				"ASSET_DETAIL" => array(
				  "FIELD" => "assetDetail",
				  "TYPE" => "List",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รายละเอียดทรัพย์",
				  "EX" => "รายละเอียด ตามตารางรายละเอียดทรัพย์ "
				),
				"ASSET_CODE" => array(
				  "FIELD" => "assetCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสทรัพย์",
				  "EX" => "1234"
				),
				"ASSET_ID" => array(
				  "FIELD" => "assetId",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขที่",
				  "EX" => "0345"
				),
				"ASSET_STATUS" => array(
				  "FIELD" => "assetStatus",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "สถานะทรัพย์",
				  "EX" => "00= งดยึด 01= ยึด 02= ศาลอนุญาตขาย 03= ส่งงานจำหน่าย 04= ขายได้ 05= ถอนยึด 06= โอนไปล้มละลาย 07= ขออนุญาตศาลขาย 90= รวบรวม 13= ติดหลักประกัน "
				),
				"BOAT_NO" => array(
				  "FIELD" => "boatNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "หมายทะเบียนเรือ",
				  "EX" => "0123455"
				),
				"BOAT_NAME" => array(
				  "FIELD" => "boatName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อเรือ",
				  "EX" => "เรือยอร์ช"
				),
				"BOAT_ID" => array(
				  "FIELD" => "boatId",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขทะเบียนเรือ",
				  "EX" => "13012311"
				),
				"BOAT_TYPE" => array(
				  "FIELD" => "boatType",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ประเภทเรือ",
				  "EX" => "13012311"
				),
				"FLAG_NAME" => array(
				  "FIELD" => "flagName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ธงสัญญาชื่อเรือ",
				  "EX" => "ชือธงสัญญาเรือ"
				),
				"PORT_NAME" => array(
				  "FIELD" => "portName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เมืองท่าขึ้นทะเบียน",
				  "EX" => "ชื่อเมืองท่า"
				),
				"BOAT_COMMENT" => array(
				  "FIELD" => "boatComment",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รายละเอียดเรือ",
				  "EX" => "รายละเอียดเรือ"
				),
				"PRICE" => array(
				  "FIELD" => "price",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ราคาประเมิน",
				  "EX" => "10,000"
				) */
				"CFC_BOAT_GEN" => array(
					"FIELD" => "cfcBoatGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขเรือ",
					"EX" => ""
				),
				"CFC_BOAT_REQ_GEN" => array(
					"FIELD" => "cfcBoatReqGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขเรือที่ขอยึด",
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
				"BOAT_TYPE" => array(
					"FIELD" => "boatType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทเรือ ",
					"EX" => ""
				),
				"BOAT_LOC_GEN" => array(
					"FIELD" => "boatLocGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมู่บ้าน/โครงการ/อาคาร",
					"EX" => ""
				),
				"BOAT_NAME" => array(
					"FIELD" => "boatName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเรือ",
					"EX" => ""
				),
				"BOAT_ID" => array(
					"FIELD" => "boatId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียนเรือ",
					"EX" => ""
				),
				"FLAG_NAME" => array(
					"FIELD" => "flagName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ธงสัญญาชื่อเรือ",
					"EX" => ""
				),
				"PORT_NAME" => array(
					"FIELD" => "portName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เมืองท่าขึ้นทะเบียน",
					"EX" => ""
				),
				"BOAT_COMMENT" => array(
					"FIELD" => "boatComment",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายการวัดเรือ",
					"EX" => ""
				),
				"CHECK_COMMENT" => array(
					"FIELD" => "checkComment",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายการตรวจเช็ค",
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
					"DESC" => "เลขชื่อผู้รักษาทรัพย์",
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
				"R_SELL_TYPE" => array(
					"FIELD" => "rSellType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วิธีขาย",
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
				"BOAT_REGISTRATION_FLAG" => array(
					"FIELD" => "boatRegistrationFlag",
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
			  "service_name" => "civilCaseAssetsBoat",
			  "service_info" => "รายละเอียดทรัพย์ประเภทเเรือ",
			  "response" => array(

				"SEQ" => array(
				  "FIELD" => "seq",
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
