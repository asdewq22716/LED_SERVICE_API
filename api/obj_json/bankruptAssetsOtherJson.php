<?php
class bankruptAssetsOtherJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankruptAssetsOther",
			"service_info" => "ข้อมูลทรัพย์สินต่าง ๆ ",
			"request" => array(
				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"ASSET_NAME" => array(
				  "FIELD" => "assetName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อทรัพย์สินอื่นๆ",
				  "EX" => "เครื่องเจาะเหล็ก ไม่ปรากฎยี่ห้อ รุ่น สีเขียว"
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
				"OTH_ASS_GRP" => array(
					"FIELD" => "othAssGrp",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OTH_CREATE_DATE" => array(
					"FIELD" => "othCreateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OTH_CREATOR" => array(
					"FIELD" => "othCreator",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OTH_CREATOR_ID" => array(
					"FIELD" => "othCreatorId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OTH_CUR" => array(
					"FIELD" => "othCur",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนทรัพย์",
					"EX" => ""
				),
				"OTH_DISTRICT_CODE" => array(
					"FIELD" => "othDistrictCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งทรัพย์ (รหัสเขต/อำเภอ)",
					"EX" => ""
				),
				"OTH_DISTRICT" => array(
					"FIELD" => "othDistrict",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งทรัพย์ (ชื่อเขต/อำเภอ)",
					"EX" => ""
				),
				"OTH_NAME" => array(
					"FIELD" => "othName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อทรัพย์",
					"EX" => ""
				),
				"OTH_POSTCODE" => array(
					"FIELD" => "othPostcode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งทรัพย์ (รหัสไปรษณีย์)",
					"EX" => ""
				),
				"OTH_PROVINCE_CODE" => array(
					"FIELD" => "othProvinceCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งทรัพย์ (รหัสจังหวัด)",
					"EX" => ""
				),
				"OTH_PROVINCE" => array(
					"FIELD" => "othProvince",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งทรัพย์ (ชื่อจังหวัด)",
					"EX" => ""
				),
				"OTH_REG_DOC_TYPE_REF" => array(
					"FIELD" => "othRegDocTypeRef",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OTH_REG_NO" => array(
					"FIELD" => "othRegNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OTH_STATUS" => array(
					"FIELD" => "othStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะ",
					"EX" => "O= ใช้งาน
							C= ยกเลิก"
				),
				"OTH_SUBDISTRICT_CODE" => array(
					"FIELD" => "othSubdistrictCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งทรัพย์ (รหัสแขวง/ตำบล)",
					"EX" => ""
				),
				"OTH_SUBDISTRICT" => array(
					"FIELD" => "othSubdistrict",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้งทรัพย์ (ชื่อแขวง/ตำบล)",
					"EX" => ""
				),
				"OTH_UPDATE_DATE" => array(
					"FIELD" => "othUpdateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OTH_UPDATER" => array(
					"FIELD" => "othUpdater",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OTH_UPDATER_ID" => array(
					"FIELD" => "othUpdaterId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OTH_USR_KEEP" => array(
					"FIELD" => "othUsrKeep",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"OTH_ASS_ID_FK" => array(
					"FIELD" => "othAssIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "Id ข้อมูลทรัพย์หลัก",
					"EX" => ""
				),
				"OTH_ADDRESS_NO" => array(
					"FIELD" => "othAddressNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ที่ตั้งทรัพย์",
					"EX" => ""
				),
				"OTH_STORE_ADDRESS_FLAG" => array(
					"FIELD" => "othStoreAddressFlag",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "0=ที่เก็บรักษาทรัพย์คนละที่กับที่ตั้งทรัพย์ , 1=ที่เก็บรักษาทรัพย์ที่เดียวกับที่ตั้งทรัพย์",
					"EX" => ""
				),
				"OTH_STORE_ADDRESS_NO" => array(
					"FIELD" => "othStoreAddressNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ที่เก็บรักษาทรัพย์",
					"EX" => ""
				),
				"OTH_STORE_DISTRICT_CODE" => array(
					"FIELD" => "othStoreDistrictCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (รหัสเขต/อำเภอ)",
					"EX" => ""
				),
				"OTH_STORE_DISTRICT" => array(
					"FIELD" => "oth_StoreDistrict",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (ชื่อเขต/อำเภอ)",
					"EX" => ""
				),
				"OTH_STORE_POSTCODE" => array(
					"FIELD" => "othStorePostcode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์ (รหัสไปรษณีย์)",
					"EX" => ""
				),
				"OTH_STORE_PROVINCE_CODE" => array(
					"FIELD" => "othStoreProvinceCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์(รหัสจังหวัด)",
					"EX" => ""
				),
				"OTH_STORE_PROVINCE" => array(
					"FIELD" => "othStoreProvince",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์(ชื่อจังหวัด)",
					"EX" => ""
				),
				"OTH_STORE_SUBDISTRICT_CODE" => array(
					"FIELD" => "othStoreSubdistrictCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์(รหัสแขวง/ตำบล)",
					"EX" => ""
				),
				"OTH_STORE_SUBDISTRICT" => array(
					"FIELD" => "othStoreSubdistrict",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่เก็บรักษาทรัพย์(ชื่อแขวง/ตำบล)",
					"EX" => ""
				),
				"OTH_REMARK" => array(
					"FIELD" => "othRemark",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเหตุ",
					"EX" => ""
				),
				"OTH_UNIT_NAME" => array(
					"FIELD" => "othUnitName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อหน่วย",
					"EX" => ""
				)
            )
        );
			
		return $this->objJson;
	
    }
    
	public function getJsonPerson(){

		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankrupAssetsOther",
			"service_info" => "ข้อมูลทรัพย์สินต่าง ๆ ",			  
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