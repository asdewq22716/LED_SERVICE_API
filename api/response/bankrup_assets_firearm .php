<?php
//header('Content-Type: application/json');
$service = array(
    "code" => "",
    "service_name" => "bankrupAssetsFirearm",
    "service_info" => "ข้อมูลอาวุธปืน ",
    "table" => "WH_BANKRUPT_ASSETS_FIREARM",
    "response" => array(
        "bankruptCode" => array(
            "NAME" => "",
            "TYPE" => "number",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสหมายบังคับคดี",
            "EX" => "1026833"
        ),
        "courtCode" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสศาล",
            "EX" => "001"
        ),
        "courtName" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ชื่อศาล",
            "EX" => "ศาลแพ่ง"
        ),
        "deptCode" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสสำนักงาน",
            "EX" => "01"
        ),
        "deptName" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ชื่อสำนักงาน",
            "EX" => "สำนักงานบังคับคดีแพ่งกรุงเทพมหานคร 1"
        ),
        "prefixBlackCase" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "คำนำหน้าหมายเลขคดีดำ",
            "EX" => "ผบ."
        ),
        "blackCase" => array(
            "NAME" => "",
            "TYPE" => "number",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "คดีหมายเลขดำที่",
            "EX" => "1111"
        ),
        "blackYY" => array(
            "NAME" => "",
            "TYPE" => "number",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "คดีหมายเลขดำปีที่",
            "EX" => "2563"
        ),
        "prefixRedCase" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "คำนำหน้าหมายเลขคดีแดง",
            "EX" => "ผบ."
        ),
        "redCase" => array(
            "NAME" => "",
            "TYPE" => "number",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "คดีหมายเลขแดงที่",
            "EX" => "111"
        ),
        "redYY" => array(
            "NAME" => "",
            "TYPE" => "number",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "คดีหมายเลขแดงปีที่",
            "EX" => "2563"
        ),
        "recordCount" => array(
            "NAME" => "",
            "TYPE" => "number",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "จำนวนรายการ",
            "EX" => "10"
        ),
        "assetDetial" => array(
            "NAME" => "",
            "TYPE" => "List",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รายละเอียดทรัพย์",
            "EX" => "รายละเอียด ตามตารางรายละเอียดทรัพย์ "
        ),
        "assetCode" => array(
            "NAME" => "ASSET_CODE",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสทรัพย์",
            "EX" => "1234"
        ),
        "assetId" => array(
            "NAME" => "ASSET_ID",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "เลขทะเบียนทรัพย์",
            "EX" => "0345"
        ),
        "assetStatus" => array(
            "NAME" => "ASSET_STATUS",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "สถานะทรัพย์",
            "EX" => "
                00 = งดยึด
                01 = ยึด
                02 = ศาลอนุญาตขาย
                03 = ส่งงานจำหน่าย
                04= ขายได้
                05= ถอนยึด
                06= โอนไปล้มละลาย
                07= ขออนุญาตศาลขาย
                90= รวบรวม
                13= ติดหลักประกัน
            "
        ),
        "lotteryName" => array(
            "NAME" => "LOTTERY_NAME",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ชื่อสลาก",
            "EX" => "AA"
        ),
        "brance" => array(
            "NAME" => "BRANCE",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "สาขา",
            "EX" => "BB"
        ),
        "startNo" => array(
            "NAME" => "START_NO",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "เลขที่",
            "EX" => "120"
        ),
        "To" => array(
            "NAME" => "TO_NO",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ถึง",
            "EX" => "123"
        ),
        "dueDate" => array(
            "NAME" => "DUEDATE",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "วันครบกำหนด",
            "EX" => "09/02/2561"
        ),
        "noUnit" => array(
            "NAME" => "NO_UNIT",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "จำนวน/หน่วย",
            "EX" => "3"
        ),
        "priceUnit" => array(
            "NAME" => "PRICE_UNIT",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ราคาต่อหน่วย",
            "EX" => "2"
        ),
        "priceSum" => array(
            "NAME" => "PRICE_SUM",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "เป็นเงิน",
            "EX" => "6"
        ),
        "price" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ราคาประเมิน",
            "EX" => "10,000"
        ),
        "tumCode" => array(
            "NAME" => "TUM_CODE",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสแขวง/ตำบล",
            "EX" => "01"
        ),
        "tumName" => array(
            "NAME" => "TUM_NAME",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ชื่อแขวง/ตำบล",
            "EX" => "บางคอแหลม"
        ),
        "ampCode" => array(
            "NAME" => "AMP_CODE",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสเขต/อำเภอ",
            "EX" => "01"
        ),
        "ampName" => array(
            "NAME" => "AMP_NAME",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ชื่อเขต/อำเภอ",
            "EX" => "บางคอแหลม"
        ),
        "provCode" => array(
            "NAME" => "PROV_CODE",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสจังหวัด",
            "EX" => "01"
        ),
        "provName" => array(
            "NAME" => "PROV_NAME",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ชื่อจังหวัด",
            "EX" => "กรุงเทพมหานคร"
        ),
        "zipCode" => array(
            "NAME" => "ZIP_CODE",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสไปรษณีย์",
            "EX" => "10000"
        ),
        "ownerList" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "List",
            "EX" => ""
        ),
        "seq" => array(
            "NAME" => "SEQ",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ลำดับ",
            "EX" => "0001"
        ),
        "personCode" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสบุคคล",
            "EX" => "1234"
        ),
        "registerCode" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "เลขประจำตัวประชาชน/นิติบุคคล",
            "EX" => "0111111111111"
        ),
        "prefixCode" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสคำนำหน้า",
            "EX" => "01"
        ),
        "prefixName" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ชื่อคำนำหน้า",
            "EX" => "นาย"
        ),
        "firstName" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ชื่อ",
            "EX" => "ทดสอบ"
        ),
        "lastName" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "นามสกุล",
            "EX" => "ทดสอบ (กรณีนิติบุคคลไม่ระบุ)"
        ),
        "concernCode" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "รหัสเกี่ยวข้องเป็น",
            "EX" => "02"
        ),
        "concernName" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ชื่อเกี่ยวข้องเป็น",
            "EX" => "จำเลย"
        ),
        "concernNo" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "ลำดับที่",
            "EX" => "1"
        ),
        "holdingGroup" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "กลุ่มผู้มีส่วนได้เสียในทรัพย์",
            "EX" => "
                01=ผู้ถือกรรมสิทธิ์/ผู้ถือกรรมสิทธิ์ร่วม
                02=ทายาท/ผู้จัดการมรดก
                03=ผู้รับจำนอง
            "
        ),
        "holdingType" => array(
            "NAME" => "",
            "TYPE" => "string",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "อัตราส่วน",
            "EX" => "
                01=ร้อยละ
                02=สัดส่วน
            "
        ),
        "holdingAmount" => array(
            "NAME" => "",
            "TYPE" => "number",
            "FIELD_TYPE" => "M", // M/O
            "DESC" => "จำนวน",
            "EX" => ""
        )
    )
);

echo json_encode($service, JSON_UNESCAPED_UNICODE);

?>