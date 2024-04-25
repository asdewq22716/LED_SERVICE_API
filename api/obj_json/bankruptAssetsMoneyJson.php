<?php
class bankruptAssetsMoneyJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankruptAssetsMoney",
			"service_info" => "ข้อมูลเงิน",	
			"request" => array(
				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
					"EX" => "111111111111"
				),
				"ASSET_ID" => array(
					"FIELD" => "assetId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขทะเบียนทรัพย์",
					"EX" => "0012/2563"
				),
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
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
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ผบ."
				),
				"RED_CASE" => array(
					"FIELD" => "redCase",
					"TYPE" => "number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "111"
				),
				"RED_YY" => array(
					"FIELD" => "redYY",
					"TYPE" => "number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
				)
			),				
			"response" => array(
				/* "ASSET_DETIAL" => array(
					"FIELD" => "assetDetial",
					"TYPE" => "string",
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
                    "DESC" => "เลขทะเบียนทรัพย์",
                    "EX" => "0345"
                ),
                "ASSET_STATUS" => array(
                    "FIELD" => "assetStatus",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "สถานะทรัพย์",
                    "EX" => "
							00 = งดยึด
							01 = ยึด
							02 = ศาลอนุญาตขาย
							03 = ส่งงานจำหน่าย
							04= ขายได้
							05= ถอนยึด
							06= โอนไปล้มละลาย
							07= ขออนุญาตศาลขาย
							90= รวบรวม
							13= ติดหลักประกัน
							"
                ),
				"INCOME_TYPE" => array(
					"FIELD" => "moneyType",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชนิดเงิน",
					"EX" => "01 = เงินเดือน
							02 = เงินค่าจ้าง
							03 = เงินปันผล
							04 = เงินเฉลี่ยคืนหุ้นสหกรณ์
							05 = เงินค่าเช่า
							06 = เงินจากการถูกรางวัล
							07 = อื่น ๆ
							08 = เงินจากการชำระหนี้
"
				),
				
				"INCOME_AMOUNT" => array(
					"FIELD" => "moneyAmout",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนเงิน",
					"EX" => "100000"
				),
				"INCOME_FROM" => array(
					"FIELD" => "moneyby",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ได้รับจาก",
					"EX" => "
						01 = หน่วยงานราชการ
						02 = หน่วยงานรัฐวิสาหกิจ
						03 = อื่นๆ
					"
				),
				"DETAIL" => array(
					"FIELD" => "moneybyDetails",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ได้รับจาก ระบุ",
					"EX" => "หน่วยงานท้องถิ่น"
				),
				"SEQ" => array(
					"FIELD" => "seq",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับ",
					"EX" => "1"
				) */
				"INCM_ADDRESS_NO" => array(
					"FIELD" => "incmAddressNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ผู้นำส่งเงิน",
					"EX" => ""
				),
				"INCM_AMOUNT" => array(
					"FIELD" => "incmAmount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนเงิน",
					"EX" => ""
				),
				"INCM_CREATE_DATE" => array(
					"FIELD" => "incmCreateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"INCM_CREATOR" => array(
					"FIELD" => "incmCreator",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"INCM_CREATOR_ID" => array(
					"FIELD" => "incmCreatorId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"INCM_FIRST_RECEIVE_AMOUNT" => array(
					"FIELD" => "incmFirstReceiveAmount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"INCM_OTHER_PERIOD_TYPE_TXT" => array(
					"FIELD" => "incmOtherPeriodTypeTxt",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"INCM_OTHER_SOURCE_TYPE_TXT" => array(
					"FIELD" => "incmOtherSourceTypeTxt",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"INCM_OTHER_TYPE_TXT" => array(
					"FIELD" => "incmOtherTypeTxt",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ระบุได้รับจาก (กรณีอื่น ๆ)",
					"EX" => ""
				),
				"INCM_PERIOD_TYPE" => array(
					"FIELD" => "incmPeriodType",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลักษณะรายรับ",
					"EX" => "1 = รายเดือน"
				),
				"INCM_POST_CODE" => array(
					"FIELD" => "incmPostCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ผู้นำส่งเงิน (รหัสไปรษณีย์)",
					"EX" => ""
				),
				"INCM_REG_DOC_TYPE_REF" => array(
					"FIELD" => "incmRegDocTypeRef",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"INCM_REMARK" => array(
					"FIELD" => "incmRemark",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "หมายเหตุ",
					"EX" => ""
				),
				"INCM_SOURCE_NAME" => array(
					"FIELD" => "incmSourceName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อผู้นำส่งเงิน",
					"EX" => ""
				),
				"INCM_SOURCE_TYPE" => array(
					"FIELD" => "incmSourceType",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ได้รับจาก",
					"EX" => "1= หน่วยงานราชการ
							2 = หน่วยงานรัฐวิสาหกิจ
							3= อื่น ๆ"
				),
				"INCM_STATUS" => array(
					"FIELD" => "incmStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะ",
					"EX" => "O = ใช้งาน
							C = ยกเลิก"
				),
				"INCM_UPDATE_DATE" => array(
					"FIELD" => "incmUpdateDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"INCM_UPDATER" => array(
					"FIELD" => "incmUpdater",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"INCM_UPDATER_ID" => array(
					"FIELD" => "incmUpdaterId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"INCM_DIS_ID_FK" => array(
					"FIELD" => "incmDisIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ผู้นำส่งเงิน (id เขต/อำเภอ)",
					"EX" => ""
				),
				"INCM_ASS_ID_FK" => array(
					"FIELD" => "incmAssIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "Id ตารางรายการทรัพย์ในระบบ",
					"EX" => ""
				),
				"INCM_PRV_ID_FK" => array(
					"FIELD" => "incmPrvIdFk",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ผู้นำส่งเงิน (id จังหวัด)",
					"EX" => ""
				),
				"INCM_ATD_ID_FK" => array(
					"FIELD" => "incmAtdIdFk",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "Id อ้างอิงชนิดเงินรายรับ",
					"EX" => ""
				),
				"INCM_SDI_ID_FK" => array(
					"FIELD" => "incmSdiIdFk",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ผู้นำส่งเงิน (id แขวง/ตำบล)",
					"EX" => ""
				),
				"INCM_DISTRICT_NAME" => array(
					"FIELD" => "incmDistrictName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ผู้นำส่งเงิน (เขต/อำเภอ)",
					"EX" => ""
				),
				"INCM_PROVINCE_NAME" => array(
					"FIELD" => "incmProvinceName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ผู้นำส่งเงิน (จังหวัด)",
					"EX" => ""
				),
				"INCM_SUBDISTRICT_NAME" => array(
					"FIELD" => "incmSubdistrictName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่อยู่ผู้นำส่งเงิน (แขวง/ตำบล)",
					"EX" => ""
				),
				"ASS_ASSET_GROUP" => array(
					"FIELD" => "assAssetGroup",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"FIND_MONEY_TYPE" => array(
					"FIELD" => "findMoneyType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"FIND_MONEY_PERIOD" => array(
					"FIELD" => "findMoneyPeriod",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ได้รับจาก",
					"EX" => ""
				),
				"FIND_GET_MONEY_FROM" => array(
					"FIELD" => "findGetMoneyFrom",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ได้รับจาก ระบุ",
					"EX" => ""
				)
            )

        );
			
		return $this->objJson;
	
    }
    
	public function getJsonPerson(){

		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankrupAssetsMoney",
			"service_info" => "ข้อมูลเงิน",			  
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