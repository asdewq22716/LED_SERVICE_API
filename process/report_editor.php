<?php
include '../include/comtop_admin.php';
?>
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			<div class="row" id="animationSandbox">
				<div class="col-sm-12">
					<div class="main-header">
						<h4>Report Management</h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item">
								<a href="index.php"><i class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item">
								<a href="workflow.php">บริหาร Workflow</a>
							</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- Row end -->
			 
			<form method="post" action="report_editor_show.php" enctype="multipart/form-data" id="form_wf" target="_blank">
				<!-- Row Starts -->
				<div class="row">
					 <!-- Document Editor start  -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">Report Editor</h5>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-12">

                                        <textarea name="show" id="editor2">
                                            &lt;pre&gt;
&lt;code class="language-javascript"&gt;var cow = new Mammal( "moo", {
	legs: 4
} );&lt;/code&gt;&lt;/pre&gt;
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Document Editor end -->
					<!-- Config start  -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-header-text">Config</h5>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-12">
										<div class="form-group">
											<label for="exampleTextarea" class="form-control-label">#1#</label>
												<textarea name="sql1" class="form-control" id="exampleTextarea" rows="4"></textarea>
										</div>
										<div class="form-group">
											<label for="exampleTextarea" class="form-control-label">#2#</label>
												<textarea name="sql2" class="form-control" id="exampleTextarea" rows="4"></textarea>
										</div>
										<div class="form-group">
											<label for="exampleTextarea" class="form-control-label">#3#</label>
												<textarea name="sql3" class="form-control" id="exampleTextarea" rows="4"></textarea>
										</div>
                                    </div>
                                </div>
                            </div>
							<div class="card-header">
                                <h5 class="card-header-text">Table</h5>
                            </div>
							<div class="card-block">
                                <div class="row">
                                    <div class="col-md-12">
										<div class="form-group">
											<label for="exampleTextarea" class="form-control-label">#TB1#</label>
												<textarea name="tb1" class="form-control" id="exampleTextarea" rows="4"></textarea>
										</div>
										<div class="form-group">
											<label for="exampleTextarea" class="form-control-label">#TB2#</label>
												<textarea name="tb2" class="form-control" id="exampleTextarea" rows="4"></textarea>
										</div>
										<div class="form-group">
											<label for="exampleTextarea" class="form-control-label">#TB3#</label>
												<textarea name="tb3" class="form-control" id="exampleTextarea" rows="4"></textarea>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Config end -->
				</div>
				<!-- Row end -->
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
<!-- ck editor -->
<script src="../assets/plugins/ckeditor/ckeditor.js"></script>

<!-- custom js -->
<script>
/*document ckeditor*/
    CKEDITOR.replace('editor2', { 
        customConfig: '',
        disallowedContent: 'img{width,height,float}',
		
        imageUploadUrl: '/uploader/upload.php?type=Images',
        height: 800,
        contentsCss: ['../assets/plugins/ckeditor/contents.css', '../assets/plugins/ckeditor/document.css'],
        bodyClass: 'document-editor',
        format_tags: 'p;h1;h2;h3;pre',
        removeDialogTabs: 'image:advanced;link:advanced',
        stylesSet: [
            {
                name: 'Marker',
                element: 'span',
                attributes: {
                    'class': 'marker'
                }
            }, {
                name: 'Cited Work',
                element: 'cite'
            }, {
                name: 'Inline Quotation',
                element: 'q'
            },
            {
                name: 'Special Container',
                element: 'div',
                styles: {
                    padding: '5px 10px',
                    background: '#eee',
                    border: '1px solid #ccc'
                }
            }, {
                name: 'Compact table',
                element: 'table',
                attributes: {
                    cellpadding: '5',
                    cellspacing: '0',
                    border: '0',
                    bordercolor: '#ccc'
                },
                styles: {
                    'border-collapse': 'collapse'
                }
            }, {
                name: 'Borderless Table',
                element: 'table',
                styles: {
                    'border-style': 'hidden',
                    'background-color': '#E6E6FA'
                }
            }, {
                name: 'Square Bulleted List',
                element: 'ul',
                styles: {
                    'list-style-type': 'square'
                }
            }
        ]
    });
</script>

<?php include '../include/combottom_admin.php'; ?>