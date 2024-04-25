<?php 
session_start();
error_reporting(E_ALL & ~E_NOTICE);

$template['title'] = "BizSmartFlow 4.0";
$_SESSION["WF_USER_ID"] = "";
include "../include/config.php";
if($_GET["BSL"] != ""){
	$url = bsl_direction($_GET["BSL"]);
	if($url != ""){
		?>
	<script type="text/javascript">
	window.location.href="<?php echo $url; ?>";
	</script>
	<?php
	exit;
	}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/template_user.php'; ?>
</head>
<body>
<?php
if($CONF_LOGIN_IMAGE != ''){?>
<style>
.common-img-front{
    background: url('<?php echo $CONF_LOGIN_IMAGE;?>')no-repeat;
}

</style>
<?php }?>
<section class="login p-fixed d-flex text-center bg-primary common-img-front">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
				<div class="card-head">
						<div class="text-center primary-color">
						<?php
						
						if($CONF_LOGIN_LOGO != ''){?>
							<img src="<?php echo $CONF_LOGIN_LOGO;?>">
						<?php }else{?>
							<img src="../assets/images/logo-blue.png">
						<?php }?>
                            <!--<img src="../assets/images/logo-blue.png">-->
                        </div>
				</div>
                <div class="login-card card-block">
                    <form id="form-login" class="md-float-material" action="login_function.php" method="post" autocomplete="off" onsubmit="return front_login();">
						<?php
						if($CONF_LOGIN_TEXT != ''){?>
							<h4 class="text-center txt-primary"><?php echo $CONF_LOGIN_TEXT;?></h4>
						
						<?php }else{?>
							<h4 class="text-center txt-primary">
								ยินดีต้อนรับสู่ระบบ <span class="txt-warning f-bold">Biz</span><span class="text-muted f-bold">SmartFlow</span>
							</h4>
						
						<?php }?>
                        <!--<h4 class="text-center txt-primary">
                            ยินดีต้อนรับสู่ระบบ <span class="txt-warning f-bold">Biz</span><span class="text-muted f-bold">SmartFlow</span>
                        </h4>-->
						
						<!--- -->
						<?php //if($_GET["error"]=="1"){ ?>
						<div class="row" id="login_error" style="display: none;">
                            <div class="col-xs-10 offset-xs-1 card bg-danger text-center p-20">
                                <i class="zmdi zmdi-info-outline"></i> Username หรือ Password ไม่ถูกต้อง
                            </div>
                        </div>
						<?php //} ?>
						<!--- -->
						<div class="md-group-add-on">
						<span class="md-add-on">
							<i class="icofont icofont-user"></i>
                        </span>
                        <div class="md-input-wrapper">
                            <input type="text" name="USER_NAME" id="USER_NAME" class="md-form-control" required />
                            <label>Username</label>
                        </div>
						</div>
						<div class="md-group-add-on">
						<span class="md-add-on">
							<i class="icofont icofont-key"></i>
                        </span>
                        <div class="md-input-wrapper">
                            <input type="password" name="USER_PASSWORD" id="USER_PASSWORD" class="md-form-control" required />
                            <label>Password</label>
                        </div>
						</div>
                        <div class="row">
                            <div class="col-xs-10 offset-xs-1 text-center">
                                <button type="submit" id="login_submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">เข้าสู่ระบบ</button>
								<div class="preloader3 text-center loader-block" id="login_load" style="display: none; height: inherit; width: inherit;">
									<div class="circ1"></div>
									<div class="circ2"></div>
									<div class="circ3"></div>
									<div class="circ4"></div>
								</div>
                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
					<div id="instead"></div>
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

<script>
//$("body").css("cursor", "wait");
	function front_login()
	{
		
		$('#login_submit, #login_error').hide();
		$('#login_load').show().css('display', 'inline');

		var url = $('#form-login').prop('action');
		var dataString = $('#form-login').serialize();
		$.post(url, dataString, function(msg){
			if(msg == "success")
			{
				window.location.href="../workflow";
				$('#login_load').hide();
			}
			else if(msg == "instead")
			{
				
				$('#login_load').hide();
				var url2 = "check_login.php";
				var dataString2 = "";
				$.post(url2, dataString2, function(txt){
					$('#form-login').hide();
					$('#instead').html(txt);
				});

			}
			else
			{
				$('#login_submit, #login_error').show();
				$('#login_load').hide();
			}
		});

		return false;
	}

	function back_to_login()
	{
		$('#instead').html('');
		$('#USER_NAME, #USER_PASSWORD').val('');
		$('#login_submit, #form-login').show();
	}
</script>

</body>
</html>
<?php db::db_close(); ?>