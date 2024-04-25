<?php
/* session_start(); */

include '../include/comtop_user_N.php';
include '../include/func_Nop.php';

CONVERT_GET((func::get_E_and_D("search_data_cmd", "D", $_GET)));

class search_data_cmd
{
	public $BankofficePerson;
	public function getdataToPersonId($TO_PERSON_ID) //ข้อมูลนิติกร
	{
		$sql = "SELECT a.PER_IDCARD ,a.PREFIX_NAME_TH ,a.PER_FIRST_NAME_TH ,a.PER_LAST_NAME_TH 
				FROM WH_BACK_OFFICE_USER a WHERE a.PER_IDCARD ='" . $TO_PERSON_ID . "'";
		$qry = db::query($sql);
		$roc = db::fetch_array($qry);
		$this->BankofficePerson = $roc;
	}
}
$Func = new search_data_cmd();
$Func->getdataToPersonId($_GET['TO_PERSON_ID']);
$_SESSION['SEND_TO'] = $_GET['SEND_TO'];
$_SESSION['TO_PERSON_ID'] = $_GET['TO_PERSON_ID']; //13หลักนิติกร
$_SESSION['TO_PERSON_ID_FIRST_NAME'] = $Func->BankofficePerson['PER_FIRST_NAME_TH']; //ชื่อนิติกร
$_SESSION['TO_PERSON_ID_LAST_NAME'] = $Func->BankofficePerson['PER_LAST_NAME_TH']; //นามสกุลนิติกร
?>

