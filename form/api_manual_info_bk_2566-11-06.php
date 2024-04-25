<?php
include "../include/comtop_user.php";

$SERVICE_ID = $_GET['SERVICE_ID'];
$GROUP_ID = $_GET['PRIVILEGE_GROUP_ID'];
?>
<style>
.card-header {
    border-bottom: 0px;
}
</style>
<div class="content-wrapper">

    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <!-- Row Starts -->
        <div class="row" id="animationSandbox">

            <div class="col-sm-12">

                <div class="main-header">

                    <div class="media m-b-12">

                        <a class="media-left" href=""></a>

                        <div class="media-body">

                            <h4 class="m-t-5">&nbsp;</h4>
                            <h4>ระบบ API Manual</h4>

                        </div>

                    </div>

                    <div class="f-right">
                        <?php if (isset($GROUP_ID)) {?>
                        <a class="btn btn-danger waves-effect waves-light"
                            href="../form/mapping_api_form.php?W=59&PRIVILEGE_GROUP_ID=<?php echo $GROUP_ID; ?>"
                            role="button" title="">
                            <i class="icofont icofont-home"></i> กลับหน้าหลัก
                        </a>
                        <?php } else {?>
                        <a class="btn btn-danger waves-effect waves-light" href="../form/api_manual.php" role="button"
                            title="">
                            <i class="icofont icofont-home"></i> กลับหน้าหลัก
                        </a>
                        <?php }?>

                    </div>

                </div>

            </div>

        </div>
        <!-- Row end -->

        <!--Workflow row start-->
        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <?php
                    $sql = "SELECT
                                  *
                            FROM
                                M_SERVICE_MANAGE
                            WHERE
                                1 = 1 AND SERVICE_MANAGE_ID = '" . $SERVICE_ID . "'";
                    $qry = db::query($sql);
                    $i = 0;
                    while ($rec = db::fetch_array($qry)) {
                    ?>
                    <div id="wf_space" class="card-header">
                        <div class="form-group row">
                            <div id="S_COURT_CODE_BSF_AREA" class="col-md-2 offset-md-1">
                                <label class="form-control-label wf-left">ระบบงาน</label>
                            </div>
                            <div id="S_COURT_CODE_BSF_AREA" class="col-md-2">
                                <label
                                    class="form-control-label wf-left"><?php echo getSystem($rec['SYS_NAME']); ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div id="S_COURT_CODE_BSF_AREA" class="col-md-2 offset-md-1">
                                <label class="form-control-label wf-left">Service Code</label>
                            </div>
                            <div id="S_COURT_CODE_BSF_AREA" class="col-md-2">
                                <label class="form-control-label wf-left"><?php echo $rec['SERVICE_CODE']; ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div id="S_COURT_CODE_BSF_AREA" class="col-md-2 offset-md-1">
                                <label class="form-control-label wf-left">ชื่อ Service</label>
                            </div>
                            <div id="S_COURT_CODE_BSF_AREA" class="col-md-2">
                                <label class="form-control-label wf-left"><?php echo $rec['SERVICE_NAME']; ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div id="S_COURT_CODE_BSF_AREA" class="col-md-2 offset-md-1">
                                <label class="form-control-label wf-left">คำอธิบาย Service</label>
                            </div>
                            <div id="S_COURT_CODE_BSF_AREA" class="col-md-2">
                                <label class="form-control-label wf-left"><?php echo $rec['SERVICE_DESC']; ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="card-block">
                        <?php if (empty($GROUP_ID)) {?>
                        <div class="f-right">
                            <a href="#!" class="btn bg-primary active waves-effect waves-light" title=""
                                data-toggle="modal" data-target="#bizModalEdit"
                                onclick="open_modal('../all_modal/modal_response_edit.php?API_NAME=<?php echo $rec['SERVICE_NAME']; ?>', '','Edit')">
                                <i class="icofont icofont-ui-add">เพิ่มข้อมูล</i>
                            </a>
                        </div>
                        <?php
                            }
                        
                        ?>
                        <form method="POST" id="form_wf_save_setting" name="form_wf_save_setting">
                            <div class="table-responsive" data-pattern="priority-columns" id="export_data">

                                <div class="showborder">

                                    <table cellspacing="0" id="tech-companies-1"
                                        class="table table-bordered sorted_table">
                                        <thead class="bg-primary">
                                            <tr class="bg-primary">
                                                <?php if (isset($GROUP_ID)) {?>
                                                <th style="width: 5%;text-align:center;" class="td_remove"></th>
                                                <?php }?>
                                                <th style="width: 5%;" class="text-center">
                                                    <nobr>
                                                        <a href="master_main.php?&W=51&wf_order=SERVICE_MANAGE_ID&wf_order_type=ASC"
                                                            class="">ลำดับ <i class="zmdi zmdi-caret-up"></i></a>
                                                    </nobr>
                                                </th>
                                                <th style="width:;" class="text-center">Service Code</th>
                                                <th style="width:;" class="text-center">Service LIST</th>
                                                <th style="width:;" class="text-center">สถานะ</th>
                                                <th style="width: 10%;text-align:center;" class="td_remove"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT
                                                          a.*,
                                                          b.API_SETTING_ID C1
                                                      FROM
                                                          M_API_SETTING a
                                                          LEFT JOIN SERVICE_MAPPING_GROUP b  on a.API_SETTING_ID = b.API_SETTING_ID and b.PRIVILEGE_GROUP_ID = '" . $GROUP_ID . "'
                                                      WHERE
                                                          1 = 1
                                                          AND a.SERVICE_ID = '" . $SERVICE_ID . "' 
                                                      ORDER BY 
                                                          a.API_SETTING_ID ASC";
                                              $qry = db::query($sql);
                                              $i = 1;
                                              while ($rec = db::fetch_array($qry)) {
                                                  $API_SETTING_ID = $rec['API_SETTING_ID'];

                                                  $chk_eda = '';
                                                  if ($rec['C1'] == $rec['API_SETTING_ID']) {
                                                      $chk_eda = 'checked';
                                                  }
                                            ?>
                                            <tr id="tr">
                                                <?php if (isset($GROUP_ID)) {?>
                                                <td style="width: 5%;" class="text-center">
                                                    <input <?php echo $chk_eda; ?> type="checkbox" name="chk_set[]"
                                                        id="chk_set" value="<?php echo $rec["API_SETTING_ID"]; ?>">
                                                    <input type="hidden" name="group_id" id="group_id"
                                                        value="<?php echo $GROUP_ID; ?>">
                                                    <input type="hidden" name="service_id" id="service_id"
                                                        value="<?php echo $SERVICE_ID; ?>">
                                                </td>
                                                <?php }?>
                                                <td style="text-align:center;"><?php echo $i; ?></td>
                                                <td class=""><?php echo $rec["SERVICE_CODE"]; ?></td>
                                                <td class=""><?php echo $rec["SERVICE_LIST"]; ?></td>
                                                <td class="text-center">
                                                    <?php if ($rec["API_STATUS"] == 1) {echo "ใช้งาน";} else {echo "ไม่ใช้งาน";}?>
                                                </td>
                                                <td style="text-align:center;" class="td_remove">
                                                    <nobr>
                                                        <?php /*<a href="#!" class="btn btn-info btn-mini" title=""
                                                            data-toggle="modal" data-target="#bizModalSpec"
                                                            onclick="open_modal('../all_modal/modal_service_manage_detail.php?ID=<?php echo $SERVICE_ID; ?>&PRIVILEGE_GROUP_ID=<?php echo $GROUP_ID; ?>&SETTING_ID=<?php echo $rec['API_SETTING_ID']; ?>&STATUS=<?php echo $rec['API_STATUS']; ?>', '','Spec')">
                                                            <i class="icofont icofont-ui-add"></i> เลือกรายการ SPEC
                                                        </a>*/?>

                                                        <a href="#!" class="btn btn-info btn-mini" title=""
                                                            data-toggle="modal" data-target="#bizModalEdit"
                                                            onclick="open_modal('../all_modal/modal_response_view.php?SETTING_ID=<?php echo $rec['API_SETTING_ID']; ?>', '','Edit')">
                                                            <i class="icofont icofont-ui-search"></i> แสดงรายละเอียด
                                                        </a>

                                                        <?php if (isset($GROUP_ID)) {?>

                                                        <?php } else {?>

                                                        <a href="#!" class="btn btn-success btn-mini" title=""
                                                            data-toggle="modal" data-target="#bizModalEdit"
                                                            onclick="open_modal('../all_modal/modal_response_edit.php?SETTING_ID=<?php echo $rec['API_SETTING_ID']; ?>', '','Edit')">
                                                            <i class="icofont icofont-ui-edit"></i> แก้ไข
                                                        </a>

                                                        <a href="#!" class="btn btn-danger btn-mini"
                                                            onclick="del_setting(<?php echo $rec['API_SETTING_ID']; ?>)">
                                                            <i class="icofont icofont-trash"></i> ลบ
                                                        </a>

                                                    <?php }?>
                                                        
                                                    </nobr>
                                                </td>
                                            </tr>

                                            <?php
                                                $i++;
                                              }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <?php if (isset($GROUP_ID) && isset($API_SETTING_ID)) {?>
                            <button type="button" class="btn btn-success wf-right"
                                onclick="save_API(<?php echo $GROUP_ID; ?>)">บันทึก</button>
                            <?php }?>
                        </form>
                    </div>
                    <?php } ?>
                </div>

            </div>

        </div>
        <!-- Workflow Row end -->

    </div>
    <!-- Container-fluid ends -->

