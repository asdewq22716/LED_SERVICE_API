<?php
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$id = conText($_GET['U_ID']);


$sql = db::query("select * from USR_MAIN where USR_ID = '".$id."'");
$rec = db::fetch_array($sql);

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
							<a href="#"><?php echo $p_process; ?></a>
						</li>
					</ol>
					<div class="f-right">
						<a class="btn btn-danger waves-effect waves-light" href="<?php echo $p_url; ?>_list.php" role="button">
							<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Row end -->
		<form action="<?php echo $p_url; ?>_function.php" name="form_wf" id="form_wf" method="post" >
		<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
		<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
			<!-- Row Starts -->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header"><h5 class="card-header-text">
							<i class="typcn typcn-message"></i> ข้อมูล<?php echo $p_name; ?></h5>
					</div>
					<div class="card-block">
						<div class="form-group row">
							<div class="col-md-3">
								<label for="USR_FNAME" class="form-control-label wf-right">ชื่อ</label>
							</div>
							<div class="col-md-9">
								<?php echo $rec['USR_PREFIX'].$rec['USR_FNAME'].' '.$rec['USR_LNAME'];?>
							</div>
						</div>
						<!---->
						<div class="form-group row">
							<?php
							$data_s = show_field('USR_EMAIL');
							?>
							<div class="col-md-3">
								<label for="USR_EMAIL" class="form-control-label wf-right"><?php echo $data_s["FIELD_LABEL"]; ?></label>
							</div>
							
							<div class="col-md-4">
								<?php echo $rec['USR_EMAIL']; ?>
							</div>
							<?php 
							$data_t = show_field('USR_TEL');?>
							<div class="col-md-1">
								<label for="USR_TEL" class="form-control-label wf-right"><?php echo $data_t["FIELD_LABEL"];?></label>
							</div>
							<div class="col-md-4">
								<?php echo $rec['USR_TEL']; ?>
							</div>
						</div>
						<!---->
						
						<?php
						$sql_o = db::query("SELECT * FROM USR_SETTING WHERE ((FIELD_TYPE='O') OR (FIELD_TYPE='S' AND (FIELD_NAME = 'DEP_ID' OR FIELD_NAME='POS_ID')))  ORDER BY FIELD_ID");
	
						while($rec_o = db::fetch_array($sql_o)){
							if($rec[$rec_o["FIELD_NAME"]] != ''){
								$arr_field = show_user_detail($rec,$rec_o["FIELD_NAME"]);
								//print_pre($arr_field);
								
								?>
								
								<div class="form-group row">
									<div class="col-md-3">
										<label for="USR_FNAME" class="form-control-label wf-right"><?php echo $arr_field["label"];?></label>
									</div>
									<div class="col-md-9">
										<?php echo $arr_field["value"];?>
									</div>
								</div>
								
						<?php
							}
							
						}
						
						
						
						?>
						<div class="form-group row">
							<div class="col-md-12">
								
								<div class="card-block">
									<div class="f-right">
										<!--<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="เพิ่มสิทธิ์การเข้าใช้งานแทนกัน" onclick="open_modal('permission_instead_form.php?process=add&U_ID=<?php echo $id;?>','เพิ่มสิทธิ์การเข้าใช้งาน');"><i class="icofont icofont-ui-add"></i> เพิ่มสิทธิ์</button>-->
										
										<a class="btn btn-primary waves-effect waves-light" href="permission_instead_form.php?process=<?php echo 'permission_instead';?>&U_ID=<?php echo $id;?>" role="button">
											<i class="icofont icofont-ui-add"></i> เพิ่มสิทธิ์
										</a>
									</div>
									<h5 class="card-header-text">
										สิทธิ์ที่มีการตั้งค่าแทนกัน
									</h5>
									<div class="table-responsive" data-pattern="priority-columns">
										<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
											<thead>
												<tr class="bg-primary">
													<th class="text-center" data-priority="2" style="width:10%">ลำดับ</th>
													<th class="text-center" data-priority="1" style="width:60%">สิทธิ์การเข้าใช้งาน</th>
													<th class="text-center" data-priority="1" style="width:15%">วันที่เริ่มต้น</th>
													<th class="text-center" data-priority="1" style="width:15%">วันที่สิ้นสุด</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$sql = db::query("SELECT * FROM PERMISSION_INSTEAD WHERE USR_ID='".$id."' ORDER BY PI_STARTDATE DESC");
											$num_rows = db::num_rows($sql);
											$k=1;
											if($num_rows > 0){
											while($rec_p = db::fetch_array($sql)){
												$str = '';
											?>
												<tr class="wf_keyword-box" id="p_<?php echo $rec_p["PI_ID"];?>">
														<td class="text-center"><?php echo $k;?></td>
														<td><?php
														$sql_o = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE!='F' AND FIELD_STATUS='Y' ORDER BY FIELD_ID");
	
														while($rec_o = db::fetch_array($sql_o)){
															if($rec_p[$rec_o["FIELD_NAME"]] != ''){
																$arr_field = show_user_detail($rec_p,$rec_o["FIELD_NAME"]);
																$str .= '<li>'.$arr_field['label'].' '.$arr_field["value"].' </li>';
															}
														}
														echo $str;
														?></td>
														<td class="text-center"><?php
														echo db2date($rec_p["PI_STARTDATE"]);
														?></td>
														<td class="text-center"><?php
														echo db2date($rec_p["PI_ENDDATE"]);
														?></td>
												</tr>
											<?php $k++;}
											}else{?>
												<tr><td colspan="4" class="text-center">ไม่พบข้อมูล</td></tr>
											<?php }?>
											</tbody>
										</table>
									</div>		
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
		<!--<div class="row">
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
		</div>-->
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
