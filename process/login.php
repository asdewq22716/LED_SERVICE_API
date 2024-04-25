<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$template['title'] = "BizSmartFlow Admin 4.0";
 ?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/template_head.php'; ?>
	<!-- Font Awesome -->
	<link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>
<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
				<div class="card-head">
						<div class="text-center stylish-color">
                           <?php
							echo $CONF_LOGIN_LOGO;
							if($CONF_LOGIN_LOGO != ''){?>
								<img src="<?php echo $CONF_LOGIN_LOGO;?>">
							<?php }else{?>
								<img src="../assets/images/logo-blue.png">
							<?php }?>
                        </div>
				</div>
                <div class="login-card card-block">
                    <form class="md-float-material" action="login_function.php" method="post" autocomplete="off">
                        <?php
						
						if($CONF_LOGIN_TEXT != ''){?>
							<h4 class="text-center txt-primary"><?php echo $CONF_LOGIN_TEXT;?></h4>
						
						<?php }else{?>
							<h4 class="text-center txt-primary">
								ยินดีต้อนรับสู่ระบบ <span class="txt-warning f-bold">Biz</span><span class="text-muted f-bold">SmartFlow</span>
							</h4>
						
						<?php }?>
						<!--- -->
						<?php if($_GET["error"]=="1"){ ?>
						<div class="row">
                            <div class="col-xs-10 offset-xs-1 card bg-danger text-center p-20">
                                <i class="zmdi zmdi-info-outline"></i> Username หรือ Password ไม่ถูกต้อง
                            </div>
                        </div>
						<?php } ?>
						<!--- -->
						<div class="md-group-add-on">
						<span class="md-add-on">
							<i class="icofont icofont-user"></i>
                        </span>
                        <div class="md-input-wrapper">
                            <input type="text" name="USER_NAME" id="USER_NAME" class="md-form-control" />
                            <label>Username</label>
                        </div>
						</div>
						<div class="md-group-add-on">
						<span class="md-add-on">
							<i class="icofont icofont-key"></i>
                        </span>
                        <div class="md-input-wrapper">
                            <input type="password" name="USER_PASSWORD" id="USER_PASSWORD" class="md-form-control" />
                            <label>Password</label>
                        </div>
						</div>
                        <div class="row">
                            <div class="col-xs-10 offset-xs-1">
                                <button type="submit" class="btn btn-info btn-md btn-block waves-effect text-center m-b-20">เข้าสู่ระบบ</button>
                            </div>
                        </div>

                        <!-- </div> -->
                    </form>
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

 
<!-- Required Jqurey -->
<script src="../assets/js/jquery-3.1.1.min.js"></script>
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