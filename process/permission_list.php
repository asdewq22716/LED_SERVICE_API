<?php
include '../include/comtop_admin.php';

$p_name_main = 'บริหารสิทธิ์การเข้าใช้งาน';
$p_name = 'เลือกสิทธิ์การเข้าใช้งานของ';
$p_url = 'permission_function.php';
$U_ID = conText($_GET['U_ID']);
$USR_TYPE = conText($_GET['USR_TYPE']);

if($USR_TYPE== 'D'){
	$sql_d = db::query("SELECT DEP_NAME FROM USR_DEPARTMENT WHERE DEP_STATUS='Y' AND DEP_ID='".$U_ID."'");
	$detail = db::fetch_array($sql_d);
	$name =  $detail["DEP_NAME"];
}
if($USR_TYPE== 'G'){
	$sql_d = db::query("SELECT GROUP_NAME FROM USR_GROUP  WHERE GROUP_STATUS='Y' AND GROUP_ID='".$U_ID."'");
	$detail = db::fetch_array($sql_d);
	$name =  $detail["GROUP_NAME"];
}
if($USR_TYPE== 'P'){
	$sql_d = db::query("SELECT POS_NAME FROM USR_POSITION WHERE POS_STATUS='Y' AND POS_ID='".$U_ID."'");
	$detail = db::fetch_array($sql_d);
	$name =  $detail["POS_NAME"];
}
if($USR_TYPE== 'U'){
	$sql_d = db::query("SELECT USR_PREFIX, USR_FNAME,USR_LNAME FROM USR_MAIN WHERE USR_STATUS = 'Y' AND USR_ID='".$U_ID."'");
	$detail = db::fetch_array($sql_d);
	$name = $detail["USR_PREFIX"].$detail["USR_FNAME"].' '.$detail["USR_LNAME"];
}


$sql_w = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W' ORDER BY WF_MAIN_ORDER ASC");
$num_rows_w = db::num_rows($sql_w);

$sql_m = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'M' ORDER BY WF_MAIN_ORDER ASC");
$num_rows_m = db::num_rows($sql_m);


$sql_r = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'R' ORDER BY WF_MAIN_ORDER ASC");
$num_rows_r = db::num_rows($sql_r);

$i=1;

/*
$sql_w_c = db::query("select WF_MAIN_ID from WF_MAIN where WF_MENU = '".$MENU_ID."' AND WF_TYPE = 'W' ");
$num_rows_w_c = db::num_rows($sql_w_c);

$sql_m_c = db::query("select WF_MAIN_ID from WF_MAIN where WF_MENU = '".$MENU_ID."' AND WF_TYPE = 'M' ");
$num_rows_m_c = db::num_rows($sql_m_c);

$sql_f_c = db::query("select WF_MAIN_ID from WF_MAIN where WF_MENU = '".$MENU_ID."' AND WF_TYPE = 'R' ");
$num_rows_f_c = db::num_rows($sql_f_c);
*/
?>

