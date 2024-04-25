<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php'; 

$W = conText($_GET['W']);
$WFR = conText($_GET['WFR']);
$DOC_ID = conText($_GET['DOC_ID']);
$p_url = 'doc_cuztomize_function.php';
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);

//$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."'");
//$rec_detail = db::fetch_array($sql_detail);

$sql_doc = db::query("SELECT * FROM DOC_MAIN WHERE DOC_ID = '".$DOC_ID."' ");
$rec_doc = db::fetch_array($sql_doc);

$sql_doc_u1 = db::query("SELECT * FROM DOC_USER WHERE DOC_ID = '".$DOC_ID."' AND USR_ID = '".$_SESSION['WF_USER_ID']."' ORDER BY DU_ID DESC ");

$sql_doc_u = db::query("SELECT count(DOC_ID) AS NUM_ROWS FROM DOC_USER WHERE DOC_ID = '".$DOC_ID."' AND USR_ID = '".$_SESSION['WF_USER_ID']."' ORDER BY DU_ID DESC ");
$rec_doc_u = db::fetch_array($sql_doc_u);

?>
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<h3><span class="pull-right"><?php echo '<i class="splashy-download"></i> <a href="../doc/'.$rec_doc['DOC_FILE'].'">Download template เอกสาร</a>&nbsp;'; ?></span>
					<!--<img src="../img/gCons/copy-item.png" alt="" /> เอกสารเพิ่มเติม-->
					</h3>
				</div>
				
				<!--<div class="col-sm-12">
					<div class="main-header">
						<h4>เอกสารเพิ่มเติม</h4>
					</div>
				</div>-->
				<div class="col-md-12">
				<table class="table table-bordered table-striped sorted_table">
					<thead>
						<thead>
							<tr class="bg-primary">
								<th style="width: 80%;" class="text-center">ชื่อเอกสาร</th>
								<th style="width: 20%;" class="text-center">ลบ</th>
							</tr>
						</tr>
					</thead>
					<tbody>
					<?php
					if($rec_doc_u["NUM_ROWS"] > 0){
					while($rec_doc_user = db::fetch_array($sql_doc_u1))
						{
							?><tr>
							<td><?php echo '<i class="splashy-document_letter"></i> <a href="'.$link.'?DOC_ID='.$rec_doc["DOC_ID"].'&WFR='.$_GET['WFR'].'&DU_ID='.$rec_doc_user['DU_ID'].'" target="_blank">'.$rec_doc_user['DU_EDIT_NAME'].'</a> '; ?></td>
							<td><div align="center"><a href="report_browse_more_function.php?W=<?php echo $_GET['W']; ?>&WFR=<?php echo $_GET['WFR']; ?>&DOC=<?php echo $_GET['DOC_ID']; ?>&DU_ID=<?php echo $rec_doc_user['DU_ID']; ?>&process=d_doc" onClick="return confirm('คุณต้องการลบเอกสารนี้หรือไม่?');" class="btn btn-danger btn-mini">ลบ</a></div></td>
						</tr><?php
						}
					}else{?>
						<tr><td colspan="2" class="text-center">ยังไม่มีเอกสาร</td></tr>
					<?php	
					}
					?>
					</tbody>
				</table>   
				
				</div>
				<div class="col-md-12">
					<h6><span>นำเข้าเอกสารเอง</span></h6>
				</div>
				<form action="<?php echo $p_url; ?>" name="doc_step" id="doc_step" method="post" enctype="multipart/form-data">
				<input type="hidden" name="process" id="process" value="add_doc">
				<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
				<input type="hidden" name="DOC_ID" id="DOC_ID" value="<?php echo $DOC_ID; ?>">
				<div class="col-md-12">
					<div class="card">
						<div class="card-block">
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="DU_EDIT_NAME" class="form-control-label wf-right">ชื่อเอกสาร 
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-7">
									<input type="text" id="DU_EDIT_NAME" name="DU_EDIT_NAME" placeholder="ชื่อเอกสาร" class="form-control" required>
								</div>
							</div>
							<!---->
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="DU_FILE_NAME" class="form-control-label wf-right">เอกสารเพิ่มเติม
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-7">
									<span class="md-add-on-file">
										<button class="btn btn-primary waves-effect waves-light"><i class="fa fa-file-word-o"></i> เลือกไฟล์ Ms Word</button>
									</span>
									<div class="md-input-file">
										<input type="file" name="DU_FILE_NAME" id="DU_FILE_NAME" class="" accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
										<input type="text" class="md-form-control md-form-file">
										<label class="md-label-file"></label>
									</div>
									
									
								</div>
							</div>
							<!---->
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12 text-center">
						<button type="submit" class="btn btn-md btn-success active waves-effect waves-light">
								<i class="icofont icofont-tick-mark"></i> บันทึก
						</button>
					</div>
				</div>
				</form>
			</div>
			
			<div class="row">
				<div class="main-header">
				</div>
			</div>
		<!-- Container-fluid ends -->

<?php
include '../include/combottom_user.php';
?>