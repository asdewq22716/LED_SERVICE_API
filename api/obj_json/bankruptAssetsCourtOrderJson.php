<?php
class bankruptAssetsCourtOrderJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankruptAssetsCourtOrder",
			"service_info" => "ข้อมูลคำสั่งศาล",			  
			"response" => array(
				"bankruptCode" => array(
					"FIELD" => "bankruptCode",
					"NAME" => "",
					"TYPE" => "string",
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
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => "1111"
				),
				"blackYY" => array(
					"FIELD" => "blackYY",
					"NAME" => "",
					"TYPE" => "string",
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
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => "111"
				),
				"redYY" => array(
					"FIELD" => "redYY",
					"NAME" => "",
					"TYPE" => "string",
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
					"EX" => "นายทดสอบ ทดสอบที่ 1"
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
				"courtOrderList" => array(
					"FIELD" => "courtOrderList",
					"NAME" => "",
					"TYPE" => "List",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายการคำสั่งศาล",
					"EX" => ""
				),
				"seq" => array(
					"FIELD" => "seq",
					"NAME" => "",
					"TYPE" => "",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับ",
					"EX" => "1"
				),
				"courtDate" => array(
					"FIELD" => "courtDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ศาลมีคำสั่ง",
					"EX" => "43906"
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
				"courtLevel" => array(
					"FIELD" => "courtLevel",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ศาลชั้น",
					"EX" => "
						01=ชั้นต้น
						02=อุทธรณ์
						03=ฎีกา
					"
				),
				"courtTypeCode" => array(
					"FIELD" => "courtTypeCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสคำสั่งศาล",
					"EX" => "1"
				),
				"courtTypeName" => array(
					"FIELD" => "courtTypeName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อคำสั่งศาล",
					"EX" => "ขอกันส่วน"
				),
				"courtAppCode" => array(
					"FIELD" => "courtAppCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสผลการพิจารณา",
					"EX" => "1"
				),
				"courtAppName" => array(
					"FIELD" => "courtAppName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อผลการพิจารณา",
					"EX" => "อนุญาตตามคำร้อง"
				),
				"courtDetail" => array(
					"FIELD" => "courtDetail",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียดคำสั่ง",
					"EX" => "ส่งทรัพย์ให้เจ้าพนักงาน"
				),
				"courtSdate" => array(
					"FIELD" => "courtSdate",
					"NAME" => "",
					"TYPE" => "Date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่มีผลบังคับ",
					"EX" => "43891"
				)
                
            )

        );
			
		return $this->objJson;
	
    }
    
	public function getJsonPerson(){

		$this->objJson = array(
              
			"code" => "",
			"service_name" => "bankruptCourtOrder",
			"service_info" => "ข้อมูลคำสั่งศาล",			  
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
					"EX" => "นายทดสอบ ทดสอบที่ 1"
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
				"courtOrderList" => array(
					"FIELD" => "courtOrderList",
					"NAME" => "",
					"TYPE" => "List",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายการคำสั่งศาล",
					"EX" => ""
				),
				"seq" => array(
					"FIELD" => "seq",
					"NAME" => "",
					"TYPE" => "",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับ",
					"EX" => "1"
				),
				"courtDate" => array(
					"FIELD" => "courtDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ศาลมีคำสั่ง",
					"EX" => "43906"
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
				"courtLevel" => array(
					"FIELD" => "courtLevel",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ศาลชั้น",
					"EX" => "
						01=ชั้นต้น
						02=อุทธรณ์
						03=ฎีกา
					"
				),
				"courtTypeCode" => array(
					"FIELD" => "courtTypeCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสคำสั่งศาล",
					"EX" => "1"
				),
				"courtTypeName" => array(
					"FIELD" => "courtTypeName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อคำสั่งศาล",
					"EX" => "ขอกันส่วน"
				),
				"courtAppCode" => array(
					"FIELD" => "courtAppCode",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสผลการพิจารณา",
					"EX" => "1"
				),
				"courtAppName" => array(
					"FIELD" => "courtAppName",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อผลการพิจารณา",
					"EX" => "อนุญาตตามคำร้อง"
				),
				"courtDetail" => array(
					"FIELD" => "courtDetail",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายละเอียดคำสั่ง",
					"EX" => "ส่งทรัพย์ให้เจ้าพนักงาน"
				),
				"courtSdate" => array(
					"FIELD" => "courtSdate",
					"NAME" => "",
					"TYPE" => "Date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่มีผลบังคับ",
					"EX" => "43891"
				)
                
            )

        );
            
    }
    
}

?>