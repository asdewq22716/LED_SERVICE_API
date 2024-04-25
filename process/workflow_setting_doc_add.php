<?php
include '../include/comtop_admin.php'; 

$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);

$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."'");
$rec_detail = db::fetch_array($sql_detail);

?>

    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row"  id="animationSandbox">
				<div class="col-sm-12">
					<div class="main-header">
						<h4>เพิ่มเอกสาร ภายใต้ขั้นตอน<?php echo $rec_detail["WFD_NAME"];?></h4>  
							<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
								<li class="breadcrumb-item"><a href="home.php"><i class="icofont icofont-home"></i></a></li>
								<li class="breadcrumb-item"><a href="workflow.php">บริหาร Workflow</a></li>
								<li class="breadcrumb-item"><a href="workflow.php">งานที่มอบหมาย</a></li>
								<li class="breadcrumb-item"><a href="#">เพิ่มเอกสารแนบ</a></li>
							</ol>
						<div class="f-right">
							<a class="btn btn-danger waves-effect waves-light" href="workflow_step_form.php?W=<?php echo $W;?>&WFD=<?php echo $WFD;?>" role="button"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ </a> 
						</div>
					</div>
				</div>
			</div>
            <!-- Row end -->
			<form method="post" enctype="multipart/form-data" id="form_doc_add" action="workflow_setting_doc_add_function.php" >
            <!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  ข้อมูลทั่วไป</h5>
						</div>
						<div class="card-block">
							<div class="col-md-10">
								<!---->
								<div class="form-group row" >
								  <div class="col-md-3">
									  <label for="DOC_TITLE" class="form-control-label wf-right">ชื่อเอกสาร<span class="text-danger">*</span></label>
									  
								  </div>
								  <div class="col-md-8">
									  <input type="text" class="form-control" name="DOC_TITLE" id="DOC_TITLE"  required>
								  </div>
								</div>
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
									  <label for="DOC_SORT" class="form-control-label wf-right">ลำดับ</label>
								  </div>
								  <div class="col-md-2">
									<?php
									$sql_sort = db::query("select MAX(DOC_SORT) AS DOC_SORT  from DOC_MAIN WHERE WF_MAIN_ID='".$W."' AND WFD_ID='".$WFD."'");
									$d_sort = db::fetch_array($sql_sort);
									$sort = ($d_sort["DOC_SORT"]+1);
									?>
									  <input type="number" class="form-control" name="DOC_SORT" id="DOC_SORT" value="<?php echo $sort;?>">
								  </div> 
								</div>
								<!---->
								<div class="form-group row">
									<div class="col-md-3">
									  <label class="form-control-label wf-right">ประเภทเอกสารแนบ</label>
								  </div>
									
								  <div class="col-md-9">
									<div class="form-radio">
									  <div class="radio"> <!-- radio-inline -->
											<label>
												<input type="radio" name="DOC_TYPE" id="DOC_TYPE1" value="W"  onclick="show_type(this.value);" checked> <!--onclick="show_type(this.value);" -->
													<i class="helper"></i> Smart Word
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="DOC_TYPE" id="DOC_TYPE2" value="L" onclick="show_type(this.value);"><i class="helper" >
													</i> Smart Link 
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="DOC_TYPE" id="DOC_TYPE3" value="D" onclick="show_type(this.value);"><i class="helper" >
													</i> Smart Download 
											</label>
										</div>
									</div>
								  </div>
								</div>
								<!----> 
								<div id="smartword" class="form-group row">
								  <div class="col-md-3">
										<label class="form-control-label wf-right">ไฟล์ Template</label>
								  </div>
								  <div class="col-md-6">
									<div class="md-group-add-on">
										<span class="md-add-on-file">
											<button class="btn btn-primary waves-effect waves-light"><i class="fa fa-file-word-o"></i> เลือกไฟล์ Ms Word</button>
										</span>
										<div class="md-input-file">
											<input type="file" name="DOC_FILE" id="DOC_FILE" class="" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>
									<small class="form-text text-muted">รองรับเฉพาะไฟล์เอกสาร Microsoft Word ในรูปแบบ .docx</small>
								  </div>
								</div>
							<!---->
								<div id="smartlink" class="form-group row"  style="display:none;"> 
								  <div class="col-md-3">
									  <label for="DOC_LINK" class="form-control-label wf-right">Link </label>
									  
								  </div>
								  <div class="col-md-8">

									  <input type="text" class="form-control" name="DOC_LINK"  id="DOC_LINK"   >
									  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
								  </div>
								</div>
							<!---->
							<div id="smartdownload" class="form-group row" style="display:none;">
								  <div class="col-md-3">
										<label class="form-control-label wf-right">ไฟล์อัพโหลด</label>
								  </div>
								  <div class="col-md-6">
									<div class="md-group-add-on">
										<span class="md-add-on-file">
											<button class="btn btn-success waves-effect waves-light"><i class="zmdi zmdi-attachment-alt"></i> เลือกไฟล์</button>
										</span>
										<div class="md-input-file">
											<input type="file" name="DOC_UPLOAD" id="DOC_UPLOAD" class=""  />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>    
								  </div>
							</div>
							<!---->	
							</div>
							
						</div>	
                    </div>
                </div>

            </div>
            <!-- Row end -->
			 
			<div class="row">
				<div class="col-md-12">    
					<div class="f-left">
						<button type="button" class="btn btn-md btn-danger active waves-effect waves-light" onclick="window.location.href='workflow_step_form.php?W=<?php echo $W;?>&WFD=<?php echo $WFD;?>'"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ</button>
					</div>
                    <div class="wf-right">&nbsp;
                        <button type="submit" class="btn btn-md btn-success active waves-effect waves-light" ><i class="icofont icofont-tick-mark"></i> บันทึก</button>
                    </div>
					<input type="hidden" name="W" id="W" value="<?php echo $W;?>">
					<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD;?>">
					<input type="hidden" name="process" id="process" value="DOC_ADD">
					
                </div>
            </div>
			<div class="row">
				<div class="main-header">
				</div>
			</div>
		</form>
	
        <!-- Container-fluid ends -->
     </div>
</div>




<script type="text/javascript">

	function show_type(type){
		if(type == 'W'){
			$('#smartword').show();
			$('#smartlink').hide();
			$('#smartdownload').hide();
			
		}else if(type == 'L'){
			$('#smartword').hide();
			$('#smartlink').show();
			$('#smartdownload').hide();
		}else if(type == 'D'){
			$('#smartword').hide();
			$('#smartlink').hide();
			$('#smartdownload').show();
		}
	
	}

</script>
<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>
