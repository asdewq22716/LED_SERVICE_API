<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
if(count($_POST["WF_SELECT"] > 0) AND $_GET["group"] == 'Y'){
	$W = implode(',',$_POST["WF_SELECT"]);
	$wh = " AND WF_MAIN_ID IN (".$W.")";
}else{
	$W = conText($_GET['W']);
	$wh = " AND WF_MAIN_ID = ".$W;
}
if(count($_POST["WF_SELECT_U"]) > 0){
	//$W = implode(',',$_POST["WF_SELECT"]);
	//$wh = " AND WF_MAIN_ID IN (".$W.")";
}else{
	//$W = conText($_GET['W']);
	//$wh = " AND WF_MAIN_ID = ".$W;
}

if($W != ''){
$sql_data = db::query("SELECT * FROM WF_MAIN WHERE 1=1 ".$wh);
$num_r = db::num_rows($sql_data);

if($num_r > 0 OR (count($_POST["WF_SELECT_U"]) > 0)){

//$WF_ARR_FIELD = db::show_field($R["WF_MAIN_SHORTNAME"]);

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
 while($R = db::fetch_array($sql_data)){	 
$arr_ref_table1 = array();

?>
      { key: "<?php echo $R["WF_MAIN_SHORTNAME"];?>",
        items: [ <?php

$sql_step_form = db::query("SELECT * FROM WF_STEP_FORM WHERE WF_MAIN_ID = '".$R['WF_MAIN_ID']."' ORDER BY WFS_ORDER,WFS_OFFSET");
				//$num_rows = count($WF_ARR_FIELD);
				$num_rows = db::num_rows($sql_step_form);
				$i=1;
				$table_ref = '';
				//foreach($WF_ARR_FIELD as $key => $value){
					while($field = db::fetch_array($sql_step_form)){
					//$step_form = select_field($R["WF_MAIN_SHORTNAME"], $field["WFS_FIELD_NAME"]);
					
					if($num_rows == $i){
						$comma = '';
					}else{
						$comma = ',';
					}
					
					if($field['WFS_FIELD_NAME'] == $R["WF_FIELD_PK"]){
						$pk = 'true';
						$figure = 'Decision';
						$color = 'yellowgrad';
					}else{
						/*if($step_form['FIELD_REF_TABLE'] != ''){
							$pk = 'true';
							$figure = 'Decision';
							$color = 'redgrad';
						}else{
							$pk = 'false';
							$figure = 'Cube1';
							$color = 'bluegrad';
						}*/
						if(($field["FORM_MAIN_ID"] == '4' OR $field["FORM_MAIN_ID"] == '5' OR $field["FORM_MAIN_ID"] == '7' OR $field["FORM_MAIN_ID"] == '9') AND $field["WFS_OPTION_SELECT_DATA"] != ''){
							if($field['WFS_FIELD_NAME'] != ''){
								$pk = 'true';
								$figure = 'Decision';
								$color = 'redgrad';
							}
							$sql_ref = db::query("SELECT WF_MAIN_SHORTNAME,WF_FIELD_PK FROM WF_MAIN WHERE WF_MAIN_ID='".$field["WFS_OPTION_SELECT_DATA"]."'");
							$ref = db::fetch_array($sql_ref);
							if($ref["WF_MAIN_SHORTNAME"] != ''){
								$arr_ref_table1[] = $ref["WF_MAIN_SHORTNAME"];
							}
							
						}elseif($field["FORM_MAIN_ID"] == '16' AND $field["WFS_FORM_SELECT"] != ''){
							if($field['WFS_FIELD_NAME'] != ''){
								$pk = 'true';
								$figure = 'Decision';
								$color = 'redgrad';
							}
							$sql_ref1 = db::query("SELECT WF_MAIN_SHORTNAME,WF_FIELD_PK FROM WF_MAIN WHERE WF_MAIN_ID='".$field["WFS_FORM_SELECT"]."'");
							$ref1 = db::fetch_array($sql_ref1);
							if($ref1["WF_MAIN_SHORTNAME"] != ''){
								$arr_ref_table1[] = $ref1["WF_MAIN_SHORTNAME"];
							}
						}else{
							if($field['WFS_FIELD_NAME'] != ''){
								$pk = 'false';
								$figure = 'Cube1';
								$color = 'bluegrad';
							}
						}
						
						
					}
					if(($field["WFS_FIELD_NAME"] != '' OR ($field['WFS_FIELD_NAME'] == $R["WF_FIELD_PK"])) AND $pk == 'true'){
						echo '{ name: "'.$field['WFS_FIELD_NAME'].'", iskey: '.$pk.', figure: "'.$figure.'", color: '.$color.' }'.$comma;
						
					}
					$i++;
				}
		?> ] },
		<?php
		$arr_ref_table = array_unique($arr_ref_table1);
		if(count($arr_ref_table) > 0){
			foreach($arr_ref_table as $val){
				
				$sql_ref_table = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_SHORTNAME = '".$val."' ");
				$ref_data = db::fetch_array($sql_ref_table);
				$REF_ARR_FIELD = db::show_field($ref_data["WF_MAIN_SHORTNAME"]);
			?>
			{ key: "<?php echo $ref_data["WF_MAIN_SHORTNAME"];?>",
			items: [
			<?php
				$num_rows_ref = count($REF_ARR_FIELD);
				$j=1;
				if($num_rows_ref > 0){
					$pk = '';
					$figure = '';
					$color = '';
					$type = '';
				foreach($REF_ARR_FIELD as $k => $v){
					$step_form_ref = select_field($ref_data["WF_MAIN_SHORTNAME"], $v);
					if($num_rows_ref == $j){
						$comma = '';
					}else{
						$comma = ',';
					}
					if($ref_data["WF_TYPE"] == 'M'){
						$type = '1';
						
					}elseif($ref_data["WF_TYPE"] == 'F'){
						$type = 'M';
					}
					
					
					if($step_form_ref['FIELD_NAME'] == $ref_data["WF_FIELD_PK"]){
						$pk = 'true';
						$figure = 'Decision';
						$color = 'yellowgrad';
						$array_relation[] = '{ from: "'.$R["WF_MAIN_SHORTNAME"].'", to: "'.$ref_data["WF_MAIN_SHORTNAME"].'", text: "1", toText: "'.$type.'" }';
						
					}else{
						if($step_form_ref['FIELD_REF_TABLE'] != ''){
							$pk = 'true';
							$figure = 'Decision';
							$color = 'redgrad';
						}else{
							$pk = 'false';
							$figure = 'Cube1';
							$color = 'bluegrad';
						}
					}
					if($step_form_ref["FIELD_COMMENT"] OR ($step_form_ref['FIELD_NAME'] == $ref_data["WF_FIELD_PK"])){
						echo '{ name: "'.$step_form_ref['FIELD_NAME'].'", iskey: '.$pk.', figure: "'.$figure.'", color: '.$color.' }'.$comma;
					}
					$j++;
				}
				}?>] },
			<?php
			}
			?>
	  <?php 	} } ?>
    ];

    var linkDataArray = [
	<?php
		echo $relation = implode(',',$array_relation);
	?>
      /*{ from: "Products", to: "Suppliers", text: "1", toText: "M" },
      { from: "Products", to: "Categories", text: "1", toText: "M" },
      { from: "Order Details", to: "Products", text: "M", toText: "1" }*/
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
<?php }} db::db_close(); ?>