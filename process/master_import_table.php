<?php
set_time_limit(0);
ini_set('max_execution_time','0');
ini_set('memory_limit','3048M');
ini_set('output_buffering',0); 
$WF_TYPE = 'M';
$show_text = '';
include '../include/comtop_admin.php'; 

$TABLE_MASTER = conText($_POST['TABLE_MASTER']);

if($TABLE_MASTER != ''){
	$arr_field = db::show_field($TABLE_MASTER);
	
	$sql_wfr = db::query("SELECT count(WF_MAIN_ID) AS NUM_ROWS_WF FROM WF_MAIN WHERE WF_MAIN_SHORTNAME='".$TABLE_MASTER."'");
	$wf = db::fetch_array($sql_wfr);
	
	if(count($arr_field) > 0){ //มีตารางใน DB
		if($wf["NUM_ROWS_WF"] == 0){//ไม่ได้มีข้อมูลใน WF_MAIN
			
			$show_text = '';
			
			
		}else{
			$show_text = 'ตาราง '.$TABLE_MASTER.' มีการใช้งานอยู่แล้วในระบบ';
			
		}
	}else{ //ไม่มีชื่อตารางที่กรอกใน DB
		$show_text = 'ไม่มีตารางที่ต้องการนำเข้า';
		
	}
	
}


?>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<h4>นำเข้าตารางเป็น Master</h4>
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
			<form method="post" id="form_wf" action="master_import_table.php">
				
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  ตารางนำเข้า</h5>
						</div>
						<div class="card-block">
							<div class="col-md-10">
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
										<label class="form-control-label wf-right">ชื่อ Table ที่ต้องการนำเข้า Master </label>
								  </div>
								  <div class="col-md-8">
									<div class="md-group-add-on">
										<div class="md-input-file">
											<input type="text" name="TABLE_MASTER" id="TABLE_MASTER" class="form-control" value="<?php echo $TABLE_MASTER;?>" required>
										</div>
									</div> 
										<small class="form-text text-muted">- ใส่ชื่อ Table ที่ต้องการ Import เข้า Master</small>
										
								  </div>
								</div> 
								<!----> 
								<!---->
								<?php 
								if($show_text != ''){?>
								<div class="form-group row">
								  <div class="col-md-3">
								  </div>
								  <div class="col-md-8">
									<?php echo $show_text;?>
 								  </div>
								</div>
								<?php }?>
								<!---->
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
								  </div>
								  <div class="col-md-8">
									<button type="submit" class="btn btn-primary waves-effect waves-light" href="#primary" role="button"><i class="icon-login"></i> ตรวจสอบ </button>
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
			<?php if((count($arr_field) > 0) AND $wf["NUM_ROWS_WF"] == 0){ ?>
			<!-- Row Starts -->
				<!-------------Column----------------> 
			<div class="row">
				<form method="post" id="auto_data" action="master_import_table_function.php">
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
									<label for="WF_MAIN_SHORTNAME" class="form-control-label wf-right">ตารางที่เก็บข้อมูล
									</label>
								</div>
								<div class="col-md-3">
									<div class="input-group">
										<!--<span class="input-group-addon">M_</span>-->
										<?php echo $TABLE_MASTER;?>
										<input type="hidden" name="WF_MAIN_SHORTNAME" id="WF_MAIN_SHORTNAME" class="form-control text-uppercase" value="<?php echo $TABLE_MASTER;?>" required>
									</div>
								</div>
							</div>
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
											<th width="10%" class="text-center">PK</th>
											<th width="25%" class="text-center">ชื่อ Field</th>
											<th width="30%" class="text-center">ข้อความที่แสดง</th>
											<th width="25%" class="text-center">ประเภท</th>
											<th width="10%" class="text-center">ขนาด</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										foreach($arr_field as $value){ 
											$rec_form = select_field($TABLE_MASTER, $value)
										
										?>
											<tr> 
												<td class="text-center">
													<label>
														<input type="radio" name="WF_FIELD_PK" id="WF_FIELD_PK" value="<?php echo $i;?>" <?php if($i == 1){ echo 'checked';}?>>
													</label>
												</td>
												<td>
													<?php echo $rec_form['FIELD_NAME']; ?>
													<input type="hidden" name="WFS_FIELD_NAME<?php echo $i;?>" id="WFS_FIELD_NAME<?php echo $i;?>" value="<?php echo $rec_form['FIELD_NAME']; ?>" >
												</td>
												<td>
													<input type="text" name="WFS_NAME<?php echo $i;?>" id="WFS_NAME<?php echo $i;?>" class="form-control" value="<?php echo $rec_form["FIELD_COMMENT"]; ?>" placeholder="ใส่ข้อความที่แสดง" required>
													 
												</td>
												<td>
													<?php 
													
													echo $arr_data_type[strtolower($rec_form['FIELD_TYPE'])]; ?>
													<input type="hidden" name="WFS_FIELD_TYPE<?php echo $i;?>" id="WFS_FIELD_TYPE<?php echo $i;?>" value="<?php echo $arr_data_type[strtolower($rec_form['FIELD_TYPE'])]; ?>" >
												</td>
												<td>
													<?php echo $rec_form["FIELD_LENGTH"];?>
													<input type="hidden" id="WFS_FIELD_LENGTH<?php echo $i;?>" name="WFS_FIELD_LENGTH<?php echo $i;?>" value="<?php echo $rec_form["FIELD_LENGTH"];?>">
												
												</td>
											</tr>
										<?php $i++; } ?>
										<input type="hidden" name="NUM_ROWS" id="NUM_ROWS" value="<?php echo $i;?>">
									</tbody>
								</table>
								</div>
							</div>
						</div> 
					<!--Card--> 
					 

							<div class="card-header">
								<div class="form-group row"> 
									<div class="col-md-12">
									<button type="submit" class="btn btn-success waves-effect waves-light" href="#primary" role="button"><i class="fa fa-save"></i> บันทึก </button> 
									</div>
								</div>
							</div>
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
