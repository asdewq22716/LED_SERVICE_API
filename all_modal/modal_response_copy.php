<?php

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$api_name = $_GET['API_NAME'];
$api_setting_id = $_GET['SETTING_ID'];

$curl = curl_init();

curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => "http://103.208.27.224:81/led_service_api/api/?MOD=manual&manualApiName=" . $api_name,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    )
);

$response = curl_exec($curl);
echo $err = curl_error($curl);

curl_close($curl);


$json_data = json_decode($response, true);

$sql = "SELECT * FROM M_SERVICE_MANAGE WHERE 1 = 1 AND SERVICE_NAME = '" . $api_name . "'";
$qry = db::query($sql);
$rec = db::fetch_array($qry);

$sql = "SELECT * FROM M_API_SETTING WHERE 1 = 1 AND API_SETTING_ID = '" . $api_setting_id . "'";
$qry = db::query($sql);
$rec_set = db::fetch_array($qry);

?>
<div class="row" id="animationSandbox">
    <form method="POST" id="form_wf_save" name="form_wf_save">
        <div class="col-sm-12">

            <div class="main-header">

                <div class="media m-b-12">


                    <div class="media-body text-left">

                        <h4 class="form-control-label" style="padding:5px">คัดลอกรายละเอียดบริการของ ฐานข้อมูล</h4>

                        <br><br>
                        <?php
                        $service_id = (empty($rec_set)) ? $rec['SERVICE_MANAGE_ID'] :  $rec_set['SERVICE_ID'];
                        $service_code = (empty($rec_set)) ? $rec['SERVICE_CODE'] : $rec_set['SERVICE_CODE'];
                        ?>
                        <input name="api_setting_id" id="service_id" value="<?php echo $api_setting_id; ?>" hidden />
                        <input name="service_id" id="service_id" value="<?php echo $service_id; ?>" hidden />
                        <input name="service_code" id="service_code" value="<?php echo $service_code; ?>" hidden />

                        <div class="row">
                            <div class="col-md-2 offset-md-1">
                                <div class="form-control-label">ชื่อการตั้งค่า <span class="text-danger">*</span></div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="setting_name" id="setting_name" class="form-control" value="" required aria-required="true">
                                <small id="DUP_setting_name_ALERT" class="form-text text-danger" style="display:none"></small>
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
                                <input type="radio" name="setting_status" id="setting_status" value="1" <?php if ($rec_set['API_STATUS'] == 1) { ?> checked <?php } ?> />
                                <label class="form-control-label">ใช้งาน</label>
                                <input type="radio" name="setting_status" id="setting_status" value="0" <?php if ($rec_set['API_STATUS'] == 0) { ?> checked <?php } ?> />
                                <label class="form-control-label">ไม่ใช้งาน</label>
                            </div>
                        </div>
                        <br>

                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="btn_copy">บันทึก</button>
            </div>
        </div>

    </form>
</div>

<script>
    $('#form_wf_save').submit(function(e) {
        $('#btn_copy').prop('disabled', true);
        var fdata = new FormData($('#form_wf_save')[0]);
        $.ajax({
            type: "POST",
            dataType: "JSON",
            processData: false,
            contentType: false,
            url: '../save/copy_api_manual.php',
            data: fdata,
            success: function(data) {
                // $('#bizModalEdit').modal('hide');
                location.reload();
            }
        });

        return false;
    });
</script>