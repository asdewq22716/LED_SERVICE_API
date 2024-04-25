<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$arr_order_file = array(0=>'เวลานำเข้าก่อนไปล่าสุด',1=>'เวลานำเข้าใหม่ไปเก่า',2=>'ตามชื่อเอกสาร A-Z',3=>'ตามชื่อเอกสาร Z-A',4=>'ขนาดไฟล์เล็กไปหาใหญ่',5=>'ขนาดไฟล์ใหญ่ไปหาเล็ก',6=>'ตามนามสกุล A-Z',7=>'ตามนามสกุล Z-A');
$WFS = conText($_GET['WFS']);

$sql_form = db::query("select * from WF_STEP_FORM where WFS_ID = '".$WFS."' ");
$rec_form = db::fetch_array($sql_form);

?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-header-text"><i class="fa fa-link"></i> ตั้งค่า Browse file</h5>
			</div>
			<div class="card-block">
				<!---->
				<div class="form-group row">
					<div class="col-md-4">
						<label class="form-control-label">รูปแบบการนำเข้า</label>
						<select name="WFS_INPUT_FORMAT" id="WFS_INPUT_FORMAT" class="form-control">
							<option value="O" <?php echo $rec_form['WFS_INPUT_FORMAT'] == "O" ? 'selected' : ''; ?>>1 To 1</option>
							<option value="M" <?php echo $rec_form['WFS_INPUT_FORMAT'] == "M" ? 'selected' : ''; ?>>1 To M</option>
						</select>
					</div>
					<div class="col-md-5">
						<label class="form-control-label">นามสกุลที่อนุญาต</label>
						<input type="text" name="WFS_FILE_EXTEND_ALLOW" id="WFS_FILE_EXTEND_ALLOW" class="form-control" value="<?php echo $rec_form['WFS_FILE_EXTEND_ALLOW']; ?>">
						<small class="form-text text-muted">คั่นด้วย (,)</small>
					</div>
					<div class="col-md-3">
						<div class="form-control-label">กรณีรูปภาพ</div>
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_FILE_LIGHTBOX" id="WFS_FILE_LIGHTBOX" type="checkbox" value="Y" <?php echo $rec_form['WFS_FILE_LIGHTBOX']=="Y"?'checked':''; ?>>
							<label for="WFS_FILE_LIGHTBOX">
								แสดง Light Box
							</label>
						</div>
						<div class="form-control-label">การเรียงไฟล์</div>
							<select name="WFS_FILE_ORDER" id="WFS_FILE_ORDER" class="form-control">
								<?php
								foreach($arr_order_file as $_key=>$_val){?>
								<option value='<?php echo $_key;?>' <?php if($_key == $rec_form["WFS_FILE_ORDER"]){ echo 'selected';}?>><?php echo $_val;?></option>
								<?php }?>
							</select>
					</div>
				</div>
				<!---->
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('.select2').select2({
			placeholder: 'กรุณาเลือก...',
			allowClear: true
		});
	});
</script>
<?php db::db_close(); ?>