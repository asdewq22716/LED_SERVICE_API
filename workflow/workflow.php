<?php
include '../include/comtop_user.php';

foreach ($_GET as $key => $val) {
	$$key = conText($val);
}
if ($W != "") {
	if (!check_permission("WFM", $W)) {
?>
		<script>
			window.location.href = "index.php";
		</script>
	<?php
		exit;
	}
	$WF_VIEW_ID = conText($_GET['VIEW']);
	$WF_SCREEN_NO = "WM#" . $W;

	if ($WF_VIEW_ID == "") {
		$sql = db::query("select * from WF_MAIN where WF_MAIN_ID = '" . $W . "' ");
	} else {
		$sql = db::query("select * from WF_MAIN_VIEW where WF_MAIN_ID = '" . $W . "' AND WF_VIEW_ID ='" . $WF_VIEW_ID . "' ");
	}
	$rec_main = db::fetch_array($sql);
	$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
	$wf_link = 'workflow.php';
	if ($rec_main["WF_BTN_ADD_LABEL"] != '') {
		$WF_TEXT_MAIN_ADD = $rec_main["WF_BTN_ADD_LABEL"];
	}
	if ($rec_main["WF_BTN_BACK_LABEL"] != '') {
		$WF_TEXT_MAIN_BACK = $rec_main["WF_BTN_BACK_LABEL"];
	}
	if ($rec_main["WF_BTN_CON_LABEL"] != '') {
		$WF_TEXT_MAIN_PROCESS = $rec_main["WF_BTN_CON_LABEL"];
	}
	if ($rec_main["WF_BTN_STEP_LABEL"] != '') {
		$WF_TEXT_MAIN_PROCESS_STEP = $rec_main["WF_BTN_STEP_LABEL"];
	}
	if ($rec_main["WF_BTN_DEL_LABEL"] != '') {
		$WF_TEXT_MAIN_DEL = $rec_main["WF_BTN_DEL_LABEL"];
	}

	$wf_limit = $_GET['wf_limit'] == "" ? 20 : $_GET['wf_limit'];
	if ($wf_page == '') {
		$wf_page = 1;
	}
	$wf_offset = ($wf_page - 1) * $wf_limit;
	if ($rec_main["WF_BTN_CON_RESIZE"] == 'Y') {
		$tootip = 'data-toggle="tooltip"';
	} else {
		$tootip = '';
	}

	if ($rec_main["WF_BTN_STEP_RESIZE"] == 'Y') {
		$tootip_step = 'data-toggle="tooltip"';
	} else {
		$tootip_step = '';
	}

	if ($rec_main["WF_BTN_DEL_RESIZE"] == 'Y') {
		$tootip_del = 'data-toggle="tooltip"';
	} else {
		$tootip_del = '';
	}
	if ($rec_main["WF_BTN_ADD_RESIZE"] == 'Y') {
		$tootip_add = 'data-toggle="tooltip"';
	} else {
		$tootip_add = '';
	}
	if ($rec_main["WF_BTN_BACK_RESIZE"] == 'Y') {
		$tootip_back = 'data-toggle="tooltip"';
	} else {
		$tootip_back = '';
	}

	$WF_LIST_DATA = "Y";

	/* Table แสดงผล */
	$tb_head = explode("|", $rec_main['WF_VIEW_COL_HEADER']);
	$tb_data = explode("|", $rec_main['WF_VIEW_COL_DATA']);
	$tb_align = explode("|", $rec_main['WF_VIEW_COL_ALIGN']);
	$tb_size = explode("|", $rec_main['WF_VIEW_COL_SIZE']);
	$tb_order = explode("|", $rec_main['WF_VIEW_COL_ORDER']);
	$tb_class = array("C" => "text-center", "L" => "text-left", "R" => "text-right");
	$column_n = count($tb_head);

	$WF_R_TOTAL = $rec_main['WF_R_TOTAL'];
	$total = explode("|", $WF_R_TOTAL);
	/* Table แสดงผล */

	$link_add = ($rec_main["WF_BTN_ADD_LINK"] != '') ? $rec_main["WF_BTN_ADD_LINK"] : "workflow_start.php?W=" . $W;
	$link_add = wf_convert_var($link_add);
	if ($rec_main["WF_BTN_BACK_LINK"] != '') {
		$link_back = wf_convert_var($rec_main["WF_BTN_BACK_LINK"]);
	} else {
		if ($system_conf["wf_show_menu"] == "A") {
			foreach ($_SESSION['WF_MENU'] as $key => $val) {
				foreach ($val as $key2 => $val2) {
					if ($val2['WF_MAIN_ID'] == $W) {
						if ($key > 0) {
							$link_back = "../workflow/index.php?G=" . $key;
						} else {
							$link_back = "../workflow/index.php";
						}
					}
				}
			}
		} else {
			$link_back = "../workflow/index.php";
		}
	}
	?>
	<style>
		.card-header {
			border-bottom: 0px;
		}

		<?php
		if ($rec_main['WF_TABLE_HTML'] == "Y") {
		?>.table-none-responsive {
			overflow-x: auto;
			background-color: #FFFFFF;
		}

		.table {
			background-color: #FFFFFF;
		}

		body {
			overflow-x: auto;
		}

		<?php
		}
		?>
	</style>
	<?php
	if ($rec_main['WF_TABLE_HTML'] == "F") {
	?>
		<link rel="stylesheet" type="text/css" href="../assets/plugins/data-table/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/plugins/data-table/css/fixedColumns.bootstrap4.min.css">
	<?php } ?>

	<!-- jqpagination css -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/jqpagination/css/jqpagination.css">

	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			<div class="row" id="animationSandbox">
				<div class="col-sm-12">
					<div class="main-header">
						<div class="media m-b-12">
							<a class="media-left" href="<?php echo $link_back_home; ?>">
								<?php if ($rec_main['WF_MAIN_ICON'] != "") {
									echo "<img src=\"../icon/" . $rec_main['WF_MAIN_ICON'] . "\" class=\"media-object\">";
								} ?>
							</a>
							<div class="media-body">
								<h4 class="m-t-5">&nbsp;</h4>
								<h4><?php echo bsf_language("W", $rec_main['WF_MAIN_ID'], $rec_main['WF_MAIN_NAME']); ?></h4>
							</div>
						</div>
						<div class="f-right">
							<?php
							if ($rec_main["WF_BTN_ADD_STATUS"] == 'Y') {
								$sql_detail = db::query("select WFD_ID from WF_DETAIL where WF_MAIN_ID = '" . $W . "' AND WFD_TYPE = 'S' ");
								$rec_detail = db::fetch_array($sql_detail);
								$notcheck = "N";
								if (check_permission("WFM", $W) or check_permission("DET", $rec_detail["WFD_ID"])) {
							?>
									<a class="btn btn-primary active waves-effect waves-light" href="<?php echo $link_add; ?>" role="button" <?php echo $tootip_add; ?> title="<?php if ($rec_main["WF_BTN_ADD_RESIZE"] == 'Y') {
																																													echo $WF_TEXT_MAIN_ADD;
																																												} ?>"><i class="icofont icofont-ui-add"></i> <?php if ($rec_main["WF_BTN_ADD_RESIZE"] != 'Y') {
																																																																										echo $WF_TEXT_MAIN_ADD;
																																																																									} ?></a>
								<?php }
							}
							if ($rec_main["WF_BTN_BACK_STATUS"] == 'Y') { ?>
								<a class="btn btn-danger waves-effect waves-light" href="<?php echo $link_back; ?>" role="button" <?php echo $tootip_back; ?> title="<?php if ($rec_main["WF_BTN_BACK_RESIZE"] == 'Y') {
																																										echo $WF_TEXT_MAIN_BACK;
																																									} ?>"><i class="icofont icofont-home"></i> <?php if ($rec_main["WF_BTN_BACK_RESIZE"] != 'Y') {
																																																																							echo $WF_TEXT_MAIN_BACK;
																																																																						} ?></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!-- Row end -->
			<!--Workflow row start-->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<?php
						$filter = "";
						if ($rec_main["WF_MAIN_TOP_INCLUDE"] != "" and file_exists("../plugin/" . $rec_main["WF_MAIN_TOP_INCLUDE"])) {
							include("../plugin/" . $rec_main["WF_MAIN_TOP_INCLUDE"]);
						}
						$sql_search = db::query("select * from WF_STEP_FORM where WF_MAIN_ID = '" . $W . "' AND WF_TYPE = 'S' AND (WFS_HIDDEN_FORM IS NULL OR WFS_HIDDEN_FORM = '' OR WFS_HIDDEN_FORM = 'N') ");
						if (db::num_rows($sql_search) > 0) {
						?>
							<div id="wf_space" class="card-header">
								<form method="get" id="form_wf_search" name="form_wf_search" action="#">
									<h4><i class="icofont icofont-search-alt-2"></i> <?php echo $system_conf["conf_search"]; ?></h4>
									<div class="form-group row">
										<?php bsf_show_form($W, 0, $_GET, 'S'); ?>
									</div>
									<div class="form-group row">
										<div class="col-md-12 text-center">
											<button type="submit" name="wf_search" id="wf_search" class="btn btn-info"><i class="icofont icofont-search-alt-2"></i> <?php echo $system_conf["conf_search"]; ?></button>&nbsp;&nbsp;
											<button type="button" name="wf_reset" id="wf_reset" class="btn btn-warning" onClick="window.location.href='workflow.php?W=<?php echo $W; ?>&VIEW=<?php echo $WF_VIEW_ID; ?>';"><i class="zmdi zmdi-refresh-alt"></i> <?php echo $system_conf["wf_label_reset"]; ?></button>
											<input type="hidden" name="W" id="W" value="<?php echo $W; ?>"><input type="hidden" name="VIEW" id="VIEW" value="<?php echo $WF_VIEW_ID; ?>"><input type="hidden" name="WF_SEARCH" id="WF_SEARCH" value="Y">
										</div>
									</div>
								</form>
							</div>
						<?php
							$filter = wf_search_function($W, $_GET, $wf_table, $rec_main["WF_FIELD_PK"]);
						} ?>

						<?php
						if (($WF_SEARCH == "Y" and $rec_main["WF_SEARCH_SHOW"] == "Y") or ($rec_main["WF_SEARCH_SHOW"] == "N" or $rec_main["WF_SEARCH_SHOW"] == "")) {
							if ($wf_order == '') {
								if ($rec_main["WF_MAIN_DEFAULT_ORDER"] != "") {
									$wf_order = wf_convert_var($rec_main["WF_MAIN_DEFAULT_ORDER"]);
									$wfr_order = "  ORDER BY " . $wf_order . " " . $wf_order_type;
								} else {
									/*$wf_order = $rec_main["WF_FIELD_PK"];
										$wf_order_type = "DESC";*/
								}
							}
							//$wfr_order = "  ORDER BY ".$wf_order." ".$wf_order_type;

							$permission_view = gen_permission($rec_main["WF_PERMISS_VIEW"], $rec_main["WF_MAIN_ID"], $rec_main["WF_TYPE"]);
							if ($permission_view != '') {
								$filter .= " AND ( " . $permission_view . " )";
							}

							if ($rec_main["WF_MAIN_SEARCH"] == '2' and $rec_main["WF_MAIN_SEARCH_SQL"] != '') {
								$sql_s = wf_convert_var($rec_main["WF_MAIN_SEARCH_SQL"]);
								$sql_s = str_replace("#SEARCH#", $filter, $sql_s);
							} else {
								if ($rec_main["WF_MAIN_SEARCH"] == '1' and $rec_main["WF_R_SQL"] != '') {
									$cond = " AND " . wf_convert_var($rec_main["WF_R_SQL"]);
								} else {
									$cond = "";
								}
								$sql_s = "select * from " . $wf_table . " where 1=1 " . $cond . $filter;
							}

							$sql_workflow = $sql_s . $wfr_order;

							if ($rec_main["WF_SPLIT_PAGE"] == 'Y') {
								$query_workflow = db::query_limit($sql_workflow, $wf_offset, $wf_limit);
							} else {
								$query_workflow = db::query($sql_workflow);
							}
							$query_num = db::query($sql_workflow);
							$num_rows_data = db::num_rows($query_num);
						?>
							<div class="card-block">
								<?php if ($num_rows_data > 0 and $rec_main["WF_SPLIT_PAGE"] == 'Y') { ?>
									<div class="form-group">
										<div class="col-md-1 offset-md-11">
											<select name="WF_PER_PAGE" id="WF_PER_PAGE" class="form-control" onchange="change_page_limit(this.value);">
												<?php
												if ($rec_main['WF_PER_PAGE'] == "") {
													if ($system_conf['wf_list_per_page'] == "") {
														$per_page_array = "20,50,100,200";
													} else {
														$per_page_array = $system_conf['wf_list_per_page'];
													}
												} else {
													$per_page_array = $rec_main['WF_PER_PAGE'];
												}

												$per_page_ex = explode(',', $per_page_array);
												foreach ($per_page_ex as $_val) {
												?>
													<option value="<?php echo trim($_val); ?>" <?php echo $_GET['wf_limit'] == trim($_val) ? 'selected' : ''; ?>><?php echo trim($_val); ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								<?php } ?>

								<div class="f-right">
									<?php
									if ($rec_main["WF_EXPORT_PDF"] == 'Y') { ?>
										<a class="btn btn-danger btn-mini waves-effect waves-light" href="#export" role="button" onClick="export_data('pdfl');"><i class="fa fa-file-pdf-o"></i> ส่งออก PDF</a>
									<?php } ?>

									<?php if ($rec_main['WF_EXPORT_WORD'] == "Y") { ?>
										<a class="btn btn-info btn-mini waves-effect waves-light" href="#export" role="button" onClick="export_data('doc');"><i class="fa fa-file-word-o"></i> ส่งออก word</a>
									<?php } ?>

									<?php if ($rec_main['WF_EXPORT_EXCEL'] == "Y") { ?>
										<a class="btn btn-success btn-mini waves-effect waves-light" href="#export" role="button" onClick="export_data('xls');"><i class="fa fa-file-excel-o"></i> ส่งออก excel</a>
									<?php } ?>
								</div>

								<div class="<?php if ($rec_main['WF_TABLE_HTML'] == "Y") {
												echo "table-non-responsive";
											} else {
												echo "table-responsive";
											} ?>" data-pattern="priority-columns" id="export_data">
									<div class="showborder">
										<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
											<thead class="bg-primary">
												<?php
												if ($rec_main['WF_REPORT_HEAD_STATUS'] == "Y") {
													$html = stripslashes($rec_main['WF_REPORT_HEADER']);
													$table = explode('<tbody>', $html);
													$th = explode('</tbody>', $table[1]);
													$th_html = str_replace('<td', '<th', $th[0]);
													$th_html = str_replace('</td', '</th', $th_html);
													echo $th_html;
												} else {
												?>
													<tr class="bg-primary">
														<?php
														if ($rec_main["WF_VIEW_COL_SHOW_NO"] == "Y") {
														?><th style="width: 5%;" class="text-center">
																<nobr><?php
																		$wf_order_n = $rec_main["WF_FIELD_PK"];
																		if ($wf_order == $rec_main["WF_FIELD_PK"]) {

																			$l_icon = order_ico($wf_order_type);
																			$wf_order_type_n = convert_order($wf_order_type);
																		} else {
																			$wf_order_type_n = "DESC";
																			$l_icon = "";
																		}
																		?><a href="<?php echo create_link($wf_link, $_GET, array(), array('wf_order', 'wf_order_type')) . '&wf_order=' . $wf_order_n . '&wf_order_type=' . $wf_order_type_n; ?>" class=""><?php echo $WF_TEXT_MAIN_ORDER; ?> <?php echo $l_icon; ?></a></nobr>
															</th><?php
																}
																for ($c = 0; $c < $column_n; $c++) {
																	?><th style="width:<?php echo $tb_size[$c]; ?>;" class="text-center"><?php
																																if ($tb_order[$c] != '') {
																																	$wf_order_n = $tb_order[$c];
																																?><nobr><?php
																																	if ($wf_order == $tb_order[$c]) {
																																		$l_icon = order_ico($wf_order_type);
																																		$wf_order_type_n = convert_order($wf_order_type);
																																	} else {
																																		$wf_order_type_n = "ASC";
																																		$l_icon = "";
																																	}
																	?><a href="<?php echo create_link($wf_link, $_GET, array(), array('wf_order', 'wf_order_type')) . '&wf_order=' . $wf_order_n . '&wf_order_type=' . $wf_order_type_n; ?>"><?php echo $tb_head[$c]; ?> <?php echo $l_icon; ?></a></nobr><?php
																																																																				} else {
																																																																					echo $tb_head[$c];
																																																																				}
																																																																					?></th><?php
																}
																if ($rec_main["WF_DET_STEP_COL"] != 'N') { ?>
															<th style="width: 10%;" class="text-center td_remove"><?php echo ($rec_main["WF_DET_STEP_LABEL_COL"] != '') ? $rec_main["WF_DET_STEP_LABEL_COL"] : $WF_TEXT_DET_STEP; ?></th>
														<?php }

																if ($rec_main["WF_DET_NEXT_COL"] != 'N') { ?>
															<th style="width: 10%;" class="text-center td_remove"><?php echo ($rec_main["WF_DET_NEXT_LABEL_COL"] != '') ? $rec_main["WF_DET_NEXT_LABEL_COL"] : $WF_TEXT_DET_NEXT; ?></th>
														<?php } ?>
														<th style="width: 10%;" class="text-center td_remove"></th>
													</tr>
												<?php } ?>
											</thead>
											<tbody>
												<?php
												$no = 1 + $wf_offset;
												while ($WF = db::fetch_array($query_workflow)) {
													$WF_T = array();
													foreach ($WF as $k => $v) {
														$WF_T[$k] = nl2br($v);
													}
													$WF = $WF_T;
												?>
													<tr id="tr_wf_<?php echo $WF["WFR_ID"]; ?>" <?php if ($WF["WF_DET_NEXT"] == '' or $WF["WF_DET_NEXT"] == '0') {
																									echo 'class="table-success"';
																								} ?>>
														<?php
														$link_process = ($rec_main["WF_BTN_CON_LINK"] != '') ? bsf_show_field($W, $WF, $rec_main["WF_BTN_CON_LINK"], 'W') : "workflow_process.php?W=" . $W . "&WFR=" . $WF["WFR_ID"];
														$link_process_step = ($rec_main["WF_BTN_STEP_LINK"] != '') ? bsf_show_field($W, $WF, $rec_main["WF_BTN_STEP_LINK"], 'W') : "workflow_step.php?W=" . $W . "&WFR=" . $WF["WFR_ID"];
														if ($rec_main["WF_BTN_DEL_LINK"] != '') {
															$link_del = bsf_show_field($W, $WF, $rec_main["WF_BTN_DEL_LINK"], 'W');
															$onclick = "";
														} else {
															$link_del = "#!";
															$onclick = "onclick=\"delete_wf_main('" . $W . "','" . $WF["WFR_ID"] . "')\"";
														}

														if ($rec_main["WF_VIEW_COL_SHOW_NO"] == "Y") {
														?><td style="text-align:center;"><?php echo $no; ?></td><?php
																												}
																												for ($c = 0; $c < $column_n; $c++) {
																													?><td class="<?php echo $tb_class[$tb_align[$c]]; ?>">
																<?php
																													echo $data_text = bsf_show_text($W, $WF, $tb_data[$c]);
																													if ($total[$c] != '') {
																														$total_all = str_replace(",", "", $data_text);
																														$sum_amount[$c] += $total_all;
																													}
																?></td><?php
																												}
																												if ($rec_main["WF_DET_STEP_COL"] != 'N') { ?>
															<td class="text-left td_remove"><?php echo step_name($WF["WF_DET_STEP"]); ?></td>
														<?php }
																												if ($rec_main["WF_DET_NEXT_COL"] != 'N') { ?>
															<td class="text-left td_remove"><?php echo step_name($WF["WF_DET_NEXT"]); ?></td>
														<?php } ?>
														<td class="text-left td_remove">
															<nobr>
																<?php if ($rec_main["WF_MAIN_LIST_INCLUDE"] != "" and file_exists("../plugin/" . $rec_main["WF_MAIN_LIST_INCLUDE"])) {
																	include("../plugin/" . $rec_main["WF_MAIN_LIST_INCLUDE"]);
																}
																if ($WF["WF_DET_NEXT"] != '' and $WF["WF_DET_NEXT"] != '0') {
																	if ($rec_main["WF_BTN_CON_STATUS"] == 'Y') {
																		$notcheck = "N";
																		if ((check_permission("WFM", $W) or check_permission("DET", $WF["WF_DET_NEXT"])) and check_det_permission($W, $WF["WF_DET_NEXT"], $WF, 'ACTION')) {

																			$sql_s_detail = db::query("SELECT WFD_BTN_CON_LABEL FROM WF_DETAIL WHERE WFD_ID='" . $WF["WF_DET_NEXT"] . "'");
																			$detail = db::fetch_array($sql_s_detail);
																			if ($detail["WFD_BTN_CON_LABEL"] != '') {
																				$WF_TEXT_MAIN_PROCESS1 = bsf_show_text($W, $WF, $detail["WFD_BTN_CON_LABEL"]);
																			} else {
																				$WF_TEXT_MAIN_PROCESS1 = $WF_TEXT_MAIN_PROCESS;
																			}
																?>
																			<a href="<?php echo $link_process; ?>" class="btn btn-success btn-mini" <?php echo $tootip; ?> title="<?php if ($rec_main["WF_BTN_CON_RESIZE"] == 'Y') {
																																													echo $WF_TEXT_MAIN_PROCESS1;
																																												} ?>">
																				<i class="icofont icofont-tick-mark"></i> <?php if ($rec_main["WF_BTN_CON_RESIZE"] != 'Y') {
																																echo $WF_TEXT_MAIN_PROCESS1;
																															} ?>
																			</a> &nbsp;
																		<?php
																		} else { ?><a href="#!" class="btn btn-disabled btn-mini" title="<?php if ($rec_main["WF_BTN_CON_RESIZE"] == 'Y') {
																																	echo 'รอดำเนินการ';
																																} ?>" <?php echo $tootip; ?> <?php echo $tootip; ?> disabled="true">
																				<i class="ion-alert-circled"></i> <?php if ($rec_main["WF_BTN_CON_RESIZE"] != 'Y') {
																														echo 'รอดำเนินการ';
																													} ?>
																			</a> &nbsp; <?php }
																				}
																			}
																			if ($rec_main["WF_BTN_STEP_STATUS"] == 'Y') {
																						?>
																	<!--<a href="#!" class="btn btn-info btn-mini"  data-toggle="modal" data-target="#bizModal" title="<?php //if($rec_main["WF_BTN_STEP_RESIZE"] == 'Y'){echo $WF_TEXT_MAIN_PROCESS_STEP;}
																																										?>" onclick="open_modal('<?php //echo $link_process_step;
																																																																					?>','');" >
																		<i class="typcn typcn-th-list"></i> <? php // if($rec_main["WF_BTN_STEP_RESIZE"] != 'Y'){echo $WF_TEXT_MAIN_PROCESS_STEP;}
																											?>
																	</a> &nbsp;-->
																	<?php if ($rec_main['WF_STEP_NEXT_TAB'] == "Y") { ?>
																		<a href="<?php echo $link_process_step; ?>" <?php echo $tootip_step; ?> title="<?php if ($rec_main["WF_BTN_STEP_RESIZE"] == 'Y') {
																																							echo $WF_TEXT_MAIN_PROCESS_STEP;
																																						} ?>" target="_blank" class="btn btn-info btn-mini">
																			<i class="typcn typcn-th-list"></i> <?php if ($rec_main["WF_BTN_STEP_RESIZE"] != 'Y') {
																													echo bsf_show_text($W, $WF, $WF_TEXT_MAIN_PROCESS_STEP);
																												} ?>
																		</a> &nbsp;
																	<?php } else { ?>
																		<a href="#!" <?php echo $tootip_step; ?> title="<?php if ($rec_main["WF_BTN_STEP_RESIZE"] == 'Y') {
																															echo $WF_TEXT_MAIN_PROCESS_STEP;
																														} ?>" onClick="PopupCenter('<?php echo $link_process_step; ?>', '<?php echo  bsf_show_text($W, $WF, $WF_TEXT_MAIN_PROCESS_STEP); ?>', (window.innerWidth-60), window.innerHeight) ;" class="btn btn-info btn-mini">
																			<i class="typcn typcn-th-list"></i> <?php if ($rec_main["WF_BTN_STEP_RESIZE"] != 'Y') {
																													echo bsf_show_text($W, $WF, $WF_TEXT_MAIN_PROCESS_STEP);
																												} ?>
																		</a> &nbsp;
																	<?php } ?>
																<?php }
																			if ($rec_main["WF_BTN_DEL_STATUS"] == 'Y' and check_det_permission($W, $WF["WF_DET_NEXT"], $WF, 'DEL')) { ?>
																	<a href="<?php echo $link_del; ?>" class="btn btn-danger btn-mini" <?php echo $tootip_del; ?> title="<?php if ($rec_main["WF_BTN_DEL_RESIZE"] == 'Y') {
																																											echo bsf_show_text($W, $WF, $WF_TEXT_MAIN_DEL);
																																										} ?>" <?php echo $onclick; ?>>
																		<i class="icofont icofont-trash"></i> <?php if ($rec_main["WF_BTN_DEL_RESIZE"] != 'Y') {
																													echo bsf_show_text($W, $WF, $WF_TEXT_MAIN_DEL);
																												} ?>
																	</a>
																<?php } ?>
															</nobr>
														</td>
													</tr>
												<?php $no++;
												} ?>
												<?php
												if ($rec_main["WF_R_TOTAL_USE"] == 'Y') { ?>
													<tr class="bg-primary">
														<?php
														if ($rec_main["WF_VIEW_COL_SHOW_NO"] == "Y") {
														?><th style="width: 5%;" class="text-center">
																<nobr></nobr>
															</th>
														<?php
														}
														for ($c = 0; $c < $column_n; $c++) { ?>
															<th style="width:<?php echo $tb_size[$c]; ?>;" class="text-right"><?php if ($total[$c] != '') {
																																	echo number_format($sum_amount[$c], 2);
																																} ?></th>
														<?php }

														if ($rec_main["WF_DET_STEP_COL"] != 'N') { ?>
															<th style="width: 10%;" class="text-center td_remove"></th>
														<?php }

														if ($rec_main["WF_DET_NEXT_COL"] != 'N') { ?>
															<th style="width: 10%;" class="text-center td_remove"></th>
														<?php } ?>
														<th style="width: 10%;" class="text-center td_remove"></th>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>

								<?php if ($num_rows_data > 0 and $rec_main["WF_SPLIT_PAGE"] == 'Y') {
									$wf_page_all = floor($num_rows_data / $wf_limit);
									if (($num_rows_data % $wf_limit) > 0) {
										$wf_page_all++;
									}
									echo $WF_SPLIT_PAGE[0] . ' ' . $wf_page . ' ' . $WF_SPLIT_PAGE[1] . ' ' . $wf_page_all . ' ' . $WF_SPLIT_PAGE[2] . ' ' . $WF_SPLIT_PAGE[3] . ' ' . $num_rows_data . ' ' . $WF_SPLIT_PAGE[4]; ?>
									<div aria-label="page list small" class="f-right">
										<ul class="pagination pagination-sm">
											<?php if ($wf_page > 1) { ?>
												<li class="page-item">
													<a class="page-link waves-effect" href="<?php echo $link = create_link($wf_link, $_GET, array(), array('wf_page')) . '&wf_page=1'; ?>" aria-label="First">
														<span aria-hidden="true"><i class="zmdi zmdi-fast-rewind"></i></span>
														<span class="sr-only">First</span>
													</a>
												</li>
												<li class="page-item">
													<a class="page-link waves-effect" href="<?php echo $link = create_link($wf_link, $_GET, array(), array('wf_page')) . '&wf_page=' . ($wf_page - 1); ?>" aria-label="Previous">
														<span aria-hidden="true"><i class="zmdi zmdi-skip-previous"></i></span>
														<span class="sr-only">Previous</span>
													</a>
												</li>
											<?php
											}
											$c_start = $wf_page - 5;
											if ($c_start < 1) {
												$c_start = '1';
											}
											$c_end = $wf_page + 5;
											if ($c_end > $wf_page_all) {
												$c_end = $wf_page_all;
											}
											for ($p = $c_start; $p <= $c_end; $p++) {
												if ($wf_page == $p) {
													$act = ' active';
													$link = '#!';
												} else {
													$act = '';
													$link = create_link($wf_link, $_GET, array(), array('wf_page')) . '&wf_page=' . ($p);
												}
											?>
												<li class="page-item<?php echo $act; ?>"><a class="page-link waves-effect" href="<?php echo $link; ?>" role="button"><?php echo $p; ?></a></li>
											<?php }
											if ($wf_page != $wf_page_all) { ?>
												<li class="page-item">
													<a class="page-link waves-effect" href="<?php echo $link = create_link($wf_link, $_GET, array(), array('wf_page')) . '&wf_page=' . ($wf_page + 1); ?>" aria-label="Next">
														<span aria-hidden="true"><i class="zmdi zmdi-skip-next"></i></span>
														<span class="sr-only">Next</span>
													</a>
												</li>
												<li class="page-item">
													<a class="page-link waves-effect" href="<?php echo $link = create_link($wf_link, $_GET, array(), array('wf_page')) . '&wf_page=' . $wf_page_all; ?>" aria-label="Last">
														<span aria-hidden="true"><i class="zmdi zmdi-fast-forward"></i></span>
														<span class="sr-only">Last</span>
													</a>
												</li>
											<?php } ?>
										</ul>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
						<?php if ($rec_main["WF_MAIN_BOTTOM_INCLUDE"] != "" and file_exists("../plugin/" . $rec_main["WF_MAIN_BOTTOM_INCLUDE"])) {
							echo "<div class=\"card-block\">";
							include("../plugin/" . $rec_main["WF_MAIN_BOTTOM_INCLUDE"]);
							echo "</div>";
						} ?>
					</div>
				</div>
			</div>
			<!-- Workflow Row end -->
		</div>
		<!-- Container-fluid ends -->
	</div>
	</div>
	<form method="post" id="form_export" name="form_export" target="_blank" action="export_report.php">
		<input type="hidden" name="export_content" id="export_content" />
		<input type="hidden" name="export_type" id="export_type" value="" />
		<input type="hidden" name="margin_left" id="margin_left" value="<?php echo ($margin_left ? $margin_left : "15"); ?>">
		<input type="hidden" name="margin_right" id="margin_right" value="<?php echo ($margin_right ? $margin_right : "15"); ?>">
		<input type="hidden" name="margin_top" id="margin_top" value="<?php echo ($margin_top ? $margin_top : "16"); ?>">
		<input type="hidden" name="margin_bottom" id="margin_bottom" value="<?php echo ($margin_bottom ? $margin_bottom : "16"); ?>">
		<input type="hidden" name="margin_header" id="margin_header " value="<?php echo ($margin_header ? $margin_header : "16"); ?>">
		<input type="hidden" name="margin_footer" id="margin_footer" value="<?php echo ($margin_footer ? $margin_footer : "9"); ?>">
		<input type="hidden" name="header_pdf" id="header_pdf" value="<?php echo ($header_pdf ? $header_pdf : ""); ?>">
		<input type="hidden" name="header_doc" id="header_doc" value="<?php echo ($header_doc ? $header_doc : ""); ?>">
		<input type="hidden" name="page_type" id="page_type" value="<?php echo ($page_type ? $page_type : ""); ?>">
		<input type="hidden" name="header_xls" id="header_xls" value="<?php echo ($header_xls ? $header_xls : ""); ?>">
		<input type="hidden" name="R_SET_FONT" id="R_SET_FONT" value="<?php echo $FONT; ?>">
	</form>
	<?php
	include '../include/combottom_js_user.php';
	if ($rec_main['WF_TABLE_HTML'] == "F") {
	?>
		<script type="text/javascript" language="javascript" src="../assets/plugins/data-table/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="../assets/plugins/data-table/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript" language="javascript" src="../assets/plugins/data-table/js/dataTables.fixedColumns.min.js"></script>
		<script>
			$(document).ready(function() {
				var tb_wf_height = $(window).height() - 200;
				var table = $('#tech-companies-1').DataTable({
					scrollY: tb_wf_height + "px",
					scrollX: true,
					scrollCollapse: true,
					paging: false,
					fixedColumns: false,
					searching: false,
					ordering: false,
					info: false
				});

				$('#tech-companies-1_wrapper').css('margin-top', 'inherit');
			});
		</script>
	<?php
	}
	?>
	<script type="text/javascript">
		function delete_wf_main(w, wfr) {
			if (w != '' && wfr != '') {
				swal({
						title: "",
						text: "<?php echo $system_conf["wf_delete_confirm_list"]; ?>",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						confirmButtonText: "<?php echo $system_conf["wf_delete_confirm"]; ?>",
						cancelButtonText: "<?php echo $system_conf["wf_cancle"]; ?>",
						closeOnConfirm: true
					},
					function() {
						var dataString = 'process=del&W=' + w + '&WFR=' + wfr;
						$.ajax({
							type: "POST",
							url: "../workflow/workflow_del_function.php",
							data: dataString,
							cache: false,
							success: function(html) {
								$('#tr_wf_' + wfr).hide();
							}
						});
					});
			}
		}

		function change_page_limit(limit) {
			window.location.href = "<?php echo create_link($wf_link, $_GET, array(), array('wf_limit', 'wf_page')) . '&wf_page=1&wf_limit='; ?>" + limit + "";
		}

		function export_data(type) {
			var alldata = $("#export_data").html();
			$('.td_remove').remove();

			type_doc(type);
			export_file();

			$("#export_data").html(alldata);
			$("#form_wf_search").submit();
		}
	</script>
<?php
}
include '../include/combottom_user.php'; ?>