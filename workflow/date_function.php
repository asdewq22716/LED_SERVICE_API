<?php
if($_GET["WF_ONCTYPE"]=="3"){
	foreach($_GET as $k => $v) {
		if (strpos($v, "/") !== false) {
			$e = explode("/",$v);
			$int = GregorianToJD($e[1], $e[0], ($e[2]-543));
			$$k = $int;
		}else{
			$$k = $v;
		}
	}
	$formula = rawurldecode($_GET["CFlag"]);
	$formula = str_replace('@', '$', $formula);
	$jd = eval('return '.$formula.';');
	if($jd > 1887980){
	$gregorian = JDToGregorian($jd);
	$e = explode("/",$gregorian);
	echo sprintf('%02d', $e[1])."/".sprintf('%02d', $e[0])."/".($e[2]+543);
	}
}else{
	foreach($_GET as $k => $v) {
		$$k = str_replace(',','',$v);
	}
	$formula = rawurldecode($_GET["CFlag"]);
	$formula = str_replace('@', '$', $formula);
	$jd = eval('return '.$formula.';');  
	if($jd != ""){
		if($_GET['WFS_INPUT_FORMAT'] == "N"){
			echo number_format($jd,0);
		}elseif($_GET['WFS_INPUT_FORMAT'] == "N1"){
			echo number_format($jd,1);
		}elseif($_GET['WFS_INPUT_FORMAT'] == "N2"){
			echo number_format($jd,2);
		}elseif($_GET['WFS_INPUT_FORMAT'] == "N3"){
			echo number_format($jd,3);
		}else{
			echo $jd;
		} 
	}
}
?>