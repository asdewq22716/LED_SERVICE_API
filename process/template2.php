<?php include '../include/comtop_admin.php'; ?>
      <!-- Handson table css start -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/handsontable/css/handsontable.full.min.css">

    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row">
                <div class="col-sm-7">
                    <div class="main-header">
                        <h4>Title</h4>
						<h5>Description</h5>
                        <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Icons</a>
                            </li>
                            <li class="breadcrumb-item"><a href="test.php">Grid-Stack</a>
                            </li>
                        </ol>
                    </div>
                </div>
				<div class="col-sm-5">
                    <div class="main-header f-right">
                        <h5>Title</h5>
						<h6>Title</h6>
                    </div>
                </div>
            </div>
            <!-- Row end -->

			<?php print_pre($_GET); ?>
			<form method="get" enctype="multipart/form-data" id="form_wf">
			<!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text text-success">
									<i class="fa fa-check-circle"></i> ข้อมูล								</h5>
								<div class="f-right">
									<a href="#primary" class="btn btn-warning waves-effect waves-light" onClick="load_data();" role="button">
										<i class="icofont icofont-save"></i> Load
									</a>
									<a href="#primary" class="btn btn-warning waves-effect waves-light" onClick="$('#xx').val(JSON.stringify({data: hot.getData()}));" role="button">
										<i class="icofont icofont-save"></i> บันทึก
									</a>
								</div>

                        </div> 
                        <div class="card-block">
							<div class="table-responsive scroll-container">
								<div id="hot"></div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
			<textarea id="xx" style="width:1000px;height:500px;" rows="100"></textarea>
			</form>

        <!-- Container-fluid ends -->
     </div>
</div>
<?php include '../include/combottom_js.php'; ?>
<!-- Handson table js -->
<script type="text/javascript" src="../assets/plugins/handsontable/js/handsontable.full.js"></script>
<script type="text/javascript" src="../assets/plugins/handsontable/js/select2-editor.js"></script>


<script>var dataObject = [
  {
    id: 1,
    flag: 'EUR' 
  },
  {
    id: 2,
    flag: 'JPY' 
  },
  {
    id: 3,
    flag: 'GBP' 
  } 
];

var optionsList = [{id: 1, text: 'first'}, {id: 2, text: 'second'},{id: 3, text: 'Third'}, {id: 4, text: 'Forth'},{id: 5, text: 'Fith'}]; 

var hotElement = document.querySelector('#hot');
var hotElementContainer = hotElement.parentNode;
var hotSettings = {
  data: dataObject,
  columns: [
    {
      data: 'ID',
      type: 'numeric',
      width: 0.5,
	  readOnly: true
    },
    {
      data: 'flag',
		type: 'text'
    },
    {
      data: 'currencyCode',
      type: 'text'
    },
    {
      data: 'currency',
      type: 'text'
    },
    {
      data: 'LEVELS',
      editor: 'inputmask',
	  renderer: safeHtmlRenderer
    },
    {
      data: 'units',
      editor: 'select2',
	  renderer: customDropdownRenderer2, 
	  select2Options: { 
		data: optionsList,
		dropdownAutoWidth: true,                        
		width: 'resolve'
		}
    },
    {
      data: 'asOf',
      type: 'date',
      dateFormat: 'DD/MM/YYYY'
    },
    {
      data: 'onedChng',
      type: 'numeric',
      numericFormat: {
        pattern: '0.00%'
      },
	  allowEmpty: false
    }
  ],
  stretchH: 'all',
  width: '100%',
  autoWrapRow: false,
  manualColumnResize: true,
  height: 300,
  columnSorting: true,
  rowHeaders: true,
  minSpareRows: 1,
  contextMenu: !0,
  colHeaders: [
    'ID',
    'Country',
    'Code',
    'Currency',
    'Level',
    'หน่วย',
    'Date',
    'Change'
  ]

};
var hot = new Handsontable(hotElement, hotSettings);

  function safeHtmlRenderer(instance, td, row, col, prop, value, cellProperties) {
    Handsontable.TextCell.renderer.apply(this, arguments); 
	$(prop[id]).inputmask({ mask: "99/99/9999"});

	 

	
  }
function customDropdownRenderer2(instance, td, row, col, prop, value, cellProperties)
{
    var selectedId;
    for (var index = 0; index < optionsList.length; index++)
    {
        if (parseInt(value) === optionsList[index].id)
        {
            selectedId = optionsList[index].id;
            value = optionsList[index].text;            
        }
    }
    Handsontable.TextCell.renderer.apply(this, arguments);
    // you can use the selectedId for posting to the DB or server
    $('#selectedId').text(selectedId);
}
function load_data(){  
			$.ajax({
				type: 'GET',
				dataType: 'json',
				url: 'master_main_json.php',
				data: 'W=40',
				cache: false,
				success: function(res){ 
					hot.loadData(res.data);
				} 
			 });
}
</script>
<?php include '../include/combottom_admin.php'; ?>