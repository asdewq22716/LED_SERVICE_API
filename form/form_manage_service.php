<?php
include "../include/comtop_user.php";

$W = $_GET['W'];
$sql_main = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_ID = '" . $W . "'");
$rec_main = db::fetch_array($sql_main);

$orgId = conText($_GET['ORG_ID']);

if ($orgId != '') {
    $sqlMain = "SELECT * FROM M_SYSTEM WHERE SYSTEM_ID = '$orgId' ";
    $qryMain = db::query($sqlMain);
    $recOrg = db::fetch_array($qryMain);
}

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
                        <a class="media-left" href="<?php echo $link_back_home; ?>">
                            <?php if ($rec_main['WF_MAIN_ICON'] != "") {
                                echo "<img src=\"../icon/" . $rec_main['WF_MAIN_ICON'] . "\" class=\"media-object\">";
                            } ?>
                        </a>
                        <div class="media-body">
                            <h4 class="m-t-5">&nbsp;</h4>
                            <h4> <?php echo  $report_name = $rec_main['WF_MAIN_NAME']; ?> </h4>
                        </div>
                    </div>

                    <div class="f-right">
                        <a class="btn btn-danger waves-effect waves-light" href="../form/disp_manage_service.php?&W=183" role="button" title="">
                            <i class="icofont icofont-home"></i> กลับหน้าหลัก
                        </a>

                    </div>

                </div>

            </div>

        </div>
        <!-- Row end -->

        <!--Workflow row start-->
        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <?php if ($orgId != '') { ?>
                        <div id="wf_space" class="card-header">
                            <div class="form-group row">
                                <div id="S_COURT_CODE_BSF_AREA" class="col-md-2 offset-md-3">
                                    <!-- offset-md-1 -->
                                    <label class="form-control-label wf-right">
                                        <h5>ชื่อหน่วยงาน :</h5>
                                    </label>
                                </div>
                                <div id="S_COURT_CODE_BSF_AREA" class="col-md-4">
                                    <label class="form-control-label wf-left">
                                        <h5><?php echo $recOrg['SYS_NAME']; ?></h5>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div id="" class="card-block">

                        <?php include "form_manage_service_tab.php"; ?>

                        <div class="tab-content tabs">

                            <div class="tab-pane active" id="<?php echo $teb1Id; ?>_tab" role="tabpanel" aria-expanded="false">
                                <div class="form-group row"></div>
                                <form action="" id="<?php echo $teb1Id; ?>_form" name="<?php echo $teb1Id; ?>_form" onsubmit="return save_org('<?php echo $orgId; ?>');">
                                    <div class="form-group row" id="<?php echo $teb1Id; ?>_content">
                                        <?php
                                        bsf_show_form('52', "",  $recOrg, "M", '', '', '');
                                        ?>
                                    </div>
                                    <button type="submit" class="btn btn-success wf-right" id="<?php echo $teb1Id; ?>_btn">บันทึก</button>
                                </form>
                            </div>

                            <div class="tab-pane" id="<?php echo $teb2Id; ?>_tab" role="tabpanel" aria-expanded="true">
                                <div class="form-group row"></div><br>
                                <?php /* <button type="button" onclick="reload_content('<?php echo $teb2Id; ?>');"></button> */ ?>
                                <div class="form-group row" id="<?php echo $teb2Id; ?>_content">
                                    <br>
                                    <?php
                                    // bsf_show_form('97', "",  $WF, "M", '', '', '');

                                    include 'admin_org_manage_service.php';
                                    ?>
                                </div>
                            </div>

                            <div class="tab-pane" id="<?php echo $teb3Id; ?>_tab" role="tabpanel" aria-expanded="true">
                                <div class="form-group row"></div><br>
                                <div class="form-group row" id="<?php echo $teb3Id; ?>_content">
                                    <div class="f-right">
                                        <div class="col-md-12 col-sm-12">
                                            <button type="button" onclick="del_template_api('<?php echo $orgId; ?>');" class="btn btn-danger btn-mini">
                                                <i class="icofont icofont-trash"></i> Reset Service ที่เลือก
                                            </button>
                                            <button type="button" onclick="open_template_api('<?php echo $orgId; ?>');" class="btn btn-primary btn-mini" data-toggle="modal" data-target="#bizModalEdit">
                                                <i class="fa fa-plus"></i> ใช้งานรูปแบบ Service
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                    <?php
                                    // bsf_show_form('59', "",  $WF, "M", '', '', '');
                                    $tbServiceMappingApi = 'SERVICE_MAPPING_GROUP';
                                    include 'api_org_manage_service.php';
                                    ?>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

        </div>
        <!-- Workflow Row end -->
    </div>
    <!-- Container-fluid ends -->

</div>

<div class="modal fade modal-flex" id="bizModalEdit" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
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


<style>
    @media (min-width: 768px) {
        .modal-dialog-team {
            width: 900px;
            margin: 30px auto;
        }
    }
</style>

<script>
    $(document).ready(function() {
        // 
        if ('<?php echo $_GET['TAB_MENU']; ?>' != '') {
            active_tab('<?php echo $_GET['TAB_MENU']; ?>');
        }
    });


    function active_tab(id) {
        $('a[href="#' + id + '_tab"]').tab('show');
    }

    function reload_content(id, orgId, w = '') {
        $('#' + id + '_content').html('');

        if (w != '') {
            $.ajax({
                url: '../form/manage_service_content.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    W: w,
                    ORG_ID: orgId
                },
                success: function(rec) {
                    $('#' + id + '_content').html(rec);
                },
                error: function() {
                    alert('error!');
                }
            });
        }
    }

    function save_org(orgId) {

        var dataForm = $('#<?php echo $teb1Id; ?>_form').serialize();
        var chk = '';


        chk = $('#<?php echo $teb1Id; ?>_form').submit(function(e) {
            e.preventDefault();
        });

        if (chk != '') {
            dataForm += '&FORM_ID=<?php echo $teb1Id; ?>';
            if (orgId == '') {
                if (confirm('ยืนยันการบันทึกข้อมูล')) {
                    $('#<?php echo $teb1Id; ?>_btn').prop('disabled', true);
                    $.ajax({
                        url: '../save/save_manage_service.php',
                        type: 'POST',
                        data: dataForm,
                        success: function(rec) {
                            const result = JSON.parse(rec);
                            window.location = '../form/form_manage_service.php?W=183&ORG_ID=' + result.orgId;
                        },
                        error: function() {
                            alert('error!');
                        }
                    });
                }
            } else {
                dataForm += '&ORG_ID=' + orgId;
                if (confirm('ยืนยันการบันทึกข้อมูล')) {
                    $('#<?php echo $teb1Id; ?>_btn').prop('disabled', true);
                    $.ajax({
                        url: '../save/save_manage_service.php',
                        type: 'POST',
                        data: dataForm,
                        success: function(rec) {
                            location.reload();
                        },
                        error: function() {
                            alert('error!');
                        }
                    });

                }
            }
            return false;
        }
    }

    function open_add_user() {
        $('#bizModalEdit .modal-body').html('');
        open_modal('../all_modal/modal_add_user_service.php?W=97&ORG_ID=<?php echo $orgId; ?>', '', 'Edit')
    }

    function open_edit_user(userId) {
        $('#bizModalEdit .modal-body').html('');
        open_modal('../all_modal/modal_add_user_service.php?W=97&ORG_ID=<?php echo $orgId; ?>&USER_ID=' + userId, '', 'Edit');
    }

    function open_template_api(orgId) {
        $('#bizModalEdit .modal-body').html('');
        open_modal('../all_modal/modal_select_template_api.php?W=185&ORG_ID=<?php echo $orgId; ?>', '', 'Edit');
    }


    function gen_token(id) {
        $.ajax({
            type: "POST",
            url: '../form/gen_token.php',
            data: {
                wfr: id
            }, // serializes the form's elements.
            success: function(data) {
                swal({
                    title: "Gen Token สำเร็จ",
                    type: "success",
                    allowOutsideClick: true
                });
            }
        });
    }

    function del_template_api(orgId) {
        if (confirm('ยืนยันการ RESET รายการ service ทั้งหมดที่เลือก')) {
            $.ajax({
                url: '../save/save_manage_service.php',
                type: 'POST',
                data: {
                    ORG_ID: orgId,
                    FORM_ID: 'delTempApi'
                },
                success: function(rec) {
                    location.reload();
                },
                error: function() {
                    alert('error!');
                }
            });
        }
    }
</script>

<?php
include '../include/combottom_js_user.php';
include '../include/combottom_user.php';
?>