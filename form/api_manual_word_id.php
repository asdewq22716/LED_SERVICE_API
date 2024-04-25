<?php

$HIDE_HEADER = "Y";
include("../include/comtop_admin.php");

if ($_GET['exit'] == 'Y') {
	exit;
}

$SERVICE_ID = conText($_GET['SERVICE_ID']);
$SETTING_ID = conText($_GET['SETTING_ID']);

// 	Setting Report
$M_FIELD_TABLE = 'M_FIELD_TABLE';
$M_CMD_SYSTEM = 'M_CMD_SYSTEM';
$M_SERVICE_MANAGE = 'M_SERVICE_MANAGE';
$M_API_SETTING = 'M_API_SETTING';
$M_API_LIST = 'M_API_LIST';


function qryResponse($SubServiceId)
{
	global $M_API_LIST;

	$sqlServiceResponse = "SELECT KEY, TYPE, LENGTH, API_DESC, CONCAT( API_TABLE_MAIN, CONCAT( '.', API_FIELD ) ) AS API_TABLE_MAIN, API_TABLE_ORIGIN, API_REF FROM $M_API_LIST WHERE API_STATUS = '1' AND API_SETTING_ID = '$SubServiceId' ORDER BY ORDER_NO,API_LIST_ID ASC ";

	$qryServiceResponse = db::query($sqlServiceResponse);
	$arrServiceResponse = array();
	while ($recServiceResponse = db::fetch_assoc($qryServiceResponse)) {
		if ($recServiceResponse['API_REF'] != '') {
			$recServiceResponse['API_TABLE_MAIN'] = '';
			$recServiceResponse['SUB'] = qryResponse($recServiceResponse['API_REF']);
		}
		$arrServiceResponse[] = $recServiceResponse;
	}

	return $arrServiceResponse;
}

function fetchSubArray($table, $arrListRes, $arrResponseShow, $num, $arrSub)
{
	$i = 1;
	foreach ($arrSub as $ServiceResponse) {
		$table->addRow(300);
		$table->addCell($arrListRes[0])->addText("$num.$i", 'rStyle1', 'pStyle');
		foreach ($ServiceResponse as $key => $field) {
			if (in_array($key, $arrResponseShow)) {
				$table->addCell($arrListRes[($key + 1)])->addText($field, 'rStyle1', 'pStyle');
			}
			if ($key == 'SUB') {
				fetchSubArray($table, $arrListRes, $arrResponseShow, "$num.$i", $field);
			}
		}
		$i++;
	}
}

require_once '../PHPWord.php';
$obPHPWord = new PHPWord();
$section = $obPHPWord->createSection(array('orientation' => 'landscape'));
$obPHPWord->addFontStyle(
	'rStyle1',
	array('name' => 'TH SarabunPSK', 'bold' => true, 'italic' => false, 'size' => 16, 'align' => 'center')
);
$obPHPWord->addFontStyle(
	'rStyle2',
	array('name' => 'TH SarabunPSK', 'bold' => true, 'italic' => false, 'size' => 14, 'align' => 'center')
);
$obPHPWord->addFontStyle(
	'rStyle3',
	array('name' => 'TH SarabunPSK', 'bold' => true, 'italic' => false, 'size' => 14, 'align' => 'center')
);
$obPHPWord->addFontStyle(
	'rStyle',
	array('name' => 'TH SarabunPSK', 'bold' => false, 'italic' => false, 'size' => 14, 'align' => 'center')
);
$obPHPWord->addParagraphStyle('pStyle', array('align' => 'center', 'spaceAfter' => 50));
$obPHPWord->addParagraphStyle('pStyle1', array('align' => 'left', 'spaceAfter' => 80));
$obPHPWord->addParagraphStyle('pStyleH', array('align' => 'center', 'spaceAfter' => 80, 'background' => '000000'));
$styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80);


$arrRequest = array(array('NO', 5), array('Field', 30), array('Data Type', 15), array('M/O', 10), array('Description', 35));
$arrResponse = array(array('NO', 5), array('Field', 20), array('Data Type', 20), array('Length', 10), array('Description', 25), array('Table บูรณาการ', 15), array('Table ต้นทาง', 15));
$arrResponseShow = array('KEY', 'TYPE', 'LENGTH', 'API_DESC', 'API_TABLE_MAIN', 'API_TABLE_ORIGIN');


$sqlSystem = "SELECT A.* FROM $M_CMD_SYSTEM A INNER JOIN $M_SERVICE_MANAGE B ON A.CMD_SYSTEM_ID = B.SYS_NAME INNER JOIN $M_API_SETTING C ON C.SERVICE_ID = B.SERVICE_MANAGE_ID WHERE C.API_SETTING_ID = '$SETTING_ID' AND B.SERVICE_MANAGE_ID = '$SERVICE_ID' ";
$qrySystem = db::query($sqlSystem);

