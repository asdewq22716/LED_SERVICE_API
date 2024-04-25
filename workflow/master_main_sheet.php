<?php
$WF_TYPE = 'M';
include '../include/comtop_user.php';
foreach($_GET as $key => $val){
	$$key = conText($val);
}
$W = conText($_GET['W']);
if($W != ""){
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."'");
$rec_main = db::fetch_array($sql);
$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
$wf_link = 'master_main.php'; 

$wf_limit = 20;
if($wf_page == ''){
	$wf_page = 1;
}
$wf_offset = ($wf_page-1)*$wf_limit;

if($rec_main["WF_BTN_ADD_LABEL"] != ''){ $WF_TEXT_MAIN_ADD = $rec_main["WF_BTN_ADD_LABEL"];}
if($rec_main["WF_BTN_BACK_LABEL"] != ''){ $WF_TEXT_MAIN_BACK = $rec_main["WF_BTN_BACK_LABEL"];}
if($rec_main["WF_BTN_CON_LABEL"] != ''){ $WF_TEXT_MAIN_EDIT = $rec_main["WF_BTN_CON_LABEL"];}
if($rec_main["WF_BTN_STEP_LABEL"] != ''){ $WF_TEXT_MAIN_VIEW = $rec_main["WF_BTN_STEP_LABEL"];}
if($rec_main["WF_BTN_DEL_LABEL"] != ''){ $WF_TEXT_MAIN_DEL = $rec_main["WF_BTN_DEL_LABEL"];}




if($rec_main["WF_BTN_CON_RESIZE"] == 'Y'){ 
    $tootip = 'data-toggle="tooltip"';
}else{
  $tootip = '';
}

if($rec_main["WF_BTN_STEP_RESIZE"] == 'Y'){ 
    $tootip_step = 'data-toggle="tooltip"';
}else{
  $tootip_step = '';
}

if($rec_main["WF_BTN_DEL_RESIZE"] == 'Y'){ 
    $tootip_del = 'data-toggle="tooltip"';
}else{
  $tootip_del = '';
}
if($rec_main["WF_BTN_ADD_RESIZE"] == 'Y'){ 
    $tootip_add = 'data-toggle="tooltip"';
}else{
  $tootip_add = '';
}
if($rec_main["WF_BTN_BACK_RESIZE"] == 'Y'){ 
    $tootip_back = 'data-toggle="tooltip"';
}else{
  $tootip_back = '';
}

