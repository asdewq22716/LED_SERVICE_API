<?php include '../include/comtop_admin.php'; ?>
<!--link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">-->
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row">
                <div class="col-sm-7">
                    <div class="main-header">
                        <h4>Title</h4>
						<h5>Description</h5>
                        <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Icons</a>
                            </li>
                            <li class="breadcrumb-item"><a href="test.php">Grid-Stack</a>
                            </li>
                        </ol>
                    </div>
                </div>
				<div class="col-sm-5">
                    <div class="main-header f-right">
                        <h5>Title</h5>
						<h6>Title</h6>
                    </div>
                </div>
            </div>
    <link href="../assets/summernote/summernote-lite.css" rel="stylesheet">
    <script src="../assets/summernote/summernote-lite.js"></script>
	<style>
	.note-icon-caret{
		display:none;
	}
	</style>
            <!-- Row end -->
			<form method="post" enctype="multipart/form-data" id="form_wf">
            <!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">
										ข้อมูล
                            </h5>
                        </div> 
                        <div class="card-block"> 
							<div class="form-group row">
								<div class="col-md-2">
								  <label class="form-control-label wf-right">รายละเอียด</label>
							  </div>
								
							  <div class="col-md-10">
								<textarea id="summernote" name="editordata"></textarea>
<script> $('#summernote').summernote({ height: 300, lang: 'th-TH' }); </script>
							  </div>
							</div>
							
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
			
			<div class="row">
				<div class="col-md-12">    
					<div class="f-left">
						<button type="button" class="btn btn-md btn-primary active waves-effect waves-light"><i class="icofont icofont-home"></i> กลับหน้าหลัก</button>
					</div>
                    <div class="wf-right">&nbsp;
						<button type="button" class="btn btn-md btn-danger active waves-effect waves-light"><i class="icofont icofont-arrow-left"></i> ย้อนขั้นตอน</button>&nbsp;
						<button type="button" class="btn btn-md btn-warning active waves-effect waves-light"><i class="icofont icofont-diskette"></i> บันทึกชั่วคราว</button>&nbsp;
                        <button type="submit" class="btn btn-md btn-success active waves-effect waves-light"><i class="icofont icofont-tick-mark"></i> บันทึก</button>
                    </div>
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
<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>