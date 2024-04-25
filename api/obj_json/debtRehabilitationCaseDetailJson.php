<?php
class debtRehabilitationCaseDetailJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
			  "code" => "",
			  "service_name" => "debtRehabilitationCaseDetail",
			  "service_info" => "รายละเอียดข้อมูลคดี",
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
				  "EX" => "กองฟื้นฟูกิจการลูกหนี้"
				),
				"PREFIX_BLACK_CASE" => array(
				  "FIELD" => "prefixBlackCase",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "คำนำหน้าหมายเลขคดีดำ",
				  "EX" => "ฟ."
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
				)
			),
			"response" => array(
				
				/* "COURT_CODE" => array(
					"FIELD" => "courtCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "044"
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
					"EX" => "กองฟื้นฟูกิจการลูกหนี้"
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ฟ."
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
					"EX" => "ฟ."
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
				"DEFFENDANT1" => array(
					"FIELD" => "deffendant",
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
				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=>" ",
					"EX" => ""
				),			
				"ADDRESS_DEFFENDANT" => array(
					"FIELD" => "addressDeffendant",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CASE_OWNER_NAME" => array(
					"FIELD" => "caseOwnerName",
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
				"FIRST_NAME" => array(
					"FIELD" => "fullName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ADDRESS" => array(
					"FIELD" => "address",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"TUM_NAME" => array(
					"FIELD" => "tumName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"AMP_NAME" => array(
					"FIELD" => "ampName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"PROV_NAME" => array(
					"FIELD" => "provName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ZIP_CODE" => array(
					"FIELD" => "zipCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				) */
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
					"EX" => "กองฟื้นฟูกิจการลูกหนี้"
				),
				"CASE_TYPE_CODE" => array(
					"FIELD" => "caseTypeCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสประเภทความ",
					"EX" => ""
				),
				"CASE_TYPE_NAME" => array(
					"FIELD" => "caseTypeName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อประเภทความ",
					"EX" => ""
				),
				"CASE_LAWS_CODE" => array(
					"FIELD" => "caseLawsCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทคดี",
					"EX" => ""
				),
				"CASE_LAWS_NAME" => array(
					"FIELD" => "caseLawsName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อประเภท",
					"EX" => ""
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => "ฟ."
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
					"EX" => "ฟ."
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
				"COURT_DATE" => array(
					"FIELD" => "courtDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ในหมาย",
					"EX" => ""
				),
				"CAPITAL_AMOUNT" => array(
					"FIELD" => "capitalAmount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"REGISTER_CODE" => array(
					"FIELD" => "registerCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=>" ",
					"EX" => ""
				),
				"DEFFENDANT1" => array(
					"FIELD" => "deffendant1",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"REQ_RESULT" => array(
					"FIELD" => "reqResult",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะรับคำร้อง",
					"EX" => "0 = รับคำร้อง 
							1 = ไม่รับคำร้อง"
				),
				"RESULT_ACCEPT_DATE" => array(
					"FIELD" => "resultAcceptDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ศาลรับคำร้อง",
					"EX" => ""
				),
				"RESULT_UNACCEPT_DATE" => array(
					"FIELD" => "resultUnacceptDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ศาลไม่รับคำร้อง",
					"EX" => ""
				),
				"CASE_OWNER_ID" => array(
					"FIELD" => "caseOwnerId",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CASE_OWNER_NAME" => array(
					"FIELD" => "caseOwnerName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),			
				"ADDRESS_DEFFENDANT" => array(
					"FIELD" => "addressDeffendant",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),			
				"REQ_REQUEST_NAME" => array(
					"FIELD" => "reqRequestName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ผู้ร้องขอ",
					"EX" => ""
				),			
				"ACCEPT_DATE_CANCEL" => array(
					"FIELD" => "acceptDateCancel",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ถอนคำร้อง",
					"EX" => ""
				),			
				"DISPOSE_DATE" => array(
					"FIELD" => "disposeDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่จำหน่ายคดี",
					"EX" => ""
				),			
				"REQ_DATE" => array(
					"FIELD" => "reqDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ยื่นคำร้อง",
					"EX" => ""
				),			
				"JUDICIAL_DATE_REFETCH" => array(
					"FIELD" => "judicialDateRefetch",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ศาลมีคำสั่งให้ฟื้นฟู",
					"EX" => ""
				),			
				"JUDICIAL_DATE_PLANNER" => array(
					"FIELD" => "judicialDatePlanner",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ศาลมีคำสั่งให้ฟื้นฟูและตั้งผู้ทำแผน",
					"EX" => ""
				),			
				"JUDICIAL_DATE_ANC_1" => array(
					"FIELD" => "judicialDateAnc1",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันประกาศราชกิจจาฯ",
					"EX" => ""
				),			
				"SET_DATE_PLAN_TEMP" => array(
					"FIELD" => "setDatePlanTemp",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ตั้งผู้บริหารชั่วคราว",
					"EX" => ""
				),			
				"SET_DATE_PLANER" => array(
					"FIELD" => "setDatePlaner",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ตั้งผู้ทำแผน",
					"EX" => ""
				),			
				"REHAB_PLAN_NAME" => array(
					"FIELD" => "rehabPlanName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ผู้ทำแผน (ชื่อผู้ทำแผน)",
					"EX" => ""
				),			
				"JUDICIAL_DATE_ANC_2" => array(
					"FIELD" => "judicialDateAnc2",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันประกาศราชกิจจาฯ",
					"EX" => ""
				),			
				"SET_PLAN_REHAB_DATE" => array(
					"FIELD" => "setPlanRehabDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ตั้งผู้บริหารแผน",
					"EX" => ""
				),			
				"DATE_CMD_REHAB_CAN" => array(
					"FIELD" => "dateCmdRehabCan",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ยกเลิกคำสั่งฟื้นฟูกิจการ",
					"EX" => ""
				),			
				"DATE_REHAB_CAN" => array(
					"FIELD" => "dateRehabCan",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ยกเลิกการฟื้นฟูกิจการ",
					"EX" => ""
				),
				"DETAILS_CANCEL_CMD" => array(
					"FIELD" => "detailsCancelCmd",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เหตุที่ยกเลิกคำสั่งฟื้นฟูกิจการ",
					"EX" => ""
				),
				"DETAILS_CANCEL_REHAB" => array(
					"FIELD" => "detailsCancelRehab",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เหตุที่ยกเลิกการฟื้นฟูกิจการ",
					"EX" => ""
				),
				"PLAINTIFF2" => array(
					"FIELD" => "plaintiff2",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 1)",
					"EX" => ""
				),
				"DEFFENDANT2" => array(
					"FIELD" => "deffendant2",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 1)",
					"EX" => ""
				),
				"PLAINTIFF3" => array(
					"FIELD" => "plaintiff3",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ (บรรทัดที่ 1)",
					"EX" => ""
				),
				"DEFFENDANT3" => array(
					"FIELD" => "deffendant3",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย (บรรทัดที่ 1)",
					"EX" => ""
				),
				"REHAB_CODE" => array(
					"FIELD" => "rehabCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"COMP_PAY_DEPT_DATE" => array(
					"FIELD" => "compPayDeptDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				)
			  ),
			);
			
			return $this->objJson;
	}
}
?>