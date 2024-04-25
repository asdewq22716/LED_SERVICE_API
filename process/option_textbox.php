<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$WFS = conText($_GET['WFS']);

$sql_form = db::query("select * from WF_STEP_FORM where WFS_ID = '".$WFS."' ");
$rec_form = db::fetch_array($sql_form);
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-header-text"><i class="fa fa-reorder"></i> ตั้งค่า Textbox/Textarea</h5>
			</div>
			<div class="card-block">
				<!---->
				<div class="form-group row">
					<div class="col-md-5">
						<label for="WFS_INPUT_FORMAT" class="form-control-label">รูปแบบข้อมูล</label>
						<?php
						form_dropdown("WFS_INPUT_FORMAT", $arr_textbox_format, $rec_form['WFS_INPUT_FORMAT']);
						?>
					</div>
					<div class="col-md-3">
						<label for="WFS_MASKING" class="form-control-label">Form Masking</label>
						<input type="text" name="WFS_MASKING" id="WFS_MASKING" class="form-control" value="<?php echo $rec_form['WFS_MASKING']; ?>">
						<small class="form-text text-muted">Format ตัวเลขใช้ "9" แทนตำแหน่งที่ต้องการ</small>
					</div>
					<div class="col-md-2">
						<label for="WFS_MAX_LENGTH" class="form-control-label">Max Length</label>
						<div class="input-group">
							<input type="text" name="WFS_MAX_LENGTH" id="WFS_MAX_LENGTH" class="form-control" value="<?php echo $rec_form['WFS_MAX_LENGTH']; ?>">
							<span class="input-group-addon">ตัวอักษร</span>
						</div>
					</div>
					<div class="col-md-2">
						<label for="WFS_OPTION_TXT_HEIGHT" class="form-control-label">ความสูงของ Textarea</label>
						<div class="input-group">
							<input type="text" name="WFS_OPTION_TXT_HEIGHT" id="WFS_OPTION_TXT_HEIGHT" class="form-control" value="<?php echo $rec_form['WFS_OPTION_TXT_HEIGHT']; ?>">
							<span class="input-group-addon">px</span>
						</div>
						<small class="form-text text-muted">ถ้าไม่ใส่จะถูก Default ไว้ที่ 80 px</small>
					</div>
				</div>
				<!---->
				<!---->
				<div class="form-group row">
					<div class="col-md-12">
						<label for="WFS_ONCHANGE" class="form-control-label">การคำนวณ</label>
							<textarea name="WFS_ONCHANGE" id="WFS_ONCHANGE" class="form-control" rows="5"><?php echo $rec_form['WFS_ONCHANGE']; ?></textarea>
							<small class="form-text text-muted">ถ้าเป็นตัวแปรในระบบ ให้ขึ้นต้นด้วย "@"</small>
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