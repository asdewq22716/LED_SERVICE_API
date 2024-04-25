<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

include '../phpvendor/vendor/autoload.php';
$pdf = new \Mpdf\Mpdf([
    'mode' => 'th',
    'default_font' => 'thsarabun',
    'default_font_size' => 14,
    'format' =>  'A4',
    'orientation' => '',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 15,
    'margin_bottom' => 20,
    "margin-header" => 40,
]);



$response = api_request('http://103.40.146.73/LedLaw.php/reportshr1i300_1', '', array(
	"shrReqBankGen" => $_GET['shrReqBankGen']
));

$CSS = "<style type='text/css'>
		/*class pdf*/
			#report_pdf { 
				width: 100%;
				border-collapse: collapse;
				font-family: TH SarabunPSK;
				padding-left:5px;	
				padding-right:3px;
				padding:3px;
			}
			#report_pdf th{
				font-size:14pt;
				font-weight: bold;
				padding:3px;
			}
			#report_pdf tr.headPDF th{
				border-top: 1px solid b#000000;
				border-bottom: 1px solid b#000000;
				vertical-align:top;
				font-size:14pt;
				padding-left:3px;		
				padding-right:3px;
				padding:3px;
			}
			#report_pdf tr.bodyBottomPDF td{	
				border-top: solid 1px #000000;		
				border-bottom: solid 1px #000000;			
				font-size:14pt;
				padding-left:3px;		
				padding-right:3px;
				padding:3px;
			}
			#report_pdf tr.bodyPDF td{
				vertical-align:top;
				font-size:14pt;
				padding-left:3px;		
				padding-right:3px;
				padding:3px;
			}
			.footer {
				border-top:solid 1px #000000; 
				padding: 0px 0px 0x 0px; 
				font-size:14pt; 
				font-weight: none; 
				font-style: normal;
			}

            #report_pdf td.footer {
				border-top:solid 1px #000000; 
                border-bottom:double 3px #000000; 
				padding: 0px 0px 0x 0px; 
				font-size:14pt; 
				font-weight: none; 
				font-style: normal;
			}
            
	</style>
	";

$pdf->AddPage('P');

//print_r($response);exit;
$data = $response['Data'];
$html .= "<table style=\"width:100%\"><tr>
	<td style=\"width:40%\">&nbsp;</td>
	<td style=\"width:20%\"><img src=\"../assets/images/report/garuda_log.png\" style=\"width:100px\" /></td>
	<td style=\"width:40%\">
		คดีหมายเลขแดงที่ {$data['prefixRedCase']} {$data['redCase']}/{$data['redYy']}<br>
		ศาล {$data['courtName']}<br>
	</td>
</tr>";
$html .= "<tr>
	<td style=\"width:60%\" colspan=\"2\">&nbsp;</td>
	<td style=\"width:40%\">
		วันที่ ".thaiDate($data['documentDate'])."
	</td>
</tr></table>";

$html .= "<table style=\"width:100%\"><tr>
	<td rowspan=\"2\" style=\"vartical-align:middle;\">
		ระหว่าง&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-size:50pt\">{</span>
	</td>
	<td>{$data['plaintiff1']}</td>
	<td> โจทก์</td>
</tr>
<tr>
	<td>{$data['defendant1']} {$data['defendant2']}</td>
	<td> จำเลย</td>
</tr></table>";

$html .= "<table style=\"width:100%\"><tr>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า {$data['fname']} {$data['lname']} {$data['companyName']} เกี่ยวพันกับคู่ความเป็น {$data['concernName']}
</td>
</tr>";
$html .= "<tr>
<td>
หมายเลขบัตรประจำตัวประชาชน / หมายเลขทะเบียนนิติบุคคล {$data['cardId']} {$data['companyId']}
</td>
</tr>";
$html .= "<tr><td>
อยู่บ้านเลขที่ {$data['houseNo']} หมู่ที่ {$data['moo']} ถนน {$data['mainStreet']} ตรอก/ซอย {$data['soi']} ตำบล/แขวง {$data['tumName']}<br>
อำเภอ/เขต {$data['ampName']} จังหวัด {$data['prvName']} เบอร์โทรศัพท์ {$data['mobileNo']}<br>
</td>
</tr>";
$html .= "<tr>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คดีนี้ ผู้ร้องประสงค์ <b>ขอรับเงิน</b>ตามบัญชีแสดงรายการรับ - จ่าย <b>โดยการโอนเงินเข้าบัญชีเงินฝากธนาคาร</b> ประเภทบัญชี <b>ออมทรัพย์ /เผื่อเรียก /กระแสรายวัน</b> มีรายละเอียดดังนี้<br>
</td>
</tr></table>";

