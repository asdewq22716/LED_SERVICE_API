<?php
class bankruptAssetsCoopJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankruptAssetsCoop",
			"service_info" => "ข้อมูลหุ้นสหกรณ์",	
			"request" => array(
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
				"CPMN_ADDRESS_NO" => array(
					"FIELD" => "cpmnAddressNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่",
					"EX" => ""
				),
				"CPMN_AMOUNT" => array(
					"FIELD" => "cpmnAmount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ทุนเรือนหุ้น (บาท)",
					"EX" => ""
				),
				"CPMN_CREATE_DATE" => array(
					"FIELD" => "cpmnCreateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CPMN_CREATOR" => array(
					"FIELD" => "cpmnCreator",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CPMN_CREATOR_ID" => array(
					"FIELD" => "cpmnCreatorId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CPMN_LEAVE_DATE" => array(
					"FIELD" => "cpmnLeaveDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ออกจากการเป็นสมาชิก",
					"EX" => ""
				),
				"CPMN_NAME" => array(
					"FIELD" => "cpmnName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสหกรณ์",
					"EX" => ""
				),
				"CPMN_POST_CODE" => array(
					"FIELD" => "cpmnPostCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ (รหัสไปรษณีย์)",
					"EX" => ""
				),
				"CPMN_REG_DOC_TYPE_REF" => array(
					"FIELD" => "cpmnRegDocTypeRef",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CPMN_REG_NUMBER" => array(
					"FIELD" => "cpmnRegNumber",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สมาชิกทะเบียนเลขที่",
					"EX" => ""
				),
				"CPMN_REMARK" => array(
					"FIELD" => "cpmnRemark",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเหตุ",
					"EX" => ""
				),
				"CPMN_SHARE_CAPITAL" => array(
					"FIELD" => "cpmnShareCapital",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CPMN_STATUS" => array(
					"FIELD" => "cpmnStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะ",
					"EX" => "O=ใช้งาน
							C=ยกเลิก"
				),
				"CPMN_UPDATE_DATE" => array(
					"FIELD" => "cpmnUpdateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CPMN_UPDATER" => array(
					"FIELD" => "cpmnUpdater",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CPMN_UPDATER_ID" => array(
					"FIELD" => "cpmnUpdaterId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CPMN_ASS_ID_FK" => array(
					"FIELD" => "cpmnAssIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "Id ข้อมูลทรัพย์หลัก",
					"EX" => ""
				),
				"CPMN_SDI_ID_FK" => array(
					"FIELD" => "cpmnSdiIdFk",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ (id แขวง/ตำบล)",
					"EX" => ""
				),
				"CPMN_DIS_ID_FK" => array(
					"FIELD" => "cpmnDisIdFk",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ (id เขต/อำเภอ)",
					"EX" => ""
				),
				"CPMN_PRV_ID_FK" => array(
					"FIELD" => "cpmnPrvIdFk",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่(id จังหวัด)",
					"EX" => ""
				),
				"CPMN_DISTRICT_NAME" => array(
					"FIELD" => "cpmnDistrictName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่(ชื่อเขต/อำเภอ)",
					"EX" => ""
				),
				"CPMN_PROVINCE_NAME" => array(
					"FIELD" => "cpmnProvinceName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่(ชื่อจังหวัด)",
					"EX" => ""
				),
				"CPMN_SUBDISTRICT_NAME" => array(
					"FIELD" => "cpmnSubdistrictName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ (ชื่อแขวง/ตำบล)",
					"EX" => ""
				),
				"ASS_ASSET_GROUP" => array(
					"FIELD" => "assAssetGroup",
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