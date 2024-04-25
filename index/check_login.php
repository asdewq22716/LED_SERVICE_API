<?php
//$hide_header = 'Y';
//include '../include/comtop_user.php';
session_start();

include '../include/config.php';

$date = date('d/m/').(date('Y')+543);
$save = isset($_POST['save']) ? conText($_POST['save']) : '';
$PERMISSION_I = isset($_POST['PERMISSION_I']) ? conText($_POST['PERMISSION_I']) : '';
$str = '';
$arr_field = array();
$arr_session = array();
if($_SESSION["TEMP_WF_USER_ID"] != ''){
	$str = '';
	$str_arr = array();
	$sql_usr = db::query("SELECT * FROM USR_MAIN WHERE USR_ID='".$_SESSION["TEMP_WF_USER_ID"]."' ");
	$usr = db::fetch_array($sql_usr);

	$sql_permission = db::query("SELECT * FROM PERMISSION_INSTEAD WHERE USR_ID='".$usr["USR_ID"]."' AND '".date2db($date)."' BETWEEN PI_STARTDATE AND PI_ENDDATE");
	$p = db::fetch_array($sql_permission);
	
	$sql = db::query("SELECT * FROM USR_SETTING WHERE ((FIELD_TYPE='O') OR (FIELD_TYPE='S' AND (FIELD_NAME = 'DEP_ID' OR FIELD_NAME='POS_ID')))  ORDER BY FIELD_ID");
	
	while($rec_o = db::fetch_array($sql)){
		if($p[$rec_o["FIELD_NAME"]] != ''){
			$arr_field = show_user_detail($p,$rec_o["FIELD_NAME"]);
			$str .= $arr_field['label'].' '.$arr_field["value"].' ';
			array_push($str_arr, $arr_field['label'].' '.$arr_field["value"]);
			$arr_session[$rec_o["FIELD_NAME"]] = $p[$rec_o["FIELD_NAME"]];
		}
		
	}
	
	
	
	if($save == ''){
	?>
		<div class="container-fluid">
	<form action="check_login_function.php" method="post" class="md-float-material" >
		<h4 class="text-center txt-primary">
			ยินดีต้อนรับสู่ระบบ <span class="txt-warning f-bold">Biz</span><span class="text-muted f-bold">SmartFlow</span>
		</h4>
		<h6 class="txt-success" style="margin-top: 20px;">
			เลือกสิทธิ์การเข้าใช้งาน
		</h6>
		<div class="row" style="margin-top: 20px;">
			<div class="col-sm-12">
				<div class="form-radio">
					<div class="radio">
						<label>
							<input type="radio" name="PERMISSION_I" id="PERMISSION_I" value="O" checked>

							<i class="helper"></i> สิทธิ์ของ <?php echo $usr["USR_PREFIX"].$usr["USR_FNAME"].' '.$usr["USR_LNAME"];?>
						</label>
					</div>
					<div class="radio radio-inline">
						<label>
							<input type="radio" name="PERMISSION_I" id="PERMISSION_I" value="H">
							<i class="helper"></i>
							สิทธิ์
							<ul style="list-style: inherit;">
								<?php foreach($str_arr as $_val){ ?>
								<li style="margin-left: 15px;"><?php echo $_val; ?></li>
								<?php } ?>
							</ul>
							<?php //echo 'สิทธิ์'.$str;?>
						</label>
					</div>
				</div>
				<div class="row" style="margin-top: 30px;">
					<div class="col-md-12 text-center">
						<input type="submit" name="btnSave" id="btnSave" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" value="เข้าสู่ระบบ" />
						<br>
						<button type="button" name="btnSave" id="btnSave" class="btn btn-warning btn-md btn-block waves-effect text-center m-b-20" onclick="back_to_login();">ย้อนกลับ</button>

						<input type="hidden" name="save" id="save" value="Y">
					</div>
				</div>
			</div>
		</div>
	</form>
		</div>
		<?php
	}
}
?>