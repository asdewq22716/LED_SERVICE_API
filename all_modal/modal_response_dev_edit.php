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
            1 = 1 AND API_SETTING_ID = '" . $api_setting_id . "'";
$qry = db::query($sql);
$rec_set = db::fetch_array($qry);


$sql_api = db::query("SELECT * FROM M_API_SETTING WHERE API_SETTING_ID = '$api_setting_id'");
$API = db::fetch_array($sql_api);

$filterResponse = "";
$sqlRequest = db::query("SELECT * FROM M_API_LIST WHERE API_SETTING_ID = '$api_setting_id' AND API_STATUS = '0'");
while ($KeyRequest = db::fetch_array($sqlRequest)) {
    if ($KeyRequest['API_FIELD']) {
        $alias = "";
        if ($KeyRequest['API_TABLE_ALIAS'] != "") {
            $alias = $KeyRequest['API_TABLE_ALIAS'] . ".";
        }
        $txt = " AND " . $alias . $KeyRequest['API_FIELD'] . " " . $KeyRequest['API_OPERATOR'] . " ''";
        $filterResponse .= $txt;
    }
}
$sqlResponse = $API['API_SQL'] . " " . $filterResponse;

?>
<div class="row" id="animationSandbox">
    <form method="POST" id="form_wf_save" name="form_wf_save">
        <div class="col-sm-12">

            <div class="main-header">

                <div class="media m-b-12">


                    <div class="media-body text-left">

                        <h4 class="form-control-label" style="padding:5px">รายละเอียดบริการของ ฐานข้อมูล</h4>

                        <br><br>

                        <div class="row">
                            <div class="col-md-2 offset-md-1">
                                <div class="form-control-label">ชื่อการตั้งค่า</div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="setting_name" id="setting_name" class="form-control" value="<?php echo ($api_name != '') ? '' : $rec_set['SERVICE_LIST']; ?>">
                                <?php if ($api_name == '') { ?>
                                    <input type="text" name="setting_id" id="setting_id" class="form-control" value="<?php echo $api_setting_id; ?>" hidden>
                                <?php } ?>
                            </div>
                        </div><br>
                        <?php if ($_GET['show'] == 'A') { ?>
                            <div class="row">
                                <div class="col-md-2 offset-md-1">
                                    <div class="form-control-label">EDIT SQL</div>
                                </div>
                                <div class="col-md-6 radio-inline">
                                    <textarea name="API_SQL" id="API_SQL" style="width: 100%; height: 500px;" class="form-control"><?php echo $API['API_SQL']; ?></textarea>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-2 offset-md-1">
                                    <div class="form-control-label"></div>
                                </div>
                                <div class="col-md-6 radio-inline f-right">
                                    <button type="button" class="btn btn-success" onclick="saveSql('<?php echo $api_setting_id; ?>')">บันทึก</button>
                                </div>
                            </div><br>
                        <?php } ?>
                        <?php /* 
                        <div class="row">
                            <div class="col-md-2 offset-md-1">
                                <div class="form-control-label">SQL</div>
                            </div>
                            <div class="col-md-4 radio-inline">
                                <?php echo $sqlResponse; ?>
                            </div>
                        </div><br>
                        */ ?>
                        <div class="row">
                            <div class="col-md-2 offset-md-1">
                                <div class="form-control-label">OPTION</div>
                            </div>
                            <div class="col-md-4 radio-inline">
                                <?php echo $api_setting_id; ?>
                            </div>
                        </div><br>

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

                                <?php if ($_GET['show'] == 'A' || $_GET['show'] == 'S') { ?>
                                    <h5 class="form-control-label">• พจนานุกรมข้อมูลที่ร้องขอ</h5>

                                    <?php if ($api_name == '' && $api_setting_id != '') { ?>
                                        <div class="f-right">
                                            <button type="button" onclick="open_add_list('1', '<?php echo $api_setting_id; ?>');" class="btn btn-primary btn-mini">
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
                                                <th class="text-center">API_TABLE_ALIAS</th>
                                                <th class="text-center">API_FIELD</th>
                                                <th class="text-center">API_OPERATOR</th>
                                                <th class="text-center">API_TABLE_MAIN</th>
                                                <th class="text-center">API_SAMPLE</th>
                                                <?php if ($api_name == '' && $api_setting_id != '') { ?>
                                                    <th style="width: 10%;" class="text-center"></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($api_setting_id)) {
                                                $sql = "SELECT
                                                              *
                                                        FROM
                                                            M_API_LIST
                                                        WHERE
                                                            1 = 1 AND API_SETTING_ID = $api_setting_id AND API_STATUS IN (0,2) ORDER BY ORDER_NO,API_LIST_ID ASC";
                                                $qry = db::query($sql);
                                                $i = 1;
                                                while ($rec = db::fetch_array($qry)) {
                                            ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $rec['KEY']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo $rec['TYPE']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php if ($rec['STATUS'] == "O" || $val['STATUS'] == "o") {
                                                                echo "O";
                                                            } else {
                                                                echo "M";
                                                            } ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <?php echo $rec['API_DESC']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $rec['API_TABLE_ALIAS']; ?>
                                                        </td>
                                                        <td>
                                                            S
                                                            <input type="checkbox" name="" id="">
                                                            <?php echo $rec['API_FIELD']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $rec['API_OPERATOR']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $rec['API_TABLE_MAIN']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $rec['API_SAMPLE']; ?>
                                                        </td>
                                                        <?php if ($api_name == '' && $api_setting_id != '') { ?>
                                                            <td style="text-align: center;">

                                                                <?php if ($rec['API_STATUS'] == 0) { ?>
                                                                    <button type="button" class="btn btn-warning btn-mini" onclick="update_HS('<?php echo $api_setting_id; ?>',2,'<?php echo $rec['API_LIST_ID']; ?>');">
                                                                        H
                                                                    </button>
                                                                <?php } else if ($rec['API_STATUS'] == 2) { ?>
                                                                    <button type="button" class="btn btn-info btn-mini" onclick="update_HS('<?php echo $api_setting_id; ?>',0,'<?php echo $rec['API_LIST_ID']; ?>');">
                                                                        S
                                                                    </button>
                                                                <?php } ?>

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
                                            ?>
                                        </tbody>

                                    </table>

                                <?php } ?>

                            </div>
                        </div>



                        <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                            <div class="showborder">

                                <?php if ($_GET['show'] == 'A' || $_GET['show'] == 'R') { ?>
                                    <h5 class="form-control-label">• พจนานุกรมข้อมูลที่ตอบกลับ</h5>
                                    <?php if ($api_name == '' && $api_setting_id != '') { ?>
                                        <div class="f-right">
                                            <button type="button" onclick="open_add_list('2', '<?php echo $api_setting_id; ?>');" class="btn btn-primary btn-mini">
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
                                                <th class="text-center">API_TABLE_MAIN</th>
                                                <th class="text-center">API_FIELD</th>
                                                <th class="text-center">API_SAMPLE</th>
                                                <th class="text-center">API_TABLE_ORG</th>
                                                <?php if ($api_name == '' && $api_setting_id != '') { ?>
                                                    <th style="width: 10%;" class="text-center"></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($api_setting_id)) {
                                                $sql = "SELECT
                                                              *
                                                        FROM
                                                            M_API_LIST
                                                        WHERE
                                                            1 = 1 AND API_SETTING_ID = $api_setting_id AND API_STATUS IN (1,3) ORDER BY ORDER_NO,API_LIST_ID ASC";
                                                $qry = db::query($sql);
                                                $i = 1;
                                                while ($rec = db::fetch_array($qry)) {
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $i; ?>
                                                            <input type="text" name="list_id_res[]" id="list_id_res" class="form-control" value="<?php echo $rec['API_LIST_ID']; ?>" hidden="true">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text" name="response_key[]" id="response_key<?php echo $i ?>" hidden="true" value="<?php echo $rec['KEY']; ?>" />
                                                            <?php echo $rec['KEY']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text" name="response_type[]" id="response_type<?php echo $i ?>" hidden="true" value="<?php echo $rec['TYPE']; ?>" />
                                                            <?php echo $rec['TYPE']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                            if ($rec['STATUS'] == "S") {
                                                                echo 'แสดง';
                                                            } else if ($rec['STATUS'] == "H") {
                                                                echo 'ซ่อน';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $rec['API_DESC']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $rec['API_TABLE_MAIN']; ?>
                                                        </td>
                                                        <td>
                                                            R
                                                            <input type="checkbox" name="" id="">
                                                            <?php echo $rec['API_FIELD']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $rec['API_SAMPLE']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $rec['API_TABLE_ORIGIN']; ?>
                                                        </td>
                                                        <?php if ($api_name == '' && $api_setting_id != '') { ?>
                                                            <td style="text-align: center;">
                                                                <?php if ($rec['API_STATUS'] == 1) { ?>
                                                                    <button type="button" class="btn btn-warning btn-mini" onclick="update_HS('<?php echo $api_setting_id; ?>',3,'<?php echo $rec['API_LIST_ID']; ?>');">
                                                                        H
                                                                    </button>
                                                                <?php } else if ($rec['API_STATUS'] == 3) { ?>
                                                                    <button type="button" class="btn btn-info btn-mini" onclick="update_HS('<?php echo $api_setting_id; ?>',1,'<?php echo $rec['API_LIST_ID']; ?>');">
                                                                        S
                                                                    </button>
                                                                <?php } ?>

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
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
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

    function del_api_list(settingId, apiListId) {
        if (confirm('ยืนยันการลบรายการ')) {
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

    function update_HS(settingId, status, id) {
        $.ajax({
            type: "POST",
            url: '../save/update_hs.php',
            dataType: 'json',
            data: {
                STATUS: status,
                ID: id,
            },
            success: function(data) {
                refresh_modal(settingId);
            }
        });
    }

    function saveSql(settingId) {
        var sql = $('#API_SQL').val();
        $.ajax({
            type: "POST",
            url: '../save/update_hsSql.php',
            dataType: 'json',
            data: {
                API_LIST_ID: settingId,
                SQL: sql
            },
            success: function(data) {
                refresh_modal(settingId);
            }
        });
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