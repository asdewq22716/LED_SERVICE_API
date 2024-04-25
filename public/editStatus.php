<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 'On'); */

include '../include/comtop_user_N.php'; //connect db

include '../include/combottom_js_user.php'; //function 

include "../include/func_Nop.php";
include "../include/paging2.php";

include "./btn_function.php";

$path = "../";

foreach ($_GET as $key => $val) {
    $$key = conText($val);
}
foreach ($_POST as $key => $val) {
    $$key = conText($val);
}
/* echo "<br><br><br><br><br>";
echo "<pre>";
print_r($_POST);
echo "</pre>"; */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../include/template_user.php'; ?>
</head>


<div class="content m-t-20">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <div class="col-sm-12" id="content">
            <form method="GET" action="./editStatus.php" enctype="multipart/form-data" id="frm-input" name='frm-input'>
                <div class="card">
                    <div class="card-header">
                        <h5>เเก้ไขสถานะทรัพย์เเละคน</h5>
                    </div>
                    <div class="card-block">
                        <label for="">ASSEST_ID</label>
                        <input type="text" name="ID" id="ID" value="<?php echo $_GET['ID'] ?>">
                        <button type="submit" name="submit">ยืนยัน</button>
                        <?php
                        if (isset($_GET['submit'])) {

                            $sqlSelectData = " 	select 		PCC_CASE_GEN,
									(select 	count(1)
									from 		M_CMD_ASSET a 
									inner join 	M_SERVICE_CMD  b on a.ASSET_CASE_TYPE = b.CMD_TYPE_CODE 
									where 		b.CMD_ACT_FLAG_2 = 1 and a.CMD_ID = a.ID)as CMD_ACT_FLAG_2,
									(select 	count(1)
									from 		M_CMD_ASSET a 
									inner join 	M_SERVICE_CMD  b on a.ASSET_CASE_TYPE = b.CMD_TYPE_CODE 
									where 		b.CMD_ACT_FLAG_3 = 1 and a.CMD_ID = a.ID) as CMD_ACT_FLAG_3,
									SEQUEST_STATUS,
									SALE_STATUS,
									ACCOUNTANCY_STATUS,
									(select 	count(1)
									from 		M_CMD_PERSON a 
									inner join 	M_SERVICE_CMD  b on a.PERSON_CASE_TYPE = b.CMD_TYPE_CODE 
									where 		b.ALLOW_MEDIATE_STATUS = 1 and a.CMD_ID = a.ID) as  ALLOW_MEDIATE_STATUS,
									(select 	count(1)
									from 		M_CMD_PERSON a 
									inner join 	M_SERVICE_CMD  b on a.PERSON_CASE_TYPE = b.CMD_TYPE_CODE 
									where 		b.BACKOFFICE_ALLOW_STATUS = 1 and a.CMD_ID = a.ID) as  BACKOFFICE_ALLOW_STATUS,
									TO_T_BLACK_CASE,
									TO_BLACK_CASE,
									TO_BLACK_YY,
									TO_T_RED_CASE,
									TO_RED_CASE,
									TO_RED_YY,
									TO_COURT_CODE
						FROM		M_DOC_CMD A
						LEFT JOIN 	M_CMD_SYSTEM B ON A.SYS_NAME = B.CMD_SYSTEM_ID
						LEFT JOIN 	M_SERVICE_CMD C ON A.CASE_TYPE = C.CMD_TYPE_CODE
						LEFT JOIN 	M_CMD_PERSON D ON D.PERSON_ID = A.PERSON_ID
						LEFT JOIN 	M_CMD_TYPE E ON C.CMD_TYPE_ID = E.CMD_TYPE_ID 
						where		A.ID = '" . $_GET['ID'] . "' ";
                            $querySelectData = db::query($sqlSelectData);
                            $recSelectData = db::fetch_array($querySelectData);
                            print_r_pre($recSelectData);
                            //กรณีระบบไกล่เกลี่ย 
                            if ($recSelectData["ALLOW_MEDIATE_STATUS"] >= 1) { 
                                //คน
                                //สถานะ ให้ดำเนินการไกล่เกลี่ยต่อไป ถึงทำงาน CMD_TYPE_CODE=70001


                                $sqlSelectRefData = "	SELECT 	REF_WFR_ID 
								FROM 	WH_MEDIATE_CASE
								WHERE	PREFIX_BLACK_CASE = '" . $recSelectData["TO_T_BLACK_CASE"] . "'
										AND BLACK_CASE = '" . $recSelectData["TO_BLACK_CASE"] . "'
										AND BLACK_YY = '" . $recSelectData["TO_BLACK_YY"] . "'
										AND PREFIX_RED_CASE = '" . $recSelectData["TO_T_RED_CASE"] . "'
										AND RED_CASE = '" . $recSelectData["TO_RED_CASE"] . "'
										AND RED_YY = '" . $recSelectData["TO_RED_YY"] . "'
										AND COURT_ID = '" . $recSelectData["TO_COURT_CODE"] . "' ";
                                $querySelectRefData = db::query($sqlSelectRefData);
                                $recSelectRefData = db::fetch_array($querySelectRefData);

                                $curl = curl_init();

                                $arrDataSet = array();

                                $arrDataSet["USERNAME"]         = "BankruptDt";
                                $arrDataSet["PASSWORD"]         = "Debtor4321";
                                $arrDataSet["refWfrId"]         = $recSelectRefData["REF_WFR_ID"];
                                $arrDataSet["registerCode"]     = $rec_person["ID_CARD"];
                                $arrDataSet["prefixBlackCase"]     = $recSelectData["TO_T_BLACK_CASE"];
                                $arrDataSet["blackCase"]         = $recSelectData["TO_BLACK_CASE"];
                                $arrDataSet["blackYy"]             = $recSelectData["TO_BLACK_YY"];
                                $arrDataSet["prefixRedCase"]     = $recSelectData["TO_T_RED_CASE"];
                                $arrDataSet["redCase"]             = $recSelectData["TO_RED_CASE"];
                                $arrDataSet["redYy"]             = $recSelectData["TO_RED_YY"];
                                $arrDataSet["cmdActFlag"]         = ($recSelectData["ALLOW_MEDIATE_STATUS"] >= 1) ? 0 : "1";

                                $data_string = json_encode($arrDataSet);
                                echo "service_log_proces<br>";
                                print_r_pre($data_string);
                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'http://103.208.27.224/ega_led_mediate/service/service_log_proces.php',
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
                                    ),
                                ));

                                $response = curl_exec($curl);

                                curl_close($curl);
                            } else {

                                if ($recSelectData["BACKOFFICE_ALLOW_STATUS"] >= 1) {
                                    //คน
                                     //สถานะ ให้ดำเนินการไกล่เกลี่ยต่อไป ถึงทำงาน CMD_TYPE_CODE=80004,80001
                                    $curl = curl_init();

                                    $arrDataSet = array();

                                    $arrDataSet["USERNAME"]         = "BankruptDt";
                                    $arrDataSet["PASSWORD"]         = "Debtor4321";
                                    $arrDataSet["CARD_ID"]             = $arrPersonList;
                                    $arrDataSet["cmdActFlag"]         = $recSelectData["BACKOFFICE_ALLOW_STATUS"];

                                    $data_string = json_encode($arrDataSet);
                                    echo "update_payroll_status<br>";
                                    print_r_pre($data_string);
                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => 'http://203.151.166.134/LED_OFFICE/LED_PER/api/update_payroll_status.php',
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
                                        ),
                                    ));

                                    $response = curl_exec($curl);

                                    curl_close($curl);
                                } else {

                                    if ($recSelectData["CMD_ACT_FLAG_2"] >= 1 || $recSelectData["CMD_ACT_FLAG_3"] >= 1) {
                                        //ทรัพย์
                                         //CMD_ACT_FLAG_2หรือCMD_ACT_FLAG_3 >=1 ปลดล็อค

                                        //เหมือนจะทำงานเเต่ไม่ได้ใช้เเล้ว
                                        $arrDataPerson["PCC_CASE_GEN"]     = $recSelectData["PCC_CASE_GEN"];
                                        $arrDataPerson["CARD_ID"]         = $arrPersonList;

                                        $data_string = json_encode($arrDataPerson);
                                        /* เก็บ log start AK*/
                                        unset($fields);
                                        $fields["PAGE_CODE"]               =   'http://103.40.146.73/LedService.php/upLockPersonCivil';
                                        $fields["COLUMN1"]                 =     $data_string;
                                        $fields["CREATE_DATE"]                 =    date("Y-m-d");
                                        $fields["SYSTEM_TYPE"]                 =   "1";
                                        $fields["NOTE"]                 =   "ปลดล็อคคน เงื่อนไขการทำงาน CMD_ACT_FLAG_2>=1 || CMD_ACT_FLAG_3 >=1 ";
                                        $fields["REF_ID"]                 =   $_GET['ID'];
                                        db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
                                        /* เก็บ log stop AK*/

                                        $curl = curl_init();
                                        echo "upLockPersonCivil<br>";
                                        print_r_pre($arrDataPerson);
                                        curl_setopt_array($curl, array(
                                            CURLOPT_URL => 'http://103.40.146.73/LedService.php/upLockPersonCivil',
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
                                            ),
                                        ));

                                        $response = curl_exec($curl);

                                        curl_close($curl);

                                        //เมื่อifนี้ทำงาน ถ้าคนมรการให้ปลดสถานะล็อค จะทำ คนด้านบนไม่ทำงานเเต่มาปลดสถานะทรัพย์เเทน
                                        $arrCFC_CAPTION_GEN = array();
                                        $sqlSelectCmdAsset         = "	select 		a.CFC_CAPTION_GEN,b.DOSS_CONTROL_GEN,c.SEQUEST_STATUS,c.SALE_STATUS,c.ACCOUNTANCY_STATUS
											from 		M_CMD_ASSET a 
											inner join 	WH_CIVIL_CASE_ASSETS b on a.ASSET_ID = b.ASSET_ID
											inner join 	M_SERVICE_CMD  c on a.ASSET_CASE_TYPE = c.CMD_TYPE_CODE
											where 		CMD_ID = " . $_GET['ID'] . "";
                                        $querySelectCmdAsset     = db::query($sqlSelectCmdAsset);
                                        while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
                                            $arrCFC_CAPTION_GEN["CFC_CAPTION_GEN"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["CFC_CAPTION_GEN"];
                                            $arrCFC_CAPTION_GEN["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
                                                "SEQUEST_STATUS" => $recSelectCmdAsset["SEQUEST_STATUS"],
                                                "SALE_STATUS" => $recSelectCmdAsset["SALE_STATUS"],
                                                "ACCOUNTANCY_STATUS" => $recSelectCmdAsset["ACCOUNTANCY_STATUS"]
                                            );
                                        }

                                        if (count($arrCFC_CAPTION_GEN) > 0) {

                                            $data_string = json_encode($arrCFC_CAPTION_GEN);

                                            /* เก็บ log start AK*/
                                            unset($fields);
                                            $fields["PAGE_CODE"]               =   'http://103.40.146.73/LedService.php/upLockAssetCivil';
                                            $fields["COLUMN1"]                 =     $data_string;
                                            $fields["CREATE_DATE"]                 =    date("Y-m-d");
                                            $fields["SYSTEM_TYPE"]                 =   "1";
                                            $fields["NOTE"]                 =   "ปลดล็อคทรัพย์ เงื่อนไขการทำงาน count(arrCFC_CAPTION_GEN) > 0";
                                            $fields["REF_ID"]                 =   $_GET['ID'];
                                            db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
                                            /* เก็บ log stop AK*/
                                            $curl = curl_init();

                                            echo "upLockAssetCivil<br>";
                                            print_r_pre($arrCFC_CAPTION_GEN);
                                            print_r_pre($data_string);
                                            curl_setopt_array($curl, array(
                                                CURLOPT_URL => 'http://103.40.146.73/LedService.php/upLockAssetCivil',
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
                                                ),
                                            ));

                                            $response = curl_exec($curl);

                                            curl_close($curl);
                                        }
                                    } else {
                                        //CMD_ACT_FLAG_2หรือCMD_ACT_FLAG_3 = 0 หรือค่าว่าง ล็อกไว้จนกว่าจะมีคำสั่ง จพท
                                        $curl = curl_init();

                                        $arrDataSet = array();

                                        $arrDataSet["USERNAME"]     = "BankruptDt";
                                        $arrDataSet["PASSWORD"]     = "Debtor4321";
                                        $arrDataSet["PCC_CASE_GEN"] = $recSelectData["PCC_CASE_GEN"];
                                        $arrDataSet["CARD_ID"]         = $rec_person["ID_CARD"];

                                        $sqlSelectCmdAsset         = "	select 		a.CFC_CAPTION_GEN,b.DOSS_CONTROL_GEN
											from 		M_CMD_ASSET a 
											inner join 	WH_CIVIL_CASE_ASSETS b on a.ASSET_ID = b.ASSET_ID
											where 		CMD_ID = " . $_GET['ID'] . "";
                                        $querySelectCmdAsset     = db::query($sqlSelectCmdAsset);
                                        while ($recSelectCmdAsset = db::fetch_array($querySelectCmdAsset)) {
                                            $arrDataSet["CFC_CAPTION_GEN"][$recSelectCmdAsset["CFC_CAPTION_GEN"]] = $recSelectCmdAsset["CFC_CAPTION_GEN"];
                                            $arrDataSet["DOSS_CONTROL_GEN"][$recSelectCmdAsset["DOSS_CONTROL_GEN"]] = array(
                                                "SEQUEST_STATUS" => $recSelectData["SEQUEST_STATUS"],
                                                "SALE_STATUS" => $recSelectData["SALE_STATUS"],
                                                "ACCOUNTANCY_STATUS" => $recSelectData["ACCOUNTANCY_STATUS"]
                                            );
                                        }

                                        $data_string = json_encode($arrDataSet);

                                        /* เก็บ log start AK*/
                                        unset($fields);
                                        $fields["PAGE_CODE"]               =   'http://103.40.146.73/LedService.php/lockPersonCivil';
                                        $fields["COLUMN1"]                 =     $data_string;
                                        $fields["CREATE_DATE"]                 =    date("Y-m-d");
                                        $fields["SYSTEM_TYPE"]                 =   "1";
                                        $fields["NOTE"]                 =   "ล็อคคน";
                                        $fields["REF_ID"]                 =   $_GET['ID'];
                                        db::db_insert("TEST_DATA_RES", $fields, 'PK_ID', 'PK_ID');
                                        /* เก็บ log stop AK*/

                                        echo "lockPersonCivil<br>";
                                        print_r_pre($arrDataSet);
                                        print_r_pre($data_string);
                                        curl_setopt_array($curl, array(
                                            CURLOPT_URL => 'http://103.40.146.73/LedService.php/lockPersonCivil',
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
                                            ),
                                        ));

                                        $response = curl_exec($curl);

                                        curl_close($curl);
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
        </body>