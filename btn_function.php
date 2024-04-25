<?php


/* java start */
?>
<script>
    function show_asset_detail(asset_id) {
        window.open("show_asset_detail.php?ASSET_ID=" + asset_id, "รายละเอียดทรัพย์", "width=800,height=700");
    }
</script>
<?php
/* java stop */
/* function กลาง start */
//print_r_pre($_POST);
//print_r_pre($page_size);
function get_top($sql = "", $page = "", $page_size = "")
{
    $P = $page_size - 1;
    $offset = ($page * $page_size) - $P;
    $limit = $page * $page_size;
    return $sql_limit = 'select * from ( select AAAA.*, rownum rnum from ( ' . $sql . ' ) AAAA ) where rnum between ' . $offset . ' and ' . $limit . ' ';
}

/* function กลาง stop */
function show_person_table( //บุคคลในคดี
    $PREFIX_BLACK_CASE = '',
    $BLACK_CASE = '',
    $BLACK_YY = '',
    $PREFIX_RED_CASE = '',
    $RED_CASE = '',
    $RED_YY = '',
    $COURT_CODE = '',
    $IDCARD
) {
    $fill = "";
    if ($PREFIX_BLACK_CASE != "") {
        $fill .= " AND TB.PREFIX_BLACK_CASE  like '%" . $PREFIX_BLACK_CASE . "%'";
    }
    if ($BLACK_CASE != "") {
        $fill .= " AND TB.BLACK_CASE  like '%" . $BLACK_CASE . "%'";
    }
    if ($BLACK_YY != "") {
        $fill .= "AND TB.BLACK_YY  like '%" . $BLACK_YY . "%'";
    }
    if ($PREFIX_RED_CASE != "") {
        $fill .= "AND TB.PREFIX_RED_CASE  like '%" . $PREFIX_RED_CASE . "%'";
    }
    if ($RED_CASE != "") {
        $fill .= "AND TB.RED_CASE  like '%" . $RED_CASE . "%'";
    }
    if ($RED_YY != "") {
        $fill .= "  AND TB.RED_YY  like '%" . $RED_YY . "%'";
    }
    if ($IDCARD != "") {
        $fill_case = "WHEN TB.REGISTER_CODE IN (" . result_array($IDCARD) . ") THEN 1";
        $hilightIDCARD = explode(",", $IDCARD);
    }
    $sql_viwe_all = "
    SELECT 
    TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
    TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
    TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
    TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
    TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
    TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
    TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
    FROM VIEW_WH_ALL_CASE_PERSON TB 
    WHERE 1=1 
    {$fill}
    AND TB.COURT_CODE = '" . $COURT_CODE . "'
    GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
    TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
    TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
    TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
    TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
    TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
    TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
    ORDER BY 
    CASE
        {$fill_case}
        WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NOT NULL THEN 2
        WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NULL THEN 3
        WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NOT NULL THEN 4
        WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NULL THEN 5
        ELSE 5
    END,TB.CONERNSEQ ASC ,
	TB.CONCERN_NAME DESC ,
	TB.CONCERN_NO ASC
    ";
    $fill = "";
    //echo $sql_viwe_all;

    //$query_viwe_all = db::query($sql_viwe_all);
    //$num_viwe_all = db::num_rows($query_viwe_all);

    global $page2, $page_size2;
    //echo get_top($sql_viwe_all, $page2, $page_size2);
    $query_viwe_all = db::query(get_top($sql_viwe_all, $page2, $page_size2));
    $total_viwe_all = db::num_rows(db::query($sql_viwe_all));
?>
    <div class="table-responsive">
        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
            <thead class="bg-primary">
                <th class="text-center">ลำดับ</th>
                <th class="text-center">รายที่</th>
                <th class="text-center">เลขบัตรประชาชน</th>
                <th class="text-center">ชื่อ-สกุล</th>
                <th class="text-center">สถานะ</th>
            </thead>

            <?php
            // if ($num_viwe_all > 0) {
            if ($total_viwe_all > 0) {
                $a_viwe_all = 0;
                while ($rec_viwe_all = db::fetch_array($query_viwe_all)) {
                    $a_viwe_all++;

                    if (in_array($rec_viwe_all['REGISTER_CODE'], $hilightIDCARD)) {
                        $background = "#e6ee9c";
                    } else {
                        $background = "#E6E6FA";
                    }
            ?>
                    <tr style="background-color:<?php echo  $background; ?>;">
                        <div>
                            <td>
                                <div align='center'><?php echo $a_viwe_all; ?></div>
                            </td>
                            <td>
                                <div align='center'><?php echo $rec_viwe_all['CONCERN_NO']; ?></div>
                            </td>
                            <td><?php echo $rec_viwe_all['REGISTER_CODE']; ?></td>
                            <td><?php echo $rec_viwe_all['PREFIX_NAME'] . " " . $rec_viwe_all['FIRST_NAME'] . " " . $rec_viwe_all['LAST_NAME']; ?></td>
                            <td><?php echo $rec_viwe_all['CONCERN_NAME']; ?></td>
                        </div>
                    </tr>
                <?php
                }
            } else {
                ?>
                <td colspan="4">
                    <div align='center'>ไม่พบข้อมูล</div>
                </td>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="row">
        <!-- <?php echo @(ceil($total_viwe_all / $page_size2) > 1) ? endPaging2("frm-input", $total_viwe_all) : ""; ?> -->
        <?php echo endPaging2("frm-input", $total_viwe_all) ?>
    </div>
<?php
}

function show_table_ROUTE( //ทางเดินสำนวน
    $PREFIX_BLACK_CASE = '',
    $BLACK_CASE = '',
    $BLACK_YY = '',
    $PREFIX_RED_CASE = '',
    $RED_CASE = '',
    $RED_YY = '',
    $COURT_CODE = ''
) {
    global $page, $page_size;

    $fill = "";
    if ($PREFIX_BLACK_CASE != "") {
        $fill .= " AND b.PREFIX_BLACK_CASE LIKE '%" . $PREFIX_BLACK_CASE . "%'";
    }
    if ($BLACK_CASE != "") {
        $fill .= " AND b.BLACK_CASE ='" . $BLACK_CASE . "'";
    }
    if ($BLACK_YY != "") {
        $fill .= "AND b.BLACK_YY ='" . $BLACK_YY . "'";
    }
    if ($PREFIX_RED_CASE != "") {
        $fill .= "AND b.PREFIX_RED_CASE LIKE '%" . $PREFIX_RED_CASE . "%'";
    }
    if ($RED_CASE != "") {
        $fill .= "AND b.RED_CASE ='" . $RED_CASE . "'";
    }
    if ($RED_YY != "") {
        $fill .= "  AND b.RED_YY ='" . $RED_YY . "'";
    }
    $SQL_ROUTE = "SELECT a.CREATE_DATE ,a.ACT_DESC FROM WH_CIVIL_ROUTE a
	JOIN WH_CIVIL_CASE b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
	WHERE 1=1
    {$fill}
	AND b.COURT_CODE ='" . $COURT_CODE . "'
	ORDER BY a.CREATE_DATE ASC ";

    /*  a.WH_ROUTE_ID ASC, */

    $queryROUTE = db::query(get_top($SQL_ROUTE, $page, $page_size));

    $total_ROUTE = db::num_rows(db::query($SQL_ROUTE));
    $fill = "";
?>

    <div class="row" class="col-md-12" style="margin: 10px 10px 10px 10px;">
        <div class="table-responsive">
            <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                <thead class="thead-dark">
                    <tr>
                        <th style="background-color: #dc3545;color: white;">ลำดับ</th>
                        <th style="background-color: #dc3545;color: white;">วันที่ดำเนินการ</th>
                        <th style="background-color: #dc3545;color: white;">รายการ</th>
                    </tr>
                </thead>
                <?php
                if ($total_ROUTE > 0) {
                    $n_ROUTE = 0;
                    while ($recROUTE = db::fetch_array($queryROUTE)) {
                        $n_ROUTE++;
                ?>
                        <tr style="background-color: #E6E6FA;">
                            <td>
                                <div><?php echo $n_ROUTE; ?></div>
                            </td>
                            <td>
                                <div><?php echo date_AK65($recROUTE['CREATE_DATE']); ?></div>
                            </td>
                            <td>
                                <div><?php echo $recROUTE['ACT_DESC']; ?></div>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="3">
                            <div align='center'>ไม่พบข้อมูล</div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <div class="row">
        <?php echo @(ceil($total_ROUTE / $page_size) > 1) ? endPaging("frm-input", $total_ROUTE) : ""; ?>
    </div>
<?php
}

function show_asset_table( //ทรัพ 
    $PREFIX_BLACK_CASE = '',
    $BLACK_CASE = '',
    $BLACK_YY = '',
    $PREFIX_RED_CASE = '',
    $RED_CASE = '',
    $RED_YY = '',
    $COURT_CODE = '',
    $SYSTEM_ID = ''
) {
    $filter = "";

    if ($PREFIX_BLACK_CASE != "") {
        $filter .= " and b.PREFIX_BLACK_CASE = '" .  $PREFIX_BLACK_CASE . "'	";
    }
    if ($BLACK_CASE != "") {
        $filter .= " and b.BLACK_CASE = '" . $BLACK_CASE . "'	";
    }
    if ($BLACK_YY != "") {
        $filter .= " and b.BLACK_YY = '" . $BLACK_YY . "'	";
    }
    if ($PREFIX_RED_CASE != "") {
        $filter .= " and b.PREFIX_RED_CASE = '" . $PREFIX_RED_CASE . "'	";
    }
    if ($RED_CASE != "") {
        $filter .= " and b.RED_CASE = '" . $RED_CASE . "'	";
    }
    if ($RED_YY != "") {
        $filter .= " and b.RED_YY = '" . $RED_YY . "'	";
    }

    if ($COURT_CODE != "" && $SYSTEM_ID != 6) {
        if ($SYSTEM_ID == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
            //  $filter .= " and COURT_ID = '" . $_POST['COURT_CODE'] . "'	";
        } else {
            $filter .= " and COURT_CODE = '" . $COURT_CODE . "'	";
        }
    }

    $arrDataAsset = array();
    if ($SYSTEM_ID == '1') { //ระบบงานบังคับคดีแพ่ง
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,CFC_CAPTION_GEN
         from 		WH_CIVIL_CASE_ASSETS a 
         inner join 	WH_CIVIL_CASE b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
         where 		1=1 AND ASSET_ID IS NOT NULL  {$filter}";
        }
    } else if ($SYSTEM_ID == '2') { //ระบบงานบังคับคดีล้มละลาย
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE
         from 		WH_BANKRUPT_ASSETS a 
         inner join 	WH_BANKRUPT_CASE_DETAIL b on a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID
         where 		1=1 {$filter}";
        }
    } else if ($SYSTEM_ID == '6') { //ระบบงาน DEBTOR
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		WH_ASSET_ID as ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,M_ASSET_KEY,ASSET_TYPE_ID
         from 		WH_DEBTOR_ASSETS
         where 		1=1 AND PROP_TITLE is not null AND WH_ASSET_ID IS NOT NULL  {$filter}";
        }
    }
    /* echo $sqlSelectDataAsset;
    exit; */
    $querySelectDataAsset = db::query($sqlSelectDataAsset);
    $num_r = db::num_rows($querySelectDataAsset);
?>
    <style>

    </style>
    <div class="row" class="col-md-12" style="margin: 10px 10px 10px 10px;">
        <div class="table-responsive">
            <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                <thead class="thead-dark">
                    <tr>
                        <th style="background-color: #dc3545;color: white;">ลำดับรายการทรัพย์</th>
                        <th style="background-color: #dc3545;color: white;">ชื่อรายการทรัพย์</th>
                        <th style="background-color: #dc3545;color: white;">สถานะ</th>
                        <th style="background-color: #dc3545;color: white;">เกี่ยวข้องเป็น</th>
                    </tr>
                </thead>
                <?php
                if ($num_r > 0) {
                ?>
                    <?php

                    $T = 1;
                    while ($recSelectDataAsset = db::fetch_array($querySelectDataAsset)) {
                    ?>
                        <tr style="background-color: #E6E6FA;">
                            <td>
                                <div align="center"><?php echo $T; ?></div>
                            </td>
                            <td><a onclick="show_asset_detail(<?php echo $recSelectDataAsset['ASSET_ID']; ?>)" href="javascript:void();"><?php echo $recSelectDataAsset["PROP_TITLE"]; ?></a></td>
                            <td> <?php echo $recSelectDataAsset['PROP_STATUS_NAME']; ?></td>
                            <?php
                            $sql_owner = "SELECT *FROM WH_CIVIL_CASE_ASSET_OWNER b 
                                            JOIN WH_CIVIL_CASE_PERSON c ON b.WH_CIVIL_ID =c.WH_CIVIL_ID AND b.PERSON_NAME =c.FULL_NAME 
                                            WHERE 1=1 
                                            AND b.ASSET_ID ='" . $recSelectDataAsset['ASSET_ID'] . "'";

                            if ($SYSTEM_ID == '1') {
                            ?>
                                <td>
                                    <table>
                                        <?php
                                        $queryowner = db::query($sql_owner);
                                        while ($rec_owner = db::fetch_array($queryowner)) {
                                            /*  if ($rec_owner['HOLDING_GROUP'] == '01') {
                                                $HOLDING_GROUP = "จำเลยและผู้ถือกรรมสิทธิ์ร่วม";
                                            } else if ($rec_owner['HOLDING_GROUP'] == '02') {
                                                $HOLDING_GROUP = "ทายาท ผู้จัดการมรดก หรือบุคคนอื่นๆที่เกี่ยวข้อง";
                                            } else if ($rec_owner['HOLDING_GROUP'] == '03') {
                                                $HOLDING_GROUP = "ผู้รับจำนอง";
                                            } */
                                        ?>
                                            <tr>
                                                <td><?php echo $rec_owner['FULL_NAME']; ?></td>
                                                <td><?php echo $rec_owner['CONCERN_NAME']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                            <?php } else if ($SYSTEM_ID == '2') { ?>
                                <td>

                                </td>
                            <?php
                            } ?>
                        </tr>
                    <?php
                        $T++;
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4">
                            <div align='center'>ไม่พบข้อมูล</div>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </table>
        </div>
    </div>
    <?php
    /* ทรัพ */
}

function show_asset( //ทรัพที่เเสดงใน search_data
    $PREFIX_BLACK_CASE = '',
    $BLACK_CASE = '',
    $BLACK_YY = '',
    $PREFIX_RED_CASE = '',
    $RED_CASE = '',
    $RED_YY = '',
    $COURT_CODE = '',
    $SYSTEM_ID = '',
    $REGISTER_CODE = ''
) {
    $filter = "";

    if ($PREFIX_BLACK_CASE != "") {
        $filter .= " and b.PREFIX_BLACK_CASE = '" .  $PREFIX_BLACK_CASE . "'	";
    }
    if ($BLACK_CASE != "") {
        $filter .= " and b.BLACK_CASE = '" . $BLACK_CASE . "'	";
    }
    if ($BLACK_YY != "") {
        $filter .= " and b.BLACK_YY = '" . $BLACK_YY . "'	";
    }
    if ($PREFIX_RED_CASE != "") {
        $filter .= " and b.PREFIX_RED_CASE = '" . $PREFIX_RED_CASE . "'	";
    }
    if ($RED_CASE != "") {
        $filter .= " and b.RED_CASE = '" . $RED_CASE . "'	";
    }
    if ($RED_YY != "") {
        $filter .= " and b.RED_YY = '" . $RED_YY . "'	";
    }

    if ($COURT_CODE != "" && $SYSTEM_ID != 6) {
        if ($SYSTEM_ID == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
            //  $filter .= " and COURT_ID = '" . $_POST['COURT_CODE'] . "'	";
        } else {
            $filter .= " and COURT_CODE = '" . $COURT_CODE . "'	";
        }
    }

    $arrDataAsset = array();
    if ($SYSTEM_ID == '1') { //ระบบงานบังคับคดีแพ่ง
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,CFC_CAPTION_GEN
         from 		WH_CIVIL_CASE_ASSETS a 
         inner join 	WH_CIVIL_CASE b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
         where 		1=1 AND ASSET_ID IS NOT NULL  {$filter}";
        }
    } else if ($SYSTEM_ID == '2') { //ระบบงานบังคับคดีล้มละลาย
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE
         from 		WH_BANKRUPT_ASSETS a 
         inner join 	WH_BANKRUPT_CASE_DETAIL b on a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID
         where 		1=1 {$filter}";
        }
    } else if ($SYSTEM_ID == '6') { //ระบบงานบังคับคดีล้มละลาย
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		WH_ASSET_ID as ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,M_ASSET_KEY,ASSET_TYPE_ID
         from 		WH_DEBTOR_ASSETS
         where 		1=1 AND PROP_TITLE is not null AND WH_ASSET_ID IS NOT NULL  {$filter}";
        }
    }
    //echo $filter;
    //echo  $sqlSelectDataAsset."<br><br>";

    $querySelectDataAsset = db::query($sqlSelectDataAsset);
    $num_r = db::num_rows($querySelectDataAsset);
    if ($num_r > 0) {
    ?>
        <tr>
            <td></td>
            <td style="background-color: #D4B6B8;">ลำดับรายการทรัพย์</td>
            <td style="background-color: #D4B6B8;">ชื่อรายการทรัพย์</td>
            <td style="background-color: #D4B6B8;">สถานะ</td>
            <td style="background-color: #D4B6B8;">เกี่ยวข้องเป็น</td>
        </tr>
    <?php
    }
    $T = 1;
    while ($recSelectDataAsset = db::fetch_array($querySelectDataAsset)) {
    ?>
        <tr>
            <td></td>
            <td style="background-color: #fff8ec;">
                <div align="center"><?php echo $T; ?></div>
            </td>
            <td style="background-color: #fff8ec;"> <?php echo $recSelectDataAsset['PROP_TITLE']; ?></td>
            <td style="background-color: #fff8ec;"> <?php echo $recSelectDataAsset['PROP_STATUS_NAME']; ?></td>
            <?php
            $sql_owner = "SELECT *FROM WH_CIVIL_CASE_ASSET_OWNER b 
                                            JOIN WH_CIVIL_CASE_PERSON c ON b.WH_CIVIL_ID =c.WH_CIVIL_ID AND b.PERSON_NAME =c.FULL_NAME 
                                            WHERE 1=1 
                                            AND b.ASSET_ID ='" . $recSelectDataAsset['ASSET_ID'] . "'";

            if ($SYSTEM_ID == '1') {
            ?>
                <td>
                    <table>
                        <?php
                        $queryowner = db::query($sql_owner);
                        while ($rec_owner = db::fetch_array($queryowner)) {
                            /*  if ($rec_owner['HOLDING_GROUP'] == '01') {
                                                $HOLDING_GROUP = "จำเลยและผู้ถือกรรมสิทธิ์ร่วม";
                                            } else if ($rec_owner['HOLDING_GROUP'] == '02') {
                                                $HOLDING_GROUP = "ทายาท ผู้จัดการมรดก หรือบุคคนอื่นๆที่เกี่ยวข้อง";
                                            } else if ($rec_owner['HOLDING_GROUP'] == '03') {
                                                $HOLDING_GROUP = "ผู้รับจำนอง";
                                            } */
                        ?>
                            <tr>
                                <td><?php echo $rec_owner['FULL_NAME']; ?></td>
                                <td><?php echo $rec_owner['CONCERN_NAME']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </td>
            <?php } else if ($SYSTEM_ID == '2') { ?>
                <td>

                </td>
            <?php
            } ?>
        </tr>
    <?php
        $T++;
    }
    /* ทรัพ */
}



function num_show_asset( //ทรัพที่เเสดงใน search_data
    $PREFIX_BLACK_CASE = '',
    $BLACK_CASE = '',
    $BLACK_YY = '',
    $PREFIX_RED_CASE = '',
    $RED_CASE = '',
    $RED_YY = '',
    $COURT_CODE = '',
    $SYSTEM_ID = '',
    $REGISTER_CODE = ''
) {
    $filter = "";

    if ($PREFIX_BLACK_CASE != "") {
        $filter .= " and b.PREFIX_BLACK_CASE = '" .  $PREFIX_BLACK_CASE . "'	";
    }
    if ($BLACK_CASE != "") {
        $filter .= " and b.BLACK_CASE = '" . $BLACK_CASE . "'	";
    }
    if ($BLACK_YY != "") {
        $filter .= " and b.BLACK_YY = '" . $BLACK_YY . "'	";
    }
    if ($PREFIX_RED_CASE != "") {
        $filter .= " and b.PREFIX_RED_CASE = '" . $PREFIX_RED_CASE . "'	";
    }
    if ($RED_CASE != "") {
        $filter .= " and b.RED_CASE = '" . $RED_CASE . "'	";
    }
    if ($RED_YY != "") {
        $filter .= " and b.RED_YY = '" . $RED_YY . "'	";
    }

    if ($COURT_CODE != "" && $SYSTEM_ID != 6) {
        if ($SYSTEM_ID == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
            //  $filter .= " and COURT_ID = '" . $_POST['COURT_CODE'] . "'	";
        } else {
            $filter .= " and COURT_CODE = '" . $COURT_CODE . "'	";
        }
    }

    $arrDataAsset = array();
    if ($SYSTEM_ID == '1') { //ระบบงานบังคับคดีแพ่ง
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,CFC_CAPTION_GEN
         from 		WH_CIVIL_CASE_ASSETS a 
         inner join 	WH_CIVIL_CASE b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
         where 		1=1 AND ASSET_ID IS NOT NULL  {$filter}";
        }
    } else if ($SYSTEM_ID == '2') { //ระบบงานบังคับคดีล้มละลาย
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE
         from 		WH_BANKRUPT_ASSETS a 
         inner join 	WH_BANKRUPT_CASE_DETAIL b on a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID
         where 		1=1 {$filter}";
        }
    } else if ($SYSTEM_ID == '6') { //ระบบงานบังคับคดีล้มละลาย
        if ($filter != '') {
            $sqlSelectDataAsset = "	select 		WH_ASSET_ID as ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,M_ASSET_KEY,ASSET_TYPE_ID
         from 		WH_DEBTOR_ASSETS
         where 		1=1 AND PROP_TITLE is not null AND WH_ASSET_ID IS NOT NULL  {$filter}";
        }
    }
    $querySelectDataAsset = db::query($sqlSelectDataAsset);
    $num_r = db::num_rows($querySelectDataAsset);

    return $num_r;
    /* ทรัพ */
}

