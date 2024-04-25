<?php
class bankruptAssetsLegalJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankruptAssetsLegal",
			"service_info" => "ข้อมูลสิทธิเรียกร้อง",	
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
				"LER_ASSET_GROUP" => array(
					"FIELD" => "lerAmount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LER_ASSET_VALUE" => array(
					"FIELD" => "lerAssetValue",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LER_CREATE_DATE" => array(
					"FIELD" => "lerCreateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LER_CREATOR" => array(
					"FIELD" => "lerCreator",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LER_CREATOR_ID" => array(
					"FIELD" => "lerCreatorId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LER_LEGAL_RIGHT_IN" => array(
					"FIELD" => "lerLegalRightIn",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สิทธิเรียกร้องใน",
					"EX" => ""
				),
				"LER_REF_ASSET_TEXT" => array(
					"FIELD" => "lerRefAssetText",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ทรัพย์ที่เกี่ยวข้อง",
					"EX" => ""
				),
				"LER_REG_DOC_TYPE_REF" => array(
					"FIELD" => "lerRegDocTypeRef",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LER_REMARK" => array(
					"FIELD" => "lerRemark",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเหตุ",
					"EX" => ""
				),
				"LER_STATUS" => array(
					"FIELD" => "lerStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะ",
					"EX" => "O= ใช้งาน
							C= ยกเลิก"
				),
				"LER_UPDATE_DATE" => array(
					"FIELD" => "lerUpdateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LER_UPDATER" => array(
					"FIELD" => "lerUpdater",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LER_UPDATER_ID" => array(
					"FIELD" => "lerUpdaterId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"LER_ASS_ID_FK" => array(
					"FIELD" => "lerAssIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "Id ข้อมูลทรัพย์หลัก",
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