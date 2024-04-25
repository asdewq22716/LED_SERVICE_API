<?php
 if($_POST['proc'] == 'get_command') {

	include "../include/include.php";
	
    $SYS_DETAIL = $_POST['get_option'];

    $sql_ser = db::query("SELECT DISTINCT SERVICE_NAME,SERVICE_CODE,SYS_DETAIL  FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = '$SYS_DETAIL'");
    ?>
	
	<select name="SERVICE_NAME" id="SERVICE_NAME" class="form-control select2 " placeholder="ทั้งหมด" tabindex="-1" aria-hidden="true">
	
    	<?php

    	echo "<option value='' >กรุณาเลือก</option>"; 
		while($data_ser = db::fetch_array($sql_ser)) {	
		$name = $data_ser['SERVICE_NAME'];
		$id = $data_ser['SERVICE_CODE'];
			if ($data_ser['SERVICE_NAME'] != ""){
			?>
				<option value="<?php echo $name;?>"
				<?php if ($SERVICE_NAME == $name){echo 'selected';} ?>> <?php echo '['.$id.']'.' '.$name; ?></option>
			<?php
			}
		}
   	 	?>
	
	</select>

<?php
    exit;
}

?>
<?php
	include '../include/comtop_user.php';
	$W = $_GET['W'];
	$SERVICE_NAME = $_GET['SERVICE_NAME'];
	$SYS_DETAIL = $_GET['SYS_DETAIL'];
	$WF_SCREEN_NO = "MM#".$W;
	$sql_main = db::query("SELECT * FROM WF_MAIN WHERE WF_MAIN_ID = '".$W."'");
	$rec_main = db::fetch_array($sql_main);
	$wf_page = $_GET['wf_page'];
	$wf_limit = $_GET['wf_limit'] == "" ? 20 : $_GET['wf_limit'];
	if($wf_page == ''){
		$wf_page = 1;
	}
	$wf_offset = ($wf_page-1)*$wf_limit;

    $filter = " ";
	$PRIVILEGE_GROUP_ID = $_GET['PRIVILEGE_GROUP_ID'];

	if($PRIVILEGE_GROUP_ID != ""){
       $filter .= " AND PRIVILEGE_GROUP_ID = '".$PRIVILEGE_GROUP_ID ."' ";
	}

	$field=" * ";
	$table= " M_PRIVILEGE_GROUP ";
	$wh=" 1=1 {$filter}";
	$orderby=" order by PRIVILEGE_GROUP_ID desc ";

	$sql = "select  ".$field." from ".$table." where ".$wh ." ".$orderby;
	$query = db::query($sql);
	$rec = db::fetch_array($query);

	$filter1 = " ";
	
	if($SERVICE_NAME != ""){
       $filter1 .= " AND SERVICE_NAME = '".$SERVICE_NAME ."' ";
	}
	if($SYS_DETAIL != ""){
		$filter1 .= " AND SYS_DETAIL = '".$SYS_DETAIL ."' ";
	 }

?>
<style>
	.card-header{
		border-bottom:0px;
	}
