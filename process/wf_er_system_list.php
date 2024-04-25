<?php
include '../include/comtop_admin.php';

$p_name = 'แบบจำลองโครงสร้างของฐานข้อมูล (Entity Relationship Diagram)';
$p_url = 'er_system.php';

$sql_usr = db::query("SELECT TABLE_NAME FROM user_tables WHERE TABLE_NAME LIKE 'USR_%' ORDER BY TABLE_NAME ASC");
$num_rows_u = db::num_rows($sql_usr);

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
							<?php 
							if($num_rows_u > 0){?>
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
								while($rec_u = db::fetch_array($sql_usr)){
									if($rec_u["TABLE_NAME"] != 'USR_SETTING'){
								?>
									<div class="form-group row">
									  <div class="col-md-3"></div>
									  <div class="col-md-9">		
										<label for="U_SELECT<?php echo $m;?>" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_SELECT_U[]" id="U_SELECT<?php echo $m;?>" class="custom-control-input" value="<?php echo $rec_u["TABLE_NAME"];?>" >
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"> <?php echo $rec_u["TABLE_NAME"];?></span>
										</label>
									  </div>
									</div>
							
							<?php	
								}
								$m++;}
							}?>
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
		
		if(type == 'U'){
			$("#U_SELECT_ALL").change(function () {
				var num_rows_u = $("#num_rows_u").val();
				for(i=1;i<=num_rows_u;i++){
					$("#U_SELECT"+i).prop('checked', $(this).prop("checked"));
				}
			});
			
		}
		
	}

</script>



<?php include '../include/combottom_admin.php'; ?>