</div>
<style>
@media (min-width: 768px) {
    .modal-dialog-team {
        width: 900px;
        margin: 30px auto;
    }
}
</style>
<div class="modal fade modal-flex" id="bizModalEdit" role="dialog" aria-labelledby="myModalLabel"
    data-backdrop="static">
    <div class="modal-dialog-team modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close biz-close-modal" data-number="bizModalEdit" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-flex" id="bizModalSpec" role="dialog" aria-labelledby="myModalLabel"
    data-backdrop="static">
    <div class="modal-dialog-team modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close biz-close-modal" data-number="bizModalSpec" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<?php
include '../include/combottom_js_user.php';
include '../include/combottom_user.php';
?>

<script>
function del_setting(Id) {
    var del_id = Id;
    if (confirm('ต้องการลบข้อมูลหรือไม่?')) {
        $.ajax({
            type: "POST",
            // processData: false,
            // contentType: false,
            dataType: 'json',
            url: '../save/del_api_setting.php',
            data: {
                del_id: del_id
            },
            success: function(data) {

            }
        });
        location.reload();
    }
}

function save_API(group_id) {
    var Id = group_id;
    var fdata = new FormData($('#form_wf_save_setting')[0]);
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: '../save/update_api_manual.php',
        data: fdata,
        success: function(data) {
            window.location.href ='../form/mapping_api_form.php?W=59&PRIVILEGE_GROUP_ID='+Id;
        }
    });
}

/*$("input:checkbox").on('click', function() {
    var $box = $(this);
    if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
    } else {
        $box.prop("checked", false);
    }
});*/
</script>