function add_order_auto()
{/* เพิ่มคำสั่ง start*/
    ?>
    <!-- การป้อนข้อมูล start -->
    <div style="display: none;">
        <!-- send start -->
        <input type="text" id="CMD_DOC_DATE" name="CMD_DOC_DATE" value="<?php echo date('Y-m-d'); ?>"><!-- //วันที่ -->
        <input type="text" id="CMD_DOC_TIME" name="CMD_DOC_TIME" value="<?php echo date("H:i:s"); ?>"><!-- เวลา -->
        <input type="text" id="register_code_send" name="register_code_send" value="1234567890123"><!-- เลข13 หลักผู้ส่ง -->
        <input type="text" id="SYSTEM_ID_send" name="SYSTEM_ID_send" value="1"><!-- คำสั่ง/สอบถาม/แจ้ง จากระบบงาน  -->

        <input type="text" id="T_BLACK_CASE_send" name="T_BLACK_CASE_send" value="ผบ."><!-- หมายเลขคดีดำ ผู้ส่ง -->
        <input type="text" id="BLACK_CASE_send" name="BLACK_CASE_send" value="000"><!-- หมายเลขคดีดำ ผู้ส่ง -->
        <input type="text" id="BLACK_YY_send" name="BLACK_YY_send" value="111"><!-- หมายเลขคดีดำ ผู้ส่ง -->

        <input type="text" id="T_RED_CASE_send" name="T_RED_CASE_send" value="ผบ."><!-- หมายเลขคดีแดง ผู้ส่ง -->
        <input type="text" id="RED_CASE_send" name="RED_CASE_send" value="0000"><!-- หมายเลขคดีแดง ผู้ส่ง -->
        <input type="text" id="RED_YY_send" name="RED_YY_send" value="1111"><!-- หมายเลขคดีแดง ผู้ส่ง -->

        <input type="text" id="COUNT_CODE_send" name="COUNT_CODE_send" value="302"><!-- ศาล -->

        <input type="text" id="plaintiff_send" name="plaintiff_send" value="นายA"><!-- โจทก์ -->
        <input type="text" id="defendant_send" name="defendant_send" value="นายB"><!-- จำเลย -->

        <!-- send stop -->

        <!-- recive  start-->
        <input type="text" id="SEND_TO_receive" name="SEND_TO_receive" value="4"><!-- คำสั่ง/สอบถาม/แจ้ง จากระบบงาน  -->

        <input type="text" id="T_BLACK_CASE_receive" name="T_BLACK_CASE_receive" value="ล."><!-- หมายเลขคดีดำ ผู้ส่ง -->
        <input type="text" id="BLACK_CASE_receive" name="BLACK_CASE_receive" value="222"><!-- หมายเลขคดีดำ ผู้ส่ง -->
        <input type="text" id="BLACK_YY_receive" name="BLACK_YY_receive" value="2565"><!-- หมายเลขคดีดำ ผู้ส่ง -->

        <input type="text" id="T_RED_CASE_receive" name="T_RED_CASE_receive" value="ล."><!-- หมายเลขคดีแดง ผู้ส่ง -->
        <input type="text" id="RED_CASE_receive" name="RED_CASE_receive" value="333"><!-- หมายเลขคดีแดง ผู้ส่ง -->
        <input type="text" id="RED_YY_receive" name="RED_YY_receive" value="2565"><!-- หมายเลขคดีแดง ผู้ส่ง -->

        <input type="text" id="COUNT_CODE_receive" name="COUNT_CODE_receive" value="003"><!-- ศาล
 -->

        <input type="text" id="plaintiff_receive" name="plaintiff_receive" value="นายC"><!-- โจทก์  -->
        <input type="text" id="defendant_receive" name="defendant_receive" value="นายD"><!-- จำเลย -->

        <input type="text" id="note" name="note" value="รายละเอียด"><!-- รายละเอียด -->
        <input type="text" id="APPROVE_PERSON" name="APPROVE_PERSON" value="1311100009189"><!-- ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร -->
        <input type="text" id="OFFICE_IDCARD" name="OFFICE_IDCARD" value="1311100009189">
        <input type="text" id="OFFICE_NAME" name="OFFICE_NAME" value="นายกฤศวรรธน์ พิลาล้ำ">
        <!-- recive stop -->
    </div>
    <!-- การป้อนข้อมูล stop -->
    <!-- ปุ่ม start -->

    <button class="btn btn-primary" type="button" onclick="inser_data_case();">บันทึกคำสั่งเจ้าพนักงาน auto</button>

    <!-- ปุ่ม stop -->
    <script>
        function inser_data_case(register_code) {
            let attachid = '<?php echo random(50); ?>' //random
            /* ชุดผู้ส่ง start */
            let CMD_DOC_DATE = $('#CMD_DOC_DATE').val(); //วันที่
            let CMD_DOC_TIME = $('#CMD_DOC_TIME').val(); //เวลา

            let register_code_send = $('#register_code_send').val(); //เลข13 หลักผู้ส่ง

            let SYSTEM_ID_send = $('#SYSTEM_ID_send').val(); //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

            let T_BLACK_CASE_send = $('#T_BLACK_CASE_send').val(); //หมายเลขคดีดำ ผู้ส่ง
            let BLACK_CASE_send = $('#BLACK_CASE_send').val(); //หมายเลขคดีดำ ผู้ส่ง
            let BLACK_YY_send = $('#BLACK_YY_send').val(); //หมายเลขคดีดำ ผู้ส่ง

            let T_RED_CASE_send = $('#T_RED_CASE_send').val(); //หมายเลขคดีแดง ผู้ส่ง
            let RED_CASE_send = $('#RED_CASE_send').val(); //หมายเลขคดีแดง ผู้ส่ง
            let RED_YY_send = $('#RED_YY_send').val(); //หมายเลขคดีแดง ผู้ส่ง

            let COUNT_CODE_send = $('#COUNT_CODE_send').val(); //ศาล

            let plaintiff_send = $('#plaintiff_send').val(); //โจทก์
            let defendant_send = $('#defendant_send').val(); //จำเลย
            /* ชุดผู้ส่ง stop */

            /* ชุดผู้รับ start */
            let SEND_TO_receive = $('#SEND_TO_receive').val(); //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

            let T_BLACK_CASE_receive = $('#T_BLACK_CASE_receive').val(); //หมายเลขคดีดำ ผู้ส่ง
            let BLACK_CASE_receive = $('#BLACK_CASE_receive').val(); //หมายเลขคดีดำ ผู้ส่ง
            let BLACK_YY_receive = $('#BLACK_YY_receive').val(); //หมายเลขคดีดำ ผู้ส่ง

            let T_RED_CASE_receive = $('#T_RED_CASE_receive').val(); //หมายเลขคดีแดง ผู้ส่ง
            let RED_CASE_receive = $('#RED_CASE_receive').val(); //หมายเลขคดีแดง ผู้ส่ง
            let RED_YY_receive = $('#RED_YY_receive').val(); //หมายเลขคดีแดง ผู้ส่ง

            let COUNT_CODE_receive = $('#COUNT_CODE_receive').val(); //ศาล

            let plaintiff_receive = $('#plaintiff_receive').val(); //โจทก์
            let defendant_receive = $('#defendant_receive').val(); //จำเลย
            /* ชุดผู้รับ stop */

            let note = $('#note').val(); //รายละเอียด
            let APPROVE_PERSON = $('#APPROVE_PERSON').val(); //ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร
            let OFFICE_IDCARD = $('#OFFICE_IDCARD').val(); //รายละเอียด
            let OFFICE_NAME = $('#OFFICE_NAME').val(); //ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร

            /* console.log(APPROVE_PERSON)
            return false */
            $.ajax({
                type: "POST",
                /* url: "./search_data_process_A.php", */
                url: "./search_data_process_A.php",
                data: {
                    proc: 'btn_search_data',
                    attachid: attachid, //random
                    /* ส่ง start  */
                    CMD_DOC_DATE: CMD_DOC_DATE, //วันที่
                    CMD_DOC_TIME: CMD_DOC_TIME, //เวลา

                    REGISTERCODE: register_code_send, //เลข13 หลักผู้ส่ง

                    SYSTEM_ID: SYSTEM_ID_send, //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

                    T_BLACK_CASE: T_BLACK_CASE_send, //หมายเลขคดีดำ ผู้ส่ง
                    BLACK_CASE: BLACK_CASE_send, //หมายเลขคดีดำ ผู้ส่ง
                    BLACK_YY: BLACK_YY_send, //หมายเลขคดีดำ ผู้ส่ง

                    T_RED_CASE: T_RED_CASE_send, //หมายเลขคดีแดง ผู้ส่ง
                    RED_CASE: RED_CASE_send, //หมายเลขคดีแดง ผู้ส่ง
                    RED_YY: RED_YY_send, //หมายเลขคดีแดง ผู้ส่ง

                    COURT_CODE: COUNT_CODE_send, //ศาล ส่ง

                    D_C: plaintiff_send, //โจทก์
                    D_NAME: defendant_send, //จำเลย
                    /* ส่ง stop  */
                    /* ------------------------------------------------------------------------------------- */
                    /* รับ start  */
                    SEND_TO: SEND_TO_receive, //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน 

                    TO_T_BLACK_CASE: T_BLACK_CASE_receive, //หมายเลขคดีดำ ผู้ส่ง
                    TO_BLACK_CASE: BLACK_CASE_receive, //หมายเลขคดีดำ ผู้ส่ง
                    TO_BLACK_YY: BLACK_YY_receive, //หมายเลขคดีดำ ผู้ส่ง

                    TO_T_RED_CASE: T_RED_CASE_receive, //หมายเลขคดีแดง ผู้ส่ง
                    TO_RED_CASE: RED_CASE_receive, //หมายเลขคดีแดง ผู้ส่ง
                    TO_RED_YY: RED_YY_receive, //หมายเลขคดีแดง ผู้ส่ง

                    TO_COURT_CODE: COUNT_CODE_receive, //ศาล ส่ง

                    TO_PLAINTIFF: plaintiff_receive, //โจทก์
                    TO_DEFENDANT: defendant_receive, //จำเลย
                    /* รับ stop  */
                    /* ------------------------------------------------------------------------------------- */
                    CMD_NOTE: note, //รายละเอียด
                    APPROVE_PERSON: APPROVE_PERSON, //ผอ อนุมัติ เป็นเลข 13 หลัก ส่งถึงใคร
                    OFFICE_IDCARD: OFFICE_IDCARD,
                    OFFICE_NAME: OFFICE_NAME
                },
                dataType: "JSON",
                success: function(data) {
                    console.log()
                    if (1 == 1) {
                        window.location = 'search_data_cmd.php'
                    }
                }

            });
        }
    </script>
<?php
}
/* เพิ่มคำสั่ง stop*/


