<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';


if (isset($_FILES['CMD_FILE_NAME'])) {
	// ข้อมูลของไฟล์ที่ถูกอัปโหลด
	$fileInfo = $_FILES['CMD_FILE_NAME'];

	// รายชื่อประเภท MIME ที่ยอมรับ (เฉพาะไฟล์เอกสารและรูปภาพ)
	$allowedMimeTypes = array(
		'application/pdf',
		'image/jpeg',
		'image/png',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
		// คุณสามารถเพิ่มประเภท MIME อื่น ๆ ที่คุณต้องการยอมรับได้
	);

	// ตรวจสอบว่าประเภท MIME ของไฟล์ที่ถูกอัปโหลดอยู่ในรายชื่อที่ยอมรับหรือไม่
	if (in_array($fileInfo['type'][0], $allowedMimeTypes)) {
		/* ?>
		<script>
			alert('ไฟล์ถูกต้อง');
		</script>
		<?php  */
		//echo 'ไฟล์ถูกต้อง: ' . $fileInfo['name'][0];
		// ทำรายการอื่น ๆ ที่คุณต้องการ
	} else {
?>
		<script>
			alert('ประเภทไฟล์ไม่ถูกต้อง ไม่สามารถอัพโหลดได้');
		</script>
	<?php
		//echo 'ประเภทไฟล์ไม่ถูกต้อง: ' . $fileInfo['name'][0];
		exit;
		// ทำรายการอื่น ๆ ที่คุณต้องการในกรณีที่ประเภทไฟล์ไม่ถูกต้อง
	}
}

/* print_r($_FILES);
exit; */

$W = conText($_POST['W']);
$WFR = conText($_POST['WFR']);
$WFR_ID = conText($_POST['WFR_ID']);
$F_TEMP_ID = conText($_POST['F_TEMP_ID']);
$F_TEMP_ID2 = conText($_POST['F_TEMP_ID2']);
$WFD = conText($_POST['WFD']);
$WFS = conText($_POST['WFS']);
if ($W != "") {

	$sql_main = db::query("select * from WF_MAIN where WF_MAIN_ID = '" . $W . "'");
	$rec_main = db::fetch_array($sql_main);
	$wf_table = $rec_main["WF_MAIN_SHORTNAME"];
	$WF_TYPE = $rec_main['WF_TYPE'];
	$pk_name = $rec_main["WF_FIELD_PK"];
	$update_wf = array();
	$wf_cond = array();

	$sql_wfs = db::query("select WF_MAIN_ID from WF_STEP_FORM where WFS_ID = '" . $WFS . "'");
	$rec_wfs = db::fetch_array($sql_wfs);

	if ($WFR == "") { //new data
		$insert_wf = array();
		$insert_wf["WF_MAIN_ID"] = $rec_wfs['WF_MAIN_ID'];
		$insert_wf["WFD_ID"] = $WFD;
		$insert_wf["WFR_ID"] = $WFR_ID;
		$insert_wf["WFS_ID"] = $WFS;
		$insert_wf["F_TEMP_ID"] = $F_TEMP_ID2;
		$insert_wf["F_CREATE_DATE"] = date2db(date("d/m/") . (date("Y") + 543));
		$insert_wf["F_CREATE_BY"] = $_SESSION['WF_USER_ID'];
		$WFR = db::db_insert($wf_table, $insert_wf, $pk_name);
		unset($insert_wf);
		$FLAG_ADD = "Y";
	}

	$insert_step = array();

	$update_wf = bsf_save_form($W, $WFD, $WFR, $WF_TYPE, $update_wf, $FLAG_ADD, $WFS);

	$wf_cond[$pk_name] = $WFR;
	db::db_update($wf_table, $update_wf, $wf_cond);
	unset($update_wf);
	unset($wf_cond);
	//echo "ssss";

	if ($_POST["WF_POP"] == "P") { //$WF_TARGRT = ".opener"; 
	}
	?>
	<script type="text/javascript" src="../assets/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
		function get_wfs_show1(obj_target, url, dataString, w_method, show) {
			console.log(obj_target)
			console.log(url)
			console.log(dataString)
			console.log(w_method)
			console.log(show)
			if (w_method == "") {
				w_method = "GET";
			}
			if (show == "") {
				show = "W";
			}
			$.ajax({
				type: w_method,
				url: url,
				data: dataString,
				cache: false,
				success: function(data) {

					if (show == 'A') {
						<?php if ($_POST["WF_POP"] == "P") { ?>
							window.top.opener.$('#' + obj_target).append(data);
							top.close();
						<?php } else { ?>
							parent.$('#' + obj_target).append(data);
						<?php } ?>
					} else {
						<?php if ($_POST["WF_POP"] == "P") { ?>
							window.top.opener.$('#' + obj_target).html(data);
							top.close();
						<?php } else { ?>
							parent.$('#' + obj_target).html(data);
						<?php } ?>
					}
				}
			});
		}

		get_wfs_show1('WFS_FORM_<?php echo $WFS; ?>', '../workflow/form_main.php', 'W=<?php echo $W; ?>&WFD=<?php echo $WFD; ?>&WFS=<?php echo $WFS; ?>&WFR=<?php echo $WFR_ID; ?>&F_TEMP_ID=<?php echo $F_TEMP_ID2; ?>', 'GET');
		<?php
		$sql_java = db::query("SELECT WFS_INPUT_EVENT,WFS_JAVASCRIPT_EVENT FROM WF_STEP_FORM where WFS_ID = '" . $WFS . "' ");
		$WS = db::fetch_array($sql_java);
		if ($WS['WFS_INPUT_EVENT'] == "change") {
		?>
			<?php echo htmlspecialchars_decode($WS['WFS_JAVASCRIPT_EVENT'], ENT_QUOTES); ?>
		<?php
		}
		if ($_POST["WF_POP"] != "P") { ?>
			parent.$('#bizModal_<?php echo $WFS; ?>').modal('hide');
		<?php } ?>
	</script>
<?php
}
db::db_close();
?>