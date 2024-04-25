<?php
include '../include/include.php';

$pccCaseGen = $_GET['pccCaseGen'];
$show_data = $_GET['show_data'];

// ------------------------------------------------------------------------------------------------------------
$WF_GET_ANNOUNCE_CIVIL_CASE = "http://103.40.146.73/LedServiceCivilById.php/getAnnounceCivilCase";
// ------------------------------------------------------------------------------------------------------------

function getAnnounceCivilCase($pccCaseGen, $show_data = '', $alert = '')
{
	global $WF_GET_ANNOUNCE_CIVIL_CASE;
	$txtFunc = 'ประกาศขายทอดตลาด';

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $WF_GET_ANNOUNCE_CIVIL_CASE,
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
			"pccCaseGen":"' . $pccCaseGen . '"
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
	// exit;
	$txtAlert = '';

	if (isset($dataReturn["ResponseCode"])) {
		if (isset($dataReturn['Data']) && count($dataReturn['Data']) > 0) {
			foreach ($dataReturn["Data"] as $dataMain) {

				$sqlSelectData = "SELECT	WH_CIVIL_ANNOUNCE_ID
								FROM 		WH_CIVIL_ANN
								WHERE 		AUC_DISTRIBUTE_GEN = '" . $dataMain["AUC_DISTRIBUTE_GEN"] . "' ";
				$querySelectData = db::query($sqlSelectData);
				$dataSelectData = db::fetch_array($querySelectData);

				unset($fields);
				$fields["AUC_DISTRIBUTE_GEN"] 	= $dataMain["AUC_DISTRIBUTE_GEN"];
				$fields["PCC_CASE_GEN"] 		= $dataMain["PCC_CASE_GEN"];
				$fields["PCC_CIVIL_GEN"] 		= $dataMain["PCC_CIVIL_GEN"];
				$fields["AUC_LOT"] 				= $dataMain["AUC_LOT"];
				$fields["AUC_LOT_YY"] 			= $dataMain["AUC_LOT_YY"];
				$fields["AUC_SET"] 				= $dataMain["AUC_SET"];
				$fields["ST_ORDER"] 			= $dataMain["ST_ORDER"];
				$fields["END_ORDER"] 			= $dataMain["END_ORDER"];
				$fields["NOTICE_TITLE"] 		= $dataMain["NOTICE_TITLE"]; //เรื่อง(ประกาศขายทอดตลาด)
				$fields["DF_BELONG"] 			= $dataMain["DF_BELONG"]; //เป็นทรัพย์ของจำเลย
				$fields["ASSET_FOR_SALE"] 		= $dataMain["ASSET_FOR_SALE"]; //รายการทรัพย์ที่จะขาย
				$fields["JUM_NONG"] 			= $dataMain["JUM_NONG"]; //ภาระหนี้จำนอง/ภาระหนี้ส่วนกลาง
				$fields["HOW_TO_BUY"] 			= $dataMain["HOW_TO_BUY"]; //วิธีการขาย
				$fields["CONDITION"] 			= $dataMain["CONDITION"]; //เงื่อนไข
				$fields["SUM_ESTIMATE"] 		= $dataMain["SUM_ESTIMATE"]; //สรุปราคาประเมิน
				$fields["SUM_GUARANTEE"] 		= $dataMain["SUM_GUARANTEE"]; //สรุปวางหลักประกัน
				$fields["ASSET_DATE"] 			= $dataMain["ASSET_DATE"]; //วันที่ขาย
				$fields["PLAINTIFF"] 			= $dataMain["PLAINTIFF"]; //โจทก์
				$fields["DEFENDANT"] 			= $dataMain["DEFENDANT"]; //จำเลย
				$fields["REPLACE_STATUS"] 		= $dataMain["REPLACE_STATUS"]; //สถานะผู้สวมสิทธิ์
				$fields["ACC_CODE"] 			= $dataMain["ACC_CODE"]; //สถานะผู้สวมสิทธิ์
				$fields["AUCTION_PLACE"]		= $dataMain["AUCTION_PLACE"]; 
				if ($dataSelectData["WH_CIVIL_ANNOUNCE_ID"] > 0) {
					db::db_update("WH_CIVIL_ANN", $fields, array('WH_CIVIL_ANNOUNCE_ID' => $dataSelectData["WH_CIVIL_ANNOUNCE_ID"]));
					$WH_CIVIL_ANNOUNCE_ID = $dataSelectData["WH_CIVIL_ANNOUNCE_ID"];
				} else {
					$WH_CIVIL_ANNOUNCE_ID = db::db_insert("WH_CIVIL_ANN", $fields, 'WH_CIVIL_ANNOUNCE_ID', 'WH_CIVIL_ANNOUNCE_ID');
				}

				db::db_delete("WH_CIVIL_ANN_ASSET", array('WH_CIVIL_ANNOUNCE_ID' => $WH_CIVIL_ANNOUNCE_ID));
				db::db_delete("WH_CIVIL_ANN_ASSET_DET", array('WH_CIVIL_ANNOUNCE_ID' => $WH_CIVIL_ANNOUNCE_ID));
				db::db_delete("WH_CIVIL_ANN_ASSET_SALE", array('WH_CIVIL_ANNOUNCE_ID' => $WH_CIVIL_ANNOUNCE_ID));

				if (count($dataMain['ASSET']) > 0) {
					foreach ($dataMain['ASSET'] as $key => $dataAsset) {
						unset($fields);
						$fields["WH_CIVIL_ANNOUNCE_ID"] 		= $WH_CIVIL_ANNOUNCE_ID;
						$fields["AUC_ASSET_GEN"] 				= $dataAsset["AUC_ASSET_GEN"];
						$fields["CFC_CAPTION_GEN"] 				= $dataAsset["CFC_CAPTION_GEN"];
						$fields["SHR_PROPERTY_CASE_GEN"] 		= $dataAsset["SHR_PROPERTY_CASE_GEN"];
						$fields["PROP_TITLE"] 					= $dataAsset["PROP_TITLE"];
						$fields["CAP_NO"] 						= $dataAsset["CAP_NO"];
						$fields["SPC_SEQ_NO"] 					= $dataAsset["SPC_SEQ_NO"];
						$fields["SUB_ORDER"] 					= $dataAsset["SUB_ORDER"];
						$fields["SALE_BY_NAME"] 				= $dataAsset["SALE_BY_NAME"];
						$fields["TYPE_DESC"] 					= $dataAsset["TYPE_DESC"];
						$fields["PROP_DET"] 					= $dataAsset["PROP_DET"];	// *
						$fields["EST_LAWYER"] 					= $dataAsset["EST_LAWYER"];
						$fields["EST_DOL"] 						= $dataAsset["EST_DOL"];
						$fields["EST_VANG_SUB"] 				= $dataAsset["EST_VANG_SUB"];
						$fields["EST_GROUP_AMOUNT"] 			= $dataAsset["EST_GROUP_AMOUNT"];
						$fields["EST_SUB_AMOUNT"] 				= $dataAsset["EST_SUB_AMOUNT"];
						$fields["COPY_FLAG_NAME"] 				= $dataAsset["COPY_FLAG_NAME"];
						$fields["PLEDGE"] 						= $dataAsset["PLEDGE"];
						$fields["COMMIT_TYPE"] 					= $dataAsset["COMMIT_TYPE"];
						$fields["PROP_STATUS_NAME"] 			= $dataAsset["PROP_STATUS_NAME"];
						$fields["PERSON_FULL_NAME"] 			= $dataAsset["PERSON_FULL_NAME"];
						$fields["SEQ_NO"] 						= $dataAsset["SEQ_NO"];
						$fields["SALE_TYPE"] 					= $dataAsset["SALE_TYPE"];
						$fields["TYPE_CODE"] 					= $dataAsset["TYPE_CODE"];
						$fields["SALE_BY_COPY"] 				= $dataAsset["SALE_BY_COPY"];
						$fields["PROP_STATUS"] 					= $dataAsset["PROP_STATUS"];
						$fields["REMARK"] 						= $dataAsset["REMARK"];
						$fields["CFC_TYPE_CODE_GEN"] 			= $dataAsset["CFC_TYPE_CODE_GEN"];
						$fields["SALE_CANC_FLAG"] 				= $dataAsset["SALE_CANC_FLAG"];
						$fields["CFC_CIVIL_GEN"] 				= $dataAsset["CFC_CIVIL_GEN"];
						$fields["SALE_BY"] 						= $dataAsset["SALE_BY"];
						$fields["AUC_LOT_GEN"] 					= $dataAsset["AUC_LOT_GEN"];
						$fields["OWNER_PERSON_GEN"] 			= $dataAsset["OWNER_PERSON_GEN"];
						$fields["UNIT_TOTAL"] 					= $dataAsset["UNIT_TOTAL"];
						$fields["UNIT_REST"] 					= $dataAsset["UNIT_REST"];
						$fields["CIVIL_CANC_FLAG"] 				= $dataAsset["CIVIL_CANC_FLAG"];
						$fields["DIVIED_FLAG"] 					= $dataAsset["DIVIED_FLAG"];
						$fields["AUTHORITY_FLAG"] 				= $dataAsset["AUTHORITY_FLAG"];
						$fields["PORTION_FLAG"] 				= $dataAsset["PORTION_FLAG"];
						$fields["TAKE_FLAG"] 					= $dataAsset["TAKE_FLAG"];
						$fields["FREE_FLAG"] 					= $dataAsset["FREE_FLAG"];
						$fields["FLAG_CANCEL"] 					= $dataAsset["FLAG_CANCEL"];
						$fields["LAND_TYPE_DESC"] 				= $dataAsset["LAND_TYPE_DESC"];
						$fields["EST_SPECIALIST"] 				= $dataAsset["EST_SPECIALIST"];
						$fields["EST_MORTGAGE"] 				= $dataAsset["EST_MORTGAGE"];
						$fields["EST_BANK"] 					= $dataAsset["EST_BANK"];
						$fields["PLOT_SEQ"] 					= $dataAsset["PLOT_SEQ"];
						$fields["DEBT_PLEDGE_AMT"] 				= $dataAsset["DEBT_PLEDGE_AMT"];
						$fields["DEBT_AMT"] 					= $dataAsset["DEBT_AMT"];
						$fields["R_SELL_TYPE_NAME"]				= $dataAsset["R_SELL_TYPE_NAME"];
						$fields["ASSET_DESC_BAK"]				= $dataAsset["ASSET_DESC_BAK"];
						db::db_insert("WH_CIVIL_ANN_ASSET", $fields, 'WH_CIVIL_ANN_ASSET_ID', 'WH_CIVIL_ANN_ASSET_ID');
					}
				}

				if (count($dataMain['ASSET_SEL']) > 0) {
					foreach ($dataMain['ASSET_SEL'] as $key => $dataAsset) {
						unset($fields);
						$fields["WH_CIVIL_ANNOUNCE_ID"] 		= $WH_CIVIL_ANNOUNCE_ID;
						$fields["AUC_ASSET_GEN"] 				= $dataAsset["AUC_ASSET_GEN"];
						$fields["SHR_CASE_GEN"] 				= $dataAsset["SHR_CASE_GEN"];
						$fields["SALE_BY_DESC"] 				= $dataAsset["SALE_BY_DESC"];
						$fields["ASSET_DESC"] 					= $dataAsset["ASSET_DESC"];
						$fields["ASSET_OWNER"] 					= $dataAsset["ASSET_OWNER"];
						$fields["ASSET_TOPIC"] 					= $dataAsset["ASSET_TOPIC"];
						$fields["DEED_NUMBER"] 					= $dataAsset["DEED_NUMBER"];
						$fields["BID_TYPE_FROM_NAME"]			= $dataAsset["BID_TYPE_FROM_NAME"];
						$fields["EST_LAWYER"]					= $dataAsset["EST_LAWYER"];
						$fields["DEBT_PLEDGE_AMT"]				= $dataAsset["DEBT_PLEDGE_AMT"];
						$fields["PLEDGE"]						= $dataAsset["PLEDGE"];
						$fields["IS_EXTRA_PLEDGE"]				= $dataAsset["IS_EXTRA_PLEDGE"];
						$fields["PLEDGE_TIME"]					= $dataAsset["PLEDGE_TIME"];
						$fields["RESERVE_FUND1"]				= $dataAsset["RESERVE_FUND1"];
						$fields["NEAR_BTS_FLAG"]				= $dataAsset["NEAR_BTS_FLAG"];
						$fields["CASE1"]						= $dataAsset["CASE1"];
						$fields["APPROVE_FLAG"]					= $dataAsset["APPROVE_FLAG"];
						$fields["REMARK"]						= $dataAsset["REMARK"];
						db::db_insert("WH_CIVIL_ANN_ASSET_SALE", $fields, 'WH_CIVIL_ANNOUNCE_DET_ID', 'WH_CIVIL_ANNOUNCE_DET_ID');
					}
				}

				if (count($dataMain['ASSET_DET']) > 0) {
					foreach ($dataMain['ASSET_DET'] as $key => $dataAsset) {
						unset($fields);
						$fields["WH_CIVIL_ANNOUNCE_ID"] 		= $WH_CIVIL_ANNOUNCE_ID;
						$fields["AUC_ASSET_GEN"] 				= $dataAsset["AUC_ASSET_GEN"];
						$fields["SHR_CASE_GEN"] 				= $dataAsset["SHR_CASE_GEN"];
						$fields["FLAG_CANCEL"] 					= $dataAsset["FLAG_CANCEL"];
						$fields["AUC_ASSET_DETAIL1"] 			= $dataAsset["AUC_ASSET_DETAIL1"];
						db::db_insert("WH_CIVIL_ANN_ASSET_DET", $fields, 'WH_CIVIL_ANNOUNCE_DET_ID', 'WH_CIVIL_ANNOUNCE_DET_ID');
					}
				}
			}

			$txtAlert = 'ดึงข้อมูล "' . $txtFunc . '" เสร็จสิ้น';
		} else {
			$txtAlert = 'ไม่พบข้อมูล "' . $txtFunc . '" ';
		}
	} else {
		$txtAlert = 'ดึงข้อมูล "' . $txtFunc . '" ล้มเหลว';
	}

	if ($alert == 'Y') {
		echo "<script>alert('$txtAlert')</script>";
	}

	return $txtAlert;
}

echo getAnnounceCivilCase($pccCaseGen, $show_data, 'Y');
