<?php
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Origin: *');
	header('Cache-Control: no-cache');
	header('Access-Control-Max-Age: 1728000');
	header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Access-Control-Request-Private-Network');
	header('Access-Control-Allow-Private-Network: true');
	die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include '../include/include.php';
include '../include/func_Nop.php';
include './check_case_Function.php';

$str_json = file_get_contents("php://input");
$res = json_decode($str_json, true);
/* เก็บ log start */
$array_link = "";
foreach (json_decode($str_json, true) as $sh1 => $ch1) {
	$array_link .= "&" . $sh1 . "=" . $ch1;
}
unset($fields);
$fields["PAGE_CODE"]                 =    "Led_serviceQuery";
$fields["COLUMN1"]                 =     $array_link;
$fields["CREATE_DATE"]                 =    date("Y-m-d");
$fields["SYSTEM_TYPE"]                 =   "1";
db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
/* เก็บ log stop */

$Civil = new civil();
$Array_params = array();

$page = $res['page']; //หน้า
$action = $res['action']; //ชื่อปุ่ม
$Array_params = $res['params']; //ตัวแปลที่ส่งมา
$pccCivilGen = $Array_params['pccCivilGen'];
$cfcCaptionGen = $Array_params['cfcCaptionGen'];
$shrCaseGen = $Array_params['shrCaseGen'];
$ArrayCfcCaptionGen_page2 = $Array_params['getWebUITableHiddenChecked:cfcCivilAndAssetTable:cfcCaptionGen'];
$ArrayCfcCaptionGen_page3 = $Array_params['getWebUITableHiddenChecked:propertyTable:cfcCaptionGen'];

//การเรียกใช้ function (civil::checkPersonMountBankrupt($pccCivilGen,"โจทก์","จำเลย "))
// ตย. (civil::checkPersonMountBankrupt(pccCivilGen,สถานะของเเพ่งที่ส่งไปตรวจ,สถานะของล้มที่พบเจอ))
// จะreturn จำนวนคนที่ติดอยู่ในล้มละลายตามสถานะ ที่ส่งไปเช็คเเละ สถานะปลายทางที่ถูกเช็ค ในตัวอยากคือการส่ง โจทก์ เช็คเป็น จำเลย ในล้มละลาย
$work = 0;


