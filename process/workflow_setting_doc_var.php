<?php
include '../include/comtop_admin.php'; 


$DOC_ID = conText($_GET['DOC_ID']);
$W = conText($_GET['W']);
$sql_doc = db::query("select * from DOC_MAIN where DOC_ID='".$DOC_ID."' "); 
$rec_doc = db::fetch_array($sql_doc);


$W = $rec_doc['WF_MAIN_ID'];
$WFD = $rec_doc['WFD_ID'];

$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec = db::fetch_array($sql);


$sql_detail = db::query("select * from WF_DETAIL where WFD_ID = '".$WFD."'");
$rec_detail = db::fetch_array($sql_detail);

$WF_ARR_FIELD = array();
$WF_ARR_NAME = array();


?>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<h4><?php echo $rec['WF_MAIN_NAME']; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item">
								<a href="index.php"><i class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item">
								<a href="workflow.php">บริหาร Workflow</a>
							</li>
							<li class="breadcrumb-item">
								<a href="workflow_detail.php?W=<?php echo $W; ?>">บริหารขั้นตอน</a>
							</li>
							<li class="breadcrumb-item">
								<a href="workflow_step_form.php?W=<?php echo $W; ?>&WFD=<?php echo $WFD;?>">บริหาร Field</a>
							</li>
							<li class="breadcrumb-item">
								<a href="#!">แก้ไขเอกสารประกอบ</a>
							</li>
						</ol>
						<div class="f-right">
							<div class="f-right m-t-20">
							<a class="btn btn-danger waves-effect waves-light" href="workflow_step_form.php?W=<?php echo $W; ?>&WFD=<?php echo $WFD;?>" role="button">
								<i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ
							</a>
						</div>
						</div>
					</div>
				</div>
			</div>
            <!-- Row end -->
			<?php
			if($rec_doc["DOC_TYPE"] == 'D'){?>
            <!-- Row Starts -->
			<form method="post" enctype="multipart/form-data" id="form_wf" action="workflow_setting_doc_add_function.php">
				
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  ข้อมูลทั่วไป</h5>
						</div>
						<div class="card-block">
							<div class="col-md-10">
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
									  <label for="DOC_TITLE" class="form-control-label wf-right">ชื่อเอกสาร<span class="text-danger">*</span></label>
								  </div>
								  <div class="col-md-8">
									  <input type="text" class="form-control" name="DOC_TITLE" id="DOC_TITLE" value="<?php echo $rec_doc["DOC_TITLE"];?>"  required>
								  </div>
								</div> 
								<!----> 
								
								<div class="form-group row">
								  <div class="col-md-3">
										<label class="form-control-label wf-right">ไฟล์เอกสารใหม่</label>
								  </div>
								  <div class="col-md-8">
									<div class="md-group-add-on">
										<span class="md-add-on-file">
											<button class="btn btn-success waves-effect waves-light"><i class="fa fa-file-word-o"></i> เลือกไฟล์เอกสาร Download</button>
										</span>
										<div class="md-input-file">
											<input type="file" name="DOC_UPLOAD" id="DOC_UPLOAD" class=""  />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>  
									<div>
									<?php 
									if(file_exists('../doc/'.$rec_doc["DOC_FILE"])){?>
										<li><a href="../doc/<?php echo $rec_doc["DOC_FILE"];?>" target="_blank"><?php echo $rec_doc["DOC_TITLE"];?></a></i>
									<?php }?>
									</div>									
								  </div>
								</div> 
								
								<!---->
								<!---->
								<div class="form-group row">
									<div class="col-md-3"> 
								  </div>
									
								   <div class="col-md-5">  
									<div class="checkbox-color checkbox-primary">
										<input id="DOC_STATUS" name="DOC_STATUS" type="checkbox" value="Y" <?php if($rec_doc["DOC_STATUS"] == 'Y'){ echo 'checked';}?> >
										<label for="DOC_STATUS">
											เปิดใช้งาน
										</label>
									</div>

								  </div>
								</div> 
								<!---->	
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
								  </div>
								  <div class="col-md-8">
									<button type="submit" class="btn btn-success waves-effect waves-light" href="#primary" role="button"><i class="fa fa-save"></i> บันทึก </button>  
									<a class="btn btn-warning waves-effect waves-light" href="#primary" role="button"><i class="fa fa-cloud-download"></i> Download file </a>
									
									<input type="hidden" name="W" id="W" value="<?php echo $W;?>">
									<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD;?>">
									<input type="hidden" name="DOC_ID" id="DOC_ID" value="<?php echo $DOC_ID;?>">
									<input type="hidden" name="process" id="process" value="DOC_EDIT">
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
			<?php
			}elseif($rec_doc["DOC_TYPE"] == 'L'){?>
			<!-- Row Starts -->
			<form method="post" enctype="multipart/form-data" id="form_wf" action="workflow_setting_doc_add_function.php">
				
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  ข้อมูลทั่วไป</h5>
						</div>
						<div class="card-block">
							<div class="col-md-10">
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
									  <label for="DOC_TITLE" class="form-control-label wf-right">ชื่อเอกสาร<span class="text-danger">*</span></label>
									  
								  </div>
								  <div class="col-md-8">

									  <input type="text" class="form-control" name="DOC_TITLE" id="DOC_TITLE" value="<?php echo $rec_doc["DOC_TITLE"];?>"  required>
								  </div>
								</div> 
								<!----> 
								<div class="form-group row">
								  <div class="col-md-3">
										<label class="form-control-label wf-right">Link  </label>
								  </div>
								  <div class="col-md-8">
									   <input type="text" class="form-control" name="DOC_LINK" id="DOC_LINK" value="<?php echo $rec_doc["DOC_FILE"];?>"  required>
								  </div>
								</div> 
								<!---->
								<!---->
								<div class="form-group row">
									<div class="col-md-3"> 
								  </div>
									
								   <div class="col-md-5">  
									<div class="checkbox-color checkbox-primary">
										<input id="DOC_STATUS" name="DOC_STATUS" type="checkbox" value="Y" <?php if($rec_doc["DOC_STATUS"] == 'Y'){ echo 'checked';}?> >
										<label for="DOC_STATUS">
											เปิดใช้งาน
										</label>
									</div>

								  </div>
								</div> 
								<!---->	
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
								  </div>
								  <div class="col-md-8">
									<button type="submit" class="btn btn-success waves-effect waves-light" href="#primary" role="button"><i class="fa fa-save"></i> บันทึก </button>  
									<input type="hidden" name="W" id="W" value="<?php echo $W;?>">
									<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD;?>">
									<input type="hidden" name="DOC_ID" id="DOC_ID" value="<?php echo $DOC_ID;?>">
									<input type="hidden" name="process" id="process" value="DOC_EDIT">
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
			<?php
			}else{?>
			<!-- Row Starts -->
			<form method="post" enctype="multipart/form-data" id="form_wf" action="workflow_setting_doc_add_function.php">
				
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  ข้อมูลทั่วไป</h5>
						</div>
						<div class="card-block">
							<div class="col-md-10">
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
									  <label for="DOC_TITLE" class="form-control-label wf-right">ชื่อเอกสาร<span class="text-danger">*</span></label>
									  
								  </div>
								  <div class="col-md-8">

									   <input type="text" class="form-control" name="DOC_TITLE" id="DOC_TITLE" value="<?php echo $rec_doc["DOC_TITLE"];?>"  required>
								  </div>
								</div> 
								<!----> 
								<div class="form-group row">
								  <div class="col-md-3">
										<label class="form-control-label wf-right">ไฟล์ Templates ใหม่</label>
								  </div>
								  <div class="col-md-8">
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
								<!---->
								<div class="form-group row">
									<div class="col-md-3"> 
								  </div>
									
								   <div class="col-md-5">  
									<div class="checkbox-color checkbox-primary">
										<input id="DOC_STATUS" name="DOC_STATUS" type="checkbox" <?php if($rec_doc["DOC_STATUS"] == 'Y'){ echo 'checked';}?> value="Y">
										<label for="DOC_STATUS">
											เปิดใช้งาน
										</label>
									</div>

								  </div>
								</div> 
								<!---->	
								<div class="form-group row">
									<div class="col-md-3"> </div>
									<div class="col-md-5">  
										<div class="checkbox-color checkbox-primary">
											<input id="DOC_USER_ADD" name="DOC_USER_ADD" type="checkbox" <?php if($rec_doc["DOC_USER_ADD"] == 'Y'){ echo 'checked';}?> value="Y">
											<label for="DOC_USER_ADD">
												User เพิ่มเอกสารเองได้
											</label>
										</div>
									</div>
								</div> 
								<!---->	
								<!---->
								<div class="form-group row">
								  <div class="col-md-3">
								  </div>
								  <div class="col-md-8">
									<button type="submit" class="btn btn-success waves-effect waves-light" href="#primary" role="button"><i class="fa fa-save"></i> บันทึก </button>  
									<?php 
										if(file_exists('../doc/'.$rec_doc["DOC_FILE"])){?>
											<a class="btn btn-warning waves-effect waves-light" href="../doc/<?php echo $rec_doc["DOC_FILE"];?>" role="button" target="_blank"><i class="fa fa-cloud-download"></i> Download template </a>
										<?php }?>
									<input type="hidden" name="W" id="W" value="<?php echo $W;?>">
									<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD;?>">
									<input type="hidden" name="DOC_ID" id="DOC_ID" value="<?php echo $DOC_ID;?>">
									<input type="hidden" name="process" id="process" value="DOC_EDIT">
 								  </div>
								</div>
								<!---->	
								
								<!---->	
								<div class="form-group row">
								  <div class="col-md-3">
									<small class="form-text text-muted wf-right">*หมายเหตุ</small>
 								  </div>
								  <div class="col-md-8">
									<small class="form-text text-muted">
									-ถ้าต้องการใส่ตัวแปรเพื่อใช้เทียบกับค่า field ในฐานข้อมูล ใช้รูปแบบ ##Field!!
									</small>
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
			<?php }?>
			<!-- Row Starts -->
			<?php
				if($rec_doc["DOC_TYPE"] == 'W'){?>
			<form method="post" id="form_request_data" action="workflow_setting_doc_add_function.php">
				<input type="hidden" name="W" id="W" value="<?php echo $W;?>">
				<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD;?>">
				<input type="hidden" name="DOC_ID" id="DOC_ID" value="<?php echo $DOC_ID;?>">
				<input type="hidden" name="process" id="process" value="REQUEST_DATA_EDIT">
            <div class="row">
				<!-------------Column---------------->
				<div class="col-md-6">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="fa fa-database"></i>  การเรียกข้อมูล</h5>
						</div>
						<div class="card-block">
							<div class="col-md-12">
								<!----> 
								<div class="form-group row"> 
								  <div id="radio" class="form-radio">
										<div class="radio radio-inline"> <!-- radio-inline -->
											<label>
												<input type="radio" name="REQUEST_DATA" id="REQUEST_DATA1" value="T" required aria-required="true" data-toggle="validator" onclick="show_text('T');" <?php echo ($rec_doc["DOC_REQUEST_DATA"] == 'T')?"checked":""; ?> checked>
												<i class="helper"></i> ดึงจาก Table : <?php if($rec["WF_MAIN_SHORTNAME"] != ""){ echo $SHORTNAME = $rec["WF_MAIN_SHORTNAME"];}?></input>
											</label>
										</div>
										<div class="radio radio-inline">
											<label>
												<input type="radio" name="REQUEST_DATA" id="REQUEST_DATA2" value="S" required aria-required="true" data-toggle="validator" onclick="show_text('S');" <?php echo ($rec_doc["DOC_REQUEST_DATA"] == 'S')?"checked":""; ?>>
												<i class="helper">
												</i> ตั้งค่า sql statment เอง </input> 
											</label>
										</div>
									</div>
								</div>
							<!---->
								<!---->
								<div class="form-group row"> 
									<span id="show_textarea" <?php echo $rec_doc["DOC_SQL"]?'':'style="display:none;"' ?>>
									  <textarea class="form-control" id="DOC_SQL"  name="DOC_SQL" rows="10"><?php echo $rec_doc["DOC_SQL"];?></textarea>
									  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
									 </span>

								</div>
								<!---->	
								<!---->
								<div class="form-group row"> 
									<button type="submit" class="btn btn-success waves-effect waves-light" role="button"><i class="fa fa-save"></i> บันทึก </button> 
								</div>
								<!---->	
							</div>
							
						</div>	
                    </div>
                </div>
				</form>
				<?php
				}
				if($rec_doc["DOC_TYPE"] == 'W'){?>
				<!-------------Column----------------> 
				<form method="post" id="auto_data" action="workflow_setting_doc_add_function.php">
					<input type="hidden" name="W" id="W" value="<?php echo $W;?>">
					<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD;?>">
					<input type="hidden" name="DOC_ID" id="DOC_ID" value="<?php echo $DOC_ID;?>">
					<input type="hidden" name="process" id="process" value="MAP_FIELD_AUTO">
				<div class="col-md-6">
                    <div class="card">
						<div class="card-header"><h5 class="card-header-text"><i class="fa fa-file-word-o"></i>  ตัวแปรที่ดึงจากฐานข้อมูลอัตโนมัติ</h5>
						</div>
						<div class="card-block">
							<div class="col-md-12">
								<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
									<thead>
										<tr class="bg-primary">
											<th width="30%">ตัวแปรฝั๋ง word</th>
											<th>ตัวแปรฝั๋งระบบ</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										
										if($rec_doc["DOC_SQL"] != ""){
											$sqlnew_doc = str_replace("&#039;","'",$rec_doc["DOC_SQL"]);
											preg_match_all("/(##)([a-zA-Z0-9_]+)(!!)/", $sqlnew_doc, $new_sql, PREG_SET_ORDER);
											foreach ($new_sql as $val_new) {
												$sqlnew_doc = str_replace("##".$val_new[2]."!!","1",$sqlnew_doc);
											}
											 
											$WF_ARR_FIELD = db::query_field($sqlnew_doc); 
										}else{ 
											
											//$sql_arr = db::query_field("SELECT * FROM ".$rec["WF_MAIN_SHORTNAME"]." WHERE WFR_ID = '1'");
											$WF_ARR_FIELD = db::show_field($rec["WF_MAIN_SHORTNAME"]);
										}											
											
											foreach($WF_ARR_FIELD as $key => $value){

											$query_step_form = db::query("SELECT WFS_ID,WSF.WFS_FIELD_NAME,WSF.WFS_NAME FROM WF_STEP_FORM WSF WHERE WSF.WF_MAIN_ID = '".$W."' AND WF_TYPE='".$rec["WF_TYPE"]."' AND (WFS_FIELD_NAME IS NOT NULL OR WFS_FIELD_NAME != '' ) AND WFS_FIELD_NAME='".$value."'");

											$step_form = db::fetch_array($query_step_form);
											array_push($WF_ARR_NAME,$step_form["WFS_NAME"]);
											}

											
											
										 
									
										$i=1;
										$filename = "../doc/".$rec_doc["DOC_FILE"];
										$all_val1 = array();
										if($rec_doc['DOC_TYPE'] == "W")
										{
											require_once '../PHPWord.php';
											$document = new ZipArchive();
											$document->open($filename);
											$document1 = $document->getFromName('word/document.xml');
											$contents = "";
										
											preg_match_all('/\##[^\$]+?!!/', $document1, $matches);
											for ($i=0;$i<count($matches[0]);$i++){
												$matches_new = preg_replace('/(<[^<]+?>)/','', $matches[0][$i]);
												$text = substr($matches_new,0,-2);
												$text = substr($text,2);
												$all_val1[] = $text;
											}
										}
										else
										{
											$handle = fopen($filename, "r");
											$contents = fread($handle, filesize($filename));
											fclose($handle);
											preg_match_all("/(##)([a-zA-Z0-9_]+)(!!)/", $contents, $matches, PREG_SET_ORDER);

											foreach ($matches as $val) {
												$all_val1[] = $val[2];
											}
										}
										
										$all_val = array_unique($all_val1);
										foreach ($all_val as $val) {?>
											<?php
											if(!in_array($val,$arr_format_date)){
											?>
											<tr>
												<input type="hidden" name="VAR_NAME<?php echo $i;?>" id="VAR_NAME<?php echo $i;?>" value="<?php echo $val;?>" />
												<td><?php echo $val;?></td>
												<td>
												<?php
													$sql_doc_v = db::query("SELECT * FROM DOC_VAR WHERE DOC_ID ='".$DOC_ID."' AND VAR_NAME = '".$val."'");
													$rec_doc_v = db::fetch_array($sql_doc_v);?>
													
													<input type="hidden" name="VAR_ID<?php echo $i;?>" id="VAR_ID<?php echo $i;?>" value="<?php echo $rec_doc_v["VAR_ID"];?>" />
													<select name="VAR_FIELD<?php echo $i;?>" id="VAR_FIELD<?php echo $i;?>" class="select2">
														<option value=""></option>
														<?php
														/*
														if(strtoupper(db::$_dbType) == 'MYSQL'){
															$str_wh = " AND WFS_FIELD_NAME = ''";
															$str_wh2 = " AND (WFS_FIELD_NAME = '' OR WFS_FIELD_NAME != '' )";
														}elseif(strtoupper(db::$_dbType) == 'ORACLE'){
															$str_wh = " AND WFS_FIELD_NAME IS NOT NULL";
															$str_wh2 = " AND (WFS_FIELD_NAME IS NOT NULL OR WFS_FIELD_NAME != '' )";
														}elseif(strtoupper(db::$_dbType) == 'MSSQL'){
															$str_wh = " AND WFS_FIELD_NAME = ''";
															$str_wh2 = " AND (WFS_FIELD_NAME = '' OR WFS_FIELD_NAME != '' )";
														}else{
															$str_wh = "";
															$str_wh2 = "";
														}*/
														foreach($WF_ARR_FIELD as $key => $vals){
															/*$sql_wf = db::query("SELECT WFS_NAME FROM WF_STEP_FORM WSF INNER JOIN WF_DETAIL WD ON WSF.WFD_ID = WD.WFD_ID WHERE WD.WF_MAIN_ID = '".$W."' AND WF_TYPE='".$WF_TYPE."' AND WFS_FIELD_NAME = '".$vals."' ".$str_wh." ORDER BY WFS_NAME");
															
															$sql_wf = db::query("SELECT WFS_ID,WSF.WFS_FIELD_NAME,WSF.WFS_NAME FROM WF_STEP_FORM WSF WHERE WSF.WF_MAIN_ID = '".$W."' AND WF_TYPE='".$rec["WF_TYPE"]."' ".$str_wh2." AND WFS_FIELD_NAME='".$vals."'");
															
															
															$rec_wf = db::fetch_array($sql_wf);*/
															
															?>
															<option value="<?php echo $vals;?>" <?php if($vals == $rec_doc_v["VAR_FIELD"]){ echo "selected"; } ?>><?php echo $WF_ARR_NAME[$key];?> (<?php echo $vals;?>)</option>	
														<?php }?>
													</select>
												</td>
											</tr>
											
											<?php $i++;}}?>
									</tbody>
								</table>
								</div>
							</div>
						</div> 
					<!--Card--> 
						<!--
						<div class="card-header"><h5 class="card-header-text"><i class="fa fa-file-word-o"></i>  ตั้งค่า INPUT เข้า word แบบ manual</h5>
						</div>
						<div class="card-block">
							<div class="col-md-12">
								<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
									<thead>
										<tr class="bg-primary">
											<th width="15%">ตัวแปร</th>
											<th width="30%">ชื่อ LABEL INPUT</th>
											<th>ชื่อ LABEL VALUE</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										
									 /* $s=1;
									  preg_match_all("/(@@)([a-zA-Z0-9_]+)(!!)/", $document1, $matches, PREG_SET_ORDER);
									 */
									  //foreach ($matches as $va) {?>
										<tr>
											<input type="hidden" name="LABEL_NAME<?php echo $s;?>" id="LABEL_NAME" value="<?php echo $va[2];?>" />
											<td><?php echo $va[2];?></td>
											<td>
											<?php 
												$sql_label = db::query("SELECT * FROM DOC_LABEL WHERE DOC_ID ='".$DOC_ID."' AND LABEL_NAME = '".$va[2]."'");
												$rec_label = db::fetch_array($sql_label);
											?>
											
											<input type="hidden" name="LABEL_ID<?php echo $s;?>" id="LABEL_ID<?php echo $s;?>" value="<?php echo $rec_label["LABEL_ID"];?>" />
											<input type="text" name="LABEL_INPUT<?php echo $s;?>" id="LABEL_INPUT<?php echo $s;?>" class="form-control" value="<?php echo $rec_label["LABEL_INPUT"]; ?>">
											</td>
											<td><textarea type="text" name="LABEL_VALUES<?php echo $s;?>" id="LABEL_VALUES<?php echo $s;?>" class="form-control"><?php echo $rec_label["LABEL_VALUES"];?></textarea></td>
										</tr>
									<?php //$s++;}?>	
									</tbody>
								</table>
								</div>
							</div>-->
							<!---->

							<div class="card-header">
								<div class="form-group row"> 
									<div class="col-md-12">
									<button type="submit" class="btn btn-success waves-effect waves-light" href="#primary" role="button"><i class="fa fa-save"></i> บันทึก </button> 
									</div>
								</div>
							</div>
							
							<input type="hidden" name="num_i" id="num_i" value="<?php echo $i;?>" />
							<input type="hidden" name="num_s" id="num_s" value="<?php echo $s;?>" />
						<!---->	
						</div>	
                    </div>
					<!--Card-->
                </div>
				</form>
				<?php }?>
            </div>
            <!-- Row end --> 
			<div class="row">
				<div class="main-header">
				</div>
			</div>
		
	
        <!-- Container-fluid ends -->
     </div>
</div>
<script type="text/javascript">

function show_text(id){
	if(id == 'S'){
		$('#show_textarea').show();		
	}else if(id == 'T'){
		$('#show_textarea').hide();		
	}
}

</script>
<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>
