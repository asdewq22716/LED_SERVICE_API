<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "P";


include('../include/include.php');


include('../include/paging.php');
include "../include/paging2.php";
include '../include/func_Nop.php';
include "./btn_function.php";

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
//print_r_pre($_GET);
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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/template_user.php'; ?>
</head>

<!-- <body id="bsf_body" class="horizontal-fixed fixed">
    <div class="wrapper"></div> -->
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

<body id="bsf_body" class="">
    <form method="GET" action="./CivilRoute.php" enctype="multipart/form-data" id="frm-input">
        <!-- PAGE_CODE=123&=1103411005612&=4&=ALL&STATUS=SEARCH -->
        <!-- การตัดหน้า start -->
        <input type="hidden" id="page2" name="page2" value="<?php echo $_GET['page2']; ?>">
        <input type="hidden" id="page_size2" name="page_size2" value="<?php echo  empty($_GET['page_size2']) ? "10" : $_GET['page_size2']; ?>">
        <!-- การตัดหน้า end -->

        <input type="hidden" name="CODE_API" id="CODE_API" value="<?php echo $_GET['CODE_API']; ?>">
        <input type="hidden" name="DOC_COR_ID_FK" id="DOC_COR_ID_FK" value="<?php echo $_GET['DOC_COR_ID_FK']; ?>">
        <?php

        class BankruptOrderCourt
        {
            public $BRC_ID_PK;
            public $DOC_COR_ID_FK;
            public $A_COURT_LOG = [];
            public $PERSON_1 = [];
            public $PERSON_2 = [];
            public function COURT_LOG()
            {
                $sql = "SELECT a.RECEIPT_DOC,a.DOC_NUMBER ,a.DOC_DATE ,a.DOC_FROM_NAME ,a.DOT_NAME ,a.DOC_SUBJECT,a.*
                FROM WH_BANKRUPT_COURT_LOG a 
                WHERE a.BRC_ID_PK ='" . $this->BRC_ID_PK . "' AND a.DOC_COR_ID_FK ='" . $this->DOC_COR_ID_FK . "'";
                $query = db::query($sql);
                $rec = db::fetch_array($query);
                $this->A_COURT_LOG = $rec;
            }
            public function COURT_LOG_PERSON($ArrayFill)
            {
                $fill = "";
                foreach ($ArrayFill as $AA => $BB) {
                    $fill .= $BB;
                }
                $sql = "SELECT a.RECEIPT_DOC,a.DOC_NUMBER ,a.DOC_DATE ,a.DOC_FROM_NAME ,a.DOT_NAME ,a.DOC_SUBJECT,a.*,b.*
                FROM WH_BANKRUPT_COURT_LOG a 
                LEFT JOIN WH_BANKRUPT_COURT_LOG_PERSON b ON a.DOC_COR_ID_FK =b.DOC_COR_ID_FK 
                WHERE a.BRC_ID_PK ='" . $this->BRC_ID_PK . "' AND a.DOC_COR_ID_FK ='" . $this->DOC_COR_ID_FK . "'
                {$fill}
                ORDER BY DEFFENDANT_NO ASC";
                $query = db::query($sql);
                $ArrayData = [];
                while ($rec = db::fetch_array($query)) {
                    $ArrayData[] = $rec;
                }
                return $ArrayData;
            }
        }
        $BankR = new BankruptOrderCourt();
        $BankR->BRC_ID_PK = $_GET['CODE_API'];
        $BankR->DOC_COR_ID_FK = $_GET['DOC_COR_ID_FK'];
        $BankR->COURT_LOG();
        unset($fill);
        $fill = [
            "PRE_NAME" => " AND b.PRE_NAME='โจทก์'",
        ];
        $BankR->PERSON_1 = $BankR->COURT_LOG_PERSON($fill);
        unset($fill);
        $fill = [
            "PRE_NAME" => " AND b.PRE_NAME='จำเลย'",
        ];
        $BankR->PERSON_2 = $BankR->COURT_LOG_PERSON($fill);
        //print_pre($BankR->A_COURT_LOG);
        //print_pre($BankR->PERSON_1);
        //print_pre($BankR->PERSON_2);
        ?>

        <!--  <div class="wrapper"> -->
        <div class="content m-t-20">
            <!-- Container-fluid starts -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Row start -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <!-- Radio-Button start -->
                                    <div class="form-group">
                                        <div class="card-header">
                                            <h4 class="card-header-text">
                                                <b>ข้อมูลเอกสาร</b>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <!-- Row start -->
                                        <!-- ส่วนของทรัพย์ START -->
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-2 text-right"><b>เลขที่เอกสาร</b></div>
                                                <div class="col-md-2 text-center"><?php echo $BankR->A_COURT_LOG['DOC_NUMBER']; ?></div>
                                                <div class="col-md-2 text-right"><b>วันที่เอกสาร</b> </div>
                                                <div class="col-md-2 text-center"><?php echo date_AK65(date('Y-m-d', strtotime($BankR->A_COURT_LOG['DOC_DATE']))); ?></div>
                                                <div class="col-md-2 text-right"><b>สถานะดำเนินการ</b></div>
                                                <div class="col-md-2 text-center"><?php echo $BankR->A_COURT_LOG['DOC_STATUS_NAME']; ?></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 text-right"><b>คำสั่งศาล/คำพิพากษา</b></div>
                                                <div class="col-md-3 text-center"><?php echo $BankR->A_COURT_LOG['DOT_NAME']; ?></div>
                                                <div class="col-md-2 text-right"><b>จาก</b></div>
                                                <div class="col-md-3 text-center"><?php echo $BankR->A_COURT_LOG['DOC_FROM_NAME']; ?></div>
                                            </div>
                                            <?php if ($BankR->A_COURT_LOG['DOT_NAME'] == 'พิทักษ์ทรัพย์/จัดการทรัพย์มรดก') {
                                            ?>
                                                <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
                                                    <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                                                        <h4 style="color: #fff;">คำสั่งศาล/คำพิพากษา พิทักษ์ทรัพย์/จัดการทรัพย์มรดก</h4>
                                                    </div>
                                                    <div class="card-body" style="padding: 10px 10px 10px 10px;">
                                                        <div class="row">
                                                            <div class="col-md-2 text-right"><b>วันที่มีคำสั่ง*</b></div>
                                                            <div class="col-md-1 text-center"><?php echo date_AK65(date('Y-m-d', strtotime($BankR->A_COURT_LOG['COR_ORDER_DATE']))); ?></div>
                                                            <div class="col-md-2 text-right"><b>วันที่ยื่นฟ้อง*</b></div>
                                                            <div class="col-md-1 text-center"><?php echo date_AK65(date('Y-m-d', strtotime($BankR->A_COURT_LOG['BRC_LODGE_DATE']))); ?></div>
                                                            <div class="col-md-2 text-right"><b>จำนวนทุนทรัพย์*</b></div>
                                                            <div class="col-md-2 text-center"><?php echo number_format($BankR->A_COURT_LOG['BRC_PROPERTY_NUM'], 2); ?></div>
                                                            <div class="col-md-1 text-right"><b>บาท</b></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
                                                    <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                                                        <h4 style="color: #fff;">โจทก์</h4>
                                                    </div>
                                                    <div class="card-body" style="padding: 10px 10px 10px 10px;">
                                                        <div class="row" style="margin:10px 5px 10px 5px;">
                                                            <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th style="background-color: #dc3545;color: white;">ที่</th>
                                                                        <th style="background-color: #dc3545;color: white;">ชื่อ</th>
                                                                        <th style="background-color: #dc3545;color: white;">ประเภท</th>
                                                                    </tr>
                                                                    <?php
                                                                    foreach ($BankR->PERSON_1 as $key => $value) {
                                                                    ?>
                                                                        <tr>
                                                                            <td class="text-center"><?php echo $value['DEFFENDANT_NO']; ?></td>
                                                                            <td><?php echo $value['DEFFENDANT_NAME']; ?></td>
                                                                            <td><?php echo $value['PRE_NAME']; ?></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
                                                    <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                                                        <h4 style="color: #fff;">จำเลย</h4>
                                                    </div>
                                                    <div class="card-body" style="padding: 10px 10px 10px 10px;">
                                                        <div class="row" style="margin:10px 5px 10px 5px;">
                                                            <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th style="background-color: #dc3545;color: white;">ประเภทจำเลย</th>
                                                                        <th style="background-color: #dc3545;color: white;">ที่</th>
                                                                        <th style="background-color: #dc3545;color: white;">เลขประจำตัวประชาชน/พาสปอร์ต/เลขทะเบียนนิติบุคคล</th>
                                                                        <th style="background-color: #dc3545;color: white;">ชื่อ</th>
                                                                        <th style="background-color: #dc3545;color: white;">อาชีพ</th>
                                                                        <th style="background-color: #dc3545;color: white;">คำสั่งศาล</th>
                                                                        <th style="background-color: #dc3545;color: white;">วันที่ศาลสั่ง</th>
                                                                    </tr>
                                                                    <?php
                                                                    foreach ($BankR->PERSON_2 as $key => $value) {
                                                                    ?>
                                                                        <tr>
                                                                            <td width="10%"><?php echo $value['PRE_NAME']; ?></td>
                                                                            <td class="text-center" width="5%"><?php echo $value['DEFFENDANT_NO']; ?></td>
                                                                            <td width="10%"><?php echo $value['DEFFENDANT_REG_NO']; ?></td>
                                                                            <td width="15%"><?php echo $value['DEFFENDANT_NAME']; ?></td>
                                                                            <td width="15%"><?php echo $value['OCC_NAME']; ?></td>
                                                                            <td width="15%"><?php echo $value['COT_NAME']; ?></td>
                                                                            <td width="15%"><?php echo date_AK65(date('Y-m-d', strtotime($value['COR_ORDER_DATE']))); ?></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                            //พิพากษาล้มละลาย start
                                            else if ($BankR->A_COURT_LOG['DOT_NAME'] == "พิพากษาล้มละลาย") { ?>
                                                <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
                                                    <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                                                        <h4 style="color: #fff;">คำสั่งศาล/คำพิพากษา พิทักษ์ทรัพย์/จัดการทรัพย์มรดก</h4>
                                                    </div>
                                                    <div class="card-body" style="padding: 10px 10px 10px 10px;">
                                                        <div class="row">
                                                            <div class="col-md-2 text-right"><b>วันที่มีคำสั่ง*</b></div>
                                                            <div class="col-md-2 text-center"><?php echo date_AK65(date('Y-m-d', strtotime($BankR->A_COURT_LOG['COR_ORDER_DATE']))); ?></div>
                                                        </div>
                                                        <div class="row" style="margin:10px 5px 10px 5px;">
                                                            <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th style="background-color: #dc3545;color: white;">จำเลยที่</th>
                                                                        <th style="background-color: #dc3545;color: white;">เลขประจำตัวประชาชน/พาสปอร์ต/เลขทะเบียนนิติบุคคล</th>
                                                                        <th style="background-color: #dc3545;color: white;">ชื่อ</th>
                                                                        <th style="background-color: #dc3545;color: white;">ล้มละลายครั้งที่</th>
                                                                        <th style="background-color: #dc3545;color: white;">กำหนดนัดไต่สวนเปิดเผย</th>
                                                                        <th style="background-color: #dc3545;color: white;">กำหนดนัดพิจารณาคำขอประนอมหนี้</th>
                                                                    </tr>
                                                                    <?php
                                                                    foreach ($BankR->PERSON_2 as $key => $value) {
                                                                        if (!empty($value['APP_DATE1'])) {
                                                                            $APP_DATE1 = "วันที่ " . date_AK65(date('Y-m-d', strtotime($value['APP_DATE1']))) . " เวลา " . $value['APP_TIME1'] . "น." . $value['DOC_FROM_NAME'];
                                                                        } else {
                                                                            $APP_DATE1 = "(ไม่ระบุ)";
                                                                        }

                                                                        if (!empty($value['APP_DATE2'])) {
                                                                            $APP_DATE2 = "วันที่ " . date_AK65(date('Y-m-d', strtotime($value['APP_DATE2']))) . " เวลา " . $value['APP_TIME2'] . "น." . $value['DOC_FROM_NAME'];
                                                                        } else {
                                                                            $APP_DATE2 = "(ไม่ระบุ)";
                                                                        }
                                                                    ?>
                                                                        <tr>
                                                                            <td width="5%"><?php echo $value['DEFFENDANT_NO']; ?></td>
                                                                            <td width="10%"><?php echo $value['DEFFENDANT_REG_NO']; ?></td>
                                                                            <td width="20%"><?php echo $value['DEFFENDANT_NAME']; ?></td>
                                                                            <td width="5%"><?php echo $value['BANKRUPT_NO']; ?></td>
                                                                            <td width="15%"><?php echo $APP_DATE1; ?></td>
                                                                            <td width="15%"><?php echo $APP_DATE2; ?></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } //พิพากษาล้มละลาย start 
                                            ?>

                                        </div>
                                        <!-- ส่วนของทรัพย์ END -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
    <script>

    </script>
    <?php
    include '../include/combottom_js_user.php';
    include '../include/combottom_user.php'; ?>