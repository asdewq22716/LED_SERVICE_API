<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "P";
include('../include/include.php');
include('../include/paging.php');

if ($_GET['process'] == 'export') {
    function chk_length($leng, $text = "0", $txt = "")
    {
        $data = "";
        if ($leng < 0) {
            $data = mb_substr($txt, 0, 100);
        } else {
            for ($i = 0; $i <= $leng; $i++) {
                $data .= $text;
            }
            $data = $txt . mb_substr($data, 0, $leng);
        }
        return $data;
    }


    $response = api_request('http://103.40.146.73/LedLaw.php/reportAud7r298', '', array(
        "centDeptGen" => $_GET['centDeptGen'],
        "chqDateMin" => date2db($_GET['chqDateMin']),
        "chqDateMax" => date2db($_GET['chqDateMax']),
        "paidType" => $_GET['paidType'],
        'filterType' => $_GET['filterType']
    ));

    foreach ($response['Data'] as $r_payroll) {
        $row_num++;
        $PAYROLL_MONEY = $r_payroll['totalAmount'];
        $sumMoney += $PAYROLL_MONEY;
        $ReceivingAC = $r_payroll['receivingacr'];
        $ReceivingBranchCode = $r_payroll['receivingbranchr'];
        $ReceivingBank = $r_payroll['receivingbankr'];
        $SendingBankCode = $r_payroll['sendingbankcoder'];
        $SendingBranchCode = $r_payroll['sendingbranchcoder'];
        $SendingAC = $r_payroll['sendingacr'];
        $EffectiveDate = $r_payroll['effectivedater'];
        $ServiceType = '01';
        $ClearingHouseCode = '01';
        $Amount = sprintf("%017d", str_replace([',', '.'], '', number_format($PAYROLL_MONEY, 2)));
        $ReceiverInfo = chk_length(8, "0", "");
        $ReceiverID  = chk_length(10, "0", "");
        $ReceiverName  = $r_payroll['receivernamer'];
        $SenderName  = $r_payroll['sendernamer']; // ชื่อบัญชี
        $OtherInfo1  = chk_length(40, "0", "");
        $DDARef1  = "  ";
        $ReserveField = chk_length(18, "0", "");
        $RefNo  = "  ";
        $OtherInfo2   = chk_length(20, "0", "");
        $RefRunningNumber  = "000001";
        $Status  = "09";
        $EmailAddress  = chk_length(40 - mb_strlen($r_payroll['email']), 0, $r_payroll['email']);
        $SMS  = chk_length(20, "0", "");
        $ReceivingSubBranchCode  = chk_length(4, "0", "");
        $Fillers  = chk_length(34, "0", "");
        $CarriageReturnLineFeed = chr(13);

        $obj = array();
        $obj[1] = '10';
        $obj[2] = '2';
        $obj[3] = '000001';
        $obj[4] = $ReceivingBank;
        $obj[5] = $ReceivingBranchCode;
        $obj[6] = $ReceivingAC;
        $obj[7] = $SendingBankCode;
        $obj[8] = $SendingBranchCode;
        $obj[9] = $SendingAC;
        $obj[10] = $EffectiveDate;
        $obj[11] = $ServiceType;
        $obj[12] = $ClearingHouseCode;
        $obj[13] = $Amount;
        $obj[14] = $ReceiverInfo;
        $obj[15] = $ReceiverID;
        $obj[16] = $ReceiverName;
        $obj[17] = $SenderName;
        $obj[18] = $OtherInfo1;
        $obj[19] = $DDARef1;
        $obj[20] = $ReserveField;
        $obj[21] = $RefNo;
        $obj[22] = $ReserveField;
        $obj[23] = $OtherInfo2;
        $obj[24] = $RefRunningNumber;
        $obj[25] = $Status;
        $obj[26] = $EmailAddress;
        $obj[27] = $SMS;
        $obj[28] = $ReceivingSubBranchCode;
        $obj[29] = $Fillers;
        $obj[30] = $CarriageReturnLineFeed;

        $detailRecord[] = $obj;

        //var_dump($obj);exit;
    }

    $txtDetail = "";
    foreach ($detailRecord as $key => $val) {
        foreach ($detailRecord[$key] as $k => $v) {
            $txtDetail .= $v;
        }
    }

    $row_num = sprintf("%07d", $row_num);
    $sumMoney = sprintf("%019d", str_replace([',', '.'], '', number_format($sumMoney, 2)));
    $batchRecord[1] = '10';
    $batchRecord[2] = '1';
    $batchRecord[3] = '000001';
    $batchRecord[4] = '006';
    $batchRecord[5] = $row_num;
    $batchRecord[6] = $sumMoney;
    $batchRecord[7] = $EffectiveDate;
    $batchRecord[8] = 'D';
    $batchRecord[9] = chk_length(8, '0');
    $batchRecord[10] = chk_length(16, '0');
    $batchRecord[11] = chk_length(20, '0');
    $batchRecord[12] = chk_length(407, '0');
    $batchRecord[13] = chr(13);;


    $txtBatch = "";
    foreach ($batchRecord as $key => $val) {
        $txtBatch .= $val;
    }


    $random = date('His'); //rand(0, 99);
    $txt = $txtBatch . $txtDetail;
    $strFileName = 'Export_KTBiPay' . $EffectiveDate . '_' . $random . '.txt';
    if (file_exists($attach_folder . $strFileName)) {
        unlink($attach_folder . $strFileName);
    }

    $objFopen = fopen($attach_folder . $strFileName, 'a+') or die("Unable to open file!");
    fwrite($objFopen, $txt);
    fclose($objFopen);

    header("Content-disposition: attachment; filename=\"" . $strFileName . "\"");
    header("Content-Transfer-Encoding: Binary");
    header("Content-Type: application/force-download");
    header('Content-Type: application/octet-stream');
    header("Content-Type: application/download");

    $arr_file['file_save_name'] = $attach_folder . $strFileName;
    $arr_file['file_name'] = $strFileName;
    echo iconv('UTF-8', 'TIS-620', $txt);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/template_user.php'; ?>
</head>
<script>
    window.resizeTo(screen.availWidth, screen.height);
</script>
<!-- <body id="bsf_body" class="horizontal-fixed fixed">
    <div class="wrapper"></div> -->

<body id="bsf_body" class="">
    <div class="wrapper">
        <?php
        //  include '../include/combottom_js_user.php'; //function 
        include '../include/func_Nop.php';
        include "./btn_function.php";
        ?>
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

                                                <form method="get" id="frm-search" name="frm-search" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                                                    <input type="hidden" name="process" id="process" value="export">

                                                    <div class="form-group row">
                                                        <div class="col-md-2 ">
                                                            <label for="BLACK_CASE" class="form-control-label wf-right">หน่วยงาน</label>
                                                        </div>
                                                        <div class="col-md-5 wf-left">
                                                            <?php
                                                            $response = api_request('http://103.40.146.73/LedLaw.php/getCentDept', '', array());
                                                            ?>
                                                            <select name="centDeptGen" id="centDeptGen" class="form-control">
                                                                <option value="">ทั้งหมด</option>
                                                                <?php foreach ($response['Data'] as $rec) { ?>
                                                                    <option value="<?php echo $rec['centDeptGen']; ?>"><?php echo $rec['deptCode'] . ' ' . $rec['deptName'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">วันที่โอนตั้งแต่</label>
                                                        </div>
                                                        <div class="col-md-1 wf-left">
                                                        <label class="input-group">
                                                            <input type="text" name="chqDateMin" id="chqDateMin" class="form-control datepicker" value="<?php echo $T_RED_CASE; ?>">
                                                            <span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
                                                        </label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">ถึงวันที่</label>
                                                        </div>
                                                        <div class="col-md-1 wf-left">
                                                        <label class="input-group">
                                                            <input type="text" name="chqDateMax" id="chqDateMax" class="form-control datepicker" value="<?php echo $T_RED_CASE; ?>">
                                                            <span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
                                                        </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">รายงาน</label>
                                                        </div>
                                                        <div class="col-md-1 wf-left">
                                                            <label class="form-check-label"><input type="radio" name="paidType" class="form-check-input" value="1"> จ่ายเงินคนนอก</label>
                                                            <label class="form-check-label"><input type="radio" name="paidType" class="form-check-input" value="2"> จ่ายเงินคนใน</label>
                                                        </div>

                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">วันที่มีผล</label>
                                                        </div>
                                                        <div class="col-md-1 wf-left">
                                                            <?php echo date('d/m/') . (date('Y') + 543); ?>
                                                        </div>

                                                    </div>



                                                    <div class="form-group row">
                                                        <div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
                                                            <label for="CMD_TYPE" class="form-control-label wf-right">จำแนกตาม</label>
                                                        </div>
                                                        <div class="col-md-2 wf-left">

                                                            <label class="form-check-label"><input type="radio" name="filterType" class="form-check-input" value="0"> บัญชีธนาคารกรุงไทย จำกัด (มหาชน)</label>
                                                            <label class="form-check-label"><input type="radio" name="filterType" class="form-check-input" value="1"> ต่างธนาคารไม่เกิน 2 ล้านบาท</label>
                                                            <label class="form-check-label"><input type="radio" name="filterType" class="form-check-input" value="2"> ต่างธนาคารเกิน 2 ล้านบาท</label>
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12 text-center">
                                                            <button type="submit" name="wf_search" id="wf_search" class="btn btn-primary">Export</button>&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    <!--div class="table-responsive">

                                                        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                            <thead class="bg-primary">
                                                                <th class="text-center">ลำดับ</th>
                                                                <th class="text-center">ชื่อ-สกุล</th>

                                                            </thead>
                                                            <?php
                                                            $response = api_request('http://103.40.146.73/LedLaw.php/reportAud7r298', '', array(
                                                                "prefixRedCase" => $_GET['prefixRedCase'],
                                                                "redCase" => $_GET['redCase'],
                                                                "redYy" => $_GET['redYy'],
                                                                "sqtReqSequesterGen" => $_GET['sqtReqSequesterGen']
                                                            ));



                                                            if ($response['ResponseCode']['ResCode'] == '000' && count($response['Data']) > 0) {
                                                                $a = 1;
                                                                foreach ($response['Data'] as $rec) {


                                                            ?>
                                                                    <tr>
                                                                        <td>
                                                                            <div align='center'><?php echo $a; ?></div>
                                                                        </td>
                                                                        <td><?php echo $rec['personFullName']; ?> </td>

                                                                    </tr>


                                                                <?php
                                                                    $a++;
                                                                }
                                                            } else {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <div align='center'><?php echo 'ไม่มีพบข้อมูล'; ?></div>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }


                                                            ?>
                                                        </table>

                                                    </div-->
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

        <?php
        include '../include/combottom_js_user.php';
        include '../include/combottom_user.php'; ?>