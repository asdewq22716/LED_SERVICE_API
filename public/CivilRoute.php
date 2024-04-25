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
        <input type="hidden" name="civilCode" id="civilCode" value="<?php echo $_GET['civilCode']; ?>">
        <input type="hidden" name="deptCode" id="deptCode" value="<?php echo $_GET['deptCode']; ?>">
        <input type="hidden" name="controlGen" id="controlGen" value="<?php echo $_GET['controlGen']; ?>">


        <?php
        /* echo "_GET";
        print_pre($_GET);
        echo "_POST";
        print_pre($_POST); */
        class CivilRoute extends Paging
        {
            //ตัวแปรที่ต้องใช้
            public $CIVIL_CODE;
            public $DOSS_DEPT_CODE;
            public $DOSS_CONTROL_GEN;

            //ข้อมูลเก็บมาจากDB
            public $Data_ASSETS;
            public $DATA_CIVIL_ROUTE;

            public $Total_ASSETS;
            public $Total_DATA_CIVIL_ROUTE;
            public $showQ;
            public function getDossControlGen()
            {
                $sql = "SELECT b.DOSS_CONTROL_GEN 
                            FROM WH_CIVIL_CASE a
                            JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID = b.WH_CIVIL_ID
                            WHERE 1 = 1
                            AND a.CIVIL_CODE = '" . $this->CIVIL_CODE . "'
                            AND b.DOSS_DEPT_CODE = '" .  $this->DOSS_DEPT_CODE . "'
                            AND b.DOSS_CONTROL_GEN = '" .  $this->DOSS_CONTROL_GEN . "'";
                $query = db::query($sql);
                $rec = db::fetch_array($query);
                return $rec['DOSS_CONTROL_GEN'];
            }

            public function WH_CIVIL_CASE_ASSETS()
            {
                $sql = "SELECT *FROM WH_CIVIL_CASE_ASSETS a 
                        WHERE a.DOSS_CONTROL_GEN ='" . $this->getDossControlGen() . "'";
                //สำหรับ paging
                $this->Total_ASSETS = db::num_rows(db::query($sql));
                $sql_rownum = $this->ROWNUM($sql);
                $query = db::query($sql_rownum);
                while ($rec = db::fetch_array($query)) {
                    $Array[] = $rec;
                }
                if (!empty($this->showQ)) {
                    return $sql;
                } else {
                    return $Array;
                }
            }

            public function Owner_ASSET($ArrayFill)
            {
                $fill = "";
                foreach ($ArrayFill as $AA => $BB) {
                    $fill .= $BB;
                }
                $sql = "SELECT *FROM WH_CIVIL_CASE_ASSET_OWNER b 
                JOIN " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " c ON b.WH_CIVIL_ID =c.WH_CIVIL_ID AND b.PERSON_NAME =c.FULL_NAME 
                WHERE 1=1 {$fill}";
                $query = db::query($sql);
                while ($rec = db::fetch_array($query)) {
                    $Array[] = $rec;
                }
                if (!empty($this->showQ)) {
                    return $sql;
                } else {
                    return $Array;
                }
            }

            public function WH_CIVIL_ROUTE()
            {
                $sql = "SELECT *
                FROM WH_CIVIL_CASE a 
                JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                INNER JOIN WH_CIVIL_ROUTE c ON b.DOSS_CONTROL_GEN = c.DOSS_CONTROL_GEN
                WHERE 1=1
                AND a.CIVIL_CODE ='" . $this->CIVIL_CODE . "' 
                AND b.DOSS_DEPT_CODE ='" . $this->DOSS_DEPT_CODE . "'
                AND b.DOSS_CONTROL_GEN ='" . $this->DOSS_CONTROL_GEN . "'
                ORDER BY  c.CREATE_DATE ASC,c.CREATE_TIME ASC ";
                //สำหรับ paging
                $this->Total_DATA_CIVIL_ROUTE = db::num_rows(db::query($sql));
                $sql_rownum = $this->ROWNUM($sql);
                $query = db::query($sql_rownum);
                $ArrayData = [];
                while ($rec = db::fetch_array($query)) {
                    $ArrayData[] = $rec;
                }
                if (!empty($this->showQ)) {
                    return $sql_rownum;
                } else {
                    return $ArrayData;
                }
            }
        }


        //ของ ทางเดินสำนวน
        $Func_Asset = new CivilRoute();
        $Func_Asset->showQ = "";
        $Func_Asset->CIVIL_CODE = $_GET['civilCode'];
        $Func_Asset->DOSS_DEPT_CODE = $_GET['deptCode'];
        $Func_Asset->DOSS_CONTROL_GEN = $_GET['controlGen'];
        //extend Class Paging เข้า class ที่ต้องการ
        unset($Array);
        $Array = [
            "name_page" => "page_Asset", //หน้าที่เเสดง
            "name_page_size" => "page_size_Asset", //จำนวนrowที่ต้องเเสดง
            "stylePage" => "Y", //สำหรับหน้าที่Bootstarpชนให้ใส่ Y
        ];
        $Func_Asset->ControllerPaging($Array);
        $Func_Asset->__GET_PAGE($_GET[$Func_Asset->name_page], $_GET[$Func_Asset->name_page_size], '5');
        $Func_Asset->Data_ASSETS = $Func_Asset->WH_CIVIL_CASE_ASSETS();


        //ของ ทางเดินสำนวน
        $Func = new CivilRoute();
        $Func->showQ = "";
        $Func->CIVIL_CODE = $_GET['civilCode'];
        $Func->DOSS_DEPT_CODE = $_GET['deptCode'];
        $Func->DOSS_CONTROL_GEN = $_GET['controlGen'];
        //extend Class Paging เข้า class ที่ต้องการ
        unset($Array);
        $Array = [
            "name_page" => "page_rount", //หน้าที่เเสดง
            "name_page_size" => "page_size_rount", //จำนวนrowที่ต้องเเสดง
            "stylePage" => "Y", //สำหรับหน้าที่Bootstarpชนให้ใส่ Y
        ];
        $Func->ControllerPaging($Array);
        $Func->__GET_PAGE($_GET[$Func->name_page], $_GET[$Func->name_page_size], '5');
        $Func->DATA_CIVIL_ROUTE = $Func->WH_CIVIL_ROUTE();

        //print_pre($Func->Data_ASSETS);
        //print_pre($Func->DATA_CIVIL_ROUTE);

        ?>

        <div class="wrapper">
            <?php
            //  include '../include/combottom_js_user.php'; //function 

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
                                        <!-- Radio-Button start -->
                                        <div class="card-block">
                                            <!-- Row start -->
                                            <!-- ส่วนของทรัพย์ START -->
                                            <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
                                                <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                                                    <h4 style="color: #fff;">รายการทรัพย์</h4>
                                                </div>
                                                <div class="card-body" style="padding: 10px 10px 10px 10px;">
                                                    <div class="row" style="margin:10px 5px 10px 5px;">
                                                        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th style="background-color: #dc3545;color: white;" width='5%'>ลำดับรายการทรัพย์</th>
                                                                    <th style="background-color: #dc3545;color: white;" width='15%'>ชื่อรายการทรัพย์</th>
                                                                    <th style="background-color: #dc3545;color: white;" width='5%'>สถานะ</th>
                                                                    <th style="background-color: #dc3545;color: white;" width='25%'>ราคา</th>
                                                                    <th style="background-color: #dc3545;color: white;" width='20%'>เกี่ยวข้องเป็น</th>
                                                                </tr>
                                                            </thead>
                                                            <?php
                                                            $T = 0;
                                                            foreach ($Func_Asset->Data_ASSETS as $key => $value) {
                                                                $T++;
                                                            ?>
                                                                <tr style="background-color: #fff;">
                                                                    <td>
                                                                        <div align="center"><?php echo $T; ?></div>
                                                                    </td>
                                                                    <td><a onclick="show_asset_detail(<?php echo $value['ASSET_ID']; ?>)" href="javascript:void();"><?php echo $value["PROP_TITLE"]; ?></a></td>
                                                                    <td> <?php echo $value['PROP_STATUS_NAME']; ?></td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <div class="col-md-6 text-right"><label for="">ราคาประเมินของสำนักงานวางทรัพย์ (ราคาประเมินของสำนักงานวางทรัพย์กลาง)</label></div>
                                                                                <div class="col-md-5 text-right"><?php echo number_format($value['EST_VANG_SUB'], 2); ?></div>
                                                                                <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-6 text-right"><label for="">ราคาประเมินของคณะกรรมการกำหนดราคา (ราคาที่กำหนดโดยคณะกรรมการกำหนดราคาทรัพย์)</label></div>
                                                                                <div class="col-md-5 text-right"><?php echo number_format($value['EST_GROUP_AMOUNT'], 2); ?></div>
                                                                                <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-6 text-right"><label for=""> ราคาประเมินของคณะอณุกรรมการกำหนดราคา (ราคาประเมินของเจ้าหนี้ตามคำพิพากษา เจ้าของทรัพย์ ผู้รับจำนำ หรือผู้รับจำนอง)</label></div>
                                                                                <div class="col-md-5 text-right"><?php echo number_format($value['EST_SUB_AMOUNT'], 2); ?></div>
                                                                                <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-6 text-right"><label for="">ราคาประเมินของเจ้าพนักงานกรมที่ดิน (ราคาประเมินของสำนักประเมินราคาทรัพย์สิน กรมธนารักษ์)</label></div>
                                                                                <div class="col-md-5 text-right"><?php echo number_format($value['EST_DOL'], 2); ?></div>
                                                                                <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-6 text-right"><label for="">ราคาประเมิน สรุปที่ระบบจะนำไปใช้</label></div>
                                                                                <div class="col-md-5 text-right"><?php echo number_format($value['EST_PRICE_AMOUNT'], 2); ?></div>
                                                                                <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-6 text-right"><label for=""> ราคาขายได้</label></div>
                                                                                <div class="col-md-5 text-right"><?php echo number_format($value['SALE_PRICE'], 2); ?></div>
                                                                                <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <table>
                                                                            <?php
                                                                            unset($OWNER);
                                                                            unset($ArOwner);
                                                                            $ArOwner = [
                                                                                "ASSET_ID" => "AND b.ASSET_ID ='" . $value['ASSET_ID'] . "'",
                                                                            ];
                                                                            $OWNER = $Func_Asset->Owner_ASSET($ArOwner);
                                                                            foreach ($OWNER as $key => $value) {
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $value['FULL_NAME']; ?></td>
                                                                                    <td><?php echo $value['CONCERN_NAME']; ?></td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </table>
                                                    </div>
                                                    <div class="row">
                                                        <?php echo $Func_Asset->endPaging("frm-input", $Func_Asset->Total_ASSETS); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ส่วนของทรัพย์ END -->

                                            <!-- ทางเดินสำนวน START -->
                                            <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
                                                <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                                                    <h4 style="color: #fff;">ทางเดินสำนวน</h4>
                                                </div>
                                                <div class="card-body" style="padding: 10px 10px 10px 10px;">
                                                    <div class="row" style="margin:10px 5px 10px 5px;">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="tab-content tabs">
                                                                    <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th style="background-color: #dc3545;color: white;" width="10%">ลำดับ</th>
                                                                                <th style="background-color: #dc3545;color: white;" width="10%">วันที่ดำเนินการ</th>
                                                                                <th style="background-color: #dc3545;color: white;" width="10%">เวลา</th>
                                                                                <th style="background-color: #dc3545;color: white;" width="10%">รหัสบัญชี</th>
                                                                                <th style="background-color: #dc3545;color: white;" width="20%">รายการ</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <?php
                                                                        $n_R = 0;
                                                                        if (count($Func->DATA_CIVIL_ROUTE) > 0) {
                                                                            foreach ($Func->DATA_CIVIL_ROUTE as $key => $recR) {
                                                                                $n_R++;
                                                                        ?>
                                                                                <tr style="background-color: #fff;">
                                                                                    <td>
                                                                                        <div align='center'><?php echo $n_R; ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div><?php echo date_AK65(date("Y-m-d", strtotime($recR['CREATE_DATE']))); ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div><?php echo $recR['CREATE_TIME'] == '00:00:00' ? "" : $recR['CREATE_TIME']; ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div><?php echo $recR['ACCOUNT_NO']; ?></div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div><?php echo $recR['ACT_DESC']; ?></div>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <tr>
                                                                                <td>ไม่พบข้อมูล</td>
                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                                <div class="row">
                                                                    <?php echo $Func->endPaging("frm-input", $Func->Total_DATA_CIVIL_ROUTE); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ทางเดินสำนวน END -->
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
        function action_from(sh1, prefixBlackCase, blackCase, blackYy, prefixRedCase, redCase, redYy, CourtCode, REGISTER_CODE) {

            let SEND_TO = '<?php echo $_GET['SEND_TO']; ?>'
            let PCC_CIVIL_GEN = '<?php echo $_GET['PCC_CIVIL_GEN']; ?>'
            let brcID = '<?php echo $_GET['brcID']; ?>'
            let WFR_API = '<?php echo $_GET['WFR_API']; ?>'
            let url = "./cmd_add_from.php?";
            if (SEND_TO == '1') { //เเพ่ง
                url += "&SEND_FROM=" + 'CIVIL'; //ส่งเพื่อเข้าif
                url += "&PCC_CIVIL_GEN=" + PCC_CIVIL_GEN;
            }
            if (SEND_TO == '2') { //ล้มละลาย
                url += "&SEND_FROM=" + 'BANKRUPT'; //ส่งเพื่อเข้าif
                url += "&brcID=" + brcID;
            }
            if (SEND_TO == '3') { //ฟื้นฟู
                url += "&SEND_FROM=" + 'REVIVE'; //ส่งเพื่อเข้าif
                url += "&WFR_API=" + WFR_API;
            }
            if (SEND_TO == '4') { //ไกล่เกลี่ย
                url += "&SEND_FROM=" + 'MEDIATE'; //ส่งเพื่อเข้าif
                url += "&WFR_API=" + WFR_API;
            }

            url += "&receive_case=" + sh1;

            url += "&receive_prefixBlackCase=" + prefixBlackCase;
            url += "&receive_blackCase=" + blackCase;
            url += "&receive_blackYy=" + blackYy;

            url += "&receive_prefixRedCase=" + prefixRedCase;
            url += "&receive_redCase=" + redCase;
            url += "&receive_redYy=" + redYy;

            url += "&receive_CourtCode=" + CourtCode;

            url += "&TO_PERSON_ID=" + '<?php echo $_GET['TO_PERSON_ID']; ?>'
            url += "&proc=" + 'search_data_add';
            url += "&REGISTER_CODE=" + REGISTER_CODE; // มี2สถานะ 1 สอบถามความประส่ง เเละค่าว่างคือเลือกได้หมด
            // window.location.href = url;
            window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
            //$('#frm-input').attr('action', './cmd_add_from.php').submit();
        }
    </script>
    <?php
    include '../include/combottom_js_user.php';
    include '../include/combottom_user.php'; ?>