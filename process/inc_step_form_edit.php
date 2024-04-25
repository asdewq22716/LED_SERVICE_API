<?php
$arr_event = array('bind','blur','change','click','contextmenu','dblclick','delegate','die','error','event.currentTarget','event.data','event.delegateTarget','event.isDefaultPrevented','event.isImmediatePropagationStopped','event.isPropagationStopped','event.metaKey','event.namespace','event.pageX','event.pageY','event.preventDefault','event.relatedTarget','event.result','event.stopImmediatePropagation','event.stopPropagation','event.target','event.timeStamp','event.type','event.which','focus','focusin','focusout','hover','jQuery.holdReady','jQuery.proxy','jQuery.ready','keydown','keypress','keyup','live','load','mousedown','mouseenter','mouseleave','mousemove','mouseout','mouseover','mouseup','off','on','one','ready','resize','scroll','select','submit','toggle','trigger','triggerHandler','unbind','undelegate','unload');

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'  AND WF_TYPE = '".$WF_TYPE."'");
$rec = db::fetch_array($sql);

if($WFS != ""){
$sql_form = db::query("select * from WF_STEP_FORM where WFS_ID = '".$WFS."' ");
$rec_form = db::fetch_array($sql_form);
}
$data_type_default = key($arr_data_type);
if($process == "add")
{
	$p_process = "เพิ่ม";
	$order_selected = "last";
	$form_main_selected = "1";
	$data_type_selected = $data_type_default;
	$data_length_selected = "255";
	$slide_left = "2";
	$slide_right = "8";
}
elseif($process == "edit")
{
	$p_process = "แก้ไข";
	$order_selected = $rec_form['WFS_ORDER'];
	$form_main_selected = $rec_form['FORM_MAIN_ID'];
	$data_type_selected = $rec_form['WFS_FIELD_TYPE'];
	$data_length_selected = $rec_form['WFS_FIELD_LENGTH'];
	$slide_left = $rec_form['WFS_COLUMN_LEFT'];
	$slide_right = $rec_form['WFS_COLUMN_RIGHT'];
}

?>
<!-- Multi Select css -->
<link rel="stylesheet" href="../assets/plugins/multi-select/css/bootstrap-multiselect.css"/>
<link rel="stylesheet" href="../assets/plugins/multi-select/css/multi-select.css"/>
<!-- Range slider css -->
<link rel="stylesheet" type="text/css" href="../assets/plugins/range-slider/css/bootstrap-slider.css">
<!-- Range slider css -->
<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Row Starts -->
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<div class="col-md-9">
						<h4><?php echo ($rec['WF_MAIN_NAME'] != '')?$rec['WF_MAIN_NAME']:$txt_head_search; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item">
								<a href="index.php"><i class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item">
								<a href="<?php echo $_txt_wf_link; ?>"><?php echo $_txt_wf_text; ?></a>
							</li>
							<?php if($WFD != "0" AND $WFD != ""){ ?>
							<li class="breadcrumb-item">
								<a href="workflow_detail.php?W=<?php echo $W; ?>">บริหารขั้นตอน</a>
							</li>
							<?php } ?>
							<li class="breadcrumb-item">
								<a href="<?php echo $_txt_step_link; ?>?W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>">บริหาร Field  <?php if($WFD != "0" AND $WFD != ""){ echo 'ภายใต้'.step_name($WFD); } ?></a>
							</li>
							<li class="breadcrumb-item">
								<a href="#"><?php echo $p_process; ?> Field</a>
							</li>
						</ol>
					</div>
					<div class="f-right col-md-3">
						<div class="input-group">
							<input name="q" id="q" type="text" class="form-control" placeholder="แปลข้อความ..">
							<span class="input-group-addon"><a href="#" onclick="window.open('https://translate.google.com/?hl=th&q='+$('#q').val(),'','width=900,height=600,scrollbars=1');"><i class="zmdi zmdi-translate"></i></a></span>
						</div>
						<div class="f-right m-t-20">
							<a class="btn btn-danger waves-effect waves-light" href="<?php echo $_txt_step_link; ?>?W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>" role="button">
								<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ 
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Row end --> 
		<form action="workflow_step_form_function.php" method="post" enctype="multipart/form-data" id="form_wf" autocomplete="off"  onsubmit="return save_positions();">
			<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
			<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
			<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD; ?>">
			<input type="hidden" name="WFS" id="WFS" value="<?php echo $WFS; ?>">
			<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE; ?>">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<!-- Include step form -->
						
