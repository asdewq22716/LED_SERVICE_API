<?php
set_time_limit(0);
ini_set('max_execution_time','0');
ini_set('memory_limit','3048M');
ini_set('output_buffering',0); 
$WF_TYPE = 'M';
include '../include/comtop_admin.php'; 
$W = conText($_REQUEST["W"]);

?>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<h4>นำเข้าข้อมูล Master</h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item">
							<a href="index.php"><i class="icofont icofont-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="master.php">บริหาร Master</a>
						</li>
						<li class="breadcrumb-item">
							<a href="#">นำเข้าข้อมูล</a>
						</li>
					</ol>
					<div class="f-right">
						<a class="btn btn-danger waves-effect waves-light" href="master.php" role="button">
							<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ
						</a>
					</div>
				</div>
			</div>
		</div>
            <!-- Row end -->
			<!-- Row Starts -->
			<form method="post" enctype="multipart/form-data" id="form_wf" action="master_import_data.php">
				
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
										<label class="form-control-label wf-right">ไฟล์ Excel</label>
								  </div>
								  <div class="col-md-8">
									<div class="md-group-add-on">
										<span class="md-add-on-file">
											<button class="btn btn-success waves-effect waves-light"><i class="fa fa-file-excel-o"></i> เลือกไฟล์ Excel</button>
										</span>
										<div class="md-input-file">
											<input type="file" name="excel" id="excel" class="" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div> 
										<small class="form-text text-muted">-ไฟล์ Template ที่นำเข้า จะเป็นนามสกุล .xls,.xlsx</small>
										<small class="form-text text-muted">-แถวแรกของไฟล์ Excel จะเป็นชื่อ Column ของข้อมูล</small>
								  </div>
								</div> 
								<!----> 
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
								  </div>
								  <div class="col-md-8">
									<button type="submit" class="btn btn-primary waves-effect waves-light" href="#primary" role="button"><i class="icon-login"></i> นำเข้า </button>
									<input type="hidden" name="W" id="W" value="<?php echo $W;?>" />
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
			<?php if($_FILES["excel"]["size"] > 0){ 
				/** PHPExcel */
				require_once '../Classes/PHPExcel.php';

				/** PHPExcel_IOFactory - Reader */
				include '../Classes/PHPExcel/IOFactory.php';

				$filename = "m_".date("YmdHis").".xls";
				copy($_FILES["excel"]["tmp_name"],"../import/".$filename);
				@chmod ("import/".$filename, 0777);
				
				$strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"])));
				$inputFileName = "../import/".$filename;

				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
				$objReader->setReadDataOnly(true);
				$objPHPExcel = $objReader->load($inputFileName); 

				///

				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
				$highestRow = $objWorksheet->getHighestRow();
				$highestColumn = $objWorksheet->getHighestColumn();
				$row = 1;
				$dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
				
				if($W != ''){
					$sql_data = db::query("SELECT WF_MAIN_SHORTNAME FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
					$rec_main =db::fetch_array($sql_data);
					$WF_ARR_FIELD = db::show_field($rec_main["WF_MAIN_SHORTNAME"]);
					
				}
			
			?>
			<!-- Row Starts -->
				<!-------------Column----------------> 
			<div class="row">
				<form method="post" id="auto_data" action="master_import_data_function.php">
				<div class="col-md-12">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="fa fa-file-excel-o"></i>  ตั้งค่า Field นำเข้าข้อมูล </h5>
						</div>
						<div class="card-block">
							<div class="col-md-12">
								<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
									<thead>
										<tr class="bg-primary">
											<th width="10%" class="text-center">ลำดับ</th>
											<th width="30%" class="text-center">ข้อความที่แสดงใน Excel</th>
											<th width="25%" class="text-center">ชื่อ Field</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										foreach($dataRow[$row] as &$value){ ?>
											<tr> 
												<td class="text-center"><?php echo $i;?></td>
												<td>
													<?php echo $value; ?>
												</td>
												<td>
													<select name="WFS_FIELD_NAME<?php echo $i;?>" id="WFS_FIELD_NAME<?php echo $i;?>" class="form-control select2">
														<?php
														if(count($WF_ARR_FIELD) > 0){
															foreach($WF_ARR_FIELD as $key => $value){?>
																<option value="<?php echo $value;?>" <?php if(($key+1) == $i){ echo " selected"; } ?>><?php echo $value;?></option>
														<?php		
															}
														}
														?>
													</select>
												</td>
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
									<div class="col-md-12" style="text-align:center;">
										<button type="submit" class="btn btn-success waves-effect waves-light" href="#primary" role="button"><i class="fa fa-save"></i> บันทึก </button> 
									</div>
								</div>
							</div>
							
							<input type="hidden" name="filename" id="filename" value="<?php echo $filename;?>" />
							<input type="hidden" name="W" id="W" value="<?php echo $W;?>" />
						<!---->	
						</div>	
                    </div>
					<!--Card-->
                </div>
				</form>
            </div>
			<?php } ?>
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
