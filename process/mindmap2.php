<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MineMap</title>
<!-- Copyright 1998-2018 by Northwoods Software Corporation. -->
<meta charset="UTF-8">
<script src="../assets/gojs/release/go.js"></script> 
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
          // start everything in the middle of the viewport
          initialContentAlignment: go.Spot.Center,
          // have mouse wheel events zoom in and out instead of scroll up and down
          "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom,
          // support double-click in background creating a new node
          "clickCreatingTool.archetypeNodeData": { text: "new node","color":"#3452FE" },
          // enable undo & redo
          "undoManager.isEnabled": true
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

    // define the Node template
    myDiagram.nodeTemplate =
      $(go.Node, "Auto",
        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
        // define the node's outer shape, which will surround the TextBlock
        $(go.Shape, "RoundedRectangle",
          {
            parameter1: 50,  // the corner has a large radius
            stroke: '',
            portId: "",  // this Shape is the Node's port, not the whole Node
            fromLinkable: true, fromLinkableSelfNode: true, fromLinkableDuplicates: true,
            toLinkable: true, toLinkableSelfNode: true, toLinkableDuplicates: true,
            cursor: "pointer"
          },
          // Shape.fill is bound to Node.data.color
          new go.Binding("fill", "color")),
        $(go.TextBlock,
          {
			textAlign: "center",
            font: "bold 20pt saraban,helvetica, bold arial, sans-serif",
			stroke: "white",
			width:200,
            editable: true,  // editing the text automatically updates the model data
			maxSize: new go.Size(200, NaN)
          },
          new go.Binding("text").makeTwoWay())
      );
 
    // unlike the normal selection Adornment, this one includes a Button
    myDiagram.nodeTemplate.selectionAdornmentTemplate =
      $(go.Adornment, "Spot",
        $(go.Panel, "Auto",
          $(go.Shape, { fill: null, stroke: "blue", strokeWidth: 2 }),
          $(go.Placeholder)  // a Placeholder sizes itself to the selected Node
        ),
        // the button to create a "next" node, at the top-right corner
        $("Button",
          {
            alignment: go.Spot.TopRight,
            click: addNodeAndLink  // this function is defined below
          },
          $(go.Shape, "PlusLine", { width: 6, height: 6 }),
		  
        ),
        // the button to create a "next" node, at the top-right corner
        $("Button",
          {
            alignment: go.Spot.BottomRight,
            click: addNodeAndLink  // this function is defined below
          },
          $(go.Shape, "Pointer", { width: 6, height: 6 }),
		  
        ) // end button
      ); // end Adornment

    // clicking the button inserts a new node to the right of the selected node,
    // and adds a link to that new node
    function addNodeAndLink(e, obj) {
      var adornment = obj.part;
      var diagram = e.diagram;
      diagram.startTransaction("Add State");

      // get the node data for which the user clicked the button
      var fromNode = adornment.adornedPart;
      var fromData = fromNode.data;
      // create a new "State" data object, positioned off to the right of the adorned Node
      var toData = { text: "new","color":"#3452FE" };
      var p = fromNode.location.copy();
      p.x += 350;
      toData.loc = go.Point.stringify(p);  // the "loc" property is a string, not a Point object
      // add the new node data to the model
      var model = diagram.model;
      model.addNodeData(toData);

      // create a link data from the old node data to the new node data
      var linkdata = {
        from: model.getKeyForNodeData(fromData),  // or just: fromData.id
        to: model.getKeyForNodeData(toData) 
      };
      // and add the link data to the model
      model.addLinkData(linkdata);

      // select the new Node
      var newnode = diagram.findNodeForData(toData);
      diagram.select(newnode);

      diagram.commitTransaction("Add State");

      // if the new node is off-screen, scroll the diagram to show the new node
      diagram.scrollToRect(newnode.actualBounds);
    }

    // replace the default Link template in the linkTemplateMap
    myDiagram.linkTemplate =
      $(go.Link,  // the whole link panel
        {
          curve: go.Link.Bezier, adjusting: go.Link.Stretch,corner: 5,
          reshapable: true, relinkableFrom: true, relinkableTo: true,
          toShortLength: 3
        },
        new go.Binding("points").makeTwoWay(),
        new go.Binding("curviness"),
        $(go.Shape,  // the link shape
          { strokeWidth: 2 }),
        $(go.Shape,  // the arrowhead
          { toArrow: "standard", stroke: null }) 
      );

    // read in the JSON data from the "mySavedModel" element
    load();
  }

  // Show the diagram's model in JSON format
  function save() {
    document.getElementById("mySavedModel").value = myDiagram.model.toJson();
  }
  function load() {
    myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
  }
</script>
</head>
<body onload="init()">
<div id="sample">
  <div id="myDiagramDiv" style=" border: solid 1px black; width: 100%; height: 600px"></div>
  <button id="SaveButton" onclick="save()">Save</button>
  <button onclick="load()">Load</button>
  Diagram Model saved in JSON format:
  <br />
  <textarea id="mySavedModel" style="width:100%;height:300px">
{ "nodeKeyProperty": "id",
  "nodeDataArray": [
    { "id": 0, "loc": "0 0", "text": "ระบบสารสนเทศงานงบประมาณ พัสดุ การเงิน และบุคลากร","color":"#DD3005" },
	 { "id": 1, "loc": "220 220", "text": "ระบบ \nBizSmartFlow4.1","color":"#3452FE" }
  ],
  "linkDataArray": [
  ]
}
  </textarea>
</div>
</body>
</html>