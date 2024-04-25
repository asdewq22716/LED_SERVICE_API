<?php
/* session_start(); */
$path = "../";
include $path . 'include/comtop_user.php'; //connect db
include $path . 'include/combottom_js_user.php'; //function 
include($path . 'include/func_Nop');
?>


<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <form name="frm-input" id="frm-input" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="proc" id="proc" value="<?php echo $_GET['proc']; ?>">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
                <div class="col-sm-12">
                    <div class="main-header">
                        <div class="media m-b-12">
                            <a class="media-left" href="">
                                <img src="../icon/icon11.png" class="media-object"></a>
                            <div class="media-body">
                                <h4 class="m-t-5">&nbsp;</h4>
                                <h4>ข้อมูลตามTOR</h4>
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
                                        <div class="row">
                                            <?php
                                            $sql_info = "
                                            SELECT *FROM M_INFO_TOR a
                                            JOIN M_CMD_SYSTEM b ON a.CMD_ID =b.CMD_SYSTEM_ID 
                                            WHERE a.INFO_ID ='" . $_GET['WFR'] . "'
                                            ";
                                            $qry_info = db::query($sql_info);
                                            $rec_info = db::fetch_array($qry_info);

                                            /*   print_pre($rec_info); */
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-1"> </div>
                                                <div class="col-xs-12 col-sm-2" align='right'>
                                                    <label for="">ระบบงาน :</label>
                                                </div>
                                                <div class="col-xs-12 col-sm-2">
                                                    <label for=""><?php echo $rec_info['SERVICE_SYS_NAME']; ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-1"> </div>
                                                <div class="col-xs-12 col-sm-2" align='right'>
                                                    <label for="">ชื่อหน้า :</label>
                                                </div>
                                                <div class="col-xs-12 col-sm-2">
                                                    <label for=""><?php echo $rec_info['NAME_PAGE']; ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-1"> </div>
                                                <div class="col-xs-12 col-sm-2" align='right'>
                                                    <label for="">รูป :</label>
                                                </div>
                                                <div class="col-xs-12 col-sm-7">
                                                    <?php $sql_IMG = "SELECT *FROM M_INFO_TOR a
                                                            LEFT JOIN FRM_FILE_MAIN b ON a.INFO_ID =b.WFR_ID AND b.WF_MAIN_ID ='133'
                                                            LEFT JOIN WF_FILE c ON b.F_ID =c.WFR_ID AND c.WF_MAIN_ID ='134' AND c.FILE_STATUS ='Y'
                                                            WHERE a.INFO_ID ='" . $_GET['WFR'] . "'";
                                                    $qry_IMG = db::query($sql_IMG);
                                                    while ($rec_IMG = db::fetch_array($qry_IMG)) {
                                                    ?>
                                                        <img src="<?php echo '../attach/w134/' . $rec_IMG['FILE_SAVE_NAME']; ?>" width="100%" alt="Image"><br><br>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-1"> </div>
                                                <div class="col-xs-12 col-sm-2" align='right'>
                                                    <label for="">coding :</label>
                                                </div>
                                                <div class="col-xs-12 col-sm-7">
                                                    <!-- ส่วนของการแอดโค๊ตจาก DB  start-->
                                                    <!-- <?php echo wf_convert_var($rec_info['CODING']);
                                                            $sql_IMG = "SELECT *FROM WF_FILE 
                                         WHERE WFR_ID ='" . $_GET['WFR'] . "' AND WFS_FIELD_NAME='CODE_PHP' AND WF_MAIN_ID ='133' AND FILE_STATUS ='Y'";
                                                            $qry_IMG = db::query($sql_IMG);
                                                            $rec_IMG = db::fetch_array($qry_IMG);
                                                            if ($rec_IMG['FILE_SAVE_NAME'] != '') {
                                                                include "../attach/w133/" . $rec_IMG['FILE_SAVE_NAME'];
                                                            }

                                                            ?> -->
                                                    <!-- ส่วนของการแอดโค๊ตจาก DB  stop-->
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-1"> </div>
                                                <div class="col-xs-12 col-sm-2" align='right'>
                                                    <label for="">การทำงาน :</label>
                                                </div>
                                                <div class="col-xs-12 col-sm-7" align="center">
                                                    <div style=" border-style:solid;color:red;border-radius: 5px;">
                                                        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
                                                            <?php
                                                            $sql_IMG = "SELECT *FROM WF_FILE 
                                                                        WHERE WFR_ID ='" . $_GET['WFR'] . "' AND WFS_FIELD_NAME='CODE_PHP' AND WF_MAIN_ID ='133' AND FILE_STATUS ='Y'";
                                                            $qry_IMG = db::query($sql_IMG);
                                                            $rec_IMG = db::fetch_array($qry_IMG);
                                                            if ($rec_IMG['FILE_SAVE_NAME'] != '') {
                                                                include "../attach/w133/" . $rec_IMG['FILE_SAVE_NAME'];
                                                            }
                                                            /* ใส่เป็นไฟล์ brown start */
                                                            include('./btn_function.php');
                                                            /* echo add_order_auto();  เพิ่มคำสั่งauto*/
                                                            /* echo add_order(); เพิ่มข้อมูลในหน้าคำสั่ง */
                                                            /* echo serch_data13(); ค้นหาด้วยเลข 13 หลัก */
                                                            if ($_GET['WFR'] == '5') {
                                                                echo add_order();
                                                                echo link_order();
                                                            }
                                                            if ($_GET['WFR'] == '4') {
                                                                echo add_order();
                                                                echo link_order();
                                                            }
                                                            if ($_GET['WFR'] == '3') {
                                                                echo add_order_have_input();
                                                                /*  echo add_order();
                                                                echo link_order(); */
                                                            }
                                                            if ($_GET['WFR'] == '2') {
                                                                echo serch_data13();
                                                            }
                                                            /* ใส่เป็นไฟล์ brown stop */

                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-1"> </div>
                                                <div class="col-xs-12 col-sm-2" align='right'>
                                                    <label for="">รายละเอียด การทำงาน :</label>
                                                </div>
                                                <div class="col-xs-12 col-sm-7">
                                                    <label for=""><?php echo $rec_info['COMMENT_IN_PAGE'] == '' ? '-' : $rec_info['COMMENT_IN_PAGE']; ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-1"> </div>
                                                <div class="col-xs-12 col-sm-2" align='right'>
                                                    <label for="">รายละเอียดตามเอกสาร :</label>
                                                </div>
                                                <div class="col-xs-12 col-sm-7">
                                                    <label for=""><?php echo $rec_info['DETIAL_PAGE'] == '' ? '-' : $rec_info['DETIAL_PAGE']; ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-1"> </div>
                                                <div class="col-xs-12 col-sm-2" align='right'>
                                                    <label for="">comment user :</label>
                                                </div>
                                                <div class="col-xs-12 col-sm-7">
                                                    <textarea name="comment_user" id="comment_user" class="form-control" cols="30" rows="10"> <?php echo htmlspecialchars($rec_info['COMMENT_USER']); ?> </textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-1"> </div>
                                                <div class="col-xs-12 col-sm-2" align='right'>
                                                    <label for="">สถานะของข้อตามtor :</label>
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                <select name="STATUS_TOR" id="STATUS_TOR" class="form-control">
                                                    <option value="pass" <?php echo $rec_info['STATUS_TOR']=='pass'?"SELECTED":""; ?> >ผ่าน</option>
                                                    <option value="not_pass" <?php echo $rec_info['STATUS_TOR']=='not_pass'?"SELECTED":""; ?>>ไม่ผ่าน</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px;">
                                                <div class="col-xs-12 col-sm-9"> </div>
                                                <div class="col-xs-12 col-sm-1" align='center'>
                                                    <button type="button" ss onclick="save_comment();" class="form-control">บันทึก</button>
                                                </div>
                                            </div>
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
    function save_comment() {
        let comment_user = $('#comment_user').val();
        let WFR = '<?php echo $_GET['WFR']; ?>'
        let STATUS_TOR = $('#STATUS_TOR').val();
        if (confirm('คุณต้องการบันทึกรายการนี้หรือไม่')) {
            $.ajax({
                type: "POST",
                url: "./search_data_process_A.php",
                data: {
                    proc: 'comment_user_WFR',
                    COMMENT_USER: comment_user,
                    WFR: WFR,
                    STATUS_TOR:STATUS_TOR
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data)
                    if (1 == 1) {
                        location.reload();
                    }
                }

            });
        }
    }
</script>