<?php
class backofficeUserJson{

	private $objJson;

	public function getJson(){

		$this->objJson = array(
			"code" => "",
			"service_name" => "backofficeUser",
			"service_info" => "ข้อมูลบุคคลภายในกรม",
			"request" => array(
				"PER_ID_CARD" => array(
					"FIELD" => "perIdCard",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชน",
					"EX" => "0111111111111"
				),
				"PREFIX_NAME_TH" => array(
					"FIELD" => "prefixNameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "คำนำหน้าชื่อภาษาไทย",
					"EX" => "นาย"
				),
				"PER_FIRST_NAME_TH" => array(
					"FIELD" => "perFirstNameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "O", // M/O
					"DESC" => "ชื่อตัวบุคลากร ภาษาไทย",
					"EX" => "ทดสอบ"
				)
			),
			"response" => array(
				"PER_ID" => array(
					"FIELD" => "perld",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสบุคลากร",
					"EX" => "1234"
				),
				"PREFIX_ID" => array(
					"FIELD" => "perfixld",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสคำนำหน้าชื่อ",
					"EX" => "12"
				),
				"PER_IDCARD" => array(
					"FIELD" => "perldcard",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "เลขประจำตัวประชาชน",
					"EX" => "11111111111"
				),
				"PREFIX_NAME_TH" => array(
					"FIELD" => "prefixNameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "คำนำหน้าชื่อภาษาไทย",
					"EX" => "นาย"
				),
				"PER_FIRST_NAME_TH" => array(
					"FIELD" => "perFirstNameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อตัวบุคลากร ภาษาไทย",
					"EX" => "ทดสอบ"
				),
				"PER_FIRST_NAME_EN" => array(
					"FIELD" => "perFirstNameEn",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อตัวบุคลากร ภาษาอังกฤษ",
					"EX" => "test"
				),
				"PER_LAST_NAME_TH" => array(
					"FIELD" => "perLastNameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสกุลบุคลากร ภาษาไทย",
					"EX" => "ทดสอบ."
				),
				"PER_LAST_NAME_EN" => array(
					"FIELD" => "perLastNameEn",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อสกุลบุคลากร ภาษาอังกฤษ",
					"EX" => "test"
				),
				"PER_DATE_BIRTH" => array(
					"FIELD" => "perDateBirth",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ว/ด/ปี เกิด",
					"EX" => "2020-03-01"
				),
				"POSTYPE_ID" => array(
					"FIELD" => "postypeld",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสประเภทบุคลาการ",
					"EX" => "1."
				),
				"TYPE_ID" => array(
					"FIELD" => "typeld",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสประเภทตำแหน่ง",
					"EX" => "1"
				),
				"LINE_ID" => array(
					"FIELD" => "lineld",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสตำแหน่งในสายงาน",
					"EX" => "1"
				),
				"LEVEL_ID" => array(
					"FIELD" => "levelld",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสระดับตำแหน่ง",
					"EX" => "1"
				),
				"MANAGE_ID" => array(
					"FIELD" => "manageld",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสตำแหน่งทางการบริหาร",
					"EX" => "1"
				),
				"ORG_ID1" => array(
					"FIELD" => "orgld1",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสหน่วยงาน ระดับกระทรวง",
					"EX" => "1"
				),
				"ORG_ID2" => array(
					"FIELD" => "orgld2",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสหน่วยงาน ระดับกรม",
					"EX" => "1"
				),
				"ORG_ID3" => array(
					"FIELD" => "orgld3",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสหน่วยงาน ระดับกอง/สำนัก/กลุ่ม",
					"EX" => "1"
				),
				"ORG_ID4" => array(
					"FIELD" => "orgld4",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "รหัสหน่วยงาน ระดับส่วน/กลุ่มงาน",
					"EX" => "1"
				),
				"POSTYPE_NAME_TH" => array(
					"FIELD" => "postypeNameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อประเภทตำแหน่งบุคลากร ภาษาไทย",
					"EX" => "ข้าราชการ"
				),
				"TYPE_NAME_TH" => array(
					"FIELD" => "typeNameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อประเภทตำแหน่ง ภาษาไทย",
					"EX" => "วิชาการ"
				),
				"LINE_NAME_TH" => array(
					"FIELD" => "lineNameTh",
					"TYPE" => "number",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อตำแหน่งในสายงาน ภาาษาไทย",
					"EX" => "นิติกร"
				),
				"LEVEL_NAME_TH" => array(
					"FIELD" => "levelNameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อระดับตำแหน่ง ภาษาไทย",
					"EX" => "ชำนาญการ"
				),
				"MANAGE_NAME_TH" => array(
					"FIELD" => "manageNameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อตำแหน่งทางการ ภาษาไทย",
					"EX" => "ผู้อำนวยการ"
				),
				"ORG1_NAME_TH" => array(
					"FIELD" => "org1NameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อหน่วยงาน ระดับกระทรวง",
					"EX" => "กระทรวงยุติธรรม"
				),
				"ORG2_NAME_TH" => array(
					"FIELD" => "org2NameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อหน่วยงาน ระดับกรม",
					"EX" => "กรมบังคับคดี"
				),
				"ORG3_NAME_TH" => array(
					"FIELD" => "org3NameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อหน่วยงาน ระดับกอง/สำนัก/กลุ่ม",
					"EX" => "กองฟื้นฟูกิจการลูกหนี้"
				),
				"ORG4_NAME_TH" => array(
					"FIELD" => "org4NameTh",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "ชื่อหน่วยงาน ระดับส่วน/กลุ่มงาน",
					"EX" => "กองฟื้นฟูกิจการลูกหนี้"
				),
				"ACTIVE_STATUS" => array(
					"FIELD" => "activeStatus",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "สถานะของการใช้งาน ",
					"EX" => "
					1 = ใช้งาน
					0 = ไม่ใช้งาน
					"
				),
				"UPDATE_DATE" => array(
					"FIELD" => "updateDate",
					"TYPE" => "string",
					"FIELD_TYPE" => "M", // M/O
					"DESC" => "วัน เวลา ที่ปรับปรุงข้อมูลครั้งล่าสุด",
					"EX" => "2020-03-010:00"
				)
			)
		);

		return $this->objJson;

	}
}
?>
