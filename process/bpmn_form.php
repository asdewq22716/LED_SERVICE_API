<?php
$HIDE_HEADER = "P";
include '../include/comtop_user.php';
$id = $_GET['id'];
$process = $_GET['process'];

if($process == 'add'){
	$default_b = ' { "class": "go.GraphLinksModel",
  "nodeDataArray": [ 
{"key":"501", "text":"Title", "isGroup":"true", "category":"Pool", "loc":"244.95312500000006 212"},
{"key":"Lane5", "text":"Lane1", "isGroup":"true", "group":"501", "color":"white", "category":"Lane", "size":"1004 115.57783203125018", "loc":"244.95312500000006 212"},
{"key":101, "category":"event", "text":"Start", "eventType":1, "eventDimension":1, "item":"start", "loc":"320 270", "group":"Lane5"},
{"key":131, "category":"activity", "text":"Task", "item":"generic task", "taskType":0, "loc":"460 270", "group":"Lane5"}
 ],
  "linkDataArray": [ {"from":101, "to":131, "points":[341.5,270.00000000000017,351.5,270.00000000000017,365.75000000000006,270.00000000000017,365.75000000000006,269.99999999999994,380.0000000000001,269.99999999999994,400.0000000000001,269.99999999999994]} ]}';
}else if($process == 'edit'){
	$q_bpmn = db::query("SELECT * FROM WF_BPMN WHERE BPMN_ID = '".$id."'");
	$r_bpmn = db::fetch_array($q_bpmn);
	
	if(file_exists('../bpmn/bpmn_'.$id.'.tmp')){
		$filename = "../bpmn/bpmn_".$id.".tmp";
		$handle = fopen($filename, "r");
		$default_b = fread($handle, filesize($filename));
		fclose($handle);
	}
}
?>
<link rel="stylesheet" href="../assets/css/jquery-ui.min.css" />
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/jquery-ui.min.js"></script>

<link href="../assets/gojs/extensions/js/BPMN.css" rel="stylesheet" type="text/css" />
<script src="../assets/gojs/release/go.js"></script>
<script src="../assets/gojs/extensions/js/DrawCommandHandler.js"></script>
<script src="../assets/gojs/extensions/js/BPMNClasses.js"></script>
<script src="../assets/gojs/extensions/js/BPMN.js"></script>
<script type="text/javascript" src="../assets/js/dom-to-image.js"></script> 
<script type="text/javascript">
  function makeSVG() {
	  document.getElementById('SVGArea').style.display='';
    var svg = myDiagram.makeSvg({
        scale: 1
      });
    svg.style.border = "0px";
    obj = document.getElementById("SVGArea");
    obj.appendChild(svg);
    if (obj.children.length > 0){
      obj.replaceChild(svg, obj.children[0]);
	}
	var parent = document.getElementById('SVGArea');
	var canvas = document.createElement('canvas');
	canvas.width = obj.scrollWidth;
	canvas.height = obj.scrollHeight;
	domtoimage.toPng(obj).then(function (pngDataUrl) {
		document.getElementById('er_img').src = pngDataUrl;
		document.getElementById('SVGArea').style.display='none';
	});
  }
