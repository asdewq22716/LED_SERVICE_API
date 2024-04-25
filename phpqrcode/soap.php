<?php

$a_data = array(
  'getMeetingStatusRequest' => 'Y',
  'scheduledate' => '2011-01-18T00:00:00.000+07:00',
  'policyMessage' => array(
    'participant_name' => 'INVOCATOR',
    's_token' => 'MeetingStatusService',
    'app_token' => 'PORTAL',
    'policy_cmd' => 'getMeetingStatus'
  )
);

$client = new SoapClient("http://10.151.0.67:8003/soa-infra/services/default/MeetingDataProviderUnit/MeetingStatusService.wsdl");
$find = array("Language"=>"EN");
try {
	$res =$client->__call("MeetingStatusService", $a_data);
	}
catch (Exception $e)
	{
	echo "error";
	}

echo $res->getMeetingStatusResult;

$Stack=array();
$Product=array();
$Price=array();
$Date="";

function startElement($parser, $name, $attrs) 
	{
		global $Stack;
		array_push($Stack,trim($name));
	}

function endElement($parser, $name) 
	{
		global $Stack;
    	array_pop($Stack);
	}
	
function characterData($parser, $data) 
	{
	global $Stack;
	global $Date;
	global $Product;
	global $Price;
	switch($Stack[sizeof($Stack)-1])
		{
		case "PRICE_DATE" : 
			$Date = $data;
			break;
		case "PRODUCT" : 
			array_push($Product,$data);
			break;
		case "PRICE" :
			array_push($Price,$data); 
			break;	
		}
	}

$xml_parser = xml_parser_create();
xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, true);
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");
if (!xml_parse($xml_parser, $res->CurrentOilPriceResult, false)) 
	{
       die(sprintf("XML error: %s at line %d",
       xml_error_string(xml_get_error_code($xml_parser)),
       xml_get_current_line_number($xml_parser)));
	}
xml_parser_free($xml_parser);

?>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620"> 
<link href="style.css" rel="stylesheet" type="text/css">
<table bgcolor="#0066FF" cellpadding="1" cellspacing="1">
	<tr bgcolor="#999999"><td colspan="2" align="center">ราคาน้ำมัน ณ วันที่ <? echo$Date;?></td></tr>
	<tr align="center" bgcolor="#999999"><td>Type</td><td>Price</td></tr>
	<?
	for($i=0;$i < sizeof($Product);$i++)
		{
		?>
		<tr bgcolor="#FFFFFF"><td><?=iconv("UTF-8","TIS-620",$Product[$i]);?></td><td align="center"><?=$Price[$i];?></td></tr>
		<?
		}
	?>
</table>