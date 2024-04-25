<?php
include '../include/comtop_admin.php';

$p_name = "ผู้ใช้งาน";
$p_url = "user";


$url_back = "user_list.php";

$con = '';
if($_GET["USR_PREFIX"] != ''){
	$con .= " AND USR_PREFIX='". conText($_GET["USR_PREFIX"])."'";
	
}
if($_GET["USR_FNAME"] != ''){
	$con .= " AND USR_FNAME LIKE '%". conText($_GET["USR_FNAME"])."%'";
	
}
if($_GET["USR_LNAME"] != ''){
	$con .= " AND USR_LNAME LIKE '%". conText($_GET["USR_LNAME"])."%'";
	
}
if($_GET["USR_EMAIL"] != ''){
	$con .= " AND USR_EMAIL LIKE '%".conText($_GET["USR_EMAIL"])."%'";
	
}
if($_GET["USR_TEL"] != ''){
	$con .= " AND USR_TEL='".conText($_GET["USR_TEL"])."'";
	
}
if($_GET["DEP_ID"] != ''){
	$con .= " AND DEP_ID='".conText($_GET["DEP_ID"])."'";
	
}
if($_GET["POS_ID"] != ''){
	$con .= " AND POS_ID='".conText($_GET["POS_ID"])."'";
	
}
if($_GET["USR_LINE_ID"] != ''){
	$con .= " AND USR_LINE_ID='".conText($_GET["USR_LINE_ID"])."'";
	
}
if($_GET["USR_USERNAME"] != ''){
	$con .= " AND USR_USERNAME LIKE '%".conText($_GET["USR_USERNAME"])."%'";
	
}

$USR_SEARCH = conText($_GET["USR_SEARCH"]);

$sql_search = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE='O' AND FIELD_STATUS='Y' ORDER BY FIELD_ID");
$k=1;
while($rec_search = db::fetch_array($sql_search)){

	if($rec_search["FIELD_RELETION"] == 'T' ){
		
		$USR_OPTION = conText($_GET[$rec_search["FIELD_NAME"]]);
		if($USR_OPTION != ''){
			$con .= " AND USR_OPTION".$k." LIKE '%".$USR_OPTION."%'";
		}

	}else{
		if(count($_GET[$rec_search["FIELD_NAME"]]) > 0 AND $rec_search["FIELD_RELETION"] == 'M'){
			$data = implode(',',$_GET[$rec_search["FIELD_NAME"]]);
			unset($_GET[$rec_search["FIELD_NAME"]]);
			
			$_GET[$rec_search["FIELD_NAME"]] = $data;
			
		}	
		
		$USR_OPTION = conText($_GET[$rec_search["FIELD_NAME"]]);
		if($USR_OPTION != ''){
			$con .= " AND USR_OPTION".$k." = '".$USR_OPTION."'";
		}
		
	}
	
	$k++;
}


function show_field($field_name){
	$sql_m = db::query("SELECT FIELD_LABEL,FIELD_REQUIRED,FIELD_STATUS,FIELD_SEARCH FROM USR_SETTING WHERE FIELD_NAME='".$field_name."'");
	$data = db::fetch_array($sql_m);
	
	return $data;
}


$sql = db::query("select * from USR_MAIN WHERE 1=1 ".$con." ORDER BY USR_FNAME, USR_LNAME ASC");
?>
<style>
	.move-td{
		cursor: move;
	}