</script>
<body onload="init()"> 
	<div id="currentFile" style="display:none">(Unsaved File)</div>
	<ul id="menuui" style="display:none">
		<li><a href="#">File</a>
			<ul>
				<li><a href="#" onclick="newDocument()">New</a></li>
				<li><a href="#" onclick="openDocument()">Open...</a></li>
				<li><a href="#" onclick="saveDocument()">Save</a></li>
				<li><a href="#" onclick="saveDocumentAs()">Save As...</a></li>
				<li><a href="#" onclick="removeDocument()">Delete...</a></li>
			</ul>
		</li>
		<li><a href="#">Edit</a>
			<ul>
				<li><a href="#" onclick="myDiagram.commandHandler.undo()">Undo</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.redo()">Redo</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.cutSelection()">Cut</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.copySelection()">Copy</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.pasteSelection()">Paste</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.deleteSelection()">Delete</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.selectAll()">Select All</a></li>
			</ul>
		</li>
		<li><a href="#">Align</a>
			<ul>
				<li><a href="#" onclick="myDiagram.commandHandler.alignLeft()">Left Sides</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.alignRight()">Right Sides</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.alignTop()">Tops</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.alignBottom()">Bottoms</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.alignCenterX()">Center X</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.alignCenterY()">Center Y</a></li>
			</ul>
		</li>
		<li><a href="#">Space</a>
			<ul>
				<li><a href="#" onclick="myDiagram.commandHandler.alignRow(askSpace())">In Row...</a></li>
				<li><a href="#" onclick="myDiagram.commandHandler.alignColumn(askSpace())">In Column...</a></li>
			</ul>
		</li>
		<li><a href="#">Options</a>
			<ul>
				<li><a href="#"><input id="grid" type="checkbox" name="options" value="grid" onclick="updateGridOption()">Grid</a></li>
				<li><a href="#"><input id="snap" type="checkbox" name="options" value="0" onclick="updateSnapOption()">Snapping</a></li>
			</ul>
		</li>
	</ul>
	<!--END menu bar -->
	 
	<!-- Styling for this portion is in BPMN.css -->
	<form id="save_m" action="bpmn_function.php" method="post" target="bpmn_target" onSubmit="return save();">
		<div id="PaletteAndDiagram">
			
			<div id="sideBar">
				<span style="display: inline-block; vertical-align: top; padding: 5px; width:100%">
					<div id="accordion">
						
						<div>
							<div id="myPaletteLevel1" class="myPaletteDiv" ></div>
						</div>  
					</div>
				</span>
				<div class="handle">Overview:</div>
				<div id="myOverviewDiv"></div>
			</div>
		
			<div id="myDiagramDiv"></div> 
			
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-block">
							<div class="form-group row">
								<div class="col-md-3" style="text-align:right;"> 
									<label for="BPMN_NAME" class="form-control-label">BPMN Name <span class="text-danger">*</span></label>
								</div> 
								<div class="col-md-7"> 
									<input type="text" name="BPMN_NAME" value="<?php echo $r_bpmn['BPMN_NAME'];?>" class="form-control" required> 
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-3" style="text-align:right;"> 
									<label for="GROUP_ID" class="form-control-label">กลุ่ม <span class="text-danger">*</span></label>
								</div> 
								<div class="col-md-7"> 
									<select name="WF_GROUP_ID" id="WF_GROUP_ID" class="select2" required aria-required="true" placeholder="เลือก...">
										<option value=""></option>
										<?php
										$sql_group = db::query("SELECT GROUP_ID, GROUP_NAME FROM WF_GROUP WHERE WF_TYPE = 'W' ORDER BY GROUP_ORDER ASC");
										while($rec_group = db::fetch_array($sql_group)){ 
											?>
											<option value="<?php echo $rec_group['GROUP_ID']; ?>" <?php if($r_bpmn['WF_GROUP_ID'] == $rec_group['GROUP_ID']){ echo "selected"; } ?>><?php echo $rec_group['GROUP_NAME']; ?></option>
											<?php 
										}
										?>
									</select>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			
			<textarea id="mySavedModel" name="M_DATA" style="width:100%;height:200px;display:none;">
				<?php echo $default_b;?>
			</textarea>
			
			<input type="hidden" name="process" value="<?php echo $process;?>">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="hidden" name="url_back" id="url_back" value="">
			
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-3" style="text-align:left;">
						<a class="btn btn-danger waves-effect waves-light" href="bpmn_list.php" role="button"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ </a>
					</div>
					<div class="col-md-9" style="text-align:right;">
						<input type="submit" class="btn btn-success" value="Save" />&nbsp;&nbsp;
						<!--<input type="submit" class="btn btn-warning" value="Save As"/>&nbsp;&nbsp;-->
						<input type="button" class="btn btn-danger" value="Reset" onclick="load();" />&nbsp;&nbsp;
						<input type="button" class="btn btn-info" value="View" onclick="printDiagram();" />&nbsp;&nbsp; 
						<input type="button" class="btn btn-warning" value="Convert" onclick="makeSVG();" />
					</div>
				</div>
			</div>
		</div>
	</form>
	<br>
	
	<iframe id="bpmn_target" name="bpmn_target" style="width:1px;height:1px;display:none"></iframe>
	
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
	  
	<div id="SVGArea" ></div>
	<img id="er_img" />
</body>
<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_admin.php'; 
 ?>