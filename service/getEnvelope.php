<?php

	// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

	include '../include/include.php';
	//include '../class_office/vendor/autoload.php';
	
	
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	
	$str_json = file_get_contents("php://input");
	$res = json_decode($str_json, true);
	
	if($res['envType'] =='1'){
		$pdf = new \Mpdf\Mpdf([
				 'mode' => 'th',
				 'default_font' => 'thsarabun', 
				 'default_font_size' => 16,
				 'format' => 'A4-L',
				 'orientation' => '',
				 'margin_left' => 30,
				 'margin_right' => 7,
				 'margin_top' => 40,
				 'margin_bottom' => 7,
				 'margin_header' => 4,
				 'margin_footer' => 4,
				]);
	}else if($res['envType'] =='2'){
		$pdf = new \Mpdf\Mpdf([
			 'mode' => 'th',
			 'default_font' => 'thsarabun', 
			 'default_font_size' => 16,
			 'format' => [220, 110],
			 'margin_left' => 15,
			 'margin_right' => 7,
			 'margin_top' => 10,
			 'margin_bottom' => 7,
			 'margin_header' => 4,
			 'margin_footer' => 4,
			]);
	}
    
	if(count($res['data']) > 0 && $res['envType'] =='1'){
		foreach($res['data'] as $key => $value){
		
			$pdf->AddPage();
			// $pdf->SetXY(25,43);
			$pdf->Cell(0,9,$value['depName'],0,0,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,9,$value['divisionName'],0,0,'L');
			$pdf->Ln(12);
			$pdf->Cell(0,9,$value['depAddress1'],0,0,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,9,$value['depAddress2'],0,0,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,9,$value['envNo'],0,0,'L');
			
			
			$pdf->Ln(21);
			$pdf->SetX(150);
			$pdf->Cell(0,9,"เรียน",0,0,'L');
			$pdf->SetX(165);
			$pdf->Cell(0,9,$value['fullName'],0,0,'L');	
			$pdf->Ln(7);
			$pdf->SetX(165);
			$pdf->Cell(0,9,$value['toAddress1'],0,0,'L');
			$pdf->Ln(7);
			$pdf->SetX(165);
			$pdf->Cell(0,9,$value['toAddress2'],0,0,'L');
			$pdf->Ln(62);

			$pdf->WriteHTML('<barcode code="'.$value['trackingCode'].'" type="EAN128A" height="0.66" text="1" />');
			$pdf->Ln(1);
			$pdf->Cell(80,9,$value['trackingCode'],0,0,'C');
			
		}
		$filepdf = 'envPostCode'.date("Ymdhis");
		$pdf->Output($filepdf.".pdf","F");
		$filename = '../service/'.$filepdf.'.pdf';
		$filecontents = file_get_contents($filename);
	}else if(count($res['data']) > 0 && $res['envType'] =='2'){
		foreach($res['data'] as $key => $value){
		
			$pdf->AddPage();
			$pdf->Cell(0,9,$value['depName'],0,0,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,9,$value['divisionName'],0,0,'L');
			$pdf->Ln(12);
			$pdf->Cell(0,9,$value['depAddress1'],0,0,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,9,$value['depAddress2'],0,0,'L');
			$pdf->Ln(7);
			$pdf->Cell(0,9,$value['envNo'],0,0,'L');
			
			
			// $pdf->Ln(21);
			$pdf->SetXY(115,40);
			$pdf->Cell(0,9,"เรียน",0,0,'L');
			$pdf->SetX(125);
			$pdf->Cell(0,9,$value['fullName'],0,0,'L');	
			$pdf->Ln(7);
			$pdf->SetX(125);
			$pdf->Cell(0,9,$value['toAddress1'],0,0,'L');
			$pdf->Ln(7);
			$pdf->SetX(125);
			$pdf->Cell(0,9,$value['toAddress2'],0,0,'L');		
			$pdf->Ln(7);
			// $pdf->SetX(135);
			// $pdf->Cell(0,9,"กรุงเทพมหานคร 10700",0,0,'L');
			$pdf->Ln(20);

			$pdf->WriteHTML('<barcode code="'.$value['trackingCode'].'" type="EAN128A" height="0.66" text="1" />');
			$pdf->Ln(1);
			$pdf->Cell(76,9,$value['trackingCode'],0,0,'C');
			
		}
		$filepdf = 'envPostCode'.date("Ymdhis");
		$pdf->Output($filepdf.".pdf","F");
		$filename = '../service/'.$filepdf.'.pdf';
		$filecontents = file_get_contents($filename);
	}
	
	
	$num = count($res['data']);
	
	if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
		$row['Data'] = chunk_split(base64_encode($filecontents));
			
	}else{
			
		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

	}
	unlink($filename);
	echo json_encode($row); 
	
	// db::db_close();
?>