<?php
include '../include/comtop_user.php';
$W = $_GET['W'];
$WF_SCREEN_NO = "MM#" . $W;

$sql_main = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_ID = '" . $W . "'");
$rec_main = db::fetch_array($sql_main);

$wf_page = $_GET['wf_page'];
$wf_limit = $_GET['wf_limit'] == "" ? 20 : $_GET['wf_limit'];
if ($wf_page == '') {
    $wf_page = 1;
}
$wf_offset = ($wf_page - 1) * $wf_limit;

$SYS_NAME = $_GET['SYS_NAME'];
$SYS_STATUS = (isset($_GET['SYS_STATUS']) && $_GET['SYS_STATUS'] != '') ? $_GET['SYS_STATUS'] : 1;

$filter = " ";
if ($SYS_NAME != '') {
    $filter .= "AND SYS_NAME LIKE '%" . $SYS_NAME . "%'";
}
if ($SYS_STATUS != '') {
    $filter .= "AND SYS_STATUS = '$SYS_STATUS' ";
}

$field = " * ";
$table = " M_SYSTEM ";
$wh = " 1=1 {$filter}";
$orderby = " order by SYSTEM_ID DESC ";

$sql = "SELECT  " . $field . " FROM " . $table . " WHERE " . $wh . " " . $orderby;
$query = db::query($sql);
$total_record = db::num_rows($query);
if ($_GET['wf_limit'] == 'all') { //// กรณี  listbox เลือก ทั้งหมด
    $query_main = db::query($sql);
} else {
    $query_main = db::query_limit($sql, $wf_offset, $wf_limit);
}
?>
<style>
    .card-header {
        border-bottom: 0px;
    }