switch ($page) {
	case "DPD2I010_1":
		$work = 1;
		if ($action == "saveByWorkStatus") { //ACCOUNTING_FLAG ต้องเช็คCPC_ ห้ามทำบัญชี
			$num = 0;
			//ได้ CFC กับมาทรัพย์เดียว
			foreach (civil::DATA_CFCCAPTION_FROM_SHR($shrCaseGen) as $AA1 => $BB1) { // ส่ง shrCaseGen ไปที่ DATA_CFCCAPTION_FROM_SHR จะได้ CFC_CAPTIONกลับมา
				//LOCK_ACCOUNTING_FLAG ห้ามทำบัญชี
				$num = 0;
				$note = '';
				$Ar = (civil::DATA_CFC_CAPTION($BB1));
				$Func = new civil();
				$Func->CFC_CAPTION = $cfcCaptionGen;
				$Func->AR_IS_OWNER_BANKRUPT = $Ar['IS_OWNER_BANKRUPT'];
				$Func->AR_IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				$Func->AR_LOCK_CONFISCATE_FLAG = $Ar['LOCK_CONFISCATE_FLAG'];
				$Func->AR_LOCK_SELL_FLAG = $Ar['LOCK_SELL_FLAG'];
				$Func->AR_LOCK_ACCOUNTING_FLAG = $Ar['LOCK_ACCOUNTING_FLAG'];
				unset($array_data);
				$array_data = [
					'status' => (($Func->textAlert('LOCK_ACCOUNTING_FLAG', 'num')) > 0 ? "no" : "yes"),
					'ResMeasalertMessagesage' => ($Func->textAlert('LOCK_ACCOUNTING_FLAG', 'note')) //เเจ้งเตือน
				];
			}
		}
		if ($action == "sendCheck") {

			$num = 0;
			//ได้ CFC กับมาทรัพย์เดียว
			foreach (civil::DATA_CFCCAPTION_FROM_SHR($shr_case_gen) as $AA1 => $BB1) { // ส่ง shr_case_genไปที่ DATA_CFCCAPTION_FROM_SHR จะได้ CFC_CAPTIONกลับมา
				//LOCK_ACCOUNTING_FLAG ห้ามทำบัญชี
				$num = 0;
				$note = '';
				$Ar = (civil::DATA_CFC_CAPTION($BB1));
				$Func = new civil();
				$Func->CFC_CAPTION = $cfcCaptionGen;
				$Func->AR_IS_OWNER_BANKRUPT = $Ar['IS_OWNER_BANKRUPT'];
				$Func->AR_IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				$Func->AR_LOCK_CONFISCATE_FLAG = $Ar['LOCK_CONFISCATE_FLAG'];
				$Func->AR_LOCK_SELL_FLAG = $Ar['LOCK_SELL_FLAG'];
				$Func->AR_LOCK_ACCOUNTING_FLAG = $Ar['LOCK_ACCOUNTING_FLAG'];
				unset($array_data);
				$array_data = [
					'status' => (($Func->textAlert('LOCK_ACCOUNTING_FLAG', 'num')) > 0 ? "no" : "yes"),
					'ResMeasalertMessagesage' => ($Func->textAlert('LOCK_ACCOUNTING_FLAG', 'note')) //เเจ้งเตือน
				];
			}
		}
		if ($action == "processAccount") {
			$num = 0;
			// ส่ง shr_case_genไปที่ DATA_CFCCAPTION_FROM_SHR จะได้ CFC_CAPTIONกลับมา
			//ได้ CFC กับมาทรัพย์เดียว
			foreach (civil::DATA_CFCCAPTION_FROM_SHR($shr_case_gen) as $AA1 => $BB1) {
				//LOCK_ACCOUNTING_FLAG ห้ามทำบัญชี
				$num = 0;
				$note = '';
				$Ar = (civil::DATA_CFC_CAPTION($BB1));
				$Func = new civil();
				$Func->CFC_CAPTION = $cfcCaptionGen;
				$Func->AR_IS_OWNER_BANKRUPT = $Ar['IS_OWNER_BANKRUPT'];
				$Func->AR_IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				$Func->AR_LOCK_CONFISCATE_FLAG = $Ar['LOCK_CONFISCATE_FLAG'];
				$Func->AR_LOCK_SELL_FLAG = $Ar['LOCK_SELL_FLAG'];
				$Func->AR_LOCK_ACCOUNTING_FLAG = $Ar['LOCK_ACCOUNTING_FLAG'];
				unset($array_data);
				$array_data = [
					'status' => (($Func->textAlert('LOCK_ACCOUNTING_FLAG', 'num')) > 0 ? "no" : "yes"),
					'ResMeasalertMessagesage' => ($Func->textAlert('LOCK_ACCOUNTING_FLAG', 'note')) //เเจ้งเตือน
				];
			}
		}
		break;

	case "DPD1I030": //ทำสัญญาส่ง13หลักมาตรวจ
		$work = 1;
		if ($action == "approveAccount") {
			$num = 0;
			$dpdCivilTrnGen = $Array_params['dpdCivilTrnGen'];
			$DPD_GET_CFC_CAPTION = civil::DPD_GET_CFC_CAPTION($dpdCivilTrnGen);
			//ได้ CFC กับมาทรัพย์เดียว
			foreach ($DPD_GET_CFC_CAPTION as $AA1 => $BB1) {
				//LOCK_ACCOUNTING_FLAG ห้ามทำบัญชี
				$num = 0;
				$note = '';
				$Ar = (civil::DATA_CFC_CAPTION($BB1));
				$Func = new civil();
				$Func->CFC_CAPTION = $cfcCaptionGen;
				$Func->AR_IS_OWNER_BANKRUPT = $Ar['IS_OWNER_BANKRUPT'];
				$Func->AR_IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				$Func->AR_LOCK_CONFISCATE_FLAG = $Ar['LOCK_CONFISCATE_FLAG'];
				$Func->AR_LOCK_SELL_FLAG = $Ar['LOCK_SELL_FLAG'];
				$Func->AR_LOCK_ACCOUNTING_FLAG = $Ar['LOCK_ACCOUNTING_FLAG'];
				unset($array_data);
				$array_data = [
					'status' => (($Func->textAlert('LOCK_ACCOUNTING_FLAG', 'num')) > 0 ? "no" : "yes"),
					'ResMeasalertMessagesage' => ($Func->textAlert('LOCK_ACCOUNTING_FLAG', 'note')) //เเจ้งเตือน
				];
			}
		}
		break;
	case "AUC1I100_2": //ทำสัญญาส่ง13หลักมาตรวจ
		$work = 1;
		if ($action == "addPerson") {
			$num1 = 0;
			//Group 1 คนในคดีของทรัพย์
			$aucSubOrderGen = $Array_params['aucSubOrderGen'];
			$AUC_ASSET_GEN_CFC_CAPTION = civil::AUC_ASSET_GEN_CFC_CAPTION($aucSubOrderGen);
			$Group_1 = 0;
			$Group_2 = 0;
			foreach ($AUC_ASSET_GEN_CFC_CAPTION as $AA1 => $BB1) {
				/* $array_idcard = (civil::selectCfcCaption($BB1));
				$num1 = (civil::checkCfcCaption($array_idcard)); //ส่งข้อมูล13หลักของทรัพย์ไปเช็ค เพื่อนับจำนวนคนที่ติดล้ม

				//ตรวจคนที่ไม่ได้อยู่ในทรัพย์
				$Civil->PCC_CIVIL_GEN = civil::convertCaptionToPccCivil($BB1);
				$num_Person = $Civil->only_ledQuery_checkPerson($array_idcard);

				$Ar = (civil::DATA_CFC_CAPTION($BB1)); //ได้ข้อมูลสถานของ cfcCaptionGen ที่ส่งไปหาข้อมูล
				//>0 คือมีคนติดล้มละลาย ให้ไปเช็ค LOCK_CONFISCATE_FLAG ว่าflagเป็น 0 หรือ 1
				//จำนวนคนติดล้มในคดี เเละ ไม่มีคำสั่ง
				$numPerson = $num1 + $num_Person;
				civil::$IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				empty($Civil->CFC_CAPTION) ? $Civil->CFC_CAPTION = $BB1 : "";
				if ($numPerson > 0) {
					$numC = $Ar['LOCK_SELL_FLAG'] >= 1 ? "1" : $numPerson;
				} else {
					$numC = $Ar['LOCK_SELL_FLAG']; //ห้ามขาย
				} */
				//LOCK_SELL_FLAG ห้ามขาย
				$Ar = (civil::DATA_CFC_CAPTION($BB1));
				$Func = new civil();
				$Func->CFC_CAPTION = $cfcCaptionGen;
				$Func->AR_IS_OWNER_BANKRUPT = $Ar['IS_OWNER_BANKRUPT'];
				$Func->AR_IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				$Func->AR_LOCK_CONFISCATE_FLAG = $Ar['LOCK_CONFISCATE_FLAG'];
				$Func->AR_LOCK_SELL_FLAG = $Ar['LOCK_SELL_FLAG'];
				$Func->AR_LOCK_ACCOUNTING_FLAG = $Ar['LOCK_ACCOUNTING_FLAG'];
				$G1 = $Func->textAlert('LOCK_SELL_FLAG', 'num');
				if ($G1 > 0) {
					$Group_1 = $G1;
				}
			}

			//Group 2 คนในป้าย
			$plateNo = $Array_params['plateNo'];
			$webuibidDate = $Array_params['webuibidDate'];
			$centDeptGen = $Array_params['centDeptGen'];
			$idCard = (civil::get_query_plateNo($plateNo, date_AK($webuibidDate), $centDeptGen)); //ทำคิวรี่หา13หลักขอคนถือป้าย
			$Group_2 = civil::checkIdCardToBankrupt(cut_last_comma($idCard), "จำเลย"); // ("111111111111,222222222222","จำเลย") 
			$num3 = $Group_1 + $Group_2;
			unset($array_data);
			$array_data = [
				'status' => ($num3 > 0 ? "no" : "yes"),
				'ResMeasalertMessagesage' => ($num3 > 0 ? "ไม่สามารถทำรายการได้ ตรวจพบบุคคลล้มละลาย" : ""), //เเจ้งเตือน
			];
		}

		if ($action == "save") {
			//เปลี่ยน
			//Group 1 คนในคดีของทรัพย์
			$num1 = 0;
			$aucSubOrderGen = $Array_params['aucSubOrderGen'];
			$AUC_ASSET_GEN_CFC_CAPTION = civil::AUC_ASSET_GEN_CFC_CAPTION($aucSubOrderGen);
			foreach ($AUC_ASSET_GEN_CFC_CAPTION as $AA1 => $BB1) {
				//LOCK_SELL_FLAG ห้ามขาย
				$num = 0;
				$note = '';
				$Ar = (civil::DATA_CFC_CAPTION($BB1));
				$Func = new civil();
				$Func->CFC_CAPTION = $cfcCaptionGen;
				$Func->AR_IS_OWNER_BANKRUPT = $Ar['IS_OWNER_BANKRUPT'];
				$Func->AR_IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				$Func->AR_LOCK_CONFISCATE_FLAG = $Ar['LOCK_CONFISCATE_FLAG'];
				$Func->AR_LOCK_SELL_FLAG = $Ar['LOCK_SELL_FLAG'];
				$Func->AR_LOCK_ACCOUNTING_FLAG = $Ar['LOCK_ACCOUNTING_FLAG'];
				unset($array_data);
				$array_data = [
					'status' => (($Func->textAlert('LOCK_SELL_FLAG', 'num')) > 0 ? "no" : "yes"),
					'ResMeasalertMessagesage' => ($Func->textAlert('LOCK_SELL_FLAG', 'note')) //เเจ้งเตือน
				];
			}
		}
		break;
	case "AUD3I010":
		$work = 1;
		if ($action == "save") {
			$pccCaseGen = $Array_params['pccCaseGen'];
			$num = 0;
			$CfcCaption = civil::pccCaseGenConvertCfcCaption($pccCaseGen);
			foreach ($CfcCaption as $AA1 => $BB1) {
				//LOCK_ACCOUNTING_FLAG ห้ามทำบัญชี
				$num = 0;
				$note = '';
				$Ar = (civil::DATA_CFC_CAPTION($BB1));
				$Func = new civil();
				$Func->CFC_CAPTION = $cfcCaptionGen;
				$Func->AR_IS_OWNER_BANKRUPT = $Ar['IS_OWNER_BANKRUPT'];
				$Func->AR_IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				$Func->AR_LOCK_CONFISCATE_FLAG = $Ar['LOCK_CONFISCATE_FLAG'];
				$Func->AR_LOCK_SELL_FLAG = $Ar['LOCK_SELL_FLAG'];
				$Func->AR_LOCK_ACCOUNTING_FLAG = $Ar['LOCK_ACCOUNTING_FLAG'];
				unset($array_data);
				$array_data = [
					'status' => (($Func->textAlert('LOCK_ACCOUNTING_FLAG', 'num')) > 0 ? "no" : "yes"),
					'ResMeasalertMessagesage' => ($Func->textAlert('LOCK_ACCOUNTING_FLAG', 'note')) //เเจ้งเตือน
				];
			}
		}
		break;
	case "CFC3I030":
		$work = 1;
		if ($action == "save") {
			$ArrayData = [];
			$Asset = "";
			$totalAsset = 0;
			$totalBankrupt = 0;
			$totalRevive = 0;
			$Total = 0;
			$i = 0;
			//หลายทรัพย์
			foreach ($ArrayCfcCaptionGen_page2 as $AA1 => $BB1) {
				/* $array_idcard = "";
				$num = "";
				
				$array_idcard = (civil::selectCfcCaption($BB1)); //ดึงข้อมูลทรัพย์เเละ13หลักของคนในทรัพย์นั้นออกมา
				$num = (civil::checkCfcCaption($array_idcard)); //ส่งข้อมูล13หลักของทรัพย์ไปเช็ค เพื่อนับจำนวนคนที่ติดล้ม

				//ตรวจคนที่ไม่ได้อยู่ในทรัพย์
				$Civil->PCC_CIVIL_GEN = civil::convertCaptionToPccCivil($BB1);
				$num_Person = $Civil->only_ledQuery_checkPerson($array_idcard);

				$Ar = (civil::DATA_CFC_CAPTION($BB1)); //ได้ข้อมูลสถานของ cfcCaptionGen ที่ส่งไปหาข้อมูล
				//>0 คือมีคนติดล้มละลาย ให้ไปเช็ค LOCK_CONFISCATE_FLAG ว่าflagเป็น 0 หรือ 1
				//จำนวนคนติดล้มในคดี เเละ ไม่มีคำสั่ง
				$numPerson = $num + $num_Person;
				civil::$IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				empty($Civil->CFC_CAPTION) ? $Civil->CFC_CAPTION = $BB1 : "";
				if ($numPerson > 0) {
					$numC = $Ar['LOCK_SELL_FLAG'] >= 1 ? "1" : $numPerson;
				} else {
					$numC = $Ar['LOCK_SELL_FLAG']; //ห้ามขาย
				}
 */
				//LOCK_SELL_FLAG ห้ามขาย
				$i++;
				$Ar = (civil::DATA_CFC_CAPTION($BB1));
				$Func = new civil();
				$Func->CFC_CAPTION = $BB1;
				$Func->AR_IS_OWNER_BANKRUPT = $Ar['IS_OWNER_BANKRUPT'];
				$Func->AR_IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				$Func->AR_LOCK_CONFISCATE_FLAG = $Ar['LOCK_CONFISCATE_FLAG'];
				$Func->AR_LOCK_SELL_FLAG = $Ar['LOCK_SELL_FLAG'];
				$Func->AR_LOCK_ACCOUNTING_FLAG = $Ar['LOCK_ACCOUNTING_FLAG'];

				//ติดล้มมาเช็คflag
				//ติดทรัพย์ซ้ำหรือไม่
				if ($Func->AssetDouble('num') > 0) {
					$totalAsset .= $Func->AssetDouble('data');
				} else {
					if ($Ar['IS_OWNER_BANKRUPT'] == '1') {
						if ($Ar['LOCK_SELL_FLAG'] == '1') {
							$ArrayData[$BB1] = $Ar['LOCK_SELL_FLAG'] > 0 ? "1" : "0";
							$Asset .= $Ar['LOCK_SELL_FLAG'] > 0 ? $i . "," : "";
							$totalBankrupt += $Ar['LOCK_SELL_FLAG'];
						}
					} else if ($Ar['IS_OWNER_REVIVE'] == '1') {
						if ($Ar['LOCK_SELL_FLAG'] == '1') {
							$totalRevive++;
						}
					}
				}
			}
			$note = "";
			if ($totalAsset > 0) {
				$note = $totalAsset;
				$Total++;
			} else {
				if ($totalBankrupt > 0) {
					$note = "ไม่สามารถบักทึกได้ ตรวจพบบุคคลล้มละลาย ที่ทรัพย์ลำดับที่ " . cut_last_comma($Asset);
					$Total++;
				} else if ($totalRevive > 0) {
					$note = "ไม่สามารถบักทึกได้ เนื่องจากตรวจพบลูกหนี้ในระบบฟื้นฟู";
					$Total++;
				}
			}
			unset($array_data);
			$array_data = [
				'status' => ($Total > 0 ? "no" : "yes"),
				'ResMeasalertMessagesage' => ($note), //เเจ้งเตือน
				'AssetInBankrupt' => $ArrayData
			];
		}
		break;
	case "CFC9I070_2":
		$work = 1;
		if ($action == "ok") {
			$ArrayData = [];
			$Asset = "";
			$totalAsset = 0;
			$totalBankrupt = 0;
			$totalRevive = 0;
			$Total = 0;
			$i = 0;
			foreach ($ArrayCfcCaptionGen_page3 as $AA1 => $BB1) {
				$i++;
				//LOCK_ACCOUNTING_FLAG ห้ามทำบัญชี
				$i++;
				$Ar = (civil::DATA_CFC_CAPTION($BB1));
				$Func = new civil();
				$Func->CFC_CAPTION = $BB1;
				$Func->AR_IS_OWNER_BANKRUPT = $Ar['IS_OWNER_BANKRUPT'];
				$Func->AR_IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
				$Func->AR_LOCK_CONFISCATE_FLAG = $Ar['LOCK_CONFISCATE_FLAG'];
				$Func->AR_LOCK_SELL_FLAG = $Ar['LOCK_SELL_FLAG'];
				$Func->AR_LOCK_ACCOUNTING_FLAG = $Ar['LOCK_ACCOUNTING_FLAG'];

				//ติดล้มมาเช็คflag
				//ติดทรัพย์ซ้ำหรือไม่
				if ($Func->AssetDouble('num') > 0) {
					$totalAsset .= $Func->AssetDouble('data');
				} else {
					if ($Ar['IS_OWNER_BANKRUPT'] == '1') {
						if ($Ar['LOCK_SELL_FLAG'] == '1') {
							$ArrayData[$BB1] = $Ar['LOCK_ACCOUNTING_FLAG'] > 0 ? "1" : "0";
							$Asset .= $Ar['LOCK_ACCOUNTING_FLAG'] > 0 ? $i . "," : "";
							$totalBankrupt += $Ar['LOCK_ACCOUNTING_FLAG'];
						}
					} else if ($Ar['IS_OWNER_REVIVE'] == '1') {
						if ($Ar['LOCK_SELL_FLAG'] == '1') {
							$totalRevive++;
						}
					}
				}
			}
			$note = "";
			if ($totalAsset > 0) {
				$note = $totalAsset;
				$Total++;
			} else {
				if ($totalBankrupt > 0) {
					$note = "ไม่สามารถบักทึกได้ ตรวจพบบุคคลล้มละลาย ที่ทรัพย์ลำดับที่ " . cut_last_comma($Asset);
					$Total++;
				} else if ($totalRevive > 0) {
					$note = "ไม่สามารถบักทึกได้ เนื่องจากตรวจพบลูกหนี้ในระบบฟื้นฟู";
					$Total++;
				}
			}
			unset($array_data);
			$array_data = [
				'status' => ($Total > 0 ? "no" : "yes"),
				'ResMeasalertMessagesage' => ($note), //เเจ้งเตือน
				'AssetInBankrupt' => $ArrayData
			];
		}
		break;
}


