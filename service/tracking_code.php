<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);


if($data['userName'] == 'BankruptDt' && $data['passWord'] == 'Debtor4321'){
  $sql = "SELECT * FROM M_RESULT_POSTCODE WHERE STATUS = 0 AND ROWNUM <= ".$data['rowNum'];
  $query = db::query($sql);
  $i = 0;
  while ($rec = db::fetch_array($query)){
    unset($field);

    $field['DEP_NAME'] = $data['depName'];
    $field['STATUS'] = 1;
    $field['USE_DATE'] = date('Y-m-d');
    $field['TRACKING_USER'] = $data['trackingUser'];
	$cond['TRACKING_CODE'] = $rec['TRACKING_CODE'];
	db::db_update("M_RESULT_POSTCODE",$field,$cond);
	
	$obj[$i]['TRACKING_CODE'] 	= $rec['TRACKING_CODE'];
	$obj[$i]['trackingCode'] 	= $rec['TRACKING_CODE'];
    $i++;
  }


  // $sql_res = "SELECT * FROM M_RESULT_POSTCODE WHERE STATUS = 1 AND DEP_NAME = '"$data['DEP_NAME']"'AND USE_DATE =";
  // $qry = db::query($sql_res);
  // $i=0;
  // while ($rec_res = db::fetch_array($qry)) {
    // $obj[$i]['TRACKING_CODE'] = $rec['TRACKING_CODE'];
    // $obj[$i]['DEP_NAME'] = $rec['DEP_NAME'];
    // $obj[$i]['USE_DATE'] = $rec['USE_DATE'];
	//$i++;
  }

  $num = count($obj);
  if($num > 0){

		$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");
		$row['Data'] = $obj;

	}else{

		$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");
			
	}

	// print_pre($row);
	echo json_encode($row);

?>
