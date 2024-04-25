<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$HIDE_HEADER = "P";
include('../include/include.php');

include('../include/paging.php');



if (isset($_GET['CODE'])) { //ตรวจสอบว่ามีตัวแปร CODE ที่ถูกส่งมาผ่านค่า GET (query parameter) หรือไม่ 
	$decodedCode = base64_decode($_GET['CODE']);
	$decodedCode = str_replace('&', '##', $decodedCode);
	$segments = explode("##", trim($decodedCode, "##"));
	$data = [];
	foreach ($segments as $segment) {
		list($key, $value) = explode("=", $segment, 2);
		$data[$key] = $value;
		$_GET[$key] = $value;
	}
}


if ($_POST) {
	foreach ($_POST as $key => $value) {
		${$key} = $value;
	}
}

if ($_GET) {
	foreach ($_GET as $key => $value) {
		${$key} = $value;
	}
}

$arr_system = array("Bankrupt" => "คดีล้มละลาย", "Civil" => "คดีแพ่ง", "Mediate" => "คดีไกล่เกลี่ย", "Revive" => "คดีฟื้นฟู");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include '../include/template_user.php'; ?>
</head>

<!-- <body id="bsf_body" class="horizontal-fixed fixed">
    <div class="wrapper"></div> -->

<body id="bsf_body" class="">
	<div class="wrapper">
		<?php
		//  include '../include/combottom_js_user.php'; //function 
		include '../include/func_Nop.php';
		include "./btn_function.php";
		?>
		<style>
			.content-wrapper {
				margin-top: -20px;
				/* ปรับระยะห่างด้านบนของ content-wrapper ให้มีค่า 20px */
			}

			.show_hide_area:after {
				font-family: 'IcoFont' !important;
				content: "\eb25";
			}

			.show_hide_area.is-active:after {
				font-family: 'IcoFont' !important;
				content: "\eb28";
			}
		</style>

		<div class="content m-t-20">
			<!-- Container-fluid starts -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<!-- Row start -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<!-- Radio-Button start -->
									<?php if ($_GET['REGISTERCODE'] != "") { ?><div class="card-header">
											<h5 class="card-header-text">
												<b>เลขบัตรประชาชน :</b> <?php echo $_GET['REGISTERCODE']; ?>
											</h5>
										</div><?php } ?>
									<?php if ($_GET['COURT_NAME'] != "") { ?><div class="card-header">
											<h5 class="card-header-text">
												<b> ศาล :</b> <?php echo $_GET['COURT_NAME']; ?>
											</h5>
										</div><?php } ?>
									<?php if ($BLACK_CASE != "") { ?><div class="card-header">
											<h5 class="card-header-text">
												<b> หมายเลขคดีดำ :</b> <?php echo $T_BLACK_CASE; ?> <?php echo $BLACK_CASE; ?>
											</h5>
										</div><?php } ?>
									<?php if ($RED_CASE != "") { ?><div class="card-header">
											<h5 class="card-header-text">
												<b> หมายเลขคดีแดง :</b> <?php echo $T_RED_CASE; ?> <?php echo $RED_CASE; ?>
											</h5>
										</div><?php } ?>


									<?php
									$k = 0;
									foreach ($arr_system as $sys => $sys_name) {
										$k++;
										$filter1 = "";

										/* start ไม่เอาคดีตัวเอง */
										if ($_GET['PCC_CIVIL_GEN'] != "") {
											$sqlSelectData = "	SELECT 	b.WH_CIVIL_ID
																FROM 	WH_CIVIL_CASE a
																JOIN ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')."  b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
																WHERE 	CIVIL_CODE = '" . $_GET['PCC_CIVIL_GEN']  . "'";
											$querySelectData = db::query($sqlSelectData);
											$rec_PCC = db::fetch_array($querySelectData);
											$filter1 .= "AND TB.WH_ID !='" . $rec_PCC['WH_CIVIL_ID'] . "' ";
										}
										/* stop ไม่เอาคดีตัวเอง */

										if ($_GET['DATA_SEARCH'] == 'ALL') {
										
											if ($_GET['REGISTERCODE'] != "") {
												$filter1 .= " and TB.REGISTER_CODE in (" . result_array($_GET['REGISTERCODE'])  . ") ";
											}

											if ($_GET['COURT_NAME'] != "") {
												$filter1 .= " AND TB.COURT_NAME = '" . $_GET['COURT_NAME'] . "' ";
											}

											if ($_GET['T_BLACK_CASE'] != "" && $_GET['BLACK_CASE'] != "" && $_GET['BLACK_YY'] != "") {

												$filter1 .= " AND TB.PREFIX_BLACK_CASE  like '%" . $_GET['T_BLACK_CASE'] . "%' ";
												$filter1 .= " AND TB.BLACK_CASE  like '%" . $_GET['BLACK_CASE'] . "%' ";
												$filter1 .= " AND TB.BLACK_YY  like '%" . $_GET['BLACK_YY'] . "%' ";
											}

											if ($_GET['T_RED_CASE'] != "" && $_GET['RED_CASE'] != "" && $_GET['RED_YY'] != "") {

												$filter1 .= " AND TB.PREFIX_RED_CASE  like '%" . $_GET['T_RED_CASE'] . "%' ";
												$filter1 .= " AND TB.RED_CASE  like '%" . $_GET['RED_CASE'] . "%' ";
												$filter1 .= " AND TB.RED_YY  like '%" . $_GET['RED_YY'] . "%' ";
											}

											if ($_GET['PRE_CODE'] != "") {
												$text_N = 1;
												foreach ($_GET['PRE_CODE'] as $A1) {
													$result_PRE_CODE .= "'" . $A1 . "'" . (count($_GET['PRE_CODE']) == $text_N ? "" : ",");
													$text_N++;
												}
												$filter1 .= " AND TB.CONCERN_NAME in (" . $result_PRE_CODE . ")  ";
											}
											if ($_GET['CONCERNED'] != "") {
												$filter1 .= " AND TB.CONCERN_NAME in (" . result_array($_GET['CONCERNED']) . ")  ";
											}
											if ($_GET['case'] != "") {
												$text_N = 1;
												foreach ($_GET['case'] as $A1) {
													$result_case .= "'" . $A1 . "'" . (count($_GET['case']) == $text_N ? "" : ",");
													$text_N++;
												}
												$filter1 .= " AND TB.SYSTEM_TYPE in (" . $result_case . ") ";
											}
											if ($filter1 != "") {
												$sqlSelectDataALL_e =        "
	SELECT 
	TB.PK_ID ,TB.WH_ID,
	TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
	TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
	TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
	TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
	TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
	TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
	TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
	FROM VIEW_WH_ALL_CASE_PERSON TB 
	WHERE TB.SYSTEM_TYPE = '" . $sys . "' {$filter1}
	GROUP BY TB.PK_ID ,TB.WH_ID,TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
	TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
	TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
	TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
	TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
	TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
	TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ
	ORDER BY TB.SYSTEM_TYPE ASC,
	CASE
		WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NOT NULL THEN 1
		WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NULL THEN 2
		WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NOT NULL THEN 3
		WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NULL THEN 4
		ELSE 5
	END,TB.CONERNSEQ ASC 
	";
	//echo "<br><br>".$sqlSelectDataALL_e ;
												$query_SelectDataALL_e[$k] = db::query($sqlSelectDataALL_e);
												$num_b[$k] = db::num_rows($query_SelectDataALL_e[$k]);
											}
										} else if ($_GET['DATA_SEARCH'] == 'COUPLE' || $_GET['DATA_SEARCH'] == 'CROSS') {
											if ($_GET['DATA_SEARCH'] == 'COUPLE') { //คู่ เลือกรายการที่REGISTERCODE_1 เป็นโจทย์ และREGISTERCODE_2 เป็นจำเลย
												$check = '1';
												if ($_GET['case'] != "") {
													$filter_SYSTEM_TYPE .= " AND TB3.SYSTEM_TYPE in (" . sort_array($_GET['case']) . ") ";
												}
												if ($_GET['REGISTERCODE_C1'] != "") {

													$filter_1 = "  AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C1'])) . ")
																		AND TB2.CONCERN_NAME in ('โจทก์')";
												}
												if ($_GET['REGISTERCODE_C2'] != "") {
													$filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C2'])) . ")
																	   AND TB2.CONCERN_NAME in ('จำเลย')";
												}
											}
											if ($_GET['DATA_SEARCH'] == 'CROSS') { //ไขว้
												$check = '2';
												if ($_GET['case'] != "") {
													$filter_SYSTEM_TYPE .= " AND TB3.SYSTEM_TYPE in (" . sort_array($_GET['case']) . ") ";
												}
												if ($_GET['REGISTERCODE_C1'] != "") {

													$filter_1 = " AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C1'])) . ")";
												}
												if ($_GET['REGISTERCODE_C2'] != "") {
													$filter_2 = "AND TB2.REGISTER_CODE in (" . str_replace('-', '', result_array($_GET['REGISTERCODE_C2'])) . ")";
												}
											}
											if ($check > 0) {
												$sql_ALL = "SELECT 
												TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
												TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
												TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
												TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
												TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
												TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
												TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ,TB.WH_ID
												FROM VIEW_WH_ALL_CASE_PERSON TB 
												WHERE 1=1 
												 AND EXISTS (	
												 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
												 WHERE 1=1 
												 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE 
												 AND TB2.BLACK_CASE=TB.BLACK_CASE 
												 AND TB2.BLACK_YY=TB.BLACK_YY 
												 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
												 AND TB2.RED_CASE = TB.RED_CASE 
												 AND TB2.RED_YY = TB.RED_YY 
												{$filter_1})
												 AND EXISTS (
												 SELECT *FROM VIEW_WH_ALL_CASE_PERSON TB2
												 WHERE 1=1
												 AND TB2.PREFIX_BLACK_CASE=TB.PREFIX_BLACK_CASE
												 AND TB2.BLACK_CASE=TB.BLACK_CASE
												 AND TB2.BLACK_YY=TB.BLACK_YY 
												 AND TB2.PREFIX_RED_CASE = TB.PREFIX_RED_CASE 
												 AND TB2.RED_CASE = TB.RED_CASE 
												 AND TB2.RED_YY = TB.RED_YY 
												 {$filter_2})
											AND TB.REGISTER_CODE in(" . result_array($_GET['REGISTERCODE_C1']) . "," . result_array($_GET['REGISTERCODE_C2']) . ")
											{$filter_SYSTEM_TYPE}
											{$filter1}
											AND TB.SYSTEM_TYPE = '" . $sys . "'
											GROUP BY TB.CONCERN_NO ,TB.REGISTER_CODE ,TB.PREFIX_NAME ,TB.FIRST_NAME ,
											TB.LAST_NAME ,TB.CONCERN_CODE ,TB.CONCERN_NAME ,TB.PREFIX_BLACK_CASE ,
											TB.BLACK_CASE ,TB.BLACK_YY ,TB.PREFIX_RED_CASE ,TB.RED_CASE ,
											TB.RED_YY ,TB.COURT_NAME ,TB.COURT_CODE ,TB.ADDRESS ,TB.TUM_NAME ,TB.AMP_NAME ,
											TB.PROV_NAME ,TB.ZIP_CODE ,TB.SYSTEM_TYPE ,TB.LOCK_PERSON_STATUS ,TB.LOCK_PERSON_STATUS_TEXT ,
											TB.PER_ORDER_STATUS ,TB.PERSON_PLAINTIFF ,TB.PERSON_DEFENDANT ,TB.PERSON_CAPITAL_AMT ,
											TB.COMP_PAY_DEPT_DATE ,TB.DEPT_NAME ,TB.CONERNSEQ,TB.WH_ID
											ORDER BY TB.CONERNSEQ ASC,TB.SYSTEM_TYPE ASC,
											CASE
												 WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NOT NULL THEN 1
												 WHEN TB.CONCERN_NAME = 'โจทก์' AND TB.CONERNSEQ IS NULL THEN 2
												 WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NOT NULL THEN 3
												 WHEN TB.CONCERN_NAME = 'จำเลย' AND TB.CONERNSEQ IS NULL THEN 4
												ELSE 5
											END
											 ";
											// echo $sql_ALL."<br><br>";
											}
											$query_SelectDataALL_e[$k] = db::query($sql_ALL);
											$num_b[$k] = db::num_rows($query_SelectDataALL_e[$k]);
										}
										//echo  $sqlSelectDataALL_e."<br><br>";
									}

									?>

									<div class="card-block">
										<!-- Row start -->
										<div class="row">
											<div class="col-lg-12">

												<!-- Nav tabs -->

												<ul class="nav nav-tabs  tabs" role="tablist">
													<?php
													$k = 0;
													foreach ($arr_system as $sys => $sys_name) {
														$k++;
													?>
														<li class="nav-item">
															<a class="nav-link <?php if ($k == 1) {
																					echo "active";
																				} ?>" data-toggle="tab" href="#<?php echo $sys; ?>" role="tab"><?php echo $sys_name; ?> <?php echo  $num_b[$k] == 0 ? "" : '<label class="badge bg-danger">' . $num_b[$k] . '</label>'; ?></a>
														</li>
													<?php } ?>

												</ul>
												<!-- Tab panes -->
												<div class="tab-content tabs">
													<?php
													$k = 0;
													foreach ($arr_system as $sys => $sys_name) {
														$k++;
													?>
														<div class="tab-pane m-t-20 <?php if ($k == 1) {
																						echo "active";
																					} ?>" id="<?php echo $sys; ?>" role="tabpanel">
															<h6><i class="icofont icofont-dotted-right"></i> <?php echo $sys_name; ?></h6>
															<div>
																<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
																	<thead class="bg-primary">
																		<th class="text-center">ลำดับ</th>
																		<th class="text-center">เลขบัตรประชาชน</th>
																		<th class="text-center">ชื่อ-สกุล</th>
																		<th class="text-center">สถานะ</th>
																		<th class="text-center">เลขคดีดำ/ปี</th>
																		<th class="text-center">เลขคดีแดง/ปี</th>
																		<th class="text-center">ศาล</th>
																		<th class="text-center">จัดการ</th>
																	</thead>
																	<?php

																	if ($num_b[$k] > 0) {
																		$a = 1;
																		while ($recSelectDataAll = db::fetch_array($query_SelectDataALL_e[$k])) {
																			$num_a = 1;
																			$num_a1 = 1;
																			$show_word = '';

																			if ($D_TYPE_RE != $recSelectDataAll['SYSTEM_TYPE']) {
																				if ($recSelectDataAll['SYSTEM_TYPE'] == 'Mediate') {
																					$show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบไกล่เกลี่ย';
																					$SYSTEM_ID = "";
																				} else if ($recSelectDataAll['SYSTEM_TYPE'] == 'Bankrupt') {
																					$show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบล้มละลาย';
																					$SYSTEM_ID = 2;
																				} else if ($recSelectDataAll['SYSTEM_TYPE'] == 'Revive') {
																					$show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบฟื้นฟู';
																					$SYSTEM_ID = "";
																				} else if ($recSelectDataAll['SYSTEM_TYPE'] == 'Backoffice') {
																					$show_word = 'Backoffice';
																					$SYSTEM_ID = "";
																				} else if ($recSelectDataAll['SYSTEM_TYPE'] == 'Civil') {
																					$show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในแพ่ง';
																					$SYSTEM_ID = 1;
																				}
																				$D_TYPE_RE = $recSelectDataAll['SYSTEM_TYPE'];
																			}
																	?>
																			<tr>
																				<div>
																					<td>
																						<div align='center'><?php echo $a; ?></div>
																					</td>
																					<td><?php echo $recSelectDataAll['REGISTER_CODE']; ?> <span class="show_hide_area" style="display:none;cursor:pointer;" id="arr_<?php echo $sys; ?>_<?php echo $a; ?>"></span></td>
																					<td><?php echo $recSelectDataAll['PREFIX_NAME'] . " " . $recSelectDataAll['FIRST_NAME'] . " " . $recSelectDataAll['LAST_NAME']; ?></td>
																					<td><?php echo $recSelectDataAll['CONCERN_NAME']; ?></td>
																					<?php

																					$A = ($recSelectDataAll['BLACK_CASE'] != '' && $recSelectDataAll['BLACK_YY'] != '') ? "/" : "";
																					$B = ($recSelectDataAll['RED_CASE'] != '' && $recSelectDataAll['RED_YY'] != '') ? "/" : "";
																					?>
																					<td><a onclick="show_detial(
									'<?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] ?>',
									'<?php echo $recSelectDataAll['BLACK_CASE'] ?>',
									'<?php echo $recSelectDataAll['BLACK_YY'] ?>',
									'<?php echo $recSelectDataAll['PREFIX_RED_CASE'] ?>',
									'<?php echo $recSelectDataAll['RED_CASE'] ?>',
									'<?php echo $recSelectDataAll['RED_YY'] ?>',
									'<?php echo $recSelectDataAll['COURT_CODE'] ?>',
									'<?php echo $SYSTEM_ID ?>',
									'<?php echo $recSelectDataAll['REGISTER_CODE'] ?>',
									'<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>');" href=""> <?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] . $recSelectDataAll['BLACK_CASE'] . $A . $recSelectDataAll['BLACK_YY']; ?></a></td>
																					<td><a onclick="show_detial(
									'<?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] ?>',
									'<?php echo $recSelectDataAll['BLACK_CASE'] ?>',
									'<?php echo $recSelectDataAll['BLACK_YY'] ?>',
									'<?php echo $recSelectDataAll['PREFIX_RED_CASE'] ?>',
									'<?php echo $recSelectDataAll['RED_CASE'] ?>',
									'<?php echo $recSelectDataAll['RED_YY'] ?>',
									'<?php echo $recSelectDataAll['COURT_CODE'] ?>',
									'<?php echo $SYSTEM_ID ?>',
									'<?php echo $recSelectDataAll['REGISTER_CODE'] ?>',
									'<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>');" href=""><?php echo $recSelectDataAll['PREFIX_RED_CASE'] . $recSelectDataAll['RED_CASE'] . $B . $recSelectDataAll['RED_YY']; ?></a></td>
																					<td><?php echo $recSelectDataAll['COURT_NAME']; ?></td>
																					<td nowrap="true">
																						<nobr>
																							<div class="form-group row" align='center'>

																								<button type="button" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด" onclick="show_detial(
									'<?php echo $recSelectDataAll['PREFIX_BLACK_CASE'] ?>',
									'<?php echo $recSelectDataAll['BLACK_CASE'] ?>',
									'<?php echo $recSelectDataAll['BLACK_YY'] ?>',
									'<?php echo $recSelectDataAll['PREFIX_RED_CASE'] ?>',
									'<?php echo $recSelectDataAll['RED_CASE'] ?>',
									'<?php echo $recSelectDataAll['RED_YY'] ?>',
									'<?php echo $recSelectDataAll['COURT_CODE'] ?>',
									'<?php echo $SYSTEM_ID ?>',
									'<?php echo $recSelectDataAll['REGISTER_CODE'] ?>',
									'<?php echo $recSelectDataAll['SYSTEM_TYPE'] ?>');" class="btn btn-info btn-mini"> <i class="icofont icofont-search"></i></button>
																								<!-- button show_detial stop-->

																								<button type="button" class="btn btn-success btn-mini" data-toggle="tooltip" data-placement="top" title="สอบถามความประสงค์" onclick="action_from('<?php echo $recSelectDataAll['REGISTER_CODE']; ?>','<?php echo $recSelectDataAll['SYSTEM_TYPE']; ?>','<?php echo $recSelectDataAll['PREFIX_BLACK_CASE']; ?>',  
								   '<?php echo $recSelectDataAll['BLACK_CASE']; ?>','<?php echo $recSelectDataAll['BLACK_YY']; ?>','<?php echo $recSelectDataAll['PREFIX_RED_CASE']; ?>',
								   '<?php echo $recSelectDataAll['RED_CASE']; ?>','<?php echo $recSelectDataAll['RED_YY']; ?>','<?php echo $recSelectDataAll['COURT_CODE']; ?>','<?php echo $recSelectDataAll['COURT_NAME']; ?>',
								   '<?php echo $recSelectDataAll['CONCERN_NAME']; ?>','<?php echo $recSelectDataAll['PREFIX_NAME'] . ' ' . $recSelectDataAll['FIRST_NAME'] . ' ' . $recSelectDataAll['LAST_NAME']; ?>');"><i class="icofont icofont-ui-call"></i></button>

																								<button type="button" class="btn btn-primary btn-mini" data-toggle="tooltip" data-placement="top" title="คำสั่งเจ้าพนักงาน" onclick="action_from('<?php echo $recSelectDataAll['REGISTER_CODE']; ?>','<?php echo $recSelectDataAll['SYSTEM_TYPE']; ?>','<?php echo $recSelectDataAll['PREFIX_BLACK_CASE']; ?>',  
								   '<?php echo $recSelectDataAll['BLACK_CASE']; ?>','<?php echo $recSelectDataAll['BLACK_YY']; ?>','<?php echo $recSelectDataAll['PREFIX_RED_CASE']; ?>',
								   '<?php echo $recSelectDataAll['RED_CASE']; ?>','<?php echo $recSelectDataAll['RED_YY']; ?>','<?php echo $recSelectDataAll['COURT_CODE']; ?>','<?php echo $recSelectDataAll['COURT_NAME']; ?>',
								   '<?php echo $recSelectDataAll['CONCERN_NAME']; ?>','<?php echo $recSelectDataAll['PREFIX_NAME'] . ' ' . $recSelectDataAll['FIRST_NAME'] . ' ' . $recSelectDataAll['LAST_NAME']; ?>');"><i class="icofont icofont-ui-messaging"></i></button>
																							</div>
																						</nobr>
																					</td>
																				</div>
																			</tr>
																			<tr id="<?php echo $sys; ?>_<?php echo $a; ?>">
																				<td id="td<?php echo $sys; ?>_<?php echo $a; ?>" colspan="8">
																					<table class="table"><?php

																											/* ทรัพ start*/
																											show_asset(
																												$recSelectDataAll['PREFIX_BLACK_CASE'],
																												$recSelectDataAll['BLACK_CASE'],
																												$recSelectDataAll['BLACK_YY'],
																												$recSelectDataAll['PREFIX_RED_CASE'],
																												$recSelectDataAll['RED_CASE'],
																												$recSelectDataAll['RED_YY'],
																												$recSelectDataAll['COURT_CODE'],
																												$SYSTEM_ID,
																												$recSelectDataAll['REGISTER_CODE']
																											);
																											/* ทรัพ stop*/
																											?></table>
																				</td>
																			</tr>
																			<script>
																				if ($('#td<?php echo $sys; ?>_<?php echo $a; ?>').html() == '<table class="table"></table>') {
																					$('#<?php echo $sys; ?>_<?php echo $a; ?>').hide();
																				} else {
																					$('#<?php echo $sys; ?>_<?php echo $a; ?>').hide();
																					$('#arr_<?php echo $sys; ?>_<?php echo $a; ?>').show();
																				}
																				$('#arr_<?php echo $sys; ?>_<?php echo $a; ?>').click(function() {
																					$(this).toggleClass('is-active');
																					$("#<?php echo $sys; ?>_<?php echo $a; ?>").slideToggle();


																				});
																			</script>
																		<?php
																			$a++;
																			$num_a++;
																		}
																	} else {
																		?>
																		<tr>
																			<td colspan="10">
																				<div align='center'><?php echo 'ไม่มีพบข้อมูล'; ?></div>
																			</td>
																		</tr>
																	<?php
																	}


																	?>
																</table>


															</div>


														</div>
													<?php } ?>

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>





	<!-- Modal Upload File -->
	<div class="modal fade modal-flex " id="payrollBizModal" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close biz-close-modal" data-number="payrollBizModal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body" id="modal_content">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger biz-close-modal" data-number="payrollBizModal">ปิด</button>
				</div>
			</div>
		</div>
	</div>
	<!-- //. Modal Upload File  -->
	<script>
		function show_detial(PREFIX_BLACK_CASE, BLACK_CASE, BLACK_YY, PREFIX_RED_CASE, RED_CASE, RED_YY, COURT_CODE, SYSTEM_ID, REGISTER_CODE, SYSTEM_TYPE) {
			//let brcId_CivilToWh_fast = $('#brcId_CivilToWh_fast').val();
			var url = "./search_data_show_detial.php?PREFIX_BLACK_CASE=" + PREFIX_BLACK_CASE + "&BLACK_CASE=" + BLACK_CASE + "&BLACK_YY=" + BLACK_YY +
				"&PREFIX_RED_CASE=" + PREFIX_RED_CASE + "&RED_CASE=" + RED_CASE + "&RED_YY=" + RED_YY +
				"&COURT_CODE=" + COURT_CODE + "&SYSTEM_ID=" + SYSTEM_ID + "&REGISTER_CODE=" + REGISTER_CODE + "&SYSTEM_TYPE=" + SYSTEM_TYPE;
			window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
		}

		function input_Number(input) {
			// ลบตัวอักษรที่ไม่ใช่ตัวเลขทั้งหมด
			input.value = input.value.replace(/[^,0-9]/g, '');

			// คั้นระหว่างตัวเลขทุก 13 ตัวด้วยเครื่องหมาย "-"
			const valueLength = input.value.length;
			if (valueLength > 13) {
				const formattedValue = input.value.replace(/(\d{13})(?=\d)/g, '$1,');
				input.value = formattedValue;
			}
		}

		function btn_clear() {
			history.replaceState({}, document.title, window.location.pathname);
			window.location = 'http://103.208.27.224:81/led_service_api/public/search_data.php'

		}

		function searchData() {
			let registerCode = $('#REGISTERCODE').val();

			let T_BLACK_CASE = $('#T_BLACK_CASE').val();
			let BLACK_CASE = $('#BLACK_CASE').val();
			let BLACK_YY = $('#BLACK_YY').val();
			let T_RED_CASE = $('#T_RED_CASE').val();
			let RED_CASE = $('#RED_CASE').val();
			let RED_YY = $('#RED_YY').val();

			let COURT_NAME = $('#COURT_NAME').val();
			let PRE_CODE = $('#PRE_CODE').val();
			let case_c = $('#case').val();
			/* console.log(registerCode)
			console.log(T_BLACK_CASE)
			console.log(BLACK_CASE)
			console.log(BLACK_YY)
			console.log(T_RED_CASE)
			console.log(RED_CASE)
			console.log(RED_YY) */

			if (registerCode != '' || (T_BLACK_CASE != '' && BLACK_CASE != '' && BLACK_YY != '') || (T_RED_CASE != '' && RED_CASE != '' && RED_YY != '')) {
				if ((T_BLACK_CASE != '' && BLACK_CASE != '' && BLACK_YY != '') || (T_RED_CASE != '' && RED_CASE != '' && RED_YY != '')) {
					if (COURT_NAME == '') {
						alert('กรุณาเลือกศาล')
						$('#COURT_NAME').focus()
						return false
					}
				}
				location.reload()
				$("#page").val(1);
				$("#page_size").val(20);
				$("#frm-input")
					.attr("target", "")
					.attr("action", "")
					.submit();
			} else {
				alert('กรุณากรอกเลขบัตรประชาชน หรือ เลขคดีดำ คดีแดง')
				$('#registerCode').focus()
				return false
			}
		}

		function action_from(REGISTERCODE, sh1, prefixBlackCase, blackCase, blackYy, prefixRedCase, redCase, redYy, CourtCode, courtName, concernName, fullName) {
			/* $('#sh1').val(sh1);
			$('#prefixBlackCase').val(prefixBlackCase);
			$('#blackCase').val(blackCase);
			$('#blackYy').val(blackYy);
			$('#prefixRedCase').val(prefixRedCase);
			$('#redCase').val(redCase);
			$('#redYy').val(redYy);
			$('#CourtCode').val(CourtCode);
			$('#courtName').val(courtName);
			$('#concernName').val(concernName);
			$('#fullName').val(fullName);
			$('#proc').val('search_data_add'); */
			let PCC_CIVIL_GEN = '<?php echo $_GET['PCC_CIVIL_GEN']; ?>'
			let url = "./cmd_add_from.php?";
			url += "&REGISTERCODE=" + REGISTERCODE;
			url += "&PCC_CIVIL_GEN=" + PCC_CIVIL_GEN;
			url += "&SEND_FROM=" + 'CIVIL';
			url += "&receive_case=" + sh1;

			url += "&receive_prefixBlackCase=" + prefixBlackCase;
			url += "&receive_blackCase=" + blackCase;
			url += "&receive_blackYy=" + blackYy;

			url += "&receive_prefixRedCase=" + prefixRedCase;
			url += "&receive_redCase=" + redCase;
			url += "&receive_redYy=" + redYy;

			url += "&receive_CourtCode=" + CourtCode;
			url += "&receive_courtName=" + courtName;
			url += "&receive_concernName=" + concernName;
			url += "&receive_fullName=" + fullName;
			url += "&TO_PERSON_ID=" + '<?php echo $_GET['TO_PERSON_ID']; ?>'
			url += "&proc=" + 'search_data_add';
			// window.location.href = url;
			window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
			//$('#frm-input').attr('action', './cmd_add_from.php').submit();
		}
	</script>
	<?php
	include '../include/combottom_js_user.php';
	include '../include/combottom_user.php'; ?>