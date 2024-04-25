<?php
class civilCaseReceiptJson{

	private $objJson;
	private $objJsonPerson;

	public function getJson(){

		$this->objJson = array(
			  "code" => "",
			  "service_name" => "civilCaseReceipt",
			  "service_info" => "รายละเอียดใบเสร็จการเงิน",
			  "request" => array(
			  
				"RECEIPT_NO" => array(
				  "FIELD" => "receiptNo",
				  "TYPE" => "string",
				  "FIELD_TYPE" => "M", // M/O
				  "DESC" => "เลขที่ใบเสร็จ",
				  "EX" => "0311/2564"
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
				  "EX" => "ผบ."
				),
				"BLACK_CASE" => array(
				  "FIELD" => "blackCase",
				  "TYPE" => "number",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขดำที่",
				  "EX" => "1111"
				),
				"BLACK_YY" => array(
				  "FIELD" => "blackYY",
				  "TYPE" => "number",
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
				  "TYPE" => "number",
				  "FIELD_TYPE" => "O", // M/O
				  "DESC" => "คดีหมายเลขแดงที่",
				  "EX" => "1111"
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

				/* "CIVIL_CODE" => array(
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
				"DOC_DATE" => array(
					"FIELD" => "docDate",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่รับเงิน",
					"EX" => "2020-03-16"
				),
				"RECORD_COUNT" => array(
					"FIELD" => "recodeCount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนรายการ",
					"EX" => "10"
				),
				"COURT_DOC_LIST" => array(
					"FIELD" => "courtDocList",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รายการ",
					"EX" => " "
				),
				"SEQ" => array(
					"FIELD" => "seq",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=>"ลำดับ ",
					"EX" => "0001"
				),
				"LIST_NO" => array(
					"FIELD" => "listNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ที่ตั้ง",
					"EX" => "98 ถนนพระรามสาม"
				),				
				"LIST_NAME" => array(
					"FIELD" => "listName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อรายการ",
					"EX" => "วางค่าใช้จ่าย"
				),
				"MONEY" => array(
					"FIELD" => "money",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนเงิน",
					"EX" => "10,000"
				),
				"RECEIPT_TYPE_ID" => array(
					"FIELD" => "receiptReqType",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสเขต/อำเภอ",
					"EX" => "01"
				),
				"RECEIPT_NO" => array(
					"FIELD" => "receiptNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสจังหวัด",
					"EX" => "01"
				),
				"RECEIPT_DATE" => array(
					"FIELD" => "receiptDate",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"RECEIPT_BANK" => array(
					"FIELD" => "receiptBank",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"RECEIPT_BANKBR" => array(
					"FIELD" => "receiptBankbr",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"RECEIPT_BANKBR_GROUP" => array(
					"FIELD" => "receiptBankGroup",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"RECEIPT_TRANSFERDATE" => array(
					"FIELD" => "receiptTransferdate",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินเจ้าพนักงานบังคับคดี",
					"EX" => "100000"
				),
				"RECEIPT_TRANSFERFLAG" => array(
					"FIELD" => "receiptTransferflag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินกรมธนารักษ์",
					"EX" => "100000"
				),
				"RECEIPT_AMOUNT" => array(
					"FIELD" => "receiptAmount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินของเจ้าพนักงานประเมินราคาทรัพย์",
					"EX" => "100000"
				),
				"RECEIPT_AMOUNTCHEQUE" => array(
					"FIELD" => "receiptAmountcheque",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินโดยคณะกรรมการกำหนดราคา",
					"EX" => "100000"
				),
				"RECEIPT_COMMENT" => array(
					"FIELD" => "receiptComment",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ราคาประเมินโดยคณะอนุกรรมการ",
					"EX" => "100000"
				),
				"RECEIPT_LIST_ID" => array(
					"FIELD" => "receiptReqList",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"RECEIPT_DOSSFLAG" => array(
					"FIELD" => "receiptDossflag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"RECEIPT_SEQUESTERDETAIL" => array(
					"FIELD" => "receiptSequesterdetail",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				) */
				"CIVIL_CODE" => array(
					"FIELD" => "civilCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสหมายบังคับคดี",
					"EX" => ""
				),
				"COURT_CODE" => array(
					"FIELD" => "courtCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => ""
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => ""
				),
				"PREFIX_BLACK_CASE" => array(
					"FIELD" => "prefixBlackCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีดำ",
					"EX" => ""
				),
				"BLACK_CASE" => array(
					"FIELD" => "blackCase",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำที่",
					"EX" => ""
				),
				"BLACK_YY" => array(
					"FIELD" => "blackYy",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขดำปีที่",
					"EX" => ""
				),
				"PREFIX_RED_CASE" => array(
					"FIELD" => "prefixRedCase",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => ""
				),
				"RED_CASE" => array(
					"FIELD" => "redCase",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงที่",
					"EX" => ""
				),
				"RED_YY" => array(
					"FIELD" => "redYy",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คดีหมายเลขแดงปีที่",
					"EX" => ""
				),				
				"RECEIPT_CODE" => array(
					"FIELD" => "receiptCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขใบเสร็จจากแพ่ง",
					"EX" => ""
				),
				"RECEIPT_NO" => array(
					"FIELD" => "receiptNo",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่ใบเสร็จรับเงิน",
					"EX" => ""
				),
				"RECEIPT_NAME" => array(
					"FIELD" => "receiptName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ผู้ชำระเงิน",
					"EX" => ""
				),
				"RECEIPT_DATE" => array(
					"FIELD" => "receiptDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ชำระเงิน",
					"EX" => ""
				),
				"DOC_DATE" => array(
					"FIELD" => "docDate",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่รับเงิน",
					"EX" => ""
				),
				"RECORD_COUNT" => array(
					"FIELD" => "recordCount",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนรายการ",
					"EX" => ""
				),
				"SEQ" => array(
					"FIELD" => "seq",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ลำดับ",
					"EX" => ""
				),
				"MONEY" => array(
					"FIELD" => "money",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "จำนวนเงิน",
					"EX" => ""
				),
				"ACCOUNT_NO" => array(
					"FIELD" => "accountNo",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"PERSON_CODE" => array(
					"FIELD" => "personCode",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"COMMENT" => array(
					"FIELD" => "comment",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำอธิบายรายการ",
					"EX" => ""
				),
				"VATRATE" => array(
					"FIELD" => "vatrate",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DEBTORNO" => array(
					"FIELD" => "debtorno",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => " ลำดับที่ผู้ถูกทวงหนี้",
					"EX" => ""
				),
				"FY" => array(
					"FIELD" => "fy",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ปีงบ",
					"EX" => ""
				),
				"CASE_CODE" => array(
					"FIELD" => "caseCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CASE_NAME" => array(
					"FIELD" => "caseName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DOSS_CODE" => array(
					"FIELD" => "dossCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"DOSS_NAME" => array(
					"FIELD" => "dossName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"RECTYPE_CODE" => array(
					"FIELD" => "rectypeCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"RECTYPE_NAME" => array(
					"FIELD" => "rectypeName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"FDOC_CODE" => array(
					"FIELD" => "fdocCode",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"FDOC_NAME" => array(
					"FIELD" => "fdocName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"VAT_AMOUNT" => array(
					"FIELD" => "vatAmount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"ACTUAL_AMOUNT" => array(
					"FIELD" => "actualAmount",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CANCEL_FLAG" => array(
					"FIELD" => "cancelFlag",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"CANCEL_FLAG_NAME" => array(
					"FIELD" => "cancelFlagName",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => ""
				),
				"WH_RECEIPT_ID" => array(
					"FIELD" => "whReceiptId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "",
					"EX" => " "
				),
				"WH_CIVIL_ID" => array(
					"FIELD" => "whCivilId",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC"=>" ",
					"EX" => ""
				),
				"WH_DOSS_ID" => array(
					"FIELD" => "whDossId",
					"TYPE" => "number",
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
