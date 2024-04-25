<?php
$str_json = file_get_contents("php://input");
$data_res = json_decode($str_json, true);
include '../include/include.php';
// include '../class_office/vendor/autoload.php'; 
$pdf = new \Mpdf\Mpdf([
'mode' => 'th',
'default_font' => 'thsarabun', 
'format' => 'A4',
'orientation' => '',
'margin_left' => 7,
'margin_right' => 7,
'margin_top' => 15,
'margin_bottom' => 7,
'margin_header' => 4,
'margin_footer' => 4,
]);

$sql_cmd = db::query("SELECT
						*
					FROM
						(
							SELECT
								A .*, (
									SELECT
										CMD_NOTE
									FROM
										M_CMD_DETAILS B
									WHERE
										B.CMD_ID = A . ID
									AND B.CMD_DETAIL_ID = (
										SELECT
											MAX (C.CMD_DETAIL_ID) AS aa
										FROM
											M_CMD_DETAILS C
										WHERE
											C.CMD_ID = A . ID
										AND C.REF_DETAIL_ID IS NULL
									)
									AND ROWNUM = 1
								) AS CMD_DETAILS
							FROM
								M_DOC_CMD A
							WHERE
								1 = 1
							AND A . ID = '".$_GET['ID']."'
						) CMD");
$rec_cmd = db::fetch_array($sql_cmd);

$pdf->AddPage();
$pdf->SetDefaultFontSize(16);

$pdf->Cell(195,9,'กรมบังคับคดี กระทรวงยุติธรรม',0,0,'C');
$pdf->Ln();
$pdf->Cell(195,9,'คำสั่งเจ้าพนักงาน',0,0,'C');
$pdf->Ln(15);
$pdf->Cell(25,9,'หมายเลขคดีดำ',0,0,'L');
$pdf->Cell(40,9,$rec_cmd['T_BLACK_CASE'].$rec_cmd['BLACK_CASE']."/".$rec_cmd['BLACK_YY'],0,0,'L');
$pdf->Cell(25,9,'หมายเลขคดีแดง',0,0,'L');
$pdf->Cell(40,9,$rec_cmd['T_RED_CASE'].$rec_cmd['RED_CASE']."/".$rec_cmd['RED_YY'],0,0,'L');
$pdf->Ln();
$pdf->Cell(25,9,'ศาล',0,0,'L');
$pdf->Cell(155,9,$rec_cmd['COURT_NAME'],0,0,'L');
$pdf->Ln();
$pdf->Cell(25,9,'โจทก์',0,0,'L');
$pdf->Cell(155,9,$rec_cmd['PLAINTIFF'],0,0,'L');
$pdf->Ln();
$pdf->Cell(25,9,'จำเลย',0,0,'L');
$pdf->Cell(155,9,$rec_cmd['DEFENDANT'],0,0,'L');
$pdf->Ln(16);
$pdf->Cell(25,9,'บุคคลที่เกี่ยวข้องตามคำสั่ง',0,0,'L');
$pdf->Ln();
$htmlPerson = '<table width="100%" cellspacing="0" cellpadding="3" border="1">
					<thead class="bg-primary">
						<tr class="bg-primary">
						<th style="width:5%;" class="text-center">ลำดับ</th>
						<th style="width:35%;" class="text-center">ชื่อ</th>
						<th style="width:30%;" class="text-center">ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
						<th style="width:30%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
					</tr>
					</thead>
					<tbody id="wfs_show_person">';
$sqlSelectCmdPerson = "SELECT FULL_NAME,PERSON_CMD_TYPE,PERSON_CASE_TYPE FROM M_CMD_PERSON WHERE CMD_ID = '".$_GET['ID']."' ";
$querySelectCmdPerson = db::query($sqlSelectCmdPerson);
$i=1;
while($recSelectCmdPerson = db::fetch_array($querySelectCmdPerson)){
	$htmlPerson .= '<tr>
						<td align="center">'.$i.'</td>
						<td>'.$recSelectCmdPerson["FULL_NAME"].'</td>
						<td>'.getCmdName($recSelectCmdPerson["PERSON_CMD_TYPE"]).'</td>
						<td>'.getCaseName($recSelectCmdPerson["PERSON_CASE_TYPE"]).'</td>
					</tr>';
	$i++;
}
					
$htmlPerson .= '</tbody></table>';
$pdf->WriteHTML($htmlPerson);
$pdf->Ln();
$pdf->Cell(25,9,'รายการทรัพย์',0,0,'L');
$pdf->Ln();
$htmlAsset = '<table width="100%" cellspacing="0" cellpadding="3" border="1">
				<thead class="bg-primary">
					<tr class="bg-primary">
					<th style="width:5%;" class="text-center">ลำดับ</th>
					<th style="width:35%;" class="text-center">รายการทรัพย์</th>
					<th style="width:25%;" class="text-center">ประเภทกลุ่มคำสั่งเจ้าพนักงาน</th>
					<th style="width:25%;" class="text-center">คำสั่งเจ้าพนักงาน</th>
					<th style="width:10%;" class="text-center">สถานะ</th>
				</tr>
				</thead>
				<tbody id="wfs_show_asset">';
$i=1;
$sqlSelectCmdAsset 		= "select PROP_DET,PROP_STATUS_NAME,ASSET_ID,ASSET_CMD_TYPE,ASSET_CASE_TYPE from M_CMD_ASSET where CMD_ID = ".$_GET['ID']."";
$querySelectCmdAsset 	= db::query($sqlSelectCmdAsset);
while($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)){
	$htmlAsset .= '	<tr>
						<td align="center">'.$i.'</td>
						<td>'.$recSelectCmdAsset["PROP_DET"].'</td>
						<td>'.getCmdName($recSelectCmdAsset["ASSET_CMD_TYPE"]).'</td>
						<td>'.getCaseName($recSelectCmdAsset["ASSET_CASE_TYPE"]).'</td>
						<td>'.$recSelectCmdAsset["PROP_STATUS_NAME"].'</td>
					</tr>';
	$i++;
}

$htmlAsset .= "</tbody></table>";

$pdf->WriteHTML($htmlAsset);

$filepdf = 'report_deptor'.date("Ymdhis");
$pdf->Output($filepdf.".pdf","I");

db::db_close();
?>