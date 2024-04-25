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
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div id="wf_space" class="card-header">
						<form method="get" id="form_wf_search" name="form_wf_search" action="#">
							
							<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
								<thead class="bg-primary">
									<tr class="bg-primary">
										<th style="width: 5%;" class="text-center">ลำดับ</th>
										<th style="width: 10%;" class="text-center">วันที่/เวลา</th>
										<th style="width: 25%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
										<th style="width: 10%;" class="text-center">ระบบงาน</th>
										<th style="width: 15%;" class="text-center">ศาล</th>
										<th style="width: 15%;" class="text-center">หมายเลขคดีดำ</th>														
										<th style="width: 15%;" class="text-center">หมายเลขคดีแดง</th>	
										<th style="width: 15%;" class="text-center">รายละเอียด</th>	
									</tr>
								</thead>
								<tbody>
									<?php
									//$filterCom = " and (A.TO_PERSON_ID = '".$_GET["TO_PERSON_ID"]."' or A.OFFICE_IDCARD = '".$_GET["TO_PERSON_ID"]."') ";
				
									$sqlSelectData = "	SELECT 		TRANSACTION_APPROVE_PERSON,TRANSACTION_STATUS_APP,A.APPROVE_STATUS,A.APPROVE_PERSON,A.ID,CMD_READ_STATUS,CMD_DOC_DATE,CMD_DOC_TIME,CMD_TYPE_NAME,SERVICE_SYS_NAME,COURT_NAME,A.ID,T_BLACK_CASE,BLACK_CASE,BLACK_YY,T_RED_CASE,RED_CASE,RED_YY,CMD_NOTE,CMD_GRP_NAME ,ALERT_NOTI
														FROM		M_DOC_CMD A
														LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
														LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
														LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
														LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
														WHERE		1=1 AND A.ID IN (select CMD_ID from M_CMD_ASSET where ASSET_ID = '".$_GET["ASSET_ID"]."') {$filterCom}
														ORDER BY 	CMD_DOC_DATE ASC,CMD_DOC_TIME ASC
																	"; 

									$i=1;
									$querySelectData = db::query($sqlSelectData);
									while($dataSelectData = db::fetch_array($querySelectData)){
										?>
										<tr>
											<td align="center">
												<?php echo $i;?>
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
														echo $i_asset.".".$recSelectCmdAsset["PROP_DET"]."<br>";
													}
												}
												?>
											</td>
											<td><?php echo $dataSelectData["SERVICE_SYS_NAME"];?></td>
											<td align="center"><?php echo $dataSelectData["COURT_NAME"];?></td>
											<td align="center"><?php echo $dataSelectData["T_BLACK_CASE"].$dataSelectData["BLACK_CASE"]."/".$dataSelectData["BLACK_YY"];?></td>
											<td align="center"><?php echo $dataSelectData["T_RED_CASE"].$dataSelectData["RED_CASE"]."/".$dataSelectData["RED_YY"];?></td>
											<td align="center">
												<a href="cmd_view.php?ID=<?php echo $dataSelectData["ID"]?>" target="_blank" class="btn btn-info btn-mini" title="">
													<i class="icofont icofont-search"></i> ดูรายละเอียด
												</a>
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