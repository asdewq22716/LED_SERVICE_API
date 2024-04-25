<?php
	$WFR = (int)$_GET['WFR'];
	
?>
<div class="form-group row">
	<div id="USR_PASSWORD_BSF_AREA" class="col-md-2 ">
		<label for="USR_PASSWORD" class="form-control-label wf-right">รหัสผ่าน<span class="text-danger">*</span></label>
	</div>
	<div id="USR_PASSWORD_BSF_AREA" class="col-md-3 wf-left">
		<input type="password" name="USR_PASSWORD" id="USR_PASSWORD" class="form-control" value="" required="" aria-required="true" <?php echo($WFR >0?'disabled=""':''); ?> >
	</div>
	<div id="USR_PASSWORD_CONFIRM_BSF_AREA" class="col-md-2">
		<label for="USR_PASSWORD_CONFIRM" class="form-control-label wf-right">ยืนยันรหัสผ่าน<span class="text-danger">*</span></label>
	</div>
	<div id="USR_PASSWORD_CONFIRM_BSF_AREA" class="col-md-3 wf-left">
		<input type="password" name="USR_PASSWORD_CONFIRM" id="USR_PASSWORD_CONFIRM" class="form-control" value="" required="" aria-required="true" <?php echo($WFR >0?'disabled=""':''); ?> >
	</div>
	<?php if($WFR >0){ ?>
		<div class="col-md-2"><input type="checkbox" id="chk_pass" name="chk_pass" value="1" onclick="ChkPass();"> เปลี่ยนรหัสผ่าน</div>
	<?php } ?>
</div>


<script>
	$(document).ready(function(){
		$("#form_wf").submit(function( event ) {
			
			if($("#USR_PASSWORD").val() != $("#USR_PASSWORD_CONFIRM").val()){
				
				swal("โปรดตรวจสอบอีกครั้ง!", "รหัสผ่านกับยืนยันรหัสผ่านไม่ตรงกัน!", "error");
				$("#USR_PASSWORD").focus();
				event.preventDefault();
			}
			
		});
	});
	
function ChkPass(){
    if($("#chk_pass").prop("checked")){
        $("#USR_PASSWORD").prop("disabled",false);
        $("#USR_PASSWORD_CONFIRM").prop("disabled",false);
    }else{
        $("#USR_PASSWORD").prop("disabled",true);
        $("#USR_PASSWORD_CONFIRM").prop("disabled",true);
    }
}
	
</script>