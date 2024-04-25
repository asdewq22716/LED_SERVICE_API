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
		.class_number { mso-number-format:Standard; } 
		.class_text_no { mso-number-format:'\@';} 
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

	}else if($_POST["export_type"] == 'json'){
		function html_to_obj($html) {
			$dom = new DOMDocument();
			$dom->loadHTML($html);
			return element_to_obj($dom->documentElement);
			
		}
		function element_to_obj($element) {
    $obj = array( "tag" => $element->tagName );
    foreach ($element->attributes as $attribute) {
        $obj[$attribute->name] = $attribute->value;
    }
    foreach ($element->childNodes as $subElement) {
        if ($subElement->nodeType == XML_TEXT_NODE) {
            $obj["html"] = $subElement->wholeText;
        }
        else {
            $obj["children"][] = element_to_obj($subElement);
        }
    }
    return $obj;
}
header("Content-Type: application/json");
echo json_encode(html_to_obj($_POST["export_content"]), JSON_PRETTY_PRINT);
	}else if($_POST["export_type"] == 'xls'){
		
		header( 'Content-type: application/x-www-form-urlencoded' );
		header( 'Content-Disposition: filename="export.' . $_POST["export_type"] . '"' );
		header( 'Content-Description: Download Data' );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );
		
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		echo "<style type=\"text/css\">
		
				.text_head {
					font-family: TH SarabunPSK;
					font-size: 24px; 
					font-style: normal; 
					line-height: normal;
					font-weight: bold;
					font-variant: normal;
					text-transform: none;
					color: #000000; 
					text-decoration: none;
				}
				.text_subhead {
					font-family: TH SarabunPSK;
					font-size: 21px;
					font-style: normal; 
					line-height: normal;
					font-weight: bold;
					font-variant: normal;
					text-transform: none;
					color: #000000; 
					background-color: #D8D8D8;
					text-decoration: none;
					border: .5pt solid;
					mso-number-format:'\@';
				}
				h1,h2,h3,h4,h5,h6 {
				font-family: TH SarabunPSK;
				}
				.text_body {
					font-family: TH SarabunPSK;
					font-size: 21px;
					font-style: normal; 
					line-height: normal;
					font-variant: normal;
					text-transform: none;
					color: #000000; 
					text-decoration: none;
					border: .5pt solid;
					vertical-align:top; 
				}
				.class_number { mso-number-format:Standard; }
				.class_text_no { mso-number-format:'\@';}
				table{ 
	font-size:12.0pt;
	font-family:\"TH SarabunPSK\",serif;}
	td{
		width:100px;border:solid windowtext 0.5pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
  font-size:16.0pt;
	}
				</style>";
 
		echo $_POST["header_word"];
		$data_content = str_replace("width=\"\"","",$_POST["export_content"]);
		echo removeLink($data_content);
		
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
		echo "<style>
				@page pageL
					{size:11.0in 8.5in;
					mso-page-orientation:landscape;
					margin:1.0in 1.0in 1.0in 1.0in;
					mso-header-margin:35.4pt;
					mso-footer-margin:35.4pt;
					mso-paper-source:0;}
					div.pageL
				{page:pageL;}
				@page pageP
					{size:8.5in 11.0in;
					margin:1.0in 1.0in 1.0in 1.0in;
					mso-header-margin:.5in;
					mso-footer-margin:.5in;
					mso-paper-source:0;}
					div.pageP
				{page:pageP;}
				h1,h2,h3,h4,h5,h6 {
				font-family: TH SarabunPSK;
				}
				.text_head {
					font-family: TH SarabunPSK;
					font-size: 21px; 
					font-style: normal; 
					line-height: normal;
					font-weight: bold;
					font-variant: normal;
					text-transform: none;
					color: #000000; 
					text-decoration: none;
				}
				.text_subhead {
					font-family: TH SarabunPSK;
					font-size: 18px;
					font-style: normal; 
					line-height: normal;
					font-weight: bold;
					font-variant: normal;
					text-transform: none;
					color: #000000; 
					background-color: #D8D8D8;
					text-decoration: none;
					border:solid windowtext 1.0pt
				}
				.text_body {
					font-family: TH SarabunPSK;
					font-size: 18px;
					font-style: normal; 
					line-height: normal;
					font-variant: normal;
					text-transform: none;
					color: #000000; 
					text-decoration: none;
					border: .5pt solid;
				}
				table.type_body{
					mso-style-name:".$type_table.";
					mso-tstyle-rowband-size:0;
					mso-tstyle-colband-size:0;
					mso-style-priority:39;
					mso-style-unhide:no;
					border:solid windowtext 1.0pt;
					mso-border-alt:solid windowtext .5pt;
					mso-padding-alt:0in 5.4pt 0in 5.4pt;
					mso-border-insideh:.5pt solid windowtext;
					mso-border-insidev:.5pt solid windowtext;
					mso-para-margin:0in;
					mso-para-margin-bottom:.0001pt;
					mso-pagination:widow-orphan;
					font-size:11.0pt;
					font-family: TH SarabunPSK;
				}
				.td_subhead{
					width:5.0%;border-top:solid windowtext 1.0pt;
				   border-left:none;border-bottom:solid windowtext 1.0pt;border-right:none;
				   mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
				   padding:.75pt .75pt .75pt .75pt
				}
								table{ 
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:39;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:14.0pt;
	width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt;
	font-family:\"TH SarabunPSK\",serif;}
			</style>";
		echo removeLink($_POST["export_content"]);
	}
db::db_close();
?>