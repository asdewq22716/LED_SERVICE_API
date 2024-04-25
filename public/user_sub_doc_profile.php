<?php
include 'include/comtop_user.php';
include 'comtop.php';
?>

<!--::header part start::-->
<?php include 'header.php';

$_SESSION['USER_MAIN'] != "Y" ? header('Location: user_doc_profile.php') : "";
$USR_ID = $_SESSION['USR_ID'];
$SYSTEM_TYPE = $_SESSION['SYSTEM_TYPE'];

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[URL]";

$linkSearch = "";
if ($_GET['search'] == "Y") {
    foreach ($_GET as $index => $val) {
        if ($index != "wf_page") {
            $linkSearch .= "&" . $index . "=" . $val;
            ${$index} = conText($val);
        }
    }
}
$wf_link = $actual_link . "?" . $linkSearch;
$wf_page = $_GET['wf_page'];
$wf_limit = $_GET['wf_limit'] == "" ? 30 : $_GET['wf_limit'];
if ($wf_page == '') {
    $wf_page = 1;
}
$wf_offset = ($wf_page - 1) * $wf_limit;

$conSearch = "";
if ($ID_CARD != "") {
    $conSearch .= " AND REPLACE(ID_CARD,'-','') = '" . str_replace("-", "", $ID_CARD) . "' ";
}
if ($GROUP_ID != "") {
    $conSearch .= " AND GROUP_ID = '" . $GROUP_ID . "' ";
}
if ($USR_FULLNAME != "") {
    $conSearch .= " AND REPLACE ( USR_PREFIX || '' || USR_FNAME || '' || USR_LNAME, ' ', '' ) like '%" . str_replace(" ", "", $USR_FULLNAME) . "%' ";
}

$sql = "SELECT
            USR_ID,
            ID_CARD,
            USR_PREFIX,
            USR_FNAME,
            USR_LNAME,
            ( SELECT SYS_NAME FROM M_SYSTEM WHERE M_SYSTEM.SYSTEM_ID = USER_API_SERVICE.SYSTEM_TYPE ) AS SYS_NAME,
            ( SELECT PRIVILEGE_GROUP_NAME FROM M_PRIVILEGE_GROUP WHERE M_PRIVILEGE_GROUP.PRIVILEGE_GROUP_ID = PERMISSION_GROUP_ID ) AS PRIVILEGE_GROUP_NAME,
            ( CASE WHEN USER_STATUS = 1 THEN 'ใช้งาน' ELSE 'ไม่ใช้งาน' END ) AS USER_STATUS 
        FROM
            USER_API_SERVICE    
        WHERE
            1 = 1 AND USR_ID != '" . $USR_ID . "' 
            -- AND USER_STATUS = '1' 
            AND SYSTEM_TYPE = '" . $SYSTEM_TYPE . "'" . $conSearch . ' ORDER BY USR_ID DESC';
$qry = db::query($sql);
$total = db::num_rows($qry);
$data_api = db::query_limit($sql, $wf_offset, $wf_limit);

?>
<style>
    th {
        color: white;
    }
</style>
<!-- Header part end-->

<!-- breadcrumb start -->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>API Documentation</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->


