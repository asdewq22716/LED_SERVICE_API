<?php
class civilCaseAssetsFundJson{

	private $objJson;
	private $objJsonPerson;

	public function getJson(){

		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsFund",
			  "service_info" => "รายละเอียดทรัพย์กองทุน",
			  "request" => array(

				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"ASSET_NAME" => array(
				  "FIELD" => "assetName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อศาล",
				  "EX" => "ศาลแพ่ง"
				),
				"COURT_NAME" => array(
				  "FIELD" => "courtName",
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
				  "EX" => "1111"
				),
				"RED_YY" => array(
				  "FIELD" => "redYY",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขแดงปีที่",
				  "EX" => "2563"
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
				  "EX" => "1111"
				),
				"RED_YY" => array(
				  "FIELD" => "redYY",
				  "TYPE" => "number",
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
				  "FIELD" => "assetsId",
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
				  "EX" => "00= งดยึด01= ยึด02= ศาลอนุญาตขาย 03= ส่งงานจำหน่าย04= ขายได้
							05= ถอนยึด 06= โอนไปล้มละลาย 07= ขออนุญาตศาลขาย 90= รวบรวม 13= ติดหลักประกัน"
				),

				"FUND_NO" => array(
				  "FIELD" => "fundNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขดำที่",
				  "EX" => "0123455"
				),
				"FUND_AMOUNT" => array(
				  "FIELD" => "fundAmount",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขดำปีที่",
				  "EX" => "10"
				),
				"PRICE" => array(
				  "FIELD" => "price",
				  "TYPE" => "Number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ราคาประเมิน",
				  "EX" => "10,000"
				),
				"PRICE" => array(
				  "FIELD" => "price",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ราคาประเมิน",
				  "EX" => "10,000"
				) */
				"CFC_FUND_GEN" => array(
					"FIELD" => "cfcFundGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขหน่วยลงทุนที่ขอยึด",
					"EX" => ""
				),
				"FUND_TYPE" => array(
					"FIELD" => "fundType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทหน่วยลงทุน",
					"EX" => ""
				),
				"COMPANY_GEN" => array(
					"FIELD" => "companyGen",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ผู้ดูแลผลประโยชน์",
					"EX" => ""
				),
				"FUND_NAME" => array(
					"FIELD" => "fundName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อหน่วยลงทุน",
					"EX" => ""
				),
				"MANAGER_FUND_NAME" => array(
					"FIELD" => "managerFundName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ผู้จัดการหน่วยลงทุน ",
					"EX" => ""
				),
				"HOLDER_LICENSE_NO" => array(
					"FIELD" => "holderLicenseNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียนผู้ถือ",
					"EX" => ""
				),
				"FUND_QTY" => array(
					"FIELD" => "fundQty",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนหน่วย",
					"EX" => ""
				),
				"FUND_DATE" => array(
					"FIELD" => "fundDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่หน่วยลงทุน",
					"EX" => ""
				),
				"FUND_RIGHT" => array(
					"FIELD" => "fundRight",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ธงสัญญาชื่อเรือ",
					"EX" => ""
				),
				"FUND_COMMENT" => array(
					"FIELD" => "fundComment",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียดอื่นๆ",
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
				"COMMIT_FLAG" => array(
					"FIELD" => "commitFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ภาระผูกพันอื่นๆ",
					"EX" => ""
				),
				"COMMIT_DESC" => array(
					"FIELD" => "commitDesc",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียดภาระผูกพันอื่นๆ",
					"EX" => ""
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
				"LICENSE_FLAG" => array(
					"FIELD" => "licenseFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สำเนาทะเบียนบ้าน",
					"EX" => ""
				),
				"DIAGRAM_FLAG" => array(
					"FIELD" => "diagramFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "แผนผังทรัพย์ที่ยึด",
					"EX" => ""
				),
				"B_RIGHT_FLAG" => array(
					"FIELD" => "bRightFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หนังสือกรรมสิทธิ์",
					"EX" => ""
				),
				"MAP_FLAG" => array(
					"FIELD" => "mapFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "แผนที่การไป",
					"EX" => ""
				),
				"ESTIMATE_COST_FLAG" => array(
					"FIELD" => "estimateCostFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมิน",
					"EX" => ""
				),
				"CONTRACT_FLAG" => array(
					"FIELD" => "contractFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หนังสือสัญญาจำนอง",
					"EX" => ""
				),
				"PICTURE_FLAG" => array(
					"FIELD" => "pictureFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ภาพถ่ายภาพที่ยึด",
					"EX" => ""
				),
				"B_CONTRACT_FLAG" => array(
					"FIELD" => "bContractFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หนังสือรับรองนิติบุคคล",
					"EX" => ""
				),
				"OTHER_DOC_FLAG" => array(
					"FIELD" => "otherDocFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เอกสารอื่น",
					"EX" => ""
				),
				"OTHER_DOC_DESC" => array(
					"FIELD" => "otherDocDesc",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายลเอียดเอกสารอื่น",
					"EX" => ""
				),
				"FUND_VALUE" => array(
					"FIELD" => "fundValue",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "มูลค่าหน่วยลงทุน",
					"EX" => ""
				),
				"FUND_REGISTRATION_FLAG" => array(
					"FIELD" => "fundRegistrationFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภททรัพย์",
					"EX" => ""
				),
				"HOLDER_NAME" => array(
					"FIELD" => "holderName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อ-สกุล ผู้ถือหน่วยลงทุน",
					"EX" => ""
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
			  "service_name" => "civilCaseAssetsStock",
			  "service_info" => "รายละเอียดทรัพย์หุ้น",
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
