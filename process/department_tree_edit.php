<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$id = conText($_GET['G']);
if($id != ""){
$sql = db::query("select * from USR_DEPARTMENT where DEP_ID = '".$id."'");
$rec = db::fetch_array($sql);
if($rec["DEP_ID"] != ""){
?>
<!-- select2 css -->
<link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />

<form action="#" name="dep_det" id="dep_det" method="post" enctype="multipart/form-data">
	<input type="hidden" name="Flag" id="Flag" value="Dep_Detail">
	<input type="hidden" name="DEP_ID" id="DEP_ID" value="<?php echo $id; ?>">
	<!-- Row Starts -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-text">
				<i class="typcn typcn-message"></i> รายละเอียดหน่วยงาน
			</h5>
			<div class="f-right">
				<button type="button" onClick="save_detail();" class="btn btn-mini btn-success active waves-effect waves-light"> <i class="icofont icofont-save"></i> บันทึก</button>
			</div>
		</div>
		<div class="card-block">
			<!---->
			<div class="form-group row">
				<div class="col-md-3">
					<label for="DEP_NAME" class="form-control-label wf-right">ชื่อหน่วยงาน
					<span class="text-danger">*</span></label>
				</div>
				<div class="col-md-9">
					<input type="text" id="DEP_NAME" name="DEP_NAME" class="form-control" value="<?php echo $rec['DEP_NAME']; ?>" required>
					<input type="hidden" id="DEP_NAME_OLD" name="DEP_NAME_OLD" value="<?php echo $rec['DEP_NAME']; ?>">
				</div>
			</div>
			
			<!---->
			<div class="form-group row">
				<div class="col-md-3">
					<label for="DEP_CODE" class="form-control-label wf-right">รหัสหน่วยงาน</label>
				</div>
				<div class="col-md-5">
					<input type="text" id="DEP_CODE" name="DEP_CODE" class="form-control" value="<?php echo $rec['DEP_CODE']; ?>">
				</div>
			</div>
			
			<!---->
			<div class="form-group row">
				<div class="col-md-3">
					<label for="DEP_SHORT_NAME" class="form-control-label wf-right">ชื่อย่อหน่วยงาน</label>
				</div>
				<div class="col-md-5">
					<input type="text" id="DEP_SHORT_NAME" name="DEP_SHORT_NAME" class="form-control" value="<?php echo $rec['DEP_SHORT_NAME']; ?>">
				</div>
			</div>
			
			<!---->
			<div class="form-group row">
				<div class="col-md-3">
					<label for="DEP_SHORT_NAME" class="form-control-label wf-right">สถานะการใช้งาน</label>
				</div>
				<div class="col-md-9">
					<label>
						<input type="radio" name="DEP_STATUS" id="DEP_STATUS" value="Y" <?php if($rec['DEP_STATUS'] == "Y"){ echo "checked"; } ?>>&nbsp;ใช้งาน
					</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label>
						<input type="radio" name="DEP_STATUS" id="DEP_STATUS" value="N" <?php if($rec['DEP_STATUS'] == "N"){ echo "checked"; } ?>>&nbsp;ไม่ใช้งาน
					</label>						
				</div>
			</div>
		</div>
	</div>
</form> 
<?php include '../include/combottom_js.php'; }}  ?>
<script src="../assets/plugins/tree-view/js/jstree.min.js"></script> 
<script type="text/javascript">
function save_detail(){
	var url = "department_tree_ajax.php"; // the script where you handle the form input. 
	$.ajax({
		type: "POST",
		url: url,
		data: $("#dep_det").serialize(), // serializes the form's elements.
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