</style>
	<!-- Range slider css -->
	<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			<div class="row" id="animationSandbox">
				<div class="col-sm-8">
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
				<div class="col-sm-4">
					<div class="md-group-add-on col-sm-12">
							 <span class="md-add-on">
								<i class="icofont icofont-search-alt-2 chat-search"></i>
							 </span>
						<div class="md-input-wrapper">
							<input type="text" class="md-form-control" name="wf_search" id="search-wf_mian">
							<label for="username">ค้นหา</label>
						</div>
					</div>
					<div class="f-right">
						<a class="btn btn-primary waves-effect waves-light" href="<?php echo $p_url; ?>_form.php?process=add" role="button">
							<i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล
						</a>
					</div>
				</div>
			</div>

			<!-- Row end -->
			
				<!-- Row Starts -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<!--SEARCH -->
							<form action="user_list.php" name="form_search" id="form_search" method="get" 
							<!-- Row Starts -->
							
							<div class="card-header">
								<h4><i class="icofont icofont-search-alt-2"></i> ค้นหา </h4>
							</div>
							<!--<div class="card-header"><h5 class="card-header-text">
									<i class="typcn typcn-message"></i> ข้อมูล<?php echo $p_name; ?></h5>
								<div class="f-right">
									<label for="USR_STATUS" class="custom-control custom-checkbox">
										<input type="checkbox" name="USR_STATUS" id="USR_STATUS" class="custom-control-input" value="Y" <?php echo $rec['USR_STATUS'] == "Y" ? 'checked' :''; ?>>
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">เปิดใช้งาน</span>
									</label>
									<label for="USR_ADM" class="custom-control custom-checkbox">
										<input type="checkbox" name="USR_ADM" id="USR_ADM" class="custom-control-input" value="Y" <?php echo $rec['USR_ADM'] == "Y" ? 'checked' :''; ?>>
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">Admin</span>
									</label>
								</div>
							</div>-->
							<div class="card-block">
								<!---->
								<?php
									
									$data_prefix = show_field('USR_PREFIX');
									$data_name = show_field('USR_FNAME');
									$data_lname = show_field('USR_LNAME');
								?>
								<div class="form-group row">
									<?php
									if($data_prefix["FIELD_SEARCH"] == 'Y'){
									?>
									<div class="col-md-2">
										<label for="USR_PREFIX" class="form-control-label wf-right">คำนำหน้าชื่อ </label>
									</div>
									<div class="col-md-2">
										<select name="USR_PREFIX" id="USR_PREFIX" class="select2 form-control" >
											<option value=""></option>
											<option value="นาย" <?php echo $_GET['USR_PREFIX'] == "นาย" ? 'selected' : ''; ?>>นาย</option>
											<option value="นางสาว" <?php echo $_GET['USR_PREFIX'] == "นางสาว" ? 'selected' : ''; ?>>นางสาว</option>
											<option value="นาง" <?php echo $_GET['USR_PREFIX'] == "นาง" ? 'selected' : ''; ?>>นาง</option>
										</select>
									</div>
									<?php }
									if($data_name["FIELD_SEARCH"] == 'Y'){
									?>
									<div class="col-md-1">
										<label for="USR_FNAME" class="form-control-label wf-right">ชื่อ </label>
									</div>
									<div class="col-md-3">
										<input type="text" id="USR_FNAME" name="USR_FNAME"  class="form-control" value="<?php echo $_GET['USR_FNAME']; ?>">
									</div>
									<?php }
									if($data_lname["FIELD_SEARCH"] == 'Y'){
									?>
									<div class="col-md-1">
										<label for="USR_LNAME" class="form-control-label wf-right">นามสกุล </label>
									</div>
									<div class="col-md-3">
										<input type="text" id="USR_LNAME" name="USR_LNAME"  class="form-control" value="<?php echo $_GET['USR_LNAME']; ?>">
									</div>
									<?php }?>
								</div>
								<!---->
								<div class="form-group row">
									<?php
									$data_s = show_field('USR_EMAIL');
									
									if($data_s["FIELD_SEARCH"] == 'Y'){
									?>
									<div class="col-md-2">
										<label for="USR_EMAIL" class="form-control-label wf-right"><?php echo $data_s["FIELD_LABEL"]; ?></label>
									</div>
									
									<div class="col-md-6">
										<input type="text" id="USR_EMAIL" name="USR_EMAIL"  class="form-control email" value="<?php echo $_GET['USR_EMAIL']; ?>" >
									</div>
									<?php }
									$data_t = show_field('USR_TEL');
									if($data_t["FIELD_SEARCH"] == 'Y'){?>
									<div class="col-md-2">
										<label for="USR_TEL" class="form-control-label wf-right"><?php echo $data_t["FIELD_LABEL"]; ?></label>
									</div>
									<div class="col-md-2">
										<input type="text" id="USR_TEL" name="USR_TEL"  class="form-control mobile" value="<?php echo $_GET['USR_TEL']; ?>" >
									</div>
									<?php }?>
								</div>
								<!---->
								<?php
								$data_d = show_field('DEP_ID');
									
								if($data_d["FIELD_SEARCH"] == 'Y'){?>
								<div class="form-group row">
									<div class="col-md-2">
										<label for="DEP_ID" class="form-control-label wf-right"><?php echo $data_d["FIELD_LABEL"]; ?></label>
									</div>
									<div class="col-md-6">
										<?php
										
										$department_data = build_data('USR_DEPARTMENT', 'DEP_ID', 'DEP_NAME');
										form_dropdown('DEP_ID', $department_data, $_GET['DEP_ID'],'');
										?>
									</div>
								</div>
									<?php }?>
								<!---->
								<?php
								$data_p = show_field('POS_ID');
									
								if($data_p["FIELD_SEARCH"] == 'Y'){?>
								<div class="form-group row">
									<div class="col-md-2">
										<label for="USR_TEL" class="form-control-label wf-right"><?php echo $data_p["FIELD_LABEL"]; ?></label>
									</div>
									<div class="col-md-6">
										<?php
										if($data_p["FIELD_REQUIRED"] == 'Y'){ $req2 = 'required';}
										$position_data = build_data('USR_POSITION', 'POS_ID', 'POS_NAME');
										form_dropdown('POS_ID', $position_data, $_GET['POS_ID'],'');
										?>
									</div>
								</div>
								<?php }?>
								<!---->
								<?php
								$data_l = show_field('USR_LINE_ID');
								if($data_l["FIELD_SEARCH"] == 'Y'){?>
								<div class="form-group row">
									<div class="col-md-2">
										<label for="USR_LINE_ID" class="form-control-label wf-right"><?php echo $data_l["FIELD_LABEL"]; ?></label>
									</div>
									<div class="col-md-4">
										<input type="text" id="USR_LINE_ID" name="USR_LINE_ID"  class="form-control" value="<?php echo $_GET['USR_LINE_ID']; ?>" >
									</div>
								</div>
								<!---->
								
								<!---->
								<?php
								}

								$sql1 = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE='O' AND FIELD_STATUS='Y' ORDER BY FIELD_ID");
								$i=1;
								while($rec_o = db::fetch_array($sql1)){	
									$wh = '';
									if($rec_o["FIELD_ID"] != '' AND $rec_o["FIELD_SEARCH"] == 'Y'){
										$sql_master = db::query("SELECT WF_MAIN_ID,WF_MAIN_NAME,WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID = '".$rec_o["WF_MAIN_ID"]."'");
										$rec_m = db::fetch_array($sql_master);
											
											
										$sql_mpk = db::query("SELECT WFS_FIELD_NAME as WFS_FIELD_NAME FROM WF_STEP_FORM WHERE WF_MAIN_ID = '". $rec_o["WF_MAIN_ID"]."' ");
										$rec_ms = db::fetch_array($sql_mpk);
										
										if($rec_o['FIELD_TEXT'] != '' AND ($rec_o['FIELD_RELETION'] == '' OR $rec_o['FIELD_RELETION'] == 'M')){
											$rec_ms["WFS_FIELD_NAME"] = $rec_o['FIELD_TEXT']; 
											
										}
										
										if($rec_o['FIELD_RELETION'] == 'T'){ //TEXT?>
											<div class="form-group row">
												<div class="col-md-2">
													<label for="USR_OPTION<?php echo $i; ?>" class="form-control-label wf-right"><?php echo $rec_o['FIELD_LABEL']; ?>
													</label>
												</div>
												<div class="col-md-4">
													<input type="text" id="USR_OPTION<?php echo $i; ?>" name="USR_OPTION<?php echo $i; ?>" class="form-control" value="<?php echo $_GET[$rec_o["FIELD_NAME"]]; ?>" >
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
													<label for="USR_OPTION<?php echo $i; ?>" class="form-control-label wf-right"><?php echo $rec_o["FIELD_LABEL"]; ?></label>
												</div>
												<div class="col-md-6">
													
													<select name="USR_OPTION<?php echo $i.$arr; ?>" id="USR_OPTION<?php echo $i; ?>" class="select2" <?php echo $multi;?>  data-placeholder="เลือก<?php echo $rec_m["WF_MAIN_NAME"]; ?>">
													<option value=""></option>
													<?php
													if($_GET["USR_OPTION".$i] != ''){
														$data = explode(',',$_GET["USR_OPTION".$i]);
													}else{
														$data = array();
														
													}
													while($data_m = db::fetch_array($sql_m_t)){
													
														if($rec_o['FIELD_RELETION'] == 'M'){
															if(in_array($data_m[$rec_m["WF_FIELD_PK"]], $data)){ $seleted = 'selected';}else{ $seleted = ''; }
														}else{
															if($data_m[$rec_m["WF_FIELD_PK"]] == $_GET["USR_OPTION".$i]){ $seleted = 'selected';}else{ $seleted = ''; }
															
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
								<?php
								$data_un = show_field('USR_USERNAME');
								
								if($data_un["FIELD_SEARCH"] == 'Y'){?>
									<div class="form-group row">
										<div class="col-md-2">
											<label for="USR_USERNAME" class="form-control-label wf-right">Username </label>
										</div>
										<div class="col-md-3">
											<input type="text" id="USR_USERNAME" name="USR_USERNAME" class="form-control" value="<?php echo $_GET['USR_USERNAME']; ?>" >
										</div>
									</div>
								<?php }?>
								<div class="form-group row">
									<div class="col-md-12 text-center"> 
										<button type="submit" name="search" id="search"  class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
										&nbsp;&nbsp;
										<button type="button" name="usr_reset" id="usr_reset"  class="btn btn-warning" onClick="window.location.href='<?php echo $url_back;?>';"><i class="zmdi zmdi-refresh-alt"></i> <?php echo $system_conf["wf_label_reset"];?></button>
										<input type="hidden" name="USR_SEARCH" id="USR_SEARCH" value="Y">
									</div>
								</div>
							</div>
							
						</form>

							<!--END SEARCH -->

					
						<?php
							if($USR_SEARCH == 'Y'){?>
							<form action="<?php echo $p_url; ?>_function.php" method="post" enctype="multipart/form-data" id="form_wf">
							<input type="hidden" name="process" id="process" value="re_order">
							<div class="card-header">
								<div class="f-right">
									<button class="btn btn-warning waves-effect waves-light" role="button">
										<i class="icofont icofont-save"></i> บันทึกสถานะ
									</button>
								</div>
							</div>
							<?php
							$sql_usr_setting = "SELECT * FROM USR_SETTING WHERE FIELD_LIST_SHOW='Y' ORDER BY FIELD_ID";
							$query_usr_s = db::query($sql_usr_setting);
							
							?>
							<div class="card-block">
								<div class="table-responsive" data-pattern="priority-columns">
									<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
										<thead>
											<tr class="bg-primary">
												<th style="width: 10%;" class="text-center" data-priority="1">Active</th>
												<th style="width: 20%;" class="text-center" data-priority="1">ชื่อ - นามสกุล</th>
												<th style="width: 20%;" class="text-center" data-priority="1">Username</th>
												<!--<th style="width: 20%;" class="text-center" data-priority="1">หน่วยงาน</th>
												<th style="width: 20%;" class="text-center" data-priority="2">ตำแหน่ง</th>-->
												<?php
												$k = 1;
												while($usr_setting = db::fetch_array($query_usr_s)){?>
													<th style="width: 20%;" class="text-center" data-priority="1"><?php echo $usr_setting["FIELD_LABEL"];?></th>
												<?php	
													$columns_data[$k] = $usr_setting["FIELD_ID"];
													$k++;
												}
												?>
												<th style="width: 20%;" class="text-center" data-priority="3">Tools</th>
												
											</tr>
										</thead>
										<tbody>
											<?php
											$i=1;
											//print_pre($columns_data);
											while($rec = db::fetch_array($sql))
											{

											?>
											<tr class="wf_keyword-box">
												<th class="text-center">
													<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
														<label class="input-checkbox checkbox-success">
															<input type="checkbox" name="USR_STATUS<?php echo $i; ?>" id="USR_STATUS<?php echo $i; ?>" <?php echo $rec['USR_STATUS'] == "Y" ? 'checked' :''; ?> value="Y">
															<span class="checkbox"></span>
														</label>
														<div class="captions"></div>
													</div>
													<input type="hidden" name="id<?php echo $i; ?>" id="id<?php echo $i; ?>" value="<?php echo $rec['USR_ID']; ?>">
												</th>
												<th class="wf_keyword">
													<?php echo $rec['USR_PREFIX'].$rec['USR_FNAME']." ".$rec['USR_LNAME']; ?>
												</th>
												<th class="wf_keyword">
													<?php echo $rec['USR_USERNAME']; ?>
												</th>
												<!--<th class="wf_keyword">
													<?php echo get_data('USR_DEPARTMENT', 'DEP_ID', 'DEP_NAME', $rec['DEP_ID']); ?>
												</th>
												<th class="wf_keyword">
													<?php echo get_data('USR_POSITION', 'POS_ID', 'POS_NAME', $rec['POS_ID']); ?>
												</th>-->
												<?php
												if(count($columns_data) > 0){
													
													foreach($columns_data as $_key=>$_val){
														
														?>
														<th class="wf_keyword">
													<?php 
														$sql_usr_set = db::query("SELECT FIELD_NAME,FIELD_RELETION,WF_MAIN_ID,FIELD_TEXT,FIELD_TYPE FROM USR_SETTING WHERE FIELD_ID='".$_val."'");
														$rec_us = db::fetch_array($sql_usr_set);
														
														
														if($rec_us['FIELD_TYPE'] == 'S'){
															if($rec_us['FIELD_NAME'] == 'DEP_ID'){
																echo get_data('USR_DEPARTMENT', 'DEP_ID', 'DEP_NAME', $rec['DEP_ID']);
																
															}elseif($rec_us['FIELD_NAME'] == 'POS_ID'){
																echo get_data('USR_POSITION', 'POS_ID', 'POS_NAME', $rec['POS_ID']);
																
															}else{
																echo $rec[$rec_us['FIELD_NAME']];
															}
															
														}elseif($rec_us['FIELD_TYPE'] == 'O'){
															
															if($rec_us['FIELD_RELETION'] == 'T'){
																echo $rec[$rec_us['FIELD_NAME']];
																
															}elseif ($rec_us['FIELD_RELETION'] == '' AND  $rec_us['WF_MAIN_ID'] != ''){
																
																$sql_m = "SELECT WF_MAIN_SHORTNAME,WF_TYPE,WF_FIELD_PK FROM WF_MAIN WHERE WF_MAIN_ID='".$rec_us["WF_MAIN_ID"]."' ";
																$query_m = db::query($sql_m);
																$rec_m = db::fetch_array($query_m);
														
																
																
																$sql_mt = "SELECT * FROM ".$rec_m["WF_MAIN_SHORTNAME"]." WHERE ".$rec_m["WF_FIELD_PK"]."='".$rec[$rec_us["FIELD_NAME"]]."'";
																$sql_m_t = db::query($sql_mt);
																if(db::num_rows($sql_mt) > 0){
																$data_m = db::fetch_array($sql_m_t);		
																
																echo bsf_show_text($rec_us["WF_MAIN_ID"],$data_m,$rec_us['FIELD_TEXT'],$rec_m["WF_TYPE"]);
																}

															}elseif ($rec_us['FIELD_RELETION'] == 'M'){

																
																$sql_m = "SELECT WF_MAIN_SHORTNAME,WF_TYPE,WF_FIELD_PK FROM WF_MAIN WHERE WF_MAIN_ID='".$rec_us["WF_MAIN_ID"]."' ";
																$query_m = db::query($sql_m);
																$rec_m = db::fetch_array($query_m);
																
																if($rec[$rec_us["FIELD_NAME"]] != ''){
																	$sql_mt = "SELECT * FROM ".$rec_m["WF_MAIN_SHORTNAME"]." WHERE ".$rec_m["WF_FIELD_PK"]." IN (".$rec[$rec_us["FIELD_NAME"]].")";
																	$sql_m_t = db::query($sql_mt);
																	$arr_data = array();
																	while($data_m = db::fetch_array($sql_m_t)){
																	
																		$arr_data[] = bsf_show_text($rec_us["WF_MAIN_ID"],$data_m,$rec_us['FIELD_TEXT'],$rec_m["WF_TYPE"]);
																		
																		
																	}
																
																	echo $data_master = implode(',',$arr_data);
																
																}
																
																/*
																$sql_mt = "SELECT * FROM ".$rec_m["WF_MAIN_SHORTNAME"]." WHERE ".$rec_m["WF_FIELD_PK"]."='".$rec[$rec_us["FIELD_NAME"]]."'";
																
																echo bsf_show_text($rec_us["WF_MAIN_ID"],$data_m,$rec_us['FIELD_TEXT'],$rec_m["WF_TYPE"]);
																}*/
																
																
																
																
																
															}else{
																if($rec_us['FIELD_NAME'] == 'DEP_ID' AND $_key['FIELD_NAME']){
																	echo get_data('USR_DEPARTMENT', 'DEP_ID', 'DEP_NAME', $rec['DEP_ID']);
																	
																}elseif($rec_us['FIELD_NAME'] == 'POS_ID'){
																	echo get_data('USR_POSITION', 'POS_ID', 'POS_NAME', $rec['POS_ID']);
																	
																}else{
																	
																	
																	
																	/*$sql_mt = "SELECT * FROM ".$rec_m["WF_MAIN_SHORTNAME"];
																	$sql_m_t = db::query($sql_mt);
																	$data_m = db::fetch_array($sql_m_t);
																	
																	///$sql_r = db::query("SELECT * FROM USR_OPTION_MASTER WHERE USR_ID='".$rec["USR_ID"]."' AND UOM_M_ID='".$rec["WF_MAIN_ID"]."' AND ");
																	$rec_m = db::fetch_array($sql_r);
																	
																	$sql_mpk = db::query("SELECT WFS_FIELD_NAME as WFS_FIELD_NAME FROM WF_STEP_FORM WHERE WF_MAIN_ID = '". $rec_us["WF_MAIN_ID"]."' ");
																	$rec_ms = db::fetch_array($sql_mpk);
																	
																	if($rec_us['FIELD_TEXT'] != '' AND ($rec_us['FIELD_RELETION'] == '' OR $rec_us['FIELD_RELETION'] == 'M')){
																		$rec_ms["WFS_FIELD_NAME"] = $rec_us['FIELD_TEXT']; 
																		
																	}
																	
																	
																	
																	
																	if($rec_us['FIELD_TEXT'] != ''){
															
																		echo bsf_show_text($rec_us["WF_MAIN_ID"],$data_m,$rec_us['FIELD_TEXT'],$rec_m["WF_TYPE"]);	
																	}else{
																		
																		echo $data_m[$rec_ms["WFS_FIELD_NAME"]];
																	}*/
																	
																}
																
															}
														}
														
													
													 ?>
														</th>
													<?php	
													}
													
												}
												?>
												<td class="text-center">
													<nobr>
														<button type="button" class="btn btn-warning btn-icon" data-toggle="tooltip" data-placement="top" title="แก้ไข <?php echo $p_name; ?>" onclick="window.location.href='<?php echo $p_url; ?>_form.php?process=edit&D=<?php echo $rec['USR_ID']; ?>';">
															<i class="icofont icofont-edit-alt"></i>
														</button> &nbsp;
														
														<button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#bizModal" title="ตั้งค่ากลุ่มสิทธิ์" onclick="open_modal('user_permission.php?U_ID=<?php echo $rec['USR_ID']; ?>','ตั้งค่ากลุ่มสิทธิ์<?php echo $p_name; ?>');">
															<i class="icon-wrench"></i>
														</button> &nbsp;
														
														<button type="button"  class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="top" title="ตั้งค่าสิทธิ์การเข้าใช้งาน" onclick="window.location.href='permission_list.php?U_ID=<?php echo $rec['USR_ID']; ?>&USR_TYPE=U';" target="_blank">
															<i class="fa fa-cog"></i>
														</button> &nbsp;
														
														
														<button type="button" class="btn btn-success btn-icon" data-toggle="tooltip" data-placement="top" title="ตั้งค่าสิทธิ์แทนกัน" onclick="window.location.href='permission_instead_list.php?U_ID=<?php echo $rec['USR_ID']; ?>';">
															<i class="icofont icofont-settings"></i>
														</button> &nbsp;
														
														<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ <?php echo $p_name; ?>" onclick="if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){window.location.href='<?php echo $p_url; ?>_function.php?process=delete&id=<?php echo $rec['USR_ID']; ?>';}">
															<i class="icofont icofont-trash"></i>
														</button>
													</nobr>
												</td>
											</tr>
											<?php $i++; } ?>
										</tbody>
									</table>
									<input type="hidden" name="total_row" id="total_row" value="<?php echo $i; ?>">
								</div>
							</div>
							</form>
							<?php }?>
						</div>
					</div>
				</div>
				<!-- Row end -->
			<!-- Container-fluid ends -->
		</div>
	</div>
<?php include '../include/combottom_js.php'; ?>
	<script src='../assets/js/jquery-sortable.js'></script>

	<script>
		$(document).ready(function()
		{
			$("#search-wf_mian").on("keyup", function()
			{

				var g = $(this).val().toLowerCase();
				$(".wf_keyword").each(function()
				{

					var s = $(this).text().toLowerCase();
					$(this).closest('.wf_keyword-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
				});
			});


		});
	</script>
<?php include '../include/combottom_admin.php'; ?>