<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$template['title'] = "BizSmartFlow 4.0";
include "../include/config.php";
$line_id = conText($_GET["line"]);
//if($line_id != ""){
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/template_user.php'; ?>
</head>
<body>
<section class="login p-fixed d-flex text-center bg-success">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
				
					<?php if($_GET["error"]=="N"){ ?>
					<div class="card-head">
						<div class="text-center success-color">
							<img src="../assets/images/brown_cony.png">
                            <img src="../assets/images/logo-blue.png">
                        </div>
				</div>
                <div class="login-card card-block">
						<h5 class="text-center txt-success">
                            ลงทะเบียน <i class="icofont icofont-social-line txt-success"></i>LINE ID  ของท่าน<br/ >กับระบบ <span class="txt-warning f-bold">Biz</span><span class="text-muted f-bold">SmartFlow</span> เรียบร้อยแล้ว
                        </h5>
						<br /><br />
						<div class="row">
                            <div class="col-xs-10 offset-xs-1">
                                <button type="button" class="btn btn-success btn-md btn-block waves-effect text-center m-b-20" onClick="window.close();">ปิด</button>
                            </div>
                        </div>
					<?php }else{ ?>
					<div class="card-head">
						<div class="text-center success-color">
							<img src="../assets/images/brown_cony2.png">
                            <img src="../assets/images/logo-blue.png">
                        </div>
				</div>
                <div class="login-card card-block">
                    <form class="md-float-material" action="login_function.php" method="post">
                        <h5 class="text-center txt-success">
                            ลงทะเบียน <i class="icofont icofont-social-line txt-success"></i>LINE ID  ของท่าน<br />กับระบบ <span class="txt-warning f-bold">Biz</span><span class="text-muted f-bold">SmartFlow</span> <br>โดยใส่ Username และ Password เพื่อยืนยันตัวตน
                        </h5>
						<!--- -->
						<?php if($_GET["error"]=="1"){ ?>
						<div class="row">
                            <div class="col-xs-10 offset-xs-1 card bg-danger text-center p-20">
                                <i class="zmdi zmdi-info-outline"></i> Username หรือ Password ไม่ถูกต้อง
                            </div>
                        </div>
						<?php }elseif($_GET["error"]=="2"){ ?>
						<div class="row">
                            <div class="col-xs-10 offset-xs-1 card bg-danger text-center p-20">
                                <i class="zmdi zmdi-info-outline"></i> ไม่สามารถเชื่อมต่อ Line ได้
                            </div>
                        </div>
						<?php } ?>
						<!--- -->
						<div class="md-group-add-on">
						<span class="md-add-on">
							<i class="icofont icofont-user"></i>
                        </span>
                        <div class="md-input-wrapper">
                            <input type="text" name="LN_USER_NAME" id="LN_USER_NAME" class="md-form-control text-lowercase" required />
                            <label>Username</label>
                        </div>
						</div>
						<div class="md-group-add-on">
						<span class="md-add-on">
							<i class="icofont icofont-key"></i>
                        </span>
                        <div class="md-input-wrapper">
                            <input type="password" name="LN_USER_PASSWORD" id="LN_USER_PASSWORD" class="md-form-control" required />
                            <label>Password</label>
                        </div>
						</div>
                        <div class="row">
                            <div class="col-xs-10 offset-xs-1">
                                <button type="submit" class="btn btn-success btn-md btn-block waves-effect text-center m-b-20">ลงทะเบียน</button>
								<input type="hidden" name="LINE_ID" value="<?php echo $line_id; ?>">
                            </div>
                        </div>

                        <!-- </div> -->
                    </form>
					<?php } ?>
                    <!-- end of form -->
                </div>
                <!-- end of login-card -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>
<script src="../assets/js/jquery-ui.min.js"></script>
<!-- tether.js -->
<script src="../assets/js/tether.min.js"></script>
<!-- waves effects.js -->
<script src="../assets/plugins/waves/js/waves.min.js"></script>
<!-- Required Framework -->
<script src="../assets/js/bootstrap.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="../assets/pages/elements.js"></script>


</body>
</html>
<?php db::db_close(); //} ?>