$number = explode(",", "2,3,4,5,6,9,10,11,12,13,14,15,16");
foreach ($number as $AA1 => $BB1) {
	if ($page == "CFC3I020_{$BB1}") {
		$work = 1;
		if ($action == "preCaption") { //ขั้นตอนยึด
			//LOCK_CONFISCATE_FLAG ห้ามยึด
			$num = 0;
			$note = '';
			$Ar = (civil::DATA_CFC_CAPTION($cfcCaptionGen));
			$CFC3I020_Func = new civil();
			$CFC3I020_Func->CFC_CAPTION = $cfcCaptionGen;
			$CFC3I020_Func->AR_IS_OWNER_BANKRUPT = $Ar['IS_OWNER_BANKRUPT'];
			$CFC3I020_Func->AR_IS_OWNER_REVIVE = $Ar['IS_OWNER_REVIVE'];
			$CFC3I020_Func->AR_LOCK_CONFISCATE_FLAG = $Ar['LOCK_CONFISCATE_FLAG'];
			$CFC3I020_Func->AR_LOCK_SELL_FLAG = $Ar['LOCK_SELL_FLAG'];
			$CFC3I020_Func->AR_LOCK_ACCOUNTING_FLAG = $Ar['LOCK_ACCOUNTING_FLAG'];
		}
		unset($array_data);
		$array_data = [
			'status' => (($CFC3I020_Func->textAlert('LOCK_CONFISCATE_FLAG', 'num')) > 0 ? "no" : "yes"),
			'ResMeasalertMessagesage' => ($CFC3I020_Func->textAlert('LOCK_CONFISCATE_FLAG', 'note')) //เเจ้งเตือน
		];
	}
}


if ($work > 0) {
	$row['ResponseCode'] = array('ResCode' => '000', 'ResMeassage' => "SUCCESS"); //ติดต่อ api สำเร็จ
	$row['page'] = $page;
	$row['action'] = $action;
	$row['data'] = $array_data;
} else {
	$row['ResponseCode'] = array('ResCode' => '102', 'ResMeassage' => "NOT FOUND"); //ติดต่อ api ไม่สำเร็จ
	$row['data'] = null;
}


echo json_encode($row);
