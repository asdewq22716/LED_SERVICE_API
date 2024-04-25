<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$table = conText($_GET['table']);
$WF_TYPE = conText($_GET['WF_TYPE']);

if($WF_TYPE == 'W'){
	$str = " (ไม่ต้องใส่ WFR_)";
	$p = "WFR_";
}elseif($WF_TYPE == 'F'){
	$str = "(ไม่ต้องใส่ FRM_)";
	$p = "FRM_";
}elseif($WF_TYPE == 'M'){
	$str = "(ไม่ต้องใส่ M_)";
	$p = "M_";
}

?>

	<form method="post" name="edit_table" id="edit_table" action="edit_tablename_function.php">
        <!-- Row Starts -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-block">
                <!---->
				<div id="show_error1" style="display:none" class="form-group row">
                  <div class="col-md-12">
                     <span id="text_error"></span>
                  </div>
                </div>
                <!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label class="form-control-label wf-right">ชื่อเดิม : </label>
                  </div>
                  <div class="col-md-1"><?php echo $table;?>
                  </div>
                </div>
                <!---->
                <!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="TABLE_NAME_NEW" class="form-control-label wf-right">ชื่อใหม่ <?php echo $str;?> : </label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" id="TABLE_NAME_NEW" name="TABLE_NAME_NEW" placeholder="ชื่อตารางที่ต้องการเปลี่ยน" class="form-control"  required>
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
				
				<input type="submit" name="btnSave" id="btnSave" class="btn btn-md btn-success" value="บันทึก" />
				<input type="hidden" name="TABLE_NAME_OLD" id="TABLE_NAME_OLD" value="<?php echo $table;?>" />
				<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE;?>" />
				<input type="hidden" name="W" id="W" value="<?php echo $W;?>" />
				<input type="hidden" name="process" id="process" value="EDIT_TABLENAME">

			</div> 
        </div>
        <div class="row"> 
          <div class="main-header">
          </div>
        </div>
    </form>
	<!-- Container-fluid ends -->
	
	<script type="text/javascript">
	$("#edit_table").submit(function(e) {
		var url = "edit_tablename_function.php"; 
		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#edit_table").serialize(),
			   success: function(data)
			   {
				 
				 if(data == "."){
					var t_name = '<?php echo $p;?>'+$('#TABLE_NAME_NEW').val();
					var tag_d = "<label class=\"label bg-primary\"><i class=\"typcn typcn-database\"></i>"+t_name+"</label><button type=\"button\" class=\"btn btn-warning btn-icon\" data-toggle=\"modal\" data-target=\"#bizModal\" title=\"แก้ไขชื่อตาราง\" onclick=\"open_modal('edit_tablename.php?table="+t_name+"&WF_TYPE=<?php echo $WF_TYPE;?>&W=<?php echo $W;?>','แก้ไขชื่อตาราง');\"><i class=\"icofont icofont-edit-alt\"></i></button>";
					$('#table_name').html(tag_d);
					$('#bizModal').modal('hide');
					
				  swal({
						  
						  title: "บันทึกการแก้ไขชื่อตารางเรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true,
						  
						});
				 }else{
					$("#show_error1").show();
					$("#text_error").html(data);
				 }
			   }
			 });

		e.preventDefault(); 
	});	
	
	



</script>

<?php 
include '../include/combottom_js.php'; 
include '../include/combottom_admin.php'; ?>
