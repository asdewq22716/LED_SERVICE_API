<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_GET['W']);

$sql_data = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
$query_count_rows = db::query("SELECT count(WF_MAIN_ID) AS NUM_ROWS FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
$num_r = db::fetch_array($query_count_rows);

if($num_r["NUM_ROWS"] == 1){
$R = db::fetch_array($sql_data);
$oper_arr_old = array("1"=>">","2"=>">=","3"=>"<","4"=>"<=","5"=>"!=",""=>"=");
$oper_arr = array("1"=>"มากกว่า","2"=>"มากกว่าหรือเท่ากับ","3"=>"น้อยกว่า","4"=>"น้อยกว่าหรือเท่ากับ","5"=>"ไม่เท่ากับ",""=>"เป็น");
$oper_Side = array("0"=>',"side":"Left"',"1"=>',"side":"Right"');
?><!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flowgrammer</title>
  <meta name="description" content="An editor for a flowchart-like diagram with a restricted syntax -- add nodes by dropping them onto existing nodes or links." />
  <!-- Copyright 1998-2018 by Northwoods Software Corporation. -->
  <meta charset="UTF-8">
  <style>
@font-face {
  font-family: 'saraban';
  font-style: normal;
  font-weight: normal;
  src: url(../function/THSarabunNew.eot);
  src: local('Open Sans'), local('PTSans-Regular'), url(../function/THSarabunNew.eot) format('embedded-opentype'), url(../function/THSarabunNew.woff) format('woff');
}
</style>
  <style>
    /* Use a Flexbox to make the Palette/Overview/Diagram responsive and size things relatively */ 
    #myFlexDiv {
      display: -webkit-flex;
      display: flex;
      width: 100%;
      height: 600px;
      
    }
    #myPODiv {
      display: -webkit-flex;
      display: flex;
    }

    @media (min-width: 768px) {
      #myFlexDiv {
        flex-flow: row;
      }
      #myPODiv {
        width: 105px;
        height: 100%;
        margin-right: 10px;
        flex-flow: column;
      }
      #myPaletteDiv {
        height: 75%;
      }
      #myOverviewDiv {
        margin-top: 3px;
        flex: 1;
      }
      #myDiagramDiv {
        flex: 1;
      }
    }
    @media (max-width: 767px) {
      #myFlexDiv {
        flex-flow: column;
        align-items: center;
      }
      #myPODiv {
        width: 90%;
        height: 105px;
        margin-bottom: 10px;
        flex-flow: row;
      }
      #myPaletteDiv {
        width: 75%;
      }
      #myOverviewDiv {
        margin-left: 3px;
        flex: 1;
      }
      #myDiagramDiv {
        width: 90%;
        flex: 1;
      }
    }
  </style>
  <script src="../assets/release/go.js"></script>
  <!--script src="../assets/js/goSamples.js"></script>  <!-- this is only for the GoJS Samples framework -->
  <script id="code">
    function init() {
      if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
      var $ = go.GraphObject.make;  // for conciseness in defining templates

      myDiagram =
        $(go.Diagram, "myDiagramDiv",  // create a Diagram for the DIV HTML element
          {
            initialContentAlignment: go.Spot.Top,
            // make the layout a vertical Layered Digraph- links "flow" downward
            layout:
              $(go.LayeredDigraphLayout,
                { direction: 90, layerSpacing: 6, columnSpacing: 6, setsPortSpots: false }),
            maxSelectionCount: 1,
            allowDrop: true,
            allowCopy: false,
            "textEditingTool.starting": go.TextEditingTool.SingleClick,
            "SelectionDeleting": function (e) {
              // assume maxSelectionCount === 1
              exciseNode(e.subject.first());  // defined below
            },
            "SelectionDeleted": function (e) {
              deleteDisconnectedNodes(e.diagram);  // defined below
            },
            "undoManager.isEnabled": true
          });

      // when the document is modified, add a "*" to the title and enable the "Save" button
      myDiagram.addDiagramListener("Modified", function(e) {
        var button = document.getElementById("SaveButton");
        if (button) button.disabled = !e.diagram.isModified;
        var idx = document.title.indexOf("*");
        if (e.diagram.isModified) {
          if (idx < 0) document.title += "*";
        } else {
          if (idx >= 0) document.title = document.title.substr(0, idx);
        }
      });

      // Parts dragged in from the Palette will be partly translucent
      myDiagram.findLayer("Tool").opacity = 0.5;

      // Define a gradient brush for each Node type, shared by the Diagram and Palette
      var greenBrush = $(go.Brush, "Linear", { 0: "rgb(183,239,206)", .3: "rgb(183,239,206)" });
      var redBrush = $(go.Brush, "Linear", { 0: "rgb(255,240,240)", .67: "rgb(255,0,0)" });
      var blueBrush = $(go.Brush, "Linear", { 0: "rgb(250,250,255)", .67: "rgb(90,125,200)" });
      var yellowBrush = $(go.Brush, "Linear", { 0: "rgb(255,255,240)", .67: "rgb(190,200,10)" });
      var pinkBrush = $(go.Brush, "Linear", { 0: "rgb(255,250,250)", .67: "rgb(255,180,200)" });
      var lightBrush = $(go.Brush, "Linear", { 0: "rgb(240,240,250)", .67: "rgb(150,200,250)" });

      // Define common properties and bindings for most kinds of nodes
      function nodeStyle() {
        return [new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                {
                  locationSpot: go.Spot.Center,
                  toSpot: go.Spot.Top,
                  fromSpot: go.Spot.NotTopSide,  // port properties on the node
                  portSpreading: go.Node.SpreadingNone,
                  layoutConditions: go.Part.LayoutAdded | go.Part.LayoutRemoved,
                  // If a node from the pallette is dragged over this node, its outline will turn green
                  mouseDragEnter: function(e, node) { node.isHighlighted = true; },
                  mouseDragLeave: function(e, node) { node.isHighlighted = false; },
                  // A node dropped onto this will draw a link from itself to this node
                  mouseDrop: dropOntoNode
                }];
      }

      function shapeStyle() {
        return [
          { stroke: "rgb(63,63,63)", strokeWidth: 2 },
          new go.Binding("stroke", "isHighlighted", function(h) { return h ? "chartreuse" : "rgb(63,63,63)"; }).ofObject(),
          new go.Binding("strokeWidth", "isHighlighted", function(h) { return h ? 4 : 2; }).ofObject()
        ];
      }

      // Define Node templates for various categories of nodes
      myDiagram.nodeTemplateMap.add("Start",
        // the name of the Node category
        $(go.Node, "Auto",
          {
            locationSpot: go.Spot.Center,
            deletable: false  // do not allow this node to be removed by the user
          },
          new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
          $(go.Shape, "Terminator",shapeStyle(),
            {
              fill: '#82E4AA'
            }),
          $(go.TextBlock,{
			margin: 8,
			font: "bold 16pt saraban,helvetica, bold arial, sans-serif",
			textAlign: "center",
			stroke: "black",
			width:50,
            editable: true,  // editing the text automatically updates the model data
			maxSize: new go.Size(50, NaN)
          }, "Start")
        ));

      myDiagram.nodeTemplateMap.add("End",
        $(go.Node, "Auto", nodeStyle(),  // use common properties and bindings
          { 
            deletable: false,  // do not allow this node to be removed by the user
            toSpot: go.Spot.NotBottomSide // port properties on the node
          },
          $(go.Shape, "Terminator", shapeStyle(),
            { fill: '#05B9D4'}),
          $(go.TextBlock,{
			margin: 8,
			font: "bold 16pt saraban,helvetica, bold arial, sans-serif",
			textAlign: "center",
			stroke: "black",
			width:50,
            editable: true,  // editing the text automatically updates the model data
			maxSize: new go.Size(50, NaN)
          }, "End")
        ));

      myDiagram.nodeTemplateMap.add("Action",
        $(go.Node, "Auto", nodeStyle(),
          { fromSpot: go.Spot.Bottom },  // override fromSpot of nodeStyle()
          $(go.Shape, "Rectangle" ,
            { fill: '#FFFFFF',strokeWidth: 0 }),
          $(go.TextBlock,
            {
			margin: 8,
			font: "14pt saraban,helvetica, bold arial, sans-serif",
			textAlign: "center",
			stroke: "black",
			width:180,
            editable: true,  // editing the text automatically updates the model data
			maxSize: new go.Size(180, NaN)
          },
            // user can edit node text by clicking on it
            new go.Binding("text", "text").makeTwoWay())
        ));

      myDiagram.nodeTemplateMap.add("Effect",
        $(go.Node, "Auto", nodeStyle(),
          { fromSpot: go.Spot.Bottom },  // override fromSpot of nodeStyle()
          $(go.Shape, "Rectangle", shapeStyle(),
            { fill: '#6505EA' }),
          $(go.TextBlock,
            {
			margin: 8,
			font: "15pt saraban,helvetica, bold arial, sans-serif",
			textAlign: "center",
			stroke: "white",
			width:180,
            editable: true,  // editing the text automatically updates the model data
			maxSize: new go.Size(180, NaN)
          },
            new go.Binding("text", "text").makeTwoWay())
        ));

      myDiagram.nodeTemplateMap.add("Output",
        $(go.Node, "Auto", nodeStyle(),
          $(go.Shape, "RoundedRectangle", shapeStyle(),
            { fill: '#2D65FF' ,parameter1: 5}),
          $(go.TextBlock,
            {
			margin: 8,
			font: "15pt saraban,helvetica, bold arial, sans-serif",
			textAlign: "center",
			stroke: "white",
			width:180,
            editable: true,  // editing the text automatically updates the model data
			maxSize: new go.Size(180, NaN)
          }, 
            new go.Binding("text", "text").makeTwoWay())
        ));

      myDiagram.nodeTemplateMap.add("Condition",
        $(go.Node, "Spot", nodeStyle(),
          $(go.Panel, "Auto",
            $(go.Shape, "Diamond", shapeStyle(),
              { fill: '#FF6F05' }),
            $(go.TextBlock,
              {
			margin: 5,
			font: "15pt saraban,helvetica, bold arial, sans-serif",
			textAlign: "center",
			stroke: "white",
			width:200,
            editable: true,  // editing the text automatically updates the model data
			maxSize: new go.Size(200, NaN)
          },
              new go.Binding("text", "text").makeTwoWay())
          ),
          $(go.Shape, "Circle",
            {
              portId: "Left", fromSpot: go.Spot.Left,
              alignment: go.Spot.Left, alignmentFocus: go.Spot.Left,
              stroke: null, fill: null, width: 1, height: 1
            }),
          $(go.Shape, "Circle",
            {
              portId: "Right", fromSpot: go.Spot.Right,
              alignment: go.Spot.Right, alignmentFocus: go.Spot.Right,
              stroke: null, fill: null, width: 1, height: 1
            })
        ));

      // Define the link template
      myDiagram.linkTemplate =
        $(go.Link,
          {
            routing: go.Link.AvoidsNodes,
            curve: go.Link.JumpOver,
            corner: 5,
            toShortLength: 4,
            selectable: false,
            layoutConditions: go.Part.LayoutAdded | go.Part.LayoutRemoved,
            // links cannot be selected, so they cannot be deleted
            // If a node from the Palette is dragged over this node, its outline will turn green
            mouseDragEnter: function(e, link) { link.isHighlighted = true; },
            mouseDragLeave: function(e, link) { link.isHighlighted = false; },
            // if a node from the Palette is dropped on a link, the link is replaced by links to and from the new node
            mouseDrop: dropOntoLink
          },
          $(go.Shape, shapeStyle()),
          $(go.Shape,
            { stroke: null, fill: "black" },new go.Binding("toArrow", "typel")),
          $(go.Panel,  // link label for conditionals, normally not visible
            { visible: false, name: "LABEL", segmentIndex: 1, segmentFraction: 0.5 },
            new go.Binding("visible", "", function (link) { return link.fromNode.category === "Condition" && !!link.data.text; }).ofObject(),
            new go.Binding("segmentOffset", "side", function (s) { return s === "Left" ? new go.Point(0, 14) : new go.Point(0, -14); }),
            $(go.TextBlock,
              {
                textAlign: "center",
                font: "10pt sans-serif",
                margin: 2,
                editable: true
              },
              new go.Binding("text").makeTwoWay())
          )
        );

      myDiagram.addDiagramListener("ExternalObjectsDropped", function (e) {
        var newnode = e.diagram.selection.first();
        if (newnode.linksConnected.count === 0) {
          // when the selection is dropped but not hooked up to the rest of the graph, delete it
          e.diagram.commandHandler.deleteSelection();
        }
      });


      // initialize Palette
      var myPalette =
        $(go.Palette, "myPaletteDiv",  // refers to its DIV HTML element by id
          { 
            layout: $(go.GridLayout),
            maxSelectionCount: 1 
          });

      // define simpler templates for the Palette than in the main Diagram
      myPalette.nodeTemplateMap.add("Action",
        $(go.Node, "Auto",
          $(go.Shape, "Rectangle",
            { fill: yellowBrush, strokeWidth: 2 }),
          $(go.TextBlock,
            { margin: 5 },
            new go.Binding("text"))
        ));
      myPalette.nodeTemplateMap.add("Effect",
        $(go.Node, "Auto",
          $(go.Shape, "Rectangle",
            { fill: blueBrush, strokeWidth: 2 }),
          $(go.TextBlock,
            { margin: 5 },
            new go.Binding("text"))
        ));
      myPalette.nodeTemplateMap.add("Output",
        $(go.Node, "Auto",
          $(go.Shape, "RoundedRectangle",
            { fill: pinkBrush, strokeWidth: 2 }),
          $(go.TextBlock,
            { margin: 5 },
            new go.Binding("text"))
        ));
      myPalette.nodeTemplateMap.add("Condition",
        $(go.Node, "Auto",
          $(go.Shape, "Diamond",
            { fill: lightBrush, strokeWidth: 2 }),
          $(go.TextBlock,
            { margin: 5 },
            new go.Binding("text"))
        ));

      // add node data to the palette
      myPalette.model.nodeDataArray = [
        { key: "if1",     category: "Condition", text: "if1"  },
        { key: "action1", category: "Action", text: "action1" },
        { key: "action2", category: "Action", text: "action2" },
        { key: "action3", category: "Action", text: "action3" },
        { key: "effect1", category: "Effect", text: "effect1" },
        { key: "effect2", category: "Effect", text: "effect2" },
        { key: "effect3", category: "Effect", text: "effect3" },
        { key: "output1", category: "Output", text: "output1" },
        { key: "output2", category: "Output", text: "output2" }
      ];


      // initialize Overview
      var myOverview =
        $(go.Overview, "myOverviewDiv",
          {
            observed: myDiagram,
            contentAlignment: go.Spot.Center
          });

      load();  // read model from textarea and initialize myDiagram
    }

    // Graph manipulation functions, to maintain the syntax of the diagram

    function dropOntoNode(e, obj) {
      var diagram = e.diagram;
      var oldnode = obj.part;
      if (oldnode.category === "Start") {
        diagram.currentTool.doCancel();
        return;
      }
      var newnode = diagram.selection.first();
      if (!(newnode instanceof go.Node)) return;
      if (newnode.linksConnected.count > 0) {
        exciseNode(newnode);
      }

      if (newnode.category === "Effect" || newnode.category === "Action" || newnode.category === "Condition") {
        // Take all links into oldnode and relink to newnode
        var it = new go.List().addAll(oldnode.findLinksInto()).iterator;
        while (it.next()) {
          var link = it.value;
          link.toNode = newnode;
        }
        // Then link newnode to oldnode
        if (newnode.category === "Condition") {
          diagram.model.addLinkData({ from: newnode.data.key, to: oldnode.data.key, text: "true", side: "Left" });
          diagram.model.addLinkData({ from: newnode.data.key, to: oldnode.data.key, text: "false", side: "Right" });
        } else {
          diagram.model.addLinkData({ from: newnode.data.key, to: oldnode.data.key });
        }
      } else if (newnode.category === "Output") {
        // Find the previous node and add a link from it; no links coming out of an "Output"
        var prev = oldnode.findTreeParentNode();
        if (prev !== null) {
          if (prev.category === "Condition") {
            diagram.model.addLinkData({ from: prev.data.key, to: newnode.data.key });
          } else {
            diagram.model.addLinkData({ from: prev.data.key, to: newnode.data.key });
          }
        }
      }
    }

    function dropOntoLink(e, obj) {
      var diagram = e.diagram;
      var newnode = diagram.selection.first();
      if (!(newnode instanceof go.Node)) return;
      if (newnode.linksConnected.count > 0) {
        exciseNode(newnode);
      }

      var oldlink = obj.part;
      var fromnode = oldlink.fromNode;
      var tonode = oldlink.toNode;
      if (newnode.category === "Effect" || newnode.category === "Action" || newnode.category === "Condition") {
        // Reconnect the existing link to the new node
        oldlink.toNode = newnode;
        // Then add links from the new node to the old node
        if (newnode.category === "Condition") {
          diagram.model.addLinkData({ from: newnode.data.key, to: tonode.data.key, text: "true", side: "Left" });
          diagram.model.addLinkData({ from: newnode.data.key, to: tonode.data.key, text: "false", side: "Right" });
        } else {
          diagram.model.addLinkData({ from: newnode.data.key, to: tonode.data.key });
        }
      } else if (newnode.category === "Output") {
        // Add a new link to the new node
        if (fromnode.category === "Condition") {
          diagram.model.addLinkData({ from: fromnode.data.key, to: newnode.data.key });
        } else {
          diagram.model.addLinkData({ from: fromnode.data.key, to: newnode.data.key });
        }
      }
    }

    // Draw links between the parent and children nodes of a node being deleted.
    function exciseNode(node) {
      if (node === null) return;
      var linksOut = node.findLinksOutOf();
      var to = null;
      if (linksOut.count > 1) {
        to = findMerge(node);
      } else if (linksOut.count === 1) {  // if only one link out of the node to be deleted
        to = linksOut.first().toNode;
      }
      if (to !== null) {
        // now there is only a single output node to reconnect with
        // for all links coming into the node to be deleted
        var linksIn = new go.List().addAll(node.findLinksInto()).iterator;
        while (linksIn.next()) {
          var l = linksIn.value;  // reconnect all links going into deleted node
          l.toNode = to;          // to that one destination node
        }
      } else {
        node.diagram.removeParts(node.findLinksInto(), false);
      }
    }

    // If there are multiple links going out of this node,
    // return the node where the links merge back into one node, if any.
    function findMerge(node) {
      var it = node.findLinksOutOf();
      if (it.count <= 1) return null;
      node.diagram.nodes.each(function (n) { n._tag = 0; });
      var i = 1;
      while (it.next()) {
        var n = walkDown(it.value.toNode, i);
        if (n !== null) return n;
        i++;
      }
      return null;
    }

    // Mark all downstream nodes, but return the first node found that was already marked
    function walkDown(node, tag) {
      var prev = node._tag;
      if (prev !== 0 && prev !== tag) return node;
      node._tag = tag;
      if (prev === tag) return null;
      var it = node.findNodesOutOf();
      while (it.next()) {
        var n = walkDown(it.value, tag);
        if (n !== null) return n;
      }
      return null;
    }

    // Delete a Node if there are no Links coming into it, other than the "Start" Node.
    function deleteDisconnectedNodes(diagram) {
      var nodesToDelete = diagram.nodes.filter(function (n) { return n.category !== "Start" && n.findLinksInto().count === 0; });
      if (nodesToDelete.count > 0) {
        diagram.removeParts(nodesToDelete, false);
        deleteDisconnectedNodes(diagram);
      }
    }


    // Save a model to and load a model from JSON text, displayed below the Diagram.
    function save() {
      document.getElementById("mySavedModel").value = myDiagram.model.toJson();
      myDiagram.isModified = false;
    }
    function load() {
      myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
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
		document.getElementById('SVGArea').style.display='';
	});
  }
  </script>
  <script type="text/javascript" src="../assets/js/dom-to-image.js"></script> 
