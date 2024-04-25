<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = conText($_GET['process']);
$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);
$WFS = conText($_GET['WFS']); 
$form_type = conText($_GET['form_type']); 
$WF_TYPE = conText($_GET['WF_TYPE']); 
$sql_form = db::query("select * from WF_STEP_FORM where WFS_ID = '".$WFS."' ");
$rec_form = db::fetch_array($sql_form); 

?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-header-text"><i class="fa fa-check-circle"></i> ตั้งค่าเพิ่มเติม</h5>
			</div>
			<div class="card-block">
				<!---->
				<?php if($form_type == "5"){ ?>
				<div class="form-group row">
					<div class="col-md-4">
						<label for="WFS_INPUT_FORMAT" class="form-control-label">รูปแบบ Checkbox</label>
						<select name="WFS_INPUT_FORMAT" id="WFS_INPUT_FORMAT" class="form-control" onChange="show_Chk(this.value);">
							<option value="O" <?php echo $rec_form['WFS_INPUT_FORMAT'] == "O" ? 'selected' : ''; ?>>1 To 1</option>
							<option value="M" <?php echo $rec_form['WFS_INPUT_FORMAT'] == "M" ? 'selected' : ''; ?>>1 To M</option>
						</select>
					</div>
					<div class="col-md-3" id="O_SELECT" style="<?php echo ($rec_form['WFS_INPUT_FORMAT'] == "M") ? 'display:none' : ''; ?>">
						<label for="WFS_OPTION_VALUE" class="form-control-label">ค่าใน Checkbox</label>
						<input type="text" name="WFS_OPTION_VALUE" id="WFS_OPTION_VALUE" class="form-control" value="<?php echo $rec_form['WFS_OPTION_VALUE']; ?>">
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_OPTION_SHORT_SELECT" id="WFS_OPTION_SHORT_SELECT" type="checkbox" value="Y" <?php echo $rec_form['WFS_OPTION_SHORT_SELECT']=="Y"?'checked':''; ?>>
							<label for="WFS_OPTION_SHORT_SELECT">
								แสดงแบบย่อในหน้ารายการแสดงผล
							</label>
						</div>
					</div>
				</div>
				<?php } ?>
				<!--M_SELECT -->
				<div id="M_SELECT" style="<?php if($form_type == "5"){ echo ($rec_form['WFS_INPUT_FORMAT'] == "O" OR $rec_form['WFS_INPUT_FORMAT'] == "") ? 'display:none' : ''; } ?>">
				<!---->		
				<div class="form-group row">
					<div class="col-md-9">
						<label for="WFS_OPTION_SELECT_DATA" class="form-control-label">เลือกข้อมูล</label>
						<select name="WFS_OPTION_SELECT_DATA" id="WFS_OPTION_SELECT_DATA" class="select2 form-control">
							<option value="">เลือก</option>
							<optgroup label="ข้อมูล Master"><?php
	$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'M' ORDER BY WF_MAIN_ORDER");
	while($rec_m = db::fetch_array($sql_list)){	
	?><option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec_form['WFS_OPTION_SELECT_DATA'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option><?php } ?>
							</optgroup>
							<optgroup label="ข้อมูล Workflow"><?php
	$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W' ORDER BY WF_MAIN_ORDER");
	while($rec_m = db::fetch_array($sql_list)){	
	?><option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec_form['WFS_OPTION_SELECT_DATA'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option><?php } ?>
							</optgroup>
							<optgroup label="ข้อมูล Form"><?php
	$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'F' ORDER BY WF_MAIN_ORDER");
	while($rec_m = db::fetch_array($sql_list)){	
	?><option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec_form['WFS_OPTION_SELECT_DATA'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option><?php } ?>
							</optgroup>
							<optgroup label="ข้อมูลระบบ">
								<?php foreach($arr_system_data as $_key => $_val){ ?>
								<option value="<?php echo $_key ?>" <?php echo $rec_form['WFS_OPTION_SELECT_DATA'] == $_key ? 'selected' : ''; ?>><?php echo $_val; ?></option>
								<?php } ?>
							</optgroup>
						</select>
					</div>
					<div class="col-md-3">
						<?php if($form_type == "4" || $form_type == "5"){ ?> 
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_OPTION_NEW_LINE" id="WFS_OPTION_NEW_LINE" type="checkbox" value="Y" <?php echo $rec_form['WFS_OPTION_NEW_LINE']=="Y"?'checked':''; ?>>
							<label for="WFS_OPTION_NEW_LINE">
								ตัวเลือกขึ้นบรรทัดใหม่
							</label>
						</div>
						<?php }elseif($form_type == "9"){ ?> 
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_OPTION_SELECT2" id="WFS_OPTION_SELECT2" type="checkbox" value="Y" <?php echo $rec_form['WFS_OPTION_SELECT2']=="N"?'':'checked'; ?>>
							<label for="WFS_OPTION_SELECT2">
								ใช้ jQuery Select2
							</label>
						</div>
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_OPTION_SELECT2COM" id="WFS_OPTION_SELECT2COM" type="checkbox" value="Y" <?php echo $rec_form['WFS_OPTION_SELECT2COM']=="Y"?'checked':''; ?> onClick="if(this.checked==true){ document.getElementById('WFS_OPTION_SELECT2').checked=true; }">
							<label for="WFS_OPTION_SELECT2COM">
								ใช้ Auto Complete
							</label>
						</div>
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_OPTION_ADD_MAIN" id="WFS_OPTION_ADD_MAIN" type="checkbox" value="Y" <?php echo $rec_form['WFS_OPTION_ADD_MAIN']=="Y"?'checked':''; ?>>
							<label for="WFS_OPTION_ADD_MAIN">
								เพิ่มข้อมูลจากหน้า Form ได้
							</label>
						</div>
						<?php }elseif($form_type == "7"){ ?> 
						<!--<div class="checkbox-color checkbox-primary">
							<input name="WFS_FORM_ADD_STATUS" id="WFS_FORM_ADD_STATUS" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_ADD_STATUS']=="Y"?'checked':''; ?>>
							<label for="WFS_FORM_ADD_STATUS">
								เพิ่มข้อมูลได้
							</label>
						</div>-->
						<?php } 
						if($WF_TYPE == "F"){ ?>
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_MASTER_CROSS" id="WFS_MASTER_CROSS" type="checkbox" value="Y" <?php echo $rec_form['WFS_MASTER_CROSS']=="Y"?'checked':''; ?>>
							<label for="WFS_MASTER_CROSS">
							บันทึกข้อมูลโดยเรียกรายการทั้งหมด
							</label>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="form-group row">
					<?php if($form_type == "4" || $form_type == "7" || $form_type == "9"){ ?>
					<div class="col-md-3">
						<label for="WFS_OPTION_SHOW_VALUE" class="form-control-label">ชื่อฟิลด์ที่ต้องการบันทึกลงตาราง</label>
						<input type="text" name="WFS_OPTION_SHOW_VALUE" id="WFS_OPTION_SHOW_VALUE" class="form-control" value="<?php echo $rec_form['WFS_OPTION_SHOW_VALUE']; ?>" >
						<small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
						<small class="form-text text-muted">หากไม่มีค่า จะใช้ Primary Key ของตารางนั้น</small>
					</div>
					<?php } ?>
					<div class="col-md-9">
						<label for="WFS_OPTION_SHOW_FIELD" class="form-control-label">ชื่อฟิลด์ที่ต้องการแสดง</label>
						<input type="text" name="WFS_OPTION_SHOW_FIELD" id="WFS_OPTION_SHOW_FIELD" class="form-control" value="<?php echo $rec_form['WFS_OPTION_SHOW_FIELD']; ?>">
						<small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
					</div>
				</div>
				<!---->
				<div class="form-group row">
					<div class="col-md-10">
						<label for="WFS_OPTION_COND" class="form-control-label">เงื่อนไขการเรียกข้อมูล</label>
						<textarea name="WFS_OPTION_COND" id="WFS_OPTION_COND" class="form-control text-primary" rows="5"><?php echo $rec_form['WFS_OPTION_COND']; ?></textarea> 
					</div>
					<div class="col-md-2">
							<br /> 
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_OPTION_FULL_SQL" id="WFS_OPTION_FULL_SQL" type="checkbox" value="Y" <?php echo $rec_form['WFS_OPTION_FULL_SQL']=="Y"?'checked':''; ?>>
							<label for="WFS_OPTION_FULL_SQL" title="เขียน SQL Statement เอง">
								FULL SQL Statement
							</label>
						</div>
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_OPTION_SQL_VALUE" id="WFS_OPTION_SQL_VALUE" type="checkbox" value="Y" <?php echo $rec_form['WFS_OPTION_SQL_VALUE']=="Y"?'checked':''; ?>>
							<label for="WFS_OPTION_SQL_VALUE" title="ไม่ต้องให้ระบบ Convert ค่าที่ได้จากฐานข้อมูล ตามที่ตั้งค่าไว้ในการแสดงผล">
								Show Value Only
							</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<small class="form-text text-muted">- ไม่ต้องใส่ WHERE</small>
							<small class="form-text text-muted">- ถ้าเงื่อนไขตัวแปรเป็น Field ให้ใส่ ##Field!!</small>
							<small class="form-text text-muted">- ถ้าเงื่อนไขตัวแปรเป็น Session ให้ใส่ @@Session!!</small>
							<small class="form-text text-muted">- ถ้าเงื่อนไขตัวแปรเป็นตัวแปร Change ให้ใส่ #@Field!!</small>
					</div>
				</div>
				<!---->
				<?php 
				if($form_type != "7"){ ?>
				<!---->
				<div class="form-group row">
					<!---->
					<div class="col-md-12">
						<div class="form-control-label">กำหนดข้อมูลเพิ่มเติม</div>
						<div class="table-responsive" data-pattern="priority-columns">
							<table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
								<thead>
									<tr class="bg-primary">
										<th width="10%"></th>
										<th width="50%">ข้อความที่แสดง</th>
										<th width="30%">VALUE</th>
										<th width="10%">ลำดับ</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql_option = db::query("select * from WF_STEP_OPTION where WFS_ID = '".$WFS."' order by WFSO_ORDER");
									$num_option = db::num_rows($sql_option);
									$j=1;
									while($rec_option = db::fetch_array($sql_option))
									{
									?>
										<tr id="wfso_option_row<?php echo $j; ?>">
											<td>
												<input type="hidden" name="WFSO_ID<?php echo $j; ?>" id="WFSO_ID<?php echo $j; ?>" value="<?php echo $rec_option['WFSO_ID']; ?>">
												<div class="checkbox-color checkbox-primary">
													<input name="wfso_option_chk<?php echo $j; ?>" id="wfso_option_chk<?php echo $j; ?>" type="checkbox" value="Y" onclick="wfso_option_switch(this, '<?php echo $j; ?>');" checked>
													<label for="wfso_option_chk<?php echo $j; ?>">ใช้งาน</label>
												</div>
											</td>
											<td>
												<input type="text" name="WFSO_NAME<?php echo $j; ?>" id="WFSO_NAME<?php echo $j; ?>" class="form-control text-primary" value="<?php echo $rec_option['WFSO_NAME']; ?>">
											</td>
											<td>
												<input type="text" name="WFSO_VALUE<?php echo $j; ?>" id="WFSO_VALUE<?php echo $j; ?>" class="form-control text-primary" value="<?php echo $rec_option['WFSO_VALUE']; ?>">
											</td>
											<td>
												<input type="number" name="WFSO_ORDER<?php echo $j; ?>" id="WFSO_ORDER<?php echo $j; ?>" class="form-control text-primary" value="<?php echo $rec_option['WFSO_ORDER']; ?>">
											</td>
										</tr>
									<?php
										$j++;
									}
									$round = $j+10;
									for($i = $j;$i < $round; $i++)
									{
									?>
										<tr id="wfso_option_row<?php echo $i; ?>">
											<td>
												<div class="checkbox-color checkbox-primary">
													<input name="wfso_option_chk<?php echo $i; ?>" id="wfso_option_chk<?php echo $i; ?>" type="checkbox" value="Y" onclick="wfso_option_switch(this, '<?php echo $i; ?>');">
													<label for="wfso_option_chk<?php echo $i; ?>">ใช้งาน</label>
												</div>
											</td>
											<td>
												<input type="text" name="WFSO_NAME<?php echo $i; ?>" id="WFSO_NAME<?php echo $i; ?>" class="form-control text-primary" disabled>
											</td>
											<td>
												<input type="text" name="WFSO_VALUE<?php echo $i; ?>" id="WFSO_VALUE<?php echo $i; ?>" class="form-control text-primary" disabled>
											</td>
											<td>
												<input type="number" name="WFSO_ORDER<?php echo $i; ?>" id="WFSO_ORDER<?php echo $i; ?>" class="form-control text-primary" value="<?php echo $i; ?>" disabled>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<input type="hidden" name="total_row_wfso_option" id="total_row_wfso_option" value="<?php echo $round; ?>">
						</div>
					</div>
					<!---->
				</div>
				<!---->
				<?php } ?>
				<?php if($form_type == "7" OR $form_type == "9"){ ?>
				<!---->
				<div class="form-group row">
					<!---->
					<div class="col-md-12">
						<div class="form-control-label">ตั้งค่าการโยนข้อมูล</div>
						<div class="table-responsive" data-pattern="priority-columns">
							<table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
								<thead>
									<tr class="bg-primary">
										<th width="10%"></th>
										<th width="50%">FIELD ต้นทาง (ใส่ ##FIELD!! เพื่อเลือกข้อมูลจาก Field ที่ต้องการ)</th>
										<th width="30%">FIELD ปลายทาง (ไม่ต้องใส่ ##!!)</th>
										<th width="10%">ประเภทการโยนข้อมูล</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql_option = db::query("select * from WF_STEP_THROW where WFS_ID = '".$WFS."' order by WFST_ID ASC");
									$num_option = db::num_rows($sql_option);
									$j=1;
									while($rec_option = db::fetch_array($sql_option))
									{
									?>
										<tr id="wfst_option_row<?php echo $j; ?>">
											<td>
												<input type="hidden" name="WFST_ID<?php echo $j; ?>" id="WFST_ID<?php echo $j; ?>" value="<?php echo $rec_option['WFST_ID']; ?>">
												<div class="checkbox-color checkbox-primary">
													<input name="wfst_option_chk<?php echo $j; ?>" id="wfst_option_chk<?php echo $j; ?>" type="checkbox" value="Y" onclick="wfst_option_switch(this, '<?php echo $j; ?>');" checked>
													<label for="wfst_option_chk<?php echo $j; ?>">ใช้งาน</label>
												</div>
											</td>
											<td>
												<input type="text" name="WFST_NAME<?php echo $j; ?>" id="WFST_NAME<?php echo $j; ?>" class="form-control text-primary" value="<?php echo $rec_option['WFST_NAME']; ?>">
											</td>
											<td>
												<input type="text" name="WFST_VALUE<?php echo $j; ?>" id="WFST_VALUE<?php echo $j; ?>" class="form-control text-primary" value="<?php echo $rec_option['WFST_VALUE']; ?>">
											</td>
											<td>
												<select class="form-control" name="WFST_TYPE<?php echo $j; ?>" id="WFST_TYPE<?php echo $j; ?>">
													<option value="" <?php if($rec_option['WFST_TYPE'] == ''){ echo 'selected';}?>>Text</option>
													<option value="ID" <?php if($rec_option['WFST_TYPE'] == 'ID'){ echo 'selected';}?>>Id</option>
												</select>
											</td>
										</tr>
									<?php
										$j++;
									}
									$round = $j+10;
									for($i = $j;$i < $round; $i++)
									{
									?>
										<tr id="wfst_option_row<?php echo $i; ?>">
											<td>
												<div class="checkbox-color checkbox-primary">
													<input name="wfst_option_chk<?php echo $i; ?>" id="wfst_option_chk<?php echo $i; ?>" type="checkbox" value="Y" onclick="wfst_option_switch(this, '<?php echo $i; ?>');">
													<label for="wfst_option_chk<?php echo $i; ?>">ใช้งาน</label>
												</div>
											</td>
											<td>
												<input type="text" name="WFST_NAME<?php echo $i; ?>" id="WFST_NAME<?php echo $i; ?>" class="form-control text-primary" disabled>
											</td>
											<td>
												<input type="text" name="WFST_VALUE<?php echo $i; ?>" id="WFST_VALUE<?php echo $i; ?>" class="form-control text-primary" disabled>
											</td>
											<td>
												<select class="form-control" name="WFST_TYPE<?php echo $i; ?>" id="WFST_TYPE<?php echo $i; ?>">
													<option value="" >Text</option>
													<option value="ID" >Id</option>
												</select>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<input type="hidden" name="total_row_throw" id="total_row_throw" value="<?php echo $round; ?>">
							
						</div>
					</div>
					<!---->
				</div>
				<!---->
				<?php } ?>
				</div> 
				<!--M_SELECT -->
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('.select2').select2({
			placeholder: 'กรุณาเลือก...',
			allowClear: true
		});
	});
	function show_Chk(opt)
	{
		if(opt == 'M')
		{
			$('#O_SELECT').hide();
			$('#M_SELECT').show();
		}
		else
		{
			$('#M_SELECT').hide();
			$('#O_SELECT').show();

		}
	}
	function wfso_option_switch(obj, row)
	{
		if(obj.checked == true)
		{
			$('#wfso_option_row'+row+' input[type="text"]').prop('disabled', false);
			$('#wfso_option_row'+row+' input[type="number"]').prop('disabled', false);
		}
		else
		{
			$('#wfso_option_row'+row+' input[type="text"]').prop('disabled', true);
			$('#wfso_option_row'+row+' input[type="number"]').prop('disabled', true);

		}
	}
	function wfst_option_switch(obj, row)
	{
		if(obj.checked == true)
		{
			$('#wfst_option_row'+row+' input[type="text"]').prop('disabled', false);
			$('#wfst_option_row'+row+' input[type="number"]').prop('disabled', false);
		}
		else
		{
			$('#wfst_option_row'+row+' input[type="text"]').prop('disabled', true);
			$('#wfst_option_row'+row+' input[type="number"]').prop('disabled', true);

		}
	}
</script>
<?php db::db_close(); ?>