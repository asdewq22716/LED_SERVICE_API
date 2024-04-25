<?php  
include '../include/comtop_admin.php';
?>
<!-- Handson table css start -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/handsontable/css/handsontable.full.min.css">
<style>
.ht_master tr > td:nth-child(2) {
  text-transform: uppercase;
}
</style> 
<br />
<div id="sample">
  <div style="width: 100%; display: flex; justify-content: space-between">
    
	<div id="myPaletteDiv2" style="width: 350px;padding:9px; background-color: whitesmoke; border: solid 1px black">
	 <form onSubmit="return save();" action="workflow_function.php" method="post">
	 <input type="hidden" name="process" id="process" value="add">
			<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="F">
			<input type="hidden" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE" value="W">
	<br /><br /><br /><br />
							<div class="form-group row">
								<div class="col-md-12"> 
										<h1>Create New Form</h1> 
								</div> 
							</div>
							<div class="form-group row">
								<div class="col-md-12"> 
										<label for="WF_MAIN_NAME" class="form-control-label">Form Name <span class="text-danger">*</span></label>
										<input type="text" name="WF_MAIN_NAME" class="form-control"  required> 
								</div> 
							</div>
							<div class="form-group row">
								<div class="col-md-12"> 
										<label for="WF_MAIN_SHORTNAME" class="form-control-label">Table Name <span class="text-danger">*</span></label>
										<input type="hidden" name="WF_ALIAS" id="WF_ALIAS" value="FRM_">
										<div class="input-group">
										<span class="input-group-addon">FRM_</span>
										<input type="text" name="WF_MAIN_SHORTNAME" id="WF_MAIN_SHORTNAME" class="form-control text-uppercase" placeholder="TABLE NAME"  autocomplete="off" maxlength="22" required>
										</div>
										<small class="text-muted">** ระบุได้เฉพาะ A-Z, 0-9 และ Underscore (_) **</small>

								</div> 
							</div>
							<div class="form-group row">
								<div class="col-md-12"> 
										<label for="WF_GROUP_ID" class="form-control-label">Group Name <span class="text-danger">*</span></label>
										<select name="WF_GROUP_ID" id="WF_GROUP_ID" class="form-control select2" required aria-required="true" placeholder="เลือก...">
											<option value=""></option>
											<?php
											$sql_group = db::query("select GROUP_NAME , GROUP_ID from WF_GROUP WHERE WF_TYPE = 'F' order by GROUP_ORDER asc");
											while($rec_group = db::fetch_array($sql_group))
											{ ?>
												<option value="<?php echo $rec_group['GROUP_ID']; ?>"><?php echo $rec_group['GROUP_NAME']; ?></option>
											<?php } ?>
										</select>  
								</div> 
							</div>
							<div class="form-group row">
								<div class="col-md-12"> 
										<input type="submit" id="SaveButton" class="btn btn-success" value="Create" />
								</div> 
							</div>
							<textarea id="mySavedModel" name="STEP_DATA" style="width:100%;height:300px;display:none"><?php echo $daefault_m; ?></textarea>
	</form>
	</div>
    <div id="myDiagramDiv" style="flex-grow: 1; height: 650px; border: solid 1px black">
		<br /><br /><br /><br />
		<div class="card-block" id="SHOW_LOAD2">
			<div class="table-responsive scroll-container">
											<div id="hot" class="hot handsontable htRowHeaders htColumnHeaders"></div>
										</div>

			<div class="loader-block" id="SHOW_LOAD1" style="position: relative;top: -200px;">
				<svg id="loader2" viewBox="0 0 100 100">
					<circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
				</svg>
			</div>
		</div>	
	</div>
  </div>

</div>
<?php
$form_system_data = build_data('FORM_SYSTEM', 'FORM_MAIN_ID', 'FORM_MAIN_NAME',"FORM_MAIN_F='Y'");
 include '../include/combottom_js.php'; ?>
<script type="text/javascript" src="../assets/plugins/handsontable/js/handsontable.full.js"></script>
<script type="text/javascript" src="../assets/plugins/handsontable/js/select2-editor.js"></script>
<script>
var window_height = $(window).height();
var bsf_height = $(window).height()-200;
var dataObject = [
    {WFS_FIELD_NAME: 'F_ID', WFS_NAME: 'xx', WFS_FIELD_TYPE: 'varchar', WFS_FIELD_LENGTH: '20', FORM_MAIN_ID: 'Textbox'} 
  ];
var hotElement = document.querySelector('#hot'); 
var hotElementContainer = hotElement.parentNode;
var emailValidator = function (value, callback) {
    setTimeout(function(){
      if (/.+@.+/.test(value)) {
        callback(true);
      }
      else {
        callback(false);
      }
    }, 1000);
  };
var hotSettings = { 
  data:dataObject,
  columns: [
    {
		data: 'WFS_FIELD_NAME',width: 50
    },{
		data: 'WFS_NAME'
	},{
		data: 'WFS_FIELD_TYPE',type: 'dropdown',width: 30,
        source: ['<?php echo implode("','",$arr_data_type); ?>']
	},{
		data: 'WFS_FIELD_LENGTH',type: 'numeric',width: 30
	},{
		data: 'FORM_MAIN_ID',editor: 'dropdown',width: 30,
        source: ['<?php echo implode("','",$form_system_data); ?>']
	}
  ],
  stretchH: 'all',
  width: '98%',
  autoWrapRow: false,
  manualColumnResize: true,
  manualRowResize: true,
  height: bsf_height, 
  rowHeaders: true, 
  minSpareRows: 1,
  fillHandle: true,
  manualColumnMove: true,
  manualRowMove: true,
  colHeaders: [
    'Field Name','Description','Field Type','Field Length','Form Type'  ]
}; 

var hot = new Handsontable(hotElement, hotSettings);
//alert(dataObject); 
$('#SHOW_LOAD1').hide();
hot.updateSettings({
  cells: function (row, col) {
    var cellProperties = {};

    if (hot.getData()[row][col] === 'Nissan') {
      cellProperties.readOnly = true;
    }

    return cellProperties;
  }
});
/*
function load_data(){  
			$.ajax({
				type: 'GET',
				dataType: 'json',
				url: 'master_main_json.php',
				data: 'W=98',
				cache: false,
				success: function(res){ 
					hot.loadData(res.data);
					$('#SHOW_LOAD1').hide();
				} 
			 });
}
load_data();
*/
</script>

<script type="text/javascript">
  $('#WF_MAIN_SHORTNAME').keyup(function()
	{
		if(this.value != "")
		{
			var chk_key = change_th2eng(this.value);
			 var data = chk_key.replace('-','_');
				 data = data.replace(' ','_');
				 data = data.toUpperCase();
			 $('#WF_MAIN_SHORTNAME').val(data); 
		}
	});

</script> 
<?php db::db_close(); ?>