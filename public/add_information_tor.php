<?php
session_start();
$path = "../";
include $path . 'include/comtop_user.php'; //connect db
include $path . 'include/combottom_js_user.php'; //function 
include($path . 'include/func_Nop');
?>


<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <form name="frm-input" id="frm-input" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="CMD_SYSTEM" id="CMD_SYSTEM" value="<?php echo $_GET['cmd_system']; ?>">
            <input type="hidden" name="proc" id="proc" value="<?php echo $_POST['proc']; ?>">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
                <div class="col-sm-12">
                    <div class="main-header">
                        <div class="media m-b-12">
                            <a class="media-left" href="">
                                <img src="../icon/icon11.png" class="media-object"></a>
                            <div class="media-body">
                                <h4 class="m-t-5">&nbsp;</h4>
                                <h4>เพิ่มข้อมูลตามTOR</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
            <!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="form-group row">
                                    <div class="col-md-12 wf-left ">
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2"></div>
                                            <div class="col-xs-12 col-sm-2"><label for="">หน้า functional</label></div>
                                            <div class="col-xs-12 col-sm-2">
                                                <input type="text" class="form-control" name='NAME_PAGE' id="NAME_PAGE" value='<?php echo $NAME_PAGE; ?>'>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2"></div>
                                            <div class="col-xs-12 col-sm-2"><label for="">รหัสหน้าจอ</label></div>
                                            <div class="col-xs-12 col-sm-2">
                                                <input type="text" class="form-control" name='CODE_PAGE' id="CODE_PAGE" value='<?php echo $CODE_PAGE; ?>'>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2"></div>
                                            <div class="col-xs-12 col-sm-2"><label for="">ลำดับหน้าจอ</label></div>
                                            <div class="col-xs-12 col-sm-2">
                                                <input type="text" class="form-control" oninput="input_Number(this)"  name='NUMBER_PAGE' id="NUMBER_PAGE" value='<?php echo $NUMBER_PAGE; ?>'>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2"></div>
                                            <div class="col-xs-12 col-sm-2"><label for="">รายละเอียดตามเอกสาร</label></div>
                                            <div class="col-xs-12 col-sm-4">
                                                <textarea name='DETIAL_PAGE' id="DETIAL_PAGE" value='<?php echo $DETIAL_PAGE; ?>' type="text" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2"></div>
                                            <div class="col-xs-12 col-sm-2"><label for="">รายละเอียดภายในcomment</label></div>
                                            <div class="col-xs-12 col-sm-4">
                                                <textarea name='COMMENT_IN_PAGE' id="COMMENT_IN_PAGE" value='<?php echo $COMMENT_IN_PAGE; ?>' type="text" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>


                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2"></div>
                                            <div class="col-xs-12 col-sm-2"><label for="">ไฟล์รูปประกอบภาพหน้าจอ</label></div>
                                            <div class="col-xs-12 col-sm-4">
                                                <input type="FILE" class="form-control" name='FILE_MAIN[]' id="FILE_MAIN[]">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2"></div>
                                            <div class="col-xs-12 col-sm-2"><label for="">ไฟล์เพิ่มเติม</label></div>
                                            <div class="col-xs-12 col-sm-4">
                                                <input type="FILE" class="form-control"  name='FILE_more[]' id="FILE_more[]">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-2"></div>
                                            <div class="col-xs-12 col-sm-2"><label for="">LINK</label></div>
                                            <div class="col-xs-12 col-sm-5">
                                                <input type="text" class="form-control" name='LINK' id="LINK" value='<?php echo $LINK; ?>'>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-xs-12 col-sm-8"></div>
                                            <div class="col-xs-12 col-sm-2"><button class="btn btn-primary" type="button" onClick="btn_save();">บันทึก</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
     function input_Number(input) {
        // ลบตัวอักษรที่ไม่ใช่ตัวเลขทั้งหมด
        input.value = input.value.replace(/[^0-9]/g, '');
    }
    function btn_save() {
        let NAME_PAGE = $("#NAME_PAGE").val();
        let CODE_PAGE = $("#CODE_PAGE").val();
        let NUMBER_PAGE = $("#NUMBER_PAGE").val();
        let DETIAL_PAGE = $("#DETIAL_PAGE").val();
        let COMMENT_IN_PAGE = $("#COMMENT_IN_PAGE").val();
        if (NAME_PAGE == '') {
            $("#NAME_PAGE").focus();
            alert('กรุณาใส่ หน้า functional')
            return false
        }
        if (CODE_PAGE == '') {
            $("#CODE_PAGE").focus();
            alert('กรุณาใส่ รหัสหน้าจอ')
            return false
        }
        var formData = $("#frm-input").serialize();
        /* $.ajax({
            url: './search_data_process_A.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
            }
        });
    */
        if (confirm('ต้องการบันทึกหรือไม่')) {
            $("#proc").val('add_information_tor');
            $('#frm-input').attr('target', '').attr('action', './search_data_process_A.php').submit();
        }
    }
</script>