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
            <form method="GET" action="./editStatus1.php" enctype="multipart/form-data" id="frm-input" name='frm-input'>
                <div class="card">
                    <div class="card-header">
                        <h5>เเก้ไขสถานะทรัพย์เเละคน</h5>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-3" align='right'>
                                <label for="">PCC_CIVIL_GEN</label>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" name="PCC_CIVIL_GEN" id="PCC_CIVIL_GEN" value="<?php echo $_GET['PCC_CIVIL_GEN'] ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-2" align='right'>
                                <button type="submit" name="submit">ยืนยัน</button>
                            </div>
                        </div>
                        <div>
                            <table border="1">
                                <thead>
                                    <td>ASSET_ID</td>
                                    <td>CFC_CAPTION_GEN</td>
                                    <td>DOSS_CONTROL_GEN</td>
                                    <td>รายละเอียดทรัพย์</td>
                                    <td></td>
                                </thead>

                                <?php
                                $sqlPcc = "SELECT b.ASSET_ID ,b.PROP_TITLE ,b.CFC_CAPTION_GEN ,b.DOSS_CONTROL_GEN FROM WH_CIVIL_CASE a 
                            JOIN WH_CIVIL_CASE_ASSETS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                            WHERE 1=1
                            AND b.ASSET_ID IS NOT NULL 
                            AND a.CIVIL_CODE ='" . $_GET['PCC_CIVIL_GEN'] . "'";
                                echo $sqlPcc;
                                $queryPcc     = db::query($sqlPcc);
                                while ($rec = db::fetch_array($queryPcc)) {
                                ?>
                                    <tr>
                                        <td><?php echo $rec['ASSET_ID']; ?></td>
                                        <td><?php echo $rec['PROP_TITLE']; ?></td>
                                        <td><?php echo $rec['CFC_CAPTION_GEN']; ?></td>
                                        <td><?php echo $rec['DOSS_CONTROL_GEN']; ?></td>
                                        <td>
                                            <button type="button" onclick="sendStatusAsset('<?php echo $rec['ASSET_ID']; ?>','<?php echo $rec['PROP_TITLE']; ?>','<?php echo $rec['CFC_CAPTION_GEN']; ?>','<?php echo $rec['DOSS_CONTROL_GEN']; ?>','lock');">ล็อคทรัพย์</button>
                                            <button type="button" onclick="sendStatusAsset('<?php echo $rec['ASSET_ID']; ?>','<?php echo $rec['PROP_TITLE']; ?>','<?php echo $rec['CFC_CAPTION_GEN']; ?>','<?php echo $rec['DOSS_CONTROL_GEN']; ?>','uplock');">ปลดล็อคทรัพย์</button>
                                        </td>
                                    </tr>
                                <?php
                                }

                                ?>
                            </table>
                        </div>
                    </div>
                    <!-- test -->
                    <?php
                    function log_order($URL_API, $ARRAY_DATA)
                    {
                        $fields["URL_API"]                 =   $URL_API;
                        $fields["ARRAY_DATA"]         =   $ARRAY_DATA;
                        $fields["CREATE_DATE"]         =  date("Y-m-d");
                        $fields["CREATE_TIME"]         =   date("h:i:sa");
                        db::db_insert("M_LOG_ORDER ", $fields, 'ID_ORDER', 'ID_ORDER');
                    }
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
						where		A.ID = '3847' ";
                    $querySelectData = db::query($sqlSelectData);
                    $recSelectData = db::fetch_array($querySelectData);

                    //กรณีระบบไกล่เกลี่ย
                    if ($recSelectData["ALLOW_MEDIATE_STATUS"] >= 1) {


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

                        echo "service_log_proces";
                        print_r_pre($arrDataSet);
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
                            $curl = curl_init();

                            $arrDataSet = array();

                            $arrDataSet["USERNAME"]         = "BankruptDt";
                            $arrDataSet["PASSWORD"]         = "Debtor4321";
                            $arrDataSet["CARD_ID"]             = $arrPersonList;
                            $arrDataSet["cmdActFlag"]         = $recSelectData["BACKOFFICE_ALLOW_STATUS"];

                            $data_string = json_encode($arrDataSet);
                            echo "update_payroll_status";
                            print_r_pre($arrDataSet);
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


                                $arrDataPerson["PCC_CASE_GEN"]     = $recSelectData["PCC_CASE_GEN"];
                                $arrDataPerson["CARD_ID"]         = $arrPersonList;

                                $data_string = json_encode($arrDataPerson);

                                log_order("upLockPersonCivil", $data_string);

                                $curl = curl_init();
                                echo "upLockPersonCivil";
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

                                $arrCFC_CAPTION_GEN = array();
                                $sqlSelectCmdAsset         = "	select 		a.CFC_CAPTION_GEN,b.DOSS_CONTROL_GEN,c.SEQUEST_STATUS,c.SALE_STATUS,c.ACCOUNTANCY_STATUS
											from 		M_CMD_ASSET a 
											inner join 	WH_CIVIL_CASE_ASSETS b on a.ASSET_ID = b.ASSET_ID
											inner join 	M_SERVICE_CMD  c on a.ASSET_CASE_TYPE = c.CMD_TYPE_CODE
											where 		CMD_ID = '3847'";
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

                                    log_order("upLockAssetCivil", $data_string);

                                    $curl = curl_init();
                                    echo "upLockAssetCivil";
                                    print_r_pre($arrCFC_CAPTION_GEN);
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

                                $curl = curl_init();

                                $arrDataSet = array();

                                $arrDataSet["USERNAME"]     = "BankruptDt";
                                $arrDataSet["PASSWORD"]     = "Debtor4321";
                                $arrDataSet["PCC_CASE_GEN"] = $recSelectData["PCC_CASE_GEN"];
                                $arrDataSet["CARD_ID"]         = $rec_person["ID_CARD"];

                                $sqlSelectCmdAsset         = "	select 		a.CFC_CAPTION_GEN,b.DOSS_CONTROL_GEN
											from 		M_CMD_ASSET a 
											inner join 	WH_CIVIL_CASE_ASSETS b on a.ASSET_ID = b.ASSET_ID
											where 		CMD_ID = " . $_POST['ID'] . "";
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


                                log_order("lockPersonCivil", $data_string);


                                echo "lockPersonCivil";
                                print_r_pre($arrDataSet);
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
                    } ?>
                </div>
            </form>
        </div>
        </body>
        <script>
            function sendStatusAsset(ASSET_ID, PROP_TITLE, CFC_CAPTION_GEN, DOSS_CONTROL_GEN, status) {
                let url = "./editStatusAjax.php?1=1";
                url += "&ASSET_ID=" + ASSET_ID + "&PROP_TITLE=" + PROP_TITLE + "&CFC_CAPTION_GEN=" + CFC_CAPTION_GEN + "&DOSS_CONTROL_GEN=" + DOSS_CONTROL_GEN + "&proc=" + status
                window.open(url, 'Image', 'width=1000px.stylewidth,height=1000px.style.height,resizable=1');
            }
        </script>