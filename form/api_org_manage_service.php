<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
if ($W == 183) {
?>
    <form id="<?php echo $teb3Id; ?>_form" name="<?php echo $teb3Id; ?>_form" onsubmit="return save_api('<?php echo $orgId; ?>');">
    <?php } ?>
    <div class="container-fluid" style=" margin-top: 0;">
        <ul class="nav nav-tabs  tabs" role="tablist">
            <?php
            $sqlSystem = "SELECT * FROM M_CMD_SYSTEM WHERE 1=1 AND CMD_SYSTEM_ID NOT IN (5,6)";
            $qrySystem = db::query($sqlSystem);
            $iSystem = 0;
            while ($recSystem = db::fetch_assoc($qrySystem)) {
                $active = '';
                if ($iSystem == 0) {
                    $active = 'active';
                }
            ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo  $active; ?>" data-toggle="tab" href="#SERVICE_TAB_<?php echo $recSystem['CMD_SYSTEM_ID']; ?>" role="tab" aria-expanded="false"><?php echo $recSystem['SERVICE_SYS_NAME']; ?></a>
                </li>


            <?php
                $iSystem++;
            }
            ?>
        </ul>



        <div class="tab-content tabs">
            <?php
            $sqlSystem = "SELECT * FROM M_CMD_SYSTEM WHERE 1=1 AND CMD_SYSTEM_ID NOT IN (5,6)";
            $qrySystem = db::query($sqlSystem);
            $iSystem = 0;
            while ($recSystem = db::fetch_assoc($qrySystem)) {
                $active = '';
                if ($iSystem == 0) {
                    $active = 'active';
                }
            ?>
                <div class="tab-pane <?php echo  $active; ?>" id="SERVICE_TAB_<?php echo $recSystem['CMD_SYSTEM_ID']; ?>" role="tabpanel" aria-expanded="true">
                    <div class="form-group row"></div><br>
                    <?php
                    $sqlMainService =
                        "SELECT 
                           SERVICE_MANAGE_ID,SERVICE_CODE,SERVICE_NAME,SYS_NAME,SERVICE_STATUS,SERVICE_DESC,SYS_DETAIL 
                       FROM 
                           M_SERVICE_MANAGE 
                       WHERE 
                           1=1
                           AND SERVICE_MANAGE_ID NOT IN (106)
                           AND SYS_NAME = '{$recSystem['CMD_SYSTEM_ID']}'
                           AND SERVICE_STATUS = '1'
                       ORDER BY SYS_NAME,SERVICE_CODE ASC
                       -- CASE 
                       --     WHEN SYS_NAME = 4 THEN 1 
                       --     WHEN SYS_NAME = 3 THEN 2 
                       --     WHEN SYS_NAME = 1 THEN 3 
                       --     ELSE 4  
                       -- END
                   ";
                    $qryMainService = db::query($sqlMainService);
                    $iMainService = 1;
                    while ($recMainService = db::fetch_assoc($qryMainService)) {
                        $SERVICE_ID = $recMainService['SERVICE_MANAGE_ID'];

                        $sqlSubOption = " FROM M_API_SETTING a LEFT JOIN $tbServiceMappingApi b  on a.API_SETTING_ID = b.API_SETTING_ID and b.PRIVILEGE_GROUP_ID = '$orgId'  WHERE 1 = 1  AND a.API_STATUS = '1'  AND a.SERVICE_ID = '$SERVICE_ID' ORDER BY a.SERVICE_CODE,a.SERVICE_LIST ASC ";

                        // (a.API_STATUS = '1' OR a.API_STATUS = '0')

                        $sqlSubService = "SELECT a.*, b.API_SETTING_ID C1 $sqlSubOption";

                        $sqlSubServiceC = "SELECT COUNT(*) AS NUM  $sqlSubOption ";

                        $qrySubServiceC = db::query($sqlSubServiceC);
                        $recSubServiceC = db::fetch_assoc($qrySubServiceC);
                        if ($recSubServiceC['NUM'] > 0) {
                    ?>

                            <div class="row col-md-12 col-sm-12 align-items-center">
                                <!-- <label for="SERVICE_MANAGE_ID_2" class="ml-2 mb-0"><#?php echo $recMainService['SERVICE_NAME'] . ' ' . $recMainService['SERVICE_DESC']; ?></label> -->

                                <div class="form-group row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-9">
                                        <span class="custom-control-description"><?php echo $iMainService . '. ' . $recMainService['SERVICE_CODE'] . ' ' .  $recMainService['SERVICE_DESC'] . ' (' . $recMainService['SERVICE_NAME'] . ')'; ?></span>
                                    </div>
                                </div>

                                <?php


                                $qrySubService = db::query($sqlSubService);
                                $i = 1;

                                while ($recSubService = db::fetch_assoc($qrySubService)) {
                                    $API_SETTING_ID = $recSubService['API_SETTING_ID'];

                                    $chk_eda = '';
                                    if ($recSubService['C1'] == $recSubService['API_SETTING_ID']) {
                                        $chk_eda = 'checked';
                                    }
                                ?>


                                    <div class="form-group row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-9">
                                            &nbsp;&nbsp;
                                            &nbsp;&nbsp;
                                            <label for="API_SETTING_ID<?php echo $recSystem['CMD_SYSTEM_ID']; ?>_<?php echo $recSubService["API_SETTING_ID"]; ?>" class="custom-control custom-checkbox">
                                                <input type="checkbox" name="chk_set[]" id="API_SETTING_ID<?php echo $recSystem['CMD_SYSTEM_ID']; ?>_<?php echo $recSubService["API_SETTING_ID"]; ?>" class="custom-control-input" value="<?php echo $recSubService["API_SETTING_ID"]; ?>" <?php echo $chk_eda; ?>>
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description"> <?php echo $recSubService["SERVICE_LIST"] . "&nbsp;&nbsp;&nbsp;&nbsp;" . $recSubService["API_DESC"] ?> <?php /* echo ($recSubService["API_STATUS"] == 1) ? '<span style="color:green;">[ ใช้งาน ]</span>' : '<span style="color:red;">[ ไม่ใช้งาน ]</span>'; */ ?> </span>
                                            </label>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                            $iMainService++;
                        }
                        ?>

                        <!-- <div class="row col-md-12 col-sm-12 align-items-center" style="padding-left:35px">
                                <input name="API_SETTING_ID[<#?php echo $recSystem['CMD_SYSTEM_ID']; ?>][3]" id="API_SETTING_ID2_3" chk-id="API_SETTING_ID2_3" chk-value="3" type="checkbox" value="3" checked="">
                                <label for="API_SETTING_ID2_3" class="ml-2 mb-0">WS-CIVIL-01-002.1</label>
                            </div> -->


                    <?php
                    }
                    ?>
                </div>

            <?php
                $iSystem++;
            }
            ?>
        </div>
    </div>

    <?php if ($W == 183) { ?>
        <button type="submit" class="btn btn-success wf-right" id="<?php echo $teb3Id; ?>_btn">บันทึก</button>
    </form>
<?php } ?>



<script>
    function save_api(orgId) {
        var dataForm = $('#apiOrg_form').serialize();
        dataForm += '&ORG_ID=' + orgId + '&FORM_ID=apiOrg';

        if (confirm('ยืนยันการบันทึกข้อมูล')) {
            $('#<?php echo $teb3Id; ?>_btn').prop('disabled', true);
            $.ajax({
                url: '../save/save_manage_service.php',
                type: 'POST',
                data: dataForm,
                success: function(rec) {
                    $('#<?php echo $teb3Id; ?>_btn').prop('disabled', false);
                    alert('บันทึกสำเร็จ');
                },
                error: function() {
                    alert('error!');
                }
            });
        }

        return false;
    }
</script>