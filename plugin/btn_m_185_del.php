<?php

$tbServiceMappingApiTemp = 'SERVICE_MAPPING_API_TEMP';

$cond = array(
    'PRIVILEGE_GROUP_ID' => $WFR,
);
db::db_delete($tbServiceMappingApiTemp, $cond);

?>