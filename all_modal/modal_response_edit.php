<?php

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$api_name = $_GET['API_NAME'];
$api_setting_id = $_GET['SETTING_ID'];

$sql = "SELECT
              *
        FROM
            M_API_SETTING
        WHERE
            1 = 1 AND API_SETTING_ID = '".$api_setting_id."'";
$qry = db::query($sql);
$rec_set = db::fetch_array($qry);
?>
<div class="row" id="animationSandbox">
    <form method="POST" id="form_wf_save" name="form_wf_save">
        <div class="col-sm-12">

            <div class="main-header">

                <div class="media m-b-12">


                    <div class="media-body text-left">

                        <h4 class="form-control-label" style="padding:5px"><?php echo $api_setting_id?'แก้ไข':'เพิ่ม'; ?>รายละเอียดบริการของ ฐานข้อมูล</h4>

                        <br><br>

                        <input name="service_id" id="service_id"
                            value="<?php if (empty($rec_set)) {echo $rec['SERVICE_MANAGE_ID'];} else {echo $rec_set['SERVICE_ID'];}?>"
                            hidden />
                        <input name="service_code" id="service_code"
                            value="<?php if (empty($rec_set)) {echo $rec['SERVICE_CODE'];} else {echo $rec_set['SERVICE_CODE'];}?>"
                            hidden />
                        <div class="row">
                            <div class="col-md-2 offset-md-1">
                                <div class="form-control-label">ชื่อการตั้งค่า</div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="setting_name" id="setting_name" class="form-control"
                                    value="<?php echo ($api_name != '') ? '' :$rec_set['SERVICE_LIST']; ?>">
                                <?php if($api_name == ''){ ?>
                                <input type="text" name="setting_id" id="setting_id" class="form-control"
                                    value="<?php echo $api_setting_id; ?>" hidden>
                                <?php } ?>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-2 offset-md-1">
                                <div class="form-control-label">รายละเอียด</div>
                            </div>
                            <div class="col-md-6">
                                <textarea name="api_desc" id="api_desc" class="form-control"><?php echo $rec_set['API_DESC']; ?></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2 offset-md-1">
                                <div class="form-control-label">สถานะ</div>
                            </div>
                            <div class="col-md-4 radio-inline">
                                <input type="radio" name="setting_status" id="setting_status" value="1"
                                    <?php if ($rec_set['API_STATUS'] == 1) {?> checked <?php }?> />
                                <label class="form-control-label">ใช้งาน</label>
                                <input type="radio" name="setting_status" id="setting_status" value="0"
                                    <?php if ($rec_set['API_STATUS'] == 0) {?> checked <?php }?> />
                                <label class="form-control-label">ไม่ใช้งาน</label>
                            </div>
                        </div><br>
                        <?php if ($api_setting_id != '') { ?>
                        <div class="row">
                            <div class="col-md-2 offset-md-1">
                                <div class="form-control-label">ออกเอกสาร</div>
                            </div>
                            <div class="col-md-4 radio-inline">
                                <input type="radio" name="export_report" id="export_report" value="1"
                                    <?php if ($rec_set['EXPORT_REPORT'] == 1) {?> checked <?php }?> />
                                <label class="form-control-label">ใช้งาน</label>
                                <input type="radio" name="export_report" id="export_report" value="2"
                                    <?php if ($rec_set['EXPORT_REPORT'] == 2) {?> checked <?php }?> />
                                <label class="form-control-label">ไม่ใช้งาน</label>
                            </div>
                        </div>
                        <br>
                        <?php } ?>
                        <h5 class="form-control-label">• รูปแบบการส่งข้อมูล</h5>
                        รูปแบบ
                        <label class="label bg-primary">5000 [0]</label>
                        <label class="label bg-success">T [0]</label>
                        <label class="label bg-warning">Office ID [0]</label>
                        <label class="label bg-danger">Service Version [0]</label>
                        <label class="label bg-info">Service ID [0]</label>
                        <label class="label bg-inverse">PID [0]</label>
                        <br><br><br>



                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-block">

                        <div class="f-right"></div>

                        <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                            <div class="showborder">

                                <h5 class="form-control-label">• พจนานุกรมข้อมูลที่ร้องขอ</h5>

                                <?php if ($api_name == '' && $api_setting_id != ''){ ?>
                                <div class="f-right">
                                    <button type="button" onclick="open_add_list('1', '<?php echo $api_setting_id; ?>');" class="btn btn-primary btn-mini" >
                                    <i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                                </div>
                                <?php } ?>

                                <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                    <thead class="bg-primary">
                                        <tr class="bg-primary">
                                            <th style="width: 5%;" class="text-center">ลำดับ</th>
                                            <th style="width: 15%;" class="text-center">Key</th>
                                            <th style="width: 10%;" class="text-center">Type</th>
                                            <th style="width: 10%;" class="text-center">M/O</th>
                                            <th style="width: 15%;" class="text-center">รายละเอียด</th>
                                            <?php if ($api_name == '' && $api_setting_id != ''){ ?>
                                                <th style="width: 10%;" class="text-center"></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($api_setting_id)) {
                                            if ($json_data['status'] == 1) {

                                                $i = 1;
                                                foreach ($json_data['data']['request'] as $key => $val) {
                                                    if($val['FIELD_TYPE'] == "M" || $val['FIELD_TYPE'] == "m"){
                                                        $val['FIELD_TYPE'] = "O";
                                                    }
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td class="text-center">
                                                <input type="text" name="request_key[]" id="request_key<?php echo $i ?>"
                                                    hidden="true" value="<?php echo $val['FIELD']; ?>" />
                                                <?php echo $val['FIELD']; ?>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" name="request_type[]"
                                                    id="request_type<?php echo $i ?>" hidden="true"
                                                    value="<?php echo $val['TYPE']; ?>" />
                                                <?php echo $val['TYPE']; ?>
                                            </td>
                                            <td class="text-center">
                                                <select name="request_select[]" id="request_select<?php echo $i ?>"
                                                    class="form-control select2">
                                                    <option value="<?php echo $val['FIELD_TYPE']; ?>">
                                                        <?php echo $val['FIELD_TYPE']; ?></option>
                                                    <option
                                                        value="<?php if ($val['FIELD_TYPE'] == "O" || $val['FIELD_TYPE'] == "o") {echo "M";} else {echo "O";}?>">
                                                        <?php if ($val['FIELD_TYPE'] == "O" || $val['FIELD_TYPE'] == "o") {echo "M";} else {echo "O";}?>
                                                    </option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="request_desc[]"
                                                    id="request_desc<?php echo $i ?>" hidden="true"
                                                    value="<?php echo $val['DESC']; ?>" />
                                                <?php echo $val['DESC']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                                  $i++;
                                                }

                                            } else {
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="5">ไม่พบข้อมูล</td>
                                        </tr>
                                        <?php
                                            }
                                        } else {

                                            if (isset($api_setting_id)) {
                                                $sql = "SELECT
                                                              *
                                                        FROM
                                                            M_API_LIST
                                                        WHERE
                                                            1 = 1 AND API_SETTING_ID = $api_setting_id AND API_STATUS = 0 ORDER BY ORDER_NO,API_LIST_ID ASC";
                                                $qry = db::query($sql);
                                                $i = 1;
                                                while ($rec = db::fetch_array($qry)) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?>
                                                <input type="text" name="list_id_req[]" id="list_id_req"
                                                    class="form-control" value="<?php echo $rec['API_LIST_ID']; ?>"
                                                    hidden="true">
                                            </td>
                                            <td class="text-left">
                                                <input type="text" name="request_key[]" id="request_key<?php echo $i ?>"
                                                    hidden="true" value="<?php echo $rec['KEY']; ?>" />
                                                <?php echo $rec['KEY']; ?>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" name="request_type[]"
                                                    id="request_type<?php echo $i ?>" hidden="true"
                                                    value="<?php echo $rec['TYPE']; ?>" />
                                                <?php echo $rec['TYPE']; ?>
                                            </td>
                                            <td class="text-center">
                                                <select name="request_select[]" id="request_select<?php echo $i ?>"
                                                    class="form-control select2">
                                                    <option value="<?php echo $rec['STATUS']; ?>">
                                                        <?php echo $rec['STATUS']; ?></option>
                                                    <option
                                                        value="<?php if ($rec['STATUS'] == "O" || $rec['STATUS'] == "o") {echo "M";} else {echo "O";}?>">
                                                        <?php if ($rec['STATUS'] == "O" || $val['STATUS'] == "o") {echo "M";} else {echo "O";}?>
                                                    </option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="request_desc[]"
                                                    id="request_desc<?php echo $i ?>" hidden="true"
                                                    value="<?php echo $rec['API_DESC']; ?>" />
                                                <?php echo $rec['API_DESC']; ?>
                                            </td>
                                            <?php if ($api_name == '' && $api_setting_id != ''){ ?>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-success btn-mini" onclick="open_edit_list('1', '<?php echo $api_setting_id; ?>','<?php echo $rec['API_LIST_ID']; ?>');">
                                                        <i class="icofont icofont-ui-edit"></i>
                                                    </button>&ensp;
                                                    <button type="button" class="btn btn-danger btn-mini" onclick="del_api_list('<?php echo $api_setting_id; ?>','<?php echo $rec['API_LIST_ID']; ?>');">
                                                        <i class="icofont icofont-trash"></i>
                                                    </button>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                                    $i++;
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>



                        <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                            <div class="showborder">

                                <h5 class="form-control-label">• พจนานุกรมข้อมูลที่ตอบกลับ</h5>
                                <?php if ($api_name == '' && $api_setting_id != ''){ ?>
                                    <div class="f-right">
                                        <button type="button" onclick="open_add_list('2', '<?php echo $api_setting_id; ?>');" class="btn btn-primary btn-mini" >
                                        <i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                                    </div>
                                <?php } ?>

                                <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                                    <thead class="bg-primary">
                                        <tr class="bg-primary">
                                            <th style="width: 5%;" class="text-center">ลำดับ</th>
                                            <th style="width: 15%;" class="text-center">Key</th>
                                            <th style="width: 10%;" class="text-center">Type</th>
                                            <th style="width: 10%;" class="text-center">แสดงผล</th>
                                            <th style="width: 15%;" class="text-center">รายละเอียด</th>
                                            <?php if ($api_name == '' && $api_setting_id != ''){ ?>
                                                <th style="width: 10%;" class="text-center"></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($api_setting_id)) {
                                            if ($json_data['status'] == 1) {

                                                $i = 1;
                                                foreach ($json_data['data']['response'] as $key => $val) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td class="text-center">
                                                <input type="text" name="response_key[]"
                                                    id="response_key<?php echo $i; ?>" hidden="true"
                                                    value="<?php echo $val['FIELD']; ?>" />
                                                <?php echo $val['FIELD']; ?>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" name="response_type[]"
                                                    id="response_type<?php echo $i; ?>" hidden="true"
                                                    value="<?php echo $val['TYPE']; ?>" />
                                                <?php echo $val['TYPE']; ?>
                                            </td>
                                            <td class="text-center">
                                                <select name="response_select[]" id="response_select<?php echo $i; ?>" class="form-control select2">
                                                    <option value="S">แสดง</option>
                                                    <option value="H">ซ่อน</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="response_desc[]"
                                                    id="response_desc<?php echo $i; ?>" hidden="true"
                                                    value="<?php echo $val['DESC']; ?>" />
                                                <?php echo $val['DESC']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                                    $i++;
                                                  }
                                              } else {
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="5">ไม่พบข้อมูล</td>
                                        </tr>
                                        <?php
                                              }
                                        } else {
                                            if (isset($api_setting_id)) {
                                                $sql = "SELECT
                                                              *
                                                        FROM
                                                            M_API_LIST
                                                        WHERE
                                                            1 = 1 AND API_SETTING_ID = $api_setting_id AND API_STATUS = 1 ORDER BY ORDER_NO,API_LIST_ID ASC";
                                                $qry = db::query($sql);
                                                $i = 1;
                                                while ($rec = db::fetch_array($qry)) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?>
                                                <input type="text" name="list_id_res[]" id="list_id_res"
                                                    class="form-control" value="<?php echo $rec['API_LIST_ID']; ?>"
                                                    hidden="true">
                                            </td>
                                            <td class="text-left">
                                                <input type="text" name="response_key[]"
                                                    id="response_key<?php echo $i ?>" hidden="true"
                                                    value="<?php echo $rec['KEY']; ?>" />
                                                <?php echo $rec['KEY']; ?>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" name="response_type[]"
                                                    id="response_type<?php echo $i ?>" hidden="true"
                                                    value="<?php echo $rec['TYPE']; ?>" />
                                                <?php echo $rec['TYPE']; ?>
                                            </td>
                                            <td class="text-center">
                                                <select name="response_select[]" id="response_select<?php echo $i ?>"
                                                    class="form-control select2">
                                                    <option value="S" <?php echo ($rec['STATUS']=="S"?"selected":""); ?>>แสดง</option>
                                                    <option value="H" <?php echo ($rec['STATUS']=="H"?"selected":""); ?>>ซ่อน</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="response_desc[]"
                                                    id="response_desc<?php echo $i ?>" hidden="true"
                                                    value="<?php echo $rec['API_DESC']; ?>" />
                                                <?php echo $rec['API_DESC']; ?>
                                            </td>
                                            <?php if ($api_name == '' && $api_setting_id != ''){ ?>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-success btn-mini" onclick="open_edit_list('2', '<?php echo $api_setting_id; ?>','<?php echo $rec['API_LIST_ID']; ?>');">
                                                        <i class="icofont icofont-ui-edit"></i>
                                                    </button>&ensp;
                                                    <button type="button" class="btn btn-danger btn-mini" onclick="del_api_list('<?php echo $api_setting_id; ?>','<?php echo $rec['API_LIST_ID']; ?>');">
                                                        <i class="icofont icofont-trash"></i>
                                                    </button>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
										
	if($rec['API_REF'] != ""){
		 $sql_sub = "SELECT * FROM M_API_LIST WHERE 1 = 1 AND API_SETTING_ID = '".$rec['API_REF']."' AND API_STATUS = 1 AND STATUS = 'S' ORDER BY ORDER_NO,API_LIST_ID ASC";
                                                $qry_sub = db::query($sql_sub);
                                                $ii = 1;
                                                while ($rec_sub = db::fetch_array($qry_sub)) {
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                            </td>
                                            <td class="text-left"> 
                                                - <?php echo $rec_sub['KEY']; ?>
                                            </td>
                                            <td class="text-center"> 
                                                <?php echo $rec_sub['TYPE']; ?>
                                            </td>
                                            <td class="text-center">แสดง
                                            </td>
                                            <td>
                                                <?php echo $rec_sub['API_DESC']; ?>
                                            </td>
                                            <?php if ($api_name == '' && $api_setting_id != ''){ ?>
                                                <td style="text-align: center;"> 
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
										$ii++;
		}
	}
										
										
										
										
										
                                                  $i++;
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if ($api_name != '') {?>
                    <button type="button" class="btn btn-success" data-dismiss="modal"
                        onclick="save_API()">บันทึก</button>
                    <?php } else {?>
                    <button type="button" class="btn btn-success" data-dismiss="modal"
                        onclick="update_API()">บันทึก</button>
                    <?php }?>
                </div>
            </div>
    </form>
</div>
<script>
function save_API() {

    var fdata = new FormData($('#form_wf_save')[0]);
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: '../save/insert_api_manual.php',
        data: fdata,
        success: function(data) {
            console.log(result);

        }
    });
    $('#bizModalEdit').on('hidden.bs.modal', function() {
        location.reload();
    })
}

function update_API() {

    var fdata = new FormData($('#form_wf_save')[0]);
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: '../save/update_api_manual.php',
        data: fdata,
        success: function(data) {

        }
    });
    $('#bizModalEdit').on('hidden.bs.modal', function() {
        location.reload();
    })
}

function del_api_list(settingId, apiListId){
    if(confirm('ยืนยันการลบรายการ')){
        $.ajax({
        type: "POST",
        url: '../save/del_api_list.php',
        dataType: 'json',
        data: {
            API_LIST_ID: apiListId
        },
        success: function(data) {
            refresh_modal(settingId);
        }
    });
    }
}

$('.select2').select2();
</script>
<style>
.select2-container .select2-selection--single {
    height: 34px !important;
}

.select2-container--default .select2-selection--single {
    border: 1px solid #ccc !important;
    border-radius: 0px !important;
}
</style>