<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "P";


include('../include/include.php');


include('../include/paging.php');
include '../include/func_Nop.php';
include "./btn_function.php";

CONVERT_GET((func::get_E_and_D("NontificationAlert", "D", $_GET)));

if (isset($_GET['CODE'])) { //ตรวจสอบว่ามีตัวแปร CODE ที่ถูกส่งมาผ่านค่า GET (query parameter) หรือไม่ 
    $decodedCode = base64_decode($_GET['CODE']);
    $decodedCode = str_replace('&', '##', $decodedCode);
    $segments = explode("##", trim($decodedCode, "##"));
    $data = [];
    foreach ($segments as $segment) {
        list($key, $value) = explode("=", $segment, 2);
        $data[$key] = $value;
        $_GET[$key] = $value;
    }
}

if ($_POST) {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
}

if ($_GET) {
    foreach ($_GET as $key => $value) {
        ${$key} = $value;
    }
}

function ConvertSystem_text($A = "")
{
    if ($A == '2') {
        $B = 'BANKRUPT';
    }
    if ($A == '1') {
        $B = 'CIVIL';
    }
    if ($A == '4') {
        $B = 'MEDIATE';
    }
    if ($A == '3') {
        $B = 'REVIVE';
    }
    return $B;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/template_user.php'; ?>
</head>

<!-- <body id="bsf_body" class="horizontal-fixed fixed">
    <div class="wrapper"></div> -->

<body id="bsf_body" class="">
    <div class="wrapper">
        <?php
        //  include '../include/combottom_js_user.php'; //function 
        ?>
        <style>
            .content-wrapper {
                margin-top: -20px;
                /* ปรับระยะห่างด้านบนของ content-wrapper ให้มีค่า 20px */
            }
        </style>
        <?php
        class Nontification extends Paging
        {
            public $DataNonti;
            public $sql;
            public $Total_row;
            public function M_ALERT_NOTIFICATION($ArrayFill)
            {
                $fill = "";
                foreach ($ArrayFill as $AA => $BB) {
                    $fill .= $BB;
                }
                $sql = "SELECT *FROM M_ALERT_NOTIFICATION   a  
                WHERE 1=1 {$fill} 
                ORDER BY a.CREATE_DATE DESC ,a.CREATE_TIME DESC  ";
                $sql_rownum = $this->ROWNUM($sql);
                $this->sql = $sql_rownum;
                $this->Total_row = db::num_rows(db::query($sql));
                $query = db::query($sql_rownum);
                $ArrayData = [];
                while ($rec = db::fetch_array($query)) {
                    $ArrayData[] = $rec;
                }
                return $ArrayData;
            }
        }
        //ถ้าเป็นค่าว่างจะเท่ากับDefeal
        //กำหนดชื่อ page
        /*  $Page = new Paging();
        $Page->name_page = 'page';
        $Page->name_page_size = 'page_size';
        $Page->__GET_PAGE($_GET[$Page->name_page], $_GET[$Page->name_page_size], '20'); */

        ?>
        <div class="content m-t-20">
            <!-- Container-fluid starts -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Row start -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="card-block">
                                        <!-- Row start -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form method="GET" action="" enctype="multipart/form-data" id="frm-input">
                                                    <input type="hidden" name="TO_PERSON_ID" id="TO_PERSON_ID" value="<?php echo $_GET['TO_PERSON_ID']; ?>">
                                                    <input type="hidden" name="SEND_TO" id="SEND_TO" value="<?php echo $_GET['SEND_TO']; ?>">
                                                    <?php


                                                    //extend Class Paging เข้า class ที่ต้องการ
                                                    $Non = new Nontification();
                                                    $Non->name_page = 'page';
                                                    $Non->name_page_size = 'page_size';
                                                    $Non->stylePage();
                                                    $Non->__GET_PAGE($_GET[$Non->name_page], $_GET[$Non->name_page_size], '20');

                                                    unset($fill);
                                                    $fill = [
                                                        "SYSTEM_TYPE_RECEIVE" => " AND a.SYSTEM_TYPE_RECEIVE ='" . $_GET['SEND_TO'] . "'",
                                                        "DOSS_OWNER_ID" => " AND a.DOSS_OWNER_ID  ='" . $_GET['TO_PERSON_ID'] . "'",
                                                    ];
                                                    $Non->DataNonti = $Non->M_ALERT_NOTIFICATION($fill);

                                                    //print_pre($Non->DataNonti);
                                                    ?>


                                                    <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                        <thead class="bg-primary">
                                                            <th class="text-center">ลำดับ</th>
                                                            <th class="text-center">วันที่</th>
                                                            <th class="text-center">รายละเอียดการเเจ้งเตือน</th>
                                                            <th class="text-center">เเจ้งเตือนมาจากระบบ</th>
                                                        </thead>
                                                        <?php
                                                        // $sql_alert = "SELECT *FROM M_ALERT_BANKRUPT  a  WHERE 1=1 AND a.SYSTEM_TYPE_RECEIVE ='BANKRUPT' AND a.DOSS_OWNER_ID  ='1341800061434'";
                                                        // $sql_alert = "SELECT *FROM M_ALERT_NOTIFICATION   a  WHERE 1=1 AND a.SYSTEM_TYPE_RECEIVE ='" . ConvertSystem_text($_GET['SEND_TO']) . "' ";
                                                        /* if ($_GET['SEND_TO'] != "") {
                                                        $Fill = "AND a.SYSTEM_TYPE_RECEIVE ='" . $_GET['SEND_TO'] . "' ";
                                                    } */
                                                        /*     if (!empty($_GET['TO_PERSON_ID'])) {
                                                        $Fill = "AND a.DOSS_OWNER_ID  ='" . $_GET['TO_PERSON_ID'] . "'";
                                                    } */
                                                        $A = 0;

                                                        if (count($Non->DataNonti) > 0) {
                                                            foreach ($Non->DataNonti as $key => $value) {
                                                                $A++;
                                                        ?>
                                                                <tr>
                                                                    <td>
                                                                        <div align='center'><?php echo $A; ?></div>
                                                                    </td>
                                                                    <td>
                                                                        <div><?php echo date_AK65($value['CREATE_DATE']); ?></div>
                                                                    </td>
                                                                    <td>
                                                                        <div><?php echo $value['NOTE']; ?></div>
                                                                    </td>
                                                                    <td>
                                                                        <div align='center'><?php echo (func::ConvertSystemToThai($value['SYSTEM_TYPE_SEND'])); ?></div>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td colspan="3" align="center">
                                                                    <div>ไม่พบข้อมูล</div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </table>
                                                    <div class="row">
                                                        <?php
                                                        echo $Non->endPaging("frm-input",$Non->Total_row); ?>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
    <?php
    include '../include/combottom_js_user.php';
    include '../include/combottom_user.php'; ?>