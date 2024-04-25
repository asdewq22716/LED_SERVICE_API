<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

// =========================================================
//    $_GET
// =========================================================
$type = $_GET['type'];

// =========================================================
//    Variable
// =========================================================
$arr_type = array(1 => 'โจทย์', 2 => 'จำเลย');
$arr_concern = array();  // เกี่ยวข้องเป็น    M_CONCERN
$arr_per_type = array();  // ประเภทบุคคล    M_MAP_PER_TYPE
$arr_prefix = array();  // คำนำหน้า    M_PREFIX_MAP
$per_type = 2;     // ข้อมูล ประเภทบุคคล ของรายการ
$concern = '';     // ข้อมูล เกี่ยวข้องเป็น ของรายการ

// เกี่ยวข้องเป็น
$sql_concern = db::query("SELECT ID_PK,NAME_CONCERN FROM M_CONCERN ");
while ($rec = db::fetch_array($sql_concern)) {
    $arr_concern[$rec['ID_PK']] = $rec['NAME_CONCERN'];
}

// ประเภทบุคคล
$sql_per_type = db::query("SELECT PERSON_TYPE_ID,PERSON_TYPE_NAME FROM M_MAP_PER_TYPE WHERE PERSON_TYPE_ID IN (1,2) ");
while ($rec = db::fetch_array($sql_per_type)) {
    $arr_per_type[$rec['PERSON_TYPE_ID']] = $rec['PERSON_TYPE_NAME'];
}

