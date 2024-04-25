<?php

$HIDE_HEADER = "P";
include '../include/comtop_user.php';

$settingId = $_GET['SETTING_ID'];
$apiListId = $_GET['API_LIST_ID'];
$type = $_GET['type'];

if ($type == 1) {
    $W = 180;
} else {
    $W = 181;
}

$WFD = conText($_GET['WFD']);
$WF_TYPE_SEARCH = conText($_GET['WF_TYPE_SEARCH']);

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

$WF = array();
if ($apiListId != '') {
    $sqlWf = "SELECT * FROM M_API_LIST WHERE API_LIST_ID = '$apiListId' ";
    $qryWf = db::query($sqlWf);
    $WF = db::fetch_array($qryWf);
}

?>
<script type="text/javascript" src="../assets/js/dom-to-image.js"></script>
<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <!-- Row Starts -->
        <form id="form_wf" name="form_wf">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-header">
                        <h4>เพิ่มข้อมูล</h4>
                    </div>
                </div>
            </div>
            <!-- Row end -->
            <div id="my-node-parent2">
                <div id="my-node2">
                    <!-- Row Starts -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div id="wf_space" class="card-block">
                                    <div class="form-group row">
                                        <?php bsf_show_form($W, $WFD, $WF, $WF_TYPE); ?>

                                        <input type="hidden" name="setting_id" id="setting_id" value="<?php echo $settingId; ?>">
                                        <input type="hidden" name="API_LIST_ID" id="API_LIST_ID" value="<?php echo $apiListId; ?>">
                                        <input type="hidden" name="type" id="type" value="<?php echo $type; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
            </div>
        </form>
        <!-- Container-fluid ends -->
        <div align="center">
            <button type="button" class="btn btn-success" onclick="save_temp_list('<?php echo $type; ?>','<?php echo $settingId; ?>');">บันทึก</button>
        </div>
    </div>
</div>
<br>
<script>
    function save_temp_list(type, settingId) {

        var dataForm = $("#form_wf").serialize();
        // console.log(dataForm);
        swal({
            title: "",
            text: "ยืนยันการบันทึก?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "บันทึก",
            cancelButtonText: "ยกเลิก",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: false,
        }, function() {
            swal.disableButtons(); //ปิดปุ่ม
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "../save/save_temp_form_api.php",
                data: dataForm,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: "กรุณารอสักครู่.....",
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        imageUrl: "../icon/loading.gif",
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });
                },
                success: function(res) {
                    if (res.result == 'success') {
                        swal({
                                title: "",
                                text: 'ดำเนินการเสร็จสิ้น',
                                type: "success", //success, warning, danger
                                confirmButtonClass: "btn-success",
                                showConfirmButton: true,
                                confirmButtonText: "ยืนยัน",
                            },
                            function() {
                                window.close();
                                window.opener.refresh_modal(settingId);
                            });
                    }
                },
                error: function(res) {
                    swal({
                        title: "",
                        text: 'ไม่สำเร็จ',
                        type: "warning", //success, warning, danger
                        confirmButtonClass: "btn-success",
                        showConfirmButton: true,
                        confirmButtonText: "ยืนยัน",
                    });
                }
            });
        });
    }
</script>
<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_user.php'; ?>