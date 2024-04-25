<?php
class bankruptCaseDetailJson{
	
	private $objJson;
	
	public function getJson(){
		
		$this->objJson = array(
			"code" => "",
			"service_name" => "bankruptCaseDetail",
			"service_info" => "ข้อมูลหมายบังคับคดี",
			"request" => array(
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "044"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลล้มละลายกลาง"
				),
				"DEPT_NAME" => array(
					"FIELD" => "deptName",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อสำนักงาน",
					"EX" => "กองบังคับคดีล้มละลาย 1"
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
					"EX" => "111"
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
				"BANKRUPT_CODE" => array(
				  "FIELD" => "bankruptCode",				  
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "รหัสคดี",
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
				  "EX" => "ศาลล้มละลายกลาง"
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
				  "EX" => "กองบังคับคดีล้มละลาย 1"
				),
				"PREFIX_BLACK_CASE" => array(
				  "FIELD" => "prefixBlackCase",				 
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีแดง",
				  "EX" => "ล."
				),
				"BLACK_CASE" => array(
				  "FIELD" => "blackCase",				 
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขแดงที่",
				  "EX" => "1111"
				),
				"BLACK_YY" => array(
				  "FIELD" => "blackYY",				  
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คดีหมายเลขแดงปีที่",
				  "EX" => "2563"
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
				"COURT_DATE" => array(
				  "FIELD" => "courtDate",
				  "TYPE" => "date",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "วันที่ในหมาย",
				  "EX" => "01/02/2563"
				),
				"CAPITAL_AMOUNT" => array(
				  "FIELD" => "capitalAmount",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ทุนทรัพย์",
				  "EX" => "100000.00"
				),
				"PLAINTIFF1" => array(
				  "FIELD" => "plaintiff1",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อโจทก์ (บรรทัดที่ 1)",
				  "EX" => "นายทดสอบ ทดสอบ ที่ 1"
				),
				"PLAINTIFF2" => array(
				  "FIELD" => "plaintiff2",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อโจทก์ (บรรทัดที่ 2)",
				  "EX" => "นายทดสอบ ทดสอบ"
				),
				"PLAINTIFF3" => array(
				  "FIELD" => "plaintiff3",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อโจทก์ (บรรทัดที่ 3)",
				  "EX" => "นายทดสอบ ทดสอบ"
				),
				"DEFFENDANT1" => array(
				  "FIELD" => "defendant1",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อจำเลย (บรรทัดที่ 1)",
				  "EX" => "นายจำเลย จำเลย ที่ 1"
				),
				"DEFFENDANT2" => array(
				  "FIELD" => "defendant2",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อจำเลย (บรรทัดที่ 2)",
				  "EX" => "นายจำเลย จำเลย"
				),
				"DEFFENDANT3" => array(
				  "FIELD" => "defendant3",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "ชื่อจำเลย (บรรทัดที่ 3)",
				  "EX" => "นายจำเลย จำเลย"
                ),
                
                "DOCKET_NAME" => array(
                    "FIELD" => "docketName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "สำนวน",
                    "EX" => ""
                ),
                "DOCKET_OWNER" => array(
                    "FIELD" => "docketOwner",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "จทพ. เจ้าของสำนวน",
                    "EX" => ""
                ),
                "DOCKET_SUBJECT" => array(
                    "FIELD" => "docketSubject",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "เรื่อง",
                    "EX" => ""
                ),
                "AMOUNT_OF_DEBT" => array(
                    "FIELD" => "amountOfDebt",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "จำนวนเงินที่ขอชำระหนี้",
                    "EX" => ""
                ),
                "AMOUNT_OF_DEBT_ALLOW" => array(
                    "FIELD" => "amountOfDebtAllow",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "จำนวนเงินที่อนุญาตให้ได้รับชำระหนี้",
                    "EX" => ""
                )
			)
		);
			
		return $this->objJson;
	
	}
}
?>