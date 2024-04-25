<?php
	include("../include/include.php");
	
	$margin_left = $_POST["margin_left"];
	$margin_right = $_POST["margin_right"];
	$margin_top = $_POST["margin_top"];
	$margin_bottom = $_POST["margin_bottom"];
	$margin_header = $_POST["margin_header"];
	$margin_footer = $_POST["margin_footer"];
	$R_SET_FONT = $_POST["R_SET_FONT"]!=''? $_POST["R_SET_FONT"]:"14";
	if($_POST["export_type"] == 'pdfl' or $_POST["export_type"] == 'pdfa3l'){
		/*$htmlcontent=$_POST["export_content"];
		$htmlcontent=stripslashes($htmlcontent);
		$htmlcontent=AdjustHTML($htmlcontent);
		$htmlcontent = str_replace( "<br>", '<br />', $htmlcontent);
		$htmlcontent = str_replace( ">__", ' />', $htmlcontent);*/
		$html =  removeLink(stripslashes($_POST["export_content"])); 


		//==============================================================
		//==============================================================
		//==============================================================
		include("../assets/mpdf/mpdf.php");
		if ($_POST["export_type"] == 'pdfa3l') {
			$size = 'A3-L';
		} else {
			$size = 'A4-L';
		}
		$mpdf=new mPDF('th', $size, '0', 'thsarabun',$margin_left,$margin_right,$margin_top,$margin_bottom,$margin_header,$margin_footer); 
		$std_css=" <style>
		table{
			border-collapse: collapse;
			overflow: wrap;
			width:100%;
		}

		th{
			border: 1px solid black;
			 font-size:".$R_SET_FONT."pt; 
			 padding:3px;
			 color:#000000;
		}
		td {
		  vertical-align: text-top;
		  font-size:".$R_SET_FONT."pt; 
		  padding:3px;
		  color:#000000;
		}
		div.showborder th{
		 vertical-align: text-top;
		  border: 1px solid black;
		  font-size:".$R_SET_FONT."pt; 
		  padding:3px;
		  color:#000000;
		}
		div.showborder td{
		 vertical-align: text-top;
		  border: 1px solid black;
		  font-size:".$R_SET_FONT."pt; 
		  padding:3px;
		  color:#000000;
		}
		div.f_14 td{
		 vertical-align: text-top;
		  border: 1px solid black;
		  font-size:".$R_SET_FONT."pt; 
		  padding:3px;
		  color:#000000;
		}
		/* ออกรายงาน   เรียงตามลำดับอาวุโส  */
		.heading{
		font-size:18pt; 
		text-align:center;

		}
		</style> ";

		$header = removeLink(stripslashes($_POST['header_pdf']));
		$mpdf->SetHTMLHeader($header);
		$css = ($_POST['css_pdf'])?stripslashes($_POST['css_pdf']):$std_css;
		$mpdf->WriteHTML($css.$html);
		$mpdf->Output();
		exit;

		//==============================================================
		//==============================================================
		//==============================================================

	}else if($_POST["export_type"] == 'pdfp'){
		/*$htmlcontent=$_POST["export_content"];
		$htmlcontent=stripslashes($htmlcontent);
		$htmlcontent=AdjustHTML($htmlcontent);
		$htmlcontent = str_replace( "<br>", '<br />', $htmlcontent);
		$htmlcontent = str_replace( ">__", ' />', $htmlcontent);*/
		$html = removeLink(stripslashes($_POST["export_content"]));



		//==============================================================
		//==============================================================
		//==============================================================
		include("../assets/mpdf/mpdf.php");

		$mpdf=new mPDF('th', 'A4', '0', 'thsarabun',$margin_left,$margin_right,$margin_top,$margin_bottom,$margin_header,$margin_footer); 

		$std_css=" <style>
		table{
			border-collapse: collapse;
			overflow: wrap;
		}
		th{
			border: 1px solid black;
			 font-size:".$R_SET_FONT."pt; 
			 padding:3px;
			 color:#000000;
		}
		td {
		  vertical-align: text-top;
		  font-size:".$R_SET_FONT."pt; 
		  padding:3px;
		  color:#000000;
		}
		p{
			font-size: 19pt; margin-bottom:2px;font-weight: bold;
		}
		div.showborder th{
		 vertical-align: text-top;
		  border: 1px solid black;
		  font-size:14pt; 
		  padding:3px;
		  color:#000000;
		}
		div.showborder td{
		 vertical-align: text-top;
		  border: 1px solid black;
		  font-size:14pt; 
		  padding:3px;
		  color:#000000;
		}
		div.showbold th{
		 vertical-align: text-top;
		  border: 1px solid black;
		  font-size:20pt; 
		  font-weight:bold;
		  padding:3px;
		  color:#000000;
		}
		div.showbold td{
		 vertical-align: text-top;
		  border: 1px solid black;
		  font-size:18pt; 
		  font-weight:bold;
		  padding:3px;
		  color:#000000;
		}
		div.topicbold td{
		 vertical-align: text-top;
		  font-size:22pt;
			font-weight:bold;  
		  padding:3px;
		  color:#000000;
		}
		div.f_14 td{
		 vertical-align: text-top;
		  border: 1px solid black;
		  font-size:14pt; 
		  padding:3px;
		  color:#000000;
		}
		div.font_14 th{
		  vertical-align: text-top;
		  font-weight: bold;
		  font-size:14pt; 
		  padding:3px;
		  color:#000000;
		}
		div.font_14 td{
		 vertical-align: text-top;
		  font-size:14pt; 
		  padding:3px;
		  color:#000000;
		}
		</style> ";

		$header = stripslashes($_POST['header_pdf']);

		$mpdf->SetHTMLHeader($header);
		$css = ($_POST['css_pdf'])?stripslashes($_POST['css_pdf']):$std_css;
		$mpdf->WriteHTML($css.$html);
		$mpdf->Output();
		exit;

		//==============================================================
		//==============================================================
		//==============================================================

	}else if($_POST["export_type"] == 'xls'){
		
		header( 'Content-type: application/x-www-form-urlencoded' );
		header( 'Content-Disposition: filename="export.' . $_POST["export_type"] . '"' );
		header( 'Content-Description: Download Data' );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo $_POST["header_word"];
		echo removeLink($_POST["export_content"]);
		
	}else if($_POST["export_type"] == 'doc'){
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=export.doc "); 
		header("Content-Transfer-Encoding: binary ");
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo removeLink($_POST["export_content"]);
	}
db::db_close();
?>