<?php
include '../include/comtop_admin.php';

$W = conText($_GET['W']);

$sql_data = db::query("SELECT WF_MAIN_NAME,WF_MAIN_SHORTNAME,WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
$rec = db::fetch_array($sql_data);

$sql_sf = db::query("select WFS_ID,FORM_MAIN_ID,WFS_FIELD_NAME,WFS_REQUIRED,WFS_CODING_FORM,WFS_CODING_SAVE,WFS_CODING_VIEW,WFS_CHECK_DUP,WFS_HIDDEN_FORM,WFS_HIDDEN_VIEW,WFS_READONLY from WF_STEP_FORM where WF_MAIN_ID = '".$W."' AND WF_TYPE = '".$rec['WF_TYPE']."' ORDER BY WFS_ORDER");
/*$sql = db::query("select WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);
$WF_ARR_FIELD = db::show_field($rec["WF_MAIN_SHORTNAME"]);
*/
?>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header"> 
					<h4><?php echo $rec['WF_MAIN_NAME'].' ('.$rec['WF_MAIN_SHORTNAME'].')'; ?></h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow"></ol>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
                <div class="card">
					<div class="card-block">
					<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
						<thead>
							<tr class="bg-primary">
								<th class="text-center" style="width:12%">ข้อความที่แสดง</th>
								<th class="text-center" style="width:10%">ชื่อ Field ในตาราง</th>
								<th class="text-center" style="width:10%">ประเภท (ขนาด) ของ Field</th>
								<th class="text-center" style="width:8%">ประเภทข้อมูล</th>
								<th class="text-center" style="width:15%">Relation</th>
								<th class="text-center" style="width:15%">ตั้งค่า Coding</th>
								<th class="text-center" style="width:5%">เช็คข้อมูลซ้าในฐานข้อมูล</th>
								<th class="text-center" style="width:5%">ซ่อนข้อมูลหน้า Form</th>
								<th class="text-center" style="width:5%">ซ่อนข้อมูลในหน้า view</th>
								<th class="text-center" style="width:5%">Read Only</th>
								<th class="text-center" style="width:10%"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							while($rec_sf = db::fetch_array($sql_sf)){
									$length = '';
									$str =  '';
									$sql_f = db::query("SELECT FORM_MAIN_NAME FROM FORM_SYSTEM WHERE FORM_MAIN_ID='".$rec_sf["FORM_MAIN_ID"]."'");
									$rec_f = db::fetch_array($sql_f);
									
									$step_form = select_field($rec["WF_MAIN_SHORTNAME"], $rec_sf["WFS_FIELD_NAME"]);
									if($rec_sf["WFS_REQUIRED"] == 'Y'){
										$str = '<span class="text-danger">*</span>';
										
									}
									
									?>
									<tr class="wf_keyword-box" id="tr_wfs_<?php echo $rec_sf["WFS_ID"];?>">
										<td><?php echo $step_form["FIELD_COMMENT"].$str;?></td>
										<td>
										<span id="field_setting_<?php echo $rec_sf["WFS_FIELD_NAME"];?>"><a href="#!" data-toggle="modal" data-target="#bizModal" title="แก้ไข Field" onclick="open_modal('setting_step_edit_field.php?W=<?php echo $W;?>&WFS=<?php echo $rec_sf["WFS_ID"];?>&FIELD=<?php echo $rec_sf["WFS_FIELD_NAME"]; ?>&OBJ_HTML=field_setting_<?php echo $rec_sf["WFS_FIELD_NAME"];?>&SETTING_FIELD=Y','แก้ไข Field');">
										<?php
										if($step_form["FIELD_NAME"] != ''){
											echo $step_form["FIELD_NAME"];
										}else{
											if($rec_sf["WFS_FIELD_NAME"] != ''){?>
											<code><?php echo $rec_sf["WFS_FIELD_NAME"];?></code>
											<?php }}?></a><span></td>
										<td><span id="LENGTH_<?php echo $rec_sf["WFS_FIELD_NAME"];?>"><?php 
										$length = ($step_form["FIELD_LENGTH"] != '')?' ('.$step_form["FIELD_LENGTH"].')':'';
										if(($step_form["FIELD_LENGTH"] > 0) AND ($step_form["FIELD_LENGTH"] <= 5)){
											echo '<code>'.$step_form["FIELD_TYPE"].$length.'</code>';
										}else{
											echo $step_form["FIELD_TYPE"].$length;
										}?></span></td>
										<td><?php echo $rec_f["FORM_MAIN_NAME"];?></td>
										<td><?php
										if($step_form["FIELD_REF_TABLE"] != ''){
											$sql_ref = db::query("SELECT WF_MAIN_NAME,WF_MAIN_SHORTNAME FROM WF_MAIN WHERE WF_MAIN_SHORTNAME = '".$step_form["FIELD_REF_TABLE"]."' ");
											$ref = db::fetch_array($sql_ref);
											echo $ref["WF_MAIN_NAME"].' ('.$ref["WF_MAIN_SHORTNAME"].')';
										}
										?></td>
										<td><?php
										if($rec_sf["FORM_MAIN_ID"] == '10'){
											if($rec_sf["WFS_CODING_FORM"]){
												echo 'ส่วนหน้า Form<br>';
												echo '<li>'.$rec_sf["WFS_CODING_FORM"].'</li>';
											}
											if($rec_sf["WFS_CODING_SAVE"]){
												echo 'ส่วนหน้า Save<br>';
												echo '<li>'.$rec_sf["WFS_CODING_SAVE"].'</li>';
											}
											if($rec_sf["WFS_CODING_VIEW"]){
												echo 'ส่วนหน้า View<br>';
												echo '<li>'.$rec_sf["WFS_CODING_VIEW"].'</li>';
											}
										}
										?></td>
										<td><?php echo ($rec_sf["WFS_CHECK_DUP"] == 'Y')?$rec_sf["WFS_CHECK_DUP"]:'';?></td>
										<td><?php echo ($rec_sf["WFS_HIDDEN_FORM"] == 'Y')?$rec_sf["WFS_HIDDEN_FORM"]:'';?></td>
										<td><?php echo ($rec_sf["WFS_HIDDEN_VIEW"] == 'Y')?$rec_sf["WFS_HIDDEN_VIEW"]:'';?></td>
										<td><?php echo ($rec_sf["WFS_READONLY"] == 'Y')?$rec_sf["WFS_READONLY"]:'';?></td>
										<td class="text-center">
											<button type="button" class="btn btn-warning btn-icon" onclick="window.open('form_step_form_edit.php?process=edit&W=<?php echo $W;?>&WFS=<?php echo $rec_sf["WFS_ID"];?>','_blank');" title="ตั้งค่า Field" ><i class="typcn typcn-pencil"></i></button>
											
											<button type="button" class="btn btn-danger btn-icon" onclick="deleteSetting_WFS('<?php echo $W;?>','<?php echo $rec_sf["WFS_ID"];?>');" title="ลบ Field">
												<i class="icofont icofont-trash"></i></button>

										</td>
									</tr>
								<?php }
							?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
include '../include/combottom_js.php';
include "inc_js_step_form.php";
?>
<script>  
  function deleteSetting_WFS(w,id){
	if(w != '' && id != ''){
		swal({
					title: "",
					text: "คุณต้องการลบ Input นี้ใช่หรือไม่",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "ยืนยันการลบ",
					cancelButtonText: "ยกเลิก",
					closeOnConfirm: true
				},
			function(){
			var dataString = 'process=delete&W='+w+'&WFS='+id;
			$.ajax({
				type: "GET",
				url: "workflow_step_form_function.php",
				data: dataString,
				cache: false,
				success: function(html){
					
					$('#tr_wfs_'+id).hide();
					swal({
					  title: "ลบข้อมูลเรียบร้อยแล้ว", 
					  type: "success",
					  allowOutsideClick:true
					});

				} 
			 });
			});
		}
	}

  
</script>
<?php
include '../include/combottom_admin.php'; ?>