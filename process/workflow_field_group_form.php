<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);
$process = conText($_GET['process']);
$id = conText($_GET['id']);
$WF_TYPE = conText($_GET['WF_TYPE']);
$p_name = "บริหารกลุ่มฟิลด์";

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_w = db::fetch_array($sql);

$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."'");
$rec_detail = db::fetch_array($sql_detail);

$sql_f_g = db::query("select * from WF_FIELD_GROUP where FIELD_G_ID = '".$id."'");
$rec = db::fetch_array($sql_f_g);

if($process == "add")
{
	$con['WF_MAIN_ID'] = $W;
	$con['WFD_ID'] = $WFD;

	$mx = db::get_max("WF_FIELD_GROUP", "FIELD_G_ORDER",$con) + 1;
}
elseif($process == "edit")
{
	$mx = $rec['FIELD_G_ORDER'];
}

?>

			<form method="post" enctype="multipart/form-data" id="wf_form_group"  action="workflow_field_group_function.php" >
        <!-- Row Starts -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-block">
                <!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="FIELD_G_ORDER" class="form-control-label wf-right">ลำดับ
                      <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-1">
                    <input type="text" id="FIELD_G_ORDER" name="FIELD_G_ORDER" placeholder="ลำดับ" class="form-control" value="<?php echo $mx; ?>" required>
                  </div>
                </div>
                <!---->
                <!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="FIELD_G_NAME" class="form-control-label wf-right">ชื่อกลุ่มของฟิลด์
                      <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="FIELD_G_NAME" name="FIELD_G_NAME" placeholder="ชื่อกลุ่มของฟิลด์" class="form-control" value="<?php echo $rec["FIELD_G_NAME"]; ?>" required>
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
            <input type="hidden" name="W" id="W" value="<?php echo $W;?>">
            <input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD;?>">
            <input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
            <input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE; ?>">
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
	$("#wf_form_group").submit(function(e) {

    var url = "workflow_field_group_function.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#wf_form_group").serialize(), // serializes the form's elements.
           success: function(data)
           {
            var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $WFD;?>&WF_TYPE=<?php echo $WF_TYPE;?>';
            $.ajax({
             type: "GET",
             url: "workflow_field_group_list.php",
             data: dataString,
             cache: false,
             success: function(html){
              $("#field_group").html(html);
              $('#bizModal').modal('hide');
             }
             });
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});

</script>

<?php db::db_close(); ?>
