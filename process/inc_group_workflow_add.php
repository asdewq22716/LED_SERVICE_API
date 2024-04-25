<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$table_alias = "WFR_";
$smart = "Flow";

$GROUP_ID = conText($_GET['GROUP_ID']);
$WF_TYPE = conText($_GET['WF_TYPE']);
?>
<form method="post" enctype="multipart/form-data" id="form_wf" target="wf_target" action="inc_group_ajax.php">
	<input type="hidden" name="Flag" id="Flag" value="add_workflow">
	<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE; ?>">
	
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i> ข้อมูลทั่วไป</h5>
					<div class="f-right">
						<label for="WF_MAIN_STATUS" class="custom-control custom-checkbox">
							<input type="checkbox" name="WF_MAIN_STATUS" id="WF_MAIN_STATUS" class="custom-control-input" value="Y">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">เปิดใช้งาน</span>
						</label>
					</div>
				</div>
				<div class="card-block">
					<div class="form-group row">
						<div class="col-md-3">
							<label for="WF_MAIN_NAME" class="form-control-label wf-right">ชื่อ<span class="text-danger">*</span></label>
						</div>
						<div class="col-md-9">
							<input type="text" class="form-control" name="WF_MAIN_NAME" id="WF_MAIN_NAME" required>
						</div>
					</div>
					<!---->
					<div class="form-group row">
						<div class="col-md-3">
							<label for="WF_MAIN_REMARK" class="form-control-label wf-right">รายละเอียด</label>
						</div>
						<div class="col-md-9">
							<input type="text" class="form-control" name="WF_MAIN_REMARK" id="WF_MAIN_REMARK" >
							<small  class="form-text text-muted">รายละเอียดจะแสดงในส่วนของ Data Dictionary</small>
						</div>
					</div>
					<!---->
					<?php
					if($WF_TYPE == 'R'){
						$display = 'none';
					}else{ $display = '';}
					?>
					<div class="form-group row" id="DIV_WF_MAIN_WH" style="display:<?php echo $display;?>">
						<div class="col-md-3">
							<label for="WF_MAIN_SHORTNAME" class="form-control-label wf-right">ตารางที่เก็บข้อมูล <?php
							if($WF_TYPE != "R"){?><span class="text-danger">*</span><?php }?>
							</label>
						</div>
						<div class="col-md-7">
							<input type="hidden" name="WF_ALIAS" id="WF_ALIAS" value="<?php echo $table_alias; ?>">
							<div class="input-group">
								<span class="input-group-addon"><?php echo $table_alias; ?></span>
								<input type="text" name="WF_MAIN_SHORTNAME" id="WF_MAIN_SHORTNAME" class="form-control text-uppercase" placeholder="TABLE NAME" autocomplete="off" maxlength="22" <?php if($WF_TYPE != "R"){ echo 'required';}?>>
							</div>
							<small class="text-muted">** ระบุได้เฉพาะ A-Z, 0-9 และ Underscore (_) **</small>
						</div>
					</div>
					<!---->
					<?php 
					if($WF_TYPE == "M" OR $WF_TYPE == "R"){ 
						$hidden  = ($WF_TYPE == 'R')?'none':'';
						?>
						<div class="form-group row" id="DIV_WF_MAIN_PK" style="display:<?php echo $hidden;?>">
							<div class="col-md-3">
								<label for="WF_FIELD_PK" class="form-control-label wf-right">Primary Key <?php
								if($WF_TYPE != "R"){?><span class="text-danger">*</span><?php }?>
								</label>
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control text-uppercase" name="WF_FIELD_PK" id="WF_FIELD_PK" placeholder="Primary Key"   autocomplete="off" maxlength="22" <?php
								if($WF_TYPE != "R"){ echo 'required';}?>>
								<small class="text-muted">** ระบุได้เฉพาะ A-Z, 0-9 และ Underscore (_) **</small>
							</div>
						</div>
					<?php } ?>
					<!---->
					<div class="form-group row">
						<div class="col-md-3">
							<label for="WF_GROUP_ID" class="form-control-label wf-right">กลุ่ม <span class="text-danger">*</span></label>
						</div>
						<div class="col-md-7">
							<select name="WF_GROUP_ID" id="WF_GROUP_ID" class="select2" required aria-required="true" placeholder="เลือก...">
								<option value=""></option>
								<?php
								$sql_group = db::query("select GROUP_NAME , GROUP_ID from WF_GROUP WHERE WF_TYPE = '".$WF_TYPE."' order by GROUP_ORDER asc");
								while($rec_group = db::fetch_array($sql_group))
								{ ?>
									<option value="<?php echo $rec_group['GROUP_ID']; ?>" <?php if($GROUP_ID == $rec_group['GROUP_ID']){ echo "selected"; } ?>><?php echo $rec_group['GROUP_NAME']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<!---->
					<div class="form-group row">
						<div class="col-md-3">
							<label class="form-control-label wf-right">ประเภท</label>
						</div>
						<div class="col-md-9">
							<?php
							if($WF_TYPE == "R"){?>
								<div class="form-radio">
									<div class="radio">
										<label>
											<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE3" value="W" checked="checked" onclick="show_div_table('R');">
											<i class="helper"></i> Smart Report
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE4" value="D" onclick="show_div_table('D');">
											<i class="helper"></i> Smart Dasboard
										</label>
									</div>
									<div class="radio"> 
										<label>
											<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE1" value="C" onclick="show_div_table('C');">
											<i class="helper"></i> Smart Calendar
										</label>
									</div>
									<div class="radio"> 
										<label>
											<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE1" value="K" onclick="show_div_table('K');">
											<i class="helper"></i> Smart Kanban
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE2" value="S" onclick="show_div_table('S');">
											<i class="helper"></i> Services
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE2" value="L" onclick="show_div_table('L');">
											<i class="helper"></i> External Link
										</label>
									</div>
								</div>
								<?php
							}else{?>
								<div class="form-radio">
									<div class="radio"> <!-- radio-inline -->
										<label>
											<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE1" checked="checked" value="W" onclick="show_div_url(this.value);">
											<i class="helper"></i> Smart <?php echo $smart; ?>
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE2" value="L" onclick="show_div_url(this.value);">
											<i class="helper"></i> External Link
										</label>
									</div>
								</div>
							<?php }?>
						</div>
					</div>
					<!---->
					
					<div class="form-group row" id="DIV_WF_SERVICES_TYPE" style="display: none;">
						<div class="col-md-3">
							<label class="form-control-label wf-right">Services Type</label>
						</div>
						<div class="col-md-7">
							<select name="WF_SERVICES_TYPE" id="WF_SERVICES_TYPE" class="select2">
								<option value="" <?php if($rec['WF_SERVICES_TYPE'] == ''){ echo "selected";} ?>>Jsons</option>
								<option value="1" <?php if($rec['WF_SERVICES_TYPE'] == '1'){ echo "selected";} ?>>Soap</option>
							</select>
						</div>
					</div>
								
					<div class="form-group row" id="DIV_WF_MAIN_URL" style="display: none;">
						<div class="col-md-3">
							<label for="WF_MAIN_URL" class="form-control-label wf-right">URL External Link</label>
						</div>
						<div class="col-md-9">
							<input type="text" class="form-control" name="WF_MAIN_URL" id="WF_MAIN_URL" placeholder="URL">
						</div>
					</div>
					
					<!---->
					<?php
					if($WF_TYPE != 'R' AND $WF_TYPE != 'W'){
					?>
					<div class="form-group row">
						<div class="col-md-3"></div>
						<div class="col-md-5">
							<div class="checkbox-color checkbox-primary">
								<input name="WF_MAIN_TAB_STATUS" id="WF_MAIN_TAB_STATUS" type="checkbox" value="Y">
								<label for="WF_MAIN_TAB_STATUS">
									ใช้งาน Tab ในหน้า form
								</label>
							</div>
						</div>
					</div>
					<?php }?>
					<!---->
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-header-text"><i class="typcn typcn-th-large-outline"></i> ICON</h5>
					<div class="f-right">
						<small class="form-text text-muted">
							<i class="ion-information-circled"></i> Path สำหรับเก็บไฟล์ : /icon
						</small>
					</div>
				</div>
				<div class="table-responsive dasboard-4-table-scroll">
					<div class="table-content">
						<div class="project-table p-20">
							<table id="product-list" class="table dt-responsive nowrap" width="100%" cellspacing="0">
								<tbody>
									<tr>
										<?php
										$icon = 0;
										if($dh = opendir("../icon"))
										{
											while(false !== ($file = readdir($dh)))
											{
												if($file == '.' || $file == '..')
												{
													continue;
												}
												else
												{
													?>
													<td class="pro-name text-center">
														<label>
															<input type="radio" name="WF_MAIN_ICON" id="WF_MAIN_ICON" value="<?php echo $file; ?>">
															<img src="../icon/<?php echo $file; ?>"/>
															<?php echo $file; ?>
														</label>
													</td>
													<?php
													$icon++;
													if($icon % 3 == 0)
													{
														echo "</tr><tr>";
													}
												}
											}
											closedir($dh);
										}
										?>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div class="card-block">
					<!---->
					<hr/>
					<label for="file" class="form-control-label">หรือเลือก Icon จากในเครื่อง</label>
					<div class="md-group-add-on">
						<span class="md-add-on-file">
							<button class="btn btn-primary waves-effect waves-light"><i class="typcn typcn-image-outline"></i> เลือก Icon</button>
						</span>
						<div class="md-input-file">
							<input type="file" name="UPLOAD_FILE" id="UPLOAD_FILE" class="" accept="image/png"/>
							<input type="text" class="md-form-control md-form-file">
							<label class="md-label-file"></label>
						</div>
						<small class="form-text text-muted">เฉพาะไฟล์นามสกุล PNG ขนาดที่เหมาะสม 65 X 65</small>
					</div>
					<!---->
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-12">
			<div class="wf-right">&nbsp;
				<button type="submit" class="btn btn-md btn-success active waves-effect waves-light">
					<i class="icofont icofont-tick-mark"></i> บันทึก
				</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="main-header"></div>
	</div>
</form>


<script src="../assets/plugins/tree-view/js/jstree.min.js"></script> 
<script type="text/javascript">
$('document').ready(function(){
	$('select.select2').select2({ 
		allowClear: true,
		placeholder: function(){
			$(this).data('placeholder');
		}
	});
});
$(".dasboard-4-table-scroll").slimScroll({
	height: 250, allowPageScroll: false, wheelStep: 5, color: '#000'
});
$('#WF_MAIN_SHORTNAME').keyup(function()
{
	if(this.value != "")
	{
		var chk_key = change_th2eng(this.value);
		var data = chk_key.replace('-','_');
			data = data.replace(' ','_');
			data = data.toUpperCase();
		$('#WF_MAIN_SHORTNAME').val(data); 
	}
});
$('#WF_FIELD_PK').keyup(function()
{
	if(this.value != "")
	{
		var chk_key = change_th2eng(this.value);
		var data = chk_key.replace('-','_');
			data = data.replace(' ','_');
			data = data.toUpperCase();
		$('#WF_FIELD_PK').val(data); 
	}
});
function show_div_url(txt){
	if(txt === "W")
	{ 
		$('#WF_MAIN_SHORTNAME').prop('required', 'required');
		$('#WF_FIELD_PK').prop('required', 'required');
		$('#DIV_WF_MAIN_WH').show();
		$('#DIV_WF_MAIN_PK').show();
		$('#DIV_WF_MAIN_URL').hide();
		$('#WF_MAIN_URL').val('');
	}
	else if(txt === "L")
	{
		$('#WF_MAIN_SHORTNAME').removeAttr('required');
		$('#WF_FIELD_PK').removeAttr('required');
		$('#DIV_WF_MAIN_WH').hide();
		$('#DIV_WF_MAIN_PK').hide();
		$('#DIV_WF_MAIN_URL').show();
	}
}
function chk(){
	if (document.getElementById("WF_MAIN_SHORTNAME").value.search("^[A-Z0-9_]+$")){
		alert("ใส่ชื่อไม่ถูกต้อง!  กรุณาใช่ A-Z0-9_ เท่านั้น");
		document.getElementById("WF_MAIN_SHORTNAME").select();
		return false;
	}
}
function show_div_table(txt){
	if(txt == 'L'){
		$('#DIV_WF_MAIN_WH').hide();
		$('#DIV_WF_MAIN_PK').hide();
		$('#DIV_WF_MAIN_URL').show();
		$('#WF_MAIN_SHORTNAME').removeAttr('required');
		$('#DIV_WF_SERVICES_TYPE').hide();
	}else if(txt == 'S'){
		$('#DIV_WF_MAIN_WH').hide();
		$('#DIV_WF_MAIN_PK').hide();
		$('#DIV_WF_MAIN_URL').hide();
		$('#WF_MAIN_URL').val('');
		$('#DIV_WF_SERVICES_TYPE').show();
	}else{
		$('#DIV_WF_MAIN_WH').hide();
		$('#DIV_WF_MAIN_PK').hide();
		$('#WF_MAIN_SHORTNAME').val('');
		$('#WF_FIELD_PK').val('');
		$('#DIV_WF_MAIN_URL').hide();
		$('#WF_MAIN_URL').val('');
		$('#DIV_WF_SERVICES_TYPE').hide();
	}
}
</script>
<?php include '../include/combottom_admin.php'; ?>