// คำนำหน้า
$sql_prefix = db::query("SELECT P_ID_LAW,P_NAME_BOF FROM M_PREFIX_MAP WHERE P_ID_LAW IS NOT NULL");
while ($rec = db::fetch_array($sql_prefix)) {
    $arr_prefix[$rec['P_ID_LAW']] = $rec['P_NAME_BOF'];
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
                    <?php /* <img src="../icon/<?php echo $rec_main['WF_MAIN_ICON']; ?>" class="media-object" style="width:45px;"> */ ?>
                </a>
                <div class="media-body">
                    <h5 style=" margin-top: 1px; ">เพิ่มรายการ<?php echo $arr_type[$type]; ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <form method="post" enctype="multipart/form-data" id="frm_add_buyer_inf" name="frm_add_preferential" action=""> -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="form-group"></div>


                    <div class="form-group row">
                        <div class="col-md-1 text-right"></div>
                        <div id="SEQ_NO_BSF_AREA" class="col-md-2 wf-left ">
                            <label for="SEQ_NO" class="form-control-label wf-left">ลำดับที่<span class="text-danger">*</span></label>
                            <input type="text" name="SEQ_NO" id="SEQ_NO" class="form-control" placeholder="ลำดับที่">
                            <small id="DUP_SEQ_NO_ALERT" class="form-text text-danger" style="display:none"></small>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-1 text-right"></div>
                        <div id="PER_TYPE_BSF_AREA" class="col-md-4 wf-left ">
                            <label for="PER_TYPE" class="form-control-label wf-left">ประเภทบุคคล<span class="text-danger">*</span></label>
                            <select name="PER_TYPE" id="PER_TYPE" class="form-control select2" style="width: 100%;" onchange="bsf_change_objF_2585(this.value);">
                                <?php foreach ($arr_per_type as $key => $val) { ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($key == $per_type) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                                <?php  } ?>
                            </select>
                        </div>

                        <script type="text/javascript">
                            function bsf_change_objF_2585(vals) {
                                var vals_txt = vals;
                                if (vals_txt == '2') {
                                    $("[id^=LNAME_BSF_AREA]").show();
                                }
                                var vals_txt = vals;
                                if (vals_txt == '1') {
                                    $('#LNAME').val('');
                                    $("[id^=LNAME_BSF_AREA]").hide();
                                }
                            }
                        </script>

                        <div id="CONCERN_BSF_AREA" class="col-md-4 wf-left ">
                            <label for="CONCERN" class="form-control-label wf-left">เกี่ยวข้องเป็น<span class="text-danger">*</span></label>
                            <select name="CONCERN" id="CONCERN" class="form-control select2" style="width: 100%;">
                                <option value="">-- เลือก --</option>
                                <?php foreach ($arr_concern as $key => $val) { ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($key == $concern) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                                <?php  } ?>
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-1 text-right"></div>
                        <div id="PREFIX_BSF_AREA" class="col-md-4 wf-left ">
                            <label for="PREFIX" class="form-control-label wf-left">คำนำหน้า<span class="text-danger">*</span></label>
                            <select name="PREFIX" id="PREFIX" class="form-control select2" style="width: 100%;" required>
                                <option value="">-- เลือก --</option>
                                <?php foreach ($arr_prefix as $key => $val) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-1 text-right"></div>
                        <div id="FNAME_BSF_AREA" class="col-md-4 wf-left ">
                            <label for="FNAME" class="form-control-label wf-left">ชื่อ<span class="text-danger">*</span></label>
                            <input type="text" name="FNAME" id="FNAME" class="form-control" placeholder="ชื่อ">
                            <small id="DUP_FNAME_ALERT" class="form-text text-danger" style="display:none"></small>
                        </div>
                        <div id="LNAME_BSF_AREA" class="col-md-4 wf-left ">
                            <label for="LNAME" class="form-control-label wf-left">นามสกุล<span class="text-danger">*</span></label>
                            <input type="text" name="LNAME" id="LNAME" class="form-control" value="" required="" aria-required="true" placeholder="นามสกุล">
                            <small id="DUP_LNAME_ALERT" class="form-text text-danger" style="display:none"></small>
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
            <button type="button" class="btn btn-success waves-effect waves-light" onclick="save_problem_defendant(<?php echo $type; ?>);" id="">บันทึก</button>
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

    function save_problem_defendant(type) {
        $(".alert_error").remove();

        var err = '';
        let seq_no = $('#SEQ_NO').val().trim();
        let per_type = $('#PER_TYPE').val();
        let concern = $('#CONCERN').val();
        let prefix = $('#PREFIX').val().trim();
        let fname = $('#FNAME').val().trim();
        let lname = $('#LNAME').val().trim();

        if (!seq_no) {
            $('#SEQ_NO').after('<span class="form-text text-danger alert_error" >กรุณาระบุ ลำดับที่</span>');
            $('#SEQ_NO').focus();
            err = 1;
        }
        if (!per_type) {
            $('#PER_TYPE_BSF_AREA .selection').after('<span class="form-text text-danger alert_error" >กรุณาระบุ ประเภทบุคคล</span>');
            err = 1;
        }
        if (!concern) {
            $('#CONCERN_BSF_AREA .selection').after('<span class="form-text text-danger alert_error" >กรุณาระบุ เกี่ยวข้องเป็น</span>');
            err = 1;
        }
        if (!prefix) {
            $('#PREFIX_BSF_AREA .selection').after('<span class="form-text text-danger alert_error" >กรุณาระบุ คำนำหน้า</span>');
            err = 1;
        }
        if (!fname) {
            $('#FNAME').after('<span class="form-text text-danger alert_error" >กรุณาระบุ ชื่อ</span>');
            err = 1;
        }
        if (!lname) {
            $('#LNAME').after('<span class="form-text text-danger alert_error" >กรุณาระบุ นามสกุล</span>');
            err = 1;
        }

        if (err != '') {
            return false;
        }

        var fdata = new FormData();
        fdata.append('TYPE', type);
        fdata.append('SEQ_NO', seq_no);
        fdata.append('PER_TYPE', per_type);
        fdata.append('CONCERN', concern);
        fdata.append('PREFIX', prefix);
        fdata.append('FNAME', fname);
        fdata.append('LNAME', lname);

        $.ajax({
            type: "POST",
            url: '../save/save_problem_defendant.php',
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
                    timer: 1000,
                }, function() {
                    swal.close();
                    window.location.reload();

                });
            }
        });

        // $('#md_tbl_problem').modal('hide');
    }
</script>