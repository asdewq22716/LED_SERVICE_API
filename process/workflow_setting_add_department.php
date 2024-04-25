<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$USR_TYPE = conText($_GET['USR_TYPE']);
$ACCESS_TYPE = conText($_GET['ACCESS_TYPE']);
$ACESS_REF_ID = conText($_GET['ACESS_REF_ID']);

				if($USR_TYPE== 'D'){
				$sql_d = db::query("SELECT DEP_ID AS ID, DEP_NAME AS NAME FROM USR_DEPARTMENT ");
				$sql_count = db::query("SELECT count(DEP_ID) AS NUMROWS FROM USR_DEPARTMENT ");
				$title = "รายชื่อหน่วยงาน";
				$head = "สิทธิ์รายหน่วยงาน";
				}
				if($USR_TYPE== 'G'){
				$sql_d = db::query("SELECT GROUP_ID AS ID, GROUP_NAME AS NAME FROM USR_GROUP ");
				$sql_count = db::query("SELECT count(GROUP_ID) AS NUMROWS FROM USR_GROUP ");
				$title = "รายชื่อกลุ่ม";
				$head = "สิทธิ์รายกลุ่ม";
				}
				if($USR_TYPE== 'P'){
				$sql_d = db::query("SELECT POS_ID AS ID, POS_NAME AS NAME FROM USR_POSITION ");
				$sql_count = db::query("SELECT count(POS_ID) AS NUMROWS FROM USR_POSITION ");
				$title = "รายชื่อตำแหน่ง";
				$head = "สิทธิ์รายตำแหน่ง";
				}
				if($USR_TYPE== 'U'){
				$sql_d = db::query("SELECT USR_ID AS ID, USR_FNAME,USR_LNAME FROM USR_MAIN WHERE USR_STATUS = 'Y' ORDER BY USR_OPTION1");
				$sql_count = db::query("SELECT count(USR_ID) AS NUMROWS FROM USR_MAIN WHERE USR_STATUS = 'Y'");
				$title = "ชื่อ - นามสกุล";
				$head = "สิทธิ์รายผู้ใช้งาน";
				}
if($ACCESS_TYPE == 'WFM'){
	$id='show_permission_';
}else{
	$id='show_permission_d';
}
?>  
<div class="row" id="animationSandbox">
	<div class="col-sm-8"></div>
	<div class="col-sm-4">
		<div class="md-group-add-on col-sm-12">
			<span class="md-add-on">
				<i class="icofont icofont-search-alt-2 chat-search"></i>
			</span>
			<div class="md-input-wrapper">
				<input type="text" class="md-form-control" name="wf_search" id="search-wf_main_modal">
				<label for="username">ค้นหา</label>
			</div>
		</div>
	</div>
</div>
<form name="form1" id="form_add_dep" method="post" action="workflow_setting_function_add.php" >

				<div class="table-responsive" data-pattern="priority-columns">
					<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
						<thead>
						<tr class="bg-primary">
							<th class="text-center" style="width:5%">
								<div class="checkbox-color checkbox-primary col-xs-12">
									<input type="checkbox" name="check_all" id="check_all"  value="Y" onclick="select_all();"><label for="check_all"></label>
								</div>
							</th>
							<th class="text-center" style="width:30%"><?php echo $title; ?></th>
						</tr>
						</thead>
						<tbody>
							<?php
							$i=1;
							$num_data = db::fetch_array($sql_count);
							
							if($num_data["NUMROWS"] > 0){
							
							while($rec_d = db::fetch_array($sql_d)){
									
								if($USR_TYPE== 'U'){
									$rec_d["NAME"] = $rec_d["USR_FNAME"].' '.$rec_d["USR_LNAME"];
								
								}	
								$query_acc = db::query("SELECT ACCESS_ID FROM USR_ACCESS WHERE ACCESS_TYPE = '".$ACCESS_TYPE."' AND
								ACCESS_REF_ID = '".$ACESS_REF_ID."' AND USR_TYPE = '".$USR_TYPE."' AND
								USR_REF_ID = '".$rec_d["ID"]."' ");
								$rac_acc = db::fetch_array($query_acc);
								
							?>
								<tr class="wf_modal_keyword-box">
									<td class="text-center">
										<div class="checkbox-color checkbox-primary col-xs-12">
										<input type="checkbox" name="access_check<?php echo $i; ?>" id="access_check<?php echo $i; ?>"  value="Y" <?php if($rac_acc["ACCESS_ID"] != ''){ echo 'checked';}?>><label for="access_check<?php echo $i;?>"></label>
										</div>
										<input type="hidden" name="ac_id<?php  echo $i; ?>" id="ac_id<?php echo $i; ?>" value="<?php echo $rac_acc["ACCESS_ID"]; ?>"><input type="hidden" name="u_id<?php echo $i;?>" id="u_id<?php echo $i; ?>" value="<?php echo $rec_d["ID"]; ?>">
									</td>
									<td class="wf_keyword"><?php echo $rec_d["NAME"]; ?></td>
								</tr>
							<?php $i++;} ?>
							<tr> 
								<td class="text-center" colspan="2">
									<input type="submit" name="btnSave" id="btnSave" class="btn btn-success" value="บันทึก" />
									<input name="process" type="hidden" id="process" value="ADD">
									<input name="ACCESS_TYPE" type="hidden" id="ACCESS_TYPE" value="<?php echo $ACCESS_TYPE;?>">
									<input name="ACCESS_REF_ID" type="hidden" id="ACCESS_REF_ID" value="<?php echo $ACESS_REF_ID;?>">
									<input name="USR_TYPE" type="hidden" id="USR_TYPE" value="<?php echo $USR_TYPE;?>">
									<input name="num_i" type="hidden" id="num_i" value="<?php echo $i; ?>">
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

</form>
<script>
	$(document).ready(function() {
		$("#search-wf_main_modal").on("keyup", function() {

			var g = $(this).val().toLowerCase();
			$(".wf_keyword").each(function() {

				var s = $(this).text().toLowerCase();
				$(this).closest('.wf_modal_keyword-box')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
			});
		});

		// Sortable rows
		$('.sorted_table').sortable({
			containerSelector: 'table',
			itemPath: '> tbody',
			itemSelector: 'tr',
			handle: '.move-td',
			placeholder: '<tr class="placeholder"/>',
			onDrop: function($item, container, _super){
				_super($item, container);
				arrange_row('sorted_table');
			}
		});
	});

	$("#form_add_dep").submit(function(e) {

    var url = "workflow_setting_function_add.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#form_add_dep").serialize(), // serializes the form's elements.
           success: function(data)
           {
               var dataString = 'A_TYPE=<?php echo  $ACCESS_TYPE;?>&A_ID=<?php echo $ACESS_REF_ID; ?>';
				$.ajax({
				 type: "GET",
				 url: "workflow_setting_view_department.php",
				 data: dataString,
				 cache: false,
				 success: function(html){
				  $("#<?php echo $id.$ACESS_REF_ID; ?>").html(html);
				   $('#bizModal').modal('hide');
				 }
				 });
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});

</script>
<?php
db::db_close();
?>