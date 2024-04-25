<?php
class mediateCaseJson{

	private $objJson;

	public function getJson(){

		$this->objJson = array(

			"code" => "",
			"service_name" => "MediateCase",
			"service_info" => "ข้อมูลผลการไกล่เกลี่ย",
			"request" => array(

				"REF_MEDIATE_ID" => array(
					"FIELD" => "refMediateId",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่ไกล่เกลี่ย",
					"EX" => "242189"
				),
				"RED_CASE_TITLE " => array(
					"FIELD" => "redCaseTitle ",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ผบ."
				),
				"RED_CASE_NO_SHW" => array(
					"FIELD" => "redCaseNoShw",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่คดีแดง",
					"EX" => "111"
				),
				"RECEIVE_DATE" => array(
					"FIELD" => "receiveDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "วันที่ยื่นคำร้อง",
					"EX" => "20//02/2563"
				),
				"REQ_FNAME" => array(
					"FIELD" => "reqFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อผู้ร้อง",
					"EX" => "นายสุขสันต์ หรรษา"
				),
				"PLAINTIFF_FNAME" => array(
					"FIELD" => "plaintiffFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อโจทก์",
					"EX" => "นางมีสุข มากมาย"
				),
				"DEFENDANT_FNAME" => array(
					"FIELD" => "deffendantFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อจำเลย",
					"EX" => "นายสวัสดี เฮเฮ"
				),
				"COURT_ID" => array(
					"FIELD" => "courtId",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtname",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลแขวงตลิ่งชัน"
				)

			),
			"response" => array(

				"REF_MEDIATE_ID" => array(
					"FIELD" => "refMediateId",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่ไกล่เกลี่ย",
					"EX" => "242189"
				),
				"RECEIVE_DATE" => array(
					"FIELD" => "receiveDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ยื่นคำร้อง",
					"EX" => "242208"
				),
				"REQ_FNAME" => array(
					"FIELD" => "reqFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อผู้ร้องขอไกล่เกลี่ย",
					"EX" => "นายสุขสันต์ หรรษา"
				),
				"PLAINTIFF_FNAME" => array(
					"FIELD" => "plaintiffFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ ",
					"EX" => "นางมีสุข มากมาย"
				),
				"DEFENDANT_FNAME" => array(
					"FIELD" => "deffendantFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย ",
					"EX" => "นายสวัสดี เฮเฮ"
				),
				"COURT_ID" => array(
					"FIELD" => "courtId",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtname",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลแขวงตลิ่งชัน"
				),
				"CHANNEL_ID" => array(
					"FIELD" => "channelId",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสช่องทางการยื่นคำร้อง",
					"EX" => "1"
				),
				"CHANNEL_NAME" => array(
					"FIELD" => "channelName",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ช่องทางการยื่นคำร้อง",
					"EX" => "ยื่นออนไลน์"
				),
				"TYPE_MEDIATE_ID" => array(
					"FIELD" => "tpyeMediateId",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสประเภทไกล่เกลี่ย",
					"EX" => "1"
				),
				"TYPE_MEDIATE_NAME" => array(
					"FIELD" => "typeMediateName",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทไกล่เกลี่ย",
					"EX" => "มหกรรม"
				)

            )

        );

		return $this->objJson;

    }

	public function getJsonPerson(){

		$this->objJson = array(

			"code" => "",
			"service_name" => "MediateCase",
			"service_info" => "ข้อมูลผลการไกล่เกลี่ย",
			"request" => array(

				"REF_MEDIATE_ID" => array(
					"FIELD" => "refMediateId",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่ไกล่เกลี่ย",
					"EX" => "242189"
				),
				"RED_CASE_TITLE " => array(
					"FIELD" => "redCaseTitle ",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าหมายเลขคดีแดง",
					"EX" => "ผบ."
				),
				"RED_CASE_NO_SHW" => array(
					"FIELD" => "redCaseNoShw",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่คดีแดง",
					"EX" => "111"
				),
				"RECEIVE_DATE" => array(
					"FIELD" => "receiveDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "วันที่ยื่นคำร้อง",
					"EX" => "20//02/2563"
				),
				"REQ_FNAME" => array(
					"FIELD" => "reqFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อผู้ร้อง",
					"EX" => "นายสุขสันต์ หรรษา"
				),
				"PLAINTIFF_FNAME" => array(
					"FIELD" => "plaintiffFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อโจทก์",
					"EX" => "นางมีสุข มากมาย"
				),
				"DEFENDANT_FNAME" => array(
					"FIELD" => "deffendantFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อจำเลย",
					"EX" => "นายสวัสดี เฮเฮ"
				),
				"COURT_ID" => array(
					"FIELD" => "courtId",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลแขวงตลิ่งชัน"
				)

			),
			"response" => array(

				"REF_MEDIATE_ID" => array(
					"FIELD" => "refMediateId",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขที่ไกล่เกลี่ย",
					"EX" => "242189"
				),
				"RECEIVE_DATE" => array(
					"FIELD" => "receiveDate",
					"NAME" => "",
					"TYPE" => "date",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วันที่ยื่นคำร้อง",
					"EX" => "242208"
				),
				"REQ_FNAME" => array(
					"FIELD" => "reqFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อผู้ร้องขอไกล่เกลี่ย",
					"EX" => "นายสุขสันต์ หรรษา"
				),
				"PLAINTIFF_FNAME" => array(
					"FIELD" => "plaintiffFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อโจทก์ ",
					"EX" => "นางมีสุข มากมาย"
				),
				"DEFENDANT_FNAME" => array(
					"FIELD" => "deffendantFname",
					"NAME" => "",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อจำเลย ",
					"EX" => "นายสวัสดี เฮเฮ"
				),
				"COURT_ID" => array(
					"FIELD" => "courtId",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสศาล",
					"EX" => "1"
				),
				"COURT_NAME" => array(
					"FIELD" => "courtName",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อศาล",
					"EX" => "ศาลแขวงตลิ่งชัน"
				),
				"CHANNEL_ID" => array(
					"FIELD" => "channelId",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสช่องทางการยื่นคำร้อง",
					"EX" => "1"
				),
				"CHANNEL_NAME" => array(
					"FIELD" => "channelName",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ช่องทางการยื่นคำร้อง",
					"EX" => "ยื่นออนไลน์"
				),
				"TYPE_MEDIATE_ID" => array(
					"FIELD" => "typeMediateId",
					"NAME" => "",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสประเภทไกล่เกลี่ย",
					"EX" => "1"
				),
				"TYPE_MEDIATE_NAME" => array(
					"FIELD" => "typeMediateName",
					"NAME" => "",
					"TYPE" => "String",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ประเภทไกล่เกลี่ย",
					"EX" => "มหกรรม"
				)

            )

        );

    }

}

?>