<div class="card-block tab-icon">
	<ul class="nav nav-tabs md-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#tabgeneral" role="tab">
				<i class="fa fa-edit"></i> ข้อมูลทั่วไป
			</a>
			<div class="slide"></div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#taboption" role="tab">
				<i class="icofont icofont-ui-settings"></i> Option เพิ่มเติม
			</a>
			<div class="slide"></div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#tabdesign" role="tab"><i class="fa fa-expand"></i> จัดรูปแบบการแสดงผล
			</a>
			<div class="slide"></div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#tabscript" role="tab">
				<i class="fa fa-code"></i> เงื่อนไขการใช้ Script
			</a>
			<div class="slide"></div>
		</li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<!-- Row Starts -->
		<div class="tab-pane active" id="tabgeneral" role="tabpanel">
			<div class="col-md-12">
				<div class="card_bk">
					<div class="card-block">
						<div class="col-md-7">
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_NAME" class="form-control-label wf-right">ข้อความที่แสดง<span class="text-danger">*</span>
									</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="WFS_NAME" id="WFS_NAME" class="form-control" value="<?php echo $rec_form['WFS_NAME']; ?>" placeholder="ใส่ข้อความที่แสดง" required>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="FORM_MAIN_ID" class="form-control-label wf-right">ประเภทข้อมูล</label>
								</div>
								<div class="col-md-7">
									<?php
									$form_system_js = "onchange=\"change_form_type(this.value);\" required";
									$form_system_data = build_data('FORM_SYSTEM', 'FORM_MAIN_ID', 'FORM_MAIN_NAME',"FORM_MAIN_".$WF_TYPE."='Y'");
									form_dropdown('FORM_MAIN_ID', $form_system_data, $form_main_selected, $form_system_js);
									?>
								</div>
							</div>
							<!---->
							<?php
							if($WF_TYPE != 'S'){
							?>
							<div class="form-group row">
								<div class="col-md-3">
									<label for="FIELD_G_ID" class="form-control-label wf-right">กลุ่มของฟิลด์</label>
								</div>
								<div class="col-md-7">
									<select class="form-control select2" name="FIELD_G_ID" id="FIELD_G_ID">
										<option value="0">ไม่มีกลุ่ม</option>
										<?php
										$sql_detail = db::query("SELECT * FROM WF_FIELD_GROUP WHERE WF_TYPE = '".$WF_TYPE."' AND WF_MAIN_ID = '".$W."' AND WFD_ID='".$WFD."' ORDER BY FIELD_G_ORDER ");
										while($detail = db::fetch_array($sql_detail)){?>
											<option value="<?php echo $detail["FIELD_G_ID"];?>" <?php if($detail["FIELD_G_ID"] == $rec_form["FIELD_G_ID"]){ echo 'selected';}?>><?php echo $detail["FIELD_G_NAME"];?></option>
										<?php }?> 
									</select>
								</div>
							</div>
							<?php }?>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_TXT_BEFORE_INPUT" class="form-control-label wf-right">ข้อความก่อน Input #</label>
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" id="WFS_TXT_BEFORE_INPUT" name="WFS_TXT_BEFORE_INPUT" value="<?php echo $rec_form['WFS_TXT_BEFORE_INPUT']; ?>">
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_TXT_AFTER_INPUT" class="form-control-label wf-right">ข้อความหลัง Input #</label>
								</div>
								<div class="col-md-6">
									<input type="text" class="form-control" id="WFS_TXT_AFTER_INPUT" name="WFS_TXT_AFTER_INPUT" value="<?php echo $rec_form['WFS_TXT_AFTER_INPUT']; ?>">
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_DEFAULT_DATA" class="form-control-label wf-right">Default Data #</label>
								</div>
								<div class="col-md-8">
									<textarea name="WFS_DEFAULT_DATA" id="WFS_DEFAULT_DATA" class="form-control" rows="5"><?php echo $rec_form['WFS_DEFAULT_DATA']; ?></textarea>
									<small class="form-text text-muted">- ถ้าเป็นวันที่ปัจจุบัน เป็น @today, @shorttoday, @fulltoday, @year, @budgetyear</small>
									<small class="form-text text-muted">- ถ้าเป็นค่า SESSION ให้ตั้งค่าเป็น @@SESSION!!</small>
								</div>
							</div>
							<!----> 
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_DEFINE_CLASS" class="form-control-label wf-right">กำหนด Class เอง</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="WFS_DEFINE_CLASS" id="WFS_DEFINE_CLASS" class="form-control" rows="5" value="<?php echo $rec_form['WFS_DEFINE_CLASS']; ?>">
									<small class="form-text text-muted">ใส่ชื่อ Class โดยไม่ต้องใส่ "." ข้างหน้า</small>
								</div>
							</div> 
							<?php if($process == "add")
							{ ?>
								<div class="form-group row">
									<div class="col-md-3">
										<label for="WFS_ORDER" class="form-control-label wf-right">วางตำแหน่ง</label>
									</div>
									<div class="col-md-8">
										<?php
										$input_order = array();
										$sql_input_order = db::query("select WFS_ID,WFS_NAME from WF_STEP_FORM where WF_TYPE = '".$WF_TYPE."' AND WF_MAIN_ID = '".$W."' AND WFD_ID = '".$WFD."' order by WFS_ORDER ");
										while($rec_input_order = db::fetch_array($sql_input_order))
										{
											$input_order[$rec_input_order['WFS_ID']] = "ก่อน".$rec_input_order['WFS_NAME'];
										}
										$input_order['last'] = "ล่างสุด";
										form_dropdown('WFS_ORDER_BY', $input_order, $order_selected);
										?>
									</div>
								</div>
							<?php } ?>
							<!---->
						</div>
						<div class="col-md-5">
							<!---->
							
							<?php
							if($WF_TYPE == 'S'){?>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WFS_SEARCH_CON" class="form-control-label">เงื่อนไขการค้นหา</label>
								<?php
									form_dropdown("WFS_SEARCH_CON", $arr_operator, $rec_form['WFS_SEARCH_CON']);
								?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WFS_FIELD_NAME" class="form-control-label">ชื่อตัวแปร<span class="text-danger">*</span></label>
										<input type="text" name="WFS_FIELD_NAME" id="WFS_FIELD_NAME" autocomplete="off" class="form-control text-uppercase" value="<?php echo $rec_form['WFS_FIELD_NAME']; ?>"  maxlength="22" required>
										<small class="form-text text-muted">ชื่อ Field ไม่ต้องใส่ ##
										</small>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WFS_SEARCH_FIELD_NAME" class="form-control-label">ชื่อ Field ที่ต้องการค้นหา</label>
										<input type="text" name="WFS_SEARCH_FIELD_NAME" id="WFS_SEARCH_FIELD_NAME" autocomplete="off" class="form-control text-uppercase" value="<?php echo $rec_form['WFS_SEARCH_FIELD_NAME']; ?>" >
										<small class="form-text text-muted">- ชื่อ Field ไม่ต้องใส่ ##
										</small>
										<small class="form-text text-muted">- หากเงื่อนไขมากกว่า 1 Field ขั้นด้วย ',' 
										</small>
										<small class="form-text text-muted">- ถ้าไม่ใส่ข้อมูล จะใช้ชื่อเดียวกับชื่อตัวแปร</small>
										
								</div>
							</div>
							<?php }else{?>
							<!---->	
								
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WFS_FIELD_NAME" class="form-control-label">ชื่อ Field ในตาราง</label>
									<?php if($process == "add")
									{ ?>
										<input type="text" name="WFS_FIELD_NAME" id="WFS_FIELD_NAME" autocomplete="off" class="form-control text-uppercase" value="<?php echo $rec_form['WFS_FIELD_NAME']; ?>"  maxlength="22">
										<small class="form-text text-muted">ชื่อ Field ในตารางต้องเป็นตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น และควรตั้งชื่อให้ถูกตามหลักการออกแบบฐานข้อมูล</small>
									<?php }
									else
									{ 
												
								?>		<span id="field_name">
										<label class="label bg-primary"><i class="fa fa-database"></i>
											<?php echo $rec_form['WFS_FIELD_NAME']; ?>
										</label>

										<button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#bizModal" title="แก้ไข Field" onclick="open_modal('setting_step_edit_field.php?W=<?php echo $W;?>&WFS=<?php echo $WFS;?>&FIELD=<?php echo $rec_form['WFS_FIELD_NAME'];?>&OBJ_HTML=field_name','แก้ไข Field');"><i class="icofont icofont-edit-alt"></i></button>
										</span>
								<?php } ?>
								</div>
							</div>
							<!---->
							<div class="form-group row alter_field" style="display: none;">
								<div class="col-md-12">
									<div class="checkbox-color checkbox-primary">
										<input name="ALTER_FIELD" id="ALTER_FIELD" type="checkbox" value="Y">
										<label for="ALTER_FIELD">
											เพิ่มฟิลด์ที่ table <?php echo $rec['WF_MAIN_SHORTNAME']; ?>
										</label>
									</div>
								</div>
							</div>
							<!---->
							<div class="form-group row alter_field" style="display: none;">
								<div class="col-md-6">
									<div class="col-md-4">
										<label for="WFS_FIELD_TYPE" class="form-control-label wf-right">ประเภท</label>
									</div>
									<div class="col-md-8">
										<?php
										$field_type_js = "onchange=\"switch_data_type(this.value,'WFS_FIELD_LENGTH');\"";
										form_dropdown('WFS_FIELD_TYPE', $arr_data_type, $data_type_selected, $field_type_js);
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-4">
										<label for="WFS_FIELD_LENGTH" class="form-control-label wf-right">ขนาด</label>
									</div>
									<div class="col-md-8">
										<input type="number" class="form-control" id="WFS_FIELD_LENGTH" name="WFS_FIELD_LENGTH" value="<?php echo $data_length_selected; ?>">
									</div>
								</div>
							</div>
							<?php }?>
							<!---->
							<div class="form-group row">
								<div class="col-md-6">
									<div class="checkbox-color checkbox-primary">
										<input name="WFS_REQUIRED" id="WFS_REQUIRED" type="checkbox" value="Y" <?php echo $rec_form['WFS_REQUIRED'] == "Y" ? 'checked' : ''; ?> onclick="if(this.checked === true){$('#WFS_VALIDATE_TEXT_DIV').show();}else{$('#WFS_VALIDATE_TEXT_DIV').hide();}">
										<label for="WFS_REQUIRED">
											บังคับตอบข้อมูลนี้
										</label>
									</div>
								</div>
								<?php
								if($WF_TYPE != 'S'){
								?>
								<div class="col-md-6">
									<div class="checkbox-color checkbox-primary">
										<input name="WFS_CHECK_DUP" id="WFS_CHECK_DUP" type="checkbox" value="Y" <?php echo $rec_form['WFS_CHECK_DUP'] == "Y" ? 'checked' : ''; ?>>
										<label for="WFS_CHECK_DUP">
											เช็คข้อมูลซ้าในฐานข้อมูล
										</label>
									</div>
								</div>
								<?php }?>
							</div>
							<!---->
							
							<div class="form-group row">
								<div class="col-md-6">
									<div class="checkbox-color checkbox-primary">
										<input name="WFS_HIDDEN_FORM" id="WFS_HIDDEN_FORM" type="checkbox" value="Y" <?php echo $rec_form['WFS_HIDDEN_FORM'] == "Y" ? 'checked' : ''; ?>>
										<label for="WFS_HIDDEN_FORM">
											ซ่อนข้อมูลหน้า Form
										</label>
									</div>
								</div><?php
							if($WF_TYPE != 'S'){
							?>
								<div class="col-md-6">
									<div class="checkbox-color checkbox-primary">
										<input name="WFS_HIDDEN_VIEW" id="WFS_HIDDEN_VIEW" type="checkbox" value="Y" <?php echo $rec_form['WFS_HIDDEN_VIEW'] == "Y" ? 'checked' : ''; ?>>
										<label for="WFS_HIDDEN_VIEW">
											ซ่อนข้อมูลในหน้า view
										</label>
									</div>
								</div><?php }?>
							</div>
							
							<!---->
							<div class="form-group row">
								<div class="col-md-6">
									<div class="checkbox-color checkbox-primary">
										<input name="WFS_READONLY" id="WFS_READONLY" type="checkbox" value="Y" <?php echo $rec_form['WFS_READONLY'] == "Y" ? 'checked' : ''; ?>>
										<label for="WFS_READONLY">
											Read Only
										</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox-color checkbox-primary">
										<input name="WFS_DISABLE" id="WFS_DISABLE" type="checkbox" value="Y" <?php echo $rec_form['WFS_DISABLE'] == "Y" ? 'checked' : ''; ?>>
										<label for="WFS_DISABLE">
											Disable
										</label>
									</div>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-6">
									<div class="checkbox-color checkbox-primary">
										<input name="WFS_NO_BR" id="WFS_NO_BR" type="checkbox" value="Y" <?php echo $rec_form['WFS_NO_BR'] == "Y" ? 'checked' : ''; ?>>
										<label for="WFS_NO_BR">
											ข้อความไม่ต้องขึ้นบรรทัดใหม่
										</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox-color checkbox-primary">
										<input name="WFS_MAIN_SHOW" id="WFS_MAIN_SHOW" type="checkbox" value="Y" <?php echo $rec_form['WFS_MAIN_SHOW'] == "Y" ? 'checked' : ''; ?>>
										<label for="WFS_MAIN_SHOW">
											ใช้ในการแสดงผลหลัก <br>(กรณีมีตัวแปรซ้ำ)
										</label>
									</div>
								</div>
							</div>
							<!---->
							
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_PLACEHOLDER" class="form-control-label wf-right">Placeholder #</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" id="WFS_PLACEHOLDER" name="WFS_PLACEHOLDER" value="<?php echo $rec_form['WFS_PLACEHOLDER']; ?>">
									<small class="form-text text-muted">กรณี Select box ถ้าไม่ใส่ ระบบจะ default รายการแรกมาแสดง</small>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_TOOLTIP" class="form-control-label wf-right">Tooltip #</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" id="WFS_TOOLTIP" name="WFS_TOOLTIP" value="<?php echo $rec_form['WFS_TOOLTIP']; ?>">
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_COMMENT" class="form-control-label wf-right">หมายเหตุ #</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" id="WFS_COMMENT" name="WFS_COMMENT" value="<?php echo $rec_form['WFS_COMMENT']; ?>">
								</div>
							</div>
							<!---->
							<div class="form-group row" id="WFS_VALIDATE_TEXT_DIV" style="display: <?php echo $rec_form['WFS_REQUIRED'] == "Y" ? '' : 'none'; ?>">
								<div class="col-md-3">
									<label for="WFS_VALIDATE_TEXT" class="form-control-label wf-right">ข้อความที่แสดงกรณีไม่กรอกข้อมูล</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" id="WFS_VALIDATE_TEXT" name="WFS_VALIDATE_TEXT" value="<?php echo $rec_form['WFS_VALIDATE_TEXT']; ?>">
								</div>
							</div>

							<!---->
							
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_HELP" class="form-control-label wf-right">คำอธิบายในเอกสาร Prototype</label>
								</div>
								<div class="col-md-9">
									<textarea name="WFS_HELP" id="WFS_HELP" class="form-control" rows="5"><?php echo $rec_form['WFS_HELP']; ?></textarea>
									
								</div>
							</div>
							<!---->
						</div>
					</div>
					<small class="form-text text-muted">(#) หมายเหตุ : ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
				</div>
			</div>
		</div>
		<!-- Row end -->
		<!-- Row Starts -->
		<!-- Row Starts -->
		<div class="tab-pane" id="tabdesign" role="tabpanel">
			<div class="col-md-8">
				<div class="card-block">
					<div class="form-group row">
						<div class="col-md-12">
							<label for="WFS_COLUMN_TYPE" class="form-control-label ">จัดรูปแบบ</label>
							<div class="form-radio">
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="WFS_COLUMN_TYPE" id="WFS_COLUMN_TYPE1" value="2" onClick="column_choose('2');" <?php if($rec_form['WFS_COLUMN_TYPE'] == "2" || $rec_form['WFS_COLUMN_TYPE'] == "")
										{
											echo 'checked';
										} ?>>
										<i class="helper"></i> 2 คอลัมน์
									</label>
								</div>
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="WFS_COLUMN_TYPE" id="WFS_COLUMN_TYPE2" value="1" onClick="column_choose('1');" <?php echo $rec_form['WFS_COLUMN_TYPE'] == "1" ? 'checked' : ''; ?>>
										<i class="helper"></i> 1 คอลัมน์
									</label>
								</div>
							</div>
						</div>
					</div>
					<!---->
					<div id="column_use2" class="form-group row" <?php echo ($rec_form['WFS_COLUMN_TYPE'] == "1") ? 'style="display:none"' : ''; ?>>
						<div class="col-md-12">
							<div class="form-control-label">ความกว้างคอลัมน์ซ้าย-ขวา</div>
							<div class="text-center">
								<input name="WFS_COLUMN_ALIGN" id="WFS_COLUMN_ALIGN" data-slider-id='slider12d' type="text" data-slider-min="1" data-slider-max="12" data-slider-step="1" data-slider-value="[<?php echo $slide_left; ?>,<?php echo($slide_left + $slide_right); ?>]" value="<?php echo $slide_left.",".$slide_right ?>"/>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon text-primary text-right">คอลัมน์ซ้าย Span</span>
										<input type="text" name="WFS_COLUMN_LEFT" id="WFS_COLUMN_LEFT" class="form-control text-primary f-bold" value="<?php echo $slide_left ?>">
									</div>
									<div class="input-group">
										<div data-toggle="buttons">
											<div class="btn-group">
												<label class="btn btn-success <?php echo $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "L" ? 'active' : ''; ?>">
													<input type="radio" name="WFS_COLUMN_LEFT_ALIGN" id="WFS_COLUMN_LEFT_ALIGN" value="L" <?php echo $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "L" ? 'checked' : ''; ?>>
													<i class="zmdi zmdi-format-align-left"></i>
												</label>
												<label class="btn btn-success <?php echo $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "C" ? 'active' : ''; ?>">
													<input type="radio" name="WFS_COLUMN_LEFT_ALIGN" id="WFS_COLUMN_LEFT_ALIGN" value="C" <?php echo $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "C" ? 'checked' : ''; ?>>
													<i class="zmdi zmdi-format-align-center"></i>
												</label>
												<label class="btn btn-success <?php echo ($rec_form['WFS_COLUMN_LEFT_ALIGN'] == "R" OR $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "") ? 'active' : ''; ?>">
													<input type="radio" name="WFS_COLUMN_LEFT_ALIGN" id="WFS_COLUMN_LEFT_ALIGN" value="R" <?php echo ($rec_form['WFS_COLUMN_LEFT_ALIGN'] == "R" OR $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "") ? 'checked' : ''; ?>>
													<i class="zmdi zmdi-format-align-right"></i>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group text-success">
										<span class="input-group-addon text-success  f-bold text-right">คอลัมน์ขวา Span</span>
										<input type="text" name="WFS_COLUMN_RIGHT" id="WFS_COLUMN_RIGHT" class="form-control text-success f-bold" value="<?php echo $slide_right ?>">
									</div>
									<div class="input-group">
										<div data-toggle="buttons">
											<div class="btn-group">
												<label class="btn btn-success <?php echo ($rec_form['WFS_COLUMN_RIGHT_ALIGN'] == "L" OR $rec_form['WFS_COLUMN_RIGHT_ALIGN'] == "") ? 'active' : ''; ?>">
													<input type="radio" name="WFS_COLUMN_RIGHT_ALIGN" id="WFS_COLUMN_RIGHT_ALIGN" value="L" <?php echo ($rec_form['WFS_COLUMN_RIGHT_ALIGN'] == "L" OR $rec_form['WFS_COLUMN_RIGHT_ALIGN'] == "") ? 'checked' : ''; ?>>
													<i class="zmdi zmdi-format-align-left"></i>
												</label>
												<label class="btn btn-success <?php echo $rec_form['WFS_COLUMN_RIGHT_ALIGN'] == "C" ? 'active' : ''; ?>">
													<input type="radio" name="WFS_COLUMN_RIGHT_ALIGN" id="WFS_COLUMN_RIGHT_ALIGN" value="C" <?php echo $rec_form['WFS_COLUMN_RIGHT_ALIGN'] == "C" ? 'checked' : ''; ?>>
													<i class="zmdi zmdi-format-align-center"></i>
												</label>
												<label class="btn btn-success <?php echo $rec_form['WFS_COLUMN_RIGHT_ALIGN'] == "R" ? 'active' : ''; ?>">
													<input type="radio" name="WFS_COLUMN_RIGHT_ALIGN" id="WFS_COLUMN_RIGHT_ALIGN" value="R" <?php echo $rec_form['WFS_COLUMN_RIGHT_ALIGN'] == "R" ? 'checked' : ''; ?>>
													<i class="zmdi zmdi-format-align-right"></i>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!---->
					<div id="column_use1" <?php echo ($rec_form['WFS_COLUMN_TYPE'] == "2" OR $rec_form['WFS_COLUMN_TYPE'] == "") ? 'style="display:none"' : ''; ?> class="form-group row">
						<div class="col-md-8">
							<label class="form-control-label">ความกว้างคอลัมน์</label>
							<input name="WFS_COLUMN_CENTER" id="WFS_COLUMN_CENTER" data-slider-id='slider22' type="text" data-slider-min="1" data-slider-max="12" data-slider-step="1" data-slider-value="<?php echo($slide_left + $slide_right); ?>" value="<?php echo($slide_left + $slide_right); ?>"/>
							<small id="WFS_COLUMN_CENTER_val" class="form-text">span<?php echo($slide_left + $slide_right); ?></small>
						</div>
						<div class="col-md-4">
							<label for="WFS_COLUMN_CENTER_ALIGN" class="form-control-label">จัดเรียง</label>
							<div class="input-group">
								<div data-toggle="buttons">
									<div class="btn-group">
										<label class="btn btn-success <?php echo ($rec_form['WFS_COLUMN_LEFT_ALIGN'] == "L" OR $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "") ? 'active' : ''; ?>">
											<input type="radio" name="WFS_COLUMN_CENTER_ALIGN" id="WFS_COLUMN_CENTER_ALIGN" value="L" <?php echo ($rec_form['WFS_COLUMN_LEFT_ALIGN'] == "L" OR $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "") ? 'checked' : ''; ?>>
											<i class="zmdi zmdi-format-align-left"></i>
										</label>
										<label class="btn btn-success <?php echo $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "C" ? 'active' : ''; ?>">
											<input type="radio" name="WFS_COLUMN_CENTER_ALIGN" id="WFS_COLUMN_CENTER_ALIGN" value="C" <?php echo $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "C" ? 'checked' : ''; ?>>
											<i class="zmdi zmdi-format-align-center"></i>
										</label>
										<label class="btn btn-success <?php echo $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "R" ? 'active' : ''; ?>">
											<input type="radio" name="WFS_COLUMN_CENTER_ALIGN" id="WFS_COLUMN_CENTER_ALIGN" value="R" <?php echo $rec_form['WFS_COLUMN_LEFT_ALIGN'] == "R" ? 'checked' : ''; ?>>
											<i class="zmdi zmdi-format-align-right"></i>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!---->
				</div>
			</div>
		</div>
		<!-- Row end -->
		<!-- Row Starts -->
		<div class="tab-pane" id="taboption" role="tabpanel">
			<div id="form_type"></div>
		</div>
		<!-- Row end -->
		<!-- Row Starts -->
		<div class="tab-pane" id="tabscript" role="tabpanel">
			<!---->
						<div class="form-group m-t-20">
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_INPUT_EVENT" class="form-control-label wf-right">Input Event</label>
								</div>
								<div class="col-md-8">
									<select class="select2" name="WFS_INPUT_EVENT" id="WFS_INPUT_EVENT">
										<option value="">เลือก</option>
										
										<?php
										foreach($arr_event as $_val){?>
											<option value="<?php echo $_val;?>" <?php if($rec_form['WFS_INPUT_EVENT'] == $_val){ echo 'selected'; }?> ><?php echo $_val;?></option>
										<?php }?>
									
									</select>

								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WFS_JAVASCRIPT_EVENT" class="form-control-label wf-right">Javascript Event</label>
								</div>
								<div class="col-md-8">
									<textarea name="WFS_JAVASCRIPT_EVENT" id="WFS_JAVASCRIPT_EVENT" class="form-control" rows="5"><?php echo $rec_form['WFS_JAVASCRIPT_EVENT']; ?></textarea>
									
								</div>
							</div>
							<!---->
						</div>
			<div class="col-md-12 m-t-10">
				<!---->
				<div class="table-responsive" data-pattern="priority-columns">
					<table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered">
						<thead>
							<tr class="bg-primary">
								<th width="10%"></th>
								<th width="15%">
									<nobr>เงื่อนไข</nobr>
								</th>
								<th width="15%">ค่าตัวแปร</th>
								<th width="20%">ตัวแปรที่ต้องการแสดง</th>
								<th width="20%">ตัวแปรที่ต้องการซ่อน</th>
								<th width="20%">Javascript</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql_js = db::query("select * from WF_STEP_JS where WFS_ID = '".$WFS."' order by WFSJ_ID");
							$o = 1;
							while($rec_js = db::fetch_array($sql_js))
							{
								?>
								<tr>
									<td>
										<input type="hidden" name="WFSJ_ID<?php echo $o; ?>" id="WFSJ_ID<?php echo $o; ?>" value="<?php echo $rec_js['WFSJ_ID']; ?>">
										<div class="checkbox-color checkbox-primary">
											<input name="WFSJ_CHK<?php echo $o; ?>" id="WFSJ_CHK<?php echo $o; ?>" type="checkbox" value="Y" checked>
											<label for="WFSJ_CHK<?php echo $o; ?>">ใช้งาน</label>
										</div>
									</td>
									<td class="text-center">
										<select name="WFSJ_OPERATE<?php echo $o; ?>" id="WFSJ_OPERATE<?php echo $o; ?>" class="form-control">
											<option value="0" <?php echo $rec_js['WFSJ_OPERATE'] == "0" ? 'selected' : ''; ?>>เท่ากับ (=)</option>
											<option value="1" <?php echo $rec_js['WFSJ_OPERATE'] == "1" ? 'selected' : ''; ?>>มากกว่า (>)</option>
											<option value="2" <?php echo $rec_js['WFSJ_OPERATE'] == "2" ? 'selected' : ''; ?>>มากกว่าเท่ากับ (>=)</option>
											<option value="3" <?php echo $rec_js['WFSJ_OPERATE'] == "3" ? 'selected' : ''; ?>>น้อยกว่า (<)</option>
											<option value="4" <?php echo $rec_js['WFSJ_OPERATE'] == "4" ? 'selected' : ''; ?>>น้อยกว่าเท่ากับ (<=)</option>
											<option value="5" <?php echo $rec_js['WFSJ_OPERATE'] == "5" ? 'selected' : ''; ?>>ไม่เท่ากับ (!=)</option>
										</select>
									</td>
									<td>
										<input name="WFSJ_VAR<?php echo $o; ?>" id="WFSJ_VAR<?php echo $o; ?>" type="text" class="form-control" value="<?php echo $rec_js['WFSJ_VAR']; ?>">
									</td>
									<td>
										<textarea name="WFSJ_SHOW<?php echo $o; ?>" id="WFSJ_SHOW<?php echo $o; ?>" class="form-control"><?php echo $rec_js['WFSJ_SHOW']; ?></textarea>
									</td>
									<td>
										<textarea name="WFSJ_HIDE<?php echo $o; ?>" id="WFSJ_HIDE<?php echo $o; ?>" class="form-control"><?php echo $rec_js['WFSJ_HIDE']; ?></textarea>
									</td>
									<td>
										<textarea name="WFSJ_JAVASCRIPT<?php echo $o; ?>" id="WFSJ_JAVASCRIPT<?php echo $o; ?>" class="form-control"><?php echo $rec_js['WFSJ_JAVASCRIPT']; ?></textarea>
									</td>
								</tr>
								<?php
								$o++;
							}
							$round_js = $o + 5;
							for($p = $o;$p < $round_js;$p++)
							{
								?>
								<tr>
									<td>
										<div class="checkbox-color checkbox-primary">
											<input name="WFSJ_CHK<?php echo $p; ?>" id="WFSJ_CHK<?php echo $p; ?>" type="checkbox" value="Y">
											<label for="WFSJ_CHK<?php echo $p; ?>">ใช้งาน</label>
										</div>
									</td>
									<td class="text-center">
										<select name="WFSJ_OPERATE<?php echo $p; ?>" id="WFSJ_OPERATE<?php echo $p; ?>" class="form-control">
											<option value="0">เท่ากับ (=)</option>
											<option value="1">มากกว่า (>)</option>
											<option value="2">มากกว่าเท่ากับ (>=)</option>
											<option value="3">น้อยกว่า (<)</option>
											<option value="4">น้อยกว่าเท่ากับ (<=)</option>
											<option value="5">ไม่เท่ากับ (!=)</option>
										</select>
									</td>
									<td>
										<input name="WFSJ_VAR<?php echo $p; ?>" id="WFSJ_VAR<?php echo $p; ?>" type="text" class="form-control">
									</td>
									<td>
										<textarea name="WFSJ_SHOW<?php echo $p; ?>" id="WFSJ_SHOW<?php echo $p; ?>" class="form-control" ></textarea>
									</td>
									<td>
										<textarea name="WFSJ_HIDE<?php echo $p; ?>" id="WFSJ_HIDE<?php echo $p; ?>" class="form-control" ></textarea>
									</td>
									<td>
										<textarea name="WFSJ_JAVASCRIPT<?php echo $p; ?>" id="WFSJ_JAVASCRIPT<?php echo $p; ?>" class="form-control" ></textarea>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<input type="hidden" name="total_row_js" id="total_row_js" value="<?php echo $p; ?>">
				</div>
				<!---->
			</div>
		</div>
		<!-- Row end -->
	</div>
	<!-- Tab end -->
</div>

<!-- Include step form -->
					</div>
					<div class="row m-b-25">
						<div class="col-md-12">
							<div class="f-left">
								<button type="button" onclick="window.location.href='<?php echo $_txt_step_link; ?>?W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>'" class="btn btn-md btn-danger active waves-effect waves-light">
									<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ
								</button>
							</div>
							<div class="wf-right">&nbsp;
							<?php
							if($process == 'add'){?>
								<input type="hidden" name="back_page_old" id="back_page_old">
								<button type="submit" class="btn btn-md btn-warning active waves-effect waves-light" onclick="$('#back_page_old').val('Y');">
									<i class="icofont icofont-tick-mark"></i> บันทึกและเพิ่มข้อมูลถัดไป
								</button>&nbsp;
							<?php }else{?>
								<input type="hidden" name="back_page_old" id="back_page_old">
								<button type="submit" class="btn btn-md btn-warning active waves-effect waves-light" onclick="$('#back_page_old').val('Y');">
									<i class="icofont icofont-tick-mark"></i> บันทึกและกลับหน้าเดิม
								</button>&nbsp;
							<?php }?>
								<button type="submit" class="btn btn-md btn-success active waves-effect waves-light">
									<i class="icofont icofont-tick-mark"></i> บันทึก
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- Container-fluid ends -->
	</div>
</div>