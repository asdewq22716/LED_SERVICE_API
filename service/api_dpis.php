<?php
	include '../include/include.php';
	include '../class_office/vendor/autoload.php';
	
	$str_json = file_get_contents("php://input");
	$res = json_decode($str_json, true);
	
	$url = connect_api_backoffice('api_dpis.php');
	$data = curl($url,$res);
	
	if(isset($data)){
		$pdf = new \Mpdf\Mpdf([
				 'mode' => 'th',
				 'default_font' => 'thsarabun', 
				 'default_font_size' => 16,
				 'format' => 'A4-L'
				]);
    
			$pdf->AddPage();
			$pdf->SetFont('thsarabun','B',18);
			$pdf->Cell(0,0,'รายงานตรวจข้อมูลพนักงาน Dpis',0,0,'C');
			
			$pdf->SetFont('thsarabun','L',16);
			$pdf->Ln(10);
			$pdf->Cell(0,0,'ตั้งแต่วันที่่ '.db2date($res['S_RETIRE_DATE']).'  ถึงวีนที่  '.db2date($res['E_RETIRE_DATE']),0,0,'C');
			$pdf->Ln(20);
			$html = '<table border="1" style=" border-collapse: collapse;">
					  <tr>
						<th style="width:">ลำดับ</th>
						<th style="width:200;">ชื่อ-สกุล</th>
						<th style="width:100px;">ตำแหน่ง</th>
						<th style="width:200px;">สังกัด</th>
						<th style="width:200px;">หน่วยงาน</th>
						<th style="width:100px;">สถานะ</th>
						<th style="width:100px;">วันที่บรรจุ</th>
						<th style="width:100pxpx;">วันที่เกษียณ</th>
					  </tr>';
			$i = 1;
			foreach($data as $k => $v){
				$html .= '<tr>
							<td align="center">'.$i.'</td>
							<td align="left">'.$v["PER_NAME"].'</td>
							<td align="center">'.$v["LINE_NAME_TH"].'</td>
							<td align="left">'.$v["Org3NameTh"].'</td>
							<td align="left">'.$v["Org4NameTh"].'</td>
							<td align="center">'.$v["PER_STATUS"].'</td>
							<td align="center">'.db2date($v["PER_DATE_RESIGN"]).'</td>
							<td align="center">'.db2date($v["PER_DATE_ENTRANCE"]).'</td>
						  </tr>';
				$i++;
			}
						  
			$html .='</table>';

			$pdf->WriteHTML($html);
			
		$filepdf = 'dpis'.date("Ymdhis");
		$pdf->Output($filepdf.".pdf","I");
		$filename = '../service/'.$filepdf.'.pdf';
		$filecontents = file_get_contents($filename);
	}
	
	
	$num = count($data);
	
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