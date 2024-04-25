<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 1); */
include "../include/include.php";
include "../service/check_case_Function.php";
include "../include/func_Nop.php";
if ($_POST["COURT_CODE"] == "050") {
	$_POST["COURT_CODE"] = "010030";
}

if ($_POST["proc"] == "getPerson") {

	$filter = "";
	if ($_POST["T_BLACK_CASE"] != "") {
		$filter .= " and PREFIX_BLACK_CASE = '" . $_POST['T_BLACK_CASE'] . "'	";
	}
	if ($_POST["BLACK_CASE"] != "") {
		$filter .= " and BLACK_CASE = '" . $_POST['BLACK_CASE'] . "'	";
	}
	if ($_POST["BLACK_YY"] != "") {
		$filter .= " and BLACK_YY = '" . $_POST['BLACK_YY'] . "'	";
	}
	if ($_POST["T_RED_CASE"] != "") {
		$filter .= " and PREFIX_RED_CASE = '" . $_POST['T_RED_CASE'] . "'	";
	}
	if ($_POST["RED_CASE"] != "") {
		$filter .= " and RED_CASE = '" . $_POST['RED_CASE'] . "'	";
	}
	if ($_POST["RED_YY"] != "") {
		$filter .= " and RED_YY = '" . $_POST['RED_YY'] . "'	";
	}
	if ($_POST["COURT_CODE"] != "") {
		$filter .= " and COURT_CODE = '" . $_POST['COURT_CODE'] . "'	";
	}


	if ($_POST["SYSTEM_ID"] == 1) { //ระบบงานบังคับคดีแพ่ง
		$sqlSelectData = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Mediate' as SYSTEM_TYPE
							from 		" . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " a
							where 		1=1 {$filter}
							";
	} else if ($_POST["SYSTEM_ID"] == 2) { //ระบบงานบังคับคดีล้มละลาย
		$sqlSelectData = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Bankrupt' as SYSTEM_TYPE
							from 		WH_BANKRUPT_CASE_PERSON a 
							where 		1=1 {$filter}";
	} else if ($_POST["SYSTEM_ID"] == 3) { //ระบบงานฟื้นฟูกิจการของลูกหนี้
		$sqlSelectData = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Revive' as SYSTEM_TYPE
							from 		WH_REHABILITATION_PERSON a
							where 		1=1 {$filter}";
	} else if ($_POST["SYSTEM_ID"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
		$sqlSelectData = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Civil' as SYSTEM_TYPE
							from 		WH_MEDIATE_PERSON a
							where 		1=1 {$filter}";
	} else if ($_POST["SYSTEM_ID"] == 5) { //ระบบงานไกล่เกลี่ยข้อพิพาท
		$filter = "";
		if ($_POST["GET_PER_TYPE"] == 1) {
			if ($_POST["GET_PER_CASE"] != "") {
				$filter = " AND USR_OPTION9 = '" . $_POST["GET_PER_CASE"] . "' ";
			}
			$sqlSelectData = "	select 		USR_OPTION9 as REGISTER_CODE,USR_PREFIX as PREFIX_NAME,USR_FNAME as FIRST_NAME,USR_LNAME as LAST_NAME,'' as CONCERN_CODE,'' as CONCERN_NAME,USR_OPTION9 as REGISTER_CODE,'' as PREFIX_BLACK_CASE,'' as BLACK_CASE,'' as BLACK_YY,'' as PREFIX_RED_CASE,'' as RED_CASE,'' as RED_YY,'' as COURT_NAME,'' as COURT_CODE,'' as ADDRESS,'' as TUM_NAME,'' as AMP_NAME,'' as PROV_NAME,'' as ZIP_CODE,'Backoffice' as SYSTEM_TYPE
								from 		USR_MAIN a
								where 		1=1 {$filter}";
		} else {
			if ($_POST["GET_PER_CASE"] != "") {
				$filter = " AND WH_CREDITOR_ID_CARD = '" . $_POST["GET_PER_CASE"] . "' ";
			}
			$sqlSelectData = "	select 		WH_CREDITOR_ID_CARD as REGISTER_CODE,WH_CREDITOR_PREFIX as PREFIX_NAME,WH_CREDITOR_FNAME as FIRST_NAME,WH_CREDITOR_LNAME as LAST_NAME,'' as CONCERN_CODE,WH_CREDITOR_ID_CARD as CONCERN_NAME,WH_CREDITOR_ID_CARD as REGISTER_CODE,'' as PREFIX_BLACK_CASE,'' as BLACK_CASE,'' as BLACK_YY,'' as PREFIX_RED_CASE,'' as RED_CASE,'' as RED_YY,'' as COURT_NAME,'' as COURT_CODE,'' as ADDRESS,'' as TUM_NAME,'' as AMP_NAME,'' as PROV_NAME,'' as ZIP_CODE,'Backoffice' as SYSTEM_TYPE
								from 		WH_CREDITOR a
								where 		1=1 {$filter}";
		}
	}
?>
	<option value=""></option>
	<?php
	$querySelectData = db::query($sqlSelectData);
	while ($recSelectData = db::fetch_array($querySelectData)) {
	?>
		<option value="<?php echo $recSelectData["REGISTER_CODE"] ?>" GET_PREFIX_NAME="<?php echo $recSelectData["PREFIX_NAME"]; ?>" GET_FIRST_NAME="<?php echo $recSelectData["FIRST_NAME"]; ?>" GET_LAST_NAME="<?php echo $recSelectData["LAST_NAME"]; ?>"><?php echo $recSelectData["CONCERN_NAME"] . " : " . $recSelectData["PREFIX_NAME"] . $recSelectData["FIRST_NAME"] . " " . $recSelectData["LAST_NAME"] ?></option>
	<?php
	}
	?>
<?php
}

if ($_POST["proc"] == "getPersonJson") {
	$filter = "";
	if ($_POST["T_BLACK_CASE"] != "") {
		$filter .= " and PREFIX_BLACK_CASE = '" . trim($_POST['T_BLACK_CASE']) . "'	";
		$filter1 .= " and xx.PREFIX_BLACK_CASE = '" . trim($_POST['T_BLACK_CASE']) . "'	";
	}
	if ($_POST["BLACK_CASE"] != "") {
		$filter .= " and BLACK_CASE = '" . trim($_POST['BLACK_CASE']) . "'	";
		$filter1 .= " and xx.BLACK_CASE = '" . trim($_POST['BLACK_CASE']) . "'	";
	}
	if ($_POST["BLACK_YY"] != "") {
		$filter .= " and BLACK_YY = '" . trim($_POST['BLACK_YY']) . "'	";
		$filter1 .= " and xx.BLACK_YY = '" . trim($_POST['BLACK_YY']) . "'	";
	}
	if ($_POST["T_RED_CASE"] != "") {
		$filter .= " and PREFIX_RED_CASE = '" . trim($_POST['T_RED_CASE']) . "'	";
		$filter1 .= " and xx.PREFIX_RED_CASE = '" . trim($_POST['T_RED_CASE']) . "'	";
	}
	if ($_POST["RED_CASE"] != "") {
		$filter .= " and RED_CASE = '" . trim($_POST['RED_CASE']) . "'	";
		$filter1 .= " and xx.RED_CASE = '" . trim($_POST['RED_CASE']) . "'	";
	}
	if ($_POST["RED_YY"] != "") {
		$filter .= " and RED_YY = '" . trim($_POST['RED_YY']) . "'	";
		$filter1 .= " and xx.RED_YY = '" . trim($_POST['RED_YY']) . "'	";
	}
	if ($_POST["COURT_CODE"] != "") {
		$filter .= " and COURT_CODE = '" . trim($_POST['COURT_CODE']) . "'	";
		$filter1 .= "and xx.COURT_CODE = '" . trim($_POST['COURT_CODE']) . "'	";
	}
	$arrPerson = array();

	if ($_POST["SYSTEM_ID"] == 1) { //ระบบงานบังคับคดีแพ่ง
		/* 	$sqlSelectData = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Mediate' as SYSTEM_TYPE
							from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
							where 		1=1 {$filter}
							order by 	CONCERN_CODE asc
							"; */
		$fill = "AND NOT EXISTS  (
			SELECT
				xx.WH_PERSON_ID
			FROM
			" . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " xx
			WHERE 1=1
			{$filter1}
				AND xx.WH_PERSON_ID=a.WH_PERSON_ID
				AND xx.CONCERN_CODE='11')"; //ไม่เอาผู้ถือกรรมสิทธ์ ที่มี13หลักซ้ำกับโจทก์เเละจำเลย
		function add_groupby($sql)
		{
			$A = "SELECT 
								x1.REGISTER_CODE,
								x1.PREFIX_NAME,
								x1.FIRST_NAME,
								x1.LAST_NAME,
								x1.CONCERN_CODE,
								x1.CONCERN_NAME
						FROM
						(" . $sql . ") x1
						GROUP BY 
								x1.REGISTER_CODE,
								x1.PREFIX_NAME,
								x1.FIRST_NAME,
								x1.LAST_NAME,
								x1.CONCERN_CODE,
								x1.CONCERN_NAME";
			return $A;
		}
		$sql = "	select 		a.WH_PERSON_ID,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Civil' as SYSTEM_TYPE
							from 		" . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " a
							where 		1=1 {$filter}{$fill}
							order by 	CONCERN_CODE asc
							";
		$sqlSelectData =			add_groupby($sql);
		/* $sqlSelectData = "	select 		a.WH_PERSON_ID,a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Mediate' as SYSTEM_TYPE
							from 		".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." a
							where 		1=1 {$filter}{$fill}
							order by 	CONCERN_CODE asc
							"; */
	} else if ($_POST["SYSTEM_ID"] == 2) { //ระบบงานบังคับคดีล้มละลาย
		$sqlSelectData = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Bankrupt' as SYSTEM_TYPE
							from 		WH_BANKRUPT_CASE_PERSON a 
							where 		1=1 {$filter}
							order by 	CONCERN_CODE asc";
	} else if ($_POST["SYSTEM_ID"] == 3) { //ระบบงานฟื้นฟูกิจการของลูกหนี้
		$sqlSelectData = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,ADDRESS,TUM_NAME,AMP_NAME,PROV_NAME,ZIP_CODE,'Revive' as SYSTEM_TYPE
							from 		WH_REHABILITATION_PERSON a
							where 		1=1 {$filter}
							order by 	CONCERN_CODE asc";
	} else if ($_POST["SYSTEM_ID"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
		$sqlSelectData = "	select 		a.REGISTER_CODE,a.PREFIX_NAME,a.FIRST_NAME,a.LAST_NAME,a.CONCERN_CODE,a.CONCERN_NAME,a.REGISTER_CODE,a.PREFIX_BLACK_CASE,a.BLACK_CASE,a.BLACK_YY,a.PREFIX_RED_CASE,a.RED_CASE,a.RED_YY,a.COURT_NAME,a.COURT_CODE,'Mediate' as SYSTEM_TYPE
							from 		WH_MEDIATE_PERSON a
							where 		1=1 {$filter}
							GROUP BY a.REGISTER_CODE,
									a.PREFIX_NAME,
									a.FIRST_NAME,
									a.LAST_NAME,
									a.CONCERN_CODE,
									a.CONCERN_NAME,
									a.REGISTER_CODE,
									a.PREFIX_BLACK_CASE,
									a.BLACK_CASE,
									a.BLACK_YY,
									a.PREFIX_RED_CASE,
									a.RED_CASE,
									a.RED_YY,
									a.COURT_NAME,
									a.COURT_CODE
							order by 	CONCERN_CODE asc";
	} else if ($_POST["SYSTEM_ID"] == '5') {
		$filter = '';
		if ($_POST["GET_PER_TYPE"] == 1) {
			if ($_POST["GET_PER_CASE"] != "") {
				$filter = " AND USR_OPTION9 = '" . $_POST["GET_PER_CASE"] . "' ";
			}
			$sqlSelectData = "	select 		USR_OPTION9 as REGISTER_CODE,USR_PREFIX as PREFIX_NAME,USR_FNAME as FIRST_NAME,USR_LNAME as LAST_NAME,'' as CONCERN_CODE,'เจ้าหน้าที่' as CONCERN_NAME,USR_OPTION9 as REGISTER_CODE,'' as PREFIX_BLACK_CASE,'' as BLACK_CASE,'' as BLACK_YY,'' as PREFIX_RED_CASE,'' as RED_CASE,'' as RED_YY,'' as COURT_NAME,'' as COURT_CODE,'' as ADDRESS,'' as TUM_NAME,'' as AMP_NAME,'' as PROV_NAME,'' as ZIP_CODE,'Backoffice' as SYSTEM_TYPE
								from 		USR_MAIN a
								where 		1=1 {$filter}";
		} else {
			if ($_POST["GET_PER_CASE"] != "") {
				$filter = " AND WH_CREDITOR_ID_CARD = '" . $_POST["GET_PER_CASE"] . "' ";
			}
			$sqlSelectData = "	select 		WH_CREDITOR_ID_CARD as REGISTER_CODE,WH_CREDITOR_PREFIX as PREFIX_NAME,WH_CREDITOR_FNAME as FIRST_NAME,WH_CREDITOR_LNAME as LAST_NAME,'' as CONCERN_CODE,'เจ้าหนี้' as CONCERN_NAME,WH_CREDITOR_ID_CARD as REGISTER_CODE,'' as PREFIX_BLACK_CASE,'' as BLACK_CASE,'' as BLACK_YY,'' as PREFIX_RED_CASE,'' as RED_CASE,'' as RED_YY,'' as COURT_NAME,'' as COURT_CODE,'' as ADDRESS,'' as TUM_NAME,'' as AMP_NAME,'' as PROV_NAME,'' as ZIP_CODE,'Backoffice' as SYSTEM_TYPE
								from 		WH_CREDITOR a
								where 		1=1 {$filter}";
		}
	}

	$querySelectData = db::query($sqlSelectData);
	while ($recSelectData = db::fetch_array($querySelectData)) {
		$arrPerson['data'][] = array(
			/* "REGISTER_CODE" => $recSelectData["REGISTER_CODE"], ของเดิม */
			//"REGISTER_CODE" => $recSelectData["REGISTER_CODE"].$recSelectData["CONCERN_CODE"],
			"REGISTER_CODE" => $recSelectData["REGISTER_CODE"],
			"PREFIX_NAME" => $recSelectData["PREFIX_NAME"],
			"FIRST_NAME" => $recSelectData["FIRST_NAME"],
			"LAST_NAME" => $recSelectData["LAST_NAME"],
			"CONCERN_NAME" => $recSelectData["CONCERN_NAME"],

		);
	}
	$arrPerson['data_sql'] = $sqlSelectData;
	$arrPerson['POST'] = $_POST;
	echo json_encode($arrPerson);
}

if ($_POST["proc"] == "getPersonJson_new") {

	//ตัวแปร
	$Func = new func();
	$ArrayPost = $_POST['AR'];
	$SYSTEM_ID = $ArrayPost['SYSTEM_ID'];

	//print_pre($_POST);

	$arrPerson = array();
	unset($MData);
	$MData = [
		"REF_ID" => $_POST['REF_ID'],
	];
	unset($Array);
	$Array = [
		"PREFIX_CASE_BLACK" => $_POST['T_BLACK_CASE'],
		"CASE_BLACK" => $_POST['BLACK_CASE'],
		"CASE_BLACK_YEAR" => $_POST['BLACK_YY'],
		"PREFIX_CASE_RED" => $_POST['T_RED_CASE'],
		"CASE_RED" => $_POST['RED_CASE'],
		"CASE_RED_YEAR" => $_POST['RED_YY'],
		"COURT_CODE" => $_POST['COURT_CODE']
	];
	if ($SYSTEM_ID  == '1') { //ระบบงานบังคับคดีแพ่ง
		$sqlSelectDataPerson = $Func->DataPersonCivil($MData, $Array);
	} else if ($SYSTEM_ID  == '2') { //ระบบงานบังคับคดีล้มละลาย
		$sqlSelectDataPerson = $Func->DataPersonBankrupt($MData, $Array);
	} else if ($SYSTEM_ID  == '3') { //ระบบงานฟื้นฟูกิจการของลูกหนี้
		$sqlSelectDataPerson = $Func->DataPersonRevive($MData, $Array);
	} else if ($SYSTEM_ID  == '4') { //ระบบงานไกล่เกลี่ยข้อพิพาท
		$sqlSelectDataPerson = $Func->DataPersonMediate($MData, $Array);
	} else if ($SYSTEM_ID == '5') { //ระบบงานBackoffice
		unset($MData);
		$MData = [
			"REF_ID" => $_POST['REF_ID'],
			"GET_PER_TYPE" => $_POST["GET_PER_TYPE"],
			"GET_PER_CASE" => $_POST['GET_PER_CASE'],
		];
		unset($Array);
		$Array = [
		];
		$sqlSelectDataPerson = $Func->DataPersonBackoffcie($MData, $Array);
	}

	$querySelectData = db::query($sqlSelectDataPerson);



	/* 	if (isset($Func)) {
		echo "อ็อบเจกต์ของคลาส func ถูกสร้างขึ้นเรียบร้อยแล้ว";
	} else {
		echo "การสร้างอ็อบเจกต์ของคลาส func ไม่สำเร็จ";
	}
	
	exit; */
	//echo ($sqlSelectDataPerson);
?>
	<div class="form-group row">
		<div class="col-md-12 wf-center ">
			<label for="" class="form-control-label wf-center">บุคคลที่เกี่ยวข้องตามคำสั่ง</label>
			<div class="table-responsive">
				<table id="wfsflow" class="table table-bordered sorted_table ">
					<thead class="bg-primary">
						<tr class="bg-primary">
							<th style="width:5%;" class="text-center">ลำดับ</th>
							<th style="width:35%;" class="text-center">ชื่อ</th>
							<th style="width:30%;" class="text-center">ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
							<th style="width:30%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
						</tr>
					</thead>
					<?php
					$i = 0;
					while ($recSelectData = db::fetch_array($querySelectData)) {
						$i++;

						//13หลักเลือกเเค่คนเดียว
						$style = "";
						$Ishow = "";
						$checked = "";
						if ($SYSTEM_ID == 5) {
							if ($ArrayPost['GET_PER_CASE'] == $recSelectData["REGISTER_CODE"]) {
								$style = "style='display: none;'";
								$Ishow = "<i class='icofont icofont-tick-mark' title=''></i>" . $i;
							} else {
								$Ishow = $i;
							}
						} else {
							if ($ArrayPost['REGISTER_CODE_MAIN'] == $recSelectData["REGISTER_CODE"]) {
								$style = "style='display: none;' ";
								$checked = "checked";
								$Ishow = "<i class='icofont icofont-tick-mark' title=''></i>" . $i;
							} else {
								$Ishow = $i;
							}
						}

						//สำหรับเลือกรายการคำสั่ง //เเพ่ง ฟื้นฟู ไกล่เกลี่ย
						// CMD_TYPE_ID=2 คือสอบถามความประสงค์
						if ($SYSTEM_ID == '1') {
							$CMD_TYPE_ID = "2";
							$CMD_TYPE_CODE = "10201";
						} else if ($SYSTEM_ID == '3') {
							$CMD_TYPE_ID = "2";
							$CMD_TYPE_CODE = "30201";
						} else if ($SYSTEM_ID == '4') {
							$CMD_TYPE_ID = "2";
							$CMD_TYPE_CODE = "40201";
						} else if ($SYSTEM_ID == '5') {
							$CMD_TYPE_ID = "2";
							$CMD_TYPE_CODE = "50201";
						}
					?>
						<tr>
							<td>
								<label for="">
									<input type="checkbox" name='LIST_REGISTER_CODE[<?php echo $recSelectData["REGISTER_CODE"]; ?>]' id="LIST_REGISTER_CODE<?php echo $recSelectData["REGISTER_CODE"]; ?>" value='<?php echo $recSelectData["REGISTER_CODE"]; ?>' <?php echo $checked; ?> <?php echo $style; ?>>
								</label>
								<?php echo $Ishow ?>
							</td>

							<td>
								<?php echo $recSelectData["CONCERN_NAME"] . ":" . $recSelectData["PREFIX_NAME"] . " " . $recSelectData["FIRST_NAME"] . " " . $recSelectData["LAST_NAME"] ?>
								<input type="hidden" name="GET_PREFIX_NAME[<?php echo $recSelectData["REGISTER_CODE"]; ?>]" id="GET_PREFIX_NAME" value="<?php echo $recSelectData["PREFIX_NAME"]; ?>">
								<input type="hidden" name="GET_FIRST_NAME[<?php echo $recSelectData["REGISTER_CODE"]; ?>]" id="GET_FIRST_NAME" value="<?php echo $recSelectData["FIRST_NAME"]; ?>">
								<input type="hidden" name="GET_LAST_NAME[<?php echo $recSelectData["REGISTER_CODE"]; ?>]" id="GET_LAST_NAME" value="<?php echo $recSelectData["LAST_NAME"]; ?>">
							</td>
							<td align="">
								<?php
								//ตัวเลือก ประเภทคำสั่ง 
								if ($CMD_TYPE_ID == '2') {
								?>
									<input type="hidden" value="<?php echo $CMD_TYPE_ID; ?>" name="CMD_TYPE_PERSON[<?php echo $recSelectData['REGISTER_CODE']; ?>]" id="CMD_TYPE_PERSON_<?php echo $recSelectData["REGISTER_CODE"]; ?>">
									<label for=""><?php echo "สอบถามความประสงค์"; ?></label>
								<?php
								} else {
									unset($Fill);
									$Fill = [
										"SYSTEM_ID" => $SYSTEM_ID, //ระบบของประเภทคำสั่ง เช่นเเพ่ง ฟื้นฟู ไกล่เกลี่ย
										"CMD_TYPE_ID" => $CMD_TYPE_ID, //ประเภทคำสั่ง
									];
									$sql_cmd = $Func->CMD_TYPE($Fill);
									unset($ArraySelect);
									$ArraySelect = [
										'sql' 	=> $sql_cmd, // sql
										'name' 	=> "CMD_TYPE_PERSON[" . $recSelectData['REGISTER_CODE'] . "]", // name_id =ชื่อเเละid
										'id' 	=> "CMD_TYPE_PERSON_" . $recSelectData["REGISTER_CODE"], // id
										'Fill_vale' => 'CMD_TYPE_ID',   // Fill_vale ข้อมูลที่ต้องการ vale
										'Fill_name' => 'CMD_GRP_NAME',  // Fill_name ข้อมูลที่ต้องการโชว์
										'process' => "class='form-control select2' tabindex='-2'  onChange=\"getCaseTypePerson('" . $recSelectData["REGISTER_CODE"] . "');\"", // กำการทำงานเป็น text
										'Selected' => $CMD_TYPE_ID, // Selected ข้อมูลที่ต้องการเลือก
										'textAler' => "เลือกประเภทคำสั่ง", //คำพูดก่อนเลือกรายการ
									];
									//print_pre($ArraySelect);
									echo $selectCmd = ($Func->getSelecter($ArraySelect)); //ประเภทบุคคล*
								}
								?>
							</td>
							<td align="">
								<?php
								//คำสั่งย่อย
								//2 คือสอบถามความประสงค์ไม่ต้องให้ลูกค้าเลือก
								if ($CMD_TYPE_ID == '2') {
								?>
									<input type="hidden" value="<?php echo $CMD_TYPE_CODE; ?>" name="CASE_TYPE_PERSON[<?php echo $recSelectData['REGISTER_CODE']; ?>]" id="CASE_TYPE_PERSON_<?php echo $recSelectData["REGISTER_CODE"]; ?>">
									<label for=""><?php echo "สอบถามความประสงค์บุคคล"; ?></label>
								<?php
								} else {
									unset($ArrayCase);
									$ArrayCase = [
										"SYSTEM_ID" => $SYSTEM_ID, //ระบบของประเภทคำสั่ง เช่นเเพ่ง ฟื้นฟู ไกล่เกลี่ย
										"CMD_TYPE_ID" => $CMD_TYPE_ID, //ประเภทคำสั่ง
										"CMD_TYPE_CODE" => $CMD_TYPE_CODE, //คำสั่งย่อย
									];
									$sqlCASE_TYPE_PERSON = $Func->CASE_TYPE_PERSON($ArrayCase); //ได้sql
									unset($ArraySelect);
									$ArraySelect = [
										'sql' 	=> $sqlCASE_TYPE_PERSON, // sql
										'name' 	=> "CASE_TYPE_PERSON[" . $recSelectData['REGISTER_CODE'] . "]", // name_id =ชื่อเเละid
										'id' 	=> "CASE_TYPE_PERSON_" . $recSelectData["REGISTER_CODE"], // id
										'Fill_vale' => 'CMD_TYPE_CODE',   // Fill_vale ข้อมูลที่ต้องการ vale
										'Fill_name' => 'CMD_TYPE_NAME',  // Fill_name ข้อมูลที่ต้องการโชว์
										'process' => "class='form-control select2' tabindex='-2'", // กำการทำงานเป็น text
										'Selected' => $CMD_TYPE_CODE, // Selected ข้อมูลที่ต้องการเลือก
										'textAler' => "เลือกคำสั่ง", //คำพูดก่อนเลือกรายการ
									];
									//echo $sqlCASE_TYPE_PERSON;
									echo $selectCmd = ($Func->getSelecter($ArraySelect)); //ประเภทบุคคล*
								}
								?>
							</td>
						</tr>
					<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php
}




if ($_POST["proc"] == "getCase") {

	$filter = "";
	if ($_POST["T_BLACK_CASE"] != "") {
		$filter .= " and PREFIX_BLACK_CASE = '" . $_POST['T_BLACK_CASE'] . "'	";
	}
	if ($_POST["BLACK_CASE"] != "") {
		$filter .= " and BLACK_CASE = '" . $_POST['BLACK_CASE'] . "'	";
	}
	if ($_POST["BLACK_YY"] != "") {
		$filter .= " and BLACK_YY = '" . $_POST['BLACK_YY'] . "'	";
	}
	if ($_POST["T_RED_CASE"] != "") {
		$filter .= " and PREFIX_RED_CASE = '" . $_POST['T_RED_CASE'] . "'	";
	}
	if ($_POST["RED_CASE"] != "") {
		$filter .= " and RED_CASE = '" . $_POST['RED_CASE'] . "'	";
	}
	if ($_POST["RED_YY"] != "") {
		$filter .= " and RED_YY = '" . $_POST['RED_YY'] . "'	";
	}
	if ($_POST["COURT_CODE"] != "") {
		if ($_POST["SYSTEM_ID"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
			$filter .= " and COURT_ID = '" . $_POST['COURT_CODE'] . "'	";
		} else {
			$filter .= " and COURT_CODE = '" . $_POST['COURT_CODE'] . "'	";
		}
	}

	if ($_POST["SYSTEM_ID"] == 1) { //ระบบงานบังคับคดีแพ่ง
		$sqlSelectData = "	select 		PLAINTIFF1 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT,DOSS_OWNER_ID,PCC_CASE_GEN
							from 		WH_CIVIL_CASE a 
							inner join 	WH_CIVIL_DOSS b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
							where		1=1 {$filter}";
	} else if ($_POST["SYSTEM_ID"] == 2) { //ระบบงานบังคับคดีล้มละลาย
		$sqlSelectData = "	select 	PLAINTIFF1 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT,'' as PCC_CASE_GEN
							from 	WH_BANKRUPT_CASE_DETAIL
							where	1=1 {$filter}	";
	} else if ($_POST["SYSTEM_ID"] == 3) { //ระบบงานฟื้นฟูกิจการของลูกหนี้
		$sqlSelectData = "	select 	PLAINTIFF2 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT,'' as PCC_CASE_GEN
							from 	WH_REHABILITATION_CASE_DETAIL
							where	1=1 {$filter}	";
	} else if ($_POST["SYSTEM_ID"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
		$sqlSelectData = "
							select 	PLAINTIFF_FNAME as PLAINTIFF,DEFENDANT_FNAME as DEFFENDANT,'' as PCC_CASE_GEN
							from 	WH_MEDIATE_CASE
							where	1=1 	{$filter}	";
	}

	$querySelectData = db::query($sqlSelectData);
	$recSelectData = db::fetch_array($querySelectData);
	$arrData["PLAINTIFF"] 		= $recSelectData["PLAINTIFF"];
	$arrData["DEFFENDANT"] 		= $recSelectData["DEFFENDANT"];
	$arrData["DOSS_OWNER_ID"] 	= $recSelectData["DOSS_OWNER_ID"];
	$arrData["PCC_CASE_GEN"] 	= $recSelectData["PCC_CASE_GEN"];
	$arrData["CivilFile"] 		= getCivilEdocument($recSelectData["PCC_CASE_GEN"]);


	echo json_encode($arrData);
}

if ($_POST["proc"] == "getAsset") {

	$filter = "";
	if ($_POST["T_BLACK_CASE"] != "") {
		$filter .= " and b.PREFIX_BLACK_CASE = '" . $_POST['T_BLACK_CASE'] . "'	";
	}
	if ($_POST["BLACK_CASE"] != "") {
		$filter .= " and b.BLACK_CASE = '" . $_POST['BLACK_CASE'] . "'	";
	}
	if ($_POST["BLACK_YY"] != "") {
		$filter .= " and b.BLACK_YY = '" . $_POST['BLACK_YY'] . "'	";
	}
	if ($_POST["T_RED_CASE"] != "") {
		$filter .= " and b.PREFIX_RED_CASE = '" . $_POST['T_RED_CASE'] . "'	";
	}
	if ($_POST["RED_CASE"] != "") {
		$filter .= " and b.RED_CASE = '" . $_POST['RED_CASE'] . "'	";
	}
	if ($_POST["RED_YY"] != "") {
		$filter .= " and b.RED_YY = '" . $_POST['RED_YY'] . "'	";
	}
	if ($_POST["COURT_CODE"] != "" && $_POST["SYSTEM_ID"] != 6) {
		if ($_POST["SYSTEM_ID"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
			$filter .= " and b.COURT_ID = '" . $_POST['COURT_CODE'] . "'	";
		} else {
			$filter .= " and b.COURT_CODE = '" . $_POST['COURT_CODE'] . "'	";
		}
	}

	$arrDataAsset = array();
	if ($_POST["SYSTEM_ID"] == 1) { //ระบบงานบังคับคดีแพ่ง
		$sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,CFC_CAPTION_GEN
								from 		WH_CIVIL_CASE_ASSETS a 
								inner join 	WH_CIVIL_CASE b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
								where 		1=1 
								AND ASSET_ID IS NOT NULL
								{$filter}";
	} else if ($_POST["SYSTEM_ID"] == 2) { //ระบบงานบังคับคดีล้มละลาย
		$sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE
								from 		WH_BANKRUPT_ASSETS a 
								inner join 	WH_BANKRUPT_CASE_DETAIL b on a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID
								where 		1=1 
								--AND ASSET_ID IS NOT NULL
								  {$filter}";
	} else if ($_POST["SYSTEM_ID"] == 6) { //ระบบงานบังคับคดีล้มละลาย
		$sqlSelectDataAsset = "	select 		WH_ASSET_ID as ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,M_ASSET_KEY,ASSET_TYPE_ID
								from 		WH_DEBTOR_ASSETS a
								where 		1=1 AND PROP_TITLE is not null 
								AND WH_ASSET_ID IS NOT NULL  
								{$filter}";
	}
	$querySelectDataAsset = db::query($sqlSelectDataAsset);
	while ($recSelectDataAsset = db::fetch_array($querySelectDataAsset)) {
		/* $arrDataAsset['ASSET'][$recSelectDataAsset["ASSET_ID"]][] =  array(
			"ASSET_ID" 			=> $recSelectDataAsset["ASSET_ID"],
			"PROP_TITLE" 		=> $recSelectDataAsset["PROP_TITLE"],
			"PROP_STATUS_NAME" 	=> (trim($recSelectDataAsset["PROP_STATUS_NAME"]) == "") ? "-" : $recSelectDataAsset["PROP_STATUS_NAME"],
			"PROP_STATUS" 		=> $recSelectDataAsset["PROP_STATUS"],
			"TYPE_CODE" 			=> $recSelectDataAsset["TYPE_CODE"],
			"CFC_CAPTION_GEN" 	=> $recSelectDataAsset["CFC_CAPTION_GEN"],
			"ASSET_TYPE_ID" 		=> $recSelectDataAsset["ASSET_TYPE_ID"],
			"M_ASSET_KEY" 		=> $recSelectDataAsset["M_ASSET_KEY"]
		); */
		$arrDataAsset['ASSET'][] =  array(
			"ASSET_ID" 			=> $recSelectDataAsset["ASSET_ID"],
			"PROP_TITLE" 		=> $recSelectDataAsset["PROP_TITLE"],
			"PROP_STATUS_NAME" 	=> (trim($recSelectDataAsset["PROP_STATUS_NAME"]) == "") ? "-" : $recSelectDataAsset["PROP_STATUS_NAME"],
			"PROP_STATUS" 		=> $recSelectDataAsset["PROP_STATUS"],
			"TYPE_CODE" 			=> $recSelectDataAsset["TYPE_CODE"],
			"CFC_CAPTION_GEN" 	=> $recSelectDataAsset["CFC_CAPTION_GEN"],
			"ASSET_TYPE_ID" 		=> $recSelectDataAsset["ASSET_TYPE_ID"],
			"M_ASSET_KEY" 		=> $recSelectDataAsset["M_ASSET_KEY"]
		);
	}
	$arrDataAsset['sql'] = $sqlSelectDataAsset;
	echo json_encode($arrDataAsset);
}

if ($_POST["proc"] == "getAsset_new") {
	//ตัวแปร
	$Func = new func();
	$ArrayPost = $_POST['AR']; //ข้อมูลเพิ่มเติม

	//print_pre($_POST);

	$arrPerson = array();
	unset($MData);
	$MData = [ //ข้อมูลหลักเผื่อต้องใช้ในหน้านั้นๆ
		"SYSTEM_ID" => $_POST['SYSTEM_ID'],
	];
	unset($Array);
	$Array = [
		"PREFIX_CASE_BLACK" => $_POST['T_BLACK_CASE'],
		"CASE_BLACK" => $_POST['BLACK_CASE'],
		"CASE_BLACK_YEAR" => $_POST['BLACK_YY'],
		"PREFIX_CASE_RED" => $_POST['T_RED_CASE'],
		"CASE_RED" => $_POST['RED_CASE'],
		"CASE_RED_YEAR" => $_POST['RED_YY'],
		"COURT_CODE" => $_POST['COURT_CODE'],
		"SYSTEM_ID" => $_POST['SYSTEM_ID'],
	];
	if ($Array['SYSTEM_ID'] == '1') {
		$CMD_TYPE_ID = 2;
		$CMD_TYPE_CODE="10201";
		$sqlSelectDataAsset = $Func->DataAsset($MData, $Array);
	} else if ($Array['SYSTEM_ID'] == '2') {
		$CMD_TYPE_CODE="";
		$sqlSelectDataAsset = $Func->DataAsset($MData, $Array);
	}
	 else if ($Array['SYSTEM_ID'] == '6') {
		$CMD_TYPE_ID = 2;
		$sqlSelectDataAsset = $Func->DataAsset($MData, $Array);
	}

	$arrDataAsset = array();
	$querySelectDataAsset = db::query($sqlSelectDataAsset);
?>
	<div class="form-group row">
		<div class="col-md-12 wf-center ">
			<label for="" class="form-control-label wf-center">รายการทรัพย์</label>
			<div class="table-responsive">
				<table id="wfsflow" class="table table-bordered sorted_table">
					<thead class="bg-primary">
						<tr class="bg-primary">
							<th style="width:5%;" class="text-center">ลำดับ</th>
							<th style="width:25%;" class="text-center">รายการทรัพย์</th>
							<th style="width:20%;" class="text-center">ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
							<th style="width:20%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
							<th style="width:10%;" class="text-center">สถานะ</th>
							<th style="width:25%;" class="text-center">action</th>
						</tr>
					</thead>
					<?php
					while ($recSelectDataAsset = db::fetch_array($querySelectDataAsset)) {
						$arrDataAsset['ASSET'][] =  array(
							"ASSET_ID" 			=> $recSelectDataAsset["ASSET_ID"],
							"PROP_TITLE" 		=> $recSelectDataAsset["PROP_TITLE"],
							"PROP_STATUS_NAME" 	=> (trim($recSelectDataAsset["PROP_STATUS_NAME"]) == "") ? "-" : $recSelectDataAsset["PROP_STATUS_NAME"],
							"PROP_STATUS" 		=> $recSelectDataAsset["PROP_STATUS"],
							"TYPE_CODE" 			=> $recSelectDataAsset["TYPE_CODE"],
							"CFC_CAPTION_GEN" 	=> $recSelectDataAsset["CFC_CAPTION_GEN"],
							"ASSET_TYPE_ID" 		=> $recSelectDataAsset["ASSET_TYPE_ID"],
							"M_ASSET_KEY" 		=> $recSelectDataAsset["M_ASSET_KEY"]
						);
						$PROP_STATUS_NAME = (trim($recSelectDataAsset["PROP_STATUS_NAME"]) == "") ? "-" : $recSelectDataAsset["PROP_STATUS_NAME"];

						/* start */
					?>
						<!-- สร้าง inputเพื่อ submit ข้อมูล -->
						<tr>
							<td><label for=""><input type="checkbox" name="ASSET_ID[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="ASSET_ID_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>" value="<?php echo $recSelectDataAsset["ASSET_ID"]; ?>"><?php echo $i; ?></label></td>
							<td>
								<input type="hidden" name="PROP_TITLE[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="PROP_TITLE_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>" value="<?php echo $recSelectDataAsset["PROP_TITLE"]; ?>">
								<input type="hidden" name="PROP_STATUS_NAME[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="PROP_STATUS_NAME_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>" value="<?php echo $recSelectDataAsset["PROP_STATUS_NAME"]; ?>">
								<input type="hidden" name="PROP_STATUS[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="PROP_STATUS_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>" value="<?php echo $recSelectDataAsset["PROP_STATUS"]; ?>">
								<input type="hidden" name="TYPE_CODE[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="TYPE_CODE_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>" value="<?php echo $recSelectDataAsset["TYPE_CODE"]; ?>">
								<input type="hidden" name="TYPE_DESC[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="TYPE_DESC_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>" value="<?php echo $recSelectDataAsset["TYPE_DESC"]; ?>">
								<input type="hidden" name="CFC_CAPTION_GEN[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="CFC_CAPTION_GEN_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>" value="<?php echo $recSelectDataAsset["CFC_CAPTION_GEN"]; ?>">
								<input type="hidden" name="M_ASSET_KEY[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="M_ASSET_KEY_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>" value="<?php echo $recSelectDataAsset["M_ASSET_KEY"]; ?>">
								<input type="hidden" name="ASSET_TYPE_ID[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="ASSET_TYPE_ID_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>" value="<?php echo $recSelectDataAsset["ASSET_TYPE_ID"]; ?>">
								<a onclick="show_asset_detail('<?php echo $recSelectDataAsset['ASSET_ID']; ?>' href='javascript:void();'"> </a><?php echo $recSelectDataAsset["PROP_TITLE"]; ?>
							</td>
							<td>
								<?php
								//คำสั่งย่อย
								//2 คือสอบถามความประสงค์ไม่ต้องให้ลูกค้าเลือก
								if ($CMD_TYPE_ID == '2') {
								?>
									<input type="hidden" value="<?php echo $CMD_TYPE_ID; ?>" name="CMD_TYPE[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="CMD_TYPE_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>">
									<label for=""><?php echo "สอบถามความประสงค์ทรัพย์"; ?></label>
								<?php
								} else {
									$sql_cmd = "";
									unset($ArrayM_TYPE);
									$ArrayM_TYPE = [
										"SYSTEM_ID" => $Array['SYSTEM_ID'],
									];
									$sql_cmd = $Func->M_CMD_TYPE($ArrayM_TYPE);
									//echo $sql_cmd;
									unset($ArraySelect);
									$ArraySelect = [
										'sql' 	=> $sql_cmd, // sql
										'name' 	=> "CMD_TYPE[" . $recSelectDataAsset["ASSET_ID"] . "]", // name_id =ชื่อเเละid
										'id' 	=> "CMD_TYPE_" . $recSelectDataAsset["ASSET_ID"], // id
										'Fill_vale' => 'CMD_TYPE_ID',   // Fill_vale ข้อมูลที่ต้องการ vale
										'Fill_name' => 'CMD_GRP_NAME',  // Fill_name ข้อมูลที่ต้องการโชว์
										'process' => "class='form-control select2' tabindex='-2' onChange=\"getCaseType('" . $recSelectDataAsset["ASSET_ID"] . "');\"", // กำการทำงานเป็น text
										'Selected' => $CMD_TYPE_ID, // Selected ข้อมูลที่ต้องการเลือก
										'textAler' => "เลือกประเภทคำสั่ง", //คำพูดก่อนเลือกรายการ
									];
									//print_pre($ArraySelect);
									echo $selectCmd = ($Func->getSelecter($ArraySelect)); //ประเภททรัพย์*
								}
								?>
							</td>
							<td>
								<?php
								if ($CMD_TYPE_CODE== '10201') {
								?>
									<input type="hidden" value="<?php echo $CMD_TYPE_CODE; ?>" name="CASE_TYPE[<?php echo $recSelectDataAsset["ASSET_ID"]; ?>]" id="CASE_TYPE_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>">
									<label for=""><?php echo "สอบถามความประสงค์ทรัพย์"; ?></label>
								<?php
								} else {
								?>
									<style>
										.select2 {
											width: 400PX;
											max-width: 400PX;
										}
									</style>
								<?php
									/* s */
									unset($ArrayM_SERVICE_CMD);
									$ArrayM_SERVICE_CMD = [
										"CMD_TYPE_ID" => $CMD_TYPE_ID,
										"SYSTEM_ID" => $Array['SYSTEM_ID'],
									];
									$sqlM_service = $Func->M_SERVICE_CMD($ArrayM_SERVICE_CMD);
									unset($ArraySelect);
									$ArraySelect = [
										'sql' 	=> $sqlM_service, // sql
										'name' 	=> "CASE_TYPE[" . $recSelectDataAsset["ASSET_ID"] . "]", // name_id =ชื่อเเละid
										'id' 	=> "CASE_TYPE_" . $recSelectDataAsset["ASSET_ID"], // id
										'Fill_vale' => 'CMD_TYPE_CODE',   // Fill_vale ข้อมูลที่ต้องการ vale
										'Fill_name' => 'CMD_TYPE_NAME',  // Fill_name ข้อมูลที่ต้องการโชว์
										'process' => "class='form-control select2' tabindex='-2'onchange=\"show_action_cmd('','" . $recSelectDataAsset['ASSET_ID'] . "')\"", // กำการทำงานเป็น text
										'Selected' => "12345", // Selected ข้อมูลที่ต้องการเลือก
										'textAler' => "เลือกคำสั่ง", //คำพูดก่อนเลือกรายการ
									];
									//print_pre($ArraySelect);
									echo $selectCmd = ($Func->getSelecter($ArraySelect)); //ประเภททรัพย์*
								}
								?>
							</td>
							<td align='center'>
								<?php echo $PROP_STATUS_NAME; ?>
							</td>
							<td>
								<input type="text" readonly name="input_show_action" id="input_show_action_<?php echo $recSelectDataAsset["ASSET_ID"]; ?>" class="form-control">
							</td>
						</tr>
					<?php
						/* stop */
					}
					?>
				</table>
			</div>
		</div>
	</div>
	<?php
}



if ($_POST["proc"] == "getAsset_return") {

	$filter = "";
	if ($_POST["T_BLACK_CASE"] != "") {
		$filter .= " and b.PREFIX_BLACK_CASE = '" . $_POST['T_BLACK_CASE'] . "'	";
	}
	if ($_POST["BLACK_CASE"] != "") {
		$filter .= " and b.BLACK_CASE = '" . $_POST['BLACK_CASE'] . "'	";
	}
	if ($_POST["BLACK_YY"] != "") {
		$filter .= " and b.BLACK_YY = '" . $_POST['BLACK_YY'] . "'	";
	}
	if ($_POST["T_RED_CASE"] != "") {
		$filter .= " and b.PREFIX_RED_CASE = '" . $_POST['T_RED_CASE'] . "'	";
	}
	if ($_POST["RED_CASE"] != "") {
		$filter .= " and b.RED_CASE = '" . $_POST['RED_CASE'] . "'	";
	}
	if ($_POST["RED_YY"] != "") {
		$filter .= " and b.RED_YY = '" . $_POST['RED_YY'] . "'	";
	}
	if ($_POST["COURT_CODE"] != "" && $_POST["SYSTEM_ID"] != 6) {
		if ($_POST["SYSTEM_ID"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
			$filter .= " and b.COURT_ID = '" . $_POST['COURT_CODE'] . "'	";
		} else {
			$filter .= " and b.COURT_CODE = '" . $_POST['COURT_CODE'] . "'	";
		}
	}

	$arrDataAsset = array();
	if ($_POST["SYSTEM_ID"] == 1) { //ระบบงานบังคับคดีแพ่ง
		$sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,CFC_CAPTION_GEN
								from 		WH_CIVIL_CASE_ASSETS a 
								inner join 	WH_CIVIL_CASE b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
								where 		1=1 
								AND ASSET_ID IS NOT NULL
								{$filter}";
	} else if ($_POST["SYSTEM_ID"] == 2) { //ระบบงานบังคับคดีล้มละลาย
		$sqlSelectDataAsset = "	select 		ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE
								from 		WH_BANKRUPT_ASSETS a 
								inner join 	WH_BANKRUPT_CASE_DETAIL b on a.WH_BANKRUPT_ID = b.WH_BANKRUPT_ID
								where 		1=1 
								--AND ASSET_ID IS NOT NULL
								  {$filter}";
	} else if ($_POST["SYSTEM_ID"] == 6) { //ระบบงานบังคับคดีล้มละลาย
		$sqlSelectDataAsset = "	select 		WH_ASSET_ID as ASSET_ID,PROP_TITLE,PROP_STATUS_NAME,PROP_STATUS,TYPE_CODE,M_ASSET_KEY,ASSET_TYPE_ID
								from 		WH_DEBTOR_ASSETS a
								where 		1=1 AND PROP_TITLE is not null 
								AND WH_ASSET_ID IS NOT NULL  
								{$filter}";
	}
	$querySelectDataAsset = db::query($sqlSelectDataAsset);
	while ($recSelectDataAsset = db::fetch_array($querySelectDataAsset)) {
		/* $arrDataAsset['ASSET'][$recSelectDataAsset["ASSET_ID"]][] =  array(
			"ASSET_ID" 			=> $recSelectDataAsset["ASSET_ID"],
			"PROP_TITLE" 		=> $recSelectDataAsset["PROP_TITLE"],
			"PROP_STATUS_NAME" 	=> (trim($recSelectDataAsset["PROP_STATUS_NAME"]) == "") ? "-" : $recSelectDataAsset["PROP_STATUS_NAME"],
			"PROP_STATUS" 		=> $recSelectDataAsset["PROP_STATUS"],
			"TYPE_CODE" 			=> $recSelectDataAsset["TYPE_CODE"],
			"CFC_CAPTION_GEN" 	=> $recSelectDataAsset["CFC_CAPTION_GEN"],
			"ASSET_TYPE_ID" 		=> $recSelectDataAsset["ASSET_TYPE_ID"],
			"M_ASSET_KEY" 		=> $recSelectDataAsset["M_ASSET_KEY"]
		); */
		$arrDataAsset['ASSET'][] =  array(
			"ASSET_ID" 			=> $recSelectDataAsset["ASSET_ID"],
			"PROP_TITLE" 		=> $recSelectDataAsset["PROP_TITLE"],
			"PROP_STATUS_NAME" 	=> (trim($recSelectDataAsset["PROP_STATUS_NAME"]) == "") ? "-" : $recSelectDataAsset["PROP_STATUS_NAME"],
			"PROP_STATUS" 		=> $recSelectDataAsset["PROP_STATUS"],
			"TYPE_CODE" 			=> $recSelectDataAsset["TYPE_CODE"],
			"CFC_CAPTION_GEN" 	=> $recSelectDataAsset["CFC_CAPTION_GEN"],
			"ASSET_TYPE_ID" 		=> $recSelectDataAsset["ASSET_TYPE_ID"],
			"M_ASSET_KEY" 		=> $recSelectDataAsset["M_ASSET_KEY"]
		);
	}
	$arrDataAsset['sql'] = $sqlSelectDataAsset;
	echo json_encode($arrDataAsset);
}

if ($_POST["proc"] == 'getFileList') {
	$sql = "SELECT
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
            (A.WFR_ID = '" . $_POST['wfr'] . "' OR A.F_TEMP_ID = '" . $_POST['wfr'] . "')
          ORDER BY A.F_ID ASC
          ";
	$query = db::query($sql);
	// print_pre($_POST);
	// exit;
	$i = 0;
	while ($rec = db::fetch_array($query)) {
		// print_pre($rec);
	?>
		<tr id="bsf_f_id<?php echo $rec['F_ID']; ?>">
			<td class="text-center"><?php echo ++$i; ?></td>
			<td class="text-left"><?php echo $rec['CMD_FILE_TYPE']; ?><input type="hidden" value="<?php echo $rec['CMD_FILE_TYPE']; ?>"></td>
			<td class="text-center">
				<div class="row">
					<div class="data_table_main icon-list-demo">
						<div id="BSA_FILE725" class="to-do-list col-sm-12" title="<?php echo $rec['FILE_NAME']; ?>">
							<?php
							if ($rec['FILE_EXT'] == 'pdf') {
							?>
								<b class="fa fa-file-pdf-o text-danger"></b>
							<?php
							} else if ($rec['FILE_EXT'] == 'doc' || $rec['FILE_EXT'] == 'docx') {
							?>
								<b class="fa fa-file-word-o text-info"></b>
							<?php
							}
							?>
							<a href="../attach/w109/<?php echo $rec['FILE_SAVE_NAME']; ?>" target="_blank">
								<?php echo $rec['FILE_NAME']; ?>
							</a>
							<input hidden id="FILE_SAVE_NAME" name="FILE_SAVE_NAME[]" value="<?php echo $rec['FILE_SAVE_NAME']; ?>" />
							<input hidden id="FILE_NAME" name="FILE_NAME[]" value="<?php echo $rec['FILE_NAME']; ?>" />
							<input hidden id="FILE_EXT" name="FILE_EXT[]" value="<?php echo $rec['FILE_EXT']; ?>" />
							<input hidden id="FILE_ID" name="FILE_ID[]" value="<?php echo $rec['FILE_ID']; ?>" />
							<input hidden id="WFS_FIELD_NAME" name="WFS_FIELD_NAME[]" value="<?php echo $rec['WFS_FIELD_NAME']; ?>" />
							<input hidden id="FILE_SIZE" name="FILE_SIZE[]" value="<?php echo $rec['FILE_SIZE']; ?>" />
							<input hidden id="FILE_TYPE" name="FILE_TYPE[]" value="<?php echo $rec['FILE_TYPE']; ?>" />
							<input hidden id="WFR_ID" name="WFR_ID[]" value="<?php echo $rec['WFR_ID']; ?>" />
						</div>
					</div>
				</div>
				<input type="hidden" value="">
			</td>
			<td class="text-center">
				<nobr>
					<a href="#!" class="btn btn-danger btn-mini" title="" onclick="bsf_del_form('117','<?php echo $rec['WFS_ID']; ?>','<?php echo $rec['WFR_ID']; ?>','<?php echo $rec['F_TEMP_ID']; ?>','0','<?php echo $rec['F_ID']; ?>');">
						<!-- <a href="#!" class="btn btn-danger btn-mini" title="" onclick="bsf_del_form('117','3440','<?php // echo $_POST['wfr']
																														?>','<? php // echo $_POST['wfr']
																																?>','0','<? php // echo $rec['FID']
																																			?>');"> -->
						<i class="icofont icofont-trash"></i> ลบ
					</a>
				</nobr>
			</td>
		</tr>
	<?php
	}
}
if ($_POST["proc"] == 'getCmdType') {
	if (!empty($_POST["GET_CMD_TYPE_ID"])) {
		$GET_CMD_TYPE_ID = $_POST["GET_CMD_TYPE_ID"];
		$fill = "AND B.CMD_TYPE_ID ='2'";
	}
	/* if (!empty($_POST["PROP_STATUS_NAME"])) {
		if ($_POST["PROP_STATUS_NAME"] == 'ถอนยึด/ถอนอายัด') {
		}else if($_POST["PROP_STATUS_NAME"] == 'ขายได้แล้ว') {//6 8
			$propFill="AND B.CMD_TYPE_ID IN (6,8)";
		}else if($_POST["PROP_STATUS_NAME"] == 'ยึด' || $_POST["PROP_STATUS_NAME"] == 'อยู่ระหว่างจำหน่าย') {//5 6 7 8
			$propFill="AND B.CMD_TYPE_ID IN (5,6,7,8)";
		}
	} */
	?>
	<select name="CMD_TYPE[<?php echo $_POST["ASSET_ID"] ?>]" id="CMD_TYPE_<?php echo $_POST["ASSET_ID"] ?>" class="form-control select2" tabindex="-1" aria-hidden="true" required onChange="getCaseType(<?php echo $_POST["ASSET_ID"] ?>)">
		<option value="" disabled selected>เลือกประเภทกลุ่มคำสั่ง</option>
		<?php $sql = "SELECT DISTINCT
		CMD_GRP_NAME,B.CMD_TYPE_ID
		FROM
		M_CMD_TYPE A
		LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
		LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_ID = C.CMD_SYSTEM_ID
		WHERE GRP_NOTI_FLAG = '1'
		AND CMD_STATUS='1'
		{$fill}
		ORDER BY
		A.CMD_GRP_NAME ASC";
		$query = db::query($sql);
		$i = 0;
		while ($rec = db::fetch_array($query)) {
		?>
			<option value="<?php echo $rec['CMD_TYPE_ID']; ?>" <?php echo ($GET_CMD_TYPE_ID == $rec['CMD_TYPE_ID']) ? "selected" : ""; ?>><?php echo $rec['CMD_GRP_NAME']; ?></option>
		<?php
		}
		?>
	</select>
<?php
}

if ($_POST["proc"] == 'getCmdType2') {

	if (!empty($_POST["GET_CMD_TYPE_ID"])) {
		$fill = "AND B.CMD_TYPE_ID ='2'";
	}
	if (!empty($_POST['SEND_TO'])) {
		$fill .= "AND c.CMD_SYSTEM_ID ='" . $_POST['SEND_TO'] . "'";
	}

?>
	<select name="CMD_TYPE_PERSON[<?php echo $_POST["REGISTER_CODE"] ?>]" id="CMD_TYPE_PERSON_<?php echo $_POST["REGISTER_CODE"] ?>" style="width: 300px; max-width: 300px;" class="form-control select2" tabindex="-1" aria-hidden="true" required onChange="getCaseTypePerson('<?php echo $_POST["REGISTER_CODE"] ?>')">
		<option value="" disabled selected>เลือกประเภทกลุ่มคำสั่ง</option>
		<?php $sql = "SELECT DISTINCT
		CMD_GRP_NAME,B.CMD_TYPE_ID
		FROM
		M_CMD_TYPE A
		LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
		LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_ID = C.CMD_SYSTEM_ID
		WHERE GRP_NOTI_FLAG = '1'
		AND CMD_STATUS='1'
		{$fill}
		ORDER BY
		A.CMD_GRP_NAME ASC";
		$query = db::query($sql);
		$i = 0;
		while ($rec = db::fetch_array($query)) {
		?>
			<option value="<?php echo $rec['CMD_TYPE_ID']; ?>" <?php echo ($_POST["GET_CMD_TYPE_ID"] == $rec['CMD_TYPE_ID']) ? "selected" : ""; ?>><?php echo $rec['CMD_GRP_NAME']; ?></option>
		<?php
		}
		?>
	</select>
<?php
}

if ($_POST["proc"] == 'getCmdType2_1') {

	if (!empty($_POST["GET_CMD_TYPE_ID"])) {
		$fill = "AND B.CMD_TYPE_ID ='2'";
	}

?>
	<select name="CMD_TYPE_PERSON[<?php echo $_POST["REGISTER_CODE"] ?>]" id="CMD_TYPE_PERSON_<?php echo $_POST["REGISTER_CODE"] ?>" class="form-control select2" tabindex="-1" aria-hidden="true" required onChange="getCaseTypePerson('<?php echo $_POST["REGISTER_CODE"] ?>')">
		<option value="" disabled selected>เลือกประเภทกลุ่มคำสั่ง</option>
		<?php $sql = "SELECT DISTINCT
		CMD_GRP_NAME,B.CMD_TYPE_ID
		FROM
		M_CMD_TYPE A
		LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
		LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_ID = C.CMD_SYSTEM_ID
		WHERE GRP_NOTI_FLAG = '1'
		AND CMD_STATUS='1'
		{$fill}
		ORDER BY
		A.CMD_GRP_NAME ASC";
		$query = db::query($sql);
		$i = 0;
		while ($rec = db::fetch_array($query)) {
		?>
			<option value="<?php echo $rec['CMD_TYPE_ID']; ?>" <?php echo ($_POST["GET_CMD_TYPE_ID"] == $rec['CMD_TYPE_ID']) ? "selected" : ""; ?>><?php echo $rec['CMD_GRP_NAME']; ?></option>
		<?php
		}
		?>
	</select>
<?php
}
if ($_POST["proc"] == "updateCmd") { //เงื่อนไขนี้้คือเข้าเงื่อนไขการอนุมัตืของฝั่งส่งข้อมูล


	function log_order($URL_API, $ARRAY_DATA)
	{
		$fields["URL_API"]                 =   $URL_API;
		$fields["ARRAY_DATA"]         =   json_encode($ARRAY_DATA);
		$fields["CREATE_DATE"]         =  date("Y-m-d");
		$fields["CREATE_TIME"]         =   date("h:i:sa");
		db::db_insert("M_LOG_ORDER ", $fields, 'ID_ORDER', 'ID_ORDER');
	}



	$sqlSelectDataCmd = "	select 		APPROVE_PERSON,USR_PREFIX,USR_FNAME,USR_LNAME,TO_PERSON_ID,CMD_MANUAL_STATUS,SEND_TO
							from 		M_DOC_CMD 
							inner join 	USR_MAIN on M_DOC_CMD.APPROVE_PERSON = USR_MAIN.USR_OPTION9
							where 		M_DOC_CMD.ID = '" . $_POST["ID"] . "' ";
	$querySelectDataCmd = db::query($sqlSelectDataCmd);
	$recSelectDataCmd = db::fetch_array($querySelectDataCmd);

	if ($_POST["APPROVE_STATUS"] == 0) { //ถ้าอนุมัติเเละส่งต่อให้อีกคนอนุมัติ
		/* เก็บ HISTORY start */
		unset($fields_COMMAND_HISTORY);
		$fields_COMMAND_HISTORY['ID_OF_M_DOC_CMD'] = $_POST["ID"];
		$fields_COMMAND_HISTORY['CMD_DOC_DATE'] = date("Y-m-d");;
		$fields_COMMAND_HISTORY['CMD_DOC_TIME'] = date("H:i:s");
		$fields_COMMAND_HISTORY['APPROVE_STATUS'] = $_POST["APPROVE_STATUS"];
		$fields_COMMAND_HISTORY['COMMENT_EDIT'] = $_POST["COMMENT_EDIT"];
		$fields_COMMAND_HISTORY['REF_ID'] = $_POST["ID"];
		$fields_COMMAND_HISTORY['TO_PERSON_ID'] = $_POST["TO_PERSON_ID"];
		$CODE_API = $_POST["PCC_CIVIL_GEN"];
		$fields_COMMAND_HISTORY['CODE_API'] = $CODE_API;
		db::db_insert("M_COMMAND_HISTORY", $fields_COMMAND_HISTORY, 'ID_COMMAND', 'ID_COMMAND');
		/* เก็บ HISTORY stop */


		unset($fields);
		$fields["APPROVE_DATE"] 		= 	date('Y-m-d');
		$fields["APPROVE_TIME"] 		= 	date('H:i:s');
		$fields["APPROVE_IDCARD"] 		= 	$recSelectDataCmd["APPROVE_PERSON"];
		$fields["APPROVE_USERNAME"] 	= 	$recSelectDataCmd["USR_PREFIX"] . $recSelectDataCmd["USR_FNAME"] . " " . $recSelectDataCmd["USR_LNAME"];
		$fields["CMD_ID"] 				= 	$_POST["ID"];
		db::db_insert("FRM__CMD_APPROVE", $fields, 'F_ID', 'F_ID');

		db::query("update M_DOC_CMD set APPROVE_STATUS = '" . $_POST["APPROVE_STATUS"] . "',APPROVE_PERSON='" . $_POST["APPROVE_PERSON_SEND"] . "',CMD_UPDATE_DATE='" . date('Y-m-d') . "',CMD_UPDATE_TIME='" . date('H:i:s') . "' where ID = '" . $_POST["ID"] . "' ");
	} else { //ถ้าอนุมัติหรือส่งกลับเเก้ไข้ APPROVE_STATUS=1 => อนุมัติ ,APPROVE_STATUS=2 => ส่งกลับเเก้ไข

		/* เก็บ HISTORY start */
		unset($fields_COMMAND_HISTORY);
		$fields_COMMAND_HISTORY['ID_OF_M_DOC_CMD'] = $_POST["ID"];
		$fields_COMMAND_HISTORY['CMD_DOC_DATE'] = date("Y-m-d");;
		$fields_COMMAND_HISTORY['CMD_DOC_TIME'] = date("H:i:s");
		$fields_COMMAND_HISTORY['APPROVE_STATUS'] = $_POST["APPROVE_STATUS"];
		$fields_COMMAND_HISTORY['COMMENT_EDIT'] = $_POST["COMMENT_EDIT"];
		$fields_COMMAND_HISTORY['REF_ID'] = $_POST["ID"];
		$fields_COMMAND_HISTORY['TO_PERSON_ID'] = $_POST["TO_PERSON_ID"];
		$CODE_API = $_POST["PCC_CIVIL_GEN"];
		$fields_COMMAND_HISTORY['CODE_API'] = $CODE_API;
		db::db_insert("M_COMMAND_HISTORY", $fields_COMMAND_HISTORY, 'ID_COMMAND', 'ID_COMMAND');
		/* เก็บ HISTORY stop */

		/* Ak start */
		if ($_POST["APPROVE_STATUS"] == '1') { //ถ้าพิจารณา จะรับทราบอัตโนมัติ updateCmd functionสำหรับการล็อค
			/* 	echo "จะรับทราบอัตโนมัติ";
			print_r($_POST); */
			updateCmdApp('1', $_POST['ID']);
		}
		/* Ak stop */
		/* SEND_BACK_EDIT */

		unset($fields);
		$fields['APPROVE_STATUS'] = $_POST['APPROVE_STATUS'];
		$fields['CMD_UPDATE_DATE'] =  date('Y-m-d');
		$fields['CMD_UPDATE_TIME'] =  date('H:i:s');
		if ($_POST['APPROVE_STATUS'] == '2') { //ส่งกลับเเก้ไขเเละเหตุผลในการส่งกลับ
			$fields['SEND_BACK_EDIT'] =  $_POST['COMMENT_EDIT'];
		} else {
			$fields['SEND_BACK_EDIT'] = "";
		}
		db::db_update("M_DOC_CMD", $fields, array('ID' => $_POST["ID"]));
		//db::query("update M_DOC_CMD set APPROVE_STATUS = '" . $_POST["APPROVE_STATUS"] . "',CMD_UPDATE_DATE='" . date('Y-m-d') . "',CMD_UPDATE_TIME='" . date('H:i:s') . "' where ID = '" . $_POST["ID"] . "' ");
		if ($recSelectDataCmd["SEND_TO"] == '6') {

			$arrAssetDebtor = array();
			$sqlSelectDataAssetDebtor = "	select 		ASSET_CMD_TYPE,ASSET_CASE_TYPE,M_ASSET_KEY,ASSET_TYPE_ID
											from 		M_CMD_ASSET
											where 		CMD_ID = " . $_POST["ID"] . " ";
			$querySelectAssetDebtor 	= db::query($sqlSelectDataAssetDebtor);
			while ($recSelectAssetDebtor = db::fetch_array($querySelectAssetDebtor)) {
				$arrAssetDebtor[] = array(
					"ASSET_CMD_TYPE" 	=> $recSelectAssetDebtor["ASSET_CMD_TYPE"],
					"ASSET_CASE_TYPE" 	=> $recSelectAssetDebtor["ASSET_CASE_TYPE"],
					"M_ASSET_KEY" 		=> $recSelectAssetDebtor["M_ASSET_KEY"],
					"ASSET_TYPE_ID" 	=> $recSelectAssetDebtor["ASSET_TYPE_ID"]
				);
			}
			if (count($arrAssetDebtor) > 0) {
				$data_string = json_encode($arrAssetDebtor);

				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => 'http://103.208.27.224/led_data/run/update_asset_form_bankrupt.php',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => $data_string,
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				));

				$response = curl_exec($curl);

				curl_close($curl);
			}
		} else { //SENT_TO 1-5 //เงื่อนไขนี้ล็อคสำหรับยืนเอกสารเอง

			//print_r($_POST);
			if ($recSelectDataCmd["CMD_MANUAL_STATUS"] == 'Y') {

				$sql_person = db::query("SELECT ID_CARD FROM M_CMD_PERSON WHERE CMD_ID = '" . $_POST['ID'] . "'");
				$rec_person = db::fetch_array($sql_person);

				$sqlSelectData = " 	select 		PCC_CASE_GEN,CMD_ACT_FLAG_2,CMD_ACT_FLAG_3,SEQUEST_STATUS,SALE_STATUS,ACCOUNTANCY_STATUS
									FROM		M_DOC_CMD A
									LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
									LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
									LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
									LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
									where		A.ID = '" . $_POST['ID'] . "' ";
				$querySelectData = db::query($sqlSelectData);
				$recSelectData = db::fetch_array($querySelectData);


				if ($recSelectData["CMD_ACT_FLAG_2"] == 1 || $recSelectData["CMD_ACT_FLAG_3"] == 1) {

					$sqlSelectData = " 	select 		PCC_CASE_GEN,CMD_ACT_FLAG_2,CMD_ACT_FLAG_3,SEQUEST_STATUS,SALE_STATUS,ACCOUNTANCY_STATUS
										FROM		M_DOC_CMD A
										LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
										LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
										LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
										LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
										where		A.ID = '" . $_POST['ID'] . "' ";
					$querySelectData = db::query($sqlSelectData);
					$recSelectData = db::fetch_array($querySelectData);

					if ($recSelectData["CMD_ACT_FLAG_2"] == 1 || $recSelectData["CMD_ACT_FLAG_3"] == 1) {

						$arrCFC_CAPTION_GEN = array();
						$sqlSelectCmdAsset 		= "	select 		a.CFC_CAPTION_GEN,b.DOSS_CONTROL_GEN
													from 		M_CMD_ASSET a 
													inner join 	WH_CIVIL_CASE_ASSETS b on a.ASSET_ID = b.ASSET_ID
													where 		CMD_ID = " . $_POST['ID'] . "";
						$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
						while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
							$arrCFC_CAPTION_GEN["CFC_CAPTION_GEN"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["CFC_CAPTION_GEN"];
							$arrCFC_CAPTION_GEN["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
								"SEQUEST_STATUS" => $recSelectData["SEQUEST_STATUS"],
								"SALE_STATUS" => $recSelectData["SALE_STATUS"],
								"ACCOUNTANCY_STATUS" => $recSelectData["ACCOUNTANCY_STATUS"]
							);
							civil::logOrder_update(
								'UPDATE_CFC_CAPTION_FOR_CMD',
								$recSelectCmdAsset["CFC_CAPTION_GEN"],
								$recSelectData["SEQUEST_STATUS"],
								$recSelectData["SALE_STATUS"],
								$recSelectData["ACCOUNTANCY_STATUS"],
								""
							);
							civil::UPDATE_CFC_CAPTION_FOR_CMD(
								$recSelectCmdAsset["CFC_CAPTION_GEN"],
								$recSelectData["SEQUEST_STATUS"],
								$recSelectData["SALE_STATUS"],
								$recSelectData["ACCOUNTANCY_STATUS"]
							);
						}

						if (count($arrCFC_CAPTION_GEN) > 0) {

							$data_string = json_encode($arrCFC_CAPTION_GEN);

							unset($fields);
							$fields["PAGE_CODE"]                 =    "";
							$fields["COLUMN1"]                 =     "upLockAssetCivil";
							$fields["CREATE_DATE"]                 =    date("Y-m-d");
							$fields["NOTE"]                 =   $data_string;
							$fields["SYSTEM_TYPE"]                 =   "1";
							db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');

							log_order("upLockAssetCivil", $arrCFC_CAPTION_GEN);

							$curl = curl_init();
							curl_setopt_array($curl, array(
								CURLOPT_URL => 'http://103.40.146.73/LedService.php/upLockAssetCivil',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => '',
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => 'POST',
								CURLOPT_POSTFIELDS => $data_string,
								CURLOPT_HTTPHEADER => array(
									'Content-Type: application/json'
								),
							));

							$response = curl_exec($curl);

							curl_close($curl);
						}
					}
				} else { //ทำงานในส่วนนี้

					$curl = curl_init();

					$arrDataSet = array();

					$arrDataSet["USERNAME"] 	= "BankruptDt";
					$arrDataSet["PASSWORD"] 	= "Debtor4321";
					$arrDataSet["PCC_CASE_GEN"] = $recSelectData["PCC_CASE_GEN"];
					$arrDataSet["CARD_ID"] 		= $rec_person["ID_CARD"];

					$sqlSelectCmdAsset 		= "	select 		a.CFC_CAPTION_GEN,b.DOSS_CONTROL_GEN
												from 		M_CMD_ASSET a 
												inner join 	WH_CIVIL_CASE_ASSETS b on a.ASSET_ID = b.ASSET_ID
												where 		CMD_ID = " . $_POST['ID'] . "";
					$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
					while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
						$arrDataSet["CFC_CAPTION_GEN"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["CFC_CAPTION_GEN"];
						$arrDataSet["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
							"SEQUEST_STATUS" => $recSelectData["SEQUEST_STATUS"],
							"SALE_STATUS" => $recSelectData["SALE_STATUS"],
							"ACCOUNTANCY_STATUS" => $recSelectData["ACCOUNTANCY_STATUS"]
						);
						civil::logOrder_update(
							'UPDATE_CFC_CAPTION_FOR_CMD',
							$recSelectCmdAsset["CFC_CAPTION_GEN"],
							$recSelectData["SEQUEST_STATUS"],
							$recSelectData["SALE_STATUS"],
							$recSelectData["ACCOUNTANCY_STATUS"],
							""
						);
						civil::UPDATE_CFC_CAPTION_FOR_CMD(
							$recSelectCmdAsset["CFC_CAPTION_GEN"],
							$recSelectData["SEQUEST_STATUS"],
							$recSelectData["SALE_STATUS"],
							$recSelectData["ACCOUNTANCY_STATUS"]
						);
					}
					$data_string = json_encode($arrDataSet);

					unset($fields);
					$fields["PAGE_CODE"]                 =    "";
					$fields["COLUMN1"]                 =     "lockPersonCivil";
					$fields["CREATE_DATE"]                 =    date("Y-m-d");
					$fields["NOTE"]                 =   $data_string;
					$fields["SYSTEM_TYPE"]                 =   "1";
					db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');

					log_order("lockPersonCivil", $arrDataSet);

					curl_setopt_array($curl, array(
						CURLOPT_URL => 'http://103.40.146.73/LedService.php/lockPersonCivil',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => $data_string,
						CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						),
					));

					$response = curl_exec($curl);

					curl_close($curl);
				}
			}
		}
	}

	getDataToWhAlert($recSelectDataCmd["APPROVE_PERSON"]);
	getDataToWhAlert($recSelectDataCmd["TO_PERSON_ID"]);
}
if ($_POST["proc"] == "sendApprove") {

	$GET_TRANSACTION_APPROVE_PERSON = 0;
	$TRANSACTION_STATUS_APP = 1;
	$FINAL_CMD = 1;
	if ($_POST["TRANSACTION_STATUS"] == 2) {
		$GET_TRANSACTION_APPROVE_PERSON = $_POST["TRANSACTION_APPROVE_PERSON"];
		$FINAL_CMD = 0;
		$TRANSACTION_STATUS_APP = 0;
	}
	db::query("update M_DOC_CMD set TRANSACTION_STATUS = '" . $_POST["TRANSACTION_STATUS"] . "',TRANSACTION_APPROVE_PERSON='" . $GET_TRANSACTION_APPROVE_PERSON . "',FINAL_CMD='" . $FINAL_CMD . "',TRANSACTION_STATUS_APP='" . $TRANSACTION_STATUS_APP . "' where ID = '" . $_POST["ID"] . "' ");

	getDataToWhAlert($GET_TRANSACTION_APPROVE_PERSON);
}




/* Ak start */

function updateCmdApp($TRANSACTION_STATUS_APP, $ID) //$_POST["TRANSACTION_STATUS_APP"]=$TRANSACTION_STATUS_APP,$_POST['ID']=ID
{
	$FINAL_CMD = 0;
	if ($TRANSACTION_STATUS_APP == 1) {
		$FINAL_CMD = 1;
	}
	db::query("update M_DOC_CMD set FINAL_CMD='" . $FINAL_CMD . "',TRANSACTION_STATUS_APP='" . $TRANSACTION_STATUS_APP . "' where ID = '" . $ID . "' ");
	db::query("update M_DOC_CMD set FINAL_CMD='" . $FINAL_CMD . "' where ID in (select ID from  M_DOC_CMD connect 	by  prior REF_ID =  ID START WITH ID = '" . $ID . "') ");

	$arrPersonList = array();
	$sql_person = db::query("SELECT ID_CARD FROM M_CMD_PERSON WHERE CMD_ID = '" . $ID . "'");
	while ($rec_person = db::fetch_array($sql_person)) {
		$arrPersonList[$rec_person["ID_CARD"]] = $rec_person["ID_CARD"];
	}


	$sqlSelectData = " 	select 		PCC_CASE_GEN,
									(select 	count(1)
									from 		M_CMD_ASSET a 
									inner join 	M_SERVICE_CMD  b on a.ASSET_CASE_TYPE = b.CMD_TYPE_CODE 
									where 		b.CMD_ACT_FLAG_2 = 1 and a.CMD_ID = a.ID)as CMD_ACT_FLAG_2,
									(select 	count(1)
									from 		M_CMD_ASSET a 
									inner join 	M_SERVICE_CMD  b on a.ASSET_CASE_TYPE = b.CMD_TYPE_CODE 
									where 		b.CMD_ACT_FLAG_3 = 1 and a.CMD_ID = a.ID) as CMD_ACT_FLAG_3,
									SEQUEST_STATUS,
									SALE_STATUS,
									ACCOUNTANCY_STATUS,
									(select 	count(1)
									from 		M_CMD_PERSON a 
									inner join 	M_SERVICE_CMD  b on a.PERSON_CASE_TYPE = b.CMD_TYPE_CODE 
									where 		b.ALLOW_MEDIATE_STATUS = 1 and a.CMD_ID = a.ID) as  ALLOW_MEDIATE_STATUS,
									(select 	count(1)
									from 		M_CMD_PERSON a 
									inner join 	M_SERVICE_CMD  b on a.PERSON_CASE_TYPE = b.CMD_TYPE_CODE 
									where 		b.BACKOFFICE_ALLOW_STATUS = 1 and a.CMD_ID = a.ID) as  BACKOFFICE_ALLOW_STATUS,
									TO_T_BLACK_CASE,
									TO_BLACK_CASE,
									TO_BLACK_YY,
									TO_T_RED_CASE,
									TO_RED_CASE,
									TO_RED_YY,
									TO_COURT_CODE
						FROM		M_DOC_CMD A
						LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
						LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
						LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
						LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
						where		A.ID = '" . $ID . "' ";
	$querySelectData = db::query($sqlSelectData);
	$recSelectData = db::fetch_array($querySelectData);
	//echo $sqlSelectData;

	//กรณีระบบไกล่เกลี่ย
	if ($recSelectData["ALLOW_MEDIATE_STATUS"] >= 1) {


		$sqlSelectRefData = "	SELECT 	REF_WFR_ID 
								FROM 	WH_MEDIATE_CASE
								WHERE	PREFIX_BLACK_CASE = '" . $recSelectData["TO_T_BLACK_CASE"] . "'
										AND BLACK_CASE = '" . $recSelectData["TO_BLACK_CASE"] . "'
										AND BLACK_YY = '" . $recSelectData["TO_BLACK_YY"] . "'
										AND PREFIX_RED_CASE = '" . $recSelectData["TO_T_RED_CASE"] . "'
										AND RED_CASE = '" . $recSelectData["TO_RED_CASE"] . "'
										AND RED_YY = '" . $recSelectData["TO_RED_YY"] . "'
										AND COURT_ID = '" . $recSelectData["TO_COURT_CODE"] . "' ";
		$querySelectRefData = db::query($sqlSelectRefData);
		$recSelectRefData = db::fetch_array($querySelectRefData);

		$curl = curl_init();

		$arrDataSet = array();

		$arrDataSet["USERNAME"] 		= "BankruptDt";
		$arrDataSet["PASSWORD"] 		= "Debtor4321";
		$arrDataSet["refWfrId"] 		= $recSelectRefData["REF_WFR_ID"];
		$arrDataSet["registerCode"] 	= $rec_person["ID_CARD"];
		$arrDataSet["prefixBlackCase"] 	= $recSelectData["TO_T_BLACK_CASE"];
		$arrDataSet["blackCase"] 		= $recSelectData["TO_BLACK_CASE"];
		$arrDataSet["blackYy"] 			= $recSelectData["TO_BLACK_YY"];
		$arrDataSet["prefixRedCase"] 	= $recSelectData["TO_T_RED_CASE"];
		$arrDataSet["redCase"] 			= $recSelectData["TO_RED_CASE"];
		$arrDataSet["redYy"] 			= $recSelectData["TO_RED_YY"];
		$arrDataSet["cmdActFlag"] 		= ($recSelectData["ALLOW_MEDIATE_STATUS"] >= 1) ? 0 : "1";

		$data_string = json_encode($arrDataSet);
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://103.208.27.224/ega_led_mediate/service/service_log_proces.php',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $data_string,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
	} else {

		if ($recSelectData["BACKOFFICE_ALLOW_STATUS"] >= 1) {
			$curl = curl_init();

			$arrDataSet = array();

			$arrDataSet["USERNAME"] 		= "BankruptDt";
			$arrDataSet["PASSWORD"] 		= "Debtor4321";
			$arrDataSet["CARD_ID"] 			= $arrPersonList;
			$arrDataSet["cmdActFlag"] 		= $recSelectData["BACKOFFICE_ALLOW_STATUS"];

			$data_string = json_encode($arrDataSet);

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://203.151.166.134/LED_OFFICE/LED_PER/api/update_payroll_status.php',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => $data_string,
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				),
			));

			$response = curl_exec($curl);

			curl_close($curl);
		} else {
			function getPccCase($B1, $B2, $B3, $R1, $R2, $R3)
			{
				$sql = "SELECT PCC_CASE_GEN
				FROM 	WH_CIVIL_CASE
				WHERE PREFIX_BLACK_CASE ='" . $B1 . "'
				AND BLACK_CASE ='" . $B2 . "'
				AND BLACK_YY ='" . $B3 . "'
				AND PREFIX_RED_CASE ='" . $R1 . "'
				AND RED_CASE ='" . $R2 . "'
				AND RED_YY ='" . $R3 . "'";
				$query = db::query($sql);
				$rec = db::fetch_array($query);
				return $rec['PCC_CASE_GEN'];
			}
			if ($recSelectData["CMD_ACT_FLAG_2"] >= 1 || $recSelectData["CMD_ACT_FLAG_3"] >= 1) {



				//$arrDataPerson["PCC_CASE_GEN"] 	= $recSelectData["PCC_CASE_GEN"];
				$arrDataPerson["PCC_CASE_GEN"] 	= getPccCase(
					$recSelectData["TO_T_BLACK_CASE"],
					$recSelectData["TO_BLACK_CASE"],
					$recSelectData["TO_BLACK_YY"],
					$recSelectData["TO_T_RED_CASE"],
					$recSelectData["TO_RED_CASE"],
					$recSelectData["TO_RED_YY"]
				);
				$arrDataPerson["CARD_ID"] 		= $arrPersonList;

				$data_string = json_encode($arrDataPerson);
				print_r($data_string);
				$curl = curl_init();

				log_order("upLockPersonCivil", $arrDataPerson);

				curl_setopt_array($curl, array(
					CURLOPT_URL => 'http://103.40.146.73/LedService.php/upLockPersonCivil',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => $data_string,
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				));

				$response = curl_exec($curl);

				curl_close($curl);

				$arrCFC_CAPTION_GEN = array();
				$sqlSelectCmdAsset 		= "	select 		a.CFC_CAPTION_GEN,b.DOSS_CONTROL_GEN,c.SEQUEST_STATUS,c.SALE_STATUS,c.ACCOUNTANCY_STATUS
											from 		M_CMD_ASSET a 
											inner join 	WH_CIVIL_CASE_ASSETS b on a.ASSET_ID = b.ASSET_ID
											inner join 	M_SERVICE_CMD  c on a.ASSET_CASE_TYPE = c.CMD_TYPE_CODE
											where 		CMD_ID = " . $ID . "";
				$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
				while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
					$arrCFC_CAPTION_GEN["CFC_CAPTION_GEN"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["CFC_CAPTION_GEN"];
					$arrCFC_CAPTION_GEN["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
						"SEQUEST_STATUS" => $recSelectCmdAsset["SEQUEST_STATUS"],
						"SALE_STATUS" => $recSelectCmdAsset["SALE_STATUS"],
						"ACCOUNTANCY_STATUS" => $recSelectCmdAsset["ACCOUNTANCY_STATUS"]
					);
					civil::logOrder_update(
						'UPDATE_CFC_CAPTION_FOR_CMD',
						$recSelectCmdAsset["CFC_CAPTION_GEN"],
						$recSelectCmdAsset["SEQUEST_STATUS"],
						$recSelectCmdAsset["SALE_STATUS"],
						$recSelectCmdAsset["ACCOUNTANCY_STATUS"],
						""
					);
					civil::UPDATE_CFC_CAPTION_FOR_CMD(
						$recSelectCmdAsset["CFC_CAPTION_GEN"],
						$recSelectCmdAsset["SEQUEST_STATUS"],
						$recSelectCmdAsset["SALE_STATUS"],
						$recSelectCmdAsset["ACCOUNTANCY_STATUS"]
					);
				}
				//echo $sqlSelectCmdAsset;
				if (count($arrCFC_CAPTION_GEN) > 0) {

					$data_string = json_encode($arrCFC_CAPTION_GEN);

					$curl = curl_init();

					log_order("upLockAssetCivil", $arrCFC_CAPTION_GEN);

					curl_setopt_array($curl, array(
						CURLOPT_URL => 'http://103.40.146.73/LedService.php/upLockAssetCivil',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS => $data_string,
						CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						),
					));

					$response = curl_exec($curl);

					curl_close($curl);
				}
			} else {
				$curl = curl_init();

				$arrDataSet = array();

				$arrDataSet["USERNAME"] 	= "BankruptDt";
				$arrDataSet["PASSWORD"] 	= "Debtor4321";
				//$arrDataSet["PCC_CASE_GEN"] = $recSelectData["PCC_CASE_GEN"];
				$arrDataSet["PCC_CASE_GEN"] = 	getPccCase(
					$recSelectData["TO_T_BLACK_CASE"],
					$recSelectData["TO_BLACK_CASE"],
					$recSelectData["TO_BLACK_YY"],
					$recSelectData["TO_T_RED_CASE"],
					$recSelectData["TO_RED_CASE"],
					$recSelectData["TO_RED_YY"]
				);

				$arrDataSet["CARD_ID"] 		= $rec_person["ID_CARD"];

				$sqlSelectCmdAsset 		= "	select 		a.CFC_CAPTION_GEN,b.DOSS_CONTROL_GEN
											from 		M_CMD_ASSET a 
											inner join 	WH_CIVIL_CASE_ASSETS b on a.ASSET_ID = b.ASSET_ID
											where 		CMD_ID = " . $ID . "";
				$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
				while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
					$arrDataSet["CFC_CAPTION_GEN"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["CFC_CAPTION_GEN"];
					$arrDataSet["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
						"SEQUEST_STATUS" => $recSelectData["SEQUEST_STATUS"],
						"SALE_STATUS" => $recSelectData["SALE_STATUS"],
						"ACCOUNTANCY_STATUS" => $recSelectData["ACCOUNTANCY_STATUS"]
					);
				}
				function get_cmd_upflag($ID)
				{
					$sqlSelectCmdAsset 	= "select 		a.CFC_CAPTION_GEN,b.DOSS_CONTROL_GEN,c.SEQUEST_STATUS,c.SALE_STATUS,c.ACCOUNTANCY_STATUS
											from 		M_CMD_ASSET a 
											inner join 	WH_CIVIL_CASE_ASSETS b on a.ASSET_ID = b.ASSET_ID
											inner join 	M_SERVICE_CMD  c on a.ASSET_CASE_TYPE = c.CMD_TYPE_CODE
											where 		CMD_ID = " . $ID . "";
					$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
					while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
						$AR[] = [
							"CFC_CAPTION_GEN" => $recSelectCmdAsset["CFC_CAPTION_GEN"],
							"SEQUEST_STATUS" => $recSelectCmdAsset["SEQUEST_STATUS"],
							"SALE_STATUS" => $recSelectCmdAsset["SALE_STATUS"],
							"ACCOUNTANCY_STATUS" => $recSelectCmdAsset["ACCOUNTANCY_STATUS"]
						];
						civil::logOrder_update(
							'UPDATE_CFC_CAPTION_FOR_CMD',
							$recSelectCmdAsset["CFC_CAPTION_GEN"],
							$recSelectCmdAsset["SEQUEST_STATUS"],
							$recSelectCmdAsset["SALE_STATUS"],
							$recSelectCmdAsset["ACCOUNTANCY_STATUS"],
							""
						);
						civil::UPDATE_CFC_CAPTION_FOR_CMD(
							$recSelectCmdAsset["CFC_CAPTION_GEN"],
							$recSelectCmdAsset["SEQUEST_STATUS"],
							$recSelectCmdAsset["SALE_STATUS"],
							$recSelectCmdAsset["ACCOUNTANCY_STATUS"]
						);
					}
				}
				get_cmd_upflag($ID);
				//echo $sqlSelectCmdAsset;
				//print_pre($recSelectData);
				$data_string = json_encode($arrDataSet);
				//echo $data_string;

				log_order("lockPersonCivil", $arrDataSet);

				curl_setopt_array($curl, array(
					CURLOPT_URL => 'http://103.40.146.73/LedService.php/lockPersonCivil',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => $data_string,
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				));

				$response = curl_exec($curl);

				curl_close($curl);
			}
		}
	}
}
/* AK stop */

?>