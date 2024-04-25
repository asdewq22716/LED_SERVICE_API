<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

// =========================================================
//    Variable
// =========================================================
//  ประเภท เพิ่ม หรือ แก้ไข
$process    = $_GET['process'];
$WFR_ID     = $_GET['wfr_id'] ? $_GET['wfr_id'] : '';

$arr_prefix = array();  // คำนำหน้า    M_PREFIX_MAP
$arr_province = array(); // จังหวัด M_PROVINCE_MAP, อำเภอ M_APHUR_MAP, ตำบล M_TAMBON_MAP

$sql_prefix = db::query("SELECT P_ID_LAW,P_NAME_BOF FROM M_PREFIX_MAP WHERE P_ID_LAW IS NOT NULL");
while ($rec = db::fetch_array($sql_prefix)) {
    $arr_prefix[] = $rec;
}

$sql_prefix = db::query("SELECT PROVINCE_CODE_LAW,PROVINCE_NAME_BOF FROM M_PROVINCE_MAP WHERE PROVINCE_CODE_LAW IS NOT NULL");
while ($rec = db::fetch_array($sql_prefix)) {
    $arr_province[] = $rec;
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
                    <h5 style=" margin-top: 1px; ">เพิ่มรายการ</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" enctype="multipart/form-data" id="frm_add_buyer_inf" name="frm_add_preferential" action="">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="form-group"></div>

                    <div class="form-group row">
                        <div class="col-md-1 text-right"><span class="text-danger">*</span></div>
                        <div class="col-md-6">
                            <label>
                                <input type="radio" name="HERITAGE_TYPE" id="HERITAGE_TYPE" value="1" checked="" required="" aria-required="true" placeholder="กรุณาเลือก" onchange="bsf_change_objF_2585(this.value);"><i class="helper"></i> บุคคลธรรมดา
                            </label>&ensp;&ensp;
                            <label>
                                <input type="radio" name="HERITAGE_TYPE" id="HERITAGE_TYPE" value="2" required="" aria-required="true" placeholder="กรุณาเลือก" onchange="bsf_change_objF_2585(this.value);"><i class="helper"></i> นิติบุคคล
                            </label>
                        </div>
                        <script type="text/javascript">
                            function bsf_change_objF_2585(vals) {
                                var vals_txt = vals;
                                if (vals_txt == '1') {
                                    $("[id^=CARD_STATUS_BSF_AREA]").show();
                                    $("[id^=LNAME_BSF_AREA]").show();
                                }
                                var vals_txt = vals;
                                if (vals_txt == '2') {
                                    $("[id^=CARD_STATUS_BSF_AREA]").hide();
                                    $("[id^=LNAME_BSF_AREA]").hide();
                                }

                            }
                        </script>
                    </div>


                    <div class="form-group row" id="CARD_STATUS_BSF_AREA">
                        <div class="col-md-1 text-right"><span class="text-danger">*</span></div>
                        <div class="col-md-6">
                            <label>
                                <input type="radio" name="CARD_STATUS" id="CARD_STATUS" value="Y" checked="" required="" aria-required="true"><i class="helper"></i> บัตรประจำตัวประชาชน</label>
                            <label>&ensp;&ensp;
                                <input type="radio" name="CARD_STATUS" id="CARD_STATUS" value="N" required="" aria-required="true"><i class="helper"></i> หนังสือเดินทาง
                            </label>
                        </div>
                    </div>

                    <div class="form-group row" id="">
                        <div class="col-md-1 text-right"></div>
                        <div class="col-md-5">
                            <label for="HERITAGE_ID_CARD">เลขประจำตัวประชาชน/เลขที่นิติบุคคล<span class="text-danger">*</span></label>
                            <input type="text" name="HERITAGE_ID_CARD" id="HERITAGE_ID_CARD" class="form-control idcard idcard">
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-md-1 text-right"></div>
                        <div id="PREFIX_BSF_AREA" class="col-md-4 wf-left ">
                            <label for="PREFIX" class="form-control-label wf-left">คำนำหน้า<span class="text-danger">*</span></label>
                            <select name="PREFIX" id="PREFIX" class="form-control select2" style="width: 100%;" required>
                                <option value="">--เลือก---</option>
                                <?php foreach ($arr_prefix as $prefix) { ?>
                                    <option value="<?php echo $prefix['P_ID_LAW']; ?>"><?php echo $prefix['P_NAME_BOF']; ?></option>
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



                    <div class="form-group row">
                        <div class="col-md-1 text-right"></div>
                        <div id="ADDRESS_BSF_AREA" class="col-md-8 wf-left ">
                            <label for="ADDRESS" class="form-control-label wf-left">ที่อยู่ที่สามารถติดต่อได้<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="ADDRESS" name="ADDRESS" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 80px;" required></textarea>
                            <small id="DUP_ADDRESS_ALERT" class="form-text text-danger" style="display:none"></small>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-1 text-right"></div>
                        <div id="PROVINCE_BSF_AREA" class="col-md-4 wf-left ">
                            <label for="PROVINCE" class="form-control-label wf-left">จังหวัด<span class="text-danger">*</span></label>
                            <select name="PROVINCE" id="PROVINCE" class="form-control select2" style="width: 100%;" required>
                                <option value="">--เลือก---</option>
                                <?php foreach ($arr_province as $province) { ?>
                                    <option value="<?php echo $province['PROVINCE_CODE_LAW']; ?>"><?php echo $province['PROVINCE_NAME_BOF']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="APHUR_BSF_AREA" class="col-md-4 wf-left offset-1">
                            <label for="APHUR" class="form-control-label wf-left">อำเภอ<span class="text-danger">*</span></label>
                            <select name="APHUR" id="APHUR" class="form-control select2" style="width: 100%;" required>
                                <option value="">--เลือก---</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-1 text-right"></div>
                        <div id="TAMBON_BSF_AREA" class="col-md-4 wf-left ">
                            <label for="TAMBON" class="form-control-label wf-left">ตำบล<span class="text-danger">*</span></label>
                            <select name="TAMBON" id="TAMBON" class="form-control select2" style="width: 100%;" required>
                                <option value="">--เลือก---</option>
                            </select>
                        </div>
                        <div id="ADD_ZIPCODE_BSF_AREA" class="col-md-4 wf-left offset-1">
                            <label for="ADD_ZIPCODE" class="form-control-label wf-left">รหัสไปรษณีย์</label>
                            <input type="text" name="ADD_ZIPCODE" id="ADD_ZIPCODE" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-1 text-right"></div>
                        <div id="MONEY_BSF_AREA" class="col-md-4 wf-left">
                            <label for="MONEY" class="form-control-label wf-left">จำนวนเงิน(บาท)<span class="text-danger">*</span></label>
                            <input type="text" name="MONEY" id="MONEY" class="form-control autonumber" value="" data-v-max="9999999999999999999.00" data-v-min="-9999999999999999999.00">
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</form>
<br>
<div class="row">
    <div class="col-md-12">
        <div align="center">&nbsp;
            <button type="button" class="btn btn-success waves-effect waves-light" onclick="save_buyer_inf('<?php echo $process; ?>','<?php echo $WFR_ID; ?>');" id="btn_save_buyer_inf">บันทึก</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#HERITAGE_ID_CARD").inputmask({
            mask: "9-9999-99999-99-9"
        });
    });
    $('.autonumber').autoNumeric('init');

    $('input[id^=HERITAGE_TYPE]').change(function() {
        var type = $('input[id^=HERITAGE_TYPE]:checked').val();

        if (type == '1') {
            $('#CARD_STATUS').prop('checked', true);

            $("#HERITAGE_ID_CARD").inputmask({
                mask: "9-9999-99999-99-9"
            });

        } else {
            $('#CARD_STATUS').prop('checked', false);
            $('#LNAME').val('');

            $("#HERITAGE_ID_CARD").inputmask('remove');
            $("#HERITAGE_ID_CARD").inputmask({
                mask: "9999999999999"
            });
        }
    });


    function save_buyer_inf(process, id = '') {
        $(".alert_error").remove();

        var err = '';
        let heritage_type = $('input[name=HERITAGE_TYPE]:checked').val();
        let heritage_id_card = $('#HERITAGE_ID_CARD').val();
        let prefix = $('#PREFIX').val();
        let fname = $('#FNAME').val();
        let lname = $('#LNAME').val();
        let address = $('#ADDRESS').val().trim();
        let province = $('#PROVINCE').val();
        let aphur = $('#APHUR').val();
        let tambon = $('#TAMBON').val();
        let add_zipcode = $('#ADD_ZIPCODE').val();
        let money = $('#MONEY').val();

        if (heritage_id_card == '') {
            $('#HERITAGE_ID_CARD').after('<span class="form-text text-danger alert_error" >กรุณาระบุ เลขประจำตัวประชาชน/เลขที่นิติบุคคล</span>');
            err = 1;
        }
        if (prefix == '') {
            $('#PREFIX_BSF_AREA .selection').after('<span class="form-text text-danger alert_error" >กรุณาระบุ คำนำหน้า</span>');
            err = 1;
        }
        if (fname == '') {
            $('#FNAME').after('<span class="form-text text-danger alert_error" >กรุณาระบุ ชื่อ</span>');
            err = 1;
        }
        if (heritage_type == '1') {
            if (lname == '') {
                $('#LNAME').after('<span class="form-text text-danger alert_error" >กรุณาระบุ สกุล</span>');
                err = 1;
            }
        }
        if (address == '') {
            $('#ADDRESS').after('<span class="form-text text-danger alert_error" >กรุณาระบุ ที่อยู่ที่สามารถติดต่อได้</span>');
            err = 1;
        }
        if (!province) {
            $('#PROVINCE_BSF_AREA .selection').after('<span class="form-text text-danger alert_error" >กรุณาระบุ จังหวัด</span>');
            err = 1;
        }
        if (!aphur) {
            $('#APHUR_BSF_AREA .selection').after('<span class="form-text text-danger alert_error" >กรุณาระบุ อำเภอ</span>');
            err = 1;
        }
        if (!tambon) {
            $('#TAMBON_BSF_AREA .selection').after('<span class="form-text text-danger alert_error" >กรุณาระบุ ตำบล</span>');
            err = 1;
        }
        if (!money) {
            $('#MONEY').after('<span class="form-text text-danger alert_error" >กรุณาระบุ จำนวนเงิน</span>');
            err = 1;
        }

        if (err != '') {
            return false;
        }

        var fdata = new FormData();
        if (id != '') {
            fdata.append('WFR_ID', id);
        }
        fdata.append('process', process);
        fdata.append('HERITAGE_TYPE', heritage_type);
        fdata.append('HERITAGE_ID_CARD', heritage_id_card);
        fdata.append('PREFIX', prefix);
        fdata.append('FNAME', fname);
        fdata.append('LNAME', lname);
        fdata.append('ADDRESS', address);
        fdata.append('PROVINCE', province);
        fdata.append('APHUR', aphur);
        fdata.append('TAMBON', tambon);
        fdata.append('ADD_ZIPCODE', add_zipcode);

        $.ajax({
            type: "POST",
            url: '../save/save_buyer_inf.php',
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
                    location.reload();

                });
            }
        });
        $('#buyer_inf_modal').modal('hide');
    }

    $('.select2').select2({
        placeholder: "  --เลือก--    ",
        allowClear: true
    });
    $('#PROVINCE').change(function() {
        $.ajax({
            type: "POST",
            url: "../save/get_addr.php",
            data: {
                type: 'province',
                province: $(this).val()
            },
            dataType: "json",
            success: function(data) {
                $('#APHUR').html(data.html);
            }
        });
    });
    $('#APHUR').change(function() {
        $.ajax({
            type: "POST",
            url: "../save/get_addr.php",
            data: {
                type: 'aphur',
                aphur: $(this).val()
            },
            dataType: "json",
            success: function(data) {
                $('#TAMBON').html(data.html);
            }
        });
    });
</script>