<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';

$W = conText($_GET['W']);

$sql_data = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
$query_count_rows = db::query("SELECT count(WF_MAIN_ID) AS NUM_ROWS FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
$num_r = db::fetch_array($query_count_rows);

if($num_r["NUM_ROWS"] == 1){
$R = db::fetch_array($sql_data);
$oper_arr = array("1"=>">","2"=>">=","3"=>"<","4"=>"<=","5"=>"!=",""=>"=");
?><!DOCTYPE html>
<html>
<head>
<title>Flow Chart</title>
<meta charset="UTF-8">
<script src="../assets/js/go.js"></script>
<!-- <link href="js/assets/css/goSamples.css" rel="stylesheet" type="text/css" />  you don't need to use this -->
 
  <script id="code">
    function init() {
      if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
      var $ = go.GraphObject.make;  // for conciseness in defining templates
      myDiagram =
        $(go.Diagram, "myDiagramDiv",
          {
            allowCopy: false,
            initialContentAlignment: go.Spot.Center,
            "draggingTool.dragsTree": true,
            "commandHandler.deletesTree": true,
            layout:
              $(go.TreeLayout,
                { angle: 90, arrangement: go.TreeLayout.ArrangementFixedRoots }),
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

      var bluegrad = $(go.Brush, "Linear", { 0: "white", 1: "skyblue" });
      var greengrad = $(go.Brush, "Linear", { 0: "white", 1: "green" });
      var redgrad = $(go.Brush, "Linear", { 0: "white", 1: "red" });
      var yellowgrad = $(go.Brush, "Linear", { 0: "yellow", 1: "orange" });

      // each action is represented by a shape and some text
      var actionTemplate =
        $(go.Panel, "Horizontal",
          $(go.Shape,
            { width: 12, height: 12 },
            new go.Binding("figure"),
            new go.Binding("fill")),
          $(go.TextBlock,
            new go.Binding("text"))
        );

      // each regular Node has body consisting of a title followed by a collapsible list of actions,
      // controlled by a PanelExpanderButton, with a TreeExpanderButton underneath the body
      myDiagram.nodeTemplate =  // the default node template
        $(go.Node, "Vertical",
          { selectionObjectName: "BODY" },
          // the main "BODY" consists of a RoundedRectangle surrounding nested Panels
          $(go.Panel, "Auto",
            { name: "BODY" },
            $(go.Shape, "RoundedRectangle",
              { fill: bluegrad },
              new go.Binding("fill"),
              new go.Binding("stroke")),
            $(go.Panel, "Vertical",
              // the title
              $(go.TextBlock, { font: "bold 10pt Arial" },
                new go.Binding("text", "question")),
              // the optional list of actions
              $(go.Panel, "Table",
                { stretch: go.GraphObject.Horizontal,
                  visible: false },  // not visible unless there is more than one action
                new go.Binding("visible", "actions", function(acts) {
                     return (Array.isArray(acts) && acts.length > 0);
                   }),
                // headered by a label and a PanelExpanderButton
                $(go.TextBlock, "Steps", { row: 0, alignment: go.Spot.Left }),
                $("PanelExpanderButton", "COLLAPSIBLE",  // name of the object to make visible or invisible
                  { row: 0, alignment: go.Spot.Right }),
                // with the list data bound in the Vertical Panel
                $(go.Panel, "Vertical",
                  {
                    row: 1, name: "COLLAPSIBLE",  // identify to the PanelExpanderButton
                    padding: 2,
                    stretch: go.GraphObject.Horizontal,  // take up whole available width
                    background: "white",  // to distinguish from the node's body
                    defaultAlignment: go.Spot.Left,  // thus no need to specify alignment on each element
                    itemTemplate: actionTemplate  // the Panel created for each item in Panel.itemArray
                  },
                  new go.Binding("itemArray", "actions")  // bind Panel.itemArray to nodedata.actions
                )  // end inner Vertical Panel
              )  // end Table Panel
            )  // end outer Vertical Panel
          ),  // end "BODY", an Auto Panel
          $(go.Panel,  // this is underneath the "BODY"
            { height: 15 },  // always this height, even if the TreeExpanderButton is not visible
            $("TreeExpanderButton"))
        );

      // define a second kind of Node:
      myDiagram.nodeTemplateMap.add("Terminal",
        $(go.Node, "Spot",
          $(go.Shape, "StopSign",
            { width: 1, height: 1 },
            new go.Binding("fill"),
            new go.Binding("stroke")),
          $(go.TextBlock,
            new go.Binding("text")))
        );

      myDiagram.linkTemplate =
        $(go.Link, go.Link.Orthogonal,
          { corner: 10 },
          $(go.Shape,
            { strokeWidth: 2 }),
          $(go.Shape,
            { toArrow: "Standard" }),
          $(go.TextBlock, go.Link.OrientUpright,
            { background: "white",
              visible: false,  // unless the binding sets it to true for a non-empty string
              segmentIndex: -2,
              segmentOrientation: go.Link.None },
            new go.Binding("text", "answer"),
            // hide empty string;
            // if the "answer" property is undefined, visible is false due to above default setting
            new go.Binding("visible", "answer", function(a) { return (a ? true : false); }))
        );

      load();
    }

    function save() {
      document.getElementById("mySavedModel").value = myDiagram.model.toJson();
      myDiagram.isModified = false;
    }
    function load() {
      myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
    }
	
	function gen_graph(){
		var svg = document.getElementById('myDiagramDiv').children[0].innerHTML;
			canvg(document.getElementById('canvas'),svg);
			var img = canvas.toDataURL("image/png");
			alert(img);
			img = img.replace('data:image/png;base64,', '');
		
		$.ajax({
			url: 'gen_graph.php',
			type: 'POST',
			dataType: 'html',
			data: {proc:'gen_graph',img_content:img,w:<?php echo $W;?> },
			success: function(data) {
				var img = "<img src=\"<?php echo $WF_URL;?>doc_image/tmp_img_flowchart/"+data+"\">";
				$('#show_diagram').html(img);
			}
		});
	}
  </script>
</head>
<body onload="init()" >
<?php
	$array_txt = array();
	$array_link = array();
            $sql_form = db::query("SELECT * FROM WF_DETAIL WHERE WF_MAIN_ID = '".$R["WF_MAIN_ID"]."' ORDER BY WFD_ORDER ASC ");
            while($F=db::fetch_array($sql_form)){
				$txt_k = "\"key\":\"S".$F["WFD_ID"]."\",";
				$txt_c = "\"fill\":\"white\",";
				$txt_t = "\"question\":\"".$F["WFD_NAME"]."\"";
				
				if($F["WFD_DEFAULT_STEP"] != "" AND $F["WFD_DEFAULT_STEP"] != '0'){
					$array_link[] = "{\"from\":\"S".$F["WFD_ID"]."\", \"to\":\"S".$F["WFD_DEFAULT_STEP"]."\", \"answer\":\"Default\"}";
				}
				$sql_con = db::query("SELECT * FROM WF_STEP_CON WHERE WFD_ID = '".$F["WFD_ID"]."'");
				while($con = db::fetch_array($sql_con)){
				$array_txt[] = "{\"key\":\"C".$con["WFSC_ID"]."\", \"question\":\"".$con["WFSC_VAR"]." ".$oper_arr[$con["WF_CON_OPERATE"]]." '".$con["WFSC_VALUE"]."'\" ,\"fill\":\"orange\"}";	
				$array_link[] = "{\"from\":\"S".$F["WFD_ID"]."\", \"to\":\"C".$con["WFSC_ID"]."\"}";
				$array_link[] = "{\"from\":\"C".$con["WFSC_ID"]."\", \"to\":\"S".$con["WFSC_STEP"]."\"}";
				$txt_c = "\"fill\":\"pink\",";
				}
				if($F["WFD_TYPE"] == "T" OR $F["WFD_TYPE"] == "E"){
					$txt_c = "\"fill\":\"yellow\",";
				}
				if($F["WFD_TYPE"] == "S" ){
					$txt_c = "\"fill\":\"skyblue\",";
				}			
				$array_txt[] = "{".$txt_k.$txt_c.$txt_t."}";		
			}
?>
  
  <textarea id="mySavedModel" style="display:none">
{ "nodeDataArray": [<?php echo implode(",",$array_txt); ?>],
  "linkDataArray": [<?php echo implode(",",$array_link); ?>]}
  </textarea>
  
	<form method="post" id="support_frm" name="support_frm" action="gen_graph.php">
		<input type="hidden" name="img_content" id="img_content" />
	</form>	
	<button type="submit" name="conv_pic" id="conv_pic"  class="btn btn-info" onclick="gen_graph()"><i class="icofont icofont-search-alt-2"></i> Convert To Picture</button>
	<div id="show_diagram"></div>
	<div id="myDiagramDiv" style="border: solid 1px black; background: white; width: 100%; height: 600px"></div>
	<canvas id="canvas" width="500px;" height="500px;" style="display:none;" ></canvas>
</body>

<?php } db::db_close(); ?>