<?php
include '../include/comtop_admin.php';
$id = $_GET['BPMN_ID'];

$q_bpmn = db::query("SELECT * FROM WF_BPMN WHERE BPMN_ID = '".$id."'");
$r_bpmn = db::fetch_array($q_bpmn);

if(file_exists('../bpmn/bpmn_'.$id.'.tmp')){
	$filename = "../bpmn/bpmn_".$id.".tmp";
	$handle = fopen($filename, "r");
	$default_b = fread($handle, filesize($filename));
	fclose($handle);
}

$arr_non_func1 = array(
	1=> "<b>1.1 Access Security</b> How well is the system guarded against unauthorized access? The extent to which the system is safeguarded against deliberate and intrusive faults from internal and external sources.",
	2=> "<b>1.2 Accessibility</b> How easy is the system to use by people with varying capabilities? The extent to which the software system can be used by people with the widest range of capabilities to achieve a specified goal in a specified context of use.",
	3=> "<b>1.3 Availability</b> How dependable is the system during normal operating times? The degree to which users can depend on the system to be up (able to function) during “normal operating times.”",
	4=> "<b>1.4 Confidentiality</b> How well does the system make sensitive data available to authorized users? The degree to which the software system protects sensitive data and allows only authorized access to the data.",
	5=> "<b>1.5 Efficiency</b> How fast can it process?  How many can be processed?  How well does the system respond? The extent to which the software system handles capacity, throughput, and response time.",
	6=> "<b>1.6 Integrity</b> How accurate and authentic are the data? The degree to which the data maintained by the software system are accurate, authentic, and without corruption.",
	7=> "<b>1.7 Reliability</b> How immune is the system to failure? The extent to which the software system consistently performs the specified functions without failure.",
	8=> "<b>1.8 Safety</b> How well does the system prevent harm to people and the environment? The degree to which a software system prevents harm to people or damage to the environment in the intended context of use.",
	9=> "<b>1.9 Survivability</b> How resilient is the system from failure? The extent to which the software system continues to function and recovers in the presence of a system failure.",
	10=>"<b>1.10 Usability</b> How easy is it to learn and operate the system? The ease with which the user is able to learn, operate, prepare inputs, and interpret outputs through interaction with a system."
);

$arr_non_func2 = array(
	1=> "<b>2.1 Flexibility</b> How easy is it to modify to work in different environments? The ease with which the software can be modified to adapt to different environments, configurations, and user expectations.",
	2=> "<b>2.2 Maintainability</b> How easy is it to upkeep and repair the system? The ease with which faults in a software system can be found and fixed.",
	3=> "<b>2.3 Modifiability</b> How easy is it to change the software system, and at what cost? The degree to which changes to a software system can be developed and deployed efficiently and cost effectively.",
	4=> "<b>2.4 Scalability</b> How easy is it to expand or upgrade the system’s capabilities? The degree in which the system is able to expand its processing capabilities upward and outward to support business growth.",
	5=> "<b>2.5 Verifiability</b> How easy is it to show the system performs its functions? The extent to which tests, analysis, and demonstrations are needed to prove that the system will function as intended."
);

$arr_non_func3 = array(
	1=> "<b>3.1 Installability</b> How easy is it to install, uninstall, and reinstall the software system? The ease with which a software system can be installed, uninstalled, or reinstalled into a target environment.",
	2=> "<b>3.2 Interoperability</b> How easy is it to interface with another system? The extent to which the software system is able to couple or facilitate the interface with other systems.",
	3=> "<b>3.3 Portability</b> How easy is it to transport? The ease with which a software system can be transferred from its current hardware or software environment to another.",
	4=> "<b>3.4 Reusability</b> How easy is it to convert for use in another system? The extent to which a portion of the software system can be converted for use in another."
);
$arr_priority = array(1=>"สำคัญมาก",2=>"สำคัญ",3=>"ไม่สำคัญ");
?>
<link href="../assets/gojs/extensions/js/BPMN.css" rel="stylesheet" type="text/css" />
<script src="../assets/gojs/release/go.js"></script>
<script src="../assets/gojs/extensions/js/DrawCommandHandler.js"></script>
<script src="../assets/gojs/extensions/js/BPMNClasses.js"></script>
<script src="../assets/gojs/extensions/js/BPMN.js"></script>

