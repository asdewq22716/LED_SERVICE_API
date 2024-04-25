<?php 
session_start();
include "../include/include.php";

$arrSystemName = array(1=>"ระบบงานบังคับคดีแพ่ง",2=>"ระบบงานบังคับคดีล้มละลาย",3=>"ระบบงานฟื้นฟูกิจการของลูกหนี้",4=>"ระบบงานไกล่เกลี่ยข้อพิพาท",5=>"ระบบ Back office");

$tbName = "USER_API_SERVICE";
$tbServiceMappingGroup = 'SERVICE_MAPPING_GROUP';

if (isset($_POST['process'])) {
	$process = $_POST['process'];
	$USR_ID = $_POST['USR_ID'];
	$ID_CARD = trim($_POST['ID_CARD']);
	$USR_PREFIX = $_POST['USR_PREFIX'];
	$USR_PREFIX_ID = $_POST['USR_PREFIX_ID'];
	$USR_FNAME = conText(trim($_POST['USR_FNAME']));
	$USR_LNAME = conText(trim($_POST['USR_LNAME']));
	$SYSTEM_TYPE = $_POST['SYSTEM_TYPE'];
	$USR_EMAIL = trim($_POST['USR_EMAIL']);
	$USR_USERNAME = conText(trim($_POST['USR_USERNAME']));
	$USR_PASSWORD = conText(trim($_POST['USR_PASSWORD']));
	$USER_STATUS = $_POST['USER_STATUS'];
	$EDIT_PAAWORD_STATUS = $_POST['EDIT_PAAWORD_STATUS'];
	//$SERVICE_MANAGE_ID = $_POST['SERVICE_MANAGE_ID'];
	$API_SETTING_ID = $_POST['API_SETTING_ID'];

	$SERVICE_MANAGE_ID=[];
	$API_SETTING_DATA=[];
	if(count($API_SETTING_ID)){
		foreach($API_SETTING_ID as $sid => $setting){
			
			$SERVICE_MANAGE_ID[]=$sid;

			if(count($setting)){
				foreach($setting as $setid){
					$API_SETTING_DATA[]=$setid;
				}
			}
		}
	}
	
	$sql_data = db::query("SELECT USR_PREFIX, USR_PREFIX_ID, ID_CARD, USR_FNAME, USR_LNAME, SYSTEM_TYPE, USR_EMAIL, USR_USERNAME, USER_STATUS, SERVICE_MANAGE_ID,API_SETTING_ID FROM ".$tbName." WHERE USR_ID = '".$USR_ID."'");
	$rec_data = db::fetch_array($sql_data);

	if ($process == "getDataUserSub" || $process == 'addUserSub') {
		if (isset($_SESSION['PERMISSION_GROUP_ID'])) {
			$sql = "SELECT 
						$tbServiceMappingGroup.SERVICE_MANAGE_ID,
						M_API_SETTING.API_SETTING_ID,
						M_API_SETTING.SERVICE_LIST,
						M_API_SETTING.API_DESC
					FROM 
						$tbServiceMappingGroup INNER JOIN
						M_API_SETTING ON M_API_SETTING.API_SETTING_ID=$tbServiceMappingGroup.API_SETTING_ID
					WHERE 
						PRIVILEGE_GROUP_ID = '" . $_SESSION['PERMISSION_GROUP_ID'] . "' 
					ORDER BY 
						SERVICE_MANAGE_ID ASC";
			$qry_permission = db::query($sql);
			$permission_id = "";
			while ($rec_permission = db::fetch_array($qry_permission)) {
				if (empty($permission_id)) {
					$permission_id .= $rec_permission['SERVICE_MANAGE_ID'];
				} else {
					$permission_id .= "," . $rec_permission['SERVICE_MANAGE_ID'];
				}

				$permission_setting_id[$rec_permission['SERVICE_MANAGE_ID']][] = $rec_permission;
			}
		}
		if (!empty($permission_id)) {
			$filter = " AND SERVICE_MANAGE_ID IN ($permission_id)";
		} else {
			if (empty($_SESSION)) {
				$filter = "AND 1 = 1";
			} else {
				$filter = "AND 1 != 1";
			}
		}

		$arr_service = array();
		$civil_service = db::query("SELECT SERVICE_MANAGE_ID, SERVICE_NAME||' : '||SERVICE_DESC as SERVICE_NAME FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานบังคับคดีแพ่ง'  AND SERVICE_STATUS = '1'{$filter}");
		while ($rec_service = db::fetch_array($civil_service)) {
			$arr_service[1][$rec_service['SERVICE_MANAGE_ID']] = $rec_service['SERVICE_NAME'];
		}
		$bank_service = db::query("SELECT SERVICE_MANAGE_ID, SERVICE_NAME||' : '||SERVICE_DESC as SERVICE_NAME FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานบังคับคดีล้มละลาย' AND SERVICE_STATUS = '1' {$filter}");
		while ($rec_service = db::fetch_array($bank_service)) {
			$arr_service[2][$rec_service['SERVICE_MANAGE_ID']] = $rec_service['SERVICE_NAME'];
		}
		$revive_service = db::query("SELECT SERVICE_MANAGE_ID, SERVICE_NAME||' : '||SERVICE_DESC as SERVICE_NAME FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานฟื้นฟูกิจการของลูกหนี้' AND SERVICE_STATUS = '1' {$filter}");
		while ($rec_service = db::fetch_array($revive_service)) {
			$arr_service[3][$rec_service['SERVICE_MANAGE_ID']] = $rec_service['SERVICE_NAME'];
		}
		$mediate_service = db::query("SELECT SERVICE_MANAGE_ID, SERVICE_NAME||' : '||SERVICE_DESC as SERVICE_NAME FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานไกล่เกลี่ยข้อพิพาท' AND SERVICE_STATUS = '1' {$filter}");
		while ($rec_service = db::fetch_array($mediate_service)) {
			$arr_service[4][$rec_service['SERVICE_MANAGE_ID']] = $rec_service['SERVICE_NAME'];
		}
		$back_service = db::query("SELECT SERVICE_MANAGE_ID, SERVICE_NAME||' : '||SERVICE_DESC as SERVICE_NAME FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบ Back office' AND SERVICE_STATUS = '1' {$filter}");
		while ($rec_service = db::fetch_array($back_service)) {
			$arr_service[5][$rec_service['SERVICE_MANAGE_ID']] = $rec_service['SERVICE_NAME'];
		}
		$a_v = explode(",", $rec_data['API_SETTING_ID']);
		foreach ($a_v as $k => $v) {
			$arrDataApiService[$v] = $v;
		}
?>
		<div class="form-row">
			<div class="form-group col-md-6 col-sm-6">
				<label for="ID_CARD" class=" title-label">เลขประจำตัวประชาชน *</label>
				<input type="text" name="ID_CARD" id="ID_CARD" required class="single-input idcard " value="<?php echo $rec_data['ID_CARD']; ?>">
				<?php /* echo str_replace("-", "", $rec_data['ID_CARD']); */ ?>
			</div>

			<?php if ($process == "getDataUserSub" ) { ?>
				<div class="form-group col-md-6 col-sm-6">
					<label for="SYSTEM_TYPE" class=" title-label">หน่วยงาน/บริษัท/อื่นๆ *</label>
					<select class="js-example-basic-single" name="SYSTEM_TYPE" id="SYSTEM_TYPE" required disabled>
						<option value="">เลือก</option>
						<?php
						$sql_sys = db::query("SELECT SYSTEM_ID, SYS_NAME FROM M_SYSTEM WHERE SYS_TYPE = 2 AND SYS_STATUS = 1");
						while ($row = db::fetch_array($sql_sys)) { ?>
							<option value="<?php echo $row['SYSTEM_ID']; ?>" <?php echo $rec_data['SYSTEM_TYPE'] == $row['SYSTEM_ID'] ? "selected" : ""; ?>><?php echo $row['SYS_NAME']; ?></option>
						<?php } ?>
					</select>
				</div>
			<?php }else if($process == 'addUserSub') { ?>
				<div class="form-group col-md-6 col-sm-6">
					<label for="SYSTEM_TYPE" class=" title-label">หน่วยงาน/บริษัท/อื่นๆ *</label>
					<select class="js-example-basic-single" name="SYSTEM_TYPE" id="SYSTEM_TYPE" required>
						<option value="">เลือก</option>
						<?php
						$sql_sys = db::query("SELECT SYSTEM_ID, SYS_NAME FROM M_SYSTEM WHERE SYS_TYPE = 2 AND SYS_STATUS = 1 and SYSTEM_ID = '" . $_SESSION["SYSTEM_TYPE"] . "' ");
						while ($row = db::fetch_array($sql_sys)) { ?>
							<option value="<?php echo $row['SYSTEM_ID']; ?>" <?php echo $_SESSION['SYSTEM_TYPE'] == $row['SYSTEM_ID'] ? "selected" : ""; ?>><?php echo $row['SYS_NAME']; ?></option>
						<?php } ?>
					</select>
				</div>
			<?php } ?>

		</div>
		<div class="form-row">
			<div class="form-group col-md-6 col-sm-6">
				<label for="USR_PREFIX" class=" title-label">คำนำหน้าชื่อ*</label>
				<div>
					<select class="js-example-basic-single" name="USR_PREFIX" id="USR_PREFIX" required>
						<option value="">เลือก</option>
						<?php
						$prefix = '';
						$sql_pre = db::query("SELECT P_ID, P_NAME_BOF FROM M_PREFIX_MAP ORDER BY P_ID DESC");
						while ($pre_name = db::fetch_array($sql_pre)) { ?>
							<option value="<?php echo $pre_name['P_NAME_BOF']; ?>" <?php echo $rec_data['USR_PREFIX_ID'] == $pre_name['P_ID'] ? "selected" : ""; ?> data-val="<?php echo $pre_name['P_ID']; ?>"><?php echo $pre_name['P_NAME_BOF']; ?></option>
						<?php
							if ($rec_data['USR_PREFIX_ID'] == $pre_name['P_ID']) {
								$prefix =  $pre_name['P_ID'];
							}
						}
						?>
					</select>
				</div>
				<input type="hidden" name="USR_PREFIX_ID" id="USR_PREFIX_ID" value="<?php echo $prefix; ?>">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6 col-sm-6">
				<label for="USR_FNAME" class=" title-label">ชื่อ *</label>
				<input type="text" name="USR_FNAME" id="USR_FNAME" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required class="single-input" value="<?php echo conTextD($rec_data['USR_FNAME']); ?>">
			</div>
			<div class="form-group col-md-6 col-sm-6">
				<label for="USR_LNAME" class=" title-label">นามสกุล *</label>
				<input type="text" name="USR_LNAME" id="USR_LNAME" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required class="single-input" value="<?php echo conTextD($rec_data['USR_LNAME']); ?>">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6 col-sm-6">
				<label for="USR_EMAIL" class=" title-label">อีเมล *</label>
				<input type="text" name="USR_EMAIL" id="USR_EMAIL_EDIT" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required class="single-input email " value="<?php echo $rec_data['USR_EMAIL']; ?>">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6 col-sm-6">
				<label for="USR_USERNAME" class=" title-label">บัญชีผู้ใช้ *</label>
				<input type="text" name="USR_USERNAME" id="USR_USERNAME" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required class="single-input" value="<?php echo conTextD($rec_data['USR_USERNAME']); ?>">
			</div>

			<?php if ($process == "getDataUserSub") { ?>
				<div class="form-group col-md-6 col-sm-5">
					<label for="inputlastnameen" class=" title-label">พาสเวิร์ด *</label>
					<input type="password" autocomplete="off" name="USR_PASSWORD" id="USR_PASSWORD" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required class="single-input" value="********" disabled>
					<input name="EDIT_PAAWORD_STATUS" id="EDIT_PAAWORD_STATUS" chk-id="EDIT_PAAWORD_STATUS" chk-value="Y" type="checkbox" value="Y">
					<label for="EDIT_PAAWORD_STATUS">แก้ไขรหัสผ่าน</label>
				</div>
			<?php } else if ($process == 'addUserSub') { ?>
				<div class="form-group col-md-6 col-sm-5">
					<label for="inputlastnameen" class=" title-label">พาสเวิร์ด *</label>
					<input type="password" autocomplete="off" name="USR_PASSWORD" id="USR_PASSWORD" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required class="single-input" value="">
				</div>
			<?php } ?>
			
		</div>
		<div class="form-row">
			<div class="form-group col-md-6 col-sm-6">
				<div class="form-radio d-flex">
					<div class="radio radio-inline mr-2">
						<label><input type="radio" name="USER_STATUS" id="USER_STATUS" value="1" <?php echo $rec_data['USER_STATUS'] == 1 ? "checked" : ""; ?>><i class="helper"></i> ใช้งาน</label>
					</div>
					<div class="radio radio-inline mr-2">
						<label><input type="radio" name="USER_STATUS" id="USER_STATUS" value="0" <?php echo $rec_data['USER_STATUS'] == 0 ? "checked" : ""; ?>><i class="helper"></i> ไม่ใช้งาน</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12 col-sm-12">
				<label for="inputlastnameen" class=" title-label">API SERVICE LIST PERMISSION</label>
				<?php
				foreach ($arr_service as $system => $data) {
				?>
					<div class="row col-md-12 col-sm-12 align-items-center"><strong><?php echo $arrSystemName[$system]; ?></strong></div>
					<?php
					foreach ($data as $serId => $serName) {

					?>
						<div class="row col-md-12 col-sm-12 align-items-center">
							<label for="SERVICE_MANAGE_ID_<?php echo $serId; ?>" class="ml-2 mb-0"><?php echo $serName; ?></label>

							<?php foreach ($permission_setting_id[$serId] as $key => $setting) { ?>
								<?php $chk = in_array($setting['API_SETTING_ID'], $arrDataApiService) ? "checked" : ""; ?>

								<div class="row col-md-12 col-sm-12 align-items-center" style="padding-left:35px">

									<input name="API_SETTING_ID[<?php echo $serId; ?>][<?php echo $setting['API_SETTING_ID']; ?>]" id="API_SETTING_ID<?php echo $serId; ?>_<?php echo $setting['API_SETTING_ID']; ?>" chk-id="API_SETTING_ID<?php echo $serId; ?>_<?php echo $setting['API_SETTING_ID']; ?>" chk-value="<?php echo $setting['API_SETTING_ID']; ?>" type="checkbox" value="<?php echo $setting['API_SETTING_ID']; ?>" <?php echo $chk; ?>>

									<label for="API_SETTING_ID<?php echo $serId; ?>_<?php echo $setting['API_SETTING_ID']; ?>" class="ml-2 mb-0">
										<?php echo $setting['SERVICE_LIST'] . ' ' . $setting['API_DESC']; ?>
									</label>

								</div>
							<?php } ?>
						</div>
				<?php }
				} ?>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.js-example-basic-single').select2();
				$("#EDIT_PAAWORD_STATUS").change(function() {
					if ($(this).is(':checked')) {
						$("#USR_PASSWORD").prop("disabled", false);
						$("#USR_PASSWORD").val("");
					} else {
						$("#USR_PASSWORD").prop("disabled", true);
					}
				});
			});
			$('#USR_PREFIX').change(function(){
				var selectElement = document.getElementById("USR_PREFIX");
				var selectedIndex = selectElement.selectedIndex;
				var selectedOption = selectElement.options[selectedIndex];
				var attributeValue = selectedOption.getAttribute("data-val");
				$('#USR_PREFIX_ID').val(attributeValue);
			});
		</script>
