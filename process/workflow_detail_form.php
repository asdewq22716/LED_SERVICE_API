<?php
$WF_TYPE='W';
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);

$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."'");
$rec_detail = db::fetch_array($sql_detail);

$detail_in_wf = build_data('WF_DETAIL', 'WFD_ID', 'WFD_NAME', "WF_MAIN_ID = '".$W."' and WFD_ID != '".$WFD."' ");
if($process == "add")
{
	$p_process = "เพิ่ม";
	$mx = db::get_max("WF_DETAIL", "WFD_ORDER", array('WF_MAIN_ID' => $W)) + 1;

	$wf_if_start = count_data("WF_DETAIL", "*", "WF_MAIN_ID = '".$W."' AND WFD_TYPE = 'S' ");

	if($wf_if_start == 0)
	{
		$wfd_type = "S";
	}
	else
	{
		$wfd_type = "P";
	}
}
elseif($process == "edit")
{
	$p_process = "แก้ไข";
	$mx = $rec_detail['WFD_ORDER'];

	$wfd_type = $rec_detail['WFD_TYPE'];
}
?>

    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<h4><?php echo $rec['WF_MAIN_NAME']; ?></h4>
							<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
								<li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a></li>
								<li class="breadcrumb-item"><a href="workflow.php">บริหาร Workflow</a></li>
								<li class="breadcrumb-item"><a href="workflow_detail.php?W=<?php echo $W; ?>">บริหารขั้นตอน</a></li>
								<li class="breadcrumb-item"><a href="#"><?php echo $p_process; ?>ขั้นตอน</a></li>
							</ol>
						<div class="f-right">
							<?php if($process == "edit"){ ?>
							<a class="btn btn-success waves-effect waves-light" href="workflow_step_form.php?W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>" role="button"><i class="typcn typcn-th-list"></i> ตั้งค่า Field </a>&nbsp;
							<?php } ?>
							<a class="btn btn-danger waves-effect waves-light" href="workflow_detail.php?W=<?php echo $W; ?>" role="button"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ </a>
							
						</div>
					</div>
				</div>
			</div>
            <!-- Row end -->
			<form action="workflow_detail_function.php" method="post" enctype="multipart/form-data" id="form_wf" autocomplete="off">
				<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
				<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
				<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD; ?>">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<!-- Radio-Button start -->
					<div class="card-block tab-icon">
						 <!-- Nav tabs -->
							<ul class="nav nav-tabs md-tabs " role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tabgeneral" role="tab"><i class="typcn typcn-message"></i>ข้อมูลทั่วไป</a>
									<div class="slide"></div>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tabsetting" role="tab"><i class="typcn typcn-input-checked-outline"></i>ตั้งค่าการแสดงผล</a>
									<div class="slide"></div>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tabpermission" role="tab"><i class="typcn typcn-lock-open-outline"></i>ตั้งค่าสิทธิ์</a>
									<div class="slide"></div>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tabtrow" role="tab"><i class="typcn typcn-export"></i>ตั้งค่าการโยนค่าไปกระบวนการอื่น</a>
									<div class="slide"></div>
								</li>

							</ul>
							<!-- Tab panes -->
			<div class="tab-content">
            <!-- Row Starts -->
            <div class="row tab-pane active" id="tabgeneral" role="tabpanel">
                <div class="col-md-12">
                    <div class="card_bk">
						 <div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  ข้อมูลทั่วไป</h5>
						</div>
						<div class="card-block">
							<div class="col-md-8">
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
									  <label for="WFD_NAME" class="form-control-label wf-right">ชื่อขั้นตอน<span class="text-danger">*</span></label>
								  </div>
								  <div class="col-md-8">
									  <input type="text" class="form-control" name="WFD_NAME" id="WFD_NAME" value="<?php echo $rec_detail['WFD_NAME']; ?>"  placeholder="ตั้งชื่อขั้นตอน" required>
								  </div>
								</div>
								<!---->
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
									  <label for="DETAIL_G_ID" class="form-control-label wf-right">กลุ่มของขั้นตอน</label>
								  </div>
								  <div class="col-md-8">
										<select class="select2 form-control"  name="DETAIL_G_ID" id="DETAIL_G_ID">
											<option value="0">ไม่มีกลุ่ม</option>
											<?php
											$sql_detail = db::query("SELECT * FROM WF_DETAIL_GROUP WHERE WF_MAIN_ID='".$W."' ORDER BY DETAIL_G_ORDER ");
											while($detail = db::fetch_array($sql_detail)){?>
												<option value="<?php echo $detail["DETAIL_G_ID"];?>" <?php if($detail["DETAIL_G_ID"] == $rec_detail["DETAIL_G_ID"]){ echo 'selected';}?>><?php echo $detail["DETAIL_G_NAME"];?></option>
											<?php }?> 
										</select>
								  </div>
								</div>
								<!---->
								<div class="form-group row" style="display: none;">
								  <div class="col-md-3">
									  <label for="WFD_ORDER" class="form-control-label wf-right">ลำดับ</label>
								  </div>
								  <div class="col-md-2">
									  <input type="number" class="form-control" name="WFD_ORDER" id="WFD_ORDER" value="<?php echo $mx; ?>">
								  </div>
								</div>
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
									  <label for="WFD_TYPE" class="form-control-label wf-right">ลักษณะขั้นตอน </label>
								  </div>
								  <div class="col-md-8">
									
									  <?php
									  /*$js_wfd_type = "onchange=\"switch_type(this.value)\"";
									  form_dropdown('WFD_TYPE', $arr_wf_detail_type, $wfd_type, $js_wfd_type);*/
									  $sql_step_s = db::query("SELECT WFD_ID FROM WF_DETAIL WHERE WF_MAIN_ID = '".$W."' AND WFD_TYPE='S' AND WFD_ID != '".$WFD."'");
									  $detail_s = db::fetch_array($sql_step_s);
									  ?>
									<select name="WFD_TYPE" id="WFD_TYPE" class="select2 form-control" onchange="switch_type(this.value)">
										<option value=""></option>
										<?php
										if($detail_s["WFD_ID"] == ''){
										?>
										<option value="S" <?php if($wfd_type == 'S'){ echo 'selected';}?>>เริ่มกระบวนงาน</option>
										<?php }?>
										<option value="P" <?php if($wfd_type == 'P'){ echo 'selected';}?>>กระบวนงาน</option>
										<option value="E" <?php if($wfd_type == 'E'){ echo 'selected';}?>>จบกระบวนงาน</option>
										<option value="T" <?php if($wfd_type == 'T'){ echo 'selected';}?>>โยนค่าไปกระบวนการอื่น</option>
									</select>
								  </div>
								</div>
								 <!---->
								 <div class="form-group row">
								  <div class="col-md-3">
									  <label for="WF_DETAIL" class="form-control-label wf-right">Default ขั้นตอนถัดไป</label>
								  </div>
								  <div class="col-md-8">
									  <?php
									  form_dropdown('WFD_DEFAULT_STEP', $detail_in_wf, $rec_detail['WFD_DEFAULT_STEP']);
									  ?>
								  </div>
								</div>
								 <!---->
								<div class="form-group row">
								  <div class="col-md-3">
									<label for="WFD_AFTER_SAVE" class="form-control-label wf-right">บันทึกเสร็จให้ไปหน้า</label>
								  </div>
								  <div class="col-md-8">
									<input type="text" class="form-control" name="WFD_AFTER_SAVE" id="WFD_AFTER_SAVE" value="<?php echo $rec_detail['WFD_AFTER_SAVE']; ?>" placeholder="URL">
									<small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
									 
								  </div>
								</div>
								<!---->
							</div>
							<div class="col-md-4">
								<!---->
								<div class="form-group row">
									<div class="col-md-12">
										<div class="checkbox-color checkbox-primary">
											<input name="WFD_TAB_STATUS" id="WFD_TAB_STATUS" type="checkbox" value="Y" <?php echo $rec_detail['WFD_TAB_STATUS'] == "Y" ? 'checked' : ''; ?>>
											<label for="WFD_TAB_STATUS">
												ใช้งาน Tab ในหน้า form
											</label>
										</div>
									</div>
								</div>
								<!---->
								<div class="form-group row">
									<div class="col-md-12">
										<div class="checkbox-color checkbox-primary">
											<input name="WFD_CONTINUE_NEXT_STEP" id="WFD_CONTINUE_NEXT_STEP" type="checkbox" value="Y" <?php echo $rec_detail['WFD_CONTINUE_NEXT_STEP'] == "Y" ? 'checked' : ''; ?>>
											<label for="WFD_CONTINUE_NEXT_STEP">
												หลังจากบันทึก ไปขั้นตอนถัดไปทันที
											</label>
										</div>
									</div>
								</div>
								<!---->
								<div class="form-group row">
									<div class="col-md-12">
										<div class="checkbox-color checkbox-primary">
											<input name="WFD_VIEW_PREVIOUS_STEP" id="WFD_VIEW_PREVIOUS_STEP" type="checkbox" value="Y" <?php echo $rec_detail['WFD_VIEW_PREVIOUS_STEP'] == "Y" || $rec_detail['WFD_VIEW_PREVIOUS_STEP'] == "" ? 'checked' : ''; ?>>
											<label for="WFD_VIEW_PREVIOUS_STEP">
												แสดงขั้นตอนนี้ในหน้ารายละเอียดย้อนหลัง
											</label>
										</div>
									</div>
								</div>
								<!---->
								<div class="form-group row">
									<div class="col-md-12">
										<div class="checkbox-color checkbox-primary">
											<input name="WFD_AUTO_SUBMIT" id="WFD_AUTO_SUBMIT" type="checkbox" value="Y" <?php echo $rec_detail['WFD_AUTO_SUBMIT'] == "Y" ? 'checked' : ''; ?>>
											<label for="WFD_AUTO_SUBMIT">
												Auto Submit
											</label>
										</div>
									</div>
								</div>
								<!---->
								<div class="form-group row">
									<div class="col-md-12">
										<div class="checkbox-color checkbox-primary">
											<input name="WFD_ALERT_STEP" id="WFD_ALERT_STEP" type="checkbox" value="Y" <?php echo $rec_detail['WFD_ALERT_STEP'] == "Y" ? 'checked' : ''; ?> <?php if($system_conf['wf_line_token_access'] == ""){ echo " disabled"; } ?>>
											<label for="WFD_ALERT_STEP">
												มีการแจ้งเตือนเมื่อถึงขั้นตอนนี้
											</label>
										</div>
									</div>
								</div>
								<!---->
								<div class="form-group">
									<label for="WFD_ALERT_BEFORE_SUBMIT" class="form-control-label">ข้อความยืนยันก่อน Submit</label>
									<textarea name="WFD_ALERT_BEFORE_SUBMIT" id="WFD_ALERT_BEFORE_SUBMIT" class="form-control" rows="3"><?php echo $rec_detail['WFD_ALERT_BEFORE_SUBMIT']; ?></textarea>
								</div>
								<!---->
							</div>
							
						</div>	
                    </div>
                </div>

            </div>
            <!-- Row end -->
			<div class="row tab-pane" id="tabtrow" role="tabpanel">
			<!-- Row Starts -->
            <div id="row_t" style="display: <?php echo ($wfd_type == 'T')?'':'none';?>">
				<div class="col-md-12">
                    <div class="card_bk">
                        <div class="card-header">
							<h5 class="card-header-text"><i class="typcn typcn-export"></i> โยนค่าไปกระบวนการอื่น</h5>
                        </div>
                        <div class="card-block">
							<!---->
							<div class="form-group row">
							  <div class="col-md-6 p-l-30">
									<label class="form-control-label"><i class="typcn typcn-database"></i> กระบวนงานต้นทาง</label>
									<blockquote class="blockquote">
									<p class="m-b-0"><label class="label bg-primary"><i class="typcn typcn-flow-children"></i>  งานที่มอบหมาย</label></p>
									</blockquote>
							  </div>
							  <div class="col-md-6">
								<label for="WFD_THROW_ID" class="form-control-label">ชื่อกระบวนงานที่ต้องการโยนค่าไป </label> 
									<select name="WFD_THROW_ID" id="WFD_THROW_ID" class="form-control select2">
									<option value="" disabled>ข้อมูล Master</option>
									 <?php
										$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'M' ORDER BY WF_MAIN_ORDER");
										
										while($rec_m = db::fetch_array($sql_list)){	?>
											<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec_detail['WFD_THROW_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
										<?php } ?> 
										<option value="" disabled>ข้อมูล Workflow</option> <?php
										$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W' ORDER BY WF_MAIN_ORDER");
										
										while($rec_m = db::fetch_array($sql_list)){?>
											<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec_detail['WFD_THROW_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
										<?php } ?> 
										<option value="" disabled>ข้อมูล Report</option> <?php
										$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'R' ORDER BY WF_MAIN_ORDER");
										
										while($rec_m = db::fetch_array($sql_list)){?>
											<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec_detail['WFD_THROW_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
										<?php } ?> 
									</select>
									
									<div class="checkbox-color checkbox-primary">
										<input name="WFD_THROW_NEXT_STEP" id="WFD_THROW_NEXT_STEP" type="checkbox" value="Y" <?php if($rec_detail['WFD_THROW_NEXT_STEP'] == 'Y'){ echo 'checked';} ?>>
										<label for="WFD_THROW_NEXT_STEP">
											กรณีโยนค่าไปยัง Workflow ให้ไปขั้นตอนถัดไป
										</label>
									</div>
									
								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group">
								<div class="col-md-6">
									<label for="InputNormal" class="form-control-label">Field ต้นทาง</label>
									<input type="text" class="form-control" name="WFD_THROW_FIELD_SOURCE" id="WFD_THROW_FIELD_SOURCE" value="<?php echo $rec_detail['WFD_THROW_FIELD_SOURCE']; ?>" >
									<small class="form-text text-muted">ตัวแปรที่ต้องการโยนค่ามากกว่า 1 Field คั่นด้วย " , "</small>
								</div>
								<div class="col-md-6">
									<label for="InputNormal" class="form-control-label">Field ปลายทาง</label>
									<input type="text" class="form-control" name="WFD_THROW_F_DESTINATION" id="WFD_THROW_F_DESTINATION" value="<?php echo $rec_detail['WFD_THROW_FIELD_DESTINATION']; ?>" >
									
								</div>
								
								</div>
							<!---->	
                        </div>
                    </div>
                </div>
				
            </div>
            <!-- Row end -->
			 
			</div>
			<!-- Row Starts -->
            <div class="row tab-pane" id="tabsetting" role="tabpanel">
                <div class="col-md-8">
                    <div class="card_bk">
						<div class="card-header">
							<h5 class="card-header-text"><i class="typcn typcn-input-checked-outline"></i> ตั้งค่าการแสดงผลปุ่ม</h5>
                        </div>
                        <div class="card-block">
							<!---->	
							<div class="table-responsive" data-pattern="priority-columns">
							<table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered">
								<thead>
								<tr class="bg-primary">
									<th width="25%">แสดง/ซ่อน</th>
									<th width="10%"><nobr>ย่อปุ่ม</nobr></th>
									<th width="30%">เปลี่ยน Label</th>
									<th>สร้าง Link เอง</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td><div class="checkbox-color checkbox-primary">
										<input name="WFD_BTN_ADD_STATUS" id="WFD_BTN_ADD_STATUS" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_ADD_STATUS'] == 'Y' || $rec_detail['WFD_BTN_ADD_STATUS'] == ""){ echo 'checked';} ?>>
										<label for="WFD_BTN_ADD_STATUS">
											ปุ่ม<?php echo $WF_TEXT_DETAIL_BACK;?>
										</label>
									</div>
									</td>
									<td class="text-center">
										<div class="checkbox-color checkbox-danger">
										<input name="WFD_BTN_ADD_RESIZE" id="WFD_BTN_ADD_RESIZE" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_ADD_RESIZE'] == 'Y' ){ echo 'checked';} ?>>
										<label for="WFD_BTN_ADD_RESIZE">&nbsp;</label>
									</div>
									</td>
									<td><input type="text" name="WFD_BTN_ADD_LABEL" id="WFD_BTN_ADD_LABEL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_DETAIL_BACK;?>" value="<?php echo $rec_detail['WFD_BTN_ADD_LABEL']; ?>"></td>
									<td><input type="text" name="WFD_BTN_ADD_LINK" id="WFD_BTN_ADD_LINK" class="form-control text-primary" value="<?php echo $rec_detail['WFD_BTN_ADD_LINK']; ?>"></td>
								</tr>
								<tr>
									<td><div class="checkbox-color checkbox-primary">
										<input name="WFD_BTN_BACK_STATUS" id="WFD_BTN_BACK_STATUS" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_BACK_STATUS'] == 'Y'){ echo 'checked';} ?>>
										<label for="WFD_BTN_BACK_STATUS">
											ปุ่ม<?php echo $WF_TEXT_DETAIL_PROCESS_BACK;?>
										</label>
									</div>
									</td>
									<td class="text-center">
										<div class="checkbox-color checkbox-danger">
										<input name="WFD_BTN_BACK_RESIZE" id="WFD_BTN_BACK_RESIZE" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_BACK_RESIZE'] == 'Y' ){ echo 'checked';} ?>>
										<label for="WFD_BTN_BACK_RESIZE">&nbsp;</label>
									</div>
									</td>
									<td><input type="text" name="WFD_BTN_BACK_LABEL" id="WFD_BTN_BACK_LABEL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_DETAIL_PROCESS_BACK;?>" value="<?php echo $rec_detail['WFD_BTN_BACK_LABEL']; ?>"></td>
									<td><input type="text" name="WFD_BTN_BACK_LINK" id="WFD_BTN_BACK_LINK" class="form-control text-primary" value="<?php echo $rec_detail['WFD_BTN_BACK_LINK']; ?>"></td>
								</tr>
								<tr>
									<td><div class="checkbox-color checkbox-primary">
										<input name="WFD_BTN_TEMP_STATUS" id="WFD_BTN_TEMP_STATUS" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_TEMP_STATUS'] == 'Y' || $rec_detail['WFD_BTN_TEMP_STATUS'] == ""){ echo 'checked';} ?>>
										<label for="WFD_BTN_TEMP_STATUS">
											ปุ่ม<?php echo $WF_TEXT_DETAIL_SAVE_TEMP;?>
										</label>
									</div>
									</td>
									<td class="text-center">
										<div class="checkbox-color checkbox-danger">
										<input name="WFD_BTN_TEMP_RESIZE" id="WFD_BTN_TEMP_RESIZE" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_TEMP_RESIZE'] == 'Y' ){ echo 'checked';} ?>>
										<label for="WFD_BTN_TEMP_RESIZE">&nbsp;</label>
									</div>
									</td>
									<td><input type="text" name="WFD_BTN_TEMP_LABEL" id="WFD_BTN_TEMP_LABEL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_DETAIL_SAVE_TEMP;?>" value="<?php echo $rec_detail['WFD_BTN_TEMP_LABEL']; ?>"></td>
									<td><input type="text" name="WFD_BTN_TEMP_LINK" id="WFD_BTN_TEMP_LINK" class="form-control text-primary" value="<?php echo $rec_detail['WFD_BTN_TEMP_LINK']; ?>"></td>
								</tr>
								<tr>
									<td><div class="checkbox-color checkbox-primary">
										<input name="WFD_BTN_SAVE_STATUS" id="WFD_BTN_SAVE_STATUS" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_SAVE_STATUS'] == 'Y' || $rec_detail['WFD_BTN_SAVE_STATUS'] == ""){ echo 'checked';} ?>>
										<label for="WFD_BTN_SAVE_STATUS">
											ปุ่ม<?php echo $WF_TEXT_DETAIL_SAVE;?>
										</label>
									</div>
									</td>
									<td class="text-center">
										<div class="checkbox-color checkbox-danger">
										<input name="WFD_BTN_SAVE_RESIZE" id="WFD_BTN_SAVE_RESIZE" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_SAVE_RESIZE'] == 'Y' ){ echo 'checked';} ?>>
										<label for="WFD_BTN_SAVE_RESIZE">&nbsp;</label>
									</div>
									</td>
									<td><input type="text" name="WFD_BTN_SAVE_LABEL" id="WFD_BTN_SAVE_LABEL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_DETAIL_SAVE;?>" value="<?php echo $rec_detail['WFD_BTN_SAVE_LABEL']; ?>"></td>
									<td><input type="text" name="WFD_BTN_SAVE_LINK" id="WFD_BTN_SAVE_LINK" class="form-control text-primary" value="<?php echo $rec_detail['WFD_BTN_SAVE_LINK']; ?>"></td>
								</tr>
								<tr>
									<td><div class="checkbox-color checkbox-primary">
										<input name="WFD_BTN_CON_STATUS" id="WFD_BTN_CON_STATUS" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_CON_STATUS'] == 'Y' || $rec_detail['WFD_BTN_CON_STATUS'] == ""){ echo 'checked';} ?>>
										<label for="WFD_BTN_CON_STATUS">
											ปุ่ม<?php echo $WF_TEXT_DETAIL_PROCESS;?>
										</label>
									</div>
									</td>
									<td class="text-center">
										<div class="checkbox-color checkbox-danger">
										<input name="WFD_BTN_CON_RESIZE" id="WFD_BTN_CON_RESIZE" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_CON_RESIZE'] == 'Y' ){ echo 'checked';} ?>>
										<label for="WFD_BTN_CON_RESIZE">&nbsp;</label>
									</div>
									</td>
									<td><input type="text" name="WFD_BTN_CON_LABEL" id="WFD_BTN_CON_LABEL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_DETAIL_PROCESS;?>" value="<?php echo $rec_detail['WFD_BTN_CON_LABEL']; ?>"></td>
									<td><input type="text" name="WFD_BTN_CON_LINK" id="WFD_BTN_CON_LINK" class="form-control text-primary" value="<?php echo $rec_detail['WFD_BTN_CON_LINK']; ?>"></td>
								</tr>
								<tr>
									<td><div class="checkbox-color checkbox-primary">
										<input name="WFD_BTN_ATTACH_STATUS" id="WFD_BTN_ATTACH_STATUS" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_ATTACH_STATUS'] == 'Y' ){ echo 'checked';} ?>>
										<label for="WFD_BTN_ATTACH_STATUS">
											ปุ่ม<?php echo $WF_TEXT_DETAIL_ATTACH;?>
										</label>
									</div>
									</td>
									<td class="text-center">
										<div class="checkbox-color checkbox-danger">
										<input name="WFD_BTN_ATTACH_RESIZE" id="WFD_BTN_ATTACH_RESIZE" type="checkbox" value="Y" <?php if($rec_detail['WFD_BTN_ATTACH_RESIZE'] == 'Y' ){ echo 'checked';} ?>>
										<label for="WFD_BTN_ATTACH_RESIZE">&nbsp;</label>
									</div>
									</td>
									<td><input type="text" name="WFD_BTN_ATTACH_LABEL" id="WFD_BTN_ATTACH_LABEL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_DETAIL_ATTACH;?>" value="<?php echo $rec_detail['WFD_BTN_ATTACH_LABEL']; ?>"></td>
									<td><input type="text" name="WFD_BTN_ATTACH_LINK" id="WFD_BTN_ATTACH_LINK" class="form-control text-primary" value="<?php echo $rec_detail['WFD_BTN_ATTACH_LINK']; ?>"></td>
								</tr>
								
								</tbody>
							</table>
							</div>
							<!---->	
							<div class="form-group row">
								<div class="col-md-6">
									<label for="WFD_TOP_INCLUDE_N" class="form-control-label">File Include ส่วนบน</label>
									<?php if($rec_detail['WFD_TOP_INCLUDE'] != ""){ ?>
							<a href="#!" data-toggle="modal" data-target="#bizModal" onclick="open_modal('wf_editor.php?p=<?php echo wf_encode(wf_encode('../plugin/'.$rec_detail['WFD_TOP_INCLUDE'])); ?>', 'Editor : <?php echo $rec_detail['WFD_TOP_INCLUDE']; ?>')">
							<i class="fa fa-edit"></i></a><?php } ?>
									 <input type="text" class="form-control" name="WFD_TOP_INCLUDE" id="WFD_TOP_INCLUDE" value="<?php echo $rec_detail['WFD_TOP_INCLUDE']; ?>">
									 <small  class="form-text text-muted">ไฟล์จะถูกเก็บไว้ที่  ../plugin</small>
								</div>
								<div class="col-md-6">
									<label for="WFD_TOP_INCLUDE_N" class="form-control-label">&nbsp;</label>
									<div class="md-group-add-on">
									  <span class="md-add-on-file">
										  <button class="btn btn-primary waves-effect waves-light"><i class="typcn typcn-image-outline"></i> เลือก File php ในเครื่อง</button>
									  </span>
										<div class="md-input-file">
											<input type="file" name="WFD_TOP_INCLUDE_N" id="WFD_TOP_INCLUDE_N" class="" />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-6">
									<label for="WFD_BOTTOM_INCLUDE_N" class="form-control-label">File Include ส่วนล่าง</label>
								 <?php if($rec_detail['WFD_BOTTOM_INCLUDE'] != ""){ ?>
							<a href="#!" data-toggle="modal" data-target="#bizModal" onclick="open_modal('wf_editor.php?p=<?php echo wf_encode(wf_encode('../plugin/'.$rec_detail['WFD_BOTTOM_INCLUDE'])); ?>', 'Editor : <?php echo $rec_detail['WFD_BOTTOM_INCLUDE']; ?>')">
							<i class="fa fa-edit"></i></a><?php } ?>
									 <input type="text" class="form-control" name="WFD_BOTTOM_INCLUDE" id="WFD_BOTTOM_INCLUDE" value="<?php echo $rec_detail['WFD_BOTTOM_INCLUDE']; ?>">
									 <small  class="form-text text-muted">ไฟล์จะถูกเก็บไว้ที่  ../plugin</small>
								</div>
								<div class="col-md-6">
									<label for="WFD_BOTTOM_INCLUDE_N" class="form-control-label">&nbsp;</label>
									<div class="md-group-add-on">
									  <span class="md-add-on-file">
										  <button class="btn btn-primary waves-effect waves-light"><i class="typcn typcn-image-outline"></i> เลือก File php ในเครื่อง</button>
									  </span>
										<div class="md-input-file">
											<input type="file" name="WFD_BOTTOM_INCLUDE_N" id="WFD_BOTTOM_INCLUDE_N" class="" />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>
								</div>
							</div>
							<!---->
							
						</div>
                    </div>
                </div>
				<!---->	
				<div class="col-md-4">
                    <div class="card_bk">
                        <div class="card-header">
							<h5 class="card-header-text"><i class="typcn typcn-code-outline"></i> ตั้งค่าหัวข้อในหน้ารายละเอียดเฉพาะขั้นตอนนี้</h5>
                        </div>
                        <div class="card-block">
							<!---->
							<div class="form-group row">
								<div class="col-md-4">
									<label for="WFD_DETAIL_TOPIC" class="form-control-label">หัวข้อ</label>
								</div>
								<div class="col-md-8 text-right">
									<div class="input-group">
										<div data-toggle="buttons">
											<div class="btn-group">
												<label class="btn btn-success <?php echo $rec['WFD_DETAIL_TOPIC_ALIGN'] == "L" ? 'active' : ''; ?>"><input type="radio" name="WFD_DETAIL_TOPIC_ALIGN" id="WFD_DETAIL_TOPIC_ALIGN" value="L" <?php echo $rec['WFD_DETAIL_TOPIC_ALIGN'] == "L" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-left"></i></label>
												<label class="btn btn-success <?php echo $rec['WFD_DETAIL_TOPIC_ALIGN'] == "C" ? 'active' : ''; ?>"><input type="radio" name="WFD_DETAIL_TOPIC_ALIGN" id="WFD_DETAIL_TOPIC_ALIGN" value="C" <?php echo $rec['WFD_DETAIL_TOPIC_ALIGN'] == "C" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-center"></i></label>
												<label class="btn btn-success <?php echo $rec['WFD_DETAIL_TOPIC_ALIGN'] == "R" ? 'active' : ''; ?>"><input type="radio" name="WFD_DETAIL_TOPIC_ALIGN" id="WFD_DETAIL_TOPIC_ALIGN" value="R" <?php echo $rec['WFD_DETAIL_TOPIC_ALIGN'] == "R" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-right"></i></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!---->
							<div class="form-group">
								  <textarea name="WFD_DETAIL_TOPIC" id="WFD_DETAIL_TOPIC" class="form-control" rows="5"><?php echo nl2br($rec_detail['WFD_DETAIL_TOPIC']); ?></textarea>
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-4">
									<label for="WFD_DETAIL_DESC" class="form-control-label">รายละเอียด</label>
								</div>
								<div class="col-md-8 text-right">
									<div class="input-group">
										<div data-toggle="buttons">
											<div class="btn-group">
												<label class="btn btn-success <?php echo $rec['WFD_DETAIL_DESC_ALIGN'] == "L" ? 'active' : ''; ?>"><input type="radio" name="WFD_DETAIL_DESC_ALIGN" id="WFD_DETAIL_DESC_ALIGN" value="L" <?php echo $rec['WFD_DETAIL_DESC_ALIGN'] == "L" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-left"></i></label>
												<label class="btn btn-success <?php echo $rec['WFD_DETAIL_DESC_ALIGN'] == "C" ? 'active' : ''; ?>"><input type="radio" name="WFD_DETAIL_DESC_ALIGN" id="WFD_DETAIL_DESC_ALIGN" value="C" <?php echo $rec['WFD_DETAIL_DESC_ALIGN'] == "C" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-center"></i></label>
												<label class="btn btn-success <?php echo $rec['WFD_DETAIL_DESC_ALIGN'] == "R" ? 'active' : ''; ?>"><input type="radio" name="WFD_DETAIL_DESC_ALIGN" id="WFD_DETAIL_DESC_ALIGN" value="R" <?php echo $rec['WFD_DETAIL_DESC_ALIGN'] == "R" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-right"></i></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!---->
							<div class="form-group">
								  <textarea name="WFD_DETAIL_DESC" id="WFD_DETAIL_DESC" class="form-control" rows="5"><?php echo nl2br($rec_detail['WFD_DETAIL_DESC']); ?></textarea>
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
							</div>
							<!---->	
							
							<div class="form-group row">
								<div class="col-md-6">
									<label for="WFD_CHANGE_FLOW_NAME" class="form-control-label">เปลี่ยนชื่อระบบในการแสดงผล</label>
								</div>
								<div class="col-md-6 text-right"></div>
							</div>
							<div class="form-group">
								  <textarea name="WFD_CHANGE_FLOW_NAME" id="WFD_CHANGE_FLOW_NAME" class="form-control" rows="5"><?php echo $rec_detail['WFD_CHANGE_FLOW_NAME']; ?></textarea>
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small> 
							</div>
							<!---->	 
							<div class="form-group row">
								<div class="col-md-6">
									<label for="WFD_CHANGE_STEP_NAME" class="form-control-label">เปลี่ยนชื่อขั้นตอนในการแสดงผล</label>
								</div>
								<div class="col-md-6 text-right"></div>
							</div>
							<div class="form-group">
								  <textarea name="WFD_CHANGE_STEP_NAME" id="WFD_CHANGE_STEP_NAME" class="form-control" rows="5"><?php echo $rec_detail['WFD_CHANGE_STEP_NAME']; ?></textarea>
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small> 
							</div>
							<!---->	 
		 
                        </div>
                    </div>
                </div>
				<!-- // -->
            </div>
            <!-- Row end -->
			<!-- Row Starts -->
            <div class="row tab-pane" id="tabpermission" role="tabpanel">
				
				<div class="col-md-12">
                    <div class="card_bk">
                        <div class="card-header">
							<h5 class="card-header-text"><i class="typcn typcn-lock-open-outline"></i> ตั้งค่าสิทธิ์เฉพาะขั้นตอนนี้</h5>
                        </div>
                        <div class="card-block">
							<!---->
							<div class="form-group">
								<label for="InputNormal" class="form-control-label">สิทธิ์การมองเห็น</label>
								  <textarea name="WFD_PERMISS_VIEW" id="WFD_PERMISS_VIEW" class="form-control" rows="6"><?php echo nl2br($rec_detail['WFD_PERMISS_VIEW']); ?></textarea>
								  <small class="form-text text-muted">ตัวแปร SESSION ให้ใช้ @@SESSION!!</small>
							</div>
							<!---->
							<div class="form-group">
								<label for="InputNormal" class="form-control-label">สิทธิ์การดำเนินการ</label>
								  <textarea name="WFD_PERMISS_ACTION" id="WFD_PERMISS_ACTION" class="form-control" rows="6"><?php echo nl2br($rec_detail['WFD_PERMISS_ACTION']); ?></textarea>
								  <small class="form-text text-muted">ตัวแปร SESSION ให้ใช้ @@SESSION!!</small>
							</div>
							<!---->	
							<div class="form-group">
								<label for="InputNormal" class="form-control-label">สิทธิ์การลบ</label>
								  <textarea name="WFD_PERMISS_DELETE" id="WFD_PERMISS_DELETE" class="form-control" rows="6"><?php echo nl2br($rec_detail['WFD_PERMISS_DELETE']); ?></textarea>
								  <small class="form-text text-muted">ตัวแปร SESSION ให้ใช้ @@SESSION!!</small>
							</div>
							<!---->	
							<div class="form-group">
								<label for="WFD_PERMISS_EDIT" class="form-control-label">สิทธิ์การแก้ไข</label>
								  <textarea name="WFD_PERMISS_EDIT" id="WFD_PERMISS_EDIT" class="form-control" rows="6"><?php echo $rec_detail['WFD_PERMISS_EDIT']; ?></textarea>
								  <small class="form-text text-muted">ตัวแปร SESSION ให้ใช้ @@SESSION!!</small>
							</div>
							<!---->	
                        </div>
                    </div>
                </div>
				
            </div>
            <!-- Row end --> 
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="col-md-12">    
					<div class="f-left">
						<button type="button" class="btn btn-md btn-danger active waves-effect waves-light" onclick="window.location.href='workflow_detail.php?W=<?php echo $W; ?>';"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ</button>
					</div>
                    <div class="wf-right">
						<input type="hidden" name="back_page_old" id="back_page_old">
						<button type="submit" class="btn btn-md btn-warning active waves-effect waves-light" onclick="$('#back_page_old').val('Y');">
							<i class="icofont icofont-tick-mark"></i> บันทึกและกลับหน้าเดิม
						</button>&nbsp;
                        <button type="submit" class="btn btn-md btn-success active waves-effect waves-light"><i class="icofont icofont-tick-mark"></i> บันทึก</button>
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
<!-- ace editor js -->
<script src="../assets/plugins/ace-editor/build/aui/aui.js"></script>
	<script>
	function switch_type(id)
	{
		if(id == "T")
		{
			$('#row_t').show();
			 
		} 
		else
		{
			$('#row_t').hide();
			 
		}
	}
	</script>
<?php include '../include/combottom_admin.php'; ?>