<section id="tabs">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php include 'left_menu.php'; ?>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <h4>จัดการผู้ใช้งาน</h4>
                    </div>
                </div>
                <form action="user_sub_doc_profile.php" method="GET" role="form" enctype="multipart/form-data">
                    <input type="hidden" name="wf_page" id="wf_page" value="<?php echo $wf_page; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group d-flex justify-content-start align-items-center">
                                    <label for="ID_CARD" class="col-md-4 text-right control-label">เลขประจำตัวประชาชน</label>
                                    <div class="col-md-8">
                                        <input type="text" name="ID_CARD" id="ID_CARD" class="form-control idcard" value="<?php echo $ID_CARD; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group d-flex justify-content-start align-items-center">
                                    <label for="USR_FULLNAME" class="col-md-4 text-right control-label">ชื่อ-นามสกุล</label>
                                    <div class="col-md-8">
                                        <input type="text" name="USR_FULLNAME" id="USR_FULLNAME" class="form-control idcard" value="<?php echo $USR_FULLNAME; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php /*
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group d-flex justify-content-start align-items-center">
                                <label for="GROUP_ID" class="col-md-4 text-right control-label">กลุ่มผู้ใช้</label>
                                <div class="col-md-8">
                                    <select class="form-control select2" name="GROUP_ID" id="GROUP_ID">
                                        <?php 
                                        $sqlGroupId = "SELECT GROUP_ID, GROUP_NAME FROM M_GROUP_USR_PUBLIC";
                                        $queryGroupId = db::query($sqlGroupId);
                                        ?>
                                        <option disabled selected>ทั้งหมด</option>
                                        <?php  while($resGroupId = db::fetch_array($queryGroupId)){ ?>
                                            <option value="<?php echo $resGroupId['GROUP_ID'];?>" <?php echo $GROUP_ID == $resGroupId['GROUP_ID'] ? "selected":""; ?> ><?php echo $resGroupId['GROUP_NAME'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    */ ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" name="search" id="search" value="Y" class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" name="addUser" id="addUser" value="Y" class="btn btn-info" onClick="addSubPerson();"><i class="icofont icofont-search-alt-2"></i> เพิ่มผู้ใช้งาน</button>
                    </div>
                </div>
                <!-- show sub user -->
                <div class="table-responsive">
                    <table class="table">
                        <thead class="breadcrumb_bg" align="center">
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th width="20%">เลขประจำตัวประชาชน</th>
                                <th width="30%">ชื่อ-นามสกุล</th>
                                <!-- <th width="20%">หน่วยงาน</th> -->
                                <!-- <th width="10%">กลุ่มสิทธิ์</th> -->
                                <th width="15%">สถานะผู้ใช้งาน</th>
                                <th width="5%">จัดการ</th>
                            </tr>
                        </thead>
                        </thead>
                        <tbody>
                            <?php
                            if ($total > 0) {
                                $i = 1;
                                while ($row = db::fetch_array($data_api)) {
                                    $edit = '<button type="button" class="btn btn-success btn-sm" title="แก้ไขข้อมูล" onclick="editSubPerson(\'' . $row['USR_ID'] . '\');">แก้ไข</button>';
                                    $delete = '<button type="button" class="btn btn-danger btn-sm" title="ลบข้อมูล" onclick="deleteSubPerson(\'' . $row['USR_ID'] . '\');">ลบ</button>';
                            ?>
                                    <tr>
                                        <td align="center"><?php echo $i + $wf_offset; ?></td>
                                        <td align="left"><?php echo $row['ID_CARD']; ?></td>
                                        <td align="left">
                                            <?php echo $row['USR_PREFIX'] . conTextD($row['USR_FNAME']) . " " . $row['USR_LNAME']; ?>
                                        </td>
                                        <?php /*<td align="left"><?php echo $row['SYS_NAME']; ?></td> */ ?>
                                        <?php /*<td align="left"><#?php echo $row['PRIVILEGE_GROUP_NAME']; ?></td> */ ?>
                                        <td align="left"><?php echo $row['USER_STATUS']; ?></td>
                                        <td align="left">
                                            <nobr><?php echo $edit . "&nbsp;" . $delete; ?></nobr>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="7">ไม่พบข้อมูล</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php echo ($total > 0) ? endPaging($total, $wf_limit, $wf_page) : ""; ?>
            </div>
        </div>
    </div>
</section>
<style type="text/css">
    .modal {
        position: fixed;
        top: 40px;
        bottom: 40px;
        left: 0;
        right: 0;
        z-index: 1050;
        max-width: 800px;
        height: auto;
        box-sizing: border-box;
        width: 90%;
        background: #fff;
        padding: 0px 10px;
        margin-left: auto;
        margin-right: auto;
    }

    .modal .modal-body {
        overflow-y: auto;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="modalEditSubPerson" tabindex="-1" role="dialog" aria-labelledby="modalEditSubPersonTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSubPersonTitle">แก้ไขข้อมูลผู้ใช้งาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="form_user_sub" action="" method="POST" role="form" enctype="multipart/form-data" onsubmit="return submitProc();">
                <input type="hidden" name="process" id="process" class="form-control" value="">
                <input type="hidden" name="USR_ID" id="USR_ID" class="form-control" value="">
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../assets/plugins/form-mask/js/inputmask.js"></script>
<script src="../assets/plugins/form-mask/js/jquery.inputmask.js"></script>
<script type="text/javascript">
    function editSubPerson(usrId) {
        $.ajax({
            type: "POST",
            url: 'ajax_user_sub_profile_proc.php',
            data: {
                process: "getDataUserSub",
                USR_ID: usrId
            },
            success: function(response) {
                $('#modalEditSubPerson .modal-body').html(response);

                $('#modalEditSubPerson #process').val('update');
                $('#modalEditSubPerson #USR_ID').val(usrId);
                $('#modalEditSubPersonTitle').text("แก้ไขข้อมูลผู้ใช้งาน");
                $('#modalEditSubPerson .btn.btn-primary').text("บันทึก");
                $('#modalEditSubPerson').css('height', 'auto');
                $('#modalEditSubPerson').modal('show');

                $(".idcard").inputmask({
                    mask: "9-9999-99999-99-9"
                });
                $('.autonumber').autoNumeric('init');
                $(".idcard").blur(function() {
                    var id_len = $(this).val().length;
                    if (id_len > 0) {
                        var data = $(this).val().split('-');
                        if (chkIDcard(data[0], data[1], data[2], data[3], data[4])) {
                            $(this).addClass("bsf-success");
                            $(this).removeClass("bsf-warning");
                        } else {
                            $(this).addClass("bsf-warning");
                            $(this).removeClass("bsf-success");
                            alert("กรุณากรอกข้อมูลให้ถูกต้อง");
                            $(this).val('');
                            $(this).focus();
                        }
                    } else {
                        $(this).removeClass("bsf-warning");
                        $(this).removeClass("bsf-success");
                    }
                });

            }
        });
    }

    function addSubPerson() {
        $.ajax({
            type: "POST",
            url: 'ajax_user_sub_profile_proc.php',
            data: {
                process: "addUserSub"
            },
            success: function(response) {
                $('#modalEditSubPerson .modal-body').html(response);

                $('#modalEditSubPerson #process').val('insert');
                $('#modalEditSubPersonTitle').text("แก้ไขข้อมูลผู้ใช้งาน");
                $('#modalEditSubPerson .btn.btn-primary').text("บันทึก");
                $('#modalEditSubPerson').css('height', 'auto');
                $('#modalEditSubPerson').modal('show');

                $(".idcard").inputmask({
                    mask: "9-9999-99999-99-9"
                });
                $('.autonumber').autoNumeric('init');
                $(".idcard").blur(function() {
                    var id_len = $(this).val().length;
                    if (id_len > 0) {
                        var data = $(this).val().split('-');
                        if (chkIDcard(data[0], data[1], data[2], data[3], data[4])) {
                            $(this).addClass("bsf-success");
                            $(this).removeClass("bsf-warning");
                        } else {
                            $(this).addClass("bsf-warning");
                            $(this).removeClass("bsf-success");
                            alert("กรุณากรอกข้อมูลให้ถูกต้อง");
                            $(this).val('');
                            $(this).focus();
                        }
                    } else {
                        $(this).removeClass("bsf-warning");
                        $(this).removeClass("bsf-success");
                    }
                });
            }
        });
    }

    function deleteSubPerson(usrId) {
        let content = '<div class="text-center"><i class="fa fa-exclamation-triangle fa-6x" aria-hidden="true" style="color: #ffc107;"></i><p class="lead text-muted ">คุณต้องการลบรายการนี้หรือไม่?</p></div>';
        $('#modalEditSubPerson #process').val('del');
        $('#modalEditSubPerson #USR_ID').val(usrId);
        $('#modalEditSubPersonTitle').text("แจ้งเตือน");
        $('#modalEditSubPerson .modal-body').html(content);
        $('#modalEditSubPerson .btn.btn-primary').text("ยืนยันการลบ");
        $('#modalEditSubPerson').css('height', 'min-content');
        $('#modalEditSubPerson').modal('show');
    }

    function submitProc() {
        let dataForm = $('#modalEditSubPerson #form_user_sub').serialize();
        $.ajax({
            type: "POST",
            url: 'ajax_user_sub_profile_proc.php',
            data: dataForm,
            success: function(response) {
                $('#modalEditSubPerson').css('height', 'min-content');
                $('#modalEditSubPerson .modal-footer').css('display', 'none');
                $('#modalEditSubPerson .modal-body').html('<div class="text-center"><i class="fa fa-check-square fa-6x" style="color: #28a745"></i><p class="lead text-muted ">ดำเนินการเสร็จสิ้น</p></div>');
                setTimeout(() => {
                    $('#modalEditSubPerson').modal('hide');
                    location.reload();
                }, 1000);
            }
        });
        return false;
    }
</script>
<!-- footer part start-->
<?php include 'footer-1.php'; ?>