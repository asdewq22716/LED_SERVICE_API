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
?>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div id="wf_space" class="card-header">
						<form method="get" id="form_wf_search" name="form_wf_search" action="#">
							<input type="hidden" name="process" id="process" value="">
							<input type="hidden" name="wf_page" id="wf_page" value="<?php echo $_GET["wf_page"];?>">
							<input type="hidden" name="tab_active" id="tab_active" value="<?php echo $_GET["tab_active"];?>">
							
							<div class="form-group row">
								<div id="SEND_TO_BSF_AREA" class="col-md-2 "><label for="SEND_TO" class="form-control-label wf-right">เลือกระบบงาน</label></div>
								<div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
									<select name="S_CASE_TYPE" id="S_CASE_TYPE"   class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true"> 
										<option value="" disabled selected>เลือกระบบงาน</option>
										<option value="1" <?php echo ($S_CASE_TYPE==1)?"selected":""?>>ระบบงานฟื้นฟูกิจการของลูกหนี้</option>
										<option value="2" <?php echo ($S_CASE_TYPE==2)?"selected":""?>>ระบบงานบังคับคดีล้มละลาย</option>
									</select>					
								</div>
							</div>						
							<div class="form-group row">
								<div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
									<label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำ</label>
								</div>
								<div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="S_PREFIX_BLACK_CASE" id="S_PREFIX_BLACK_CASE" class="form-control" value="<?php echo $S_PREFIX_BLACK_CASE ;?>">
									<small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="S_BLACK_CASE" id="S_BLACK_CASE" class="form-control" value="<?php echo $S_BLACK_CASE  ;?>">
									<small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
									<div class="row">
										<div id="" class="col-md-1 wf-left">
										ปี
										</div>
										<div id="" class="col-md-5 wf-left">
											<input type="text" name="S_BLACK_YY" id="S_BLACK_YY" class="form-control" value="<?php echo $S_BLACK_YY  ;?>">
											<small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
										</div>
									</div>
								</div>

								<div id="RED_CASE_BSF_AREA" class="col-md-2 ">
									<label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดง</label>
								</div>
								<div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="S_PREFIX_RED_CASE" id="S_PREFIX_RED_CASE" class="form-control" value="<?php echo $S_PREFIX_RED_CASE ;?>">
									<small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="S_RED_CASE" id="S_RED_CASE" class="form-control" value="<?php echo $S_RED_CASE ;?>">
									<small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
									<div class="row">
										<div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
										ปี
										</div>
										<div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
											<input type="text" name="S_RED_YY" id="S_RED_YY" class="form-control" value="<?php echo $S_RED_YY;?>">
											<small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
										</div>
									</div>
								</div>

							</div>
							<div class="form-group row">
								<div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
									<label for="BLACK_CASE" class="form-control-label wf-right">เลขประจำตัวประชาชน/<br>เลขทะเบียนนิติบุคคล</label>
								</div>
								<div id="T_BLACK_CASE_BSF_AREA" class="col-md-2 wf-left">
									<input type="text" name="S_REGISTER_CODE" id="S_REGISTER_CODE" class="form-control" value="<?php echo $S_REGISTER_CODE ;?>">
									<small id="S_REGISTER_CODE" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_CASE_BSF_AREA" class="col-md-1"></div>
								<div id="BLACK_CASE_BSF_AREA" class="col-md-2">
									<label for="BLACK_CASE" class="form-control-label wf-right">ชื่อลูกหนี้</label>
								</div>
								<div id="T_BLACK_CASE_BSF_AREA" class="col-md-3 wf-left">
									<input type="text" name="S_FULL_NAME" id="S_FULL_NAME" class="form-control" value="<?php echo $S_FULL_NAME ;?>">
									<small id="S_FULL_NAME" class="form-text text-danger" style="display:none"></small>
								</div>
							</div>
							<div class="form-group row">
								<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 ">
									<label for="S_DUE_DATE" class="form-control-label wf-right">วันที่</label>
								</div>
								<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 wf-left">
									<label class="input-group">
										<input name="S_DUE_DATE" id="S_DUE_DATE" value="<?php echo $S_DUE_DATE;?>" class="form-control datepicker" placeholder="">
										<span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
									</label>
								</div>
								<div id="BLACK_CASE_BSF_AREA" class="col-md-1"></div>
								<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 ">
									<label for="E_DUE_DATE" class="form-control-label wf-right">ถึงวันที่</label>
								</div>
								<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 wf-left">
									<label class="input-group">
										<input name="E_DUE_DATE" id="E_DUE_DATE" value="<?php echo $E_DUE_DATE;?>" class="form-control datepicker" placeholder="">
										<span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
									</label>
								</div>
							</div>

							  
							<div class="form-group row">
								<div class="col-md-12 text-center">
									<button type="submit" name="wf_search" id="wf_search" class="btn btn-primary"> ค้นหา</button>&nbsp;&nbsp;
								</div>
							</div>

							<div class="table-responsive">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
									<thead class="bg-primary">
										<tr class="bg-primary">
											<th style="width: 5%;" class="text-center">ลำดับ</th>
											<th style="width: 15%;" class="text-center">ระบบงาน</th>
											<th style="width: 15%;" class="text-center">ศาล</th>
											<th style="width: 10%;" class="text-center">หมายเลขคดีดำ</th>														
											<th style="width: 10%;" class="text-center">หมายเลขคดีแดง</th>	
											<th style="width: 10%;" class="text-center">เลขประจำตัวประชาชน/เลขทะเบียนนิติบุคคล</th>	
											<th style="width: 25%;" class="text-center">ชื่อลูกหนี้</th>	
											<th style="width: 10%;" class="text-center">ครบกำหนด</th>
										</tr>
									</thead>
									<tbody>
										<?php
										//,,,,,RED_YY,COURT_CODE,COURT_NAME,COMP_PAY_DEPT_DATE,REGISTER_CODE,FULL_NAME
										$filter = "";
										if($S_CASE_TYPE){
											$filter .= " AND CASE_TYPE = '".$S_CASE_TYPE."' ";
										}
										if($S_PREFIX_BLACK_CASE){
											$filter .= " AND PREFIX_BLACK_CASE = '".$S_PREFIX_BLACK_CASE."' ";
										}
										if($S_BLACK_CASE){
											$filter .= " AND BLACK_CASE = '".$S_BLACK_CASE."' ";
										}
										if($S_BLACK_YY){
											$filter .= " AND BLACK_YY = '".$S_BLACK_YY."' ";
										}
										if($S_RED_CASE){
											$filter .= " AND RED_CASE = '".$S_RED_CASE."' ";
										}
										
										if($S_PREFIX_RED_CASE){
											$filter .= " AND PREFIX_RED_CASE = '".$S_PREFIX_RED_CASE."' ";
										}
										if($S_RED_CASE){
											$filter .= " AND RED_CASE = '".$S_RED_CASE."' ";
										}
										if($S_RED_YY){
											$filter .= " AND RED_YY = '".$S_RED_YY."' ";
										}
										if($S_REGISTER_CODE){
											$filter .= " AND REGISTER_CODE = '".$S_REGISTER_CODE."' ";
										}
										if($S_FULL_NAME){
											$filter .= " AND FULL_NAME LIKE '%".$S_FULL_NAME."%' ";
										}
										if($S_DUE_DATE!=""){
											$filter .= " AND TO_CHAR(COMP_PAY_DEPT_DATE,'YYYY-MM-DD') >= '".$S_DUE_DATE."' ";
										}
										if($E_DUE_DATE!=""){
											$filter .= " AND TO_CHAR(COMP_PAY_DEPT_DATE,'YYYY-MM-DD') <= '".$E_DUE_DATE."' ";
										}
										$sqlSelectData = "	SELECT 		* 
															FROM		VIEW_PERSON_PAY_DUE
															WHERE		1=1 {$filter}
															ORDER BY 	COMP_PAY_DEPT_DATE ASC
														 "; 
										$i=1;
										$querySelectData = db::query($sqlSelectData);
										while($dataSelectData = db::fetch_array($querySelectData)){
											?>
											<tr>
												<td align="center"><?php echo $i;?></td>
												<td><?php echo $dataSelectData["CASE_TYPE_NAME"];?></td>
												<td><?php echo $dataSelectData["COURT_NAME"];?></td>
												<td align="center"><?php echo $dataSelectData["PREFIX_BLACK_CASE"].$dataSelectData["BLACK_CASE"]."/".$dataSelectData["BLACK_YY"];?></td>
												<td align="center"><?php echo $dataSelectData["PREFIX_RED_CASE"].$dataSelectData["RED_CASE"]."/".$dataSelectData["RED_YY"];?></td>
												<td align="center"><?php echo $dataSelectData["REGISTER_CODE"];?></td>
												<td><?php echo $dataSelectData["FULL_NAME"];?></td>
												<td align="center"><?php echo db2date($dataSelectData["COMP_PAY_DEPT_DATE"]);?></td>
											</tr>
											<?php
											$i++;
										}
										?>
									<tbody>
								</table>
							</div>						
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ข้ามตรวจทาน -->
<div class="modal fade" id="skip_send_form" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="col-sm-12">
                    <div class="media m-b-12">
                        <div class="media-body">
                            <h5>เปลี่ยนผู้ตรวจทาน</h5>
                        </div>
                    </div>
                    <div class="f-right">

                    </div>
                </div>

            </div>
            <div class="modal-body">
                <div class="form-group row" id="SHOW_DATA_REVIEW">
                    <div class="col-md-12">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
<!-- ข้ามตรวจทาน -->
<?php 
include '../include/combottom_js_user.php'; 
include '../include/combottom_user.php'; 
?>
<script>	
	function change_page_limit(limit){
		window.location.href="<?php echo create_link($wf_link,$_GET,array(),array('wf_limit','wf_page')).'&wf_page=1&wf_limit='; ?>"+limit+"";
	}
	function change_page_no(page){
		if(page!=""){
			$('#wf_page').val(page);
		}
	}