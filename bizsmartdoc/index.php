<base href="../process/"><?php 

	if(isset($_POST['bt_save'])){
		try{
			$str_code = '<?php /*$config = array(\'base_url\'=>\'http://domain/workflow_present/\',\'max_ocr_length\'=>8001);*/ $config = array(\'base_url\'=>\''.$_POST['base_url'].'\',\'max_ocr_length\'=>'.($_POST['max_ocr_length']*1).'); ?>';
			$ret_write = file_put_contents('bizsmartdoc.config.php',$str_code);
			if($ret_write===false){
				throw new Exception('Error,Couldn\'t save config');
			}
			$msg_result = "The config is saved";
			
		}catch(Exception $ex){
			$msg_result = $ex->getMessage();
		}
	}
	
//	require('../include/config.php ');
	//require('../include/include.php '); 
	require('bizsmartdoc.config.php');
	
	require '../include/comtop_admin.php';
?>

	<style>
		.btn-file {
			position: relative;
			overflow: hidden;
		}
		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
		}
	</style>
	


	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<h4>BizSmartDoc</h4>
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12 col-lg-12">
					<div class="card">
					<!-- Include step form -->
					
						<div class="card-block tab-icon">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs md-tabs " role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#setting" role="tab"><i class="fa fa-retweet"></i> Setting</a>
									<div class="slide"></div>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#download" role="tab"><i class="fa fa-object-group"></i> Download <span id="wf_group_field_show"></span></a>
									<div class="slide"></div>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#howto" role="tab"><i class="fa fa-object-group"></i> How to use <span id="wf_group_field_show"></span></a>
									<div class="slide"></div>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#whatsnew" role="tab"><i class="fa fa-object-group"></i> What's New <span id="wf_group_field_show"></span></a>
									<div class="slide"></div>
								</li>
							</ul>
							<div class="tab-content">
								<!-- Row Starts -->
								<div class="row tab-pane active" id="setting" role="tabpanel">
									<div class="col-md-12">
										
										<form action="../bizsmartdoc/index.php" method="post">
											<div class="form-group">
											  <label for="base_url">BASE URL:</label>
											  <input type="text" class="form-control" id="base_url" placeholder="BASE URL" name="base_url" value="<?php echo $config['base_url']; ?>">
											</div>
											<div class="form-group">
											  <label for="base_url">Max ORC length:</label>
											  <input type="text" class="form-control" id="max_ocr_length" placeholder="Max ORC length" name="max_ocr_length" value="<?php echo $config['max_ocr_length']; ?>">
											</div>
											<!--div class="form-group">
											  <label for="token_file">Google ORC File Key:</label>
											  <input type="file" class="form-control" id="token_file" placeholder="Select token_file" name="token_file">
											</div-->
											<?php echo $msg_result.'<br>'; ?>
											<button type="submit" class="btn btn-primary" name="bt_save">Submit</button>
										</form>
										
											
											
										
										<br>
									</div>
								</div>
														
								<div class="row tab-pane" id="download" role="tabpanel">
									<div class="col-md-12">
										<br>
										<table class="table table-striped" style="width:100%;max-width:1000px;">
											<thead>
											  <tr>
												<th style="width:30%">File Name</th>
												<th style="width:50%">Description</th>
												<th style="width:20%">Size</th>
											  </tr>
											</thead>
											<tbody>
											  <tr>
												<td><a href="../bizsmartdoc/download/BizSmartDoc Service v1.19.0225.00.zip">BizSmartDoc Service v1.19.0225.00.zip</a></td>
												<td>BizSmartDoc</td>
												<td class="text-right"><?php echo number_format(@filesize('download/BizSmartDoc Service v1.19.0225.00.zip')/1024/1024,2); ?>MB</td>
											  </tr>
											  <tr>
												<td><a href="../bizsmartdoc/download/BizSmartDoc Service v1.18.1228.00.zip">BizSmartDoc Service v1.18.1228.00.zip</a></td>
												<td>BizSmartDoc</td>
												<td class="text-right"><?php echo number_format(@filesize('download/BizSmartDoc Service v1.18.1228.00.zip')/1024/1024,2); ?>MB</td>
											  </tr>
											  <tr>
												<td><a href="../bizsmartdoc/download/twainds.win32.installer.2.1.3.zip">twainds.win32.installer.2.1.3.msi</a></td>
												<td>Virtual Scanner</td>
												<td class="text-right"><?php echo number_format(@filesize('download/twainds.win32.installer.2.1.3.zip')/1024/1024,2); ?>MB</td>
											  </tr>
											  <tr>
												<td></td>
												<td></td>
												<td></td>
											  </tr>
											</tbody>
										  </table>
									</div>
								</div>
								<div class="row tab-pane" id="howto" role="tabpanel">
									<div class="col-md-12 text-center">
										<br />
										<iframe width="1000" height="393.75" src="https://www.youtube-nocookie.com/embed/8mng3gAV5Zw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									</div>
								</div>
								<div class="row tab-pane" id="whatsnew" role="tabpanel">
									<div class="col-md-12">
										<br />
										<br />
										<h4>Version 1.19.0225.00</h4>
										<p>
											-แก้ไขบัคไฟล์ล็อค
										</p>
											
											
										
										<br>
									</div>

									<div class="col-md-12">
										<br />
										<br />
										<h4>Version 1.18.1228.00</h4>
										<p>
											-แก้ไข App info เช่น ชื่อ app (เป็น BizSmartDoc), หน่วยงานเจ้าของ app (Bizpotential co., ltd) และไอคอน (หลอดไฟส้ม) <br />
											-แก้ไขปิดเมนู/ฟังก์ชันเลือกไฟล์จากเครือง เพื่อเลี่ยงไฟล์ล็อค (แก้ที่ปลายเหตุ)<br />
											-พัฒนาหน้าหลังบ้านใช้ตั้งค่า base url ให้สามารถเปลี่ยน domain name โคยไม่ต้องแก้โค้ด (<a href="http://103.208.27.224/workflow_present/bizsmartdoc/">http://103.208.27.224/workflow_present/bizsmartdoc/</a>)<br />
											-ส่งค่า text ocr ไปยัง &lt;input type="hidden" /&gt; (ยังไม่สามารถใช้งานได้ จนว่าพี่ม่อนจะเพิ่มคอลัม orc_text ในตาราง WF_FILE)<br />
											
										</p>
											
											
										
										<br>
									</div>
								</div>
								<!--div id="google-vision" class="tab-pane fade">
								<p>
									<!--a class="btn btn-success" href="javascript:callPdfEditorService('http://localhost:379/?service_config=<?php echo base64_encode($config['base_url'].'pdf_editor/pdf_editor.proc.php?proc=getMetaInfo&uploadToken=xxxxxxxx'); ?>');">Add From Scanner</a>
										<a class="btn btn-info" href="javascript:loadGoogleApiKeyToClient('http://localhost:379/?service_config=<?php echo base64_encode($config['base_url'].'pdf_editor/pdf_editor.proc.php?proc=downloadGoogleApiKeyToClient'); ?>');">Load Google Api Key Client</a--><!--
									<form id="google-vision-form" action="./pdf_editor.proc.php?proc=uploadGoogleApiKey"  enctype="multipart/form-data" class="form-horizontal">
										<div class="form-group">
											<label class="control-label" for="googlevision_key">ไฟล์สำหรับ Authen Google Vision:</label>
											<?php 
											$filepath='./application_data/google-api-key.json.encrypted';
											if(file_exists($filepath)){
												echo 'google-api-key.json.encrypted ('.(filesize($filepath)/1024).' KB)';
											}else{
												echo '<i>ไม่พบไฟล์</i>';
											}
											?>
											<span class="btn btn-default btn-file">
												Browse <input type="file" name="googlevision_key" id="googlevision_key" accept=".json" />
											</span>
										</div>
										<br />
										<button class="btn btn-primary" type="button" onclick="uploadFile();">Upload file</button>
									</form>
								</p>
								</div-->
							</div>

						</div>
					</div>
				</div>
			</div>
        </div>
	</div>
	
	<script>
		/*
		function uploadFile(){
			$.ajax({
			   url : $('#google-vision-form').attr('action'),
			   type: 'POST',
			   data: new FormData($('#google-vision-form')[0]),
			   async: false,
			   cache: false,
			   dataType: "json",
			   contentType: false,
			   enctype: 'multipart/form-data',
			   processData: false,
			   success : function(data) {
				   if(data.result=='OK'){
						swal({ title: "Success!", text: "Your file was saved.", type: "success"},
						function(){
							//dosomething
						});
						
					}else{
						swal("Error!", "Your file wasn't saved.", "error");
					}
			   },
				error: function(xhr, ajaxOptions, thrownError) {
				   swal("Error!", "Cannot Connect to the service.", "error");
				}
			});
		}
		function callPdfEditorService(app_url){
			$.ajax({
				url: app_url,
				type: 'get',
				dataType: "json",
				cache: false,
				beforeSend: function() {
					swal({
					  title: "",
					  imageUrl: 'images/loading.gif',
					  showConfirmButton: false
					});
				},
				success: function(data){
					if(data.result=='OK'){
						swal({ title: "Success!", text: data.message, type: "success"},
						function(){location.reload();});
						
					}else{
						swal("Error!", data.message, "error");
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
				   swal("Error!", "Cannot Connect to the service.", "error");
				}
			});
		}
		function loadGoogleApiKeyToClient(app_url){
			$.ajax({
				url: app_url,
				type: 'get',
				dataType: "json",
				cache: false,
				beforeSend: function() {
					swal({
					  title: "",
					  imageUrl: 'images/loading.gif',
					  showConfirmButton: false
					});
				},
				success: function(data){
					if(data.result=='OK'){
						swal({ title: "Success!", text: "Google API Key has been updated.", type: "success"},
						function(){
							//do nothing
						});
						
					}else{
						swal("Error!", "Google API Key hasn't updated.", "error");
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
				   swal("Error!", "Cannot Connect to the service.", "error");
				}
			});
		}*/
	</script>



	<script src="js/sweetalert.min.js"></script>

<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>