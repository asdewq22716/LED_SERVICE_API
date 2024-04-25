<?php
include '../include/comtop_admin.php';

$p_name = "ตั้งค่าภาษาของระบบ"; 
$_url = "system_setting_languages";

?>
<!-- gridstack css -->

	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			
			<div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<h4><?php echo $p_name; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item">
								<a href="index.php"><i class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item">
								<a href="<?php echo $p_url; ?>_list.php">บริหารข้อมูล</a>
							</li>
						</ol>
					</div>
				</div>
			</div>
            <!-- Row end -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<form action="<?php echo $_url;?>_function.php" method="post" >
						<div class="card-header">
							<h5 class="card-header-text">
								<i class="icofont icofont-ui-folder"></i> <?php echo $p_name; ?>
							</h5>
							
						</div>
						<div class="card-block">
							<?php
							$i=0;
							foreach($conf_code as $_key => $_val)
							{
								$sql_config = db::query("SELECT * FROM WF_CONFIG WHERE CONFIG_NAME = '{$_val}' ");
								$rec_config = db::fetch_array($sql_config);
								$value = $rec_config['CONFIG_VALUE'];

								if(array_key_exists($_val, $conf_data_type))
								{
									$config_type = $conf_data_type[$_val];
								}
								else
								{
									$config_type = "1";
								}
							?>
							<div class="form-group row">
								<div class="col-md-4">
									<label for="<?php echo $_val; ?>" class="form-control-label wf-right"><?php echo $conf_title[$_key]; ?></label>
									<input type="hidden" name="CONFIG_TYPE<?php echo $i; ?>" id="CONFIG_TYPE<?php echo $i; ?>" value="<?php echo $config_type; ?>">
								</div>
								<div class="col-md-6">
									<?php
									if($config_type == 1){ ?>
										<input type="text" class="form-control" name="<?php echo $_val;?>" id="<?php echo $_val;?>" value="<?php echo $value; ?>" >

									<?php }elseif($config_type == 2){ ?>
										<textarea name="<?php echo $_val;?>" id="<?php echo $_val;?>" class="form-control" rows="3"><?php echo $value; ?></textarea>


									<?php }/*elseif($rec_config['CONFIG_ID'] == 3){
										$e = explode(',',$system_option[$_val]);
										foreach($e as $k=>$v){?>
											
											<div class="form-radio">
												<div class="radio radio-inline">
													<label><input type="radio" name="<?php echo $_val;?>" id="<?php echo $_val;?>" value="<?php echo $v;?>" <?php if($v == $value){ echo 'checked';}?> ><i class="helper"></i> <?php echo $v;?></label>
												</div>
											
											</div>
											<?php
										}
									}*/?>
							</div>
						</div>
						<?php $i++; } ?>
					</div>
                </div>
            </div>
        <!-- Container-fluid ends -->
     </div>
	 <div class="row">
		<div class="col-md-12">
			<div class="wf-right">&nbsp;
				<button type="submit" class="btn btn-md btn-success active waves-effect waves-light">
					<i class="icofont icofont-tick-mark"></i> บันทึก
				</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="main-header">
		</div>
	</div>
	</form>
</div>
<?php include '../include/combottom_js.php'; ?>

<!-- custom js -->
<?php include '../include/combottom_admin.php'; ?>