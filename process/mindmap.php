<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MindMap</title>
<!-- Copyright 1998-2018 by Northwoods Software Corporation. -->
<meta charset="UTF-8">
<script src="../assets/gojs/release/go.js"></script> 
<script src="../assets/gojs/extensions/GuidedDraggingTool.js"></script> 
<style>
@font-face {
  font-family: 'saraban';
  font-style: normal;
  font-weight: normal;
  src: url(../function/THSarabunNew.eot);
  src: local('Open Sans'), local('PTSans-Regular'), url(../function/THSarabunNew.eot) format('embedded-opentype'), url(../function/THSarabunNew.woff) format('woff');
}
</style>
<script id="code">
function init() {
    if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var $ = go.GraphObject.make;  // for conciseness in defining templates

    myDiagram =
      $(go.Diagram, "myDiagramDiv",  // must name or refer to the DIV HTML element
        {
          initialContentAlignment: go.Spot.Center,
          allowDrop: true,  // must be true to accept drops from the Palette
          "LinkDrawn": showLinkLabel,  // this DiagramEvent listener is defined below
          "LinkRelinked": showLinkLabel,
          scrollsPageOnFocus: false,
		  "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom, 
                    draggingTool: new GuidedDraggingTool(),  // defined in GuidedDraggingTool.js
                    "draggingTool.horizontalGuidelineColor": "blue",
                    "draggingTool.verticalGuidelineColor": "blue",
                    "draggingTool.centerGuidelineColor": "green",
                    "draggingTool.guidelineWidth": 1,
          "undoManager.isEnabled": true  // enable undo & redo
        });

    // when the document is modified, add a "*" to the title and enable the "Save" button
    myDiagram.addDiagramListener("Modified", function(e) {
      var button = document.getElementById("SaveButton");
      if (button) button.disabled = !myDiagram.isModified;
      var idx = document.title.indexOf("*");
      if (myDiagram.isModified) {
        if (idx < 0) document.title += "*";
      } else {
        if (idx >= 0) document.title = document.title.substr(0, idx);
      }
    });
	 
	 var defaultAdornment =
      $(go.Adornment, "Spot",
        $(go.Panel, "Auto",
          $(go.Shape, { fill: null, stroke: "dodgerblue", strokeWidth: 4 }),
          $(go.Placeholder)),
        // the button to create a "next" node, at the top-right corner
        $("Button",
          { alignment: go.Spot.TopRight,
			click: function (e, obj) {  // OBJ is the Button
                var node = obj.part;  // get the Node containing this Button
                if (node === null) return;
                e.handled = true;
                expandNode(node);
              }
		  },  // this function is defined below
          new go.Binding("visible", "", function(a) { return !a.diagram.isReadOnly; }).ofObject(),
          $(go.Shape, "Chevron", { desiredSize: new go.Size(6, 6) })
        )
      );
    // helper definitions for node templates
	var nodeResizeAdornmentTemplate =
      $(go.Adornment, "Spot",
        { locationSpot: go.Spot.Right },
        $(go.Placeholder),
        $(go.Shape, { alignment: go.Spot.TopLeft, cursor: "nw-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
        $(go.Shape, { alignment: go.Spot.Top, cursor: "n-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
      /*  $(go.Shape, { alignment: go.Spot.TopRight, cursor: "ne-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
*/
        $(go.Shape, { alignment: go.Spot.Left, cursor: "w-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
        $(go.Shape, { alignment: go.Spot.Right, cursor: "e-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),

        $(go.Shape, { alignment: go.Spot.BottomLeft, cursor: "se-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
        $(go.Shape, { alignment: go.Spot.Bottom, cursor: "s-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
        $(go.Shape, { alignment: go.Spot.BottomRight, cursor: "sw-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" })
      );
	function expandNode(node) {
		var diagram = node.diagram; 
		var data = node.data;
		//alert(data.loc);
	}
    function nodeStyle() {
      return [
        // The Node.location comes from the "loc" property of the node data,
        // converted by the Point.parse static method.
        // If the Node.location is changed, it updates the "loc" property of the node data,
        // converting back using the Point.stringify static method.
        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
        {
          // the Node.location is at the center of each node
          locationSpot: go.Spot.Center
        }
      ];
    }

    // Define a function for creating a "port" that is normally transparent.
    // The "name" is used as the GraphObject.portId,
    // the "align" is used to determine where to position the port relative to the body of the node,
    // the "spot" is used to control how links connect with the port and whether the port
    // stretches along the side of the node,
    // and the boolean "output" and "input" arguments control whether the user can draw links from or to the port.
    function makePort(name, align, spot, output, input) {
      var horizontal = align.equals(go.Spot.Top) || align.equals(go.Spot.Bottom);
      // the port is basically just a transparent rectangle that stretches along the side of the node,
      // and becomes colored when the mouse passes over it
      return $(go.Shape,
        {
          fill: "transparent",  // changed to a color in the mouseEnter event handler
          strokeWidth: 0,  // no stroke
          width: horizontal ? NaN : 8,  // if not stretching horizontally, just 8 wide
          height: !horizontal ? NaN : 8,  // if not stretching vertically, just 8 tall
          alignment: align,  // align the port on the main Shape
          stretch: (horizontal ? go.GraphObject.Horizontal : go.GraphObject.Vertical),
          portId: name,  // declare this object to be a "port"
          fromSpot: spot,  // declare where links may connect at this port
          fromLinkable: output,  // declare whether the user may draw links from here
          toSpot: spot,  // declare where links may connect at this port
          toLinkable: input,  // declare whether the user may draw links to here
          cursor: "pointer",  // show a different cursor to indicate potential link point
          mouseEnter: function(e, port) {  // the PORT argument will be this Shape
            if (!e.diagram.isReadOnly) port.fill = "rgba(255,0,255,0.5)";
          },
          mouseLeave: function(e, port) {
            port.fill = "transparent";
          }
        });
    }

    function textStyle() {
      return {
		textAlign: "center",
        font: "bold 13pt saraban,Helvetica, Arial, sans-serif",
        stroke: "white"
      }
    }

    // define the Node templates for regular nodes

    myDiagram.nodeTemplateMap.add("",  // the default category
      $(go.Node, "Table", nodeStyle(),
        { selectionAdornmentTemplate: defaultAdornment },
        { resizable: true, resizeObjectName: "PANEL", resizeAdornmentTemplate: nodeResizeAdornmentTemplate },
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
          { name: "PANEL" },
          new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
          $(go.Shape, "RoundedRectangle",
            { fill: "#05C0A6", strokeWidth: 0 },
            new go.Binding("figure", "figure")),
          $(go.TextBlock, textStyle(),
            {
              margin: 8,
              editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, go.Spot.TopSide, true, true),
        makePort("L", go.Spot.Left, go.Spot.LeftSide, true, true),
        makePort("R", go.Spot.Right, go.Spot.RightSide, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.BottomSide, true, true)
      ));

    myDiagram.nodeTemplateMap.add("Conditional",
      $(go.Node, "Table", nodeStyle(),
        // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
        $(go.Panel, "Auto",
          $(go.Shape, "Diamond",
            { fill: "#00A9C9", strokeWidth: 0 },
            new go.Binding("figure", "figure")),
          $(go.TextBlock, textStyle(),
            {
              margin: 8,
              maxSize: new go.Size(160, NaN),
              wrap: go.TextBlock.WrapFit,
              editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // four named ports, one on each side:
        makePort("T", go.Spot.Top, go.Spot.Top, false, true),
        makePort("L", go.Spot.Left, go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.Bottom, true, false)
      ));

    myDiagram.nodeTemplateMap.add("Start",
      $(go.Node, "Table", nodeStyle(),
        { selectionAdornmentTemplate: defaultAdornment },
		{
            locationSpot: go.Spot.Center,
            deletable: false   // do not allow this node to be removed by the user
          },
        { resizable: true, resizeObjectName: "PANEL", resizeAdornmentTemplate: nodeResizeAdornmentTemplate },
        $(go.Panel, "Auto",
          { name: "PANEL" },
          new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
          $(go.Shape, "Ellipse",
            { fill: "#79C900", strokeWidth: 0 }),
          $(go.TextBlock, "Start", textStyle(),
			{
              margin: 10,
			  wrap: go.TextBlock.WrapFit,
			  font: "bold 20pt saraban,Helvetica, Arial, sans-serif",
              editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // three named ports, one on each side except the top, all output only:
        makePort("L", go.Spot.Left, go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.Bottom, true, true),
        makePort("T", go.Spot.Top, go.Spot.Top, true, true)
      ));

    myDiagram.nodeTemplateMap.add("Module",
      $(go.Node, "Table", nodeStyle(),
        { selectionAdornmentTemplate: defaultAdornment },
        { resizable: true, resizeObjectName: "PANEL", resizeAdornmentTemplate: nodeResizeAdornmentTemplate },
        $(go.Panel, "Auto",
          { name: "PANEL" },
          new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
          $(go.Shape, "RoundedRectangle",
            {fill: "#3452FE", strokeWidth: 0 }),
          $(go.TextBlock, " ", textStyle(),
			{
              margin: 8, 
			  font: "bold 15pt saraban,Helvetica, Arial, sans-serif",
              editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("L", go.Spot.Left, go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.Bottom, true, true),
        makePort("T", go.Spot.Top, go.Spot.Top, true, true)
      ));
	  
	 myDiagram.nodeTemplateMap.add("Document",
      $(go.Node, "Table", nodeStyle(),
        { selectionAdornmentTemplate: defaultAdornment },
        { resizable: true, resizeObjectName: "PANEL", resizeAdornmentTemplate: nodeResizeAdornmentTemplate },
        $(go.Panel, "Auto",
          { name: "PANEL" },
          new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
          $(go.Shape, "MultiDocument",
            {fill: "#C61565", strokeWidth: 0 }),
          $(go.TextBlock, " ", textStyle(),
			{
              margin: 7,
              editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("L", go.Spot.Left, go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.Bottom, true, true),
        makePort("T", go.Spot.Top, go.Spot.Top, true, true)
      ));
	myDiagram.nodeTemplateMap.add("Service",
      $(go.Node, "Table", nodeStyle(),
        { selectionAdornmentTemplate: defaultAdornment },
        { resizable: true, resizeObjectName: "PANEL", resizeAdornmentTemplate: nodeResizeAdornmentTemplate },
        $(go.Panel, "Auto",
          { name: "PANEL" },
          new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
          $(go.Shape, "Database",
            {fill: "#F0A693", strokeWidth: 0 }),
          $(go.TextBlock, " ", textStyle(),
			{
              margin: 8,
			  stroke: "black",
              maxSize: new go.Size(90, NaN), 
              editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("L", go.Spot.Left, go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.Bottom, true, true),
        makePort("T", go.Spot.Top, go.Spot.Top, true, true)
      ));
    myDiagram.nodeTemplateMap.add("Comment",
      $(go.Node, "Table", nodeStyle(),
        { selectionAdornmentTemplate: defaultAdornment },
        { resizable: true, resizeObjectName: "PANEL", resizeAdornmentTemplate: nodeResizeAdornmentTemplate },
        $(go.Panel, "Auto",
          { name: "PANEL" },
          new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
          $(go.Shape, "File",
            {fill: "#FFD582", strokeWidth: 0 }),
          $(go.TextBlock, " ", textStyle(),
			{
              margin: 10,
			  textAlign: "left",
			  stroke: "black",
              editable: true
            },
            new go.Binding("text").makeTwoWay())
        ),
        // three named ports, one on each side except the bottom, all input only:
        makePort("L", go.Spot.Left, go.Spot.Left, true, true),
        makePort("R", go.Spot.Right, go.Spot.Right, true, true),
        makePort("B", go.Spot.Bottom, go.Spot.Bottom, true, true),
        makePort("T", go.Spot.Top, go.Spot.Top, true, true)
      ));
/*	myDiagram.linkTemplate =
          $(go.Link,
		  { relinkableFrom: true, relinkableTo: true },
          $(go.Shape, { stroke: "gray", strokeWidth: 2 }),
		  $(go.Shape,  // the arrowhead
          { toArrow: "standard", stroke: null})
        );
*/
    // replace the default Link template in the linkTemplateMap
 /**/       // replace the default Link template in the linkTemplateMap
 function editText(e, button) { 
      var node = button.part.adornedPart;
      e.diagram.commandHandler.editTextBlock(node.findObject("TEXTBLOCK"));
    }
    myDiagram.linkTemplate =
      $(go.Link,  // the whole link panel
        { selectionAdorned: true,
          layerName: "Foreground",
          reshapable: true,
          routing: go.Link.AvoidsNodes,
          corner: 5,
          curve: go.Link.JumpOver, 
			doubleClick: function (e, obj) {  // OBJ is the Button
                var node = obj.part;  // get the Node containing this Button
                if (node === null) return;
                e.handled = true;
                e.diagram.commandHandler.editTextBlock(node.findObject("TEXTBLOCK"));
              } },
        { relinkableFrom: true, relinkableTo: true },
          $(go.TextBlock," ",  // the label
            {
              textAlign: "center",
			  margin: 5,
			  segmentIndex: -1,
			  segmentOffset: new go.Point(NaN, NaN),
              segmentOrientation: go.Link.OrientUpright,
              font: "12pt saraban, arial, sans-serif",
              stroke: "#333333",
              editable: true
            },
            new go.Binding("text", "text").makeTwoWay()),
        new go.Binding("points").makeTwoWay(),
        $(go.Shape,  // the highlight shape, normally transparent
          { isPanelMain: true, strokeWidth: 8, stroke: "transparent", name: "HIGHLIGHT" }), 
        $(go.Shape,  // the link path shape 
          { isPanelMain: true, stroke: "gray", strokeWidth: 2 }),
        $(go.Shape,  // the arrowhead
          { toArrow: "standard", strokeWidth: 0, fill: "gray"}),
        $(go.Panel, "Auto",  // the link label, normally not visible
          { visible: false, name: "LABEL", segmentIndex: 2, segmentFraction: 0.5},
          new go.Binding("visible", "visible").makeTwoWay(),
          $(go.Shape, "RoundedRectangle",  // the label shape
            { fill: "#F8F8F8", strokeWidth: 0 }),
          $(go.TextBlock, "Yes",  // the label
            {
              textAlign: "center",
              font: "11pt helvetica, arial, sans-serif",
              stroke: "#333333",
              editable: true
            },
            new go.Binding("text", "text").makeTwoWay())
        )
      );
/**/
    // Make link labels visible if coming out of a "conditional" node.
    // This listener is called by the "LinkDrawn" and "LinkRelinked" DiagramEvents.
    function showLinkLabel(e) {
      var label = e.subject.findObject("LABEL");
      if (label !== null) label.visible = (e.subject.fromNode.data.figure === "Diamond");
    }

    // temporary links used by LinkingTool and RelinkingTool are also orthogonal:
    myDiagram.toolManager.linkingTool.temporaryLink.routing = go.Link.Orthogonal;
    myDiagram.toolManager.relinkingTool.temporaryLink.routing = go.Link.Orthogonal;

    load();  // load an initial diagram from some JSON text

    // initialize the Palette that is on the left side of the page
    myPalette =
      $(go.Palette, "myPaletteDiv",  // must name or refer to the DIV HTML element
        { 
          scrollsPageOnFocus: false,
          nodeTemplateMap: myDiagram.nodeTemplateMap,  // share the templates used by myDiagram
          model: new go.GraphLinksModel([  // specify the contents of the Palette
            { category: "Module", text: "Module" },
            { text: "Sub-Module" },
			{ category: "Document", text: "Document" },
            { category: "Service", text: "Plug in" },
            { category: "Comment", text: "หมายเหตุ" }
          ])
        });
  } // end init
	

  // Show the diagram's model in JSON format that the user may edit
  function save() {
    document.getElementById("mySavedModel").value = myDiagram.model.toJson();
    myDiagram.isModified = false;
	document.getElementById('save_m').submit();
  }
  function load() {
    myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
  }

  // print the diagram by opening a new window holding SVG images of the diagram contents for each page
  function printDiagram() {
    var svgWindow = window.open();
    if (!svgWindow) return;  // failure to open a new Window
    var printSize = new go.Size(700, 800);
    var bnds = myDiagram.documentBounds;
    var x = bnds.x;
    var y = bnds.y;
    while (y < bnds.bottom) {
      while (x < bnds.right) {
        var svg = myDiagram.makeSVG({ scale: 1.0, position: new go.Point(x, y), size: printSize });
        svgWindow.document.body.appendChild(svg);
        x += printSize.width;
      }
      x = bnds.x;
      y += printSize.height;
    }
    setTimeout(function() { svgWindow.print(); }, 1);
  }
</script>
</head>
<body onload="init()"><?php
if(file_exists('../function/mindmap.tmp')){
	$filename = "../function/mindmap.tmp";
	$handle = fopen($filename, "r");
	$daefault_m = fread($handle, filesize($filename));
	fclose($handle);
}else{
$daefault_m = '{ "class": "go.GraphLinksModel",
  "linkFromPortIdProperty": "fromPort",
  "linkToPortIdProperty": "toPort",
  "nodeDataArray": [ 
{"key":1, "category":"Start", "loc":"0 0", "text":"'.$template['title'].'"} ],
  "linkDataArray": []}';
}
 ?>
<div id="sample">
  <div style="width: 100%; display: flex; justify-content: space-between">
    <div id="myPaletteDiv" style="width: 100px;margin-right: 2px; background-color: whitesmoke; border: solid 1px black"></div>
    <div id="myDiagramDiv" style="flex-grow: 1; height: 600px; border: solid 1px black"></div>
	<div id="myPaletteDiv2" style="width: 200px;margin-right: 2px; background-color: whitesmoke; border: solid 1px black"></div>
  </div>
  <button id="SaveButton" onclick="save()">Save</button>
  <button onclick="load()">Reset</button>
  <button onclick="printDiagram()">Print</button>
  <form id="save_m" action="mindmap_function.php" target="mm" method="post">
  <textarea id="mySavedModel" name="M_DATA" style="width:100%;height:300px;display:none"><?php echo $daefault_m; ?>
  </textarea>
  <input type="hidden" name="Flag" value="Save">
  </form>
  <iframe id="mm" name="mm" style="width:1px;height:1px;display:none"></iframe>
</div>
</body>
</html>
<?php db::db_close(); ?>