$html .= "<table style=\"width:100%\"><tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อธนาคาร {$data['bankName']} สาขา {$data['bankBrName']}<br></td></tr>";

$html .= "<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่บัญชีธนาคาร {$data['bankNo']}</td></tr>";

$html .= "<tr>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อบัญชี (ภาษาไทย) {$data['bankAccountName']}</td>
</tr>
<tr><td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อบัญชี (ภาษาอังกฤษ)............................................................................................................................................</td>
</tr>";

$html .= "<tr>
<td style=\"text-align:center;\">(ข้อมูล<b>ชื่อบัญชีภาษาอังกฤษ</b> ใช้สำหรับการโอนเงินมากกว่า 2 ล้านบาท ทางระบบบาทเนต)</td>
</tr></table>";

$html .= "<table style=\"width:100%\"><tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โดยได้แนบเอกสารเพื่อเป็นหลักฐานข้อมูลการขอรับเงินโดยการโอนเงินเข้าบัญชีเงินฝากธนาคาร ดังนี้</td>
</tr>";
$html .= "<tr>
<td><img src=\"../assets/images/report/unchecked.png\" style=\"width:15px\" /> สำเนาหน้าสมุดบัญชีเงินฝากธนาคาร<b>(ออมทรัพย์ /เผื่อเรียก)</b> หรือ หนังสือรับรองบัญชีเงินฝากธนาคาร<b>(กระแสรายวัน)</b><br></td>
</tr>";
$html .= "<tr>
<td><img src=\"../assets/images/report/unchecked.png\" style=\"width:15px\" /> อื่น ๆ (ระบุ)...........................................................................................................................................................................<br></td>
</tr>";

$html .= "<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เมื่อโอนเงินผ่านระบบอิเล็กทรอนิกส์ของธนาคารแล้ว ให้ส่งข้อมูลการโอนเงินผ่านช่องทาง<br>
</td>
</tr>";
$html .= "<tr>
<td><img src=\"../assets/images/report/unchecked.png\" style=\"width:15px\" /> ข้อความแจ้งเตือนผ่านโทรศัพท์มือถือ (SMS) ที่หมายเลข....................................................................................<br>
</td>
</tr>";
$html .= "<tr>
<td><img src=\"../assets/images/report/unchecked.png\" style=\"width:15px\" /> จดหมายอิเล็กทรอนิกส (e-mail Address) : ........................................................................................................<br>
</td>
</tr>";

$html .= "<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า<b>ยินยอมชำระค่าธรรมเนียมการโอนเงินเข้าบัญชีตามอัตราที่ธนาคารกำหนด</b> โดยหักจากเงินที่ข้าพเจ้าได้รับ
และประสงค์ใช้บัญชีธนาคารนี้ในการรับโอนเงินตลอดไป จนกว่าจะมีการแจ้งเปลี่ยนแปลงเป็นลายลักษณ์อักษร<br>
</td>
</tr>";

$html .= "<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขอได้โปรดอนุญาต</td>
</tr></table>";

$html .= "<table style=\"width:100%\"><tr>

<td style=\"width:60%;\">&nbsp;</td><td style=\"text-align:center;\">
<br>
<br>
ลงชื่อ ............................................................. ผู้ร้อง<br>
(................................................................)<br>
</td>";

$html .= '</tr>';

$html .= '</table>';

$pdf->WriteHTML($CSS . $html);


$pdf->SetTitle('report_shr1i300_1', 'I');
$pdf->Output('report_shr1i300_1.pdf', 'I');