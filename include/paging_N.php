<?php
$default = 20;
$page_size = ($page_size == "") ? $default : $page_size;
$arrPage = array("20" => "20", "40" => "40", "60" => "60", "80" => "80", "100" => "100", "200" => "200", "2000" => "ทั้งหมด");
$page =  ($_REQUEST['page'] == "") ? 1 : $_REQUEST['page'];
$goto = ($page_size * ($page - 1));
/*echo $goto.'==='.$page.'=='.$page_size;
	echo '<pre>';
	print_r($_REQUEST);
	echo '</pre>';*/
function startPaging($form, $total_record)
{
	global $default, $arrPage, $page, $page_size;

	$page_size = ($page_size == "") ? $default : $page_size;

	$total_page = ceil($total_record / $page_size);

	$max_page = ($total_page > 4) ? 4 : $total_page;

	$start_page = ($page == "") ? 1 : $page - 2;
	$start_page = ($start_page <= 0) ? 1 : $start_page;

	$end_page = ($max_page + $start_page);
	$end_page = ($end_page > $total_page) ? $total_page : $end_page;

	$start_page = (($end_page - $start_page) < 4) ? $end_page - 4 : $start_page;
	$start_page = ($start_page <= 0) ? 1 : $start_page;

	$startClass = ($page == 1) ? " class=\"disabled\" " : "";
	$endClass = ($page == $total_page) ? " class=\"disabled\" " : "";

	$html = "<div class=\"col-xs-6 col-sm-6 hidden-md hidden-lg\">
            	<div style=\"height:80px; display:table-cell; vertical-align:middle;\">
                    <div class=\"input-group\">
                      <span class=\"input-group-btn\">
                          <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                            แสดง " . $arrPage[$page_size] . " <span class=\"caret\"></span>
                          </button>
                          <ul class=\"dropdown-menu\" role=\"menu\">";
	foreach ($arrPage as $key => $val) {
		$html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#page_size').val('" . $key . "'); $('#page').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">แสดง " . $val . "</a></li>";
	}
	$html .= "</ul>
                      </span>
                      <span class=\"input-group-addon\"> / หน้า จำนวน " . $total_record . " รายการ</span>
                    </div>
                </div>
            </div>
            <div class=\"col-xs-6 col-sm-6 hidden-xs hidden-sm hidden-md hidden-lg\">
                <ul class=\"pagination pull-right\">";
	if ($page == 1) {
		$html .= "<li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&laquo;</a></li>
                  <li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&#8249;</a></li>";
	} else {
		$html .= "<li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#page').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&laquo;</a></li>
                  <li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#page').val('" . ($page - 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8249;</a></li>";
	}
	for ($i = $start_page; $i <= $end_page; $i++) {
		$active = ($i == $page) ? " class=\"active\" " : "";
		$html .= "<li $active ><a href=\"javascript:void(0);\" onclick=\"$('#page').val('" . ($i) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">" . $i . "</a></li>";
	}
	if ($page == $total_page) {
		$html .= "<li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&#8250;</a></li>
					  <li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&raquo;</a></li>";
	} else {
		$html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#page').val('" . ($page + 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8250;</a></li>
					  <li><a href=\"javascript:void(0);\" onclick=\"$('#page').val('" . $total_page . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&raquo;</a></li>";
	}
	$html .= "</ul>
            </div>";

	return $html;
}

