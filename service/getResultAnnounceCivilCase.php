<?php
include '../include/include.php';

$pccCaseGen = $_GET['pccCivilGen'];
$show_data = $_GET['show_data'];

// ------------------------------------------------------------------------------------------------------------
$WF_CIVIL_GET_RESULT_ANNOUNCE = "http://103.40.146.73/LedServiceCivilById.php/getResultAnnounceCivilCase";
// ------------------------------------------------------------------------------------------------------------

function getResultAnnounceCivilCase($pccCivilGen, $show_data = '', $alert = '')
{
	global $WF_CIVIL_GET_RESULT_ANNOUNCE;
	$txtFunc = 'ผลการขายทอดตลาด';

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $WF_CIVIL_GET_RESULT_ANNOUNCE,
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
			'Content-Type: application/x-www-form-urlencoded'
		),

		// CURLOPT_POSTFIELDS =>'{
		// 		"USERNAME":"BankruptDt",
		// 		"PASSWORD":"Debtor4321",
		// 		"shrCaseGen":"1663248",
		// 		"pccCaseGen":"3825729"
		// 	}',
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	$dataReturn = json_decode($response, true);

	if ($show_data == 'Y') {
		print_pre($dataReturn);
	}

	$updateRow = 0;
	$insertRow = 0;
	$txtAlert = '';

	if (isset($dataReturn["ResponseCode"])) {
		if (isset($dataReturn['Data']) && count($dataReturn['Data']) > 0) {

			db::db_delete('WH_CIVIL_ANN_RESULT', array('PCC_CIVIL_GEN' => $pccCivilGen));
			db::db_delete('WH_CIVIL_ANN_RESULT_HISTORY', array('PCC_CIVIL_GEN' => $pccCivilGen));
			db::db_delete('WH_CIVIL_ANN_RESULT_ASSET', array('PCC_CIVIL_GEN' => $pccCivilGen));
			db::db_delete('WH_CIVIL_ANN_RESULT_DOCUMENT', array('PCC_CIVIL_GEN' => $pccCivilGen));
			db::db_delete('WH_CIVIL_ANN_RESULT_RECEIPT', array('PCC_CIVIL_GEN' => $pccCivilGen));
			db::db_delete('WH_CIVIL_ANN_RESULT_PAST', array('PCC_CIVIL_GEN' => $pccCivilGen));

			foreach ($dataReturn['Data']['AUC1I100'] as $keyAUC1I100 => $valAUC1I100) {

				$auc1i100aucSubOrderGen = $valAUC1I100['AUC_SUB_ORDER_GEN'];

				$sqlSelectData =
					"SELECT		AUC_SUB_ORDER_GEN
					FROM 		WH_CIVIL_ANN_RESULT
					WHERE 		AUC_SUB_ORDER_GEN = '$auc1i100aucSubOrderGen' ";

				$querySelectData = db::query($sqlSelectData);
				$dataSelectData = db::fetch_array($querySelectData);

				unset($fields);
				$fields["AUC_SUB_ORDER_GEN"] 	= $valAUC1I100["AUC_SUB_ORDER_GEN"];
				$fields["SUB_ORDER"]			= $valAUC1I100["SUB_ORDER"];
				$fields["PCC_CASE_GEN"] 		= $valAUC1I100["PCC_CASE_GEN"];
				$fields["PCC_CIVIL_GEN"] 		= $valAUC1I100["PCC_CIVIL_GEN"];
				$fields["PREFIX_RED_CASE"] 		= $valAUC1I100["PREFIX_RED_CASE"];
				$fields["RED_CASE"]				= $valAUC1I100["RED_CASE"];
				$fields["RED_YY"]				= $valAUC1I100["RED_YY"];
				$fields["PREFIX_BLACK_CASE"] 	= $valAUC1I100["PREFIX_BLACK_CASE"];
				$fields["BLACK_CASE"] 			= $valAUC1I100["BLACK_CASE"];
				$fields["BLACK_YY"] 			= $valAUC1I100["BLACK_YY"];
				$fields["COURT_CODE"] 			= $valAUC1I100["COURT_CODE"];
				$fields["COURT_NAME"] 			= $valAUC1I100["COURT_NAME"];
				$fields["PLAINTIFF1"] 			= $valAUC1I100["PLAINTIFF1"];
				$fields["PLAINTIFF2"] 			= $valAUC1I100["PLAINTIFF2"];
				$fields["PLAINTIFF3"] 			= $valAUC1I100["PLAINTIFF3"];
				$fields["DEFENDANT1"] 			= $valAUC1I100["DEFENDANT1"];
				$fields["DEFENDANT2"] 			= $valAUC1I100["DEFENDANT2"];
				$fields["DEFENDANT3"] 			= $valAUC1I100["DEFENDANT3"];
				$fields["ASSET_TOPIC"] 			= $valAUC1I100["ASSET_TOPIC"];
				$fields["ASSET_DESC"] 			= $valAUC1I100["ASSET_DESC"];
				$fields["AUC_ASSET_GEN"]		= $valAUC1I100["AUC_ASSET_GEN"];
				$fields["ASSET_SALE_DATE"] 		= ($valAUC1I100["ASSET_SALE_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100["ASSET_SALE_DATE"])) : '';
				$fields["SALE_NO"]				= $valAUC1I100["SALE_NO"];
				$fields["BUYING_BY"]			= $valAUC1I100["BUYING_BY"];
				$fields["DATE_RCV_DEED"]		= ($valAUC1I100["DATE_RCV_DEED"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_RCV_DEED"])) : '';
				$fields["SALE_DATE"]			= ($valAUC1I100["SUB_SALE_DATE_2_1"]) ? date('Y-m-d', strtotime($valAUC1I100["SUB_SALE_DATE_2_1"])) : '';
				$fields["BID_BY_GEN"]			= $valAUC1I100["BID_BY_GEN_2_1"];
				$fields["BID_RESULT"]			= $valAUC1I100["BID_RESULT_NAME_2_1"];
				$fields["BID_RESULT_TYPE"]		= $valAUC1I100["BID_RESULT_TYPE_NAME_2_1"];
				$fields["AUCT_STOP_DESC"]		= $valAUC1I100["AUCT_STOP_NAME_2_1"];
				$fields["BID_BAN_TIMES"]		= $valAUC1I100["BID_BAN_TIMES_2_1"];
				$fields["ESTIMATE"]				= $valAUC1I100["ESTIMATE_2_1"];
				$fields["CAPITAL_AMOUNT"]		= $valAUC1I100["CAPITAL_AMOUNT_2_1"];
				$fields["ESTIMATE_1"]			= $valAUC1I100["ESTIMATE_START_2_1"];
				$fields["BID_AMOUNT"]			= $valAUC1I100["BID_AMOUNT_2_1"];
				$fields["DEPOSIT"]				= $valAUC1I100["DEPOSIT_2_1"];
				$fields["AUCTION_DUTY"]			= $valAUC1I100["AUCTION_DUTY_3_1"];
				$fields["AUCTION_TAX"]			= $valAUC1I100["AUCTION_TAX_3_1"];
				$fields["ACTUAL_AUCTION_TAX"]	= $valAUC1I100["ACTUAL_AUCTION_TAX_3_1"];
				$fields["TAX_RETURN_STATUS"]	= $valAUC1I100["TAX_RETURN_STATUS_3_1"];
				$fields["BID_AMOUNT_1"]			= $valAUC1I100["BID_AMOUNT_3_1"];
				$fields["DEPOSIT_1"]			= $valAUC1I100["DEPOSIT_3_1"];
				$fields["AUCTION_SURPLUS"]		= $valAUC1I100["AUCTION_SURPLUS_3_1"];
				$fields["AUCTION_DATE"]			= ($valAUC1I100["AUCTION_DATE_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["AUCTION_DATE_3_1"])) : '';
				$fields["DATE_FIRST_PAY"]		= ($valAUC1I100["DATE_FIRST_PAY_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_FIRST_PAY_3_1"])) : '';
				$fields["DATE_LAST_PAY"]		= ($valAUC1I100["DATE_LAST_PAY_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_LAST_PAY_3_1"])) : '';
				$fields["DATE_REVOKE"]			= ($valAUC1I100["DATE_REVOKE_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_REVOKE_3_1"])) : '';
				$fields["DATE_CANCEL_REVOKE"]	= ($valAUC1I100["DATE_CANCEL_REVOKE_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_CANCEL_REVOKE_3_1"])) : '';
				$fields["DATE_COMPLETE_PAY"]	= ($valAUC1I100["DATE_COMPLETE_PAY_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_COMPLETE_PAY_3_1"])) : '';
				$fields["DATE_RCV_DEED_1"]		= ($valAUC1I100["DATE_RCV_DEED_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_RCV_DEED_3_1"])) : '';
				$fields["DATE_EXP_RETAX"]		= ($valAUC1I100["DATE_EXP_RETAX_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_EXP_RETAX_3_1"])) : '';
				$fields["DATE_EXP_RETAX_OVER"]	= ($valAUC1I100["DATE_EXP_RETAX_OVER_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_EXP_RETAX_OVER_3_1"])) : '';
				$fields["DATE_PETITION_RETAX"]	= ($valAUC1I100["DATE_PETITION_RETAX_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_PETITION_RETAX_3_1"])) : '';
				$fields["DATE_EXP_PETI_RETAX"]	= ($valAUC1I100["DATE_EXP_PETI_RETAX_3_1"]) ? date('Y-m-d', strtotime($valAUC1I100["DATE_EXP_PETI_RETAX_3_1"])) : '';

				db::db_insert("WH_CIVIL_ANN_RESULT", $fields);

				foreach ($valAUC1I100["AUC1I100_2_2"] as $keyAUC1I100_2_2 => $valAUC1I100_2_2) {
					$f_auc1i100_2_2['PCC_CIVIL_GEN'] 			= $pccCivilGen;
					$f_auc1i100_2_2['AUC_ASSET_GEN'] 			= $valAUC1I100["AUC_ASSET_GEN"];

					$f_auc1i100_2_2['ROOT_SHR_PERSON_MAP_GEN']	= $valAUC1I100_2_2['ROOT_SHR_PERSON_MAP_GEN'];
					$f_auc1i100_2_2['SHR_PERSON_MAP_GEN']		= $valAUC1I100_2_2['SHR_PERSON_MAP_GEN'];
					$f_auc1i100_2_2['AUCTION_BY_ID_FLAG']		= $valAUC1I100_2_2['AUCTION_BY_ID_FLAG'];
					$f_auc1i100_2_2['AUCTION_DATE']				= ($valAUC1I100_2_2["AUCTION_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_2["AUCTION_DATE"])) : '';
					$f_auc1i100_2_2['SELL_RELEASE_STATUS']		= $valAUC1I100_2_2['SELL_RELEASE_STATUS'];
					$f_auc1i100_2_2['PERSON_FULL_NAME']			= $valAUC1I100_2_2['PERSON_FULL_NAME'];
					$f_auc1i100_2_2['CONCERN_NAME']				= $valAUC1I100_2_2['CONCERN_NAME'];
					$f_auc1i100_2_2['PERSON_TYPE_CODE']			= $valAUC1I100_2_2['PERSON_TYPE_CODE'];
					$f_auc1i100_2_2['NAME_HOUSE']				= $valAUC1I100_2_2['NAME_HOUSE'];
					$f_auc1i100_2_2['HOUSE_NO']					= $valAUC1I100_2_2['HOUSE_NO'];
					$f_auc1i100_2_2['ROOM_NO']					= $valAUC1I100_2_2['ROOM_NO'];
					$f_auc1i100_2_2['MOO']						= $valAUC1I100_2_2['MOO'];
					$f_auc1i100_2_2['SOI']						= $valAUC1I100_2_2['SOI'];
					$f_auc1i100_2_2['MAIN_STREET']				= $valAUC1I100_2_2['MAIN_STREET'];
					$f_auc1i100_2_2['CENT_LOC_GEN']				= $valAUC1I100_2_2['CENT_LOC_GEN'];
					$f_auc1i100_2_2['POST_CODE']				= $valAUC1I100_2_2['POST_CODE'];
					$f_auc1i100_2_2['ADDR_FULL_NAME']			= $valAUC1I100_2_2['ADDR_FULL_NAME'];
					$f_auc1i100_2_2['TUM_NAME']					= $valAUC1I100_2_2['TUM_NAME'];
					$f_auc1i100_2_2['AMP_NAME']					= $valAUC1I100_2_2['AMP_NAME'];
					$f_auc1i100_2_2['PRV_NAME']					= $valAUC1I100_2_2['PRV_NAME'];
					$f_auc1i100_2_2['LOC_FULL_NAME']			= $valAUC1I100_2_2['LOC_FULL_NAME'];
					$f_auc1i100_2_2['SHR_PERSON_PROPERTY_GEN']	= $valAUC1I100_2_2['SHR_PERSON_PROPERTY_GEN'];
					$f_auc1i100_2_2['RELATE_CONCERN_CODE']		= $valAUC1I100_2_2['RELATE_CONCERN_CODE'];
					$f_auc1i100_2_2['COCERN_NAME_RELATE']		= $valAUC1I100_2_2['COCERN_NAME_RELATE'];


					if (pm_check_dup_arr(
						array(
							'AUC_ASSET_GEN' => $valAUC1I100["AUC_ASSET_GEN"],
							'SHR_PERSON_MAP_GEN' => $valAUC1I100_2_2['SHR_PERSON_MAP_GEN']
						),
						'WH_CIVIL_ANN_RESULT_HISTORY'
					) == 0) {
						db::db_insert("WH_CIVIL_ANN_RESULT_HISTORY", $f_auc1i100_2_2);
					}
				}

				foreach ($valAUC1I100["AUC1I100_2_3"] as $keyAUC1I100_2_3 => $valAUC1I100_2_3) {
					$f_auc1i100_2_3['PCC_CIVIL_GEN'] = $pccCivilGen;
					$f_auc1i100_2_3['AUC_ASSET_GEN'] = $valAUC1I100["AUC_ASSET_GEN"];
					$f_auc1i100_2_3['SHR_PROPERTY_CASE_GEN'] = $valAUC1I100_2_3["SHR_PROPERTY_CASE_GEN"];
					$f_auc1i100_2_3['SHR_CASE_GEN'] = $valAUC1I100_2_3["SHR_CASE_GEN"];
					$f_auc1i100_2_3['SHR_PERSON_CASE_GEN'] = $valAUC1I100_2_3["SHR_PERSON_CASE_GEN"];
					$f_auc1i100_2_3['CFC_CAPTION_GEN'] = $valAUC1I100_2_3["CFC_CAPTION_GEN"];
					$f_auc1i100_2_3['TYPE_CODE'] = $valAUC1I100_2_3["TYPE_CODE"];
					$f_auc1i100_2_3['CFC_TYPE_CODE_GEN'] = $valAUC1I100_2_3["CFC_TYPE_CODE_GEN"];
					$f_auc1i100_2_3['EST_VANG_SUB'] = $valAUC1I100_2_3["EST_VANG_SUB"];
					$f_auc1i100_2_3['EST_GROUP_AMOUNT'] = $valAUC1I100_2_3["EST_GROUP_AMOUNT"];
					$f_auc1i100_2_3['EST_SUB_AMOUNT'] = $valAUC1I100_2_3["EST_SUB_AMOUNT"];
					$f_auc1i100_2_3['EST_DOL'] = $valAUC1I100_2_3["EST_DOL"];
					$f_auc1i100_2_3['EST_PRICE_AMOUNT'] = $valAUC1I100_2_3["EST_PRICE_AMOUNT"];
					$f_auc1i100_2_3['REMARK'] = $valAUC1I100_2_3["REMARK"];
					$f_auc1i100_2_3['SALE_PRICE'] = $valAUC1I100_2_3["SALE_PRICE"];
					$f_auc1i100_2_3['DIVIED_FLAG'] = $valAUC1I100_2_3["DIVIED_FLAG"];
					$f_auc1i100_2_3['PROP_STATUS'] = $valAUC1I100_2_3["PROP_STATUS"];
					$f_auc1i100_2_3['FREE_FLAG'] = $valAUC1I100_2_3["FREE_FLAG"];
					$f_auc1i100_2_3['PROP_DET'] = $valAUC1I100_2_3["PROP_DET"];
					$f_auc1i100_2_3['AUTHORITY_FLAG'] = $valAUC1I100_2_3["AUTHORITY_FLAG"];
					$f_auc1i100_2_3['CAP_TYPE'] = $valAUC1I100_2_3["CAP_TYPE"];
					$f_auc1i100_2_3['CAP_NO'] = $valAUC1I100_2_3["CAP_NO"];
					$f_auc1i100_2_3['PORTION_FLAG'] = $valAUC1I100_2_3["PORTION_FLAG"];
					$f_auc1i100_2_3['TAKE_FLAG'] = $valAUC1I100_2_3["TAKE_FLAG"];
					$f_auc1i100_2_3['SALE_CANC_FLAG'] = $valAUC1I100_2_3["SALE_CANC_FLAG"];
					$f_auc1i100_2_3['CIVIL_CANC_FLAG'] = $valAUC1I100_2_3["CIVIL_CANC_FLAG"];
					$f_auc1i100_2_3['APPROVE_DATE'] = ($valAUC1I100_2_3["APPROVE_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["APPROVE_DATE"])) : '';
					$f_auc1i100_2_3['SEQUESTER_TYPE_CODE'] = $valAUC1I100_2_3["SEQUESTER_TYPE_CODE"];
					$f_auc1i100_2_3['RATE_TYPE'] = $valAUC1I100_2_3["RATE_TYPE"];
					$f_auc1i100_2_3['AMOUNT'] = $valAUC1I100_2_3["AMOUNT"];
					$f_auc1i100_2_3['TERM'] = $valAUC1I100_2_3["TERM"];
					$f_auc1i100_2_3['ACCOUNT_NO'] = $valAUC1I100_2_3["ACCOUNT_NO"];
					$f_auc1i100_2_3['ACCOUNT_TYPE'] = $valAUC1I100_2_3["ACCOUNT_TYPE"];
					$f_auc1i100_2_3['COMMIT_TYPE'] = $valAUC1I100_2_3["COMMIT_TYPE"];
					$f_auc1i100_2_3['DEBT_AMT'] = $valAUC1I100_2_3["DEBT_AMT"];
					$f_auc1i100_2_3['INTEREST_RATE'] = $valAUC1I100_2_3["INTEREST_RATE"];
					$f_auc1i100_2_3['COMPUTE_DATE'] = ($valAUC1I100_2_3["COMPUTE_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["COMPUTE_DATE"])) : '';
					$f_auc1i100_2_3['SALARY'] = $valAUC1I100_2_3["SALARY"];
					$f_auc1i100_2_3['SYS_CODE'] = $valAUC1I100_2_3["SYS_CODE"];
					$f_auc1i100_2_3['SQT_PROPERTY_GEN'] = $valAUC1I100_2_3["SQT_PROPERTY_GEN"];
					$f_auc1i100_2_3['CENT_LOC_GEN'] = $valAUC1I100_2_3["CENT_LOC_GEN"];
					$f_auc1i100_2_3['TRANSFER_FLAG'] = $valAUC1I100_2_3["TRANSFER_FLAG"];
					$f_auc1i100_2_3['TAX_REFUND'] = $valAUC1I100_2_3["TAX_REFUND"];
					$f_auc1i100_2_3['CAP_QTY'] = $valAUC1I100_2_3["CAP_QTY"];
					$f_auc1i100_2_3['UNIT'] = $valAUC1I100_2_3["UNIT"];
					$f_auc1i100_2_3['BROKE_FLAG'] = $valAUC1I100_2_3["BROKE_FLAG"];
					$f_auc1i100_2_3['BROKE_ACTION_FLAG'] = $valAUC1I100_2_3["BROKE_ACTION_FLAG"];
					$f_auc1i100_2_3['CANCEL_BROKE_FLAG'] = $valAUC1I100_2_3["CANCEL_BROKE_FLAG"];
					$f_auc1i100_2_3['CANCEL_BROKE_DATE'] = ($valAUC1I100_2_3["CANCEL_BROKE_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["CANCEL_BROKE_DATE"])) : '';
					$f_auc1i100_2_3['DATE_FIRST_PAY'] = ($valAUC1I100_2_3["DATE_FIRST_PAY"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["DATE_FIRST_PAY"])) : '';
					$f_auc1i100_2_3['DATE_COMPLETE_PAY'] = ($valAUC1I100_2_3["DATE_COMPLETE_PAY"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["DATE_COMPLETE_PAY"])) : '';
					$f_auc1i100_2_3['DATE_EXP_RETAX'] = ($valAUC1I100_2_3["DATE_EXP_RETAX"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["DATE_EXP_RETAX"])) : '';
					$f_auc1i100_2_3['DATE_SALE'] = ($valAUC1I100_2_3["DATE_SALE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["DATE_SALE"])) : '';
					$f_auc1i100_2_3['ADDRESS'] = $valAUC1I100_2_3["ADDRESS"];
					$f_auc1i100_2_3['RELEASE_DATE'] = ($valAUC1I100_2_3["RELEASE_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["RELEASE_DATE"])) : '';
					$f_auc1i100_2_3['COPY_FLAG'] = $valAUC1I100_2_3["COPY_FLAG"];
					$f_auc1i100_2_3['RETURN_TAX'] = $valAUC1I100_2_3["RETURN_TAX"];
					$f_auc1i100_2_3['AUCTION_DUTY'] = $valAUC1I100_2_3["AUCTION_DUTY"];
					$f_auc1i100_2_3['AUCTION_FEE'] = $valAUC1I100_2_3["AUCTION_FEE"];
					$f_auc1i100_2_3['PCC_CASE_GEN'] = $valAUC1I100_2_3["PCC_CASE_GEN"];
					$f_auc1i100_2_3['CONCERN_CODE'] = $valAUC1I100_2_3["CONCERN_CODE"];
					$f_auc1i100_2_3['ACCOUNT_NAME'] = $valAUC1I100_2_3["ACCOUNT_NAME"];
					$f_auc1i100_2_3['EST_LAWYER'] = $valAUC1I100_2_3["EST_LAWYER"];
					$f_auc1i100_2_3['WITH_LAND'] = $valAUC1I100_2_3["WITH_LAND"];
					$f_auc1i100_2_3['WITH_HOUSE'] = $valAUC1I100_2_3["WITH_HOUSE"];
					$f_auc1i100_2_3['WITH_CNT_LAND'] = $valAUC1I100_2_3["WITH_CNT_LAND"];
					$f_auc1i100_2_3['ACC_STATUS'] = $valAUC1I100_2_3["ACC_STATUS"];
					$f_auc1i100_2_3['AUCTION_TAX'] = $valAUC1I100_2_3["AUCTION_TAX"];
					$f_auc1i100_2_3['USER_DEPT_CODE'] = $valAUC1I100_2_3["USER_DEPT_CODE"];
					$f_auc1i100_2_3['DPD_STRUCTURE_GEN'] = $valAUC1I100_2_3["DPD_STRUCTURE_GEN"];
					$f_auc1i100_2_3['PARENT_PROP_STATUS'] = $valAUC1I100_2_3["PARENT_PROP_STATUS"];
					$f_auc1i100_2_3['GROUP_FLAG'] = $valAUC1I100_2_3["GROUP_FLAG"];
					$f_auc1i100_2_3['BID_RESULT_TYPE'] = $valAUC1I100_2_3["BID_RESULT_TYPE"];
					$f_auc1i100_2_3['FEE_END_DATE'] = ($valAUC1I100_2_3["FEE_END_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["FEE_END_DATE"])) : '';
					$f_auc1i100_2_3['FEE_FLAG'] = $valAUC1I100_2_3["FEE_FLAG"];
					$f_auc1i100_2_3['DPD_CIVIL_TRN_GEN'] = $valAUC1I100_2_3["DPD_CIVIL_TRN_GEN"];
					$f_auc1i100_2_3['DATE_RCV_DEED'] = ($valAUC1I100_2_3["DATE_RCV_DEED"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["DATE_RCV_DEED"])) : '';
					$f_auc1i100_2_3['PROP_TITLE'] = $valAUC1I100_2_3["PROP_TITLE"];
					$f_auc1i100_2_3['PROP_ADDR'] = $valAUC1I100_2_3["PROP_ADDR"];
					$f_auc1i100_2_3['SEQ_NO'] = $valAUC1I100_2_3["SEQ_NO"];
					$f_auc1i100_2_3['FEE_PAY_END'] = $valAUC1I100_2_3["FEE_PAY_END"];
					$f_auc1i100_2_3['EST_SPECIALIST'] = $valAUC1I100_2_3["EST_SPECIALIST"];
					$f_auc1i100_2_3['EST_MORTGAGE'] = $valAUC1I100_2_3["EST_MORTGAGE"];
					$f_auc1i100_2_3['EST_BANK'] = $valAUC1I100_2_3["EST_BANK"];
					$f_auc1i100_2_3['COLLECT_NO'] = $valAUC1I100_2_3["COLLECT_NO"];
					$f_auc1i100_2_3['KEEP_DATE'] = ($valAUC1I100_2_3["KEEP_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["KEEP_DATE"])) : '';
					$f_auc1i100_2_3['ASSET_TYPE'] = $valAUC1I100_2_3["ASSET_TYPE"];
					$f_auc1i100_2_3['RECV_ALLOW_DATE'] = ($valAUC1I100_2_3["RECV_ALLOW_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["RECV_ALLOW_DATE"])) : '';
					$f_auc1i100_2_3['ASSET_DEBT_FLAG'] = $valAUC1I100_2_3["ASSET_DEBT_FLAG"];
					$f_auc1i100_2_3['ASSET_LOCK_DATE'] = ($valAUC1I100_2_3["ASSET_LOCK_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["ASSET_LOCK_DATE"])) : '';
					$f_auc1i100_2_3['ASSET_RELEASE_DATE'] = ($valAUC1I100_2_3["ASSET_RELEASE_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["ASSET_RELEASE_DATE"])) : '';
					$f_auc1i100_2_3['ASSET_SUB_ORDER_DEBT_FLAG'] = ($valAUC1I100_2_3["ASSET_SUB_ORDER_DEBT_FLAG"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["ASSET_SUB_ORDER_DEBT_FLAG"])) : '';
					$f_auc1i100_2_3['ASSET_SUB_ORDER_LOCK_DATE'] = ($valAUC1I100_2_3["ASSET_SUB_ORDER_LOCK_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["ASSET_SUB_ORDER_LOCK_DATE"])) : '';
					$f_auc1i100_2_3['ASSET_SUB_ORDER_RELEASE_DATE'] = ($valAUC1I100_2_3["ASSET_SUB_ORDER_RELEASE_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["ASSET_SUB_ORDER_RELEASE_DATE"])) : '';
					// $f_auc1i100_2_3['ASSET_SELL_RESULT_DEBT_FLAG'] = $valAUC1I100_2_3["ASSET_SELL_RESULT_DEBT_FLAG"];
					$f_auc1i100_2_3['ASSET_SELL_RESULT_LOCK_DATE'] = ($valAUC1I100_2_3["ASSET_SELL_RESULT_LOCK_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["ASSET_SELL_RESULT_LOCK_DATE"])) : '';
					$f_auc1i100_2_3['ASSET_SELL_RESULT_RELEASE_DATE'] = ($valAUC1I100_2_3["ASSET_SELL_RESULT_RELEASE_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["ASSET_SELL_RESULT_RELEASE_DATE"])) : '';
					$f_auc1i100_2_3['ASSET_SELL_R_P_DEBT_FLAG'] = $valAUC1I100_2_3["ASSET_SELL_R_P_DEBT_FLAG"];
					$f_auc1i100_2_3['ASSET_SELL_R_P_LOCK_DATE'] = ($valAUC1I100_2_3["ASSET_SELL_R_P_LOCK_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["ASSET_SELL_R_P_LOCK_DATE"])) : '';
					$f_auc1i100_2_3['ASSET_SELL_R_P_RELEASE_DATE'] = ($valAUC1I100_2_3["ASSET_SELL_R_P_RELEASE_DATE"]) ? date('Y-m-d', strtotime($valAUC1I100_2_3["ASSET_SELL_R_P_RELEASE_DATE"])) : '';
					$f_auc1i100_2_3['PROP_STATUS_NAME'] = $valAUC1I100_2_3["PROP_STATUS_NAME"];

					if (pm_check_dup_arr(
						array(
							'SHR_PROPERTY_CASE_GEN' => $valAUC1I100_2_3["SHR_PROPERTY_CASE_GEN"],
							'AUC_ASSET_GEN' => $valAUC1I100["AUC_ASSET_GEN"]
						),
						'WH_CIVIL_ANN_RESULT_ASSET'
					) == 0) {
						db::db_insert("WH_CIVIL_ANN_RESULT_ASSET", $f_auc1i100_2_3);
					}
				}

				foreach ($valAUC1I100["AUC1I100_3_2"] as $key_AUC1I100_3_2 => $val_AUC1I100_3_2) {
					$f_auc1i100_3_2['PCC_CIVIL_GEN']	= $pccCivilGen;
					$f_auc1i100_3_2['AUC_ASSET_GEN']	= $valAUC1I100["AUC_ASSET_GEN"];
					$f_auc1i100_3_2['DOCUMENT_NO']		= $val_AUC1I100_3_2['DOCUMENT_NO'];
					$f_auc1i100_3_2['DOCUMENT_YY']		= $val_AUC1I100_3_2['DOCUMENT_YY'];
					$f_auc1i100_3_2['PETITION_DATE'] 	= ($val_AUC1I100_3_2["PETITION_DATE"]) ? date('Y-m-d', strtotime($val_AUC1I100_3_2["PETITION_DATE"])) : '';
					$f_auc1i100_3_2['PETITION_TYPE']	= $val_AUC1I100_3_2['PETITION_TYPE'];


					if (pm_check_dup_arr(
						array(
							'AUC_ASSET_GEN' => $valAUC1I100["AUC_ASSET_GEN"],
							'DOCUMENT_NO' => $val_AUC1I100_3_2['DOCUMENT_NO'],
							'DOCUMENT_YY' => $val_AUC1I100_3_2['DOCUMENT_YY'],
							'PETITION_DATE' => $val_AUC1I100_3_2['PETITION_DATE'],
							'PETITION_TYPE' => $val_AUC1I100_3_2['PETITION_TYPE']
						),
						'WH_CIVIL_ANN_RESULT_DOCUMENT'
					) == 0) {
						db::db_insert("WH_CIVIL_ANN_RESULT_DOCUMENT", $f_auc1i100_3_2);
					}
				}

				foreach ($valAUC1I100["AUC1I100_3_3"] as $key_AUC1I100_3_3 => $val_AUC1I100_3_3) {
					$f_auc1i100_3_3['PCC_CIVIL_GEN']	= $pccCivilGen;
					$f_auc1i100_3_3['AUC_ASSET_GEN']	= $valAUC1I100["AUC_ASSET_GEN"];
					$f_auc1i100_3_3['TR_NO']			= $val_AUC1I100_3_3['TR_NO'];
					$f_auc1i100_3_3['TR_BOOK_NO']		= $val_AUC1I100_3_3['TR_BOOK_NO'];
					$f_auc1i100_3_3['TR_DATE'] 			= ($val_AUC1I100_3_3["TR_DATE"]) ? date('Y-m-d', strtotime($val_AUC1I100_3_3["TR_DATE"])) : '';
					$f_auc1i100_3_3['TR_AMOUNT']		= $val_AUC1I100_3_3['TR_AMOUNT'];


					if (pm_check_dup_arr(
						array(
							'AUC_ASSET_GEN' => $valAUC1I100["AUC_ASSET_GEN"],
							'TR_NO' => $val_AUC1I100_3_3['TR_NO'],
							'TR_BOOK_NO' => $val_AUC1I100_3_3['TR_BOOK_NO'],
							'TR_DATE' => $val_AUC1I100_3_3['TR_DATE'],
							'TR_AMOUNT' => $val_AUC1I100_3_3['TR_AMOUNT']
						),
						'WH_CIVIL_ANN_RESULT_RECEIPT'
					) == 0) {
						db::db_insert("WH_CIVIL_ANN_RESULT_RECEIPT", $f_auc1i100_3_3);
					}
				}

				foreach ($valAUC1I100["AUC1I100_4"] as $key_AUC1I100_4 => $val_AUC1I100_4) {
					$f_auc1i100_4['PCC_CIVIL_GEN']			= $pccCivilGen;
					$f_auc1i100_4['PLEDGE']					= $val_AUC1I100_4["PLEDGE"];
					$f_auc1i100_4['SALE_NO']				= $val_AUC1I100_4['SALE_NO'];
					$f_auc1i100_4['SALE_REAL_NO']			= $val_AUC1I100_4['SALE_REAL_NO'];
					$f_auc1i100_4['SALE_DATE'] 				= ($val_AUC1I100_4["SALE_DATE"]) ? date('Y-m-d', strtotime($val_AUC1I100_4["SALE_DATE"])) : '';
					$f_auc1i100_4['BID_RESULT']				= $val_AUC1I100_4['BID_RESULT'];
					$f_auc1i100_4['AUC_ASSET_BID_RESULT']	= $val_AUC1I100_4['AUC_ASSET_BID_RESULT'];
					$f_auc1i100_4['UNIT_TOTAL']				= $val_AUC1I100_4['UNIT_TOTAL'];
					$f_auc1i100_4['UNIT_REST']				= $val_AUC1I100_4['UNIT_REST'];
					$f_auc1i100_4['UNIT_SALE']				= $val_AUC1I100_4['UNIT_SALE'];
					$f_auc1i100_4['BUYING_BY']				= $val_AUC1I100_4['BUYING_BY'];
					$f_auc1i100_4['BID_RESULT_NAME']		= $val_AUC1I100_4['BID_RESULT_NAME'];
					$f_auc1i100_4['BID_AMOUNT']				= $val_AUC1I100_4['BID_AMOUNT'];
					$f_auc1i100_4['BID_STEP_UP']			= $val_AUC1I100_4['BID_STEP_UP'];
					$f_auc1i100_4['OPPOSE_PLAINTIFF']		= $val_AUC1I100_4['OPPOSE_PLAINTIFF'];
					$f_auc1i100_4['OPPOSE_DEFENDANT']		= $val_AUC1I100_4['OPPOSE_DEFENDANT'];
					$f_auc1i100_4['OPPOSE_OTHER']			= $val_AUC1I100_4['OPPOSE_OTHER'];
					$f_auc1i100_4['AUCT_STOP_DESC']			= $val_AUC1I100_4['AUCT_STOP_DESC'];
					$f_auc1i100_4['SELL_RELEASE_STATUS']	= $val_AUC1I100_4['SELL_RELEASE_STATUS'];
					$f_auc1i100_4['AUC_LOT_GEN']			= $val_AUC1I100_4['AUC_LOT_GEN'];
					$f_auc1i100_4['AUC_SUB_ORDER_GEN']		= $val_AUC1I100_4['AUC_SUB_ORDER_GEN'];


					if (pm_check_dup(
						'AUC_SUB_ORDER_GEN',
						$val_AUC1I100_4['AUC_SUB_ORDER_GEN'],
						'WH_CIVIL_ANN_RESULT_PAST'
					) == 0) {
						db::db_insert("WH_CIVIL_ANN_RESULT_PAST", $f_auc1i100_4);
					}
				}
			}
		}
	}
}

getResultAnnounceCivilCase($pccCaseGen, $show_data, 'Y');
