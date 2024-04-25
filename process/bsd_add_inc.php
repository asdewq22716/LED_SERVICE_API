<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
?>
<form onSubmit="return save();" action="workflow_function.php" method="post">
<input type="hidden" name="process" id="process" value="add">
			<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE; ?>">
			<input type="hidden" name="WF_ALIAS" id="WF_ALIAS" value="<?php echo $table_alias; ?>">
			<input type="hidden" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE" value="W">
			<?php if($WF_TYPE == "M"){ ?>
			<input type="hidden" class="form-control text-uppercase" name="WF_FIELD_PK" id="WF_FIELD_PK" value="ID"><?php } ?>
<div class="form-group row">
	<div class="col-md-12"> 
			<label for="WF_MAIN_NAME" class="form-control-label">ชื่อ <span class="text-danger">*</span></label>
			<input type="text" name="WF_MAIN_NAME" class="form-control"  required> 
	</div> 
</div>
<div class="form-group row">
	<div class="col-md-6"> 
			<label for="WF_MAIN_SHORTNAME" class="form-control-label">Table Name <span class="text-danger">*</span></label>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $table_alias; ?></span>
			<input type="text" name="WF_MAIN_SHORTNAME" id="WF_MAIN_SHORTNAME" class="form-control text-uppercase" placeholder="TABLE NAME"  autocomplete="off" maxlength="22" required>
			</div>
			<small class="text-muted">** ระบุได้เฉพาะ A-Z, 0-9 และ Underscore (_) **</small>

	</div> 
	<div class="col-md-6"> 
			<label for="WF_GROUP_ID" class="form-control-label">Group Name <span class="text-danger">*</span></label>
			<select name="WF_GROUP_ID" id="WF_GROUP_ID" class="form-control select2" required aria-required="true" placeholder="เลือก...">
				<option value=""></option>
				<?php
				$sql_group = db::query("select GROUP_NAME , GROUP_ID from WF_GROUP WHERE WF_TYPE = '".$WF_TYPE."' order by GROUP_ORDER asc");
				while($rec_group = db::fetch_array($sql_group))
				{ ?>
					<option value="<?php echo $rec_group['GROUP_ID']; ?>"><?php echo $rec_group['GROUP_NAME']; ?></option>
				<?php } ?>
			</select> 
	</div> 
</div> 
<div class="form-group row">
	<div class="col-md-12"> 
			<input type="submit" id="SaveButton" class="btn btn-success" value="Create" />
	</div> 
</div>
</form> 
 
<?php include '../include/combottom_js.php'; ?>
<script type="text/javascript">
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

</script> 
<?php include '../include/combottom_admin.php'; ?>