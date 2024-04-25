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
                    <h5 style=" margin-top: 1px; ">เพิ่มรายการพิจารณารวมคดี</h5>
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


                <div class="form-group row" id="BLACK_CASE_F_AREA">
                    <div class="col-md-1 text-right"></div>
                    <div id="PREFIX_BLACK_CASE_BSF_AREA" class="col-md-2 wf-left ">
                        <label for="BLACK_CASE" class="form-control-label wf-left">
                            หมายเลขคดีดำที่<span class="text-danger">*</span>
                        </label>
                        <input type="text" name="PREFIX_BLACK_CASE" id="PREFIX_BLACK_CASE" class="form-control" placeholder="พ, ผบ">
                        <span id="DUP_PREFIX_BLACK_CASE_ALERT"></span>
                    </div>
                    <div id="BLACK_CASE_AREA" class="col-md-4 wf-left">
                        <label for="PREFIX_BLACK_CASE" class="form-control-label wf-left">&#160;</label>
                        <div class="input-group">
                            <input type="text" name="BLACK_CASE" id="BLACK_CASE" class="form-control is-valid" value="" placeholder="0001">
                            <span class="input-group-addon">/</span>
                            <input type="text" name="BLACK_YY" id="BLACK_YY" class="form-control is-valid" value="" placeholder="XXXX">
                        </div>
                        <span id="DUP_BLACK_CASE_ALERT"></span>
                    </div>
                </div>


                <div class="form-group row" id="RED_CASE_F_AREA">
                    <div class="col-md-1 text-right"></div>
                    <div id="PREFIX_RED_CASE_BSF_AREA" class="col-md-2 wf-left ">
                        <label for="RED_CASE" class="form-control-label wf-left">
                            หมายเลขคดีแดงที่<span class="text-danger">*</span>
                        </label>
                        <input type="text" name="PREFIX_RED_CASE" id="PREFIX_RED_CASE" class="form-control" placeholder="พ, ผบ">
                        <span id="DUP_PREFIX_RED_CASE_ALERT"></span>
                    </div>
                    <div id="RED_CASE_AREA" class="col-md-4 wf-left">
                        <label for="PREFIX_RED_CASE" class="form-control-label wf-left">&#160;</label>
                        <div class="input-group">
                            <input type="text" name="RED_CASE" id="RED_CASE" class="form-control is-valid" value="" placeholder="0001">
                            <span class="input-group-addon">/</span>
                            <input type="text" name="RED_YY" id="RED_YY" class="form-control is-valid" value="" placeholder="XXXX">
                        </div>
                        <span id="DUP_RED_CASE_ALERT"></span>
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
            <button type="button" class="btn btn-success waves-effect waves-light" onclick="save_consider();" id="">บันทึก</button>
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

    function save_consider() {
        $(".alert_error").remove();

        var err = '';
        let prefix_black_case = $('#PREFIX_BLACK_CASE').val().trim();
        let black_case = $('#BLACK_CASE').val().trim();
        let black_yy = $('#BLACK_YY').val().trim();

        let prefix_red_case = $('#PREFIX_RED_CASE').val().trim();
        let red_case = $('#RED_CASE').val().trim();
        let red_yy = $('#RED_YY').val().trim();


        if (!prefix_black_case) {
            $('#DUP_PREFIX_BLACK_CASE_ALERT').after('<span class="form-text text-danger alert_error" >กรุณาระบุ</span>');
            $('#PREFIX_BLACK_CASE').focus();
            err = 1;
        }

        if (!black_case || !black_yy) {
            $('#DUP_BLACK_CASE_ALERT').after('<span class="form-text text-danger alert_error" >กรุณาระบุ</span>');
            if (!black_case) {
                $('#BLACK_CASE').focus();
            } else {
                $('#BLACK_YY').focus();
            }
            err = 1;
        }

        if (!prefix_red_case) {
            $('#DUP_PREFIX_RED_CASE_ALERT').after('<span class="form-text text-danger alert_error" >กรุณาระบุ</span>');
            $('#PREFIX_RED_CASE').focus();
            err = 1;
        }

        if (!red_case || !red_yy) {
            $('#DUP_RED_CASE_ALERT').after('<span class="form-text text-danger alert_error" >กรุณาระบุ</span>');
            if (!red_case) {
                $('#RED_CASE').focus();
            } else {
                $('#RED_YY').focus();
            }
            err = 1;
        }


        if (err != '') {
            return false;
        }

        var fdata = new FormData();
        fdata.append('PREFIX_BLACK_CASE', prefix_black_case);
        fdata.append('BLACK_CASE', black_case);
        fdata.append('BLACK_YY', black_yy);
        fdata.append('PREFIX_RED_CASE', prefix_red_case);
        fdata.append('RED_CASE', red_case);
        fdata.append('RED_YY', red_yy);

        $.ajax({
            type: "POST",
            url: '../save/save_consider.php',
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