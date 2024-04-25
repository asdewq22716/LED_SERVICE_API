<?php
// echo phpinfo();
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	// $path = "../";
	include '../include/include.php';
	include '../class_office/vendor/autoload.php';
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
	
	$pdf->SetDocTemplate('template/report_revice.pdf',0);
	$pdf->AddPage();
	
	
	$pdf->WriteHTML($CSS.$html);	
	$pdf->SetXY(25,43);
	$pdf->Cell(0,9,"ลูกหนี้",0,0,'L');
	
	$pdf->SetXY(42,53);
	$pdf->Cell(0,9,"ลูกหนี้(ภาษาอังกฤษ)",0,0,'L');
	
	$pdf->SetXY(25,63);
	$pdf->Cell(0,9,"ศาล",0,0,'L');
	$pdf->SetX(105);
	$pdf->Cell(0,9,"หมายเลขดํา",0,0,'L');
	$pdf->SetX(160);
	$pdf->Cell(0,9,"หมายเลขแดง",0,0,'L');
	
	$pdf->SetXY(32,70);
	$pdf->Cell(0,9,"โดยผู้ร้องขอ",0,0,'L');
	
	$pdf->SetXY(32,85);
	$pdf->Cell(0,9,"วันที่ยื่นคําร้อง",0,0,'L');
	$pdf->SetX(120);
	$pdf->Cell(0,9,"วันที่ถอนคำร้อง",0,0,'L');
	
	$pdf->SetXY(32,95);
	$pdf->Cell(0,9,"วันที่ยกคําร้อง",0,0,'L');
	$pdf->SetX(120);
	$pdf->Cell(0,9,"วันที่จำหน่ายคดี",0,0,'L');
	
	$pdf->SetXY(47,110);
	$pdf->Cell(0,9,"วันที่ศาลมีคําสังรับคําร้อง",0,0,'L');
	
	$pdf->SetXY(47,120);
	$pdf->Cell(0,9,"วันที่ศาลสั่งฟื้นฟูกิจการ",0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(0,9,"วันประกาศราชกิจจาฯ",0,0,'L');
	
	$pdf->SetXY(47,130);
	$pdf->Cell(0,9,"วันที่ตั้งผู้บริหารชัวคราว",0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(0,9,"วันที่ตั้งผู้ทําแผน",0,0,'L');
	
	$pdf->SetXY(47,140);
	$pdf->Cell(0,9,"ผู้ทําแผน (ชื่อผู้ทําแผน)",0,0,'L');
	
	$pdf->SetXY(47,150);
	$pdf->Cell(0,9,"วันที่ศาลเห็นชอบด้วยแผน",0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(0,9,"วันประกาศราชกิจจาฯ",0,0,'L');
	
	$pdf->SetXY(47,160);
	$pdf->Cell(0,9,"วันที่ตั้งผู้บริหารแผน",0,0,'L');
	
	$pdf->SetXY(47,177);
	$pdf->Cell(0,9,"วันที่ยกเลิกคําสั่งฟื้นฟูกิจการ",0,0,'L');
	
	$pdf->SetXY(47,187);
	$pdf->Cell(0,9,"วันที่ยกเลิกการฟื้นฟูกิจการ",0,0,'L');
	
	$pdf->SetXY(47,197);
	$pdf->Cell(0,9,"เหตุที่ยกเลิกคําสังฟื้นฟูกิจการ",0,0,'L');
	
	$pdf->SetXY(47,207);
	$pdf->Cell(0,9,"เหตุที่ยกเลิกการฟื้นฟูกิจการ",0,0,'L');
	
	$filepdf = 'report_deptor'.date("Ymdhis");
	$pdf->Output($filepdf.".pdf","F");
	$filename = '../report/'.$filepdf.'.pdf';
	$filecontents = file_get_contents($filename);
	
	  if($filecontents){

			$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
			$row['Data'] = chunk_split(base64_encode($filecontents));

		}else{

			$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

		}
	unlink($filename);
	echo json_encode($row);