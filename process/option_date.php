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
				<h5 class="card-header-text"><i class="fa fa-reorder"></i> ตั้งค่าวันที่</h5>
			</div>
			<div class="card-block">
				<!---->
				<div class="form-group row">
					<div class="col-md-12">
						<div class="checkbox-color checkbox-primary">
							<input name="WFS_CALENDAR_EN" id="WFS_CALENDAR_EN" type="checkbox" value="Y" <?php if($rec_form['WFS_CALENDAR_EN']=="Y"){ echo "checked"; } ?>>
							<label for="WFS_CALENDAR_EN">
								ปฏิทินรูปแบบ ค.ศ.
							</label>
						</div>

					</div>
				</div>
				<!---->
				<!---->
				<div class="form-group row">
					<div class="col-md-12">
						<label for="WFS_ONCHANGE" class="form-control-label">การคำนวณวันที่</label>
							<textarea name="WFS_ONCHANGE" id="WFS_ONCHANGE" class="form-control" rows="5"><?php echo $rec_form['WFS_ONCHANGE']; ?></textarea>
							<small class="form-text text-muted">ถ้าเป็นตัวแปรในระบบ ให้ขึ้นต้นด้วย "@"</small>
					</div>
				</div>
				<!---->
				
			</div>
		</div>
	</div>
</div>
<?php db::db_close(); ?>