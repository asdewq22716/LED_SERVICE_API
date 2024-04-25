<?php
	include '../include/include.php';
	// include '../class_office/vendor/autoload.php';
	// ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

	$str_json = file_get_contents("php://input");
	$res = json_decode($str_json, true);

    if($res['userName'] == 'BankruptDt' && $res['passWord'] == 'Debtor4321'){

       
        $obj['prefixBlackCase'] = $res['prefixBlackCase'];
        $obj['blackCase']       = $res['blackCase'];
        $obj['blackYY']         = $res['blackYY'];
        $obj['prefixRedCase']   = $res['prefixRedCase'];
        $obj['redCase']         = $res['redCase'];
        $obj['redYY']           = $res['redYY'];

        $data_string = json_encode($obj);
       
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://103.208.27.224/led_revive/form/report_balancedata.php',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$data_string,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        )
      );
        $response = curl_exec($curl);
        $arr_data =  json_decode($response, true);
        curl_close($curl);
       
}

    $pdf = new \Mpdf\Mpdf([
        'mode' => 'th',
        'default_font' => 'thsarabun', 
        'default_font_size' => 15,
        'format' => 'A4-L',
        'orientation' => '',
        'margin_left' => 8,
        'margin_right' => 8,
        'margin_top' => 25,
        'margin_bottom' => 10,
        'margin_header' => 4,
        'margin_footer' => 4,
    ]);

    $a = $arr_data['Data'];


    $pdf->AddPage();
    $pdf->Cell(0,0,"ภาระหนี้คงเหลือ",0,0,'C');
    $pdf->Ln(8);
    $pdf->Cell(0,9,"คดีหมายเลขดำที่"."  ". $a['rehabType']. $a['blackCase']."/". $a['blackYy'] ,0,0,'L');
    $pdf->Ln(7);
    $pdf->Cell(0,9,"คดีหมายเลขแดงที่"."  ". $a['rehabType']. $a['redCase']."/". $a['redYy'],0,0,'L');
    $pdf->Ln(7);
    $pdf->Cell(0,9,"ชื่อลูกหนี้"."  ". $a['titleDebName']."  ". $a['debNameth'],0,0,'L');
    $pdf->Ln(7);

          // $pdf->Ln(8);

          $pdf->SetFont('thsarabun', '', 12);
          $pdf->Ln(8);
          
          $pdf->Cell(7, 12, ('กลุ่ม'), 1, "C");
          $pdf->Cell(7, 12, ('รายที่'), 1, 0, "C");
          $pdf->Cell(38, 12, ('ชื่อเจ้าหนี้'), 1, 0, "C");
          $pdf->Cell(71, 6, ('จำนวนหนี้ตามคำสั่ง/คำขอ'), 1, 0, "C");
          $pdf->Cell(71, 6, ('ยอดที่จ่ายแล้ว'), 1, 0, "C");
          $pdf->Cell(71, 6, ('ยอดคงเหลือ'), 1, 0, "C");
          $pdf->Cell(15, 12, ('หมายเหตุ'), 1, 0, "C");


          $pdf->Cell(0, 6, '', 0, 1);

          $pdf->Cell(52, 6, '', 0,0, "C");
          $pdf->Cell(27, 6, ('เงินต้น'), 1, 0, "C");
          $pdf->Cell(17, 6, ('ดอกเบี้ย'), 1, 0, "C");
          $pdf->Cell(27, 6, ('รวม'), 1, 0, "C");
          $pdf->Cell(27, 6, ('เงินต้น'), 1, 0, "C");
          $pdf->Cell(17, 6, ('ดอกเบี้ย'), 1, 0, "C");
          $pdf->Cell(27, 6, ('รวม'), 1, 0, "C");
          $pdf->Cell(27, 6, ('เงินต้น'), 1, 0, "C");
          $pdf->Cell(17, 6, ('ดอกเบี้ย'), 1, 0, "C");
          $pdf->Cell(27, 6, ('รวม'), 1, 1, "C");
       
          // $pdf->Cell(35, 10, ('ชื่อเจ้าหนี้'), 1, 0, "C");
          // $pdf->Cell(27, 10, ('เงินต้น'), 1, 0, "C");
          // $pdf->Cell(17, 10, ('ดอกเบี้ย'), 1, 0, "C");
         
          
      
          $arr_type = array("0" => 'ถอนคำขอ' , "1" => 'ยกคำขอ');
    foreach($a['datamain'] as $k => $value){
      
                $pdf->SetFont('thsarabun', '', 12);
                $k++;
              
                
                $row_min_height = 10 ;
                $c_1_width = 7;
                $c_2_width = 7;
                $c_3_width = 38;
                $c_4_width = 27;
                $c_5_width = 17;
                $c_6_width = 27;
                $c_7_width = 27;
                $c_8_width = 17;
                $c_9_width = 27;
                $c_10_width = 27;
                $c_11_width = 17;
                $c_12_width = 27;
                $c_13_width = 15;

                $cell_width_array = array($c_1_width, $c_2_width, $c_3_width, $c_4_width, $c_5_width, $c_6_width, $c_7_width, $c_8_width,$c_9_width, $c_10_width, $c_11_width, $c_12_width, $c_13_width);
  
   
          //  $pdf->Cell($c_1_width, $row_min_height, ($x), 1, 0, "C");
          //   $pdf->Cell($c_1_width, $row_min_height, ($y), 1, 0, "C");
            $sy = $pdf->y;
            $pdf->SetXY(22,$sy);
            // $pdf->Cell($c_2_width, $row_min_height, ($value['CRE20_NO']), 1, 0, "C");
            $pdf->MultiCell($c_3_width, $row_min_height, $value['CRE20_NAME1_FULL'], 1,  "T");
            $x = $pdf->x;
            $ey = $pdf->y; 
            $y = $ey -$sy;
            $pdf->SetXY(8,$sy);
          
            $pdf->Cell($c_1_width, $y, ($value['GROUP_ID']), 1, 0, "C");
            $pdf->Cell($c_2_width,$y, ($value['CRE20_NO']), 1, 0, "C");
            
            $pdf->SetXY(60,$sy);
            // $pdf->Cell($c_4_width, $y , $x.','.$y, 1, 0, "L");
            $pdf->Cell($c_4_width, $y, (number_format($value['PRINCIPAL'],2)), 1, 0, "R");
            $pdf->Cell($c_5_width, $y, (number_format($value['INTEREST'],2)), 1, 0, "R");
            $pdf->Cell($c_6_width, $y, (number_format($value['PRINCIPAL'] + $value['INTEREST'],2)), 1, 0, "R");
            $pdf->Cell($c_7_width, $y, (number_format($value['SUM_MONEY'],2)), 1, 0, "R");
            $pdf->Cell($c_8_width, $y, (number_format($value['INTEREST_PAID'],2)), 1, 0, "R");
            $pdf->Cell($c_9_width, $y, (number_format($value['SUM_MONEY'] + $value['INTEREST_PAID'],2) ), 1, 0, "R");
            $pdf->Cell($c_10_width, $y, (number_format($PS_TOTAL = $value['PRINCIPAL'] - $value['SUM_MONEY'],2)), 1, 0, "R");
            $pdf->Cell($c_11_width, $y, ( number_format($II_TOTAL = $value['INTEREST'] - $value['INTEREST_PAID'],2) ), 1, 0, "R");
            $TOTAL_BALANCE_FI = $PS_TOTAL + $II_TOTAL;
            $pdf->Cell($c_12_width, $y, ($TOTAL_BALANCE_FI > 0 ? number_format($TOTAL_BALANCE_FI,2) : number_format(0,2)), 1, 0, "R");
            $pdf->Cell($c_13_width, $y, ($arr_type[$value['CRE20_RADIO']]), 1, 0, "R");
           
        
            $TOTAL_PRINCIPAL += $value['PRINCIPAL'];
            $TOTAL_INTEREST += $value['INTEREST'];
            $TOTAL_SUM_TO += $value['PRINCIPAL'] + $value['INTEREST'];
            $TOTAL_SUM_MONEY += $value['SUM_MONEY'];
            $TOTAL_INTEREST_PAID += $value['INTEREST_PAID'];
            $TOTAL_BALANCE_MON += $value['SUM_MONEY'] + $value['INTEREST_PAID'];
            $TOTAL_BALANCE_INTER += $PS_TOTAL;
            $TOTAL_NEW_CHK_TOTAL += $II_TOTAL;
            $TOTAL_TOTAL_BAL_SUM += $PS_TOTAL + $II_TOTAL;
        
            $pdf->Ln();

            if ($ey >= 182) {
              $pdf->SetFont('thsarabun', '', 14);
          $pdf->Ln(8);
          
          $pdf->Cell(7, 12, ('กลุ่ม'), 1, "C");
          $pdf->Cell(7, 12, ('รายที่'), 1, 0, "C");
          $pdf->Cell(38, 12, ('ชื่อเจ้าหนี้'), 1, 0, "C");
          $pdf->Cell(71, 6, ('จำนวนหนี้ตามคำสั่ง/คำขอ'), 1, 0, "C");
          $pdf->Cell(71, 6, ('ยอดที่จ่ายแล้ว'), 1, 0, "C");
          $pdf->Cell(71, 6, ('ยอดคงเหลือ'), 1, 0, "C");
          $pdf->Cell(15, 12, ('หมายเหตุ'), 1, 0, "C");


          $pdf->Cell(0, 6, '', 0, 1);

          $pdf->Cell(52, 6, '', 0,0, "C");
          $pdf->Cell(27, 6, ('เงินต้น'), 1, 0, "C");
          $pdf->Cell(17, 6, ('ดอกเบี้ย'), 1, 0, "C");
          $pdf->Cell(27, 6, ('รวม'), 1, 0, "C");
          $pdf->Cell(27, 6, ('เงินต้น'), 1, 0, "C");
          $pdf->Cell(17, 6, ('ดอกเบี้ย'), 1, 0, "C");
          $pdf->Cell(27, 6, ('รวม'), 1, 0, "C");
          $pdf->Cell(27, 6, ('เงินต้น'), 1, 0, "C");
          $pdf->Cell(17, 6, ('ดอกเบี้ย'), 1, 0, "C");
          $pdf->Cell(27, 6, ('รวม'), 1, 1, "C");
              $pdf->SetFont('THSarabun', '', 14);
          }
       
         
         
			
	}

    if($value != ''){
            

      $pdf->Cell(52, $row_min_height, ('รวม'), 1, 0, "L");
      $pdf->Cell($c_4_width, $row_min_height, (number_format($TOTAL_PRINCIPAL,2)), 1, 0, "R");
      $pdf->Cell($c_5_width, $row_min_height, (number_format($TOTAL_INTEREST,2)), 1, 0, "R");
      $pdf->Cell($c_6_width, $row_min_height, (number_format($TOTAL_SUM_TO,2) ), 1, 0, "R");
      $pdf->Cell($c_7_width, $row_min_height, (number_format($TOTAL_SUM_MONEY,2) ), 1, 0, "R");
      $pdf->Cell($c_8_width, $row_min_height, (number_format($TOTAL_INTEREST_PAID,2)), 1, 0, "R");
      $pdf->Cell($c_9_width, $row_min_height, (number_format($TOTAL_BALANCE_MON,2) ), 1, 0, "R");
      $pdf->Cell($c_10_width, $row_min_height, (number_format($TOTAL_BALANCE_INTER,2)), 1, 0, "R");
      $pdf->Cell($c_11_width, $row_min_height, (number_format($TOTAL_NEW_CHK_TOTAL,2)), 1, 0, "R");
      $pdf->Cell($c_12_width, $row_min_height, ($TOTAL_TOTAL_BAL_SUM > 0 ? number_format($TOTAL_TOTAL_BAL_SUM,2) : number_format(0,2)), 1, 0, "L");
      $pdf->Cell($c_13_width, $row_min_height, (''), 1, 0, "L");



    } else {
      $pdf->Ln(0);
      $pdf->Cell(280, 8, ('ไม่พบข้อมูล'), 1, 0, "C");

    }

        

		$filepdf = 'report_revive'.date("Ymdhis");
		$pdf->Output($filepdf.".pdf","F");
		$filename = '../service/'.$filepdf.'.pdf';
		$filecontents = file_get_contents($filename);



        $num = count($arr_data);
	
        if($num > 0){
    
            $row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
            $row['Data'] = chunk_split(base64_encode($filecontents));
                
        }else{
                
            $row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");
    
        }
        unlink($filename);
        echo json_encode($row); 
        


?>