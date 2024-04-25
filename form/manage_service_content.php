<?php

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$W = $_POST['W'];
$orgId = $_POST['ORG_ID'];

switch ($W) {
    case 97:
        $html = '';
        ob_start();
        include 'admin_org_manage_service.php';
        $html .= ob_get_contents();
        ob_end_clean();
        break;
}

echo $html;
