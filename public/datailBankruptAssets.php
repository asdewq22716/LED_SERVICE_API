<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "P";


include('../include/include.php');
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
        <input type="hidden" name="CODE_API" id="CODE_API" value="<?php echo $_GET['CODE_API']; ?>">
        <input type="hidden" name="ASSET_ID" id="ASSET_ID" value="<?php echo $_GET['ASSET_ID']; ?>">
        <?php
        class DatailBankruptAssets
        {
            public $code_api;
            public $asset_id;

            public $BankruptDataAssets;

            public $BankruptOwner;
            public $BankruptAssetMovement;

            public $showQ;

            public function BankruptDataAssets() //ข้อมูลทรัพย์ ชิ้นนั้น
            {

                $sql = "SELECT *
                    FROM WH_BANKRUPT_CASE_DETAIL a 
                    JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
                    WHERE 1=1 
                    AND a.BANKRUPT_CODE  ='" . $this->code_api . "' 
                    AND b.ASSET_ID ='" . $this->asset_id . "'";
                $query = db::query($sql);
                $rec = db::fetch_array($query);
                if (!empty($this->showQ)) {
                    return $sql;
                } else {
                    return $rec;
                }
            }

            public function BankruptOwner()
            {
                $sql = "SELECT b.ASSET_ID ,b.PROP_TITLE ,c.PER_FULLNAME AS FULL_NAME,c.RELATE_PROPERTY_NAME AS CONCERN_NAME,c.*
                FROM WH_BANKRUPT_ASSETS b 
                JOIN WH_BANKRUPT_ASSETS_OWNER c ON b.ASSET_ID =c.ASSET_ID 
                WHERE b.ASSET_ID ='" . $this->asset_id . "'";
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
            public function BankruptAssetMovement()
            {
                $sql = "SELECT b.BRA_ID_PK ,c.AST_START_DATE ,c.ASSET_STATUS_TYPE_NAME ,c.AST_REMARK ,c.AST_CREATE_DATE ,c.AST_UPDATER 
                FROM WH_BANKRUPT_CASE_DETAIL a 
                JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID =b.WH_BANKRUPT_ID 
                JOIN WH_BANKRUPT_ASSETS_MOVEMENT c ON b.BRA_ID_PK =c.AST_BRA_ID_FK
                WHERE 1=1
                AND a.BANKRUPT_CODE  ='" . $this->code_api . "' 
                AND b.ASSET_ID ='" . $this->asset_id . "'";
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
        }
        $Func = new DatailBankruptAssets();
        $Func->code_api = $_GET['CODE_API'];
        $Func->asset_id = $_GET['ASSET_ID'];
        $Func->showQ = "";
        $Func->BankruptDataAssets = $Func->BankruptDataAssets(); //ข้อมูลทรัพย์
        $Func->BankruptOwner = $Func->BankruptOwner(); //คนในทรัพย์
        $Func->BankruptAssetMovement = $Func->BankruptAssetMovement(); //สำนวนสาขา
        //print_pre($Func->BankruptDataAssets);
        //print_pre($Func->BankruptOwner);
        //print_pre($Func->BankruptAssetMovement);
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
                                                <b>ข้อมูลสำนวนกิจการและทรัพย์สิน</b>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="card-block">
                                        <!-- Row start -->
                                        <?php
                                        $arr_system = array(
                                            "1" => "ข้อมูลทรัพย์",
                                            "2" => "สำนวนสาขา",
                                            "3" => "ความเคลื่อนไหว",
                                        );
                                        $array_total = array( //จำนวนของmenu
                                            "1" => "",
                                            "2" => "",
                                            "3" => "",
                                        );
                                        tab::TabUiSub($arr_system, $array_total);
                                        ?>
                                        <!-- start -->
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <?php
                                            $k = 0;
                                            foreach ($arr_system as $sys => $sys_name) {
                                                $k++;
                                            ?>
                                                <div class="tab-pane <?php echo ($k == 1) ? 'active' : ''; ?>" id="<?php echo $sys; ?>">
                                                    <!-- Content of <?php echo $sys_name; ?> tab -->
                                                    <label for="<?php echo $sys; ?>" style="color: #A8164E; font-weight: bold;">
                                                        <h6><?php echo $sys_name; ?></h6>
                                                    </label>
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-md-2 text-right"><b>ประเภททรัพย์</b></div>
                                                            <div class="col-md-8 text-left"><?php echo $Func->BankruptDataAssets['TYPE_CODE_NAME']; ?></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2 text-right"><b>ชื่อทรัพย์</b></div>
                                                            <div class="col-md-8 text-left"><?php echo $Func->BankruptDataAssets['PROP_TITLE']; ?></div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if ($sys == '1') {
                                                    ?>
                                                        <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
                                                            <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                                                                <h4 style="color: #fff;">ผู้มีส่วนได้เสียในทรัพย์</h4>
                                                            </div>
                                                            <div class="card-body" style="padding: 10px 10px 10px 10px;">
                                                                <div class="row" style="margin:10px 5px 10px 5px;">
                                                                    <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th style="background-color: #dc3545;color: white;">ที่</th>
                                                                                <th style="background-color: #dc3545;color: white;">ชื่อตามสารบัญจดทะเบียนหลังโฉนด</th>
                                                                                <th style="background-color: #dc3545;color: white;">เลขประจำตัวประชาชน /เลขที่หนังสือเดินทาง /เลขทะเบียนนิติบุคคล</th>
                                                                                <th style="background-color: #dc3545;color: white;">ชื่อ</th>
                                                                                <th style="background-color: #dc3545;color: white;">ฐานะในคดี</th>
                                                                                <th style="background-color: #dc3545;color: white;">ความเกี่ยวข้องกับทรัพย์</th>
                                                                                <th style="background-color: #dc3545;color: white;">อัดราส่วนกรรมสิทธิ์/สัดส่วนจำนอง</th>
                                                                            </tr>
                                                                            <?php
                                                                            $i = 0;
                                                                            foreach ($Func->BankruptOwner() as $key => $value) {
                                                                                $i++;
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $i; ?></td>
                                                                                    <td><?php echo $value['COMPANY_NAME_IN_LANE_CODE']; ?></td>
                                                                                    <td><?php echo $value['PER_IDCARD']; ?></td>
                                                                                    <td><?php echo $value['FULL_NAME']; ?></td>
                                                                                    <td><?php echo "ขาด"; ?></td>
                                                                                    <td><?php echo $value['RELATE_PROPERTY_NAME']; ?></td>
                                                                                    <td><?php echo $value['BRP_RATIO_NAME']; ?></td>
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
                                                                <h4 style="color: #fff;">ราคาประเมินสำหรับการประกาศขายทอดตลาด</h4>
                                                            </div>
                                                            <div class="card-body" style="padding: 10px 10px 10px 10px;">
                                                                <div class="row" style="margin:10px 5px 10px 5px;">
                                                                    <div class="row">
                                                                        <div class="col-md-8 text-right"><label for="">ราคาประเมินของเจ้าพนักงานพิทักษ์ทรัพย์ (ปรับปรุงเพื่อกำหนดราคาขาย)</label></div>
                                                                        <div class="col-md-3 text-right"><?php echo number_format($Func->BankruptDataAssets['EST_ASSET_PRICE1'], 2); ?></div>
                                                                        <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-8 text-right"><label for="">ราคาประเมินของสำนักงานประเมินราคาทรัพย์สิน กรมธนารักษ์</label></div>
                                                                        <div class="col-md-3 text-right"><?php echo number_format($Func->BankruptDataAssets['EST_ASSET_PRICE2'], 2); ?></div>
                                                                        <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-8 text-right"><label for=""> ราคาประเมินของผู้เชี่ยวชาญการประเมินราคา</label></div>
                                                                        <div class="col-md-3 text-right"><?php echo number_format($Func->BankruptDataAssets['EST_ASSET_PRICE3'], 2); ?></div>
                                                                        <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-8 text-right"><label for="">ราคาประเมินของเจ้าพนักงานพิทักษ์ทรัพย์</label></div>
                                                                        <div class="col-md-3 text-right"><?php echo number_format($Func->BankruptDataAssets['EST_ASSET_PRICE4'], 2); ?></div>
                                                                        <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-8 text-right"><label for="">ราคาประเมินของเจ้าพนักงานประเมินราคา กรมบังคับคดี</label></div>
                                                                        <div class="col-md-3 text-right"><?php echo number_format($Func->BankruptDataAssets['EST_ASSET_PRICE5'], 2); ?></div>
                                                                        <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-8 text-right"><label for=""> ราคากำหนดโดยคณะกรรมการกำหนดราคาทรัพย์</label></div>
                                                                        <div class="col-md-3 text-right"><?php echo number_format($Func->BankruptDataAssets['EST_ASSET_PRICE6'], 2); ?></div>
                                                                        <div class="col-md-1 text-left"><label for="">บาท</label></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } else if ($sys == '2') { ?>
                                                        <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
                                                            <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                                                                <h4 style="color: #fff;">สำนวนสาขาที่เกี่ยวข้อง</h4>
                                                            </div>
                                                            <div class="card-body" style="padding: 10px 10px 10px 10px;">
                                                                <div class="row" style="margin:10px 5px 10px 5px;">
                                                                    <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                                        <thead class="thead-dark">
                                                                            <tr>

                                                                                <th style="background-color: #dc3545;color: white;">ที่</th>
                                                                                <th style="background-color: #dc3545;color: white;">วันที่บันทึกตั้งสำนวน</th>
                                                                                <th style="background-color: #dc3545;color: white;">ประเภทสำนวน</th>
                                                                                <th style="background-color: #dc3545;color: white;">เรื่อง</th>
                                                                                <th style="background-color: #dc3545;color: white;">เจ้าของสำนวน</th>
                                                                                <th style="background-color: #dc3545;color: white;">สถานะ</th>
                                                                            </tr>
                                                                            <?php
                                                                            $i = 0;
                                                                            foreach ($Func->BankruptAssetMovement() as $key => $value) {
                                                                                $i++;
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $i; ?></td>
                                                                                    <td><?php echo $value['COMPANY_NAME_IN_LANE_CODE']; ?></td>
                                                                                    <td><?php echo $value['PER_IDCARD']; ?></td>
                                                                                    <td><?php echo $value['FULL_NAME']; ?></td>
                                                                                    <td><?php echo "ขาด"; ?></td>
                                                                                    <td><?php echo $value['RELATE_PROPERTY_NAME']; ?></td>
                                                                                </tr>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </thead>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } else if ($sys == '3') { ?>
                                                        <div class="card text-white mb-3 " style="max-width:100%;margin: 15px 0px 15px 0px">
                                                            <div class="card-header" style="padding: 10px 10px 10px 10px;background-color: #A8164E ;">
                                                                <h4 style="color: #fff;">ความเคลื่อนไหวทรัพย์</h4>
                                                            </div>
                                                            <div class="card-body" style="padding: 10px 10px 10px 10px;">
                                                                <div class="row" style="margin:10px 5px 10px 5px;">
                                                                    <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                                        <thead class="thead-dark">
                                                                            <tr>


                                                                                <th style="background-color: #dc3545;color: white;">วันที่ดำเนินการ</th>
                                                                                <th style="background-color: #dc3545;color: white;">กิจกรรม</th>
                                                                                <th style="background-color: #dc3545;color: white;">หมายเหตุ</th>
                                                                                <th style="background-color: #dc3545;color: white;">วันที่บันทึก</th>
                                                                                <th style="background-color: #dc3545;color: white;">ผู้บันทึก</th>
                                                                                <th style="background-color: #dc3545;color: white;">แบบ</th>
                                                                            </tr>
                                                                            <?php
                                                                            $i = 0;
                                                                            foreach ($Func->BankruptAssetMovement() as $key => $value) {
                                                                                $i++;
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo date_AK65($value['AST_START_DATE']); ?></td>
                                                                                    <td><?php echo $value['ASSET_STATUS_TYPE_NAME']; ?></td>
                                                                                    <td><?php echo $value['AST_REMARK']; ?></td>
                                                                                    <td><?php echo date_AK65(date("Y-m-d",strtotime($value['AST_CREATE_DATE'])))." ".date("H:i:s",strtotime($value['AST_CREATE_DATE'])); ?></td>
                                                                                    <td><?php echo $value['AST_UPDATER']; ?></td>
                                                                                    <td><?php echo "ขาด"; ?></td>
                                                                                </tr>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </thead>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        tab::TabScript();
                                        ?>
                                        <!-- stop -->
                                        <!-- Row stop -->
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