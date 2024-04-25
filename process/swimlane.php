<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = $_GET['W'];
?>
<!DOCTYPE html>
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
				style[mxConstants.STYLE_VERTICAL_ALIGN] = 'top';
				style[mxConstants.STYLE_SPACING_TOP] = 40;
				style[mxConstants.STYLE_SPACING_RIGHT] = 64;
				graph.getStylesheet().putCellStyle('condition', style);
								
				style = mxUtils.clone(style);
				style[mxConstants.STYLE_SHAPE] = mxConstants.SHAPE_DOUBLE_ELLIPSE;
				style[mxConstants.STYLE_PERIMETER] = mxPerimeter.EllipsePerimeter;
				style[mxConstants.STYLE_SPACING_TOP] = 28;
				style[mxConstants.STYLE_FONTSIZE] = 14;
				style[mxConstants.STYLE_FONTSTYLE] = 1;
				delete style[mxConstants.STYLE_SPACING_RIGHT];
				graph.getStylesheet().putCellStyle('end', style);
				
				style = graph.getStylesheet().getDefaultEdgeStyle();
				style[mxConstants.STYLE_EDGE] = mxEdgeStyle.ElbowConnector;
				style[mxConstants.STYLE_ENDARROW] = mxConstants.ARROW_BLOCK;
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

				// Adds automatic layout and various switches if the
				// graph is enabled
				if (graph.isEnabled())
				{
					// Allows new connections but no dangling edges
					graph.setConnectable(true);
					graph.setAllowDanglingEdges(false);
					
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
					<?php
					$sql_group = db::query("SELECT * FROM WF_DETAIL_GROUP WHERE WF_MAIN_ID='".$W."' ORDER BY DETAIL_G_ORDER ");
					$num_group = db::num_rows($sql_group);
					if($num_group == 0) exit;
					$array_lane = array();
					while($rec_group = db::fetch_array($sql_group))
					{
						$array_lane[$rec_group['DETAIL_G_ID']] = $rec_group['DETAIL_G_NAME'];
					}

					$sql_det = "SELECT * FROM WF_DETAIL WHERE WF_MAIN_ID = '{$W}'  ORDER BY WFD_ORDER";
					$res_det = db::query($sql_det);
					$num_det = db::num_rows($res_det);
					$i=0;
					$previous = "";
					while($rec_det = db::fetch_array($res_det))
					{
						if($i == 0)
						{
							$start['lane'] = $rec_det['DETAIL_G_ID'];
							$start['node'] = $rec_det['WFD_ID'];
						}
						elseif(($i + 1) == $num_det)
						{
							$end['lane'] = $rec_det['DETAIL_G_ID'];
							$end['node'] = $rec_det['WFD_ID'];
						}

						$array_flow[$i]['lane_id'] = $rec_det['DETAIL_G_ID'];
						$array_flow[$i]['wfd_id'] = $rec_det['WFD_ID'];
						$array_flow[$i]['wfd_next'] = $rec_det['WFD_DEFAULT_STEP'];
						$array_flow[$i]['wfd_previous'] = $previous;
						$array_flow[$i]['name'] = $rec_det['WFD_NAME'];
						$array_flow[$i]['order'] = $rec_det['WFD_ORDER'];

						$sql_con = db::query("SELECT * FROM WF_STEP_CON WHERE WFD_ID = '".$rec_det["WFD_ID"]."'");
						$num_con = db::num_rows($sql_con);
						if($num_con == 0)
						{
							$array_flow[$i]['process'] = "process";
						}
						else
						{
							$array_flow[$i]['process'] = "condition";
							$j = 0;
							while($rec_con = db::fetch_array($sql_con))
							{
								$array_flow[$i]['cond_detail'][$j]['c_id'] = $rec_con['WFSC_STEP'];
								$array_flow[$i]['cond_detail'][$j]['c_name'] = $rec_con['WFSC_VALUE'];

								$j++;
							}
						}

						$previous = $rec_det['WFD_DEFAULT_STEP'];
						$i++;
					}

//					$array_lane = array('นายช่าง', 'จัดประโยชน์', 'ธนารักษ์', 'การเงิน');
					/*$array_flow[0]['lane_id'] = "1";
					$array_flow[0]['wfd_id'] = "1";
					$array_flow[0]['wfd_next'] = "2";
					$array_flow[0]['wfd_previous'] = "";
					$array_flow[0]['name'] = "ยื่นคำขอ";
					$array_flow[0]['process'] = "process";
					$array_flow[0]['order'] = "1";

					$array_flow[1]['lane_id'] = "0";
					$array_flow[1]['wfd_id'] = "2";
					$array_flow[1]['wfd_next'] = "3";
					$array_flow[1]['wfd_previous'] = "1";
					$array_flow[1]['name'] = "สำรวจ";
					$array_flow[1]['process'] = "process";
					$array_flow[1]['order'] = "2";

					$array_flow[2]['lane_id'] = "0";
					$array_flow[2]['wfd_id'] = "3";
					$array_flow[2]['wfd_next'] = "4";
					$array_flow[2]['wfd_previous'] = "2";
					$array_flow[2]['name'] = "บันทึกผลสำรวจ";
					$array_flow[2]['process'] = "process";
					$array_flow[2]['order'] = "3";

					$array_flow[3]['lane_id'] = "3";
					$array_flow[3]['wfd_id'] = "4";
					$array_flow[3]['wfd_next'] = "5";
					$array_flow[3]['wfd_previous'] = "3";
					$array_flow[3]['name'] = "รับเงิน";
					$array_flow[3]['process'] = "process";
					$array_flow[3]['order'] = "4";

					$array_flow[4]['lane_id'] = "2";
					$array_flow[4]['wfd_id'] = "5";
					$array_flow[4]['wfd_next'] = "6";
					$array_flow[4]['wfd_previous'] = "4";
					$array_flow[4]['name'] = "จัดเช่าหรือไม่";
					$array_flow[4]['process'] = "condition";
					$array_flow[4]['order'] = "5";
					$array_flow[4]['cond_detail'][0]['c_id'] = 10;
					$array_flow[4]['cond_detail'][0]['c_name'] = "Yes";
					$array_flow[4]['cond_detail'][1]['c_id'] = 11;
					$array_flow[4]['cond_detail'][1]['c_name'] = "No";

					$array_flow[5]['lane_id'] = "1";
					$array_flow[5]['wfd_id'] = "10";
					$array_flow[5]['wfd_next'] = "12";
					$array_flow[5]['wfd_previous'] = "5";
					$array_flow[5]['name'] = "ติดประกาศ";
					$array_flow[5]['process'] = "process";
					$array_flow[5]['order'] = "6";

					$array_flow[6]['lane_id'] = "2";
					$array_flow[6]['wfd_id'] = "11";
					$array_flow[6]['wfd_next'] = "12";
					$array_flow[6]['wfd_previous'] = "5";
					$array_flow[6]['name'] = "จบกระบวนงาน";
					$array_flow[6]['process'] = "process";
					$array_flow[6]['order'] = "7";*/

					##	สร้างเส้นเชื่อม		ตัวแปรเลน			ตัวแปรต้นทาง	ตัวแปรปลายทาง
					## graph.insertEdge(lane1a, null, null, start1, step1);
					?>

					var pool1 = graph.insertVertex(parent, null, 'การจัดเช่าเพื่ออยู่อาศัย', 0, 0, 640, 0);
					pool1.setConnectable(false);

					<?php
					foreach($array_lane as $_key => $_val)
					{
					?>
						var lane<?php echo $_key; ?> = graph.insertVertex(pool1, null, '<?php echo $_val; ?>', 0, 0, 1000, 110);		// สร้าง Lane
						lane<?php echo $_key; ?>.setConnectable(false);
					<?php
					}
					?>

					var start1 = graph.insertVertex(lane<?php echo $start['lane'] ?>, null, 'Start', 40, 40, 30, 30, 'state');		// Node เริ่มต้น
					var end1 = graph.insertVertex(lane<?php echo $end['lane'] ?>, null, 'Finish', 560, 40, 30, 30, 'end');			// Node สิ้นสุด

					<?php
					$x = 90;
					$y = 0;
					$last_lane = "";
					foreach($array_flow as $_key => $_val)
					{
						if($_val['lane_id'] == $last_lane)
						{
							$x += 100;
							$y = 0;
						}
						else
						{
							if($_key != 0)
							{
								$y++;
							}
						}

						if($y == 2)
						{
							$x += 100;
							$y = 0;
						}
					?>
						var step<?php echo $_val['wfd_id']; ?> = graph.insertVertex(lane<?php echo $_val['lane_id']; ?>, null, '<?php echo $_val['name']; ?>', <?php echo $x; ?>, 30, 80, 50, '<?php echo $_val['process']; ?>');		// Node ปกติ
					<?php
						$last_lane = $_val['lane_id'];
					}
					?>

					graph.insertEdge(lane<?php echo $start['lane'] ?>, null, null, start1, step<?php echo $start['node']; ?>);			// เส้นเชื่อม Node เริ่มต้น

					<?php
					foreach($array_flow as $_key => $_val)
					{
						if($_key == 0) continue;


					?>
						graph.insertEdge(lane<?php echo $_val['lane_id']; ?>, null, null, step<?php echo $_val['wfd_previous']; ?>, step<?php echo $_val['wfd_id']; ?>);			// เส้นเชื่อม Node
					<?php
					if($_val['process'] == "condition")
						{
							foreach($_val['cond_detail'] as $_node => $_item)
							{
								?>
									graph.insertEdge(lane<?php echo $_val['lane_id']; ?>, null, '<?php echo $_item['c_name']; ?>', step<?php echo $_val['wfd_id']; ?>, step<?php echo $_item['c_id']; ?>, 'verticalAlign=bottom');			// เส้นเชื่อม Node แบบมีเงื่อนไข
								<?php
							}
						}
					}
					?>

					graph.insertEdge(lane<?php echo $end['lane'] ?>, null, null, step<?php echo $end['node'] ?>, end1);			// เส้นเชื่อม Node สิ้นสุด
					//graph.insertEdge(lane3, null, null, step11, end1);			// เส้นเชื่อม Node สิ้นสุด
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
<?php
/*$x = 90;
$y = 0;
$last_lane = "";
foreach($array_flow as $_key => $_val)
{
	echo $_key.$_val['name'].'<br>';

	if($_val['lane_id'] == $last_lane)
	{
		$x += 100;
		$y = 0;
	}
	else
	{
		if($_key != 0)
		{
			$y++;
		}
	}

	if($y == 2)
	{
		echo 'var s_'.$_val['name'].$y.';';
		$x += 100;
		$y = 0;
	}

	$last_lane = $_val['lane_id'];
	echo '<hr>';
}exit;*/
?>

<div id="graphContainer"
		style="position:absolute;overflow:hidden;top:40px;left:40px;width:600px;height:400px;border: gray dotted 1px;cursor:default;">
</div>

</body>
</html>
<?php db::db_close(); ?>