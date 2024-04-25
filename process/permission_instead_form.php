<?php
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$U_ID = conText($_GET['U_ID']);

$p_name = "ผู้ใช้งาน";
$p_url = "user";
$p_process = 'สิทธิ์การเข้าใช้งานแทนกัน';


function show_field($field_name){
	$sql_m = db::query("SELECT FIELD_LABEL,FIELD_REQUIRED,FIELD_STATUS FROM USR_SETTING WHERE FIELD_NAME='".$field_name."'");
	$data = db::fetch_array($sql_m);
	
	return $data;
}

?>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Row Starts -->
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<h4><?php echo $p_process; ?></h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item">
							<a href="index.php"><i class="icofont icofont-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?php echo $p_url; ?>_list.php">บริหาร<?php echo $p_name; ?></a>
						</li>
						<li class="breadcrumb-item">
							<a href="permission_instead_list.php?process=permission_instead&U_ID=<?php echo $U_ID;?>"><?php echo $p_process; ?></a>
						</li>
						<li class="breadcrumb-item">
							<a href="#">เพิ่มสิทธิ์</a>
						</li>
					</ol>
					
				</div>
			</div>
		</div>
		<!-- Row end -->
		<form action="permission_instead_function.php" method="post">
			<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
			<input type="hidden" name="U_ID" id="U_ID" value="<?php echo $U_ID; ?>">
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-block">
							<div class="form-group row">
								<div class="col-md-2">
									<label for="PI_STARTDATE" class="form-control-label wf-right">เริ่มวันที่</label>
								</div>
								<div class="col-md-2">
									<label class="input-group">
										<input name="PI_STARTDATE" id="PI_STARTDATE" value=""   class="form-control datepicker" placeholder="วว/ดด/ปปปป"><span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
									</label>
								</div>
								<div class="col-md-2">
									<label for="PI_ENDDATE" class="form-control-label wf-right">ถึงวันที่</label>
								</div>
								<div class="col-md-2">
									<label class="input-group">
										<input name="PI_ENDDATE" id="PI_ENDDATE" value=""   class="form-control datepicker" placeholder="วว/ดด/ปปปป"><span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
									</label>
								</div>
							</div>
							<?php
							$data_d = show_field('DEP_ID');
								
							if($data_d["FIELD_STATUS"] == 'Y'){?>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="DEP_ID" class="form-control-label wf-right"><?php echo $data_d["FIELD_LABEL"]; ?></label>
								</div>
								<div class="col-md-6">
									<?php
									
									$department_data = build_data('USR_DEPARTMENT', 'DEP_ID', 'DEP_NAME');
									form_dropdown('DEP_ID', $department_data, $rec['DEP_ID'],$req);
									?>
								</div>
							</div>
								<?php }?>
							<!---->
							<?php
							$data_p = show_field('POS_ID');
								
							if($data_p["FIELD_STATUS"] == 'Y'){?>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="USR_TEL" class="form-control-label wf-right"><?php echo $data_p["FIELD_LABEL"]; ?></label>
								</div>
								<div class="col-md-6">
									<?php
									
									$position_data = build_data('USR_POSITION', 'POS_ID', 'POS_NAME');
									form_dropdown('POS_ID', $position_data, $rec['POS_ID'],$req2);
									?>
								</div>
							</div>
							<?php }?>
							<!---->
							<?php
							$sql = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE='O' AND FIELD_STATUS='Y' ORDER BY FIELD_ID");
							$i=1;
							while($rec_o = db::fetch_array($sql)){	
								$wh = '';
								if($rec_o["FIELD_ID"] != ''){
									$sql_master = db::query("SELECT WF_MAIN_ID,WF_MAIN_NAME,WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID = '".$rec_o["WF_MAIN_ID"]."'");
									$rec_m = db::fetch_array($sql_master);
										
										
									$sql_mpk = db::query("SELECT WFS_FIELD_NAME as WFS_FIELD_NAME FROM WF_STEP_FORM WHERE WF_MAIN_ID = '". $rec_o["WF_MAIN_ID"]."' ");
									$rec_ms = db::fetch_array($sql_mpk);
									
									if($rec_o['FIELD_TEXT'] != '' AND ($rec_o['FIELD_RELETION'] == '' OR $rec_o['FIELD_RELETION'] == 'M')){
										$rec_ms["WFS_FIELD_NAME"] = $rec_o['FIELD_TEXT']; 
										
									}
									
									//$data_show = show_field($rec_o['FIELD_NAME']);
									
									if($rec_o['FIELD_RELETION'] == 'T'){ //TEXT?>
										<div class="form-group row">
											<div class="col-md-2">
												<label for="USR_OPTION<?php echo $i; ?>" class="form-control-label wf-right"><?php echo $rec_o['FIELD_LABEL']; if($rec_o["FIELD_REQUIRED"] == 'Y'){ echo ' <span class="text-danger">*</span></label>';}?>
												</label>
											</div>
											<div class="col-md-4">
												<input type="text" id="USR_OPTION<?php echo $i; ?>" name="USR_OPTION<?php echo $i; ?>" class="form-control" value="<?php echo $rec[$rec_o["FIELD_NAME"]]; ?>" <?php if($rec_o["FIELD_REQUIRED"] == 'Y'){ echo 'required';}?>>
											</div>
										</div>
									<?php
									}elseif(($rec_o['FIELD_RELETION'] == 'M' OR $rec_o['FIELD_RELETION'] == '') AND $rec_m["WF_MAIN_ID"] != ''){ //1:M,1:1
										if($rec_o['FIELD_STATEMENT'] != ''){
											$wh = " where ".str_replace("&#039;","'",$rec_o['FIELD_STATEMENT']);
											
										}else{
											$wh = '';
										}
										
										if($rec_o['FIELD_RELETION'] == 'M'){$arr = '[]';$multi = 'multiple';}else{ $arr = '';$multi ='';}
										
										$sql_mt = "SELECT * FROM ".$rec_m["WF_MAIN_SHORTNAME"].$wh;
										$sql_m_t = db::query($sql_mt);?>
										<div class="form-group row">
											<div class="col-md-2">
												<label for="USR_OPTION<?php echo $i; ?>" class="form-control-label wf-right"><?php echo $rec_o["FIELD_LABEL"]; if($rec_o["FIELD_REQUIRED"] == 'Y'){ echo ' <span class="text-danger">*</span></label>';}?></label>
											</div>
											<div class="col-md-6">
												
												<select name="USR_OPTION<?php echo $i.$arr; ?>" id="USR_OPTION<?php echo $i; ?>" class="select2" <?php echo $multi;?>  data-placeholder="เลือก<?php echo $rec_m["WF_MAIN_NAME"]; ?>">
												<option value=""></option>
												<?php
												if($rec["USR_OPTION".$i] != ''){
													$data = explode(',',$rec["USR_OPTION".$i]);
												}else{
													$data = array();
													
												}
												while($data_m = db::fetch_array($sql_m_t)){
												
													if($rec_o['FIELD_RELETION'] == 'M'){
														if(in_array($data_m[$rec_m["WF_FIELD_PK"]], $data)){ $seleted = 'selected';}else{ $seleted = ''; }
													}else{
														if($data_m[$rec_m["WF_FIELD_PK"]] == $rec["USR_OPTION".$i]){ $seleted = 'selected';}else{ $seleted = ''; }
														
													}
													
													
												?>
													<option value="<?php echo $data_m[$rec_m["WF_FIELD_PK"]]; ?>" <?php echo $seleted;?>> <?php
													if($rec_o['FIELD_TEXT'] != ''){
														
													echo bsf_show_text($rec_m["WF_MAIN_ID"],$data_m,$rec_o['FIELD_TEXT'],$rec_m["WF_TYPE"]);	
													}else{
														
														echo $data_m[$rec_ms["WFS_FIELD_NAME"]];
													}
													?></option>
												<?php }	?>
												</select>
											</div>
									</div>

									<?php	
																	
									}
									
									?>
										
									<input type="hidden" name="FIELD_ID<?php echo $i;?>" id="FIELD_ID<?php echo $i;?>" value="<?php echo $rec_o['FIELD_ID'];?>">
									<?php
								}
							$i++;}
							?>
							<input type="hidden" name="num_rows_o" id="num_rows_o" value="<?php echo $i;?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="f-left">
						<button type="button" class="btn btn-md btn-danger active waves-effect waves-light" onclick="window.location.href='<?php echo $p_url; ?>_list.php';">
							<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ
						</button>
					</div>
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
		<!-- Container-fluid ends -->
	</div>
</div>
<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>
