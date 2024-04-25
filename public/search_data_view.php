<?php
// include '../include/include.php';
  include '../include/comtop_user.php';
  include("../include/combottom_js_user.php");
  $id = $_GET['ID'];
  $id_wfr = $id;
  $sql_cmd = db::query("SELECT
                        	*
                        FROM
                        	(
                        		SELECT
                        			A .*, (
                        				SELECT
                        					CMD_NOTE
                        				FROM
                        					M_CMD_DETAILS B
                        				WHERE
                        					B.CMD_ID = A . ID
                        				AND B.CMD_DETAIL_ID = (
                        					SELECT
                        						MAX (C.CMD_DETAIL_ID) AS aa
                        					FROM
                        						M_CMD_DETAILS C
                        					WHERE
                        						C.CMD_ID = A . ID
                        					AND C.REF_DETAIL_ID IS NULL
                        				)
                        				AND ROWNUM = 1
                        			) AS CMD_DETAILS
                        		FROM
                        			M_DOC_CMD A
                        		WHERE
                        			1 = 1
                        		AND A . ID = '".$_GET['ID']."'
                        	) CMD");
  $rec_cmd = db::fetch_array($sql_cmd);

  $sql_person = db::query("SELECT * FROM M_CMD_PERSON WHERE CMD_ID = '".$_GET['ID']."'");
  $rec_person = db::fetch_array($sql_person);
  
	if($_GET["update_view"]=='Y'){
		db::query("update M_DOC_CMD set CMD_READ_STATUS = '1',CMD_READ_DATE='".date('Y-m-d')."',CMD_READ_TIME='".date('H:i:s')."' where ID = '".$_GET["ID"]."' ");
		getDataToWhAlert($_GET["TO_PERSON_ID"]);
	}
	
	
	
	
	
	//ต้นทาง
	$text_param .= "GET_S_PREFIX_CASE_BLACK=".$dataSelectData["PREFIX_BLACK_CASE"];
	$text_param .= "&GET_S_CASE_BLACK=".$dataSelectData["BLACK_CASE"];
	$text_param .= "&GET_S_CASE_BLACK_YEAR=".$dataSelectData["BLACK_YY"];
	$text_param .= "&GET_S_PREFIX_CASE_RED=".$dataSelectData["PREFIX_RED_CASE"];
	$text_param .= "&GET_S_CASE_RED=".$dataSelectData["RED_CASE"];
	$text_param .= "&GET_S_CASE_RED_YEAR=".$dataSelectData["RED_YY"];
	$text_param .= "&GET_S_COURT_CODE=".$dataSelectData["COURT_CODE"];
	$text_param .= "&GET_S_SYSTEM_ID=1";
	$text_param .= "&SEND_TO=1";
	$text_param .= "&TO_PERSON_ID=".$_GET["TO_PERSON_ID"];
	$text_param .= "&GET_PLAINTIFF=".$dataSelectData["PLAINTIFF1"];
	$text_param .= "&GET_DEFENDANT=".$dataSelectData["DEFFENDANT1"];
	
	//ปลายทาง
	$text_param .= "&GET_T_PREFIX_CASE_BLACK=".$_GET["TO_PREFIX_BLACK_CASE"];
	$text_param .= "&GET_T_CASE_BLACK=".$_GET["TO_BLACK_CASE"];
	$text_param .= "&GET_T_CASE_BLACK_YEAR=".$_GET["TO_BLACK_YY"];
	$text_param .= "&GET_T_PREFIX_CASE_RED=".$_GET["TO_PREFIX_RED_CASE"];
	$text_param .= "&GET_T_CASE_RED=".$_GET["TO_RED_CASE"];
	$text_param .= "&GET_T_CASE_RED_YEAR=".$_GET["TO_RED_YY"];
	$text_param .= "&GET_T_COURT_CODE=".$_GET["TO_COURT_CODE"];
	$text_param .= "&GET_T_SYSTEM_ID=".$_GET["SEND_TO"];
	$text_param .= "&ID_CARD=".$_GET["CARD_ID"];
	$text_param .= "&PCC_CASE_GEN=".$dataSelectData["PCC_CASE_GEN"];
	
	
	if($rec_cmd['SYS_NAME']){
		// $arrGetCivil = array();
		// $arrGetCivil["courtCode"] = $dataSelectData["COURT_CODE"];
		// $arrGetCivil["prefixBlackCase"] = $dataSelectData["PREFIX_BLACK_CASE"];
		// $arrGetCivil["blackCase"] = $dataSelectData["BLACK_CASE"];
		// $arrGetCivil["blackYy"] = $dataSelectData["BLACK_YY"];
		// $arrGetCivil["prefixRedCase"] = $dataSelectData["PREFIX_RED_CASE"];
		// $arrGetCivil["redCase"] = $dataSelectData["RED_CASE"];
		// $arrGetCivil["redYy"] = $dataSelectData["RED_YY"];
		// getCivilToWh($arrGetCivil);
	}
?>
<style>
.badge{
	text-align:left;
}
</style>
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Row Starts -->
		<div class="row" id="animationSandbox">
			<div class="col-md-12">
				<div class="main-header">
					<h4> ระบบบันทึกคำสั่งเจ้าพนักงาน </h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow"></ol>
					<div class="f-right">
						<a class="btn btn-primary active waves-effect waves-light" href="show_cmd_form.php?<?php echo $text_param;?>&proc=add" role="button"  title="<?php if($rec_main["WF_BTN_ADD_RESIZE"] == 'Y'){ echo $WF_TEXT_MAIN_ADD;}?>"><i class="icofont icofont-ui-add"></i> <?php if($rec_main["WF_BTN_ADD_RESIZE"] != 'Y'){ echo $WF_TEXT_MAIN_ADD;}?></a>
						<a class="btn btn-danger waves-effect waves-light" href="show_cmd_disp.php?TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"];?>&SEND_TO=<?php echo $_GET["SEND_TO"];?>" role="button"><i class="icofont icofont-home"></i> กลับหน้าหลัก</a>
					</div>
				</div>
			</div>
		</div>

    <div class="form-group row">
			<div class="col-md-12">
				<div class="card">
          <div id="wf_space" class="card-block">
							<div class="form-group row">
								<input type="hidden" name="F_TEMP_ID" id="F_TEMP_ID" value="3103616">
								<input type="hidden" name="WFR" id="WFR" value="">
              </div>
              <div class="form-group row">
                <div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 ">
                  <label for="CMD_DOC_DATE" class="form-control-label wf-right ">วันที่</label>
                </div>
                <div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 wf-left">
                  <label class="input-group badge badge-lg bg-info"><?php echo date('d/m').'/'.(date('Y')+543); ?></label>
                </div>
                <div id="CMD_DOC_TIME_BSF_AREA" class="col-md-2 offset-md-1 ">
                  <label for="CMD_DOC_TIME" class="form-control-label wf-right">เวลา</label>
                </div>
                <div id="CMD_DOC_TIME_BSF_AREA" class="col-md-2 wf-left">
                  <label class="input-group badge badge-lg bg-info"><?php echo date("H:i:s"); ?></label>
                </div>
              </div>
			  
			  <div class="form-group row">
                  <div id="SEND_TO_BSF_AREA" class="col-md-2 "><label for="SEND_TO" class="form-control-label wf-right">คำสั่ง/สอบถาม/แจ้ง จากระบบงาน</label>
                </div>
                <div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
                  <?php $sql_cmd_sys = db::query("SELECT * FROM M_CMD_SYSTEM WHERE CMD_SYSTEM_ID = '".$rec_cmd['SYS_NAME']."'");
                  $rec_cmd_sys = db::fetch_array($sql_cmd_sys);?>
                  <label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd_sys['SERVICE_SYS_NAME'];?></label>
                </div>

              </div>

              



              <div class="form-group row">
                <div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
                  <label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำ</label>
                </div>
                <div id="T_BLACK_CASE_BSF_AREA" class="col-md-2 wf-left">
                  <label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['T_BLACK_CASE'].$rec_cmd['BLACK_CASE']."/".$rec_cmd['BLACK_YY'];?></label>
                </div>
                <div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
                </div>
                <div id="RED_CASE_BSF_AREA" class="col-md-2 ">
                  <label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดง</label>
                </div>
                <div id="T_RED_CASE_BSF_AREA" class="col-md-2 wf-left">
                  <label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['T_RED_CASE'].$rec_cmd['RED_CASE']."/".$rec_cmd['RED_YY'];?></label>
                </div>
              </div>
				<div class="form-group row">
                  <!-- <div class="row">
                    <div class="col-md-10">
                      <input type="text" name="CIVIL_CODE" id="CIVIL_CODE" class="form-control" value="">
                      <small id="DUP_CIVIL_CODE_ALERT" class="form-text text-danger" style="display:none"></small>
                    </div>
                    <div class="col-md-2">
                      <button type="button" name="button" id="" class="btn btn-mini btn-primary wf-left" style="margin-left:-10px; margin-top:3px;"><i class="fa fa-search"></i></button>
                    </div>
                  </div> -->
                <div id="COURT_NAME_BSF_AREA" class="col-md-2 ">
                  <label for="COURT_NAME" class="form-control-label wf-right">ศาล</label>
                </div>
                <div id="COURT_NAME_BSF_AREA" class="col-md-2 wf-left">
                  <label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['COURT_NAME'];?></label>
                </div>
                </div>
				
			  
			  <div class="form-group row">
				<div id="NAME_REQ" class="col-md-2">
					<label for="NAME_REQ" class="form-control-label wf-right">โจทก์</label>
				  </div>

				  <div class="col-md-5 wf-left">
			  <label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['PLAINTIFF'];?></label>
				  </div>
				</div>
			 <div class="form-group row">
				  <div id="DEPT_NAME" class="col-md-2 ">
				<label for="DEPT_NAME" class="form-control-label wf-right">จำเลย</label>
			  </div>

			  <div id="DEPT_NAME" class="col-md-5 wf-left">
          <label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['DEFENDANT'];?></label>
			  </div>
			  </div>
			  <!--<div class="form-group row">
				<div id="list" class="col-md-2">
				<label for="list" class="form-control-label wf-right">บุคคลที่เกี่ยวข้องตามคำสั่ง</label>
			  </div>

				  <div id="list" class="col-md-2 wf-left">
            <label class="input-group badge badge-lg bg-info"><?php echo $rec_person['FULL_NAME'];?></label>
				  </div>
              </div>-->
              
			<?php
			if($rec_cmd["CMD_FIX_DATE_STATUS"]!='Y'){
				?>
				<div class="form-group row"> <div id="CASE_TYPE_BSF_AREA" class="col-md-12 "><hr></div></div>
				<div class="form-group row">
					<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
						<label for="CASE_TYPE" class="form-control-label wf-right">ส่งถึงระบบ</label>
					</div>
					<div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
						<?php $sql_sys = db::query("SELECT * FROM M_CMD_SYSTEM WHERE CMD_SYSTEM_ID = '".$rec_cmd['SEND_TO']."'");
						$rec_sys = db::fetch_array($sql_sys);?>
						<label class="input-group badge badge-lg bg-info"><?php echo $rec_sys['SERVICE_SYS_NAME'];?></label>
					</div>
				</div>
				<div class="form-group row">
					<div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
						<label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำปลายทาง</label>
					</div>
					<div id="T_BLACK_CASE_BSF_AREA" class="col-md-2 wf-left">
						<label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['TO_T_BLACK_CASE'].$rec_cmd['TO_BLACK_CASE']."/".$rec_cmd['TO_BLACK_YY'];?></label>
					</div>
					<div id="RED_CASE_BSF_AREA" class="col-md-1 "></div>
					<div id="RED_CASE_BSF_AREA" class="col-md-2 ">
						<label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดงปลายทาง</label>
					</div>
					<div id="T_RED_CASE_BSF_AREA" class="col-md-2 wf-left">
						<label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['TO_T_RED_CASE'].$rec_cmd['TO_RED_CASE']."/".$rec_cmd['TO_RED_YY'];?></label>
					</div>
				</div>
				<div class="form-group row">
					<div id="COURT_NAME_BSF_AREA" class="col-md-2 ">
						<label for="T_COURT_NAME" class="form-control-label wf-right">ศาลปลายทาง</label>
					</div>
					<div id="COURT_NAME_BSF_AREA" class="col-md-2 wf-left">
						<label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['TO_COURT_NAME'];?></label>
					</div>
				</div>
				<div class="form-group row">
					<div id="NAME_REQ" class="col-md-2">
						<label for="NAME_REQ" class="form-control-label wf-right">โจทก์</label>
					</div>
					<div class="col-md-5 wf-left">
						<label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['TO_PLAINTIFF'];?></label>
					</div>
				</div>
				<div class="form-group row">
					<div id="DEPT_NAME" class="col-md-2 ">
						<label for="DEPT_NAME" class="form-control-label wf-right">จำเลย</label>
					</div>
					<div id="DEPT_NAME" class="col-md-5 wf-left">
						<label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['TO_DEFENDANT'];?></label>
					</div>
				</div>
				<div class="form-group row"> <div id="CASE_TYPE_BSF_AREA" class="col-md-12 "><hr></div></div>
				<div class="form-group row">
					<div id="CMD_NOTE_BSF_AREA" class="col-md-2 ">
						<label for="CMD_NOTE" class="form-control-label wf-right">รายละเอียด</label>
					</div>
					<div id="CMD_NOTE_BSF_AREA" class="col-md-6 wf-left">
						<label class="input-group badge badge-lg bg-info"><?php echo $rec_cmd['CMD_DETAILS'];?></label>
					</div>
				</div>
				<?php
			}
			?>
			  
			  
			<?php
			if($rec_cmd_staff['FLAG_CMD_NOTI']!='Y' && trim($rec_cmd['APPROVE_PERSON'])!=""){
				?>
				<div class="form-group row">
					<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
						<label for="CASE_TYPE" class="form-control-label wf-right">ผู้พิจารณา</label>
					</div>
					<div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
						<?php $sql_appPerson = db::query("SELECT * FROM USR_MAIN WHERE USR_OPTION9 = '".$rec_cmd['APPROVE_PERSON']."'");
						$rec_appPerson =  db::fetch_array($sql_appPerson);?>
						<label class="input-group badge badge-lg bg-info"><?php echo $rec_appPerson['USR_PREFIX'].$rec_appPerson['USR_FNAME']." ".$rec_appPerson['USR_LNAME'];?></label>
					</div>
				</div>
				<?php
			}
			?>
			
			
              

              <div class="form-group row"><div class="col-md-12"></div></div>

              <!-- <div class="form-group row">
                <div id="CMD_FILE_BSF_AREA" class="col-md-2 offset-md-4 "></div>
                <div id="CMD_FILE_SPACE" class="col-md-4 offset-md-1 wf-left">
                  <div class="md-group-add-on">
                    <span class="md-add-on-file">
                      <button class="btn btn-primary waves-effect waves-light"><i class="zmdi zmdi-cloud-upload"></i> เลือกไฟล์</button>
                    </span>
                    <div class="md-input-file">
                      <input type="file" name="CMD_FILE[]" id="CMD_FILE" class="" multiple="">
                      <input type="text" class="md-form-control md-form-file"><label class="md-label-file"></label>
                      <span class="md-line"></span>
                    </div>
                  </div>
                </div>
              </div> -->

              <input type="hidden" name="OFFICE_IDCARD" id="OFFICE_IDCARD" value="<?php echo $_SESSION['USR_OPTION1']; ?>">
              <input type="hidden" name="OFFICE_NAME" id="OFFICE_NAME" value="<?php echo $_SESSION['WF_USER_NAME']; ?>">

            <input type="hidden" name="DEPT_CODE" id="DEPT_CODE" value="">
              <!-- <input type="hidden" name="DEPT_NAME" id="DEPT_NAME" value=""> -->
			
			<div class="form-group row">
				<div class="col-md-12">
					<strong>ประวัติคำสั่ง</strong>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
						<thead class="bg-primary">
							<tr class="bg-primary">
								<th style="width: 5%;" class="text-center">ลำดับ</th>
								<th style="width: 10%;" class="text-center">วันที่/เวลา</th>
								<th style="width: 25%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
								<th style="width: 20%;" class="text-center">รายละเอียด</th>
								<th style="width: 20%;" class="text-center">โดย</th>
								<th style="width: 20%;" class="text-center">เอกสารแนบ</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sqlSelectComLog = "select 		CMD_DOC_DATE,CMD_DOC_TIME,REF_ID,CMD_NAME_ORDER,CMD_NOTE,ID,OFFICE_NAME
											from 		M_DOC_CMD 
											connect 	by  prior REF_ID =  ID
											START WITH ID = '".$_GET['ID']."'
											order by 	CMD_DOC_DATE asc,CMD_DOC_TIME asc";
						$querySelectComLog = db::query($sqlSelectComLog);
						$i_com_log = 1;
						while($recSelectComLog = db::fetch_array($querySelectComLog)){
							if($_GET['ID']!=$recSelectComLog["ID"]){
								?>
								<tr>
									<td align="center"><?php echo $i_com_log;?></td>
									<td align="center"><?php echo db2date($recSelectComLog["CMD_DOC_DATE"])." ".substr($recSelectComLog["CMD_DOC_TIME"],0,5);?></td>
									<td><?php echo $recSelectComLog["CMD_NAME_ORDER"];?></td>
									<td><?php echo $recSelectComLog["CMD_NOTE"]?></td>
									<td><?php echo $recSelectComLog["OFFICE_NAME"]?></td>
									<td>
										<?php
											$sqlFile="SELECT 	DF.FILE_SAVE_NAME,
																DF.FILE_NAME
													  FROM 		FRM_CMD_FILE A
													  LEFT JOIN WF_FILE DF ON DF.WFR_ID = A.F_ID AND DF.WF_MAIN_ID = '109'
													  WHERE 	A.WF_MAIN_ID = '110' 
																AND (A.WFR_ID = '".$recSelectComLog['ID']."' OR A.F_TEMP_ID = '".$recSelectComLog['ID']."')
													  ORDER BY 	A.F_ID ASC
													  ";
											$queryFile = db::query($sqlFile);
											$i = 0;
											while($recFile = db::fetch_array($queryFile)){
												?>
												<a href="../attach/w109/<?php echo $recFile['FILE_SAVE_NAME']; ?>" target="_blank">
												  <?php echo $recFile['FILE_NAME']; ?>
												</a>
												<br>
												<?php
											}
										  ?>
									</td>
								</tr>
								<?php
								$i_com_log++;
							}
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12"><hr></div>
			</div>
			
			<div class="form-group row">
				<div class="col-md-12 wf-center ">
				<label for="" class="form-control-label wf-center">บุคคลที่เกี่ยวข้องตามคำสั่ง</label>
					<div class="table-responsive">
						<table id="wfsflow" class="table table-bordered sorted_table">
							<thead class="bg-primary">
								<tr class="bg-primary">
								<th style="width:5%;" class="text-center">ลำดับ</th>
								<th style="width:35%;" class="text-center">ชื่อ</th>
								<th style="width:30%;" class="text-center">ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
								<th style="width:30%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
							</tr>
							</thead>
							<tbody id="wfs_show_person">
								<?php
								$sqlSelectCmdPerson = "SELECT FULL_NAME,PERSON_CMD_TYPE,PERSON_CASE_TYPE FROM M_CMD_PERSON WHERE CMD_ID = '".$_GET['ID']."' ";
								$querySelectCmdPerson = db::query($sqlSelectCmdPerson);
								$i=1;
								while($recSelectCmdPerson = db::fetch_array($querySelectCmdPerson)){
									?>
									<tr>
										<td align="center"><?php echo $i;?></td>
										<td><?php echo $recSelectCmdPerson["FULL_NAME"];?></td>
										<td><?php echo getCmdName($recSelectCmdPerson["PERSON_CMD_TYPE"]);?></td>
										<td><?php echo getCaseName($recSelectCmdPerson["PERSON_CASE_TYPE"]);?></td>
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
			<div class="form-group row">
				<div class="col-md-12 wf-center ">
					<label for="" class="form-control-label wf-center">รายการทรัพย์</label>
					<label for="" class="form-control-label wf-right"><button type="button" class="btn btn-success" id="getAssetToBankrupt" style="background-color: #191970;border-color: #191970;">ดึงทรัพย์เข้าล้มละลาย</button></label>
					<div class="table-responsive">
						<table id="wfsflow-3440" class="table table-bordered sorted_table">
							<thead class="bg-primary">
								<tr class="bg-primary">
								<th style="width:5%;" class="text-center">ลำดับ</th>
								<th style="width:35%;" class="text-center">รายการทรัพย์</th>
								<th style="width:25%;" class="text-center">ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
								<th style="width:25%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
								<th style="width:10%;" class="text-center">สถานะ</th>
							</tr>
							</thead>
							<tbody id="wfs_show_asset">
								<?php
								$i=1;
								$sqlSelectCmdAsset 		= "select PROP_DET,PROP_STATUS_NAME,ASSET_ID,ASSET_CMD_TYPE,ASSET_CASE_TYPE from M_CMD_ASSET where CMD_ID = ".$_GET['ID']."";
								$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
								while($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)){
									?>
									<tr>
										<td align="center"><?php echo $i;?></td>
										<td><a onclick="show_asset_detail(<?php echo $recSelectCmdAsset["ASSET_ID"]?>)" href="javascript:void();"><?php echo $recSelectCmdAsset["PROP_DET"];?></a></td>
										<td><?php echo getCmdName($recSelectCmdAsset["ASSET_CMD_TYPE"]);?></td>
										<td><?php echo getCaseName($recSelectCmdAsset["ASSET_CASE_TYPE"]);?></td>
										<td><?php echo $recSelectCmdAsset["PROP_STATUS_NAME"];?></td>
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
			<div class="form-group row">
				<div class="col-md-12 wf-center ">
				<label for="" class="form-control-label wf-center">รายการเอกสารในคดี</label>
					<div class="table-responsive">
						<table id="wfsflow" class="table table-bordered sorted_table">
							<thead class="bg-primary">
								<tr class="bg-primary">
								<th style="width:5%;" class="text-center">ลำดับ</th>
								<th style="width:95%;" class="text-center">ชื่อเอกสาร</th>
							</tr>
							</thead>
							<tbody id="wfs_show_file_case">
								<?php
								if(trim($rec_cmd["PCC_CASE_GEN"])!=""){
									$arr_file = getCivilEdocument($rec_cmd["PCC_CASE_GEN"]);
									$no_file=1;
									foreach($arr_file as $key => $val){
										?>
										<tr>
											<td align="center"><?php echo $no_file;?></td>
											<td><a href="<?php echo $val["URL_SHOW_FILE"] ?>" target="_blank"><?php echo $val["FILE_NAME"] ?></a></td>
										</tr>
										<?php
										$no_file++;
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
              <div class="form-group row">
                <div class="col-md-12 wf-center ">
                  <label for="" class="form-control-label wf-center"></label>
					<span id="WFS_FORM_3440">
						<div class="f-right">
						  <a class="btn btn-primary  active waves-effect waves-light" href="#!" title="" data-toggle="modal" data-target="#bizModal_1441" onclick="open_modal('../workflow/form_mgt.php?W=109&amp;WFS=1441&amp;WFD=0&amp;WFR_ID=<?php echo $id_wfr; ?>&amp;F_TEMP_ID=<?php echo $id; ?>', '','_1441')">

							<i class="icofont icofont-ui-add"></i> เพิ่มข้อมูล
						  </a><small>&nbsp;</small>
						</div>
						<div class="table-responsive">
						<table id="wfsflow-1441" class="table table-bordered sorted_table">
							<thead class="bg-primary">
							  <tr class="bg-primary">
								<th style="width: 5%;" class="text-center">ลำดับ</th>
								<th style="width:;" class="text-center">ประเภทเอกสาร</th>
								<th style="width:;" class="text-center">แนบไฟล์</th>
							  </tr>
							</thead>

							<tbody id="wfs_show1441">
							<?php
								$sql="SELECT
										A.*,
										DF.FILE_SAVE_NAME,
										DF.FILE_NAME,
										DF.FILE_EXT,
										DF.FILE_ID,
										DF.WFS_FIELD_NAME,
										DF.FILE_SIZE,
										DF.FILE_TYPE
									  FROM FRM_CMD_FILE A
									  LEFT JOIN WF_FILE DF ON DF.WFR_ID = A.F_ID AND DF.WF_MAIN_ID = '109'
									  WHERE
										 A.WF_MAIN_ID = '110' AND
										(A.WFR_ID = '".$_GET['ID']."' OR A.F_TEMP_ID = '".$_GET['ID']."')
									  ORDER BY A.F_ID ASC
									  ";
								$query = db::query($sql);
								// print_pre($_POST);
								// exit;
								$i = 0;
								while($rec = db::fetch_array($query)){
								  // print_pre($rec);
							  ?>
								  <tr id="bsf_f_id<?php echo $rec['F_ID']; ?>">
									<td class="text-center"><?php echo ++$i; ?></td>
									<td class="text-left"><?php echo $rec['CMD_FILE_TYPE']; ?><input type="hidden" value="<?php echo $rec['CMD_FILE_TYPE']; ?>"></td>
									<td class="text-left">
									  <div class="row">
										<div class="data_table_main icon-list-demo">
										  <div id="BSA_FILE725" class="to-do-list col-sm-12" title="<?php echo $rec['FILE_NAME']; ?>">
											<?php
											  if($rec['FILE_EXT'] == 'pdf'){
											?>
											<b class="fa fa-file-pdf-o text-danger"></b>
											<?php
											  }
											  else if($rec['FILE_EXT'] == 'doc' || $rec['FILE_EXT'] == 'docx'){
											?>
											<b class="fa fa-file-word-o text-info"></b>
											<?php
											  }
											?>
											<a href="../attach/w109/<?php echo $rec['FILE_SAVE_NAME']; ?>" target="_blank">
											  <?php echo $rec['FILE_NAME']; ?>
											</a>
											<input hidden id="FILE_SAVE_NAME" name="FILE_SAVE_NAME[]" value="<?php echo $rec['FILE_SAVE_NAME']; ?>"/>
											<input hidden id="FILE_NAME" name="FILE_NAME[]" value="<?php echo $rec['FILE_NAME']; ?>"/>
											<input hidden id="FILE_EXT" name="FILE_EXT[]" value="<?php echo $rec['FILE_EXT']; ?>"/>
											<input hidden id="FILE_ID" name="FILE_ID[]" value="<?php echo $rec['FILE_ID']; ?>"/>
											<input hidden id="WFS_FIELD_NAME" name="WFS_FIELD_NAME[]" value="<?php echo $rec['WFS_FIELD_NAME']; ?>"/>
											<input hidden id="FILE_SIZE" name="FILE_SIZE[]" value="<?php echo $rec['FILE_SIZE']; ?>"/>
											<input hidden id="FILE_TYPE" name="FILE_TYPE[]" value="<?php echo $rec['FILE_TYPE']; ?>"/>
											<input hidden id="WFR_ID" name="WFR_ID[]" value="<?php echo $rec['WFR_ID']; ?>"/>
											</div>
										  </div>
										</div>
										<input type="hidden" value="">
									  </td>
									</tr>
							<?php
								}
								?>
						  </tbody>
						 </table>

						<input type="text" id="wfsflow-chk-1441" value="" style="opacity: 0;width:1px;height:1px;position:absolute;top:15px;">
						<script type="text/javascript">
							function WFS_UPDATE1441(){
								var row_num = $('#wfsflow-1441 tbody tr');
								if(row_num.length > 0){
								  $('#wfsflow-chk-1441').val(row_num.length);
								}else{
								  $('#wfsflow-chk-1441').val('');
								}
								for (var x = 0; x < row_num.length; x++) {
								  $('#wfsflow-1441 tbody tr:eq('+x+') td:eq(0)').html((x+1));
								}
	
							}

							$('#wfs_show1441 input').blur(function (){
								WFS_UPDATE1441();
							});
							$(document).ready(function() {
								WFS_UPDATE1441();
							});
						</script>
						<script type="text/javascript">
							$(document).ready(function() {
								$('select.select2').select2({
									allowClear: true,
									placeholder: function(){
										$(this).data('placeholder');
									}
								});
								$('select.select2-province').select2({
									allowClear: true,
									placeholder: 'เลือกจังหวัด'
								});
								$('select.select2-amphur').select2({
									allowClear: true,
									placeholder: 'เลือกอำเภอ'
								});
								$('select.select2-tambon').select2({
									allowClear: true,
									placeholder: 'เลือกตำบล'
								});
								$('textarea').autosize();
								$('input[maxlength]').maxlength();
								$(".datepicker, .datepicker_en").inputmask({ mask: "99/99/9999"});
								$('.datepicker:not(:read-only)').datepicker({
									format: "dd/mm/yyyy",
									language: "th-th",
									autoclose: true,
									todayHighlight: true
								});
								$('.datepicker_en:not(:read-only)').datepicker({
									format: "dd/mm/yyyy",
									autoclose: true,
									todayHighlight: true
								});
								/*$(".datepicker").inputmask({ mask: "99/99/9999"});
								$('.datepicker').datepicker({
								format: "dd/mm/yyyy",
								language: 'th-th',
								autoclose: true,
								todayHighlight: true,
								}).on('changeDate', function (ev) {
								$(this).datepicker('hide');
								$(this).blur();
								});
								$(".datepicker_en").inputmask({ mask: "99/99/9999"});
								$('.datepicker_en').datepicker({
								format: "dd/mm/yyyy",
								language: 'en',
								autoclose: true,
								todayHighlight: true,
								}).on('changeDate', function (ev) {
								$(this).datepicker('hide');
								$(this).blur();
								});*/
								$("input:file[multiple]").change(function (e,v){
									var input = document.getElementById(this.id);
									var img_name = [];
									for (var x = 0; x < input.files.length; x++) {
										img_name[x] = input.files[x].name;
									}
									$(this).parent().children('.md-form-file').val(img_name.join(', '));
								});
								$("input:file[single]").change(function (e,v){
									var pathArray = $(this).val().split('\\');
									var img_name=pathArray[pathArray.length - 1];
									$(this).parent().children('.md-form-file').val(img_name);
								});
								$('textarea.max-textarea').maxlength({
									alwaysShow: true
								});
								$(".select2-single-amphur").select2({
									ajax: {
										url: "../process/load_area.php",
										dataType: 'json',
										delay: 250,
										data: function(params) {
											return {
												qa: params.term
											};
										},
										processResults: function (data) {
											return {
												results: $.map(data, function(obj) {
													return { id: obj.id, text: obj.text };
												})
											};
										},
										cache: true
									},
									minimumInputLength: 2,
									allowClear: true
								});
								$(".select2-single-tambon").select2({
									ajax: {
										url: "../process/load_area.php",
										dataType: 'json',
										delay: 250,
										data: function(params) {
											return {
												qt: params.term
											};
										},
										processResults: function (data) {
											return {
												results: $.map(data, function(obj) {
													return { id: obj.id, text: obj.text };
												})
											};
										},
										cache: true
									},
									minimumInputLength: 2,
									allowClear: true
								});
							});
							$(".wf_check_dup").blur(function (){
								var id_len = $(this).val().length;
								var chk_name = $(this).attr('name');
								var chk_val = $(this).val();
								if(id_len > 0){
									var dataString = 'W=117&WFR=0&FIELD_N='+chk_name+'&val='+chk_val;
									$.ajax({
										type: "POST",
										url: "../workflow/load_dup.php",
										data: dataString,
										cache: false,
										success: function(data){
											if(data == "D"){
												$('#'+chk_name).addClass("bsf-warning");
												$('#'+chk_name).removeClass("bsf-success");
												$('#DUP_'+chk_name+'_ALERT').show();
												$('#DUP_'+chk_name+'_ALERT').html('ข้อมูลนี้มีอยู่แล้วในระบบ');
												$('#'+chk_name).attr('placeholder',chk_val);
												$('#'+chk_name).val('');
											}else{
												$('#'+chk_name).addClass("bsf-success");
												$('#'+chk_name).removeClass("bsf-warning");
												$('#DUP_'+chk_name+'_ALERT').hide();
												$('#DUP_'+chk_name+'_ALERT').html('');
											}
										}
									});
								}else{
									$('#'+chk_name).attr('placeholder','');
									$('#DUP_'+chk_name+'_ALERT').hide();
									$('#DUP_'+chk_name+'_ALERT').html('');
									$(this).removeClass("bsf-warning");
									$(this).removeClass("bsf-success");
								}
							});
							$(".idcard").inputmask({ mask: "9-9999-99999-99-9"});
							$('.autonumber').autoNumeric('init');
							$(".idcard").blur(function (){
								var id_len = $(this).val().length;
								if(id_len > 0){
									var data = $(this).val().split('-');
									if(chkIDcard(data[0],data[1],data[2],data[3],data[4])){
										$(this).addClass("bsf-success");
										$(this).removeClass("bsf-warning");
									}else{
										$(this).addClass("bsf-warning");
										$(this).removeClass("bsf-success");
										alert("กรุณากรอกข้อมูลให้ถูกต้อง");
										$(this).val('');
										$(this).focus();
									}
								}else{
									$(this).removeClass("bsf-warning");
									$(this).removeClass("bsf-success");
								}
							});

							$(".email").blur(function (){
								var em_len = $(this).val().length;
								if(em_len > 0){
									if(valid2EMail($(this).val())){
										$(this).addClass("bsf-success");
										$(this).removeClass("bsf-warning");
									}else{
										$(this).addClass("bsf-warning");
										$(this).removeClass("bsf-success");
									}
								}else{
									$(this).removeClass("bsf-warning");
									$(this).removeClass("bsf-success");
								}
							});
							function open_modal(url, head, modal_id){
								var id = typeof modal_id === 'undefined' ? 'bizModal' : 'bizModal'+modal_id;
								$('#'+id+' .modal-title').text(head);
								$('#'+id+' .modal-body').load(url);
							}
							function PopupCenter(url, title, w, h) {
								// Fixes dual-screen position                         Most browsers      Firefox
								var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
								var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

								var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
								var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

								var left = ((width / 2) - (w / 2)) + dualScreenLeft;
								var top = ((height / 2) - (h / 2)) + dualScreenTop;
								var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

								// Puts focus on the newWindow
								if (window.focus) {
									newWindow.focus();
								}
							}
							function chkIDcard (SubCardID1,SubCardID2,SubCardID3,SubCardID4,SubCardID5) {
								var CardID=SubCardID1+SubCardID2+SubCardID3+SubCardID4+SubCardID5;
								var FcardID=(CardID.substr(0,1))*13;
								for(i=1;i<12;i++) {
									var subNum = CardID.substr(i,1);
									FcardID=parseInt(FcardID)+ (parseInt(subNum)*(14-(i+1)));
								}
								chk=CardID.substr(CardID.length-1,1);
								temp=11-(parseInt(FcardID)%11);
								temtStr=temp+'';
								chkAnswer=temtStr.substr(temtStr.length-1,1);
								if(parseInt(chk)==parseInt(chkAnswer)) {
									return true;
								} else {
									return false;
								}
							}
							function validLength(item,min,max){
								return (item.length >= min) && (item.length<=max)
							}

							function valid2EMail(mailObj){
								if (validLength(mailObj,1,50)){
									//return false;
									if (mailObj.search("^.+@.+\\..+$") != -1)
									return true;
									else return false;
								}
								return true;
							}

							function get_amphur(province_obj,amphur_obj,tambon_obj,zipcode_obj,default_data){
								var dataString = 'P='+$('select#'+province_obj).val();
								var txt_a = 'เลือกอำเภอ';
								if($('select#'+province_obj).val()=='10'){ txt_a = 'เลือกแขวง'; }
									$.ajax({
										type: "GET",
										url: "../process/load_area.php",
										data: dataString,
										cache: false,
										success: function(html){
											console.log(html);
											$('select#'+amphur_obj).html('').select2({data: [{id:'', text: txt_a,disabled: true,selected:true}]});
											$('select#'+amphur_obj).select2({
												data: html
											});
											$('select#'+amphur_obj).select2("open");
											$('select#'+amphur_obj).select2("close");
											if(tambon_obj != ""){
												$('select#'+tambon_obj).html('').select2({data: [{id:'', text: '',disabled: true,selected:true}]});
											}
											if(zipcode_obj != ""){
												$('#'+zipcode_obj).val('');
											}
										}
									});
								}
                      function get_tambon(province_obj,amphur_obj,tambon_obj,zipcode_obj,default_data){
                      var dataString = 'A='+$('select#'+amphur_obj).val();
                      var txt_a = 'เลือกตำบล';
                      if($('select#'+amphur_obj).val() != ''){
                      if($('select#'+amphur_obj).val().substring(0, 2)=='10'){ txt_a = 'เลือกแขวง'; }
                      }
						  $.ajax({
						  type: "GET",
						  url: "../process/load_area.php",
						  data: dataString,
						  cache: false,
						  success: function(html){
						  $('select#'+tambon_obj).html('').select2({data: [{id:'', text: txt_a,disabled: true,selected:true}]});
						  $('select#'+tambon_obj).select2({
						  data: html
						  });
						  $('select#'+tambon_obj).select2("open");
						  $('select#'+tambon_obj).select2("close");
						  if(zipcode_obj != ""){
						  $('#'+zipcode_obj).val('');
                      }
                      }
                      });
                      }
                      function get_zipcode(province_obj,amphur_obj,tambon_obj,zipcode_obj){

                      if(zipcode_obj != ""){

                      var dataString = 'T='+$('#'+tambon_obj).val();

                      $.ajax({
                      type: "GET",
                      url: "../process/load_area.php",
                      data: dataString,
                      cache: false,
                      success: function(html){
                      $('#'+zipcode_obj).val(html);
                      }
                      });
                      }
                      }
                      function wf_file_d(w,f,wfr,txt){
                      if(w != '' && f != '' && wfr != ''){
						  swal({
						  title: "",
						  text: "คุณต้องการลบรายการนี้หรือไม่?",
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonClass: "btn-danger",
						  confirmButtonText: "ยืนยันการลบ",
						  cancelButtonText: "ยกเลิก",
						  closeOnConfirm: true
                      },
                      function(){
                      var dataString = 'process=d&wfr='+wfr+'&W='+w+'&f='+f;
                      $.ajax({
                      type: "POST",
                      url: "../workflow/wf_file_d.php",
                      data: dataString,
                      cache: false,
                      success: function(html){
                      /*swal({
                      title: "บันทึกตำแหน่งเรียบร้อยแล้ว",
                      type: "success",
                      allowOutsideClick:true
                      });*/
                      $('#BSA_FILE'+f).hide();
                      }
                      });

                      });
                      }
                      }
                      $(window).scroll(function () {
                      if ($(this).scrollTop() > 600) {
                      $('.scrollup').fadeIn();
                      } else {
                      $('.scrollup').fadeOut();
                      }
                      });

                      $('.scrollup').click(function () {
                      $("html, body").animate({
                      scrollTop: 0
                      }, 600);
                      return false;
                      });

                      function delete_wf_main(w,wfr){
                      if(w != '' && wfr != ''){
						  swal({
						  title: "",
						  text: "คุณต้องการลบรายการนี้หรือไม่?",
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonClass: "btn-danger",
						  confirmButtonText: "ยืนยันการลบ",
						  cancelButtonText: "ยกเลิก",
						  closeOnConfirm: true
                      },
                      function(){
						  var dataString = 'process=del&W='+w+'&WFR='+wfr;
						  $.ajax({
						  type: "POST",
						  url: "../workflow/workflow_del_function.php",
						  data: dataString,
						  cache: false,
						  success: function(html){
						  $('#tr_wf_'+wfr).hide();
                      }
                      });
                      });
                      }
                      }
                      function number_format(num,digit) {
                      var p = num.toFixed(digit).split(".");
                      var x= p[0].split("").reverse().reduce(function(acc, num, i, orig) {
                      return  num + (i && !(i % 3) ? "," : "") + acc;
                      }, "");
                      if(digit > 0){
                      return x + "." + p[1];
                      }else{
                      return x;
                      }

                      }
                      function bsf_del_form(W,WFS,WFR,F_TEMP_ID,WFD,FID){
                      if(W != '' && WFS != '' && FID != ''){
						  swal({
						  title: "",
						  text: "คุณต้องการลบรายการนี้หรือไม่??",
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonClass: "btn-danger",
						  confirmButtonText: "ยืนยันการลบ",
						  cancelButtonText: "ยกเลิก",
						  closeOnConfirm: true
                      },
						function(){
							var dataString = 'process=d&W='+W+'&f='+FID;
							$.ajax({
								type: "POST",
								url: "../workflow/wf_form_d.php",
								data: dataString,
								cache: false,
								success: function(html){
									$('#bsf_f_id'+FID).remove();
									var func = 'WFS_UPDATE'+WFS+'()';
									setTimeout(func,1);
								}
							});
						});
                      }
                      }
                      function type_doc(id){
                      document.getElementById("export_type").value = id;
                      }

                      function export_file() {
                      document.getElementById("export_content").value = document.getElementById("export_data").innerHTML;
                      document.getElementById("form_export").action = "../workflow/export_report.php";
                      document.getElementById("form_export").submit();
                      }
                    </script>
						
						</div>
					</span>
                </div>
              </div>
			  
			  
			  
			<?php
			if($_GET["approve"]=='Y' && $rec_cmd["APPROVE_STATUS"]==0 && $rec_cmd["APPROVE_PERSON"]==$_GET["TO_PERSON_ID"]){
				?>
				<div class="form-group row">
					<div id="COURT_NAME_BSF_AREA" class="col-md-2 ">
					<label for="T_COURT_NAME" class="form-control-label wf-right">พิจารณา</label>
					</div>
					<div id="COURT_NAME_BSF_AREA" class="col-md-5 wf-left">
						<label>
							<input type="radio" name="APPROVE_STATUS" id="APPROVE_STATUS1" value="1" checked onclick="$('#showSendApprove').hide();"> อนุมัติ
						</label>
						<label>
							<input type="radio" name="APPROVE_STATUS" id="APPROVE_STATUS0" value="0" onclick="$('#showSendApprove').show();"> อนุมัติ/ส่งต่อ
						</label>
						<label>
							<input type="radio" name="APPROVE_STATUS" id="APPROVE_STATUS2" value="2" onclick="$('#showSendApprove').hide();"> ส่งกลับแก้ไข
						</label>
					</div>
				</div>
				<div class="row" id="showSendApprove" style="display:none">
					<div id="COURT_NAME_BSF_AREA" class="col-md-2 ">
						<label for="T_COURT_NAME" class="form-control-label wf-right">เสนอผู้พิจารณา</label>
					</div>
					<div id="COURT_NAME_BSF_AREA" class="col-md-5 wf-left">
						<select name="APPROVE_PERSON_SEND"    id="APPROVE_PERSON_SEND" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" >
							<?php
							  $sql = "SELECT DISTINCT
										A .USR_OPTION9,
										A .USR_PREFIX,
										A .USR_FNAME,
										A .USR_LNAME
									  FROM
										USR_MAIN A
									  WHERE
										1=1
									  ORDER BY USR_FNAME ASC";
							  $query = db::query($sql);
							  while($rec = db::fetch_array($query)){
							?>
							<option value="<?php echo $rec['USR_OPTION9']; ?>"><?php echo $rec['USR_PREFIX'].$rec['USR_FNAME']." ".$rec['USR_LNAME'] ?></option>
							<?php
							  }
							?>
						  </select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="wf-right">
							<button type="button" id="btn_save" class="btn btn-success waves-effect waves-light"><i class="icofont icofont-tick-mark" title=""></i> บันทึก</button>
						</div>
					</div>
				</div>
				<?php
			}else if($_GET["approve"]=='Y' && $rec_cmd["APPROVE_STATUS"]>0){
				if($rec_cmd["APPROVE_STATUS"]==1){
					?>
					<div class="form-group row">
						<div id="COURT_NAME_BSF_AREA" class="col-md-2 ">
						<label for="T_COURT_NAME" class="form-control-label wf-right">ผลการพิจารณา</label>
						</div>
						<div id="COURT_NAME_BSF_AREA" class="col-md-5 wf-left">
							อนุมัติเเล้ว
						</div>
					</div>
					<?php
				}else{
					?>
					<div class="form-group row">
						<div id="COURT_NAME_BSF_AREA" class="col-md-2 ">
						<label for="T_COURT_NAME" class="form-control-label wf-right">ผลการพิจารณา</label>
						</div>
						<div id="COURT_NAME_BSF_AREA" class="col-md-5 wf-left">
							ส่งกลับแก้ไข
						</div>
					</div>
					<?php
				}
			}
			if($_GET["approve2"]=='Y' && $rec_cmd["TRANSACTION_STATUS_APP"]==0){
				?>
				<div class="form-group row">
					<div id="COURT_NAME_BSF_AREA" class="col-md-2 ">
					<label for="T_COURT_NAME" class="form-control-label wf-right">พิจารณา</label>
					</div>
					<div id="COURT_NAME_BSF_AREA" class="col-md-5 wf-left">
						<label>
							<input type="radio" name="TRANSACTION_STATUS_APP" id="TRANSACTION_STATUS_APP1" value="1" checked> รับทราบ
						</label>
						<label>
							<input type="radio" name="TRANSACTION_STATUS_APP" id="TRANSACTION_STATUS_APP2" value="2"> สอบถามเพิ่มเติม
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="wf-right">
							<button type="button" id="btn_save_app" class="btn btn-success waves-effect waves-light"><i class="icofont icofont-tick-mark" title=""></i> บันทึก</button>
						</div>
					</div>
				</div>
				<?php
			}
			if($_GET["update_view"]=='Y'){
				if($rec_cmd["TRANSACTION_STATUS"]<1){
					?>
					<div class="form-group row">
						<div id="COURT_NAME_BSF_AREA" class="col-md-2 ">
						<label for="T_COURT_NAME" class="form-control-label wf-right">ดำเนินการ</label>
						</div>
						<div id="COURT_NAME_BSF_AREA" class="col-md-3 wf-left">
							<label>
								<input type="radio" name="TRANSACTION_STATUS" id="TRANSACTION_STATUS1" value="1" checked onclick="$('#showSendApp').hide();"> รับทราบ
							</label>
							<label>
								<input type="radio" name="TRANSACTION_STATUS" id="TRANSACTION_STATUS2" value="2" onclick="$('#showSendApp').show();"> เสนอผู้พิจารณา
							</label>
						</div>
						<span id="showSendApp" style="display:none">
							<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
							<label for="CASE_TYPE" class="form-control-label">เสนอผู้พิจารณา</label>
							</div>
							<div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
								<select name="TRANSACTION_APPROVE_PERSON"    id="TRANSACTION_APPROVE_PERSON" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" >
									<option value="" disabled selected>เลือกผู้พิจารณาคำสั่ง</option>
									<?php
									$sql = "SELECT 		DISTINCT
														A .USR_OPTION9,
														A .USR_PREFIX,
														A .USR_FNAME,
														A .USR_LNAME
											FROM 		USR_MAIN A
											WHERE 		1=1
											ORDER BY 	USR_FNAME ASC";
									$query = db::query($sql);
									while($rec = db::fetch_array($query)){
										?>
										<option value="<?php echo $rec['USR_OPTION9']; ?>"><?php echo $rec['USR_PREFIX'].$rec['USR_FNAME']." ".$rec['USR_LNAME'] ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</span>
					</div>
					<?php 
				}
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="wf-right">
							<?php
							if($rec_cmd["TRANSACTION_STATUS"]<1){
								?>
								<button type="button" id="btn_save_send" class="btn btn-success waves-effect waves-light"><i class="icofont icofont-tick-mark" title=""></i> บันทึก</button>
								<?php
							}
							if($rec_cmd["FINAL_CMD"]!=1){
								?>
								<button type="button" id="reply_com" class="btn btn-success waves-effect waves-light"><i class="icofont icofont-tick-mark" title=""></i> ตอบกลับ</button>
								<?php
							}else{
								echo "<font color=\"#FF0000\">หมายเหตุ : ไม่สามารถตอบกลับได้เนื่องจากอนุมัติการตอบกลับคำสั่งเเล้ว<font>";
							}
							?>
						</div>
					</div>
				</div>
				<?php
			}
			?>

              <script type="text/javascript">
                // get_wfs_show('WFS_FORM_49647','../process/form_main.php','W=2078&WFD=0&WFS=49647&WFR=<?php echo $id_wfr; ?>&F_TEMP_ID=<?php echo $id; ?>&wfp=','GET','');
                $(document).ready(function() {

                  load_file('<?php echo $id; ?>');
				  
				  $( "#btn_save" ).click(function() {
					  swal({
							  title: "",
							  text: "ยืนยันการอนุมัติ",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "ยืนยันการอนุมัติ",
							  cancelButtonText: "ยกเลิก",
							  closeOnConfirm: true
						  },
							function(){
								var APPROVE_STATUS = $('input[name="APPROVE_STATUS"]:checked').val();
								var dataString = 'proc=updateCmd&APPROVE_STATUS='+APPROVE_STATUS+'&ID=<?php echo $_GET["ID"]?>&APPROVE_PERSON_SEND='+$('#APPROVE_PERSON_SEND').val();
								$.ajax({
									type: "POST",
									url: "get_data_ajax.php",
									data: dataString,
									cache: false,
									success: function(msg){
										window.location.reload();
									}
								});
						});
				  });
				  
				  $( "#btn_save_app" ).click(function() {
					  swal({
							  title: "",
							  text: "ยืนยันการดำเนินการ",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "ยืนยัน",
							  cancelButtonText: "ยกเลิก",
							  closeOnConfirm: true
						  },
							function(){
								var TRANSACTION_STATUS_APP = $('input[name="TRANSACTION_STATUS_APP"]:checked').val();
								var dataString = 'proc=updateCmdApp&TRANSACTION_STATUS_APP='+TRANSACTION_STATUS_APP+'&ID=<?php echo $_GET["ID"]?>';
								$.ajax({
									type: "POST",
									url: "get_data_ajax.php",
									data: dataString,
									cache: false,
									success: function(msg){
										window.location.reload();
									}
								});
						});
				  });
				  
				  $( "#btn_save_send" ).click(function() {
					  swal({
							  title: "",
							  text: "ยืนยันการดำเนินการ",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-primary",
							  confirmButtonText: "ยืนยัน",
							  cancelButtonText: "ยกเลิก",
							  closeOnConfirm: true
						  },
							function(){
								var TRANSACTION_STATUS = $('input[name="TRANSACTION_STATUS"]:checked').val();
								var TRANSACTION_APPROVE_PERSON = $('#TRANSACTION_APPROVE_PERSON').val();
								var dataString = 'proc=sendApprove&TRANSACTION_STATUS='+TRANSACTION_STATUS+'&TRANSACTION_APPROVE_PERSON='+TRANSACTION_APPROVE_PERSON+'&ID=<?php echo $_GET["ID"]?>';
								$.ajax({
									type: "POST",
									url: "get_data_ajax.php",
									data: dataString,
									cache: false,
									success: function(msg){
										window.location.reload();
									}
								});
						});
				  });
				  
				  $( "#reply_com" ).click(function() {
				  
					self.location.href='show_cmd_form.php?REF_ID=<?php echo $_GET["ID"];?>&SEND_TO=<?php echo $_GET["SEND_TO"];?>&TO_PERSON_ID=<?php echo $_GET["TO_PERSON_ID"];?>';
					
				  });

                });

                $(document).on('hide.bs.modal','#bizModal_49647', function () {
                  load_file('<?php echo $id; ?>');
                })

                $('button[type="submit"]').click(function(event) {
                  // load_file('<?php echo $id; ?>');
                });

                function load_file(id){
                  $.ajax({
                    url: '../form/order_official_ajax.php',
                    type: 'POST',
                    data: {fn:'data_form',wfr:id},
                  })
                  .done(function(data) {
                    // $('#wfs_show49647').remove();
                    $('#wfs_show49647').remove();
                    $("#wfsflow-49647").append("<tbody id='wfs_show49647'></tbody>");
                    $('#wfs_show49647').append(data);
                  });
                }

                $(document).ready(function(){
                  $('button.close-modal').click(function(){
                    var modal_number = $(this).attr('data-number');
                    var modal_id = $(this).parents(':eq(3)').attr('id');
                    $('#'+modal_number).modal('hide'); $('#'+modal_id+' .modal-title, #'+modal_id+' .modal-body').html('');
                  });
                });
				
				function open_modal(url, head, modal_id){
					var id = typeof modal_id === 'undefined' ? 'bizModal' : 'bizModal'+modal_id;
					$('#'+id+' .modal-title').text(head);
					$('#'+id+' .modal-body').load(url);
				}
				
				function show_asset_detail(asset_id){
					window.open("show_asset_detail.php?ASSET_ID="+asset_id, "รายละเอียดทรัพย์", "width=800,height=700");
				}
				function WFS_UPDATE1441(){
					var row_num = $('#wfsflow-1441 tbody tr');
					if(row_num.length > 0){
					  $('#wfsflow-chk-1441').val(row_num.length);
					}else{
					  $('#wfsflow-chk-1441').val('');
					}
					for (var x = 0; x < row_num.length; x++) {
					  $('#wfsflow-1441 tbody tr:eq('+x+') td:eq(0)').html((x+1));
					}
				}

				$('#wfs_show1441 input').blur(function (){
					WFS_UPDATE1441();
				});
				$(document).ready(function() {
					WFS_UPDATE1441();
				});
              </script>
				<div class="modal fade modal-flex" id="bizModal_1441" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                <div class="modal-dialog modal-lg " role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close close-modal" data-number="bizModal_1441" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger close-modal" data-number="bizModal_1441">ปิด</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade modal-flex" id="bizModal_49647" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                <div class="modal-dialog modal-lg " role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close close-modal" data-number="bizModal_49647" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger close-modal" data-number="bizModal_49647">ปิด</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

          </div>
          <!-- <div class="row">
	          <div class="col-md-12">
              <div class="wf-right">
                <button type="button" id="btn_save" class="btn btn-success waves-effect waves-light" onclick="save_reply();"><i class="icofont icofont-tick-mark" title=""></i> บันทึก</button>
              </div>
            </div>
          </div> -->
        </div>
      </div>

      <?php
        // if (isset($_POST['get_data'])) {
        //   $sql = "SELECT
        //             *
        //           FROM  WFR_PETITION_NOR
        //           WHERE 1=1
        //             -- AND BLACK_CASE_NO_SHW IS NOT NULL
        //             -- AND YEAR_BLACK IS NOT NULL
        //             -- AND RED_CASE_NO_SHW IS NOT NULL
        //             -- AND YEAR_RED IS NOT NULL
        //             AND MEDIATE_NO IS NOT NULL
        //             AND MEDIATE_NO IS NOT NULL
        //           ORDER BY WFR_ID DESC
        //           ";
        //   $query = db::query($sql);
        //   $i = 0;
        //   $rec = db::fetch_array($query);
        // }
      ?>


				<script type="text/javascript">

						  function WFS_UPDATE49647(){
							var row_num = $('#wfsflow-49647 tbody tr');
							if(row_num.length > 0){
							  $('#wfsflow-chk-49647').val(row_num.length);
							}else{
							  $('#wfsflow-chk-49647').val('');
							}
							for (var x = 0; x < row_num.length; x++) {
							  $('#wfsflow-49647 tbody tr:eq('+x+') td:eq(0)').html((x+1));
							}
						  }

						  $('#wfs_show49647 input').blur(function (){
							WFS_UPDATE49647();
						  });
						  $(document).ready(function() {
							WFS_UPDATE49647();
						  });
						  
						   $(document).ready(function() {

								load_file('<?php echo $id; ?>');
							  
								$('#getAssetToBankrupt').click(function(event) {
									swal({
										  title: "",
										  text: "ยืนยันการดำเนินการ",
										  type: "warning",
										  showCancelButton: true,
										  confirmButtonClass: "btn-primary",
										  confirmButtonText: "ยืนยัน",
										  cancelButtonText: "ยกเลิก",
										  closeOnConfirm: true
									  },
										function(){
											var TRANSACTION_APPROVE_PERSON = $('#TRANSACTION_APPROVE_PERSON').val();
											var dataString = 'ID=<?php echo $_GET["ID"]?>&SYS_NAME=<?php echo $rec_cmd["SYS_NAME"];?>';
											$.ajax({
												type: "POST",
												url: "get_asset_to_bankrupt_ajax.php",
												data: dataString,
												cache: false,
												success: function(msg){
													//window.location.reload();
												}
											});
									});
								});
							});

							$(document).on('hide.bs.modal','#bizModal_3440', function () {
							  load_file('<?php echo $id; ?>');
							})

							$('button[type="submit"]').click(function(event) {
							  // load_file('<?php echo $id; ?>');
							});

							function load_file(id){
							  $.ajax({
								url: '../form/order_official_ajax.php',
								type: 'POST',
								data: {fn:'data_form',wfr:id},
							  })
							  .done(function(data) {
								// $('#wfs_show1441').remove();
								$('#wfs_show1441').remove();
								$("#wfsflow-3440").append("<tbody id='wfs_show1441'></tbody>");
								$('#wfs_show1441').append(data);
							  });
							}

							$(document).ready(function(){
							  $('button.close-modal').click(function(){
								var modal_number = $(this).attr('data-number');
								var modal_id = $(this).parents(':eq(3)').attr('id');
								$('#'+modal_number).modal('hide'); $('#'+modal_id+' .modal-title, #'+modal_id+' .modal-body').html('');
							  });
							});

                    </script>

      <!-- <script type="text/javascript">
        $(document).ready(function() {
          $('button.biz-close-modal').click(function(event) {
            $('#bizModal3').modal('hide');
          });
				$("#SYSTEM_ID").change(function(){
				if( $('#SYSTEM_ID').val()=='3'){
					$("#CMD_TYPE").change(function(){
					if( $('#CMD_TYPE').val()=='1'){
						$('#CMD_PRIORITY_STATUS').val('0');
					 }else{
						$('#CMD_PRIORITY_STATUS').val('1');
					 }
					});
				}else{
						$('#CMD_PRIORITY_STATUS').val('0');
					}
					});
					//ส่งคนไปเช็ค
					$('#BLACK_CASE').blur(function(){
						if($('#BLACK_CASE').val() != ''){
						var id_len = $(this).val().length;

							if(id_len > 0){

									var BLACK_CASE = $('#BLACK_CASE').val();

										$.ajax({
										type: "POST",
										url: "../form/check_person_ajax.php",
										dataType: "Json",
										data: {BLACK_CASE:BLACK_CASE},
										success: function(result){

											if(result == 'true'){
												alert();
											}
										}
										});
							}
						}
					});
        });
      </script> -->

      <!-- <script type="text/javascript">
      function save_reply(){
        var wfr = '<?php echo $_GET['WFR'];?>';
        var cmd_date = $('#CMD_DOC_DATE').val();
        var cmd_time = $('#CMD_DOC_TIME').val();
        var b_court = $('#COURT_NAME').val();
        var b_pre_black = $('#T_BLACK_CASE').val();
        var b_no_black = $('#BLACK_CASE').val();
        var b_black_y = $('#BLACK_YY').val();
        var b_pre_red = $('#T_RED_CASE').val();
        var b_no_red = $('#RED_CASE').val();
        var b_red_y = $('#RED_YY').val();
        var system_Id = $('#SYSTEM_ID').val();
        var cmd_type = $('#CMD_TYPE').val();
        var case_type = $('#CASE_TYPE').val();
        var send_to = $('#SEND_TO').val();
        var person_name = $('#list_name').val();
        var register_code = $('#DEB_ID').val();
        var plaintiff = $('#PLAINTIFF').val();
        var defendant = $('#DEFENDANT').val();
        var approve_person = $('#APPROVE_PERSON').val();
        var t_pre_black = $('#TO_T_BLACK_CASE').val();
        var t_no_black = $('#TO_BLACK_CASE').val();
        var t_black_y = $('#TO_BLACK_YY').val();
        var t_pre_red = $('#TO_T_RED_CASE').val();
        var t_no_red = $('#TO_RED_CASE').val();
        var t_red_y = $('#TO_RED_YY').val();
        var t_court = $('#T_COURT_NAME').val();
        var cmd_note = $('#CMD_NOTE').val();
        var to_person = $('#ref_person').val();
        var to_person_Id = $('#ref_personId').val();
        var uid = '<?php echo $_SESSION['WF_USER_ID'];?>';

        $.ajax({
        type: "POST",
        url: "../save/save_cmd_reply.php",
        data: {
          cmd_date:cmd_date,
          cmd_time:cmd_time,
          b_court:b_court,
          b_pre_black:b_pre_black,
          b_no_black:b_no_black,
          b_black_y:b_black_y,
          b_pre_red:b_pre_red,
          b_no_red:b_no_red,
          b_red_y:b_red_y,
          system_Id:system_Id,
          cmd_type:cmd_type,
          case_type:case_type,
          send_to:send_to,
          person_name:person_name,
          register_code:register_code,
          plaintiff:plaintiff,
          defendant:defendant,
          approve_person:approve_person,
          t_pre_black:t_pre_black,
          t_no_black:t_no_black,
          t_black_y:t_black_y,
          t_pre_red:t_pre_red,
          t_no_red:t_no_red,
          t_red_y:t_red_y,
          t_court:t_court,
          to_person:to_person,
          to_person_Id:to_person_Id,
          cmd_note:cmd_note,
          uid:uid
        },
        success: function(result){
          // return false;
          location.href = '../workflow/workflow_process.php?W=1&WFR='+wfr;
        }
        });
        // return false;
      }

		function modalCus2(){
			 var wfr = $('#WFR').val();
       // console.log('->'+wfr);
			 var url = '../all_modal/modal_list_name.php?wfr='+wfr;
			setTimeout(function(){

				open_modal(url,'','3');
				$('#bizModal3').modal('show');

			}, 500);
		}
	  </script> -->
