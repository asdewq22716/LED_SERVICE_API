<?php
set_time_limit(0);
ini_set('max_execution_time','0');
ini_set('memory_limit','3048M');
ini_set('output_buffering',0); 
$WF_TYPE = 'M';
include '../include/comtop_admin.php'; 
//print_r($arr_data_type); 
$data_type_default = key($arr_data_type);
$data_type_selected = $data_type_default;

?>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<h4>นำเข้าตารางและข้อมูล</h4>
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
						<a class="btn btn-success waves-effect waves-light" href="history_import_master.php" role="button">
							<i class="icofont icofont-copy-alt"></i> รายการนำเข้าข้อมูล
						</a>
						<a class="btn btn-danger waves-effect waves-light" href="master.php" role="button">
							<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ
						</a>
					</div>
				</div>
			</div>
		</div>
            <!-- Row end -->
			<!-- Row Starts -->
			<form method="post" enctype="multipart/form-data" id="form_wf" action="master_import.php">
				
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
										<small class="form-text text-muted">- ไฟล์ Template ที่นำเข้า จะเป็นนามสกุล .xls,.xlsx</small>
										<small class="form-text text-muted">- แถวแรกของไฟล์ Excel จะเป็นชื่อ Column ของข้อมูล</small>
										<small class="form-text text-muted">- คอลัมน์แรกของไฟล์ Excel จะเป็น Field Primary Key หากต้องการให้ระบบกำหนดให้ต้องทำเป็นช่องว่างไว้</small>
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
			<?php if($_FILES["excel"]["size"] > 0){ 
				/** PHPExcel */
				require_once '../Classes/PHPExcel.php';

				/** PHPExcel_IOFactory - Reader */
				include '../Classes/PHPExcel/IOFactory.php';
				//$ext = explode('.',$_FILES["excel"]["tmp_name"]["name"]);
				//$extension = strtolower($ext[(count($ext) - 1)]);
				$filename = "m_".date("YmdHis").".xls";
				copy($_FILES["excel"]["tmp_name"],"../import/".$filename);
				@chmod ("../import/".$filename, 0777);
				
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
			
			?>
			<!-- Row Starts -->
				<!-------------Column----------------> 
			<div class="row">
				<form method="post" id="auto_data" action="master_import_function.php">
				<div class="col-md-12">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="fa fa-file-excel-o"></i>  ตั้งค่า Table</h5>
						</div>
						<div class="card-block">
							<div class="form-group row">
								<div class="table-responsive" data-pattern="priority-columns">
									<div class="col-md-3">
										<label for="WF_MAIN_NAME" class="form-control-label wf-right">ชื่อ<span class="text-danger">*</span>
										</label>
									</div>
									<div class="col-md-5">
										<input type="text" class="form-control" name="WF_MAIN_NAME" id="WF_MAIN_NAME" required>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WF_MAIN_SHORTNAME" class="form-control-label wf-right">ตารางที่เก็บข้อมูล <span class="text-danger">*</span>
									</label>
								</div>
								<div class="col-md-3">
									<input type="hidden" name="WF_ALIAS" id="WF_ALIAS" value="M_">
									<div class="input-group">
										<span class="input-group-addon">M_</span>
										<input type="text" name="WF_MAIN_SHORTNAME" id="WF_MAIN_SHORTNAME" class="form-control text-uppercase" placeholder="TABLE NAME"  autocomplete="off" maxlength="22" required>
									</div>
									<small class="text-muted">** ระบุได้เฉพาะ A-Z, 0-9 และ Underscore (_) **</small>
								</div>
							</div>
							<!---->
							<!--<div class="form-group row">
								<div class="col-md-3">
									<label for="WF_FIELD_PK" class="form-control-label wf-right">Primary Key <span class="text-danger">*</span>
									</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control text-uppercase" name="WF_FIELD_PK" id="WF_FIELD_PK" placeholder="Primary Key"   autocomplete="off" maxlength="22" required>
									<small class="text-muted">** ระบุได้เฉพาะ A-Z, 0-9 และ Underscore (_) **</small>
								</div>
							</div>-->
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WF_GROUP_ID" class="form-control-label wf-right">กลุ่ม
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-5">
									<select name="WF_GROUP_ID" id="WF_GROUP_ID" class="select2" required aria-required="true" placeholder="เลือก...">
										<option value=""></option>
										<?php
										$sql_group = db::query("select GROUP_NAME , GROUP_ID from WF_GROUP WHERE WF_TYPE = '".$WF_TYPE."' order by GROUP_ORDER asc");
										while($rec_group = db::fetch_array($sql_group))
										{ ?>
											<option value="<?php echo $rec_group['GROUP_ID']; ?>"><?php echo $rec_group['GROUP_NAME']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<!---->
						</div>
						<div class="card-header"><h5 class="card-header-text"><i class="fa fa-file-excel-o"></i>  ตั้งค่า Column</h5>
						</div>
						<div class="card-block">
							<div class="col-md-12">
								<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
									<thead>
										<tr class="bg-primary">
											<th width="10%" class="text-center"></th>
											<th width="30%" class="text-center">ข้อความที่แสดง</th>
											<th width="25%" class="text-center">ชื่อ Field</th>
											<th width="25%" class="text-center">ประเภท</th>
											<th width="10%" class="text-center">ขนาด</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										foreach($dataRow[$row] as &$value){ ?>
											<tr> 
												<td class="text-center"><?php if($i == 1){ echo 'PK';}?></td>
												<td>
													<input type="text" name="WFS_NAME<?php echo $i;?>" id="WFS_NAME<?php echo $i;?>" class="form-control" value="<?php echo $value; ?>" placeholder="ใส่ข้อความที่แสดง" required>
													 
												</td>
												<td>
													<input type="text" name="WFS_FIELD_NAME<?php echo $i;?>" id="WFS_FIELD_NAME<?php echo $i;?>" autocomplete="off" class="form-control text-uppercase" value="<?php echo $rec_form['WFS_FIELD_NAME']; ?>"  maxlength="22" required>
												</td>
												<td>
												<?php
													if($i == 1){
														$data_type_selected = "number";
														
													}else{
														$data_type_selected = "varchar2";
													}
														
													$field_type_js = "onchange=\"switch_data_type(this.value,'WFS_FIELD_LENGTH".$i."');\" required";
													form_dropdown('WFS_FIELD_TYPE'.$i, $arr_data_type, $data_type_selected, $field_type_js);
													
												?>
												</td>
												<td>
													<input type="number" class="form-control" id="WFS_FIELD_LENGTH<?php echo $i;?>" name="WFS_FIELD_LENGTH<?php echo $i;?>" value="<?php if($i == 1){echo '10';}else{echo '255'; }?>">
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