</style>
<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row" id="animationSandbox">
            <div class="col-sm-12">
                <div class="main-header">
                    <div class="media m-b-12">
                        <a class="media-left" href="<?php echo $link_back_home; ?>">
                            <?php if ($rec_main['WF_MAIN_ICON'] != "") {
                                echo "<img src=\"../icon/" . $rec_main['WF_MAIN_ICON'] . "\" class=\"media-object\">";
                            } ?>
                        </a>
                        <div class="media-body">
                            <h4 class="m-t-5">&nbsp;</h4>
                            <h4><?php echo  $report_name = $rec_main['WF_MAIN_NAME']; ?></h4>
                        </div>
                    </div>
                    <div class="f-right">
                        <a class="btn btn-primary active waves-effect waves-light" href="../form/form_manage_service.php?W=183" role="button" title=""><i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล</a>

                        <a class="btn btn-danger waves-effect waves-light" href="../workflow/index.php?G=47" role="button"><i class="icofont icofont-home"></i> กลับหน้าหลัก</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

        <!--Workflow row start-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div id="wf_space" class="card-header">

                        <form method="get" id="form_wf_search" name="form_wf_search" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <h4><i class="icofont icofont-search-alt-2"></i> ค้นหา</h4>

                            <div class="form-group row">
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-3 wf-left">

                                </div>
                            </div>

                            <br>

                            <div class="form-group row">

                                <div id="SYS_NAME_BSF_AREA" class="col-md-2 offset-md-1 "><label for="SYS_NAME" class="form-control-label wf-right">ชื่อหน่วยงาน</label></div>

                                <div id="SYS_NAME_BSF_AREA" class="col-md-2 wf-left">
                                    <input type="text" name="SYS_NAME" id="SYS_NAME" class="form-control" value="<?php echo $SYS_NAME  ?>" placeholder="กรุณาเลือก">
                                    <small id="DUP_SYS_NAME_ALERT" class="form-text text-danger" style="display:none"></small>
                                </div>

                                <div id="SYS_STATUS_BSF_AREA" class="col-md-2 "><label for="SYS_STATUS" class="form-control-label wf-right">สถานะ</label></div>

                                <div id="SYS_STATUS_BSF_AREA" class="col-md-2 wf-left">
                                    <select name="SYS_STATUS" id="SYS_STATUS" class="form-control select2 select2-hidden-accessible" placeholder="ทั้งหมด" tabindex="-1" aria-hidden="true" value="<?php echo $SYS_STATUS  ?>">
                                        <option value="" disabled="">เลือก</option>
                                        <option value="1" <?php if ($SYS_STATUS == 1) {
                                                                echo "selected";
                                                            } ?>>ใช้งาน</option>
                                        <option value="0" <?php if ($SYS_STATUS == 0) {
                                                                echo "selected";
                                                            } ?>>ไม่ใช้งาน</option>
                                    </select>
                                    <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 215.7px;"><span class="selection">
                                </div>

                                <div class="col-md-12 text-center">

                                    <button type="submit" name="wf_search" id="wf_search" class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
                                    &nbsp;&nbsp;

                                    <button type="button" name="wf_reset" id="wf_reset" class="btn btn-warning" onclick="window.location.href='disp_manage_service.php?W=183';">

                                        <i class="zmdi zmdi-refresh-alt"></i> Reset

                                    </button>

                                    <input type="hidden" name="W" id="W" value="<?php echo $W; ?>">

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-block">
                        <div class="f-right">
                        </div>
                        <?php echo ($total_record > 0) ? startPagingNew($total_record, $wf_limit, $wf_page) : ""; ?>
                        <div class="table-responsive" data-pattern="priority-columns" id="export_data">
                            <div class="showborder">
                                <table cellspacing="0" class="table table-bordered sorted_table">
                                    <thead class="bg-primary">
                                        <tr class="bg-primary">
                                            <th width="5%">ลำดับ</th>
                                            <th width="30%">ชื่อหน่วยงาน</th>
                                            <th width="20%">สถานะ</th>
                                            <th width="5%">รายละเอียด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $j = 0;
                                        $i = 1;
                                        while ($rec = db::fetch_array($query_main)) {

                                        ?>
                                            <tr id="tr_wfr_<?php echo $rec['SYSTEM_ID']; ?>">
                                                <td class="text-center"><?php echo $i; ?></td>

                                                <td class="text-left">
                                                    <?php echo $rec['SYS_NAME']; ?></td>


                                                <td class="text-center">
                                                    <?php if ($rec['SYS_STATUS'] == 0) {
                                                        echo "ไม่ใช้งาน";
                                                    } else {
                                                        echo "ใช้งาน";
                                                    }
                                                    ?>
                                                </td>

                                                <td class="text-center">
                                                    <nobr>
                                                        <a href="form_manage_service.php?W=183&ORG_ID=<?php echo $rec['SYSTEM_ID']; ?>" class="btn btn-success btn-mini" title="">
                                                            <i class="icofont icofont-ui-edit"></i> จัดการ</a>
                                                        <a href="#!" class="btn btn-danger btn-mini" title="" onclick="delete_wfr('52','<?php echo $rec['SYSTEM_ID']; ?>')">
                                                            <i class="icofont icofont-trash"></i> ลบ </a>
                                                    </nobr>
                                                </td>
                                            </tr>

                                        <?php

                                            $i++;
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php echo ($total_record > 0) ? endPagingNew($total_record, $wf_limit, $wf_page) : ""; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Workflow Row end -->
    </div>
    <!-- Container-fluid ends -->
</div>

<script>
    function change_page(limit) {
        window.location.href = "<?php echo create_link($wf_link, $_GET, array(), array('wf_limit', 'wf_page')) . '&wf_page=1&wf_limit='; ?>" + limit + "";
    }

    function delete_wfr(w, wfr) {
        if (w != '' && wfr != '') {
            swal({
                    title: "",
                    text: "<?php echo $system_conf["wf_delete_confirm_list"]; ?>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "<?php echo $system_conf["wf_delete_confirm"]; ?>",
                    cancelButtonText: "<?php echo $system_conf["wf_cancle"]; ?>",
                    closeOnConfirm: true
                },
                function() {
                    var dataString = 'process=del&W=' + w + '&WFR=' + wfr;
                    $.ajax({
                        type: "POST",
                        url: "../workflow/workflow_del_function.php",
                        data: dataString,
                        cache: false,
                        success: function(html) {
                            $('#tr_wfr_' + wfr).hide();
                        }
                    });
                });
        }
    }
</script>
<?php
include '../include/combottom_js_user.php';
include '../include/combottom_user.php';



function startPagingNew($num_rows_data, $wf_limit, $wf_page, $per_page_array = "20,50,100,200")
{
    global $wf_link, $_GET;
    $html = "";
    if ($num_rows_data > 0) {
        $html .= '<div class="form-group">';
        $html .= '<div class="col-md-1 offset-md-11">';
        $html .= '<select name="WF_PER_PAGE" id="WF_PER_PAGE" class="form-control select2" onchange="change_page(this.value);">';
        $per_page_ex = explode(',', $per_page_array);

        foreach ($per_page_ex as $_val) {
            $selected = "";
            if ($_GET["wf_limit"] == trim($_val) || $_GET["wf_limit"] == "1000000") {
                $selected = "selected";
            }
            $html .= '<option value="' . trim($_val) . '" ' . $selected . ' >' . trim($_val) . '</option>';
        }
        $html .= '<option value="1000000"  ' . $selected . ' >ทั้งหมด</option>';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';
    }
    return $html;
}
function endPagingNew($num_rows_data, $wf_limit, $wf_page)
{
    global $wf_link, $WF_SPLIT_PAGE, $_GET;

    $html = "";

    $wf_page_all = floor($num_rows_data / $wf_limit);
    if (($num_rows_data % $wf_limit) > 0) {
        $wf_page_all++;
    }
    $html .= $WF_SPLIT_PAGE[0] . ' ' . $wf_page . ' ' . $WF_SPLIT_PAGE[1] . ' ' . $wf_page_all . ' ' . $WF_SPLIT_PAGE[2] . ' ' . $WF_SPLIT_PAGE[3] . ' ' . $num_rows_data . ' ' . $WF_SPLIT_PAGE[4];
    $html .= '<div aria-label="page list small" class="f-right">';
    $html .= '<ul class="pagination pagination-sm">';
    if ($wf_page > 1) {

        $link = create_link($wf_link, $_GET, array(), array('wf_page'));

        $html .= '<li class="page-item">';
        $html .= '<a class="page-link waves-effect" href="' . $link . '&wf_page=1" aria-label="First">';
        $html .= '<span aria-hidden="true"><i class="zmdi zmdi-fast-rewind"></i></span>';
        $html .= '<span class="sr-only">First</span>';
        $html .= '</a>';
        $html .= '</li>';
        $html .= '<li class="page-item">';
        $html .= '<a class="page-link waves-effect" href="' . $link . '&wf_page=' . ($wf_page - 1) . '" aria-label="Previous">';
        $html .= '<span aria-hidden="true"><i class="zmdi zmdi-skip-previous"></i></span>';
        $html .= '<span class="sr-only">Previous</span>';
        $html .= '</a>';
        $html .= '</li>';
    }
    $c_start = $wf_page - 5;
    if ($c_start < 1) {
        $c_start = '1';
    }
    $c_end = $wf_page + 5;
    if ($c_end > $wf_page_all) {
        $c_end = $wf_page_all;
    }
    for ($p = $c_start; $p <= $c_end; $p++) {
        if ($wf_page == $p) {
            $act = ' active';
            $link = '#!';
        } else {
            $act = '';
            $link = create_link($wf_link, $_GET, array(), array('wf_page')) . '&wf_page=' . ($p);
        }
        $html .= '<li class="page-item' . $act . '"><a class="page-link waves-effect" href="' . $link . '" role="button">' . $p . '</a></li>';
    }
    if ($wf_page != $wf_page_all) {

        $link = create_link($wf_link, $_GET, array(), array('wf_page'));

        $html .= '<li class="page-item">';
        $html .= '<a class="page-link waves-effect" href="' . $link . '&wf_page=' . ($wf_page + 1) . '" aria-label="Next">';
        $html .= '<span aria-hidden="true"><i class="zmdi zmdi-skip-next"></i></span>';
        $html .= '<span class="sr-only">Next</span>';
        $html .= '</a>';
        $html .= '</li>';
        $html .= '<li class="page-item">';
        $html .= '<a class="page-link waves-effect" href="' . $link . '&wf_page=' . $wf_page_all . '" aria-label="Last">';
        $html .= '<span aria-hidden="true"><i class="zmdi zmdi-fast-forward"></i></span>';
        $html .= '<span class="sr-only">Last</span>';
        $html .= '</a>';
        $html .= '</li>';
    }

    $html .= '</ul>';
    $html .= '</div>';

    return $html;
}
?>