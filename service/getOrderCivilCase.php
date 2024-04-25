<?php
include '../include/include.php';

$pccCaseGen = $_GET['pccCaseGen'];
$show_data = $_GET['show_data'];

// ------------------------------------------------------------------------------------------------------------
$WF_GET_ORDER_CIVIL_CASE = "http://103.40.146.73/LedServiceCivilById.php/getOrderCivilCase";
// ------------------------------------------------------------------------------------------------------------

function getOrderCivilCase($pccCaseGen, $show_data = '', $alert = '')
{
	global $WF_GET_ORDER_CIVIL_CASE;
	$txtFunc = 'ใบสั่งจ่าย';

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $WF_GET_ORDER_CIVIL_CASE,
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

	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	$dataReturn = json_decode($response, true);

	if ($show_data == 'Y') {
		print_pre($dataReturn);
	}

	$txtAlert = '';

	if (isset($dataReturn["ResponseCode"])) {
		if (isset($dataReturn['Data']) && count($dataReturn['Data']) > 0) {

			db::db_delete("WH_CIVIL_CASE_ORDER", array('PCC_CASE_GEN' => $pccCaseGen));
			db::db_delete("WH_CIVIL_ORDER_LIST", array('PCC_CASE_GEN' => $pccCaseGen));

			foreach ($dataReturn["Data"] as $dataMain) {

				unset($fields);
				$fields["AUD_PAID_GEN"] 		= $dataMain["AUD_PAID_GEN"];
				$fields["PCC_CASE_GEN"] 		= $dataMain["PCC_CASE_GEN"];
				$fields["CASE_CODE"] 			= $dataMain["CASE_CODE"];
				$fields["CASE_NAME"] 			= $dataMain["CASE_NAME"];
				$fields["PAY_TYPES"] 			= $dataMain["PAY_TYPES"];
				$fields["PAY_NAME"] 			= $dataMain["PAY_NAME"];
				$fields["ACC_CODE"] 			= $dataMain["ACC_CODE"];
				$fields["COURT_CODE"] 			= $dataMain["COURT_CODE"];
				$fields["COURT_NAME"] 			= $dataMain["COURT_NAME"];
				$fields["RECV_NO"] 				= $dataMain["RECV_NO"];
				$fields["RECV_YEAR"] 			= $dataMain["RECV_YEAR"];
				$fields["PLAINTIFF1"] 			= $dataMain["PLAINTIFF1"];
				$fields["PLAINTIFF2"] 			= $dataMain["PLAINTIFF2"];
				$fields["PLAINTIFF3"] 			= $dataMain["PLAINTIFF3"];
				$fields["DEFENDANT1"] 			= $dataMain["DEFENDANT1"];
				$fields["DEFENDANT2"] 			= $dataMain["DEFENDANT2"];
				$fields["DEFENDANT3"] 			= $dataMain["DEFENDANT3"];
				$fields["DOSS_CODE"] 			= $dataMain["DOSS_CODE"];
				$fields["DOSS_NAME"] 			= $dataMain["DOSS_NAME"];
				$fields["CANCEL_FLAG"] 			= $dataMain["CANCEL_FLAG"];
				$fields["PREFIX_BLACK_CASE"]	= $dataMain["PREFIX_BLACK_CASE"];
				$fields["BLACK_CASE"] 			= $dataMain["BLACK_CASE"];
				$fields["BLACK_YY"] 			= $dataMain["BLACK_YY"];
				$fields["PREFIX_RED_CASE"] 		= $dataMain["PREFIX_RED_CASE"];
				$fields["RED_CASE"] 			= $dataMain["RED_CASE"];
				$fields["RED_YY"] 				= $dataMain["RED_YY"];
				$fields["TR_NO"] 				= $dataMain["TR_NO"];
				$fields["TR_BOOK_NO"] 			= $dataMain["TR_BOOK_NO"];
				$fields["PAID_TYPE"] 			= $dataMain["PAID_TYPE"];
				$fields["TR_DATE"] 				= ($dataMain["TR_DATE"]) ? date('Y-m-d', strtotime($dataMain["TR_DATE"])) : '';
				$fields["TR_TO1"] 				= $dataMain["TR_TO1"];
				$fields["TR_TO2"] 				= $dataMain["TR_TO2"];
				$fields["TR_COMMENT"]			= $dataMain["TR_COMMENT"];
				$fields["OWNER_SAVE_NAME"] 		= $dataMain["OWNER_SAVE_NAME"];
				$fields["PAID_TYPE_NAME"] 		= $dataMain["PAID_TYPE_NAME"];
				$fields["CANCEL_FLAG_NAME"]		= $dataMain["CANCEL_FLAG_NAME"];

				db::db_insert("WH_CIVIL_CASE_ORDER", $fields);

				if (count($dataMain['ORDER_LIST']) > 0) {
					foreach ($dataMain['ORDER_LIST'] as $key => $orderList) {

						unset($fieldsList);
						$fieldsList["AUD_PAID_DETAIL_GEN"]	= $orderList["AUD_PAID_DETAIL_GEN"];
						$fieldsList["PCC_CASE_GEN"]			= $orderList["PCC_CASE_GEN"];
						$fieldsList["AUD_PAID_GEN"]			= $orderList["AUD_PAID_GEN"];
						$fieldsList["TR_SEQ"]				= $orderList["TR_SEQ"];
						$fieldsList["SENDWRIT_BOOK_NO"]		= $orderList["SENDWRIT_BOOK_NO"];
						$fieldsList["SENDWRIT_BOOK_DATE"]	= ($orderList["SENDWRIT_BOOK_DATE"]) ? date('Y-m-d', strtotime($orderList["SENDWRIT_BOOK_DATE"])) : '';
						$fieldsList["RECPAY_CODE"]			= $orderList["RECPAY_CODE"];
						$fieldsList["RECPAY_NAME"]			= $orderList["RECPAY_NAME"];
						$fieldsList["TR_AMOUNT"]			= $orderList["TR_AMOUNT"];

						db::db_insert("WH_CIVIL_ORDER_LIST", $fieldsList);
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

echo getOrderCivilCase($pccCaseGen, $show_data, 'Y');
