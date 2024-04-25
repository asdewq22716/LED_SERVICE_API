<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

$HIDE_HEADER = "P";
include '../include/comtop_user.php';


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div id="wf_space" class="card-block">
                    <div class="">
                        <div class="f-right">
                            <a class="btn btn-primary active waves-effect waves-light" href="#!" onclick="manage_buyer('add');" title="">
                                <i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล</a><small>&nbsp;</small>
                        </div>
                        <table id="table_list" border="1" width="100%" class="table table-bordered sorted_table">
                            <thead class="bg-primary">
                                <tr>
                                    <th style="width: 10%; text-align: center;">ลำดับ</th>
                                    <th style="text-align: center;">ชื่อ-สกุล</th>
                                    <th style="text-align: center;">จำนวน (บาท)</th>
                                    <th style="width: 20%; text-align: center;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="temp_row">
                                    <td class="text-center">1</td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-mini btn-success" onclick="manage_buyer('edit',1);"><i class="fa fa-pencil"></i></button>&nbsp;<button type="button" class="btn btn-mini btn-danger" onclick="del_buyer(1)"><i class="fa fa-trash"></i> </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="buyer_inf_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- <h5 class="modal-title" id="buyer_inf_modal_label">เพิ่มรายการ</h5> -->
            </div>
            <div class="modal-body" id="buyer_inf_content">

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button> -->
                <!-- <button type="button" class="btn btn-primary">บันทึก</button> -->
            </div>
        </div>

    </div>
</div>

<?php
include '../include/combottom_js_user.php';
include '../include/combottom_user.php';
?>

<script>
    function show_modal(url, body_id) {
        $.get(url, function(msg) {
            $('#' + body_id).html(msg);
        });
    }

    $('.select2').select2({
        placeholder: "  --เลือก--    ",
        allowClear: true
    });


    function manage_buyer(process, id = '') {
        $('#buyer_inf_content').html('');
        var param_id = '';
        if (id != '') {
            param_id = '&wfr_id=' + id;
        }
        show_modal('../all_modal/modal_add_buyer_inf.php?process=' + process + param_id, 'buyer_inf_content');
        $('#buyer_inf_modal').modal('show');
    }


    function del_buyer(wfr_id) {
        if (wfr_id) {
            var url_process = '../save/save_buyer_inf.php';
            swal({
                title: "",
                text: "ยืนยันการลบ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: false,
                closeOnCancel: true,
                showLoaderOnConfirm: false,
            }, function() {
                swal.disableButtons();
                $.ajax({
                    type: "POST",
                    url: url_process,
                    processData: false,
                    contentType: false,
                    data: {
                        process: 'del',
                        WFR_ID: wfr_id,
                    },
                    success: function(data) {
                        swal({
                            title: 'ลบข้อมูลเรียบร้อยแล้ว',
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
            });
        }
    }
</script>