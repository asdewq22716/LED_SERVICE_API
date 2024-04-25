<?php
//phpinfo();
	//include '../include/include.php';
	//include '../class_office/vendor/autoload.php';
	require('../assets/mpdf/mpdf.php');


	$rawData = file_get_contents("php://input");
    $request =  json_decode($rawData,true);
	$html = base64_decode($request['bodyHtml']);
	
	file_put_contents(__FILE__.'_log.txt',$html);
	$mpdf=new mPDF('th', 'A4-L', '0', 'THSaraban'); 
		/*$mpdf = new \Mpdf\Mpdf([
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
			]);*/
	$mpdf->WriteHTML('<div lang="th">'.$html.'</div>');

	if($request['isResponseJson']){
		ob_start();
		$mpdf->Output();
		$pdfBytes = ob_get_contents();
		ob_end_clean();
		header("Content-Type: application/json");


		$response = array();
		$response['return'] = true;
		$response['data'] = base64_encode($pdfBytes);
		echo json_encode($response);
		exit;
	}else{
		$mpdf->Output((isset($data['filename'])?$data['filename'].'pdf':'file.pdf'), 'I');
	}
	
?>