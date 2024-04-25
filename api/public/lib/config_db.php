<?php
db::setHost('103.208.27.224');
db::setUser('led_service_api');
db::setPassword('ledserviceapi4321');
db::setDBName('led_service_api');
db::setDBType('Oracle');
db::setAutoIncrement("N");
db::setLangDate('EN');
db::setRunType('DEV'); //LIVE,DEV
 ini_set('display_errors', 0);

db::setupDatabase();
?>