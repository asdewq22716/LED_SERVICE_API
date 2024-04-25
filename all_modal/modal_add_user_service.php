<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$W = conText($_GET['W']);
$ORG_ID = conText($_GET['ORG_ID']);
$USR_ID = ($_GET['USER_ID']) ? conText($_GET['USER_ID']) : '-';
$WFD = conText($_GET['WFD']);
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
if ($USR_ID != '-') {
    $sqlUser = "SELECT * FROM USER_API_SERVICE WHERE USR_ID = '$USR_ID' ";
    $qryUser = db::query($sqlUser);
    $WF = db::fetch_array($qryUser);
} else {
    $USR_ID = '';
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
                    <h5>เพิ่มรายชื่อ</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" enctype="multipart/form-data" id="frm_add_user_service" name="frm_add_user_service" 
onsubmit="return save_user_org();">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="form-group row">
                        <input type="hidden" name="USR_ID" id="USR_ID" value="<?php echo $USR_ID; ?>">
                        <?php bsf_show_form($W, $WFD, $WF, $WF_TYPE); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div align="center">&nbsp;
                <button type="submit" class="btn btn-success waves-effect waves-light"><i class="icofont icofont-tick-mark"></i> บันทึก</button>
                <input type="hidden" name="WFR_ID" value="<?php echo $WFR; ?>">
            </div>
        </div>
    </div>
</form>

<?php

include '../include/combottom_js_user.php';
include '../include/combottom_user.php';

?>
<script>
    $(document).ready(function() {
        $('#SYSTEM_TYPE').val('<?php echo $ORG_ID; ?>').trigger('change');
        $('#PERMISSION_GROUP_ID').val('<?php echo $ORG_ID; ?>').trigger('change');
        if ($('#EDIT_PAAWORD_STATUS').is(':checked')) {
            $('#EDIT_PAAWORD_STATUS').prop('checked', false);
        }
    });

    $(".email").blur(function() {
		var id = $(this).attr('id');
		var em_len = $('#' + id).val().length;
		if (em_len > 0) {
			if (valid2EMail($(this).val())) {} else {
				alert('อีเมล ไม่ถูกต้อง');
				$('#' + id).val('');
			}
		} else {
			alert('อีเมล ไม่ถูกต้อง');
		}
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