<?php
$default2 = 10;
$page_size2 = ($page_size2 == "") ? $default2 : $page_size2;

$arrPage2 = array("10" => "10","20" => "20", "40" => "40", "60" => "60", "80" => "80", "100" => "100", "200" => "200", "2000" => "ทั้งหมด");
$page2 =  ($_REQUEST['page2'] == "") ? 1 : $_REQUEST['page2'];
$goto2 = ($page_size2 * ($page2 - 1));
/*echo $goto2.'==='.$page2.'=='.$page_size2;
	echo '<pre>';
	print_r($_REQUEST);
	echo '</pre>';*/

function startPaging2($form, $total_record)
{
	global $default2, $arrPage2, $page2, $page_size2;

	$page_size2 = ($page_size2 == "") ? $default2 : $page_size2;

	$total_page = ceil($total_record / $page_size2);

	$max_page = ($total_page > 4) ? 4 : $total_page;

	$start_page = ($page2 == "") ? 1 : $page2 - 2;
	$start_page = ($start_page <= 0) ? 1 : $start_page;

	$end_page = ($max_page + $start_page);
	$end_page = ($end_page > $total_page) ? $total_page : $end_page;

	$start_page = (($end_page - $start_page) < 4) ? $end_page - 4 : $start_page;
	$start_page = ($start_page <= 0) ? 1 : $start_page;

	$startClass = ($page2 == 1) ? " class=\"disabled\" " : "";
	$endClass = ($page2 == $total_page) ? " class=\"disabled\" " : "";

	$html = "<div class=\"col-xs-6 col-sm-6 hidden-md hidden-lg\">
            	<div style=\"height:80px; display:table-cell; vertical-align:middle;\">
                    <div class=\"input-group\">
                      <span class=\"input-group-btn\">
                          <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                            แสดง " . $arrPage2[$page_size2] . $page_size2 . " <span class=\"caret\"></span>
                          </button>
                          <ul class=\"dropdown-menu\" role=\"menu\">";
	foreach ($arrPage2 as $key => $val) {
		$html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#page_size2').val('" . $key . "'); $('#page2').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">แสดง " . $val . "</a></li>";
	}
	$html .= "</ul>
                      </span>
                      <span class=\"input-group-addon\"> / หน้า จำนวน " . $total_record . " รายการ</span>
                    </div>
                </div>
            </div>
            <div class=\"col-xs-6 col-sm-6 hidden-xs hidden-sm hidden-md hidden-lg\">
                <ul class=\"pagination pull-right\">";
	if ($page2 == 1) {
		$html .= "<li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&laquo;</a></li>
                  <li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&#8249;</a></li>";
	} else {
		$html .= "<li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#page2').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&laquo;</a></li>
                  <li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#page2').val('" . ($page2 - 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8249;</a></li>";
	}
	for ($i = $start_page; $i <= $end_page; $i++) {
		$active = ($i == $page2) ? " class=\"active\" " : "";
		$html .= "<li $active ><a href=\"javascript:void(0);\" onclick=\"$('#page2').val('" . ($i) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">" . $i . "</a></li>";
	}
	if ($page2 == $total_page) {
		$html .= "<li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&#8250;</a></li>
					  <li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&raquo;</a></li>";
	} else {
		$html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#page2').val('" . ($page2 + 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8250;</a></li>
					  <li><a href=\"javascript:void(0);\" onclick=\"$('#page2').val('" . $total_page . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&raquo;</a></li>";
	}
	$html .= "</ul>
            </div>";

	return $html;
}
function endPaging2($form, $total_record)
{
	global $default2, $arrPage2, $page2, $page_size2;
	$page_size2 = ($page_size2 == "") ? $default2 : $page_size2;

	$total_page = ceil($total_record / $page_size2);

	$max_page = ($total_page > 4) ? 4 : $total_page;

	$start_page = ($page2 == "") ? 1 : $page2 - 2;
	$start_page = ($start_page <= 0) ? 1 : $start_page;

	$end_page = ($max_page + $start_page);
	$end_page = ($end_page > $total_page) ? $total_page : $end_page;

	$start_page = (($end_page - $start_page) < 4) ? $end_page - 4 : $start_page;
	$start_page = ($start_page <= 0) ? 1 : $start_page;

	$startClass = ($page2 == 1) ? " class=\"disabled\" " : "";
	$endClass = ($page2 == $total_page) ? " class=\"disabled\" " : "";

	$html = "<div class=\"col-sm-6 hidden-xs\">
            	<div style=\"height:80px; display:table-cell; vertical-align:middle;\">
                    <div class=\"input-group\">
                      <span class=\"input-group-btn\">
                          <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                            แสดง " . $arrPage2[$page_size2] . "
                          </button>
                          <ul class=\"dropdown-menu\" role=\"menu\">";
	foreach ($arrPage2 as $key => $val) {
		$html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#page_size2').val('" . $key . "'); $('#page2').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">แสดง " . $val . "</a></li>";
	}
	$html .= "</ul>
                      </span>
                      <span class=\"input-group-addon\"> / หน้า จำนวน " . $total_record . " รายการ</span>
                    </div>
                </div>
            </div>
            <div class=\"col-xs-12 col-sm-6\">
                <ul class=\"pagination pull-right\">";
	if ($page2 == 1) {
		$html .= "<li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&laquo;</a></li>
					  <li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&#8249;</a></li>";
	} else {
		$html .= "<li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#page2').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&laquo;</a></li>
					  <li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#page2').val('" . ($page2 - 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8249;</a></li>";
	}
	for ($i = $start_page; $i <= $end_page; $i++) {
		$active = ($i == $page2) ? " class=\"active\" " : "";
		$html .= "<li $active ><a href=\"javascript:void(0);\" onclick=\"$('#page2').val('" . ($i) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">" . $i . "</a></li>";
	}
	if ($page2 == $total_page) {
		$html .= "<li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&#8250;</a></li>
					  <li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&raquo;</a></li>";
	} else {
		$html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#page2').val('" . ($page2 + 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8250;</a></li>
					  <li><a href=\"javascript:void(0);\" onclick=\"$('#page2').val('" . $total_page . "'); $('#" . $form . "').submit();\">&raquo;</a></li>";
	}
	$html .= "</ul>
            </div>";

	return $html;
}
