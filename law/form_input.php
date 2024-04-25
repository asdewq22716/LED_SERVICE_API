<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

$HIDE_HEADER = "P";
include '../include/comtop_user.php';

// Variable
$arr_prefix = array();
$pccCivilGen    = ($_GET['pccCivilGen'])    ? conText($_GET['pccCivilGen']) : '';
$concernType    = ($_GET['concernType'])    ? conText($_GET['concernType']) : '';
$concernNo      = ($_GET['concernNo'])      ? conText($_GET['concernNo'])   : '';
$concernCode    = ($_GET['concernCode'])    ? conText($_GET['concernCode']) : '';
$executionStatus= ($_GET['executionStatus']) ? conText($_GET['executionStatus']) : '';
$personType= ($_GET['personType']) ? conText($_GET['personType']) : '';

$sql_prefix = db::query("SELECT * FROM M_PREFIX_MAP WHERE P_ID_LAW IS NOT NULL");
while ($rec = db::fetch_array($sql_prefix)) {
    $arr_prefix[] = $rec;
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div id="wf_space" class="card-block">
                    <div class="form-group row"></div>
                    <?php print_pre($_GET);print_pre($_GET); ?>
                    <!--==============================================================================================-->
                    <form action="../save/save_form_input_name.php" method="post" id="form_input_name">

                        <input type="hidden" name="pccCivilGen" id="pccCivilGen" value="<?php echo $pccCivilGen; ?>">
                        <input type="hidden" name="concernType" id="concernType" value="<?php echo $concernType; ?>">
                        <input type="hidden" name="concernNo" id="concernNo" value="<?php echo $concernNo; ?>">
                        <input type="hidden" name="concernCode" id="concernCode" value="<?php echo $concernCode; ?>">
                        <input type="hidden" name="executionStatus" id="executionStatus" value="<?php echo $executionStatus; ?>">
                        <input type="hidden" name="personType" id="personType" value="<?php echo $personType; ?>">

                        <div class="card">
                            <div class="card-header text-right">
                                บันทึกข้อมูล
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-2 text-right">คำนำหน้าชื่อ</div>
                                    <div class="col-md-6">
                                        <select class="select2" name="prefix[]" id="prefix" multiple="multiple" style="width: 100%;" required>
                                            <?php foreach ($arr_prefix as $k_pf => $v_pf) { ?>
                                                <option value="<?php echo $v_pf['P_ID_LAW']; ?>"><?php echo $v_pf['P_NAME_BOF']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2 text-right">ชื่อ</div>
                                    <div class="col-md-6">
                                        <select class="select2" name="fname[]" id="fname" multiple="multiple" style="width: 100%;" required></select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2 text-right">นามสกุล</div>
                                    <div class="col-md-6">

                                        <select class="select2" name="lname[]" id="lname" multiple="multiple" style="width: 100%;" required></select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2 text-right">ชื่ออื่น (และ/หรือ)</div>
                                    <div class="col-md-6">
                                        <input type="text" name="remark" id="remark" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                            </div>
                        </div>

                    </form>
                    <!--==============================================================================================-->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../include/combottom_js_user.php';
include '../include/combottom_user.php';
?>

<script>
    $(document).ready(function() {
        $("#prefix").select2({
            tags: true, // Allow adding tags
            tokenSeparators: [',', ' '], // Define the separators
        });
        $("#fname").select2({
            tags: true
        });
        $("#lname").select2({
            tags: true
        });
/*
        $('#form_input_name').submit(function() {
            let prefix = $("#prefix").val().length;
            let fname = $("#fname").val().length;
            let lname = $("#lname").val().length;
            if (prefix == fname && prefix == lname) {
                return true;
            } else {
                alert('กรุณากรอกข้อมูลให้เท่ากัน');
                return false;
            }
        });
        */
    });
</script>