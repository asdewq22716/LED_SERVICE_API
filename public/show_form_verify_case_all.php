<?php
session_start(); 
$_SESSION["WF_USER_ID"] = "-1";
$_REQUEST['wfp']="WNzNrMmw0ZTR3NDA1ZzRhNHI0bzRmM3E1aTRwNHEzdzNiMjM0eTJ1Mm8zaTNvMw==";
include '../include/comtop_public.php';

foreach($_GET as $key => $val){
	$$key = conText($val);
}
foreach($_POST as $key => $val){
	$$key = conText($val);
}

$SYSTEM_ID = $SYSTEM_ID == "" ? 1 : $SYSTEM_ID; 

$wf_limit = $_GET['wf_limit'] == "" ? 20 : $_GET['wf_limit'];

// $pccCivilGen = '3816498';
// $systemType = '1';

if($systemType==1){
	$SYSTEM_ID = 1;
	$sqlSelectCase = "	SELECT	PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,PREFIX_RED_CASE,RED_CASE,RED_YY,COURT_CODE,CIVIL_CODE
						FROM 	WH_CIVIL_CASE
						WHERE	CIVIL_CODE = '".$pccCivilGen."'";
	$querySelectCase = db::query($sqlSelectCase);
	$dataSelectCase = db::fetch_array($querySelectCase);
	
	$PREFIX_BLACK_CASE 	= $dataSelectCase["PREFIX_BLACK_CASE"];
	$BLACK_CASE 		= $dataSelectCase["BLACK_CASE"];
	$BLACK_YY 			= $dataSelectCase["BLACK_YY"];
	$PREFIX_RED_CASE 	= $dataSelectCase["PREFIX_RED_CASE"];
	$RED_CASE 			= $dataSelectCase["RED_CASE"];
	$RED_YY 			= $dataSelectCase["RED_YY"];
	$COURT_CODE 		= $dataSelectCase["COURT_CODE"];
	
	if($dataSelectCase["CIVIL_CODE"]==""){
		
		getCivilToWh($pccCivilGen);
		
		$sqlSelectData = "	SELECT 	CIVIL_CODE,
									COURT_CODE,
									PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,
									PREFIX_RED_CASE,RED_CASE,RED_YY
							FROM 	WH_CIVIL_CASE
							WHERE 	CIVIL_CODE = '".$pccCivilGen."' ";
		$querySelectData = db::query($sqlSelectData);
		$dataSelectData = db::fetch_array($querySelectData);
		
		$PREFIX_BLACK_CASE 	= $dataSelectCase["PREFIX_BLACK_CASE"];
		$BLACK_CASE 		= $dataSelectCase["BLACK_CASE"];
		$BLACK_YY 			= $dataSelectCase["BLACK_YY"];
		$PREFIX_RED_CASE 	= $dataSelectCase["PREFIX_RED_CASE"];
		$RED_CASE 			= $dataSelectCase["RED_CASE"];
		$RED_YY 			= $dataSelectCase["RED_YY"];
		$COURT_CODE 		= $dataSelectCase["COURT_CODE"];
		
	}
}

