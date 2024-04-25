<?php 
	require('../include/config.php ');
	///require('../include/include.php '); 
	require('pdf_editor.config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PDF Editor</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
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
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	    <!-- jQuery -->
    <script src="js/jquery.js"></script>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">PDF Editor</a>
            </div>
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#demo">Demo</a></li>
	  <li><a data-toggle="tab" href="#google-vision">Google Vision</a></li>
	</ul>

	<div class="tab-content">
	  <div id="demo" class="tab-pane fade in active">
		<p>
			<div>
				<a class="btn btn-primary" href="<?php echo $config['base_url']; ?>pdf_editor/installer/PDF-Editor-Servce-1.0.17.rar">Download Pdf Editor 1.0.17 (2017-10-18)</a>
				<a class="btn btn-success" href="javascript:callPdfEditorService('http://localhost:379/?service_config=<?php echo base64_encode($config['base_url'].'pdf_editor/pdf_editor.proc.php?proc=getMetaInfo&uploadToken=xxxxxxxx'); ?>');">Add From Scanner</a>
				<a class="btn btn-info" href="javascript:loadGoogleApiKeyToClient('http://localhost:379/?service_config=<?php echo base64_encode($config['base_url'].'pdf_editor/pdf_editor.proc.php?proc=downloadGoogleApiKeyToClient'); ?>');">Load Google Api Key Client</a>
				
				
			</div>
			<br>
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>#</th>
						<th>Thumbnail</th>
						<th>TEMP_CODE</th>
						<th>TEMP_FILE</th>
						<th>USED_SPACE</th>
						<th></th>
					</tr>
					<?php 
					$result = db::query('SELECT * FROM WF_FILE WHERE WFS_FIELD_NAME=\'SCAN_FILE\'');
					while($row = db::fetch_array($result)){ ?>
						<tr>
							<td><?php echo $row['TEMP_DOC_ID']; ?></td>
							<td>
								<?php  if(file_exists ("../fileupload/document_file/thumbnail/".$row['TEMP_THUMBNAIL_FILE'])){ ?>
								<input type="image" style="width:80px;height:80px;" src="<?php echo $config['base_url']; ?>fileupload/document_file/thumbnail/<?php echo $row['TEMP_THUMBNAIL_FILE']; ?>" onclick="alert($(this).attr('src'));" />
								<?php } ?>
								</td>
							<td><?php echo $row['TEMP_CODE']; ?></td>
							<td><?php echo $row['TEMP_FILE']; ?></td>
							<td><?php echo $row['USED_SPACE']; ?></td>
							<td>
							
							<a class="btn btn-info" href="<?php echo $config['base_url'].'pdf_editor/pdf_editor.proc.php?proc=downloadPdf&uploadToken=xxxxxxxx&mode=scanPdf&moduleCode=DOCUMENT_TEMP_FILE&id='.$row['TEMP_DOC_ID']; ?>" target="_blank">View</a>
							
							<div class="btn-group">
								<a class="btn btn-warning" href="<?php echo $config['base_url'].'pdf_editor/pdf_editor.proc.php?proc=downloadPdf&uploadToken=xxxxxxxx&mode=annotatePdf&moduleCode=DOCUMENT_TEMP_FILE&id='.$row['TEMP_DOC_ID']; ?>"<?php echo $row['TEMP_FILE_ANOTATE']?'':' disabled'; ?> target="_blank">Annotate </a>
								<button type="button" class="btn btn-warning" onclick="javascript:callPdfEditorService('http://localhost:379/?service_config=<?php echo base64_encode($config['base_url'].'pdf_editor/pdf_editor.proc.php?proc=getMetaInfo&uploadToken=xxxxxxxx&mode=annotatePdf&moduleCode=DOCUMENT_TEMP_FILE&id='.$row['TEMP_DOC_ID']); ?>');">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
							</div>
							
							
							<div class="btn-group">
								<a class="btn btn-danger" href="<?php echo $config['base_url'].'pdf_editor/pdf_editor.proc.php?proc=downloadPdf&uploadToken=xxxxxxxx&mode=blackMarkerPdf&moduleCode=DOCUMENT_TEMP_FILE&id='.$row['TEMP_DOC_ID']; ?>"<?php echo $row['TEMP_FILE_BLACK_MARKER']?'':' disabled'; ?> target="_blank">Black Marker </a>
								<button type="button" class="btn btn-danger" onclick="javascript:callPdfEditorService('http://localhost:379/?service_config=<?php echo base64_encode($config['base_url'].'pdf_editor/pdf_editor.proc.php?proc=getMetaInfo&uploadToken=xxxxxxxx&mode=blackMarkerPdf&moduleCode=DOCUMENT_TEMP_FILE&id='.$row['TEMP_DOC_ID']); ?>');">
									<span class="glyphicon glyphicon-edit"></span>
								</button>
							</div>
							
							</td>
						</tr>
					<?php 
					} ?>
				</table>
			</div>
		</p>
	  </div>
	  <div id="google-vision" class="tab-pane fade">
		<p>
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
	  </div>
	</div>
        
	</div>
	
<script>
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
	}
</script>
 </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->



    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/sweetalert.min.js"></script>

</body>

</html