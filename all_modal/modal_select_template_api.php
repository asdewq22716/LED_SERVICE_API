<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$W = conText($_GET['W']);
$ORG_ID = conText($_GET['ORG_ID']);

$WFD = conText($_GET['WFD']);
$WF_TYPE_SEARCH = conText($_GET['WF_TYPE_SEARCH']);

$wf_page = $_GET['wf_page'];
$wf_limit = $_GET['wf_limit'] == "" ? 20 : $_GET['wf_limit'];
if ($wf_page == '') {
    $wf_page = 1;
}
$wf_offset = ($wf_page - 1) * $wf_limit;


$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '" . $W . "'");
$rec = db::fetch_array($sql);
if ($WFD != '0') {
    $sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '" . $WFD . "'");
    $rec_detail = db::fetch_array($sql_detail);
}
if ($WF_TYPE_SEARCH == 'Y') {
    $WF_TYPE = 'S';
} else {
    $WF_TYPE = $rec["WF_TYPE"];
}

$field = " * ";
$table = " M_API_TEMP ";
$wh = " 1=1 ";
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

    .alert_error {
        color: red;
    }

    .error {
        color: red;
    }
</style>
<!-- Row Starts -->
<div class="row" id="animationSandbox">
    <div class="col-sm-12">
        <div class="main-header">
            <div class="media m-b-12">
                <a class="media-left">
                    <img src="../icon/<?php echo $rec['WF_MAIN_ICON']; ?>" class="media-object" style="width:45px;">
                </a>
                <div class="media-body">
                    <h5>เลือกรูปแบบ Service</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" enctype="multipart/form-data" id="frm_template_service" name="frm_template_service" action="">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="form-group row"></div>
                    <div class="f-right">
                    </div>
                    <?php echo ($total_record > 0) ? startPagingNew($total_record, $wf_limit, $wf_page) : ""; ?>
                    <div class="table-responsive" data-pattern="priority-columns" id="export_data">
                        <div class="showborder">
                            <table cellspacing="0" class="table table-bordered sorted_table">
                                <thead class="bg-primary">
                                    <tr class="bg-primary">
                                        <th width="10%"></th>
                                        <th width="10%">ลำดับ</th>
                                        <th width="90%">ชื่อรูปแบบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $j = 0;
                                    $i = 1;
                                    while ($rec = db::fetch_array($query_main)) {

                                    ?>
                                        <tr id="tr_wfr_<?php echo $rec['SYSTEM_ID']; ?>">
                                            <td class="text-center" >
                                                <label for="SERVICE_LIST_<?php echo $rec['SYSTEM_ID']; ?>" class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="SERVICE_LIST[]" id="SERVICE_LIST_<?php echo $rec['SYSTEM_ID']; ?>" class="custom-control-input" value="<?php echo $rec['SYSTEM_ID']; ?>">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description"></span>
                                                </label>
                                            </td>
                                            <td class="text-center"><?php echo $i; ?></td>

                                            <td class="text-left">
                                                <?php echo $rec['SYS_NAME']; ?>
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
    <div class="row">
        <div class="col-md-12">
            <div align="center">&nbsp;
                <button type="button" class="btn btn-success waves-effect waves-light" onclick="save_template_api();"><i class="icofont icofont-tick-mark"></i> บันทึก</button>
                <input type="hidden" name="ORG_ID" value="<?php echo $ORG_ID; ?>">
            </div>
        </div>
    </div>
</form>


<script>
    function open_template_api_page(page) {
        $('#bizModalEdit .modal-body').html('');
        open_modal('../all_modal/modal_select_template_api.php?W=185&ORG_ID=<?php echo $ORG_ID; ?>&wf_page=' + page, '', 'Edit');
    }

    function save_template_api() {
        var dataForm = $("#frm_template_service").serialize();
        dataForm += '&FORM_ID=temp_api';

        chk = $('#frm_add_user_service').submit(function(e) {
            e.preventDefault();
        });
        if (chk != '') {
            $.ajax({
                url: "../save/save_manage_service.php",
                type: "POST",
                data: dataForm,
                dataType: "JSON",
                success: function(val) {
                    swal({
                            title: "",
                            text: "ดำเนินการเสร็จสิ้น",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "ยืนยัน",
                            // cancelButtonText: "ยกเลิก",
                            closeOnConfirm: true
                        },
                        function() {
                            $('#bizModalEdit').modal('hide');
                            location.reload();
                        });
                }
            });
            return false;
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
        $html .= '<div class="col-md-2 offset-md-10">';
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
        $html .= '<li class="page-item">';
        $html .= '<button type="button" class="page-link waves-effect" onclick="open_template_api_page(1);" aria-label="First">';
        $html .= '<span aria-hidden="true"><i class="zmdi zmdi-fast-rewind"></i></span>';
        $html .= '<span class="sr-only">First</span>';
        $html .= '</button>';
        $html .= '</li>';
        $html .= '<li class="page-item">';
        $html .= '<button type="button" class="page-link waves-effect" onclick="open_template_api_page(' . ($wf_page - 1) . ');" aria-label="Previous">';
        $html .= '<span aria-hidden="true"><i class="zmdi zmdi-skip-previous"></i></span>';
        $html .= '<span class="sr-only">Previous</span>';
        $html .= '</button>';
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
        }
        $html .= '<li class="page-item' . $act . '"><button type="button" class="page-link waves-effect" onclick="open_template_api_page(' . $p . ');" role="button">' . $p . '</button></li>';
    }
    if ($wf_page != $wf_page_all) {
        $html .= '<li class="page-item">';
        $html .= '<button type="button" class="page-link waves-effect" onclick="open_template_api_page(' . ($wf_page + 1) . ');" aria-label="Next">';
        $html .= '<span aria-hidden="true"><i class="zmdi zmdi-skip-next"></i></span>';
        $html .= '<span class="sr-only">Next</span>';
        $html .= '</a>';
        $html .= '</li>';
        $html .= '<li class="page-item">';
        $html .= '<button type="button" class="page-link waves-effect" onclick="open_template_api_page(' . $wf_page_all . ');"  aria-label="Last">';
        $html .= '<span aria-hidden="true"><i class="zmdi zmdi-fast-forward"></i></span>';
        $html .= '<span class="sr-only">Last</span>';
        $html .= '</button>';
        $html .= '</li>';
    }

    $html .= '</ul>';
    $html .= '</div>';

    return $html;
}
?>
<script>
    $(document).ready(function() {
        $('#SYSTEM_TYPE').val('<?php echo $ORG_ID; ?>').trigger('change');
        $('#PERMISSION_GROUP_ID').val('<?php echo $ORG_ID; ?>').trigger('change');
    });

    function save_user_org() {
        var dataForm = $("#frm_add_user_service").serialize();
        dataForm += '&FORM_ID=adminOrg';

        chk = $('#frm_add_user_service').submit(function(e) {
            e.preventDefault();
        });
        if (chk != '') {
            $.ajax({
                url: "../save/save_manage_service.php",
                type: "POST",
                data: dataForm,
                dataType: "JSON",
                success: function(val) {
                    swal({
                            title: "",
                            text: "ดำเนินการเสร็จสิ้น",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "ยืนยัน",
                            // cancelButtonText: "ยกเลิก",
                            closeOnConfirm: true
                        },
                        function() {
                            $('#bizModalEdit').modal('hide');
                            reload_content('adminOrg', '<?php echo $ORG_ID; ?>', '<?php echo $W; ?>');
                        });
                }
            });
            return false;
        }
    }
</script>