?>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div id="wf_space" class="card-header">
						<form method="get" id="form_wf_search" name="form_wf_search" action="#">
							<input type="hidden" name="process" id="process" value="">
							<input type="hidden" name="wf_page" id="wf_page" value="<?php echo $_GET["wf_page"];?>">
							<div class="form-group row">
								<div id="SEND_TO_BSF_AREA" class="col-md-2 ">
									<label for="SEND_TO" class="form-control-label wf-right">คำสั่ง/สอบถาม/แจ้ง จากระบบงาน <span class="text-danger">*</span></label>
								</div>
								<div id="SEND_TO_BSF_AREA" class="col-md-4 wf-left">
									<select name="SYSTEM_ID" id="SYSTEM_ID"   class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" required onChange="//showFormPerType();"> 
										<option value="" disabled selected>เลือกระบบงาน</option>
										<?php
										$sql = "SELECT * FROM M_CMD_SYSTEM WHERE 1=1 AND CMD_SYSTEM_ID NOT IN (5, 6) ORDER BY CMD_SYSTEM_ID ASC";
										$query = db::query($sql);
										while($rec = db::fetch_array($query)){
											?>
											<option value="<?php echo $rec['CMD_SYSTEM_ID']; ?>"<?php echo $SYSTEM_ID == $rec['CMD_SYSTEM_ID'] ?'SELECTED':''?>><?php echo $rec['SERVICE_SYS_NAME']; ?></option>
											<?php
										}
										?>
									</select>
									<input type="hidden" name="SYSTEM_NAME" id="SYSTEM_NAME" value="">				
								</div>
								<!-- <div class="col-md-2 show_per_type" style="display:none"></div>
								<div class="col-md-1 show_per_type" style="display:none">ประเภทบุคคล</div>
								<div class="col-md-2 show_per_type" style="display:none">
									<label><input type="radio" name="GET_PER_TYPE" id="GET_PER_TYPE" value="1" checked> บุคลากร</label>
									<label><input type="radio" name="GET_PER_TYPE" id="GET_PER_TYPE" value="2"> เจ้าหนี้</label>
								</div> -->
							</div>
							<div class="form-group row">
								<div id="PREFIX_BLACK_CASE_BSF_AREA" class="col-md-2 ">
									<label for="PREFIX_BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำ</label>
								</div>
								<div id="PREFIX_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="PREFIX_BLACK_CASE" id="PREFIX_BLACK_CASE" class="form-control" value="<?php echo $PREFIX_BLACK_CASE ;?>">
									<small id="DUP_PREFIX_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="BLACK_CASE" id="BLACK_CASE" class="form-control" value="<?php echo $BLACK_CASE  ;?>" required>
									<small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
									<div class="row">
										<div id="" class="col-md-1 wf-left">
											ปี
										</div>
										<div id="" class="col-md-5 wf-left">
											<input type="text" name="BLACK_YY" id="BLACK_YY" class="form-control" value="<?php echo $BLACK_YY  ;?>" required>
											<small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
										</div>
									</div>
								</div>

								<div id="PREFIX_RED_CASE_BSF_AREA" class="col-md-2 ">
									<label for="PREFIX_RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดง</label>
								</div>
								<div id="PREFIX_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="PREFIX_RED_CASE" id="PREFIX_RED_CASE" class="form-control" value="<?php echo $PREFIX_RED_CASE ;?>">
									<small id="DUPT_PREFIX_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="RED_CASE" id="RED_CASE" class="form-control" value="<?php echo $RED_CASE ;?>" required>
									<small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
									<div class="row">
										<div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
											ปี
										</div>
										<div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
											<input type="text" name="RED_YY" id="RED_YY" class="form-control" value="<?php echo $RED_YY;?>" required>
											<small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
										</div>
									</div>
								</div>

							</div>
							<div class="form-group row">
								<div id="COURT_CODE_BSF_AREA" class="col-md-2 ">
									<label for="CMD_TYPE" class="form-control-label wf-right">ศาล <span class="text-danger">*</span></label>
								</div>
								<div id="COURT_CODE_BSF_AREA" class="col-md-4 wf-left">
									<select name="COURT_CODE" id="COURT_CODE"   class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" required> 
										<option value="" disabled selected>ทั้งหมด</option>
										<?php
										$sqlCourt = "SELECT COURT_CODE, COURT_NAME FROM M_COURT WHERE 1=1 ORDER BY COURT_CODE ASC";
										$queryCourt = db::query($sqlCourt);
										while($recCourt = db::fetch_array($queryCourt)){
											?>
											<option value="<?php echo $recCourt['COURT_CODE']; ?>" <?php echo ($COURT_CODE==$recCourt['COURT_CODE'])?"selected":"";?>><?php echo $recCourt['COURT_NAME']; ?></option>
											<?php
										}
										?>
									</select>			
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 text-center">
									<button type="submit" name="wf_search" id="wf_search" class="btn btn-primary"><i class="icofont icofont-search-alt-2"></i> ค้นหา</button>
									&nbsp;&nbsp;
									<button type="button" name="wf_reset" id="wf_reset" class="btn btn-warning"><i class="zmdi zmdi-refresh-alt"></i> Reset</button>
								</div>
							</div>
							<div class="table-responsive">
								<label for="data_personel" class="form-control-label wf-left">ตารางข้อมูลบุคคลที่เกี่ยวข้องในคดี</label>
								<table cellspacing="0" id="data_personel" class="table table-bordered sorted_table">
									<thead class="bg-primary">
										<tr class="bg-primary">
											<th style="width: 5%;" class="text-center"><input type="checkbox" name="CHK_ALL" id="CHK_ALL" value="Y" class="checkedAll_1"></th>
											<th style="width: 5%;" class="text-center">ลำดับ</th>
											<th style="width: 25%;" class="text-center">ชื่อ - นามสกุล</th>
											<th style="width: 25%;" class="text-center">ชื่อ - นามสกุล ที่นำไปตรวจสอบ</th>
											<th style="width: 20%;" class="text-center">เกี่ยวข้องเป็น</th>
											<th style="width: 20%;" class="text-center">เลขประจำตัวบัตรประชาชน/เลขทะเบียนนิติบุคคล</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$condSearch = "";
										$cond = "";
										$orderBy = "";
										$chkSearch = 0;
										if($PREFIX_BLACK_CASE != ""){
											$condSearch .= " AND a.PREFIX_BLACK_CASE LIKE '%".$PREFIX_BLACK_CASE."%' ";
										}
										if($BLACK_CASE != ""){
											$condSearch .= " AND a.BLACK_CASE = '".$BLACK_CASE."' ";
											$chkSearch++;
										}
										if($BLACK_YY != ""){
											$condSearch .= " AND a.BLACK_YY = '".$BLACK_YY."' ";
											$chkSearch++;
										}
										if($PREFIX_RED_CASE != ""){
											$condSearch .= " AND a.PREFIX_RED_CASE LIKE '%".$PREFIX_RED_CASE."%' ";
										}
										if($RED_CASE != ""){
											$condSearch .= " AND a.RED_CASE = '".$RED_CASE."' ";
											$chkSearch++;
										}
										if($RED_YY != ""){
											$condSearch .= " AND a.RED_YY = '".$RED_YY."' ";
											$chkSearch++;
										}
										if($COURT_CODE != ""){
											if($SYSTEM_ID != "4"){
												if($COURT_CODE=='050'){
													$condSearch .= " AND a.COURT_CODE in ('050','010030') ";
												}else{
													$condSearch .= " AND a.COURT_CODE = '".$COURT_CODE."' ";
												}
											}else{
												$condSearch .= " AND a.COURT_ID = '".$COURT_CODE."' ";
											}
											$chkSearch++;
										}

										$arrFields = array();
										$arrTable = array();

										$arrFields[1] = "a.WH_CIVIL_ID AS WH_ID"; //ระบบงานบังคับคดีแพ่ง
										$arrFields[2] = "a.WH_BANKRUPT_ID AS WH_ID"; //ระบบงานบังคับคดีล้มละลาย
										$arrFields[3] = "a.WH_REHAB_ID AS WH_ID"; //ระบบงานฟื้นฟูกิจการของลูกหนี้
										$arrFields[4] = "a.WH_MEDAITE_ID AS WH_ID"; //ระบบงานไกล่เกลี่ยข้อพิพาท

										$arrTable[1] = "WH_CIVIL_CASE a INNER JOIN ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." b ON a.WH_CIVIL_ID = b.WH_CIVIL_ID"; //ระบบงานบังคับคดีแพ่ง
										$arrTable[2] = "WH_BANKRUPT_CASE_DETAIL a INNER JOIN WH_BANKRUPT_CASE_PERSON b ON a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID"; //ระบบงานบังคับคดีล้มละลาย
										$arrTable[3] = "WH_REHABILITATION_CASE_DETAIL a INNER JOIN WH_REHABILITATION_PERSON b ON a.WH_REHAB_ID = b.WH_REHAB_ID"; //ระบบงานฟื้นฟูกิจการของลูกหนี้
										$arrTable[4] = "WH_MEDIATE_CASE a INNER JOIN WH_MEDIATE_PERSON b ON a.WH_MEDAITE_ID = b.WH_MEDIATE_ID"; //ระบบงานไกล่เกลี่ยข้อพิพาท
										$sqlSelectData = "SELECT ".$arrFields[$SYSTEM_ID].", b.PREFIX_NAME, b.FIRST_NAME, b.LAST_NAME, b.CONCERN_NAME, b.REGISTER_CODE
										FROM ".$arrTable[$SYSTEM_ID]." WHERE 1=1".$cond.$condSearch.$orderBy; 
										$i=1;
										$querySelectData = db::query($sqlSelectData);
										$rowsSelectDataP = db::num_rows( "SELECT ".$arrFields[$SYSTEM_ID]." FROM ".$arrTable[$SYSTEM_ID]." WHERE 1=1".$cond.$condSearch);
										if($rowsSelectDataP > 0 && $chkSearch >= 5){
											while($dataSelectData = db::fetch_array($querySelectData)){
												?>
												<tr>
													<td align="center">
														<input type="checkbox" name="REGISTER_CODE[<?php echo $i;?>]" id="REGISTER_CODE_<?php echo $i;?>" value="<?php echo $dataSelectData['REGISTER_CODE'];?>" class="checkSingle_1">
														<input type="hidden" name="CONCERN_NAME[<?php echo $i;?>]" id="CONCERN_NAME_<?php echo $i;?>" value="<?php echo $dataSelectData['CONCERN_NAME'];?>" disabled>
													</td>
													<td align="center"><?php echo $i;?></td>
													<td><?php echo $dataSelectData['PREFIX_NAME'].$dataSelectData['FIRST_NAME']." ".$dataSelectData['LAST_NAME'];?></td>
													<td><?php echo $dataSelectData['PREFIX_NAME'].$dataSelectData['FIRST_NAME']." ".$dataSelectData['LAST_NAME'];?></td>
													<td><?php echo $dataSelectData["CONCERN_NAME"];?></td>
													<td><?php echo $dataSelectData["REGISTER_CODE"];?></td>
												</tr>
												<?php
												$i++;
											}
										}else{
											echo '<tr><td align="center" colspan="6">ไม่พบข้อมูล</td></tr>';
										}
										?>
									</tbody>
								</table>
							</div>
							<?php if($SYSTEM_ID == "1" || $SYSTEM_ID == "2"){ ?>
								<div class="table-responsive">
									<label for="data_personel" class="form-control-label wf-left">ตารางข้อมูลทรัพย์สินที่เกี่ยวข้องในคดี</label>
									<table cellspacing="0" id="data_assets" class="table table-bordered sorted_table">
										<thead class="bg-primary">
											<tr class="bg-primary">
												<th style="width: 5%;" class="text-center"><input type="checkbox" name="CHK_ALL" id="CHK_ALL" value="Y" class="checkedAll_2"></th>
												<th style="width: 5%;" class="text-center">ลำดับ</th>
												<th style="width: 20%;" class="text-center">ประเภททรัพย์</th>
												<th style="width: 50%;" class="text-center">รายละเอียดทรัพย์</th>
												<th style="width: 20%;" class="text-center">สถานะทรัพย์</th>
											</tr>
										</thead>
										<tbody>
											<?php
										// $condSearch = "";
										// $cond = "";
										// $orderBy = "";

										$arrTableAssets[1] = "WH_CIVIL_CASE a INNER JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID = b.WH_CIVIL_ID"; //ระบบงานบังคับคดีแพ่ง
										$arrTableAssets[2] = "WH_BANKRUPT_CASE_DETAIL a INNER JOIN WH_BANKRUPT_ASSETS b ON a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID"; //ระบบงานบังคับคดีล้มละลาย
										$sqlSelectData = "SELECT ".$arrFields[$SYSTEM_ID].", b.TYPE_CODE_NAME, b.PROP_TITLE, b.PROP_STATUS_NAME
										FROM ".$arrTableAssets[$SYSTEM_ID]." WHERE 1=1".$cond.$condSearch.$orderBy; 
										$i=1;
										$querySelectData = db::query($sqlSelectData);
										$rowsSelectDataA = db::num_rows( "SELECT ".$arrFields[$SYSTEM_ID]." FROM ".$arrTableAssets[$SYSTEM_ID]." WHERE 1=1".$cond.$condSearch);
										if($rowsSelectDataA > 0 && $chkSearch >= 5){
											while($dataSelectData = db::fetch_array($querySelectData)){

												?>
												<tr>
													<td align="center"><input type="checkbox" name="WH_ID[<?php echo $dataSelectData['WH_ID'];?>]" id="WH_ID_<?php echo $dataSelectData['WH_ID'];?>" value="<?php echo $dataSelectData['WH_ID'];?>" class="checkSingle_2"></td>
													<td align="center"><?php echo $i;?></td>
													<td><?php echo $dataSelectData['TYPE_CODE_NAME'];?></td>
													<td><?php echo $dataSelectData['PROP_TITLE'];?></td>
													<td><?php echo $dataSelectData["PROP_STATUS_NAME"];?></td>
												</tr>
												<?php
												$i++;
											}
										}else{
											echo '<tr><td align="center" colspan="5">ไม่พบข้อมูล</td></tr>';
										}
										?>
									</tbody>
								</table>
							</div>
						<?php } ?>
					</form>
					<?php if($rowsSelectDataP > 0 || $rowsSelectDataA >0){ ?>
						<div class="form-group row">
							<div class="col-md-12 text-center">
								<button type="button" name="check_wh" id="check_wh" class="btn btn-info">ตรวจสอบ</button>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="checking_load" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="text-center">
						<img src="../assets/images/loading.gif" class="img-responsive" alt="Image" style="width: 100px;">
					</div>
					<div class="text-center">
						<strong></strong>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
include '../include/combottom_js_user.php'; 
include '../include/combottom_user.php'; 
?>
<script>
	$(document).ready(function() {
		$('select.select2').select2({
			allowClear: true,
			placeholder: function(){
				$(this).data('placeholder');
			}
		});
		$('#wf_reset').click(function(){
			$('#form_wf_search select').val('');
			$('#form_wf_search input[type="text"]').val('');
			$('#form_wf_search #SYSTEM_ID').val(1);
			window.location.href='show_form_verify_case_all.php';
		});
		$('#check_wh').click(function(){
			$('#checking_load').modal('show');
			$('#checking_load strong').text("กำลังตรวจสอบ");
			$('#checking_load img').attr("src","../assets/images/loading.gif");
			$('#SYSTEM_NAME').val($('#SYSTEM_ID option:selected').text());
			var dataForm = $("#form_wf_search").serialize();
			$.ajax({
				type: "POST",
				url:  'save_verify_case_all.php',
				data: dataForm,
				success: function(response){
					// var data = JSON.parse(response);
					// console.log(data);
					$('#checking_load img').attr("src","../assets/images/check_sucess.png");
					$('#checking_load strong').text("ตรวจสอบเสร็จสิ้น");
					setTimeout(function(){
						$('#checking_load').modal('hide');
					}, 2500);
				}
			});
		});
		$("[class^=checkedAll]").change(function() {
			let i = $(this).attr("class").split("_")[1];
			if (this.checked) {
				$(".checkSingle_"+i).each(function() {
					this.checked=true;
					let ids = this.id.split("_");
					$('#CONCERN_NAME_'+ids[2]).prop("disabled", false);
				});
			} else {
				$(".checkSingle_"+i).each(function() {
					this.checked=false;
					let ids = this.id.split("_");
					$('#CONCERN_NAME_'+ids[2]).prop("disabled", true);
				});
			}
		});
		$("[class^=checkSingle]").change(function() {
			let i = $(this).attr("class").split("_")[1];
			let ids = this.id.split("_");
			if ($(this).is(":checked")) {
				var isAllChecked = 0;

				$(".checkSingle_"+i).each(function() {
					if (!this.checked)
						isAllChecked = 1;
				});

				if (isAllChecked == 0) {
					$(".checkedAll_"+i).prop("checked", true);
				}     
				$('#CONCERN_NAME_'+ids[2]).prop("disabled", false);
			}else {
				$(".checkedAll_"+i).prop("checked", false);
				$('#CONCERN_NAME_'+ids[2]).prop("disabled", true);
			}
		});
	});
	// function showFormPerType(){
	// 	console.log($('#SYSTEM_ID').val());
	// 	if($('#SYSTEM_ID').val()==5){
	// 		$('.show_per_type').show();
	// 		$('.show_class_required').hide();
	// 	}else{
	// 		$('.show_per_type').hide();
	// 		$('.show_class_required').show();
	// 	}
	// }
</script>