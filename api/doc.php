<?php
include('led_service.php');
include('tcpdf/tcpdf.php');

$method = web_service::getMethod();
ob_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Demo Document!!!</title>
  </head>
  <body>
<?php
$url = web_service::getURL();
$row = count($method);
$s=0;
foreach((array)$method as $_item) {
  $s++;
  web_service::callService($_item);
  $service = web_service::getService();
?>
    <div>
<b>Service</b> : <?=$service['service_name']?><br />
<b>รายละเอียด</b> : <?=$service['service_info']?><br />
<b>URL</b> : <?=$url.'?MOD='.$service['service_name']?>
    </div>
    <div><b>Request</b></div>
    <table width="100%">
      <thead>
        <tr>
          <th width="80" style="text-align: center;">ลำดับ</th>
          <th width="250" style="text-align: center;">ชื่อ</th>
          <th width="100" style="text-align: center;">ชนิด</th>
          <th width="100" style="text-align: center;">M/O</th>
          <th width="auto" style="text-align: center;">รายละเอียด</th>
        </tr>
      </thead>
      <tbody>
<?php 
  $i=1;
  foreach((array)$service['request'] as $_key=>$_item) { 
?>
        <tr>
          <td width="80" style="text-align: right;"><?=$i?></td>
          <td width="250"><?=$_key?></td>
          <td width="100"><?=$_item['TYPE']?></td>
          <td width="100"><?=$_item['FIELD_TYPE']?></td>
          <td width="auto"><?=$_item['DESC']?></td>
        </tr>
<?php
    $i++;
  }
?>
      </tbody>
    </table>
    <br />
    <div><b>Response</b></div>
    <table>
      <thead>
        <tr>
          <th width="80" style="text-align: center;">ลำดับ</th>
          <th width="250" style="text-align: center;">ชื่อ</th>
          <th width="100" style="text-align: center;">ชนิด</th>
          <th width="100" style="text-align: center;">M/O</th>
          <th width="auto" style="text-align: center;">รายละเอียด</th>
        </tr>
      </thead>
      <tbody>
      <?php 
  $i=1;
  foreach((array)$service['response'] as $_key=>$_item) { 
?>
        <tr>
          <td width="80" style="text-align: right;"><?=$i?></td>
          <td width="250"><?=$_key?></td>
          <td width="100"><?=$_item['TYPE']?></td>
          <td width="100"><?=$_item['FIELD_TYPE']?></td>
          <td width="auto"><?=$_item['DESC']?></td>
        </tr>
<?php
    $i++;
  }
?>
      </tbody>
    </table>
    <?php if($s < $row) { ?><br pagebreak="true" /><?php } ?>
<?php
}
?>
  </body>
</html>

<?php

$htmlcontent = ob_get_contents();
ob_end_clean();

$html = $htmlcontent;

$html .= '<style>
  table, th, td {
    border: soild 1px #000;
  }
  table {
    padding: 6px;
    width: 100% !important;
  }
</style>';

class PDF extends TCPDF {

  public function Header() {
  }
  public function Footer() {
  }

}

$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Document service');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
  require_once(dirname(__FILE__).'/lang/eng.php');
  $pdf->setLanguageArray($l);
}
$pdf->SetFont('thsarabun', '', 14);
$pdf->setFontSubsetting(false);
$pdf->AddPage();
$pdf->writeHTML($html, true, 0, true, 0);
$pdf->lastPage();
$pdf->Output('service.pdf', 'I');

?>