/* Table แสดงผล */
$link_add = ($rec_main["WF_BTN_ADD_LINK"] != '')?$rec_main["WF_BTN_ADD_LINK"]:"master_main_edit.php?W=".$W;
$link_back = ($rec_main["WF_BTN_BACK_LINK"] != '')?$rec_main["WF_BTN_BACK_LINK"]:"index.php";
$link_back_home =  ($rec_detail["WFD_BTN_ADD_LINK"] != '')? bsf_show_field($W,$WF,$rec_detail["WFD_BTN_ADD_LINK"]):"master_main.php?W=".$W;
?>
<style>
#foo {
   position: absolute;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
}
</style>
<!-- Handson table css start -->
      <link rel="stylesheet" type="text/css" href="../assets/plugins/handsontable/css/handsontable.full.min.css">
 <!-- jqpagination css -->
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
			
			<?php 
			if($rec_main["WF_MAIN_STATUS"] != 'Y'){?>
				<div class="row" id="animationSandbox">
					<div class="col-sm-12">
						<div class="main-header">
							<h4><?php echo $system_conf["wf_not_activated"];?></h4>
						</div>
					</div>
				</div>
			<?php
			}else{?>
            <!-- Row Starts -->
		<div class="row">
			<div class="col-sm-12">
				<div class="main-header">
					<div class="media m-b-12">
						<a class="media-left" href="<?php echo $link_back_home; ?>"><?php if($rec_main['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec_main['WF_MAIN_ICON']."\" class=\"media-object\">"; } ?></a>
						<div class="media-body">
							<h4 class="m-t-5"> &nbsp;</h4>
							<h4><?php echo $rec_main['WF_MAIN_NAME']; ?></h4>
						</div>
					</div>
					<div class="f-right">
						<?php
						if($rec_main["WF_BTN_BACK_STATUS"] == 'Y'){?>
						<a class="btn btn-danger waves-effect waves-light" href="<?php echo $link_back;?>" role="button" <?php echo $tootip_back;?>  title="<?php if($rec_main["WF_BTN_BACK_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_BACK;}?>"><i class="icofont icofont-home"></i> <?php if($rec_main["WF_BTN_BACK_RESIZE"] != 'Y'){echo $WF_TEXT_MAIN_BACK;}?></a>
						<?php }?>
					</div>
				</div>
				
			</div>
		</div> 
            <!-- Row end --> 
             <!--Workflow row start-->
            <div class="row">
				<div id="full_s" class="col-md-12">
                    <div id="container"  class="card">
						<div class="card-header">
                            <h5 class="card-header-text text-success"></h5>
								<div class="f-right"> 
									<a href="#primary" id="toggle_fullscreen" class="btn btn-info waves-effect waves-light" role="button">
										<i class="ion-arrow-expand"></i> เต็มหน้าจอ
									</a> 
									<a href="#primary"  id="bsf_save_data" class="btn btn-warning waves-effect waves-light" role="button">
										<i class="icofont icofont-save"></i> บันทึก
									</a>
									
								</div>

                        </div>
										
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
            <!-- Workflow Row end -->
		<?php }?>
    </div>
	<form id="frm_save" method="post" >  
	<input type="hidden" name="save_data" id="save_data" > 
	<input type="hidden" name="PK_MIAN" value="<?php echo $rec_main["WF_FIELD_PK"]; ?>">
	<input type="hidden" name="TB_MIAN" value="<?php echo $rec_main["WF_MAIN_SHORTNAME"]; ?>"> 
	</form> 
        <!-- Container-fluid ends -->
     </div>
</div>
<?php
 include '../include/combottom_js_user.php'; ?>
<!-- Handson table js -->
<script type="text/javascript" src="../assets/plugins/handsontable/js/handsontable.full.js"></script>
<script type="text/javascript" src="../assets/plugins/handsontable/js/select2-editor.js"></script>


<script>
var window_height = $(window).height();
var bsf_height = $(window).height()-200;
var dataObject = [];
	<?php
	$arr_func = array();
	$txt_data = "";
	$tb_data = "";
	if($rec_main["WF_EXCEL_FIELD"] == ""){
	$sql_step_f = db::query("SELECT * FROM WF_STEP_FORM WHERE WF_MAIN_ID='".$W."' AND WF_TYPE = '".$rec_main["WF_TYPE"]."' AND FORM_MAIN_ID != '16'  AND FORM_MAIN_ID != '10' AND (WFS_NAME != '' OR WFS_NAME IS NOT NULL) ORDER BY WFS_ORDER,WFS_OFFSET");
	}else{
 
	$sql_step_f = db::query("SELECT * FROM WF_STEP_FORM WHERE WF_MAIN_ID='".$W."' AND WF_TYPE = '".$rec_main["WF_TYPE"]."' AND FORM_MAIN_ID != '16'  AND FORM_MAIN_ID != '10' AND WFS_FIELD_NAME IN ('".str_replace(",","','",$rec_main["WF_EXCEL_FIELD"])."') ORDER BY WFS_ORDER,WFS_OFFSET"); 
	
	}
	while($form_step = db::fetch_array($sql_step_f)){ 
	$txt_data .= ",{data: '".$form_step["WFS_FIELD_NAME"]."'";
	if($form_step['FORM_MAIN_ID']!="5"){
		if($form_step['WFS_REQUIRED']=="Y"){ $txt_data .= ",allowEmpty: false"; }else{ $txt_data .= ",allowEmpty: true"; }
	}
	if($form_step['FORM_MAIN_ID']=="1" OR $form_step['FORM_MAIN_ID']=="2"){
		if($form_step["WFS_INPUT_FORMAT"] == "N"){  
			$txt_data .= ",type: 'numeric',className: 'htRight'"; 
		}elseif($form_step["WFS_INPUT_FORMAT"] == "N1"){ 
			$txt_data .= ",type: 'numeric',className: 'htRight',format: '0,0.0'"; 
		}elseif($form_step["WFS_INPUT_FORMAT"] == "N2"){
			$txt_data .= ",type: 'numeric',className: 'htRight',format: '0,0.00'"; 
		}elseif($form_step["WFS_INPUT_FORMAT"] == "N3"){
			$txt_data .= ",type: 'numeric',className: 'htRight',format: '0,0.000'"; 
		}elseif($form_step["WFS_INPUT_FORMAT"] == "E"){
			$txt_data .= ",type: 'text', validator: emailValidator, allowInvalid: true"; 
		}
	}
	if($form_step['FORM_MAIN_ID']=="3"){
		$txt_data .= ",type: 'date',dateFormat: 'YYYY-MM-DD'"; 
	}
	if($form_step['FORM_MAIN_ID']=="4" OR $form_step['FORM_MAIN_ID']=="7" OR $form_step['FORM_MAIN_ID']=="9"){
		
		$WF = array();
		
		$data_list = wf_call_relation($form_step["WFS_ID"],$rec_main["WF_FIELD_PK"],$WF); 
		if(count($data_list)>0){
		$arr_txt2 = array();
		$txt_data .= ",editor: 'select2', renderer: customDropdownRenderer".$form_step["WFS_ID"].", select2Options: { data: ";
		
			foreach($data_list as $key => $val){
					if(is_numeric($val['id'])){
						$arr_txt2[] = "{id: ".$val['id'].", text: '".$val['text']."'}";
					}else{
						$arr_txt2[] = "{id: \"".$val['id']."\", text: '".$val['text']."'}";
					}
				}
		$txt_data2 = "[".implode(",",$arr_txt2)."]";
		echo "var optionsList".$form_step["WFS_ID"]." = ".$txt_data2.";\n"; 
		$arr_func[$form_step["WFS_ID"]] = $txt_data2;
		
		$txt_data .= "optionsList".$form_step["WFS_ID"].", dropdownAutoWidth: true,allowClear: true,width: '300' }";
		} 
		
	}
	if($form_step['FORM_MAIN_ID']=="5"){
		$txt_data .= ",type: 'checkbox',checkedTemplate: 'Y',uncheckedTemplate: '',label: {position: 'before',value: '".$form_step["WFS_NAME"]."'}"; 
	}
		$txt_data .= "}";
		$tb_data .= ",'".$form_step["WFS_NAME"]."'";
	}
	?>
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
  data: dataObject,
  columns: [
    {
      data: 'WFR',
      type: 'numeric',
	  width: 0.3,
	  readOnly: true
    }<?php echo $txt_data; ?>

  ],
  stretchH: 'all',
  width: '100%',
  autoWrapRow: false,
  manualColumnResize: true,
  manualRowResize: true,
  height: bsf_height,
  columnSorting: true,
  rowHeaders: true, 
  minSpareRows: 1,
  fillHandle: true,
  manualColumnMove: true,
  manualRowMove: true,
  colHeaders: [
    'รหัส'<?php echo $tb_data; ?>
  ] 
}; 

