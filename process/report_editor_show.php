<?php
//ini_set("display_errors", 0); 
include '../include/config.php';
$html =  stripslashes($_POST["show"]);
$R_SET_FONT = "16";  
$margin_left = "20";
$margin_right = "20";
$margin_top = "20";
$margin_bottom = "20";

if($_POST["sql1"] != ""){
$sql = db::query($_POST["sql1"]);
$rec = db::fetch_array($sql);

	preg_match_all("/(##)([a-zA-Z0-9_]+)(!!)/", $html, $new_sql, PREG_SET_ORDER);
	foreach ($new_sql as $val_new) {
		$html = str_replace("##".$val_new[2]."!!",$rec[$val_new[2]],$html);
	}
}
if($_POST["tb1"] != ""){
$txt = '<div class=showborder><table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>134</td>
                                                <td>Summer Throssell</td>
                                                <td>summert@example.com</td>
                                            </tr>
                                            <tr>
                                                <td>135</td>
                                                <td>Anthony Pound</td>
                                                <td>anthonyp@example.com</td>
                                            </tr>
                                            <tr>
                                                <td>136</td>
                                                <td>Erin Church</td>
                                                <td>erinc@example.com</td>
                                            </tr>
                                            <tr>
                                                <td>137</td>
                                                <td>Declan Pamphlett</td>
                                                <td>declanp@example.com</td>
                                            </tr>
                                        </tbody>
                                    </table></div>';

	$html = str_replace("#TB1#",$txt,$html);
}

		include("../assets/mpdf/mpdf.php");
		$mpdf=new mPDF('th', 'A4', '0', 'thsarabun',$margin_left,$margin_right,$margin_top,$margin_bottom,$margin_header,$margin_footer); 
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
		.heading{
		font-size:18pt; 
		text-align:center;

		}
		p {
		  font-size:".$R_SET_FONT."pt;
		}
		</style> ";

		$header = stripslashes($_POST['header_pdf']);
		$mpdf->SetHTMLHeader($header);
		$css = ($_POST['css_pdf'])?stripslashes($_POST['css_pdf']):$std_css;
		$mpdf->WriteHTML($css.$html);
		$mpdf->Output();
		exit;
?>