<div class="">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<div class="f-right">
						<?php
						$url = "";
						$A = '0';
						if ($_GET['SEND_TO'] == '1') { //เเพ่ง
							$url .= "&SEND_FROM=CIVIL";
							$url .= "&PCC_CIVIL_GEN=" . $_GET['PCC_CIVIL_GEN'];
							if (empty($_GET['PCC_CIVIL_GEN'])) {
								$A = '1';
							}
						}
						if ($_GET['SEND_TO'] == '2') { //ล้มละลาย
							$url .= "&SEND_FROM=BANKRUPT";
							$url .= "&brcID=" . $_GET['brcID'];
							if (empty($_GET['brcID'])) {
								$A = '1';
							}
						}
						if ($_GET['SEND_TO'] == '3') { //ฟื้นฟู
							$url .= "&SEND_FROM=REVIVE";
							$url .= "&WFR_API=" . $_GET['WFR_API'];
							if (empty($_GET['WFR_API'])) {
								$A = '1';
							}
						}
						if ($_GET['SEND_TO'] == '4') { //ไกล่เกลี่ย
							$url .= "&SEND_FROM=MEDIATE";
							$url .= "&WFR_API=" . $_GET['WFR_API'];
							if (empty($_GET['WFR_API']) || $_GET['WFR_API'] == 'W1' || $_GET['WFR_API'] == 'W86') {
								$A = '1';
							}
						}
						if ($_GET['SEND_TO'] == '5') { //ไกล่เกลี่ย
							$url .= "&SEND_FROM=BACKOFFICE";
							$url .= "&TARGET_SYSTEM=" . $_GET['TARGET_SYSTEM']; //ส่งไปถึงระบบ
							$url .= "&GET_PERSON_CASE=" . $_GET['REGISTERCODE']; //ส่งใครมาตรวจ
							$url .= "&T_BLACK_CASE=" . $_GET['T_BLACK_CASE']; //คดีดำ
							$url .= "&BLACK_CASE=" . $_GET['BLACK_CASE']; //คดีดำ
							$url .= "&BLACK_YY=" . $_GET['BLACK_YY']; //คดีดำ
							$url .= "&T_RED_CASE=" . $_GET['T_RED_CASE']; //คดีเเดง
							$url .= "&RED_CASE=" . $_GET['RED_CASE']; //คดีเเดง
							$url .= "&RED_YY=" . $_GET['RED_YY']; //คดีเเดง
						}
						/* $Page1 = "cmd_add_from2.php";
																					$Page2 = "cmd_add_from_send_to2.php"; */
						$Page1 = "cmd_add_from.php";
						$Page2 = "cmd_add_from_send_to.php?NewPage=New";
						$text_param = $Page1 . "?1=1&proc=search_data_add&SEND_TO=" . $_GET['SEND_TO'] . "&TO_PERSON_ID=" . $_SESSION['TO_PERSON_ID'] . $url;

						if ($A == "1") {
							$text_param = $Page2;
						}
						?> <a class="btn btn-primary active waves-effect waves-light" href="<?php echo $text_param; ?>" role="button" title=""><i class="icofont icofont-ui-add"></i>เพิ่มข้อมูล</a>
					</div>
				</div>
			</div>
		</div>
		<div class=" row">
			<div class="col-md-12">
				<div class="card">
					<div id="wf_space" class="card-header">

						<form method="get" id="frm-search" name="frm-search" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
							<input type="hidden" name="process" id="process" value="">
							<input type="hidden" name="REGISTERCODE" id="REGISTERCODE" value="<?php echo $_GET["REGISTERCODE"]; ?>">
							<input type="hidden" id="page" name="page" value="<?php echo $_GET["page"]; ?>">
							<input type="hidden" id="page_size" name="page_size" value="<?php echo $_GET["page_size"]; ?>">
							<input type="hidden" id="SEND_TO" name="SEND_TO" value="<?php echo $_GET["SEND_TO"]; ?>">
							<input type="hidden" id="TO_PERSON_ID" name="TO_PERSON_ID" value="<?php echo $_SESSION['TO_PERSON_ID']; ?>">
							<div class="form-group row">
								<div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
									<label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำ</label>
								</div>
								<div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="T_BLACK_CASE" id="T_BLACK_CASE" class="form-control" value="<?php echo $T_BLACK_CASE; ?>">
									<small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="BLACK_CASE" id="BLACK_CASE" class="form-control" value="<?php echo $BLACK_CASE; ?>">
									<small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
									<div class="row">
										<div id="" class="col-md-1 wf-left">
											ปี
										</div>
										<div id="" class="col-md-5 wf-left">
											<input type="text" name="BLACK_YY" id="BLACK_YY" class="form-control" value="<?php echo $BLACK_YY; ?>">
											<small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
										</div>
									</div>
								</div>

								<div id="RED_CASE_BSF_AREA" class="col-md-2 ">
									<label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดง</label>
								</div>
								<div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="T_RED_CASE" id="T_RED_CASE" class="form-control" value="<?php echo $T_RED_CASE; ?>">
									<small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
									<input type="text" name="RED_CASE" id="RED_CASE" class="form-control" value="<?php echo $RED_CASE; ?>">
									<small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
								<div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
									<div class="row">
										<div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
											ปี
										</div>
										<div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
											<input type="text" name="RED_YY" id="RED_YY" class="form-control" value="<?php echo $RED_YY; ?>">
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
									<select name="S_COM_STATUS" id="S_COM_STATUS" class="form-control select2" tabindex="-1">
										<option value="1" <?php echo $_GET["S_COM_STATUS"] == 1 ? "selected" : ""; ?>>คำสั่งเข้าใหม่</option>
										<option value="2" <?php echo $_GET["S_COM_STATUS"] == 2 ? "selected" : ""; ?>>ทั้งหมด</option>
									</select>
								</div>
								<div class="col-md-1 wf-left"></div>
								<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
									<label for="CMD_TYPE" class="form-control-label wf-right">การแสดงข้อมูล</label>
								</div>
								<div class="col-md-2 wf-left">
									<select name="S_SYSTEM_READ_STATUS" id="S_SYSTEM_READ_STATUS" class="form-control select2" tabindex="-1">
										<option value="1" <?php echo $S_SYSTEM_READ_STATUS == 1 ? "selected" : ""; ?>>ที่ยังไม่ได้อ่าน</option>
										<option value="2" <?php echo $S_SYSTEM_READ_STATUS == 2 ? "selected" : ""; ?>>ทั้งหมด</option>
									</select>
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
											<th style="width: 7%;" class="text-center">วันที่/เวลา</th>
											<th style="width: 20%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
											<th style="width: 7%;" class="text-center">ประเภท</th>
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
										if ($_GET["GET_S_PREFIX_CASE_BLACK"] != "" && $_GET["GET_T_PREFIX_CASE_BLACK"]) {
											//จากระบบต้นทางไปหาระบบอื่นๆ
											$filterCom .= " AND ((T_BLACK_CASE = '" . $_GET["GET_S_PREFIX_CASE_BLACK"] . "'";
											$filterCom .= " AND BLACK_CASE = '" . $_GET["GET_S_CASE_BLACK"] . "'";
											$filterCom .= " AND BLACK_YY = '" . $_GET["GET_S_CASE_BLACK_YEAR"] . "'";
											if (trim($_GET["GET_S_PREFIX_CASE_RED"]) != "") {
												$filterCom .= " AND T_RED_CASE = '" . $_GET["GET_S_PREFIX_CASE_RED"] . "'";
											}
											$filterCom .= " AND RED_CASE = '" . $_GET["GET_S_CASE_RED"] . "'";
											$filterCom .= " AND RED_YY = '" . $_GET["GET_S_CASE_RED_YEAR"] . "'";

											$filterCom .= " AND TO_T_BLACK_CASE = '" . $_GET["GET_T_PREFIX_CASE_BLACK"] . "'";
											$filterCom .= " AND TO_BLACK_CASE = '" . $_GET["GET_T_CASE_BLACK"] . "'";
											$filterCom .= " AND TO_BLACK_YY = '" . $_GET["GET_T_CASE_BLACK_YEAR"] . "'";
											if (trim($_GET["GET_T_PREFIX_CASE_RED"]) != "") {
												$filterCom .= " AND TO_T_RED_CASE = '" . $_GET["GET_T_PREFIX_CASE_RED"] . "'";
											}
											$filterCom .= " AND TO_RED_CASE = '" . $_GET["GET_T_CASE_RED"] . "'";
											$filterCom .= " AND TO_RED_YY = '" . $_GET["GET_T_CASE_RED_YEAR"] . "') or ";

											//จากระบบอื่นเข้ามาที่ระบบต้นทาง
											$filterCom .= " (T_BLACK_CASE = '" . $_GET["GET_T_PREFIX_CASE_BLACK"] . "'";
											$filterCom .= " AND BLACK_CASE = '" . $_GET["GET_T_CASE_BLACK"] . "'";
											$filterCom .= " AND BLACK_YY = '" . $_GET["GET_T_CASE_BLACK_YEAR"] . "'";
											if (trim($_GET["GET_T_PREFIX_CASE_RED"]) != "") {
												$filterCom .= " AND T_RED_CASE = '" . $_GET["GET_T_PREFIX_CASE_RED"] . "'";
											}
											$filterCom .= " AND RED_CASE = '" . $_GET["GET_T_CASE_RED"] . "'";
											$filterCom .= " AND RED_YY = '" . $_GET["GET_T_CASE_RED_YEAR"] . "'";

											$filterCom .= " AND TO_T_BLACK_CASE = '" . $_GET["GET_S_PREFIX_CASE_BLACK"] . "'";
											$filterCom .= " AND TO_BLACK_CASE = '" . $_GET["GET_S_CASE_BLACK"] . "'";
											$filterCom .= " AND TO_BLACK_YY = '" . $_GET["GET_S_CASE_BLACK_YEAR"] . "'";
											if (trim($_GET["GET_S_PREFIX_CASE_RED"]) != "") {
												$filterCom .= " AND TO_T_RED_CASE = '" . $_GET["GET_S_PREFIX_CASE_RED"] . "'";
											}
											$filterCom .= " AND TO_RED_CASE = '" . $_GET["GET_S_CASE_RED"] . "'";
											$filterCom .= " AND TO_RED_YY = '" . $_GET["GET_S_CASE_RED_YEAR"] . "') ) ";
										} else {
											if ($T_BLACK_CASE != "") {
												$filterCom .= " AND (T_BLACK_CASE = '" . $T_BLACK_CASE . "' or TO_T_BLACK_CASE = '" . $T_BLACK_CASE . "')";
											}
											if ($BLACK_CASE != "") {
												$filterCom .= " AND (BLACK_CASE = '" . $BLACK_CASE . "'  or TO_BLACK_CASE = '" . $BLACK_CASE . "')";
											}
											if ($BLACK_YY != "") {
												$filterCom .= " AND (BLACK_YY = '" . $BLACK_YY . "'  or TO_BLACK_YY = '" . $BLACK_YY . "')";
											}
											if (trim($T_RED_CASE) != "") {
												$filterCom .= " AND (T_RED_CASE = '" . $T_RED_CASE . "'  or TO_T_RED_CASE = '" . $T_RED_CASE . "')";
											}
											if (trim($RED_CASE) != "") {
												$filterCom .= " AND (RED_CASE = '" . $RED_CASE . "'  or TO_RED_CASE = '" . $RED_CASE . "')";
											}
											if (trim($RED_YY) != "") {
												$filterCom .= " AND (RED_YY = '" . $RED_YY . "'  or TO_RED_YY = '" . $RED_YY . "')";
											}
										}

										if ($S_SYSTEM_READ_STATUS == 1) {
											$filterCom .= " AND NVL(SYSTEM_READ_STATUS,'N')= 'N' ";
										}
										// echo $T_RED_CAS;
										// echo $RED_CASE;
										// echo $RED_YY;
										// echo $filterCom;
										/* $sqlSelectData = "	SELECT 		TRANSACTION_APPROVE_PERSON,TRANSACTION_STATUS_APP,A.APPROVE_STATUS,A.APPROVE_PERSON,A.ID,CMD_READ_STATUS,CMD_DOC_DATE,CMD_DOC_TIME,CMD_TYPE_NAME,C.FLAG_CMD_NOTI,SERVICE_SYS_NAME,TO_COURT_NAME,A.ID,T_BLACK_CASE,BLACK_CASE,BLACK_YY,T_RED_CASE,RED_CASE,RED_YY,CMD_NOTE,CMD_GRP_NAME ,ALERT_NOTI,SEND_TO,TO_T_BLACK_CASE,TO_BLACK_CASE,TO_BLACK_YY,TO_T_RED_CASE,TO_RED_CASE,TO_RED_YY,CMD_NOTE
										FROM		M_DOC_CMD A
										LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
										LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
										LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
										LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
										WHERE		1=1 AND 
													(
													(A.SEND_TO = '" . $_GET["SEND_TO"] . "' and (A.TO_PERSON_ID = '" . $_GET["TO_PERSON_ID"] . "' or A.TRANSACTION_APPROVE_PERSON = '" . $_GET["TO_PERSON_ID"] . "')) 
													 OR 
													 (A.SYS_NAME = '" . $_GET["SEND_TO"] . "' AND ( A.OFFICE_IDCARD = '" . $_GET["TO_PERSON_ID"] . "' OR APPROVE_PERSON = '" . $_GET["TO_PERSON_ID"] . "' or A.OFFICE_IDCARD is null
													  ))
													 OR A.ID in (SELECT REF_ID FROM M_DOC_CMD AA WHERE ( A.OFFICE_IDCARD = '" . $_GET["TO_PERSON_ID"] . "' OR APPROVE_PERSON = '" . $_GET["TO_PERSON_ID"] . "'))
													 )
													 AND NVL(REF_ID,0) = 0
													 AND A.OFFICE_IDCARD IS NOT null
													 {$filterCom}
										ORDER BY	CMD_DOC_DATE asc,CMD_DOC_TIME asc
													"; */

										$i = 1;
										$FIll = "";
										/* if ($_GET['TO_PERSON_ID'] != '') {
											$FIll = "AND A.APPROVE_PERSON ='" . $_GET['TO_PERSON_ID'] . "'";
										}

										$SQL_CMD = "
										SELECT 
										*
										FROM M_DOC_CMD A
										LEFT JOIN M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
										LEFT JOIN M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
										LEFT JOIN M_CMD_PERSON D ON	D.PERSON_ID = A.PERSON_ID
										LEFT JOIN M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID
										WHERE 1 = 1	
										AND NVL(A.REF_ID, 0) = 0 
										--AND A.OFFICE_IDCARD IS NOT NULL
										{$FIll}
										ORDER BY	
										A.CMD_DOC_DATE DESC,
										A.CMD_DOC_TIME DESC
										"; */
										$show = "true";
										//if ($_GET["SEND_TO"] != "" && $_SESSION['TO_PERSON_ID'] != "" && $show == 'true') {
										if ($show == 'true') {
											$FIll = "AND 
												(
												(A.SEND_TO = '" . $_SESSION["SEND_TO"] . "' and (A.TO_PERSON_ID = '" . $_SESSION['TO_PERSON_ID'] . "' or A.TRANSACTION_APPROVE_PERSON = '" . $_SESSION['TO_PERSON_ID'] . "')) 
												OR 
												(A.SYS_NAME = '" . $_SESSION["SEND_TO"] . "' AND ( A.OFFICE_IDCARD = '" . $_SESSION['TO_PERSON_ID'] . "' OR APPROVE_PERSON = '" . $_SESSION['TO_PERSON_ID'] . "' or A.OFFICE_IDCARD = '" . $_SESSION['TO_PERSON_ID'] . "'
												))
												OR A.ID in (SELECT REF_ID FROM M_DOC_CMD AA WHERE ( A.OFFICE_IDCARD = '" . $_SESSION['TO_PERSON_ID'] . "' OR APPROVE_PERSON = '" . $_SESSION['TO_PERSON_ID'] . "'))
												)";
										}
										$SQL_CMD = "	SELECT 	*
										FROM		M_DOC_CMD A
										LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
										LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
										LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
										LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
										WHERE		1=1 
										{$FIll}
										--AND NVL(REF_ID,0) = 0
										--AND A.OFFICE_IDCARD IS NOT null
										{$filterCom}
										ORDER BY	CMD_DOC_DATE DESC,CMD_DOC_TIME DESC
													";
										//echo $SQL_CMD;
										function get_top($sql = "", $page = "", $page_size = "")
										{
											$page_size = $page_size == "" ? "20" : $page_size;
											$page = $page == "" ? "1" : $page;
											$P = $page_size - 1;
											$offset = ($page * $page_size) - $P;
											$limit = $page * $page_size;
											return $sql_limit = 'select * from ( select AAAA.*, rownum rnum from ( ' . $sql . ' ) AAAA ) where rnum between ' . $offset . ' and ' . $limit . ' ';
										}

										function send_back_comment($ID, $Fill)
										{
											$sql = "SELECT a.SEND_BACK_EDIT,a.*  FROM M_DOC_CMD a WHERE a.ID ='" . $ID . "'";
											$qry = db::query($sql);
											$data = db::fetch_array($qry);
											return $data[$Fill];
										}

										$queryCMD = db::query(get_top($SQL_CMD, $page, $page_size));
										$querySelectData = db::query($sqlSelectData);

										while ($dataSelectData = db::fetch_array($queryCMD)) {
										?>
											<style>
												.font_table {
													font-size: 16px;
													font-weight: bold;
													background-color: #FFD6D6;
												}
											</style>
											<tr class="font_table">
												<td align="center">
													<?php echo $i; ?>
													<img src="icon_img_new.png" width="30px;">
													<!-- <?php
															if ($tab_active == 1) {
																if ($dataSelectData["CMD_READ_STATUS"] == 0) {
															?>
															<img src="icon_img_new.png" width="30px;">
														<?php
																} else {
														?>
															<img src="icon_img_read.png" width="30px;">
													<?php
																}
															}
													?> -->
													<?php echo $dataSelectData["ID"]  ?>
												</td>
												<?php $i++; ?>
												<td><?php echo db2date($dataSelectData["CMD_DOC_DATE"]) . " " . substr($dataSelectData["CMD_DOC_TIME"], 0, 5); ?></td>
												<td>
													<?php
													if ($dataSelectData["ALERT_NOTI"] == 1) {
													?>
														<img src="Alert.gif" width="30px;">
													<?php
													}
													echo $dataSelectData["CMD_NOTE"];

													?>
												</td>
												<td align="center">
													<?php
													$update_view = "";
													if ($dataSelectData["SEND_TO"] == $_GET["SEND_TO"]) {
														//echo "ขาเข้า";
														echo "คำถาม";
														$update_view = "Y";
													} else {
														//echo "ขาออก";
														echo "คำถาม";
														//echo "คำตอบ";
														//AK
														$update_view = "Y";
													}
													?>
												</td>
												<td><?php echo $dataSelectData["SERVICE_SYS_NAME"]; ?></td>
												<td><?php echo getsystemName($dataSelectData["SEND_TO"]); ?></td>
												<td align="center"><?php echo $dataSelectData["TO_COURT_NAME"]; ?></td>
												<td align="center">
													<?php
													if (!empty($dataSelectData["TO_BLACK_CASE"])) {
													?>
													<?php echo $dataSelectData["TO_T_BLACK_CASE"] . $dataSelectData["TO_BLACK_CASE"] . "/" . $dataSelectData["TO_BLACK_YY"];
													} ?>
												</td>
												<td align="center">
													<?php
													if (!empty($dataSelectData["TO_RED_CASE"])) {
													?>
													<?php echo $dataSelectData["TO_T_RED_CASE"] . $dataSelectData["TO_RED_CASE"] . "/" . $dataSelectData["TO_RED_YY"];
													} ?>
												</td>
												<td>
													<?php
													$sqlFile = "	SELECT 		DF.FILE_SAVE_NAME,
																			DF.FILE_NAME
																FROM 		FRM_CMD_FILE A
																LEFT JOIN 	WF_FILE DF ON DF.WFR_ID = A.F_ID AND DF.WF_MAIN_ID = '109'
																WHERE 		A.WF_MAIN_ID = '110' AND
																			(A.WFR_ID = '" . $dataSelectData['ID'] . "' OR A.F_TEMP_ID = '" . $dataSelectData['ID'] . "')
																ORDER BY 	A.F_ID ASC
																";
													$queryFile = db::query($sqlFile);
													$i_file = 0;
													while ($recFile = db::fetch_array($queryFile)) {
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
												<td align="center">
													<?php
													$sql_reply = "	SELECT 		TRANSACTION_APPROVE_PERSON,TRANSACTION_STATUS_APP,A.APPROVE_STATUS,A.APPROVE_PERSON,A.ID,CMD_READ_STATUS,CMD_DOC_DATE,CMD_DOC_TIME,CMD_TYPE_NAME,C.FLAG_CMD_NOTI,SERVICE_SYS_NAME,TO_COURT_NAME,A.ID,T_BLACK_CASE,BLACK_CASE,BLACK_YY,T_RED_CASE,RED_CASE,RED_YY,CMD_NOTE,CMD_GRP_NAME ,ALERT_NOTI,SEND_TO,TO_T_BLACK_CASE,TO_BLACK_CASE,TO_BLACK_YY,TO_T_RED_CASE,TO_RED_CASE,TO_RED_YY,CMD_NOTE
													FROM		M_DOC_CMD A
													LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
													LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
													LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
													LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
													WHERE		1=1 
																AND NVL(REF_ID,0) = " . $dataSelectData['ID'] . "
																{$filterCom}
													order by 	 CMD_DOC_DATE asc,CMD_DOC_TIME asc
															";
													$query_reply = db::query($sql_reply);
													$num_reply = db::num_rows($query_reply);

													if ($dataSelectData["APPROVE_STATUS"] == 0) {
														echo "รอพิจารณา";
													} else if ($dataSelectData["APPROVE_STATUS"] == 1) {
														if ($num_reply == 0) {
															echo "รอการตอบกลับ";
														} else if ($num_reply > 0) {
															echo "ตอบกลับเเล้ว";
														}
													} else if ($dataSelectData["APPROVE_STATUS"] == 2) {
														echo send_back_comment($dataSelectData["ID"], 'SEND_BACK_EDIT'); //echo "ส่งกลับแก้ไข"
													}
													/* if ($dataSelectData["FLAG_CMD_NOTI"] == 'Y') {
														echo "ส่งแจ้งแล้ว";
													} else {
														if ($dataSelectData["SEND_TO"] == $_GET["SEND_TO"]) {
															$sqlSelectCountSend = "select count(1) as COUNT_DATA from M_DOC_CMD where NVL(REF_ID,0) = " . $dataSelectData['ID'] . "";
															$querySelectCountSend = db::query($sqlSelectCountSend);
															$dataSelectDataSub = db::fetch_array($querySelectCountSend);
															if ($dataSelectDataSub["COUNT_DATA"] > 0) {
																echo "ตอบกลับเเล้ว";
															} else {
																echo "รอตอบกลับ";
															}
														} else {
															if ($dataSelectData["APPROVE_STATUS"] == 0) {
																echo "รอพิจารณา";
															} else if ($dataSelectData["APPROVE_STATUS"] == 1) {
																echo "พิจารณาเเล้ว";
															} else if ($dataSelectData["APPROVE_STATUS"] == 2) {
																echo send_back_comment($dataSelectData["ID"], 'SEND_BACK_EDIT');
																//echo "ส่งกลับแก้ไข";
															}
														}
													} */
													?>
												</td>

												<td align="center">
													<style>
														.content_btn {
															display: flex;
															justify-content: center;
															margin-top: 5px;
															margin-bottom: 5px;
															/* ปรับตำแหน่งของปุ่ม */
														}

														.content_btn a {
															margin: 0 5px;
															/* ระยะห่างระหว่างปุ่ม */
														}
													</style>
													<div class="content_btn">
														<?php
														if ($dataSelectData["APPROVE_STATUS"] == 2 && $dataSelectData["OFFICE_IDCARD"] == $_SESSION['TO_PERSON_ID']) {
														?>
															<a href="cmd_add_from_send_to.php?ID=<?php echo $dataSelectData["ID"] ?>&proc=edit&TO_PERSON_ID=<?php echo $_SESSION['TO_PERSON_ID']; ?>&SEND_TO=<?php echo $_GET["SEND_TO"] ?>" class="btn btn-success btn-mini" title=""> <i class="icofont icofont-ui-edit"></i> </a><!-- เเก้ไข -->
															<a href="#!" class="btn btn-danger btn-mini" title="" onclick="delete_cmd('<?php echo $dataSelectData['ID'] ?>')"><i class="icofont icofont-trash"></i> </a><!-- ลบ -->
														<?php
														}
														?>
														<button class="btn btn-info btn-mini" type="button" onclick="window.open('search_view.php?ID=<?php echo $dataSelectData['ID'] ?>&update_view=<?php echo $update_view; ?>&TO_PERSON_ID=<?php echo $_SESSION['TO_PERSON_ID']; ?>&SEND_TO=<?php echo $_GET['SEND_TO'] ?>', 'รายการคำสั่งเจ้าพนักงาน', 'width=800,height=700');"><i class="icofont icofont-search"></i></button>
														<!-- ปริ้น --> <a href="print_doc_cmd_form.php?ID=<?php echo $dataSelectData["ID"] ?>" target="_blank" class="btn btn-warning btn-mini" title=""><i class="icofont icofont-print"></i> </a><!-- ปริ้น -->

														<button type="button" onclick="openModal_Log('<?php echo $dataSelectData['ID'] ?>')" class="btn btn-light btn-mini" data-toggle="modal" data-target="#modal_log" name='log' id="log">log</button>

													</div>

													<?php

													//AK
													/* echo "APPROVE_STATUS=".$dataSelectData["APPROVE_STATUS"]."<br>";
													echo "APPROVE_PERSON=".$dataSelectData["APPROVE_PERSON"]."<br>";
													echo "TO_PERSON_ID=".$_SESSION['TO_PERSON_ID']."<br>"; */
													if ($dataSelectData["APPROVE_STATUS"] == 0 && $dataSelectData["APPROVE_PERSON"] == $_SESSION['TO_PERSON_ID']) { //คนที่มีสิทธ์เสนอพิจารณาเท่านั้นถึงจะเห็น
													?>
														<div class="content_btn">
															<a href="search_view.php?ID=<?php echo $dataSelectData["ID"] ?>&approve=Y&TO_PERSON_ID=<?php echo $_SESSION['TO_PERSON_ID']; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>" target="_blank" class="btn btn-success btn-mini" title="">
																<i class="icofont icofont-search"></i> พิจารณา
															</a>
														</div>
													<?php
													}

													/* if ($dataSelectData["TRANSACTION_STATUS_APP"] == 0 && $dataSelectData["APPROVE_STATUS"] == 1 && $rec_status['POS_ID'] == '512403') { */ //นิติ
													if ($dataSelectData["TRANSACTION_STATUS_APP"] == 0 && $dataSelectData["APPROVE_STATUS"] == 1) {
													?>
														<div class="content_btn">
															<a href="search_view.php?ID=<?php echo $dataSelectData["ID"] ?>&approve2=Y&TO_PERSON_ID=<?php echo $dataSelectData["APPROVE_PERSON"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>&REGISTERCODE=<?php echo $_GET["REGISTERCODE"]; ?>" target="_blank" class="btn btn-success btn-mini" title="">
																<i class="icofont icofont-search"></i> รับทราบ
															</a>
														</div>
													<?php
													}
													?>

													<!-- start ตอบกลับ main -->
													<?php
													//echo "APPROVE_PERSON=" . $dataSelectData["APPROVE_PERSON"] . "<br>";
													//echo "APPROVE_STATUS=" . $dataSelectData["APPROVE_STATUS"] . "<br>";
													//echo "TRANSACTION_STATUS_APP=" . $dataSelectData["TRANSACTION_STATUS_APP"] . "<br>";
													//echo "SEND_TO=" . $dataSelectData["SEND_TO"] . "  " . $SEND_TO . "<br>";
													//echo "TO_PERSON_ID=" . $dataSelectData["TO_PERSON_ID"]  . "<br>";
													if ($num_reply == '0' &&  $dataSelectData["APPROVE_STATUS"] == 1 && $dataSelectData["TRANSACTION_STATUS_APP"] == 1  && $dataSelectData["SEND_TO"] == $SEND_TO && $dataSelectData["TO_PERSON_ID"] == $_SESSION['TO_PERSON_ID']) { //ตอบกลับคนที่โดนส่งถึงเเละเป็นเจ้าของตอบกลับได้เท่านั้น
													?>
														<div class="content_btn">
															<button type="button" onclick="reply_com('<?php echo  $dataSelectData['ID']; ?>','<?php echo $_SESSION['TO_PERSON_ID']; ?>','<?php echo $_GET['SEND_TO'] ?>');" class="btn btn-danger btn-mini"><i class="icofont icofont-tick-mark" title=""></i> ตอบกลับ</button>
														</div>
													<?php } ?>
													<?php if ($num_reply > 0 &&  $dataSelectData["APPROVE_STATUS"] == 1 && $dataSelectData["TRANSACTION_STATUS_APP"] == 1 && $dataSelectData["SEND_TO"] == $SEND_TO && $dataSelectData["TO_PERSON_ID"] == $_SESSION['TO_PERSON_ID']) {
													?>
														<div class="content_btn">
															<button style="background-color:#fffde7;color :#333" type="button" onclick="reply_com('<?php echo  $dataSelectData['ID']; ?>','<?php echo $_SESSION['TO_PERSON_ID']; ?>','<?php echo $_GET['SEND_TO'] ?>');" class="btn btn-mini"><i class="ion-plus"></i> เพิ่มคำสั่ง</button>
														</div>
													<?php } ?>
													<!-- stop ตอบกลับ main -->
												</td>
											</tr>
											<?php
											$sql_reply = "	SELECT 		A.TO_PERSON_ID ,TRANSACTION_APPROVE_PERSON,TRANSACTION_STATUS_APP,A.APPROVE_STATUS,A.APPROVE_PERSON,A.ID,CMD_READ_STATUS,CMD_DOC_DATE,CMD_DOC_TIME,CMD_TYPE_NAME,C.FLAG_CMD_NOTI,SERVICE_SYS_NAME,TO_COURT_NAME,A.ID,T_BLACK_CASE,BLACK_CASE,BLACK_YY,T_RED_CASE,RED_CASE,RED_YY,CMD_NOTE,CMD_GRP_NAME ,ALERT_NOTI,SEND_TO,TO_T_BLACK_CASE,TO_BLACK_CASE,TO_BLACK_YY,TO_T_RED_CASE,TO_RED_CASE,TO_RED_YY,CMD_NOTE
											FROM		M_DOC_CMD A
											LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
											LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
											LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
											LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
											WHERE		1=1 
														AND NVL(REF_ID,0) = " . $dataSelectData['ID'] . "
														{$filterCom}
											order by 	 CMD_DOC_DATE asc,CMD_DOC_TIME asc
													";

											$H = 1;
											$query_reply = db::query($sql_reply);
											$num_reply = db::num_rows($query_reply);
											$query_reply = db::query($sql_reply);
											while ($data_reply = db::fetch_array($query_reply)) {
											?>
												<tr style="background-color: #E6E6FA;">
													<td align="center">
														<i class="fa fa-mail-reply"></i>
													</td>
													<td><?php echo db2date($data_reply["CMD_DOC_DATE"]) . " " . substr($data_reply["CMD_DOC_TIME"], 0, 5); ?></td>
													<td>
														<?php
														if ($data_reply["ALERT_NOTI"] == 1) {
														?>
															<img src="Alert.gif" width="30px;">
														<?php
														}
														echo $data_reply["CMD_NOTE"];
														?>
													</td>
													<td align="center">
														<?php
														$update_view = "";
														if ($data_reply["SEND_TO"] == $_GET["SEND_TO"]) {
															//echo "ขาเข้า";
															echo "คำตอบ";
															$update_view = "Y";
														} else {
															//echo "ขาออก";
															echo "คำตอบ";
														}
														?>
													</td>
													<td><?php echo $data_reply["SERVICE_SYS_NAME"]; ?></td>
													<td><?php echo getsystemName($data_reply["SEND_TO"]); ?></td>
													<td align="center"><?php echo $data_reply["TO_COURT_NAME"]; ?></td>
													<td align="center">
														<?php if (!empty($data_reply["TO_BLACK_CASE"])) { ?>
														<?php echo $data_reply["TO_T_BLACK_CASE"] . $data_reply["TO_BLACK_CASE"] . "/" . $data_reply["TO_BLACK_YY"];
														} ?>
													</td>
													<td align="center">
														<?php if (!empty($data_reply["TO_RED_CASE"])) { ?>
														<?php echo $data_reply["TO_T_RED_CASE"] . $data_reply["TO_RED_CASE"] . "/" . $data_reply["TO_RED_YY"];
														} ?>
													</td>
													<td>
														<?php
														$sqlFile = "	SELECT 		DF.FILE_SAVE_NAME,
																			DF.FILE_NAME
																FROM 		FRM_CMD_FILE A
																LEFT JOIN 	WF_FILE DF ON DF.WFR_ID = A.F_ID AND DF.WF_MAIN_ID = '109'
																WHERE 		A.WF_MAIN_ID = '110' AND
																			(A.WFR_ID = '" . $data_reply['ID'] . "' OR A.F_TEMP_ID = '" . $data_reply['ID'] . "')
																ORDER BY 	A.F_ID ASC
																";
														$queryFile = db::query($sqlFile);
														$i_file = 0;
														while ($recFile1 = db::fetch_array($queryFile)) {
														?>
															<li>
																<a href="../attach/w109/<?php echo $recFile1['FILE_SAVE_NAME']; ?>" target="_blank">
																	<?php echo $recFile1['FILE_NAME']; ?>
																</a>
															</li>
														<?php
														}
														?>
													</td>
													<td align="center">
														<?php
														if ($data_reply["APPROVE_STATUS"] == 0) {
															echo "รอพิจารณา";
														} else if ($data_reply["APPROVE_STATUS"] == 1) {
															if ($num_reply == $H) {
																echo "รอการตอบกลับ";
															} else {
																echo "ตอบกลับเเล้ว";
															}
														} else if ($data_reply["APPROVE_STATUS"] == 2) {
															echo send_back_comment($data_reply["ID"], 'SEND_BACK_EDIT'); //echo "ส่งกลับแก้ไข"
														}
														/* if ($data_reply["SEND_TO"] == $_GET["SEND_TO"]) {
															echo "รอดำเนินการ";
														} else {
															if ($data_reply["FLAG_CMD_NOTI"] == 'Y') {
																echo "ส่งแจ้งแล้ว";
															} else {
																if ($data_reply["APPROVE_STATUS"] == 0) {
																	echo "รออนุมัติ";
																} else {
																	echo "อนุมัติเเล้ว";
																}
															}
														} */
														?>
													</td>
													<td align="center">
														<?php
														//if ($data_reply["APPROVE_STATUS"] == 2 || $data_reply["APPROVE_STATUS"] == 0) {
														if ($data_reply["APPROVE_STATUS"] == 2) {
														?>
															<div class="content_btn">
																<a href="cmd_add_from_send_to_return.php?ID=<?php echo $data_reply["ID"] ?>&proc=edit&subID=edit&TO_PERSON_ID=<?php echo $_SESSION['TO_PERSON_ID']; ?>&SEND_TO=<?php echo $_GET["SEND_TO"] ?>" class="btn btn-success btn-mini" title=""> <i class="icofont icofont-ui-edit"></i> </a>
																<a href="#!" class="btn btn-danger btn-mini" title="" onclick="delete_cmd('<?php echo $data_reply['ID'] ?>')">
																	<i class="icofont icofont-trash"></i>
																</a>

															<?php
														}
															?>
															<button class="btn btn-info btn-mini" type="button" onclick="window.open('search_view.php?ID=<?php echo $data_reply['ID'] ?>&update_view=<?php echo $update_view; ?>&TO_PERSON_ID=<?php echo $_SESSION['TO_PERSON_ID']; ?>&SEND_TO=<?php echo $_GET['SEND_TO'] ?>', 'รายการคำสั่งเจ้าพนักงาน', 'width=800,height=700');"><i class="icofont icofont-search"></i></button>
															<button type="button" onclick="openModal_Log('<?php echo $data_reply['ID'] ?>')" class="btn btn-light btn-mini" data-toggle="modal" data-target="#modal_log" name='log' id="log">log</button>
															</div>


															<?php
															//echo "APPROVE_PERSON=".$data_reply["APPROVE_PERSON"];
															if ($data_reply["APPROVE_STATUS"] == 0 && $data_reply["APPROVE_PERSON"] == $_SESSION['TO_PERSON_ID']) {
															?>
																<div class="content_btn">
																	<a href="search_view.php?ID=<?php echo $data_reply["ID"] ?>&approve=Y&TO_PERSON_ID=<?php echo $_SESSION['TO_PERSON_ID']; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>" target="_blank" class="btn btn-success btn-mini" title="">
																		<i class="icofont icofont-search"></i> พิจารณา
																	</a>
																</div>
															<?php
															}

															/* if ($dataSelectData["TRANSACTION_STATUS_APP"] == 0 && $dataSelectData["APPROVE_STATUS"] == 1 && $rec_status['POS_ID'] == '512403') { */ //นิติ
															if ($data_reply["TRANSACTION_STATUS_APP"] == 0 && $data_reply["APPROVE_STATUS"] == 1) {
															?>
																<div class="content_btn">
																	<a href="search_view.php?ID=<?php echo $data_reply["ID"] ?>&approve2=Y&TO_PERSON_ID=<?php echo $dataSelectData["APPROVE_PERSON"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>&REGISTERCODE=<?php echo $_GET["REGISTERCODE"]; ?>" target="_blank" class="btn btn-success btn-mini" title="">
																		<i class="icofont icofont-search"></i> รับทราบ
																	</a>
																</div>
															<?php
															}
															?>
															<?php

															if ($num_reply == $H && $data_reply["APPROVE_STATUS"] == 1 && $data_reply["SEND_TO"] == $SEND_TO && $data_reply["TO_PERSON_ID"] == $_SESSION['TO_PERSON_ID']) { ?>
																<div class="content_btn">
																	<button type="button" onclick="reply_com('<?php echo  $data_reply['ID']; ?>','<?php echo $_SESSION['TO_PERSON_ID']; ?>','<?php echo $_GET['SEND_TO'] ?>');" class="btn btn-success btn-mini"><i class="icofont icofont-tick-mark" title=""></i> ตอบกลับ</button>
																</div>
															<?php
															}
															?>
															<?php
															/* if ($dataSelectData["TRANSACTION_STATUS_APP"] == 0 && $dataSelectData["APPROVE_STATUS"] == 1) {
														?>
															<a href="search_view.php?ID=<?php echo $dataSelectData["ID"] ?>&approve2=Y&TO_PERSON_ID=<?php echo $dataSelectData["APPROVE_PERSON"]; ?>&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>&REGISTERCODE=<?php echo $_GET["REGISTERCODE"]; ?>" target="_blank" class="btn btn-success btn-mini" title="">
																<i class="icofont icofont-search"></i> รับทราบ
															</a>
														<?php
														} */
															?>
													</td>
												</tr>
											<?php
												$H++;
											}
											?>
										<?php
										}
										?>
									<tbody>
								</table>
							</div>

							<!-- Modal_Log start -->
							<script>
								function openModal_Log(ID) {
									/* $('#S_DBD').hide("");
									$('#A_DBD').hide("");
									$('#juristicNameTh').text(""); */
									$.ajax({
										type: "POST",
										url: "../public/search_data_process_A.php",
										data: {
											proc: 'modalLog',
											ID: ID
										},
										cache: false,
										success: function(data) {
											console.log('data')
											console.log(data)
											$(".modal_log_body").html(data);
										}
									});
								}
							</script>
							<div class="modal fade" id="modal_log" tabindex="-1" role="dialog" aria-labelledby="modal_log" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Log</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal_log_body">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
										</div>
									</div>
								</div>
							</div>
							<!-- Modal_Log stop -->



							<div class="clearfix"></div>
							<style>
								/* กำหนดสไตล์สำหรับ Pagination */
								.pagination {
									display: flex;
									list-style: none;
									padding: 0;
									margin: 20px 0;
									justify-content: center;
								}

								/* กำหนดสไตล์สำหรับรายการหน้า */
								.pagination li {
									margin: 0 0px;
									display: flex;
								}

								/* กำหนดสไตล์สำหรับลิงค์ของหน้า */
								.pagination li a {
									text-decoration: none;
									color: #333;
									padding: 5px 10px;
									border: 1px solid #ccc;
									border-radius: 3px;
								}

								/* กำหนดสไตล์สำหรับลิงค์ของหน้า (เมื่อนอกเนื้อหาปัจจุบัน) */
								.pagination li a:hover {
									background-color: #f4f4f4;
								}

								/* กำหนดสไตล์สำหรับลิงค์ของหน้าปัจจุบัน */
								.pagination li.active a {
									background-color: #007bff;
									color: #fff;
								}
							</style>
							<?php
							$total_CMD = db::num_rows(db::query($SQL_CMD));
							echo ($total_CMD  > 1) ? endPaging("frm-search", $total_CMD) : ""; ?>
							<div class="clearfix"></div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- start modal_reply -->
<style>
	.custom-modal-lg {
		max-width: 90%;
		padding-left: 10px;
	}
</style>

<div class="modal fade bd-example-modal-lg modal_reply" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog custom-modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">ตอบกลับรายการ</h3>
			</div>
			<div class="row" style="margin-top: 10px;"></div>
			<div class="row">
				<div class="" align="center">
					<input readonly type="hidden" name="ID" id="ID" class="form-control" value="">
					<input readonly type="hidden" name="PARENT_NUM" id="PARENT_NUM" class="form-control" value="">
					<input readonly type="hidden" name="OFFICE_IDCARD" id="OFFICE_IDCARD" class="form-control" value="">
				</div>
				<div class="col-md-2" align="center">
					<h4><u>ผู้ส่ง</u> </h4>
				</div>
			</div>


			<div class="row" style="padding: 20px 20px 20px 20px;">
				<div class="form-group row">
					<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 ">
						<label for="CMD_DOC_DATE" class="form-control-label wf-right">วันที่</label>
					</div>
					<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 wf-left">
						<label class="input-group">
							<input type="hidden" name="CMD_DOC_DATE" id="CMD_DOC_DATE" value="<?php echo date("y-m-d");   ?>">
							<input readonly name="CMD_DOC_DATE_SHOW" id="CMD_DOC_DATE_SHOW" value="<?php echo date('d/m') . '/' . (date('Y') + 543)   ?>" class="form-control datepicker" placeholder="">
							<span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
						</label>
					</div>
					<div id="CMD_DOC_TIME_BSF_AREA" class="col-md-2 offset-md-1 ">
						<label for="CMD_DOC_TIME" class="form-control-label wf-right">เวลา</label>
					</div>
					<div id="CMD_DOC_TIME_BSF_AREA" class="col-md-2 wf-left">
						<input type="text" name="CMD_DOC_TIME" id="CMD_DOC_TIME" class="form-control" value="<?php echo date("H:i:s"); ?>" readonly="true">
						<small id="DUP_CMD_DOC_TIME_ALERT" class="form-text text-danger" style="display:none"></small>
					</div>
				</div>
				<!-- send start -->
				<div class="form-group row">
					<div id="SEND_TO_BSF_AREA" class="col-md-2 "><label class="form-control-label wf-right">จากระบบงาน <span class="text-danger">*</span></label></div>
					<div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
						<input readonly type="hidden" name="SYSTEM_ID" id="SYSTEM_ID" class="form-control" value="">
						<input readonly type="text" name="SYSTEM_NAME" id="SYSTEM_NAME" class="form-control" value="">
					</div>

					<div class="col-md-2 show_per_type" style="display:none"></div>
					<div class="col-md-1 show_per_type" style="display:none">ประเภทบุคคล</div>
					<div class="col-md-2 show_per_type" style="display:none">
						<label><input type="radio" name="GET_PER_TYPE" id="GET_PER_TYPE" value="1" checked> บุคลากร</label>
						<label><input type="radio" name="GET_PER_TYPE" id="GET_PER_TYPE" value="2"> เจ้าหนี้</label>
					</div>
					<div id="CASE_TYPE_BSF_AREA" class="col-md-1 wf-left show_per_type" style="display:none">
						<button type="button" class="btn btn-success" id="getCaseDataBackoffice" style="background-color: #191970;border-color: #191970;">ดึงข้อมูล</button>
					</div>
					<div class="col-md-2 show_fix_bankrupt_date" style="<?php echo ($rec_cmd["CMD_FIX_DATE_STATUS"] == 'Y') ? "" : "display:none;" ?>white-space:nowrap"><label><input type="checkbox" name="CMD_FIX_DATE_STATUS" id="CMD_FIX_DATE_STATUS" value="Y" onclick="showFormFixData();" <?php echo ($rec_cmd["CMD_FIX_DATE_STATUS"] == 'Y') ? "checked" : "" ?>> กำหนดวันปลดล้มละลายไว้ล่วงหน้า</label></div>
					<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-1 show_fix_bankrupt_date2" style="<?php echo ($rec_cmd["CMD_FIX_DATE_STATUS"] == 'Y') ? "" : "display:none;" ?>">
						<label for="CMD_FIX_DOC_DATE" class="form-control-label">วันที่คำสั่งมีผล</label>
					</div>
					<div id="CMD_DOC_DATE_BSF_AREA" class="col-md-2 wf-left show_fix_bankrupt_date2" style="<?php echo ($rec_cmd["CMD_FIX_DATE_STATUS"] == 'Y') ? "" : "display:none;" ?>">
						<label class="input-group">
							<input name="CMD_FIX_DOC_DATE" id="CMD_FIX_DOC_DATE" value="<?php echo db2date($rec_cmd["CMD_FIX_DOC_DATE"]) ?>" class="form-control datepicker" placeholder="">
							<span class="input-group-addon bg-primary"><span class="icofont icofont-ui-calendar"></span></span>
						</label>
					</div>

				</div>
				<span id="show_form_source_input">
					<div class="form-group row">
						<div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
							<label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำ <span class="text-danger show_class_required">*</span></label>
						</div>
						<div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
							<input readonly type="text" name="T_BLACK_CASE" id="T_BLACK_CASE" class="form-control" value="<?php echo $GET_T_NO_BLACK; ?>" <?php echo $inputReadonly; ?>>
							<small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
						</div>
						<div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
							<input readonly type="text" name="BLACK_CASE" id="BLACK_CASE" class="form-control" value="<?php echo $GET_TO_BLACK_CASE; ?>" <?php echo $inputReadonly; ?>>
							<small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
						</div>
						<div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
							<div class="row">
								<div id="" class="col-md-1 wf-left">
									ปี
								</div>
								<div id="" class="col-md-5 wf-left">
									<input readonly type="text" name="BLACK_YY" id="BLACK_YY" class="form-control" value="<?php echo $GET_TO_BLACK_YY; ?>" <?php echo $inputReadonly; ?>>
									<small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
							</div>
						</div>

						<div id="RED_CASE_BSF_AREA" class="col-md-2 ">
							<label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดง <span class="text-danger show_class_required">*</span></label>
						</div>
						<div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
							<input readonly type="text" name="T_RED_CASE" id="T_RED_CASE" class="form-control" value="<?php echo $GET_TO_T_RED_CASE; ?>" <?php echo $inputReadonly; ?>>
							<small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
						</div>
						<div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
							<input readonly type="text" name="RED_CASE" id="RED_CASE" class="form-control" value="<?php echo $GET_TO_RED_CASE; ?>" <?php echo $inputReadonly; ?>>
							<small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
						</div>
						<div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
							<div class="row">
								<div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
									ปี
								</div>
								<div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
									<input readonly type="text" name="RED_YY" id="RED_YY" class="form-control" value="<?php echo $GET_TO_RED_YY; ?>" <?php echo $inputReadonly; ?>>
									<small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
								</div>
							</div>
						</div>

					</div>
					<div class="form-group row">
						<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
							<label for="CMD_TYPE" class="form-control-label wf-right">ศาล <span class="text-danger show_class_required">*</span></label>
						</div>
						<div id="CASE_TYPE_BSF_AREA" class="col-md-4 wf-left">
							<input readonly type="hidden" name="COURT_CODE" id="COURT_CODE" class="form-control" value="">
							<input readonly type="text" name="COURT_NAME" id="COURT_NAME" class="form-control" value="">

						</div>

					</div>
					<div class="form-group row">
						<div id="NAME_REQ" class="col-md-2 ">
							<label for="NAME_REQ" class="form-control-label wf-right">โจทก์</label>
						</div>
						<div id="PLAINTIFF_PRE_NAME_AREA" class="col-md-8 wf-left">
							<input readonly type="text" name="D_C" id="D_C" class="form-control" value="<?php echo $GET_PLAINTIFF; ?>">
							<small id="DUP_PLAINTIFF_PRE_NAME_ALERT" class="form-text text-danger" style="display:none"></small>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="DEPT_NAME" class="form-control-label wf-right">จำเลย</label>
						</div>
						<div id="DEPT_NAME" class="col-md-8 wf-left">
							<input readonly type="text" name="D_NAME" id="D_NAME" class="form-control" value="<?php echo $GET_DEFENDANT; ?>">
							<input type="hidden" id="CMD_PRIORITY_STATUS" value="">
							<input type="hidden" id="CMD_READ_STATUS" value="0">
							<small id="DEPT_NAME" class="form-text text-danger" style="display:none"></small>
						</div>
					</div>
					<!-- send stop -->

					<div class="form-group row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<hr class="line" style=" border-top: 4px solid #8c8b8b;margin: 30px 0px 30px 0px;">
						</div>
						<div class="col-md-1"></div>
					</div>

					<!-- to_send start -->

					<div class="row">
						<div class="col-md-2" align="center">
							<h4><u>ผู้รับ</u> </h4>
						</div>
					</div>
					<div class="form-group row">
						<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
							<label for="CASE_TYPE" class="form-control-label wf-right">ส่งถึงระบบ <span class="text-danger">*</span></label>
						</div>
						<div id="SEND_TO_BSF_AREA" class="col-md-2 wf-left">
							<input readonly type="hidden" name="SEND_TO" id="SEND_TO" class="form-control" value="">
							<input readonly type="text" name="SEND_TO_NAME" id="SEND_TO_NAME" class="form-control" value="">
						</div>


					</div>


					<div class="form-group row">
						<div class="col-md-12"></div>
					</div>

					<span id="show_form_source_input2">

						<div class="form-group row">
							<div id="BLACK_CASE_BSF_AREA" class="col-md-2 ">
								<label for="BLACK_CASE" class="form-control-label wf-right">หมายเลขคดีดำปลายทาง <span class="text-danger show_class_required2">*</span></label>
							</div>
							<div id="T_BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
								<input readonly type="text" name="TO_T_BLACK_CASE" id="TO_T_BLACK_CASE" class="form-control" value="<?php echo $GET_FORM_PREFIX_BCASE; ?>" <?php echo $inputReadonly; ?>>
								<small id="DUP_T_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
							</div>
							<div id="BLACK_CASE_BSF_AREA" class="col-md-1 wf-left">
								<input readonly type="text" name="TO_BLACK_CASE" id="TO_BLACK_CASE" class="form-control" value="<?php echo $GET_FORM_BLACK_CASE; ?>" <?php echo $inputReadonly; ?>>
								<small id="DUP_BLACK_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
							</div>
							<div id="BLACK_YY_BSF_AREA" class="col-md-1 wf-left">
								<div class="row">
									<div id="" class="col-md-1 wf-left">
										ปี
									</div>
									<div id="" class="col-md-2 wf-left">
										<input readonly type="text" name="TO_BLACK_YY" id="TO_BLACK_YY" class="form-control" value="<?php echo $GET_FORM_BLACK_YY; ?>" <?php echo $inputReadonly; ?>>
										<small id="DUP_BLACK_YY_ALERT" class="form-text text-danger" style="display:none"></small>
									</div>
								</div>
							</div>
							<div id="RED_CASE_BSF_AREA" class="col-md-2 ">
								<label for="RED_CASE" class="form-control-label wf-right">หมายเลขคดีแดงปลายทาง <span class="text-danger show_class_required2">*</span></label>
							</div>
							<div id="T_RED_CASE_BSF_AREA" class="col-md-1 wf-left">
								<input readonly type="text" name="TO_T_RED_CASE" id="TO_T_RED_CASE" class="form-control" value="<?php echo $GET_FORM_PREFIX_RCASE; ?>" <?php echo $inputReadonly; ?>>
								<small id="DUPT_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
							</div>
							<div id="RED_CASE_BSF_AREA" class="col-md-1 wf-left">
								<input readonly type="text" name="TO_RED_CASE" id="TO_RED_CASE" class="form-control" value="<?php echo $GET_FORM_RED_CASE; ?>" <?php echo $inputReadonly; ?>>
								<small id="DUP_RED_CASE_ALERT" class="form-text text-danger" style="display:none"></small>
							</div>
							<div id="RED_YY_BSF_AREA" class="col-md-2 wf-left">
								<div class="row">
									<div id="RED_YY_BSF_AREA" class="col-md-1 wf-left">
										ปี
									</div>
									<div id="RED_YY_BSF_AREA" class="col-md-5 wf-left">
										<input readonly type="text" name="TO_RED_YY" id="TO_RED_YY" class="form-control" value="<?php echo $GET_FORM_RED_YY; ?>" <?php echo $inputReadonly; ?>>
										<small id="DUP_RED_YY_ALERT" class="form-text text-danger" style="display:none"></small>
									</div>
								</div>
							</div>

						</div>

						<div class="form-group row">
							<div id="TO_COURT_NAME_BSF_AREA" class="col-md-2 wf-left">
								<label for="" class="form-control-label wf-right">ศาลปลายทาง <span class="text-danger show_class_required2">*</span></label>
							</div>
							<div id="TO_COURT_NAME_BSF_AREA" class="col-md-4 wf-left">
								<input readonly type="hidden" name="TO_COURT_CODE" id="TO_COURT_CODE" class="form-control" value="">
								<input readonly type="text" name="TO_COURT_NAME" id="TO_COURT_NAME" class="form-control" value="">
							</div>

						</div>
						<div class="form-group row">
							<div id="NAME_REQ" class="col-md-2 ">
								<label for="NAME_REQ" class="form-control-label wf-right">โจทก์</label>
							</div>
							<div id="PLAINTIFF_PRE_NAME_AREA" class="col-md-8 wf-left">
								<input readonly type="text" name="TO_PLAINTIFF" id="TO_PLAINTIFF" class="form-control" value="<?php echo $TO_PLAINTIFF; ?>" <?php echo $inputReadonly; ?>>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2">
								<label for="DEPT_NAME" class="form-control-label wf-right">จำเลย</label>
							</div>
							<div id="DEPT_NAME" class="col-md-8 wf-left">
								<input readonly type="text" name="TO_DEFENDANT" id="TO_DEFENDANT" class="form-control" value="<?php echo $TO_DEFENDANT; ?>" <?php echo $inputReadonly; ?>>
							</div>
						</div>
					</span>
				</span>
				<!-- to_send_stop -->
				<div class="form-group row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<hr class="line" style=" border-top: 4px solid #8c8b8b;margin: 30px 0px 30px 0px;">
					</div>
					<div class="col-md-1"></div>
				</div>
				<!-- note start -->
				<div class="form-group row">
					<div id="CMD_NOTE_BSF_AREA" class="col-md-2 ">
						<label for="CMD_NOTE" class="form-control-label wf-right">รายละเอียด <span class="text-danger">*</span></label>
					</div>
					<div id="CMD_NOTE_BSF_AREA" class="col-md-6 wf-left">
						<textarea class="form-control" name="CMD_NOTE" id="CMD_NOTE" cols="80" rows="10"><?php echo $rec_cmd["CMD_NOTE"]; ?></textarea>
					</div>
				</div>
				<div class="form-group row">
					<div id="CASE_TYPE_BSF_AREA" class="col-md-2 ">
						<label for="CASE_TYPE" class="form-control-label wf-right">เสนอผู้พิจารณา <span class="text-danger">*</span></label>
					</div>
					<div id="SEND_TO_BSF_AREA" class="col-md-5 wf-left">
						<input readonly type="hidden" name="APPROVE_PERSON" id="APPROVE_PERSON" class="form-control"><!-- เลข13 หลัก -->
						<input readonly type="text" name="OFFICE_NAME" id="OFFICE_NAME" class="form-control"><!-- เลข13 ชื่อ -->
					</div>
				</div>
				<!-- note stop -->
			</div><!-- stop  -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" onclick="approve_send();">ส่ง</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
			</div>
		</div>
	</div>
</div>



<script>
	function reply_com(REF_ID, TO_PERSON_ID, SEND_TO) {

		let url = 'cmd_add_from_send_to_return.php?REF_ID=' + REF_ID + '&SEND_TO=<?php echo $_GET["SEND_TO"]; ?>&TO_PERSON_ID=<?php echo $_SESSION['TO_PERSON_ID']; ?>&STATUS=RETURN'
		window.open(url, "รายละเอียดทรัพย์", "width=800,height=700");
	}

	function modal_reply(CMD_SYSTEM_ID = "", SYSTEM_NAME = "", T_BLACK_CASE = "", BLACK_CASE = "", BLACK_YY = "", T_RED_CASE = "", RED_CASE = "", RED_YY = "", COURT_CODE = "", COURT_NAME = "", PLAINTIFF = "", DEFENDANT = "", SEND_TO = "", SEND_TO_NAME = "", TO_T_BLACK_CASE = "", TO_BLACK_CASE = "", TO_BLACK_YY = "", TO_T_RED_CASE = "", TO_RED_CASE = "", TO_RED_YY = "", TO_COURT_CODE = "", TO_COURT_NAME = "", TO_PLAINTIFF = "", TO_DEFENDANT = "",
		OFFICE_IDCARD = "", APPROVE_PERSON = "", OFFICE_NAME = "", ID = "", PARENT_NUM = "") {


		let text = "";
		/* ส่ง */
		text += "&GET_S_SYSTEM_ID=" + CMD_SYSTEM_ID;

		text += "&GET_S_PREFIX_CASE_BLACK=" + T_BLACK_CASE;
		text += "&GET_S_CASE_BLACK=" + BLACK_CASE;
		text += "&GET_S_CASE_BLACK_YEAR=" + BLACK_YY;

		text += "&GET_S_PREFIX_CASE_RED=" + T_RED_CASE;
		text += "&GET_S_CASE_RED=" + RED_CASE;
		text += "&GET_S_CASE_RED_YEAR=" + RED_YY;

		text += "&GET_S_COURT_CODE=" + COURT_CODE;

		text += "&GET_S_COURT_CODE=" + COURT_CODE;
		text += "&GET_S_COURT_CODE=" + COURT_CODE;

		$('#GET_PLAINTIFF').val(TO_PLAINTIFF);
		$('#GET_DEFENDANT').val(TO_DEFENDANT);
		/* รับ */

		text += "&GET_T_SYSTEM_ID=" + SEND_TO;

		text += "&GET_T_PREFIX_CASE_BLACK=" + TO_T_BLACK_CASE;
		text += "&GET_T_CASE_BLACK=" + TO_BLACK_CASE;
		text += "&GET_T_CASE_BLACK_YEAR=" + TO_BLACK_YY;

		text += "&GET_T_PREFIX_CASE_RED=" + TO_T_RED_CASE;
		text += "&GET_T_CASE_RED=" + TO_RED_CASE;
		text += "&GET_T_CASE_RED_YEAR=" + TO_RED_YY;

		text += "&GET_T_COURT_CODE=" + TO_COURT_CODE;
		text += "&GET_T_SYSTEM_ID=" + TO_COURT_CODE;
		text += "&proc=add"

		let url = "./cmd_add_from_send_to_return.php?1=1" + text
		window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
	}

	function approve_send() {

		let CMD_DOC_DATE = $('#CMD_DOC_DATE').val();
		let CMD_DOC_TIME = $('#CMD_DOC_TIME').val();

		let CMD_SYSTEM_ID = $('#SYSTEM_ID').val();
		let SYSTEM_NAME = $('#SYSTEM_NAME').val();
		let T_BLACK_CASE = $('#T_BLACK_CASE').val();
		let BLACK_CASE = $('#BLACK_CASE').val();
		let BLACK_YY = $('#BLACK_YY').val();
		let T_RED_CASE = $('#T_RED_CASE').val();
		let RED_CASE = $('#RED_CASE').val();
		let RED_YY = $('#RED_YY').val();
		let COURT_CODE = $('#COURT_CODE').val();
		let COURT_NAME = $('#COURT_NAME').val();
		let PLAINTIFF = $('#D_C').val();
		let DEFENDANT = $('#D_NAME').val();

		let SEND_TO = $('#SEND_TO').val();
		let SEND_TO_NAME = $('#SEND_TO_NAME').val();
		let TO_T_BLACK_CASE = $('#TO_T_BLACK_CASE').val();
		let TO_BLACK_CASE = $('#TO_BLACK_CASE').val();
		let TO_BLACK_YY = $('#TO_BLACK_YY').val();
		let TO_T_RED_CASE = $('#TO_T_RED_CASE').val();
		let TO_RED_CASE = $('#TO_RED_CASE').val();
		let TO_RED_YY = $('#TO_RED_YY').val();
		let TO_COURT_CODE = $('#TO_COURT_CODE').val();
		let TO_COURT_NAME = $('#TO_COURT_NAME').val();
		let TO_PLAINTIFF = $('#TO_PLAINTIFF').val();
		let TO_DEFENDANT = $('#TO_DEFENDANT').val();

		let OFFICE_IDCARD = $('#OFFICE_IDCARD').val();
		let APPROVE_PERSON = $('#APPROVE_PERSON').val();
		let OFFICE_NAME = $('#OFFICE_NAME').val();
		let ID = $('#ID').val();
		let PARENT_NUM = $('#PARENT_NUM').val();
		let CMD_NOTE = $('#CMD_NOTE').val();
		$(".modal_reply").modal();
		$.post('./search_data_process_A.php', {
				proc: "search_data_cmd_reply",

				SYSTEM_ID: CMD_SYSTEM_ID,
				SYSTEM_NAME: SYSTEM_NAME,
				T_BLACK_CASE: T_BLACK_CASE,
				BLACK_CASE: BLACK_CASE,
				BLACK_YY: BLACK_YY,
				T_RED_CASE: T_RED_CASE,
				RED_CASE: RED_CASE,
				RED_YY: RED_YY,
				COURT_CODE: COURT_CODE,
				COURT_NAME: COURT_NAME,
				D_C: PLAINTIFF,
				D_NAME: DEFENDANT,

				SEND_TO: SEND_TO,
				SEND_TO_NAME: SEND_TO_NAME,
				TO_T_BLACK_CASE: TO_T_BLACK_CASE,
				TO_BLACK_CASE: TO_BLACK_CASE,
				TO_BLACK_YY: TO_BLACK_YY,
				TO_T_RED_CASE: TO_T_RED_CASE,
				TO_RED_CASE: TO_RED_CASE,
				TO_RED_YY: TO_RED_YY,
				TO_COURT_CODE: TO_COURT_CODE,
				TO_COURT_NAME: TO_COURT_NAME,
				TO_PLAINTIFF: TO_PLAINTIFF,
				TO_DEFENDANT: TO_DEFENDANT,

				OFFICE_IDCARD: OFFICE_IDCARD,
				APPROVE_PERSON: APPROVE_PERSON,
				OFFICE_NAME: OFFICE_NAME,

				CMD_DOC_DATE: CMD_DOC_DATE,
				CMD_DOC_TIME: CMD_DOC_TIME,

				ID: ID,

				PARENT_NUM: PARENT_NUM,

				CMD_NOTE: CMD_NOTE
			},
			function(data) {
				let rst = JSON.parse(data)
				console.log(rst)
				if (1 == 1) {
					location.reload();
				}
			}
		);

	}
</script>
<!-- stop modal_reply -->

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
	function change_page_limit(limit) {
		window.location.href = "<?php echo create_link($wf_link, $_GET, array(), array('wf_limit', 'wf_page')) . '&wf_page=1&wf_limit='; ?>" + limit + "";
	}

	function change_page_no(page) {
		if (page != "") {
			$('#wf_page').val(page);
		}
	}

	function changeSubmit(tab_active) {
		window.location.href = "show_cmd_disp.php?tab_active=" + tab_active + '&SEND_TO=' + $('#SEND_TO').val() + '&TO_PERSON_ID=' + $('#TO_PERSON_ID').val();
	}

	function showAssetComList(ASSET_ID, TO_PERSON_ID) {
		window.open("show_cmd_list.php?ASSET_ID=" + ASSET_ID + '&TO_PERSON_ID=' + TO_PERSON_ID, "รายการคำสั่งเจ้าพนักงาน", "width=800,height=700");
	}

	function delete_cmd(CMD_ID) {
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
			function() {

				var dataString = 'proc=delete&CMD_ID=' + CMD_ID + '&HIDDEN_SEND_TO=' + $('#SEND_TO').val() + '&HIDDEN_TO_PERSON_ID=' + $('#TO_PERSON_ID').val();
				$.ajax({
					type: "POST",
					url: "search_data_process.php",
					data: dataString,
					cache: false,
					success: function(html) {
						console.log(html);
						//window.location.href = "search_data_cmd.php";
						location.reload();
					}
				});

			});
	}
</script>