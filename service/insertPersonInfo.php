<?php
include '../include/include.php';

$str_json = file_get_contents("php://input");
$data = json_decode($str_json, true);

if ($data['userName'] == "BankruptDt" && $data['passWord'] == "Debtor4321")
{

    if ($data['registerCode'])
    {
        $plaintiff_Id = str_replace("-", "", $data['registerCode']);
        // $defendant_Id = str_replace("-", "", $data['registerCode']);
    }
    $brcId = $data['brcId'];

    unset($form_field);
    $form_field['userName'] = 'BankruptDt';
    $form_field['passWord'] = 'Debtor4321';
    $form_field['brcId'] = $brcId;
    $data_string = json_encode($form_field);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://103.40.146.180/api/public/CheckCase',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ) ,
    ));

    $response = curl_exec($curl);

    $resBrc = json_decode($response, true);
    $dataBrc = $resBrc['data']['Data'][0];
    curl_close($curl);

    if ($plaintiff_Id)
    {

        unset($form_field);
        $form_field['userName'] = 'BankruptDt';
        $form_field['passWord'] = 'Debtor4321';
        $form_field['registerCode'] = $plaintiff_Id;
        $data_string = json_encode($form_field);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/verifyPerson.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ) ,
        ));

        $response = curl_exec($curl);

        $res = json_decode($response, true);
        // print_pre($res);
        curl_close($curl);

        if ($res['ResponseCode']['ResCode'] == '000')
        {
            $res_data = $res['Data'];
            foreach ($res_data as $key => $value)
            {
                if (($dataBrc['prefixBlackCase'] != $value['prefixBlackCase'] || $dataBrc['blackCase'] != $value['blackCase'] || $dataBrc['blackYY'] != $value['blackYy']) || ($dataBrc['prefixRedCase'] != $value['prefixRedCase'] || $dataBrc['redCase'] != $value['redCase'] || $dataBrc['redYY'] != $value['redYy']))
                {
                    if ($value['systemType'] == "Revive")
                    {
                        $sql_rev = db::query("SELECT * FROM M_PERSONAL_INFO_CASE WHERE REPLACE(REGISTERCODE,'-','') = '" . $value['registerCode'] . "' AND ((T_NO_BLACK = '" . $value['prefixBlackCase'] . "' AND NO_BLACK_CASE = '" . $value['blackCase'] . "' AND BLACK_YEAR = '" . $value['blackYy'] . "')
                                OR (T_NO_RED = '" . $value['prefixRedCase'] . "' AND NO_RED_CASE = '" . $value['redCase'] . "' AND RED_YEAR = '" . $value['redYy'] . "')) AND COURT_NAME = '" . $value['courtName'] . "'  AND F_NAME = '" . $value['fullName'] . "'");
                        $rec_rev = db::fetch_array($sql_rev);
                        $chk_rev = db::num_rows($sql_rev);
                        if ($chk_rev < 1)
                        {
                            unset($revive_plain);
                            if ($plaintiff_Id)
                            {
                                $revive_plain['REGISTERCODE'] = $plaintiff_Id;
                            }
                            $revive_plain['F_NAME'] = $value['fullName'];
                            $revive_plain['CONERNNAME'] = $value['concernName'];
                            $revive_plain['T_NO_BLACK'] = $value['prefixBlackCase'];
                            $revive_plain['NO_BLACK_CASE'] = $value['blackCase'];
                            $revive_plain['BLACK_YEAR'] = $value['blackYy'];
                            $revive_plain['T_NO_RED'] = $value['prefixRedCase'];
                            $revive_plain['NO_RED_CASE'] = $value['redCase'];
                            $revive_plain['RED_YEAR'] = $value['redYy'];
                            $revive_plain['SYSTEM_TYPE'] = $value['systemType'];
                            $revive_plain['COURT_NAME'] = $value['courtName'];
                            $revive_plain['WFR_ID'] = $WFR;
                            $revive_plain['PERSON_TYPE_RE'] = "โจทก์/เจ้าหนี้";
                            $revive_plain['ADDRESS'] = $value['address'];
                            $revive_plain['BRC_ID'] = $brcId;
							$revive_plain['ORDER_STATUS'] = $value['orderStatus'];
							$revive_plain['PERSON_TYPE_CODE'] = $value['personType'];

                            $personal_Id = db::db_insert("M_PERSONAL_INFO_CASE", $revive_plain, "PERSONAL_ID", "PERSONAL_ID");
                        }
                        else
                        {
                            $personal_Id = $rec_rev['PERSONAL_ID'];
                        }
                    }
                    if ($value['systemType'] == "Mediate")
                    {
                        $sql_med = db::query("SELECT * FROM M_PERSONAL_INFO_CASE WHERE REPLACE(REGISTERCODE,'-','') = '" . $value['registerCode'] . "' AND ((T_NO_BLACK = '" . $value['prefixBlackCase'] . "' AND NO_BLACK_CASE = '" . $value['blackCase'] . "' AND BLACK_YEAR = '" . $value['blackYy'] . "')
                                OR (T_NO_RED = '" . $value['prefixRedCase'] . "' AND NO_RED_CASE = '" . $value['redCase'] . "' AND RED_YEAR = '" . $value['redYy'] . "')) AND COURT_NAME = '" . $value['courtName'] . "'  AND F_NAME = '" . $value['fullName'] . "'");
                        $rec_med = db::fetch_array($sql_med);
                        $chk_med = db::num_rows($sql_med);
                        if ($chk_med < 1)
                        {
                            unset($mediate_plain);
                            if ($plaintiff_Id)
                            {
                                $mediate_plain['REGISTERCODE'] = $plaintiff_Id;
                            }
                            $mediate_plain['F_NAME'] = $value['fullName'];
                            $mediate_plain['CONERNNAME'] = $value['concernName'];
                            $mediate_plain['T_NO_BLACK'] = $value['prefixBlackCase'];
                            $mediate_plain['NO_BLACK_CASE'] = $value['blackCase'];
                            $mediate_plain['BLACK_YEAR'] = $value['blackYy'];
                            $mediate_plain['T_NO_RED'] = $value['prefixRedCase'];
                            $mediate_plain['NO_RED_CASE'] = $value['redCase'];
                            $mediate_plain['RED_YEAR'] = $value['redYy'];
                            $mediate_plain['SYSTEM_TYPE'] = $value['systemType'];
                            $mediate_plain['COURT_NAME'] = $value['courtName'];
                            $mediate_plain['WFR_ID'] = $WFR;
                            $mediate_plain['PERSON_TYPE_RE'] = "โจทก์/เจ้าหนี้";
                            $mediate_plain['ADDRESS'] = $value['address'];
                            $mediate_plain['BRC_ID'] = $brcId;
							$mediate_plain['ORDER_STATUS'] = $value['orderStatus'];
							$mediate_plain['PERSON_TYPE_CODE'] = $value['personType'];

                            db::db_insert("M_PERSONAL_INFO_CASE", $mediate_plain, "PERSONAL_ID");
                        }
                    }
                    if ($value['systemType'] == "Civil")
                    {
                        $sql_cil = db::query("SELECT * FROM M_PERSONAL_INFO_CASE WHERE REPLACE(REGISTERCODE,'-','') = '" . $value['registerCode'] . "' AND ((T_NO_BLACK = '" . $value['prefixBlackCase'] . "' AND NO_BLACK_CASE = '" . $value['blackCase'] . "' AND BLACK_YEAR = '" . $value['blackYy'] . "')
                                OR (T_NO_RED = '" . $value['prefixRedCase'] . "' AND NO_RED_CASE = '" . $value['redCase'] . "' AND RED_YEAR = '" . $value['redYy'] . "')) AND COURT_NAME = '" . $value['courtName'] . "' AND F_NAME = '" . $value['fullName'] . "'");
                        $rec_cil = db::fetch_array($sql_cil);
                        $chk_cil = db::num_rows($sql_cil);
                        if ($chk_cil < 1)
                        {
                            unset($civil_plain);
                            if ($plaintiff_Id)
                            {
                                $civil_plain['REGISTERCODE'] = $plaintiff_Id;
                            }
                            $civil_plain['F_NAME'] = $value['fullName'];
                            $civil_plain['T_NO_BLACK'] = $value['prefixBlackCase'];
                            $civil_plain['NO_BLACK_CASE'] = $value['blackCase'];
                            $civil_plain['BLACK_YEAR'] = $value['blackYy'];
                            $civil_plain['T_NO_RED'] = $value['prefixRedCase'];
                            $civil_plain['NO_RED_CASE'] = $value['redCase'];
                            $civil_plain['RED_YEAR'] = $value['redYy'];
                            $civil_plain['SYSTEM_TYPE'] = $value['systemType'];
                            $civil_plain['COURT_NAME'] = $value['courtName'];
                            $civil_plain['CONERNNAME'] = $value['concernName'];
                            $civil_plain['WFR_ID'] = $WFR;
                            $civil_plain['PERSON_TYPE_RE'] = "โจทก์/เจ้าหนี้";
                            $civil_plain['ADDRESS'] = $value['address'];
                            $civil_plain['BRC_ID'] = $brcId;
							$civil_plain['ORDER_STATUS'] = $value['orderStatus'];
							$civil_plain['PERSON_TYPE_CODE'] = $value['personType'];

                            db::db_insert("M_PERSONAL_INFO_CASE", $civil_plain, "PERSONAL_ID");
                        }
                        else
                        {
                            if (strstr($rec_cil['CONERNNAME'], $value['concernName']) === false)
                            {
                                unset($update);
                                $update['CONERNNAME'] = $rec_cil['CONERNNAME'] . "/" . $value['concernName'];
                                $cond['PERSONAL_ID'] = $rec_cil['PERSONAL_ID'];

                                db::db_update("M_PERSONAL_INFO_CASE", $update, $cond);
                            }
                        }
                    }
                    if ($value['systemType'] == "Bankrupt")
                    {
                        $sql_bank = db::query("SELECT * FROM M_PERSONAL_INFO_CASE WHERE REPLACE(REGISTERCODE,'-','') = '" . $value['registerCode'] . "' AND ((T_NO_BLACK = '" . $value['prefixBlackCase'] . "' AND NO_BLACK_CASE = '" . $value['blackCase'] . "' AND BLACK_YEAR = '" . $value['blackYy'] . "')
                                OR (T_NO_RED = '" . $value['prefixRedCase'] . "' AND NO_RED_CASE = '" . $value['redCase'] . "' AND RED_YEAR = '" . $value['redYy'] . "')) AND COURT_NAME = '" . $value['courtName'] . "' AND F_NAME = '" . $value['fullName'] . "'");
                        $rec_bank = db::fetch_array($sql_bank);
                        $chk_bank = db::num_rows($sql_bank);
                        if ($chk_bank < 1)
                        {
                            unset($bankrupt_plain);
                            if ($plaintiff_Id)
                            {
                                $bankrupt_plain['REGISTERCODE'] = $plaintiff_Id;
                            }
                            if ($_POST['PLAINTIFF_LP_NUMBER'])
                            {
                                $bankrupt_plain['REGISTERCODE'] = $_POST['PLAINTIFF_LP_NUMBER'];
                            }
                            $bankrupt_plain['F_NAME'] = $value['fullName'];
                            $bankrupt_plain['T_NO_BLACK'] = $value['prefixBlackCase'];
                            $bankrupt_plain['NO_BLACK_CASE'] = $value['blackCase'];
                            $bankrupt_plain['BLACK_YEAR'] = $value['blackYy'];
                            $bankrupt_plain['T_NO_RED'] = $value['prefixRedCase'];
                            $bankrupt_plain['NO_RED_CASE'] = $value['redCase'];
                            $bankrupt_plain['RED_YEAR'] = $value['redYy'];
                            $bankrupt_plain['SYSTEM_TYPE'] = $value['systemType'];
                            $bankrupt_plain['COURT_NAME'] = $value['courtName'];
                            $bankrupt_plain['WFR_ID'] = $WFR;
                            $bankrupt_plain['PERSON_TYPE_RE'] = "โจทก์/เจ้าหนี้";
                            $bankrupt_plain['ADDRESS'] = $value['address'];
                            $bankrupt_plain['CONERNNAME'] = $value['concernName'];
                            $bankrupt_plain['BRC_ID'] = $brcId;
							$bankrupt_plain['ORDER_STATUS'] = $value['orderStatus'];
							$bankrupt_plain['PERSON_TYPE_CODE'] = $value['personType'];
                            $personal_Id = db::db_insert("M_PERSONAL_INFO_CASE", $bankrupt_plain, "PERSONAL_ID", "PERSONAL_ID");
                        }
                        else
                        {
                            if (strstr($rec_bank['CONERNNAME'], $value['concernName']) === false)
                            {
                                unset($update);
                                $update['CONERNNAME'] = $rec_bank['CONERNNAME'] . "/" . $value['concernName'];
                                $personal_Id = $cond['PERSONAL_ID'] = $rec_bank['PERSONAL_ID'];

                                db::db_update("M_PERSONAL_INFO_CASE", $update, $cond);
                            }
                            else
                            {
                                $personal_Id = $rec_bank['PERSONAL_ID'];
                            }
                        }
                    }
                }
            }
        }
    }

    /* if ($defendant_Id)
    {

        unset($form_field);
        $form_field['userName'] = 'BankruptDt';
        $form_field['passWord'] = 'Debtor4321';
        $form_field['registerCode'] = $defendant_Id;
        $data_string = json_encode($form_field);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/verifyPerson.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ) ,
        ));

        $response = curl_exec($curl);

        $res = json_decode($response, true);
        // print_pre($res);
        curl_close($curl);

        if ($res['ResponseCode']['ResCode'] == '000')
        {
            $res_data = $res['Data'];
            foreach ($res_data as $key => $value)
            {
                if (($dataBrc['prefixBlackCase'] != $value['prefixBlackCase'] || $dataBrc['blackCase'] != $value['blackCase'] || $dataBrc['blackYY'] != $value['blackYy']) || ($dataBrc['prefixRedCase'] != $value['prefixRedCase'] || $dataBrc['redCase'] != $value['redCase'] || $dataBrc['redYY'] != $value['redYy']))
                {
                    if ($value['systemType'] == "Revive")
                    {
                        $sql_rev = db::query("SELECT * FROM M_PERSONAL_INFO_CASE WHERE REPLACE(REGISTERCODE,'-','') = '" . $value['registerCode'] . "' AND ((T_NO_BLACK = '" . $value['prefixBlackCase'] . "' AND NO_BLACK_CASE = '" . $value['blackCase'] . "' AND BLACK_YEAR = '" . $value['blackYy'] . "')
                                OR (T_NO_RED = '" . $value['prefixRedCase'] . "' AND NO_RED_CASE = '" . $value['redCase'] . "' AND RED_YEAR = '" . $value['redYy'] . "')) AND COURT_NAME = '" . $value['courtName'] . "' AND F_NAME = '" . $value['fullName'] . "'");
                        $rec_rev = db::fetch_array($sql_rev);
                        $chk_rev = db::num_rows($sql_rev);
                        if ($chk_rev < 1)
                        {
                            unset($revive_defen);
                            if ($defendant_Id)
                            {
                                $revive_defen['REGISTERCODE'] = $defendant_Id;
                            }
                            $revive_defen['F_NAME'] = $value['fullName'];
                            $revive_defen['CONERNNAME'] = $value['concernName'];
                            $revive_defen['T_NO_BLACK'] = $value['prefixBlackCase'];
                            $revive_defen['NO_BLACK_CASE'] = $value['blackCase'];
                            $revive_defen['BLACK_YEAR'] = $value['blackYy'];
                            $revive_defen['T_NO_RED'] = $value['prefixRedCase'];
                            $revive_defen['NO_RED_CASE'] = $value['redCase'];
                            $revive_defen['RED_YEAR'] = $value['redYy'];
                            $revive_defen['SYSTEM_TYPE'] = $value['systemType'];
                            $revive_defen['COURT_NAME'] = $value['courtName'];
                            $revive_defen['WFR_ID'] = $WFR;
                            $revive_defen['PERSON_TYPE_RE'] = "จำเลย/ลูกหนี้";
                            $revive_defen['ADDRESS'] = $value['address'];
                            $revive_defen['BRC_ID'] = $brcId;
							$revive_defen['ORDER_STATUS'] = $value['orderStatus'];
							$revive_defen['PERSON_TYPE_CODE'] = $value['personType'];

                            $personal_Id = db::db_insert("M_PERSONAL_INFO_CASE", $revive_defen, "PERSONAL_ID", "PERSONAL_ID");
                        }
                        else
                        {
                            $personal_Id = $rec_rev['PERSONAL_ID'];
                        }
                    }
                    if ($value['systemType'] == "Mediate")
                    {
                        $sql_med = db::query("SELECT * FROM M_PERSONAL_INFO_CASE WHERE REPLACE(REGISTERCODE,'-','') = '" . $value['registerCode'] . "' AND ((T_NO_BLACK = '" . $value['prefixBlackCase'] . "' AND NO_BLACK_CASE = '" . $value['blackCase'] . "' AND BLACK_YEAR = '" . $value['blackYy'] . "')
                                OR (T_NO_RED = '" . $value['prefixRedCase'] . "' AND NO_RED_CASE = '" . $value['redCase'] . "' AND RED_YEAR = '" . $value['redYy'] . "')) AND COURT_NAME = '" . $value['courtName'] . "' AND F_NAME = '" . $value['fullName'] . "'");
                        $rec_med = db::fetch_array($sql_med);
                        $chk_med = db::num_rows($sql_med);
                        if ($chk_med < 1)
                        {
                            unset($mediate_defen);
                            if ($defendant_Id)
                            {
                                $mediate_defen['REGISTERCODE'] = $defendant_Id;
                            }
                            $mediate_defen['F_NAME'] = $value['fullName'];
                            $mediate_defen['CONERNNAME'] = $value['concernName'];
                            $mediate_defen['T_NO_BLACK'] = $value['prefixBlackCase'];
                            $mediate_defen['NO_BLACK_CASE'] = $value['blackCase'];
                            $mediate_defen['BLACK_YEAR'] = $value['blackYy'];
                            $mediate_defen['T_NO_RED'] = $value['prefixRedCase'];
                            $mediate_defen['NO_RED_CASE'] = $value['redCase'];
                            $mediate_defen['RED_YEAR'] = $value['redYy'];
                            $mediate_defen['SYSTEM_TYPE'] = $value['systemType'];
                            $mediate_defen['COURT_NAME'] = $value['courtName'];
                            $mediate_defen['WFR_ID'] = $WFR;
                            $mediate_defen['PERSON_TYPE_RE'] = "จำเลย/ลูกหนี้";
                            $mediate_defen['ADDRESS'] = $value['address'];
                            $mediate_defen['BRC_ID'] = $brcId;
							$mediate_defen['ORDER_STATUS'] = $value['orderStatus'];
							$mediate_defen['PERSON_TYPE_CODE'] = $value['personType'];

                            db::db_insert("M_PERSONAL_INFO_CASE", $mediate_defen, "PERSONAL_ID");
                        }
                    }
                    if ($value['systemType'] == "Civil")
                    {
                        $sql_cil = db::query("SELECT * FROM M_PERSONAL_INFO_CASE WHERE REPLACE(REGISTERCODE,'-','') = '" . $value['registerCode'] . "' AND ((T_NO_BLACK = '" . $value['prefixBlackCase'] . "' AND NO_BLACK_CASE = '" . $value['blackCase'] . "' AND BLACK_YEAR = '" . $value['blackYy'] . "')
                                OR (T_NO_RED = '" . $value['prefixRedCase'] . "' AND NO_RED_CASE = '" . $value['redCase'] . "' AND RED_YEAR = '" . $value['redYy'] . "')) AND COURT_NAME = '" . $value['courtName'] . "' AND F_NAME = '" . $value['fullName'] . "'");
                        $rec_cil = db::fetch_array($sql_cil);
                        $chk_cil = db::num_rows($sql_cil);
                        if ($chk_cil < 1)
                        {
                            unset($civil_defen);
                            if ($defendant_Id)
                            {
                                $civil_defen['REGISTERCODE'] = $defendant_Id;
                            }
                            $civil_defen['F_NAME'] = $value['fullName'];
                            $civil_defen['CONERNNAME'] = $value['concernName'];
                            $civil_defen['T_NO_BLACK'] = $value['prefixBlackCase'];
                            $civil_defen['NO_BLACK_CASE'] = $value['blackCase'];
                            $civil_defen['BLACK_YEAR'] = $value['blackYy'];
                            $civil_defen['T_NO_RED'] = $value['prefixRedCase'];
                            $civil_defen['NO_RED_CASE'] = $value['redCase'];
                            $civil_defen['RED_YEAR'] = $value['redYy'];
                            $civil_defen['SYSTEM_TYPE'] = $value['systemType'];
                            $civil_defen['COURT_NAME'] = $value['courtName'];
                            $civil_defen['WFR_ID'] = $WFR;
                            $civil_defen['PERSON_TYPE_RE'] = "จำเลย/ลูกหนี้";
                            $civil_defen['ADDRESS'] = $value['address'];
                            $civil_defen['BRC_ID'] = $brcId;
							$civil_defen['ORDER_STATUS'] = $value['orderStatus'];
							$civil_defen['PERSON_TYPE_CODE'] = $value['personType'];

                            db::db_insert("M_PERSONAL_INFO_CASE", $civil_defen, "PERSONAL_ID");
                        }
                        else
                        {
                            if ($rec_cil['CONERNNAME'] != $value['concernName'])
                            {
                                unset($update);
                                $update['CONERNNAME'] = $rec_cil['CONERNNAME'] . "/" . $value['concernName'];
                                $cond['PERSONAL_ID'] = $rec_cil['PERSONAL_ID'];

                                db::db_update("M_PERSONAL_INFO_CASE", $update, $cond);
                            }
                        }
                    }
                    if ($value['systemType'] == "Bankrupt")
                    {
                        $sql_bank = db::query("SELECT * FROM M_PERSONAL_INFO_CASE WHERE REPLACE(REGISTERCODE,'-','') = '" . $value['registerCode'] . "' AND ((T_NO_BLACK = '" . $value['prefixBlackCase'] . "' AND NO_BLACK_CASE = '" . $value['blackCase'] . "' AND BLACK_YEAR = '" . $value['blackYy'] . "')
                                OR (T_NO_RED = '" . $value['prefixRedCase'] . "' AND NO_RED_CASE = '" . $value['redCase'] . "' AND RED_YEAR = '" . $value['redYy'] . "')) AND COURT_NAME = '" . $value['courtName'] . "' AND F_NAME = '" . $value['fullName'] . "'");
                        $rec_bank = db::fetch_array($sql_bank);
                        $chk_bank = db::num_rows($sql_bank);
                        if ($chk_bank < 1)
                        {
                            unset($bankrupt_defen);
                            if ($defendant_Id)
                            {
                                $bankrupt_defen['REGISTERCODE'] = $defendant_Id;
                            }
                            $bankrupt_defen['F_NAME'] = $value['fullName'];
                            $bankrupt_defen['CONERNNAME'] = $value['concernName'];
                            $bankrupt_defen['T_NO_BLACK'] = $value['prefixBlackCase'];
                            $bankrupt_defen['NO_BLACK_CASE'] = $value['blackCase'];
                            $bankrupt_defen['BLACK_YEAR'] = $value['blackYy'];
                            $bankrupt_defen['T_NO_RED'] = $value['prefixRedCase'];
                            $bankrupt_defen['NO_RED_CASE'] = $value['redCase'];
                            $bankrupt_defen['RED_YEAR'] = $value['redYy'];
                            $bankrupt_defen['SYSTEM_TYPE'] = $value['systemType'];
                            $bankrupt_defen['COURT_NAME'] = $value['courtName'];
                            $bankrupt_defen['WFR_ID'] = $WFR;
                            $bankrupt_defen['PERSON_TYPE_RE'] = "จำเลย/ลูกหนี้";
                            $bankrupt_defen['ADDRESS'] = $value['address'];
                            $bankrupt_defen['CONERNNAME'] = $value['concernName'];
                            $bankrupt_defen['BRC_ID'] = $brcId;
                            $bankrupt_defen['BANKRUPT_CODE'] = $value['bankruptCode'];
							$bankrupt_defen['ORDER_STATUS'] = $value['orderStatus'];
							$bankrupt_defen['PERSON_TYPE_CODE'] = $value['personType'];

                            $personal_Id = db::db_insert("M_PERSONAL_INFO_CASE", $bankrupt_defen, "PERSONAL_ID", "PERSONAL_ID");
                        }
                        else
                        {
                            if (strstr($rec_bank['CONERNNAME'], $value['concernName']) === false)
                            {
                                unset($update);
                                $update['CONERNNAME'] = $rec_bank['CONERNNAME'] . "/" . $value['concernName'];
                                $personal_Id = $cond['PERSONAL_ID'] = $rec_bank['PERSONAL_ID'];

                                db::db_update("M_PERSONAL_INFO_CASE", $update, $cond);
                            }
                            else
                            {
                                $personal_Id = $rec_bank['PERSONAL_ID'];
                            }
                        }
                    }
                }
            }
        }
    } */

}

$row['ResponseCode'] = array(
    'ResCode' => '000',
    'ResMeassage' => "SUCCESS"
);

echo json_encode($row);
?>
