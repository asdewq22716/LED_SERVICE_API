<?php
set_time_limit(0);
ini_set('max_execution_time','0');
ini_set('memory_limit','3048M');
ini_set('output_buffering',0); 
include '../include/comtop_admin.php';
?>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<h4>นำเข้า Module</h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item">
							<a href="index.php"><i class="icofont icofont-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="module_list.php">บริหาร Module</a>
						</li>
						<li class="breadcrumb-item">
							<a href="#">นำเข้าข้อมูล</a>
						</li>
					</ol>
					<div class="f-right"> 
						<a class="btn btn-danger waves-effect waves-light" href="module_list.php" role="button">
							<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ
						</a>
					</div>
				</div>
			</div>
		</div>
            <!-- Row end -->
			<!-- Row Starts -->
			<form method="post" enctype="multipart/form-data" id="form_wf" action="module_import.php">
				
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  ไฟล์นำเข้า</h5>
						</div>
						<div class="card-block">
							<div class="col-md-10">
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
										<label class="form-control-label wf-right">ไฟล์ </label>
								  </div>
								  <div class="col-md-8">
									<div class="md-group-add-on">
										<span class="md-add-on-file">
											<button class="btn btn-success waves-effect waves-light"><i class="fa fa-file-excel-o"></i> เลือกไฟล์</button>
										</span>
										<div class="md-input-file">
											<input type="file" name="db" id="db" class=""  />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>  
								  </div>
								</div> 
								<!----> 
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
								  </div>
								  <div class="col-md-8">
									<button type="submit" class="btn btn-primary waves-effect waves-light" href="#primary" role="button"><i class="icon-login"></i> นำเข้า </button>
 								  </div>
								</div>
								<!---->
							</div>
							
						</div>	
                    </div>
                </div>

            </div>
			</form>
            <!-- Row end -->
			<?php if($_FILES["db"]["size"] > 0){ 

				$filename = "i_".date("YmdHis").".db";
				copy($_FILES["db"]["tmp_name"],"../import/".$filename);
				@chmod ("../import/".$filename, 0777);
				
				$db = new PDO('sqlite:../import/'.$filename); 
			
			?>
			<!-- Row Starts -->
				<!-------------Column----------------> 
			<div class="row">
				<form method="post" id="auto_data" action="master_import_function.php">
				<div class="col-md-12">
                    <div class="card"> 
						<div class="card-header"><h5 class="card-header-text"><i class="fa fa-file-excel-o"></i>  รายการ Module</h5>
						</div>
						<div class="card-block">
							<div class="col-md-12">
								<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
									<thead>
										<tr class="bg-primary">
											<th width="60%" class="text-center">ชื่อ Module</th>
											<th width="40%" class="text-center">กลุ่ม</th>
										</tr>
									</thead>
									<tbody>
										<?php
									$text = "SELECT * FROM WF_MAIN ";
									$sql_list=$db->query($text);
										$i=0;
										while($R=$sql_list->fetch()){ ?>
											<tr> 
												<td class="text-left"><?php echo $R['WF_MAIN_NAME']; ?></td>
												<td class="text-left">
												<select name="WF_GROUP_ID<?php echo $i; ?>" id="WF_GROUP_ID<?php echo $i; ?>" class="select2" required aria-required="true" placeholder="เลือก...">
										<option value=""></option>
										<?php
										$sql_group = db::query("select GROUP_NAME , GROUP_ID from WF_GROUP WHERE WF_TYPE = '".$R['WF_TYPE']."' order by GROUP_ORDER asc");
										while($rec_group = db::fetch_array($sql_group))
										{ ?>
											<option value="<?php echo $rec_group['GROUP_ID']; ?>"><?php echo $rec_group['GROUP_NAME']; ?></option>
										<?php } ?>
									</select></td>
											</tr>
										<?php $i++; } ?>
									</tbody>
								</table>
								</div>
							</div>
						</div> 
					<!--Card--> 
					 

							<div class="card-header">
								<div class="form-group row"> 
									<div class="col-md-12 text-center">
									<button type="submit" class="btn btn-success waves-effect waves-light" href="#primary" role="button"><i class="fa fa-save"></i> บันทึก </button> 
									</div>
								</div>
							</div>
							
							<input type="hidden" name="filename" id="filename" value="<?php echo $filename;?>" />
							<input type="hidden" name="process" id="process" value="ADD" />
							
							
						<!---->	
						</div>	
                    </div>
					<!--Card-->
                </div>
				</form>
            </div>
			<?php $db->NULL; } ?>
            <!-- Row end --> 
			<div class="row">
				<div class="main-header">
				</div>
			</div>
		
	
        <!-- Container-fluid ends -->
     </div>
</div>

<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>
