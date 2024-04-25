้<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
include '../include/include.php';
include '../include/func_Nop.php';
include '../include/template_user.php';


/* echo check_function('getDataToWhAlert'); */
/* echo "<pre>";
print_r($_POST);
echo "</pre>";
exit; */

function trimBoth($str)
{
	return preg_replace('/^\s+|\s+$/', '', $str);
}
$A = "&SEND_TO=" . $_POST["HIDDEN_SEND_TO"] . "&TO_PERSON_ID=" . $_POST["HIDDEN_TO_PERSON_ID"];
$data = func::get_E_and_D("search_data_process", "E", $A);
function DOSS_OWNER_ID($SEND_TO, $T_BLACK_CASE, $BLACK_CASE, $BLACK_YY, $T_RED_CASE, $RED_CASE, $RED_YY, $COURT_CODE)
{
	$fill = "";
	if ($_POST["TO_T_BLACK_CASE"] != "") {
		$fill .= " and PREFIX_BLACK_CASE = '" . $_POST['TO_T_BLACK_CASE'] . "'	";
	}
	if ($_POST["TO_BLACK_CASE"] != "") {
		$fill .= " and BLACK_CASE = '" . $_POST['TO_BLACK_CASE'] . "'	";
	}
	if ($_POST["TO_BLACK_YY"] != "") {
		$fill .= " and BLACK_YY = '" . $_POST['TO_BLACK_YY'] . "'	";
	}
	if ($_POST["TO_T_RED_CASE"] != "") {
		$fill .= " and PREFIX_RED_CASE = '" . $_POST['TO_T_RED_CASE'] . "'	";
	}
	if ($_POST["TO_RED_CASE"] != "") {
		$fill .= " and RED_CASE = '" . $_POST['TO_RED_CASE'] . "'	";
	}
	if ($_POST["TO_RED_YY"] != "") {
		$fill .= " and RED_YY = '" . $_POST['TO_RED_YY'] . "'	";
	}
	if ($COURT_CODE != "") {
		if ($_POST["SEND_TO"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
			$fill .= " and COURT_ID = '" . $COURT_CODE . "'	";
		} else if ($_POST["SEND_TO"] == 2) {
			$fill .= " and COURT_CODE = '010030'	";
		} else {
			$fill .= " and COURT_CODE = '" . $COURT_CODE . "'	";
		}
	}
	switch ($SEND_TO) {
		case '1':
			$sqlSelectData = "	SELECT 	DOSS_OWNER_ID FROM WH_CIVIL_CASE a 
									inner join WH_CIVIL_DOSS b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
									WHERE 1=1 {$fill}";
			break;
		case '2':
			$sqlSelectData = "	SELECT DOSS_OWNER_ID FROM WH_BANKRUPT_CASE_DETAIL
									WHERE 1=1 {$fill}	";
			break;
		case '3':
			$sqlSelectData = "SELECT DOSS_OWNER_ID  FROM WH_REHABILITATION_CASE_DETAIL  WHERE 1=1 {$fill}	";
			break;
		case '4':
			$sqlSelectData = "SELECT DOSS_OWNER_ID  FROM WH_MEDIATE_CASE a  WHERE 1=1 {$fill}	";
			break;
	}
	$querySelectData = db::query($sqlSelectData);
	$recSelectData = db::fetch_array($querySelectData);
	return	$recSelectData["DOSS_OWNER_ID"];
}
if ($_POST["proc"] == 'add') {


	//คำสั่งหลัก
	unset($fields);
	/* Nop start  */
	/* $fields["REGISTERCODE"] 		= 		$_POST["REGISTERCODE"]; */
	/* Nop stop */
	$fields["CMD_DOC_DATE"] 		= 		date2db($_POST["CMD_DOC_DATE"]);
	$fields["CMD_DOC_TIME"] 		= 		$_POST["CMD_DOC_TIME"];
	$fields["COURT_CODE"] 			= 		trimBoth($_POST["COURT_CODE"]);
	$fields["COURT_NAME"] 			= 		getcourtName($_POST["COURT_CODE"]);

	if ($_POST["HIDDEN_SEND_TO"] != '5') { //ถ้าไม่ใช้backoffice 
		$fields["F_BLACK_CASE"] 		= 		$_POST["T_BLACK_CASE"] . $_POST["BLACK_CASE"] . "/" . $_POST["BLACK_YY"];
		$fields["T_BLACK_CASE"] 		= 		$_POST["T_BLACK_CASE"];
		$fields["BLACK_CASE"] 			= 		$_POST["BLACK_CASE"];
		$fields["BLACK_YY"] 			= 		$_POST["BLACK_YY"];

		$fields["F_RED_CASE"] 			= 		$_POST["T_RED_CASE"] . $_POST["RED_CASE"] . "/" . $_POST["RED_YY"];
		$fields["T_RED_CASE"] 			= 		$_POST["T_RED_CASE"];
		$fields["RED_CASE"] 			= 		$_POST["RED_CASE"];
		$fields["RED_YY"] 				= 		$_POST["RED_YY"];
	}
	$fields["SEND_TO"] 				= 		trimBoth($_POST["SEND_TO"]);


	$fields["REF_ID"] 				= 		trimBoth($_POST["REF_ID"]);

	$fields["COURT_CODE"] 			= 		trimBoth($_POST["COURT_CODE"]); //ศาล

	$fields["CASE_TYPE"] 			= 		trimBoth($_POST["CASE_TYPE"]);
	$fields["CASE_TYPE_NAME"] 		= 		getCaseName($_POST["CASE_TYPE"]);

	$fields["SEND_STATUS"] 			= 		0;

	$fields["CMD_NOTE"] 			= 		$_POST["CMD_NOTE"];

	$fields["OFFICE_IDCARD"] 		= 		trimBoth($_POST["OFFICE_IDCARD"]);
	$fields["OFFICE_NAME"] 			= 		trimBoth($_POST["OFFICE_NAME"]);
	/* ถ้าเลือกเป็นสอบถามความประสงค์ start */
	if (($_POST["HIDDEN_SEND_TO"] == '1' || $_POST["HIDDEN_SEND_TO"] == '3' || $_POST["HIDDEN_SEND_TO"] == '4') && ($_POST["APPROVE_PERSON"] == $_POST["HIDDEN_TO_PERSON_ID"] || $_POST["APPROVE_PERSON"] == "")) { //ถ้าเป็น เเพ่ง ฟื้นฟู ไกล่เกลี่ย ไม่พิจารณา
		$APPROVE_STATUS = 1; //ไม่ต้องพิจารณาให้ใช้1
		$fields["TRANSACTION_STATUS_APP"] 			= 		'1';
	} else if ($_POST["HIDDEN_SEND_TO"] == '2') { //ถ้าเป็นระบบล้มละลาย
		if ($_POST["HIDDEN_TO_PERSON_ID"] == $_POST["APPROVE_PERSON"]) { //เลือกตัวเองในการพิจารณา ไม่ต้องพิจารณา
			$APPROVE_STATUS = 1; //ไม่ต้องพิจารณาให้ใช้1
			$fields["TRANSACTION_STATUS_APP"] 	= 	'1';
		} else { //ถ้าไม่เลือกตัวเองต้องพิจารณา
			$APPROVE_STATUS = 0;
		}
	} else if ($_POST["HIDDEN_SEND_TO"] == '5') {
		$APPROVE_STATUS = 1; //ไม่ต้องพิจารณาให้ใช้1
		$fields["TRANSACTION_STATUS_APP"] 	= 	'1';
	} else {
		$APPROVE_STATUS = 0;
	}

	/* ถ้าเลือกเป็นสอบถามความประสงค์ stop */

	$fields["APPROVE_STATUS"] 		= 		$APPROVE_STATUS;
	$fields["PLAINTIFF"] 			= 		trimBoth($_POST["D_C"]);
	$fields["DEFENDANT"] 			= 		trimBoth($_POST["D_NAME"]);

	$fields["SEND_TO_PERSON"] 		= 		trimBoth($_POST["sendToPerson"]);

	$fields["CMD_READ_STATUS"] 		= 		0;
	$fields["CMD_DETAIL"] 			= 		$_POST["CMD_NOTE"];


	$fields["CMD_SYSTEM"] 			= 		trimBoth($_POST["SYSTEM_ID"]);
	$fields["CMD_SYSTEM_ID"] 		= 		trimBoth($_POST["SYSTEM_ID"]);
	$fields["SYSTEM_NAME"] 			= 		getsystemName($_POST["SYSTEM_ID"]);
	$fields["SYS_NAME"] 			= 		trimBoth($_POST["SYSTEM_ID"]);

	$fields["CMD_TYPE"] 			= 		trimBoth($_POST["CMD_TYPE"]);

	//$fields["CMD_NAME_ORDER"] 		= 		getCmdName($_POST["CMD_TYPE"]);

	$fields["APPROVE_PERSON"] 		= 		trimBoth($_POST["APPROVE_PERSON"]);
	$fields["TO_T_BLACK_CASE"] 		= 		trimBoth($_POST["TO_T_BLACK_CASE"]);
	$fields["TO_BLACK_CASE"]		= 		trimBoth($_POST["TO_BLACK_CASE"]);
	$fields["TO_BLACK_YY"] 			= 		trimBoth($_POST["TO_BLACK_YY"]);

	$fields["TO_T_RED_CASE"] 		= 		trimBoth($_POST["TO_T_RED_CASE"]);
	$fields["TO_RED_CASE"] 			= 		trimBoth($_POST["TO_RED_CASE"]);
	$fields["TO_RED_YY"] 			= 		trimBoth($_POST["TO_RED_YY"]);

	$fields["TO_COURT_CODE"] 		= 		trimBoth($_POST["TO_COURT_CODE"]);
	$fields["TO_COURT_NAME"] 		= 		trimBoth(getcourtName($_POST["TO_COURT_CODE"]));

	$fields["TO_PLAINTIFF"] 		= 		trimBoth($_POST["TO_PLAINTIFF"]);
	$fields["TO_DEFENDANT"] 		= 		trimBoth($_POST["TO_DEFENDANT"]);

	$fields["PCC_CASE_GEN"] 		= 		trimBoth($_POST["PCC_CASE_GEN"]);
	$fields["CMD_MANUAL_STATUS"] 	= 		trimBoth($_POST["CMD_MANUAL_STATUS"]);
	$fields["GET_PER_TYPE"] 		= 		trimBoth($_POST["GET_PER_TYPE"]);



	if ($_REQUEST["REF_ID"] > 0) {
		if ($_POST["DOSS_OWNER_ID"] == "") {
			$DOSS_OWNER_ID = "";
			$DOSS_OWNER_ID = DOSS_OWNER_ID(
				$_POST["SEND_TO"],
				$_POST['TO_T_BLACK_CASE'],
				$_POST['TO_BLACK_CASE'],
				$_POST['TO_BLACK_YY'],
				$_POST['TO_T_RED_CASE'],
				$_POST['TO_RED_CASE'],
				$_POST['TO_RED_YY'],
				$_POST["TO_COURT_CODE"]
			);
			$fields["TO_PERSON_ID"] = 	$DOSS_OWNER_ID;
		} else {
			$fields["TO_PERSON_ID"] = 	$_POST["DOSS_OWNER_ID"];
		}
	} else {
		$DOSS_OWNER_ID = "";
		$DOSS_OWNER_ID = DOSS_OWNER_ID(
			$_POST["SEND_TO"],
			$_POST['T_BLACK_CASE'],
			$_POST['BLACK_CASE'],
			$_POST['BLACK_YY'],
			$_POST['T_RED_CASE'],
			$_POST['RED_CASE'],
			$_POST['RED_YY'],
			$_POST['TO_COURT_CODE']
		);
		//การfig ค่าปลายทาง
		/* if ($_POST["SEND_TO"] == 2) { 
			$DOSS_OWNER_ID = "3100903272320";
		} else if ($_POST["SEND_TO"] == 3) {
			$DOSS_OWNER_ID = "1103411005612";
		} else if ($_POST["SEND_TO"] == 4) {
			$DOSS_OWNER_ID = "1103411005612";
		} else {
			$DOSS_OWNER_ID = "3920300038603";
		} */
		if ($_POST["SEND_TO"] == 2) {
			$DOSS_OWNER_ID = "3100903272320";
		}
		$fields["TO_PERSON_ID"] 		= 		$DOSS_OWNER_ID; //$_POST["TO_PERSON_ID"];
	}
	$fields["CMD_FIX_DATE_STATUS"] = $_POST["CMD_FIX_DATE_STATUS"];
	if ($_POST["CMD_FIX_DATE_STATUS"] == 'Y') {
		$fields["CMD_FIX_DOC_DATE"] = date2db($_POST["CMD_FIX_DOC_DATE"]);
	}
	/* echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	echo "<pre>";
	print_r($fields);
	echo "</pre>";
	exit; */

	$CMD_ID = db::db_insert("M_DOC_CMD", $fields, 'ID', 'ID');


	/* เก็บ HISTORY start */
	$fields_COMMAND_HISTORY['ID_OF_M_DOC_CMD'] = $CMD_ID;
	$fields_COMMAND_HISTORY['CMD_DOC_DATE'] = date2db($_POST["CMD_DOC_DATE"]);
	$fields_COMMAND_HISTORY['CMD_DOC_TIME'] = $_POST["CMD_DOC_TIME"];
	$fields_COMMAND_HISTORY['SEND_TO'] = $_POST["SEND_TO"];
	$fields_COMMAND_HISTORY['SYS_NAME'] = $_POST["SYSTEM_ID"];
	$fields_COMMAND_HISTORY['CMD_NOTE'] = $_POST["CMD_NOTE"];
	$fields_COMMAND_HISTORY['REF_ID'] = $_POST["REF_ID"];
	$fields_COMMAND_HISTORY['PROC'] = $_POST["proc"];
	$fields_COMMAND_HISTORY['TO_PERSON_ID'] = $_POST["HIDDEN_TO_PERSON_ID"];
	/* if($_POST["SEND_TO"]==1){
		
	} */
	$CODE_API = $_POST["PCC_CIVIL_GEN"];
	$fields_COMMAND_HISTORY['CODE_API'] = $CODE_API;
	db::db_insert("M_COMMAND_HISTORY", $fields_COMMAND_HISTORY, 'ID_COMMAND', 'ID_COMMAND');
	/* เก็บ HISTORY stop */

	//รายละเอียดคำสั่ง
	unset($fields);
	$fields["CMD_ID"] 	= 	$CMD_ID;
	$fields["CMD_NOTE"] =	$_POST["CMD_NOTE"];
	db::db_insert("M_CMD_DETAILS", $fields, 'CMD_DETAIL_ID', 'CMD_DETAIL_ID');

	//รายการทรัพย์ในคำสั่ง
	if (count($_POST["ASSET_ID"]) > 0) {
		foreach ($_POST["ASSET_ID"] as $key => $val) {
			unset($fields);
			$fields["CMD_ID"] 				= 	$CMD_ID;
			$fields["ASSET_ID"] 			= 	$val;
			$fields["PROP_DET"] 			= 	$_POST["PROP_TITLE"][$key];
			$fields["TYPE_CODE"] 			= 	$_POST["TYPE_CODE"][$key];
			$fields["TYPE_DESC"] 			= 	$_POST["TYPE_DESC"][$key];
			$fields["PROP_STATUS"] 			= 	$_POST["PROP_STATUS"][$key];
			$fields["PROP_STATUS_NAME"] 	= 	$_POST["PROP_STATUS_NAME"][$key];
			$fields["CFC_CAPTION_GEN"] 		= 	$_POST["CFC_CAPTION_GEN"][$key];
			$fields["ASSET_CMD_TYPE"] 		= 	$_POST["CMD_TYPE"][$key];
			$fields["ASSET_CASE_TYPE"] 		= 	$_POST["CASE_TYPE"][$key];
			db::db_insert("M_CMD_ASSET", $fields, 'CMD_ASSET_ID', 'CMD_ASSET_ID');
		}
	}

	//คนในคำสั่ง
	if (count($_POST["LIST_REGISTER_CODE"]) > 0) {
		foreach ($_POST["LIST_REGISTER_CODE"] as $key => $val) {
			unset($fields);
			$fields["CMD_ID"] 				= 	$CMD_ID;
			$fields["ID_CARD"] 				= 	$val;
			$fields["PREFIX_NAME"] 			= 	$_POST["GET_PREFIX_NAME"][$val];
			$fields["FIRST_NAME"] 			= 	$_POST["GET_FIRST_NAME"][$val];
			$fields["LAST_NAME"] 			= 	$_POST["GET_LAST_NAME"][$val];
			$fields["FULL_NAME"] 			= 	$_POST["GET_PREFIX_NAME"][$val] . $_POST["GET_FIRST_NAME"][$val] . " " . $_POST["GET_LAST_NAME"][$val];
			$fields["ADDRESS"] 				= 	$val["address"];
			$fields["PHONE"] 				= 	$val["phone"];
			$fields["FAX"] 					= 	$val["fax"];
			$fields["MOBILE"] 				= 	$val["mobile"];
			$fields["EMAIL"] 				= 	$val["email"];
			$fields["PERSON_CMD_TYPE"] 		= 	$_POST["CMD_TYPE_PERSON"][$key];
			$fields["PERSON_CASE_TYPE"] 	= 	$_POST["CASE_TYPE_PERSON"][$key];
			db::db_insert("M_CMD_PERSON", $fields, 'PERSON_ID', 'PERSON_ID');
		}
	}
	db::query("UPDATE FRM_CMD_FILE SET WFR_ID = " . $CMD_ID . " WHERE WFR_ID = '" . $_POST["attachid"] . "' ");
	getDataToWhAlert($_POST["APPROVE_PERSON"]);

?>
	<script>
		const ID = <?php echo $CMD_ID ?>;
		const APPSTATUS = <?php echo $APPROVE_STATUS ?>;

		if (ID !== "" && APPSTATUS === 1) {
			workFunc(ID, APPSTATUS);
			console.log('ทำงาน');
			console.log('ID:', ID);
			console.log('APPSTATUS:', APPSTATUS);
		} else if (APPSTATUS === 0) {
			show_loading();
			console.log('ทำงาน1');
			self.location.href = 'search_data_cmd.php?<?php echo $data; ?>';
			//self.location.href = 'search_data_cmd.php?SEND_TO=<?php echo $_POST["HIDDEN_SEND_TO"]; ?>&TO_PERSON_ID=<?php echo $_POST["HIDDEN_TO_PERSON_ID"]; ?>';
		}

		function workFunc(ID, APPSTATUS) {
			$(document).ready(function() {
				$.ajax({
					type: "POST",
					url: "get_data_ajax.php",
					data: {
						proc: 'updateCmd',
						APPROVE_STATUS: "1",
						ID: ID,
						TO_PERSON_ID: APPSTATUS
					},
					cache: false,
					success: function(msg) {
						// จัดการกรณีที่สำเร็จได้ที่นี่ (ถ้าจำเป็น)
						show_loading();
						console.log('ทำงาน2');
						console.log(msg);
						self.location.href = 'search_data_cmd.php?<?php echo $data; ?>';
						//self.location.href = 'search_data_cmd.php?SEND_TO=<?php echo $_POST["HIDDEN_SEND_TO"]; ?>&TO_PERSON_ID=<?php echo $_POST["HIDDEN_TO_PERSON_ID"]; ?>';
					},
					error: function(xhr, textStatus, errorThrown) {
						// จัดการกรณีเกิดข้อผิดพลาดได้ที่นี่ (ถ้าจำเป็น)
						console.error('AJAX Error:', textStatus, errorThrown);
					}
				});
			});
		}
	</script>

<?php
} else if ($_POST["proc"] == 'edit') {
	/* print_r_pre($_POST);
	exit; */
	//คำสั่งหลัก
	unset($fields);
	$fields["CMD_DOC_DATE"] 		= 		date2db($_POST["CMD_DOC_DATE"]);
	$fields["CMD_DOC_TIME"] 		= 		$_POST["CMD_DOC_TIME"];
	$fields["COURT_CODE"] 			= 		$_POST["COURT_CODE"];
	$fields["COURT_NAME"] 			= 		getcourtName($_POST["COURT_CODE"]);
	$fields["F_BLACK_CASE"] 		= 		$_POST["T_BLACK_CASE"] . $_POST["BLACK_CASE"] . "/" . $_POST["BLACK_YY"];
	$fields["T_BLACK_CASE"] 		= 		$_POST["T_BLACK_CASE"];
	$fields["BLACK_CASE"] 			= 		$_POST["BLACK_CASE"];
	$fields["BLACK_YY"] 			= 		$_POST["BLACK_YY"];

	$fields["F_RED_CASE"] 			= 		$_POST["T_RED_CASE"] . $_POST["RED_CASE"] . "/" . $_POST["RED_YY"];
	$fields["T_RED_CASE"] 			= 		$_POST["T_RED_CASE"];
	$fields["RED_CASE"] 			= 		$_POST["RED_CASE"];
	$fields["RED_YY"] 				= 		$_POST["RED_YY"];

	$fields["SEND_TO"] 				= 		$_POST["SEND_TO"];

	if ($_POST['subID'] == 'edit') {
	} else {
		$fields["REF_ID"] 				= 		$_POST["REF_ID"];
	}

	$fields["COURT_CODE"] 			= 		$_POST["COURT_CODE"]; //ศาล

	$fields["CASE_TYPE"] 			= 		$_POST["CASE_TYPE"];
	$fields["CASE_TYPE_NAME"] 		= 		getCaseName($_POST["CASE_TYPE"]);

	$fields["SEND_STATUS"] 			= 		0;

	$fields["CMD_NOTE"] 			= 		$_POST["CMD_NOTE"];

	$fields["OFFICE_IDCARD"] 		= 		$_POST["OFFICE_IDCARD"];
	$fields["OFFICE_NAME"] 			= 		$_POST["OFFICE_NAME"];

	$fields["APPROVE_STATUS"] 		= 		0;
	$fields["PLAINTIFF"] 			= 		$_POST["D_C"];
	$fields["DEFENDANT"] 			= 		$_POST["D_NAME"];

	$fields["SEND_TO_PERSON"] 		= 		$_POST["sendToPerson"];

	$fields["CMD_READ_STATUS"] 		= 		0;
	$fields["CMD_DETAIL"] 			= 		$_POST["CMD_NOTE"];


	$fields["CMD_SYSTEM"] 			= 		$_POST["SYSTEM_ID"];
	$fields["CMD_SYSTEM_ID"] 		= 		$_POST["SYSTEM_ID"];
	$fields["SYSTEM_NAME"] 			= 		getsystemName($_POST["SYSTEM_ID"]);
	$fields["SYS_NAME"] 			= 		$_POST["SYSTEM_ID"];

	$fields["CMD_TYPE"] 			= 		$_POST["CMD_TYPE"];
	//$fields["CMD_NAME_ORDER"] 		= 		getCmdName($_POST["CMD_TYPE"]);



	$fields["APPROVE_PERSON"] 		= 		$_POST["APPROVE_PERSON"];

	$fields["TO_T_BLACK_CASE"] 		= 		$_POST["TO_T_BLACK_CASE"];
	$fields["TO_BLACK_CASE"]		= 		$_POST["TO_BLACK_CASE"];
	$fields["TO_BLACK_YY"] 			= 		$_POST["TO_BLACK_YY"];

	$fields["TO_T_RED_CASE"] 		= 		$_POST["TO_T_RED_CASE"];
	$fields["TO_RED_CASE"] 			= 		$_POST["TO_RED_CASE"];
	$fields["TO_RED_YY"] 			= 		$_POST["TO_RED_YY"];

	$fields["TO_COURT_CODE"] 		= 		$_POST["TO_COURT_CODE"];
	$fields["TO_COURT_NAME"] 		= 		getcourtName($_POST["TO_COURT_CODE"]);

	$fields["TO_PLAINTIFF"] 		= 		$_POST["TO_PLAINTIFF"];
	$fields["TO_DEFENDANT"] 		= 		$_POST["TO_DEFENDANT"];

	$fields["CMD_MANUAL_STATUS"] 	= 		$_POST["CMD_MANUAL_STATUS"];

	if ($_REQUEST["REF_ID"] > 0) {
		//$fields["TO_PERSON_ID"] 		= 		$_POST["DOSS_OWNER_ID"];
	} else {
		$DOSS_OWNER_ID = "";
		$DOSS_OWNER_ID = DOSS_OWNER_ID(
			$_POST["SEND_TO"],
			$_POST['T_BLACK_CASE'],
			$_POST['BLACK_CASE'],
			$_POST['BLACK_YY'],
			$_POST['T_RED_CASE'],
			$_POST['RED_CASE'],
			$_POST['RED_YY'],
			$_POST['TO_COURT_CODE']
		);
		if ($_POST["SEND_TO"] == 2) {
			//$DOSS_OWNER_ID = "3100903272320";
		}
		//$fields["TO_PERSON_ID"] 		= 		$DOSS_OWNER_ID; 
	}
	$fields["CMD_FIX_DATE_STATUS"] = $_POST["CMD_FIX_DATE_STATUS"];
	if ($_POST["CMD_FIX_DATE_STATUS"] == 'Y') {
		$fields["CMD_FIX_DOC_DATE"] = date2db($_POST["CMD_FIX_DOC_DATE"]);
	} else {
		$fields["CMD_FIX_DOC_DATE"] = NULL;
	}


	db::db_update("M_DOC_CMD", $fields, array('ID' => $_POST["CMD_ID"]));

	/* เก็บ HISTORY start */
	$fields_COMMAND_HISTORY['ID_OF_M_DOC_CMD'] = $_POST["CMD_ID"];
	$fields_COMMAND_HISTORY['CMD_DOC_DATE'] = date2db($_POST["CMD_DOC_DATE"]);
	$fields_COMMAND_HISTORY['CMD_DOC_TIME'] = $_POST["CMD_DOC_TIME"];
	$fields_COMMAND_HISTORY['SEND_TO'] = $_POST["SEND_TO"];
	$fields_COMMAND_HISTORY['SYS_NAME'] = $_POST["SYSTEM_ID"];
	$fields_COMMAND_HISTORY['CMD_NOTE'] = $_POST["CMD_NOTE"];
	$fields_COMMAND_HISTORY['REF_ID'] = $_POST["CMD_ID"];
	$fields_COMMAND_HISTORY['PROC'] = $_POST["proc"];
	$fields_COMMAND_HISTORY['TO_PERSON_ID'] = $_POST["HIDDEN_TO_PERSON_ID"];
	/* if($_POST["SEND_TO"]==1){
		
	} */
	$CODE_API = $_POST["PCC_CIVIL_GEN"];
	$fields_COMMAND_HISTORY['CODE_API'] = $CODE_API;
	db::db_insert("M_COMMAND_HISTORY", $fields_COMMAND_HISTORY, 'ID_COMMAND', 'ID_COMMAND');
	/* เก็บ HISTORY stop */


	//รายละเอียดคำสั่ง
	db::db_delete("M_CMD_DETAILS", array('CMD_ID' => $_POST["CMD_ID"]));
	unset($fields);
	$fields["CMD_ID"] 	= 	$_POST["CMD_ID"];
	$fields["CMD_NOTE"] =	$_POST["CMD_NOTE"];
	db::db_insert("M_CMD_DETAILS", $fields, 'CMD_DETAIL_ID', 'CMD_DETAIL_ID');

	//รายการทรัพย์ในคำสั่ง
	db::db_delete("M_CMD_ASSET", array('CMD_ID' => $_POST["CMD_ID"]));
	//รายการทรัพย์ในคำสั่ง
	if (count($_POST["ASSET_ID"]) > 0) {
		foreach ($_POST["ASSET_ID"] as $key => $val) {
			unset($fields);
			$fields["CMD_ID"] 				= 	$_POST["CMD_ID"];
			$fields["ASSET_ID"] 			= 	$val;
			$fields["PROP_DET"] 			= 	$_POST["PROP_TITLE"][$key];
			$fields["TYPE_CODE"] 			= 	$_POST["TYPE_CODE"][$key];
			$fields["TYPE_DESC"] 			= 	$_POST["TYPE_DESC"][$key];
			$fields["PROP_STATUS"] 			= 	$_POST["PROP_STATUS"][$key];
			$fields["PROP_STATUS_NAME"] 	= 	$_POST["PROP_STATUS_NAME"][$key];
			$fields["CFC_CAPTION_GEN"] 		= 	$_POST["CFC_CAPTION_GEN"][$key];
			$fields["ASSET_CMD_TYPE"] 		= 	$_POST["CMD_TYPE"][$key];
			$fields["ASSET_CASE_TYPE"] 		= 	$_POST["CASE_TYPE"][$key];
			db::db_insert("M_CMD_ASSET", $fields, 'CMD_ASSET_ID', 'CMD_ASSET_ID');
		}
	}

	//คนในคำสั่ง
	db::db_delete("M_CMD_PERSON", array('CMD_ID' => $_POST["CMD_ID"]));
	//คนในคำสั่ง
	if (count($_POST["LIST_REGISTER_CODE"]) > 0) {
		foreach ($_POST["LIST_REGISTER_CODE"] as $key => $val) {
			unset($fields);
			$fields["CMD_ID"] 				= 	$_POST["CMD_ID"];
			$fields["ID_CARD"] 				= 	$val;
			$fields["PREFIX_NAME"] 			= 	$_POST["GET_PREFIX_NAME"][$val];
			$fields["FIRST_NAME"] 			= 	$_POST["GET_FIRST_NAME"][$val];
			$fields["LAST_NAME"] 			= 	$_POST["GET_LAST_NAME"][$val];
			$fields["FULL_NAME"] 			= 	$_POST["GET_PREFIX_NAME"][$val] . $_POST["GET_FIRST_NAME"][$val] . " " . $_POST["GET_LAST_NAME"][$val];
			$fields["ADDRESS"] 				= 	$val["address"];
			$fields["PHONE"] 				= 	$val["phone"];
			$fields["FAX"] 					= 	$val["fax"];
			$fields["MOBILE"] 				= 	$val["mobile"];
			$fields["EMAIL"] 				= 	$val["email"];
			$fields["PERSON_CMD_TYPE"] 		= 	$_POST["CMD_TYPE_PERSON"][$key];
			$fields["PERSON_CASE_TYPE"] 	= 	$_POST["CASE_TYPE_PERSON"][$key];
			db::db_insert("M_CMD_PERSON", $fields, 'PERSON_ID', 'PERSON_ID');
		}
	}


	db::query("UPDATE FRM_CMD_FILE SET WFR_ID = " . $_POST["CMD_ID"] . " WHERE WFR_ID = '" . $_POST["attachid"] . "' ");

	getDataToWhAlert($_POST["APPROVE_PERSON"]);
} elseif ($_POST["proc"] == 'delete') {
	db::db_delete("M_DOC_CMD", array('ID' => $_POST["CMD_ID"]));
	//db::db_delete("M_DOC_CMD", array('PARENT' => $_POST["CMD_ID"]));
	db::db_delete("M_CMD_ASSET", array('CMD_ID' => $_POST["CMD_ID"]));
	db::db_delete("M_CMD_PERSON", array('CMD_ID' => $_POST["CMD_ID"]));
	db::db_delete("M_CMD_DETAILS", array('CMD_ID' => $_POST["CMD_ID"]));
	db::db_delete("M_COMMAND_HISTORY", array('ID_OF_M_DOC_CMD' => $_POST["CMD_ID"]));
	echo 1;
}

?>
<script type="text/javascript">
	const proc = '<?php echo $_POST["proc"] ?>'
	if (proc == "edit") {
		self.location.href = 'search_data_cmd.php?<?php echo $data; ?>';
		//self.location.href = 'search_data_cmd.php?SEND_TO=<?php echo $_POST["HIDDEN_SEND_TO"]; ?>&TO_PERSON_ID=<?php echo $_POST["HIDDEN_TO_PERSON_ID"]; ?>';
	} else {
		//self.location.href = 'search_data_cmd.php?<?php echo $data; ?>';
		//self.location.href = 'search_data_cmd.php?SEND_TO=<?php echo $_POST["HIDDEN_SEND_TO"]; ?>&TO_PERSON_ID=<?php echo $_POST["HIDDEN_TO_PERSON_ID"]; ?>';
	}
</script>