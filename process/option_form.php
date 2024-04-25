<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);
$WFS = conText($_GET['WFS']);

$sql_form = db::query("select * from WF_STEP_FORM where WFS_ID = '".$WFS."' ");
$rec_form = db::fetch_array($sql_form);
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-header-text"><i class="fa fa-list-alt"></i> ตั้งค่า Form</h5>
			</div>
			<div class="card-block">
				<!---->
				<div class="form-group">
					<div class="col-md-12">
						<div class="form-group row">
							<div class="col-md-9">
								<label for="WFS_FORM_SELECT" class="form-control-label">เลือก Form </label>
								<div class="input-group">
								<select name="WFS_FORM_SELECT" id="WFS_FORM_SELECT" class="select2" onchange="option_field_form(this.value,'<?php echo $rec_form["WFS_FORM_FIELD_EDIT"];?>');"><option value="" disabled selected>เลือก</option>
									<?php
	$sql_list = db::query("select WF_MAIN_ID,WF_MAIN_NAME,WF_TYPE from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'F' ORDER BY WF_MAIN_ORDER");
	while($rec_m = db::fetch_array($sql_list)){
		$sql_form = db::query("select COUNT(WFS_ID) AS WFS_ID from WF_STEP_FORM WHERE WF_MAIN_ID = '".$rec_m["WF_MAIN_ID"]."' AND WF_TYPE = '".$rec_m["WF_TYPE"]."' AND WFS_MASTER_CROSS = 'Y'");
		$C = db::fetch_array($sql_form);
	?><option value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" <?php if($rec_form['WFS_FORM_SELECT'] == $rec_m["WF_MAIN_ID"]){ echo "selected"; } ?>><?php echo $rec_m["WF_MAIN_NAME"]; ?> <?php if($C['WFS_ID']>0){ echo '*'; } ?></option><?php } ?>
								</select>
								<span class="input-group-addon bg-primary" ><a href="#!" onClick="if($('#WFS_FORM_SELECT').val() != null){ window.open('workflow_step_preview.php?WFD=0&W='+$('#WFS_FORM_SELECT').val(),'',''); }"><i class="icofont icofont-search-alt-2"> </i></a></span>
								<span class="input-group-addon bg-primary" ><a href="#!" onClick="if($('#WFS_FORM_SELECT').val() != null){ window.open('form_step_form.php?WFD=0&W='+$('#WFS_FORM_SELECT').val(),'',''); }"><i class="icofont icofont-edit-alt"> </i></a></span>
									</div>

								<small class="form-text text-muted">* เป็น form ที่มีการตั้งค่าบันทึกข้อมูลแบบทั้งหมด</small>
							</div>
							<div class="col-md-3">
								<label class="form-control-label">รูปแบบการแสดง</label>
								<select name="WFS_INPUT_FORMAT" id="WFS_INPUT_FORMAT" class="form-control" onChange="option_field_form(WFS_FORM_SELECT.value,this.value); frm_select(this.value);">
									<option value="O" <?php echo $rec_form['WFS_INPUT_FORMAT'] == "O" ? 'selected' : ''; ?>>1 To 1</option>
									<option value="T" <?php echo $rec_form['WFS_INPUT_FORMAT'] == "T" ? 'selected' : ''; ?>>1 To 1 (เก็บเฉพาะขั้นตอนนี้)</option>
									<option value="M" <?php echo $rec_form['WFS_INPUT_FORMAT'] == "M" ? 'selected' : ''; ?>>1 To M</option>
									<option value="D" <?php echo $rec_form['WFS_INPUT_FORMAT'] == "D" ? 'selected' : ''; ?>>1 To M (เก็บเฉพาะขั้นตอนนี้)</option>
								</select>
							</div>
						</div>
						<div class="form-group" id="F1TOM1" style="display:<?php echo ($rec_form['WFS_INPUT_FORMAT'] == "" OR $rec_form['WFS_INPUT_FORMAT'] == "O" OR $rec_form['WFS_INPUT_FORMAT'] == "T") ? 'none' : ''; ?>">
					<div class="form-group row">
						<div class="col-md-5">
						<div class="form-group"> 
							<label for="WFS_FORM_ADD_POPUP" class="form-control-label ">รูปแบบการบันทึกข้อมูล</label>
								 <div class="form-radio">
									<div class="radio">
										<label>
											<input type="radio" name="WFS_FORM_ADD_POPUP" id="WFS_FORM_ADD_POPUP" value="Y" required aria-required="true" data-toggle="validator" <?php echo ($rec_form['WFS_FORM_ADD_POPUP'] == "" OR $rec_form['WFS_FORM_ADD_POPUP'] == "Y") ? 'checked' : ''; ?>>
											<i class="helper"></i> เพิ่มข้อมูลแบบ Pop-up</input>
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="WFS_FORM_ADD_POPUP" id="WFS_FORM_ADD_POPUP" value="N" required aria-required="true" data-toggle="validator" <?php echo ($rec_form['WFS_FORM_ADD_POPUP'] == "N") ? 'checked' : ''; ?>>
											<i class="helper">
											</i>  เพิ่มข้อมูลแบบ In-line</input>
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="WFS_FORM_ADD_POPUP" id="WFS_FORM_ADD_POPUP" value="M" required aria-required="true" data-toggle="validator" <?php echo ($rec_form['WFS_FORM_ADD_POPUP'] == "M") ? 'checked' : ''; ?>>
											<i class="helper">
											</i>  เพิ่มข้อมูลแบบ In-line ตามค่า Master ที่ Set ไว้</input>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="WFS_FORM_POPUP" class="form-control-label ">กรณี เพิ่มข้อมูลแบบ Pop-up</label>
								 <div class="form-radio">
									<div class="radio">
										<label>
											<input type="radio" name="WFS_FORM_POPUP" id="WFS_FORM_POPUP" value="Y" <?php echo ($rec_form['WFS_FORM_POPUP'] == "" OR $rec_form['WFS_FORM_POPUP'] == "Y") ? 'checked' : ''; ?>>
											<i class="helper"></i> ใช้  Modal</input>
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="WFS_FORM_POPUP" id="WFS_FORM_POPUP" value="P" <?php echo ($rec_form['WFS_FORM_POPUP'] == "P") ? 'checked' : ''; ?>>
											<i class="helper">
											</i> ใช้ Window.open</input>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 m-t-20">
								<label for="WFS_FORM_PRELOAD" class="form-control-label ">กรณี เพิ่มข้อมูลแบบ In-line </label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-10">
								<div class="input-group"> 
								<span class="input-group-addon" >เพิ่มข้อมูลรอ</span>
								<input type="number" name="WFS_FORM_PRELOAD" id="WFS_FORM_PRELOAD" class="form-control autonumber" value="<?php echo $rec_form['WFS_FORM_PRELOAD']; ?>">
								<span class="input-group-addon" >รายการ</span>
								</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<div class="checkbox-color checkbox-primary">
										<input name="WFS_INLINE_FORM" id="WFS_INLINE_FORM" type="checkbox" value="Y" <?php if($rec_form['WFS_INLINE_FORM']=="Y"){ echo "checked"; } ?>>
										<label for="WFS_INLINE_FORM">
											แสดง In-line ตาม form ต้นฉบับ
										</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-7">
							<div class="form-control-label">ตั้งค่าการแสดงผลปุ่ม</div>
							<div class="table-responsive" data-pattern="priority-columns">
								<table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
									<thead>
										<tr class="bg-primary">
											<th width="40%"  class="text-center">แสดง/ซ่อน</th>
											<th width="10%" class="text-center">
												<nobr>ย่อปุ่ม</nobr>
											</th>
											<th class="text-center">เปลี่ยน Label</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-left">
												<div class="checkbox-color checkbox-primary">
													<input name="WFS_FORM_ADD_STATUS" id="WFS_FORM_ADD_STATUS" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_ADD_STATUS'] == "Y" ? 'checked' : ''; ?>>
													<label for="WFS_FORM_ADD_STATUS">
														ปุ่มเพิ่มข้อมูล
													</label>
												</div>
											</td>
											<td class="text-right">
												<div class="checkbox-color checkbox-danger">
													<input name="WFS_FORM_ADD_RESIZE" id="WFS_FORM_ADD_RESIZE" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_ADD_RESIZE'] == "Y" ? 'checked' : ''; ?>>
													<label for="WFS_FORM_ADD_RESIZE">&nbsp;</label>
												</div>
											</td>
											<td>
												<input type="text" name="WFS_FORM_ADD_LABEL" id="WFS_FORM_ADD_LABEL" class="form-control text-primary" placeholder="เพิ่มข้อมูล" value="<?php echo $rec_form['WFS_FORM_ADD_LABEL']; ?>">
											</td>
										</tr>
										<tr>
											<td class="text-left">
												<div class="checkbox-color checkbox-primary">
													<input name="WFS_FORM_EDIT_STATUS" id="WFS_FORM_EDIT_STATUS" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_EDIT_STATUS'] == "Y" ? 'checked' : ''; ?>>
													<label for="WFS_FORM_EDIT_STATUS">
														ปุ่มแก้ไข
													</label>
												</div>
											</td>
											<td class="text-right">
												<div class="checkbox-color checkbox-danger">
													<input name="WFS_FORM_EDIT_RESIZE" id="WFS_FORM_EDIT_RESIZE" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_EDIT_RESIZE'] == "Y" ? 'checked' : ''; ?>>
													<label for="WFS_FORM_EDIT_RESIZE">&nbsp;</label>
												</div>
											</td>
											<td>
												<input type="text" name="WFS_FORM_EDIT_LABEL" id="WFS_FORM_EDIT_LABEL" class="form-control text-primary" placeholder="แก้ไข" value="<?php echo $rec_form['WFS_FORM_EDIT_LABEL']; ?>">
											</td>
										</tr>
										<tr>
											<td class="text-left">
												<div class="checkbox-color checkbox-primary">
													<input name="WFS_FORM_VIEW_STATUS" id="WFS_FORM_VIEW_STATUS" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_VIEW_STATUS'] == "Y" ? 'checked' : ''; ?>>
													<label for="WFS_FORM_VIEW_STATUS">
														ปุ่มดูข้อมูล
													</label>
												</div>
											</td>
											<td class="text-right">
												<div class="checkbox-color checkbox-danger">
													<input name="WFS_FORM_VIEW_RESIZE" id="WFS_FORM_VIEW_RESIZE" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_VIEW_RESIZE'] == "Y" ? 'checked' : ''; ?>>
													<label for="WFS_FORM_VIEW_RESIZE">&nbsp;</label>
												</div>
											</td>
											<td>
												<input type="text" name="WFS_FORM_VIEW_LABEL" id="WFS_FORM_VIEW_LABEL" class="form-control text-primary" placeholder="ดูข้อมูล" value="<?php echo $rec_form['WFS_FORM_VIEW_LABEL']; ?>">
											</td>
										</tr>
										<tr>
											<td class="text-left">
												<div class="checkbox-color checkbox-primary">
													<input name="WFS_FORM_COPY_STATUS" id="WFS_FORM_COPY_STATUS" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_COPY_STATUS'] == "Y" ? 'checked' : ''; ?>>
													<label for="WFS_FORM_COPY_STATUS">
														ปุ่มคัดลอกข้อมูล
													</label>
												</div>
											</td>
											<td class="text-right">
												<div class="checkbox-color checkbox-danger">
													<input name="WFS_FORM_COPY_RESIZE" id="WFS_FORM_COPY_RESIZE" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_COPY_RESIZE'] == "Y" ? 'checked' : ''; ?>>
													<label for="WFS_FORM_COPY_RESIZE">&nbsp;</label>
												</div>
											</td>
											<td>
												<input type="text" name="WFS_FORM_COPY_LABEL" id="WFS_FORM_COPY_LABEL" class="form-control text-primary" placeholder="คัดลอก" value="<?php echo $rec_form['WFS_FORM_COPY_LABEL']; ?>">
											</td>
										</tr>
										<tr>
											<td class="text-left">
												<div class="checkbox-color checkbox-primary">
													<input name="WFS_FORM_DEL_STATUS" id="WFS_FORM_DEL_STATUS" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_DEL_STATUS'] == "Y" ? 'checked' : ''; ?>>
													<label for="WFS_FORM_DEL_STATUS">
														ปุ่มลบ
													</label>
												</div>
											</td>
											<td class="text-right">
												<div class="checkbox-color checkbox-danger">
													<input name="WFS_FORM_DEL_RESIZE" id="WFS_FORM_DEL_RESIZE" type="checkbox" value="Y" <?php echo $rec_form['WFS_FORM_DEL_RESIZE'] == "Y" ? 'checked' : ''; ?>>
													<label for="WFS_FORM_DEL_RESIZE">&nbsp;</label>
												</div>
											</td>
											<td>
												<input type="text" name="WFS_FORM_DEL_LABEL" id="WFS_FORM_DEL_LABEL" class="form-control text-primary" placeholder="ปุ่มลบ" value="<?php echo $rec_form['WFS_FORM_DEL_LABEL']; ?>">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						</div>
					</div>
				</div>
				<!---->
				<div class="form-group row"> 
					<div class="col-md-12"  id="F1TOM2" style="display:<?php echo ($rec_form['WFS_INPUT_FORMAT'] == "" OR $rec_form['WFS_INPUT_FORMAT'] == "O" OR $rec_form['WFS_INPUT_FORMAT'] == "T") ? 'none' : ''; ?>">
						<div class="form-group"> 
							<label for="WFS_FORM_INPUT_SHOW" class="form-control-label ">ตั้งค่าการบันทึกแบบฟอร์ม</label>
							 <div class="form-radio">
								<div class="radio">
									<label>
										<input type="radio" name="WFS_FORM_INPUT_SHOW" id="WFS_FORM_INPUT_SHOW" value="" <?php echo ($rec_form['WFS_FORM_INPUT_SHOW'] == "" ) ? 'checked' : ''; ?> onClick="$('#WFS_FORM_INPUT_SHOW_MANUAL').hide();">
										<i class="helper"></i> ใช้ Input ทุกตัวในแบบฟอร์ม</input>
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="WFS_FORM_INPUT_SHOW" id="WFS_FORM_INPUT_SHOW" value="M" <?php echo ($rec_form['WFS_FORM_INPUT_SHOW'] == "M") ? 'checked' : ''; ?>  onClick="$('#WFS_FORM_INPUT_SHOW_MANUAL').show();">
										<i class="helper">
										</i>  ตั้งค่า Input เอง</input>
									</label>
								</div>
							</div>
						</div>
						<div id="WFS_FORM_INPUT_SHOW_MANUAL" class="form-group" <?php echo ($rec_form['WFS_FORM_INPUT_SHOW'] == "" ) ? 'style="display:none"' : ''; ?>> 
							<label for="WFS_FORM_FIELD_EDIT" class="form-control-label">กรณีตั้งค่า Input เอง กำหนด Field ที่ต้องการแสดงในส่วนเพิ่ม/แก้ไข/ดูข้อมูล</label>
							<div id="WFS_FORM_FIELD_EDIT"></div>
						</div>
					</div>
				</div>
				<div  id="F1TOM3" style="display:<?php echo ($rec_form['WFS_INPUT_FORMAT'] == "" OR $rec_form['WFS_INPUT_FORMAT'] == "O" OR $rec_form['WFS_INPUT_FORMAT'] == "T") ? 'none' : ''; ?>">
				<div class="form-group row">
					<div class="col-md-6">
						<div class="form-control-label">
							ตั้งค่าการแสดงผลหน้าตาราง (ถ้าไม่ได้ตั้งค่า จะแสดงทุกคอลัมน์ของ form )
						</div>
					</div>
					<?php
			$WF_VIEW_COL_HEADER = conText($rec_form['WF_VIEW_COL_HEADER']);
			if($WF_VIEW_COL_HEADER != ""){
			$WF_VIEW_COL_DATA = $rec_form['WF_VIEW_COL_DATA'];
			$WF_VIEW_COL_ALIGN = $rec_form['WF_VIEW_COL_ALIGN'];
			$WF_VIEW_COL_SIZE = $rec_form['WF_VIEW_COL_SIZE'];
			$WF_VIEW_COL_TOTAL = $rec_form['WF_VIEW_COL_TOTAL'];
			$WF_VIEW_COL_TROW = $rec_form['WF_VIEW_COL_TROW'];
			$fi = explode("|",$WF_VIEW_COL_HEADER);
			$va = explode("|",$WF_VIEW_COL_DATA);
			$al = explode("|",$WF_VIEW_COL_ALIGN);
			$wi = explode("|",$WF_VIEW_COL_SIZE);
			$to = explode("|",$WF_VIEW_COL_TOTAL);
			$tr = explode("|",$WF_VIEW_COL_TROW);
			$column = count($fi);
			}
					?>
					<input type="hidden" name="WF_VIEW_COL_HEADER" id="WF_VIEW_COL_HEADER" class="form-control" value="<?php echo $WF_VIEW_COL_HEADER; ?>">
					<input type="hidden" name="WF_VIEW_COL_DATA" id="WF_VIEW_COL_DATA" class="form-control" value="<?php echo $WF_VIEW_COL_DATA; ?>">
					<input type="hidden" name="WF_VIEW_COL_ALIGN" id="WF_VIEW_COL_ALIGN" class="form-control" value="<?php echo $WF_VIEW_COL_ALIGN; ?>">
					<input type="hidden" name="WF_VIEW_COL_SIZE" id="WF_VIEW_COL_SIZE" class="form-control" value="<?php echo $WF_VIEW_COL_SIZE; ?>">
					<input type="hidden" name="WF_VIEW_COL_TOTAL" id="WF_VIEW_COL_TOTAL" class="form-control" value="<?php echo $WF_VIEW_COL_TOTAL; ?>">
					<input type="hidden" name="WF_VIEW_COL_TROW" id="WF_VIEW_COL_TROW" class="form-control" value="<?php echo $WF_VIEW_COL_TROW; ?>">
					<div class="col-md-6">
						<div class="f-right">
							<button type="button" onClick="addACol('data_position');" class="btn btn-success waves-effect waves-light">
								<i class="icofont icofont-ui-add"></i> เพิ่มคอลัมน์
							</button>
						</div>
					</div>
				</div>
				<!---->
				<div class="form-group row">
					<div class="col-md-12">
						<!---->
						<div class="table-responsive" data-pattern="priority-columns">
							<table id="data_position" class='table table-striped table-bordered'>
								<thead class='sorted_head' style="cursor:move">
									<tr class="bg-primary">
										<td style="cursor:default;">
											<label for="WF_VIEW_COL_SHOW_NO" class="custom-control custom-checkbox">
												<input type="checkbox" name="WF_VIEW_COL_SHOW_NO" id="WF_VIEW_COL_SHOW_NO" class="custom-control-input" value="Y" <?php if($rec_form['WF_VIEW_COL_SHOW_NO'] == 'Y' )
												{
													echo 'checked';
												} ?>>
												<span class="custom-control-indicator"></span>
												<span class="custom-control-description">แสดงลำดับ</span>
											</label>
										</td>
										<?php for($c = 0;$c < $column;$c++)
										{ ?>
											<th>ลำดับที่ <?php echo($c + 1); ?></th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<tr class="text-center">
										<th>หัวตาราง</th>
										<?php for($c = 0;$c < $column;$c++)
										{ ?>
											<td>
												<input type="text" id="fi_val" class="form-control fi_val" value="<?php echo $fi[$c]; ?>">
											</td>
										<?php } ?>
									</tr>
									<tr class="text-center">
										<th>การแสดงข้อมูล
											<small class="form-text text-muted">Table Field ให้ใช้ ##FIELD!!</small>
										</th>
										<?php for($c = 0;$c < $column;$c++)
										{ ?>
											<td>
												<input type="text" id="va_val" class="form-control va_val" value="<?php echo $va[$c]; ?>">
											</td>
										<?php } ?>
									</tr>
									<tr class="text-center">
										<th>จัดตำแหน่ง</th>
										<?php for($c = 0;$c < $column;$c++)
										{ ?>
											<td class="text-left"><select id="al_val" class="form-control">
													<option value="L" <?php if($al[$c] == "L")
													{
														echo "selected";
													} ?>>ชิดซ้าย
													</option>
													<option value="C" <?php if($al[$c] == "C")
													{
														echo "selected";
													} ?>>ตรงกลาง
													</option>
													<option value="R" <?php if($al[$c] == "R")
													{
														echo "selected";
													} ?>>ชิดขวา
													</option>
												</select></td>
										<?php } ?>
									</tr>
									<tr>
										<th>ขนาด</th>
										<?php for($c = 0;$c < $column;$c++)
										{ ?>
											<td>
												<input type="text" id="wi_val" class="form-control text-right" value="<?php echo $wi[$c]; ?>">
											</td>
										<?php } ?>
									</tr>
									<tr class="text-center">
										<th>
											<div class="input-group col-md-4">
												<span class="input-group-addon" id="alighaddon1"><label for="WF_VIEW_FOOTER" class="custom-control custom-checkbox"><input type="checkbox" name="WF_VIEW_FOOTER" id="WF_VIEW_FOOTER" class="custom-control-input" value="Y" <?php echo $rec_form['WF_VIEW_FOOTER'] == "Y" ? 'checked' : ''; ?>><span class="custom-control-indicator"></span></label></span>
												<input type="text" name="WF_TEXT_FOOTER" class="form-control col-md-4" placeholder="รวม" value="<?php echo $rec_form['WF_TEXT_FOOTER']; ?>">
											</div>
										</th>
										<?php for($c = 0;$c < $column;$c++)
										{ ?>
											<td class="text-center"><input type="text" id="to_val" class="form-control text-right" value="<?php echo $to[$c]; ?>"></td>
										<?php } ?>
									</tr>
									<tr class="text-center">
										<th>
											โยนค่าไปยังตัวแปร
											<small class="form-text text-muted">ใส่ id ตัวแปรที่ต้องการโยนค่า (ต้องตั้งค่ารวมก่อน)</small>
										</th>
										<?php for($c = 0;$c < $column;$c++)
										{ ?>
											<td class="text-center"><input type="text" id="tr_val" class="form-control" value="<?php echo $tr[$c]; ?>"></td>
										<?php } ?>
									</tr>
									<tr class="text-center">
										<th></th>
										<?php for($c = 0;$c < $column;$c++)
										{ ?>
											<td>
												<button type="button" onClick="del('data_position',<?php echo $c; ?>);" class="btn btn-danger waves-effect btn-mini">
													<i class="icofont icofont-ui-close"></i> ลบ
												</button>
											</td>
										<?php } ?>
									</tr>
								</tbody>
							</table>
						</div>หมายเหตุ : สัญญลักษณ์การรวม ประกอบด้วย <br />"S0":รวมแสดงเป็นจำนวนเต็ม, "S1":รวมแสดงเป็นทศนิยม 1 ตำแหน่ง, "S2":รวมแสดงเป็นทศนิยม 2 ตำแหน่ง, "S3":รวมแสดงเป็นทศนิยม 3 ตำแหน่ง,<br>"A0":ค่าเฉลี่ยแสดงเป็นจำนวนเต็ม, "A1":ค่าเฉลี่ยแสดงเป็นทศนิยม 1 ตำแหน่ง, "A2":ค่าเฉลี่ยแสดงเป็นทศนิยม 2 ตำแหน่ง, "A3":ค่าเฉลี่ยแสดงเป็นทศนิยม 3 ตำแหน่ง, <br>"C":นับจำนวน
					</div>
					<!---->
					<div class="col-md-12 row">
						<div class="card-header">
							 <label for="WFS_REPORT_HEAD_STATUS" class="custom-control custom-checkbox"><input type="checkbox" name="WFS_REPORT_HEAD_STATUS" id="WFS_REPORT_HEAD_STATUS" class="custom-control-input" value="Y" <?php if($rec_form['WFS_REPORT_HEAD_STATUS'] == 'Y' ){ echo 'checked';} ?>><span class="custom-control-indicator"></span>
											<span class="custom-control-description"> ตั้งค่าหัวตารางเอง</span></label>
						</div>
						<div class="card-block">
							 <textarea id="WFS_REPORT_HEADER" name="WFS_REPORT_HEADER"><?php echo stripslashes($rec_form['WFS_REPORT_HEADER']); ?></textarea>
						</div>
					</div>
				</div>
				<!---->
				</div>
			</div>
		</div>
	</div>
</div> 

<script src="../assets/plugins/tiny_mce/jquery.tinymce.js"></script>
<script>
	$(document).ready(function() {
		// File Browser
		$('textarea#WFS_REPORT_HEADER').tinymce({
			// Location of TinyMCE script
			script_url 							: '../assets/plugins/tiny_mce/tiny_mce.js',
			// General options
			theme 								: "advanced",
			plugins 							: "autoresize,style,table,advhr,advimage,advlink,emotions,inlinepopups,preview,media,contextmenu,paste,fullscreen,noneditable,xhtmlxtras,template,advlist",
			// Theme options
			theme_advanced_buttons1 			: "justifyleft,justifycenter,justifyright, justifyfull,|,tablecontrols,|,code,preview,fullscreen",
			theme_advanced_buttons2 			: "",
			theme_advanced_buttons3 			: "",
			theme_advanced_toolbar_location 	: "top",
			theme_advanced_toolbar_align 		: "left",
			theme_advanced_statusbar_location 	: "bottom",
			theme_advanced_resizing 			: false,
			font_size_style_values 				: "8pt,10px,12pt,14pt,18pt,24pt,36pt",
			init_instance_callback				: function(){
				function resizeWidth() {
					document.getElementById(tinyMCE.activeEditor.id+'_tbl').style.width='100%';
				}
				resizeWidth();
				$(window).resize(function() {
					resizeWidth();
				})
			},
			 content_css : "../assets/plugins/tiny_mce/themes/advanced/css/edit_content.css", 
			// file browser
			file_browser_callback: function openKCFinder(field_name, url, type, win) {
				tinyMCE.activeEditor.windowManager.open({
					file: 'file-manager/browse.php?opener=tinymce&type=' + type + '&dir=image/themeforest_assets',
					title: 'KCFinder',
					width: 700,
					height: 500,
					resizable: "yes",
					inline: true,
					close_previous: "no",
					popup_css: false
				}, {
					window: win,
					input: field_name
				});
				return false;
			}
		});
	});
</script>
<script>
	
	$(document).ready(function(){
		$('.select2').select2({
			placeholder: 'กรุณาเลือก...',
			allowClear: true
		});

		$('.searchable').multiSelect({
			selectableHeader: "<div class='custom-header'>Field ในตาราง</div><input type='text' class='form-control' autocomplete='off' placeholder='ค้นหา..'>",
			selectionHeader: "<div class='custom-header'>Field ที่เลือก</div><input type='text' class='form-control' autocomplete='off' placeholder='ค้นหา..'>",
			afterInit: function(ms) {
				var that = this,
					$selectableSearch = that.$selectableUl.prev(),
					$selectionSearch = that.$selectionUl.prev(),
					selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
					selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

				that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
					.on('keydown', function(e) {
						if (e.which === 40) {
							that.$selectableUl.focus();
							return false;
						}
					});

				that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
					.on('keydown', function(e) {
						if (e.which == 40) {
							that.$selectionUl.focus();
							return false;
						}
					});
			},
			afterSelect: function() {
				this.qs1.cache();
				this.qs2.cache();
			},
			afterDeselect: function() {
				this.qs1.cache();
				this.qs2.cache();
			}
		});
	});
	function frm_select(v){
		if(v=='O' || v=='T'){
			$('#F1TOM1').hide();
			$('#F1TOM2').hide();
			$('#F1TOM3').hide();
		}else{
			$('#F1TOM1').show();
			$('#F1TOM2').show();
			$('#F1TOM3').show();
		}
	}
	function addACol(p_table) {
		var col_num = $('#'+p_table+' thead tr th').length;
		if(col_num > 0){
			$('#'+p_table+' thead tr').find('th:last').after('<th>ลำดับที่ '+(col_num+1)+'</th>');
			var currentNumberOfTDsInARow = $('#'+p_table+' tr:first td').length;
			var rows = $('#'+p_table+' tbody tr');
			$(rows[0]).find('td:last').after('<td><input type="text" id="fi_val" class="form-control fi_val"></td>');
			$(rows[1]).find('td:last').after('<td><input type="text" id="va_val" class="form-control va_val"></td>');
			$(rows[2]).find('td:last').after('<td><select id="al_val" class="form-control"><option value="L">ชิดซ้าย</option><option value="C">ตรงกลาง</option><option value="R">ชิดขวา</option></select></td>');
			$(rows[3]).find('td:last').after('<td><input type="text" id="wi_val" class="form-control text-right"></td>');
			$(rows[4]).find('td:last').after('<td><input type="text" id="to_val" class="form-control text-right"></td>');
			$(rows[5]).find('td:last').after('<td><input type="text" id="tr_val" class="form-control"></td>');
			$(rows[6]).find('td:last').after("<td><button type=\"button\" onClick=\"del('data_position',"+col_num+");\" class=\"btn btn-danger waves-effect btn-mini\"><i class=\"icofont icofont-ui-close\"></i> ลบ</button></td>");
		}else{
			$('#'+p_table+' thead tr').find('td:last').after('<th>ลำดับที่ '+(col_num+1)+'</th>');
			var rows = $('#'+p_table+' tbody tr');
			$(rows[0]).find('th:last').after('<td><input type="text" id="fi_val" class="form-control fi_val" value=""></td>');
			$(rows[1]).find('th:last').after('<td><input type="text" id="va_val" class="form-control va_val" value=""></td>');
			$(rows[2]).find('th:last').after('<td><select id="al_val" class="form-control"><option value="L">ชิดซ้าย</option><option value="C">ตรงกลาง</option><option value="R">ชิดขวา</option></select></td>');
			$(rows[3]).find('th:last').after('<td><input type="text" id="wi_val" class="form-control text-right"></td>');
			$(rows[4]).find('th:last').after('<td><input type="text" id="to_val" class="form-control text-right"></td>');
			$(rows[5]).find('th:last').after('<td><input type="text" id="tr_val" class="form-control"></td>');
			$(rows[6]).find('th:last').after("<td><button type=\"button\" onClick=\"del('data_position',0);\" class=\"btn btn-danger waves-effect btn-mini\"><i class=\"icofont icofont-ui-close\"></i> ลบ</button></td>");
		}
	}
	function arrange_col(p_table) {
		var col_num = $('#'+p_table+' thead tr th');
		for (var x = 0; x < col_num.length; x++) {
			$(col_num[x]).html("ลำดับที่ "+(x+1));
		}
		var row_num = $('#'+p_table+' tbody tr');
		for (var x = 0; x < row_num.length; x++) {
			$('#'+p_table+' tr:eq(7) td:eq(' + x + ')').html("<button type=\"button\" onClick=\"del('data_position',"+x+");\" class=\"btn btn-danger waves-effect btn-mini\"><i class=\"icofont icofont-ui-close\"></i> ลบ</button>");
		}

	}
	function del(p_table,c) {
		if(confirm("คุณต้องการยกเลิกคอลัมน์ลำดับที่ "+(c+1)+"?")){
			$('#'+p_table+' tr:eq(0) th:eq(' + c + ')').remove();
			$('#'+p_table+' tr:eq(1) td:eq(' + c + ')').remove();
			$('#'+p_table+' tr:eq(2) td:eq(' + c + ')').remove();
			$('#'+p_table+' tr:eq(3) td:eq(' + c + ')').remove();
			$('#'+p_table+' tr:eq(4) td:eq(' + c + ')').remove();
			$('#'+p_table+' tr:eq(5) td:eq(' + c + ')').remove();
			$('#'+p_table+' tr:eq(6) td:eq(' + c + ')').remove();
			$('#'+p_table+' tr:eq(7) td:eq(' + c + ')').remove();
			arrange_col(p_table);
		}
	}
	function save_pos(p_table){
		var data1 = $('#'+p_table+' tbody tr td #fi_val');
		var data2 = $('#'+p_table+' tbody tr td #va_val');
		var data3 = $('#'+p_table+' tbody tr td #al_val');
		var data4 = $('#'+p_table+' tbody tr td #wi_val');
		var data5 = $('#'+p_table+' tbody tr td #to_val');
		var data6 = $('#'+p_table+' tbody tr td #tr_val');
		var fi_txt = '';
		var va_txt = '';
		var al_txt = '';
		var wi_txt = '';
		var to_txt = '';
		var tr_txt = '';
		for (var x = 0; x < data1.length; x++) {
			fi_txt += '|'+$(data1[x]).val();
			va_txt += '|'+$(data2[x]).val();
			al_txt += '|'+$(data3[x]).val();
			wi_txt += '|'+$(data4[x]).val();
			to_txt += '|'+$(data5[x]).val();
			tr_txt += '|'+$(data6[x]).val();
		}
		var fitxt = fi_txt.substring(1);
		var vatxt = va_txt.substring(1);
		var altxt = al_txt.substring(1);
		var witxt = wi_txt.substring(1);
		var totxt = to_txt.substring(1);
		var trtxt = tr_txt.substring(1);
		$('#WF_VIEW_COL_HEADER').val(fitxt);
		$('#WF_VIEW_COL_DATA').val(vatxt);
		$('#WF_VIEW_COL_ALIGN').val(altxt);
		$('#WF_VIEW_COL_SIZE').val(witxt);
		$('#WF_VIEW_COL_TOTAL').val(totxt);
		$('#WF_VIEW_COL_TROW').val(trtxt);

	}
	
	// Sortable rows
	$('.sorted_table').sortable({
		containerSelector: 'table',
		itemPath: '> tbody',
		itemSelector: 'tr',
		placeholder: '<tr class="placeholder"/>'
	});

	// Sortable column heads
	var oldIndex;
	$('.sorted_head tr').sortable({
		containerSelector: 'tr',
		itemSelector: 'th',
		placeholder: '<th class="placeholder"/>',
		vertical: false,
		onDragStart: function ($item, container, _super) {
			oldIndex = $item.index();
			$item.appendTo($item.parent());
			_super($item, container);
		},
		onDrop: function  ($item, container, _super) {
			var field,
				newIndex = $item.index();

			if(newIndex != oldIndex) {
				$item.closest('table').find('tbody tr').each(function (i, row) {
					row = $(row);
					if(newIndex < oldIndex) {
						row.children().eq(newIndex).before(row.children()[oldIndex]);
					} else if (newIndex > oldIndex) {
						row.children().eq(newIndex).after(row.children()[oldIndex]);
					}
				});
			}

			_super($item, container);

			arrange_col('data_position');

		}
	});
	
	function option_field_form(id,value){
		//$('#WFS_FORM_FIELD_EDIT option').remove();
		var dataString = {ID:id,WFS_FORM_FIELD_EDIT:value,WFS_FORM_FIELD_VIEW:'<?php echo $rec_form["WFS_FORM_FIELD_VIEW"];?>',WFS:'<?php echo $WFS;?>'};
		$.ajax({
		 type: "GET",
		 url: "ajax_option_form.php",
		 data: dataString,
		 cache: false,
		 success: function(html){
			 //$('#ms-WFS_FORM_FIELD_EDIT').remove();
			 /*alert(html);
			$('#WFS_FORM_FIELD_EDIT').append(html).multiSelect('refresh');*/
			//$('.searchable').multiSelect();
			$('#WFS_FORM_FIELD_EDIT').html(html);
		 }
		 });
	}
	option_field_form('<?php echo $rec_form["WFS_FORM_SELECT"];?>','<?php echo $rec_form["WFS_FORM_FIELD_EDIT"];?>');

</script>
<?php db::db_close(); ?>