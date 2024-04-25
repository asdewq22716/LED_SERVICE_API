<?php

include '../include/include.php';


$str_json = file_get_contents("php://input");
$POST = json_decode($str_json, true);

$filter = "";
if($POST["startDate"]!=""){
	$filter .= " AND WORK_DATE >= '".$POST["startDate"]."' ";
}
if($POST["endDate"]!=""){
	$filter .= " AND WORK_DATE <= '".$POST["endDate"]."' ";
}
if($POST["registerCode"]!=""){
	$filter .= " AND USER_IDCARD = '".str_replace('-','',$POST["registerCode"])."'";
}

if($filter!=""){
	$i = 1;
	$sqlSelectData = "	select 	* 
						from 	VIEW_WORKLOAD_ALL
						where 	rownum < 1"; 
	$arrFieldsList = db::query_field($sqlSelectData);

	$sqlSelectData = "	select 		*
						from 		VIEW_WORKLOAD_ALL
						where 		1=1  {$filter} ";
	$querySelectData = db::query($sqlSelectData);
	while($recSelectData = db::fetch_array($querySelectData)){
		foreach($arrFieldsList as $key => $val){
			$obj[$i][underToCamel($val)] = $recSelectData[$val];
		}
		$i++;
	}
	
}

$num = count($obj);
	
if($num > 0){

	$row['ResponseCode'] = array('ResCode'=>'000','ResMeassage'=>"SUCCESS");	
	$row['Data'] = $obj;
		
}else{
		
	$row['ResponseCode'] = array('ResCode'=>'102','ResMeassage'=>"NOT FOUND");

}


echo json_encode($row); 

?>