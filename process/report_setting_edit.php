<?php
include '../include/comtop_admin.php';
$process = conText($_GET['process']);
$W = conText($_GET['W']);
$WG = conText($_GET['WG']);
$WF_TYPE = "R";

$_txt_wf_text = "บริหารรายงาน";
$_txt_wf_link = "report.php"; 
$_txt_step_link = "report_setting.php";

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'  AND WF_TYPE = '".$WF_TYPE."'");
$rec = db::fetch_array($sql);

if($WG != ""){
$sql_form = db::query("select * from WF_WIDGET where WG_ID = '".$WG."' ");
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
	$form_main_selected = $rec_form['WG_TYPE'];
	$data_type_selected = $rec_form['WFS_FIELD_TYPE'];
	$data_length_selected = $rec_form['WFS_FIELD_LENGTH'];
	$slide_left = $rec_form['WFS_COLUMN_LEFT'];
	$slide_right = $rec_form['WFS_COLUMN_RIGHT'];
}
$arr_color = array('','bg-primary','bg-success','bg-warning','bg-danger','bg-info');
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
							<li class="breadcrumb-item">
								<a href="<?php echo $_txt_step_link; ?>?W=<?php echo $W; ?>">บริหาร Dashboard</a>
							</li>
							<li class="breadcrumb-item">
								<a href="#"><?php echo $p_process; ?> Widget</a>
							</li>
						</ol>
					</div>
					<div class="f-right col-md-3">
						<div class="f-right m-t-50">
							<a class="btn btn-danger waves-effect waves-light" href="<?php echo $_txt_step_link; ?>?W=<?php echo $W; ?>" role="button">
								<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ 
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Row end --> 
		<form action="report_setting_edit_function.php" method="post" enctype="multipart/form-data" id="form_wf" autocomplete="off" ">
			<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
			<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
			<input type="hidden" name="WG" id="WG" value="<?php echo $WG; ?>">
			<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE; ?>">
			<!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  ข้อมูลทั่วไป</h5>
						</div>
						<div class="card-block">
							<div class="col-md-8">
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
									  <label for="WG_NAME" class="form-control-label wf-right">หัวข้อ<span class="text-danger">*</span></label>
									  
								  </div>
								  <div class="col-md-8">

									  <input type="text" class="form-control" name="WG_NAME" id="WG_NAME" value="<?php echo $rec_form['WG_NAME']; ?>" required>
								  </div>
								</div>
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
									  <label for="WG_TYPE" class="form-control-label wf-right">ประเภท</label>
								  </div>
								  <div class="col-md-8">
									  <?php
									$form_system_js = "onchange=\"change_widget(this.value,$('#WG_REPORT_ID').val());\" required";
									$form_system_data = build_data('WF_WIDGET_TYPE', 'WGT_ID', 'WGT_NAME',"WGT_STATUS='Y'");
									form_dropdown('WG_TYPE', $form_system_data, $form_main_selected, $form_system_js);
									?>
								  </div>
								</div>
								 <!---->
								 <div class="form-group row">
								  <div class="col-md-3">
									  <label for="WG_REPORT_ID" class="form-control-label wf-right">รายงานที่เชื่อมโยง</label>
								  </div>
								  <div class="col-md-8">
									  <select class="form-control select2" name="WG_REPORT_ID" id="WG_REPORT_ID" onchange="change_widget($('#WG_TYPE').val(),this.value);">
										<option value="">เลือก</option>

										<?php
										$sql_detail = db::query("SELECT * FROM WF_MAIN WHERE WF_TYPE = 'R' AND WF_MAIN_TYPE = 'W' ");
										while($detail = db::fetch_array($sql_detail)){?>
											<option value="<?php echo $detail["WF_MAIN_ID"];?>" <?php if($detail["WF_MAIN_ID"] == $rec_form["WG_REPORT_ID"]){ echo 'selected';}?>><?php echo $detail["WF_MAIN_NAME"];?></option>
										<?php }?> 
									</select>
								  </div>
								</div>
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
								  </div>
								  <div class="col-md-8">
									<div class="checkbox-color checkbox-primary">
										<input name="WG_DRILLDOWN" id="WG_DRILLDOWN" type="checkbox" value="Y" <?php if($rec_form['WG_DRILLDOWN']=="Y"){ echo "checked"; } ?>>
											<label for="WG_DRILLDOWN">
												กรณีรายงานมีการตั้งค่า drilldown ให้แสดงใน dashboard ด้วย
											</label>
									</div>
								  </div>
								</div>
								<!---->
								
							</div>
						
							<div class="col-md-4">
								<!---->
								<div class="form-group row">
								  <div class="col-md-6">
									<div class="checkbox-color checkbox-primary">
										<input name="WG_HIDE_HEADER" id="WG_HIDE_HEADER" type="checkbox" value="Y" <?php if($rec_form['WG_HIDE_HEADER']=="Y"){ echo "checked"; } ?>>
											<label for="WG_HIDE_HEADER">
												Hide Header
											</label>
									</div>
								  </div>
								  <div class="col-md-6"> 
										<label for="WG_BG">
										Theme
										</label>
										<select class="form-control" name="WG_BG" id="WG_BG" >
										<?php
										foreach($arr_color as $color){?>
											<option value="<?php echo $color;?>" <?php if($color == $rec_form["WG_BG"]){ echo 'selected';}?> class="<?php echo $color;?>"><?php echo $color;?></option>
										<?php }?> 
									</select> 
								  </div>
								</div>
								<!---->
								<div class="form-group">
									<label for="WG_ICON" class="form-control-label">Icon</label>
									  <textarea name="WG_ICON" id="WG_ICON" class="form-control" ><?php echo $rec_form['WG_ICON']; ?></textarea>
								</div>
								<!---->
							</div>
							
						</div>	
                    </div>
                </div>

            </div>
            <!-- Row end -->
			<!-- Row Starts -->
            <div id="wf_widget" class="row"></div>
            <!-- Row end -->

			<div class="row">
				<div class="col-lg-12">
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
<?php
include '../include/combottom_js.php';
?>
<!-- ace editor js -->
<script src="../assets/plugins/ace-editor/build/aui/aui.js"></script>
<!-- custom js -->
<script src="../assets/pages/form-validation.js"></script>
<script src='../assets/js/jquery-sortable.js'></script>
<script src='../assets/js/typeahead.min.js'></script>
<script type="text/javascript">
	function change_widget(wg_type,wg_report){
		if(wg_type=='2'){
		var url = 'option_upload.php';
		var dataString = {WG: '<?php echo $WG; ?>', WT:wg_type , WR:wg_report};
		$.get(url, dataString, function(msg){
			$('#wf_widget').html(msg);
		});
		}else if(wg_type=='3' || wg_type=='4'){
		var url = 'option_widget.php';
		var dataString = {WG: '<?php echo $WG; ?>', WT:wg_type , WR:wg_report};
		$.get(url, dataString, function(msg){
			$('#wf_widget').html(msg);
		});
		}else{
			$('#wf_widget').html('');
		}
	}
	change_widget('<?php echo $rec_form["WG_TYPE"]; ?>','<?php echo $rec_form["WG_REPORT_ID"]; ?>');
</script>
<?php
include '../include/combottom_admin.php';
?>