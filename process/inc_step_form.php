<?php
$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."' AND WF_TYPE = '".$WF_TYPE."'");
$rec = db::fetch_array($sql);

$con_form ="";
if($WFD != "0" OR $WFD != ""){ $con_form =" AND WFD_ID = '".$WFD."' "; }

if($WF_TYPE_SEARCH == 'Y'){
	$link_search = '&WF_TYPE_SEARCH='.$WF_TYPE_SEARCH;
	
}else{
	$link_search = '';
}
?>
<!-- gridstack css -->
<link rel="stylesheet" href="../assets/css/gridstack.css"/>
<style>
.gridframe{
	border:3px solid #E3E0E0;
}
.grid-stack{
	min-height:40px;
}
</style>
<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			
			<div class="row">
				<div class="col-sm-12">
					<div class="main-header">
						<h4><?php echo ($rec['WF_MAIN_NAME'] != '')?$rec['WF_MAIN_NAME'] :$txt_head_search; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item">
								<a href="index.php"><i class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item">
								<a href="<?php echo $txt_head_url; ?>"><?php echo $txt_head_text; ?></a>
							</li>
							<?php if($WFD != "0" AND $WFD != ""){ ?>
							<li class="breadcrumb-item">
								<a href="workflow_detail.php?W=<?php echo $W; ?>">บริหารขั้นตอน</a>
							</li>
							<?php } ?>
							<li class="breadcrumb-item">
								<a href="#">บริหาร Field <?php if($WFD != "0" AND $WFD != ""){ echo 'ภายใต้'.step_name($WFD); } ?></a>
							</li>
						</ol>
						<div class="f-right">
							<?php if($WF_TYPE == "W"){ ?>
							<a href="workflow_edit.php?W=<?php echo $W; ?>" class="btn btn-success waves-effect waves-light">
								<i class="fa fa-edit"></i> แก้ไข Workflow
							</a>&nbsp;
							<a href="workflow_detail_form.php?process=edit&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>" class="btn btn-primary waves-effect waves-light">
								<i class="fa fa-edit"></i> แก้ไขขั้นตอน
							</a>&nbsp;
							<?php } ?>
							<?php if($WF_TYPE == "F"){ ?>
							<a href="form_edit.php?W=<?php echo $W; ?>" class="btn btn-success waves-effect waves-light">
								<i class="fa fa-edit"></i> แก้ไข Form
							</a>&nbsp;
							<?php } ?>
							<?php if($WF_TYPE == "M"){ ?>
							<a href="master_edit.php?W=<?php echo $W; ?>" class="btn btn-success waves-effect waves-light">
								<i class="fa fa-edit"></i> แก้ไข Master
							</a>&nbsp;
							<a href="master_main.php?W=<?php echo $W; ?>" class="btn btn-primary waves-effect waves-light">
								<i class="fa fa-table"></i> บริหารข้อมูล
							</a>&nbsp;
							<a href="master_import_data.php?W=<?php echo $W; ?>" class="btn btn-primary waves-effect waves-light">
								<i class="fa fa-plus-circle"></i> นำเข้าข้อมูล <?php echo $rec['WF_MAIN_NAME'];?>
							</a>&nbsp;
							<?php } ?>
							<a href="#!" onClick="PopupCenter('workflow_step_preview.php?W=<?php echo $W; ?>&WFD=<?php echo $WFD; echo $link_search;?>', 'Preview', (window.innerWidth-60), window.innerHeight) ;"  class="btn btn-info waves-effect waves-light">
								<i class="fa fa-search"></i> ดูหน้าจอ
							</a>
						</div>
					</div>
				</div>
			</div>
            <!-- Row end -->
				<input type="hidden" name="process" id="process" value="re_order">
				<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
				<input type="hidden" name="WFD" id="WFD" value="<?php echo $WFD; ?>">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<!-- Include step form -->
					
<div class="card-block tab-icon">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs md-tabs " role="tablist">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#wfposition" role="tab"><i class="fa fa-retweet"></i> บริหาร Field/จัดตำแหน่ง</a>
			<div class="slide"></div>
		</li>
		<?php if($WF_TYPE == "W"){ ?>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#wfdocument" role="tab"><i class="fa fa-link"></i> เอกสารประกอบ <span id="wf_attach_show"></span></a>
			<div class="slide"></div>
		</li>
		
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#wfprocess" role="tab"><i class="fa fa-random"></i> เงื่อนไขการเปลี่ยน Flow <span id="wf_process_way_show"></span></a>
			<div class="slide"></div>
		</li>
		<?php }
		if($WF_TYPE != "S"){
		?>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#wfgroup" role="tab"><i class="fa fa-object-group"></i> กลุ่มของ Field <span id="wf_group_field_show"></span></a>
			<div class="slide"></div>
		</li>
		<?php }?>
	</ul>
