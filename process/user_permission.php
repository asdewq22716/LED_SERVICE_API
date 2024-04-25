<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$USR_ID = conText($_GET['U_ID']);

$sql_group = db::query("select * from USR_GROUP WHERE GROUP_STATUS='Y' ORDER BY GROUP_ORDER ASC");
$num_rows = db::num_rows($sql_group);

$sql_ugs = db::query("SELECT UGS_ID FROM USR_GROUP_SETTING WHERE USR_ID='".$USR_ID."'");
$data = db::num_rows($sql_ugs);
$title = "กลุ่มสิทธิ์";
//$head = "สิทธิ์รายผู้ใช้งาน";

?>  

<form name="form1" id="user_permission" method="post" action="setting_group_user_function.php" >

				<div class="table-responsive" data-pattern="priority-columns">
					<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
						<thead>
						<tr class="bg-primary">
							<th class="text-center" style="width:5%">
								<div class="checkbox-color checkbox-primary col-xs-12">
									<input type="checkbox" name="check_all" id="check_all"  value="Y" onclick="select_all();" <?php if($data == $num_rows){ echo 'checked';}?>><label for="check_all"></label>
								</div>
							</th>
							<th class="text-center" style="width:30%" ><?php echo $title; ?></th>
						</tr>
						</thead>
						<tbody>
							<?php
							$i=1;

							if($num_rows > 0){
							
							while($rec_d = db::fetch_array($sql_group)){
									
								$query_setting = db::query("SELECT UGS_ID FROM USR_GROUP_SETTING WHERE GROUP_ID='".$rec_d["GROUP_ID"]."' AND USR_ID='".$USR_ID."' ");
								$rac_setting = db::fetch_array($query_setting);
								
							?>
								<tr class="wf_keyword-box">
									<td class="text-center">
										<div class="checkbox-color checkbox-primary col-xs-12">
										<input type="checkbox" name="setting_check<?php echo $i; ?>" id="setting_check<?php echo $i; ?>"  value="Y" <?php if($rac_setting["UGS_ID"] != ''){ echo 'checked';}?>><label for="setting_check<?php echo $i;?>"></label>
										</div>
										<input type="hidden" name="UGS_ID<?php  echo $i; ?>" id="UGS_ID<?php echo $i; ?>" value="<?php echo $rac_setting["UGS_ID"]; ?>"><input type="hidden" name="GROUP_ID<?php echo $i;?>" id="GROUP_ID<?php echo $i; ?>" value="<?php echo $rec_d["GROUP_ID"]; ?>">
									</td>
									<td><?php echo $rec_d["GROUP_NAME"]; ?></td>
								</tr>
							<?php $i++;} ?>
							<tr class="wf_keyword-box"> 
								<td class="text-center" colspan="2">
									<input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="บันทึก" />
									<input name="process" type="hidden" id="process" value="USR_SETTING">
									<input name="USR_ID" type="hidden" id="USR_ID" value="<?php echo $USR_ID;?>">
									<input name="num_i" type="hidden" id="num_i" value="<?php echo $i; ?>">
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

</form>
<script type="text/javascript">
	$("#user_permission").submit(function(e) {

    var url = "setting_group_user_function.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#user_permission").serialize(), // serializes the form's elements.
           success: function(data)
           {
              // alert(data);
			   $('#bizModal').modal('hide');
				swal({
					  title: "บันทึกข้อมูลเรียบร้อยแล้ว", 
					  type: "success",
					  allowOutsideClick:true
					});
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