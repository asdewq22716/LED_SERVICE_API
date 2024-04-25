<?php
	include '../include/include.php';
	include '../class_office/vendor/autoload.php';
	$pdf = new \Mpdf\Mpdf([
			 'mode' => 'th',
			 'default_font' => 'thsarabun', 
			 'default_font_size' => 16,
			 'format' => [220, 110],
			 'margin_left' => 30,
			 'margin_right' => 7,
			 'margin_top' => 20,
			 'margin_bottom' => 7,
			 'margin_header' => 4,
			 'margin_footer' => 4,
			]);

		
			$pdf->AddPage();
			$pdf->Cell(0,9,"กรมบังคับคดี",0,0,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,9,"กองบังคับคดีล้มละลาย 5",0,0,'L');
			$pdf->Ln(12);
			$pdf->Cell(0,9,"เลขที่ 189/1 ถนนบางขุนนนท์",0,0,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,9,"แขวงบางขุนนนท์  5 เขตบางกอกน้อย",0,0,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,9,"กรุงเทพมหานคร 10700",0,0,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,9,"ที่ ยธ. 0507/3137",0,0,'L');
			
			
			// $pdf->Ln(21);
			$pdf->SetXY(120,32);
			$pdf->Cell(0,9,"เรียน",0,0,'L');
			$pdf->SetX(135);
			$pdf->Cell(0,9,"นายสถาปนา คงศรีสวัสดิ",0,0,'L');	
			$pdf->Ln(7);
			$pdf->SetX(135);
			$pdf->Cell(0,9,"เลขที่ 63 หมู่ 1 ถนนประชาอุทิ",0,0,'L');
			$pdf->Ln(7);
			$pdf->SetX(135);
			$pdf->Cell(0,9,"ตำบลบางมด อำเภอทุ่งครุ",0,0,'L');		
			$pdf->Ln(7);
			$pdf->SetX(135);
			$pdf->Cell(0,9,"กรุงเทพมหานคร 10700",0,0,'L');
			// $pdf->Ln(7);
			// $pdf->SetX(165);
			// $pdf->Cell(0,9,$value['addressLine2'],0,0,'L');
			$pdf->Ln(30);

			$pdf->WriteHTML('<barcode code="123132132" type="EAN128A" height="0.66" text="1" />');
			$pdf->Ln(1);
			$pdf->Cell(60,9,"123132132",0,0,'C');

		// $filepdf = 'envPostCode'.date("Ymdhis");
		$pdf->Output();
		// $filename = '../report/'.$filepdf.'.pdf';
		// $filecontents = file_get_contents($filename);

?>