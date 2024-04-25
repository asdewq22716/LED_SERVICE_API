<?php

/*$htmlcontent=$_POST["export_content"];
$htmlcontent=stripslashes($htmlcontent);
$htmlcontent=AdjustHTML($htmlcontent);
$htmlcontent = str_replace( "<br>", '<br />', $htmlcontent);
$htmlcontent = str_replace( ">__", ' />', $htmlcontent);*/
$html = $_POST["export_content"];


//==============================================================
//==============================================================
//==============================================================

include("mpdf.php");

$mpdf=new mPDF('th', 'A4-L', '0', 'THSaraban'); 

$mpdf->WriteHTML('<div lang="th">'.$html.'</div>');
//$mpdf->SetAutoFont(AUTOFONT_THAIVIET);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>