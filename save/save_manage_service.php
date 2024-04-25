<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';

$FORM_ID = $_POST['FORM_ID'];
$ORG_ID = $_POST['ORG_ID'];

switch ($FORM_ID) {
    case 'detailOrg':
        $W = 52;
        $insert_wf = array();
        $insert_wf = bsf_save_form($W, '', $WFR, 'M', $insert_wf, 'Y', $WFS);
        if (!$ORG_ID) {
            $pk = db::db_insert('M_SYSTEM', $insert_wf, 'SYSTEM_ID', 'SYSTEM_ID');
            $txt['result'] = 'success';
            $txt['orgId'] = $pk;
        } else {
            db::db_update('M_SYSTEM', $insert_wf, array('SYSTEM_ID' => $ORG_ID));
        }
        break;
    case 'adminOrg':
        $W = 97;
        $insert_wf = array();
        $insert_wf = bsf_save_form($W, '', $WFR, 'M', $insert_wf, 'Y', $WFS);

        if (!$_POST['USR_ID']) {
            $pk = db::db_insert('USER_API_SERVICE', $insert_wf, 'USR_ID', 'USR_ID');
            $txt['result'] = 'success';
            $txt['usrId'] = $pk;
        } else {
            if (trim($_POST['USR_PASSWORD']) == '') {
                $sql = db::query("SELECT USR_PASSWORD FROM  USER_API_SERVICE WHERE USR_ID = '" . $_POST['USR_ID'] . "'");
                $data_sql = db::fetch_array($sql);
                $insert_wf['USR_PASSWORD'] = $data_sql['USR_PASSWORD'];
            }
            db::db_update("USER_API_SERVICE", $insert_wf, array('USR_ID' => $_POST['USR_ID']));
            $txt['result'] = 'success';
        }
        break;
    case 'apiOrg':

        $tbServiceMappingApiTemp = 'SERVICE_MAPPING_GROUP';
        $cond = array(
            'PRIVILEGE_GROUP_ID' => $ORG_ID,
        );
        db::db_delete($tbServiceMappingApiTemp, $cond);

        $arrApiSetting = array();

        $sqlApiSetting = "SELECT API_SETTING_ID,SERVICE_ID FROM M_API_SETTING WHERE 1=1 ";
        $qryApiSetting = db::query($sqlApiSetting);
        while ($recApiSetting = db::fetch_assoc($qryApiSetting)) {
            $arrApiSetting[$recApiSetting['API_SETTING_ID']] = $recApiSetting['SERVICE_ID'];
        }

        // จากหน้าเมนู mapping จัดการสิิทธิ
        foreach ($_POST['chk_set'] as $key => $value) {
            $feild = [];
            $feild['MAPPING_STATUS'] = 1;
            $feild['SERVICE_MANAGE_ID'] = $arrApiSetting[$value];
            $feild['PRIVILEGE_GROUP_ID'] = $ORG_ID;
            $feild['API_SETTING_ID'] = $value;
            db::db_insert($tbServiceMappingApiTemp, $feild);
        }
        $txt['result'] = 'success';

        break;

    case 'temp_api':

        $tbServiceMappingApiTemp = 'SERVICE_MAPPING_GROUP';

        if ($_POST['SERVICE_LIST'] != '') {

            $sqlNowService = "SELECT API_SETTING_ID FROM $tbServiceMappingApiTemp WHERE PRIVILEGE_GROUP_ID = '$ORG_ID' ";
            $qryNowService = db::query($sqlNowService);
            $arrNowService = array();
            while ($rec = db::fetch_array($qryNowService)) {
                $arrNowService[$rec['API_SETTING_ID']] = $rec['API_SETTING_ID'];
            }

            $arrApiSetting = array();

            $sqlApiSetting = "SELECT API_SETTING_ID,SERVICE_ID FROM M_API_SETTING WHERE 1=1 ";
            $qryApiSetting = db::query($sqlApiSetting);
            while ($recApiSetting = db::fetch_assoc($qryApiSetting)) {
                $arrApiSetting[$recApiSetting['API_SETTING_ID']] = $recApiSetting['SERVICE_ID'];
            }

            // จากหน้าเมนู mapping จัดการสิิทธิ

            foreach ($_POST['SERVICE_LIST'] as $key => $value) {


                $sqlTemp = db::query("SELECT * FROM SERVICE_MAPPING_API_TEMP WHERE PRIVILEGE_GROUP_ID = '$value' ");
                while ($rec = db::fetch_array($sqlTemp)) {
                    $feild = [];
                    $feild['MAPPING_STATUS'] = 1;
                    $feild['SERVICE_MANAGE_ID'] = $arrApiSetting[$rec['API_SETTING_ID']];
                    $feild['PRIVILEGE_GROUP_ID'] = $ORG_ID;
                    $feild['API_SETTING_ID'] = $rec['API_SETTING_ID'];
                    if (!$arrNowService[$rec['API_SETTING_ID']]) {
                        db::db_insert($tbServiceMappingApiTemp, $feild);
                        $arrNowService[$rec['API_SETTING_ID']] = $rec['API_SETTING_ID'];
                    }
                }
            }
        }
        break;

    case 'delTempApi':

        $tbServiceMappingApiTemp = 'SERVICE_MAPPING_GROUP';

        $cond = array(
            'PRIVILEGE_GROUP_ID' => $ORG_ID,
        );
        db::db_delete($tbServiceMappingApiTemp, $cond);
        break;
}

echo json_encode($txt);
