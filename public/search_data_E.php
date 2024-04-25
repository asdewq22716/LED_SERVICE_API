<?php


include '../include/comtop_user.php'; //connect db
include '../include/combottom_js_user.php'; //function 
include '../include/func_Nop.php';
include "./btn_function.php";



?>


<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <form method="GET" action="./search_data_E.php" enctype="multipart/form-data" id="frm-input">
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
            <input type="hidden" id="proc" name="proc">
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
                                                            <div class="col-xs-12 col-sm-2">
                                                                <label for="" class="form-control-label wf-right">เลือกวิธีการตรวจสอบ </label>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3">
                                                                <select name="check_type" id="check_type" class="form-control">
                                                                    <option value="">กรุณาเลือก</option>
                                                                    <option <?php echo $_GET['check_type'] == 'couple' ? 'selected' : '' ?> value="couple">ตรวจสอบเเบบคู่</option>
                                                                    <option <?php echo $_GET['check_type'] == 'cross' ? 'selected' : '' ?> value="cross">ตรวจสอบเเบบไขว้</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-xs-12 col-sm-2">
                                                                <label for="" class="form-control-label wf-right">เลขบัตรประชาชน </label>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3"><input class="form-control" type="text" name="REGISTERCODE_1" id="REGISTERCODE_1" oninput="input_Number(this)" value="<?php echo $_GET['REGISTERCODE_1']; ?>"></div>
                                                            <div class="col-xs-12 col-sm-2">
                                                                <label for="" class="form-control-label wf-right">เลขบัตรประชาชน </label>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3"><input class="form-control" type="text" name="REGISTERCODE_2" id="REGISTERCODE_2" oninput="input_Number(this)" value="<?php echo $_GET['REGISTERCODE_2']; ?>"></div>
                                                        </div>
                                                        <div class="form-group row">
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
                                                            <div class="col-xs-12 col-sm-2"><label for="" class="form-control-label wf-right">ประเภทคดี </label></div>
                                                            <div class="col-xs-12 col-sm-3">
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
                                                                <button type="button" class="btn btn-primary" onClick="search_Data();">ค้นหา</button>
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
                                                    $filter1 = "";
                                                    $filter_SYSTEM_TYPE = "";
                                                    $filter_1 = "";
                                                    $filter_2 = "";
                                                    $check = '';
                                                    if ($_GET['check_type'] == 'couple') { //คู่ เลือกรายการที่REGISTERCODE_1 เป็นโจทย์ และREGISTERCODE_2 เป็นจำเลย
                                                        $check = '1';
                                                        if ($_GET['case'] != "") {
                                                            $filter_SYSTEM_TYPE .= " AND TB3.SYSTEM_TYPE in (" . sort_array($_GET['case']) . ") ";
                                                        }
                                                        if ($_GET['REGISTERCODE_1'] != "") {

                                                            $filter_1 = "  AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_1'])) . ")
                                                                                AND TB2.CONCERN_NAME in ('โจทก์')";
                                                        }
                                                        if ($_GET['REGISTERCODE_2'] != "") {
                                                            $filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_2'])) . ")
                                                                               AND TB2.CONCERN_NAME in ('จำเลย')";
                                                        }
                                                    }
                                                    if ($_GET['check_type'] == 'cross') { //ไขว้
                                                        $check = '2';
                                                        if ($_GET['case'] != "") {
                                                            $filter_SYSTEM_TYPE .= " AND TB3.SYSTEM_TYPE in (" . sort_array($_GET['case']) . ") ";
                                                        }
                                                        if ($_GET['REGISTERCODE_1'] != "") {

                                                            $filter_1 = " AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_1'])) . ")";
                                                        }
                                                        if ($_GET['REGISTERCODE_2'] != "") {
                                                            $filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_2'])) . ")";
                                                        }
                                                    }
                                                    if ($check > 0) {
                                                        $sql_ALL = "SELECT 
                                                        TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                                                        TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                                                        TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                                                        TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                                                        TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                                                        TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                                                        TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
                                                        FROM VIEW_WH_ALL_CASE_PERSON TB 
                                                        WHERE 1=1 
                                                         AND EXISTS (	
                                                         SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
                                                         WHERE 1=1 
                                                         AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
                                                         AND TB2.BLACK_CASE=TB.BLACK_CASE 
                                                         AND TB2.BLACK_YY=TB.BLACK_YY 
                                                         AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                                                         AND TB2.RED_CASE = TB.RED_CASE 
                                                         AND TB2.RED_YY = TB.RED_YY 
                                                        {$filter_1})
                                                         AND EXISTS (
                                                         SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
                                                         WHERE 1=1
                                                         AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
                                                         AND TB2.BLACK_CASE=TB.BLACK_CASE
                                                         AND TB2.BLACK_YY=TB.BLACK_YY 
                                                         AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
                                                         AND TB2.RED_CASE = TB.RED_CASE 
                                                         AND TB2.RED_YY = TB.RED_YY 
                                                         {$filter_2})
			                                        AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_1']) . "," . result_array($_GET['REGISTERCODE_2']) . ")
                                                    {$filter_SYSTEM_TYPE}
                                                    GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                                                    TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                                                    TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                                                    TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                                                    TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                                                    TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                                                    TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
                                                    ORDER BY TB.CONERNSEQ ASC,TB.SYSTEM_TYPE ASC,
                                                    CASE
                                                         WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NOT NULL THEN 1
                                                         WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NULL THEN 2
                                                         WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NOT NULL THEN 3
                                                         WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NULL THEN 4
                                                        ELSE 5
                                                    END
                                                     ";
                                                    }
                                                    ?>
                                                    <?php
                                                    // echo  $sql_ALL;

                                                    $querySelectDataALL = db::query($sql_ALL);
                                                    $num_b = db::num_rows($querySelectDataALL);
                                                    if ($num_b > 0) {
                                                        while ($recSelectDataAll = db::fetch_array($querySelectDataALL)) {

                                                            $num_a = 1;
                                                            $num_a1 = 1;
                                                            $show_word = '';

                                                            if ($D_TYPE_RE != $recSelectDataAll['SYSTEM_TYPE']) {
                                                                if ($recSelectDataAll['SYSTEM_TYPE'] == 'Mediate') {
                                                                    $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบไกล่เกลี่ย';
                                                                    $SYSTEM_ID = "";
                                                                } else if ($recSelectDataAll['SYSTEM_TYPE'] == 'Bankrupt') {
                                                                    $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบล้มละลาย';
                                                                    $SYSTEM_ID = 2;
                                                                } else if ($recSelectDataAll['SYSTEM_TYPE'] == 'Revive') {
                                                                    $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบฟื้นฟู';
                                                                    $SYSTEM_ID = "";
                                                                } else if ($recSelectDataAll['SYSTEM_TYPE'] == 'Backoffice') {
                                                                    $show_word = 'Backoffice';
                                                                    $SYSTEM_ID = "";
                                                                } else if ($recSelectDataAll['SYSTEM_TYPE'] == 'Civil') {
                                                                    $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในแพ่ง';
                                                                    $SYSTEM_ID = 1;
                                                                }
                                                                $D_TYPE_RE = $recSelectDataAll['SYSTEM_TYPE'];
                                                    ?>
                                                                <tr>
                                                                    <td colspan="10" style="background-color:#dc3545 ;color:aliceblue;"><?php echo $show_word; ?></td>
                                                                </tr>
                                                            <?php
                                                                $a = 1;
                                                            }
                                                            ?>
                                                            <tr style="background-color: #E6E6FA;">
                                                                <div>
                                                                    <td>
                                                                        <div align='center'><?php echo $a; ?></div>
                                                                    </td>
                                                                    <td><?php echo $recSelectDataAll['REGISTER_CODE']; ?></td>
                                                                    <td><?php echo $recSelectDataAll['PREFIX_NAME'] . " " . $recSelectDataAll['FIRST_NAME'] . " " . $recSelectDataAll['LAST_NAME']; ?></td>
                                                                    <td><?php echo $recSelectDataAll['CONCERN_NAME']; ?></td>
                                                                    <?php
                                                                    $A = ($recSelectDataAll['BLACK_CASE'] != '' && $recSelectDataAll['BLACK_YY'] != '') ? "/" : "";
                                                                    $B = ($recSelectDataAll['RED_CASE'] != '' && $recSelectDataAll['RED_YY'] != '') ? "/" : "";
                                                                    ?>
                                                                    <td><a onclick="show_detial(
                                                                                        '<?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['BLACK_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['BLACK_YY'] ?>',
                                                                                        '<?php echo $recSelectDataAll['PREFIX_RED_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['RED_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['RED_YY'] ?>',
                                                                                        '<?php echo $recSelectDataAll['COURT_CODE'] ?>',
                                                                                        '<?php echo $SYSTEM_ID ?>',
                                                                                        '<?php echo $recSelectDataAll['REGISTER_CODE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>');" href=""> <?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] . $recSelectDataAll['BLACK_CASE'] . $A . $recSelectDataAll['BLACK_YY']; ?></a></td>
                                                                    <td><a onclick="show_detial(
                                                                                        '<?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['BLACK_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['BLACK_YY'] ?>',
                                                                                        '<?php echo $recSelectDataAll['PREFIX_RED_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['RED_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['RED_YY'] ?>',
                                                                                        '<?php echo $recSelectDataAll['COURT_CODE'] ?>',
                                                                                        '<?php echo $SYSTEM_ID ?>',
                                                                                        '<?php echo $recSelectDataAll['REGISTER_CODE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>');" href=""><?php echo $recSelectDataAll['PREFIX_RED_CASE'] . $recSelectDataAll['RED_CASE'] . $B . $recSelectDataAll['RED_YY']; ?></a></td>
                                                                    <td><?php echo $recSelectDataAll['COURT_NAME']; ?></td>
                                                                    <td>
                                                                        <div class="form-group row" align='center'>
                                                                            <!-- button show_detial start-->
                                                                            <button type="button" onclick="show_detial(
                                                                                        '<?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['BLACK_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['BLACK_YY'] ?>',
                                                                                        '<?php echo $recSelectDataAll['PREFIX_RED_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['RED_CASE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['RED_YY'] ?>',
                                                                                        '<?php echo $recSelectDataAll['COURT_CODE'] ?>',
                                                                                        '<?php echo $SYSTEM_ID ?>',
                                                                                        '<?php echo $recSelectDataAll['REGISTER_CODE'] ?>',
                                                                                        '<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>');" class="btn btn-info btn-mini"> <i class="icofont icofont-search"></i>ดูรายละเอียด</button>
                                                                            <!-- button show_detial stop-->
                                                                        </div>

                                                                        <div class="form-group row" align='center'>
                                                                            <button type="button" class="btn btn-success btn-mini" onclick="action_from('<?php echo $recSelectDataAll['SYSTEM_TYPE']; ?>','<?php echo $recSelectDataAll['PREFIX_BLACK_CASE']; ?>',  
                                                                                       '<?php echo $recSelectDataAll['BLACK_CASE']; ?>','<?php echo $recSelectDataAll['BLACK_YY']; ?>','<?php echo $recSelectDataAll['PREFIX_RED_CASE']; ?>',
                                                                                       '<?php echo $recSelectDataAll['RED_CASE']; ?>','<?php echo $recSelectDataAll['RED_YY']; ?>','<?php echo $recSelectDataAll['COURT_CODE']; ?>','<?php echo $recSelectDataAll['COURT_NAME']; ?>',
                                                                                       '<?php echo $recSelectDataAll['CONCERN_NAME']; ?>','<?php echo $recSelectDataAll['PREFIX_NAME'] . ' ' . $recSelectDataAll['FIRST_NAME'] . ' ' . $recSelectDataAll['LAST_NAME']; ?>');">คำสั่งเจ้าพนักงาน</button>
                                                                        </div>
                                                                        <?php
                                                                        ?>
                                                                    </td>
                                                                </div>
                                                            </tr>
                                                            <?php
                                                            /* ทรัพ start*/
                                                            show_asset(
                                                                $recSelectDataAll['PREFIX_BLACK_CASE'],
                                                                $recSelectDataAll['BLACK_CASE'],
                                                                $recSelectDataAll['BLACK_YY'],
                                                                $recSelectDataAll['PREFIX_RED_CASE'],
                                                                $recSelectDataAll['RED_CASE'],
                                                                $recSelectDataAll['RED_YY'],
                                                                $recSelectDataAll['COURT_CODE'],
                                                                $SYSTEM_ID,
                                                                $recSelectDataAll['REGISTER_CODE']
                                                            );
                                                            /* ทรัพ stop*/
                                                            ?>
                                                        <?php
                                                            $num_a++;
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
    function show_detial(PREFIX_BLACK_CASE, BLACK_CASE, BLACK_YY, PREFIX_RED_CASE, RED_CASE, RED_YY, COURT_CODE, SYSTEM_ID, REGISTER_CODE, SYSTEM_TYPE) {
        //let brcId_CivilToWh_fast = $('#brcId_CivilToWh_fast').val();
        var url = "./search_data_show_detial.php?PREFIX_BLACK_CASE=" + PREFIX_BLACK_CASE + "&BLACK_CASE=" + BLACK_CASE + "&BLACK_YY=" + BLACK_YY +
            "&PREFIX_RED_CASE=" + PREFIX_RED_CASE + "&RED_CASE=" + RED_CASE + "&RED_YY=" + RED_YY +
            "&COURT_CODE=" + COURT_CODE + "&SYSTEM_ID=" + SYSTEM_ID + "&REGISTER_CODE=" + REGISTER_CODE + "&SYSTEM_TYPE=" + SYSTEM_TYPE;
        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }

    function input_Number(input) {
        // ลบตัวอักษรที่ไม่ใช่ตัวเลขทั้งหมด
        input.value = input.value.replace(/[^,0-9]/g, '');

        // คั้นระหว่างตัวเลขทุก 13 ตัวด้วยเครื่องหมาย "-"
        const valueLength = input.value.length;
        if (valueLength > 13) {
            const formattedValue = input.value.replace(/(\d{13})(?=\d)/g, '$1,');
            input.value = formattedValue;
        }
    }

    function btn_clear() {
        history.replaceState({}, document.title, window.location.pathname);
        window.location = 'http://103.208.27.224:81/led_service_api/public/search_data_E.php'

    }

    function search_Data() {
        let check_type = $('#check_type').val();
        let REGISTERCODE_1 = $('#REGISTERCODE_1').val();
        let REGISTERCODE_2 = $('#REGISTERCODE_2').val();
        if (check_type == '') {
            $('#check_type').val('')
            $('#check_type').focus()
            alert('กรุณาเลือกวิธีการตรวจสอบ');
            return false
        }
        if (REGISTERCODE_1 == '') {
            $('#REGISTERCODE_1').val('')
            $('#REGISTERCODE_1').focus()
            alert('กรุณากรอกเลขบัตรประชาชนให้ครบถ้วน');
            return false
        }
        if (REGISTERCODE_2 == '') {
            $('#REGISTERCODE_2').val('')
            $('#REGISTERCODE_2').focus()
            alert('กรุณากรอกเลขบัตรประชาชนให้ครบถ้วน');
            return false
        }
        $("#frm-input").attr("target", "").attr("action", "").submit();
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
        $('#proc').val('search_data_add');
        $('#frm-input').attr('action', './cmd_add_from.php').submit();
    }
</script>