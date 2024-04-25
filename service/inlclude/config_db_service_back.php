<?php
db2::setHost('203.151.166.132');
db2::setUser('led_finance');
db2::setPassword('l#dfinance43210');
db2::setDBName('LED_PER');
db2::setDBType('MSSQL');
db2::setAutoIncrement("N");
db2::setLangDate('EN');
db2::setRunType('DEV'); //LIVE,DEV

// db2::setHost('203.151.166.132');
// db2::setUser('backoffice');
// db2::setPassword('backoffice');
// db2::setDBName('LED_ERP');
// db2::setDBType('MSSQL');
// db2::setAutoIncrement("N");
// db2::setLangDate('EN');
// db2::setRunType('DEV'); //LIVE,DEV

db2::setupDatabase();
$WF_URL = "http://103.208.27.224/ega_led_mediate/";
$WF_LINE_CLIENT_ID = "f3sCDIwcbTcMLzhtgNJel3";
$WF_LINE_CLIENT_SECRET = "EH0YUMcrstZRylzjJqmR1eEY3gwQH0XCX1wqRxo9rnB";

?>
