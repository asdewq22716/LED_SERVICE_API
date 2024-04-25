<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$W_ID = conText($_GET['W_ID']);

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);
if($rec["WF_MAIN_ID"] != "" AND $W_ID != ""){

$WF_ARR_FIELD = array();
$WF_ARR_NAME = array();
					
$query_main = db::query("SELECT WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID='".$W_ID."'");
$rec_data = db::fetch_array($query_main);

$WF_ARR_FIELD = db::show_field($rec_data["WF_MAIN_SHORTNAME"]);
foreach($WF_ARR_FIELD as $key => $value){

$query_step_form = db::query("SELECT WFS_ID,WSF.WFS_FIELD_NAME,WSF.WFS_NAME FROM WF_STEP_FORM WSF WHERE WSF.WF_MAIN_ID = '".$W_ID."' AND WF_TYPE='".$rec_data["WF_TYPE"]."' AND (WFS_FIELD_NAME IS NOT NULL OR WFS_FIELD_NAME != '' ) AND WFS_FIELD_NAME='".$value."'");

$step_form = db::fetch_array($query_step_form);
array_push($WF_ARR_NAME,$step_form["WFS_NAME"]);
}
?><div class="form-group"> 
<label for="WF_R_TYPE" class="form-control-label ">รูปแบบการแสดงผล</label>
	 <div class="form-radio">
		<div class="radio radio-inline">
			<label>
				<input type="radio" name="WF_R_TYPE" id="WF_R_TYPE" value="" <?php if($rec['WF_R_TYPE']==""){ echo "checked"; } ?> onClick="wf_change_r('');">
				<i class="helper"></i> แสดงรายการ
			</label>
		</div>
		<div class="radio radio-inline">
			<label>
				<input type="radio" name="WF_R_TYPE" id="WF_R_TYPE" value="G" <?php if($rec['WF_R_TYPE']=="G"){ echo "checked"; } ?> onClick="wf_change_r('G');">
				<i class="helper">
				</i> นับตามกลุ่ม
			</label>
		</div>
		<div class="radio radio-inline">
			<label>
				<input type="radio" name="WF_R_TYPE" id="WF_R_TYPE" value="C"  <?php if($rec['WF_R_TYPE']=="C"){ echo "checked"; } ?> onClick="wf_change_r('C');">
				<i class="helper">
				</i> รูปแบบ xy
			</label>
		</div>
	</div>
</div>
<!------->
<div id="show_gl1" <?php if($rec['WF_R_TYPE']=="C"){ echo "style=\"display:none\""; } ?>>
<!------->
	<div class="form-group">
		<label for="WF_R_GFIELD" class="form-control-label ">Field ที่ต้องการจัดกลุ่ม</label>
		<select name="WF_R_GFIELD" id="WF_R_GFIELD" class="select2 form-control">
				<option value="">ไม่มีการจัดกลุ่ม</option> 
				<?php
				foreach($WF_ARR_FIELD as $key => $value){
					?><option value="<?php echo $value; ?>" <?php if($rec['WF_R_GFIELD']==$value){ echo "selected"; } ?>><?php echo $WF_ARR_NAME[$key]; ?> (<?php echo $value; ?>)</option><?php
				}
				?>
			</select>
	</div>
</div>	
	<!------->
	<div class="form-group row" id="show_gxy" <?php if($rec['WF_R_TYPE']==""){ echo "style=\"display:none\""; } ?>>
		<div class="col-md-5">
		<label for="WF_R_GTYPE" class="form-control-label ">รูปแบบการนับ (AS BSF_GROUP)</label>
			 <div class="form-radio">
				<div class="radio radio-inline">
					<label>
						<input type="radio" name="WF_R_GTYPE" id="WF_R_GTYPE" value="" <?php if($rec['WF_R_GTYPE']==""){ echo "checked"; } ?>  onClick="wf_change_s('');">
						<i class="helper"></i> COUNT
					</label>
				</div>
				<div class="radio radio-inline">
					<label>
						<input type="radio" name="WF_R_GTYPE" id="WF_R_GTYPE" value="S" <?php if($rec['WF_R_GTYPE']=="S"){ echo "checked"; } ?> onClick="wf_change_s('S');">
						<i class="helper">
						</i> SUM
					</label>
				</div>
				<div class="radio radio-inline">
					<label>
						<input type="radio" name="WF_R_GTYPE" id="WF_R_GTYPE" value="A" <?php if($rec['WF_R_GTYPE']=="A"){ echo "checked"; } ?> onClick="wf_change_s('A');">
						<i class="helper">
						</i> AVG
					</label>
				</div>
			</div>
		</div>
		<div class="col-md-7" id="show_g_sum" <?php if($rec['WF_R_GTYPE']==""){ echo "style=\"display:none\""; } ?>>
			<label for="WF_R_SFIELD" class="form-control-label ">กรณี SUM/AVG ระบุ Field</label>
			<select name="WF_R_SFIELD" id="WF_R_SFIELD" class="select2 form-control">
				<option value="">ไม่มีการคำนวณ</option>
				<?php
				foreach($WF_ARR_FIELD as $key => $value){
					?><option value="<?php echo $value; ?>" <?php if($rec['WF_R_SFIELD']==$value){ echo "selected"; } ?>><?php echo $WF_ARR_NAME[$key]; ?> (<?php echo $value; ?>)</option><?php
				}
				?>
			</select>
		</div>	
	</div>
	<!------->
<div id="show_gl2" <?php if($rec['WF_R_TYPE']=="C"){ echo "style=\"display:none\""; } ?>>
	<div class="form-group row">
		<div class="col-md-12">
			<label for="WF_MAIN_DEFAULT_ORDER" class="form-control-label">ค่า default Field เรียงลำดับการแสดงผล</label>
			 <input type="text" class="form-control" name="WF_MAIN_DEFAULT_ORDER" id="WF_MAIN_DEFAULT_ORDER" value="<?php echo $rec['WF_MAIN_DEFAULT_ORDER']; ?>">
		</div>
	</div>
</div>
<!------->
</div>
<div id="show_xy" <?php if($rec['WF_R_TYPE']!="C"){ echo "style=\"display:none\""; } ?>>
<!------->
	<div class="form-group">
		<label for="WF_R_XFIELD" class="form-control-label ">Field แกน X</label>
		<select name="WF_R_XFIELD" id="WF_R_XFIELD" class="select2 form-control">
				<option value="">เลือก Field แกน X</option>
				<?php
				foreach($WF_ARR_FIELD as $key => $value){
					?><option value="<?php echo $value; ?>" <?php if($rec['WF_R_XFIELD']==$value){ echo "selected"; } ?>><?php echo $WF_ARR_NAME[$key]; ?> (<?php echo $value; ?>)</option><?php
				}
				?>
			</select>
	</div>
	<!------->
	<div class="form-group">
		<label for="WF_R_XORDER" class="form-control-label ">เรียงลำดับการแสดงผล แกน X</label>
		<input type="text" class="form-control" name="WF_R_XORDER" id="WF_R_XORDER" value="<?php echo $rec["WF_R_XORDER"]; ?>" /> 
	</div>
	<!------->
	<div class="form-group">
		<label for="WF_R_YFIELD" class="form-control-label ">Field แกน Y</label>
		<select name="WF_R_YFIELD" id="WF_R_YFIELD" class="select2 form-control">
				<option value="">เลือก Field แกน Y</option>
				<?php
				foreach($WF_ARR_FIELD as $key => $value){
					?><option value="<?php echo $value; ?>" <?php if($rec['WF_R_YFIELD']==$value){ echo "selected"; } ?>><?php echo $WF_ARR_NAME[$key]; ?> (<?php echo $value; ?>)</option><?php
				}
				?>
			</select>
	</div>
	<!------->
	<div class="form-group">
		<label for="WF_R_YORDER" class="form-control-label ">เรียงลำดับการแสดงผล แกน Y</label>
		<input type="text" class="form-control" name="WF_R_YORDER" id="WF_R_YORDER" value="<?php echo $rec["WF_R_YORDER"]; ?>" /> 
	</div>
<!------->
</div>
<script>
function wf_change_r(rtype){
	if(rtype=="C"){
		$("#show_xy").show();
		$("#show_gl1").hide();
		$("#show_gl2").hide();
		$("#show_gxy").show();
		$("#show_g_only").hide();
	}else if(rtype=="G"){
		$("#show_xy").hide();
		$("#show_gl1").show();
		$("#show_gl2").show();
		$("#show_gxy").show();
		$("#show_g_only").show();
	}else{
		$("#show_xy").hide();
		$("#show_gl1").show();
		$("#show_gl2").show();
		$("#show_gxy").hide();
		$("#show_g_only").hide();
	}
}
function wf_change_s(gtype){
	if(gtype==""){
		$("#show_g_sum").hide();
	}else{
		$("#show_g_sum").show();
	}
}
</script>
<?php }
include '../include/combottom_js_user.php';
include '../include/combottom_user.php';  ?>