</style>
<link rel="stylesheet" type="text/css" href="../assets/css/sortable.css">
<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row" id="animationSandbox">
            <div class="col-sm-12">
                <div class="main-header">
                    <div class="media m-b-12">
						<a class="media-left" href="<?php echo $link_back_home; ?>">
							<?php if($rec_main['WF_MAIN_ICON'] != ""){ echo "<img src=\"../icon/".$rec_main['WF_MAIN_ICON']."\" class=\"media-object\">"; } ?>
						</a>
                        <div class="media-body">
                            <h4 class="m-t-5">&nbsp;</h4>
                            <h4><?php echo  $report_name = $rec_main['WF_MAIN_NAME'];?></h4>
                        </div>
                    </div>
                    <div class="f-right">
						<a class="btn btn-danger waves-effect waves-light" href="mapping_api.php?W=59" role="button"><i class="icofont icofont-home"></i> กลับหน้าหลัก</a>
					</div>
                </div>
            </div>
        </div>
		
        <!-- Row end -->
		
        <!--Workflow row start-->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div id="wf_space" class="card-header">
							<form method="get" id="form_wf_search" name="form_wf_search" action="#">
								<h4><i class="icofont icofont-search-alt-2"></i> ค้นหา</h4>
								<div class="form-group row">
								<input type="hidden" name="W" id="W" value="<?php echo $W; ?>">
								<input type="hidden" name="PRIVILEGE_GROUP_ID" id="PRIVILEGE_GROUP_ID" value="<?php echo $PRIVILEGE_GROUP_ID;?>">
								
									<div id="SYS_DETAIL_BSF_AREA" class="col-md-2 offset-md-1">
										<label for="SYS_DETAIL" class="form-control-label wf-right">ระบบ</label>
									</div>

									<div id="SYS_DETAIL_BSF_AREA" class="col-md-2 wf-left">
										<select name="SYS_DETAIL" id="SYS_DETAIL" class="form-control select2 " tabindex="-1" aria-hidden="true" onchange="fetch_select(this.value) ;">
											<option value="" selected>ทั้งหมด</option>
									
											<?php
											$sql_sys = db::query("SELECT DISTINCT SYS_DETAIL,SYS_NAME  FROM M_SERVICE_MANAGE");
											

											while($data_sys = db::fetch_array($sql_sys)){
												$name = $data_sys['SYS_DETAIL'];
												$sys = $data_sys['SYS_NAME'];
												if ($data_sys['SYS_DETAIL'] != ""){
												?>
													<option value ="<?php echo $name;?>"
													<?php if ($SYS_DETAIL == $name){echo 'selected';} ?>> <?php echo $name; ?></option>
												<?php
													}
												}
												?>
										</select>
										<span class="select2 select2-container select2-container--default" dir="ltr" style="width: 215.7px;"><span class="selection"></div>

										<div id="SERVICE_NAME_BSF_AREA" class="col-md-2 ">
										<label for="SERVICE_NAME" class="form-control-label wf-right">ชื่อ Service</label>
									</div>
									<div id="SERVICE_NAME_BSF_AREA" class="col-md-3 ">
										<div id="shw_service">
                                          

										<select name="SERVICE_NAME" id="SERVICE_NAME" class="form-control select2 " placeholder="ทั้งหมด" tabindex="-1" aria-hidden="true" value="">
											<option value="" selected>ทั้งหมด</option>
											<?php
											$sql_ser = db::query("SELECT DISTINCT SERVICE_NAME,SERVICE_CODE  FROM M_SERVICE_MANAGE");

											while($data_ser = db::fetch_array($sql_ser)) {	
												$name = $data_ser['SERVICE_NAME'];
												$id = $data_ser['SERVICE_CODE'];
												if ($data_ser['SERVICE_NAME'] != ""){
												?>
													<option value="<?php echo $name;?>"
													<?php if ( $SERVICE_NAME == $name){echo 'selected';} ?>> <?php echo '['.$id.']'.' '.$name; ?></option>
												<?php
													}
												}
												?>
										
											
										</select>
										</div>
									</div>

									<div class="col-md-12 text-center">

										<button type="submit" name="wf_search" id="wf_search" class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
										&nbsp;&nbsp;

										<button type="button" name="wf_reset" id="wf_reset" class="btn btn-warning" onclick="window.location.href='mapping_api_form.php?W=<?php echo $W;?>&PRIVILEGE_GROUP_ID=<?php echo $PRIVILEGE_GROUP_ID;?>';"><i class="zmdi zmdi-refresh-alt"></i> Reset</button>
										
									</div>
								</div>
							</form>


							<form method="post" enctype="multipart/form-data" id="form_wf" name="form_wf" action="../save/save_check_service.php">
								
								
								<div class="form-group row">
									<div class="text-left">
										<label style="width:500px;"  for="label_task" class="text">
										</label>

										<label style="width:300px;"  for="label_task" class="text">
											<b>ชื่อกลุ่ม &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<?php echo $rec['PRIVILEGE_GROUP_NAME'];?></b>
										</label>

										<label style="width:;"  for="label_task" class="text">
											<b>สถานะ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<?php if ($rec['PRIVILEGE_GROUP_STATUS'] == 0) {
														echo "ไม่ใช้งาน";
															} else {
																echo "ใช้งาน";
															}
														?>
											</b>
										</label>
									</div>
								</div>
								<br>
							<table cellspacing="0" id="SERVICE_MANAGE_ID" class="table table-bordered sorted_table">
								<thead class="bg-primary">
									<tr>
										<?php /*<th style="width:;" class="text-center">
										<input type="checkbox" id="chkall_service" name="checkall_service" value="1"></th>*/ ?>
										<th style="width:;" class="text-center">ลำดับ</th>
										<th style="width:;" class="text-center">Service Code</th>
										<th style="width:;" class="text-center">ชื่อ Service</th>
										<th style="width:;" class="text-center">คำอธิบาย Service</th>
										<th style="width:;" class="text-center">ระบบ</th>
										<th style="width:;" class="text-center">สถานะ</th>
										<th style="width:;" class="text-center"> </th>
									</tr>
								</thead>
								<tbody>
								<?php
									$sql = "SELECT * FROM M_SERVICE_MANAGE WHERE 1=1  {$filter1}";
									$query = db::query($sql);
									// echo $sql;
									$i = 1;
									while($data = db::fetch_array($query)){

									$chk_ed= " ";
									$a = db::query("SELECT * FROM SERVICE_MAPPING_GROUP WHERE PRIVILEGE_GROUP_ID = '".$PRIVILEGE_GROUP_ID."' AND SERVICE_MANAGE_ID = '".$data['SERVICE_MANAGE_ID']."'");
									$n = db::num_rows($a);
									$b = db::fetch_array($a);
									if($n > 0){
										$chk_ed = 'checked';
									}
								

									?>
								
								<tr>
									<?php /*<td class="text-center" >
										<input <?php echo $chk_ed; ?> type="checkbox" id="chk_service" name="chk_service[]" value="<?php echo $data['SERVICE_MANAGE_ID']; ?>">
									</td>*/ ?>
									<td style="width:;" class="text-center"><?php echo $i;?></td>
									<td style="width:;" class="text-left"><?php echo $data['SERVICE_CODE'];?></td>
									<td style="width:;" class="text-left"><?php echo $data['SERVICE_NAME'];?></td>
									<td style="width:;" class="text-left"><?php echo $data['SERVICE_DESC'];?></td>
									<td style="width:;" class="text-left"><?php echo $data['SYS_DETAIL'];?></td>
									<td style="width:;" class="text-center"><?php if ($b['MAPPING_STATUS'] == 1 ) {
																			echo "มีการจัดการ";
																				} else {
																					echo "ไม่มีการจัดการ";
																				}
																			?>
																			</td>
									<td style="text-align:center;" class="td_remove">
										<nobr>
											<?php /*<a href="#!" class="btn btn-info btn-mini"
												title="" data-toggle="modal" data-target="#bizModal" onclick="open_modal('../all_modal/modal_service_manage_detail.php?ID=<?php echo $data['SERVICE_MANAGE_ID']; ?>&PRIVILEGE_GROUP_ID=<?php echo $PRIVILEGE_GROUP_ID;?>&SETTING_ID=<?php echo $b['API_SETTING_ID'];?>&view=1', '','')">
												<i class="icofont icofont-ui-add"></i> ดูรายละเอียด
											</a>*/ ?>

											<a  class="btn btn-success btn-mini" href="http://103.208.27.224:81/led_service_api/form/api_manual_info.php?SERVICE_ID=<?php echo $data['SERVICE_MANAGE_ID']?>&PRIVILEGE_GROUP_ID=<?php echo $PRIVILEGE_GROUP_ID;?>">
												<i class="icofont icofont-ui-edit"></i> กำหนดรายการ SERVICE
											</a>
										</nobr>
			 						</td>
								</tr>

								<?php
									$i++;
								}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
        <!-- Workflow Row end -->
			<?php /*<div class="row">
				<div class="col-md-12">
					<div class="wf-right">&nbsp;
							<button type="submit" class="btn btn-success waves-effect waves-light"><i class="icofont icofont-tick-mark" title=""></i> บันทึก</button>
						<input type="hidden" name="W" value="<?php echo $W; ?>">
						<input type="hidden" name="PRIVILEGE_GROUP_ID" value="<?php echo $PRIVILEGE_GROUP_ID ?>">
					</div>
				</div>
			</div>*/ ?>
		</form>
    </div>
    <!-- Container-fluid ends -->
</div>

<?php
	include '../include/combottom_js_user.php';
	include '../include/combottom_user.php';
?>
<script>

	$('#chkall_service').click(function(){

		if($(this).is(':checked',true)){
			$('[id*=chk_service]').prop('checked',true);
		}else {
			$('[id*=chk_service]').prop('checked',false);
		}
	});
	function formatState (state) {
	if (!state.id) { return state.text; }
	var $state = $(
	'<span>' + state.text.replace(/(?:\r\n|\r|\n)/g, '<br />') + '</span>'
	);
	return $state;
}
	function fetch_select(val) {
	
    	$.ajax({
        type: 'post',
        url: '../form/mapping_api_form.php',
        data: {
            get_option: val,
            proc: 'get_command'
        },
        success: function(response) {
            $("#shw_service").html(response);
            $("#SERVICE_NAME").select2({
				templateResult: formatState
	});
        }
    });

}

</script>
