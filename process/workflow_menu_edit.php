<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$id = conText($_GET['G']);
if($id != ""){
$sql = db::query("select * from WF_MENU_TEMP where MENU_ID = '".$id."'"); 
$rec = db::fetch_array($sql);
if($rec["MENU_ID"] != ""){
$p_url = "menu_group";
$p_name = "กลุ่มของ Menu";
$p_url_main = "menu_group";
$p_process = "แก้ไข";
	$mx = $rec['MENU_ORDER'];
?>
<!-- select2 css -->
	<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />

		<form action="#" name="menu_det" id="menu_det" method="post" enctype="multipart/form-data">
			<input type="hidden" name="Flag" id="Flag" value="Menu_Detail">
			<input type="hidden" name="MENU_ID" id="MENU_ID" value="<?php echo $id; ?>">
			<!-- Row Starts -->
					<div class="card">
						<div class="card-header">
							<h5 class="card-header-text">
								<i class="typcn typcn-message"></i> รายละเอียดเมนู
							</h5>
							<div class="f-right">
								<button type="button" onClick="save_detail();" class="btn btn-mini btn-success active waves-effect waves-light"> <i class="icofont icofont-save"></i> บันทึก
								</button>
							</div>
						</div>
						<div class="card-block">
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="MENU_NAME" class="form-control-label wf-right">ชื่อเมนู
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-9">
									<input type="text" id="MENU_NAME" name="MENU_NAME"   class="form-control" value="<?php echo $rec['MENU_NAME']; ?>" required>
									<input type="hidden" id="MENU_NAME_OLD" name="MENU_NAME_OLD" value="<?php echo $rec['MENU_NAME']; ?>">
								</div>
							</div>
							<!---->
							
							
							<div class="form-group row"  <?php if($rec['MENU_FLAG']=="file"){ echo "style=\"display:none\""; } ?>>
								<div class="col-md-3">
									<label for="MENU_SHOW" class="form-control-label wf-right">แสดงเมนูย่อย</label>
								</div>
								<div class="col-md-9">
										<label>
											<input type="radio" name="MENU_SHOW" id="MENU_SHOW" value="" <?php if($rec['MENU_SHOW'] == ""){ echo "checked"; } ?>>
											<i class="helper"></i>  Drill-down							
										</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label>
											<input type="radio" name="MENU_SHOW" id="MENU_SHOW" value="C" <?php if($rec['MENU_SHOW'] == "C"){ echo "checked"; } ?>>
											<i class="helper">
											</i> Collapse
										</label>

								</div>
							</div>
							<!---->
							<div class="form-group row" <?php if($rec['MENU_FLAG']!="file"){ echo "style=\"display:none\""; } ?>>
								<div class="col-md-3">
									<label for="MENU_TYPE" class="form-control-label wf-right">ประเภท</label>
								</div>
								<div class="col-md-9">
										<label>
											<input type="radio" name="MENU_TYPE" id="MENU_TYPE" value="W" <?php if($rec['MENU_TYPE'] == "W"){ echo "checked"; } ?> onClick="$('#M_W_TYPE').show();$('#M_L_TYPE').hide();$('#M_I_TYPE').hide();">
											<i class="helper"></i> BizSmartFlow Module								
										</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label>
											<input type="radio" name="MENU_TYPE" id="MENU_TYPE" value="" <?php if($rec['MENU_TYPE'] == ""){ echo "checked"; } ?> onClick="$('#M_W_TYPE').hide();$('#M_L_TYPE').show();$('#M_I_TYPE').show();">
											<i class="helper">
											</i> External Link
										</label>

								</div>
							</div>
							<!---->
							<div id="M_W_TYPE" class="form-group row" <?php if($rec['MENU_FLAG']!="file" OR $rec['MENU_TYPE']==""){ echo "style=\"display:none\""; } ?>> 
								<div class="col-md-3">
									<label for="WF_MAIN_ID" class="form-control-label wf-right">Link</label>
								</div>
								<div class="col-md-9">
									<select name="WF_MAIN_ID" id="WF_MAIN_ID" class="select2 form-control" >
										<option value="">ไม่เลือก</option>
										<option value="" disabled>ข้อมูล Workflow</option>
										<?php
										$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W' ORDER BY WF_MAIN_ORDER");
										
										while($rec_m = db::fetch_array($sql_list)){?>
											<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['WF_MAIN_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
										<?php } ?>
										
										<option value="" disabled>ข้อมูล Master</option>
										<?php
										$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'M' ORDER BY WF_MAIN_ORDER");
										
										while($rec_m = db::fetch_array($sql_list)){	?>
											<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['WF_MAIN_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
										<?php } ?>
										<option value="" disabled>ข้อมูล Report</option>
										<?php
										$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'R' ORDER BY WF_MAIN_ORDER");
										
										while($rec_m = db::fetch_array($sql_list)){?>
											<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['WF_MAIN_ID'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
										<?php } ?> 
									</select>
								</div>
							</div>
							<!---->
							<div id="M_L_TYPE" class="form-group row" <?php if($rec['MENU_FLAG']!="file" OR $rec['MENU_TYPE']=="W"){ echo "style=\"display:none\""; } ?>>
								<div class="col-md-3">
									<label for="MENU_URL" class="form-control-label wf-right">Link</label>
								</div>
								<div class="col-md-9">
									<input type="text" id="MENU_URL" name="MENU_URL" placeholder="" class="form-control" value="<?php echo $rec['MENU_URL']; ?>" >
								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group row" id="M_I_TYPE" <?php if($rec['MENU_FLAG']=="file" AND $rec['MENU_TYPE']=="W"){ echo "style=\"display:none\""; } ?>>
								<div class="col-md-3">
									<label for="MENU_ICON" class="form-control-label wf-right">ICON ใหญ่</label>
								</div>
								<div class="col-md-9">
									<div class="table-responsive dasboard-4-table-scroll">
							<div class="table-content">
								<div class="project-table p-20">
									<table id="product-list" class="table dt-responsive nowrap" width="100%" cellspacing="0">
										<tbody>
											<tr>
											<?php
											$icon = 0;
											if( $dh = opendir("../icon"))
											{
												while(false !== ($file = readdir($dh)))
												{
													if($file == '.' || $file == '..')
													{
														continue;
													}
													else
													{
														if($rec['MENU_ICON'] == $file)
														{
															$checked_img = "checked";
															$checked_highlight = "bg-gray";
														}
														else
														{
															$checked_img = "";
															$checked_highlight = "";
														}
														?>
												<td class="pro-name text-center <?php echo $checked_highlight; ?>">
													<label>
														<div><img src="../icon/<?php echo $file; ?>" /></div>
														<input type="radio" name="MENU_ICON" id="MENU_ICON"  value="<?php echo $file; ?>" <?php echo $checked_img ?>> <?php echo $file; ?>
													</label>
												</td>
														<?php
														$icon++;
														if($icon%3==0){ echo "</tr><tr>"; }
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
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="MENU_S_ICON" class="form-control-label wf-right">ICON เล็ก</label>
								</div>
								<div class="col-md-9">
									<div class="input-group">
										<span class="input-group-addon">Name</span>
										<input type="text" id="MENU_S_ICON" name="MENU_S_ICON" placeholder="" class="form-control" value="<?php echo $rec['MENU_S_ICON']; ?>" >
											<span class="input-group-addon"><a href="icons_ion.php" target="_blank"><i class="ion-help-circled"></i></a></span>
									</div>

								</div>
							</div>
							<!----> 
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="MENU_TARGET" class="form-control-label wf-right">รูปแบบ</label>
								</div>
								<div class="col-md-9">
										<label>
											<input type="radio" name="MENU_TARGET" id="MENU_TARGET" value="" <?php if($rec['MENU_TARGET'] == ""){ echo "checked"; } ?>>
											<i class="helper"></i>  หน้าต่างเดิม								
										</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label>
											<input type="radio" name="MENU_TARGET" id="MENU_TARGET" value="_blank" <?php if($rec['MENU_TARGET'] == "_blank"){ echo "checked"; } ?>>
											<i class="helper">
											</i> หน้าต่างใหม่
										</label>

								</div>
							</div>
							<!----> 
						</div>
					</div>
		</form> 
<?php include '../include/combottom_js.php'; }}  ?>
<script src="../assets/plugins/tree-view/js/jstree.min.js"></script> 
<script type="text/javascript">
function save_detail(){
	var url = "workflow_menu_ajax.php"; // the script where you handle the form input. 
	$.ajax({
		   type: "POST",
		   url: url,
		   data: $("#menu_det").serialize(), // serializes the form's elements.
		   success: function(data)
		   { 
			if(data.change == "Y"){
				$('#dragTree').jstree(true).rename_node(data.id,data.menu);
			}
							swal({
							  title: "บันทึกข้อมูลเรียบร้อยแล้ว", 
							  type: "success",
							  allowOutsideClick:true
							});

		   }
		 });

	e.preventDefault(); // avoid to execute the actual submit of the form.
}
</script>
<script type="text/javascript">	
$(document).ready(function() {
	$('select.select2').select2({ 
		allowClear: true,
		placeholder: function(){
			$(this).data('placeholder');
		}
	});
	$(".dasboard-4-table-scroll").slimScroll({
		height: 220,
		size: '10px',
		allowPageScroll: true,
		wheelStep:5,
		color: '#000'
   });
});
</script>
<?php include '../include/combottom_admin.php'; ?>
