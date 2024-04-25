<?php
session_start();

include '../include/comtop_user.php'; //connect db

include '../include/combottom_js_user.php'; //function 
/* echo "<br><br><br><br><br><pre>";
print_r($_GET);
echo "</pre>"; */


if ($_GET['REGISTERCODE'] != '') {
    $_POST["registerCode"] = $_GET["REGISTERCODE"];
    $_GET["REGISTERCODE"] = "";
}


$curl = curl_init();
$arrData = array();
if ($_POST["registerCode"] != "") {
    $arrData["registerCode"] = $_POST["registerCode"];
}
if ($_POST["registerCode2"] != "") {
    $arrData["registerCode2"] = $_POST["registerCode2"];
}
if ($_POST["concernCode"] != "") {
    $arrData["concernCode"] = $_POST["concernCode"];
}

if ($_GET['court_c'] != '') { //ศาล
    $arrData["COURT_NAME"] = $_GET['court_c'];
}
if ($_GET['T_BLACK_CASE'] != '') {
    $arrData["PREFIXBLACKCASE"] = $_GET['T_BLACK_CASE'];
}
if ($_GET['BLACK_CASE'] != '') {
    $arrData["BLACKCASE"] = $_GET['BLACK_CASE'];
}
if ($_GET['BLACK_YY'] != '') {
    $arrData["BLACKYY"] = $_GET['BLACK_YY'];
}
if ($_GET['T_RED_CASE'] != '') {
    $arrData["PREFIXREDCASE"] = $_GET['T_RED_CASE'];
}
if ($_GET['RED_CASE'] != '') {
    $arrData["REDCASE"] = $_GET['RED_CASE'];
}
if ($_GET['RED_YY'] != '') {
    $arrData["REDYY"] = $_GET['RED_YY'];
}
/* เกี่ยวข้องเป็น */
if ($_GET['PRE_CODE'] != '') {
    $arrData["PRE_CODE"] = $_GET['PRE_CODE'];
}
/* ประเภทคดี */
if ($_GET['case'] != '') {
    $arrData["case"] = $_GET['case'];
}


$dataString = json_encode($arrData);

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/GetPersonCaseList_ver1.php',
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

function ctext($txt, $converted = 0)
{
    $strOut = strip_tags($txt);
    $strOut = htmlspecialchars($strOut, ENT_QUOTES);
    $strOut = stripslashes($strOut);
    $strOut = str_replace("'", " ", $strOut);
    $strOut = trim($strOut);

    //return iconv("utf-8","tis-620",$strOut);
    return ($converted == 0) ? $strOut : iconv("utf-8", "tis-620", $strOut);
}

/* echo "<br><br><br><br><br><pre>";
print_r($_POST);
echo "</pre>"; */
/* echo "<br><br><br><br><br><pre>";
print_r($dataReturn);
echo "</pre>"; */
?>
<script>
    let data_arr = <?php echo json_encode($dataReturn); ?>;
    console.log(data_arr)
</script>
<?php

/* db::db_delete_ALL("WF_CASE_TEM1"); */ // ลบข้อมูลทั้งหมด
$S = 0;
/* อัดข้อมูลใส่DB start*/
/* foreach ($dataReturn['Data'] as $AA1 => $BB1) {
    foreach ($BB1 as $AA2 => $BB2) {
        unset($fields);
        $S++;
        $fields["ID_TEM"]   =       $S;
        $fields["PREFIXBLACKCASE"]   =      $BB2['prefixBlackCase'];
        $fields["blackCase"]         =      $BB2['blackCase'];
        $fields["blackYy"]           =      $BB2['blackYy'];
        $fields["prefixRedCase"]     =      $BB2['prefixRedCase'];
        $fields["redCase"]           =      $BB2['redCase'];
        $fields["redYy"]           =      $BB2['redYy'];
        $fields["CourtCode"]           =      $BB2['CourtCode'];
        $fields["courtName"]           =      $BB2['courtName'];
        $fields["registerCode"]           =      $BB2['registerCode'];
        $fields["prefixName"]           =      $BB2['prefixName'];
        $fields["firstName"]           =      $BB2['firstName'];
        $fields["lastName"]           =      $BB2['lastName'];
        $fields["fullName"]           =      $BB2['fullName'];
        $fields["personType"]           =      $BB2['personType'];
        $fields["concernName"]           =      $BB2['concernName'];
        $fields["address"]           =      $BB2['address'];
        $fields["tumName"]           =      $BB2['tumName'];
        $fields["ampName"]           =      $BB2['ampName'];
        $fields["provName"]           =      $BB2['provName'];
        $fields["zipCode"]           =      $BB2['zipCode'];
        $fields["concernNo"]           =      $BB2['concernNo'];
        $fields["lockPersonStatus"]           =      $BB2['lockPersonStatus'];
        $fields["lockPersonStatusText"]           =      $BB2['lockPersonStatusText'];
        $fields["orderStatus"]           =      $BB2['orderStatus'];
        $fields["comPayDeptDate"]           =      $BB2['comPayDeptDate'];
        $fields["personPlaintiff"]           =      $BB2['personPlaintiff'];
        $fields["personDefendant"]           =      $BB2['personDefendant'];
        $fields["personCapital"]           =      $BB2['personCapital'];
        $fields["deptName"]           =     ($BB2['deptName']);
        $fields["D_TYPE"]           =      ctext($AA1);
        $fields["DEL"]           =      ctext(1);
        db::db_insert("WF_CASE_TEM1", $fields);
    }
} */
/* อัดข้อมูลใส่DB STOP */

