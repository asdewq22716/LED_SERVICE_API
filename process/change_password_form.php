<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$process = conText($_GET['process']);
$id = conText($_GET['id']);

?>

	<form method="post" enctype="multipart/form-data" id="form_change_pw"  action="change_password_function.php" >
        <!-- Row Starts -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-block">
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
                    <input type="password" id="CONFIRM_PW" name="CONFIRM_PW" placeholder="ยืนยันรหัสผ่าน" onblur="check_pw(this)" class="form-control" required>
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
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
					</div> 
        </div>
        <div class="row"> 
          <div class="main-header">
          </div>
        </div>
      </form>
	
        <!-- Container-fluid ends -->
<script>

	$("#form_change_pw").submit(function(e) {

		var url = "../process/change_password_function.php"; 

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#form_change_pw").serialize(),
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

					}
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
	});

	function check_pw(val){
		if(val.value != $('#USR_PW_NEW').val() && val.value != ''){
			
			alert('รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบอีกครั้ง');
			val.value = '';
		}
		
	}
	

</script>

<?php db::db_close(); ?>
