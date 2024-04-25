<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$id = $_GET['BPMN_ID'];

$q_bpmn = db::query("SELECT BPMN_NAME,WF_GROUP_ID FROM WF_BPMN WHERE BPMN_ID = '".$id."'");
$r_bpmn = db::fetch_array($q_bpmn);
?>
<form name="form1" id="form_copy_bpmn" method="post" action="bpmn_function.php" >
	<div class="form-group row">
		<div class="col-md-3 ">
			<label class="form-control-label wf-right">ชื่อ BPMN ต้นฉบับ</label>
		</div>
		<div class="col-md-9 wf-left" ><?php echo $r_bpmn['BPMN_NAME'];?></div>
	</div>
	<div class="form-group row">
		<div class="col-md-3 ">
			<label class="form-control-label wf-right">ชื่อ BPMN ปลายทาง <span class="text-danger">*</span></label>
		</div>
		<div class="col-md-9 wf-left" ><input type="text" name="BPMN_NAME" id="BPMN_NAME" class="form-control" required></div>
	</div>
	
	<div class="form-group row">
		<div class="col-md-3" style="text-align:right;"> 
			<label for="GROUP_ID" class="form-control-label">กลุ่ม <span class="text-danger">*</span></label>
		</div> 
		<div class="col-md-7"> 
			<select name="WF_GROUP_ID" id="WF_GROUP_ID" class="select2" required aria-required="true" placeholder="เลือก...">
				<option value=""></option>
				<?php
				$sql_group = db::query("SELECT GROUP_ID, GROUP_NAME FROM WF_GROUP WHERE WF_TYPE = 'W' ORDER BY GROUP_ORDER ASC");
				while($rec_group = db::fetch_array($sql_group)){ 
					?>
					<option value="<?php echo $rec_group['GROUP_ID']; ?>" <?php if($r_bpmn['WF_GROUP_ID'] == $rec_group['GROUP_ID']){ echo "selected"; } ?>><?php echo $rec_group['GROUP_NAME']; ?></option>
					<?php 
				}
				?>
			</select>
		</div>
	</div>
	
	<div class="form-group row" >
		<div class="col-md-12" style="text-align:center;">
			<input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="บันทึก" />
			<input type="hidden" name="process" id="process" value="copy_bpmn">
			<input type="hidden" name="BPMN_ID" id="BPMN_ID" value="<?php echo $id; ?>">
		</div>
	</div>
</form>
<?php include '../include/combottom_js.php';
include '../include/combottom_admin.php'; ?>
<script>
$('select.select2').select2({
	allowClear: true,
	placeholder: function(){
		$(this).data('placeholder');
	}
});
</script>