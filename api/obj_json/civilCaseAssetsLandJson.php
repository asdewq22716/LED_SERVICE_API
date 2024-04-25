<?php
class civilCaseAssetsLandJson{

	private $objJson;
	private $objJsonPerson;

	public function getJson(){

		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsLand",
			  "service_info" => "ข้อมูลที่ดิน ",
			  "request" => array(

				"REGISTER_CODE" => array(
				  "FIELD" => "registerCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
				  "EX" => "0111111111111"
				),
				"LAND_TYPE" => array(
				  "FIELD" => "landType",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC"=>"ประเภทเอกสารสิทธิ์",
				  "EX" => "1"
				),
				"DEED_NO" => array(
				  "FIELD" => "deedNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC"=>"เลขที่",
				  "EX" => "1"
				),
				"LAND_NO" => array(
				  "FIELD" => "landNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขที่ดิน",
				  "EX" => "4"
				),
				"BOOK_NO" => array(
				  "FIELD" => "bookNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC"=>"เล่ม ",
				  "EX" => "1"
				),
				"PAGE_NO" => array(
				  "FIELD" => "pageNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "หน้า",
				  "EX" => "2"
				),
				"FREIGHT" => array(
				  "FIELD" => "freight",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "เลขระวาง",
				  "EX" => "3"
				),
				"SURVEY_PAGE" => array(
				  "FIELD" => "surveyPage",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "หน้าสำรวจ",
				  "EX" => "5"
				),
				"COURT_CODE" => array(
				  "FIELD" => "courtCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสศาล",
				  "EX" => "01"
				),
				"DEPT_CODE" => array(
				  "FIELD" => "deptCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสสำนักงาน",
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
				),
				"TUM_CODE" => array(
				  "FIELD" => "tumCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสแขวง/ตำบล",
				  "EX" => "01"
				),
				"TUM_NAME" => array(
				  "FIELD" => "tumName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อแขวง/ตำบล",
				  "EX" => "บางคอแหลม"
				),
				"AMP_CODE" => array(
				  "FIELD" => "ampCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสเขต/อำเภอ",
				  "EX" => "01"
				),
				"AMP_NAME" => array(
				  "FIELD" => "ampName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อเขต/อำเภอ",
				  "EX" => "บางคอแหลม"
				),
				"PROV_CODE" => array(
				  "FIELD" => "provCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสจังหวัด",
				  "EX" => "01"
				),
				"PROV_NAME" => array(
				  "FIELD" => "provName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อจังหวัด",
				  "EX" => "กรุงเทพมหานคร"
				),
				"ZIP_CODE" => array(
				  "FIELD" => "zipCode",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "รหัสไปรษณีย์",
				  "EX" => "10000"
				),
				"OLD_TUM_NAME" => array(
				  "FIELD" => "oldTumName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อตำบลตามเอกสารสิทธิ์",
				  "EX" => "บางคอแหลม"
				),
				"OLD_AMP_NAME" => array(
				  "FIELD" => "oldAmpName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่ออำเภอตามเอกสารสิทธิ์",
				  "EX" => "บางคอแหลม"
				),
				"OLD_PROV_NAME" => array(
				  "FIELD" => "oldProvName",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "ชื่อจังหวัดตามเอกสารสิทธิ์",
				  "EX" => "กรุงเทพมหานคร"
				),
        "FARM" => array(
          "FIELD" => "farm",
          "TYPE" => "number",
          "FIELD_TYPE" => "O", // M/O
          "DESC" => "ไร่",
          "EX" => ""
        ),
        "NGAN" => array(
          "FIELD" => "ngan",
          "TYPE" => "number",
          "FIELD_TYPE" => "O", // M/O
          "DESC" => "งาน",
          "EX" => ""
        ),
        "VA" => array(
          "FIELD" => "va",
          "TYPE" => "number",
          "FIELD_TYPE" => "O", // M/O
          "DESC" => "วา",
          "EX" => ""
        ),
			),
			"response" => array(
                    "SEQ_NO" => array(
                      "FIELD" => "seqNo",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ลำดับที่ (เดิม แปลงที่)",
                      "EX" => ""
                    ),
                    "LAND_TYPE" => array(
                      "FIELD" => "landType",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ชนิดเอกสารสิทธิ์",
                      "EX" => ""
                    ),
                    "DEED_NO" => array(
                      "FIELD" => "deepNo",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "เลขที่",
                      "EX" => ""
                    ),
                    "LAND_NO" => array(
                      "FIELD" => "landNo",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "เลขที่ดิน",
                      "EX" => ""
                    ),
                    "PAGE_NO" => array(
                      "FIELD" => "pageNo",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "เลขหน้า",
                      "EX" => ""
                    ),
                    "SURVEY" => array(
                      "FIELD" => "survey",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "หน้าสำรวจ",
                      "EX" => ""
                    ),
                    "DOC_BOOK_NO" => array(
                      "FIELD" => "docBookNo",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "สารบบเล่ม",
                      "EX" => ""
                    ),
                    "DOC_PAGE_NO" => array(
                      "FIELD" => "docPageNo",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "สารบบหน้าที่",
                      "EX" => ""
                    ),
                    "MOO_NO" => array(
                      "FIELD" => "mooNo",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "หมู่ที่",
                      "EX" => ""
                    ),
                    "DISTRICT_NAME" => array(
                      "FIELD" => "districtName",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ตำบล/แขวง(ตามเอกสารสิทธิ์)",
                      "EX" => ""
                    ),
                    "AMPHUR_NAME" => array(
                      "FIELD" => "amphurName",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "อำเภอ/เขต(ตามเอกสารสิทธิ์)",
                      "EX" => ""
                    ),
                    "PROVINCE_NAME" => array(
                      "FIELD" => "provinceName",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "จังหวัด(ตามเอกสารสิทธิ์)",
                      "EX" => ""
                    ),
                    "CENT_LOC_GEN" => array(
                      "FIELD" => "centLocGen",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ข้อมูลปัจจุบัน (ตำบล, อำเภอ, จังหวัด, ไปรษณีย์)",
                      "EX" => ""
                    ),
                    "COMMIT_TYPE" => array(
                      "FIELD" => "commitType",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ภาระทรัพย์",
                      "EX" => "	1 = ปลอดจำนอง 
								2 = การจำนองติดไป 
								3 = ไม่มีภาระผูกพันในทางจำนอง"
                    ),
                    "COMMIT_DESC" => array(
                      "FIELD" => "commitDesc",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "รายละเอียดภาระทรัพย์",
                      "EX" => ""
                    ),
                    "FARM" => array(
                      "FIELD" => "farm",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ไร่",
                      "EX" => ""
                    ),
                    "NGAN" => array(
                      "FIELD" => "ngan",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "งาน",
                      "EX" => ""
                    ),
                    "VA" => array(
                      "FIELD" => "va",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "วา",
                      "EX" => ""
                    ),
                    "REMAIN_VA" => array(
                      "FIELD" => "remainVa",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "เนื้อที่(เศษวา)",
                      "EX" => ""
                    ),
                    "REMAIN_BASE" => array(
                      "FIELD" => "remainBase",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "เนื้อที่(ส่วนวา)",
                      "EX" => ""
                    ),
                    "SURRENDER_FARM" => array(
                      "FIELD" => "surrenderFarm",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "เวรคืน(ไร่)",
                      "EX" => ""
                    ),
                    "SURRENDER_NGAN" => array(
                      "FIELD" => "surrenderNgan",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "เวรคืน(งาน)",
                      "EX" => ""
                    ),
                    "SURRENDER_VA" => array(
                      "FIELD" => "surrenderVa",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "เวรคืน(วา)",
                      "EX" => ""
                    ),
                    "SURRENDER_REMAIN_VA" => array(
                      "FIELD" => "surrenderRemainVa",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "เวรคืน(เศษวา)",
                      "EX" => ""
                    ),
                    "SURRENDER_REMAIN_BASE" => array(
                      "FIELD" => "surrenderRemainBase",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "เวรคืน(ส่วนวา)",
                      "EX" => ""
                    ),
                    "PART_FARM" => array(
                      "FIELD" => "partFarm",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "บังคับเฉพาะส่วน(ไร่)",
                      "EX" => ""
                    ),
                    "PART_NGAN" => array(
                      "FIELD" => "partNgan",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "บังคับเฉพาะส่วน(งาน)",
                      "EX" => ""
                    ),
                    "PART_VA" => array(
                      "FIELD" => "partVa",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "บังคับเฉพาะส่วน(วา)",
                      "EX" => ""
                    ),
                    "PART_REMAIN_VA" => array(
                      "FIELD" => "partRemainVa",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "บังคับเฉพาะส่วน(เศษวา)",
                      "EX" => ""
                    ),
                    "PART_REMAIN_BASE" => array(
                      "FIELD" => "partRemainBase",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "บังคับเฉพาะส่วน(ส่วนวา)",
                      "EX" => ""
                    ),
                    "EST_PER_FARM_AMOUNT" => array(
                      "FIELD" => "estPerFarmAmount",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ราคาประเมินต่อไร่",
                      "EX" => ""
                    ),
                    "EST_PER_VA_AMOUNT" => array(
                      "FIELD" => "estPerVaAmount",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ราคาประเมินต่อตารางวา",
                      "EX" => ""
                    ),
                    "EST_AREA_AMOUNT" => array(
                      "FIELD" => "estAreaAmount",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ราคาทั้งแปลง",
                      "EX" => ""
                    ),
                    "ADD_PERCENT" => array(
                      "FIELD" => "addPercent",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ปรับเพิ่มร้อยละ",
                      "EX" => ""
                    ),
                    "ADD_AMOUNT" => array(
                      "FIELD" => "addAmount",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ปรับเพิ่มเป็นเงิน",
                      "EX" => ""
                    ),
                    "MINUS_PERCENT" => array(
                      "FIELD" => "minusPercent",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ปรับลดร้อยละ",
                      "EX" => ""
                    ),
                    "MINUS_AMOUNT" => array(
                      "FIELD" => "minusAmount",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ปรับลดเป็นเงิน",
                      "EX" => ""
                    ),
                    "EST_ASS_AMOUNT" => array(
                      "FIELD" => "estAssAmount",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ราคาประเมินสำนักงานวางทรัพย์",
                      "EX" => ""
                    ),
                    "EST_GOV_AMOUNT" => array(
                      "FIELD" => "estGovAmount",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ราคารประเมินของทางราชการ",
                      "EX" => ""
                    ),
                    "EST_PRICE_AMOUNT" => array(
                      "FIELD" => "estPriceAmount",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ราคาประเมินเจ้าพนักงานบังคับคดีขณะยึด",
                      "EX" => ""
                    ),
                    "LAND_DESC" => array(
                      "FIELD" => "landDesc",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "สภาพที่ดิน",
                      "EX" => ""
                    ),
                    "LAND_COMMENT" => array(
                      "FIELD" => "landComment",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "หมายเหตุ",
                      "EX" => ""
                    ),
                    "NEARLY_AREA" => array(
                      "FIELD" => "nearlyArea",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "พื้นที่ใกล้เคียง",
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
                      "EX" => "	00 = งดยึด  
								01 = ยึด  
								02 = ศาลอนุญาตขาย  
								03 = ส่งจำหน่าย  
								04 = ขายได้  
								05 = ถอนยึด  
								06 = โอนไปล้มละลาย  
								90 = รวบรวม"
                    ),
                    "HOUSE_FLAG" => array(
                      "FIELD" => "houseFlag",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "Flag มีบ้านอยู่บนที่ดิน หรือเปล่า",
                      "EX" => "	0 = ไม่มีบ้านอยู่บนที่ดิน(ที่ดินเปล่า) 
								1 = มีบ้านอยู่บนที่ดิน"
                    ),
                    "PLOT_SEQ" => array(
                      "FIELD" => "plotSeq",
                      "TYPE" => "number",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "แปลงที่",
                      "EX" => ""
                    ),
                    "COPY_FLAG" => array(
                      "FIELD" => "copyFlag",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ยึดตาม",
                      "EX" => "	1 = ต้นฉบับ 
								2 = สำเนา 
								3 = สำเนา(ต้นฉบับชำรุด)"
                    ),
                    "LAND_FOR_ID" => array(
                      "FIELD" => "landForId",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "รหัสที่ดิน",
                      "EX" => ""
                    ),
                    "LAND_REGISTRATION_FLAG" => array(
                      "FIELD" => "landRegistrationFlag",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ประเภททรัพย์ที่เช่า (รหัส)",
                      "EX" => "	ว่าง = ไม่ระบุ 
								1 = ไม่มีทะเบียน 
								2 = มีทะเบียน"
                    ),
                    "LAND_TRAIN_FLAG" => array(
                      "FIELD" => "landTrainFlag",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ติดแนงรถไฟ",
                      "EX" => ""
                    ),
                    "SOME_PART_FLAG" => array(
                      "FIELD" => "somePartFlag",
                      "TYPE" => "string",
                      "FIELD_TYPE" => "M", // M/O
                      "DESC" => "ยึดบางส่วน",
                      "EX" => ""
                    )
				/*"CIVIL_CODE" => array(
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
                "DOSS_ID" => array(
                    "FIELD" => "dossId",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "รหัสสำนวน",
                    "EX" => "01"
                ),
                "ASSET_ID" => array(
                    "FIELD" => "assetId",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => ""
                ),
                "ASSET_DOC_TYPE" => array(
                    "FIELD" => "assetDocType",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ประเภทเอกสารสิทธิ์",
                    "EX" => "01=โฉนดที่ดิน"
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
                "BOOK_NO" => array(
                    "FIELD" => "bookNo",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC"=>"เล่ม ",
                    "EX" => "1"
                ),
                "PAGE_NO" => array(
                    "FIELD" => "pageNo",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "หน้า",
                    "EX" => "2"
                ),
                "FREIGHT" => array(
                    "FIELD" => "freight",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เลขระวาง",
                    "EX" => "3"
                ),
                "LAND_NO" => array(
                    "FIELD" => "landNo",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เลขที่ดิน",
                    "EX" => "4"
                ),
                "SURVEY_PAGE" => array(
                    "FIELD" => "surveyPage",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "หน้าสำรวจ",
                    "EX" => "5"
                ),
                "TUM_CODE" => array(
                    "FIELD" => "tumCode",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "รหัสแขวง/ตำบล",
                    "EX" => "01"
                ),
                "TUM_NAME" => array(
                    "FIELD" => "tumName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อแขวง/ตำบล",
                    "EX" => "บางคอแหลม"
                ),
                "AMP_CODE" => array(
                    "FIELD" => "ampCode",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "รหัสเขต/อำเภอ",
                    "EX" => "01"
                ),
                "AMP_NAME" => array(
                    "FIELD" => "ampName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อเขต/อำเภอ",
                    "EX" => "บางคอแหลม"
                ),
                "PROV_CODE" => array(
                    "FIELD" => "provCode",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "รหัสจังหวัด",
                    "EX" => "01"
                ),
                "PROV_NAME" => array(
                    "FIELD" => "provName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อจังหวัด",
                    "EX" => "กรุงเทพมหานคร"
                ),
                "ZIP_CODE" => array(
                    "FIELD" => "zipCode",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "รหัสไปรษณีย์",
                    "EX" => "10000"
                ),
                "OLD_TUM_NAME" => array(
                    "FIELD" => "oldTumName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อตำลบตามเอกสารสิทธิ์",
                    "EX" => "บางคอแหลม"
                ),
                "OLD_AMP_NAME" => array(
                    "FIELD" => "oldAmpName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่ออำเภอตามเอกสารสิทธิ์",
                    "EX" => "บางคอแหลม"
                ),
                "OLD_PROV_NAME" => array(
                    "FIELD" => "oldProvName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อจังหวัดตามเอกสารสิทธิ์",
                    "EX" => "กรุงเทพมหานคร"
                ),
                "AREA_RAI" => array(
                    "FIELD" => "areaRai",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เนื้อที่/ไร่",
                    "EX" => "7"
                ),
                "AREA_NGAN" => array(
                    "FIELD" => "areaNgan",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เนื้อที่/งาน",
                    "EX" => "2"
                ),
                "AREA_WA" => array(
                    "FIELD" => "areaWa",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เนื้อที่/ตารางวา",
                    "EX" => "10"
                ),
                "AREA_FRACTION_WA" => array(
                    "FIELD" => "areaFractionWa",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เนื้อที่/เศษวา/10่",
                    "EX" => "9"
                ),
                "DETAIL" => array(
                    "FIELD" => "detail",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "รายละเอียดที่นิติกรบรรยาย",
                    "EX" => "รายละเอียดที่นิติกรบรรยาย"
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
                )*/
			  )
			);

			return $this->objJson;

	}
	public function getJsonPerson(){
		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseAssetsLand",
			  "service_info" => "ข้อมูลที่ดิน ",
			  "response" => array(

				"REQ" => array(
				  "FIELD" => "req",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ลำดับ",
				  "EX" => "0001"
				),

				"PERSON_CODE" => array(
				  "FIELD" => "personCode",
				  "TYPE" => "number",
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
				  "FIELD" => "ConcernCode",
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
				  "EX" => "จำเลย "
				),
				"CONCERN_NO" => array(
				  "FIELD" => "concernNo",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ลำดับที่",
				  "EX" => "1"
				),
			  ),
			);

			return $this->objJson;
	}
}
?>
