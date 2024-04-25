<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);
// print_pre('l');
// exit;
if($data['userName'] == "BankruptDt" && $data['passWord'] == "Debtor4321"){
   
    $sql = db::query("SELECT * FROM M_RESULT_POSTCODE   WHERE TRACKING_CODE = '". $data['trackingCode']."' ");
    $query = db::fetch_array($sql);

    

    $sql1 = "SELECT * FROM FRM_TRACKING_DETATIL   WHERE WFR_ID = '".$query['POSTCODE_ID']."' AND TRACK_TF_DEP = '".$data['location']."' AND TRACK_TF_DETAIL = '".$data['trackDetail']."' ";
    $dataquery = db::query($sql1);
    $num1 = db::num_rows($dataquery);
    $query1 = db::fetch_array($dataquery);

    if ($num1 < 1)
    {
  
		$insert['WFR_ID']               = $query['POSTCODE_ID'];
        $insert['WF_MAIN_ID']           = '78';
		$insert['WFS_ID']               = '1246';
		$insert['F_TEMP_ID']            = $query['POSTCODE_ID'];
		$insert['TRACK_TF_DATE']        = date2db($data['trackDate']);
		$insert['TRACK_TF_DEP']         = $data['location'];
		$insert['TRACK_TF_DETAIL']      = $data['trackDetail'];
		$insert['TRACK_TF_RESULT']      = $data['trackResult'];
        $insert['TRACK_TF_TIME']        = $data['trackTime'];
		

		$idtrack = db::db_insert("FRM_TRACKING_DETATIL ",$insert,'F_ID','F_ID');

        if($data['signature'] != ''){

            $url = $data['signature'];
            
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $genName = '';

            for ($i = 0;$i < 10;$i++)
            {
                $genName .= $characters[rand(0, $charactersLength - 1) ];
            }

            $target_dir = '../attach/w78/';
            $file_save_name = "f" . date("YmdHis") . "_" . $genName . ".png";
            $target_file = $target_dir . $file_save_name;

            file_put_contents( $target_file,file_get_contents($url));
          
    
        
        unset($data1);
        $data1['WFS_FIELD_NAME']      = 'TRACK_FILE';
        $data1['WFR_ID']              = $query['POSTCODE_ID'];
        $data1['FILE_NAME']           = '';
        $data1['WF_MAIN_ID']          = '78';
        $data1['FILE_TYPE']           = '';
        $data1['FILE_EXT']            =  'png';
        $data1['FILE_SAVE_NAME']      =  $file_save_name;
        $data1['FILE_DATE']           =  date('Y-m-d');
        $data1['FILE_TIME']           =  date(' H:i:s');
        $data1['FILE_STATUS']         =  "Y";
    //   print_pre($a);
        $id = db::db_insert("WF_FILE",$data1,"FILE_ID");

        }
        $cond['POSTCODE_ID'] = $query['POSTCODE_ID'];
        $update['SEND_RESULT'] = $data['trackDetail'];
        $update['SIGN_FILE']   = $data['receiverName'];
        $update['FILE_ID']   =  $id;
        db::db_update("M_RESULT_POSTCODE", $update , $cond);


        
    
    }



        
       
    
$num = count($data);
if ($data > 0)
{

    $row['ResponseCode'] = array(
        'ResCode' => '000',
        'ResMeassage' => "SUCCESS"
       
    );
    
    
}
else
{

    $row['ResponseCode'] = array(
        'ResCode' => '102',
        'ResMeassage' => "NOT FOUND"
    );

}

}
echo json_encode($row); 
 ?>
  

