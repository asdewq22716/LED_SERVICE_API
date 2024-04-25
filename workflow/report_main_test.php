<?php
$WF_TYPE = 'R';
include '../include/comtop_user.php';
 
 
$W = conText($_GET['W']);
if($W != ""){
?>
    <!-- Calender css -->
    <link rel="stylesheet" type="text/css" href="../assets/plugins/calender/css/fullcalendar.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/calender/css/fullcalendar.print.css" media='print'>
<style>
	tr:first-child > td > .fc-day-grid-event {
	margin-top: 2px;
	margin-left: 2px;
	padding-left: 5px;
} 
tr > td > .fc-day-grid-event {
	margin-top: 2px;
	margin-left: 2px;
	padding-left: 5px;
} 
</style>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
			<div class="row" id="animationSandbox">
					<div class="col-sm-12">
						<div class="main-header">
							<h4>Calendar</h4>
						</div>
					</div>
				</div>
             <!--Report row start-->
          <div class="row" >
			<div class="col-md-12">
                <div class="card">
					<div class="card-block">
						<div class="form-group row">
							<div class="col-md-12">
								<div id="calendar"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

        <!-- Container-fluid ends -->
     </div>
</div>
<?php
$cal_txt = "";
$sql_cal = db::query("select * from WF_CALENDAR WHERE WF_MAIN_ID='".$W."' ORDER BY CAL_ID ASC");
while($rec = db::fetch_array($sql_cal)){
	$WF_SQL = "";
	if($rec['CAL_TAG_COLOR'] == ""){ $tag_color = "#2196F3"; }else{ $tag_color = $rec['CAL_TAG_COLOR']; }
	if($rec['CAL_BG_COLOR'] == ""){ $bg_color = "#EFF0F1"; }else{ $bg_color = $rec['CAL_BG_COLOR']; }
	if($rec['CAL_TEXT_COLOR'] == ""){ $text_color = "#000000"; }else{ $text_color = $rec['CAL_TEXT_COLOR']; } 
	if($rec["CAL_W_ID"] != '' AND $rec["CAL_CHOOSE_TYPE"] == '1'){
	$sql_m = db::query("select WF_MAIN_ID,WF_MAIN_NAME,WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_TYPE from WF_MAIN where WF_MAIN_ID = '".$rec["CAL_W_ID"]."'");
	$rec_m = db::fetch_array($sql_m);
	$wf_table = $rec_m["WF_MAIN_SHORTNAME"]; 
	$WF_FIELD_PK = $rec_m["WF_FIELD_PK"];
	$TYPE = $rec_m["WF_TYPE"];
	$WF_MAIN_ID = $rec_m["WF_MAIN_ID"];
	$WF_MAIN_NAME = $rec_m['WF_MAIN_NAME'];
	$wf_con = " WHERE 1=1 ";
		if(trim($rec["CAL_MORE_SQL"]) != ''){
			$wf_con = " AND ".wf_convert_var($rec["CAL_MORE_SQL"]);
		}
	$WF_SQL = "SELECT * FROM ".$wf_table.$wf_con;
	}elseif($rec["CAL_MAIN_SQL"] !=""){
		$WF_SQL = htmlspecialchars_decode($rec["CAL_MAIN_SQL"], ENT_QUOTES);
	}

	if($WF_SQL != ""){ 
		$sql_r = db::query($WF_SQL);
		while($rec_r = db::fetch_array($sql_r)){
		$date_s = $rec["CAL_START_DATE"];
		if($rec["CAL_END_DATE"] == ""){
			$date_e = $rec["CAL_START_DATE"];
		}else{
			$date_e = $rec["CAL_END_DATE"];
		}
		$time_s = "";
		$time_e = "";
		if($rec["CAL_START_TIME"] != ""){
		$time_s = "T".$rec_r[$rec["CAL_START_TIME"]];	
		}
		if($rec["CAL_END_TIME"] != ""){
		$time_e = "T".$rec_r[$rec["CAL_END_TIME"]];
		}
		$title = bsf_show_text($rec["CAL_W_ID"],$rec_r,$rec["CAL_SHOW"],$TYPE);
			$cal_txt .= ",{title: '".$title."',start: '".$rec_r[$date_s]."".$time_s."',end: '".$rec_r[$date_e]."".$time_e."', borderColor: '".$tag_color."', backgroundColor: '".$bg_color."'}";
		}
		
	}

	
}
include '../include/combottom_js_user.php'; ?>
<script src="../assets/plugins/calender/js/moment.min.js"></script>
<script src="../assets/plugins/calender/js/fullcalendar.min.js"></script>
<script src="../assets/plugins/calender/js/locale-all.js"></script>
<script>

  $(document).ready(function() {
    var initialLocaleCode = 'th';

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listMonth'
      },
      defaultDate: '<?php echo date("Y-m-d"); ?>',
      locale: initialLocaleCode,
      buttonIcons: true, // show the prev/next text
      weekNumbers: false,
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      eventLimit: false, // allow "more" link when too many events
      events: [<?php echo substr($cal_txt,1,strlen($cal_txt)); ?>]
    });
	
  });

</script>
<?php 
}
include '../include/combottom_user.php'; ?>