function endPaging($form, $total_record)
{

	global $default, $arrPage, $page, $page_size;
	$page_size = ($page_size == "") ? $default : $page_size;

	$total_page = ceil($total_record / $page_size);

	$max_page = ($total_page > 4) ? 4 : $total_page;

	$start_page = ($page == "") ? 1 : $page - 2;
	$start_page = ($start_page <= 0) ? 1 : $start_page;

	$end_page = ($max_page + $start_page);
	$end_page = ($end_page > $total_page) ? $total_page : $end_page;

	$start_page = (($end_page - $start_page) < 4) ? $end_page - 4 : $start_page;
	$start_page = ($start_page <= 0) ? 1 : $start_page;

	$startClass = ($page == 1) ? " class=\"disabled\" " : "";
	$endClass = ($page == $total_page) ? " class=\"disabled\" " : "";
	/* echo "total_record" . $total_record . "<br>";
	echo "page_size" . $page_size . "<br>";
	echo "total_page" . $total_page . "<br>";
	echo "max_page" . $max_page . "<br>";
	echo "start_page" . $start_page . "<br>";
	echo "end_page" . $end_page . "<br>"; */
	$html = "<div class=\"col-sm-6 hidden-xs\">
            	<div style=\"height:80px; display:table-cell; vertical-align:middle;\">
                    <div class=\"input-group\">
					<label for=\"\">จำนวน " . $total_record . " รายการ</label>
                    </div>
                </div>
            </div>
            <div class=\"col-xs-12 col-sm-6\">
                <ul class=\"pagination pull-right\">";
	if ($page == 1) {
		$html .= "<li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&laquo;</a></li>
					  <li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&#8249;</a></li>";
	} else {
		$html .= "<li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#page').val('1'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&laquo;</a></li>
					  <li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#page').val('" . ($page - 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8249;</a></li>";
	}
	for ($i = $start_page; $i <= $end_page; $i++) {
		$active = ($i == $page) ? " class=\"active\" " : "";
		$html .= "<li $active ><a href=\"javascript:void(0);\" onclick=\"$('#page').val('" . ($i) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">" . $i . "</a></li>";
	}
	if ($page == $total_page) {
		$html .= "<li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&#8250;</a></li>
					  <li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&raquo;</a></li>";
	} else {
		$html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#page').val('" . ($page + 1) . "'); $('#" . $form . "').attr('target','').attr('action','').submit();\">&#8250;</a></li>
					  <li><a href=\"javascript:void(0);\" onclick=\"$('#page').val('" . $total_page . "'); $('#" . $form . "').submit();\">&raquo;</a></li>";
	}
	$html .= "</ul>
            </div>";
	/* $html1 = "<div class=\"col-sm-6 hidden-xs\">
            	<div style=\"height:80px; display:table-cell; vertical-align:middle;\">
                    <div class=\"input-group\">
                      <span class=\"input-group-btn\">
                          <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                            แสดง ".$arrPage[$page_size]." <span class=\"caret\"></span>
                          </button>
                          <ul class=\"dropdown-menu\" role=\"menu\">";
						  foreach($arrPage as $key => $val){
						  	$html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#page_size').val('".$key."'); $('#page').val('1'); $('#".$form."').attr('target','').attr('action','').submit();\">แสดง ".$val."</a></li>";
						  }
                          $html .= "</ul>
                      </span>
                      <span class=\"input-group-addon\"> / หน้า จำนวน ".$total_record." รายการ</span>
                    </div>
                </div>
            </div>
            <div class=\"col-xs-12 col-sm-6\">
                <ul class=\"pagination pull-right\">";
                  if($page == 1){
					  $html .= "<li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&laquo;</a></li>
					  <li $startClass ><a href=\"javascript:void(0);\" style=\"cursor:default\" >&#8249;</a></li>";
					}else{
						$html .= "<li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#page').val('1'); $('#".$form."').attr('target','').attr('action','').submit();\">&laquo;</a></li>
					  <li $startClass ><a href=\"javascript:void(0);\" onclick=\"$('#page').val('".($page-1)."'); $('#".$form."').attr('target','').attr('action','').submit();\">&#8249;</a></li>";
					}
				  for($i=$start_page;$i<=$end_page;$i++){
					  	$active = ($i == $page) ? " class=\"active\" ":"";
				  	$html .= "<li $active ><a href=\"javascript:void(0);\" onclick=\"$('#page').val('".($i)."'); $('#".$form."').attr('target','').attr('action','').submit();\">".$i."</a></li>";
				  }
                  if($page == $total_page){
					  $html .= "<li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&#8250;</a></li>
					  <li $endClass ><a href=\"javascript:void(0);\" style=\"cursor:default\">&raquo;</a></li>";
				  }else{
					  $html .= "<li><a href=\"javascript:void(0);\" onclick=\"$('#page').val('".($page+1)."'); $('#".$form."').attr('target','').attr('action','').submit();\">&#8250;</a></li>
					  <li><a href=\"javascript:void(0);\" onclick=\"$('#page').val('".$total_page."'); $('#".$form."').submit();\">&raquo;</a></li>";
				  }
                $html .= "</ul>
            </div>"; */

	return $html;
}