<?php
	}

	if($process == "update"){

		$data = array(
			'ID_CARD' => $ID_CARD,
			'USR_PREFIX' => $USR_PREFIX,
			'USR_PREFIX_ID' => $USR_PREFIX_ID,
			'USR_FNAME' => $USR_FNAME,
			'USR_LNAME' => $USR_LNAME,
			'USR_LNAME' => $USR_LNAME,
			'USR_EMAIL' => $USR_EMAIL,
			'USR_USERNAME' => $USR_USERNAME,
			'USER_STATUS' => $USER_STATUS,
			'SERVICE_MANAGE_ID' => implode(",", $SERVICE_MANAGE_ID),
			'API_SETTING_ID' => implode(",", $API_SETTING_DATA),
		);
		if($EDIT_PAAWORD_STATUS == "Y"){
			$data['USR_PASSWORD'] = md5($USR_PASSWORD);
		}
		db::db_update($tbName, $data, array('USR_ID' => $USR_ID));
	}
	
	if($process == "insert"){
		
		$sqlSelectToken = "select TOKEN_ID,PERMISSION_GROUP_ID from {$tbName} where USR_ID = '".$_SESSION["USR_ID"]."' ";
		$querySelectToken = db::query($sqlSelectToken);
		$recSelectToken = db::fetch_array($querySelectToken);
		
		$data = array(
			'SYSTEM_TYPE' => $SYSTEM_TYPE,
			'ID_CARD' => $ID_CARD,
			'USR_PREFIX' => $USR_PREFIX,
			'USR_PREFIX_ID' => $USR_PREFIX_ID,
			'USR_FNAME' => $USR_FNAME,
			'USR_LNAME' => $USR_LNAME,
			'USR_LNAME' => $USR_LNAME,
			'USR_EMAIL' => $USR_EMAIL,
			'USR_USERNAME' => $USR_USERNAME,
			'USER_STATUS' => $USER_STATUS,
			'GROUP_ID' => 2,
			'USER_MAIN' => 'N',
			'TOKEN_ID' => $recSelectToken["TOKEN_ID"],
			'PERMISSION_GROUP_ID' => $recSelectToken["PERMISSION_GROUP_ID"],
			'SERVICE_MANAGE_ID' => implode(",", $SERVICE_MANAGE_ID),
			'API_SETTING_ID' => implode(",", $API_SETTING_DATA),
			'USR_PASSWORD' => md5($USR_PASSWORD)
		);
		db::db_insert($tbName, $data,'USR_ID');
	}

	if($process == "del"){
		$data = array(
			'USER_STATUS' => 0
		);
		db::db_update($tbName, $data, array('USR_ID' => $USR_ID));
	}
}
?>


