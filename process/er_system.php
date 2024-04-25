<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$array_relation = array();

if(count($_POST["WF_SELECT_U"]) > 0){
	
	/*$u = implode(',',$_POST["WF_SELECT_U"]);
	$wh = " AND TABLE_NAME IN (".$u.")";
	$sql_data = db::query("SELECT * FROM WF_MAIN WHERE 1=1 ".$wh);
	$num_r = db::num_rows($sql_data);*/

	
	
?><!DOCTYPE html>
<html>
<head>
<title>Entity Relationship</title>
<meta charset="UTF-8">
<script src="../assets/js/go.js"></script>
<!-- <link href="js/assets/css/goSamples.css" rel="stylesheet" type="text/css" />  you don't need to use this -->
<script type="text/javascript" src="../assets/js/dom-to-image.js"></script> 
<script id="code">
  function init() {
    if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var $ = go.GraphObject.make;  // for conciseness in defining templates

    myDiagram =
      $(go.Diagram, "myDiagramDiv",  // must name or refer to the DIV HTML element
        {
          initialContentAlignment: go.Spot.Center,
          allowDelete: true,
          allowCopy: false,
          layout: $(go.ForceDirectedLayout),
          "undoManager.isEnabled": true
        });

    // define several shared Brushes
    var bluegrad = $(go.Brush, "Linear", { 0: "rgb(150, 150, 250)", 0.5: "rgb(86, 86, 186)", 1: "rgb(86, 86, 186)" });
    var greengrad = $(go.Brush, "Linear", { 0: "rgb(158, 209, 159)", 1: "rgb(67, 101, 56)" });
    var redgrad = $(go.Brush, "Linear", { 0: "rgb(206, 106, 100)", 1: "rgb(180, 56, 50)" });
    var yellowgrad = $(go.Brush, "Linear", { 0: "rgb(254, 221, 50)", 1: "rgb(254, 182, 50)" });
    var lightgrad = $(go.Brush, "Linear", { 1: "#E6E6FA", 0: "#FFFAF0" });


    // the template for each attribute in a node's array of item data
    var itemTempl =
      $(go.Panel, "Horizontal",
        $(go.Shape,
          { desiredSize: new go.Size(10, 10) },
          new go.Binding("figure", "figure"),
          new go.Binding("fill", "color")),
        $(go.TextBlock,
          { stroke: "#333333",
            font: "bold 14px sans-serif" },
          new go.Binding("text", "name"))
      );

    // define the Node template, representing an entity
    myDiagram.nodeTemplate =
      $(go.Node, "Auto",  // the whole node panel
        { selectionAdorned: true,
          resizable: true,
          layoutConditions: go.Part.LayoutStandard & ~go.Part.LayoutNodeSized,
          fromSpot: go.Spot.AllSides,
          toSpot: go.Spot.AllSides,
          isShadowed: true,
          shadowColor: "#C5C1AA" },
        new go.Binding("location", "location").makeTwoWay(),
        // whenever the PanelExpanderButton changes the visible property of the "LIST" panel,
        // clear out any desiredSize set by the ResizingTool.
        new go.Binding("desiredSize", "visible", function(v) { return new go.Size(NaN, NaN); }).ofObject("LIST"),
        // define the node's outer shape, which will surround the Table
        $(go.Shape, "Rectangle",
          { fill: lightgrad, stroke: "#756875", strokeWidth: 3 }),
        $(go.Panel, "Table",
          { margin: 8, stretch: go.GraphObject.Fill },
          $(go.RowColumnDefinition, { row: 0, sizing: go.RowColumnDefinition.None }),
          // the table header
          $(go.TextBlock,
            {
              row: 0, alignment: go.Spot.Center,
              margin: new go.Margin(0, 14, 0, 2),  // leave room for Button
              font: "bold 16px sans-serif"
            },
            new go.Binding("text", "key")),
          // the collapse/expand button
          $("PanelExpanderButton", "LIST",  // the name of the element whose visibility this button toggles
            { row: 0, alignment: go.Spot.TopRight }),
          // the list of Panels, each showing an attribute
          $(go.Panel, "Vertical",
            {
              name: "LIST",
              row: 1,
              padding: 3,
              alignment: go.Spot.TopLeft,
              defaultAlignment: go.Spot.Left,
              stretch: go.GraphObject.Horizontal,
              itemTemplate: itemTempl
            },
            new go.Binding("itemArray", "items"))
        )  // end Table Panel
      );  // end Node

    // define the Link template, representing a relationship
    myDiagram.linkTemplate =
      $(go.Link,  // the whole link panel
        {
          selectionAdorned: true,
          layerName: "Foreground",
          reshapable: true,
          routing: go.Link.AvoidsNodes,
          corner: 5,
          curve: go.Link.JumpOver
        },
		$(go.Shape,  // the link shape
          { stroke: "#303B45", strokeWidth: 2.5 }),
		  
        $(go.TextBlock,  // the "from" label
          {
            textAlign: "center",
            font: "bold 14px sans-serif",
            stroke: "#1967B3",
            segmentIndex: 0,
            segmentOffset: new go.Point(NaN, NaN),
            segmentOrientation: go.Link.OrientUpright
          },
          new go.Binding("text", "text")),
        $(go.TextBlock,  // the "to" label
          {
            textAlign: "center",
            font: "bold 14px sans-serif",
            stroke: "#1967B3",
            segmentIndex: -1,
            segmentOffset: new go.Point(NaN, NaN),
            segmentOrientation: go.Link.OrientUpright
          },
          new go.Binding("text", "toText"))
      );

    // create the model for the E-R diagram
	var nodeDataArray = [
<?php
$array_relation = array();
//while($R = db::fetch_array($sql_data)){
	$array_relation["USR_ACCESS"] = '{ from: "USR_ACCESS", to: "USR_MAIN", text: "1", toText: "M" }';
	$array_relation["USR_GROUP_SETTING"] = '{ from: "USR_GROUP_SETTING", to: "USR_GROUP", text: "M", toText: "1" },';
	$array_relation["USR_GROUP_SETTING"] .= '{ from: "USR_GROUP_SETTING", to: "USR_MAIN", text: "M", toText: "1" }';
	$array_relation["USR_MAIN"] = '{ from: "USR_MAIN", to: "USR_POSITION", text: "1", toText: "1" },';
	$array_relation["USR_MAIN"] .= '{ from: "USR_MAIN", to: "USR_DEPARTMENT", text: "1", toText: "1" }';

	$arr_pk = array('USR_ACCESS'=>'ACCESS_ID','USR_DEPARTMENT'=>'DEP_ID','USR_GROUP'=>'GROUP_ID','USR_GROUP_SETTING'=>'UGS_ID','USR_MAIN'=>'USR_ID','USR_POSITION'=>'POS_ID');

	
	$arr_ref_table1 = array('USR_ACCESS','USR_GROUP_SETTING','USR_MAIN');
	$arr_fk['USR_ACCESS'] = array('USR_REF_ID');
	$arr_fk['USR_GROUP_SETTING'] = array('GROUP_ID','USR_ID');
	$arr_fk['USR_MAIN'] = array('DEP_ID','POS_ID');
foreach($_POST["WF_SELECT_U"] as $val){	



?>
      { key: "<?php echo $val;?>",
        items: [ <?php
				/*$sql_step_form = db::query("SELECT COLUMN_NAME, DATA_TYPE, DATA_LENGTH FROM all_tab_cols 
								WHERE table_name = '".$val."' 
								ORDER BY SEGMENT_COLUMN_ID");*/
				$arr_data = db::show_field($val);
				$num_rows = count($arr_data);
				//$field_pk = get_pk($val);
				$field_pk = $arr_pk[$val];
				
				$i=0;
				$table_ref = '';
					foreach($arr_data as $value){
						$pk = '';
						$figure = '';
						$color = '';
					if($num_rows == $i){
						$comma = '';
					}else{
						$comma = ',';
					}
					
					if($value == $field_pk){
						$pk = 'true';
						$figure = 'Decision';
						$color = 'yellowgrad';
					}else{
						
						if($value != ''){
							if(count($arr_fk[$val]) > 0){
								if(in_array($value, $arr_fk[$val])){
									$pk = 'true';
									$figure = 'Decision';
									$color = 'redgrad';
								
								
								}else{
									$pk = 'false';
									$figure = 'Cube1';
									$color = 'bluegrad';
								}
							}else{
								$pk = 'false';
								$figure = 'Cube1';
								$color = 'bluegrad';
							}
						}
					}
					if($value != '' OR $pk == 'true'){
						echo '{ name: "'.$value.'", iskey: '.$pk.', figure: "'.$figure.'", color: '.$color.' }'.$comma;
						
					}
					$i++;
				}
		?> ] },
		<?php 	} ?>
    ];
 
    var linkDataArray = [
	<?php
		echo $relation = implode(',',$array_relation);
	?>
    ];
    myDiagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);
  }
  function makeSVG() {
	  document.getElementById('SVGArea').style.display='';
    var svg = myDiagram.makeSvg({
        scale: 1
      });
    svg.style.border = "1px solid black";
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
</head>
<body onload="init()" >
 
  <div id="myDiagramDiv" style="background-color: white; border: solid 1px black; width: 100%; height: 600px"></div>
  <button onclick="makeSVG()">Convert to Picture</button>
	<div id="SVGArea" ></div>
	<img id="er_img" />
</body>
<?php } db::db_close(); ?>