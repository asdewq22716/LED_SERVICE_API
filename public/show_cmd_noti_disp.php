<?php
session_start(); 
$_SESSION["WF_USER_ID"] = "-1";

include '../include/comtop_user.php';

foreach($_GET as $key => $val){
	$$key = conText($val);
}
$wf_limit = $_GET['wf_limit'] == "" ? 20 : $_GET['wf_limit'];

$tab_active = $_GET['tab_active'];
if($tab_active==""){
	$tab_active = 1;
}
?>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<div class="f-right">
						<a class="btn btn-primary active waves-effect waves-light" href="show_cmd_form.php?TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"];?>&SEND_TO=<?php echo $_GET["SEND_TO"];?>" role="button"  title="<?php if($rec_main["WF_BTN_ADD_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_ADD;}?>"><i class="icofont icofont-ui-add"></i> <?php if($rec_main["WF_BTN_ADD_RESIZE"] != 'Y'){ echo $WF_TEXT_MAIN_ADD;}?></a>
					</div>
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
							<input type="hidden" name="SEND_TO" id="SEND_TO" value="<?php echo $_GET["SEND_TO"];?>">
							<input type="hidden" name="TO_PERSON_ID" id="TO_PERSON_ID" value="<?php echo $_GET["TO_PERSON_ID"];?>">
							
							<div class="form-group row">
								<div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
								  <label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำ</label>
								</div>
								<div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
								  <input type="text" name="T_BLACK_CASE" id="T_BLACK_CASE" class="form-control" value="<?php echo $T_BLACK_CASE ;?>">
								  <small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
								  <input type="text" name="BLACK_CASE" id="BLACK_CASE" class="form-control" value="<?php echo $BLACK_CASE  ;?>">
								  <small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
								  <div class="row">
									<div id="" class="col-md-1 wf-left">
									ปี
									</div>
									<div id="" class="col-md-5 wf-left">
									  <input type="text" name="BLACK_YY" id="BLACK_YY" class="form-control" value="<?php echo $BLACK_YY  ;?>">
									  <small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
									</div>
								  </div>
								</div>
								
								<div id="RED_CASE_BSF_AREA" class="col-md-2 ">
								  <label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดง</label>
								</div>
								<div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
								  <input type="text" name="T_RED_CASE" id="T_RED_CASE" class="form-control" value="<?php echo $T_RED_CASE ;?>">
								  <small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
								  <input type="text" name="RED_CASE" id="RED_CASE" class="form-control" value="<?php echo $RED_CASE ;?>">
								  <small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
								  <div class="row">
									<div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
									ปี
									</div>
									<div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
									  <input type="text" name="RED_YY" id="RED_YY" class="form-control" value="<?php echo $RED_YY;?>">
									  <small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
									</div>
								  </div>
								</div>

							  </div>
							  <div class="form-group row">
								<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
									<label for="CMD_TYPE" class="form-control-label wf-right">สถานะคำสั่ง</label>
								</div>
								<div class="col-md-2 wf-left">
									<select name="S_COM_STATUS" id="S_COM_STATUS"   class="form-control select2" tabindex="-1"> 
										<option value="1" <?php echo $_GET["S_COM_STATUS"]==1?"selected":"";?>>คำสั่งเข้าใหม่</option>
										<option value="2" <?php echo $_GET["S_COM_STATUS"]==2?"selected":"";?>>ทั้งหมด</option>										
									</select>			
								</div>								
							</div>
							<div class="form-group row">
								<div class="col-md-12 text-center">
									<button type="submit" name="wf_search" id="wf_search" class="btn btn-primary"> ค้นหา</button>&nbsp;&nbsp;
								</div>
							</div>
							
							<!--<ul class="nav nav-tabs  tabs" role="tablist">
								<li class="nav-item"><a class="nav-link <?php echo ($tab_active == 1) ? "active" : ""; ?>" data-toggle="tab" href="javascript:void(0)" onClick="changeSubmit(1);" role="tab">คำสั่งเข้า</a></li>
								<li class="nav-item"><a class="nav-link <?php echo ($tab_active == 2) ? "active" : ""; ?>" data-toggle="tab" href="javascript:void(0)" onClick="changeSubmit(2);" role="tab">คำสั่งออก </a></li>
							</ul>-->
							<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
								<thead class="bg-primary">
									<tr class="bg-primary">
										<th style="width: 5%;" class="text-center">ลำดับ</th>
										<th style="width: 7%;" class="text-center">วันที่/เวลา</th>
										<th style="width: 20%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
										<th style="width: 10%;" class="text-center">ระบบงานต้นทาง</th>
										<th style="width: 10%;" class="text-center">ระบบงานปลายทาง</th>
										<th style="width: 10%;" class="text-center">ศาล</th>
										<th style="width: 7%;" class="text-center">หมายเลขคดีดำ</th>														
										<th style="width: 7%;" class="text-center">หมายเลขคดีแดง</th>	
										<th style="width: 10%;" class="text-center">เอกสารแนบ</th>	
										<th style="width: 7%;" class="text-center">สถานะ</th>
										<th style="width: 10%;" class="text-center">จัดการ</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$filterCom = "";
									$orderBy = "";
									
									if($T_NO_BLACK!=""){
										$filterCom .= " AND T_NO_BLACK = '".$T_NO_BLACK."' ";
									}
									if($BLACK_CASE!=""){
										$filterCom .= " AND BLACK_CASE = '".$BLACK_CASE."' ";
									}
									if($BLACK_YY!=""){
										$filterCom .= " AND BLACK_YY = '".$BLACK_YY."' ";
									}
									if($T_RED_CASE!=""){
										$filterCom .= " AND T_RED_CASE = '".$T_RED_CASE."' ";
									}
									if($RED_CASE!=""){
										$filterCom .= " AND RED_CASE = '".$RED_CASE."' ";
									}
									if($RED_YY!=""){
										$filterCom .= " AND RED_YY = '".$RED_YY."' ";
									}
				
									$sqlSelectData = "	SELECT 		TRANSACTION_APPROVE_PERSON,TRANSACTION_STATUS_APP,A.APPROVE_STATUS,A.APPROVE_PERSON,A.ID,CMD_READ_STATUS,CMD_DOC_DATE,CMD_DOC_TIME,CMD_TYPE_NAME,SERVICE_SYS_NAME,COURT_NAME,A.ID,T_BLACK_CASE,BLACK_CASE,BLACK_YY,T_RED_CASE,RED_CASE,RED_YY,CMD_NOTE,CMD_GRP_NAME ,ALERT_NOTI,SEND_TO
														FROM		M_DOC_CMD A
														LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
														LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
														LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
														LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
														WHERE		1=1 AND 
																	((A.SEND_TO = '".$_GET["SEND_TO"]."' and (A.TO_PERSON_ID = '".$_GET["TO_PERSON_ID"]."' or A.TRANSACTION_APPROVE_PERSON = '".$_GET["TO_PERSON_ID"]."')) 
																	 OR 
																	 (A.SYS_NAME = '".$_GET["SEND_TO"]."' AND ( A.OFFICE_IDCARD = '".$_GET["TO_PERSON_ID"]."' OR APPROVE_PERSON = '".$_GET["TO_PERSON_ID"]."'))
																	 )
																	 AND NVL(REF_ID,0) = 0
														ORDER BY	CMD_DOC_DATE asc,CMD_DOC_TIME asc
																	"; 

									$i=1;
									$querySelectData = db::query($sqlSelectData);
									while($dataSelectData = db::fetch_array($querySelectData)){
										
										?>
										<tr style="background-color: #E6E6FA;">
											<td align="center">
												<?php echo $i;?>
												<?php
												if($tab_active==1){
													if($dataSelectData["CMD_READ_STATUS"]==0){
														?>
														<img src="icon_img_new.png" width="30px;">
														<?php
													}else{
														?>
														<img src="icon_img_read.png" width="30px;">
														<?php
													}
												}
												?>
											</td>
											<td nowrap><?php echo db2date($dataSelectData["CMD_DOC_DATE"])." ".substr($dataSelectData["CMD_DOC_TIME"],0,5);?></td>
											<td>
												<?php 
												if($dataSelectData["ALERT_NOTI"]==1){
													?>
													<img src="Alert.gif" width="30px;">
													<?php
												}
												echo $dataSelectData["CMD_TYPE_NAME"];
												if($dataSelectData["ALERT_NOTI"]==1){
													echo "<br> <strong><font color=\"red\">โดยมีรายละเอียดทรัพย์ดังต่อไปนี้</font></strong><br>";
													$sqlSelectCmdAsset 		= "select * from M_CMD_ASSET where CMD_ID = ".$dataSelectData['ID']."";
													$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
													$i_asset = 1;
													while($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)){
														echo $i_asset.".".$recSelectCmdAsset["PROP_DET"]." <a href=\"javascript:viod(0)\" onClick=\"showAssetComList(".$recSelectCmdAsset["ASSET_ID"].",'".$_GET["TO_PERSON_ID"]."')\" class=\"btn btn-success btn-mini\" title=\"\"><i class=\"icofont icofont-search\">คำสั่ง</i></a><br>";
													}
												}
												?>
											</td>
											<td><?php echo $dataSelectData["SERVICE_SYS_NAME"];?></td>
											<td><?php echo getsystemName($dataSelectData["SEND_TO"]);?></td>
											<td align="center"><?php echo $dataSelectData["COURT_NAME"];?></td>
											<td align="center"><?php echo $dataSelectData["T_BLACK_CASE"].$dataSelectData["BLACK_CASE"]."/".$dataSelectData["BLACK_YY"];?></td>
											<td align="center"><?php echo $dataSelectData["T_RED_CASE"].$dataSelectData["RED_CASE"]."/".$dataSelectData["RED_YY"];?></td>
											<td>
												<?php
												$sqlFile="	SELECT 		DF.FILE_SAVE_NAME,
																		DF.FILE_NAME
															FROM 		FRM_CMD_FILE A
															LEFT JOIN 	WF_FILE DF ON DF.WFR_ID = A.F_ID AND DF.WF_MAIN_ID = '109'
															WHERE 		A.WF_MAIN_ID = '110' AND
																		(A.WFR_ID = '".$dataSelectData['ID']."' OR A.F_TEMP_ID = '".$dataSelectData['ID']."')
															ORDER BY 	A.F_ID ASC
															";
												$queryFile = db::query($sqlFile);
												$i_file = 0;
												while($recFile = db::fetch_array($queryFile)){
													?>
													<li>
														<a href="../attach/w109/<?php echo $recFile['FILE_SAVE_NAME']; ?>" target="_blank">
														  <?php echo $recFile['FILE_NAME']; ?>
														</a>
													</li>
													<?php
												}
												?>
											</td>
											<td align="center" nowrap>
												<?php
												if($dataSelectData["APPROVE_STATUS"]==0){
													echo "รออนุมัติ";
												}else{
													echo "อนุมัติเเล้ว";
												}
												?>
											</td>
											<td align="center">
												<a href="cmd_view.php?ID=<?php echo $dataSelectData["ID"]?>&update_view=<?php echo $update_view;?>&TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"];?>&SEND_TO=<?php echo $_GET["SEND_TO"]?>" target="_blank" class="btn btn-info btn-mini" title="">
													<i class="icofont icofont-search"></i> ดูรายละเอียด
												</a>
												<?php
												if($dataSelectData["APPROVE_PERSON"]==$_GET["TO_PERSON_ID"] && $dataSelectData["APPROVE_STATUS"]==0){
													?>
													<a href="cmd_view.php?ID=<?php echo $dataSelectData["ID"]?>&approve=Y" target="_blank" class="btn btn-success btn-mini" title="">
														<i class="icofont icofont-search"></i> อนุมัติ
													</a>
													<?php
												}
												if($dataSelectData["TRANSACTION_APPROVE_PERSON"]==$_GET["TO_PERSON_ID"] && $dataSelectData["TRANSACTION_STATUS_APP"]==0){
													?>
													<a href="cmd_view.php?ID=<?php echo $dataSelectData["ID"]?>&approve2=Y" target="_blank" class="btn btn-success btn-mini" title="">
														<i class="icofont icofont-search"></i> รับทราบ
													</a>
													<?php
												}
												?>
											</td>
										</tr>
										<?php
										$i++;
									}
									?>
								<tbody>
							</table>
							
							
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
	function changeSubmit(tab_active){
		window.location.href="show_cmd_disp.php?tab_active="+tab_active+'&SEND_TO='+$('#SEND_TO').val()+'&TO_PERSON_ID='+$('#TO_PERSON_ID').val();
	}
	
	function showAssetComList(ASSET_ID,TO_PERSON_ID){
		window.open("show_cmd_list.php?ASSET_ID="+ASSET_ID+'&TO_PERSON_ID='+TO_PERSON_ID, "รายการคำสั่งเจ้าพนักงาน", "width=800,height=700");
	}
	
</script>