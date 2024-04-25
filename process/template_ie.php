<?php include '../include/comtop_admin.php'; ?>
<link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">
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
								<div class="col-md-12">
									 <div id="xxx"></div>
							    </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
			
			<!-- Row Starts -->
 
			<div class="row">
				<div class="main-header">
				</div>
			</div>
		</form>

        <!-- Container-fluid ends -->
     </div>
</div>
<?php include '../include/combottom_js.php'; ?>
	<script>
		function get_wfs_show_ie(obj_target,url,dataString,w_method,show){ 
			$.ajax({
				type: w_method,
				url: url,
				data: dataString,
				cache: false,
				success: function(data){
					if(show=='A'){
						$('#'+obj_target).append(data);
					}else{
						$('#'+obj_target).html(data);
					}
				} 
			 });
		} 
		get_wfs_show_ie('xxx','../form/f.php','','GET','W');
	</script>
<script>
$(document).ready(function() {
 
    
});
</script>
<?php include '../include/combottom_admin.php'; ?>