<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
 
$WFS = conText($_GET['WFS']);
$WFD = conText($_GET['WFD']);

$sql_form = db::query("select * from WF_STEP_FORM where WFS_ID = '".$WFS."' ");
$rec_form = db::fetch_array($sql_form);
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-header-text"><i class="fa fa-map-marker"></i> ตั้งค่าการเชื่อมโยงข้อมูลจังหวัด</h5>
			</div>
			<div class="card-block">
				<!---->
				<div class="form-group row">
					<div class="col-md-4">
						 <label for="WFS_SHOW_AMPHUR" class="form-control-label">Object เขต/อำเภอ</label>
						 <input type="text" name="WFS_SHOW_AMPHUR" id="WFS_SHOW_AMPHUR" class="form-control text-uppercase" value="<?php echo $rec_form['WFS_SHOW_AMPHUR']; ?>">
						 <small class="form-text text-muted">ใส่ชื่อ Field โดยไม่ต้องใส่ ##</small>
					</div>
					<div class="col-md-4">
						<label for="WFS_SHOW_TAMBON" class="form-control-label">Object แขวง/ตำบล</label>
						 <input type="text" name="WFS_SHOW_TAMBON" id="WFS_SHOW_TAMBON" class="form-control text-uppercase" value="<?php echo $rec_form['WFS_SHOW_TAMBON']; ?>">
						 <small class="form-text text-muted">ใส่ชื่อ Field โดยไม่ต้องใส่ ##</small>
					</div>
					<div class="col-md-4">
						<label for="WFS_SHOW_ZIPCODE" class="form-control-label">Object รหัสไปรษณีย์</label>
						 <input type="text" name="WFS_SHOW_ZIPCODE" id="WFS_SHOW_ZIPCODE" class="form-control text-uppercase" value="<?php echo $rec_form['WFS_SHOW_ZIPCODE']; ?>">
						 <small class="form-text text-muted">ใส่ชื่อ Field โดยไม่ต้องใส่ ##</small>
					</div>
				</div>
				<!---->
			</div>
		</div>
	</div>
</div>
<?php
$array_a = array();
$sql_form_a = db::query("select WFS_FIELD_NAME from WF_STEP_FORM where WFD_ID = '".$WFD."' AND FORM_MAIN_ID = '12' AND WFS_FIELD_NAME IS NOT NULL ORDER BY WFS_FIELD_NAME ASC");
while($rec_form_a = db::fetch_array($sql_form_a)){ $array_a[] = $rec_form_a["WFS_FIELD_NAME"]; }

$array_t = array();
$sql_form_t = db::query("select WFS_FIELD_NAME from WF_STEP_FORM where WFD_ID = '".$WFD."' AND FORM_MAIN_ID = '13' AND WFS_FIELD_NAME IS NOT NULL ORDER BY WFS_FIELD_NAME ASC");
while($rec_form_t = db::fetch_array($sql_form_t)){ $array_t[] = $rec_form_t["WFS_FIELD_NAME"]; }

$array_z = array();
$sql_form_z = db::query("select WFS_FIELD_NAME from WF_STEP_FORM where WFD_ID = '".$WFD."' AND FORM_MAIN_ID = '14' AND WFS_FIELD_NAME IS NOT NULL ORDER BY WFS_FIELD_NAME ASC");
while($rec_form_z = db::fetch_array($sql_form_z)){ $array_z[] = $rec_form_z["WFS_FIELD_NAME"]; }
?>
<script type="text/javascript">
$(document).ready(function() {
	var data_field_a = ['<?php echo implode("','", $array_a);?>'];
	$('#WFS_SHOW_AMPHUR').typeahead({
		source: data_field_a
	});
	var data_field_t = ['<?php echo implode("','", $array_t);?>'];
	$('#WFS_SHOW_TAMBON').typeahead({
		source: data_field_t
	});
	var data_field_z = ['<?php echo implode("','", $array_z);?>'];
	$('#WFS_SHOW_ZIPCODE').typeahead({
		source: data_field_z
	});
});
</script>
<?php include '../include/combottom_admin.php'; ?>
	