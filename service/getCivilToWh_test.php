<?php
include '../include/include.php';

$str_json     = file_get_contents("php://input");
$POST         = json_decode($str_json, true);

$h = fopen("log_file/json_GetCivilTowh" . date('YmdHis') . '.txt', "w");
fwrite($h, json_encode($POST, JSON_UNESCAPED_UNICODE));
fclose($h);

if ($_GET["pccCivilGen"] != "") {
    $POST["pccCivilGen"] = $_GET["pccCivilGen"];
}
$GET_WH_CIVIL_ID = getCivilToWh_TEST($POST["pccCivilGen"], $_GET["show_data"]);


function getCivilToWh($pccCivilGen = "", $show_data = "")
{

	$curl = curl_init();



	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://103.40.146.73/LedServiceCivilById.php/getCivil',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => '{
		"USERNAME":"BankruptDt",
		"PASSWORD":"Debtor4321",
		"pccCivilGen":"' . $pccCivilGen . '"
	}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$dataReturn = json_decode($response, true);

	if ($show_data == 'Y') {
		print_pre($dataReturn);
	}


	$data_main = $dataReturn["Data"];


	$sqlSelectData = "	select 		WH_CIVIL_ID
						from 		WH_CIVIL_CASE
						where 		CIVIL_CODE = '" . $data_main["pccCivilGen"] . "' ";


	$querySelectData = db::query($sqlSelectData);
	$dataSelectData = db::fetch_array($querySelectData);

	//case

	unset($fields);
	$fields["CIVIL_CODE"] 			= $data_main["pccCivilGen"];
	$fields["COURT_CODE"] 			= $data_main["courtCode"];
	$fields["COURT_NAME"] 			= $data_main["courtName"];
	$fields["DEPT_CODE"] 			= $data_main["deptCode"];
	$fields["DEPT_NAME"] 			= $data_main["deptName"];
	$fields["CASE_TYPE_CODE"] 		= $data_main["caseTypeCode"];
	$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
	$fields["BLACK_CASE"] 			= $data_main["blackCase"];
	$fields["BLACK_YY"] 			= $data_main["blackYy"];
	$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
	$fields["RED_CASE"] 			= $data_main["redCase"];
	$fields["RED_YY"] 				= $data_main["redYy"];
	$fields["COURT_DATE"] 			= substr($data_main["courtDate"], 0, 10);
	$fields["CAPITAL_AMOUNT"] 		= $data_main["capitalAmount"];
	$fields["PLAINTIFF1"] 			= $data_main["plaintiff1"];
	$fields["PLAINTIFF2"] 			= $data_main["plaintiff2"];
	$fields["PLAINTIFF3"] 			= $data_main["plaintiff3"];
	$fields["DEFFENDANT1"] 			= $data_main["defendant1"];
	$fields["DEFFENDANT2"] 			= $data_main["defendant2"];
	$fields["DEFFENDANT3"] 			= $data_main["defendant3"];
	$fields["CASE_TYPE_NAME"] 		= $data_main["caseTypeDesc"];
	$fields["PCC_CASE_GEN"] 		= $data_main["pccCaseGen"];
	$fields["REV_NO"] 				= $dataReturn['Data']['doss'][0]["recvNo"];
	$fields["REV_YEAR"] 			= $dataReturn['Data']['doss'][0]["recvYear"];

	if ($dataSelectData["WH_CIVIL_ID"] > 0) {
		db::db_update("WH_CIVIL_CASE", $fields, array('WH_CIVIL_ID' => $dataSelectData["WH_CIVIL_ID"]));
		$WH_CIVIL_ID = $dataSelectData["WH_CIVIL_ID"];
	} else {
		$WH_CIVIL_ID = db::db_insert("WH_CIVIL_CASE", $fields, 'WH_CIVIL_ID', 'WH_CIVIL_ID');
	}

	//doss

	db::db_delete("WH_CIVIL_DOSS", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
	/* start */

	if (count($dataReturn['Data']['doss']) > 0) {
		foreach ($dataReturn['Data']['doss'] as $key => $data_doss) {
			unset($fields);
			$fields["ACCOUNT_NO"] 			= $data_doss["accCode"];
			$fields["DOSS_CONTROL"] 		= $data_doss["dossName"];
			$fields["DOSS_CONTROL_GEN"] 	= $data_doss["pccDossControlGen"];
			$fields["DOSS_CODE"] 			= $data_doss["dossCode"];
			$fields["DOSS_OWNER_ID"] 		= $data_doss["personCode"];
			$fields["DOSS_OWNER_NAME"] 		= $data_doss["dossOwnerName"];
			$fields["DOSS_REV_NO"] 			= $data_doss["recvNo"];
			$fields["DOSS_REV_YEAR"] 		= $data_doss["recvYear"];
			$fields["DOSS_DEPT_CODE"] 		= $data_doss["deptCode"];
			$fields["DOSS_DEPT_NAME"] 		= $data_doss["deptName"];
			$fields["WH_CIVIL_ID"] 			= $WH_CIVIL_ID;
			$fields["PCC_CASE_RECV_GEN"] 	= $data_doss["pccCaseRecvGen"];
			$DOSS_ID = db::db_insert("WH_CIVIL_DOSS", $fields, 'DOSS_ID', 'DOSS_ID');

			

			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://103.40.146.73/LedServiceCivilById.php/getCivilRoute',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => '{
				"USERNAME":"BankruptDt",
				"PASSWORD":"Debtor4321",
				"pccDossControlGen":"' . $data_doss["pccDossControlGen"] . '"
			}',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				),
			));

			$responseRoute = curl_exec($curl);

			curl_close($curl);

			$dataReturnRoute = json_decode($responseRoute, true);

			db::db_delete("WH_CIVIL_ROUTE", array('WH_CIVIL_ID' => $WH_CIVIL_ID, 'DOSS_CONTROL_GEN' => $data_doss["pccDossControlGen"]));
			/* มีปัญหา start */
			if (count($dataReturnRoute["Data"]) > 0) {
				foreach ($dataReturnRoute["Data"] as $key => $val) {
					unset($fields);
					$fields["ROUTE_GEN"] 		= 	$val["routeGen"];
					$fields["CREATE_DATE"] 		= 	substr($val["trDate"], 0, 10);
					$fields["ACT_DESC"] 		= 	$val["actDesc"];
					$fields["WH_CIVIL_ID"] 		= 	$WH_CIVIL_ID;
					$fields["DOSS_ID"] 			= 	$DOSS_ID;
					$fields["DOSS_CONTROL_GEN"] = 	$data_doss["pccDossControlGen"];
						$WH_ROUTE_ID=db::db_insert("WH_CIVIL_ROUTE",$fields,'WH_ROUTE_ID','WH_ROUTE_ID');

						
				}
			}
			/* มีปัญหา stop */
			$curlTransaction = curl_init();

			curl_setopt_array($curlTransaction, array(
				CURLOPT_URL => 'http://103.40.146.73/LedServiceCivilById.php/getCivilTransaction',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => '{
				"USERNAME":"BankruptDt",
				"PASSWORD":"Debtor4321",
				"pccCaseRecvGen":"' . $data_doss["pccCaseRecvGen"] . '"
			}',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				),
			));

			$responseTransaction = curl_exec($curlTransaction);

			curl_close($curlTransaction);

			$dataReturnTransaction = json_decode($responseTransaction, true);

			//print_pre($dataReturnTransaction);

			db::db_delete("WH_CIVIL_TRANSACTION", array('WH_CIVIL_ID' => $WH_CIVIL_ID, 'PCC_CASE_RECV_GEN' => $data_doss["pccCaseRecvGen"]));
			if (count($dataReturnTransaction["Data"]) > 0) {
				foreach ($dataReturnTransaction["Data"] as $key => $valTransaction) {
					unset($fields);
					$fields["SETUP_DATE"] 		= 	substr($valTransaction["setupDate"], 0, 10);
					$fields["DOSS"] 			= 	$valTransaction["dossName"];
					$fields["SEND_DATE"] 		= 	substr($valTransaction["sendDate"], 0, 10);
					$fields["FROM_DEPT"] 		= 	$valTransaction["fromCentDeptName"];
					$fields["RECV_DOSS_DATE"] 	= 	substr($valTransaction["recvDate"], 0, 10);
					$fields["TO_DEPT"] 			= 	$valTransaction["toCentDeptName"];
					$fields["PROCESS_DESC"] 	= 	$valTransaction["processDesc"];
					$fields["REMARK"] 			= 	$valTransaction["remark"];
					$fields["WH_CIVIL_ID"] 		= 	$WH_CIVIL_ID;
					$fields["DOSS_ID"] 			= 	$DOSS_ID;
					$fields["DOSS_CONTROL_GEN"] = 	$data_doss["pccDossControlGen"];
					$fields["PCC_CASE_RECV_GEN"] = 	$data_doss["pccCaseRecvGen"];
					$WH_ROUTE_ID=db::db_insert("WH_CIVIL_TRANSACTION", $fields, 'WH_ROUTE_ID', 'WH_ROUTE_ID');

				
				}
			}


			$curlEdoc = curl_init();

			curl_setopt_array($curlEdoc, array(
				CURLOPT_URL => 'http://103.40.146.73/LedServiceCivilById.php/getCivilEdocument',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => '{
				"USERNAME":"BankruptDt",
				"PASSWORD":"Debtor4321",
				"pccDossControlGen":"' . $data_doss["pccDossControlGen"] . '"
			}',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				),
			));

			$responseEdoc = curl_exec($curlEdoc);

			curl_close($curlEdoc);

			$dataReturnEdoc = json_decode($responseEdoc, true);

			//print_pre($dataReturnEdoc);

			db::db_delete("WH_CIVIL_EDOC", array('WH_CIVIL_ID' => $WH_CIVIL_ID, 'PCC_CASE_RECV_GEN' => $data_doss["pccCaseRecvGen"]));
			if (count($dataReturnEdoc["Data"]) > 0) {
				foreach ($dataReturnEdoc["Data"] as $key => $valEdoc) {
					unset($fields);
					$fields["WH_CIVIL_ID"] 			= 	$WH_CIVIL_ID;
					$fields["DOSS_ID"] 				= 	$DOSS_ID;
					$fields["PCC_DOSS_CONTROL_GEN"]	= 	$data_doss["pccDossControlGen"];
					$fields["PCC_CASE_RECV_GEN"] 	= 	$data_doss["pccCaseRecvGen"];
					$fields["SHR_E_DOCUMENT_NAME"] 	= 	$valEdoc["shrEDocumentName"];
					$fields["SHR_E_DOCUMENT_URL"] 	= 	$valEdoc["shrEDocumentUrl"];
					$fields["PCC_CASE_GEN"] 		= 	$data_main["pccCaseGen"];
					$fields["CREATE_DATE"] 			= 	substr($valEdoc["createDate"], 0, 10);
					$WH_CIVIL_EDOC_ID=db::db_insert("WH_CIVIL_EDOC", $fields, 'WH_CIVIL_EDOC_ID', 'WH_CIVIL_EDOC_ID');

			
				}
			}
		}
	}
	/* stop */
	//person
	db::db_delete("WH_CIVIL_CASE_PERSON", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
	db::db_delete("WH_CIVIL_PETITION", array('WH_CIVIL_ID' => $WH_CIVIL_ID));


	if (count($dataReturn['Data']['person']) > 0) {
		foreach ($dataReturn['Data']['person'] as $key => $data_person) {
			unset($fields);
			$fields["WH_CIVIL_ID"] 			= $WH_CIVIL_ID;
			$fields["PERSON_CODE"] 			= $data_person["personCode"];
			$fields["REGISTER_CODE"] 		= $data_person["registerId"];
			$fields["PREFIX_CODE"] 			= $data_person["titleCode"];

			$fields["PREFIX_NAME"] 			= (trim($data_person["fname"]) == "") ? null : $data_person["titleName"];
			$fields["FIRST_NAME"] 			= (trim($data_person["fname"]) == "") ? $data_person["personFullName"] : $data_person["fname"];
			$fields["LAST_NAME"] 			= $data_person["lname"];
			$fields["FULL_NAME"] 			= $data_person["personFullName"];

			$fields["PERSON_TYPE"] 			= (substr($data_person["registerId"], 0, 1) == '0') ? 2 : 1; //$data_person["personType"]
			$fields["SEX"] 					= $data_person["sex"];
			$fields["RACE"] 				= $data_person["race"];
			$fields["NATIONALITY"] 			= $data_person["nationality"];

			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["COURT_NAME"] 			= $data_main["courtName"];
			$fields["DEPT_CODE"] 			= $data_main["deptCode"];
			$fields["DEPT_NAME"] 			= $data_main["deptName"];
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYy"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYy"];

			$fields["ADDRESS"] 				= $data_person["houseNo"];
			$fields["TUM_CODE"] 			= $data_person["tumCode"];
			$fields["TUM_NAME"] 			= $data_person["tumName"];
			$fields["AMP_CODE"] 			= $data_person["ampCode"];
			$fields["AMP_NAME"] 			= $data_person["ampName"];
			$fields["PROV_CODE"] 			= $data_person["provCode"];
			$fields["PROV_NAME"] 			= $data_person["prvName"];
			$fields["ZIP_CODE"] 			= $data_person["postCode"];
			$fields["CONCERN_CODE"] 		= $data_person["concernCode"];
			$fields["CONCERN_NAME"] 		= $data_person["concernName"];
			$fields["CONCERN_NO"] 			= $data_person["concernNo"];
			$fields["MOO"] 					= $data_person["moo"];
			$fields["SOI"] 					= $data_person["soi"];
			$fields["PERSON_PCC_CASE_GEN"] 	= $data_person["pccCaseGen"];
			$fields["PER_ORDER_STATUS"] 	= $data_person["executionStatus"];
			$WH_PERSON_ID=db::db_insert("WH_CIVIL_CASE_PERSON", $fields, 'WH_PERSON_ID', 'WH_PERSON_ID');

		

			if (count($data_person["petition"]) > 0) {
				$CASE_CODE_TEXT = "ไม่ระบุ";
				if ($data_person["petition"]["caseCode"] == 1) {
					$CASE_CODE_TEXT = "แพ่ง";
				} else if ($data_person["petition"]["caseCode"] == 2) {
					$CASE_CODE_TEXT = "ล้มละลาย";
				} else if ($data_person["petition"]["caseCode"] == 3) {
					$CASE_CODE_TEXT = "วางทรัพย์";
				} else if ($data_person["petition"]["caseCode"] == 4) {
					$CASE_CODE_TEXT = "อาญา";
				} else if ($data_person["petition"]["caseCode"] == 5) {
					$CASE_CODE_TEXT = "บังคับทางปกครอง";
				}
				unset($fieldsPetition);
				$fieldsPetition["WH_CIVIL_ID"] 					= $WH_CIVIL_ID;
				$fieldsPetition["CASE_CODE_TEXT"] 				= $CASE_CODE_TEXT;
				$fieldsPetition["PREFIX_BLACK_CASE"] 			= $data_person["petition"]["prefixBlackCase"];
				$fieldsPetition["BLACK_CASE"] 					= $data_person["petition"]["blackCase"];
				$fieldsPetition["BLACK_YY"] 					= $data_person["petition"]["blackYy"];
				$fieldsPetition["PREFIX_RED_CASE"] 				= $data_person["petition"]["prefixRedCase"];
				$fieldsPetition["RED_CASE"] 					= $data_person["petition"]["redCase"];
				$fieldsPetition["RED_YY"] 						= $data_person["petition"]["redYy"];
				$fieldsPetition["COURTDATE"] 					= substr($data_person["petition"]["courtdate"], 0, 10);
				$fieldsPetition["PLAINTIFF"] 					= $data_person["petition"]["plaintiff"];
				$fieldsPetition["DEFENDANT"] 					= $data_person["petition"]["defendant"];
				$fieldsPetition["CAPITAL_AMT"] 					= $data_person["petition"]["capitalAmt"];
				$fieldsPetition["COURT_OBLIG_AMT"] 				= $data_person["petition"]["courtObligAmt"];
				$fieldsPetition["TAX_LAW_AMT"] 					= $data_person["petition"]["taxLawAmt"];
				$fieldsPetition["SOCIAL_SEC_LAW_AMT"] 			= $data_person["petition"]["socialSecLawAmt"];
				$fieldsPetition["LABOR_LAW_AMT"] 				= $data_person["petition"]["laborLawAmt"];
				$fieldsPetition["OTHER_LAW_NAME"] 				= $data_person["petition"]["otherLawName"];
				$fieldsPetition["OTHER_LAW_AMT"] 				= $data_person["petition"]["otherLawAmt"];
				$fieldsPetition["COURT_NAME"] 					= $data_person["petition"]["courtName"];
				$fieldsPetition["SOURCE_COURT_CODE"] 			= $data_main["courtCode"];
				$fieldsPetition["SOURCE_COURT_NAME"] 			= $data_main["courtName"];
				$fieldsPetition["SOURCE_PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
				$fieldsPetition["SOURCE_BLACK_CASE"] 			= $data_main["blackCase"];
				$fieldsPetition["SOURCE_BLACK_YY"] 				= $data_main["blackYy"];
				$fieldsPetition["SOURCE_PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
				$fieldsPetition["SOURCE_RED_CASE"] 				= $data_main["redCase"];
				$fieldsPetition["SOURCE_RED_YY"] 				= $data_main["redYy"];
				$fieldsPetition["REGISTER_CODE"] 				= $data_person["registerId"];
				$WH_CIVIL_PETITION_ID=db::db_insert("WH_CIVIL_PETITION", $fieldsPetition, 'WH_CIVIL_PETITION_ID', 'WH_CIVIL_PETITION_ID');

				
			}
		}
	}


	//asset
	//db::query("DELETE FROM WH_CIVIL_CASE_ASSET_OWNER WHERE WH_CIVIL_ID in (SELECT WH_ASSET_ID FROM WH_CIVIL_CASE_ASSETS WHERE WH_CIVIL_ID = '".$WH_CIVIL_ID."' )");
	db::db_delete("WH_CIVIL_CASE_ASSET_OWNER", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
	//db::db_delete("WH_CIVIL_CASE_ASSETS", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
	db::query("DELETE FROM WH_CIVIL_CASE_ASSETS WHERE WH_CIVIL_ID ='".$WH_CIVIL_ID."'");//DELETE  WH_CIVIL_CASE_ASSETS

	if (count($dataReturn['Data']['asset']) > 0) {
		foreach ($dataReturn['Data']['asset'] as $key => $data) {

			$sqlSelectDataDoss 		= "	select 		DOSS_ID
										from 		WH_CIVIL_DOSS
										where 		DOSS_CONTROL_GEN = '" . $data["pccDossControlGen"] . "' ";
			$querySelectDataDoss 	= db::query($sqlSelectDataDoss);
			$dataSelectDataDoss 	= db::fetch_array($querySelectDataDoss);

			unset($fields);
			$fields["ASSET_ID"] 		= $data["assetId"];
			$fields["TYPE_CODE"] 		= $data["typeCode"];

			if ($data["typeCode"] == '01') {
				$fields["TYPE_CODE_NAME"] = "ที่ดิน";
			} else if ($data["typeCode"] == '02') {
				$fields["TYPE_CODE_NAME"] = "สิ่งปลูกสร้าง";
			} else if ($data["typeCode"] == '03') {
				$fields["TYPE_CODE_NAME"] = "ห้องชุด";
			} else if ($data["typeCode"] == '04') {
				$fields["TYPE_CODE_NAME"] = "สิทธิการเช่าที่ดิน";
			} else if ($data["typeCode"] == '05') {
				$fields["TYPE_CODE_NAME"] = "สิทธิการเช่าห้องชุด";
			} else if ($data["typeCode"] == '14') {
				$fields["TYPE_CODE_NAME"] = "อาวุธปืน";
			} else if ($data["typeCode"] == '13') {
				$fields["TYPE_CODE_NAME"] = "เครื่องจักร";
			} else if ($data["typeCode"] == '11') {
				$fields["TYPE_CODE_NAME"] = "รถยนต์";
			} else if ($data["typeCode"] == '08') {
				$fields["TYPE_CODE_NAME"] = "หุ้น";
			} else if ($data["typeCode"] == '10') {
				$fields["TYPE_CODE_NAME"] = "สลากออมทรัพย์";
			} else if ($data["typeCode"] == '99') {
				$fields["TYPE_CODE_NAME"] = "บัญชีทรัพย์สินอื่นๆ";
			}

			$fields["PROP_TITLE"] 		= $data["propTitle"];
			$fields["PROP_STATUS"] 		= $data["propStatus"];
			$fields["PROP_STATUS_NAME"] = $data["propStatusName"];

			$fields["EST_VANG_SUB"] 	= $data["estVangSub"]; //ราคาประเมินเจ้าพนักงานประเมินราคาทรัพย์
			$fields["EST_GROUP_AMOUNT"] = $data["estGroupAmount"]; //ราคาประเมินคณะกรรมการกำหนดราคาทรัพย์
			$fields["EST_SUB_AMOUNT"] 	= $data["estSubAmount"]; //ราคากำหนดพิเศษ
			$fields["EST_DOL"] 			= $data["estDol"]; //ราคาประเมินกรมธนารักษ์
			$fields["EST_PRICE_AMOUNT"] = $data["estPriceAmount"]; //ราคาประเมินเจ้าพนักงานบังคับคดี
			$fields["SALE_PRICE"] 		= $data["salePrice"]; //ราคาขาย
			$fields["EST_SPECIALIST"] 	= $data["estSpecialist"]; //ราคาประเมินผู้เชี่ยวชาญราคาประเมิน
			$fields["EST_MORTGAGE"] 	= $data["estMortgage"]; //ราคาประเมินที่จำนำ/จำนองไว้
			$fields["EST_BANK"] 		= $data["estBank"]; //ราคาประเมินที่สถาบันการเงินแจ้งต่อธนาคารแห่งประเทศไทย

			$fields["COMMIT_TYPE"]		= $data["commitType"];
			$fields["DATE_SALE"] 		= substr($data["dateSale"], 0, 10);
			$fields["ADDRESS"] 			= $data["address"];
			//$fields["ASSET_DESC"] 		= $text_owner;
			$fields["WH_CIVIL_ID"] 		= $WH_CIVIL_ID;
			$fields["DOSS_ID"] 			= $dataSelectDataDoss["DOSS_ID"];
			$fields["DOSS_CONTROL_GEN"] = $data["pccDossControlGen"];
			$fields["CFC_CAPTION_GEN"]  = $data["cfcCaptionGen"];
			$fields["CAP_NO"]  			= $data["capNo"];
			$fields["SEQ_NO"]  			= $data["seqNo"];
			$fields["ASSET_DATA_TYPE"]  = 1;
			$WH_ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS", $fields, 'WH_ASSET_ID', 'WH_ASSET_ID');

			


			$text_owner = "";
			if (count($data["owner"]) > 0) {
				foreach ($data['owner'] as $key_owner => $data_owner) {

					$text_ratioFlag = "";
					if ($data_owner["ratioFlag"] == 1) {
						$text_ratioFlag = "เฉลี่ย";
					} else if ($data_owner["ratioFlag"] == 2) {
						$text_ratioFlag = "อัตราส่วน";
					} else if ($data_owner["ratioFlag"] == 3) {
						$text_ratioFlag = "อัตราส่วนเป็นเงิน " . $data_owner["holdingAmount"];
					} else if ($data_owner["ratioFlag"] == 4) {
						$text_ratioFlag = "อัตราส่วนเป็นเปอร์เซ็นต์ " . $data_owner["holdingAmount"];
					} else if ($data_owner["ratioFlag"] == 5) {
						$text_ratioFlag = "ตามลำดับ";
					}
					$text_owner .=  $data_owner["personFullName"] . " " . $data_owner["concernName"] . " " . $text_ratioFlag . "<br>";

					$HOLDING_GROUP = "02";
					if ($data_owner["concernCode"] == 11) {
						$HOLDING_GROUP = "01";
					} else if ($data_owner["concernCode"] == 13) {
						$HOLDING_GROUP = "03";
					}

					unset($fieldsOwner);
					$fieldsOwner["ASSET_ID"] 		= $data["assetId"];
					$fieldsOwner["WH_ASSET_ID"] 	= $WH_ASSET_ID;
					$fieldsOwner["WH_CIVIL_ID"] 	= $WH_CIVIL_ID;
					$fieldsOwner["HOLDING_GROUP"] 	= $HOLDING_GROUP;
					$fieldsOwner["PERSON_NAME"] 	= $data_owner["personFullName"];
					$fieldsOwner["HOLDING_TYPE"] 	= $text_ratioFlag;
					$fieldsOwner["CONCERNCODE"] 	= $data_owner["concernCode"];
					$fieldsOwner["CONCERNNAME"] 	= $data_owner["concernName"];
					$fieldsOwner["REGISTERID"] 	= $data_owner["registerId"];
					$WH_OWNER_ASSET_ID=db::db_insert("WH_CIVIL_CASE_ASSET_OWNER", $fieldsOwner, 'WH_OWNER_ASSET_ID', 'WH_OWNER_ASSET_ID');

				}
			}
		}
	}

	if (count($dataReturn['Data']['dossAsset']) > 0) {
		foreach ($dataReturn['Data']['dossAsset'] as $key => $data) {

			$sqlSelectDataDoss 		= "	select 		DOSS_ID
										from 		WH_CIVIL_DOSS
										where 		DOSS_CONTROL_GEN = '" . $data["pccDossControlGen"] . "' ";
			$querySelectDataDoss 	= db::query($sqlSelectDataDoss);
			$dataSelectDataDoss 	= db::fetch_array($querySelectDataDoss);
			//1 = จำนวน 2 = %หรือร้อยละ 3 = เต็มหมายบังคับคดี
			$ratetypeText = "";
			if ($data["ratetype"] == 1) {
				$ratetypeText = "";
			} else if ($data["ratetype"] == 2) {
				$ratetypeText = "%";
			} else if ($data["ratetype"] == 3) {
				$ratetypeText = "เต็มหมายบังคับคดี";
			}
			unset($fields);
			$fields["PROP_TITLE"] 		= $data["sequestertypename"];
			$fields["GERNISSHEE"] 		= $data["garnisshee"];
			$fields["OUTSIDER"] 		= $data["outsider"];
			$fields["AMOUNT_TYPE"] 		= $data["amount"] . $ratetypeText;
			$fields["WH_CIVIL_ID"] 		= $WH_CIVIL_ID;
			$fields["DOSS_ID"] 			= $dataSelectDataDoss["DOSS_ID"];
			$fields["DOSS_CONTROL_GEN"] = $data["pccDossControlGen"];
			$fields["ASSET_DATA_TYPE"] 	= 2;
			$WH_ASSET_ID = db::db_insert("WH_CIVIL_CASE_ASSETS", $fields, 'WH_ASSET_ID', 'WH_ASSET_ID');

			

		}
	}

	//Payment
	db::db_delete("WH_CIVIL_PAYMENT", array('WH_CIVIL_ID' => $WH_CIVIL_ID));
	if (count($dataReturn['Data']['payDesc']) > 0) {
		foreach ($dataReturn['Data']['payDesc'] as $key => $data_payDesc) {
			unset($fields);
			$fields["WH_CIVIL_ID"] 			= $WH_CIVIL_ID;
			$fields["PREFIX_BLACK_CASE"] 	= $data_main["prefixBlackCase"];
			$fields["BLACK_CASE"] 			= $data_main["blackCase"];
			$fields["BLACK_YY"] 			= $data_main["blackYy"];
			$fields["PREFIX_RED_CASE"] 		= $data_main["prefixRedCase"];
			$fields["RED_CASE"] 			= $data_main["redCase"];
			$fields["RED_YY"] 				= $data_main["redYy"];
			$fields["COURT_CODE"] 			= $data_main["courtCode"];
			$fields["CIVIL_CODE"] 			= $data_main["pccCivilGen"];

			$fields["PERSON_FULL_NAME"] 	= $data_payDesc["personFullName"];
			$fields["EXECUTION_STATUS"] 	= $data_payDesc["executionStatus"];
			$fields["CAPITAL_AMOUNT"] 		= $data_payDesc["capitalAmount"];
			$fields["ASSET_AMOUNT_REMAIN"] 	= $data_payDesc["assetAmountRemain"];
			$fields["CONCERN_NAME"] 		= $data_payDesc["concernName"];
			$fields["CONCERN_CODE"] 		= $data_payDesc["concernCode"];


			$WH_CIVIL_PAYMENT_ID=db::db_insert("WH_CIVIL_PAYMENT", $fields, 'WH_CIVIL_PAYMENT_ID', 'WH_CIVIL_PAYMENT_ID');

		
		}
	}

	return $WH_CIVIL_ID;
	
}


