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
				<h5 class="card-header-text"><i class="fa fa-code"></i> ตั้งค่า Coding</h5>
			</div>
			<div class="card-block">
				<!---->
				<div class="form-group">
					<div class="col-md-4">
						<div class="form-control-label"><i class="fa fa-th-list"></i> ส่วนหน้า form
						</div>
						<div class="md-group-add-on">
							  <span class="md-add-on-file">
								  <button class="btn btn-success waves-effect waves-light"><i class="fa fa-file-code-o"></i> Coding</button>
							  </span>
							<div class="md-input-file">
								<input type="file" name="WFS_CODING_FORM_FILE" id="WFS_CODING_FORM_FILE" />
								<input type="text" class="md-form-control md-form-file">
								<label class="md-label-file">Upload New File</label>
							</div>
						</div>
						<div class="form-group">
							<label for="WFS_CODING_FORM" class="form-control-label">Filename</label>
							<?php if($rec_form['WFS_CODING_FORM'] != ""){ ?>
							<a href="#!" data-toggle="modal" data-target="#bizModal" onclick="open_modal('wf_editor.php?p=<?php echo wf_encode(wf_encode('../form/'.$rec_form['WFS_CODING_FORM'])); ?>', 'Editor : <?php echo $rec_form['WFS_CODING_FORM']; ?>')">
							<i class="fa fa-edit"></i></a><?php } ?>
							<input type="text" name="WFS_CODING_FORM" id="WFS_CODING_FORM" class="form-control" value="<?php echo $rec_form['WFS_CODING_FORM']; ?>">
							<small class="form-text text-muted">บันทึกใน ../form</small>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-control-label"><i class="fa fa-save"></i> ส่วนหน้า save</div>
						<div class="md-group-add-on">
							  <span class="md-add-on-file">
								  <button class="btn btn-success waves-effect waves-light"><i class="fa fa-file-code-o"></i> Coding</button>
							  </span>
							<div class="md-input-file">
								<input type="file" name="WFS_CODING_SAVE_FILE" id="WFS_CODING_SAVE_FILE" />
								<input type="text" class="md-form-control md-form-file">
								<label class="md-label-file">Upload New File</label>
							</div>
						</div>
						<div class="form-group">
							<label class="form-control-label">Filename</label>
							<?php if($rec_form['WFS_CODING_SAVE'] != ""){ ?>
							<a href="#!" data-toggle="modal" data-target="#bizModal" onclick="open_modal('wf_editor.php?p=<?php echo wf_encode(wf_encode('../save/'.$rec_form['WFS_CODING_SAVE'])); ?>', 'Editor : <?php echo $rec_form['WFS_CODING_SAVE']; ?>')">
							<i class="fa fa-edit"></i></a><?php } ?>
							<input type="text" name="WFS_CODING_SAVE" id="WFS_CODING_SAVE" class="form-control" value="<?php echo $rec_form['WFS_CODING_SAVE']; ?>">
							<small class="form-text text-muted">บันทึกใน ../save</small>
							<?php if($rec_form['WF_TYPE'] == "S"){ ?><small class="form-text text-muted">ตัวแปรสำหรับเชื่อม SQL Statement : $filter</small><?php } ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-control-label"><i class="fa fa-search"></i> ส่วนหน้า view</div>
						<div class="md-group-add-on">
							  <span class="md-add-on-file">
								  <button class="btn btn-success waves-effect waves-light"><i class="fa fa-file-code-o"></i> Coding</button>
							  </span>
							<div class="md-input-file">
								<input type="file" name="WFS_CODING_VIEW_FILE" id="WFS_CODING_VIEW_FILE"/>
								<input type="text" class="md-form-control md-form-file">
								<label class="md-label-file">Upload New File</label>
							</div>
						</div>
						<div class="form-group">
							<label class="form-control-label">Filename</label>
							<?php if($rec_form['WFS_CODING_VIEW'] != ""){ ?>
							<a href="#!" data-toggle="modal" data-target="#bizModal" onclick="open_modal('wf_editor.php?p=<?php echo wf_encode(wf_encode('../view/'.$rec_form['WFS_CODING_VIEW'])); ?>', 'Editor : <?php echo $rec_form['WFS_CODING_VIEW']; ?>')">
							<i class="fa fa-edit"></i></a><?php } ?>
							<input type="text" name="WFS_CODING_VIEW" id="WFS_CODING_VIEW" class="form-control" value="<?php echo $rec_form['WFS_CODING_VIEW']; ?>">
							<small class="form-text text-muted">บันทึกใน ../view</small>
						</div>
					</div>
				</div>
				<!---->
				<div class="form-group">
					<div class="col-md-6">
						<label class="form-control-label">Form Ajax url</label>
						<input type="text" name="WFS_CODING_AJAX" id="WFS_CODING_AJAX" class="form-control" value="<?php echo $rec_form['WFS_CODING_AJAX']; ?>">
						<small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!! ,ตัวแปร GET ให้ใช้ @#GET!!</small>
					</div>
					<div class="col-md-6">
						<?php if($rec_form['WF_TYPE'] == "S"){ ?><label class="form-control-label">ตัวแปร $_GET ที่ต้องการให้ค้นหาอัตโนมัติ</label><?php }else{  ?><label class="form-control-label">ตัวแปร $_POST ที่ต้องการให้บันทึกอัตโนมัติ</label><?php } ?>
						<input type="text" name="WFS_CODING_POST" id="WFS_CODING_POST" class="form-control" value="<?php echo $rec_form['WFS_CODING_POST']; ?>">
						<small class="form-text text-muted">คั่นด้วย (,)</small>
					</div>
				</div>
				<!---->
			</div>
		</div>
	</div>
</div>
<?php db::db_close(); ?>