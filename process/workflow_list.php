<?php
include '../include/comtop_admin.php';

$p_name_main = 'บริหาร Menu';
$p_name = 'เลือกข้อมูลที่อยู่ในเมนู';
$p_url = 'menu_group_function.php';
$MENU_ID = conText($_GET['MENU_ID']);
$process = conText($_GET['process']);

$sql_menu = db::query("select MENU_NAME from WF_MENU WHERE MENU_ID='".$MENU_ID."'");
$menu = db::fetch_array($sql_menu);

$sql_w = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME,WF_MENU from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W' ORDER BY WF_MAIN_ORDER ASC");
$num_rows_w = db::num_rows($sql_w);

$sql_m = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME,WF_MENU from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'M' ORDER BY WF_MAIN_ORDER ASC");
//$rec_m = db::fetch_array($sql_m);
$num_rows_m = db::num_rows($sql_m);


$sql_f = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME,WF_MENU from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'R' ORDER BY WF_MAIN_ORDER ASC");
//$rec_f = db::fetch_array($sql_f);
$num_rows_f = db::num_rows($sql_f);

$sql_w_c = db::query("select WF_MAIN_ID from WF_MAIN where WF_MENU = '".$MENU_ID."' AND WF_TYPE = 'W' ");
$num_rows_w_c = db::num_rows($sql_w_c);

$sql_m_c = db::query("select WF_MAIN_ID from WF_MAIN where WF_MENU = '".$MENU_ID."' AND WF_TYPE = 'M' ");
$num_rows_m_c = db::num_rows($sql_m_c);

$sql_f_c = db::query("select WF_MAIN_ID from WF_MAIN where WF_MENU = '".$MENU_ID."' AND WF_TYPE = 'R' ");
$num_rows_f_c = db::num_rows($sql_f_c);

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
								<i class="icofont icofont-ui-folder"></i> <?php echo $p_name.$menu["MENU_NAME"]; ?>
							</h5>
							
						</div>
						<div class="card-block">
							<?php 
							if($num_rows_w > 0){
							?>
							<div class="form-group row"><!--class="form-control-label wf-right"  class="custom-control custom-checkbox"-->
							  <div class="col-md-2"></div>
							  <div class="col-md-3">		
								<label for="WF_SELECT_ALL" class="custom-control custom-checkbox">
									<input type="checkbox" name="WF_SELECT_ALL" id="WF_SELECT_ALL" class="custom-control-input" value="Y" onclick="select_all('W');" <?php if(($num_rows_w_c == $num_rows_w) AND ($num_rows_w_c > 0)){ echo 'checked';} ?>>
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
											<input type="checkbox" name="WF_SELECT[]" id="WF_SELECT<?php echo $i;?>" class="custom-control-input" value="<?php echo $rec_w["WF_MAIN_ID"];?>" <?php echo ($rec_w["WF_MENU"] == $MENU_ID)?'checked':''?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"> <?php echo $rec_w["WF_MAIN_NAME"];?></span>
										</label>
									  </div>
									</div>
							
							<?php							
								$i++;}
							}?>
							<?php 
							if($num_rows_m > 0){?>
							<div class="form-group row">
							  <div class="col-md-2"></div>
							  <div class="col-md-3">		
								<label for="M_SELECT_ALL" class="custom-control custom-checkbox">
									<input type="checkbox" name="M_SELECT_ALL" id="M_SELECT_ALL" class="custom-control-input" value="Y" onclick="select_all('M');" <?php if(($num_rows_m_c == $num_rows_m) AND ($num_rows_m_c > 0)){ echo 'checked';} ?>>
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
											<input type="checkbox" name="WF_SELECT[]" id="M_SELECT<?php echo $k;?>" class="custom-control-input" value="<?php echo $rec_m["WF_MAIN_ID"];?>" <?php echo ($rec_m["WF_MENU"] == $MENU_ID)?'checked':''?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"> <?php echo $rec_m["WF_MAIN_NAME"];?></span>
										</label>
									  </div>
									</div>
							
							<?php							
								$k++;}
							}?>
							<?php 
							if($num_rows_f > 0){?>
							<div class="form-group row">
							  <div class="col-md-2"></div>
							  <div class="col-md-3">		
								<label for="F_SELECT_ALL" class="custom-control custom-checkbox">
									<input type="checkbox" name="F_SELECT_ALL" id="F_SELECT_ALL" class="custom-control-input" value="Y" onclick="select_all('R');" <?php if(($num_rows_f_c == $num_rows_f) AND ($num_rows_f_c > 0)){ echo 'checked';} ?>>
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description"> Report</span>
								</label>
								<input type="hidden" name="num_rows_f" id="num_rows_f" value="<?php echo $num_rows_f;?>">
							  </div>
							</div>
							<?php 
								$n=1;
								while($rec_f = db::fetch_array($sql_f)){?>
									<div class="form-group row">
									  <div class="col-md-3"></div>
									  <div class="col-md-9">		
										<label for="F_SELECT<?php echo $n;?>" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_SELECT[]" id="F_SELECT<?php echo $n;?>" class="custom-control-input" value="<?php echo $rec_f["WF_MAIN_ID"];?>" <?php echo ($rec_f["WF_MENU"] == $MENU_ID)?'checked':''?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"> <?php echo $rec_f["WF_MAIN_NAME"];?></span>
										</label>
									  </div>
									</div>
							
							<?php							
								$n++;}
							}?>
							<input type="hidden" name="num_rows" id="num_rows" value="<?php echo ($num_rows_w+$num_rows_m+$num_rows_f);?>">
							
							<input type="hidden" name="MENU_ID" id="MENU_ID" value="<?php echo $MENU_ID;?>">
							<input type="hidden" name="process" id="process" value="<?php echo $process;?>">
							
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
			
		}else if(type == 'R'){
			$("#F_SELECT_ALL").change(function () {
				var num_rows_f = $("#num_rows_f").val();
				for(i=1;i<=num_rows_f;i++){
					$("#F_SELECT"+i).prop('checked', $(this).prop("checked"));
				}
			});
			
		}
		
	}

</script>



<?php include '../include/combottom_admin.php'; ?>