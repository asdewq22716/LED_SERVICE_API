<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

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
                    <?php /* <img src="../icon/<?php echo $rec_main['WF_MAIN_ICON']; ?>" class="media-object" style="width:45px;"> */ ?>
                </a>
                <div class="media-body">
                    <h5 style=" margin-top: 1px; ">เพิ่มรายการหลักประกัน</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <form method="post" enctype="multipart/form-data" id="frm_add_guarantee" name="frm_add_guarantee" action=""> -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="form-group"></div>


                <div class="form-group row">
                    <div class="col-md-1 text-right"></div>
                    <div id="GUARANTEE_BSF_AREA" class="col-md-6 wf-left ">
                        <label for="GUARANTEE" class="form-control-label wf-left">หลักประกัน<span class="text-danger">*</span></label>
                        <input type="text" name="GUARANTEE" id="GUARANTEE" class="form-control" placeholder="ชื่อ">
                        <small id="DUP_GUARANTEE_ALERT" class="form-text text-danger" style="display:none"></small>
                    </div>
                    <div id="SEQ_NO_BSF_AREA" class="col-md-2 wf-left ">
                        <label for="SEQ_NO" class="form-control-label wf-left">เลขที่<span class="text-danger">*</span></label>
                        <input type="text" name="SEQ_NO" id="SEQ_NO" class="form-control" placeholder="เลขที่">
                        <small id="DUP_SEQ_NO_ALERT" class="form-text text-danger" style="display:none"></small>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-1 text-right"></div>
                    <div id="DETAIL_BSF_AREA" class="col-md-10 wf-left ">
                        <label for="DETAIL" class="form-control-label wf-left">รายละเอียด<span class="text-danger">*</span></label>
                        <textarea name="DETAIL" id="DETAIL" class="form-control" required="" aria-required="true" style="height: 100px"></textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-1 text-right"></div>
                    <div id="LOCATION_BSF_AREA" class="col-md-10 wf-left ">
                        <label for="LOCATION" class="form-control-label wf-left">ที่ตั้ง<span class="text-danger">*</span></label>
                        <textarea name="LOCATION" id="LOCATION" class="form-control" required="" aria-required="true" style="height: 100px"></textarea>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- </form> -->
<div class="row">
    <div class="col-md-12">
        <div align="center">&nbsp;
            <button type="button" class="btn btn-success waves-effect waves-light" onclick="save_guarantee();" id="">บันทึก</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {});
    $('.autonumber').autoNumeric('init');
    $('.select2').select2({
        placeholder: "-- เลือก --",
        allowClear: true
    });

    function save_guarantee() {
        $(".alert_error").remove();

        var err = '';
        let guarantee = $('#GUARANTEE').val().trim();
        let seq_no = $('#SEQ_NO').val().trim();
        let detail = $('#DETAIL').val().trim();
        let location = $('#LOCATION').val().trim();


        if (!guarantee) {
            $('#GUARANTEE').after('<span class="form-text text-danger alert_error" >กรุณาระบุ หลักประกัน</span>');
            $('#GUARANTEE').focus();
            err = 1;
        }
        if (!seq_no) {
            $('#SEQ_NO').after('<span class="form-text text-danger alert_error" >กรุณาระบุ ลำดับที่</span>');
            $('#SEQ_NO').focus();
            err = 1;
        }
        if (!detail) {
            $('#DETAIL').after('<span class="form-text text-danger alert_error" >กรุณาระบุ รายละเอียด</span>');
            $('#DETAIL').focus();
            err = 1;
        }
        if (!location) {
            $('#LOCATION').after('<span class="form-text text-danger alert_error" >กรุณาระบุ ที่ตั้ง</span>');
            $('#LOCATION').focus();
            err = 1;
        }


        if (err != '') {
            return false;
        }

        var fdata = new FormData();
        fdata.append('GUARANTEE', guarantee);
        fdata.append('SEQ_NO', seq_no);
        fdata.append('DETAIL', detail);
        fdata.append('LOCATION', location);

        $.ajax({
            type: "POST",
            url: '../save/save_guarantee.php',
            processData: false,
            contentType: false,
            data: fdata,
            dataType: "json",
            beforeSend: function() {
                swal({
                    title: "",
                    text: "กำลังบันทึกข้อมูล.....",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    // imageUrl: "../icon/loading.gif",
                    showConfirmButton: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
            },
            success: function(data) {
                swal({
                    title: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                    text: '',
                    type: 'success',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: 1000
                }, function(data) {
                    swal.close();
                    window.location.reload();

                });
            }
        });

        // $('#md_tbl_guarantee').modal('hide');

    }
</script>