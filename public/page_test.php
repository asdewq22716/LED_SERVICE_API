<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 'On'); */

include '../include/comtop_user_N.php'; //connect db

include '../include/combottom_js_user.php'; //function 

include "../include/func_Nop.php";
include "../include/paging2.php";

include "./btn_function.php";

$path = "../";

foreach ($_GET as $key => $val) {
    $$key = conText($val);
}
foreach ($_POST as $key => $val) {
    $$key = conText($val);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/template_user.php'; ?>
</head>


<div class="content m-t-20">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <div class="col-sm-12" id="content">
            <form method="GET"  enctype="multipart/form-data" id="frm-input" name='frm-input'>
                <div class="card">
                    <div class="card-header">
                        <h5>เเก้ไขสถานะทรัพย์เเละคน</h5>
                    </div>
                    <div class="card-block">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-xs-12 col-sm-2" align=""></div>
                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button"><a style="color: white;" href="editStatus.php">editStatus</a></button></div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-xs-12 col-sm-2" align=""></div>
                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button"><a style="color: white;" href="editStatus1.php">ทดสอบล็อคทรัพย์</a></button></div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-xs-12 col-sm-2" align=""></div>
                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button"><a style="color: white;" href="GetBankruptApi.php">ดึงbrcIdล้มละลาย</a></button></div>
                            <div class="col-xs-12 col-sm-2" align=""> <label for="">SELECT*FROM M_BRC_ID </label> </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-xs-12 col-sm-2" align=""></div>
                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button"><a style="color: white;" href="GetCivilApi.php">ดึง PccCivilGen เเพ่ง</a></button></div>
                            <div class="col-xs-12 col-sm-2" align=""> <label for="">SELECT*FROM M_PCC_CIVIL_CASE </label> </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-xs-12 col-sm-2" align=""></div>
                            <div class="col-xs-12 col-sm-2"> <button class="btn btn-primary" type="button"><a style="color: white;" href="iFrameBankrupt.php">iFrameไปล้มละลาย</a></button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </body>