<div class="tab-content">
	<!-- Row Starts -->
	<div class="row tab-pane active" id="wfposition" role="tabpanel">
		<div class="col-md-12">
			<div class="card_bk">
				<div class="card-header">
						
						<h5 class="card-header-text">
							<i class="fa fa-retweet"></i> บริหาร Field/จัดตำแหน่ง
						</h5>
						<div class="f-right">
							<button type="button" class="btn btn-primary waves-effect waves-light" onclick="window.location.href='<?php echo $_url_edit; ?>?process=add&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>'">
								<i class="fa fa-plus-circle"></i> เพิ่ม Input
							</button> &nbsp;
							<button id="save-grid" type="button" class="btn btn-warning waves-effect waves-light">
								<i class="fa fa-save"></i> บันทึกตำแหน่ง
							</button>
						</div>
				</div>
				
				
<?php
for($tab_r=0;$tab_r<2;$tab_r++){
$TAB_RR = array();
if($tab_r==0){
	$TAB_RR[0]["FIELD_G_ID"] = 0;
}else{
$sql_tab = db::query("select FIELD_G_ID,FIELD_G_NAME from WF_FIELD_GROUP WHERE WF_MAIN_ID='".$W."' AND WFD_ID='".$WFD."' AND WF_TYPE = '".$WF_TYPE."' ORDER BY FIELD_G_ORDER ASC");
	$t=0;
	while($TAB1=db::fetch_array($sql_tab)){
		$TAB_RR[$t]["FIELD_G_ID"] = $TAB1["FIELD_G_ID"];
		$TAB_RR[$t]["FIELD_G_NAME"] = $TAB1["FIELD_G_NAME"];
		$t++;
	}
}
$tab_n = 0;

foreach($TAB_RR as $TAB){
	?><div class="card gridframe"><?php
if($TAB["FIELD_G_ID"] != '0'){
?><div class="card-header">
				<h5 class="card-header-text">
					<i class="zmdi zmdi-tab"></i> <?php echo $TAB["FIELD_G_NAME"]; ?>
				</h5>
			</div>
<?php } ?>
				<div class="card-block">
					<div class="loader-block">
						<div class="preloader3 loader-block">
							<div class="circ1"></div>
							<div class="circ2"></div>
							<div class="circ3"></div>
							<div class="circ4"></div>
						</div>
					</div>
					<div class="grid-stack" id="grid<?php echo $tab_n; ?>" data-gs-width="12" data-gs-groupid ="<?php echo $TAB["FIELD_G_ID"]; ?>" >
	<?php
		$sql_form = db::query("select
			WF_STEP_FORM.WFS_ID,
			WF_STEP_FORM.WFD_ID,
			WF_STEP_FORM.WFS_FIELD_NAME,
			WF_STEP_FORM.WFS_COLUMN_TYPE,
			WF_STEP_FORM.WFS_COLUMN_LEFT,
			WF_STEP_FORM.WFS_NAME,
			WF_STEP_FORM.WFS_COLUMN_RIGHT,
			WF_STEP_FORM.WFS_OFFSET,
			WF_STEP_FORM.WFS_ORDER,
			FORM_SYSTEM.FORM_MAIN_NAME,
			FORM_SYSTEM.FORM_MAIN_ICON,
			WF_STEP_FORM.WFS_MASTER_CROSS
		from WF_STEP_FORM
			INNER JOIN FORM_SYSTEM on WF_STEP_FORM.FORM_MAIN_ID = FORM_SYSTEM.FORM_MAIN_ID
		where WF_STEP_FORM.FIELD_G_ID = '".$TAB["FIELD_G_ID"]."' AND WF_STEP_FORM.WF_MAIN_ID = '".$W."' AND WF_STEP_FORM.WF_TYPE= '".$WF_TYPE."' ".$con_form."
		order by WFS_ORDER,WFS_OFFSET");
						while($rec_form = db::fetch_array($sql_form))
						{
							if($rec_form["WFS_COLUMN_TYPE"] == "1")
							{ //1 column
								$width = $rec_form['WFS_COLUMN_LEFT'];
								$min = "";
							}
							else
							{
								$width = $rec_form['WFS_COLUMN_LEFT'] + $rec_form['WFS_COLUMN_RIGHT'];
								if($width > 12)
								{
									$width = 12;
								}
								$min = 'data-gs-min-width="'.($rec_form['WFS_COLUMN_LEFT'] + 1).'"';
							}
							//เช็ค field ใน db
							$field = select_field($rec['WF_MAIN_SHORTNAME'],$rec_form["WFS_FIELD_NAME"]);
							$field_exist = '';
							$field_exist = ($field["FIELD_NAME"] != '' AND ($rec_form['WF_TYPE'] != 'S'))?'Y':'N';
								
							?>
							<div class="grid-stack-item" data-gs-id="<?php echo $rec_form['WFS_ID']; ?>" data-gs-x="<?php echo $rec_form['WFS_OFFSET']; ?>" data-gs-y="<?php echo($rec_form['WFS_ORDER'] - 1); ?>" data-gs-width="<?php echo $width; ?>" data-gs-height="1" <?php echo $min; ?>>
								<div class="grid-stack-item-content">
									<div class="label-main">
										<i class="<?php echo $rec_form['FORM_MAIN_ICON'] ?>"></i> <?php echo $rec_form['WFS_NAME']; ?> <?php if($rec_form['WFS_MASTER_CROSS']=="Y"){ echo "*"; } ?>
										<div class="f-right">
											<button type="button" class="btn btn-mini btn-flat flat-info txt-info waves-effect waves-light" onclick="window.location.href='<?php echo $_url_edit; ?>?process=edit&W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WFS=<?php echo $rec_form['WFS_ID']; ?>'">
												<i class="typcn typcn-pencil"></i></button>
											<button type="button" class="btn btn-mini btn-flat flat-danger txt-danger waves-effect waves-light" onclick="deleteWFS('<?php echo $rec_form['WFS_ID']; ?>','<?php echo $field_exist;?>');">
												<i class="typcn typcn-delete"></i></button>
										</div>
									</div>
									<small id="wfs_<?php echo $rec_form['WFS_ID']; ?>" class="label bg-success">
									<?php if($rec_form["WFS_FIELD_NAME"] != "")
									{ ?>
										
										<i class="fa fa-database"></i> <?php echo $rec_form["WFS_FIELD_NAME"]; ?>
										<?php } ?> <i class="fa fa-edit" data-toggle="modal" data-target="#bizModal" title="แก้ไข Field" onclick="open_modal('setting_step_edit_field.php?W=<?php echo $W;?>&WFS=<?php echo $rec_form['WFS_ID']; ?>&FIELD=<?php echo $rec_form['WFS_FIELD_NAME'];?>&OBJ_HTML=wfs_<?php echo $rec_form['WFS_ID']; ?>&HELP=N','แก้ไข Field');"></i></small>
								</div>
							</div>
						<?php } ?>
						
					</div>
				</div>
			</div>
			
<?php $tab_n++; }
unset($TAB_RR);
} ?>
			</div>
		</div>
	</div>
	<textarea  name="re_order_grid" id="re_order_grid" cols="100" rows="20" style="display:none"></textarea>
	<!-- Row end -->
	<?php if($WF_TYPE == "W"){ ?>
	<!-- Row Starts -->
	<div class="row tab-pane" id="wfdocument" role="tabpanel">
		<div class="col-md-12">
			<div id="doc_list">
				<script type="text/javascript">
					var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $WFD;?>';
					$.ajax({
					 type: "GET",
					 url: "workflow_setting_doc_list.php",
					 data: dataString,
					 cache: false,
					 success: function(html){
						
					  $("#doc_list").html(html);
					  
					 }
					 });

				</script>
			</div>
		</div>
	</div>
	<!-- Row end -->
	<!-- Row Starts -->
	
	<div class="row tab-pane" id="wfprocess" role="tabpanel">
		<div class="col-md-12">
			<div id="step_form_change">
				<script type="text/javascript">
					var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $WFD;?>';
					$.ajax({
					 type: "GET",
					 url: "workflow_step_change.php",
					 data: dataString,
					 cache: false,
					 success: function(html){
					  $("#step_form_change").html(html);
					 }
					 });

				</script>
				
			</div>
		</div>
	</div>
	
	<?php } 
if($WF_TYPE != 'S'){?>
  <div class="row tab-pane" id="wfgroup" role="tabpanel">
		<div class="col-md-12">
			<div id="field_group">
				<script type="text/javascript">
					var dataString = 'W=<?php echo $W;?>&WFD=<?php echo $WFD;?>&WF_TYPE=<?php echo $WF_TYPE;?>';
					$.ajax({
					 type: "GET",
					 url: "workflow_field_group_list.php",
					 data: dataString,
					 cache: false,
					 success: function(html){
					  $("#field_group").html(html);
					 }
					 });

				</script>
			</div>
		</div>
	</div>
<?php }?>
	<!-- Row end -->
</div>
</div>

					<!-- Include step form -->
                </div>
            </div>
		</div>

        <!-- Container-fluid ends -->
     </div>
</div>