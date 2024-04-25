<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Cache-Control: no-cache');
    header('Access-Control-Max-Age: 1728000');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Access-Control-Request-Private-Network');
    header('Access-Control-Allow-Private-Network: true');
    die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../include/include.php';
include '../include/func_Nop.php';
include './check_case_Function.php';

$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$PAGE_CODE = $POST['pageCode'];
$SYSTEM_TYPE = $POST["systemCode"];
$PCC_CIVIL_GEN = $POST["pccCivilGen"];
$toPersonId = $POST['toPersonId'];

function notification_alert_auto($ID_API = "",$toPersonId="")
{
    //ID_API ของคดี
    //$sys ตัวแปลระบบ
    //$toPersonId 13หลักผู้ส่ง 
    $arr_system = [
        "BANKRUPT" => "คดีล้มละลาย",
        "CIVIL" => "คดีแพ่ง",
        "MEDIATE" => "คดีไกล่เกลี่ย",
        "REVIVE" => "คดีฟื้นฟู",
    ];
    foreach ($arr_system as $sys => $sys_name) {
        /* ตรวจสอบว่ามีการส่งซ้ำหรือไม่ */
        $sql_check = "SELECT *FROM M_ALERT_NOTIFICATION a 
                WHERE 1=1 
                AND a.SYSTEM_TYPE_SEND ='CIVIL'
                AND a.SEND_CODE_ID ='" . $ID_API . "'
                AND a.SYSTEM_TYPE_RECEIVE ='" . $sys . "'";
        $query_check = db::query($sql_check);
        $num_check = db::num_rows($query_check);

        if ($num_check == 0) {

            unset($fields);
            //ฝั่งส่ง ส่งจากเเพ่ง
            $fields["SEND_CODE_ID"]         =     $ID_API; //IDของคดีที่เรียกapi ของผู้ส่ง pccCivilGen ,brc_id //มาจาก api
            $fields["SYSTEM_TYPE_SEND"]         =     "REVIVE"; //ส่งจากระบบ 1=เเพ่ง 2=ล้มละลาย 
            $Text_1=""; //ข้อความที่เเจ้งเตือน
            ///ฝั่งรับ รับได้หลายระบบ ล้มละลาย ฟื้นฟู ไกล่เกลี่ย หรือส่งเข้าระบบตัวเอง เเพ่ง
            $fields["ID_CARD_SEND"]         =     $toPersonId; //13หลักผู้ส่ง //มาจาก api
            $fields["DOSS_OWNER_ID"]         =     ""; //IDของเจ้าของคดี
            $fields["DOSS_OWNER_NAME"]         =    ""; //ชื่อเจ้าของคดีฝั่งรับ
            $fields["WH_ASSET_ID"]         =     ""; //IDของทรัพย์ที่ซ้ำ
            $fields["NOTE"]         =     $Text_1; //ข้อความที่เเสดงในการเเจ้งเตือน
            $fields["RECEIVE_CODE_ID"]         =    ""; //IDของคดีที่เรียกapi ของผู้รับ
            $fields["SYSTEM_TYPE_RECEIVE"]         =     $sys; //ระบบที่รับ system_($ss)
            db::db_insert("M_ALERT_NOTIFICATION", $fields, 'ID_ALERT', 'ID_ALERT');
        }
    }
}

 
