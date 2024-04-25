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
			 'margin_left' => 10,
			 'margin_right' => 7,
			 'margin_top' => 15,
			 'margin_bottom' => 7,
			 'margin_header' => 4,
			 'margin_footer' => 4,
			]);
			
	$redCase = $data_res['prefixRedCase'].$data_res['redCase']."/".$data_res['redYy'];
	$blackCase = $data_res['prefixBlackCase'].$data_res['blackCase']."/".$data_res['blackYy'];
	
	$form_field['prefixRedCase']   = $data_res['prefixRedCase'];
	$form_field['redCase'] 		   = $data_res['redCase'];
	$form_field['redYy'] 		   = $data_res['redYy'];
	$form_field['prefixBlackCase'] = $data_res['prefixBlackCase'];
	$form_field['blackCase'] 	   = $data_res['blackCase'];
	$form_field['blackYy'] 		   = $data_res['blackYy'];
	$form_field['registerCode']    = $data_res['registerCode'];

	$url = connect_bankrupt('ReportDeb');
	$res = curl($url,$form_field);
	if($res['statusCode'] == '200'){
		foreach($res['data']['Data'] as $k => $v){ 
			if($v['annId'] == '1'){
				$Date1 =  db2date($v['courtDate']);
				$annDate1 = db2date($v['annDate']);
				$annBookNo1 = $v['annBookNo'];
				$annLessonNo1 = $v['annLessonNo'];
				$annPageNo1 = $v['annPageNo'];
				$debDate1_1 = db2date($v['debDate1']);
				$debDate1_2 = db2date($v['debDate2']);
			}
			if($v['annId'] == '2'){
				$Date2 =  db2date($v['courtDate']);
				$annDate2 = db2date($v['annDate']);
				$annBookNo2 = $v['annBookNo'];
				$annLessonNo2 = $v['annLessonNo'];
				$annPageNo2 = $v['annPageNo'];
			}
			if($v['annId'] == '4'){
				$Date4 =  db2date($v['courtDate']);
				$annDate4 = db2date($v['annDate']);
				$annBookNo4 = $v['annBookNo'];
				$annLessonNo4 = $v['annLessonNo'];
				$annPageNo4 = $v['annPageNo'];
			}
			if($v['annId'] == '12'){
				$Date12 =  db2date($v['courtDate']);
				$annDate12 = db2date($v['annDate']);
				$annBookNo12 = $v['annBookNo'];
				$annLessonNo12 = $v['annLessonNo'];
				$annPageNo12 = $v['annPageNo'];
				$debDate12_1 = db2date($v['debDate1']);
				$debDate12_2 = db2date($v['debDate2']);
			}
			if($v['annId'] == '13'){
				$Date13 =  db2date($v['courtDate']);
				$annDate13 = db2date($v['annDate']);
				$annBookNo13 = $v['annBookNo'];
				$annLessonNo13 = $v['annLessonNo'];
				$annPageNo13 = $v['annPageNo'];
				$debDate13_1 = db2date($v['debDate1']);
				$debDate13_2 = db2date($v['debDate2']);
			}
			if($v['annId'] == '6'){
				$Date6 =  db2date($v['courtDate']);
				$annDate6 = db2date($v['annDate']);
				$annBookNo6 = $v['annBookNo'];
				$annLessonNo6 = $v['annLessonNo'];
				$annPageNo6 = $v['annPageNo'];
			}
			if($v['annId'] == '7'){
				$Date7 =  db2date($v['courtDate']);
				$annDate7 = db2date($v['annDate']);
				$annBookNo7 = $v['annBookNo'];
				$annLessonNo7 = $v['annLessonNo'];
				$annPageNo7 = $v['annPageNo'];
			}
			if($v['annId'] == '8'){
				$Date8 =  db2date($v['courtDate']);
				$annDate8 = db2date($v['annDate']);
				$annBookNo8 = $v['annBookNo'];
				$annLessonNo8 = $v['annLessonNo'];
				$annPageNo8 = $v['annPageNo'];
			}
			if($v['annId'] == '21'){
				$Date21 =  db2date($v['courtDate']);
				$annDate21 = db2date($v['annDate']);
				$annBookNo21 = $v['annBookNo'];
				$annLessonNo21 = $v['annLessonNo'];
				$annPageNo21 = $v['annPageNo'];
			}
			if($v['annId'] == '10'){
				$date10 = db2date($v['annDate']);
			}if($v['annId'] == '14'){
				$date14 = db2date($v['annDate']);
			}if($v['annId'] == '9'){
				$date9 = db2date($v['annDate']);
			}if($v['annId'] == '15'){
				$date15 = db2date($v['annDate']);
			}if($v['annId'] == '7'){
				$date7 = db2date($v['annDate']);
			}
		}
	}
	$pdf->SetDocTemplate('template/report_debtor.pdf',0);

	$pdf->AddPage();
	$pdf->SetDefaultFontSize(14);
	
	$pdf->WriteHTML($CSS.$html);	
	$pdf->SetXy(127,32);
	$pdf->Cell(20,9,db2date(date('Y-m-d')),0,0,'L'); // date
	$pdf->SetX(165);
	$pdf->Cell(38,9,date("H:i"),0,0,'L'); // time
	
	$pdf->SetXy(45,43);
	$pdf->Cell(90,9,$data_res['fullName'],0,0,'L'); // debname
	$pdf->Cell(38,9,$data_res['registerCode'],0,0,'L'); // idcard
	
	$pdf->SetXy(25,51);
	$pdf->Cell(35,9,'1',0,0,'L'); // No
	$pdf->Cell(38,9,$data_res['courtName'],0,0,'L'); // court
	
	$pdf->SetXy(40,58);
	$pdf->Cell(35,9,$blackCase,0,0,'L'); // Blackcase 
	
	$pdf->SetXy(130,60); 
	$pdf->Cell(38,9,$redCase,0,0,'L'); // Redcase
	
	$pdf->SetXy(22,66);
	$pdf->Cell(38,9,$data_res['senderName'],0,0,'L'); // By
	
	$pdf->SetXy(50,81);
	$pdf->Cell(38,9,$Date2,0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(38,9,$annDate2,0,0,'L');
	
	$pdf->SetXy(57,86);
	$pdf->Cell(15,9,$annBookNo2,0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,$annLessonNo2,0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,$annPageNo2,0,0,'L');
	
	$pdf->SetXy(50,92);
	$pdf->Cell(38,9,'',0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(38,9,'',0,0,'L');
	
	$pdf->SetXy(57,97);
	$pdf->Cell(15,9,'',0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,'',0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,'',0,0,'L');
	
	$pdf->SetXy(50,102);
	$pdf->Cell(38,9,$Date1,0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(38,9,$annDate1,0,0,'L');
	
	$pdf->SetXy(57,107);
	$pdf->Cell(15,9,$annBookNo1,0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,$annLessonNo1,0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,$annPageNo1,0,0,'L');
	
	$pdf->SetXy(65,113);
	$pdf->Cell(38,9,$debDate1_1,0,0,'L');
	$pdf->SetX(131);
	$pdf->Cell(38,9,$debDate1_2,0,0,'L');
	
	$pdf->SetXy(50,118);
	$pdf->Cell(38,9,'',0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(38,9,'',0,0,'L');
	
	$pdf->SetXy(57,123);
	$pdf->Cell(15,9,'',0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,'',0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,'',0,0,'L');
	
	$pdf->SetXy(50,129);
	$pdf->Cell(38,9,$Date4,0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(38,9,$annDate4,0,0,'L');
	
	$pdf->SetXy(57,134);
	$pdf->Cell(15,9,$annBookNo4,0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,$annLessonNo4,0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,$annPageNo4,0,0,'L');
	
	$pdf->SetXy(92,139);
	$pdf->Cell(38,9,$Date12,0,0,'L');
	$pdf->SetX(155);
	$pdf->Cell(38,9,$annDate12,0,0,'L');
	
	$pdf->SetXy(57,144);
	$pdf->Cell(15,9,$annBookNo12,0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,$annLessonNo12,0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,$annPageNo12,0,0,'L');
	
	$pdf->SetXy(65,150);
	$pdf->Cell(38,9,">>>>>".$debDate12_1,0,0,'L');
	$pdf->SetX(131);
	$pdf->Cell(38,9,$debDate12_2,0,0,'L');
	
	$pdf->SetXy(50,155);
	$pdf->Cell(38,9,$Date21,0,0,'L');
	$pdf->SetX(135);
	$pdf->Cell(38,9,$annDate21,0,0,'L');
	
	$pdf->SetXy(57,160);
	$pdf->Cell(15,9,$annBookNo21,0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,$annLessonNo21,0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,$annPageNo21,0,0,'L');
	
	$pdf->SetXy(55,166);
	$pdf->Cell(38,9,$Date6,0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(38,9,$annDate6,0,0,'L');
	
	$pdf->SetXy(57,171);
	$pdf->Cell(15,9,$annBookNo6,0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,$annLessonNo6,0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,$annPageNo6,0,0,'L');
	
	$pdf->SetXy(90,176);
	$pdf->Cell(38,9,$Date13,0,0,'L');
	$pdf->SetX(155);
	$pdf->Cell(38,9,$annDate13,0,0,'L');
	
	$pdf->SetXy(57,181);
	$pdf->Cell(15,9,$annBookNo13,0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,$annLessonNo13,0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,$annPageNo13,0,0,'L');
	
	$pdf->SetXy(65,187);
	$pdf->Cell(38,9,$debDate13_1,0,0,'L');
	$pdf->SetX(135);
	$pdf->Cell(38,9,$debDate13_2,0,0,'L');
	
	$pdf->SetXy(50,192);
	$pdf->Cell(38,9,$Date8,0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(38,9,$annDate8,0,0,'L');
	
	$pdf->SetXy(57,197);
	$pdf->Cell(15,9,$annBookNo8,0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,$annLessonNo8,0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,$annPageNo8,0,0,'L');
	
	$pdf->SetXy(50,202);
	$pdf->Cell(38,9,$Date7,0,0,'L');
	$pdf->SetX(127);
	$pdf->Cell(38,9,$annDate7,0,0,'L');
	
	$pdf->SetXy(57,207);
	$pdf->Cell(15,9,$annBookNo7,0,0,'L');
	$pdf->SetX(99);
	$pdf->Cell(38,9,$annLessonNo7,0,0,'L');
	$pdf->SetX(130);
	$pdf->Cell(38,9,$annPageNo7,0,0,'L');
	
	$pdf->SetXy(60,213.5);
	$pdf->Cell(38,9,'',0,0,'L');
	$pdf->SetX(133);
	$pdf->Cell(38,9,'',0,0,'L');
	
	$pdf->SetXy(45,219);
	$pdf->Cell(38,9,$date10,0,0,'L');
	$pdf->SetX(115);
	$pdf->Cell(38,9,$date14,0,0,'L');
	
	$pdf->SetXy(45,224);
	$pdf->Cell(38,9,$date9,0,0,'L');
	$pdf->SetX(115);
	$pdf->Cell(38,9,$date15,0,0,'L');
	
	$pdf->SetXy(45,229);
	$pdf->Cell(38,9,$date7,0,0,'L');
	$pdf->SetX(115);
	$pdf->Cell(38,9,'',0,0,'L');
	
	
	
	
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

	
	db::db_close();
?>