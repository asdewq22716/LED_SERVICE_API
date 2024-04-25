<?php
include '../include/comtop_user.php';

$curl = curl_init();

$arrData = array();
if ($_GET["registerCode"] != "") {
    $arrData["registerCode"] = $_GET["registerCode"];
} else {
    // $arrData["registerCode"] = '0135558001347';
}
if ($_GET["registerCode2"] != "") {
    $arrData["registerCode2"] = $_GET["registerCode2"];
}
if ($_GET["concernCode"] != "") {
    $arrData["concernCode"] = $_GET["concernCode"];
}


// $arrData["systemType"] = 2;
/* $arrData["registerCode"] = '4459884784638';
$arrData["registerCode2"] = '9989985615951'; */
/* echo "ข้อมูลที่ส่งไป";
echo "<pre>";
print_r($arrData);
echo "</pre>"; */
$dataString = json_encode($arrData);

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/GetPersonCaseList.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $dataString,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

curl_close($curl);

$dataReturn = json_decode($response, true);
?>


<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <form method="GET" action="./tem.php" enctype="multipart/form-data" id="frm-input">
            <input type="hidden" id="DOC_ID" name="DOC_ID" value="">

            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
                <div class="col-sm-12">
                    <div class="main-header">
                        <div class="media m-b-12">
                            <a class="media-left" href="">
                                <img src="../icon/icon11.png" class="media-object"></a>
                            <div class="media-body">
                                <h4 class="m-t-5">&nbsp;</h4>
                                <h4>ค้นหา</h4>
                            </div>
                        </div>
                        <div class="f-right">
                            <a class="btn btn-danger waves-effect waves-light" href="../workflow/master_main.php?W=18" role="button" title=""><i class="icofont icofont-home"></i> กลับหน้าหลัก</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
            <!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="form-group row">
                                    <div class="col-md-12 wf-left ">
                                        <!--    <div class="col-md-12 wf-left "> -->
                                        <label class="label bg-primary wf-left">ค้นหาข้อมูล</label>
                                        <!-- start search -->
                                        <fieldset id="fie_search">
                                            <!-- <legend>ค้นหา</legend> -->
                                            <div class="form-group row">
                                                <div class="row">
                                                    <div>
                                                        <div class="col-xs-12 col-sm-5" align="right"><label for="" class="form-control-label wf-right">เลขบัตรประชาชน </label></div>
                                                        <div class="col-xs-12 col-sm-3"><input class="form-control" type="text" name="registerCode" id="registerCode" value="<?php echo $_GET['registerCode']; ?>"></div>
                                                    </div>
                                                    <!-- <div>
                                                        <div class="col-xs-12 col-sm-2" align="right"><label for="" class="form-control-label wf-right">จำเลย </label></div>
                                                        <div class="col-xs-12 col-sm-2"><input class="form-control" type="text" name="registerCode2" id="registerCode2" value="<?php echo $_GET['registerCode2']; ?>"></div>
                                                    </div> -->
                                                </div>
                                           <!--      <div class="row" style="margin-top: 10px;">
                                                    <div>
                                                        <div class="col-xs-12 col-sm-2" align="right"><label for="" class="form-control-label wf-right">หมายเลขคดีดำ </label></div>
                                                        <div class="col-xs-12 col-sm-2"><input class="form-control" type="text" name="blackCase_number" id="blackCase_number" value="<?php echo $_GET['blackCase_number']; ?>"></div>
                                                    </div>
                                                    <div>
                                                        <div class="col-xs-12 col-sm-2" align="right"><label for="" class="form-control-label wf-right">หมายเลขคดีแดง </label></div>
                                                        <div class="col-xs-12 col-sm-2"><input class="form-control" type="text" name="redCase_number" id="redCase_number" value="<?php echo $_GET['redCase_number']; ?>"></div>
                                                    </div>
                                                </div> -->
                                              
                                                <div class="row" align="center" style="margin-top: 10px;">
                                                    <div class="col-xs-12 col-sm-12"><button type="button" class="btn btn-primary" onClick="searchData();">ค้นหา</button></div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!-- Revive ไกล่เกลี่ย -->
                                        <div class="row" class="col-md-12">
                                            <div class="table-responsive">
                                                <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                    <thead class="bg-primary">
                                                        <?php
                                                        /*  $ii = 0;
                                                        foreach ($dataReturn['Data'] as $tt1 => $th1) {
                                                        ?>
                                                            <?php
                                                            foreach ($th1 as $tt2 => $th2) {
                                                                if ($ii > 0) {
                                                                } else {
                                                            ?> <tr class="bg-primary"><?php
                                                                                        foreach ($th2 as $tt3 => $th3) {
                                                                                        ?>

                                                                            <div>
                                                                                <td><?php echo $tt3; ?></td>
                                                                            </div>

                                                                        <?php
                                                                                        }
                                                                        ?>
                                                                    </tr><?php
                                                                        }
                                                                        $ii++;
                                                                    }
                                                                            ?>
                                                        <?php
                                                        } */
                                                        ?>
                                                        <!-- <th class="text-center">ลำดับ</th> -->
                                                        <th class="text-center">เลขบัตรประชาชน</th>
                                                        <!-- <th class="text-center">คำนำหน้า</th> -->
                                                        <th class="text-center">ชื่อ-สกุล</th>
                                                        <th class="text-center">สถานะ</th>
                                                        <!-- <th class="text-center">ที่อยู่</th> -->
                                                        <th class="text-center">เลขคดีดำ</th>
                                                        <!-- <th class="text-center">ปี</th> -->
                                                        <th class="text-center">เลขคดีแดง</th>
                                                        <!-- <th class="text-center">ปี</th>
                                                        <th class="text-center">รหัสศาล</th> -->
                                                    </thead>
                                                    <?php
                                                    foreach ($dataReturn['Data'] as $sh1 => $ch1) {
                                                        $num_a = 1;
                                                        // if ($sh1 == 'Mediate') {
                                                        //     $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบไกล่เกลี่ย';
                                                        // } else if ($sh1 == 'Bankrupt') {
                                                        //     $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบล้มละลาย';
                                                        // } else if ($sh1 == 'Revive') {
                                                        //     $show_word = ' ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบฟื้นฟู';
                                                        // } else if ($sh1 == 'Backoffice') {
                                                        //     $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในแพ่ง';
                                                        // }
                                                    ?>

                                                        <!-- <tr>
                                                            <td colspan="11" style="background-color:#dc3545 ;color:aliceblue;"><?php echo $show_word; ?></td>
                                                        </tr> -->
                                                        <?php
                                                        foreach ($ch1 as $sh2 => $ch2) {
                                                        ?> <tr>
                                                                <!-- <div>
                                                                    <td>
                                                                        <div align='center'><?php echo $num_a; ?></div>
                                                                    </td> -->
                                                                    <td><?php echo $ch2['registerCode']; ?></td>
                                                                    <!-- <td><?php echo $ch2['prefixName']; ?></td> -->
                                                                    <td><?php echo $ch2['firstName'] . " " . $ch2['lastName']; ?></td>
                                                                    <td><?php echo $ch2['concernName']; ?></td>
                                                                    <!-- <td><?php echo $ch2['address'] . " " . $ch2['tumName'] . " " . $ch2['ampName'] . " " . $ch2['provName'] . " " . $ch2['zipCode']; ?></td> -->
                                                                    <td><?php echo $ch2['blackCase']; ?></td>
                                                                    <!-- <td><?php echo $ch2['blackYy']; ?></td> -->
                                                                    <td><?php echo $ch2['redCase']; ?></td>
                                                                    <!-- <td><?php echo $ch2['redYy']; ?></td>
                                                                    <td><?php echo $ch2['CourtCode']; ?></td> -->
                                                                </div>
                                                            </tr><?php
                                                                    $num_a++;
                                                                }
                                                                    ?>
                                                    <?php
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- stop search -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="main-header">
                </div>
            </div>
            <!-- Container-fluid ends -->
        </form>
    </div>
</div>


<!-- Modal Upload File -->
<div class="modal fade modal-flex " id="payrollBizModal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close biz-close-modal" data-number="payrollBizModal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger biz-close-modal" data-number="payrollBizModal">ปิด</button>
            </div>
        </div>
    </div>
</div>
<!-- //. Modal Upload File  -->
<script>
    function searchData() {
        $("#page").val(1);
        $("#frm-input")
            .attr("target", "")
            .attr("action", "")
            .submit();
    }
</script>