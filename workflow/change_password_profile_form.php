<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 

$process = conText($_GET['process']);

?>

	<form method="post" enctype="multipart/form-data" id="profile_form_change_pw"  action="change_password_profile_function.php" >
        <!-- Row Starts -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-block">
			  
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="USR_PW_NEW" class="form-control-label wf-right"> Old Password
                      <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-5">
                    <input type="password" id="USR_PW_OLD" name="USR_PW_OLD" placeholder="รหัสผ่านเดิม" class="form-control" required>
                  </div>
                </div>
                <!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="USR_PW_NEW" class="form-control-label wf-right"> New Password
                      <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-5">
                    <input type="password" id="USR_PW_NEW" name="USR_PW_NEW" placeholder="รหัสผ่านใหม่" class="form-control" required>
                  </div>
                </div>
                <!---->
                <!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="CONFIRM_PW" class="form-control-label wf-right">Comfirm Password
                      <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-5">
                    <input type="password" id="CONFIRM_PW" name="CONFIRM_PW" placeholder="ยืนยันรหัสผ่าน"  class="form-control" required>
                  </div>
                </div>
                <!---->
                
              </div>	
            </div>
          </div>
        </div>
            <!-- Row end -->
			 
        <div class="row">
          <div class="col-md-12 text-center">  
            <input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="บันทึก" />
            <input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
					</div> 
        </div>
        <div class="row"> 
          <div class="main-header">
          </div>
        </div>
      </form>
	
        <!-- Container-fluid ends -->
<script>

	$("#profile_form_change_pw").submit(function(e) {
		if($('#CONFIRM_PW').val() != $('#USR_PW_NEW').val()){
			
			swal({
				  title: "รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบอีกครั้ง", 
				  type: "error",
				  allowOutsideClick:true
				});
			$('#CONFIRM_PW').val('');
			return false;
		}else{
		var url = "change_password_profile_function.php"; 

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#profile_form_change_pw").serialize(),
			   success: function(data)
			   {
					
					if(data == 'Y')
					{
						
						swal({
						  title: "บันทึกการเปลี่ยนรหัสผ่านเรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						});
						$('#bizModal').modal('hide');

					}else{
						swal({
						  title: "รหัสผ่านเดิมไม่ถูกต้อง ตรวจสอบรหัสผ่านใหม่อีกครั้ง", 
						  type: "error",
						  allowOutsideClick:true
						});
						
					}
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
		}
	});


	

</script>

<?php db::db_close(); ?>
