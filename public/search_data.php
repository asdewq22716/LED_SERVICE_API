<?php


include '../include/comtop_user.php'; //connect db

include '../include/combottom_js_user.php'; //function 
include '../include/func_Nop.php';
include "./btn_function.php";


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
            <input type="hidden" id="proc" name="proc">
            <input type="hidden" id="page" name="page" value="<?php echo $_GET["page"]; ?>">
            <input type="hidden" id="page_size" name="page_size" value="<?php echo $_GET["page_size"]; ?>">
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
                                                            <div class="col-xs-12 col-sm-2" align=""><label for="" class="form-control-label wf-right">เลขบัตรประชาชน </label></div>
                                                            <div class="col-xs-12 col-sm-3"><input class="form-control" type="text" oninput="input_Number(this)" name="REGISTERCODE" id="REGISTERCODE" value="<?php echo $_GET['REGISTERCODE']; ?>"></div>

                                                            <div class="col-xs-12 col-sm-2"><label for="" class="form-control-label wf-right">
                                                                    ศาล </label></div>
                                                            <div class="col-xs-12 col-sm-2">

                                                                <?php
                                                                $sql_court = "SELECT a.COURT_ID ,a.COURT_NAME ,a.COURT_CODE FROM M_COURT a";
                                                                $qry_court = db::query($sql_court);

                                                                ?>
                                                                <select name="COURT_NAME" id="COURT_NAME" class="form-control select2" tabindex="-1">
                                                                    <option value="">ทั้งหมด</option>
                                                                    <?php
                                                                    while ($rec = db::fetch_array($qry_court)) {

                                                                        $SELECT = $_GET['COURT_NAME'] == $rec['COURT_NAME'] ? "selected" : "";
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
                                                    $filter1 = "";
                                                    if ($_GET['REGISTERCODE'] != "") {
                                                        $filter1 .= " and TB.REGISTER_CODE in (" . result_array($_GET['REGISTERCODE'])  . ") ";
                                                    }

                                                    if ($_GET['COURT_NAME'] != "") {
                                                        $filter1 .= " AND TB.COURT_NAME = '" . $_GET['COURT_NAME'] . "' ";
                                                    }

                                                    /*    echo $_GET['T_BLACK_CASE'];
                                                    echo $_GET['BLACK_CASE'];
                                                    echo $_GET['BLACKYY']; */

                                                    if ($_GET['T_BLACK_CASE'] != "" && $_GET['BLACK_CASE'] != "" && $_GET['BLACK_YY'] != "") {

                                                        $filter1 .= " AND TB.PREFIX_BLACK_CASE  like '%" . $_GET['T_BLACK_CASE'] . "%' ";
                                                        $filter1 .= " AND TB.BLACK_CASE  like '%" . $_GET['BLACK_CASE'] . "%' ";
                                                        $filter1 .= " AND TB.BLACK_YY  like '%" . $_GET['BLACK_YY'] . "%' ";
                                                    }

                                                    if ($_GET['T_RED_CASE'] != "" && $_GET['RED_CASE'] != "" && $_GET['RED_YY'] != "") {

                                                        $filter1 .= " AND TB.PREFIX_RED_CASE  like '%" . $_GET['T_RED_CASE'] . "%' ";
                                                        $filter1 .= " AND TB.RED_CASE  like '%" . $_GET['RED_CASE'] . "%' ";
                                                        $filter1 .= " AND TB.RED_YY  like '%" . $_GET['RED_YY'] . "%' ";
                                                    }

                                                    if ($_GET['PRE_CODE'] != "") {
                                                        $text_N = 1;
                                                        foreach ($_GET['PRE_CODE'] as $A1) {
                                                            $result_PRE_CODE .= "'" . $A1 . "'" . (count($_GET['PRE_CODE']) == $text_N ? "" : ",");
                                                            $text_N++;
                                                        }
                                                        $filter1 .= " AND TB.CONCERN_NAME in (" . $result_PRE_CODE . ")  ";
                                                    }
                                                    if ($_GET['case'] != "") {
                                                        $text_N = 1;
                                                        foreach ($_GET['case'] as $A1) {
                                                            $result_case .= "'" . $A1 . "'" . (count($_GET['case']) == $text_N ? "" : ",");
                                                            $text_N++;
                                                        }
                                                        $filter1 .= " AND TB.SYSTEM_TYPE in (" . $result_case . ") ";
                                                    }
                                                    if ($filter1 != "") {
                                                        $sqlSelectDataALL_e =        "
                                                        SELECT 
                                                        TB.PK_ID ,TB.WH_ID,
                                                        TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                                                        TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                                                        TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                                                        TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                                                        TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                                                        TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                                                        TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME 
                                                        FROM VIEW_WH_ALL_CASE_PERSON TB 
                                                        WHERE 1=1 {$filter1}
                                                        GROUP BY TB.PK_ID ,TB.WH_ID,
                                                        TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
                                                        TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
                                                        TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
                                                        TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
                                                        TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
                                                        TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
                                                        TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME 
                                                        ORDER BY TB.SYSTEM_TYPE ASC
                                                        ";
                                                        $query_SelectDataALL_e = db::query(get_top($sqlSelectDataALL_e, $page, $page_size));
                                                    }

                                                    $num_b = db::num_rows($query_SelectDataALL_e);
                                                    if ($num_b > 0) {
                                                        $a = 1;
                                                        while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e)) {
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
                                                                    $a++;
                                                                    $A = ($recSelectDataAll['BLACK_CASE'] != '' && $recSelectDataAll['BLACK_YY'] != '') ? "/" : "";
                                                                    $B = ($recSelectDataAll['RED_CASE'] != '' && $recSelectDataAll['RED_YY'] != '') ? "/" : "";
                                                                    ?>
                                                                    <td><a onclick="show_detial_2(
									'<?php echo $recSelectDataAll['WH_ID'] ?>',
									'<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>',
									'<?php echo ($recSelectDataAll['REGISTER_CODE']) ?>');" href=""> <?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] . $recSelectDataAll['BLACK_CASE'] . $A . $recSelectDataAll['BLACK_YY']; ?></a></td>
                                                                    <td><a onclick="show_detial_2(
									'<?php echo $recSelectDataAll['WH_ID'] ?>',
									'<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>',
									'<?php echo ($recSelectDataAll['REGISTER_CODE']) ?>');" href=""><?php echo $recSelectDataAll['PREFIX_RED_CASE'] . $recSelectDataAll['RED_CASE'] . $B . $recSelectDataAll['RED_YY']; ?></a></td>
                                                                    <td><?php echo $recSelectDataAll['COURT_NAME']; ?></td>
                                                                    <td>
                                                                        <div class="form-group row" align='center'>
                                                                            <!-- button show_detial start-->
                                                                            <button type="button" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด" onclick="show_detial_2(
									'<?php echo $recSelectDataAll['WH_ID'] ?>',
									'<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>',
									'<?php echo ($recSelectDataAll['REGISTER_CODE']) ?>');" class="btn btn-info btn-mini"> <i class="icofont icofont-search"></i></button>
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
                                        <div class="clearfix"></div>
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
                                        <?php
                                        $total_CMD = db::num_rows(db::query($sqlSelectDataALL_e));
                                        /* echo @(ceil($total_CMD / $page_size) > 1) ? endPaging("frm-input", $total_CMD) : "";  */
                                        echo @(ceil($total_CMD) > 1) ? endPaging("frm-input", $total_CMD) : "";
                                        ?>
                                        <div class="clearfix"></div>
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
        var url = "./search_data_show_detial2.php?PREFIX_BLACK_CASE=" + PREFIX_BLACK_CASE + "&BLACK_CASE=" + BLACK_CASE + "&BLACK_YY=" + BLACK_YY +
            "&PREFIX_RED_CASE=" + PREFIX_RED_CASE + "&RED_CASE=" + RED_CASE + "&RED_YY=" + RED_YY +
            "&COURT_CODE=" + COURT_CODE + "&SYSTEM_ID=" + SYSTEM_ID + "&REGISTER_CODE=" + REGISTER_CODE + "&SYSTEM_TYPE=" + SYSTEM_TYPE;
        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
    }

    function show_detial_2(WH_ID, SYSTEM_TYPE, IDCARD) {
        var url = "./search_data_show_detial2.php?WH_ID=" + WH_ID + "&SYSTEM_TYPE=" + SYSTEM_TYPE + "&IDCARD=" + IDCARD
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

        let COURT_NAME = $('#COURT_NAME').val();
        let PRE_CODE = $('#PRE_CODE').val();
        let case_c = $('#case').val();
        /* console.log(registerCode)
        console.log(T_BLACK_CASE)
        console.log(BLACK_CASE)
        console.log(BLACK_YY)
        console.log(T_RED_CASE)
        console.log(RED_CASE)
        console.log(RED_YY) */

        if (registerCode != '' || (T_BLACK_CASE != '' && BLACK_CASE != '' && BLACK_YY != '') || (T_RED_CASE != '' && RED_CASE != '' && RED_YY != '')) {
            if ((T_BLACK_CASE != '' && BLACK_CASE != '' && BLACK_YY != '') || (T_RED_CASE != '' && RED_CASE != '' && RED_YY != '')) {
                if (COURT_NAME == '') {
                    alert('กรุณาเลือกศาล')
                    $('#COURT_NAME').focus()
                    return false
                }
            }
            location.reload()
            $("#page").val(1);
            $("#page_size").val(20);
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

    /* function action_from(sh1, prefixBlackCase, blackCase, blackYy, prefixRedCase, redCase, redYy, CourtCode, courtName, concernName, fullName) {
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
    } */
    function action_from(sh1, prefixBlackCase, blackCase, blackYy, prefixRedCase, redCase, redYy, CourtCode, courtName, concernName, fullName) {
        /* $('#sh1').val(sh1);
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
        $('#proc').val('search_data_add'); */

        let url = "./cmd_add_from.php?";
        url += "&receive_case=" + sh1;

        url += "&receive_prefixBlackCase=" + prefixBlackCase;
        url += "&receive_blackCase=" + blackCase;
        url += "&receive_blackYy=" + blackYy;

        url += "&receive_prefixRedCase=" + prefixRedCase;
        url += "&receive_redCase=" + redCase;
        url += "&receive_redYy=" + redYy;

        url += "&receive_CourtCode=" + CourtCode;
        url += "&receive_courtName=" + courtName;
        url += "&receive_concernName=" + concernName;
        url += "&receive_fullName=" + fullName;
        url += "&proc=" + 'search_data_add';
        // window.location.href = url;
        window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
        //$('#frm-input').attr('action', './cmd_add_from.php').submit();
    }
</script>