<?php
include '../include/comtop_admin.php';

$p_name = "ตั้งค่าผู้ใช้งาน"; 
$_url = "setting_user_option";

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
						<div class="card-block">
							<div class="form-group row">
								<div class="col-md-12">
									<div class="table-responsive" data-pattern="priority-columns">
										<div class="card-header">
										<h5 class="card-header-text">
											<i class="fa fa-folder-open-o"></i> มีอยู่ในระบบ แต่แก้ไขไม่ได้ 
										</h5>
										</div>
										<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
											<thead>
												<tr class="bg-primary">
													<th style="width: 35%;" class="text-center" data-priority="1">ชื่อ Field</th>
													<th style="width: 35%;" class="text-center" data-priority="3">Label</th>
													<th style="width: 10%;" class="text-center" data-priority="1">User แก้ไขเองได้</th>
													<th style="width: 10%;" class="text-center" data-priority="1">บังคับกรอกข้อมูล</th>
													<th style="width: 10%;" class="text-center" data-priority="1">ค้นหา</th>
													
												</tr>
											</thead>
											<tbody>
											<?php 
												
												$sql_f = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE='F'  ORDER BY FIELD_ID");
												$a=1;
												while($rec_f = db::fetch_array($sql_f)){?>
												
													<tr>
														
														<td><?php echo $rec_f["FIELD_NAME"]; ?>
															<input type="hidden" name="OPTION_ID<?php echo $a; ?>" id="OPTION_ID<?php echo $a; ?>" value="<?php echo $rec_f["FIELD_ID"]; ?>">
														</td>
														<td><?php echo $rec_f["FIELD_LABEL"]; ?>
															<input type="hidden" name="FIELD_LABEL<?php echo $a; ?>" id="FIELD_LABEL<?php echo $a; ?>" value="<?php echo $rec_f["FIELD_LABEL"]; ?>" >
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_EDIT<?php echo $a; ?>" id="FIELD_EDIT<?php echo $a; ?>" value="Y" <?php if($rec_f["FIELD_EDIT"] == 'Y'){ echo 'checked';}?> >
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_REQUIRED<?php echo $a; ?>" id="FIELD_REQUIRED<?php echo $a; ?>" value="Y" <?php if($rec_f["FIELD_REQUIRED"] == 'Y'){ echo 'checked';}?> >
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_SEARCH<?php echo $a; ?>" id="FIELD_SEARCH<?php echo $a; ?>" value="Y" <?php if($rec_f["FIELD_SEARCH"] == 'Y'){ echo 'checked';}?> >
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
													</tr>
												
											<?php $a++;}?>
											
											</tbody>
										</table>
										</div>
									</div>
								</div>
							</div>
						
						
						
						
						<div class="card-block">
							<div class="form-group row">
								<div class="col-md-12">
									<div class="table-responsive" data-pattern="priority-columns">
										<div class="card-header">
										<h5 class="card-header-text">
											<i class="fa fa-folder-open-o"></i> มีอยู่ในระบบ แต่แก้ไขได้ 
										</h5>
										</div>
										<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
											<thead>
												<tr class="bg-primary">
													<th style="width: 10%;" class="text-center" data-priority="1">Active</th>
													<th style="width: 20%;" class="text-center" data-priority="1">ชื่อ Field</th>
													<th style="width: 30%;" class="text-center" data-priority="3">Label</th>
													<th style="width: 10%;" class="text-center" data-priority="1">แสดงในหน้ารายการ</th>
													<th style="width: 10%;" class="text-center" data-priority="1">User แก้ไขเองได้</th>
													<th style="width: 10%;" class="text-center" data-priority="1">บังคับกรอกข้อมูล</th>
													<th style="width: 10%;" class="text-center" data-priority="1">ค้นหา</th>
													
												</tr>
											</thead>
											<tbody>
											<?php 
												
												$sql_s = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE='S'  ORDER BY FIELD_ID");
												$k=$a;
												while($rec_s = db::fetch_array($sql_s)){?>
												
												<tr>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="OPTION_USE<?php echo $k; ?>" id="OPTION_USE<?php echo $k; ?>" value="Y" <?php if($rec_s["FIELD_STATUS"] == 'Y'){ echo 'checked';}?> onClick="use_data(this,'<?php echo $k; ?>');">
																	<span class="checkbox"></span>
																	<input type="hidden" name="OPTION_ID<?php echo $k; ?>" id="OPTION_ID<?php echo $k; ?>" value="<?php echo $rec_s["FIELD_ID"]; ?>">
																</label>
																<div class="captions"></div>
															</div>
														</td>
														<td><?php echo $rec_s["FIELD_NAME"]; ?></td>
														<td class="text-center">
															<input type="text" class="form-control input-success" name="FIELD_LABEL<?php echo $k; ?>" id="FIELD_LABEL<?php echo $k; ?>" value="<?php echo $rec_s["FIELD_LABEL"]; ?>" >
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_LIST_SHOW<?php echo $k; ?>" id="FIELD_LIST_SHOW<?php echo $k; ?>" value="Y" <?php if($rec_s["FIELD_LIST_SHOW"] == 'Y'){ echo 'checked';} ?>>
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_EDIT<?php echo $k; ?>" id="FIELD_EDIT<?php echo $k; ?>" value="Y" <?php if($rec_s["FIELD_EDIT"] == 'Y'){ echo 'checked';}?> >
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_REQUIRED<?php echo $k; ?>" id="FIELD_REQUIRED<?php echo $k; ?>" value="Y" <?php if($rec_s["FIELD_REQUIRED"] == 'Y'){ echo 'checked';}?> >
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_SEARCH<?php echo $k; ?>" id="FIELD_SEARCH<?php echo $k; ?>" value="Y" <?php if($rec_s["FIELD_SEARCH"] == 'Y'){ echo 'checked';}?> >
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
													</tr>
												
											<?php $k++;}?>
											
											</tbody>
										</table>
										</div>
									</div>
								</div>
							</div>
						<div class="card-block">
							<div class="form-group row">
								<div class="col-md-12">
									<div class="table-responsive" data-pattern="priority-columns">
										<div class="card-header">
											<h5 class="card-header-text">
												<i class="fa fa-folder-open-o"></i> Option
											</h5>
										</div>
										<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
											<thead>
												<tr class="bg-primary">
													<th style="width: 3%;" class="text-center" data-priority="1">Active</th>
													<th style="width: 8%;" class="text-center" data-priority="1">option สำหรับผู้ใช้งาน</th>
													<th style="width: 15%;" class="text-center" data-priority="2">เชื่อมต่อกับ</th>
													<th style="width: 15%;" class="text-center" data-priority="3">Label</th>
													<th style="width: 8%;" class="text-center" data-priority="1">รูปแบบความสัมพันธ์</th>
													<th style="width: 7%;" class="text-center" data-priority="1">แสดงในหน้ารายการ</th>
													<th style="width: 7%;" class="text-center" data-priority="1">User แก้ไขเองได้</th>
													<th style="width: 20%;" class="text-center" data-priority="1">Field ที่จะแสดง <br>(Field ใช้ ##)</th>
													<th style="width: 20%;" class="text-center" data-priority="1">เงื่อนไขการเรียกข้อมูล <br>(ไม่ต้องใส่ WHERE)</th>
													<th style="width: 6%;" class="text-center" data-priority="1">บังคับกรอกข้อมูล</th>
													<th style="width: 6%;" class="text-center" data-priority="1">ค้นหา</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												
												//for($i=1;$i<=10;$i++){ 
												$sql = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE='O' ORDER BY FIELD_ID");
												$i = $k;
												while($rec = db::fetch_array($sql)){
												?>
													<tr>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="OPTION_USE<?php echo $i; ?>" id="OPTION_USE<?php echo $i; ?>" value="Y" <?php if($rec["FIELD_STATUS"] == 'Y'){ echo 'checked';}?> onClick="use_data(this,'<?php echo $i; ?>');">
																	<span class="checkbox"></span>
																	<input type="hidden" name="OPTION_ID<?php echo $i; ?>" id="OPTION_ID<?php echo $i; ?>" value="<?php echo $rec["FIELD_ID"]; ?>">
																</label>
																<div class="captions"></div>
															</div>
														</td>
														<td><?php echo $rec["FIELD_NAME"]; ?></td>
														<td>
															<select class="select2" name="MASTER_ID<?php echo $i; ?>" id="MASTER_ID<?php echo $i; ?>" >
																<option value="0">-</option>
																<?php
																  $sql_m = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_STATUS = 'Y' AND WF_TYPE='M' ORDER BY WF_MAIN_ORDER ASC ");
																	while($M = db::fetch_array($sql_m)){
																		?><option value="<?php echo $M['WF_MAIN_ID'];?>" <?php if($rec["WF_MAIN_ID"] == $M['WF_MAIN_ID']){ echo "selected"; } ?>><?php echo $M["WF_MAIN_NAME"]; ?></option>
																	<?php } ?>
															</select>
														</td>
														<td class="text-center">
															<input type="text" class="form-control input-success" name="FIELD_LABEL<?php echo $i; ?>" id="FIELD_LABEL<?php echo $i; ?>" value="<?php echo $rec["FIELD_LABEL"]; ?>" >
														</td>
														<td>
															
															<select name="OPTION_RELATION<?php echo $i; ?>" id="OPTION_RELATION<?php echo $i; ?>" class="form-control"  >
																<option value="" <?php if($rec["FIELD_RELETION"] == ''){ echo 'selected';}?>>1:1</option>
																<option value="M" <?php if($rec["FIELD_RELETION"] == 'M'){ echo 'selected';}?>>1:M</option>
																<option value="T" <?php if($rec["FIELD_RELETION"] == 'T'){ echo 'selected';}?>>TEXT</option>
															</select>
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_LIST_SHOW<?php echo $i; ?>" id="FIELD_LIST_SHOW<?php echo $i; ?>" value="Y" <?php if($rec["FIELD_LIST_SHOW"] == 'Y'){ echo 'checked';} ?>>
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_EDIT<?php echo $i; ?>" id="FIELD_EDIT<?php echo $i; ?>" value="Y" <?php if($rec["FIELD_EDIT"] == 'Y'){ echo 'checked';}?> >
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
														<td class="text-center">
															<input type="text" class="form-control input-success" name="FIELD_TEXT<?php echo $i; ?>" id="FIELD_TEXT<?php echo $i; ?>" value="<?php echo $rec["FIELD_TEXT"]; ?>" >
														</td>
														<td class="text-center">
															<textarea class="form-control input-success" name="FIELD_STATEMENT<?php echo $i; ?>" id="FIELD_STATEMENT<?php echo $i; ?>"><?php echo $rec["FIELD_STATEMENT"]; ?></textarea>
															
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_REQUIRED<?php echo $i; ?>" id="FIELD_REQUIRED<?php echo $i; ?>" value="Y" <?php if($rec["FIELD_REQUIRED"] == 'Y'){ echo 'checked';}?> >
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
														<td class="text-center">
															<div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
																<label class="input-checkbox checkbox-success">
																	<input type="checkbox" name="FIELD_SEARCH<?php echo $i; ?>" id="FIELD_SEARCH<?php echo $i; ?>" value="Y" <?php if($rec["FIELD_SEARCH"] == 'Y'){ echo 'checked';}?> >
																	<span class="checkbox"></span>
																</label>
																<div class="captions"></div>
															</div>
														</td>
													</tr>
												
												<?php
													$i++;}
												//}
												?>
												<tr>
													<td class="text-center" colspan="11">
														<input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="บันทึก" />
														<input type="hidden" name="num_rows" id="num_rows" value="<?php echo $i; ?>" />
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</form>
                </div>
            </div>
        <!-- Container-fluid ends -->
     </div>
</div>
<?php include '../include/combottom_js.php'; ?>

<!-- custom js -->
<?php include "inc_js_step_form.php"; ?>

<?php include '../include/combottom_admin.php'; ?>