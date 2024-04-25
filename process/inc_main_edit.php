<?php
include '../include/comtop_admin.php';
$WF_VIEW_ID = conText($_GET['VIEW']);
$sql_group = db::query("select * from WF_GROUP WHERE WF_TYPE= '".$WF_TYPE."' order by GROUP_ORDER asc");

if($WF_VIEW_ID == ""){
	$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '".$W."' AND WF_TYPE= '".$WF_TYPE."'");
}else{
	$sql = db::query("select * from WF_MAIN_VIEW where WF_MAIN_ID = '".$W."' AND WF_TYPE= '".$WF_TYPE."' AND WF_VIEW_ID ='".$WF_VIEW_ID."' ");	
}
$rec = db::fetch_array($sql);
if($rec["WF_MAIN_ID"] != ""){
	$arr_set_page_pdf = array(""=>"A4-L", "1"=>"A4-P");//, "2"=>"A3-L", "3"=>"A3-P"
	$arr_set_page_word = array(""=>"A4-P", "1"=>"A4-L");//, "2"=>"A3-P", "3"=>"A3-L"
?>
	<!-- Range slider css -->
	<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
    <!-- bash syntaxhighlighter css -->
    <link type="text/css" rel="stylesheet" href="../assets/plugins/highlighter/css/shCoreDjango.css"/>
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row"  id="animationSandbox">
				<div class="col-sm-12">
					<div class="main-header">
						<h4><?php if(conText($_GET['VIEW']) != ""){ echo "View: "; } echo $rec['WF_MAIN_NAME']; ?></h4>
							<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
								<li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a></li>
								<li class="breadcrumb-item"><a href="<?php echo $txt_link_back; ?>"><?php echo $txt_system_sub; ?></a></li>
								<li class="breadcrumb-item"><a href="#">แก้ไข</a></li>
							</ol>
						<div class="f-right">
							<a class="btn btn-primary waves-effect waves-light" href="#view" role="button"  data-toggle="modal" data-target="#bizModal" title="Manage View" onclick="open_modal('workflow_setting_view.php?W_ID=<?php echo $rec["WF_MAIN_ID"]; ?>&VIEW=<?php echo $WF_VIEW_ID; ?>','Manage View');"><i class="icofont icofont-copy-alt"></i> Manage View </a> &nbsp; 
							<a class="btn btn-info waves-effect waves-light" href="search_step_form.php?W=<?php echo $W; ?>&WFD=0" role="button"><i class="icofont icofont-search-alt-2"></i> ตั้งค่าการค้นหา </a> &nbsp; 
							<?php
							$sql_multilang = db::query("SELECT COUNT(LANG_ID) AS NUM FROM WF_LANGUAGE");
							$LN = db::fetch_array($sql_multilang);
							if($LN['NUM'] > 0){
							?><a class="btn btn-warning waves-effect waves-light" href="workflow_setting_lang.php?W=<?php echo $W;?>" role="button" target="_blank">
												<i class="zmdi zmdi-translate"></i> ตั้งค่าภาษา 
										</a> &nbsp; 
							<?php
							}
							if($WF_TYPE == "W"){ 
								 if($rec['WF_MAIN_TYPE'] == "W"){
								?>
							 <a class="btn btn-success waves-effect waves-light" href="workflow_detail.php?W=<?php echo $W; ?>" role="button"><i class="icofont icofont-settings"></i> เพิ่ม/แก้ไข Step </a> &nbsp; 
								 <?php }}else{ 
									if($WF_TYPE == 'M'){?>
										<a class="btn btn-info waves-effect waves-light" href="er.php?W=<?php echo $W;?>" role="button" target="_blank">
												<i class="fa fa-table"></i>  ER 
										</a> &nbsp;
							<?php			
									} 
							if($rec['WF_TYPE'] != 'R'){ ?> 
							<a class="btn btn-success waves-effect waves-light" href="<?php echo $txt_link_field; ?>?W=<?php echo $W; ?>&WFD=0" role="button"><i class="icofont icofont-settings"></i> ตั้งค่า Field </a> &nbsp; 
							<?php }else{ ?><a href="#!" onClick="PopupCenter('../workflow/report_main.php?W=<?php echo $W; ?>', 'Preview', (window.innerWidth-60), window.innerHeight) ;"  class="btn btn-info" href="#primary" ><i class="fa fa-search"></i> ดูหน้าจอ</a> 
							<?php }} ?>
							<a class="btn btn-danger waves-effect waves-light" href="<?php echo $txt_link_back; ?>" role="button"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ </a>
						</div>
					</div>
				</div>
			</div>
            <!-- Row end -->
			<form action="workflow_function.php" method="post" enctype="multipart/form-data" id="form_wf" autocomplete="off" onsubmit="return save_pos('data_position');">
				<input type="hidden" name="process" id="process" value="edit">
				<input type="hidden" name="id" id="id" value="<?php echo $W; ?>">
				<input type="hidden" name="WF_TYPE" id="WF_TYPE" value="<?php echo $WF_TYPE; ?>">
				<input type="hidden" name="WF_VIEW_ID" id="WF_VIEW_ID" value="<?php echo $WF_VIEW_ID ; ?>">
			<div class="row">
				<div class="col-lg-12">
				<div class="card">

				 <!-- Radio-Button start -->
				<div class="card-block tab-icon">  
					<!-- Nav tabs -->
					<ul class="nav nav-tabs md-tabs " role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"><i class="icofont icofont-ui-edit"></i>ข้อมูลทั่วไป</a>
							<div class="slide"></div>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tab2" role="tab"><i class="icofont icofont-ui-theme"></i> ตั้งค่าการแสดงผลหน้าเว็บไซต์</a>
							<div class="slide"></div>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tab3" role="tab"><i class="icofont icofont-ui-lock"></i> ตั้งค่าสิทธิ์</a>
							<div class="slide"></div>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tab4" role="tab"><i class="icofont icofont-ui-touch-phone"></i> ตั้งค่าการแสดงผลในมือถือ</a>
							<div class="slide"></div>
						</li>

					</ul>
					<!-- Tab panes -->
			<!-- Tab panes -->
            <div class="tab-content">

			<!-- Row Starts -->
            <div class="row tab-pane active" id="tab1" role="tabpanel">
                <div class="col-md-8">
					<div class="card_bk">
						<div class="card-header"><h5 class="card-header-text">
								<i class="typcn typcn-message"></i> ข้อมูลทั่วไป</h5>
							<div class="f-right">
								<label for="WF_MAIN_STATUS" class="custom-control custom-checkbox">
									<input type="checkbox" name="WF_MAIN_STATUS" id="WF_MAIN_STATUS" class="custom-control-input" value="Y" <?php echo $rec['WF_MAIN_STATUS'] == 'Y' ? 'checked' : ''; ?>>
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description">เปิดใช้งาน</span>
								</label>
							</div>
						</div>
						<div class="card-block">
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WF_MAIN_NAME" class="form-control-label wf-right">ชื่อ<span class="text-danger">*</span>
									</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" name="WF_MAIN_NAME" id="WF_MAIN_NAME" placeholder="ตั้งชื่อ" required value="<?php echo $rec['WF_MAIN_NAME']; ?>">
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WF_MAIN_REMARK" class="form-control-label wf-right">รายละเอียด</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" name="WF_MAIN_REMARK" id="WF_MAIN_REMARK" placeholder="" value="<?php echo $rec['WF_MAIN_REMARK']; ?>">
									 <small  class="form-text text-muted">รายละเอียดจะแสดงในส่วนของ Data Dictionary</small>
								</div>
								
							</div>
							<!---->
						<?php
						if($rec['WF_TYPE'] != 'R'){
							if($rec['WF_MAIN_TYPE'] != 'L' AND $rec['WF_MAIN_TYPE'] != 'R'){
							?>
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WF_MAIN_SHORTNAME" class="form-control-label wf-right">ตารางที่เก็บข้อมูล<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-9">
									<span id="table_name"><label class="label bg-primary"><i class="typcn typcn-database"></i> <?php echo $rec['WF_MAIN_SHORTNAME']; ?></label>
									<button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#bizModal" title="แก้ไขชื่อตาราง" onclick="open_modal('edit_tablename.php?table=<?php echo $rec["WF_MAIN_SHORTNAME"];?>&WF_TYPE=<?php echo $WF_TYPE;?>&W=<?php echo $W;?>','แก้ไขชื่อตาราง');"><i class="icofont icofont-edit-alt"></i></button></span>
								</div>
							</div>
						<?php }} ?>
							<!---->
							<div class="form-group row">
								<div class="col-md-3">
									<label for="WF_GROUP_ID" class="form-control-label wf-right">กลุ่ม
										<span class="text-danger">*</span></label>
								</div>
								<div class="col-md-7">
									<select name="WF_GROUP_ID" id="WF_GROUP_ID" class="select2" required aria-required="true" placeholder="เลือก...">
										<option value=""></option>
										<?php while($rec_group = db::fetch_array($sql_group)){ ?>
											<option value="<?php echo $rec_group['GROUP_ID']; ?>" <?php echo $rec['WF_GROUP_ID'] == $rec_group['GROUP_ID'] ? 'selected' : ''; ?>><?php echo $rec_group['GROUP_NAME']; ?></option>
										<?php } ?>
									</select>
								</div> 
							</div>
							<!---->	
							 
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label wf-right">ประเภท</label>
								</div>
								<div class="col-md-9"> 
									<div class="form-radio">
										<div class="radio"> <!-- radio-inline -->
											<label>
												<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE1" value="W" onclick="show_div_url(this.value);" <?php echo $rec['WF_MAIN_TYPE'] == 'W' ? 'checked' : ''; ?>>
												<i class="helper"></i> Smart <?php echo $smart; ?>
											</label>
										</div>
										<?php if($WF_TYPE == "R"){?>
										<div class="radio"> <!-- radio-inline -->
											<label>
												<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE1" value="D" onclick="show_div_url(this.value);" <?php echo $rec['WF_MAIN_TYPE'] == 'D' ? 'checked' : ''; ?>>
												<i class="helper"></i> Smart Dashboard
											</label>
										</div>
										<div class="radio"> 
											<label>
												<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE1" value="C" onclick="show_div_url(this.value);" <?php echo $rec['WF_MAIN_TYPE'] == 'C' ? 'checked' : ''; ?>>
												<i class="helper"></i> Smart Calendar
											</label>
										</div>
										<div class="radio"> 
											<label>
												<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE1" value="K" onclick="show_div_url(this.value);" <?php echo $rec['WF_MAIN_TYPE'] == 'K' ? 'checked' : ''; ?>>
												<i class="helper"></i> Smart Kanban
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE2" value="S" onclick="show_div_url(this.value);" <?php echo $rec['WF_MAIN_TYPE'] == 'S' ? 'checked' : ''; ?>>
												<i class="helper"></i> Services
											</label>
										</div>
										
										<?php } ?>
										<div class="radio">
											<label>
												<input type="radio" name="WF_MAIN_TYPE" id="WF_MAIN_TYPE2" value="L" onclick="show_div_url(this.value);" <?php echo $rec['WF_MAIN_TYPE'] == 'L' ? 'checked' : ''; ?>>
												<i class="helper"></i> External Link
											</label>
										</div>
									</div>
									
								</div>
							</div> 
							<!---->
							
							<div class="form-group row" id="DIV_WF_SERVICES_TYPE" style="display: none;">
								<div class="col-md-3">
									<label class="form-control-label wf-right">Services Type</label>
								</div>
								<div class="col-md-7">
									<select name="WF_SERVICES_TYPE" id="WF_SERVICES_TYPE" class="select2">
										<option value="" <?php if($rec['WF_SERVICES_TYPE'] == ''){ echo "selected";} ?>>JSON</option>
										<option value="1" <?php if($rec['WF_SERVICES_TYPE'] == '1'){ echo "selected";} ?>>SOAP</option>
									</select>
								</div>
							</div>
							
							<div class="form-group row" id="DIV_WF_MAIN_URL" style="display: none;">
								<div class="col-md-3">
									<label for="WF_MAIN_URL" class="form-control-label wf-right">URL External Link</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" name="WF_MAIN_URL" id="WF_MAIN_URL" placeholder="URL" value="<?php echo $rec['WF_MAIN_URL']; ?>">
								</div>
							</div>
							<?php if($WF_TYPE == 'W'){ ?>
							<div class="form-group row"  >
								<div class="col-md-3">
									<label class="form-control-label wf-right">Public Short URL</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control text-danger" style="font-size:11px;" value="../public/workflow.php?wfp=W<?php echo base64_encode(wf_encode('@#BizSmartFlow#S#'.$W.'#NS'));?>" readonly="true">
								</div>
							</div>
							<div class="form-group row"  >
								<div class="col-md-3">
									<label class="form-control-label wf-right">Public Full URL</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control text-danger" style="font-size:11px;" value="<?php echo $WF_URL; ?>public/workflow.php?wfp=W<?php echo base64_encode(wf_encode('@#BizSmartFlow#S#'.$W.'#NS'));?>" readonly="true">
								</div>
							</div>
							<div class="form-group row"  >
								<div class="col-md-3">
									<label for="WF_PUPLIC_S_URL" class="form-control-label wf-right">(กรณี Public URL)<br />Url เมื่อบันทึกเสร็จ</label>
								</div>
								<div class="col-md-9">
									<input type="text" name="WF_PUPLIC_S_URL" class="form-control" value="<?php echo $rec['WF_PUPLIC_S_URL']; ?>" >
								</div>
							</div>
							<!---->
							<?php
							}
							if($WF_TYPE != 'R' AND $WF_TYPE != 'W'){
							?>
							<div class="form-group row">
								<div class="col-md-3">
								</div>
								<div class="col-md-5">
									<div class="checkbox-color checkbox-primary">
										<input name="WF_MAIN_TAB_STATUS" id="WF_MAIN_TAB_STATUS" type="checkbox" value="Y" <?php echo $rec['WF_MAIN_TAB_STATUS'] == 'Y' ? 'checked' : ''; ?>>
										<label for="WF_MAIN_TAB_STATUS">
											ใช้งาน Tab ในหน้า form
										</label>
									</div>
								</div>
							</div>
							<?php } 
							if($WF_TYPE == 'M'){
							?>
							<div class="form-group row" id="DIV_WF_PARENT_USE" style="display:none;">
								<div class="col-md-3">
									<label for="WF_PARENT_USE" class="form-control-label wf-right">Parent-Child</label>
								</div>
								<div class="col-md-7">
									<select name="WF_PARENT_USE" id="WF_PARENT_USE" class="select2" aria-required="true" placeholder="เลือก" onchange="show_div_parent(this.value);">
										<option value="" <?php if($rec['WF_PARENT_USE'] == ''){ echo "selected"; } ?>>ไม่ใช้งาน</option>
										<option value="2" <?php if($rec['WF_PARENT_USE'] == 2){ echo "selected"; } ?>>ใช้งาน</option>
										<!--<option value="3" <?php if($rec['WF_PARENT_USE'] == 3){ echo "selected"; } ?>>Parent Child Advance</option>-->
									</select>
								</div> 
							</div>
							
							<div class="form-group row" id="DIV_WF_PARENT_FIELD" style="display: none;">
								<div class="col-md-3">
									<label for="WF_PARENT_FIELD" class="form-control-label wf-right">ชื่อ Field Parent <span class="text-danger">*</span></label>
								</div>
								<div class="col-md-7">
									<select name="WF_PARENT_FIELD" id="WF_PARENT_FIELD" class="select2">
										<option value="">กรุณาเลือก</option>
										<?php 
										$WF_ARR_FIELD = db::show_field($rec['WF_MAIN_SHORTNAME']);
										if(count($WF_ARR_FIELD) > 0){
											foreach($WF_ARR_FIELD as $key => $fields_name){
												?>
												<option value="<?php echo $fields_name;?>" <?php if($rec['WF_PARENT_FIELD'] == $fields_name){ echo "selected"; } ?>><?php echo $fields_name;?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							
							<div class="form-group row" id="DIV_WF_PARENT_SHOW" style="display: none;">
								<div class="col-md-3">
									<label for="WF_PARENT_SHOW" class="form-control-label wf-right">การแสดงผลของ Parent <span class="text-danger">*</span></label>
								</div>
								<div class="col-md-7">
									<input type="text" name="WF_PARENT_SHOW" id="WF_PARENT_SHOW" value="<?php echo $rec['WF_PARENT_SHOW'];?>" class="form-control">
									<small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
								</div>
							</div>
							
							<?php }?>
							<!---->
						</div>
					</div>
                </div>

				<div class="col-md-4">
					<div class="card_bk">
						<div class="card-header">
							<h5 class="card-header-text"><i class="typcn typcn-th-large-outline"></i> ICON</h5>
							<div class="f-right">
							<small  class="form-text text-muted"><i class="ion-information-circled"></i> Path สำหรับเก็บไฟล์ : ../icon </small>
							</div>
						</div>
						<div class="table-responsive dasboard-4-table-scroll">
							<div class="table-content">
								<div class="project-table p-20">
									
									<table id="product-list" class="table dt-responsive nowrap" width="100%" cellspacing="0">
										<tbody>
											<tr>
											<?php
											$icon = 0;
											if( $dh = opendir("../icon"))
											{
												while(false !== ($file = readdir($dh)))
												{
													if($file == '.' || $file == '..')
													{
														continue;
													}
													else
													{
														if($rec['WF_MAIN_ICON'] == $file)
														{
															$checked_img = "checked";
															$checked_highlight = "bg-gray";
														}
														else
														{
															$checked_img = "";
															$checked_highlight = "";
														}
														?>
												<td class="pro-name text-center <?php echo $checked_highlight; ?>">
													<label>
														<div><img src="../icon/<?php echo $file; ?>" /></div>
														<input type="radio" name="WF_MAIN_ICON" id="WF_MAIN_ICON"  value="<?php echo $file; ?>" <?php echo $checked_img ?>> <?php echo $file; ?>
													</label>
												</td>
														<?php
														$icon++;
														if($icon%3==0){ echo "</tr><tr>"; }
													}
												}
												closedir($dh);
											}
											?>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="card-block">
							<!---->
							<hr />
							<label for="UPLOAD_FILE" class="form-control-label">หรือเลือก Icon จากในเครื่อง</label>
							<div class="md-group-add-on">
								
								  <span class="md-add-on-file">
									  <button class="btn btn-primary waves-effect waves-light"><i class="typcn typcn-image-outline"></i> เลือก Icon</button>
								  </span>
								<div class="md-input-file">
									<input type="file" name="UPLOAD_FILE" id="UPLOAD_FILE" class="" accept="image/png"/>
									<input type="text" class="md-form-control md-form-file">
									<label class="md-label-file"></label>
								</div>
								  <small  class="form-text text-muted">เฉพาะไฟล์นามสกุล PNG  ขนาดที่เหมาะสม 65 X 65</small>
							  </div>
							<!---->
						</div>
					</div>
				</div>

            </div>
            <!-- Row end -->
			<?php
			$WF_VIEW_COL_HEADER = conText($rec['WF_VIEW_COL_HEADER']);
			if($WF_VIEW_COL_HEADER != ""){
			$WF_VIEW_COL_DATA = $rec['WF_VIEW_COL_DATA'];
			$WF_VIEW_COL_ALIGN = $rec['WF_VIEW_COL_ALIGN'];
			$WF_VIEW_COL_SIZE = $rec['WF_VIEW_COL_SIZE'];
			/*if($WF_TYPE=="R"){
			$WF_VIEW_COL_ORDER = $rec['WF_R_TOTAL'];
			}else{
			$WF_VIEW_COL_ORDER = $rec['WF_VIEW_COL_ORDER'];
			}*/
			$WF_R_TOTAL = $rec['WF_R_TOTAL'];
			$WF_VIEW_COL_ORDER = $rec['WF_VIEW_COL_ORDER'];
			$WF_VIEW_COL_DRILL = $rec['WF_VIEW_COL_DRILL'];
			$WF_VIEW_COL_FORMAT = $rec['WF_VIEW_COL_FORMAT'];
			
			$fi = explode("|",$WF_VIEW_COL_HEADER);
			$va = explode("|",$WF_VIEW_COL_DATA);
			$al = explode("|",$WF_VIEW_COL_ALIGN);
			$wi = explode("|",$WF_VIEW_COL_SIZE);
			$or = explode("|",$WF_VIEW_COL_ORDER);
			$dr = explode("|",$WF_VIEW_COL_DRILL);
			$fo = explode("|",$WF_VIEW_COL_FORMAT);
			$total = explode("|",$WF_R_TOTAL);
			$column = count($fi);
			}
			?>
			<!-- Row Starts -->
            <div class="row tab-pane" id="tab2" role="tabpanel">
                <div class="col-md-12">
                    <div class="card_bk">
						<?php
						if($rec['WF_TYPE'] == 'R' AND $rec['WF_MAIN_TYPE'] == "C"){ ?>
							<div class="card-header">
								<div class="form-group row">
									<div id="calendar_list"></div>	
									
									<script type="text/javascript">
										var dataString = 'W=<?php echo $W;?>';
										$.ajax({
											type: "GET",
											url: "workflow_calendar.php",
											data: dataString,
											cache: false,
											success: function(html){
											
												$("#calendar_list").html(html);
										  
											}
										});
										function delete_cal(id){
											if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){	
												
												var dataString = 'process=delete&W=<?php echo $W;?>&id='+id;
												$.ajax({
													type: "POST",
													url: "workflow_calendar_function.php",
													data: dataString,
													cache: false,
													success: function(html){
														$("#tr_"+id).hide();
													}
												});
											}
										}
									</script>
								</div>
							</div>
							<?php 
						}
						
						if($rec['WF_TYPE'] == 'R' AND $rec['WF_MAIN_TYPE'] == "K"){ ?>
							<div class="card-header">
								<div class="form-group row">
									<div id="kanban_list"></div>	
									
									<script type="text/javascript">
										var dataString = 'W=<?php echo $W;?>';
										$.ajax({
											type: "GET",
											url: "workflow_kanban.php",
											data: dataString,
											cache: false,
											success: function(html){
												$("#kanban_list").html(html);
											}
										});
										function delete_kan(id){
											if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){	
												
												var dataString = 'process=delete&W=<?php echo $W;?>&id='+id;
												$.ajax({
													type: "POST",
													url: "workflow_kanban_function.php",
													data: dataString,
													cache: false,
													success: function(html){
														$("#tr_"+id).hide();
													}
												});
											}
										}
										function delete_kan_list(id){
											if(confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?')){	
												
												var dataString = 'process=delete&W=<?php echo $W;?>&id='+id;
												$.ajax({
													type: "POST",
													url: "workflow_kanban_list_function.php",
													data: dataString,
													cache: false,
													success: function(html){
														$("#tr_k_list_"+id).hide();
													}
												});
											}
										}
										function save_order_kan_group(wfd){
											var url = "workflow_kanban_function.php";
											$.ajax({
											   type: "POST",
											   url: url,
											   data: $("#wf_kanban_group").serialize(),
											   success: function(data)
											   {
													if(data == 'Y'){
														swal({
															title: "บันทึกตำแหน่งเรียบร้อยแล้ว", 
															type: "success",
															allowOutsideClick:true
														});
													}			 
												}
											});
											e.preventDefault(); // avoid to execute the actual submit of the form. 
										}
									</script>
								</div>
							</div>
							<?php 
						}
					
					if($check_data == ""){
							if($rec['WF_TYPE'] == 'R'){ ?>
						<div class="card-header" <?php if($rec['WF_TYPE'] == 'R' AND ($rec['WF_MAIN_TYPE'] == "C" OR $rec['WF_MAIN_TYPE'] == "K")){ echo 'style="display:none"'; } ?>>	
							<div class="form-group row"> 
								<div class="col-md-6">
									<div class="form-radio">
										<div class="radio"> <!-- radio-inline -->
											<label>
												<input type="radio" name="WF_MAIN_SEARCH" id="WF_MAIN_SEARCH1" value="1" <?php echo ($rec['WF_MAIN_SEARCH'] == '1' OR $rec['WF_MAIN_SEARCH'] == '') ? 'checked' : ''; ?>>
												<i class="helper"></i> ดึงข้อมูลจาก
											</label>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<select name="WF_MAIN_ID_SEARCH" id="WF_MAIN_ID_SEARCH" class="select2 form-control" onchange="change_report_connected(this.value);">
													<option value="">ไม่เลือก</option>
													<option value="" disabled>ข้อมูล Master</option>
													<?php
													$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'M' ORDER BY WF_MAIN_ORDER");
													
													while($rec_m = db::fetch_array($sql_list)){	?>
														<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['WF_MAIN_ID_SEARCH'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
													<?php } ?>
													<option value="" disabled>ข้อมูล Workflow</option>
													<?php
													$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W' ORDER BY WF_MAIN_ORDER");
													
													while($rec_m = db::fetch_array($sql_list)){?>
														<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['WF_MAIN_ID_SEARCH'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
													<?php } ?>
													<option value="" disabled>ข้อมูล Form</option>
													<?php
													$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'F' ORDER BY WF_MAIN_ORDER");
													
													while($rec_m = db::fetch_array($sql_list)){?>
														<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['WF_MAIN_ID_SEARCH'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
													<?php } ?> 
													<option value="" disabled>ข้อมูล Report</option>
													<?php
													$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'R' ORDER BY WF_MAIN_ORDER");
													
													while($rec_m = db::fetch_array($sql_list)){?>
														<option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec['WF_MAIN_ID_SEARCH'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?></option>
													<?php } ?> 
												</select>
												<script>
	function change_report_connected(w_connect){
		var url = 'option_report.php';
		var dataString = {W_ID: w_connect, W:'<?php echo $W; ?>'};
		$.get(url, dataString, function(msg){
			$('#report_area_type').html(msg);
		});	
	}
	<?php if($rec['WF_MAIN_ID_SEARCH'] != ""){ echo "change_report_connected('".$rec['WF_MAIN_ID_SEARCH']."');"; } ?>
												</script>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
											<label for="WF_R_SQL" class="form-control-label ">SQL เงื่อนไขเพิ่มเติม</label>
												<textarea name="WF_R_SQL" id="WF_R_SQL" class="form-control"><?php echo $rec['WF_R_SQL']; ?></textarea>
											</div>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="WF_MAIN_SEARCH" id="WF_MAIN_SEARCH2" value="2" <?php echo $rec['WF_MAIN_SEARCH'] == '2' ? 'checked' : ''; ?>>
												<i class="helper">
												</i> เขียน Sql เอง
											</label>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<textarea name="WF_MAIN_SEARCH_SQL" id="WF_MAIN_SEARCH_SQL" class="form-control"><?php echo $rec['WF_MAIN_SEARCH_SQL']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
								<!---->
								<div class="col-md-6" id="report_area_type">
										
								</div>
							</div>
						</div>
					<?php }
					
						if($rec['WF_TYPE'] == 'W' OR $rec['WF_TYPE'] == 'M'){?>
						<div class="card-header">	
							<div class="form-group row"> 
								<div class="col-md-12">
									<div class="form-radio">
										<div class="radio"> <!-- radio-inline -->
											<label>
												<input type="radio" name="WF_MAIN_SEARCH" id="WF_MAIN_SEARCH1" value="1" <?php echo ($rec['WF_MAIN_SEARCH'] == '1' OR $rec['WF_MAIN_SEARCH'] == '') ? 'checked' : ''; ?>>
												<i class="helper"></i> ดึงข้อมูลจาก <?php echo $rec["WF_MAIN_SHORTNAME"];?>
											</label>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
											<label for="WF_R_SQL" class="form-control-label ">SQL เงื่อนไขเพิ่มเติม</label>
												<textarea name="WF_R_SQL" id="WF_R_SQL" class="form-control"><?php echo $rec['WF_R_SQL']; ?></textarea>
											</div>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="WF_MAIN_SEARCH" id="WF_MAIN_SEARCH2" value="2" <?php echo $rec['WF_MAIN_SEARCH'] == '2' ? 'checked' : ''; ?>>
												<i class="helper">
												</i> เขียน Sql เอง
											</label>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<textarea name="WF_MAIN_SEARCH_SQL" id="WF_MAIN_SEARCH_SQL" class="form-control"><?php echo $rec['WF_MAIN_SEARCH_SQL']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
								<!---->
							</div>
						</div>
					<?php }?>

                        <div class="card-header"  <?php if($rec['WF_TYPE'] == 'R' AND ($rec['WF_MAIN_TYPE'] == "C" OR $rec['WF_MAIN_TYPE'] == "K")){ echo 'style="display:none"'; } ?>>
							<h5 class="card-header-text"><i class="typcn typcn-device-desktop"></i> ตั้งค่าการแสดงผลหน้าเว็บไซต์</h5><?php if($WF_TYPE=="R"){ echo "<br />หากกำหนดเป็นรูปแบบ xy คอลัมน์ 1 และ 2 จะเป็นการตั้งค่าการแสดงผล"; } ?>
							<div class="f-right">
								<button type="button" onClick="addACol('data_position');" class="btn btn-success waves-effect waves-light"><i class="icofont icofont-ui-add"></i> เพิ่มคอลัมน์
								</button>
							</div>
                        </div>
                        <div class="card-block" <?php if($rec['WF_TYPE'] == 'R' AND ($rec['WF_MAIN_TYPE'] == "C" OR $rec['WF_MAIN_TYPE'] == "K")){ echo 'style="display:none"'; } ?>>
							<!---->
							<div class="table-responsive" data-pattern="priority-columns">
							<table id="data_position" class='table table-bordered'>
								<thead class='sorted_head' style="cursor:move">
								  <tr class="bg-primary">
									<td style="cursor:default;">
										&nbsp;
									</td>
									<?php for($c=0;$c<$column;$c++){ ?>
									<th>ลำดับที่ <?php echo ($c+1); ?></th>
									<?php } ?>
								  </tr>
								</thead>
								<tbody>
								 <tr class="text-center">
									<th>หัวตาราง</th>
									<?php for($c=0;$c<$column;$c++){ ?>
									<td><input type="text" id="fi_val" class="form-control fi_val" value="<?php echo $fi[$c]; ?>"></td>
									<?php } ?>
								  </tr>
								  <tr class="text-center">
									<th>การแสดงข้อมูล*<small class="form-text text-muted">Table Field ให้ใช้ ##FIELD!!</small>
									<small class="form-text text-muted">ใส่ @&lt;file&gt; สำหรับ include ไฟล์จาก folder ../plugin</small>
									</th>
									<?php for($c=0;$c<$column;$c++){ ?>
									<td><textarea id="va_val" class="form-control va_val"><?php echo $va[$c]; ?></textarea></td>
									<?php } ?>
								  </tr>
								  <tr class="text-center">
									<th>จัดตำแหน่ง</th>
									  <?php for($c = 0;$c < $column;$c++)
									  { ?>
										  <td class="text-left"><select id="al_val" class="form-control">
												  <option value="L" <?php if($al[$c] == "L")
												  {
													  echo "selected";
												  } ?>>ชิดซ้าย
												  </option>
												  <option value="C" <?php if($al[$c] == "C")
												  {
													  echo "selected";
												  } ?>>ตรงกลาง
												  </option>
												  <option value="R" <?php if($al[$c] == "R")
												  {
													  echo "selected";
												  } ?>>ชิดขวา
												  </option>
											  </select></td>
									  <?php } ?>
								  </tr>
								  <tr>
									<th>ขนาด</th>
									<?php for($c=0;$c<$column;$c++){ ?>
									<td><input type="text" id="wi_val" class="form-control text-right" value="<?php echo $wi[$c]; ?>"></td>
									<?php } ?>
								  </tr>
								  <!--<tr class="text-center">
									<th><?php if($WF_TYPE=="R"){ ?><label for="WF_R_TOTAL_USE" class="custom-control custom-checkbox"><input type="checkbox" name="WF_R_TOTAL_USE" id="WF_R_TOTAL_USE" class="custom-control-input" value="Y" <?php if($rec['WF_R_TOTAL_USE'] == 'Y' ){ echo 'checked';} ?>><span class="custom-control-indicator"></span>
											<span class="custom-control-description"> แสดงรวม</span></label><?php }else{ ?>การเรียงลำดับ<small class="form-text text-muted">Table Field ใส่ชื่อ Field ได้เลย</small><?php } ?></th>
									<?php for($c=0;$c<$column;$c++){ ?>
									<td><input type="text" id="or_val" class="form-control or_val" value="<?php echo $or[$c]; ?>"></td>
									<?php } ?>
								  </tr>-->
								  <tr class="text-center">
									<th>
										การเรียงลำดับ<small class="form-text text-muted">Table Field ใส่ชื่อ Field ได้เลย</small></th>
									<?php for($c=0;$c<$column;$c++){ ?>
									<td><input type="text" id="or_val" class="form-control or_val" value="<?php echo $or[$c]; ?>"></td>
									<?php } ?>
								  </tr>
								  <tr class="text-center">
									<th>
										<label for="WF_R_TOTAL_USE" class="custom-control custom-checkbox"><input type="checkbox" name="WF_R_TOTAL_USE" id="WF_R_TOTAL_USE" class="custom-control-input" value="Y" <?php if($rec['WF_R_TOTAL_USE'] == 'Y' ){ echo 'checked';} ?>><span class="custom-control-indicator"></span>
											<span class="custom-control-description"> รวม**</span></label>
									</th>
									<?php for($c=0;$c<$column;$c++){ ?>
									<td><input type="text" id="total_val" class="form-control" value="<?php echo $total[$c]; ?>"></td>
									<?php } ?>
								  </tr>
								  <?php if($WF_TYPE=="R"){ ?>
								  <tr>
									<th>Format***</th>
									<?php for($c=0;$c<$column;$c++){ ?>
									<td><input type="text" id="fo_val" class="form-control" value="<?php echo $fo[$c]; ?>"></td>
									<?php } ?>
								  </tr>
								  <tr>
									<th>DrillDown</th>
									<?php for($c=0;$c<$column;$c++){ ?>
									<td><input type="text" id="dr_val" class="form-control" value="<?php echo $dr[$c]; ?>"></td>
									<?php } ?>
								  </tr>
								  <?php } ?>
								  <tr class="text-center">
									<th></th>
									  <?php for($c=0;$c<$column;$c++){ ?>
									  <td><button type="button" onClick="del('data_position',<?php echo $c; ?>);" class="btn btn-danger waves-effect btn-mini"><i class="icofont icofont-ui-close"></i> ลบ</button></td>
									  <?php } ?>
								  </tr>
								</tbody>
							  </table>
							  </div>
						<?php if($WF_TYPE=="R"){ ?>
						<div class="card-header"  <?php if($rec['WF_TYPE'] == 'R' AND ($rec['WF_MAIN_TYPE'] == "C" OR $rec['WF_MAIN_TYPE'] == "K")){ echo 'style="display:none"'; } ?>>
							<div class="form-group row">
								<div class="col-md-12">
									 <label for="WF_R_SCOL_USE" class="custom-control custom-checkbox"><input type="checkbox" name="WF_R_SCOL_USE" id="WF_R_SCOL_USE" class="custom-control-input" value="Y" <?php if($rec['WF_R_SCOL_USE'] == 'Y' ){ echo 'checked';} ?> onClick="rsumc(this);"><span class="custom-control-indicator"></span>
									<span class="custom-control-description"> ตั้งค่ารวมคอลัมน์ในตาราง (ขวามือ)</span></label>
								</div>
							</div>
							<div id="RSUMCOL" class="form-group row" <?php if($rec['WF_R_SCOL_USE'] != 'Y' ){ echo 'style="display:none;"';} ?>>
								<div class="col-md-2">
									<label  for="WF_R_SCOL_TEXT" class="block form-control-label">ข้อความ</label>
									<input name="WF_R_SCOL_TEXT" id="WF_R_SCOL_TEXT" type="text" class="form-control" value="<?php echo $rec['WF_R_SCOL_TEXT']; ?>">
								</div>
								<div class="col-md-2">
									<label  for="WF_R_SCOL_TOTAL" class="block form-control-label">การแสดงข้อมูลรวม **</label>
									<input name="WF_R_SCOL_TOTAL" id="WF_R_SCOL_TOTAL" type="text" class="form-control" value="<?php echo $rec['WF_R_SCOL_TOTAL']; ?>">
								</div>
								<div class="col-md-2">
									<label  for="WF_R_SCOL_ALIGN" class="block form-control-label">ตำแหน่ง</label>
									<select name="WF_R_SCOL_ALIGN" id="WF_R_SCOL_ALIGN" class="form-control">
										  <option value="L" <?php if($rec['WF_R_SCOL_ALIGN'] == "L"){
											  echo "selected";
										  } ?>>ชิดซ้าย</option>
										  <option value="C" <?php if($rec['WF_R_SCOL_ALIGN'] == "C"){
											  echo "selected";
										  } ?>>ตรงกลาง</option>
										  <option value="R" <?php if($rec['WF_R_SCOL_ALIGN'] == "R"){
											  echo "selected";
										  } ?>>ชิดขวา</option>
									  </select>
								</div>
								<div class="col-md-2">
									<label  for="WF_R_SCOL_SIZE" class="block form-control-label">ขนาด</label>
									<input name="WF_R_SCOL_SIZE" id="WF_R_SCOL_SIZE" type="text" class="form-control" value="<?php echo $rec['WF_R_SCOL_SIZE']; ?>">
								</div>
								<div class="col-md-2">
									<label  for="WF_R_SCOL_FORMAT" class="block form-control-label">Format***</label>
									<input name="WF_R_SCOL_FORMAT" id="WF_R_SCOL_FORMAT" type="text" class="form-control" value="<?php echo $rec['WF_R_SCOL_FORMAT']; ?>">
								</div> 	 								
								<div class="col-md-2">
									<label  for="WF_R_SCOL_DRILL" class="block form-control-label">DrillDown</label>
									<input name="WF_R_SCOL_DRILL" id="WF_R_SCOL_DRILL" type="text" class="form-control" value="<?php echo $rec['WF_R_SCOL_DRILL']; ?>">
								</div> 
							</div>
							<script type="text/javascript">
							function rsumc(c){
								if(c.checked==true){
									$('#RSUMCOL').show();
								}else{
									$('#RSUMCOL').hide();
								}
							}
							</script>
						</div>
							<div class="form-group row"  <?php if($rec['WF_TYPE'] == 'R' AND ($rec['WF_MAIN_TYPE'] == "C" OR $rec['WF_MAIN_TYPE'] == "K")){ echo 'style="display:none"'; } ?>>
								<div class="col-md-12">
									หมายเหตุ : <br />*การคำนวณในคอลัมน์ จะต้องขึ้นต้นด้วย "=" โดยตัวแปรมีดังนี้  <br />"$F1" จะแทนค่าของ คอลัมน์ที่ 1, "$SR" = ค่ารวมของแต่ละแถว, "$SC1" = ค่ารวมของคอลัมน์ที่ 1, "$CR" = จำนวนแถวทั้งหมด<br />
									** สัญญลักษณ์การรวม ประกอบด้วย <br />"S0":รวมแสดงเป็นจำนวนเต็ม, "S1":รวมแสดงเป็นทศนิยม 1 ตำแหน่ง, "S2":รวมแสดงเป็นทศนิยม 2 ตำแหน่ง, "S3":รวมแสดงเป็นทศนิยม 3 ตำแหน่ง,<br />"A0":ค่าเฉลี่ยแสดงเป็นจำนวนเต็ม, "A1":ค่าเฉลี่ยแสดงเป็นทศนิยม 1 ตำแหน่ง, "A2":ค่าเฉลี่ยแสดงเป็นทศนิยม 2 ตำแหน่ง, "A3":ค่าเฉลี่ยแสดงเป็นทศนิยม 3 ตำแหน่ง, <br />"C":นับจำนวน<br />
									***การตั้งค่า  Format หากต้องการใส่เป็นตัวเลข ทศนิยม 2 ตำแหน่ง ให้ใส่ "N2" หากมีคำลงท้าย ให้ใส่ + หลังจาก Format
								</div>
							</div>
					<?php } ?>
							<!---->	
							<input type="hidden" name="WF_VIEW_COL_HEADER" id="WF_VIEW_COL_HEADER" class="form-control" value="<?php echo $WF_VIEW_COL_HEADER; ?>">
							<input type="hidden" name="WF_VIEW_COL_DATA" id="WF_VIEW_COL_DATA" class="form-control" value="<?php echo $WF_VIEW_COL_DATA; ?>">
							<input type="hidden" name="WF_VIEW_COL_ALIGN" id="WF_VIEW_COL_ALIGN" class="form-control" value="<?php echo $WF_VIEW_COL_ALIGN; ?>">
							<input type="hidden" name="WF_VIEW_COL_SIZE" id="WF_VIEW_COL_SIZE" class="form-control" value="<?php echo $WF_VIEW_COL_SIZE; ?>">
							<input type="hidden" name="WF_VIEW_COL_ORDER" id="WF_VIEW_COL_ORDER" class="form-control" value="<?php echo $WF_VIEW_COL_ORDER; ?>">
							<input type="hidden" name="WF_R_TOTAL" id="WF_R_TOTAL" class="form-control" value="<?php echo $WF_R_TOTAL; ?>">
							<input type="hidden" name="WF_VIEW_COL_FORMAT" id="WF_VIEW_COL_FORMAT" class="form-control" value="<?php echo $WF_VIEW_COL_FORMAT; ?>">
							<input type="hidden" name="WF_VIEW_COL_DRILL" id="WF_VIEW_COL_DRILL" class="form-control" value="<?php echo $WF_VIEW_COL_DRILL; ?>">
                        </div>
						<?php //if($WF_TYPE == "R" ){
							if($WF_TYPE != "F" ){?>
						<div class="col-md-12 row" <?php if($rec['WF_TYPE'] == 'R' AND ($rec['WF_MAIN_TYPE'] == "C" OR $rec['WF_MAIN_TYPE'] == "K")){ echo 'style="display:none"'; } ?>>
						<div class="card-header">
							 <label for="WF_REPORT_HEAD_STATUS" class="custom-control custom-checkbox"><input type="checkbox" name="WF_REPORT_HEAD_STATUS" id="WF_REPORT_HEAD_STATUS" class="custom-control-input" value="Y" <?php if($rec['WF_REPORT_HEAD_STATUS'] == 'Y' ){ echo 'checked';} ?>><span class="custom-control-indicator"></span>
											<span class="custom-control-description"> ตั้งค่าหัวตารางเอง</span></label>
                        </div>
						<div class="card-block">
							 <textarea id="WF_REPORT_HEADER" name="WF_REPORT_HEADER"><?php echo stripslashes($rec['WF_REPORT_HEADER']); ?></textarea>
                        </div>
						</div>
						<?php }//}else{ 
						if($WF_TYPE != "R" ){?>
						<!---->
						<div class="col-md-12 row">
						<div class="card-header">
							<h5 class="card-header-text"><i class="typcn typcn-input-checked-outline"></i> ตั้งค่าการแสดงผลปุ่ม</h5>
							<div class="f-right">
								
							</div>
                        </div>
                        <div class="card-block">
							<!---->	
							<div class="table-responsive" data-pattern="priority-columns">
							<table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered">
								<thead>
								<tr class="bg-primary">
									<th width="20%">แสดง/ซ่อน</th>
									<th width="5%">ย่อปุ่ม</th>
									<th width="30%">เปลี่ยน Label</th>
									<th>สร้าง Link เอง <small>(ต้องการส่งค่า $_GET ใช้รูปแบบ @#GET!!)</small></th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>
										<label for="WF_BTN_ADD_STATUS" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_ADD_STATUS" id="WF_BTN_ADD_STATUS" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_ADD_STATUS'] == 'Y' || $rec['WF_BTN_ADD_STATUS'] == ""){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">ปุ่ม<?php echo $WF_TEXT_MAIN_ADD;?></span>
										</label>
									</td>
									<td class="text-center">
										<label for="WF_BTN_ADD_RESIZE" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_ADD_RESIZE" id="WF_BTN_ADD_RESIZE" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_ADD_RESIZE'] == 'Y'){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"></span>
										</label>
									</td>
									<td><input type="text" name="WF_BTN_ADD_LABEL" id="WF_BTN_ADD_LABEL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_MAIN_ADD;?>" value="<?php echo $rec['WF_BTN_ADD_LABEL']; ?>"></td>

									<td><input type="text" name="WF_BTN_ADD_LINK" id="WF_BTN_ADD_LINK" class="form-control text-primary" value="<?php echo $rec['WF_BTN_ADD_LINK']; ?>"></td>
								</tr>
								<tr>
									<td>
										<label for="WF_BTN_CON_STATUS" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_CON_STATUS" id="WF_BTN_CON_STATUS" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_CON_STATUS'] == 'Y' || $rec['WF_BTN_CON_STATUS'] == ""){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">ปุ่ม<?php if($WF_TYPE == 'W'){echo $WF_TEXT_MAIN_PROCESS;}else{ echo $WF_TEXT_MAIN_EDIT;}?></span>
										</label>
									</td>
									<td class="text-center">
										<label for="WF_BTN_CON_RESIZE" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_CON_RESIZE" id="WF_BTN_CON_RESIZE" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_CON_RESIZE'] == 'Y'){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"></span>
										</label>
									</td>
									<td><input type="text" name="WF_BTN_CON_LABEL" id="WF_BTN_CON_LABEL" class="form-control text-primary" placeholder="<?php if($WF_TYPE == 'W'){echo $WF_TEXT_MAIN_PROCESS;}else{ echo $WF_TEXT_MAIN_EDIT;}?>" value="<?php echo $rec['WF_BTN_CON_LABEL']; ?>"></td>
									<td><input type="text" name="WF_BTN_CON_LINK" id="WF_BTN_CON_LINK" class="form-control text-primary" value="<?php echo $rec['WF_BTN_CON_LINK']; ?>"></td>
								</tr>
								<tr>
									<td>
										<label for="WF_BTN_STEP_STATUS" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_STEP_STATUS" id="WF_BTN_STEP_STATUS" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_STEP_STATUS'] == 'Y' || $rec['WF_BTN_STEP_STATUS'] == ""){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">ปุ่ม<?php if($WF_TYPE == 'W'){echo $WF_TEXT_MAIN_PROCESS_STEP;}else{ echo $WF_TEXT_MAIN_VIEW;}?></span>
										</label>
									</td>
									<td class="text-center">
										<label for="WF_BTN_STEP_RESIZE" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_STEP_RESIZE" id="WF_BTN_STEP_RESIZE" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_STEP_RESIZE'] == 'Y'){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"></span>
										</label>
									</td>
									<td><input type="text" name="WF_BTN_STEP_LABEL" id="WF_BTN_STEP_LABEL" class="form-control text-primary" placeholder="<?php if($WF_TYPE == 'W'){echo $WF_TEXT_MAIN_PROCESS_STEP;}else{ echo $WF_TEXT_MAIN_VIEW;}?>" value="<?php echo $rec['WF_BTN_STEP_LABEL']; ?>"></td>
									<td><input type="text" name="WF_BTN_STEP_LINK" id="WF_BTN_STEP_LINK" class="form-control text-primary" value="<?php echo $rec['WF_BTN_STEP_LINK']; ?>"></td>
								</tr>
								<tr>
									<td>
										<label for="WF_BTN_DEL_STATUS" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_DEL_STATUS" id="WF_BTN_DEL_STATUS" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_DEL_STATUS'] == 'Y' || $rec['WF_BTN_DEL_STATUS'] == ""){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">ปุ่ม<?php echo $WF_TEXT_MAIN_DEL;?></span>
										</label>
									</td>
									<td class="text-center">
										<label for="WF_BTN_DEL_RESIZE" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_DEL_RESIZE" id="WF_BTN_DEL_RESIZE" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_DEL_RESIZE'] == 'Y'){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"></span>
										</label>
									</td>
									<td><input type="text" name="WF_BTN_DEL_LABEL" id="WF_BTN_DEL_LABEL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_MAIN_DEL;?>" value="<?php echo $rec['WF_BTN_DEL_LABEL']; ?>" ></td>
									<td><input type="text" name="WF_BTN_DEL_LINK" id="WF_BTN_DEL_LINK" class="form-control text-primary" value="<?php echo $rec['WF_BTN_DEL_LINK']; ?>"></td>
								</tr>
								<tr>
									<td>
										<label for="WF_BTN_COPY_STATUS" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_COPY_STATUS" id="WF_BTN_COPY_STATUS" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_COPY_STATUS'] == 'Y'){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">ปุ่มคัดลอกข้อมูล</span>
										</label>
									</td>
									<td class="text-center">
										<label for="WF_BTN_COPY_RESIZE" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_COPY_RESIZE" id="WF_BTN_COPY_RESIZE" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_COPY_RESIZE'] == 'Y'){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"></span>
										</label>
									</td>
									<td><input type="text" name="WF_BTN_COPY_LABEL" id="WF_BTN_COPY_LABEL" class="form-control text-primary" placeholder="คัดลอก" value="<?php echo $rec['WF_BTN_COPY_LABEL']; ?>" ></td>
									<td><input type="text" name="WF_BTN_COPY_LINK" id="WF_BTN_COPY_LINK" class="form-control text-primary" value="<?php echo $rec['WF_BTN_COPY_LINK']; ?>"></td>
								</tr>
								<tr>
									<td>
										<label for="WF_BTN_BACK_STATUS" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_BACK_STATUS" id="WF_BTN_BACK_STATUS" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_BACK_STATUS'] == 'Y' || $rec['WF_BTN_BACK_STATUS'] == ""){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">ปุ่ม<?php echo $WF_TEXT_MAIN_BACK;?></span>
										</label>
									</td>
									<td class="text-center">
										<label for="WF_BTN_BACK_RESIZE" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_BTN_BACK_RESIZE" id="WF_BTN_BACK_RESIZE" class="custom-control-input" value="Y" <?php if($rec['WF_BTN_BACK_RESIZE'] == 'Y'){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description"></span>
										</label>
									</td>
									<td><input type="text" name="WF_BTN_BACK_LABEL" id="WF_BTN_BACK_LABEL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_MAIN_BACK;?>" value="<?php echo $rec['WF_BTN_BACK_LABEL']; ?>"></td>
									<td><input type="text" name="WF_BTN_BACK_LINK" id="WF_BTN_BACK_LINK" class="form-control text-primary" value="<?php echo $rec['WF_BTN_BACK_LINK']; ?>"></td>
								</tr>
								<tr>
									<td>
										<label for="WF_DET_STEP_COL" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_DET_STEP_COL" id="WF_DET_STEP_COL" class="custom-control-input" value="Y" <?php if($rec['WF_DET_STEP_COL'] == 'Y' || $rec['WF_DET_STEP_COL'] == ""){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">คอลัมน์<?php echo $WF_TEXT_DET_STEP;?></span>
										</label>
									</td>
									<td></td>
									<td><input type="text" name="WF_DET_STEP_LABEL_COL" id="WF_DET_STEP_LABEL_COL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_DET_STEP;?>" value="<?php echo $rec['WF_DET_STEP_LABEL_COL']; ?>"></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<label for="WF_DET_NEXT_COL" class="custom-control custom-checkbox">
											<input type="checkbox" name="WF_DET_NEXT_COL" id="WF_DET_NEXT_COL" class="custom-control-input" value="Y" <?php if($rec['WF_DET_NEXT_COL'] == 'Y' || $rec['WF_DET_NEXT_COL'] == ""){ echo 'checked';} ?>>
											<span class="custom-control-indicator"></span>
											<span class="custom-control-description">คอลัมน์<?php echo $WF_TEXT_DET_NEXT;?></span>
										</label>
									</td>
									<td></td>
									<td><input type="text" name="WF_DET_NEXT_LABEL_COL" id="WF_DET_NEXT_LABEL_COL" class="form-control text-primary" placeholder="<?php echo $WF_TEXT_DET_NEXT;?>" value="<?php echo $rec['WF_DET_NEXT_LABEL_COL']; ?>"></td>
									<td></td>
								</tr>
								</tbody>
							</table>
							</div>
							<!---->	
						</div>
						</div>
						<?php } ?>
						<!--??-->
						<div class="col-md-7 row">
                        <div class="card-header">
							<h5 class="card-header-text"><i class="typcn typcn-code-outline"></i> ตั้งค่าในหน้ารายการ</h5>
                        </div>
                        <div class="card-block">
							<!---->
							<?php if($WF_TYPE != "R" ){ ?>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WF_VIEW_COL_SHOW_NO" class="custom-control custom-checkbox">
										<input type="checkbox" name="WF_VIEW_COL_SHOW_NO" id="WF_VIEW_COL_SHOW_NO" class="custom-control-input" value="Y" <?php if($rec['WF_VIEW_COL_SHOW_NO'] == 'Y' || $rec['WF_VIEW_COL_SHOW_NO'] == ""){ echo 'checked';} ?>>
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">แสดงลำดับในรายการแรก</span>
									</label>
								</div>
							</div>
							<?php } ?>
							<!---->
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WF_SEARCH_SHOW" class="custom-control custom-checkbox">
										<?php
										//เช็คว่าเป็น search รึป่าว ถ้าใช่ให้ disabled checkbox
										$sql_s = db::query("SELECT COUNT(WFS_ID) AS NUM_WFS FROM WF_STEP_FORM WHERE WF_TYPE='S' AND WF_MAIN_ID='".$W."'");
										$data_s = db::fetch_array($sql_s);
										$disable = ($data_s["NUM_WFS"] == 0)?'disabled':'';
										?>
										<input type="checkbox" name="WF_SEARCH_SHOW" id="WF_SEARCH_SHOW" class="custom-control-input" value="Y" <?php if($rec['WF_SEARCH_SHOW'] == 'Y'){ echo 'checked';} ?> <?php echo $disable;?>>
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">ค้นหาก่อนแสดงรายการ</span>
									</label>

								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WF_SPLIT_PAGE" class="custom-control custom-checkbox">
										<input type="checkbox" name="WF_SPLIT_PAGE" id="WF_SPLIT_PAGE" class="custom-control-input" value="Y" <?php if($rec['WF_SPLIT_PAGE'] == 'Y'){ echo 'checked';} ?> onclick="show_per_page(this);">
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">มีการตัดหน้า</span>
									</label>
								</div>
							</div>
							<!---->
							<?php if($rec['WF_TYPE'] != 'R'){ ?>
							<div class="form-group row" id="div_per_page" style="display: <?php if($rec['WF_SPLIT_PAGE'] == 'Y'){ echo '';}else{echo 'none';}  ?>">
								<div class="col-md-12">
									<label for="WF_PER_PAGE" class="form-control-label">จำนวนที่ให้เป็นตัวเลือกในการแสดงผล</label>
									 <input type="text" class="form-control" name="WF_PER_PAGE" id="WF_PER_PAGE" value="<?php echo $rec['WF_PER_PAGE']; ?>">
									 <small  class="form-text text-muted">ถ้าเป็นค่าว่าง ระบบจะใช้ตามการตั้งค่าของระบบ, ถ้าต้องการให้เป็นหลายตัวเลือกให้ใส่คอมม่า (,) คั่น</small>
								</div>
							</div>
							<?php } ?>
							<!---->
							<div class="form-group row">
								<div class="col-md-12">
									<div class="form-radio">
										<div class="radio radio-inline">
											<label>
												<input type="radio" name="WF_TABLE_HTML" id="WF_TABLE_HTML1" value="" <?php if($rec['WF_TABLE_HTML'] == ''){ echo 'checked';} ?>>
												<i class="helper"></i> แสดงตาราง Bootstrap
											</label>
										</div>
										<div class="radio radio-inline">
											<label>
												<input type="radio" name="WF_TABLE_HTML" id="WF_TABLE_HTML2" value="Y" <?php if($rec['WF_TABLE_HTML'] == 'Y'){ echo 'checked';} ?>>
												<i class="helper"></i> แสดงตาราง HTML ปกติ
											</label>
										</div>
										<div class="radio radio-inline">
											<label>
												<input type="radio" name="WF_TABLE_HTML" id="WF_TABLE_HTML3" value="F" <?php if($rec['WF_TABLE_HTML'] == 'F'){ echo 'checked';} ?>>
												<i class="helper"></i> ตรึงหัวตาราง (Data Table)
											</label>
										</div>
									</div>
								</div>
							</div>
							<!---->
							<?php if($rec['WF_TYPE'] == 'W'){ ?>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WF_STEP_NEXT_TAB" class="custom-control custom-checkbox">
										<input type="checkbox" name="WF_STEP_NEXT_TAB" id="WF_STEP_NEXT_TAB" class="custom-control-input" value="Y" <?php if($rec['WF_STEP_NEXT_TAB'] == 'Y'){ echo 'checked';} ?>>
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">ปุ่มขั้นตอนการทำงาน แสดงเป็นแบบแท็บถัดไป</span>
									</label>
								</div>
							</div>
							<!---->
							<?php } if($rec['WF_TYPE'] != 'R'){ ?>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WF_JQUERY_VALIDATE" class="custom-control custom-checkbox">
										<input type="checkbox" name="WF_JQUERY_VALIDATE" id="WF_JQUERY_VALIDATE" class="custom-control-input" value="Y" <?php if($rec['WF_JQUERY_VALIDATE'] == 'Y'){ echo 'checked';} ?>>
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">แจ้งเตือนเมื่อกรอกข้อมูลที่จำเป็นไม่ครบทั้งหมดพร้อมกัน</span>
									</label>
								</div>
							</div>
							<?php } ?>
							<!---->
							<?php if($rec['WF_TYPE'] != 'R'){ ?>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WF_MAIN_DEFAULT_ORDER" class="form-control-label">ค่า default Field เรียงลำดับการแสดงผล</label>
									 <input type="text" class="form-control" name="WF_MAIN_DEFAULT_ORDER" id="WF_MAIN_DEFAULT_ORDER" value="<?php echo $rec['WF_MAIN_DEFAULT_ORDER']; ?>">
									 <small  class="form-text text-muted">ถ้าเป็นค่าว่าง ระบบจะเรียงตาม WFR_ID DESC</small>
								</div>
							</div>
							<?php } ?>
							<!---->
							<?php
							if($rec['WF_TYPE'] == "R"){
								if($rec['WF_EXPORT_PDF'] == "" || $rec['WF_EXPORT_PDF'] == "Y"){
									$WF_EXPORT_PDF = "checked";
								}
							}else{
								if($rec['WF_EXPORT_PDF'] == "Y"){
									$WF_EXPORT_PDF = "checked";
								}
							}
							?>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WF_EXPORT_PDF" class="custom-control custom-checkbox">
										<input type="checkbox" name="WF_EXPORT_PDF" id="WF_EXPORT_PDF" class="custom-control-input" value="Y" <?php echo $WF_EXPORT_PDF; ?> >
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">ส่งออก PDF&nbsp;&nbsp;ตั้งค่าหน้ากระดาษ&nbsp;</span>
									</label>
									<label for="WF_SET_PAGE_PDF" class="form-control-label">
										<select name="WF_SET_PAGE_PDF" id="WF_SET_PAGE_PDF" class="form-control" placeholder="เลือก">
											<?php
											foreach($arr_set_page_pdf as $sp_id => $sp_name){
												?>
												<option value="<?php echo $sp_id;?>" <?php if($sp_id == $rec['WF_SET_PAGE_PDF']){ echo "selected";} ?>><?php echo $sp_name;?></option>
												<?php
											}
											?>
										</select>
									</label>
								</div>
							</div>
							<!---->
							<?php
							if($rec['WF_TYPE'] == "R"){
								if($rec['WF_EXPORT_WORD'] == "" || $rec['WF_EXPORT_WORD'] == "Y"){
									$WF_EXPORT_WORD = "checked";
								}
							}else{
								if($rec['WF_EXPORT_WORD'] == "Y"){
									$WF_EXPORT_WORD = "checked";
								}
							}
							?>
							<div class="form-group row">
								<div class="col-md-12">
									<label class="custom-control custom-checkbox">
										<input type="checkbox" name="WF_EXPORT_WORD" id="WF_EXPORT_WORD" class="custom-control-input" value="Y" <?php echo $WF_EXPORT_WORD; ?> >
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">ส่งออก Word&nbsp;&nbsp;ตั้งค่าหน้ากระดาษ&nbsp;</span>
									</label>
									<label for="WF_SET_PAGE_WORD" class="form-control-label">
										<select name="WF_SET_PAGE_WORD" id="WF_SET_PAGE_WORD" class="form-control" placeholder="เลือก">
											<?php
											foreach($arr_set_page_word as $sp_id => $sp_name){
												?>
												<option value="<?php echo $sp_id;?>" <?php if($sp_id == $rec['WF_SET_PAGE_WORD']){ echo "selected";} ?>><?php echo $sp_name;?></option>
												<?php
											}
											?>
										</select>
									</label>
									
								</div>
							</div>
							<!---->
							<?php
							if($rec['WF_TYPE'] == "R"){
								if($rec['WF_EXPORT_EXCEL'] == "" || $rec['WF_EXPORT_EXCEL'] == "Y"){
									$WF_EXPORT_EXCEL = "checked";
								}
							}else{
								if($rec['WF_EXPORT_EXCEL'] == "Y"){
									$WF_EXPORT_EXCEL = "checked";
								}
							}
							?>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WF_EXPORT_EXCEL" class="custom-control custom-checkbox">
										<input type="checkbox" name="WF_EXPORT_EXCEL" id="WF_EXPORT_EXCEL" class="custom-control-input" value="Y" <?php echo $WF_EXPORT_EXCEL; ?> >
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">ส่งออก Excel</span>
									</label>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-6">
									<label for="WF_MAIN_TOP_INCLUDE_N" class="form-control-label">File Include ส่วนบน</label>
									<?php if($rec['WF_MAIN_TOP_INCLUDE'] != ""){ ?>
							<a href="#!" data-toggle="modal" data-target="#bizModal" onclick="open_modal('wf_editor.php?p=<?php echo wf_encode(wf_encode('../plugin/'.$rec['WF_MAIN_TOP_INCLUDE'])); ?>', 'Editor : <?php echo $rec['WF_MAIN_TOP_INCLUDE']; ?>')">
							<i class="fa fa-edit"></i></a><?php } ?>
									 <input type="text" class="form-control" name="WF_MAIN_TOP_INCLUDE" id="WF_MAIN_TOP_INCLUDE" value="<?php echo $rec['WF_MAIN_TOP_INCLUDE']; ?>">
									 <small  class="form-text text-muted">ไฟล์จะถูกเก็บไว้ที่  ../plugin</small>
								</div>
								<div class="col-md-6">
									<label for="WF_MAIN_TOP_INCLUDE_N" class="form-control-label">&nbsp;</label>
									<div class="md-group-add-on">
									  <span class="md-add-on-file">
										  <button class="btn btn-primary waves-effect waves-light"><i class="typcn typcn-image-outline"></i> เลือก File php ในเครื่อง</button>
									  </span>
										<div class="md-input-file">
											<input type="file" name="WF_MAIN_TOP_INCLUDE_N" id="WF_MAIN_TOP_INCLUDE_N" class="" />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-6">
									<label for="WF_MAIN_LIST_INCLUDE_N" class="form-control-label">File Include ส่วนแสดงผล</label>
									<?php if($rec['WF_MAIN_LIST_INCLUDE'] != ""){ ?>
							<a href="#!" data-toggle="modal" data-target="#bizModal" onclick="open_modal('wf_editor.php?p=<?php echo wf_encode(wf_encode('../plugin/'.$rec['WF_MAIN_LIST_INCLUDE'])); ?>', 'Editor : <?php echo $rec['WF_MAIN_LIST_INCLUDE']; ?>')">
							<i class="fa fa-edit"></i></a><?php } ?>
									 <input type="text" class="form-control" name="WF_MAIN_LIST_INCLUDE" id="WF_MAIN_LIST_INCLUDE" value="<?php echo $rec['WF_MAIN_LIST_INCLUDE']; ?>">
									 <small  class="form-text text-muted">ไฟล์จะถูกเก็บไว้ที่  ../plugin</small>
								</div>
								<div class="col-md-6">
									<label for="WF_MAIN_LIST_INCLUDE_N" class="form-control-label">&nbsp;</label>
									<div class="md-group-add-on">
									  <span class="md-add-on-file">
										  <button class="btn btn-primary waves-effect waves-light"><i class="typcn typcn-image-outline"></i> เลือก File php ในเครื่อง</button>
									  </span>
										<div class="md-input-file">
											<input type="file" name="WF_MAIN_LIST_INCLUDE_N" id="WF_MAIN_LIST_INCLUDE_N" class="" />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>
								</div>
							</div> 
							<!---->
							<div class="form-group row">
								<div class="col-md-6">
									<label for="WF_MAIN_BOTTOM_INCLUDE_N" class="form-control-label">File Include ส่วนล่าง</label>
								 <?php if($rec['WF_MAIN_BOTTOM_INCLUDE'] != ""){ ?>
							<a href="#!" data-toggle="modal" data-target="#bizModal" onclick="open_modal('wf_editor.php?p=<?php echo wf_encode(wf_encode('../plugin/'.$rec['WF_MAIN_BOTTOM_INCLUDE'])); ?>', 'Editor : <?php echo $rec['WF_MAIN_BOTTOM_INCLUDE']; ?>')">
							<i class="fa fa-edit"></i></a><?php } ?>
									 <input type="text" class="form-control" name="WF_MAIN_BOTTOM_INCLUDE" id="WF_MAIN_BOTTOM_INCLUDE" value="<?php echo $rec['WF_MAIN_BOTTOM_INCLUDE']; ?>">
									 <small  class="form-text text-muted">ไฟล์จะถูกเก็บไว้ที่  ../plugin</small>
								</div>
								<div class="col-md-6">
									<label for="WF_MAIN_BOTTOM_INCLUDE_N" class="form-control-label">&nbsp;</label>
									<div class="md-group-add-on">
									  <span class="md-add-on-file">
										  <button class="btn btn-primary waves-effect waves-light"><i class="typcn typcn-image-outline"></i> เลือก File php ในเครื่อง</button>
									  </span>
										<div class="md-input-file">
											<input type="file" name="WF_MAIN_BOTTOM_INCLUDE_N" id="WF_MAIN_BOTTOM_INCLUDE_N" class="" />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-6">
									<label for="WF_MAIN_DEL_INCLUDE" class="form-control-label">File Include การลบข้อมูล</label>
									<?php if($rec['WF_MAIN_DEL_INCLUDE'] != ""){ ?>
							<a href="#!" data-toggle="modal" data-target="#bizModal" onclick="open_modal('wf_editor.php?p=<?php echo wf_encode(wf_encode('../plugin/'.$rec['WF_MAIN_DEL_INCLUDE'])); ?>', 'Editor : <?php echo $rec['WF_MAIN_DEL_INCLUDE']; ?>')">
							<i class="fa fa-edit"></i></a><?php } ?>
									 <input type="text" class="form-control" name="WF_MAIN_DEL_INCLUDE" id="WF_MAIN_DEL_INCLUDE" value="<?php echo $rec['WF_MAIN_DEL_INCLUDE']; ?>">
									 <small  class="form-text text-muted">ไฟล์จะถูกเก็บไว้ที่  ../plugin</small>
								</div>
								<div class="col-md-6">
									<label for="WF_MAIN_DEL_INCLUDE_N" class="form-control-label">&nbsp;</label>
									<div class="md-group-add-on">
									  <span class="md-add-on-file">
										  <button class="btn btn-primary waves-effect waves-light"><i class="typcn typcn-image-outline"></i> เลือก File php ในเครื่อง</button>
									  </span>
										<div class="md-input-file">
											<input type="file" name="WF_MAIN_DEL_INCLUDE_N" id="WF_MAIN_DEL_INCLUDE_N" class="" />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>
								</div>
							</div>
							<!---->
		 
                        </div>
                    </div> 
				<!--??-->
						<div class="col-md-5 row">
                        <div class="card-header">
							<h5 class="card-header-text"><i class="typcn typcn-code-outline"></i> ตั้งค่าหัวข้อในหน้ารายละเอียด</h5>
                        </div>
                        <div class="card-block">
							<!---->
							<div class="form-group row">
								<div class="col-md-4">
									<label for="WF_DETAIL_TOPIC" class="form-control-label">หัวข้อ</label>
								</div>
								<div class="col-md-8 text-right">
									<div class="input-group">
										<div data-toggle="buttons">
											<div class="btn-group">
												<label class="btn btn-success <?php echo $rec['WF_DETAIL_TOPIC_ALIGN'] == "L" ? 'active' : ''; ?>"><input type="radio" name="WF_DETAIL_TOPIC_ALIGN" id="WF_DETAIL_TOPIC_ALIGN" value="L" <?php echo $rec['WF_DETAIL_TOPIC_ALIGN'] == "L" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-left"></i></label>
												<label class="btn btn-success <?php echo $rec['WF_DETAIL_TOPIC_ALIGN'] == "C" ? 'active' : ''; ?>"><input type="radio" name="WF_DETAIL_TOPIC_ALIGN" id="WF_DETAIL_TOPIC_ALIGN" value="C" <?php echo $rec['WF_DETAIL_TOPIC_ALIGN'] == "C" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-center"></i></label>
												<label class="btn btn-success <?php echo $rec['WF_DETAIL_TOPIC_ALIGN'] == "R" ? 'active' : ''; ?>"><input type="radio" name="WF_DETAIL_TOPIC_ALIGN" id="WF_DETAIL_TOPIC_ALIGN" value="R" <?php echo $rec['WF_DETAIL_TOPIC_ALIGN'] == "R" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-right"></i></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								  <textarea name="WF_DETAIL_TOPIC" id="WF_DETAIL_TOPIC" class="form-control" rows="5"><?php echo $rec['WF_DETAIL_TOPIC']; ?></textarea>
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-4">
									<label for="WF_DETAIL_DESC" class="form-control-label">รายละเอียด</label>
								</div>
								<div class="col-md-8 text-right">
									<div class="input-group">
										<div data-toggle="buttons">
											<div class="btn-group">
												<label class="btn btn-success <?php echo $rec['WF_DETAIL_DESC_ALIGN'] == "L" ? 'active' : ''; ?>"><input type="radio" name="WF_DETAIL_DESC_ALIGN" id="WF_DETAIL_DESC_ALIGN" value="L" <?php echo $rec['WF_DETAIL_DESC_ALIGN'] == "L" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-left"></i></label>
												<label class="btn btn-success <?php echo $rec['WF_DETAIL_DESC_ALIGN'] == "C" ? 'active' : ''; ?>"><input type="radio" name="WF_DETAIL_DESC_ALIGN" id="WF_DETAIL_DESC_ALIGN" value="C" <?php echo $rec['WF_DETAIL_DESC_ALIGN'] == "C" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-center"></i></label>
												<label class="btn btn-success <?php echo $rec['WF_DETAIL_DESC_ALIGN'] == "R" ? 'active' : ''; ?>"><input type="radio" name="WF_DETAIL_DESC_ALIGN" id="WF_DETAIL_DESC_ALIGN" value="R" <?php echo $rec['WF_DETAIL_DESC_ALIGN'] == "R" ? 'checked' : ''; ?>><i class="zmdi zmdi-format-align-right"></i></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								
								  <textarea name="WF_DETAIL_DESC" id="WF_DETAIL_DESC" class="form-control" rows="5"><?php echo $rec['WF_DETAIL_DESC']; ?></textarea>
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small> 
							</div>
							<!---->	 
							<div class="form-group row">
								<div class="col-md-12">
									<label for="WF_DETAIL_FIRST_VIEW" class="custom-control custom-checkbox">
										<input type="checkbox" name="WF_DETAIL_FIRST_VIEW" id="WF_DETAIL_FIRST_VIEW" class="custom-control-input" value="Y" <?php if($rec['WF_DETAIL_FIRST_VIEW'] == 'Y'){ echo 'checked';} ?>>
										<span class="custom-control-indicator"></span>
										<span class="custom-control-description">แสดงหัวข้อที่ตั้งค่าไว้ในหน้าเพิ่มข้อมูล</span>
									</label>
								</div>
							</div>
							<!---->
							
							<div class="form-group row">
								<div class="col-md-6">
									<label for="WF_CHANGE_FLOW_NAME" class="form-control-label">เปลี่ยนชื่อระบบในการแสดงผล</label>
								</div>
								<div class="col-md-6 text-right"></div>
							</div>
							<div class="form-group">
								  <textarea name="WF_CHANGE_FLOW_NAME" id="WF_CHANGE_FLOW_NAME" class="form-control" rows="5"><?php echo $rec['WF_CHANGE_FLOW_NAME']; ?></textarea>
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small> 
							</div>
							<!---->	 
							<div class="form-group row">
								<div class="col-md-6">
									<label for="WF_CHANGE_STEP_NAME" class="form-control-label">เปลี่ยนชื่อขั้นตอนในการแสดงผล</label>
								</div>
								<div class="col-md-6 text-right"></div>
							</div>
							<div class="form-group">
								  <textarea name="WF_CHANGE_STEP_NAME" id="WF_CHANGE_STEP_NAME" class="form-control" rows="5"><?php echo $rec['WF_CHANGE_STEP_NAME']; ?></textarea>
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small> 
							</div>
							<!---->	 
							
							
                        </div>
                    </div> 
				<!--??-->
							
						<?php } ?>
                    </div>
					
                </div> 
						<?php if($rec["WF_TYPE"] == 'M'){ ?>
							<div class="form-group ">
							  <div class="col-md-12">
							  <div class="col-md-12">
							  
							  <label for="WF_EXCEL_FIELD" class="form-control-label">ตั้งค่าคอลัมน์การแสดงผลในรูปแบบ Excel </label>
								<div class="input-group">
									<span class="input-group-addon"><?php echo $rec["WF_FIELD_PK"]; ?>,</span>
									<input type="text" class="form-control  text-uppercase" id="WF_EXCEL_FIELD" name="WF_EXCEL_FIELD" value="<?php echo strtoupper($rec['WF_EXCEL_FIELD']); ?>">
									
								</div>
								<small class="form-text text-muted">ใส่ชื่อ FIELD แล้วคั่นด้วยเครื่องหมาย "," หากไม่ตั้งค่า ระบบจะแสดง FIELD ทั้งหมด</small>  
								  
							  </div>
							  </div>
							</div>
						<?php } ?>
				<div class="col-md-12">
                    <div class="card_bk">
                        <div class="card-header">
							<h5 class="card-header-text"><i class="typcn typcn-code-outline"></i> ตั้งค่าหัวข้อในการส่ง Email</h5>
                        </div>
                        <div class="card-block">
							<div class="form-group row">
								<div class="col-md-4">
									<div class="checkbox-color checkbox-primary">
										<input name="WFD_EMAIL_SETTING" id="WFD_EMAIL_SETTING" type="checkbox" value="Y" <?php echo $rec['WFD_EMAIL_SETTING'] == "Y" ? 'checked' : ''; ?>>
										<label for="WFD_EMAIL_SETTING">
											ใช้งานการส่ง Email
										</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="checkbox-color checkbox-primary">
										<input name="WFD_EMAIL_SETTING_EDIT" id="WFD_EMAIL_SETTING_EDIT" type="checkbox" value="Y" <?php echo $rec['WFD_EMAIL_SETTING_EDIT'] == "Y" ? 'checked' : ''; ?>>
										<label for="WFD_EMAIL_SETTING_EDIT">
											ส่ง mail กรณีแก้ไขข้อมูล
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-4">
									<label for="WFD_DETAIL_EMAIL" class="form-control-label">หัวข้อ</label>
								</div>
							</div>
							<!---->
							<div class="form-group">
								  <textarea name="WFD_DETAIL_EMAIL" id="WFD_DETAIL_EMAIL" class="form-control" rows="5"><?php echo nl2br($rec['WFD_DETAIL_EMAIL']); ?></textarea>
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-4">
									<label for="WFD_DETAIL_EMAIL_DESC" class="form-control-label">รายละเอียด</label>
								</div>
							</div>
							<!---->
							<div class="form-group">
								  <textarea name="WFD_DETAIL_EMAIL_DESC" id="WFD_DETAIL_EMAIL_DESC" class="form-control" rows="5"><?php echo nl2br($rec['WFD_DETAIL_EMAIL_DESC']); ?></textarea>
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
							</div>
							<!---->	
							
							<div class="form-group">
								<div class="form-radio">
								  <div class="radio radio-inline"> <!-- radio-inline -->
										<label>
											<input type="radio" name="WFD_EMAIL_SEND_SETTING" id="WFD_EMAIL_SEND_SETTING" value="" onclick="if(this.checked === true){$('#CONFIG_EMAIL_SEND_SETTING_FILED').hide();}" <?php if($rec['WFD_EMAIL_SEND_SETTING'] == ''){ echo 'checked';}?>> <!--onclick="show_type(this.value);" -->
												<i class="helper"></i> ส่งตามสิทธิ์ของขั้นตอน
										</label>
									</div>
									<div class="radio radio-inline">
										<label>
											<input type="radio" name="WFD_EMAIL_SEND_SETTING" id="WFD_EMAIL_SEND_SETTING" value="S" onclick="if(this.checked === true){$('#CONFIG_EMAIL_SEND_SETTING_FILED').show();}" <?php if($rec['WFD_EMAIL_SEND_SETTING'] == 'S'){ echo 'checked';}?>><i class="helper">
												</i> ส่งตาม field ที่กำหนด
										</label>
									</div>
								</div>
							</div>
							<!---->	
							<div id="CONFIG_EMAIL_SEND_SETTING_FILED" <?php if($rec['WFD_EMAIL_SEND_SETTING'] == ''){ echo 'style="display:none;"';}?>>
							<div class="form-group row">
								<div class="col-md-2">
									<label for="WFD_EMAIL_SETTING_FIELD" class="form-control-label">ระบุ field email</label>
								</div>
								<div class="col-md-4">
									<input type="text" class="form-control" name="WFD_EMAIL_SETTING_FIELD" id="WFD_EMAIL_SETTING_FIELD" value="<?php echo $rec['WFD_EMAIL_SETTING_FIELD']; ?>">
								</div>
							</div>
							<!---->	
							</div>
							
							<div class="form-group row">
								<div class="col-md-4">
									<label for="" class="form-control-label">กรณีลง Calendar</label>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-2">
									<label for="WFD_DETAIL_EMAIL_CAL" class="form-control-label">Field วันที่เริ่มต้น</label>
								</div>
								<div class="col-md-4">
									 <input type="text" class="form-control" name="WFD_DETAIL_EMAIL_CAL" id="WFD_DETAIL_EMAIL_CAL" value="<?php echo $rec['WFD_DETAIL_EMAIL_CAL']; ?>">
								</div>
								<div class="col-md-2">
									<label for="WFD_DETAIL_EMAIL_CAL_STIME" class="form-control-label">Field เวลาเริ่มต้น</label>
								</div>
								<div class="col-md-4">
									 <input type="text" class="form-control" name="WFD_DETAIL_EMAIL_CAL_STIME" id="WFD_DETAIL_EMAIL_CAL_STIME" value="<?php echo $rec['WFD_DETAIL_EMAIL_CAL_STIME']; ?>">
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="WFD_DETAIL_EMAIL_CAL_EDATE" class="form-control-label">Field วันที่สิ้นสุด</label>
								</div>
								<div class="col-md-4">
									 <input type="text" class="form-control" name="WFD_DETAIL_EMAIL_CAL_EDATE" id="WFD_DETAIL_EMAIL_CAL_EDATE" value="<?php echo $rec['WFD_DETAIL_EMAIL_CAL_EDATE']; ?>">
								</div>
								<div class="col-md-2">
									<label for="WFD_DETAIL_EMAIL_CAL_ETIME" class="form-control-label">Field เวลาสิ้นสุด</label>
								</div>
								<div class="col-md-4">
									 <input type="text" class="form-control" name="WFD_DETAIL_EMAIL_CAL_ETIME" id="WFD_DETAIL_EMAIL_CAL_ETIME" value="<?php echo $rec['WFD_DETAIL_EMAIL_CAL_ETIME']; ?>">
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="WFD_DETAIL_EMAIL_CAL_PLACE" class="form-control-label">Field สถานที่</label>
								</div>
								<div class="col-md-10">
									 <input type="text" class="form-control" name="WFD_DETAIL_EMAIL_CAL_PLACE" id="WFD_DETAIL_EMAIL_CAL_PLACE" value="<?php echo $rec['WFD_DETAIL_EMAIL_CAL_PLACE']; ?>">
									  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
								</div>
							</div>
							<!---->

                        </div>
					</div>
				</div>
            </div>
            <!-- Row end -->
			<!-- Row Starts -->
            <div class="row tab-pane" id="tab3" role="tabpanel">
				<div class="col-md-12">
                    <div class="card_bk">
                        <div class="card-header">
							<?php if($rec["WF_TYPE"] == 'W' OR $rec["WF_TYPE"] == 'M' OR $rec["WF_TYPE"] == 'R'){?>
							<h5 class="card-header-text"><i class="typcn typcn-lock-open-outline"></i> ตั้งค่าสิทธิ์</h5>
							<div>
							<h6 class="card-header-text">
								<i class="ion-unlocked"></i>
								<div class="btn-group" role="group"> 
								
								<button type="button" class="btn btn-success active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าสิทธิ์รายบุคคล" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=WFM&ACESS_REF_ID=<?php echo $rec["WF_MAIN_ID"]; ?>&USR_TYPE=U','ตั้งค่าสิทธิ์รายบุคคล');"><i class="ion-person"></i></button>
								<button type="button" class="btn btn-primary active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าสิทธิ์ตามหน่วยงาน" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=WFM&ACESS_REF_ID=<?php echo $rec["WF_MAIN_ID"]; ?>&USR_TYPE=D','ตั้งค่าสิทธิ์ตามหน่วยงาน');"><i class="ion-home"></i></button>
								<button type="button" class="btn btn-warning active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าสิทธิ์ตามตำแหน่ง" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=WFM&ACESS_REF_ID=<?php echo $rec["WF_MAIN_ID"]; ?>&USR_TYPE=P','ตั้งค่าสิทธิ์ตามตำแหน่ง');"><i class="ion-briefcase"></i></button>
								<button type="button" class="btn btn-danger active btn-mini waves-effect waves-light" data-toggle="modal" data-target="#bizModal" title="ตั้งค่าสิทธิ์ตามกลุ่ม" onclick="open_modal('workflow_setting_add_department.php?ACCESS_TYPE=WFM&ACESS_REF_ID=<?php echo $rec["WF_MAIN_ID"]; ?>&USR_TYPE=G','ตั้งค่าสิทธิ์ตามกลุ่ม');"><i class="ion-person-stalker"></i></button>
								</div>
							</h6>
							</div>
						<?php }?>
                        </div>
						<?php if($rec["WF_TYPE"] == 'W' OR $rec["WF_TYPE"] == 'M' OR $rec["WF_TYPE"] == 'R'){?>
						<div class="card-block">
							<div class="form-group row">
							  <div class="col-md-12">
								<div id="show_permission_<?php echo $rec["WF_MAIN_ID"]; ?>">
									
									<script type="text/javascript">
										var dataString = 'A_TYPE=WFM&A_ID=<?php echo $rec["WF_MAIN_ID"]; ?>';
										$.ajax({
										 type: "GET",
										 url: "workflow_setting_view_department.php",
										 data: dataString,
										 cache: false,
										 success: function(html){
										  $("#show_permission_<?php echo $rec["WF_MAIN_ID"]; ?>").html(html);
										 }
										 });

									</script>
								 </div>
							  </div>
							</div>
						</div>
						<?php }?>
                        <div class="card-block">
							<!---->
							<div class="form-group">
								<label for="WF_PERMISS_VIEW" class="form-control-label">สิทธิ์การมองเห็น</label>
								  <textarea name="WF_PERMISS_VIEW" id="WF_PERMISS_VIEW" class="form-control" rows="6"><?php echo nl2br($rec['WF_PERMISS_VIEW']); ?></textarea>
								  <small class="form-text text-muted">ตัวแปร SESSION ให้ใช้ @@SESSION!!</small>
							</div>
							<!---->
							<div class="form-group">
								<label for="WF_PERMISS_ACTION" class="form-control-label"><?php if($WF_TYPE=="M"){ echo "สิทธิ์การเพิ่มข้อมูล"; }else{ echo "สิทธิ์การดำเนินการ"; } ?></label>
								  <textarea name="WF_PERMISS_ACTION" id="WF_PERMISS_ACTION" class="form-control" rows="6"><?php echo nl2br($rec['WF_PERMISS_ACTION']); ?></textarea>
								  <small class="form-text text-muted">ตัวแปร SESSION ให้ใช้ @@SESSION!!</small>
							</div>
							<!---->	
							<div class="form-group">
								<label for="WF_PERMISS_DELETE" class="form-control-label">สิทธิ์การลบ</label>
								  <textarea name="WF_PERMISS_DELETE" id="WF_PERMISS_DELETE" class="form-control" rows="6"><?php echo $rec['WF_PERMISS_DELETE']; ?></textarea>
								  <small class="form-text text-muted">ตัวแปร SESSION ให้ใช้ @@SESSION!!</small>
							</div>
							<!---->	
							<div class="form-group">
								<label for="WF_PERMISS_EDIT" class="form-control-label">สิทธิ์การแก้ไข</label>
								  <textarea name="WF_PERMISS_EDIT" id="WF_PERMISS_EDIT" class="form-control" rows="6"><?php echo $rec['WF_PERMISS_EDIT']; ?></textarea>
								  <small class="form-text text-muted">ตัวแปร SESSION ให้ใช้ @@SESSION!!</small>
							</div>
							<!---->	
                        </div>
                    </div>
                </div>
				
            </div>
			<!-- Row Starts -->
            <div class="row tab-pane" id="tab4" role="tabpanel">
                <div class="col-md-12">
                    <div class="card_bk">
                        <div class="card-header">
							<h5 class="card-header-text"><i class="typcn typcn-device-phone"></i> ตั้งค่าการแสดงผลในมือถือ</h5>
                        </div>
                        <div class="card-block">
							<!---->
							<div class="form-group row">
							  <div class="col-md-12">
								<h6><i class="typcn typcn-th-list-outline"></i> รายการแสดงหน้าจอ</h6>	
							  </div>
							</div>
							<!---->
							<div class="form-group row">
							  <div class="col-md-2">
								  <label for="WF_M_TOPIC" class="form-control-label wf-right">หัวข้อรายการ</label>
							  </div>
							  <div class="col-md-10">
								  <input type="text" class="form-control" id="WF_M_TOPIC" name="WF_M_TOPIC" value="<?php echo $rec['WF_M_TOPIC']; ?>">
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
							  </div>
							</div>
							<!---->
							<div class="form-group row">
							  <div class="col-md-2">
								  <label for="WF_M_TOPIC_DESC" class="form-control-label wf-right">รายละเอียด</label>
							  </div>
							  <div class="col-md-10">
								  <input type="text" class="form-control" id="WF_M_TOPIC_DESC" name="WF_M_TOPIC_DESC" value="<?php echo $rec['WF_M_TOPIC_DESC']; ?>">
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
							  </div>
							</div>
							<!---->
							<div class="form-group row">
							  <div class="col-md-12">
								<h6><i class="typcn typcn-message"></i> ตั้งค่าการแจ้งเตือนใน LINE</h6>	
							  </div>
							</div>
							<!---->
							<div class="form-group row">
							  <div class="col-md-2">
								  <label for="WF_M_ALERT" class="form-control-label wf-right">ข้อความ</label>
							  </div>
							  <div class="col-md-10">
								  <input type="text" class="form-control" id="WF_M_ALERT" name="WF_M_ALERT" value="<?php echo $rec['WF_M_ALERT']; ?>">
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
							  </div>
							</div>
							<!--
							<div class="form-group row">
							  <div class="col-md-2">
								  <label for="WF_M_ALERT_DESC" class="form-control-label wf-right">รายละเอียด</label>
								  
							  </div>
							  <div class="col-md-10">
								  <input type="text" class="form-control" id="WF_M_ALERT_DESC" name="WF_M_ALERT_DESC" value="<?php echo $rec['WF_M_ALERT_DESC']; ?>">
								  <small class="form-text text-muted">ตัวแปร Table Field ให้ใช้ ##FIELD!!</small>
							  </div>
							</div>-->
							<!---->
							<!---->
							<div class="form-group row">
							  <div class="col-md-12">
								<h6><i class="typcn typcn-message"></i> ตั้งค่าการการรับข้อความ (ระบบจะรอรับคำสั่งที่ขึ้นต้นด้วย "@" และข้อความที่คั่นด้วย "::")</h6>	
							  </div>
							</div>
							<!---->
							<div class="form-group row">
							  <div class="col-md-2">
								  <label for="WF_LINE_CODE" class="form-control-label wf-right">รหัสของ Flow นี้</label>
							  </div>
							  <div class="col-md-3">
								  <input type="text" class="form-control" id="WF_LINE_CODE" name="WF_LINE_CODE" value="<?php echo $rec['WF_LINE_CODE']; ?>">
								  <small class="form-text text-muted">ตั้งเป็นตัวอักษรหรือตัวเลข ห้ามมีเครื่องหมาย "-"</small>
							  </div>
							</div>
							<!---->
							<div class="form-group row">
							  <div class="col-md-2">
								  <label for="WF_LINE_COL" class="form-control-label wf-right">Column ที่ต้องการบันทึก</label>
								  
							  </div>
							  <div class="col-md-10">
								  <input type="text" class="form-control" id="WF_LINE_COL" name="WF_LINE_COL" value="<?php echo $rec['WF_LINE_COL']; ?>">
								  <small class="form-text text-muted">ใส่ Field Table ลงได้เลย โดยคั่นด้วย ","</small>
							  </div>
							</div>
							<!---->
                        </div>
                    </div>
                </div>
			</div>
				<!-- // -->
            <!-- Row end -->
							</div>
						</div>
					 </div>
                </div>
			</div>	
<!-- Row end -->			
			<div class="row">
				<div class="col-md-12">    
					<div class="f-left">
						<button type="button" class="btn btn-md btn-danger active waves-effect waves-light" onclick="window.location.href='workflow.php';"><i class="typcn typcn-chevron-left-outline"></i> ย้อนกลับ</button>
					</div>
                    <div class="wf-right">
						<input type="hidden" name="back_page_old" id="back_page_old">
						<button type="submit" class="btn btn-md btn-warning active waves-effect waves-light" onclick="$('#back_page_old').val('Y');">
							<i class="icofont icofont-tick-mark"></i> บันทึกและกลับหน้าเดิม
						</button>&nbsp;
                        <button type="submit" class="btn btn-md btn-success active waves-effect waves-light"><i class="icofont icofont-tick-mark"></i> บันทึก</button>
                    </div>
                </div>
            </div>
					
			<div class="row">
				<div class="main-header">
				</div>
			</div>
		</form>
        <!-- Container-fluid ends -->
     </div>
</div>

<?php include '../include/combottom_js.php'; ?>
<script src='../assets/js/jquery-sortable.js'></script>
<script src='../assets/js/typeahead.min.js'></script>
<!-- ace editor js -->
<script src="../assets/plugins/ace-editor/build/aui/aui.js"></script>
<?php //if($WF_TYPE == "R"){ 
if($WF_TYPE != "F"){ ?>
<script src="../assets/plugins/tiny_mce/jquery.tinymce.js"></script>
<?php
}//}

$fi_val = "'".implode("','", $WF_ARR_NAME)."'";
$va_val = "'##".implode("!!','##", $WF_ARR_FIELD)."!!'";
$or_val = "'".implode("','", $WF_ARR_FIELD)."'";
//if($WF_TYPE == "R"){
if($WF_TYPE != "F"){
?>
<script>
	$(document).ready(function() {
		// File Browser
		$('textarea#WF_REPORT_HEADER').tinymce({
			// Location of TinyMCE script
			script_url 							: '../assets/plugins/tiny_mce/tiny_mce.js',
			// General options
			theme 								: "advanced",
			plugins 							: "autoresize,style,table,advhr,advimage,advlink,emotions,inlinepopups,preview,media,contextmenu,paste,fullscreen,noneditable,xhtmlxtras,template,advlist",
			// Theme options
			theme_advanced_buttons1 			: "justifyleft,justifycenter,justifyright, justifyfull,|,tablecontrols,|,code,preview,fullscreen",
			theme_advanced_buttons2 			: "",
			theme_advanced_buttons3 			: "",
			theme_advanced_toolbar_location 	: "top",
			theme_advanced_toolbar_align 		: "left",
			theme_advanced_statusbar_location 	: "bottom",
			theme_advanced_resizing 			: false,
			font_size_style_values 				: "8pt,10px,12pt,14pt,18pt,24pt,36pt",
			init_instance_callback				: function(){
				function resizeWidth() {
					document.getElementById(tinyMCE.activeEditor.id+'_tbl').style.width='100%';
				}
				resizeWidth();
				$(window).resize(function() {
					resizeWidth();
				})
			},
			 content_css : "../assets/plugins/tiny_mce/themes/advanced/css/edit_content.css", 
			// file browser
			file_browser_callback: function openKCFinder(field_name, url, type, win) {
				tinyMCE.activeEditor.windowManager.open({
					file: 'file-manager/browse.php?opener=tinymce&type=' + type + '&dir=image/themeforest_assets',
					title: 'KCFinder',
					width: 700,
					height: 500,
					resizable: "yes",
					inline: true,
					close_previous: "no",
					popup_css: false
				}, {
					window: win,
					input: field_name
				});
				return false;
			}
		});
	});
</script>
<?php }//} ?>
<script type="text/javascript">
			$(".dasboard-4-table-scroll").slimScroll({
                height: 350,
                 allowPageScroll: false,
                 wheelStep:5,
                 color: '#000'
           });
	<?php if($WF_TYPE=="R"){ ?>
	function addACol(p_table) {
		var col_num = $('#'+p_table+' thead tr th').length;
		if(col_num > 0){
		$('#'+p_table+' thead tr').find('th:last').after('<th>ลำดับที่ '+(col_num+1)+'</th>');
		var currentNumberOfTDsInARow = $('#'+p_table+' tr:first td').length;
		var rows = $('#'+p_table+' tbody tr');
			$(rows[0]).find('td:last').after('<td><input type="text" id="fi_val" class="form-control fi_val"></td>');
			$(rows[1]).find('td:last').after('<td><textarea id="va_val" class="form-control va_val"></textarea></td>');
			$(rows[2]).find('td:last').after('<td><select id="al_val" class="form-control"><option value="L">ชิดซ้าย</option><option value="C">ตรงกลาง</option><option value="R">ชิดขวา</option></select></td>');
			$(rows[3]).find('td:last').after('<td><input type="text" id="wi_val" class="form-control text-right"></td>');
			$(rows[4]).find('td:last').after('<td><input type="text" id="or_val" class="form-control or_val"></td>');
			$(rows[5]).find('td:last').after('<td><input type="text" id="total_val" class="form-control"></td>');
			$(rows[6]).find('td:last').after('<td><input type="text" id="fo_val" class="form-control fo_val"></td>');
			$(rows[7]).find('td:last').after('<td><input type="text" id="dr_val" class="form-control dr_val"></td>');
			$(rows[8]).find('td:last').after("<td><button type=\"button\" onClick=\"del('data_position',"+col_num+");\" class=\"btn btn-danger waves-effect btn-mini\"><i class=\"icofont icofont-ui-close\"></i> ลบ</button></td>");
		}else{
		$('#'+p_table+' thead tr').find('td:last').after('<th>ลำดับที่ '+(col_num+1)+'</th>');
		var rows = $('#'+p_table+' tbody tr');
			$(rows[0]).find('th:last').after('<td><input type="text" id="fi_val" class="form-control fi_val" value=""></td>');
			$(rows[1]).find('th:last').after('<td><textarea id="va_val" class="form-control va_val"></textarea></td>');
			$(rows[2]).find('th:last').after('<td><select id="al_val" class="form-control"><option value="L">ชิดซ้าย</option><option value="C">ตรงกลาง</option><option value="R">ชิดขวา</option></select></td>');
			$(rows[3]).find('th:last').after('<td><input type="text" id="wi_val" class="form-control text-right"></td>');
			$(rows[4]).find('th:last').after('<td><input type="text" id="or_val" class="form-control or_val" value=""></td>');
			$(rows[5]).find('th:last').after('<td><input type="text" id="total_val" class="form-control" value=""></td>');
			$(rows[6]).find('th:last').after('<td><input type="text" id="fo_val" class="form-control fo_val" value=""></td>');
			$(rows[7]).find('th:last').after('<td><input type="text" id="dr_val" class="form-control dr_val" value=""></td>');
			$(rows[8]).find('th:last').after("<td><button type=\"button\" onClick=\"del('data_position',0);\" class=\"btn btn-danger waves-effect btn-mini\"><i class=\"icofont icofont-ui-close\"></i> ลบ</button></td>");
		}
			$('.fi_val').typeahead({
				source: [<?php echo $fi_val; ?>]
			});
			$('.va_val').typeahead({
				source: [<?php echo $va_val; ?>]
			});
	}
	
	function arrange_col(p_table) {
		var col_num = $('#'+p_table+' thead tr th');	
		for (var x = 0; x < col_num.length; x++) {
			$(col_num[x]).html("ลำดับที่ "+(x+1));
		}
		var row_num = $('#'+p_table+' tbody tr');	
		for (var x = 0; x < row_num.length; x++) {
			$('#'+p_table+' tr:eq(9) td:eq(' + x + ')').html("<button type=\"button\" onClick=\"del('data_position',"+x+");\" class=\"btn btn-danger waves-effect btn-mini\"><i class=\"icofont icofont-ui-close\"></i> ลบ</button>");
		}
		
	}
	function del(p_table,c) {
		if(confirm("คุณต้องการยกเลิกคอลัมน์ลำดับที่ "+(c+1)+"?")){
		$('#'+p_table+' tr:eq(0) th:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(1) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(2) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(3) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(4) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(5) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(6) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(7) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(8) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(9) td:eq(' + c + ')').remove();
		arrange_col(p_table);
		}
	}
	function save_pos(p_table){
		var data1 = $('#'+p_table+' tbody tr td #fi_val');
		var data2 = $('#'+p_table+' tbody tr td #va_val');
		var data3 = $('#'+p_table+' tbody tr td #al_val');
		var data4 = $('#'+p_table+' tbody tr td #wi_val');
		var data5 = $('#'+p_table+' tbody tr td #or_val');
		var data6 = $('#'+p_table+' tbody tr td #total_val');
		var data7 = $('#'+p_table+' tbody tr td #fo_val');
		var data8 = $('#'+p_table+' tbody tr td #dr_val');
		var fi_txt = '';
		var va_txt = '';
		var al_txt = '';
		var wi_txt = '';
		var or_txt = '';
		var total_txt = '';
		var fo_txt = '';
		var dr_txt = '';
		for (var x = 0; x < data1.length; x++) {
			fi_txt += '|'+$(data1[x]).val();
			va_txt += '|'+$(data2[x]).val();
			al_txt += '|'+$(data3[x]).val();
			wi_txt += '|'+$(data4[x]).val();
			or_txt += '|'+$(data5[x]).val();
			total_txt += '|'+$(data6[x]).val();
			fo_txt += '|'+$(data7[x]).val();
			dr_txt += '|'+$(data8[x]).val();
		}
		var fitxt = fi_txt.substring(1);
		var vatxt = va_txt.substring(1);
		var altxt = al_txt.substring(1);
		var witxt = wi_txt.substring(1);
		var ortxt = or_txt.substring(1);
		var totaltxt = total_txt.substring(1);
		var fotxt = fo_txt.substring(1);
		var drtxt = dr_txt.substring(1);
		$('#WF_VIEW_COL_HEADER').val(fitxt);
		$('#WF_VIEW_COL_DATA').val(vatxt);
		$('#WF_VIEW_COL_ALIGN').val(altxt);
		$('#WF_VIEW_COL_SIZE').val(witxt);
		$('#WF_VIEW_COL_ORDER').val(ortxt);
		$('#WF_R_TOTAL').val(totaltxt);
		$('#WF_VIEW_COL_FORMAT').val(fotxt);
		$('#WF_VIEW_COL_DRILL').val(drtxt);
	}
	<?php }else{ ?>
	function addACol(p_table) {
		var col_num = $('#'+p_table+' thead tr th').length;
		if(col_num > 0){
		$('#'+p_table+' thead tr').find('th:last').after('<th>ลำดับที่ '+(col_num+1)+'</th>');
		var currentNumberOfTDsInARow = $('#'+p_table+' tr:first td').length;
		var rows = $('#'+p_table+' tbody tr');
			$(rows[0]).find('td:last').after('<td><input type="text" id="fi_val" class="form-control fi_val"></td>');
			$(rows[1]).find('td:last').after('<td><textarea id="va_val" class="form-control va_val"></textarea></td>');
			$(rows[2]).find('td:last').after('<td><select id="al_val" class="form-control"><option value="L">ชิดซ้าย</option><option value="C">ตรงกลาง</option><option value="R">ชิดขวา</option></select></td>');
			$(rows[3]).find('td:last').after('<td><input type="text" id="wi_val" class="form-control text-right"></td>');
			$(rows[4]).find('td:last').after('<td><input type="text" id="or_val" class="form-control or_val"></td>');
			$(rows[5]).find('td:last').after('<td><input type="text" id="total_val" class="form-control"></td>');
			$(rows[6]).find('td:last').after("<td><button type=\"button\" onClick=\"del('data_position',"+col_num+");\" class=\"btn btn-danger waves-effect btn-mini\"><i class=\"icofont icofont-ui-close\"></i> ลบ</button></td>");
		}else{
		$('#'+p_table+' thead tr').find('td:last').after('<th>ลำดับที่ '+(col_num+1)+'</th>');
		var rows = $('#'+p_table+' tbody tr');
			$(rows[0]).find('th:last').after('<td><input type="text" id="fi_val" class="form-control fi_val" value=""></td>');
			$(rows[1]).find('th:last').after('<td><textarea id="va_val" class="form-control va_val"></textarea></td>');
			$(rows[2]).find('th:last').after('<td><select id="al_val" class="form-control"><option value="L">ชิดซ้าย</option><option value="C">ตรงกลาง</option><option value="R">ชิดขวา</option></select></td>');
			$(rows[3]).find('th:last').after('<td><input type="text" id="wi_val" class="form-control text-right"></td>');
			$(rows[4]).find('th:last').after('<td><input type="text" id="or_val" class="form-control or_val" value=""></td>');
			$(rows[5]).find('th:last').after('<td><input type="text" id="total_val" class="form-control" value=""></td>');
			$(rows[6]).find('th:last').after("<td><button type=\"button\" onClick=\"del('data_position',0);\" class=\"btn btn-danger waves-effect btn-mini\"><i class=\"icofont icofont-ui-close\"></i> ลบ</button></td>");
		}
			$('.fi_val').typeahead({
				source: [<?php echo $fi_val; ?>]
			});
			$('.va_val').typeahead({
				source: [<?php echo $va_val; ?>]
			});
			$('.or_val').typeahead({
				source: [<?php echo $or_val; ?>]
			});
	}
	
	function arrange_col(p_table) {
		var col_num = $('#'+p_table+' thead tr th');	
		for (var x = 0; x < col_num.length; x++) {
			$(col_num[x]).html("ลำดับที่ "+(x+1));
		}
		var row_num = $('#'+p_table+' tbody tr');	
		for (var x = 0; x < row_num.length; x++) {
			$('#'+p_table+' tr:eq(7) td:eq(' + x + ')').html("<button type=\"button\" onClick=\"del('data_position',"+x+");\" class=\"btn btn-danger waves-effect btn-mini\"><i class=\"icofont icofont-ui-close\"></i> ลบ</button>");
		}
		
	}
	function del(p_table,c) {
		if(confirm("คุณต้องการยกเลิกคอลัมน์ลำดับที่ "+(c+1)+"?")){
		$('#'+p_table+' tr:eq(0) th:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(1) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(2) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(3) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(4) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(5) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(6) td:eq(' + c + ')').remove();
		$('#'+p_table+' tr:eq(7) td:eq(' + c + ')').remove();
		arrange_col(p_table);
		}
	}
	function save_pos(p_table){
		var data1 = $('#'+p_table+' tbody tr td #fi_val');
		var data2 = $('#'+p_table+' tbody tr td #va_val');
		var data3 = $('#'+p_table+' tbody tr td #al_val');
		var data4 = $('#'+p_table+' tbody tr td #wi_val');
		var data5 = $('#'+p_table+' tbody tr td #or_val');
		var data6 = $('#'+p_table+' tbody tr td #total_val');
		var fi_txt = '';
		var va_txt = '';
		var al_txt = '';
		var wi_txt = '';
		var or_txt = '';
		var total_txt = '';
		for (var x = 0; x < data1.length; x++) {
			fi_txt += '|'+$(data1[x]).val();
			va_txt += '|'+$(data2[x]).val();
			al_txt += '|'+$(data3[x]).val();
			wi_txt += '|'+$(data4[x]).val();
			or_txt += '|'+$(data5[x]).val();
			total_txt += '|'+$(data6[x]).val();
		}
		var fitxt = fi_txt.substring(1);
		var vatxt = va_txt.substring(1);
		var altxt = al_txt.substring(1);
		var witxt = wi_txt.substring(1);
		var ortxt = or_txt.substring(1);
		var totaltxt = total_txt.substring(1);
		$('#WF_VIEW_COL_HEADER').val(fitxt);
		$('#WF_VIEW_COL_DATA').val(vatxt);
		$('#WF_VIEW_COL_ALIGN').val(altxt);
		$('#WF_VIEW_COL_SIZE').val(witxt);
		$('#WF_VIEW_COL_ORDER').val(ortxt);
		$('#WF_R_TOTAL').val(totaltxt);
	}
	<?php } ?>
	function show_div_url(txt){
		if(txt == "L"){
			$('#DIV_WF_MAIN_URL').show();
			$('#DIV_WF_PARENT_USE').hide();
			$('#DIV_WF_SERVICES_TYPE').hide();
		}else if(txt == 'S'){
			$('#DIV_WF_MAIN_URL').hide();
			$('#WF_MAIN_URL').val('');
			$('#DIV_WF_PARENT_USE').hide();
			$('#DIV_WF_SERVICES_TYPE').show();
		}else{
			$('#DIV_WF_MAIN_URL').hide();
			$('#WF_MAIN_URL').val('');
			$('#DIV_WF_PARENT_USE').show();
			$('#DIV_WF_SERVICES_TYPE').hide();
		}
	}
	function show_div_parent(id){
		if(id == ''){
			$('#DIV_WF_PARENT_FIELD').hide();
			$('#WF_PARENT_FIELD').removeAttr('required');
			$("#WF_PARENT_FIELD option[value='']").prop('selected', true).trigger("liszt:updated");
			
			$('#DIV_WF_PARENT_SHOW').hide();
			$('#WF_PARENT_SHOW').removeAttr('required');
			$('#WF_PARENT_SHOW').val('');
		}else{
			$('#DIV_WF_PARENT_FIELD').show();
			$('#WF_PARENT_FIELD').attr('required','true');
			
			$('#DIV_WF_PARENT_SHOW').show();
			$('#WF_PARENT_SHOW').attr('required','true');
		}
	}
// Sortable rows
	$('.sorted_table').sortable({
	  containerSelector: 'table',
	  itemPath: '> tbody',
	  itemSelector: 'tr',
	  placeholder: '<tr class="placeholder"/>'
	});

// Sortable column heads
	var oldIndex;
	$('.sorted_head tr').sortable({
	  containerSelector: 'tr',
	  itemSelector: 'th',
	  placeholder: '<th class="placeholder"/>',
	  vertical: false,
	  onDragStart: function ($item, container, _super) {
		oldIndex = $item.index();
		$item.appendTo($item.parent());
		_super($item, container);
	  },
	  onDrop: function  ($item, container, _super) {
		var field,
			newIndex = $item.index();

		if(newIndex != oldIndex) {
		  $item.closest('table').find('tbody tr').each(function (i, row) {
			row = $(row);
			if(newIndex < oldIndex) {
			  row.children().eq(newIndex).before(row.children()[oldIndex]);
			} else if (newIndex > oldIndex) {
			  row.children().eq(newIndex).after(row.children()[oldIndex]);
			}
		  });
		}

		_super($item, container);
		
		arrange_col('data_position');
		
	  }
	});
	$('.fi_val').typeahead({
		source: [<?php echo $fi_val; ?>]
	});
	$('.va_val').typeahead({
		source: [<?php echo $va_val; ?>]
	});
	$('.or_val').typeahead({
		source: [<?php echo $or_val; ?>]
	});

	show_div_url('<?php echo $rec['WF_MAIN_TYPE']; ?>');
	show_div_parent('<?php echo $rec['WF_PARENT_USE']; ?>');
	
	function select_all(){
		var i;
		var num_rows = $('#num_i').val();
		
		$("#check_all").change(function() {
			if(this.checked) {
				for(i=1;i<num_rows;i++){
			
					$('#access_check'+i).prop('checked', true);
				}
			}else{
				
				for(i=1;i<num_rows;i++){
					
					$('#access_check'+i).prop('checked', false);
				}
			}
		});
		
	}
	
	function show_per_page(obj)
	{
		if(obj.checked == true)
		{
			$('#div_per_page').show();
		}
		else
		{
			$('#div_per_page').hide();
		}
	}
</script>
<?php } include '../include/combottom_admin.php'; ?>