<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Row Starts -->
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<h4><?php echo $p_name; ?></h4>
				</div>
			</div>
		</div>
		<!-- Row end -->
		<form action="<?php echo $p_url; ?>_function.php" name="form_wf" id="form_wf" method="post" enctype="multipart/form-data" onsubmit="return chk_password();">
			<input type="hidden" name="process" id="process" value="<?php echo $process; ?>">
			<!-- Row Starts -->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header"><h5 class="card-header-text">
								<i class="typcn typcn-message"></i> ข้อมูล<?php echo $p_name; ?></h5>
						</div>
						<div class="card-block">
							<!---->
							<div class="form-group row">
								<?php
								$data_pre = show_field('USR_PREFIX');
								?>
								<div class="col-md-2">
									<label for="USR_PREFIX" class="form-control-label wf-right">คำนำหน้าชื่อ
										<?php if($data_pre["FIELD_REQUIRED"] == 'Y'){ echo ' <span class="text-danger">*</span></label>';}?></label>
								</div>
								<div class="col-md-2">
									<?php
									
									if($data_pre["FIELD_EDIT"] == 'Y'){?>
									
										<select name="USR_PREFIX" id="USR_PREFIX" class="select2 form-control" <?php if($data_pre["FIELD_REQUIRED"] == 'Y'){ echo 'required';}?>>
											<option value=""></option>
											<option value="นาย" <?php echo $rec['USR_PREFIX'] == "นาย" ? 'selected' : ''; ?>>นาย</option>
											<option value="นางสาว" <?php echo $rec['USR_PREFIX'] == "นางสาว" ? 'selected' : ''; ?>>นางสาว</option>
											<option value="นาง" <?php echo $rec['USR_PREFIX'] == "นาง" ? 'selected' : ''; ?>>นาง</option>
										</select>
									<?php
									}else{
										echo $rec['USR_PREFIX'];
										?>
										<input type="hidden" name="USR_PREFIX" id="USR_PREFIX" value="<?php echo $rec['USR_PREFIX'];?>">
									<?php }?>
								</div>
								<?php
								$data_name = show_field('USR_FNAME');
								$data_lname = show_field('USR_LNAME');
								
								?>
								<div class="col-md-1">
									<label for="USR_FNAME" class="form-control-label wf-right">ชื่อ
										<?php if($data_name["FIELD_REQUIRED"] == 'Y'){ echo ' <span class="text-danger">*</span></label>';}?></label>
								</div>
								<div class="col-md-3">
									<?php
									if($data_name["FIELD_EDIT"] == 'Y'){?>
										<input type="text" id="USR_FNAME" name="USR_FNAME"  class="form-control" value="<?php echo $rec['USR_FNAME']; ?>" <?php if($data_name["FIELD_REQUIRED"] == 'Y'){ echo 'required';}?>>
									<?php
									}else{
										echo $rec['USR_FNAME'];
									?>
										<input type="hidden" id="USR_FNAME" name="USR_FNAME"  value="<?php echo $rec['USR_FNAME']; ?>" >
									<?php
									}?>
								</div>
								<div class="col-md-1">
									<label for="USR_LNAME" class="form-control-label wf-right">นามสกุล <?php if($data_lname["FIELD_REQUIRED"] == 'Y'){ echo ' <span class="text-danger">*</span></label>';}?></label>
								</div>
								<div class="col-md-3">
									<?php
									if($data_lname["FIELD_EDIT"] == 'Y'){?>
										<input type="text" id="USR_LNAME" name="USR_LNAME"  class="form-control" value="<?php echo $rec['USR_LNAME']; ?>" <?php if($data_lname["FIELD_REQUIRED"] == 'Y'){ echo 'required';}?>>
									
									<?php }else{ 
										echo  $rec['USR_LNAME'];
									?>
										<input type="hidden" id="USR_LNAME" name="USR_LNAME"  value="<?php echo $rec['USR_LNAME']; ?>" >
										
									<?php	
									}?>
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<?php
								$data_e = show_field('USR_EMAIL');
								$data_tel = show_field('USR_TEL');
								
								?>
								<div class="col-md-2">
									<label for="USR_EMAIL" class="form-control-label wf-right">E-Mail<?php if($data_e["FIELD_REQUIRED"] == 'Y'){ echo ' <span class="text-danger">*</span></label>';}?></label>
								</div>
								<div class="col-md-6">
									<?php
									if($data_e["FIELD_EDIT"] == 'Y'){?>
										<input type="text" id="USR_EMAIL" name="USR_EMAIL"  class="form-control email" value="<?php echo $rec['USR_EMAIL']; ?>" <?php if($data_e["FIELD_REQUIRED"] == 'Y'){ echo 'required';}?>>
									<?php
									}else{
										echo $rec['USR_EMAIL'];?>
										<input type="hidden" id="USR_EMAIL" name="USR_EMAIL"  value="<?php echo $rec['USR_EMAIL']; ?>" >
									<?php }?>
								</div>
								<div class="col-md-2">
									<label for="USR_TEL" class="form-control-label wf-right">เบอร์โทรศัพท์ <?php if($data_tel["FIELD_REQUIRED"] == 'Y'){ echo ' <span class="text-danger">*</span></label>';}?></label>
								</div>
								<div class="col-md-2">
								<?php
									if($data_e["FIELD_EDIT"] == 'Y'){?>
										<input type="text" id="USR_TEL" name="USR_TEL"  class="form-control mobile" value="<?php echo $rec['USR_TEL']; ?>" <?php if($data_e["FIELD_REQUIRED"] == 'Y'){ echo 'required';}?>>
									<?php
									}else{
										echo $rec['USR_TEL'];?>
										<input type="hidden" id="USR_TEL" name="USR_TEL"  value="<?php echo $rec['USR_TEL']; ?>" >
									<?php }?>
								</div>
							</div>
							<div class="form-group row">
								<?php
								$data_line = show_field('USR_LINE_ID');?>
								<div class="col-md-2">
									<label for="USR_LINE_ID" class="form-control-label wf-right">Line ID <?php if($data_line["FIELD_REQUIRED"] == 'Y'){ echo ' <span class="text-danger">*</span></label>';}?></label>
								</div>
								<div class="col-md-4"><?php
									if($data_line["FIELD_EDIT"] == 'Y'){?>
										<input type="text" id="USR_LINE_ID" name="USR_LINE_ID"  class="form-control mobile" value="<?php echo $rec['USR_LINE_ID']; ?>" <?php if($data_line["FIELD_REQUIRED"] == 'Y'){ echo 'required';}?>>
									<?php
									}else{
										echo $rec['USR_LINE_ID'];?>
									<input type="hidden" id="USR_LINE_ID" name="USR_LINE_ID" value="<?php echo $rec['USR_LINE_ID']; ?>">
									<?php }?>
								</div>
							</div>
							<!---->
							
							<!---->
							<?php
							if($rec["USR_PICTURE"] != ''){?>
								<div class="form-group row">
									  <div class="col-md-2">
										<label class="form-control-label wf-right"></label>
									  </div>
									  <div class="col-md-4">
										<div class="md-group-add-on">
										<?php
											if(file_exists('../profile/'.$rec["USR_PICTURE"])){?>
												<img src="../profile/<?php echo $rec["USR_PICTURE"];?>" alt="Profile Picture" height="120" width="120"> <br>
												<input type="checkbox" name="CANCLE_PICTURE" id="CANCLE_PICTURE" value="Y" > ยกเลิกรูปโปรไฟล์
										<?php }?>
										</div>    
									  </div>
								</div>
							<?php }?>
							<div class="form-group row">
								  <div class="col-md-2">
									<label class="form-control-label wf-right">ภาพโปรไฟล์</label>
								  </div>
								  <div class="col-md-4">
									<div class="md-group-add-on">
										<span class="md-add-on-file">
											<button class="btn btn-success waves-effect waves-light"><i class="zmdi zmdi-attachment-alt"></i> เลือกไฟล์</button>
										</span>
										<div class="md-input-file">
											<input type="file" name="USR_PICTURE" id="USR_PICTURE" class=""  />
											<input type="text" class="md-form-control md-form-file">
											<label class="md-label-file"></label>
										</div>
									</div>    
								  </div>
							</div>
							
							<?php
							$sql = db::query("SELECT * FROM USR_SETTING WHERE FIELD_TYPE='O' AND FIELD_STATUS='Y' ORDER BY FIELD_ID");
							$i=1;
							while($rec_o = db::fetch_array($sql)){	
								$wh = '';
								if($rec_o["FIELD_ID"] != ''){
									$sql_master = db::query("SELECT WF_MAIN_ID,WF_MAIN_NAME,WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID = '".$rec_o["WF_MAIN_ID"]."'");
									$rec_m = db::fetch_array($sql_master);
										
										
									$sql_mpk = db::query("SELECT WFS_FIELD_NAME as WFS_FIELD_NAME FROM WF_STEP_FORM WHERE WF_MAIN_ID = '". $rec_o["WF_MAIN_ID"]."' AND WF_TYPE='".$WF_TYPE."'");
									$rec_ms = db::fetch_array($sql_mpk);
									
									if($rec_o['FIELD_TEXT'] != '' AND ($rec_o['FIELD_RELETION'] == '' OR $rec_o['FIELD_RELETION'] == 'M')){
										$rec_ms["WFS_FIELD_NAME"] = $rec_o['FIELD_TEXT']; 
										
									}
									
									//$data_show = show_field($rec_o['FIELD_NAME']);
									
									if($rec_o['FIELD_EDIT'] == 'Y'){
									if($rec_o['FIELD_RELETION'] == 'T'){ //TEXT?>
										<div class="form-group row">
											<div class="col-md-2">
												<label for="USR_OPTION<?php echo $i; ?>" class="form-control-label wf-right"><?php echo $rec_o['FIELD_LABEL']; if($rec_o["FIELD_REQUIRED"] == 'Y'){ echo ' <span class="text-danger">*</span></label>';}?>
												</label>
											</div>
											<div class="col-md-4">
												<input type="text" id="USR_OPTION<?php echo $i; ?>" name="USR_OPTION<?php echo $i; ?>" class="form-control" value="<?php echo $rec[$rec_o["FIELD_NAME"]]; ?>" <?php if($rec_o["FIELD_REQUIRED"] == 'Y'){ echo 'required';}?>>
											</div>
										</div>
									<?php
									}elseif(($rec_o['FIELD_RELETION'] == 'M' OR $rec_o['FIELD_RELETION'] == '') AND $rec_m["WF_MAIN_ID"] != ''){ //1:M,1:1
										if($rec_o['FIELD_STATEMENT'] != ''){
											$wh = " where ".str_replace("&#039;","'",$rec_o['FIELD_STATEMENT']);
											
										}else{
											$wh = '';
										}
										
										if($rec_o['FIELD_RELETION'] == 'M'){$arr = '[]';$multi = 'multiple';}else{ $arr = '';$multi ='';}
										
										$sql_mt = "SELECT * FROM ".$rec_m["WF_MAIN_SHORTNAME"].$wh;
										$sql_m_t = db::query($sql_mt);?>
										<div class="form-group row">
											<div class="col-md-2">
												<label for="USR_OPTION<?php echo $i; ?>" class="form-control-label wf-right"><?php echo $rec_o["FIELD_LABEL"]; if($rec_o["FIELD_REQUIRED"] == 'Y'){ echo ' <span class="text-danger">*</span></label>';}?></label>
											</div>
											<div class="col-md-6">
												
												<select name="USR_OPTION<?php echo $i.$arr; ?>" id="USR_OPTION<?php echo $i; ?>" class="select2" <?php echo $multi;?>  data-placeholder="เลือก<?php echo $rec_m["WF_MAIN_NAME"]; ?>">
												<option value=""></option>
												<?php
												if($rec["USR_OPTION".$i] != ''){
													$data = explode(',',$rec["USR_OPTION".$i]);
												}else{
													$data = array();
													
												}
												while($data_m = db::fetch_array($sql_m_t)){
												
													if($rec_o['FIELD_RELETION'] == 'M'){
														if(in_array($data_m[$rec_m["WF_FIELD_PK"]], $data)){ $seleted = 'selected';}else{ $seleted = ''; }
													}else{
														if($data_m[$rec_m["WF_FIELD_PK"]] == $rec["USR_OPTION".$i]){ $seleted = 'selected';}else{ $seleted = ''; }
														
													}
													
													
												?>
													<option value="<?php echo $data_m[$rec_m["WF_FIELD_PK"]]; ?>" <?php echo $seleted;?>> <?php
													if($rec_o['FIELD_TEXT'] != ''){
														echo bsf_show_text($rec_m["WF_MAIN_ID"],$data_m,$rec_o['FIELD_TEXT'],$rec_m["WF_TYPE"]);														
													}else{
														echo $data_m[$rec_ms["WFS_FIELD_NAME"]];
													}
													?></option>
												<?php }	?>
												</select>
											</div>
									</div>

									<?php	
																	
									}
									}
									?>
										
									<input type="hidden" name="FIELD_ID<?php echo $i;?>" id="FIELD_ID<?php echo $i;?>" value="<?php echo $rec_o['FIELD_ID'];?>">
									<?php
								}
							$i++;}
							?>

							<div class="form-group row">
								<div class="col-md-2">
									<label for="USR_USERNAME" class="form-control-label wf-right">Username </label>
								</div>
								<div class="col-md-4">
									<?php echo $rec['USR_USERNAME']; ?>
									<!--<input type="text" id="USR_USERNAME" name="USR_USERNAME" class="form-control text-lowercase" value="<?php echo $rec['USR_USERNAME']; ?>" required onblur="chk_username(this.value)">-->
								</div>
							</div>
							<!---->
							<div class="form-group row">
								<div class="col-md-2">
									<label for="USR_PASSWORD" class="form-control-label wf-right">Password </label>
								</div>
								<div class="col-md-4">
									******** <button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#bizModal" title="แก้ไข Password" onclick="open_modal('change_password_profile_form.php?process=change_password&id=<?php echo $rec["USR_ID"];?>','เปลี่ยนรหัสผ่าน');"><i class="icofont icofont-edit-alt"></i></button>
									
								</div>
							</div>
							<!---->
							
							
							
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="wf-right">&nbsp;
						<button type="submit" class="btn btn-md btn-success active waves-effect waves-light">
							<i class="icofont icofont-tick-mark"></i> บันทึก
						</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="main-header">
				</div>
			</div>
		</form>
		<!-- Container-fluid ends -->
	</div>
</div>
<script>
	$(".mobile").inputmask({ mask: "999-999-9999"});
	function chk_password()
	{
		var pass1 = $('#USR_PASSWORD').val();
		var pass2 = $('#USR_PASSWORD2').val();

		if(pass1 !== pass2)
		{
			$('#USR_PASSWORD, #USR_PASSWORD2').val('');
			$('button[type=submit]').prop('disabled', true);
			swal('ERROR', 'รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบ', 'error');
			return false;
		}
		else
		{
			$('button[type=submit]').prop('disabled', false);
		}
	}

	function chk_username(username)
	{
		var url = "ajax_function.php?process=chk_username";
		var dataString = {username: username, id : '<?php echo $id; ?>'};
		$.get(url, dataString, function(msg){
			if(msg > 0)
			{
				$('#USR_USERNAME').val('').focus();
				$('button[type=submit]').prop('disabled', true);
				swal('ERROR', 'Username นี้ถูกใช้ไปแล้ว กรุณาตรวจสอบ', 'error');
				return false;
			}
			else
			{
				$('button[type=submit]').prop('disabled', false);
			}
		});
	}
</script>