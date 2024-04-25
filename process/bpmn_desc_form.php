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
							<li class="breadcrumb-item"><a href="#">คำอธิบาย</a></li>
						</ol>
						<div class="f-right">
							<nobr>
								<button class="btn btn-primary waves-effect waves-light" onclick="addRow();" role="button">
									<i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล
								</button>
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
			
			<form id="save_m" action="bpmn_desc_function.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="process" value="add_desc">
				<input type="hidden" name="BPMN_ID" id="BPMN_ID" value="<?php echo $id;?>">
				<input type="hidden" name="back_page_old" id="back_page_old" value="">
			
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="table-responsive" data-pattern="priority-columns">
									<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
										<thead>
											<tr class="bg-primary">
												<td class="text-center" style="width:6%">ขั้นตอนที่</td>
												<td class="text-center" style="width:20%">คำอธิบาย</td>
												<td class="text-center" style="width:17%">แบบฟอร์ม 1</td>
												<td class="text-center" style="width:17%">แบบฟอร์ม 2</td>
												<td class="text-center" style="width:17%">แบบฟอร์ม 3</td>
												<td class="text-center" style="width:17%">ข้อกำหนดที่เกี่ยวข้อง</td>
												<th class="text-center" style="width:6%"></th>
											</tr>
										<thead>
										<tbody>
											<?php
											$j=1;
											$q_desc = db::query("SELECT * FROM WF_BPMN_DESC WHERE BPMN_ID = '".$id."' ORDER BY CAST(DESC_ORDER AS FLOAT) ASC");
											while($r_desc = db::fetch_array($q_desc)){
												$random = $r_desc['DESC_ID'];
												?>
												<tr id="tr_<?php echo $random;?>">
													<input type="hidden" name="FID[]" value="<?php echo $random; ?>">
													<td class="text-center">
														<input type="text" name="DESC_ORDER_<?php echo $random; ?>" id="DESC_ORDER_<?php echo $random; ?>" value="<?php echo $r_desc['DESC_ORDER']; ?>" class="form-control" style="width:80px;">
													</td>
													<td class="text-left">
														<textarea name="DESC_DETAIL_<?php echo $random;?>" id="DESC_DETAIL_<?php echo $random;?>" class="form-control"><?php echo $r_desc['DESC_DETAIL'];?></textarea>
													</td>
													<td class="text-left">
														<textarea name="FORM_DETAIL1_<?php echo $random;?>" id="FORM_DETAIL1_<?php echo $random;?>" class="form-control"><?php echo $r_desc['FORM_DETAIL1'];?></textarea>
														<input type="hidden" name="FORM_ATTACH1_OLD_<?php echo $random;?>" id="FORM_ATTACH1_OLD_<?php echo $random;?>" value="<?php echo $r_desc['FORM_ATTACH1'];?>">
														<?php if($r_desc['FORM_ATTACH1'] != ''){ ?>
														<span id="shw_form_attach1_<?php echo $random;?>">
															<a href="../bpmn_desc/<?php echo $r_desc['FORM_ATTACH1'];?>" target="_blank"><?php echo $r_desc['FORM_ATTACH1_ORI'];?></a>
															<div class="f-right"><a href="#!" onClick="delete_file('<?php echo $random;?>','1');" title="ลบ<?php echo $r_desc['FORM_ATTACH1'];?>"><i class="icofont icofont-ui-delete"></i></a></div>
														</span>
														<?php } ?>
														<?php echo form_ifile("FORM_ATTACH1_".$random,""," ","single","","");?>
													</td>
													<td class="text-left">
														<textarea name="FORM_DETAIL2_<?php echo $random;?>" id="FORM_DETAIL2_<?php echo $random;?>" class="form-control"><?php echo $r_desc['FORM_DETAIL2'];?></textarea>
														<input type="hidden" name="FORM_ATTACH2_OLD_<?php echo $random;?>" id="FORM_ATTACH2_OLD_<?php echo $random;?>" value="<?php echo $r_desc['FORM_ATTACH2'];?>">
														<?php if($r_desc['FORM_ATTACH2'] != ''){ ?>
														<span id="shw_form_attach2_<?php echo $random;?>">
															<a href="../bpmn_desc/<?php echo $r_desc['FORM_ATTACH2'];?>" target="_blank"><?php echo $r_desc['FORM_ATTACH2_ORI'];?></a>
															<div class="f-right"><a href="#!" onClick="delete_file('<?php echo $random;?>','2');" title="ลบ<?php echo $r_desc['FORM_ATTACH2'];?>"><i class="icofont icofont-ui-delete"></i></a></div>
														</span>
														<?php } ?>
														<?php echo form_ifile("FORM_ATTACH2_".$random,""," ","single","","");?>
													</td>
													<td class="text-left">
														<textarea name="FORM_DETAIL3_<?php echo $random;?>" id="FORM_DETAIL3_<?php echo $random;?>" class="form-control"><?php echo $r_desc['FORM_DETAIL3'];?></textarea>
														<input type="hidden" name="FORM_ATTACH3_OLD_<?php echo $random;?>" id="FORM_ATTACH3_OLD_<?php echo $random;?>" value="<?php echo $r_desc['FORM_ATTACH3'];?>">
														<?php if($r_desc['FORM_ATTACH3'] != ''){ ?>
														<span id="shw_form_attach3_<?php echo $random;?>">
															<a href="../bpmn_desc/<?php echo $r_desc['FORM_ATTACH3'];?>" target="_blank"><?php echo $r_desc['FORM_ATTACH3_ORI'];?></a>
															<div class="f-right"><a href="#!" onClick="delete_file('<?php echo $random;?>','3');" title="ลบ<?php echo $r_desc['FORM_ATTACH3'];?>"><i class="icofont icofont-ui-delete"></i></a></div>
														</span>
														<?php } ?>
														<?php echo form_ifile("FORM_ATTACH3_".$random,""," ","single","","");?>
													</td>
													<td class="text-left">
														<textarea name="REQ_DETAIL_<?php echo $random;?>" id="REQ_DETAIL_<?php echo $random;?>" class="form-control"><?php echo $r_desc['REQ_DETAIL'];?></textarea>
														<input type="hidden" name="REQ_ATTACH_OLD_<?php echo $random;?>" id="REQ_ATTACH_OLD_<?php echo $random;?>" value="<?php echo $r_desc['REQ_ATTACH'];?>">
														<?php if($r_desc['REQ_ATTACH'] != ''){ ?>
														<span id="shw_form_attach4_<?php echo $random;?>">
															<a href="../bpmn_desc/<?php echo $r_desc['REQ_ATTACH'];?>" target="_blank"><?php echo $r_desc['REQ_ATTACH_ORI'];?></a>
															<div class="f-right"><a href="#!" onClick="delete_file('<?php echo $random;?>','4');" title="ลบ<?php echo $r_desc['REQ_ATTACH'];?>"><i class="icofont icofont-ui-delete"></i></a></div>
														</span>
														<?php } ?>
														<?php echo form_ifile("REQ_ATTACH_".$random,""," ","single","","");?>
													</td>
													<td class="text-center">
														<nobr>
															<button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="ลบ" onclick="delete_desc_bpmn('<?php echo $random;?>');">
																<i class="icofont icofont-trash"></i>
															</button>
														</nobr>
													</td>
												</tr>
												<?php
												$j++;
											}
											?>
										</tbody>
									</table>
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
function addRow(){
	var dataString = 'process=add_row';
	$.ajax({
		type: "POST",
		url: "bpmn_desc_function.php",
		data: dataString,
		cache: false,
		success: function(html){
			$("#tech-companies-1").append(html);
		}
	});
}
function delete_desc_bpmn(id){
	if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){
		var dataString = 'process=delete&id='+id;
		$.ajax({
			type: "POST",
			url: "bpmn_desc_function.php",
			data: dataString,
			cache: false,
			success: function(html){
				$("#tr_"+id).hide();
			}
		});
	}
}
function delete_file(id, type){
	if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){	
		var dataString = 'process=delete_file&id='+id+'&type='+type;
		$.ajax({
			type: "POST",
			url: "bpmn_desc_function.php",
			data: dataString,
			cache: false,
			success: function(html){
				$("#shw_form_attach"+type+"_"+id).hide();
			}
		});
	}
}
</script>
<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_admin.php'; 
?>