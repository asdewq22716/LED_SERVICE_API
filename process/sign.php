<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
 
?><!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Freehand Drawing Tool</title>
  <!-- Copyright 1998-2018 by Northwoods Software Corporation. -->
  <meta charset="UTF-8">
  <script src="../assets/js/goSamples.js"></script><!-- this is only for the GoJS Samples framework -->
</head>
<body>
  <div id="sample">
    <div id="myDiagramDiv" style="border: solid 1px black; width: 100%; height: 600px"></div>
    <div id="buttons">
      <button id="select">Select</button>
      <button id="drawMode">Draw Mode</button>
      <button id="save">Save</button>
      <button id="load">Load</button>
      <label><input type="checkbox" id = "allowResizing" checked="checked" />Allow Resizing</label>
      <label><input type="checkbox" id = "allowReshaping" checked="checked" />Allow Reshaping</label>
      <label><input type="checkbox" id = "allowRotating" checked="checked" />Allow Rotating</label>
    </div>
    <p>
      This sample demonstrates the FreehandDrawingTool. It is defined in its own file, as <a href="FreehandDrawingTool.ts">FreehandDrawingTool.ts</a>.
      It also demonstrates the GeometryReshapingTool, another custom tool, defined in <a href="GeometryReshapingTool.ts">GeometryReshapingTool.ts</a>.
    </p>
    <p>
      Press and drag to draw a line.
    </p>
    <p>
      Click the "Select" button to switch back to the normal selection behavior, so that you can select, resize, and rotate the
      shapes. The checkboxes control whether you can resize, reshape, and/or rotate selected shapes.
    </p>
    <textarea id="mySavedDiagram" style="width:100%;height:300px">
{ "position": "0 0",
  "model": { "class": "go.GraphLinksModel",
  "nodeDataArray": [ {"loc":"301 143", "category":"FreehandDrawing", "geo":"M0 70 L1 70 L2 70 L3 70 L5 70 L7 70 L8 70 L11 70 L13 70 L18 69 L21 69 L25 68 L29 67 L34 67 L38 67 L42 67 L47 66 L50 66 L53 66 L55 66 L57 66 L60 66 L63 66 L64 66 L66 66 L68 66 L70 66 L72 66 L74 66 L76 66 L78 65 L81 65 L83 65 L85 65 L88 65 L90 65 L92 65 L95 65 L98 65 L100 65 L102 65 L104 65 L106 65 L109 65 L110 65 L111 65 L112 65 L113 65 L114 65 L115 65 L116 65 L118 65 L119 65 L120 65 L121 65 L122 65 L123 65 L124 65 L125 65 L126 65 L127 65 L128 65 L129 65 L131 65 L131 64 L132 64 L133 64 L134 64 L135 64 L137 64 L138 64 L139 64 L140 64 L141 64 L140 64 L139 64 L138 64 L137 64 L135 65 L134 65 L132 66 L130 67 L129 67 L126 68 L123 70 L121 71 L119 72 L116 73 L114 74 L111 76 L109 77 L106 78 L104 79 L99 81 L96 84 L94 84 L90 87 L89 87 L87 88 L86 89 L84 89 L83 90 L81 91 L80 92 L79 92 L77 93 L76 94 L74 94 L74 95 L73 96 L71 96 L70 97 L68 98 L67 98 L66 99 L64 99 L64 100 L62 100 L61 101 L60 102 L59 102 L58 103 L57 103 L57 104 L56 104 L56 105 L54 105 L54 107 L53 107 L52 108 L51 108 L51 109 L49 110 L48 111 L47 112 L47 113 L46 113 L45 114 L44 114 L44 115 L44 116 L43 116 L43 117 L42 117 L42 119 L41 119 L41 120 L40 120 L40 121 L39 122 L39 123 L38 124 L37 125 L36 126 L36 127 L35 128 L34 128 L34 129 L33 130 L33 131 L32 131 L32 130 L32 129 L33 128 L34 125 L35 122 L37 119 L39 115 L41 111 L41 106 L43 103 L45 98 L47 93 L48 90 L49 86 L51 83 L52 81 L54 78 L55 74 L55 71 L56 68 L57 65 L58 62 L58 59 L58 55 L58 53 L58 51 L58 49 L58 48 L59 45 L60 44 L60 42 L61 40 L61 38 L62 36 L64 32 L64 30 L65 29 L66 27 L66 26 L66 25 L66 24 L67 23 L67 22 L67 21 L67 20 L67 19 L68 19 L68 18 L68 17 L69 16 L69 15 L69 14 L69 12 L69 11 L69 10 L70 9 L70 8 L70 7 L70 6 L71 5 L71 4 L71 3 L71 2 L71 1 L71 0 L71 1 L71 2 L71 5 L71 6 L71 8 L71 9 L71 12 L71 14 L72 16 L72 18 L73 20 L73 23 L74 25 L74 27 L75 29 L76 32 L77 34 L78 35 L79 38 L79 39 L81 42 L81 43 L82 45 L83 46 L83 47 L83 49 L85 50 L86 52 L86 55 L86 58 L88 60 L89 62 L89 64 L90 66 L91 67 L91 69 L92 70 L92 71 L93 72 L94 73 L94 74 L94 75 L95 76 L96 77 L96 79 L97 81 L98 82 L98 83 L98 84 L99 85 L99 86 L100 87 L100 90 L101 91 L102 92 L102 93 L103 95 L103 96 L103 97 L104 98 L104 100 L104 101 L105 102 L106 103 L106 104 L107 106 L108 108 L109 110 L110 111 L111 113 L112 114 L113 115 L113 117 L115 119 L116 121 L116 123 L118 124 L119 126 L120 127 L121 129 L121 130 L122 131 L123 131 L123 132 L124 132 L124 133 L125 134 L125 135 L126 135 L127 136 L128 137 L129 138 L130 139 L131 140 L130 139 L129 138 L128 138 L126 136 L124 136 L123 134 L121 133 L118 131 L116 130 L114 128 L111 127 L107 123 L105 122 L102 120 L100 119 L98 117 L95 116 L93 114 L90 113 L88 111 L85 110 L83 108 L81 106 L78 105 L77 104 L75 103 L72 102 L71 101 L70 100 L68 99 L67 98 L65 98 L64 97 L62 96 L60 96 L58 95 L57 94 L54 93 L53 93 L51 92 L49 91 L48 91 L47 91 L45 90 L44 90 L43 89 L42 89 L41 89 L40 88 L39 87 L37 87 L36 86 L35 85 L33 85 L32 84 L31 84 L30 83 L29 83 L28 82 L26 81 L25 81 L24 80 L22 80 L21 79 L21 78 L20 78 L19 78 L18 77 L17 77 L16 76 L15 76 L15 75 L14 75 L13 75 L12 74 L11 74 L10 74 L9 74 L7 73 L5 72 L4 72 L3 72 L2 71", "key":-1} ],
  "linkDataArray": [  ]
} }
  </textarea>
  </div>
  <script src="../assets/js/require.js"></script>
  <script>
    require(["FreehandDrawingScript"], function (app) {
      app.init();
      document.getElementById("select").onclick = app.select;
      document.getElementById("drawMode").onclick = app.drawMode;
      document.getElementById("save").onclick = app.save;
      document.getElementById("load").onclick = app.load;
      document.getElementById("allowResizing").onclick = app.allowResizing;
      document.getElementById("allowReshaping").onclick = app.allowReshaping;
      document.getElementById("allowRotating").onclick = app.allowRotating;
    });
  </script>
</body>
</html>
<?php db::db_close(); ?>