<!-- Range slider css -->
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Row Starts -->
		<div class="row" id="animationSandbox">
			<div class="col-sm-8">
				<div class="main-header">
					<h4><?php echo $p_name_main; ?></h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a></li>
						<li class="breadcrumb-item"><a href="menu_group_list.php"><?php echo $p_name_main;?></a></li>
						<li class="breadcrumb-item"><a href="">เลือกข้อมูล</a></li>
					</ol>
				</div>
			</div>
			<div class="col-sm-4">
				
			</div>
		</div>
		<!-- Row end -->
		<form action="<?php echo $p_url; ?>" method="post" >
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-header-text">
								<i class="icofont icofont-ui-folder"></i> <?php echo $p_name.' '.$name; ?>
							</h5>
						</div>
						<div class="card-block">
							<?php 
							if($num_rows_w > 0){
							?>
							<div class="form-group row"><!--class="form-control-label wf-right"  class="custom-control custom-checkbox"-->
							  <div class="col-md-2"></div>
							  <div class="col-md-3"><i class="icofont icofont-chart-flow-alt-2"></i> Workflow
								<input type="hidden" name="num_rows_w" id="num_rows_w" value="<?php echo $num_rows_w;?>">
							  </div>
							</div>
							<?php 
								
								while($rec_w = db::fetch_array($sql_w)){
									$query_acc = db::query("SELECT ACCESS_ID FROM USR_ACCESS WHERE ACCESS_TYPE = 'WFM' AND
								ACCESS_REF_ID = '".$rec_w["WF_MAIN_ID"]."' AND USR_TYPE = '".$USR_TYPE."' AND
								USR_REF_ID = '".$U_ID."' ");
									$rac_acc = db::fetch_array($query_acc);
									
									$sql_detail = db::query("SELECT WFD_ID,WFD_NAME FROM WF_DETAIL WHERE WF_MAIN_ID='".$rec_w["WF_MAIN_ID"]."' ORDER BY WFD_ORDER");
									$num_w_detail = db::num_rows($sql_detail);
									?>
									<div class="form-group row">
									  <div class="col-md-3"></div>
									  <div class="col-md-9">		
										<label for="WF_SELECT<?php echo $i;?>" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_SELECT<?php echo $i;?>" id="WF_SELECT<?php echo $i;?>" class="custom-control-input" value="Y" <?php if($rac_acc["ACCESS_ID"] != ''){ echo 'checked';}?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"> <?php echo $rec_w["WF_MAIN_NAME"];?></span>
											<input type="hidden" name="ACC_TYPE<?php echo $i;?>" id="ACC_TYPE<?php echo $i;?>" value="WFM">
											<input type="hidden" name="WF_MAIN_ID<?php echo $i;?>" id="WF_MAIN_ID<?php echo $i;?>" value="<?php echo $rec_w["WF_MAIN_ID"];?>">
										</label>
									  </div>
									</div>
									<?php
									$i++;
									if($num_w_detail > 0){
										while($w_detail = db::fetch_array($sql_detail)){
										$query_w_acc_det = db::query("SELECT ACCESS_ID FROM USR_ACCESS WHERE ACCESS_TYPE = 'DET' AND ACCESS_REF_ID = '".$w_detail["WFD_ID"]."' AND USR_TYPE = '".$USR_TYPE."' AND USR_REF_ID = '".$U_ID."' ");
										$w_acc_det = db::fetch_array($query_w_acc_det);
										?>
											<div class="form-group row">
											  <div class="col-md-4"></div>
											  <div class="col-md-8">		
												<label for="WF_SELECT<?php echo $i;?>" class="custom-control custom-checkbox">
													<input type="checkbox" name="WF_SELECT<?php echo $i;?>" id="WF_SELECT<?php echo $i;?>" class="custom-control-input" value="Y" <?php if($w_acc_det["ACCESS_ID"] != ''){ echo 'checked';}?>>
													<span class="custom-control-indicator"></span>
													<span class="custom-control-description"> <?php echo $w_detail["WFD_NAME"];?></span>
													<input type="hidden" name="ACC_TYPE<?php echo $i;?>" id="ACC_TYPE<?php echo $i;?>" value="DET">
													<input type="hidden" name="WF_MAIN_ID<?php echo $i;?>" id="WF_MAIN_ID<?php echo $i;?>" value="<?php echo $w_detail["WFD_ID"];?>">
												</label>
											  </div>
											</div>
									<?php	
										$i++;
										}
									}
									?>
									
							
							<?php							
								}
							}?>
							<?php 
							if($num_rows_m > 0){?>
							<div class="form-group row">
							  <div class="col-md-2"></div>
							  <div class="col-md-3"><i class="fa fa-table"></i> Master
								<input type="hidden" name="num_rows_m" id="num_rows_m" value="<?php echo $num_rows_m;?>">
							  </div>
							</div>
							<?php 
								//$k = ($i > 1)?($i-1):1;
								while($rec_m = db::fetch_array($sql_m)){
									$query_m_acc = db::query("SELECT ACCESS_ID FROM USR_ACCESS WHERE ACCESS_TYPE = 'WFM' AND ACCESS_REF_ID = '".$rec_m["WF_MAIN_ID"]."' AND USR_TYPE = '".$USR_TYPE."' AND USR_REF_ID = '".$U_ID."' ");
									$m_acc = db::fetch_array($query_m_acc);
									
								?>
									<div class="form-group row">
									  <div class="col-md-3"></div>
									  <div class="col-md-9">		
										<label for="WF_SELECT<?php echo $i;?>" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_SELECT<?php echo $i;?>" id="WF_SELECT<?php echo $i;?>" class="custom-control-input" value="Y" <?php if($m_acc["ACCESS_ID"] != ''){ echo 'checked';}?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"> <?php echo $rec_m["WF_MAIN_NAME"];?></span>
										</label>
										<input type="hidden" name="ACC_TYPE<?php echo $i;?>" id="ACC_TYPE<?php echo $i;?>" value="WFM">
										<input type="hidden" name="WF_MAIN_ID<?php echo $i;?>" id="WF_MAIN_ID<?php echo $i;?>" value="<?php echo $rec_m["WF_MAIN_ID"];?>">
									  </div>
									</div>
							
							<?php							
								$i++;}
							}?>
							<?php 
							if($num_rows_r > 0){?>
							<div class="form-group row">
							  <div class="col-md-2"></div>
							  <div class="col-md-3"><i class="fa fa-file-text-o"></i> Report
								<input type="hidden" name="num_rows_f" id="num_rows_f" value="<?php echo $num_rows_f;?>">
							  </div>
							</div>
							<?php 
								//$n= ($k > 1)?($k-1):1;
								while($rec_r = db::fetch_array($sql_r)){
									$query_r_acc = db::query("SELECT ACCESS_ID FROM USR_ACCESS WHERE ACCESS_TYPE = 'WFM' AND ACCESS_REF_ID = '".$rec_r["WF_MAIN_ID"]."' AND USR_TYPE = '".$USR_TYPE."' AND USR_REF_ID = '".$U_ID."' ");
									$r_acc = db::fetch_array($query_r_acc);
									
								?>
									<div class="form-group row">
									  <div class="col-md-3"></div>
									  <div class="col-md-9">		
										<label for="WF_SELECT<?php echo $i;?>" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_SELECT<?php echo $i;?>" id="WF_SELECT<?php echo $i;?>" class="custom-control-input" value="Y" <?php if($r_acc["ACCESS_ID"] != ''){ echo 'checked';}?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"> <?php echo $rec_r["WF_MAIN_NAME"];?></span>
										</label>
										<input type="hidden" name="ACC_TYPE<?php echo $i;?>" id="ACC_TYPE<?php echo $i;?>" value="WFM">
										<input type="hidden" name="WF_MAIN_ID<?php echo $i;?>" id="WF_MAIN_ID<?php echo $i;?>" value="<?php echo $rec_r["WF_MAIN_ID"];?>">
									  </div>
									</div>
							
							<?php							
								$i++;}
							}?>
							<input type="hidden" name="num_rows" id="num_rows" value="<?php echo $i;?>">
							<input type="hidden" name="U_ID" id="U_ID" value="<?php echo $U_ID;?>">
							<input type="hidden" name="USR_TYPE" id="USR_TYPE" value="<?php echo $USR_TYPE;?>">
							
							<div class="form-group row">
								<div class="col-md-12 text-center">  
								<input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="บันทึก" />
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
<!--<script type="text/javascript">
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
			
		}else if(type == 'R'){
			$("#F_SELECT_ALL").change(function () {
				var num_rows_f = $("#num_rows_f").val();
				for(i=1;i<=num_rows_f;i++){
					$("#F_SELECT"+i).prop('checked', $(this).prop("checked"));
				}
			});
			
		}
		
	}

</script>-->



<?php include '../include/combottom_admin.php'; ?>