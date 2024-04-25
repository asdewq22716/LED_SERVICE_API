<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 'On'); */

include '../include/comtop_user_N.php'; //connect db

include '../include/combottom_js_user.php'; //function 

include "../include/func_Nop.php";

include "./btn_function.php";

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

<div class="content m-t-20">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <?php
        /* php start */
        $PREFIX_BLACK_CASE = $_GET['PREFIX_BLACK_CASE'];
        $BLACK_CASE = $_GET['BLACK_CASE'];
        $BLACK_YY = $_GET['BLACK_YY'];
        $PREFIX_RED_CASE = $_GET['PREFIX_RED_CASE'];
        $RED_CASE = $_GET['RED_CASE'];
        $RED_YY = $_GET['RED_YY'];
        $COURT_CODE = $_GET['COURT_CODE'];
        $SYSTEM_ID = $_GET['SYSTEM_ID'];
        $REGISTER_CODE = $_GET['REGISTER_CODE'];
        $SYSTEM_TYPE = $_GET['SYSTEM_TYPE']; //จากระบบใหน

        $queryCOURT = db::query("SELECT*FROM M_COURT a  WHERE a.COURT_CODE ='" . $_GET['COURT_CODE'] . "'");
        $recCOURT = db::fetch_array($queryCOURT);
        /* php stop */
        ?>

        <div class="col-sm-12" id="content">
            <form method="POST" action="./search_data_show_detial.php" enctype="multipart/form-data" id="frm-input" name='frm-input'>
                <input type="hidden" id="page" name="page" value="<?php echo $page; ?>">
                <input type="hidden" id="page_size" name="page_size" value="<?php echo $page_size; ?>">
                <!-- การทำงาน start -->
                <div class="form-group row">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">
                                <?php echo "เลขคดีดำ " . $_GET['PREFIX_BLACK_CASE'] . $_GET['BLACK_CASE'] . "/" . $_GET['BLACK_YY'] . "  " . "เลขคดีแดง " . $_GET['PREFIX_RED_CASE'] . $_GET['RED_CASE'] . "/" . $_GET['RED_YY'];
                                if ($recCOURT['COURT_NAME'] != "") {
                                    echo " (" . $recCOURT['COURT_NAME'] . ")";
                                }
                                ?>
                            </h5>
                        </div>
                        <div class="card-block">
                            <div class="row " class="col-md-12">
                                <div class="col-xs-12 col-sm-3">
                                    <h6>บุคคลที่เกี่ยวข้อง</h6>
                                </div>
                                <div class="col-xs-12 col-sm-2"></div>
                            </div>
                            <?php /* คน start*/
                            show_person_table(
                                $_GET['PREFIX_BLACK_CASE'],
                                $_GET['BLACK_CASE'],
                                $_GET['BLACK_YY'],
                                $_GET['PREFIX_RED_CASE'],
                                $_GET['RED_CASE'],
                                $_GET['RED_YY'],
                                $_GET['COURT_CODE']
                            );
                            /* คน stop*/ ?>

                            <div class="row " class="col-md-12">
                                <div class="col-xs-12 col-sm-2">
                                    <h6>รายการทรัพย์</h6>
                                </div>
                                <div class="col-xs-12 col-sm-2"></div>

                                <?php /* ทรัพ start*/
                                show_asset_table(
                                    $_GET['PREFIX_BLACK_CASE'],
                                    $_GET['BLACK_CASE'],
                                    $_GET['BLACK_YY'],
                                    $_GET['PREFIX_RED_CASE'],
                                    $_GET['RED_CASE'],
                                    $_GET['RED_YY'],
                                    $_GET['COURT_CODE'],
                                    $_GET['SYSTEM_ID']
                                );
                                /* ทรัพ stop*/ ?>
                            </div>
                            <div class="row " class="col-md-12">
                                <div class="col-xs-12 col-sm-2">
                                    <h6>ทางเดินสำนวน</h6>
                                </div>

                                <!-- ทางเดินสำนวน start -->
                                <?php
                                show_table_ROUTE(
                                    $_GET['PREFIX_BLACK_CASE'],
                                    $_GET['BLACK_CASE'],
                                    $_GET['BLACK_YY'],
                                    $_GET['PREFIX_RED_CASE'],
                                    $_GET['RED_CASE'],
                                    $_GET['RED_YY'],
                                    $_GET['COURT_CODE']
                                );
                                ?>
                                <!-- ทางเดินสำนวน stop -->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- การทำงาน stop -->
        </form>
    </div>
    </body>