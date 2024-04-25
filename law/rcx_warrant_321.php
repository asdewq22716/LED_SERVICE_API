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
                    <div class="form-group row"></div>

                    <!----------------------------------------- โจทย์  ----------------------------------------->
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-control-label wf-right ">โจทย์</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-2 ">
                            <input id="plaintiff_1" name="plaintiff_1" value="" type="text" class="form-control" readonly="">
                        </div>
                        <div class="col-md-3 ">
                            <!-- <label class="form-control-label wf-left ">เจ้าหนี้หรือผู้มีสิทธิ์รับชำระหนี้</label> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-2 ">
                            <input id="plaintiff_2" name="plaintiff_2" value="" type="text" class="form-control" readonly="">
                        </div>
                        <div class="col-md-3 "></div>
                    </div>


                    <!----------------------------------------- จำเลย  ----------------------------------------->
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-control-label wf-right ">จำเลย</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-2 ">
                            <input id="defendant_1" name="defendant_1" value="" type="text" class="form-control" readonly="">
                        </div>
                        <div class="col-md-3 "></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-2 ">
                            <input id="defendant_2" name="defendant_2" value="" type="text" class="form-control" readonly="">
                        </div>
                        <div class="col-md-3 "></div>
                    </div>


                    <!----------------------------------------- ทุนทรัพย์  ----------------------------------------->
                    <div class="form-group row" style="margin-top:20px;">
                        <div id="CAPITAL_BSF_AREA" class="col-md-2 ">
                            <label for="CAPITAL" class="form-control-label wf-right">ทุนทรัพย์ <?php /* <span class="text-danger">*</span>*/ ?></label>
                        </div>
                        <div id="CAPITAL_BSF_AREA" class="col-md-2 wf-left">
                            <input type="text" name="CAPITAL" id="CAPITAL" class="form-control autonumber" value="" required="" aria-required="true" data-v-max="9999999999999999999.99" data-v-min="-9999999999999999999.99">
                            <small id="DUP_CAPITAL_ALERT" class="form-text text-danger" style="display:none"></small>
                        </div>
                        <div id="PERSON_TYPE_ID_BSF_AREA" class="col-md-2 wf-left">
                            <select name="UNIT" id="UNIT" class="form-control select2" style="width: 100%;">
                                <option value="">-- เลือก --</option>
                            </select>
                        </div>
                    </div>


                    <!----------------------------------------- หมายเหตุ ----------------------------------------->
                    <div class="form-group row">
                        <div id="NOTES_BSF_AREA" class="col-md-2 "><label for="NOTES" class="form-control-label wf-right">หมายเหตุ</label></div>
                        <div id="NOTES_BSF_AREA" class="col-md-8 wf-left">
                            <textarea name="NOTES" id="NOTES" class="form-control" required="" aria-required="true" style="height: 100px"></textarea>
                        </div>
                    </div>


                    <!----------------------------------------- คำพิพากษา ----------------------------------------->
                    <div class="form-group row">
                        <div id="SENTENCE_BSF_AREA" class="col-md-2 "><label for="SENTENCE" class="form-control-label wf-right">คำพิพากษา</label></div>
                        <div id="SENTENCE_BSF_AREA" class="col-md-8 wf-left">
                            <textarea name="SENTENCE" id="SENTENCE" class="form-control" required="" aria-required="true" style="height: 100px"></textarea>
                        </div>
                    </div>


                    <!----------------------------------------- ตาราง โจทย์ ----------------------------------------->
                    <div class="form-group row" style="margin-top:20px;" id="tbl_problem">
                        <div class="col-md-12">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <label for="" class="form-control-label wf-left">ตารางโจทย์</label>
                                <div class="f-right">
                                    <a class="btn btn-primary active waves-effect waves-light" href="#!" onclick="add_problem_defendant(1);" title="">
                                        <i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล</a><small>&nbsp;</small>
                                </div>
                                <table cellspacing="0" class="table table-bordered sorted_table" id="table2">
                                    <thead class="bg-primary">
                                        <tr class="bg-primary">
                                            <th style="width:15%;" class="text-center">เกี่ยวข้องเป็น</th>
                                            <th style="width:5%;" class="text-center">ที่</th>
                                            <th style="width:15%;" class="text-center">ชื่อ-นามสกุล</th>
                                            <th style="width:15%;" class="text-center">ชื่ออื่น(และ/หรือ)</th>
                                            <th style="width:15%;" class="text-center">สถานะตามกฎหมาย</th>
                                            <th style="width:15%;" class="text-center">ร้องขอออกหมาย</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_problem_body">
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <!----------------------------------------- ตาราง จำเลย ----------------------------------------->
                    <div class="form-group row" style="margin-top:20px;" id="tbl_defendant">
                        <div class="col-md-12">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <label for="" class="form-control-label wf-left">ตารางจำเลย</label>
                                <div class="f-right">
                                    <a class="btn btn-primary active waves-effect waves-light" href="#!" onclick="add_problem_defendant(2);" title="">
                                        <i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล</a><small>&nbsp;</small>
                                </div>
                                <table cellspacing="0" class="table table-bordered sorted_table" id="table2">
                                    <thead class="bg-primary">
                                        <tr class="bg-primary">
                                            <th style="width:15%;" class="text-center">เกี่ยวข้องเป็น</th>
                                            <th style="width:5%;" class="text-center">ที่</th>
                                            <th style="width:15%;" class="text-center">ชื่อ-นามสกุล</th>
                                            <th style="width:15%;" class="text-center">ชื่ออื่น(และ/หรือ)</th>
                                            <th style="width:15%;" class="text-center">สถานะตามกฎหมาย</th>
                                            <th style="width:15%;" class="text-center">ร้องขอออกหมาย</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_defendant_body">
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <!----------------------------------------- ตาราง หลักประกัน ----------------------------------------->
                    <div class="form-group row" style="margin-top:20px;" id="tbl_guarantee">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <label for="" class="form-control-label wf-left">หลักประกัน</label>
                                <div class="f-right">
                                    <a class="btn btn-primary active waves-effect waves-light" href="#!" onclick="add_guarantee();" title="">
                                        <i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล</a><small>&nbsp;</small>
                                </div>
                                <table cellspacing="0" class="table table-bordered sorted_table" id="table2">
                                    <thead class="bg-primary">
                                        <tr class="bg-primary">
                                            <th style="width:15%;" class="text-center">หลักประกัน</th>
                                            <th style="width:5%;" class="text-center">เลขที่</th>
                                            <th style="width:30%;" class="text-center">รายละเอียด</th>
                                            <th style="width:45%;" class="text-center">ที่ตั้ง</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_guarantee_body">
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <!----------------------------------------- ตาราง พิจารณารวมคดี ----------------------------------------->
                    <div class="form-group row" style="margin-top:20px;" id="tbl_consider">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <label for="" class="form-control-label wf-left">พิจารณารวมคดี</label>
                                <div class="f-right">
                                    <a class="btn btn-primary active waves-effect waves-light" href="#!" onclick="add_consider();" title="">
                                        <i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล</a><small>&nbsp;</small>
                                </div>
                                <table cellspacing="0" class="table table-bordered sorted_table" id="table2">
                                    <thead class="bg-primary">
                                        <tr class="bg-primary">
                                            <th style="width:10%;" class="text-center">ลำดับที่</th>
                                            <th style="width:45%;" class="text-center">หมายเลขคดีดำที่</th>
                                            <th style="width:45%;" class="text-center">หมายเลขคดีแดงที่</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_consider_body">
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <!-----------------------------------------  ----------------------------------------->
                </div>
            </div>
        </div>
    </div>
