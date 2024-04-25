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
				<h5 class="card-header-text"><i class="fa fa-keyboard-o"></i> ตั้งค่าข้อความ</h5>
			</div>
			<div class="card-block">
				<!---->
				<div class="row">
					<div class="col-md-6">
						<div class="form-control-label">คอลัมน์ซ้าย</div>
						<textarea name="WFS_TXT_C_LEFT" id="WFS_TXT_C_LEFT" rows="5" class="form-control"><?php echo nl2br($rec_form['WFS_TXT_C_LEFT']); ?></textarea>
						<small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_TXT_C_LEFT_HIGHLIGHT" id="WFS_TXT_C_LEFT_HIGHLIGHT" type="checkbox" value="Y" <?php echo $rec_form['WFS_TXT_C_LEFT_HIGHLIGHT']=="Y"?'checked':''; ?>>
							<label for="WFS_TXT_C_LEFT_HIGHLIGHT">
								แสดง Highlight Label
							</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-control-label">คอลัมน์ขวา</div>
						<textarea name="WFS_TXT_C_RIGHT" id="WFS_TXT_C_RIGHT" rows="5" class="form-control"><?php echo nl2br($rec_form['WFS_TXT_C_RIGHT']); ?></textarea>
						<small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_TXT_C_RIGHT_HIGHLIGHT" id="WFS_TXT_C_RIGHT_HIGHLIGHT" type="checkbox" value="Y" <?php echo $rec_form['WFS_TXT_C_RIGHT_HIGHLIGHT']=="Y"?'checked':''; ?>>
							<label for="WFS_TXT_C_RIGHT_HIGHLIGHT">
								แสดง Highlight Label
							</label>
						</div>
					</div>
				</div>
				<!---->
			</div>
		</div>
	</div>
</div>
<?php db::db_close(); ?>