var hot = new Handsontable(hotElement, hotSettings);


<?php foreach($arr_func as $key => $val){ ?>
function customDropdownRenderer<?php echo $key; ?>(instance, td, row, col, prop, value, cellProperties)
{
    var selectedId;
    for (var index = 0; index < optionsList<?php echo $key; ?>.length; index++)
    {
		if(Number.isInteger(value) || value == '' || value == null){
			var my_val = parseInt(value);
		}else{
			var my_val = value;
		}
        if (my_val == optionsList<?php echo $key; ?>[index].id)
        {
            selectedId = optionsList<?php echo $key; ?>[index].id;
            value = optionsList<?php echo $key; ?>[index].text;            
        }
    }
    Handsontable.TextCell.renderer.apply(this, arguments);
    // you can use the selectedId for posting to the DB or server
	
	//alert(selectedId);
    $('#selectedId').text(selectedId);
}  
<?php } ?>
function load_data(){  
			$.ajax({
				type: 'GET',
				dataType: 'json',
				url: 'master_main_json.php',
				data: 'W=<?php echo $W; ?>',
				cache: false,
				success: function(res){ 
					hot.loadData(res.data);
					$('#SHOW_LOAD1').hide();
				} 
			 });
}
load_data();
</script>
<script>
$('#bsf_save_data').on('click', function(){
	$('#SHOW_LOAD1').show();
	
	var all_data = JSON.stringify({data: hot.getData()});
	$('#save_data').val(all_data); 
	/*
	var dataString = 'PK_MIAN=<?php echo $rec_main["WF_FIELD_PK"]; ?>&TB_MIAN=<?php echo $rec_main["WF_MAIN_SHORTNAME"]; ?>&save_data='+$('#save_data').val();
	$.ajax({
	 type: "POST",
	 url: "master_main_excel_func.php",
	 data: dataString,
	 cache: false,
	 success: function(html){
	  alert(html);
	  load_data();
						swal({
						  title: "บันทึกเรียบร้อยแล้ว", 
						  type: "success",
						  allowOutsideClick:true
						});

	 }
	 });*/
	 
		var url = "master_main_sheet_func.php"; 
		var data_all = $("#frm_save").serialize();
		$.ajax({
			   type: "POST",
			   url: url,
			   data: data_all,
			   success: function(html)
			   {
						  load_data();
							swal({
							  title: "บันทึกเรียบร้อยแล้ว", 
							  type: "success",
							  allowOutsideClick:true
							});
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form. 

});
$('#toggle_fullscreen').on('click', function(){
  // if already full screen; exit
  // else go fullscreen
  if (
    document.fullscreenElement ||
    document.webkitFullscreenElement ||
    document.mozFullScreenElement ||
    document.msFullscreenElement
  ) {
	 hot.updateSettings({
		height: bsf_height
	});
	$('#full_s').css('padding-right','15px');
	$('#full_s').css('padding-left','15px');
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    }
	$('#toggle_fullscreen').html('<i class="ion-arrow-expand"></i> เต็มหน้าจอ');
  } else {
    element = $('#container').get(0);
	hot.updateSettings({
    height: window_height
	});
	$('#full_s').css('padding-right','0px');
	$('#full_s').css('padding-left','0px');
    if (element.requestFullscreen) {
      element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if (element.webkitRequestFullscreen) {
      element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    } else if (element.msRequestFullscreen) {
      element.msRequestFullscreen();
    }
	$('#toggle_fullscreen').html('<i class="ion-arrow-shrink"></i> ย่อหน้าจอ');
  }
});
</script>
<?php
}
include '../include/combottom_user.php'; ?>