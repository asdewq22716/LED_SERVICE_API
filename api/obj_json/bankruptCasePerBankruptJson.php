<?php
class bankruptCasePerBankruptJson{
	
	private $objJson;
	
	public function getJson(){
		
		$this->objJson = array(
				"code" => "",
				"service_name" => "bankruptCasePerBankrupt",
				"service_info" => "ข้อมูลบุคคลล้มละลาย",
				"request" => array(
					"REGISTER_CODE" => array(
						"FIELD" => "registerCode",
						"TYPE" => "string",
						"FIELD_TYPE" => "M", // M/O
						"DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
						"EX" => "0111111111111"
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
					)
				),
				"response" => array(
					"COURT_CODE" => array(
                        "FIELD" => "courtCode",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "รหัสศาล",
                        "EX" => "01"
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
                    
                    "DEFFENDANT1" => array(
                        "FIELD" => "deffendant1",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    ),
                    
                    "COURT_DATE" => array(
                        "FIELD" => "courtDate",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    ),
                    "CAPITAL_AMOUNT" => array(
                        "FIELD" => "capitalAmount",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    ),
                    
                    "COURT_APP_NAME" => array(
                        "FIELD" => "courtName",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    ),
                    "COURT_LEVEL" => array(
                        "FIELD" => "courtLevel",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    ),
                    "COURT_TYPE_NAME" => array(
                        "FIELD" => "courtTypeName",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    ),
                    "COURT_SDATE" => array(
                        "FIELD" => "courtSdate",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    ),
                    "BOOK_NO" => array(
                        "FIELD" => "bookNo",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    ),
                    "PAGE_NO" => array(
                        "FIELD" => "pageNo",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "หน้าที่",
                        "EX" => ""
                    ),
                    
                    "LESSON_NO" => array(
                        "FIELD" => "lessonNo",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "ตอนที่",
                        "EX" => ""
                    ),
                    "NEW_PAPER_NAME" => array(
                        "FIELD" => "newsPaperName",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    ),
                    "NEW_PAPER_DATE" => array(
                        "FIELD" => "newsPaperDate",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    ),
                    "GAZETTE_DATE" => array(
                        "FIELD" => "gaztteDate",
                        "TYPE" => "string",
                        "FIELD_TYPE" => "M", // M/O
                        "DESC" => "",
                        "EX" => ""
                    )
				)
			);
			
			return $this->objJson;
	
	}
}
?>