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
				<div class="col-sm-8">
					<div class="main-header">
						<h4><?php echo $r_bpmn['BPMN_NAME'];?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a></li>
							<li class="breadcrumb-item"><a href="bpmn_list.php">BPMN</a></li>
							<li class="breadcrumb-item"><a href="#">Requirment</a></li>
						</ol>
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="md-group-add-on col-sm-12">
						<span class="md-add-on">
							<i class="icofont icofont-search-alt-2 chat-search"></i>
						</span>
						<div class="md-input-wrapper">
							<input type="text" class="md-form-control" name="wf_search" id="search-wf_main_modal">
							<label for="username">ค้นหา</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row" id="animationSandbox">
				<div class="col-sm-12">
					<div class="f-right">
						<nobr>
							<input type="button" class="btn btn-info" value="ดูรูป BPMN" onclick="printDiagram();" />
							<a class="btn btn-danger waves-effect waves-light" href="bpmn_list.php" role="button"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ </a>
						</nobr>
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
			
			<form id="form_req_bpmn" action="bpmn_requiment_function.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="process" value="add_requirment">
				<input type="hidden" name="BPMN_ID" id="BPMN_ID" value="<?php echo $id;?>">
				<input type="hidden" name="back_page_old" id="back_page_old" value="">
				
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="table-responsive" data-pattern="priority-columns">
									<div class="f-right text-danger">หมายเหตุ : Font สีแดงคือ TOR ที่มีการถูกติกเลือกแล้ว</div>
									<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
										<thead>
											<tr class="bg-primary">
												<th class="text-center" style="width:8%">เลือก</th>
												<th class="text-center" style="width:12%">ข้อที่ TOR</th>
												<th class="text-center" style="width:80%">รายละเอียด TOR</th>
											</tr>
										<thead>
										<tbody>
											<?php
											$j=1;
											$q_tor = db::query("SELECT * FROM WF_TOR ORDER BY TOR_ID ASC");
											$num_rows_tor = db::num_rows($q_tor);
											while($r_tor = db::fetch_array($q_tor)){
												$sql_bpmn = db::query("SELECT BPMN_TOR_ID, TOR_ID FROM WF_BPMN_TOR WHERE BPMN_ID = '".$id."' AND TOR_ID = '".$r_tor['TOR_ID']."'");
												$data_bpmn = db::fetch_array($sql_bpmn);
												
												$q_bpmn_tor = db::query("SELECT BPMN_TOR_ID FROM WF_BPMN_TOR WHERE TOR_ID = '".$r_tor['TOR_ID']."'");
												$num_rows = db::num_rows($q_bpmn_tor);
												$class = ($num_rows > 0) ? "text-danger" : "";
												?>
												<tr id="tr_<?php echo $r_tor['BPMN_ID'];?>" class="wf_modal_keyword-box">
													<td class="text-center">
														<div class="checkbox-color checkbox-primary col-xs-12">
															<input type="checkbox" name="TOR_SELECT<?php echo $j;?>" id="TOR_SELECT<?php echo $j;?>" value="Y" <?php if($data_bpmn['BPMN_TOR_ID'] != ''){ echo 'checked';}?>><label for="TOR_SELECT<?php echo $j;?>"></label>
														</div>
														<input type="hidden" name="TOR_ID<?php echo $j;?>" id="TOR_ID<?php echo $j;?>" value="<?php echo $r_tor['TOR_ID']; ?>">
														<input type="hidden" name="BPMN_TOR_ID<?php echo $j;?>" id="BPMN_TOR_ID<?php echo $j;?>" value="<?php echo $data_bpmn['BPMN_TOR_ID']; ?>">
													</td>
													<td class="wf_keyword <?php echo $class;?>"><?php if($r_tor['TOR_STATUS'] == 'M' || $r_tor['TOR_STATUS'] == 'H'){ echo "<b>".$r_tor['TOR_NO']."</b>"; }else{ echo $r_tor['TOR_NO']; }?></td>
													<td class="wf_keyword <?php echo $class;?>"><?php if($r_tor['TOR_STATUS'] == 'M' || $r_tor['TOR_STATUS'] == 'H'){ echo "<b>".$r_tor['TOR_NAME']."</b>"; }else{ echo $r_tor['TOR_NAME']; }?></td>
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
				<input type="hidden" name="num_rows_tor" id="num_rows_tor" value="<?php echo $num_rows_tor; ?>">
			</form>
		</div>
	</div>
</body>
<script>
$(document).ready(function() {
	$("#search-wf_main_modal").on("keyup", function() {
		var g = $(this).val().toLowerCase();
		$(".wf_keyword").each(function() {
			var s = $(this).text().toLowerCase();
			$(this).closest('.wf_modal_keyword-box')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
		});
	});
});
</script>
<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_admin.php'; 
?>