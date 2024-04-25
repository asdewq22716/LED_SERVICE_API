<?php
function convert_to_normal_text($text) {

    $normal_characters = "a-zA-Z0-9ก-๙เ\s`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]";
    $normal_text = preg_replace("/[^$normal_characters]/", '', $text);

    return $normal_text;
}
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
.fc-unthemed .fc-today {
	color:#000;
}
.fc-event, .fc-event:hover, .ui-widget .fc-event {
    color: #000;
}
</style>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
			<div class="row" id="animationSandbox">
					<div class="col-sm-12">
						<div class="main-header">
							<h4><?php echo $rec_main['WF_MAIN_NAME']; ?></h4>
						</div>
					</div>
				</div>
             <!--Report row start-->
          <div class="row" >
			<div class="col-md-12">
                <div class="card">
					<div class="card-header">
						<?php 
					$filter = "";
					if($rec_main["WF_MAIN_TOP_INCLUDE"] != "" AND file_exists("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"])){ include("../plugin/".$rec_main["WF_MAIN_TOP_INCLUDE"]); }
						$sql_search = db::query("select * from WF_STEP_FORM where WF_MAIN_ID = '".$W."' AND WF_TYPE = 'S' AND (WFS_HIDDEN_FORM IS NULL OR WFS_HIDDEN_FORM = '' OR WFS_HIDDEN_FORM = 'N') ");
						if(db::num_rows($sql_search)>0){
						?><form method="get" id="form_wf_search" name="form_wf_search" action="#">
						<h4><i class="icofont icofont-search-alt-2"></i> ค้นหา</h4>
								<div class="form-group row">
								<?php bsf_show_form($W,0,$_GET,'S'); ?>
								</div>
								<div class="form-group row">
									<div class="col-md-12 text-center">
										<button type="submit" name="wf_search" id="wf_search"  class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
										&nbsp;&nbsp;
										<button type="button" name="wf_reset" id="wf_reset"  class="btn btn-warning" onClick="window.location.href='report_main.php?W=<?php echo $W; ?>';"><i class="zmdi zmdi-refresh-alt"></i> <?php echo $system_conf["wf_label_reset"];?></button>
										<input type="hidden" name="W" id="W" value="<?php echo $W; ?>"><input type="hidden" name="WF_SEARCH" id="WF_SEARCH" value="Y">
									</div>
								</div>
						</form>	
						<?php 
						} ?>
					</div>
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
$rows_conf = db::num_rows($sql_cal);
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
	$wf_con = " WHERE ".$rec["CAL_START_DATE"]." IS NOT NULL ";
		if(trim($rec["CAL_MORE_SQL"]) != ''){
			$wf_con .= " AND ".wf_convert_var($rec["CAL_MORE_SQL"]);
		}
		if($rows_conf == 1){
			$wf_con .= wf_search_function($W,$_GET,$wf_table,$rec_main["WF_FIELD_PK"]);
		}
		$WF_SQL = "SELECT * FROM ".$wf_table.$wf_con;
	}elseif($rec["CAL_MAIN_SQL"] !=""){
		$WF_SQL1 = htmlspecialchars_decode(wf_convert_var($rec["CAL_MAIN_SQL"]), ENT_QUOTES);
		$WF_EX = explode("ORDER BY ",$WF_SQL1);
		if($rows_conf == 1){
		$WF_SQL = $WF_EX[0].wf_search_function($W,$_GET,$wf_table,$rec_main["WF_FIELD_PK"]);
			if($WF_EX[1] != ""){ 
				$WF_SQL .= " ORDER BY ".$WF_EX[1];
			}
		}else{
		$WF_SQL = $WF_SQL1;	
		}
	}

	if($WF_SQL != ""){ 
		$sql_r = db::query($WF_SQL);
		while($rec_r = db::fetch_array($sql_r)){
		$date_s = $rec["CAL_START_DATE"];
		if($rec["CAL_END_DATE"] == ""){
			$date_e = $rec["CAL_START_DATE"];
		}else{
			$date_e = $rec["CAL_END_DATE"];
			/*if($rec["CAL_END_TIME"] == "" OR $rec_r[$rec["CAL_END_TIME"]] == ''){
				$date_n =  $rec_r[$date_e];
				$date_end = strtotime($date_n);
				$date_end = strtotime("+1 day",$date_end);
				$rec_r[$date_e] = date('Y-m-d', $date_end);
			
			}*/
		}
		
		if($rec_r[$rec["CAL_END_DATE"]] != '' AND $rec_r[$rec["CAL_START_DATE"]] != $rec_r[$rec["CAL_END_DATE"]]){
			$date =  $rec_r[$date_e];
			$date = strtotime($date);
			$date = strtotime("+1 day", $date);
			$date = date('Y-m-d', $date);
			$rec_r[$date_e] = $date;
		}
		
		$time_s = "";
		$time_e = "";
		if($rec["CAL_START_TIME"] != ""){
			$time_s = "T".$rec_r[$rec["CAL_START_TIME"]];	
		}else{
			$time_s = "";
		}
		if($rec["CAL_END_TIME"] != ""){
			if($rec_r[$rec["CAL_END_TIME"]] != '' AND $rec_r[$rec["CAL_END_TIME"]] != '00:00'){
				$time_e = "T".$rec_r[$rec["CAL_END_TIME"]];
				$allDay = 'false';
			}else{
				$time_e = "T00:00";
				$allDay = 'true';
				//$rec_r[$date_e] = $date;
			}
		}else{
			$time_e = "";
			//$rec_r[$date_e] = $date;
			$allDay = 'true';
		}
		$wf_link = "";
		if($rec["CAL_LINK"] != ""){
			$wf_link = ",url: '".bsf_show_field($rec["CAL_W_ID"],$rec_r,$rec["CAL_LINK"],$TYPE)."'";
		}
		$title = bsf_show_text($rec["CAL_W_ID"],$rec_r,$rec["CAL_SHOW"],$TYPE);
		$title = preg_replace('/\s\s+/', '\n',$title);
		$title = convert_to_normal_text($title);
			$cal_txt .= ",{title: '".$title."',start: '".$rec_r[$date_s]."".$time_s."',end: '".$rec_r[$date_e]."".$time_e."',allDay: ".$allDay.", borderColor: '".$tag_color."', backgroundColor: '".$bg_color."', color: '".$text_color."'".$wf_link."}";
		}
		
	}

	
}
?>
<script src="../assets/plugins/calendar/js/moment.min.js"></script>
<script src="../assets/plugins/calendar/js/fullcalendar.min.js"></script>
<script src="../assets/plugins/calendar/js/locale-all.js"></script>
<script>

  $(document).ready(function() {
    var initialLocaleCode = 'th';

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listMonth'
      },eventRender: function(eventObj, $el) {
        $el.popover({
          content: eventObj.title,
          trigger: 'hover',
          placement: 'top',
          container: 'body'
        });
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
<?php include '../include/combottom_js_user.php'; 
include '../include/combottom_user.php'; ?>
