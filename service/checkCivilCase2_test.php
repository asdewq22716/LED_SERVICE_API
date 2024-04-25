<?php
set_time_limit(0);
ini_set("display_errors", 0);
ini_set('max_execution_time','0');
ini_set('memory_limit','3048M');
ini_set('output_buffering',0); 

include '../include/include.php';


echo $sqlSelectData = "select PCC_CASE_GEN,CIVIL_CODE,PREFIX_BLACK_CASE,BLACK_CASE,BLACK_YY,PREFIX_RED_CASE,RED_CASE,RED_YY,CASE_LAWS_CODE,CASE_LAWS_NAME,CAPITAL_AMOUNT,PLAINTIFF1,PLAINTIFF2,PLAINTIFF3,DEFFENDANT1,DEFFENDANT2,DEFFENDANT3 from WH_CIVIL_CASE where BLACK_CASE = '1853' and BLACK_YY = '2563' and COURT_CODE = '204'"; 
 /*
$conn = oci_connect('led_service_api', 'ledserviceapi4321', '103.208.27.224/orcl','UTF8');
 
$stid = oci_parse($conn, $sqlSelectData);
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
 exit;
 */

$querySelectData = db::query($sqlSelectData);
while($dataSelectData = db::fetch_array($querySelectData)){
	$obj[$i]['PccDossControl'] 		= $dataSelectData['PCC_CASE_GEN'];
	$obj[$i]['CivilCode'] 			= $dataSelectData['CIVIL_CODE'];
	$obj[$i]['PrefixBlackCase'] 	= $dataSelectData['PREFIX_BLACK_CASE'];
	$obj[$i]['BlackCase'] 			= $dataSelectData['BLACK_CASE'];
	$obj[$i]['BlackYY'] 			= $dataSelectData['BLACK_YY'];
	$obj[$i]['PrefixRedCase'] 		= $dataSelectData['PREFIX_RED_CASE'];
	$obj[$i]['RedCase'] 			= $dataSelectData['RED_CASE'];
	$obj[$i]['RedYY'] 				= $dataSelectData['RED_YY'];
	$obj[$i]['CaseLawsCode'] 		= $dataSelectData['CASE_LAWS_CODE'];
	$obj[$i]['CaseLawsName'] 		= $dataSelectData['CASE_LAWS_NAME'];
	$obj[$i]['CapitalAmount'] 		= $dataSelectData['CAPITAL_AMOUNT'];
	$obj[$i]['Plaintiff1'] 			= $dataSelectData['PLAINTIFF1'];
	$obj[$i]['Plaintiff2'] 			= $dataSelectData['Plaintiff2'];
	$obj[$i]['Plaintiff3'] 			= $dataSelectData['PLAINTIFF3'];
	$obj[$i]['Deffendant1'] 		= $dataSelectData['DEFFENDANT1'];
	$obj[$i]['Deffendant2'] 		= $dataSelectData['DEFFENDANT2'];
	$obj[$i]['Deffendant3'] 		= $dataSelectData['DEFFENDANT3'];

	$i++;
}
print_r($obj);
 ?>