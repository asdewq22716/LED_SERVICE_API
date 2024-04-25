<?php
include '../include/include.php';

getBankruptToWh_num($_GET["brcId"], $_GET["show_data"]);


/* Nop start ดึงล้มละลาย ให้เรียงโจทย์จำเลยตามลำดับ */

function getBankruptToWh_num_exit($brcId = "", $show_data = "")//ถ้าจะใช้ให้ลบ_exitออก
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://103.40.146.180/api/public/CheckCaseByID',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 300,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{
		"brcId":"' . $brcId . '"
	}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataJson = json_decode($response, true);


	if ($show_data == 'Y') {
		print_pre($dataJson);
	}


	$data_main = $dataJson["data"]["Data"][0];

	$sqlSelectData = "	select 		WH_BANKRUPT_ID
						from 		WH_BANKRUPT_CASE_DETAIL
						where 		BANKRUPT_CODE = '" . $data_main["bankruptCode"] . "' ";


	$querySelectData = db::query($sqlSelectData);
	$dataSelectData = db::fetch_array($querySelectData);

	//case
	unset($fields);
	$fields["BANKRUPT_CODE"] 		= $data_main["bankruptCode"];
	$fields["COURT_CODE"] 			= $data_main["courtCode"];
	$fields["COURT_NAME"] 			= $data_main["courtName"];
	$fields["DEPT_CODE"] 			= $data_main["deptCode"];
	$fields["DEPT_NAME"] 			= $data_main["deptName"];
	$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
	$fields["BLACK_CASE"] 			= $data_main["blackCase"];
	$fields["BLACK_YY"] 			= $data_main["blackYY"];
	$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
	$fields["RED_CASE"] 			= $data_main["redCase"];
	$fields["RED_YY"] 				= $data_main["redYY"];
	$fields["COURT_DATE"] 			= substr($data_main["courtDate"], 0, 10);
	$fields["CAPITAL_AMOUNT"] 		= $data_main["capitalAmount"];
	$fields["DOSS_OWNER_ID"] 		= $data_main["onwerIdcard"];
	$fields["DOSS_OWNER_NAME"] 		= $data_main["onwerName"];
	$fields["PLAINTIFF1"] 			= $data_main["plaintiff"][0];
	$fields["PLAINTIFF2"] 			= $data_main["plaintiff"][1];
	$fields["PLAINTIFF3"] 			= $data_main["plaintiff"][2];
	$fields["DEFFENDANT1"] 			= $data_main["deffendant"][0];
	$fields["DEFFENDANT2"] 			= $data_main["defendant2"][1];
	$fields["DEFFENDANT3"] 			= $data_main["defendant3"][2];
	if ($dataSelectData["WH_BANKRUPT_ID"] > 0) {
		db::db_update("WH_BANKRUPT_CASE_DETAIL", $fields, array('WH_BANKRUPT_ID' => $dataSelectData["WH_BANKRUPT_ID"]));
		$WH_BANKRUPT_ID = $dataSelectData["WH_BANKRUPT_ID"];
	} else {
		$WH_BANKRUPT_ID = db::db_insert("WH_BANKRUPT_CASE_DETAIL", $fields, 'WH_BANKRUPT_ID', 'WH_BANKRUPT_ID');
	}

	db::db_delete("WH_COURT_LOG", array('COURT_SYSTEM_TYPE' => '2', 'BLACK_CASE' => $data_main["blackCase"], 'BLACK_YY' => $data_main["blackYY"], 'RED_CASE' => $data_main["redCase"], 'RED_YY' => $data_main["redYY"]));

	$ORD_STATUS = "";
	if (count($data_main['courtOrderHis']) > 0) {
		foreach ($data_main['courtOrderHis'] as $key => $datacourtOrderHis) {
			unset($fields);
			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["COURT_NAME"] 			= $data_main["courtName"];
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYY"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYY"];
			$fields["COURT_SYSTEM_TYPE"] 	= 2;
			$fields["COURT_DATE"] 			= substr($datacourtOrderHis["courtOrderDate"], 0, 10);
			$fields["COURT_DETAIL"] 		= $datacourtOrderHis["annName"];


			if ($datacourtOrderHis["annName"] == 'คำสั่งพิทักษ์ทรัพย์เด็ดขาด' || $datacourtOrderHis["annName"] == 'คำสั่งพิทักษ์ทรัพย์ชั่วคราว' || $datacourtOrderHis["annName"] == 'คำพิพากษาจัดการทรัพย์มรดก' || $datacourtOrderHis["annName"] == 'ยกเลิกประนอมหนี้ก่อนล้มและพิพากษาล้มละลาย' || $datacourtOrderHis["annName"] == 'ยกเลิกประนอมหนี้หลังล้มและพิพากษาล้มละลาย' || $datacourtOrderHis["annName"] == 'พิพากษาล้มละลาย' || $datacourtOrderHis["annName"] == 'พิทักษ์ทรัพย์เด็ดขาดและจัดการทรัพย์มรดก' || $datacourtOrderHis["annName"] == 'เห็นชอบการประนอมหนี้หลังล้มละลายและยกเลิกการล้มละลาย') {
				$fields["ORD_STATUS"] = 'บังคับคดี';
			} else {
				$fields["ORD_STATUS"] = 'ไม่บังคับคดี';
			}

			$ORD_STATUS = $fields["ORD_STATUS"];
			db::db_insert("WH_COURT_LOG", $fields, 'WH_COURT_LOG_ID', 'WH_COURT_LOG_ID');
		}
	}

	$getRegisterCode = "";
	//person คนในคดี
	db::db_delete("WH_BANKRUPT_CASE_PERSON", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
	if (count($data_main['person']) > 0) {
		foreach ($data_main['person'] as $key => $data_person) {
			unset($fields);
			$fields["WH_BANKRUPT_ID"] 		= $WH_BANKRUPT_ID;
			$fields["PERSON_CODE"] 			= $data_person["personCode"];
			$fields["REGISTER_CODE"] 		= $data_person["registerCode"];
			$fields["PREFIX_CODE"] 			= $data_person["preFixName"];

			$fields["PREFIX_NAME"] 			= $data_person["preFixName"];
			$fields["FIRST_NAME"] 			= (trim($data_person["firstName"]) != "") ? $data_person["firstName"] : $data_person["fullName"];
			$fields["LAST_NAME"] 			= $data_person["lastName"];
			//$fields["FULL_NAME"] 			= $data_person["personFullName"];

			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["COURT_NAME"] 			= $data_main["courtName"];
			$fields["DEPT_CODE"] 			= $data_main["deptCode"];
			$fields["DEPT_NAME"] 			= $data_main["deptName"];
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYY"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYY"];

			$fields["ADDRESS"] 				= $data_person["houseNo"];
			$fields["TUM_CODE"] 			= $data_person["tumCode"];
			$fields["TUM_NAME"] 			= $data_person["tumName"];
			$fields["AMP_CODE"] 			= $data_person["ampCode"];
			$fields["AMP_NAME"] 			= $data_person["ampName"];
			$fields["PROV_CODE"] 			= $data_person["provCode"];
			$fields["PROV_NAME"] 			= $data_person["prvName"];
			$fields["ZIP_CODE"] 			= $data_person["postCode"];
			$fields["CONCERN_CODE"] 		= ($data_person["personType"] == '06') ? '02' : $data_person["personType"];
			$fields["CONCERN_NAME"] 		= ($data_person["personStatus"] == 'เจ้าหนี้') ? $data_person["personStatus"] : $data_person["conernName"];
			$fields["CONCERN_NO"] 			= $data_person["concernNo"];
			$fields["MOO"] 					= $data_person["moo"];
			$fields["SOI"] 					= $data_person["soi"];

			$fields["CONERNSEQ"] 					= $data_person["conernSeq"]; //Nop 

			$fields["COMP_PAY_DEPT_DATE"] 	= substr($data_person["appDate"], 0, 10);

			if ($data_person["personType"] == '06') {
				if ($ORD_STATUS == 'บังคับคดี') {
					$fields["LOCK_PERSON_STATUS_TEXT"] = "บุคคลล้มละลาย";
					$fields["PER_ORDER_STATUS"] = "บังคับคดี";
				} else {
					$fields["LOCK_PERSON_STATUS_TEXT"] = "ไม่เป็นบุคคลล้มละลาย";
					$fields["PER_ORDER_STATUS"] = "ไม่บังคับคดี";
				}
				$getRegisterCode = $data_person["registerCode"];
			}
			db::db_insert("WH_BANKRUPT_CASE_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');
		}
	}


	unset($fieldsCourtLog);
	$fieldsCourtLog["COURT_REGISTER_CODE"] 	= $getRegisterCode;
	db::db_update("WH_COURT_LOG", $fieldsCourtLog, array('COURT_SYSTEM_TYPE' => '2', 'BLACK_CASE' => $data_main["blackCase"], 'BLACK_YY' => $data_main["blackYY"], 'RED_CASE' => $data_main["redCase"], 'RED_YY' => $data_main["redYY"]));

	//person
	db::db_delete("WH_BANKRUPT_DOCKET", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
	db::db_delete("WH_BANKRUPT_BALANCE_PERSON", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
	if (count($data_main['docket']) > 0) {
		foreach ($data_main['docket'] as $key => $data_docket) {
			unset($fields);
			$fields["WH_BANKRUPT_ID"] 		= $WH_BANKRUPT_ID;
			$fields["DOCKET_TYPE"] 			= $data_docket["dytCode"];
			$fields["DOCKET_NAME"] 			= $data_docket["dytName"];
			$fields["DOCKET_SUBJECT"] 		= $data_docket["subject"];
			$fields["AMOUNT_OF_DEBT"] 		= $data_docket["dobValue"];
			$fields["AMOUNT_OF_DEBT_ALLOW"] = $data_docket["debtAmount"];
			$fields["DOCKET_OWNER"] 		= $data_docket["usrName"];
			db::db_insert("WH_BANKRUPT_DOCKET", $fields, 'DOCKET_ID', 'DOCKET_ID');


			unset($fields);
			$fields["WH_BANKRUPT_ID"] 		= $WH_BANKRUPT_ID;
			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYY"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYY"];
			$fields["BALANCE_ALL"] 			= $data_docket["dobValue"];
			$fields["BALANCE_1"] 			= $data_docket["debtAmount"];
			$fields["REGISTER_CODE"] 		= $data_docket["perIdcard"];
			db::db_insert("WH_BANKRUPT_BALANCE_PERSON", $fields, 'WH_REH_BAL_ID', 'WH_REH_BAL_ID');
		}
	}


	db::db_delete("WH_BANKRUPT_DOC", array('BANKRUPT_CODE' => $data_main["bankruptCode"]));
	if (count($data_main["DocFile"]) > 0) {
		foreach ($data_main["DocFile"] as $key => $valFile) {
			unset($fields);
			$fields["BANKRUPT_CODE"] 		= $data_main["bankruptCode"];
			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["COURT_NAME"] 			= $data_main["courtName"];
			$fields["DEPT_CODE"] 			= $data_main["deptCode"];
			$fields["DEPT_NAME"] 			= $data_main["deptName"];
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYY"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYY"];
			$fields["DOC_DATE"] 			= substr($valFile["dofCreateDate"], 0, 10);
			$fields["DOC_REF_ID"] 			= $valFile["dofIdPk"];
			$fields["DOC_NAME"] 			= $valFile["dofFileName"];
			$fields["PLAINTIFF1"] 			= $data_main["plaintiff"][0];
			$fields["PLAINTIFF2"] 			= $data_main["plaintiff"][1];
			$fields["PLAINTIFF3"] 			= $data_main["plaintiff"][2];
			$fields["DEFFENDANT1"] 			= $data_main["deffendant"][0];
			$fields["DEFFENDANT2"] 			= $data_main["defendant2"][1];
			$fields["DEFFENDANT3"] 			= $data_main["defendant3"][2];
			$fields["RECORD_COUNT"] 		= count($data_main["DocFile"]);
			db::db_insert("WH_BANKRUPT_DOC", $fields, 'DOC_ID', 'DOC_ID');
		}
	}


	/* start เพิ่มการบันทึก ทรัพ เเละ ทรัพเป็นของใคร */
	db::db_delete("WH_BANKRUPT_ASSETS", array('WH_BANKRUPT_ID' => $WH_BANKRUPT_ID));
	echo count($data_main["asset"]);
	if (count($data_main["asset"]) > 0) {
		foreach ($data_main["asset"] as $key => $valFile) {
			unset($fields);
			$fields["WH_BANKRUPT_ID"] 			=  $WH_BANKRUPT_ID;
			$fields["PROP_TITLE"] 			=  $valFile["assetsDisplay"];//รายละเอียดทรัพย์
			$fields["PROP_STATUS_NAME"] 			=  $valFile["assetsStatus"];
			$fields["TYPE_CODE_NAME"] 			=  $valFile["assetsType"];
			$fields["EST_ASSET_PRICE1"] 			=  $valFile["assetsPrice"];
			//คดีดำ
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYY"];
			//คดีเเดง
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYY"];

			db::db_insert("WH_BANKRUPT_ASSETS", $fields, 'WH_ASSET_ID', 'WH_ASSET_ID');
		}
	}

	/* stop เพิ่มการบันทึก ทรัพ เเละ ทรัพเป็นของใคร */
}
/* Nop stop ดึงล้มละลาย ให้เรียงโจทย์จำเลยตามลำดับ */
