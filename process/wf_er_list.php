<?php
include '../include/comtop_admin.php';

$p_name = 'แบบจำลองโครงสร้างของฐานข้อมูล (Entity Relationship Diagram)';
$p_url = 'er.php';

$sql_w = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W' AND WF_MAIN_TYPE = 'W' ORDER BY WF_MAIN_ORDER ASC");
$num_rows_w = db::num_rows($sql_w);

$sql_m = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'M' AND WF_MAIN_TYPE = 'W' ORDER BY WF_MAIN_ORDER ASC");
//$rec_m = db::fetch_array($sql_m);
$num_rows_m = db::num_rows($sql_m);


//$sql_usr = db::query("SELECT TABLE_NAME FROM user_tables WHERE TABLE_NAME LIKE 'USR_%' ORDER BY TABLE_NAME ASC");
//$num_rows_u = db::num_rows($sql_usr);

?>

<!-- Range slider css -->
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Row Starts -->
		<div class="row" id="animationSandbox">
			<div class="col-sm-8">
				<div class="main-header">
					<h4><?php echo $p_name; ?></h4>
					
				</div>
			</div>
			<div class="col-sm-4">
				
			</div>
		</div>
		<!-- Row end -->
		<form action="<?php echo $p_url; ?>?group=Y" method="post" id="form_er" target="_blank">
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-header-text">
								<i class="icofont icofont-ui-folder"></i> <?php echo $p_name; ?>
							</h5>
							
						</div>
						<div class="card-block">
							<div class="row">
								<div class="col-md-6">
									<?php
									if($num_rows_w > 0){?>
										<div class="form-group row"><!--class="form-control-label wf-right"  class="custom-control custom-checkbox"-->
											<div class="col-md-2"></div>
											<div class="col-md-3">
												<label for="WF_SELECT_ALL" class="custom-control custom-checkbox">
													<input type="checkbox" name="WF_SELECT_ALL" id="WF_SELECT_ALL" class="custom-control-input" value="Y" onclick="select_all('W');" >
													<span class="custom-control-indicator"></span>
													<span class="custom-control-description"> Workflow</span>
												</label>
												<input type="hidden" name="num_rows_w" id="num_rows_w" value="<?php echo $num_rows_w;?>">
											</div>
										</div>
										<?php
										$i=1;
										while($rec_w = db::fetch_array($sql_w)){?>
											<div class="form-group row">
												<div class="col-md-3"></div>
												<div class="col-md-9">
													<label for="WF_SELECT<?php echo $i;?>" class="custom-control custom-checkbox">
														<input type="checkbox" name="WF_SELECT[]" id="WF_SELECT<?php echo $i;?>" class="custom-control-input" value="<?php echo $rec_w["WF_MAIN_ID"];?>" >
														<span class="custom-control-indicator"></span>
														<span class="custom-control-description"> <?php echo $rec_w["WF_MAIN_NAME"];?></span>
													</label>
												</div>
											</div>

											<?php
											$i++;}
									}?>
								</div>
								<div class="col-md-6">
									<?php
									if($num_rows_m > 0){?>
										<div class="form-group row">
											<div class="col-md-2"></div>
											<div class="col-md-3">
												<label for="M_SELECT_ALL" class="custom-control custom-checkbox">
													<input type="checkbox" name="M_SELECT_ALL" id="M_SELECT_ALL" class="custom-control-input" value="Y" onclick="select_all('M');">
													<span class="custom-control-indicator"></span>
													<span class="custom-control-description"> Master</span>
												</label>
												<input type="hidden" name="num_rows_m" id="num_rows_m" value="<?php echo $num_rows_m;?>">
											</div>
										</div>
										<?php
										$k=1;
										while($rec_m = db::fetch_array($sql_m)){?>
											<div class="form-group row">
												<div class="col-md-3"></div>
												<div class="col-md-9">
													<label for="M_SELECT<?php echo $k;?>" class="custom-control custom-checkbox">
														<input type="checkbox" name="WF_SELECT[]" id="M_SELECT<?php echo $k;?>" class="custom-control-input" value="<?php echo $rec_m["WF_MAIN_ID"];?>" >
														<span class="custom-control-indicator"></span>
														<span class="custom-control-description"> <?php echo $rec_m["WF_MAIN_NAME"];?></span>
													</label>
												</div>
											</div>

											<?php
											$k++;}
									}?>
								</div>
							</div>


							<?php
							/*if($num_rows_u > 0){?>
							<div class="form-group row">
							  <div class="col-md-2"></div>
							  <div class="col-md-3">
								<label for="U_SELECT_ALL" class="custom-control custom-checkbox">
									<input type="checkbox" name="U_SELECT_ALL" id="U_SELECT_ALL" class="custom-control-input" value="Y" onclick="select_all('U');" >
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description"> ข้อมูลของระบบ</span>
								</label>
								<input type="hidden" name="num_rows_u" id="num_rows_u" value="<?php echo $num_rows_u;?>">
							  </div>
							</div>
							<?php
								$m=1;
								while($rec_u = db::fetch_array($sql_usr)){?>
									<div class="form-group row">
									  <div class="col-md-3"></div>
									  <div class="col-md-9">
										<label for="U_SELECT<?php echo $m;?>" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_SELECT_U[]" id="U_SELECT<?php echo $m;?>" class="custom-control-input" value="<?php echo $sql_usr["TABLE_NAME"];?>" >
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"> <?php echo $rec_u["TABLE_NAME"];?></span>
										</label>
									  </div>
									</div>

							<?php
								$n++;}
							}*/?>
							<input type="hidden" name="num_rows" id="num_rows" value="<?php echo ($num_rows_w+$num_rows_m+$num_rows_f);?>">
							<div class="form-group row">
								<div class="col-md-12 text-center">  
								<input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="ส่งออก" />
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<!-- Row end -->
		</form>
		<!-- Container-fluid ends -->
	</div>
</div>
<script type="text/javascript">
	function select_all(type){
		
		if(type == 'W'){
			
			$("#WF_SELECT_ALL").change(function () {
				var num_rows_w = $("#num_rows_w").val();
				for(i=1;i<=num_rows_w;i++){
					$("#WF_SELECT"+i).prop('checked', $(this).prop("checked"));
				}
			});
			
		}else if(type == 'M'){
			$("#M_SELECT_ALL").change(function () {
				var num_rows_m = $("#num_rows_m").val();
				for(i=1;i<=num_rows_m;i++){
					$("#M_SELECT"+i).prop('checked', $(this).prop("checked"));
				}
			});
			
		}else if(type == 'F'){
			$("#F_SELECT_ALL").change(function () {
				var num_rows_f = $("#num_rows_f").val();
				for(i=1;i<=num_rows_f;i++){
					$("#F_SELECT"+i).prop('checked', $(this).prop("checked"));
				}
			});
			
		}else if(type == 'U'){
			$("#U_SELECT_ALL").change(function () {
				var num_rows_u = $("#num_rows_u").val();
				for(i=1;i<=num_rows_u;i++){
					$("#U_SELECT"+i).prop('checked', $(this).prop("checked"));
				}
			});
			
		}
		
	}

</script>
<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_admin.php'; ?>