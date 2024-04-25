<?php
include '../include/include.php';


$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);

if($data['systemId'] != ''){
		$filter .= "AND ANC_TYPE_CIVIL = '".$data['systemId']."'";
}
if($data['noticeDate'] != ''){
		$filter .= "AND ANC_DATE = '".date2db($data['noticeDate'])."'";
}
if($data['redCase'] != ''){
		$filter .= "AND RED_CASE like '%".$data['redCase']."%'";
}
if($data['redYy'] != ''){
		$filter .= "AND RED_YEAR like '%".$data['redYy']."%'";
}
if($data['blackCase'] != ''){
		$filter .= "AND BLACK_CASE like '%".$data['blackCase']."%'";
} 
if($data['blackYy'] != ''){
		$filter .= "AND BLACK_YEAR like '%".$data['blackYy']."%'";
}
if($data['plantiffName'] != ''){
		$filter .= "AND PLANTIFF_1 like '%".$data['plantiffName']."%'";
}
if($data['defendantName'] != ''){
		$filter .= "AND DEFENDANT_1 like '%".$data['defendantName']."%'";
}
if($data['courtId'] != ''){
		$filter .= "AND COURT_ID = '".$data['blackYy']."'";
}

	$sql = "SELECT A.*,B.COURT_NAME_LAW,C.*,D.FILE_NAME,D.FILE_SAVE_NAME FROM M_ANC_NOTICE_WEBSITE A 
	LEFT JOIN M_COURT_CODE_MAP B ON A.COURT_ID = B.COURT_ID 
	LEFT JOIN FRM_ANC_NOTICE C ON A.ANC_NOTICE_WEB_ID = C.WFR_ID 
	LEFT JOIN WF_FILE D ON C.F_ID = D.WFR_ID AND D. WFS_FIELD_NAME = 'ANC_NOTICE_FILE' AND d.FILE_STATUS ='Y' 
	WHERE 1=1 {$filter}";
	$query = db::query($sql);

	$i = 0;
	while($res = db::fetch_array($query)){
		
		foreach($res as $k => $v){
			if(!is_numeric($k)){
				if($k == 'ANC_DATE'){
					$row[$i]['ANC_DATE'] = db2date($v);
				}else{
					
					$row[$i][$k] = $v;
				}
			}
		}
		$i++;
	}





echo json_encode($row); 
 ?>
 