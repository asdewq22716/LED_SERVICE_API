<?php
class civilCaseDetailJson
{
    private $objJson;
    private $objJsonPerson;

    public function getJson()
    {

        $this->objJson = array(
            "code" => "",
            "service_name" => "civilCaseDetail",
            "service_info" => "ข้อมูลหมายบังคับคดี",
            "request" => array(

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
                    "FIELD_TYPE" => "O", // M/O
                    "DESC" => "ชื่อศาล",
                    "EX" => "ศาลแขวงเชียงใหม่"
                ),
                "DEPT_CODE" => array(
                    "FIELD" => "deptCode",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "O", // M/O
                    "DESC" => "รหัสสำนักงาน",
                    "EX" => "01"
                ),
                "DEPT_NAME" => array(
                    "FIELD" => "deptName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "O", // M/O
                    "DESC" => "ชื่อสำนักงาน",
                    "EX" => "สำนักงานบังคับคดีจังหวัดเชียงใหม่"
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
                "CASE_TYPE_CODE" => array(
                    "FIELD" => "caseTypeCode",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "รหัสประเภทความ",
                    "EX" => "001"
                ),
                "CASE_TYPE_NAME" => array(
                    "FIELD" => "caseTypeName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อประเภทความ",
                    "EX" => "คดีแพ่ง"
                ),
                "CASE_LAWS_CODE" => array(
                    "FIELD" => "caseLawsCode",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ประเภทคดี",
                    "EX" => "001"
                ),
                "CASE_LAWS_NAME" => array(
                    "FIELD" => "caseLawsName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อประเภท",
                    "EX" => "คดีแพ่ง"
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
                "COURT_DATE" => array(
                    "FIELD" => "courtDate",
                    "TYPE" => "date",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "วันที่ในหมายบังคับคดี",
                    "EX" => "01/02/2563"
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
                    "FIELD" => "deffendant1",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อจำเลย (บรรทัดที่ 1)",
                    "EX" => "นายจำเลย จำเลย ที่  1"
                ),
                "DEFFENDANT2" => array(
                    "FIELD" => "deffendant2",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อจำเลย (บรรทัดที่ 2) ",
                    "EX" => "นายจำเลย จำเลย"
                ),
                "DEFFENDANT3" => array(
                    "FIELD" => "deffendant3",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "ชื่อจำเลย (บรรทัดที่ 3)",
                    "EX" => "นายจำเลย จำเลย"
                ),
                "CASE_TYPE_NAME" => array(
                    "FIELD" => "caseTypeName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => "  "
                ),
                "CASE_LAWS_NAME" => array(
                    "FIELD" => "caseLawsName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => "  "
                ),
                "CAPITAL_AMOUNT" => array(
                    "FIELD" => "capitalAmount",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => "  "
                ),
                "ACCOUNT_NO" => array(
                    "FIELD" => "accountNo",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => " "
                ),
                "DOSS_CODE" => array(
                    "FIELD" => "dossCode",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => "  "
                ),
                "DOSS_CONTROL" => array(
                    "FIELD" => "dossControl",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => "  "
                ),
                "DOSS_OWNER_NAME" => array(
                    "FIELD" => "dossOwnerName",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => "  "
                ),
                "CREATE_DATE" => array(
                    "FIELD" => "createDate",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => "  "
                ),
                "ACT_DESC" => array(
                    "FIELD" => "actDesc",
                    "TYPE" => "string",
                    "FIELD_TYPE" => "M", // M/O
                    "DESC" => "",
                    "EX" => "  "
                )
            ),
        );

        return $this->objJson;
    }
}
