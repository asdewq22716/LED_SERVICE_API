<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$G_ID = conText($_GET['G_ID']);

$sql_d = db::query("SELECT USR_ID , USR_PREFIX,USR_FNAME,USR_LNAME FROM USR_MAIN WHERE USR_STATUS = 'Y'");
$sql_count = db::query("SELECT count(USR_ID) AS NUMROWS FROM USR_MAIN WHERE USR_STATUS = 'Y'");
$num_data = db::fetch_array($sql_count);
$sql_ugs = db::query("SELECT UGS_ID FROM USR_GROUP_SETTING WHERE GROUP_ID='".$G_ID."'");
$data = db::num_rows($sql_ugs);

$title = "ชื่อ - นามสกุล";
//$head = "สิทธิ์รายผู้ใช้งาน";

?>  

<form name="form1" id="form_setting_user" method="post" action="setting_group_user_function.php" >

				<div class="table-responsive" data-pattern="priority-columns">
					<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
						<thead>
						<tr class="bg-primary">
							<th class="text-center" style="width:5%">
								<div class="checkbox-color checkbox-primary col-xs-12">
									<input type="checkbox" name="check_all" id="check_all"  value="Y" onclick="select_all();" <?php if($data == $num_data["NUMROWS"]){ echo 'checked';}?>><label for="check_all"></label>
								</div>
							</th>
							<th class="text-center" style="width:30%"><?php echo $title; ?></th>
						</tr>
						</thead>
						<tbody>
							<?php
							$i=1;

							if($num_data["NUMROWS"] > 0){
							
							while($rec_d = db::fetch_array($sql_d)){
									
								$query_setting = db::query("SELECT UGS_ID FROM USR_GROUP_SETTING WHERE GROUP_ID='".$G_ID."' AND USR_ID='".$rec_d["USR_ID"]."' ");
								$rac_setting = db::fetch_array($query_setting);
								
							?>
								<tr class="wf_keyword-box">
									<td class="text-center">
										<div class="checkbox-color checkbox-primary col-xs-12">
										<input type="checkbox" name="setting_check<?php echo $i; ?>" id="setting_check<?php echo $i; ?>"  value="Y" <?php if($rac_setting["UGS_ID"] != ''){ echo 'checked';}?>><label for="setting_check<?php echo $i;?>"></label>
										</div>
										<input type="hidden" name="UGS_ID<?php  echo $i; ?>" id="UGS_ID<?php echo $i; ?>" value="<?php echo $rac_setting["UGS_ID"]; ?>"><input type="hidden" name="USR_ID<?php echo $i;?>" id="USR_ID<?php echo $i; ?>" value="<?php echo $rec_d["USR_ID"]; ?>">
									</td>
									<td><?php echo $rec_d["USR_PREFIX"].$rec_d["USR_FNAME"].' '.$rec_d["USR_LNAME"]; ?></td>
								</tr>
							<?php $i++;} ?>
							<tr class="wf_keyword-box"> 
								<td class="text-center" colspan="2">
									<input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="บันทึก" />
									<input name="process" type="hidden" id="process" value="GROUP_SETTING">
									<input name="GROUP_ID" type="hidden" id="GROUP_ID" value="<?php echo $G_ID;?>">
									<input name="num_i" type="hidden" id="num_i" value="<?php echo $i; ?>">
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

</form>
<script type="text/javascript">
	$("#form_setting_user").submit(function(e) {

    var url = "setting_group_user_function.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#form_setting_user").serialize(), // serializes the form's elements.
           success: function(data)
           {
                $('#bizModal').modal('hide');
				swal({
					  title: "บันทึกข้อมูลเรียบร้อยแล้ว", 
					  type: "success",
					  allowOutsideClick:true
					});
			   /*var dataString = 'A_TYPE=<?php echo  $ACCESS_TYPE;?>&A_ID=<?php echo $ACESS_REF_ID; ?>';
				$.ajax({
				 type: "GET",
				 url: "workflow_setting_view_department.php",
				 data: dataString,
				 cache: false,
				 success: function(html){
				  $("#<?php echo $id.$ACESS_REF_ID; ?>").html(html);
				   $('#bizModal').modal('hide');
				 }
				 });*/
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});

function select_all(){

	$("#check_all").change(function () {
		var num_i = $("#num_i").val();
		for(i=1;i<=num_i;i++){
			$("#setting_check"+i).prop('checked', $(this).prop("checked"));
		}
	});

}

</script>


<?php
db::db_close();
?>