<script>
	function valid2EMail(mailObj) {
		if (validLength(mailObj, 1, 50)) {
			//return false;
			if (mailObj.search("^.+@.+\\..+$") != -1)
				return true;
			else return false;
		}
		return true;
	}

	function validLength(item, min, max) {
		return (item.length >= min) && (item.length <= max)
	}

	$(".wf_check_dup").blur(function() {
		var id_len = $(this).val().length;
		var chk_name = $(this).attr('name');
		var chk_val = $(this).val();
		var id = $(this).attr('id');
		if (id_len > 0) {
			var dataString = 'W=97&WFR=&FIELD_N=' + chk_name + '&val=' + chk_val;
			$.ajax({
				type: "POST",
				url: "../workflow/load_dup.php",
				data: dataString,
				cache: false,
				success: function(data) {
					if (data == "D") {
						$('#' + id).val('');
						alert('ข้อมูลนี้มีอยู่แล้วในระบบ');
					} else {}
				}
			});
		}
	});

	$(".email").blur(function() {
		var id = $(this).attr('id');
		var em_len = $('#' + id).val().length;
		if (em_len > 0) {
			if (valid2EMail($(this).val())) {} else {
				alert('อีเมล ไม่ถูกต้อง');
				$('#' + id).val('');
			}
		} else {
			alert('อีเมล ไม่ถูกต้อง');
		}
	});
</script>