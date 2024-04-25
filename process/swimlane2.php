<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_GET['W']);
$sql_data = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
$query_count_rows = db::query("SELECT count(WF_MAIN_ID) AS NUM_ROWS FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
$num_r = db::fetch_array($query_count_rows);

if($num_r["NUM_ROWS"] == 1){
$R = db::fetch_array($sql_data);
//$oper_arr = array("1"=>">","2"=>">=","3"=>"<","4"=>"<=","5"=>"!=",""=>"=");
$oper_arr_old = array("1"=>">","2"=>">=","3"=>"<","4"=>"<=","5"=>"!=",""=>"=");
$oper_arr = array("1"=>"มากกว่า","2"=>"มากกว่าหรือเท่ากับ","3"=>"น้อยกว่า","4"=>"น้อยกว่าหรือเท่ากับ","5"=>"ไม่เท่ากับ",""=>"เป็น");
?><!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<script type="text/javascript">
		mxBasePath = '../assets/js';
	</script>
	<script type="text/javascript" src="../assets/plugins/mxgraph/javascript/mxClient.js"></script>
	<script type="text/javascript">
		// Defines an icon for creating new connections in the connection handler.
		// This will automatically disable the highlighting of the source vertex.
		mxConnectionHandler.prototype.connectImage = new mxImage('images/connector.gif', 16, 16);
		
		// Program starts here. Creates a sample graph in the
		// DOM node with the specified ID. This function is invoked
		// from the onLoad event handler of the document (see below).
		function main(container)
		{
			// Checks if browser is supported
			if (!mxClient.isBrowserSupported())
			{
				// Displays an error message if the browser is
				// not supported.
				mxUtils.error('Browser is not supported!', 200, false);
			}
			else
			{
				// Creates a wrapper editor around a new graph inside
				// the given container using an XML config for the
				// keyboard bindings
				var config = mxUtils.load(
					'editors/config/keyhandler-commons.xml').
						getDocumentElement();
				var editor = new mxEditor(config);
				editor.setGraphContainer(container);
				var graph = editor.graph;
				var model = graph.getModel();
				// Auto-resizes the container
				graph.border = 80;
				graph.getView().translate = new mxPoint(graph.border/2, graph.border/2);
				graph.setResizeContainer(true);
				graph.graphHandler.setRemoveCellsFromParent(false);

				// Changes the default vertex style in-place
				var style = graph.getStylesheet().getDefaultVertexStyle();
				style[mxConstants.STYLE_SHAPE] = mxConstants.SHAPE_SWIMLANE;
				style[mxConstants.STYLE_VERTICAL_ALIGN] = 'middle';
				style[mxConstants.STYLE_LABEL_BACKGROUNDCOLOR] = 'white';
				style[mxConstants.STYLE_FONTSIZE] = 11;
				style[mxConstants.STYLE_STARTSIZE] = 22;
				style[mxConstants.STYLE_HORIZONTAL] = false;
				style[mxConstants.STYLE_FONTCOLOR] = 'black';
				style[mxConstants.STYLE_STROKECOLOR] = 'black';
				delete style[mxConstants.STYLE_FILLCOLOR];

				style = mxUtils.clone(style);
				style[mxConstants.STYLE_SHAPE] = mxConstants.SHAPE_RECTANGLE;
				style[mxConstants.STYLE_FONTSIZE] = 10;
				style[mxConstants.STYLE_ROUNDED] = true;
				style[mxConstants.STYLE_HORIZONTAL] = true;
				style[mxConstants.STYLE_VERTICAL_ALIGN] = 'middle';
				delete style[mxConstants.STYLE_STARTSIZE];
				style[mxConstants.STYLE_LABEL_BACKGROUNDCOLOR] = 'none';
				graph.getStylesheet().putCellStyle('process', style);
				
				style = mxUtils.clone(style);
				style[mxConstants.STYLE_SHAPE] = mxConstants.SHAPE_ELLIPSE;
				style[mxConstants.STYLE_PERIMETER] = mxPerimeter.EllipsePerimeter;
				delete style[mxConstants.STYLE_ROUNDED];
				graph.getStylesheet().putCellStyle('state', style);
												
				style = mxUtils.clone(style);
				style[mxConstants.STYLE_SHAPE] = mxConstants.SHAPE_RHOMBUS;
				style[mxConstants.STYLE_PERIMETER] = mxPerimeter.RhombusPerimeter;
				style[mxConstants.STYLE_VERTICAL_ALIGN] = 'middle';
				//style[mxConstants.STYLE_SPACING_TOP] = 15;
				//style[mxConstants.STYLE_SPACING_RIGHT] = 64;
				graph.getStylesheet().putCellStyle('condition', style);
								
				style = mxUtils.clone(style);
				style[mxConstants.STYLE_SHAPE] = mxConstants.SHAPE_DOUBLE_ELLIPSE;
				style[mxConstants.STYLE_PERIMETER] = mxPerimeter.EllipsePerimeter;
				style[mxConstants.STYLE_SPACING_TOP] = 40;
				style[mxConstants.STYLE_FONTSIZE] = 14;
				style[mxConstants.STYLE_FONTSTYLE] = 1;
				delete style[mxConstants.STYLE_SPACING_RIGHT];
				graph.getStylesheet().putCellStyle('end', style);
				
				style = graph.getStylesheet().getDefaultEdgeStyle();
				style[mxConstants.STYLE_EDGE] = mxEdgeStyle.ElbowConnector;
				style[mxConstants.STYLE_ENDARROW] = mxConstants.ARROW_BLOCK;
				style[mxConstants.STYLE_VERTICAL_ALIGN] = 'top';
				style[mxConstants.STYLE_FONTSIZE] = 10;
				style[mxConstants.STYLE_ROUNDED] = true;
				style[mxConstants.STYLE_FONTCOLOR] = 'black';
				style[mxConstants.STYLE_STROKECOLOR] = 'black';
				
				style = mxUtils.clone(style);
				style[mxConstants.STYLE_DASHED] = true;
				style[mxConstants.STYLE_ENDARROW] = mxConstants.ARROW_OPEN;
				style[mxConstants.STYLE_STARTARROW] = mxConstants.ARROW_OVAL;
				graph.getStylesheet().putCellStyle('crossover', style);
						
				// Installs double click on middle control point and
				// changes style of edges between empty and this value
				graph.alternateEdgeStyle = 'elbow=vertical';
				
				// Enables guides
				mxGraphHandler.prototype.guidesEnabled = true;
				mxEdgeHandler.prototype.snapToTerminals = true;

				// Registers and defines the custom marker
				mxMarker.addMarker('dash', function(canvas, shape, type, pe, unitX, unitY, size, source, sw, filled)
				{
					var nx = unitX * (size + sw + 1);
					var ny = unitY * (size + sw + 1);

					return function()
					{
						canvas.begin();
						canvas.moveTo(pe.x - nx / 2 - ny / 2, pe.y - ny / 2 + nx / 2);
						canvas.lineTo(pe.x + ny / 2 - 3 * nx / 2, pe.y - 3 * ny / 2 - nx / 2);
						canvas.stroke();
					};
				});
				
				// Defines custom message shape
				function MessageShape()
				{
					mxCylinder.call(this);
				};
				mxUtils.extend(MessageShape, mxCylinder);
				MessageShape.prototype.redrawPath = function(path, x, y, w, h, isForeground)
				{
					if (isForeground)
					{
						path.moveTo(0, 0);
						path.lineTo(w / 2, h / 2);
						path.lineTo(w, 0);
					}
					else
					{
						path.moveTo(0, 0);
						path.lineTo(w, 0);
						path.lineTo(w, h);
						path.lineTo(0, h);
						path.close();
					}
				};

				// Registers the message shape
				mxCellRenderer.registerShape('message', MessageShape);
				
				// Defines custom edge shape
				function LinkShape()
				{
					mxArrow.call(this);
				};
				mxUtils.extend(LinkShape, mxArrow);
				LinkShape.prototype.paintEdgeShape = function(c, pts)
				{
					var width = 10;

					// Base vector (between end points)
					var p0 = pts[0];
					var pe = pts[pts.length - 1];
					
					var dx = pe.x - p0.x;
					var dy = pe.y - p0.y;
					var dist = Math.sqrt(dx * dx + dy * dy);
					var length = dist;
					
					// Computes the norm and the inverse norm
					var nx = dx / dist;
					var ny = dy / dist;
					var basex = length * nx;
					var basey = length * ny;
					var floorx = width * ny/3;
					var floory = -width * nx/3;
					
					// Computes points
					var p0x = p0.x - floorx / 2;
					var p0y = p0.y - floory / 2;
					var p1x = p0x + floorx;
					var p1y = p0y + floory;
					var p2x = p1x + basex;
					var p2y = p1y + basey;
					var p3x = p2x + floorx;
					var p3y = p2y + floory;
					// p4 not necessary
					var p5x = p3x - 3 * floorx;
					var p5y = p3y - 3 * floory;
					
					c.begin();
					c.moveTo(p1x, p1y);
					c.lineTo(p2x, p2y);
					c.moveTo(p5x + floorx, p5y + floory);
					c.lineTo(p0x, p0y);
					c.stroke();
				};

				// Registers the link shape
				mxCellRenderer.registerShape('link', LinkShape);
				
				// Adds automatic layout and various switches if the
				// graph is enabled
				if (graph.isEnabled())
				{
					// Allows new connections but no dangling edges
					graph.setConnectable(true); 
					graph.setAllowDanglingEdges(true);
					graph.setDisconnectOnMove(true);
					
					// End-states are no valid sources
					var previousIsValidSource = graph.isValidSource;
					
					graph.isValidSource = function(cell)
					{
						if (previousIsValidSource.apply(this, arguments))
						{
							var style = this.getModel().getStyle(cell);
							
							return style == null || !(style == 'end' || style.indexOf('end') == 0);
						}

						return false;
					};
					
					// Start-states are no valid targets, we do not
					// perform a call to the superclass function because
					// this would call isValidSource
					// Note: All states are start states in
					// the example below, so we use the state
					// style below
					graph.isValidTarget = function(cell)
					{
						var style = this.getModel().getStyle(cell);
						
						return !this.getModel().isEdge(cell) && !this.isSwimlane(cell) &&
							(style == null || !(style == 'state' || style.indexOf('state') == 0));
					};
					
					// Allows dropping cells into new lanes and
					// lanes into new pools, but disallows dropping
					// cells on edges to split edges
					graph.setDropEnabled(true);
					graph.setSplitEnabled(false);
					graph.setHtmlLabels(true);
					// Returns true for valid drop operations
					graph.isValidDropTarget = function(target, cells, evt)
					{
						if (this.isSplitEnabled() && this.isSplitTarget(target, cells, evt))
						{
							return true;
						}
						
						var model = this.getModel();
						var lane = false;
						var pool = false;
						var cell = false;
						
						// Checks if any lanes or pools are selected
						for (var i = 0; i < cells.length; i++)
						{
							var tmp = model.getParent(cells[i]);
							lane = lane || this.isPool(tmp);
							pool = pool || this.isPool(cells[i]);
							
							cell = cell || !(lane || pool);
						}
						
						return !pool && cell != lane && ((lane && this.isPool(target)) ||
							(cell && this.isPool(model.getParent(target))));
					};
					
					// Adds new method for identifying a pool
					graph.isPool = function(cell)
					{
						var model = this.getModel();
						var parent = model.getParent(cell);
					
						return parent != null && model.getParent(parent) == model.getRoot();
					};
					
					// Changes swimlane orientation while collapsed
					graph.model.getStyle = function(cell)
					{
						var style = mxGraphModel.prototype.getStyle.apply(this, arguments);
					
						if (graph.isCellCollapsed(cell))
						{
							if (style != null)
							{
								style += ';';
							}
							else
							{
								style = '';
							}
							
							style += 'horizontal=1;align=left;spacingLeft=14;';
						}
						
						return style;
					};

					// Keeps widths on collapse/expand					
					var foldingHandler = function(sender, evt)
					{
						var cells = evt.getProperty('cells');
						
						for (var i = 0; i < cells.length; i++)
						{
							var geo = graph.model.getGeometry(cells[i]);

							if (geo.alternateBounds != null)
							{
								geo.width = geo.alternateBounds.width;
							}
						}
					};

					graph.addListener(mxEvent.FOLD_CELLS, foldingHandler);
				}
				
				// Applies size changes to siblings and parents
				new mxSwimlaneManager(graph);

				// Creates a stack depending on the orientation of the swimlane
				var layout = new mxStackLayout(graph, false);
				
				// Makes sure all children fit into the parent swimlane
				layout.resizeParent = true;
							
				// Applies the size to children if parent size changes
				layout.fill = true;

				// Only update the size of swimlanes
				layout.isVertexIgnored = function(vertex)
				{
					return !graph.isSwimlane(vertex);
				}
				
				// Keeps the lanes and pools stacked
				var layoutMgr = new mxLayoutManager(graph);

				layoutMgr.getLayout = function(cell)
				{
					if (!model.isEdge(cell) && graph.getModel().getChildCount(cell) > 0 &&
						(model.getParent(cell) == model.getRoot() || graph.isPool(cell)))
					{
						layout.fill = graph.isPool(cell);
						
						return layout;
					}
					
					return null;
				};
				
				// Gets the default parent for inserting new cells. This
				// is normally the first child of the root (ie. layer 0).
				var parent = graph.getDefaultParent();

				// Adds cells to the model in a single step
				model.beginUpdate();
				try
				{
					
					var pool1 = graph.insertVertex(parent, null, '<?php echo $R['WF_MAIN_NAME']; ?>', 0, 0, 2500, 0);
					pool1.setConnectable(false);
					<?php
					if(strtoupper(db::$_dbType) == 'ORACLE'){
						$order_s = " NULLS FIRST";
					}
					$sql_group = db::query("SELECT WF_DETAIL.DETAIL_G_ID,WF_DETAIL_GROUP.DETAIL_G_NAME FROM WF_DETAIL LEFT JOIN WF_DETAIL_GROUP ON WF_DETAIL.DETAIL_G_ID = WF_DETAIL_GROUP.DETAIL_G_ID WHERE WF_DETAIL.WF_MAIN_ID = '".$W."' GROUP BY WF_DETAIL.DETAIL_G_ID,WF_DETAIL_GROUP.DETAIL_G_NAME,WF_DETAIL_GROUP.DETAIL_G_ORDER ORDER BY WF_DETAIL_GROUP.DETAIL_G_ORDER".$order_s);
					while($L=db::fetch_array($sql_group)){
						echo "var lane_".$L['DETAIL_G_ID']." = graph.insertVertex(pool1, null, '".$L['DETAIL_G_NAME']."', 0, 0, 2500, 160);		// สร้าง Lane\n";
						$w_lane[$L['DETAIL_G_ID']] = 120;
					}
					$w_lane_a = 120;
					?>
					
							// Node เริ่มต้น
								// Node สิ้นสุด
		<?php
		$end="";
		$txt = "";
		$txt2 = "";
		$cur_l = "";
		$sql_form = db::query("SELECT * FROM WF_DETAIL WHERE WF_MAIN_ID = '".$R["WF_MAIN_ID"]."' ORDER BY WFD_ORDER ASC ");
            while($F=db::fetch_array($sql_form)){
				$txt_k = $F["WFD_ID"];
				$txt_c = "process";
				$txt_t = $F["WFD_NAME"];
				$txt_l = $F['DETAIL_G_ID'];
				
				if($F["WFD_DEFAULT_STEP"] != "" AND $F["WFD_DEFAULT_STEP"] != '0'){
					$txt2 .= "graph.insertEdge(lane_".$txt_l.", null, null, step".$F["WFD_ID"].", step".$F["WFD_DEFAULT_STEP"].");\n";
				}
				$sql_con = db::query("SELECT * FROM WF_STEP_CON WHERE WFD_ID = '".$F["WFD_ID"]."'");
				$x=0;
				while($con = db::fetch_array($sql_con)){
					
					$query_frm_show = db::query("SELECT WSF.WFS_NAME 
											FROM WF_STEP_FORM WSF 
											WHERE WSF.WF_MAIN_ID = '".$W."' 
											AND WF_TYPE = '".$R['WF_TYPE']."' 
											AND WFS_FIELD_NAME='".$con["WFSC_VAR"]."'");
					$step_fshow = db::fetch_array($query_frm_show); 
					$data_field = $step_fshow["WFS_NAME"];
					if($data_field == ""){
						$data_field = $con["WFSC_VAR"];
					}
					$data_ex[$con["WFSC_VAR"]] = $con["WFSC_VALUE"];
					if($con["WFSC_VAR"] != ""){
					$data_txt = bsf_show_text($W,$data_ex,"##".$con["WFSC_VAR"]."!!",$R['WF_TYPE']);
					}else{
					$data_txt = "";	
					}
					if($data_txt == ""){
						$data_txt = $con["WFSC_VALUE"];
					}
					if($data_txt == ""){
						$data_txt = "(ว่าง)";
					}
					
				$array_txt[] = "{\"key\":\"C".$con["WFSC_ID"]."\", \"text\":\"".$data_field."".$oper_arr[$con["WF_CON_OPERATE"]]." '".$data_txt."'\" ,\"category\":\"Action\"}";	
				$array_link[] = "{\"from\":\"S".$F["WFD_ID"]."\", \"to\":\"C".$con["WFSC_ID"]."\"".$oper_Side[$x]."}";
				$array_link[] = "{\"from\":\"C".$con["WFSC_ID"]."\", \"to\":\"S".$con["WFSC_STEP"]."\"}";
				$txt2 .= "graph.insertEdge(lane_".$txt_l.", null, \"".$data_field."".$oper_arr[$con["WF_CON_OPERATE"]]." '".$data_txt."'\", step".$F["WFD_ID"].", step".$con["WFSC_STEP"].");\n";
				$txt_c = "condition";
				$x++;
				}
				if($F["WFD_TYPE"] == "T"){
					$txt_c = "process";
				}
				if($F["WFD_TYPE"] == "E"){
					if($end==""){
					$array_txt[] = '{"key":"End", "category":"End", "text":"End"}';
					$txt .= "var end1 = graph.insertVertex(lane_".$txt_l.", null, '', ".($w_lane_a+200).", 65, 30, 30, 'end');\n";
					$end = "Y";
					} 
					$txt2 .= "graph.insertEdge(lane_".$txt_l.", null, null, step".$F["WFD_ID"].", end1);\n";
				}
				if($F["WFD_TYPE"] == "S" ){
					$txt .= "var start1 = graph.insertVertex(lane_".$txt_l.", null, 'Start', 40, 60, 40, 40, 'state');\n";
					$txt2 .= "graph.insertEdge(lane_".$txt_l.", null, null, start1, step".$F["WFD_ID"].");\n";
				}			
				 
				$txt .= "var step".$txt_k." = graph.insertVertex(lane_".$txt_l.", null, '".$txt_t."', ".$w_lane_a.", 50, 150, 60, '".$txt_c.";whiteSpace=wrap;');\n";
				
				//$w_lane[$txt_l] += 250;
				$w_lane_a += 200;
				 $cur_l = $txt_l;
			}
			echo $txt.$txt2;
		?>
			 
				}
				finally
				{
					// Updates the display
					model.endUpdate();
					 
				}
			}
		}
	</script>
</head>
<body onload="main(document.getElementById('graphContainer'))">

<div id="graphContainer"
		style="position:absolute;overflow:hidden;top:40px;left:40px;width:600px;height:400px;border: gray dotted 1px;cursor:default;">
</div>

</body>
</html>
<?php } db::db_close(); ?>