<?php
class bankruptDocJson{
	
	private $objJson;
	private $objJsonPerson;  
	
	public function getJson(){
		
		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankruptDoc",
			"service_info" => "ข้อมูลเอกสารภายในคดี",			  
			"response" => array(
				"bankruptCode" => array(
					"FIELD" => "bankruptCode",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสคดี",
					"EX" => "1026833"
				),
				"courtCode" => array(
					"FIELD" => "courtCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
				),
				"courtName" => array(
					"FIELD" => "courtName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลล้มละลายกลาง"
				),
				"deptCode" => array(
					"FIELD" => "deptCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสสำนักงาน",
					"EX" => "1"
				),
				"deptName" => array(
					"FIELD" => "deptName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสำนักงาน",
					"EX" => "กองบังคับคดีล้มละลาย 1"
				),
				"prefixBlackCase" => array(
					"FIELD" => "prefixBlackCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ล."
				),
				"blackCase" => array(
					"FIELD" => "blackCase",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"blackYY" => array(
					"FIELD" => "blackYY",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำปีที่",
					"EX" => "2563"
				),
				"prefixRedCase" => array(
					"FIELD" => "prefixRedCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ล."
				),
				"redCase" => array(
					"FIELD" => "redCase",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "111"
				),
				"redYY" => array(
					"FIELD" => "redYY",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
				),
				"courtDate" => array(
					"FIELD" => "courtDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ในหมาย",
					"EX" => "242189"
				),
				"capitalAmount" => array(
					"FIELD" => "capitalAmount",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ทุนทรัพย์",
					"EX" => "100000"
				),
				"plaintiff1" => array(
					"FIELD" => "plaintiff1",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 1)",
					"EX" => "นายทดสอบ ทดสอบ ที่ 1"
				),
				"plaintiff2" => array(
					"FIELD" => "plaintiff2",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 2)",
					"EX" => "นายทดสอบ ทดสอบ"
				),
				"plaintiff3" => array(
					"FIELD" => "plaintiff3",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 3)",
					"EX" => "นายทดสอบ ทดสอบ"
				),
				"deffendant1" => array(
					"FIELD" => "deffendant1",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 1)",
					"EX" => "นายจำเลย จำเลย ที่ 1"
				),
				"deffendant2" => array(
					"FIELD" => "deffendant2",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 2)",
					"EX" => "นายจำเลย จำเลย"
				),
				"deffendant3" => array(
					"FIELD" => "deffendant3",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 3)",
					"EX" => "นายจำเลย จำเลย"
				),
				"recordCount" => array(
					"FIELD" => "recordCount",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนรายการ",
					"EX" => "10"
				),
				"seq" => array(
					"FIELD" => "seq",
					"NAME" => "",
					"TYPE" => "",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับ",
					"EX" => "1"
				),
				"docDate" => array(
					"FIELD" => "docDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่เอกสาร",
					"EX" => "43906"
				),
				"docName" => array(
					"FIELD" => "docName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเอกสาร",
					"EX" => "สำเนาโฉนดที่ดิน"
				),
				"docFile" => array(
					"FIELD" => "docFile",
					"NAME" => "",
					"TYPE" => "Base64",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ไฟล์เอกสาร",
					"EX" => ""
				)
                
            )

        );
			
		return $this->objJson;
	
    }
    
	public function getJsonPerson(){

		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankruptDoc",
			"service_info" => "ข้อมูลเอกสารภายในคดี",			  
			"response" => array(
				"bankruptCode" => array(
					"FIELD" => "bankruptCode",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสคดี",
					"EX" => "1026833"
				),
				"courtCode" => array(
					"FIELD" => "courtCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
				),
				"courtName" => array(
					"FIELD" => "courtName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลล้มละลายกลาง"
				),
				"deptCode" => array(
					"FIELD" => "deptCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสสำนักงาน",
					"EX" => "1"
				),
				"deptName" => array(
					"FIELD" => "deptName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสำนักงาน",
					"EX" => "กองบังคับคดีล้มละลาย 1"
				),
				"prefixBlackCase" => array(
					"FIELD" => "prefixBlackCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ล."
				),
				"blackCase" => array(
					"FIELD" => "blackCase",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"blackYY" => array(
					"FIELD" => "blackYY",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำปีที่",
					"EX" => "2563"
				),
				"prefixRedCase" => array(
					"FIELD" => "prefixRedCase",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ล."
				),
				"redCase" => array(
					"FIELD" => "redCase",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "111"
				),
				"redYY" => array(
					"FIELD" => "redYY",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => "2563"
				),
				"courtDate" => array(
					"FIELD" => "courtDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ในหมาย",
					"EX" => "242189"
				),
				"capitalAmount" => array(
					"FIELD" => "capitalAmount",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ทุนทรัพย์",
					"EX" => "100000"
				),
				"plaintiff1" => array(
					"FIELD" => "plaintiff1",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 1)",
					"EX" => "นายทดสอบ ทดสอบ ที่ 1"
				),
				"plaintiff2" => array(
					"FIELD" => "plaintiff2",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 2)",
					"EX" => "นายทดสอบ ทดสอบ"
				),
				"plaintiff3" => array(
					"FIELD" => "plaintiff3",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 3)",
					"EX" => "นายทดสอบ ทดสอบ"
				),
				"deffendant1" => array(
					"FIELD" => "deffendant1",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 1)",
					"EX" => "นายจำเลย จำเลย ที่ 1"
				),
				"deffendant2" => array(
					"FIELD" => "deffendant2",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 2)",
					"EX" => "นายจำเลย จำเลย"
				),
				"deffendant3" => array(
					"FIELD" => "deffendant3",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 3)",
					"EX" => "นายจำเลย จำเลย"
				),
				"recordCount" => array(
					"FIELD" => "recordCount",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนรายการ",
					"EX" => "10"
				),
				"seq" => array(
					"FIELD" => "seq",
					"NAME" => "",
					"TYPE" => "",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับ",
					"EX" => "1"
				),
				"docDate" => array(
					"FIELD" => "docDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่เอกสาร",
					"EX" => "43906"
				),
				"docName" => array(
					"FIELD" => "docName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อเอกสาร",
					"EX" => "สำเนาโฉนดที่ดิน"
				),
				"docFile" => array(
					"FIELD" => "docFile",
					"NAME" => "",
					"TYPE" => "Base64",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ไฟล์เอกสาร",
					"EX" => ""
				)
                
            )

        );
            
    }
    
}

?>