?>


<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <form method="GET" action="./search_data.php" enctype="multipart/form-data" id="frm-input">
            <input type="hidden" id="DOC_ID" name="DOC_ID" value="">
            <input type="hidden" id="sh1" name="sh1">
            <input type="hidden" id="prefixBlackCase" name="prefixBlackCase">
            <input type="hidden" id="blackCase" name="blackCase">
            <input type="hidden" id="blackYy" name="blackYy">
            <input type="hidden" id="prefixRedCase" name="prefixRedCase">
            <input type="hidden" id="redCase" name="redCase">
            <input type="hidden" id="redYy" name="redYy">
            <input type="hidden" id="CourtCode" name="CourtCode">
            <input type="hidden" id="courtName" name="courtName">
            <input type="hidden" id="concernName" name="concernName">
            <input type="hidden" id="fullName" name="fullName">
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
                        <!--  <div class="f-right">
                            <a class="btn btn-danger waves-effect waves-light" href="../workflow/master_main.php?W=18" role="button" title=""><i class="icofont icofont-home"></i> กลับหน้าหลัก</a>
                        </div> -->
                        <!-- <div class="row" id="animationSandbox">
                            <div class="col-sm-12">
                                <div class="main-header">
                                    <div class="f-right">
                                        <a class="btn btn-primary active waves-effect waves-light" href="show_cmd_form.php?<?php echo $text_param; ?>&proc=add" role="button" title="<?php if ($rec_main["WF_BTN_ADD_RESIZE"] == 'Y') {
                                                                                                                                                                                            echo $WF_TEXT_MAIN_ADD;
                                                                                                                                                                                        } ?>"><i class="icofont icofont-ui-add"></i> <?php if ($rec_main["WF_BTN_ADD_RESIZE"] != 'Y') {
                                                                                                                                                                                                                                            echo $WF_TEXT_MAIN_ADD;
                                                                                                                                                                                                                                        } ?></a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--      <div class="f-right">
                            <a class="btn btn-primary active waves-effect waves-light" href="search_data_from.php?<?php echo $text_param; ?>&proc=add" role="button" title="<?php if ($rec_main["WF_BTN_ADD_RESIZE"] == 'Y') {
                                                                                                                                                                                echo $WF_TEXT_MAIN_ADD;
                                                                                                                                                                            } ?>"><i class="icofont icofont-ui-add"></i> <?php if ($rec_main["WF_BTN_ADD_RESIZE"] != 'Y') {
                                                                                                                                                                                                                                echo $WF_TEXT_MAIN_ADD;
                                                                                                                                                                                                                            } ?></a>
                        </div> -->
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
                                        <!--   <label class="label bg-primary wf-left">ค้นหาข้อมูล</label> -->
                                        <!-- start search -->
                                        <fieldset id="fie_search">
                                            <!--    <legend>ค้นหา</legend> -->
                                            <div class="form-group row">
                                                <div>
                                                    <div>
                                                        <div class="form-group row">
                                                            <div class="col-xs-12 col-sm-2" align=""><label for="" class="form-control-label wf-right">เลขบัตรประชาชน </label></div>
                                                            <div class="col-xs-12 col-sm-3"><input class="form-control" type="text" name="REGISTERCODE" id="REGISTERCODE" value="<?php echo $_POST['registerCode']; ?>"></div>

                                                            <div class="col-xs-12 col-sm-2"><label for="" class="form-control-label wf-right">
                                                                    ศาล </label></div>
                                                            <div class="col-xs-12 col-sm-2">

                                                                <?php
                                                                $sql_court = "SELECT a.COURT_ID ,a.COURT_NAME ,a.COURT_CODE FROM M_COURT a";
                                                                $qry_court = db::query($sql_court);

                                                                ?>
                                                                <select name="court_c" id="court_c" class="form-control select2" tabindex="-1">
                                                                    <option value="">ทั้งหมด</option>
                                                                    <?php
                                                                    while ($rec = db::fetch_array($qry_court)) {
                                                                        $SELECT = $_GET['court_c'] == $rec['COURT_NAME'] ? "selected" : "";
                                                                        echo " <option  " . $SELECT  . "  value='" . $rec['COURT_NAME'] . "'>" . $rec['COURT_NAME'] . "</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">

                                                            <div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
                                                                <label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำ</label>
                                                            </div>

                                                            <div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
                                                                <input type="text" name="T_BLACK_CASE" id="T_BLACK_CASE" class="form-control" value="<?php echo $T_BLACK_CASE; ?>">
                                                                <small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                                                            </div>

                                                            <div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
                                                                <input type="text" name="BLACK_CASE" id="BLACK_CASE" class="form-control" value="<?php echo $BLACK_CASE; ?>">
                                                                <small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                                                            </div>

                                                            <div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
                                                                <div class="row">
                                                                    <div id="" class="col-md-1 wf-left">
                                                                        ปี
                                                                    </div>
                                                                    <div id="" class="col-md-5 wf-left">
                                                                        <input type="text" name="BLACK_YY" id="BLACK_YY" class="form-control" value="<?php echo $BLACK_YY; ?>">
                                                                        <small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="RED_CASE_BSF_AREA" class="col-md-2 ">
                                                                <label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดง</label>
                                                            </div>
                                                            <div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
                                                                <input type="text" name="T_RED_CASE" id="T_RED_CASE" class="form-control" value="<?php echo $T_RED_CASE; ?>">
                                                                <small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                                                            </div>
                                                            <div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
                                                                <input type="text" name="RED_CASE" id="RED_CASE" class="form-control" value="<?php echo $RED_CASE; ?>">
                                                                <small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
                                                            </div>
                                                            <div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
                                                                <div class="row">
                                                                    <div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
                                                                        ปี
                                                                    </div>
                                                                    <div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
                                                                        <input type="text" name="RED_YY" id="RED_YY" class="form-control" value="<?php echo $RED_YY; ?>">
                                                                        <small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-xs-12 col-sm-2"><label for="" class="form-control-label wf-right">เกี่ยวข้องเป็น </label></div>



                                                            <div class="col-xs-12 col-sm-2">
                                                                <?php
                                                                $SQL_PARTY = "SELECT a.PRE_NAME  FROM TEMP_REF_PARTY_TYPE a 
                                                                GROUP BY a.PRE_NAME ";
                                                                $qry_PARTY = db::query($SQL_PARTY);
                                                                while ($rec_PARTY = db::fetch_array($qry_PARTY)) {
                                                                    foreach ($_GET['PRE_CODE'] as $PRE1) {
                                                                        if ($PRE1 == $rec_PARTY['PRE_NAME']) {
                                                                            $SELECT . ${$rec_PARTY['PRE_NAME']} = "selected";
                                                                        }
                                                                    }
                                                                }

                                                                ?>

                                                                <select name="PRE_CODE[]" id="PRE_CODE[]" multiple="multiple" class="form-control select2" tabindex="-1">
                                                                    <!-- <option value="">ทั้งหมด</option> -->
                                                                    <?php
                                                                    $qry_PARTY = db::query($SQL_PARTY);
                                                                    while ($rec_PARTY = db::fetch_array($qry_PARTY)) {
                                                                        echo " <option  " . $SELECT . ${$rec_PARTY['PRE_NAME']}  . "  value='" . $rec_PARTY['PRE_NAME'] . "'>" . $rec_PARTY['PRE_NAME'] . "</option>";
                                                                    }

                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <?php
                                                            $array_case = array('Mediate', 'Revive', 'Bankrupt', 'Civil');
                                                            foreach ($array_case as $PRE1) {
                                                                foreach ($_GET['case'] as $PRE2) {
                                                                    if ($PRE2 == $PRE1) {
                                                                        $SELECT . ${$PRE1} = "selected";
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            <div class="col-xs-12 col-sm-3"><label for="" class="form-control-label wf-right">ประเภทคดี </label></div>
                                                            <div class="col-xs-12 col-sm-2">
                                                                <select name="case[]" id="case[]" multiple="multiple" class="form-control select2" tabindex="-1">
                                                                    <?php foreach ($array_case as $PRE1) {
                                                                        if ($PRE1 == 'Mediate') {
                                                                            $word = 'ระบบไกล่เกลี่ย';
                                                                        } else if ($PRE1 == 'Bankrupt') {
                                                                            $word = 'ระบบล้มละลาย';
                                                                        } else if ($PRE1 == 'Revive') {
                                                                            $word = 'ระบบฟื้นฟู';
                                                                        } else if ($PRE1 == 'Backoffice') {
                                                                            $word = 'Backoffice';
                                                                        } else if ($PRE1 == 'Civil') {
                                                                            $word = 'ระบบแพ่ง';
                                                                        }
                                                                    ?>

                                                                        <option <?php echo $SELECT . ${$PRE1}; ?> value="<?php echo $PRE1; ?>"><?php echo $word; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-6" align="right">
                                                                <button type="button" class="btn btn-primary" onClick="searchData();">ค้นหา</button>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6" align="left">
                                                                <button type="button" class="btn btn-info" onClick="btn_clear();"><i class="fa fa-refresh"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!-- Revive ไกล่เกลี่ย -->
                                        <div class="row" class="col-md-12">
                                            <div class="table-responsive">
                                                <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                                    <thead class="bg-primary">
                                                        <th class="text-center">ลำดับ</th>
                                                        <th class="text-center">เลขบัตรประชาชน</th>
                                                        <th class="text-center">ชื่อ-สกุล</th>
                                                        <th class="text-center">สถานะ</th>
                                                        <th class="text-center">เลขคดีดำ/ปี</th>
                                                        <th class="text-center">เลขคดีแดง/ปี</th>
                                                        <th class="text-center">ศาล</th>
                                                        <th class="text-center">จัดการ</th>
                                                    </thead>
                                                    <?php





                                                    $num_row = count($dataReturn['Data']);
                                                    if ($num_row > 0) {


                                                        foreach ($dataReturn['Data'] as $sh1 => $ch1) {
                                                            $num_a = 1;
                                                            $num_a1 = 1;
                                                            $show_word = '';
                                                            if ($sh1 == 'Mediate') {
                                                                $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบไกล่เกลี่ย';
                                                            } else if ($sh1 == 'Bankrupt') {
                                                                $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบล้มละลาย';
                                                                $_POST["SYSTEM_ID"] = 2;
                                                            } else if ($sh1 == 'Revive') {
                                                                $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบฟื้นฟู';
                                                            } else if ($sh1 == 'Backoffice') {
                                                                $show_word = 'Backoffice';
                                                            } else if ($sh1 == 'Civil') {
                                                                $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในแพ่ง';
                                                                $_POST["SYSTEM_ID"] = 1;
                                                            }

                                                            /* start เเสดง tabเมนู ที่มีข้อมูลจังหวัด */

                                                    ?>
                                                            <tr>
                                                                <td colspan="10" style="background-color:#dc3545 ;color:aliceblue;"><?php echo $show_word; ?></td>
                                                            </tr>
                                                            <!-- stop เเสดง tabเมนู ที่มีข้อมูลจังหวัด -->
                                                            <?php

                                                            foreach ($ch1 as $sh2 => $ch2) {
                                                            ?> <tr style="background-color: #E6E6FA;">
                                                                    <div>
                                                                        <td>
                                                                            <div align='center'><?php echo $num_a; ?></div>
                                                                        </td>
                                                                        <td><?php echo $ch2['registerCode']; ?></td>
                                                                        <td><?php echo $ch2['prefixName'] . " " . $ch2['firstName'] . " " . $ch2['lastName']; ?></td>
                                                                        <td><?php echo $ch2['concernName']; ?></td>
                                                                        <!--   <td><?php echo $ch2['address'] . " " . $ch2['tumName'] . " " . $ch2['ampName'] . " " . $ch2['provName'] . " " . $ch2['zipCode']; ?></td> -->
                                                                        <?php
                                                                        $A = ($ch2['blackCase'] != '' && $ch2['blackYy'] != '') ? "/" : "";
                                                                        $B = ($ch2['redCase'] != '' && $ch2['redYy'] != '') ? "/" : "";
                                                                        ?>
                                                                        <td><?php echo $ch2['prefixBlackCase'] . $ch2['blackCase'] . $A . $ch2['blackYy']; ?></td>
                                                                        <td><?php echo $ch2['prefixRedCase'] . $ch2['redCase'] . $B . $ch2['redYy']; ?></td>
                                                                        <td><?php echo $ch2['courtName']; ?></td>
                                                                        <td>
                                                                            <div class="form-group row" align='center'>
                                                                                <!--  <a href="##" target="_blank" class="btn btn-info btn-mini" title="">
                                                                                    <i class="icofont icofont-search"></i> ดูรายละเอียด
                                                                                </a> -->

                                                                                <a href="cmd_view.php?ID=<?php echo $dataSelectData["ID"] ?>&update_view=<?php echo $update_view; ?>&TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"] ?>" target="_blank" class="btn btn-info btn-mini" title="">
                                                                                    <i class="icofont icofont-search"></i> ดูรายละเอียด
                                                                                </a>
                                                                            </div>
                                                                            <div class="form-group row" align='center'>
                                                                                <button type="button" class="btn btn-success btn-mini" onclick="action_from('<?php echo $sh1; ?>','<?php echo $ch2['prefixBlackCase']; ?>',
                                                                           '<?php echo $ch2['blackCase']; ?>','<?php echo $ch2['blackYy']; ?>','<?php echo $ch2['prefixRedCase']; ?>',
                                                                           '<?php echo $ch2['redCase']; ?>','<?php echo $ch2['redYy']; ?>','<?php echo $ch2['CourtCode']; ?>',
                                                                           '<?php echo $ch2['courtName']; ?>','<?php echo $ch2['concernName']; ?>','<?php echo $ch2['fullName']; ?>');">คำสั่งเจ้าพนักงาน</button>
                                                                            </div>
                                                                        </td>
                                                                    </div>
                                                                </tr>
                                                                <?php
                                                                /* ทรัพ */
                                                                $filter = "";
                                                                if ($ch2['prefixBlackCase'] != "") {
                                                                    $filter .= " and b.PREFIX_BLACK_CASE = '" .  $ch2['prefixBlackCase'] . "'	";
                                                                }
                                                                if ($ch2['blackCase'] != "") {
                                                                    $filter .= " and b.BLACK_CASE = '" . $ch2['blackCase'] . "'	";
                                                                }
                                                                if ($ch2['blackYy'] != "") {
                                                                    $filter .= " and b.BLACK_YY = '" . $ch2['blackYy'] . "'	";
                                                                }
                                                                if ($ch2['prefixRedCase'] != "") {
                                                                    $filter .= " and b.PREFIX_RED_CASE = '" . $ch2['prefixRedCase'] . "'	";
                                                                }
                                                                if ($ch2['redCase'] != "") {
                                                                    $filter .= " and b.RED_CASE = '" . $ch2['redCase'] . "'	";
                                                                }
                                                                if ($ch2['redYy'] != "") {
                                                                    $filter .= " and b.RED_YY = '" . $ch2['redYy'] . "'	";
                                                                }
                                                                /* if ($ch2['CourtCode'] != "" && $_POST["SYSTEM_ID"] != 6) {
                                                                    if ($_POST["SYSTEM_ID"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
                                                                        $filter .= " and COURT_ID = '" . $_POST['COURT_CODE'] . "'	";
                                                                    } else {
                                                                        $filter .= " and COURT_CODE = '" . $_POST['COURT_CODE'] . "'	";
                                                                    }
                                                                } */

                                                                $arrDataAsset = array();
                                                                if ($_POST["SYSTEM_ID"] == 1) { //ระบบงานบังคับคดีแพ่ง
                                                                    $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,CFC_CAPTION_GEN
								from 		WH_CIVIL_CASE_ASSETS a 
								inner join 	WH_CIVIL_CASE b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
								where 		1=1 {$filter}";
                                                                } else if ($_POST["SYSTEM_ID"] == 2) { //ระบบงานบังคับคดีล้มละลาย
                                                                    $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE
								from 		WH_BANKRUPT_ASSETS a 
								inner join 	WH_BANKRUPT_CASE_DETAIL b on a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID
								where 		1=1 {$filter}";
                                                                } else if ($_POST["SYSTEM_ID"] == 6) { //ระบบงานบังคับคดีล้มละลาย
                                                                    $sqlSelectDataAsset = "	select 		WH_ASSET_ID as ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,M_ASSET_KEY,ASSET_TYPE_ID
								from 		WH_DEBTOR_ASSETS
								where 		1=1 AND PROP_TITLE is not null {$filter}";
                                                                }

                                                               /*  echo  $sqlSelectDataAsset; */
                                                                $querySelectDataAsset = db::query($sqlSelectDataAsset);
                                                                $num_r = db::num_rows($querySelectDataAsset);
                                                                if ($num_r > 0) {
                                                                ?>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td style="background-color: #D4B6B8;">ลำดับรายการทรัพย์</td>
                                                                        <td style="background-color: #D4B6B8;">ชื่อรายการทรัพย์</td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                $T = 1;
                                                                while ($recSelectDataAsset = db::fetch_array($querySelectDataAsset)) {
                                                                ?>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td style="background-color: #FFE0B0;">
                                                                            <div align="center"><?php echo $T; ?></div>
                                                                        </td>
                                                                        <td style="background-color: #FFE0B0;"> <?php echo $recSelectDataAsset['PROP_TITLE']; ?></td>
                                                                    </tr>
                                                                <?php
                                                                    $T++;
                                                                }
                                                                /* ทรัพ */
                                                                ?>
                                                            <?php
                                                                $num_a++;
                                                            }
                                                            ?>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="10">
                                                                <div align='center'><?php echo 'ไม่มีข้อมูล'; ?></div>
                                                            </td>
                                                        </tr>
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
    function btn_clear() {
        history.replaceState({}, document.title, window.location.pathname);
        window.location = 'http://103.208.27.224:81/led_service_api/public/search_data.php'

    }

    function searchData() {
        let registerCode = $('#REGISTERCODE').val();

        let T_BLACK_CASE = $('#T_BLACK_CASE').val();
        let BLACK_CASE = $('#BLACK_CASE').val();
        let BLACK_YY = $('#BLACK_YY').val();
        let T_RED_CASE = $('#T_RED_CASE').val();
        let RED_CASE = $('#RED_CASE').val();
        let RED_YY = $('#RED_YY').val();

        let court_c = $('#court_c').val();
        let PRE_CODE = $('#PRE_CODE').val();
        let case_c = $('#case').val();
        console.log(registerCode)
        console.log(T_BLACK_CASE)
        console.log(BLACK_CASE)
        console.log(BLACK_YY)
        console.log(T_RED_CASE)
        console.log(RED_CASE)
        console.log(RED_YY)
        /*   if (registerCode == '') {
              alert('กรุณากรอกเลขบัตรประชาชน')
              $('#registerCode').focus()
              return false
          } */
        /*   if (registerCode == ''&& (T_BLACK_CASE==''||BLACK_CASE==''||BLACK_YY=='')&& (T_RED_CASE==''||RED_CASE==''||PRE_CODE=='')) { */
        if (registerCode != '' || (T_BLACK_CASE != '' && BLACK_CASE != '' && BLACK_YY != '') || (T_RED_CASE != '' && RED_CASE != '' && RED_YY != '')) {
            if ((T_BLACK_CASE != '' && BLACK_CASE != '' && BLACK_YY != '') || (T_RED_CASE != '' && RED_CASE != '' && RED_YY != '')) {
                if (court_c == '') {
                    alert('กรุณาเลือกศาล')
                    $('#court_c').focus()
                    return false
                }
            }
            location.reload()
            $("#page").val(1);
            $("#frm-input")
                .attr("target", "")
                .attr("action", "")
                .submit();
        } else {
            alert('กรุณากรอกเลขบัตรประชาชน หรือ เลขคดีดำ คดีแดง')
            $('#registerCode').focus()
            return false
        }
    }

    function action_from(sh1, prefixBlackCase, blackCase, blackYy, prefixRedCase, redCase, redYy, CourtCode, courtName, concernName, fullName) {
        $('#sh1').val(sh1);
        $('#prefixBlackCase').val(prefixBlackCase);
        $('#blackCase').val(blackCase);
        $('#blackYy').val(blackYy);
        $('#prefixRedCase').val(prefixRedCase);
        $('#redCase').val(redCase);
        $('#redYy').val(redYy);
        $('#CourtCode').val(CourtCode);
        $('#courtName').val(courtName);
        $('#concernName').val(concernName);
        $('#fullName').val(fullName);
        $('#frm-input').attr('action', './cmd_add_from.php').submit();
    }
</script>