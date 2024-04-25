<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$WG = conText($_GET['WG']);
$WR = conText($_GET['WR']);
$WT = conText($_GET['WT']);

$arr_graph = array('line','spline','area','areaspline','column','bar','pie','scatter','contour','surface','spider','mixed');

if($WR != ''){
$sql_form = db::query("select * from WF_WIDGET where WG_ID = '".$WG."' ");
$rec_form = db::fetch_array($sql_form);
if($WT == "3"){
if($rec_form['WG_GRAPH_TYPE']==""){ $rec_form['WG_GRAPH_TYPE'] = "line"; }
if($rec_form['WG_PIE_SELECT'] == ''){ $rec_form['WG_PIE_SELECT'] = '1'; }
?><div class="col-md-12">
	<div class="card">
		<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  ตั้งค่า</h5>
		</div>
		<div class="card-block">
			<div class="col-md-6">
				<!---->
				 <div class="row">
					<?php foreach($arr_graph as $wf_graph){ ?>
					<div class="col-sm-4 col-xl-4 col-sx-6">
						<div class="card thumb-block">
							<div class="thumb-img">
								<img src="../assets/highcharts/images/<?php echo $wf_graph; ?>.png?E=<?php echo date("YmdHis"); ?>" class="img-fluid width-100">
							</div>
							<div class="card-footer">
								<div id="radio" class="form-radio">
									<div class="radio radio-inline">
										<label>
											<input type="radio" name="WG_GRAPH_TYPE" id="WG_GRAPH_TYPE" value="<?php echo $wf_graph; ?>" <?php if($rec_form['WG_GRAPH_TYPE']==$wf_graph){ echo "checked"; } ?> onClick="select_graph('<?php echo $wf_graph; ?>');">
											<i class="helper"></i> <?php echo $wf_graph; ?></input>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<!---->				
			</div>
		
			<div class="col-md-6">
				<!---->
				<div class="form-group">
					<label for="InputNormal" class="form-control-label">กำหนดสีเอง </label>
					  <textarea name="WG_GRAPH_COLOR" id="WG_GRAPH_COLOR" class="form-control" rows="3"><?php echo $rec_form['WG_GRAPH_COLOR']; ?></textarea>
					  <small class="form-text text-muted">(คั่นสีด้วย , ตัวอย่าง "#3452FE","#FF6F05","#2A363B")</small>
				</div>
				<div class="form-group">
					<div class="checkbox-color checkbox-primary">
						<input name="WG_GRAPH_STACK" id="WG_GRAPH_STACK" type="checkbox" value="Y" <?php if($rec_form['WG_GRAPH_STACK']=="Y"){ echo "checked"; } ?>>
							<label for="WG_GRAPH_STACK">
								Stack Graph
							</label>
					</div>
				  </div>
				  <div class="form-group">
					<div class="checkbox-color checkbox-primary">
						<input name="WG_GRAPH_OPP" id="WG_GRAPH_OPP" type="checkbox" value="Y" <?php if($rec_form['WG_GRAPH_OPP']=="Y"){ echo "checked"; } ?>>
							<label for="WG_GRAPH_OPP">
								แยกการแสดงค่า แกน Y
							</label>
					</div>
				  </div>
				<?php
				$arr_r = bsf_load_report($WR);
				?>
				<!---->
				<div class="form-group" id="pie_setting" <?php if($rec_form['WG_GRAPH_TYPE'] != 'pie'){ echo 'style="display:none"'; } ?>>
					<label class="form-control-label">กำหนดคอลัมน์ที่แสดงผล </label>
					<div class="form-radio">
					<?php
					foreach($arr_r[0] as $c=>$val){ 
						if($c > 0){ ?>
						<div class="radio radio-inline">
							<label>
								<input type="radio" name="WG_PIE_SELECT" id="WG_PIE_SELECT" value="<?php echo $c; ?>" <?php if($rec_form['WG_PIE_SELECT'] == $c){ echo "checked"; } ?> >
									<i class="helper"></i> <?php echo $val['text']; ?>
							</label>
						</div>
					<?php }}	?> 
					</div>
					<div class="form-group">
					<div class="checkbox-color checkbox-primary">
						<input name="WG_GRAPH_DONUT" id="WG_GRAPH_DONUT" type="checkbox" value="Y" <?php if($rec_form['WG_GRAPH_DONUT']=="Y"){ echo "checked"; } ?>>
							<label for="WG_GRAPH_DONUT">
								Donut
							</label>
					</div>
				  </div>
				</div>
				<!---->
				<div class="form-group" id="mixed_setting" <?php if($rec_form['WG_GRAPH_TYPE'] != 'mixed'){ echo 'style="display:none"'; } ?>>
					<label class="form-control-label">กำหนดกราฟแต่ละประเภทข้อมูล </label>
					<table class="table">
						<thead>
							<tr>
							<th>ประเภทข้อมูล</th>
							<th>ประเภทกราฟ</th>
							</tr>
						</thead>
						<tbody>
					<?php
					$m = explode('|',$rec_form['WG_MIXED_COL']);
					foreach($arr_r[0] as $c=>$val){
						if($c > 0){ ?>
						<tr>
							<td><?php echo $val['text']; ?></td>
							<td><select name="mix<?php echo $c; ?>" class="form-control"><?php
							foreach($arr_graph as $gr){
								if($gr != "mixed"){
									echo "<option value=\"".$gr."\" ";
									if($m[$c] == $gr){ echo " selected"; }
									echo ">".$gr."</option>";
								}
							}
							?></select></td>
						</tr>
					<?php }}	?> 
					</tbody>
					</table>
					<input type="hidden" name="allM" id="allM" value="<?php echo $c; ?>" />
				 
				</div>
				<!---->
			</div>
			
		</div>	
	</div> 
<script>
function select_graph(c){
	if(c=='pie'){
		$('#pie_setting').show();
		$('#mixed_setting').hide();
	}else if(c=='mixed'){
		$('#pie_setting').hide();
		$('#mixed_setting').show();
	}else{
		$('#pie_setting').hide();
		$('#mixed_setting').hide();
	}
}
</script>
<?php }elseif($WT == "4"){
	if($rec_form['WG_SUMMARY_COL']==""){ $rec_form['WG_SUMMARY_COL'] = "1"; }
	?>
<div class="col-md-12">
	<div class="card">
		<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  ตั้งค่า</h5>
		</div>
		<div class="card-block">
			<div class="col-md-12">
				<!---->
				 <div class="row">
				 <label class="form-control-label">กำหนด Column ที่ตัองการแสดง </label>
				 <table class="table">
					<thead><tr>
				<?php
				$arr_r = bsf_load_report($WR);
					foreach($arr_r[0] as $key=>$th){ ?>
						<th><?php echo $th['text']; ?></th>
					<?php } ?>
					</tr></thead>
					<tbody><tr>
				<?php
				//$arr_r = bsf_load_report($WR);
					foreach($arr_r['T'] as $c=>$td){
					?><td><div class="form-radio"><div class="radio radio-inline">
							<label>
								<input type="radio" name="WG_SUMMARY_COL" id="WG_SUMMARY_COL" value="<?php echo $c; ?>" <?php if($rec_form['WG_SUMMARY_COL'] == $c){ echo "checked"; } ?> >
									<i class="helper"></i> <?php if($c==0){ echo " รวม ".$td['count']." รายการ "; }elseif($td['text'] != ""){ 
									$sufix = explode('+',$td['format']);
									echo wf_report_format($td['text'],$sufix[0]).$sufix[1];  } ?>
							</label>
						</div></div></td>
					<?php } ?>
					</tr></tbody>
				</table>
				</div>
				<!---->		
				<div class="form-group">
					<label for="WG_SUMMARY_FOOTER" class="form-control-label">FOOTER</label>
					  <textarea name="WG_SUMMARY_FOOTER" id="WG_SUMMARY_FOOTER" class="form-control" ><?php echo $rec_form['WG_SUMMARY_FOOTER']; ?></textarea>
				</div>
				<!---->
			</div>
			
		</div>
		<div class="card-header"><h5 class="card-header-text"><i class="typcn typcn-message"></i>  รูปแบบการแสดงผล</h5>
		<?php 
		$wf_title = "Title";
		$wf_footer = "Footer";
		$wf_icon = "ion-social-windows"; //ion-social-windows
		$wf_theme = ""; //
		?>
		</div>	
		<div class="card-block">
			 <div class="row">
			<?php for($n=1;$n<=4;$n++){ ?>	
			<div class="col-md-3">
				<div class="form-radio"><div class="radio radio-inline">
					<label>
						<input type="radio" name="WG_SUMMARY_TYPE" id="WG_SUMMARY_TYPE" value="<?php echo $n; ?>" <?php if($rec_form['WG_SUMMARY_TYPE'] == $n){ echo "checked"; } ?> >
							<i class="helper"></i> เลือก
					</label>
				</div></div>
				<div class="card <?php echo $wf_theme; ?>">
					<div class="card-block">
						<?php
						$wf_value = rand(100,1000);
						bsf_report_summary($n,$wf_value,$wf_title,$wf_footer,$wf_icon,$wf_theme,''); ?>
					</div>
				</div>
			</div>
			<?php } ?>
			 </div>
			 <!--<div class="row">
				<div class="col-md-3">
					<div class="card <?php echo $wf_theme; ?>">
						<div class="card-block">
						<?php bsf_report_summary('5',$wf_value,$wf_title,$wf_footer,$wf_icon,$wf_theme,''); ?>   
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card <?php echo $wf_theme; ?>">
						<div class="card-block">
						<?php bsf_report_summary('6',$wf_value,$wf_title,$wf_footer,$wf_icon,$wf_theme,''); ?>   
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card <?php echo $wf_theme; ?>">
						<div class="card-block">
						<?php bsf_report_summary('7',$wf_value,$wf_title,$wf_footer,$wf_icon,$wf_theme,''); ?>   
						</div>
					</div>
				</div> 
				<div class="col-md-3">
					<div class="card"> 
						 <div class="card-block">
								 <div class="m-b-5">
									<h4 >Title</h4>
								</div>
								<i class="ion-social-windows text-primary f-64"></i>
								<div class="cloud-temp">
									<h2>999</h2>
									<small class="">Footer</small>
								</div>

						</div> 
						<ul class="weather-temp bg-white">
							<li>
								<span>Rows1</span>
							<div class="f-w-600 text-primary">111</div>
							</li>
							<li>
								<span>Rows2</span>
							<div class="f-w-600 text-primary">222</div>
							</li>
							<li>
								<span>Rows3</span>
							<div class="f-w-600 text-primary">333</div>
							</li>
						</ul>
					</div>
				</div>
			 </div>-->
		</div>
	</div>
	
</div>
 
<script type="text/javascript" src="../assets/plugins/charts/sparkline/js/jquery.sparkline.js"></script>
<script>
$(".barchartxx").sparkline([5, 6, 2, 4, 9, 1, 2, 8, 3, 6, 4, 2, 9, 6], {
            type: 'bar',
            barWidth: '10px',
            height: '60px',
            barSpacing: '5px',
            tooltipClassname: 'chart-sparkline',
			barColor:'#2196F3'
        });
$(".linechartdd").sparkline([5, 6, 2, 4, 9, 1, 2, 8, 3, 6, 4, 2, 9, 6], {
        type: 'line',
        width: '100%',
        height: '60px',  
		tooltipClassname: 'chart-sparkline',
        lineColor:'#FFFFFF',
        fillColor: '#FFFFFF',
		spotColor:'#FFFFFF'
        });	
</script>
	<?php
}} db::db_close(); ?>