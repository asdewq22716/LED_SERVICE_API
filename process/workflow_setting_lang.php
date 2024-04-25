<?php
include '../include/comtop_admin.php';

$W = conText($_GET['W']);

$sql_data = db::query("SELECT WF_MAIN_NAME,WF_MAIN_SHORTNAME,WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."' ");
$rec = db::fetch_array($sql_data);

$sql_detail = db::query("SELECT WFD_ID,WFD_NAME,WFD_TYPE FROM WF_DETAIL WHERE WF_MAIN_ID = '".$W."' ");


if($rec['WF_TYPE'] == 'W'){
	$p_name = "Workflow:";
	
}elseif($rec['WF_TYPE'] == 'F'){
	$p_name = "Form:";

}elseif($rec['WF_TYPE'] == 'M'){
	$p_name = "Master:";
}elseif($rec['WF_TYPE'] == 'R'){
	$p_name = "Report:";
}
?>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header"> 
					<h4><?php echo $rec['WF_MAIN_NAME']; ?></h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow"></ol>
				</div>
			</div>
		</div>
		<form action="workflow_setting_lang_function.php" method="post" id="form_wf">
				<input type="hidden" name="process" id="process" value="save_lang">
				<input type="hidden" name="W" id="W" value="<?php echo $W;?>">
		<div class="row">
			<div class="col-md-12">
                <div class="card">
					<div class="card-block">
							<div class="card-header">
								<h5 class="card-header-text">
									<i class="icofont icofont-ui-folder"></i> รายการ
								</h5>
								<div class="f-right">
									<button class="btn btn-warning waves-effect waves-light" role="button">
										<i class="icofont icofont-save"></i> บันทึก
									</button>
								</div>
							</div>
					<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
						<thead>
							<tr class="bg-primary">
								<th class="text-center" style="width:15%">ชื่อ Field</th>
								<th class="text-center" style="width:15%">ข้อความ</th>
								<?php
								$lang_arr = array();
								$lg = 0;
								$sql_lang = db::query("select * from WF_LANGUAGE ORDER BY LANG_ORDER ASC");
								while($L=db::fetch_array($sql_lang)){ ?>
								<th class="text-center" style="width:15%"><?php echo $L['LANG_NAME']; ?></th>
								<?php
								$lang_arr[$lg] = $L['LANG_ID'];
								$lg++;
								}
								
								?>
							</tr>
						</thead>
						<tbody>
							<tr class="bg-info">
								<td colspan="2"><h5><?php echo $p_name.$rec['WF_MAIN_NAME']; ?><input type="hidden" name="wfcode_0" value="W"><input type="hidden" name="wfref_0" value="<?php echo $W;?>"></h5></td> 
								<?php foreach($lang_arr as $key=>$val){ ?>
								<td><input type="text" name="wflang_0_<?php echo $key; ?>" class="form-control" value="<?php echo bsf_language_m("W",$W,$val); ?>"></td>
								<?php } ?>
							</tr>
							<?php
							$n = 1;
							if($rec['WF_TYPE'] == 'W'){
							while($data_detail = db::fetch_array($sql_detail)){
								//$i=1;
								$sql_sf = db::query("select WFS_ID,FORM_MAIN_ID,WFS_NAME,WFS_FIELD_NAME from WF_STEP_FORM where WF_MAIN_ID = '".$W."' AND WFD_ID='".$data_detail["WFD_ID"]."' AND WF_TYPE = '".$rec['WF_TYPE']."' ORDER BY WFS_ORDER");
								?>
								<tr style="background-color:#AEADA8;">
									<td colspan="2">
										<h6 style="color:#FFF"><?php echo $data_detail['WFD_NAME']; ?><input type="hidden" name="wfcode_<?php echo $n;?>" value="WFD"><input type="hidden" name="wfref_<?php echo $n;?>" value="<?php echo $data_detail["WFD_ID"];?>"></h6>
									</td> 
									<?php foreach($lang_arr as $key=>$val){ ?>
									<td><input type="text" name="wflang_<?php echo $n;?>_<?php echo $key; ?>" class="form-control" value="<?php echo bsf_language_m("WFD",$data_detail["WFD_ID"],$val); ?>"></td>
									<?php  } $n++;?>
								</tr>
								
								<?php
								while($rec_sf = db::fetch_array($sql_sf)){ ?>
								<tr>
									<td><?php echo $rec_sf["WFS_FIELD_NAME"];?><input type="hidden" name="wfcode_<?php echo $n;?>" value="WFS"><input type="hidden" name="wfref_<?php echo $n;?>" value="<?php echo $rec_sf["WFS_ID"];?>"></td>
									<td><?php echo $rec_sf["WFS_NAME"];?></td>
									<?php foreach($lang_arr as $key=>$val){ ?>
									<td><input type="text" name="wflang_<?php echo $n;?>_<?php echo $key; ?>" class="form-control" value="<?php echo bsf_language_m("WFS",$rec_sf["WFS_ID"],$val); ?>"></td>
									<?php } $n++; ?>
								</tr>
								<?php //$i++; 
								} 
							
							}
							}else{?> 
							<?php 
								$sql_sf = db::query("select WFS_ID,FORM_MAIN_ID,WFS_NAME,WFS_FIELD_NAME from WF_STEP_FORM where WF_MAIN_ID = '".$W."' AND WF_TYPE = '".$rec['WF_TYPE']."' ORDER BY WFS_ORDER");
								
								while($rec_sf = db::fetch_array($sql_sf)){ ?>
								<tr>
									<td><?php echo $rec_sf["WFS_FIELD_NAME"];?><input type="hidden" name="wfcode_<?php echo $n;?>" value="WFS"><input type="hidden" name="wfref_<?php echo $n;?>" value="<?php echo $rec_sf["WFS_ID"];?>"></td>
									<td><?php echo $rec_sf["WFS_NAME"];?></td>
									<?php foreach($lang_arr as $key=>$val){ ?>
									<td><input type="text" name="wflang_<?php echo $n;?>_<?php echo $key; ?>" class="form-control" value="<?php echo bsf_language_m("WFS",$rec_sf["WFS_ID"],$val); ?>"></td>
									<?php } $n++; ?>
								</tr>
								<?php //$i++; 
								} 
							}?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="all_i" id="all_i" value="<?php echo $n;?>">
		</form>
	</div>
</div>

<?php 
include '../include/combottom_js.php'; 
?>
<script>  

</script>
<?php
include '../include/combottom_admin.php'; ?>