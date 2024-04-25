<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print barcode</title>
</head>
<?php
 
$_REQUEST['data'] = "http://103.208.27.224/workflow_present/view/accept.php?W=81&WFR=".$_GET["W"];

$errorCorrectionLevel = "H";
$matrixPointSize = "5";
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';
    include "qrlib.php";    
	     $filename = $PNG_TEMP_DIR.$_GET["W"].'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
	//	echo $filename;
	$x = basename($filename);
?>
<!--<body>
<table width="300" height="120" border="0" cellpadding="5" cellspacing="1" bgcolor="#000000" style="font-family:Tahoma; font-size:11px">
  <tr>
    <td  bgcolor="#FFFFFF">
      <table width="100%" border="0" cellspacing="1" cellpadding="5" >
        <tr>
          <td width="100"><img src="temp/<?php echo $x; ?>"  width="100" height="100" border="1"  /></td>
          <td valign="top">รหัส <?php echo $R["I_NUMBER"]; ?></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>-->
</html>