<body onload="init();">
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<div class="row" id="animationSandbox">
				<div class="col-sm-12">
					<div class="main-header">
						<h4><?php echo $r_bpmn['BPMN_NAME'];?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a></li>
							<li class="breadcrumb-item"><a href="bpmn_list.php">BPMN</a></li>
							<li class="breadcrumb-item"><a href="#">Non-functional</a></li>
						</ol>
						<div class="f-right">
							<nobr>
								<input type="button" class="btn btn-info" value="ดูรูป BPMN" onclick="printDiagram();" />
								<a class="btn btn-danger waves-effect waves-light" href="bpmn_list.php" role="button"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ </a>
							</nobr>
						</div>
					</div>
				</div>
			</div>
			
			<div id="PaletteAndDiagram" style="display:none;">
				<div id="sideBar">
					<span style="display: inline-block; vertical-align: top; padding: 5px; width:100%">
						<div id="accordion">
							<div>
								<div id="myPaletteLevel1" class="myPaletteDiv" ></div>
							</div>  
						</div>
					</span>
					<div class="handle">Overview:</div>
					<div id="myOverviewDiv" ></div>
				</div>
				
				<div id="myDiagramDiv"></div>
				<textarea id="mySavedModel" name="M_DATA" style="width:100%;height:200px;display:none;">
					<?php echo $default_b;?>
				</textarea>
			</div>
			
			<div id="openDocument" class="draggable" style="display:none;">
				<div id="openDraggableHandle" class="handle">Open File</div>
				<div id="openText" class="elementText">Choose file to open...</div>
				<select id="mySavedFiles" class="mySavedFiles"></select>
				<br />
				<button id="openBtn" class="elementBtn" type="button" onclick="loadFile()" style="margin-left: 70px">Open</button>
				<button id="cancelBtn" class="elementBtn" type="button" onclick="closeElement('openDocument')">Cancel</button>
			</div>

			<div id="removeDocument" class="draggable" style="display:none;">
				<div id="removeDraggableHandle" class="handle">Delete File</div>
				<div id="removeText" class="elementText">Choose file to remove...</div>
				<select id="mySavedFiles2" class="mySavedFiles"></select>
				<br />
				<button id="removeBtn" class="elementBtn" type="button" onclick="removeFile()" style="margin-left: 70px">Remove</button>
				<button id="cancelBtn2" class="elementBtn" type="button" onclick="closeElement('removeDocument')">Cancel</button>
			</div>
			
			<form id="save_m" action="bpmn_non_func_function.php" method="post">
				<input type="hidden" name="process" value="add_non_func">
				<input type="hidden" name="BPMN_ID" id="BPMN_ID" value="<?php echo $id;?>">
				<input type="hidden" name="back_page_old" id="back_page_old" value="">
			
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-block accordion-block">
								<div class="color-accordion" id="color-accordion">
								
									<a class="accordion-msg bg-success" ><i class="fa fa-folder-open-o"></i> <b>1. OPERATION Requirements:</b> How well does the system perform for daily use? Describe the user concern for using the functionality. The user perceives the system as a tool to automate tasks.</a> 
									<div class="accordion-desc">
										<?php
										$type=1;
										foreach($arr_non_func1 as $key1 => $non_func1){
											?>
											<table cellspacing="0" id="func1_<?php echo $key1;?>" class="table table-bordered sorted_table">
												<tr>
													<td style="text-align:left" colspan="4"><?php echo $non_func1;?></td>
												</tr>
												<tr>
													<th colspan="4">
														<div class="f-right">
															<nobr>
																<button type="button" class="btn btn-primary waves-effect waves-light" onclick="addRow('func1_<?php echo $key1;?>','<?php echo $type;?>','<?php echo $key1;?>');" role="button">
																	<i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล
																</button>
															</nobr>
														</div>
													</th>
												</tr>
												<tr class="bg-primary">
													<th class="text-center" style="width:10%">เลขที่</th>
													<th class="text-center" style="width:60%">Non-functional Requirment</th>
													<th class="text-center" style="width:15%">Priority</th>
													<th class="text-center" style="width:10%"></th>
												</tr>
												<?php 
												$q_non1 = db::query("SELECT * FROM WF_BPMN_NON_FUNC WHERE BPMN_ID = '".$id."' AND NON_FUNC_TYPE = '".$type."' AND NON_FUNC_TOPIC = '".$key1."' ORDER BY NON_FUNC_ID ASC");
												while($r_non1 = db::fetch_array($q_non1)){
													$random = $r_non1['NON_FUNC_ID'];
													?>
													<tr id="tr_<?php echo $random; ?>">
														<input type="hidden" name="FID<?php echo $type;?>[]" value="<?php echo $random; ?>">
														<input type="hidden" name="NON_FUNC_TOPIC_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_TOPIC_<?php echo $type;?>_<?php echo $random;?>" value="<?php echo $key1;?>">
														<td class="text-center">
															<input type="text" name="NON_FUNC_ORDER_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_ORDER_<?php echo $type;?>_<?php echo $random;?>" value="<?php echo $r_non1['NON_FUNC_ORDER'];?>" class="form-control" style="width:80px;">
														</td>
														<td class="text-left">
															<textarea name="NON_FUNC_DET_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_DET_<?php echo $type;?>_<?php echo $random;?>" class="form-control"><?php echo $r_non1['NON_FUNC_DET'];?></textarea>
														</td>
														<td class="text-left">
															<select name="PRIORITY_NO_<?php echo $type;?>_<?php echo $random;?>" id="PRIORITY_NO_<?php echo $type;?>_<?php echo $random;?>" class="select2" placeholder="เลือก...">
																<option value=""></option>
																<?php foreach($arr_priority as $key => $val){?>
																	<option value="<?php echo $key;?>" <?php if($key == $r_non1['PRIORITY_NO']){ echo "selected"; }?>><?php echo $val;?></option>
																<?php } ?>
															</select>
														</td>
														<td class="text-center">
															<nobr>
																<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ" onclick="delete_non_func_bpmn('<?php echo $random;?>');">
																	<i class="icofont icofont-trash"></i>
																</button>
															</nobr>
														</td>
													</tr>
													<?php
												}
												?>
											</table>
											<?php		
										}
										?>
									</div>
									
									<a class="accordion-msg bg-success" ><i class="fa fa-folder-open-o"></i> <b>2. REVISION Requirements:</b> How easy is it to correct errors and add functions? Describe the user concern for changing source code or data that drive the system.  The user perceives the system as programmed language statements.</a> 
									<div class="accordion-desc">
										<?php
										$type=2;
										foreach($arr_non_func2 as $key2 => $non_func2){
											?>
											<table cellspacing="0" id="func2_<?php echo $key2;?>" class="table table-bordered sorted_table">
												<tr>
													<td style="text-align:left" colspan="4"><?php echo $non_func2;?></td>
												</tr>
												<tr>
													<th colspan="4">
														<div class="f-right">
															<nobr>
																<button type="button" class="btn btn-primary waves-effect waves-light" onclick="addRow('func2_<?php echo $key2;?>','<?php echo $type;?>','<?php echo $key2;?>');" role="button">
																	<i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล
																</button>
															</nobr>
														</div>
													</th>
												</tr>
												<tr class="bg-primary">
													<th class="text-center" style="width:10%">เลขที่</th>
													<th class="text-center" style="width:60%">Non-functional Requirment</th>
													<th class="text-center" style="width:15%">Priority</th>
													<th class="text-center" style="width:10%"></th>
												</tr>
												<?php
												$q_non2 = db::query("SELECT * FROM WF_BPMN_NON_FUNC WHERE BPMN_ID = '".$id."' AND NON_FUNC_TYPE = '".$type."' AND NON_FUNC_TOPIC = '".$key2."' ORDER BY NON_FUNC_ID ASC");
												while($r_non2 = db::fetch_array($q_non2)){
													$random = $r_non2['NON_FUNC_ID'];
													?>
													<tr id="tr_<?php echo $random; ?>">
														<input type="hidden" name="FID<?php echo $type;?>[]" value="<?php echo $random; ?>">
														<input type="hidden" name="NON_FUNC_TOPIC_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_TOPIC_<?php echo $type;?>_<?php echo $random;?>" value="<?php echo $key2;?>">
														<td class="text-center">
															<input type="text" name="NON_FUNC_ORDER_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_ORDER_<?php echo $type;?>_<?php echo $random;?>" value="<?php echo $r_non2['NON_FUNC_ORDER'];?>" class="form-control" style="width:80px;">
														</td>
														<td class="text-left">
															<textarea name="NON_FUNC_DET_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_DET_<?php echo $type;?>_<?php echo $random;?>" class="form-control"><?php echo $r_non2['NON_FUNC_DET'];?></textarea>
														</td>
														<td class="text-left">
															<select name="PRIORITY_NO_<?php echo $type;?>_<?php echo $random;?>" id="PRIORITY_NO_<?php echo $type;?>_<?php echo $random;?>" class="select2" placeholder="เลือก...">
																<option value=""></option>
																<?php foreach($arr_priority as $key => $val){?>
																	<option value="<?php echo $key;?>" <?php if($key == $r_non2['PRIORITY_NO']){ echo "selected"; }?>><?php echo $val;?></option>
																<?php } ?>
															</select>
														</td>
														<td class="text-center">
															<nobr>
																<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ" onclick="delete_non_func_bpmn('<?php echo $random;?>');">
																	<i class="icofont icofont-trash"></i>
																</button>
															</nobr>
														</td>
													</tr>
													<?php
												}	
												?>
											</table>
											<?php
										}
										?>
									</div>
										
									<a class="accordion-msg bg-success"><i class="fa fa-folder-open-o"></i> 3. TRANSITION Requirements:</b> How easy is it to adapt to changes in the technical environment? Describe the user concern for managing the upkeep of the software.  The user perceives the system to have characteristics similar to hardware.</a> 
									<div class="accordion-desc">
										<?php
										$type=3;
										foreach($arr_non_func3 as $key3 => $non_func3){
											?>
											<table cellspacing="0" id="func3_<?php echo $key3;?>" class="table table-bordered sorted_table">
												<tr>
													<td style="text-align:left" colspan="4"><?php echo $non_func3;?></td>
												</tr>
												<tr>
													<th colspan="4">
														<div class="f-right">
															<nobr>
																<button type="button" class="btn btn-primary waves-effect waves-light" onclick="addRow('func3_<?php echo $key3;?>','<?php echo $type;?>','<?php echo $key3;?>');" role="button">
																	<i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล
																</button>
															</nobr>
														</div>
													</th>
												</tr>
												<tr class="bg-primary">
													<th class="text-center" style="width:10%">เลขที่</th>
													<th class="text-center" style="width:60%">Non-functional Requirment</th>
													<th class="text-center" style="width:15%">Priority</th>
													<th class="text-center" style="width:10%"></th>
												</tr>
												<?php
												$q_non3 = db::query("SELECT * FROM WF_BPMN_NON_FUNC WHERE BPMN_ID = '".$id."' AND NON_FUNC_TYPE = '".$type."' AND NON_FUNC_TOPIC = '".$key3."' ORDER BY NON_FUNC_ID ASC");
												while($r_non3 = db::fetch_array($q_non3)){
													$random = $r_non3['NON_FUNC_ID'];
													?>
													<tr id="tr_<?php echo $random; ?>">
														<input type="hidden" name="FID<?php echo $type;?>[]" value="<?php echo $random; ?>">
														<input type="hidden" name="NON_FUNC_TOPIC_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_TOPIC_<?php echo $type;?>_<?php echo $random;?>" value="<?php echo $key3;?>">
														<td class="text-center">
															<input type="text" name="NON_FUNC_ORDER_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_ORDER_<?php echo $type;?>_<?php echo $random;?>" value="<?php echo $r_non3['NON_FUNC_ORDER'];?>" class="form-control" style="width:80px;">
														</td>
														<td class="text-left">
															<textarea name="NON_FUNC_DET_<?php echo $type;?>_<?php echo $random;?>" id="NON_FUNC_DET_<?php echo $type;?>_<?php echo $random;?>" class="form-control"><?php echo $r_non3['NON_FUNC_DET'];?></textarea>
														</td>
														<td class="text-left">
															<select name="PRIORITY_NO_<?php echo $type;?>_<?php echo $random;?>" id="PRIORITY_NO_<?php echo $type;?>_<?php echo $random;?>" class="select2" placeholder="เลือก...">
																<option value=""></option>
																<?php foreach($arr_priority as $key => $val){?>
																	<option value="<?php echo $key;?>" <?php if($key == $r_non3['PRIORITY_NO']){ echo "selected"; }?>><?php echo $val;?></option>
																<?php } ?>
															</select>
														</td>
														<td class="text-center">
															<nobr>
																<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ" onclick="delete_non_func_bpmn('<?php echo $random;?>');">
																	<i class="icofont icofont-trash"></i>
																</button>
															</nobr>
														</td>
													</tr>
													<?php
												}
												?>
											</table>
											<?php	
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div align="right">
							<button type="submit" class="btn btn-warning active waves-effect waves-light" onclick="$('#back_page_old').val('Y');">
								<i class="icofont icofont-tick-mark"></i> บันทึกและกลับหน้าเดิม
							</button>&nbsp;
							<button type="submit" class="btn btn-success waves-effect waves-light" id="wf-btn-save">
								<i class="icofont icofont-tick-mark"></i> บันทึก
							</button>
						</div>
					</div>
				</div>
				<br>
			</form>
		</div>
	</div>
</body>
<script>
function addRow(id_table,type,topic){
	var dataString = 'process=add_row&type='+type+'&topic='+topic;
	$.ajax({
		type: "POST",
		url: "bpmn_non_func_function.php",
		data: dataString,
		cache: false,
		success: function(html){
			$("#"+id_table).append(html);
			$('select.select2').select2({
				allowClear: true,
				placeholder: function(){
					$(this).data('placeholder');
				}
			});
		}
	});
}
function delete_non_func_bpmn(id){
	if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){	
		var dataString = 'process=delete&id='+id;
		$.ajax({
			type: "POST",
			url: "bpmn_non_func_function.php",
			data: dataString,
			cache: false,
			success: function(html){
				$("#tr_"+id).hide();
			}
		});
	}
}
</script>
<script type="text/javascript" src="../assets/pages/accordion.js"></script>
<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_admin.php'; 
?>