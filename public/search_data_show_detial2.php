<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../include/comtop_user_N.php'; //connect db
include '../include/combottom_js_user.php'; //function 
include "../include/paging2.php";
include "../include/func_Nop.php";


$path = "../";

foreach ($_GET as $key => $val) {
    $$key = conText($val);
}
foreach ($_POST as $key => $val) {
    $$key = conText($val);
}
/* echo "<br><br><br><br><br>";
echo "<pre>";
print_r($_POST);
echo "</pre>"; */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/template_user.php'; ?>
</head>
<style>
    /* กำหนดสไตล์สำหรับ Pagination */
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 20px 0;
        justify-content: center;
    }

    /* กำหนดสไตล์สำหรับรายการหน้า */
    .pagination li {
        margin: 0 0px;
        display: flex;
    }

    /* กำหนดสไตล์สำหรับลิงค์ของหน้า */
    .pagination li a {
        text-decoration: none;
        color: #333;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    /* กำหนดสไตล์สำหรับลิงค์ของหน้า (เมื่อนอกเนื้อหาปัจจุบัน) */
    .pagination li a:hover {
        background-color: #f4f4f4;
    }

    /* กำหนดสไตล์สำหรับลิงค์ของหน้าปัจจุบัน */
    .pagination li.active a {
        background-color: #007bff;
        color: #fff;
    }
</style>
<style>
    .content-wrapper {
        margin-top: -20px;
        /* ปรับระยะห่างด้านบนของ content-wrapper ให้มีค่า 20px */
    }

    .show_hide_area:after {
        font-family: 'IcoFont' !important;
        content: "\eb25";
    }

    .show_hide_area.is-active:after {
        font-family: 'IcoFont' !important;
        content: "\eb28";
    }
</style>

<div class="content m-t-20">

    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <?php
        include "./btn_function.php";
        ?>
        <?php
        $SYSTEM_TYPE = convertSystem($_GET['SYSTEM_TYPE']); //แปลงชื่อ ตย. Mediate =>ไกล่เกลี่ย
        $WH_ID = $_GET['WH_ID'];
        $CODE_API = $_GET['CODE_API'];
        $IDCARD = $_GET['IDCARD'];
        if ($SYSTEM_TYPE == 1) { //เเพ่ง
            $sql_system = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,
                                a.RED_CASE,a.RED_YY, a.CIVIL_CODE AS WH_API,a.WH_CIVIL_ID AS WH_ID_MAIN, 
                            CASE
                                WHEN a.COURT_CODE='010030' THEN '050'
                                ELSE a.COURT_CODE
                            END AS COURT_CODE  
                            ,a.COURT_NAME,'1' as SYSTEM_ID
                            FROM WH_CIVIL_CASE a WHERE a.CIVIL_CODE ='" . $CODE_API . "'";
        } else if ($SYSTEM_TYPE == 2) { //ล้มละลาย
            $sql_system = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,
                                a.RED_CASE,a.RED_YY, a.BANKRUPT_CODE AS WH_API,a.WH_BANKRUPT_ID AS WH_ID_MAIN,
                            CASE
                                WHEN a.COURT_CODE='050' THEN '010030'
                                ELSE a.COURT_CODE
                            END AS COURT_CODE  
                            ,a.COURT_NAME,'2' as SYSTEM_ID
                           FROM WH_BANKRUPT_CASE_DETAIL a WHERE a.BANKRUPT_CODE='" . $CODE_API . "'";
        } else if ($SYSTEM_TYPE == 3) { //ฟื้นฟู
            $sql_system = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,
                                a.RED_CASE,a.RED_YY,a.REHAB_CODE AS WH_API,a.WH_REHAB_ID AS WH_ID_MAIN,
                            CASE
                                WHEN a.COURT_CODE='010030' THEN '050'
                                ELSE a.COURT_CODE
                            END AS COURT_CODE  
                            ,a.COURT_NAME  ,'3' as SYSTEM_ID,a.REHAB_CODE 
                            FROM WH_REHABILITATION_CASE_DETAIL a WHERE a.REHAB_CODE ='" . $CODE_API . "'";
        } else if ($SYSTEM_TYPE == 4) { //ไกล่เกลี่ย
            $sql_system = "SELECT a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,
                                a.RED_CASE,a.RED_YY,a.REF_WFR_ID AS WH_API,a.WH_MEDAITE_ID AS WH_ID_MAIN,
                            CASE
                                WHEN a.COURT_ID='010030' THEN 050
                                ELSE a.COURT_ID
                            END AS COURT_CODE  
                            ,a.COURT_NAME  ,'4' as SYSTEM_ID,a.REF_WFR_ID
                           FROM WH_MEDIATE_CASE a WHERE a.REF_WFR_ID ='" . $CODE_API . "'";
        }
        //echo $sql_system;
        $query_system = db::query($sql_system);
        $rec_WH = db::fetch_array($query_system);

        $btn = new Btn_function();
        $btn->systemType = $SYSTEM_TYPE;
        $btn->codeApi = $rec_WH['WH_API'];

        ?>

        <div class="col-sm-12" id="content">
            <form method="POST" action="./search_data_show_detial2.php" enctype="multipart/form-data" id="frm-input" name='frm-input'>
                <input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
                <input type="hidden" id="page_size" name="page_size" value="<?php echo $page_size; ?>">
                <input type="hidden" id="page2" name="page2" value="<?php echo $page2; ?>">
                <input type="hidden" id="page_size2" name="page_size2" value="<?php echo $page_size2; ?>">

                <input type="hidden" name="tkey" id="tkey" value="<?php echo $_SESSION['ss_smartcard_token']; ?>">
                <!-- การทำงาน start -->
                <div class="form-group row">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">
                                <?php
                                echo "<U>" . convertSystemThai($_GET['SYSTEM_TYPE']) . "</U>" . "<br>";
                                echo "เลขคดีดำ " . $rec_WH['PREFIX_BLACK_CASE'] . $rec_WH['BLACK_CASE'] . "/" . $rec_WH['BLACK_YY'] . "  " . "เลขคดีแดง " . $rec_WH['PREFIX_RED_CASE'] . $rec_WH['RED_CASE'] . "/" . $rec_WH['RED_YY'] . " (" . $rec_WH['COURT_NAME'] . ")";
                                ?>
                            </h5>
                        </div>
                        <div class="card-block">
                            <?php
                            $WFR = $rec_WH['REHAB_CODE'];
                            if ($SYSTEM_TYPE == '3' && $rec_WH['REHAB_CODE'] != "") { //ฟื้นฟู
                            ?><div class="link-button" style="text-align: right;">
                                    <a href="http://103.208.27.224/led_revive/workflow/workflow_view_service.php?W=288&WFR=<?PHP echo $rec_WH['REHAB_CODE']; ?>&WFD=1654&REVIVE_59=3" class="link-button">
                                        <button type="button" class="btn btn-info btn-mini"><i class="icofont icofont-search"></i>รายละเอียดเพิ่มเติม</button>
                                    </a>
                                </div>
                            <?php
                            }

                            if ($SYSTEM_TYPE == '4' && $rec_WH['REF_WFR_ID'] != "") { //ไกล่เกลี่ย
                                $result_array = explode('W', $rec_WH['REF_WFR_ID']);
                                $WFR = $result_array[0];  // 111
                                $W = $result_array[1];
                            ?><div class="link-button" style="text-align: right;">
                                    <a href="http://103.208.27.224/ega_led_mediate/workflow/workflow_view_service.php?W=<?php echo $W; ?>&WFR=<?PHP echo $WFR; ?>&WFD=97&MEDIATE=3" class="link-button">
                                        <button type="button" class="btn btn-info btn-mini"><i class="icofont icofont-search"></i>รายละเอียดเพิ่มเติม</button>
                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                            <?php /* คน start*/
                            show_person_table( //ทุกระบบใช้อันนี้
                                $rec_WH['WH_ID_MAIN'],
                                $IDCARD, //13หลักของบุคคที่ตรวจ
                                $SYSTEM_TYPE,
                                $WFR
                            );
                            /* คน stop*/
                            if ($SYSTEM_TYPE == 1) { 
                                //ทางเดินสำนวน
                                /* show_table_ROUTE(
                                            $rec_WH['PREFIX_BLACK_CASE'],
                                            $rec_WH['BLACK_CASE'],
                                            $rec_WH['BLACK_YY'],
                                            $rec_WH['PREFIX_RED_CASE'],
                                            $rec_WH['RED_CASE'],
                                            $rec_WH['RED_YY'],
                                            $rec_WH['COURT_CODE']
                                        ); */
                                tableRouteAsset(
                                    $rec_WH['PREFIX_BLACK_CASE'],
                                    $rec_WH['BLACK_CASE'],
                                    $rec_WH['BLACK_YY'],
                                    $rec_WH['PREFIX_RED_CASE'],
                                    $rec_WH['RED_CASE'],
                                    $rec_WH['RED_YY'],
                                    $rec_WH['COURT_CODE']
                                ); ?>
                            <?php
                            } else if ($SYSTEM_TYPE == 2) {
                                //รายการทรัพย์
                                /*  show_asset_table(
                                            $rec_WH['PREFIX_BLACK_CASE'],
                                            $rec_WH['BLACK_CASE'],
                                            $rec_WH['BLACK_YY'],
                                            $rec_WH['PREFIX_RED_CASE'],
                                            $rec_WH['RED_CASE'],
                                            $rec_WH['RED_YY'],
                                            $rec_WH['COURT_CODE'],
                                            $rec_WH['SYSTEM_ID'],
                                            $TARGET_ASSET
                                        ); */
                                $btn->BankruptAsset();//รายการทรัพย์
                                //คำสั่งศาล
                                /* Btn_function::showCourtLogBankrupt(
                                            $rec_WH['PREFIX_BLACK_CASE'],
                                            $rec_WH['BLACK_CASE'],
                                            $rec_WH['BLACK_YY'],
                                            $rec_WH['PREFIX_RED_CASE'],
                                            $rec_WH['RED_CASE'],
                                            $rec_WH['RED_YY']
                                        ); */
                                $btn->orderCourt();
                            } else if ($SYSTEM_TYPE == 4) { // สถานะคดีระบบไกล่เกลี่ย
                                showMediateResult($rec_WH['WH_ID_MAIN']);
                            }
                            ?>
                            <!-- ทางเดินสำนวน stop -->

                            <?php

                            /* if ($SYSTEM_TYPE == 2 && $_GET['SEND_TO'] == '1') { */
                            if ($SYSTEM_TYPE == "2") { //เเพ่งค้นหาคนล้ม
                                // Btn_function::BankruptCheck($CODE_API, $_GET['TARGET_IDCARD']);
                            } ?>
                        </div>
                    </div>
                </div>
                <div style="text-align: right; ">
                    <label for="" style="font-size: 12px;" onclick="update_api('<?php echo $rec_WH['WH_API']; ?>');">
                        <button type="button" class="btn btn-warning btn-mini"><?php echo $rec_WH['WH_API']; ?> อัพเดท...</button>
                    </label>

                </div>
            </form>
        </div>
        </body>

        <script>
            function update_api(api) {
                show_loading();
                var SYSTEM_TYPE = '<?php echo $_GET['SYSTEM_TYPE']; ?>'
                $.ajax({
                    url: './search_data_process_A.php',
                    type: "POST",
                    dataType: "html",
                    data: {
                        page: 'search_data_show_detial2',
                        SYSTEM_TYPE: SYSTEM_TYPE,
                        api: api
                    },
                    async: true,
                    success: function(data) {
                        location.reload();
                    },
                });


            }
        </script>