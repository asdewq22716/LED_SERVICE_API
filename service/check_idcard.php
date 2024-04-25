
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


/* รับเข้า */
$IDCARD = $POST["IDCARD"];
$PAGE = $POST["PAGE"];

/* เก็บ log start */
$array_link = "";
foreach (json_decode($str_json, true) as $sh1 => $ch1) {
    $array_link .= "&" . $sh1 . "=" . $ch1;
}
unset($fields);
$fields["PAGE_CODE"]                 =   $PAGE;
$fields["COLUMN1"]                 =     $array_link;
$fields["CREATE_DATE"]                 =    date("Y-m-d");
$fields["SYSTEM_TYPE"]                 =   "4";
db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
/* เก็บ log stop */
switch ($PAGE) {
    case "approve_mediator_board": //บันทึกผลการพิจารณาแต่งตั้งผู้ไกล่เกลี่ย
        function like_url($Url)
        {
            return " <a href=\"javascript:openDGDialogWithExternalLink('$Url', 800, 800)\">ตรวจพบสถานะ</a>";
        }
        $link .= "&DATA_SEARCH=ALL";
        $IDCARD = str_replace(' ', '', $IDCARD);
        $Url = "http://103.208.27.224:81/led_service_api/public/search_data_WH.php" . "?REGISTERCODE=" . $IDCARD . $link;
        $obj = like_url($Url);

        $text = "REGISTERCODE=" . $IDCARD . $link;
        if (check_person_2($text) == 0) {
            $obj = "";
        }
        echo json_encode($obj);
        break;
    case "show_btn_personal_info": //ตรวจสอบสถานะบุคคล ตรวสอบบุคคุลว่าเป็นจำเลยในคดีล้มหรือไม่        
        $status = "";
        $sql_check_idcard =        "
        SELECT 
        TB.PK_ID ,TB.WH_ID,
        TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
        TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
        TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
        TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
        TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
        TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
        TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
        FROM VIEW_WH_ALL_CASE_PERSON TB 
        WHERE TB.SYSTEM_TYPE = 'Bankrupt' 
        AND TB.CONCERN_NAME = 'จำเลย'
        AND TB.REGISTER_CODE ='" . $IDCARD . "'
        GROUP BY TB.PK_ID ,TB.WH_ID,TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
        TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
        TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
        TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
        TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
        TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
        TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
        ORDER BY TB.SYSTEM_TYPE ASC,
        CASE
        WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NOT NULL THEN 1
        WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NULL THEN 2
        WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NOT NULL THEN 3
        WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NULL THEN 4
        ELSE 5
        END,TB.CONERNSEQ ASC 
        ";
        $query_Scheck_idcard = db::query($sql_check_idcard);
        while ($rec = db::fetch_array($query_Scheck_idcard)) {
            $status = "พบสถานะในคดี";
        }
        echo json_encode($status);
        break;
        // More cases can be added as needed
}