while ($recSystem = db::fetch_assoc($qrySystem)) {
	$section->addText($recSystem['SERVICE_SYS_NAME'], 'rStyle1', 'pStyle');

	$sqlServiceMain = "SELECT * FROM $M_SERVICE_MANAGE WHERE 1 = 1 AND SERVICE_STATUS = '1'AND SYS_NAME = '{$recSystem['CMD_SYSTEM_ID']}'  AND SERVICE_MANAGE_ID = '$SERVICE_ID' ORDER BY SERVICE_CODE ASC ";
	$qryServiceMain = db::query($sqlServiceMain);
	$sysSubI = 1;

	while ($recServiceMain = db::fetch_assoc($qryServiceMain)) {

		$section->addText($sysSubI . '. ' . trim($recServiceMain['SERVICE_CODE']) . ' ' . trim($recServiceMain['SERVICE_DESC']) . ' (' . trim($recServiceMain['SERVICE_NAME']) . ')', 'rStyle1', 'pStyle1');

		// หา service exprot
		$sqlSubServiceId = "SELECT API_SETTING_ID FROM $M_API_SETTING WHERE SERVICE_ID = '{$recServiceMain['SERVICE_MANAGE_ID']}' AND EXPORT_REPORT = '1' ";
		$qrySubServiceId = db::query($sqlSubServiceId);
		$SubServiceId = db::fetch_assoc($qrySubServiceId);
		$SubServiceId = $SubServiceId['API_SETTING_ID'];



		$sqlServiceRequest = "SELECT KEY, TYPE, STATUS, API_DESC FROM $M_API_LIST WHERE API_STATUS = '0' AND API_SETTING_ID = '$SubServiceId' ORDER BY ORDER_NO,API_LIST_ID ASC ";
		$qryServiceRequest = db::query($sqlServiceRequest);
		$arrServiceRequest = array();
		while ($recServiceRequest = db::fetch_assoc($qryServiceRequest)) {
			$arrServiceRequest[] = $recServiceRequest;
		}

		$arrServiceResponse = qryResponse($SubServiceId);

		// -------------------Request-------------------------------------

		$section->addText('Data Request: ' . trim($recServiceMain['SERVICE_NAME']), 'rStyle1', 'pStyle1');

		$obPHPWord->addTableStyle('myOwnTableStyle', $styleTable);
		$table = $section->addTable('myOwnTableStyle');

		$table->addRow(300, array('tblHeader' => true));
		$arrListReq = array();
		foreach ($arrRequest as $i => $Request) {
			$table->addCell(intval($Request[1] * 150))->addText($Request[0], 'rStyle1', 'pStyle');
			$arrListReq[($i + 1)] = intval($Request[1] * 150);
		}

		$i = 1;
		foreach ($arrServiceRequest as $ServiceRequest) {
			$table->addRow(300);
			$table->addCell($arrListReq[0])->addText($i, 'rStyle1', 'pStyle');
			foreach ($ServiceRequest as $key => $field) {
				$table->addCell($arrListReq[($key + 1)])->addText($field, 'rStyle1', 'pStyle');
			}
			$i++;
		}

		$section = $obPHPWord->createSection(array('orientation' => 'landscape'));


		// -------------------Response-------------------------------------
		$section->addText('Data Response: ' . trim($recServiceMain['SERVICE_NAME']), 'rStyle1', 'pStyle1');

		$obPHPWord->addTableStyle('myOwnTableStyle', $styleTable);
		$table = $section->addTable('myOwnTableStyle');

		$table->addRow(300, array('tblHeader' => true));
		$arrListRes = array();
		foreach ($arrResponse as $Response) {
			$table->addCell(intval($Response[1] * 150))->addText($Response[0], 'rStyle1', 'pStyle');
			$arrListRes[($i + 1)] = intval($Request[1] * 150);
		}

		$i = 1;
		foreach ($arrServiceResponse as $ServiceResponse) {
			$table->addRow(300);
			$table->addCell($arrListRes[0])->addText($i, 'rStyle1', 'pStyle');
			foreach ($ServiceResponse as $key => $field) {
				if (in_array($key, $arrResponseShow)) {
					$table->addCell($arrListRes[($key + 1)])->addText($field, 'rStyle1', 'pStyle');
				}
				if ($key == 'SUB') {
					fetchSubArray($table, $arrListRes, $arrResponseShow, $i, $field);
				}
			}
			$i++;
		}


		$section = $obPHPWord->createSection(array('orientation' => 'landscape'));

		$sysSubI++;
	}
}

/*
$obPHPWord->addTableStyle('myOwnTableStyle', $styleTable);
$table = $section->addTable('myOwnTableStyle');
$table->addRow(300);
$table->addCell(1000)->addText('Module', 'rStyle1', 'pStyle');
$table->addCell(4000)->addText('Table Name', 'rStyle1', 'pStyle');
$table->addCell(4000)->addText('Table Description', 'rStyle1', 'pStyle');
*/

// Save File
$temp_file = 'DOC_DATADICTIONARY_API_SERVICE.docx';
$objWriter = PHPWord_IOFactory::createWriter($obPHPWord, 'Word2007');
$objWriter->save($temp_file);

header('Content-Description: File Transfer');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename=' . $temp_file);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($temp_file));
ob_clean();
flush();
readfile($temp_file);
unlink($temp_file); // deletes the temporary file


db::db_close();