</div>


<!----------------------------------------- Modal ----------------------------------------->
<div class="modal" id="md_tbl_problem">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="md_tbl_problem_content"></div>
            <div class="modal-footer"></div>

        </div>
    </div>
</div>

<div class="modal" id="md_tbl_guarantee">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="md_tbl_guarantee_content"></div>
            <div class="modal-footer"></div>

        </div>
    </div>
</div>

<div class="modal" id="md_tbl_consider">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="md_tbl_consider_content"></div>
            <div class="modal-footer"></div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- เลือก --",
            allowClear: true
        });
    });

    function show_modal(url, body_id) {
        $.get(url, function(msg) {
            $('#' + body_id).html(msg);
        });
    }

    function add_problem_defendant(type) {
        $('#md_tbl_problem_content').html('');
        show_modal('../all_modal/modal_add_problem_defendant.php?type=' + type, 'md_tbl_problem_content');
        $('#md_tbl_problem').modal('show');
    }

    function add_guarantee() {
        $('#md_tbl_guarantee_content').html('');
        show_modal('../all_modal/modal_add_guarantee.php', 'md_tbl_guarantee_content');
        $('#md_tbl_guarantee').modal('show');
    }

    function add_consider() {
        $('#md_tbl_consider_content').html('');
        show_modal('../all_modal/modal_add_consider.php', 'md_tbl_consider_content');
        $('#md_tbl_consider').modal('show');
    }
    
</script>

<?php
include '../include/combottom_js_user.php';
include '../include/combottom_user.php';
?>