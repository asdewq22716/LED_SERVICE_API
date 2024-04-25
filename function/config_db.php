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


?>
