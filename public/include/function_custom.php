<?php
function connect_led_api($path){ // แพ่ง

	$url = 'http://103.208.27.224:81/led_service_api/service/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url.$path;
	return $final_url;

}

function connect_api_bankrupt($path){ //ล้มละลาย

	$url = 'http://vpn.bizpotential.com:9090/save/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url.$path;
	return $final_url;

}

function connect_api_mediate($path){ //ไกล่เกลี่ย

	$url = 'http://103.208.27.224/ega_led_mediate/service/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url.$path;
	return $final_url;

}

function connect_api_revive($path){ // ฟื้นฟู

	$url = 'http://103.208.27.224/led_revive/service/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url.$path;
	return $final_url;

}
function connect_api_civil($path){ // แพ่ง

	$url = 'http://103.40.146.73/ledservicelaw.php/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url.$path;
	return $final_url;

}

function connect_api_backoffice($path){ //ไกล่เกลี่ย

	$url = 'http://203.150.224.249/LED_FINANCE/LED_PER/api/'; /// แก้ไขตรงนี้ กรณี  path เปลี่ยน

	$final_url = $url.$path;
	return $final_url;

}


function getSystem($sysCode){

	$sql = "SELECT * FROM M_SYSTEM WHERE SYSTEM_ID = '".$sysCode."'";
	$qry = db::query($sql);
	$rec = db::fetch_array($qry);

	return $rec['SYS_NAME'];
}
function api_request($url, $token, $content = null){

    $headers = [
        'Authorization: Token '. $token,
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($content) );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec( $ch );
    curl_close($ch);

    return json_decode($result, true);
}
function curl($url, $request){

 $data_string = json_encode($request);

	 $curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
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
	curl_close($curl);

	return json_decode($response, true);
}
function startPaging($num_rows_data,$wf_limit,$wf_page){
	global $wf_link,$_GET;
	$html = "";
	if($num_rows_data > 0){
		$html .= '<div class="form-group">';
			$html .= '<div class="col-md-1 offset-md-11">';
				$html .= '<select name="WF_PER_PAGE" id="WF_PER_PAGE" class="form-control select2" onchange="change_page(this.value);">';
						$per_page_array = "20,50,100,200";
						$per_page_ex = explode(',', $per_page_array);

						foreach($per_page_ex as $_val){
							$selected = "";
							if($_GET["wf_limit"]==trim($_val) || $_GET["wf_limit"]=="all"){
								$selected = "selected";
							}
							$html .= '<option value="'.trim($_val).'" '.$selected.' >'.trim($_val).'</option>';
						}
					//$html .= '<option value="all"  '.$selected.' >ทั้งหมด</option>';
				$html .= '</select>';
			$html .= '</div>';
		$html .= '</div>';
	}
	return $html;
}

 function endPaging($num_rows_data,$wf_limit,$wf_page){
   //global $wf_limit, $wf_page, $wf_link, $WF_SPLIT_PAGE, $_GET;
   global $wf_link,$WF_SPLIT_PAGE,$_GET;

	 $html = "";
   /* if($wf_limit=='all'){
    $wf_limit = $num_rows_data;
   } */
   $wf_page_all = floor($num_rows_data/$wf_limit);
   if(($num_rows_data%$wf_limit) > 0){
    $wf_page_all++;
   }
   $html .= $WF_SPLIT_PAGE[0].' หน้าที่ '.$wf_page.' '.$WF_SPLIT_PAGE[1].' จากทั้งหมด '.$wf_page_all.' '. $WF_SPLIT_PAGE[2].' '. $WF_SPLIT_PAGE[3].' จำนวนข้อมูล '.$num_rows_data.' '.$WF_SPLIT_PAGE[4].' รายการ';
   // $html .= '<div aria-label="page list small" class="text-right">';
	 $html .= '<style>
							 .page-item.active .page-link {
							    background-color: #A8164E;
							    border-color: #A8164E;
								}
								.page-link{
									color: black;
								}
						 </style>';
   $html .= '<ul class="pagination pagination-sm float-right">';
   if($wf_page > 1){

    $link = $wf_link;

    $html .= '<li class="page-item">';
    $html .= '<a class="page-link waves-effect" href="'.$link.'&wf_page=1" aria-label="First">';
    $html .= '<span aria-hidden="true"><i class="fas fa-backward"></i></span>';
    $html .= '<span class="sr-only">First</span>';
    $html .= '</a>';
    $html .= '</li>';
    $html .= '<li class="page-item">';
    $html .= '<a class="page-link waves-effect" href="'.$link.'&wf_page='.($wf_page-1).'" aria-label="Previous">';
    $html .= '<span aria-hidden="true"><i class="fas fa-step-backward"></i></span>';
    $html .= '<span class="sr-only">Previous</span>';
    $html .= '</a>';
    $html .= '</li>';

   }
   $c_start = $wf_page-5;
   if($c_start < 1){ $c_start = '1'; }
   $c_end = $wf_page+5;
   if($c_end > $wf_page_all){ $c_end = $wf_page_all; }
   for($p=$c_start;$p<=$c_end;$p++){
    if($wf_page == $p){
     $act = ' active';
     $link = '#!';
    }else{
     $act = '';
     $link = $wf_link.'&wf_page='.($p);
    }
     $html .= '<li class="page-item'.$act.'"><a class="page-link waves-effect" href="'.$link.'" role="button">'.$p.'</a></li>';
   }
   if($wf_page != $wf_page_all){

      $link = $wf_link;

      $html .= '<li class="page-item">';
      $html .= '<a class="page-link waves-effect" href="'.$link.'&wf_page='.($wf_page+1).'" aria-label="Next">';
      $html .= '<span aria-hidden="true"><i class="fas fa-step-forward"></i></span>';
      $html .= '<span class="sr-only">Next</span>';
      $html .= '</a>';
      $html .= '</li>';
      $html .= '<li class="page-item">';
      $html .= '<a class="page-link waves-effect" href="'.$link.'&wf_page='.$wf_page_all.'" aria-label="Last">';
      $html .= '<span aria-hidden="true"><i class="fas fa-forward"></i></span>';
      $html .= '<span class="sr-only">Last</span>';
      $html .= '</a>';
      $html .= '</li>';
    }

   $html .= '</ul>';
   $html .= '</div>';

   return $html;
 }
 
 function send_mail($to = " ", $subject = " ", $body = " ",$file_path = " ",$file_name = " "){

   require_once('../sendmail/vendor/autoload.php');
  

		$from = 'noreply@bizpotential.com';
	 	$from_email = 'noreply@bizpotential.com';
		$from_pass = 'P@ssw0rd!@#$noreply';
		// $to = 'thailstyle@gmail.com';
		$mail = new  PHPMailer\PHPMailer\PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->SMTPDebug = 0;       			  
		$mail->isSMTP();             			 
		$mail->Host = 'mail.bizpotential.com';  		   
		$mail->SMTPAuth = true;
		$mail->Username = $from_email;     // SMTP username
		$mail->Password = $from_pass;     // SMTP password
		$mail->SMTPSecure = 'SSL';           	  
		$mail->Port = 25; 

		$mail->setFrom($from, $from);
		$mail->addAddress($to);     				

		$mail->isHTML(true);                        
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$send_status = $mail->send();
		if(!$send_status){
			$error =  $mail->ErrorInfo;
		}
 }
 
?>
