<?php
include '../include/include.php';

$pccCaseGen = $_GET['pccCaseGen'];
$show_data = $_GET['show_data'];

// ------------------------------------------------------------------------------------------------------------
$WF_CIVIL_GET_ACCOUNT_INCOME_EXPENSES = "http://103.40.146.73/LedServiceCivilById.php/getAccountIncomeExpenses";
// ------------------------------------------------------------------------------------------------------------

function getAccountIncomeExpensesCivilCase($pccCaseGen, $show_data = '', $alert = '')
{

	global $WF_CIVIL_GET_ACCOUNT_INCOME_EXPENSES;
	$txtFunc = 'บัญชีรับจ่าย';

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $WF_CIVIL_GET_ACCOUNT_INCOME_EXPENSES,
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

	// PC.PCC_CASE_GEN = 4716534 OR 
	// PC.PCC_CASE_GEN = 4716621 OR
	// PC.PCC_CASE_GEN = 1283099

	// WH_CIVIL_CASE_ACCOUNT_LIST
	// WH_CIVIL_CASE_ACCOUNT_INCEXP

	$txtAlert = '';

	if (isset($dataReturn["ResponseCode"])) {
		if (isset($dataReturn['Data']) && count($dataReturn['Data']) > 0) {

			db::db_delete('WH_CIVIL_CASE_ACCOUNT_LIST',	array("PCC_CASE_GEN" => $pccCaseGen));
			db::db_delete('WH_CIVIL_CASE_ACCOUNT_INCEXP', array("PCC_CASE_GEN" => $pccCaseGen));
			// exit;
			foreach ($dataReturn["Data"] as $dataMain) {

				unset($fields);
				$fields["AUD_PRIVATE_GEN"]		= $dataMain["AUD_PRIVATE_GEN"];
				$fields["AUD_PRIVATE_CENT_DEPT_GEN"]	= $dataMain["AUD_PRIVATE_CENT_DEPT_GEN"];
				$fields["PCC_CASE_GEN"]			= $dataMain["PCC_CASE_GEN"];
				$fields["ACC_CODE"]				= $dataMain["ACC_CODE"];
				$fields["ACC_NAME"]				= $dataMain["ACC_NAME"];
				$fields["CASE_CODE"]			= $dataMain["CASE_CODE"];
				$fields["CASE_NAME"]			= $dataMain["CASE_NAME"];
				$fields["DOSS_CODE"]			= $dataMain["DOSS_CODE"];
				$fields["DOSS_NAME"]			= $dataMain["DOSS_NAME"];
				$fields["COURT_CODE"]			= $dataMain["COURT_CODE"];
				$fields["COURT_NAME"]			= $dataMain["COURT_NAME"];
				$fields["RECV_NO"]				= $dataMain["RECV_NO"];
				$fields["RECV_YEAR"]			= $dataMain["RECV_YEAR"];
				$fields["PREFIX_BLACK_CASE"]	= $dataMain["PREFIX_BLACK_CASE"];
				$fields["BLACK_CASE"]			= $dataMain["BLACK_CASE"];
				$fields["BLACK_YY"]				= $dataMain["BLACK_YY"];
				$fields["PREFIX_RED_CASE"]		= $dataMain["PREFIX_RED_CASE"];
				$fields["RED_CASE"]				= $dataMain["RED_CASE"];
				$fields["RED_YY"]				= $dataMain["RED_YY"];
				$fields["PLAINTIFF1"]			= $dataMain["PLAINTIFF1"];
				$fields["PLAINTIFF2"]			= $dataMain["PLAINTIFF2"];
				$fields["DEFENDANT1"]			= $dataMain["DEFENDANT1"];
				$fields["DEFENDANT2"]			= $dataMain["DEFENDANT2"];
				$fields["ACC_AMOUNT"]			= $dataMain["ACC_AMOUNT"];
				$fields["ACC_DATE"]				= ($dataMain["ACC_DATE"]) ? date('Y-m-d', strtotime($dataMain["ACC_DATE"])) : '';
				$fields["MONEY_TOGETHER"]		= $dataMain["MONEY_TOGETHER"];
				$fields["INCOME"]				= $dataMain["INCOME"];
				$fields["EXPENSES"]				= $dataMain["EXPENSES"];
				// $fields["PLAINTIFF3"]		= $dataMain["PLAINTIFF3"];
				// $fields["DEFENDANT3"]		= $dataMain["DEFENDANT3"];

				db::db_insert("WH_CIVIL_CASE_ACCOUNT_LIST", $fields);
				$INCEXP_I = 1;
				foreach ($dataMain['INC_EXP'] as $incExp) {
					unset($fieldIncExp, $INCEXP_TYPE);

					if ($incExp["D_AMOUNT"] != '') {
						$INCEXP_TYPE = 1;
					} else {
						$INCEXP_TYPE = 2;
					}

					$fieldIncExp['AUD_PRIVATE_GEN'] = $dataMain["AUD_PRIVATE_GEN"];
					$fieldIncExp["PCC_CASE_GEN"] 	= $dataMain["PCC_CASE_GEN"];
					$fieldIncExp["TR_DATE"] 		= ($incExp["TR_DATE"]) ? date('Y-m-d', strtotime($incExp["TR_DATE"])) : '';
					$fieldIncExp["TR_NO_BOOK_NO"] 	= $incExp["TR_NO_BOOK_NO"];
					$fieldIncExp["RECPAY_NAME"] 	= $incExp["RECPAY_NAME"];
					$fieldIncExp["D_AMOUNT"] 		= $incExp["D_AMOUNT"];
					$fieldIncExp["C_AMOUNT"]		= $incExp["C_AMOUNT"];
					$fieldIncExp["INCEXP_TYPE"] 	= $INCEXP_TYPE;
					$fieldIncExp["SEQ"] 			= $INCEXP_I;

					db::db_insert("WH_CIVIL_CASE_ACCOUNT_INCEXP", $fieldIncExp);
					$INCEXP_I++;
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

echo getAccountIncomeExpensesCivilCase($pccCaseGen, $show_data, 'Y');
