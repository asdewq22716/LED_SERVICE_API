<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$WFS = conText($_GET['WFS']);
$FIELD = conText($_GET['FIELD']);
$OBJ_HTML = conText($_GET['OBJ_HTML']);
$HELP = conText($_GET['HELP']);
$SETTING = conText($_GET['SETTING_FIELD']);

$sql = db::query("select WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);

if($WFS != ''){
	$sql_form = db::query("select WFS_NAME,WFS_FIELD_NAME from WF_STEP_FORM where WFS_ID = '".$WFS."' ");
	$rec_form = db::fetch_array($sql_form);
}


$field_name = ($rec_form["WFS_FIELD_NAME"] != '')?$rec_form["WFS_FIELD_NAME"]:$FIELD;


$rec_field = select_field($rec["WF_MAIN_SHORTNAME"],strtoupper($field_name));


/*
$sql_f = db::query("select COLUMN_NAME,DATA_TYPE,DATA_LENGTH,DATA_PRECISION from user_tab_cols where column_name = '".strtoupper($field_name)."' and table_name = '".$rec["WF_MAIN_SHORTNAME"]."' ");
$rec_field = db::fetch_array($sql_f);*/

?>

	<form method="post" name="step_edit_field" id="step_edit_field" action="#">
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
				<?php if($rec_form["WFS_NAME"]!=""){ ?>
				<div class="form-group row">
                  <div class="col-md-3">
                    <label class="form-control-label wf-right">รายละเอียด : </label>
                  </div>
                  <div class="col-md-4"><?php echo $rec_form["WFS_NAME"];?>
                  </div>
                </div>
                <!---->
				<?php } ?>
                <!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label class="form-control-label wf-right">ตาราง : </label>
                  </div>
                  <div class="col-md-1"><?php echo $rec["WF_MAIN_SHORTNAME"];?>
                  </div>
                </div>
                <!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="FIELD_NAME_NEW" class="form-control-label wf-right">ชื่อ Field : </label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="FIELD_NAME_NEW" name="FIELD_NAME_NEW" placeholder="ชื่อ Field" class="form-control" value="<?php echo $rec_field["FIELD_NAME"]; ?>" required>
                  </div>
                </div>
                <!---->
				<!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="FIELD_TYPE" class="form-control-label wf-right">ประเภท Field : </label>
                  </div>
                  <div class="col-md-4">
					<?php
						
						$js_field_type = "onchange=\"switch_data_type(this.value,'FIELD_LENGTH')\"";
						form_dropdown('FIELD_TYPE', $arr_data_type, strtolower($rec_field["FIELD_TYPE"]), $js_field_type);
					?>
                  </div> 
                </div>
                <!---->
				<!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="FIELD_LENGTH" class="form-control-label wf-right">Length : </label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="FIELD_LENGTH" name="FIELD_LENGTH" class="form-control" value="<?php 
						if($rec_field["FIELD_LENGTH"] != ""){
							if($rec_field["FIELD_TYPE"] == 'NUMBER'){
								echo $rec_field["DATA_PRECISION"];
							}else{
								echo $rec_field["FIELD_LENGTH"];
							}
						}?>" >
                  </div>
                </div>
                <!---->
				<?php if($rec_field["FIELD_COMMENT_TYPE"] == "C"){ ?>
                <!---->
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="FIELD_COMMENT" class="form-control-label wf-right">Comment : </label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" id="FIELD_COMMENT" name="FIELD_COMMENT" class="form-control" value="<?php echo $rec_field["FIELD_COMMENT"]; ?>" >
					<input type="hidden" id="FIELD_COMMENT_O" name="FIELD_COMMENT_O" value="<?php echo $rec_field["FIELD_COMMENT"]; ?>" >
                  </div>
                </div>
                <!---->
				<?php } ?>
              </div>	
            </div>
          </div>
        </div>
            <!-- Row end -->
			 
        <div class="row">
			<div class="col-md-12 text-center"> 
				
				<input type="submit" name="btnSave" id="btnSave" class="btn btn-md btn-success" value="บันทึก" />
				<?php 
				if($f_drop == 'Y'){?>
					&nbsp;
					<button type="button" class="btn btn-md btn-danger" onclick="drop_field_name('<?php echo $rec["WF_MAIN_SHORTNAME"];?>','<?php echo $rec_field["COLUMN_NAME"];?>');">ลบ Field</button>
				<?php	
				}
				?>
				
				<input type="hidden" name="FIELD_NAME_OLD" id="FIELD_NAME_OLD" value="<?php  echo $rec_field["FIELD_NAME"];?>" />
				<input type="hidden" name="FIELD_TYPE_OLD" id="FIELD_TYPE_OLD" value="<?php if($rec_field["DATA_TYPE"] != ""){ echo $rec_field["DATA_TYPE"];}else{ echo '';}?>" />
				<input type="hidden" name="FIELD_LENGTH_OLD" id="FIELD_LENGTH_OLD" value="<?php if($rec_field["DATA_LENGTH"] != ""){ echo $rec_field["DATA_LENGTH"];}else{ echo '';}?>" />
				<input type="hidden" name="process" id="process" value="ADD">
				<input type="hidden" name="W" id="W" value="<?php echo $W;?>" />
				<input type="hidden" name="WFS" id="WFS" value="<?php echo $WFS;?>" />
				<input type="hidden" name="FIELD" id="FIELD" value="<?php echo $FIELD;?>" />
				<input type="hidden" name="OBJ_HTML" id="OBJ_HTML" value="<?php echo $OBJ_HTML;?>" />
				<input type="hidden" name="HELP" id="HELP" value="<?php echo $HELP;?>" />
				
			</div> 
        </div>
        <div class="row"> 
          <div class="main-header">
          </div>
        </div>
    </form>
	<!-- Container-fluid ends -->
	
	<script type="text/javascript">
	$("#step_edit_field").submit(function(e) {
		var url = "setting_edit_field_function.php"; 
		
		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#step_edit_field").serialize(), 
			   success: function(data)
			   { 
				 if(data=="."){ 
					var field_name = $('#FIELD_NAME_NEW').val();
					var field_name_o = $('#FIELD_NAME_OLD').val();
					var OBJ_HTML = $('#OBJ_HTML').val();
					if(OBJ_HTML == 'field_help'){
						var OBJ_HTML_A = OBJ_HTML+'_'+field_name_o;
					}else{
						var OBJ_HTML_A = OBJ_HTML;
					}
					
					<?php if($HELP == 'Y'){?>
						var tag_d = "<code>##"+field_name+"!!</code> <a href=\"#!\"  data-toggle=\"modal\" data-target=\"#bizModal\" title=\"แก้ไข Field\" onclick=\"open_modal('setting_step_edit_field.php?W=<?php echo $W;?>&WFS=<?php echo $WFS;?>&FIELD="+field_name+"&OBJ_HTML=<?php echo $OBJ_HTML;?>&HELP=Y','แก้ไข Field');\"><i class=\"fa fa-edit\"></i></a>";
					<?php }elseif($HELP == 'N'){?>
						var tag_d = "<i class=\"fa fa-database\"></i> "+field_name+" <i class=\"fa fa-edit\" data-toggle=\"modal\" data-target=\"#bizModal\" title=\"แก้ไข Field\" onclick=\"open_modal('setting_step_edit_field.php?W=<?php echo $W;?>&WFS=<?php echo $WFS;?>&FIELD="+field_name+"&OBJ_HTML=<?php echo $OBJ_HTML;?>&HELP=N','แก้ไข Field');\"></i>";
					<?php }else{
						if($SETTING == 'Y'){?>
						var tag_d = "<span id=\"field_setting_"+field_name+"\"><a href=\"#!\" data-toggle=\"modal\" data-target=\"#bizModal\" title=\"แก้ไข Field\" onclick=\"open_modal('setting_step_edit_field.php?W=<?php echo $W;?>&WFS=<?php echo $WFS;?>&FIELD="+field_name+"&OBJ_HTML=<?php echo $OBJ_HTML;?>&SETTING_FIELD=Y','แก้ไข Field');\">"+field_name+"</a><span>";
						var FIELD_TYPE = $('#FIELD_TYPE').val();
						var FIELD_LENGTH = $('#FIELD_LENGTH').val();
						var LENGTH = '';
						if(FIELD_LENGTH != ''){
							LENGTH = ' ('+FIELD_LENGTH+')';
						}else{
							LENGTH = '';
						}
						var SHOW_LENGTH = "<span id=\"LENGTH_"+field_name+"\">"+FIELD_TYPE+LENGTH+"</span>";
						 $('#LENGTH_'+field_name_o).html(SHOW_LENGTH);
						<?php }else{?>
						var tag_d = "<label class=\"label bg-primary\"><i class=\"fa fa-database\"></i> "+field_name+"</label><input type=\"hidden\" name=\"WFS_FIELD_NAME\" id=\"WFS_FIELD_NAME\" value=\""+field_name+"\"> <button type=\"button\" class=\"btn btn-warning btn-icon\" data-toggle=\"modal\" data-target=\"#bizModal\" title=\"แก้ไข Field\" onclick=\"open_modal('setting_step_edit_field.php?W=<?php echo $W;?>&WFS=<?php echo $WFS;?>&FIELD="+field_name+"&OBJ_HTML=<?php echo $OBJ_HTML;?>','แก้ไข Field');\"><i class=\"icofont icofont-edit-alt\"></i></button>";
						<?php }?>
					
					<?php }?> 
				  $('#'+OBJ_HTML_A).html(tag_d);
				  
				  $('#bizModal').modal('hide');
				  swal({
						  title: "บันทึกการแก้ไข Field เรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						});
				 }else{
					$("#show_error1").show();
					$("#text_error").html(data);
				 }
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
	});
	
	function drop_field_name(table,f_name){
		
		if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){		
			var dataString = 'process=DEL&TABLE_NAME='+table+'&FIELD_NAME='+f_name;
			
			$.ajax({
			 type: "GET",
			 url: "setting_edit_field_function.php",
			 data: dataString,
			 cache: false,
			 success: function(html){
				
				
				if(html=="."){
					$("#H_"+f_name).hide();
					$('#bizModal').modal('hide');
					swal({
						  title: "ลบ Field เรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						});

				 
				 }else{
					$("#show_error1").show();
					$("#text_error").html(data);
				 }
				
				
			 }
			 });

		}
		
	}
	



</script>

<?php 
include '../include/combottom_js.php'; 
include '../include/combottom_admin.php'; ?>
