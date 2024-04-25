<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 'On'); */

include '../include/comtop_user_N.php'; //connect db

include '../include/combottom_js_user.php'; //function 

include "../include/func_Nop.php";
include "../include/paging2.php";

include "./btn_function.php";

$path = "../";

foreach ($_GET as $key => $val) {
    $$key = conText($val);
}
foreach ($_POST as $key => $val) {
    $$key = conText($val);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/template_user.php'; ?>
</head>


<div class="content m-t-20">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <div class="col-sm-12" id="content">
            <form method="GET" action="./editStatus1.php" enctype="multipart/form-data" id="frm-input" name='frm-input'>
                <div class="card">
                    <div class="card-header">
                        <h5>เเก้ไขสถานะทรัพย์เเละคน</h5>
                    </div>
                    <div class="card-block">
                        <?php
                        if ($_GET['proc'] == 'lock') {
                        ?>
                            <div>
                                <div class="card-header">
                                    <h5>ล็อคทรัพย์</h5>
                                     <p><?php echo $_GET['PROP_TITLE'] ?></p>
                                </div>
                            </div>
                        <?php
                        } elseif ($_GET['proc'] == 'uplock') {
                        ?>
                            <div>
                                <div class="card-header">
                                    <h5>ปลดล็อคทรัพย์</h5>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="row">
                            <select name="SYSTEM_ID" id="SYSTEM_ID" class="form-control" tabindex="-1" aria-hidden="true" required onChange="showCMD(this.value);">
                                <option value="" disabled selected>เลือกระบบงาน</option>
                                <?php
                                $sql = "SELECT
										*
									  FROM M_CMD_SYSTEM
									  WHERE 1=1 AND CMD_SYSTEM_ID NOT IN (6) 
									  ORDER BY SERVICE_SYS_NAME ASC
									  ";
                                $query = db::query($sql);
                                while ($rec = db::fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $rec['CMD_SYSTEM_ID']; ?>" <?php echo $GET_SYSTEM_ID == $rec['CMD_SYSTEM_ID'] ? 'SELECTED' : '' ?>><?php echo $rec['SERVICE_SYS_NAME']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row">
                            <select name="CMD_TYPE" id="CMD_TYPE" class="form-control select2" tabindex="-1" aria-hidden="true" required onChange="getCaseType(this.value);">
                            </select>
                        </div>
                        <div class="row">
                            <select name="CASE_TYPE" id="CASE_TYPE" class="form-control select2" tabindex="-2">
                            </select>
                        </div>
                        <div class="row">
                        </div>
                        <?php
                        if ($_GET['proc'] == 'lock') {
                        ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-2"></div>
                                <div class="col-xs-12 col-sm-10" align="right"> <button class="btn btn-primary" type="button" onclick="lock_asset()">ยืนยัน</button></div>
                            </div>
                        <?php
                        } elseif ($_GET['proc'] == 'uplock') {
                        ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-2"></div>
                                <div class="col-xs-12 col-sm-10" align="right"> <button class="btn btn-primary" type="button" onclick="uplock_asset()">ยืนยัน</button></div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
        </body>
        <script>
            function showCMD(system_type) {
                $.ajax({
                    url: './editStatusPhp.php',
                    type: "POST",
                    dataType: "html",
                    data: {
                        proc: "showCMD",
                        system_type: system_type
                    },
                    async: true,
                    success: function(data) {
                        let data_show = JSON.parse(data)
                        for (const key in data_show) {
                            /* console.log(key);
                            console.log(data_show[key]); */
                            $('#CMD_TYPE').append("<option value=\"" + key + "\">" + data_show[key] + "</option>");
                            $(".selectbox").trigger("liszt:updated");
                        }

                    },
                });
            }

            function getCaseType(CMD_TYPE) {
                let SYSTEM_ID = $('#SYSTEM_ID').val();
                $.ajax({
                    url: './editStatusPhp.php',
                    type: "POST",
                    dataType: "html",
                    data: {
                        proc: "getCaseType",
                        CMD_TYPE: CMD_TYPE,
                        SYSTEM_ID: SYSTEM_ID
                    },
                    async: true,
                    success: function(data) {
                        let data_show = JSON.parse(data)
                        for (const key in data_show) {
                            /* console.log(key);
                            console.log(data_show[key]); */
                            $('#CASE_TYPE').append("<option value=\"" + key + "\">" + data_show[key] + "</option>");
                            $(".selectbox").trigger("liszt:updated");
                        }

                    },
                });
            }

            function lock_asset() {
                let CFC_CAPTION_GEN = '<?php echo $_GET['CFC_CAPTION_GEN']; ?>'
                let DOSS_CONTROL_GEN = '<?php echo $_GET['DOSS_CONTROL_GEN']; ?>'
                let CASE_TYPE = $('#CASE_TYPE').val();
                $.ajax({
                    url: './editStatusPhp.php',
                    type: "POST",
                    dataType: "html",
                    data: {
                        proc: "lock_asset",
                        CFC_CAPTION_GEN: CFC_CAPTION_GEN,
                        DOSS_CONTROL_GEN: DOSS_CONTROL_GEN,
                        CASE_TYPE: CASE_TYPE
                    },
                    async: true,
                    success: function(data) {
                        let data_show = JSON.parse(data)
                        console.log(data_show);
                        alert('ดำเนินการเสร็จสิ้น')
                    },
                });
            }

            function uplock_asset() {
                let CFC_CAPTION_GEN = '<?php echo $_GET['CFC_CAPTION_GEN']; ?>'
                let DOSS_CONTROL_GEN = '<?php echo $_GET['DOSS_CONTROL_GEN']; ?>'
                let CASE_TYPE = $('#CASE_TYPE').val();
                console.log(CFC_CAPTION_GEN);
                console.log(DOSS_CONTROL_GEN);
                console.log(CASE_TYPE);
                $.ajax({
                    url: './editStatusPhp.php',
                    type: "POST",
                    dataType: "html",
                    data: {
                        proc: "uplock_asset",
                        CFC_CAPTION_GEN: CFC_CAPTION_GEN,
                        DOSS_CONTROL_GEN: DOSS_CONTROL_GEN,
                        CASE_TYPE: CASE_TYPE
                    },
                    async: true,
                    success: function(data) {
                        let data_show = JSON.parse(data)
                        console.log(data_show);
                        alert('ดำเนินการเสร็จสิ้น')
                    },
                });
                
            }
        </script>