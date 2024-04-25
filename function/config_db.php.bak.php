<?php
db::setHost('103.208.27.224');
db::setUser('led_service_api');
db::setPassword('ledserviceapi4321');
db::setDBName('led_service_api');
db::setDBType('Oracle');
db::setAutoIncrement("N");
db::setLangDate('EN');
db::setRunType('DEV'); //LIVE,DEV
db::setupDatabase();
$WF_URL = "http://103.208.27.224/led_service_api/";
$WF_LINE_CLIENT_ID = "f3sCDIwcbTcMLzhtgNJel3"; 
$WF_LINE_CLIENT_SECRET = "EH0YUMcrstZRylzjJqmR1eEY3gwQH0XCX1wqRxo9rnB";
$WF_BANKRUPT_CHACK_CASE_BY_ID = "http://103.40.146.73/LedServiceBankrupt.php/checkCaseByID";

$WF_GET_CIVIL = "http://103.40.146.73/LedServiceCivilById.php/getCivil";
$WF_GET_CIVIL_ROUTE = "http://103.40.146.73/LedServiceCivilById.php/getCivilRoute";
$WF_GET_CIVIL_TRANSACTION = "http://103.40.146.73/LedServiceCivilById.php/getCivilTransaction";
$WF_GET_CIVIL_EDOCUMENT = "http://103.40.146.73/LedServiceCivilById.php/getCivilEdocument";
$WF_GET_RECIEPT = "http://103.40.146.73/LedServiceCivilById.php/getReciept";
?>