</head>
<body onload="init()">
<div id="sample">
  <div id="myFlexDiv">
    <div id="myPODiv">
      <div id="myPaletteDiv" style="display:none"></div>
      <div id="myOverviewDiv" style="border: solid 1px black"></div>
    </div>
    <div id="myDiagramDiv" style="border: solid 1px black"></div>
  </div> 
  <div>
  <button onclick="makeSVG()">Convert to Picture</button>
	<div id="SVGArea" ></div>
	<img id="er_img" />
  <!--<button id="SaveButton" onclick="save()">Save</button>
  <button onclick="load()">Load</button>-->
  </div>
  <?php
	$array_txt = array();
	$array_link = array();
	$end = "";
	$array_txt[] = '{"key":"Start", "category":"Start"}';
            $sql_form = db::query("SELECT * FROM WF_DETAIL WHERE WF_MAIN_ID = '".$R["WF_MAIN_ID"]."' ORDER BY WFD_ORDER ASC ");
            while($F=db::fetch_array($sql_form)){
				$txt_k = "\"key\":\"S".$F["WFD_ID"]."\",";
				$txt_c = "\"category\":\"Output\",";
				$txt_t = "\"text\":\"".$F["WFD_NAME"]."\"";
				
				if($F["WFD_DEFAULT_STEP"] != "" AND $F["WFD_DEFAULT_STEP"] != '0'){
					$array_link[] = "{\"from\":\"S".$F["WFD_ID"]."\", \"to\":\"S".$F["WFD_DEFAULT_STEP"]."\", \"text\":\"Default\",\"typel\":\"standard\"}";
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
					$data_txt = str_replace("  "," ",strip_tags($data_txt));
				$array_txt[] = "{\"key\":\"C".$con["WFSC_ID"]."\", \"text\":\"".$data_field."".$oper_arr[$con["WF_CON_OPERATE"]]." '".$data_txt."'\" ,\"category\":\"Action\"}";	
				$array_link[] = "{\"from\":\"S".$F["WFD_ID"]."\", \"to\":\"C".$con["WFSC_ID"]."\"".$oper_Side[$x].",\"typel\":\"\"}";
				$array_link[] = "{\"from\":\"C".$con["WFSC_ID"]."\", \"to\":\"S".$con["WFSC_STEP"]."\",\"typel\":\"standard\"}";
				$txt_c = "\"category\":\"Condition\",";
				$x++;
				}
				if($F["WFD_TYPE"] == "T"){
					$txt_c = "\"category\":\"Effect\",";
				}
				if($F["WFD_TYPE"] == "E"){
					if($end==""){
					$array_txt[] = '{"key":"End", "category":"End", "text":"End"}';
					$end = "Y";
					}
					$array_link[] = "{\"from\":\"S".$F["WFD_ID"]."\", \"to\":\"End\",\"typel\":\"standard\" }";
				}
				if($F["WFD_TYPE"] == "S" ){
					$array_link[] = '{"from":"Start", "to":"S'.$F["WFD_ID"].'","typel":"standard"}';
				}			
				$array_txt[] = "{".$txt_k.$txt_c.$txt_t."}";		
			}
?>
  <textarea id="mySavedModel" style="display:none">
{ "class": "go.GraphLinksModel",
  "linkFromPortIdProperty": "side",
  "nodeDataArray": [<?php echo implode(",",$array_txt); ?>],
  "linkDataArray": [<?php echo implode(",",$array_link); ?>]}
  </textarea>
  
</div>
</body>
</html>
<?php } db::db_close(); ?>