function add_order_have_input()/* บันทึกคำสั่งเจ้าพนักงาน ลิ้งไปหน้าคำสั่ง start */
{
?>
    <!-- send start -->
    <div class="form-group row">
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2" align="left">
                <h3><u>ผู้ส่ง</u></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-md-2 "><label for="SEND_TO">คำสั่ง/สอบถาม/แจ้ง จากระบบงาน </label></div>
            <div class="col-xs-12 col-sm-3">
                <select name="SYSTEM_ID_have_input" id="SYSTEM_ID_have_input" class="form-control select2">
                    <option value="" disabled selected>เลือกระบบงาน</option>
                    <?php
                    $sql = "SELECT	* FROM M_CMD_SYSTEM
									  WHERE 1=1 AND CMD_SYSTEM_ID NOT IN (6) 
									  ORDER BY SERVICE_SYS_NAME ASC
									  ";
                    $query = db::query($sql);
                    while ($rec = db::fetch_array($query)) {
                    ?>
                        <option value="<?php echo $rec['CMD_SYSTEM_ID']; ?>"><?php echo $rec['SERVICE_SYS_NAME']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2"><label for="">หมายเลขคดีดำ</label></div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="T_BLACK_CASE_send_have_input" name="T_BLACK_CASE_send_have_input" value="ผบ."><!-- หมายเลขคดีดำ ผู้ส่ง -->
            </div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="BLACK_CASE_send_have_input" name="BLACK_CASE_send_have_input" value="000"><!-- หมายเลขคดีดำ ผู้ส่ง -->
            </div>
            <div class="col-xs-12 col-sm-1" align="right"><label for="">ปี</label></div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="BLACK_YY_send_have_input" name="BLACK_YY_send_have_input" value="2560"><!-- หมายเลขคดีดำ ผู้ส่ง -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2"><label for="">หมายเลขคดีแดง</label></div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="T_RED_CASE_send_have_input" name="T_RED_CASE_send_have_input" value="ผบ."><!-- หมายเลขคดีแดง ผู้ส่ง -->
            </div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="RED_CASE_send_have_input" name="RED_CASE_send_have_input" value="0000"><!-- หมายเลขคดีแดง ผู้ส่ง -->
            </div>
            <div class="col-xs-12 col-sm-1" align="right"><label for="">ปี</label></div>
            <div class="col-xs-12 col-sm-2">
                <input type="text" class="form-control" id="RED_YY_send_have_input" name="RED_YY_send_have_input" value="2560"><!-- หมายเลขคดีแดง ผู้ส่ง -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2"><label for="">ศาล</label></div>
            <div class="col-xs-12 col-sm-2">
                <select name="COURT_CODE_have_input" id="COURT_CODE_have_input" class="form-control select2" tabindex="-1" aria-hidden="true" required>
                    <option value="" disabled selected>ศาล</option>
                    <?php
                    $sqlCourt = "	SELECT 		COURT_CODE,COURT_NAME
												FROM 		M_COURT
												WHERE 		1=1 
												ORDER BY 	COURT_CODE ASC
												";
                    $queryCourt = db::query($sqlCourt);
                    while ($recCourt = db::fetch_array($queryCourt)) {
                    ?>
                        <option value="<?php echo $recCourt['COURT_CODE']; ?>"><?php echo $recCourt['COURT_NAME']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2"><label for="">โจทก์</label></div>
            <div class="col-xs-12 col-sm-4">
                <input type="text" class="form-control" id="plaintiff_send_have_input" name="plaintiff_send_have_input" value="นายA"><!-- โจทก์ -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-1"> </div>
            <div class="col-xs-12 col-sm-2"><label for="">จำเลย</label></div>
            <div class="col-xs-12 col-sm-4">
                <input type="text" class="form-control" id="defendant_send_have_input" name="defendant_send_have_input" value="นายB"><!-- จำเลย -->
            </div>
        </div>
    </div>
    <!-- send stop -->
    <button class="btn btn-primary" type="button" onclick="save_order_add_order_have_input();">บันทึกคำสั่งเจ้าพนักงาน</button>
    <script>
        function save_order_add_order_have_input() {
            let SYSTEM_ID = $('#SYSTEM_ID_have_input').val(); //คำสั่ง/สอบถาม/แจ้ง จากระบบงาน
            let T_BLACK_CASE_send = $('#T_BLACK_CASE_send_have_input').val(); //หมายเลขคดีดำ
            let BLACK_CASE_send = $('#BLACK_CASE_send_have_input').val(); //หมายเลขคดีดำ
            let BLACK_YY_send = $('#BLACK_YY_send_have_input').val(); //หมายเลขคดีดำ
            let T_RED_CASE_send = $('#T_RED_CASE_send_have_input').val(); //หมายเลขคดีแดง
            let RED_CASE_send = $('#RED_CASE_send_have_input').val(); //หมายเลขคดีแดง
            let RED_YY_send = $('#RED_YY_send_have_input').val(); //หมายเลขคดีแดง

            let COURT_CODE = $('#COURT_CODE_have_input').val(); //ศาล
            let plaintiff_send = $('#plaintiff_send_have_input').val(); //โจทก์
            let defendant_send = $('#defendant_send_have_input').val(); //จำเลย

            let url = "./cmd_add_from_send_to.php?proc=add";
            url += "&GET_S_SYSTEM_ID=" + SYSTEM_ID;

            url += "&GET_S_PREFIX_CASE_BLACK=" + T_BLACK_CASE_send;
            url += "&GET_S_CASE_BLACK=" + BLACK_CASE_send;
            url += "&GET_S_CASE_BLACK_YEAR=" + BLACK_YY_send;

            url += "&GET_S_PREFIX_CASE_RED=" + T_RED_CASE_send;
            url += "&GET_S_CASE_RED=" + RED_CASE_send;
            url += "&GET_S_CASE_RED_YEAR=" + RED_YY_send;

            url += "&GET_S_COURT_CODE=" + COURT_CODE;
            url += "&GET_PLAINTIFF=" + plaintiff_send;
            url += "&GET_DEFENDANT=" + defendant_send;
            window.location.href = url;

        }
    </script>
<?php
}
/* ลิ้งไปหน้าคำสั่ง stop */
function add_order()/* บันทึกคำสั่งเจ้าพนักงาน ลิ้งไปหน้าคำสั่ง start */
{
?>
    <!-- send start -->
    <input type="hidden" id="register_code_send" name="register_code_send" value="1234567890123"><!-- เลข13 หลักผู้ส่ง -->
    <input type="hidden" id="SYSTEM_ID_send" name="SYSTEM_ID_send" value="1"><!-- คำสั่ง/สอบถาม/แจ้ง จากระบบงาน  -->

    <input type="hidden" id="T_BLACK_CASE_send" name="T_BLACK_CASE_send" value="ผบ."><!-- หมายเลขคดีดำ ผู้ส่ง -->
    <input type="hidden" id="BLACK_CASE_send" name="BLACK_CASE_send" value="000"><!-- หมายเลขคดีดำ ผู้ส่ง -->
    <input type="hidden" id="BLACK_YY_send" name="BLACK_YY_send" value="111"><!-- หมายเลขคดีดำ ผู้ส่ง -->

    <input type="hidden" id="T_RED_CASE_send" name="T_RED_CASE_send" value="ผบ."><!-- หมายเลขคดีแดง ผู้ส่ง -->
    <input type="hidden" id="RED_CASE_send" name="RED_CASE_send" value="0000"><!-- หมายเลขคดีแดง ผู้ส่ง -->
    <input type="hidden" id="RED_YY_send" name="RED_YY_send" value="1111"><!-- หมายเลขคดีแดง ผู้ส่ง -->

    <input type="hidden" id="COUNT_CODE_send" name="COUNT_CODE_send" value="302"><!-- ศาล -->

    <input type="hidden" id="plaintiff_send" name="plaintiff_send" value="นายA"><!-- โจทก์ -->
    <input type="hidden" id="defendant_send" name="defendant_send" value="นายB"><!-- จำเลย -->

    <input type="hidden" id="defendant_send" name="defendant_send" value="">
    <!-- send stop -->
    <button class="btn btn-primary" type="button" onclick="save_order();">บันทึกคำสั่งเจ้าพนักงาน</button>
    <script>
        function save_order() {
            window.location.href = './cmd_add_from_send_to.php?GET_S_PREFIX_CASE_BLACK=ล.&GET_S_CASE_BLACK=20701&GET_S_CASE_BLACK_YEAR=2566&GET_S_PREFIX_CASE_RED=ล.&GET_S_CASE_RED=20702&GET_S_CASE_RED_YEAR=2566&GET_S_COURT_CODE=050&GET_S_SYSTEM_ID=2&SEND_TO=2&TO_PERSON_ID=1730500105717&GET_PLAINTIFF=บริษัท%20ซิตี้คอร์ป%20ลีสซิ่ง%20(ประเทศไทย)%20จำกัดฯ%20&GET_DEFENDANT=นางสาวน้ำค้าง%20วังเย็น&GET_T_PREFIX_CASE_BLACK=ผบ&GET_T_CASE_BLACK=177&GET_T_CASE_BLACK_YEAR=2553&GET_T_PREFIX_CASE_RED=ผบ.&GET_T_CASE_RED=342&GET_T_CASE_RED_YEAR=2553&GET_T_COURT_CODE=204&GET_T_SYSTEM_ID=1&ID_CARD=3809900078401&PCC_CASE_GEN=4716287&proc=add';

        }
    </script>
<?php
}
/* ลิ้งไปหน้าคำสั่ง stop */

function serch_data13()/* ค้นหาจากเลข 13หลัก start */
{
?> <div class="col-xs-12 col-sm-12">
        <div class="col-xs-12 col-sm-4"> <input type="text" name="data13" id="data13" oninput="input_Number(this)" class="form-control"> </div>
        <div class="col-xs-12 col-sm-2"> <button type="button" onclick="search13();" class="btn btn-primary">ค้นหา</button></div>
    </div>
    <script>
        function search13() {
            let data13 = $('#data13').val();
            window.location.href = './search_data.php?REGISTERCODE=' + data13;
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
    </script>
<?php
}
/* ค้นหาจากเลข 13หลัก stop */
function link_order()
{
?><button type="button" onclick="link_();" class="btn btn-primary">คำสั่งเจ้าพนักงาน </button>
    <script>
        function link_() {
            window.location.href = './search_data_cmd.php';
        }
    </script>
<?php
}
?>