<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$WG = conText($_GET['WG']);
$WT = conText($_GET['WT']);

$sql_form = db::query("select * from WF_WIDGET where WG_ID = '".$WG."' ");
$rec_form = db::fetch_array($sql_form);
?>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-header-text"><i class="fa fa-code"></i> ตั้งค่า Coding</h5>
			</div>
			<div class="card-block">
				<!---->
				<div class="form-group">
					<div class="col-md-8">
						<div class="form-control-label"><i class="fa fa-th-list"></i>ไฟล์ include
						</div>
						<div class="md-group-add-on">
							  <span class="md-add-on-file">
								  <button class="btn btn-success waves-effect waves-light"><i class="fa fa-file-code-o"></i> Coding</button>
							  </span>
							<div class="md-input-file">
								<input type="file" name="WG_CODING_INCLUDE_FILE" id="WG_CODING_INCLUDE_FILE" />
								<input type="text" class="md-form-control md-form-file">
								<label class="md-label-file">Upload New File</label>
							</div>
						</div>
						<div class="form-group">
							<label for="WG_CODING_INCLUDE" class="form-control-label">Filename</label>
							<?php if($rec_form['WG_CODING_INCLUDE'] != ""){ ?>
							<a href="#!" data-toggle="modal" data-target="#bizModal" onclick="open_modal('wf_editor.php?p=<?php echo wf_encode(wf_encode('../dashboard/'.$rec_form['WG_CODING_INCLUDE'])); ?>', 'Editor : <?php echo $rec_form['WG_CODING_INCLUDE']; ?>')">
							<i class="fa fa-edit"></i></a><?php } ?>
							<input type="text" name="WG_CODING_INCLUDE" id="WG_CODING_INCLUDE" class="form-control" value="<?php echo $rec_form['WG_CODING_INCLUDE']; ?>">
							<small class="form-text text-muted">บันทึกใน ../dashboard</small>
						</div>
						<div class="form-group">
						<label class="form-control-label">Form Ajax url</label>
						<input type="text" name="WG_CODING_AJAX" id="WG_CODING_AJAX" class="form-control" value="<?php echo $rec_form['WG_CODING_AJAX']; ?>">
						<small class="form-text text-muted">ต้องการส่งค่า $_GET ให้ใช้ @#_GET!!</small>
					</div>
					</div>
				</div>
				<!---->
			</div>
		</div>
	</div>
<?php db::db_close(); ?>