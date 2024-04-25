<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "P";
include('../include/include.php');
include('../include/paging.php');

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

                                                <form method="post" id="frm-search" name="frm-search" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                                                    <input type="hidden" name="process" id="process" value="search">
                                                    <input type="hidden" name="personCode" id="personCode" value="<?php echo $_REQUEST['personCode']; ?>">


                                                    <!-- <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">วันที่แจ้ง</label>
                                                        </div>
                                                        <div class="col-md-1 wf-left">
                                                        <label class="input-group">
                                                            <input type="text" name="createDate" id="createDate" class="form-control datepicker" value="<?php echo $_POST['createDate'] ?>">
                                                            <span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
                                                        </label>
                                                        </div>
                                                    </div> -->


                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">ศาล</label>
                                                        </div>
                                                        <div class="col-md-3 wf-left">
                                                            <?php
                                                            $response = api_request('http://103.40.146.73/LedLaw.php/getCentCourt', '', array());
                                                            ?>
                                                            <select name="courtCode" id="courtCode" class="form-control select2">
                                                                <option value="">ทั้งหมด</option>
                                                                <?php foreach ($response['Data'] as $rec) { ?>
                                                                    <option value="<?php echo $rec['courtCode']; ?>" <?php echo $rec['courtCode'] == $_POST['courtCode'] ? ' selected' : ''; ?>><?php echo $rec['courtCode'] . ' ' . $rec['courtName'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">หมายเลขเก็บ</label>
                                                        </div>
                                                        <div class="col-md-10 wf-left">
                                                            <div class="input-group">
                                                                <input type="text" name="recvNo" class="form-control" style="width:10px" value="<?php echo $_POST['recvNo'] ?>" />
                                                                <input type="text" name="recvYear" class="form-control" style="width:10px" value="<?php echo $_POST['recvYear'] ?>" />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">คดีหมายเลขดำเลขที่</label>
                                                        </div>
                                                        <div class="col-md-10 wf-left">
                                                            <div class="input-group">
                                                                <input type="text" name="prefixBlackCase" class="form-control" style="width:5px" value="<?php echo $_POST['prefixBlackCase'] ?>" />
                                                                <input type="text" name="blackCase" class="form-control" style="width:10px" value="<?php echo $_POST['blackCase'] ?>" />
                                                                <input type="text" name="blackYy" class="form-control" style="width:10px" value="<?php echo $_POST['blackYy'] ?>" />

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">คดีหมายเลขแดงเลขที่</label>
                                                        </div>
                                                        <div class="col-md-10 wf-left">
                                                            <div class="input-group">
                                                                <input type="text" name="prefixRedCase" class="form-control" style="width:5px" value="<?php echo $_POST['prefixRedCase'] ?>" />
                                                                <input type="text" name="redCase" class="form-control" style="width:10px" value="<?php echo $_POST['redCase'] ?>" />
                                                                <input type="text" name="redYy" class="form-control" style="width:10px" value="<?php echo $_POST['redYy'] ?>" />
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">ประเภท To do list</label>
                                                        </div>
                                                        <div class="col-md-3 wf-left">
                                                            <?php
                                                            $arrTodiListType = array(
                                                                1 => 'แสดงทั้งสำนักงาน',
                                                                2 => 'แสดงเฉพาะตำแหน่ง',
                                                                3 => 'แสดงรายบุคคล',
                                                                4 => 'แสงเฉพาะตำแหน่งและจะลบออกภายหลัง'
                                                            );
                                                            ?>
                                                            <select name="toDoListType" id="toDoListType" class="form-control select2" >
                                                                <option value="">ทั้งหมด</option>
                                                                <?php foreach ($arrTodiListType as $key => $val) { ?>
                                                                    <option value="<?php echo $key; ?>" <?php echo $key == $_POST['toDoListType'] ? ' selected' : ''; ?>><?php echo $val ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <label class="form-control-label wf-right">วันที่แจ้ง</label>
                                                        </div>
                                                        <div class="col-md-1 wf-left">
                                                        <label class="input-group">
                                                            <input type="text" name="createDate" id="createDate" class="form-control datepicker" value="<?php echo $_POST['createDate'] ?>">
                                                            <span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
                                                        </label>
                                                        </div>
                                                    </div>



                                                    <div class="form-group row">
                                                        <div class="col-md-12 text-center">
                                                            <button type="submit" name="wf_search" id="wf_search" class="btn btn-primary">ค้นหา</button>&nbsp;&nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">

                                                        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                            <thead class="bg-primary">
                                                                <th class="text-center">ลำดับ</th>
                                                                <th class="text-center">วันที่แจ้งเตือน</th>
                                                                <th class="text-center">คดีหมายเลขแดงเลขที่</th>
                                                                <th class="text-center">ศาล</th>
                                                                <th class="text-center">งานที่ต้องทำ</th>

                                                            </thead>
                                                            <?php
                                                            $response = api_request('http://103.40.146.73/LedLaw.php/todolist', '', array(
                                                                "personCode" => $_REQUEST['personCode'],
                                                                "courtCode" => $_REQUEST['courtCode'],

                                                                "recvNo" => $_REQUEST['recvNo'],
                                                                "recvYear" => $_REQUEST['recvYear'],

                                                                "prefixBlackCase" => $_REQUEST['prefixBlackCase'],
                                                                "blackCase" => $_REQUEST['blackCase'],
                                                                "blackYy" => $_REQUEST['blackYy'],
                                                                
                                                                "prefixRedCase" => $_REQUEST['prefixRedCase'],
                                                                "redCase" => $_REQUEST['redCase'],
                                                                "redYy" => $_REQUEST['redYy'],
                                                                
                                                                "createDate" => date2db($_REQUEST['createDate']),

                                                            ));


                                                            if ($response['ResponseCode']['ResCode'] == '000' && count($response['Data']) > 0) {
                                                                $a = 1;
                                                                foreach ($response['Data'] as $rec) {
                                                                    // print_pre($response['Data']);
                                                                    // exit;
                                                                    $baseUrl = 'http://ledapp5.led.go.th:7001/' . 'led/';

                                                                    if ($rec['todolistType'] == '3') {
                                                                        $onclick = "approveTodolistPage('" . $baseUrl . $rec['shrTodolistUrl'] . $rec['shrTodolistGen'] . "')";
                                                                    } else if ($rec['color']) {
                                                                        // even สำหรับใส่ highlight โดยเปิด tag Table
                                                                        if ($rec['shrTodolistUrl']) {
                                                                            $onclick = "window.open('" . $baseUrl . $rec['shrTodolistUrl'] . "')";
                                                                        }
                                                                    } else {
                                                                        // even สำหรับใส่ highlight โดยเปิด tag Table
                                                                        $onclick = "approveTodolistPage('" . $baseUrl .  $rec['shrTodolistUrl'] . $rec['shrTodolistGen'] . "')";
                                                                    }
                                                            ?>

                                                                    <tr <?php echo $rec['shrTodolistUrl'] ? (' onclick="' . $onclick . '" style="cursor: pointer;"') : ''; ?>>
                                                                        <td>
                                                                            <div align='center'><?php echo $a; ?></div>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo thaiDate($rec['createDate']); ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $rec['prefixRedCase'] . $rec['redCase'] . '/' . $rec['redYy']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php echo $rec['courtName']; ?></td>
                                                                        <td>
                                                                            <?php echo '<pre>' . $rec['shrTodolistDetail'] . '</pre>'; ?>
                                                                        </td>

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
        <script>
            function openNewProgram(winName, url) {
                var winOption = "location=no, scrollbars=yes ,status=yes, resize=yes ,width=" + (screen.width - 6) + ",height=" + (screen.height - 90) + "top=0,left=0";
                var newWin = window.open(url, winName, winOption);
                newWin.focus();
                newWin.moveTo(0, 0);
                return newWin;
            }

            function approveTodolistPage(url) {
                var PROGRAM_ID = url.split("/")[3].substring(0, 8);
                openNewProgram(PROGRAM_ID, url);
            }
        </script>
        <?php
        include '../include/combottom_js_user.php';
        include '../include/combottom_user.php'; ?>