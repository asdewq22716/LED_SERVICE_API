<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 'On'); */

include "../include/include.php";
include "../include/func_Nop.php";


switch ($_POST['page']) {

    case 'search_data_show_detial2':
        if ($_POST['SYSTEM_TYPE'] == 'Civil') {
            getCivilToWh($_POST['api'], 'Y'); //เรียก api มาบันทึกข้อมูล

        } else if ($_POST['SYSTEM_TYPE'] == 'Bankrupt') {
            getBankruptToWh_num($_POST['api'], "Y"); //เรียก api มาบันทึกข้อมูล

        } else if ($_POST['SYSTEM_TYPE'] == 'Revive') {
            $dataSet["SYSTEM_TYPE"] = $_POST['api'];
            getReviveToWh($dataSet, "Y");
        } else if ($_POST['SYSTEM_TYPE'] == 'Mediate') {
            getMedToWh($_POST['api'], "Y");
        }
        break;
}



switch ($_POST['proc']) {
    case 'IDCARD': //ตรวจ บุคคลทั่วไป

        break;
    case 'openModalWebRoute':

        function getDossControlGen($CIVIL_CODE, $DOSS_DEPT_CODE, $DOSS_CONTROL_GEN)
        {
            $sql = "SELECT b.DOSS_CONTROL_GEN 
                                                        FROM WH_CIVIL_CASE a
                                                        JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID = b.WH_CIVIL_ID
                                                        WHERE 1 = 1
                                                AND a.CIVIL_CODE = '" . $CIVIL_CODE . "'
                                                AND b.DOSS_DEPT_CODE = '" . $DOSS_DEPT_CODE . "'
                                                AND b.DOSS_CONTROL_GEN = '" . $DOSS_CONTROL_GEN . "'";
            $query = db::query($sql);
            $rec = db::fetch_array($query);
            return $rec['DOSS_CONTROL_GEN'];
        }
?>
        <!-- ส่วนของทรัพย์ START -->
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content tabs">

                    <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                        <thead class="thead-dark">
                            <tr>
                                <th style="background-color: #dc3545;color: white;">ลำดับรายการทรัพย์</th>
                                <th style="background-color: #dc3545;color: white;">ชื่อรายการทรัพย์</th>
                                <th style="background-color: #dc3545;color: white;">สถานะ</th>
                                <th style="background-color: #dc3545;color: white;">ราคาประเมิน</th>
                                <th style="background-color: #dc3545;color: white;">เกี่ยวข้องเป็น</th>
                            </tr>
                        </thead>
                        <?php
                        $sqlAsset = "SELECT *FROM WH_CIVIL_CASE_ASSETS a WHERE a.DOSS_CONTROL_GEN ='" . getDossControlGen($_POST['civilCode'], $_POST['deptCode'], $_POST['controlGen']) . "'";
                        $queryAsset = db::query($sqlAsset);
                        $T = 1;
                        while ($recSelectDataAsset = db::fetch_array($queryAsset)) {
                        ?>
                            <tr style="background-color: #E6E6FA;">
                                <td>
                                    <div align="center"><?php echo $T; ?></div>
                                </td>
                                <td><a onclick="show_asset_detail(<?php echo $recSelectDataAsset['ASSET_ID']; ?>)" href="javascript:void();"><?php echo $recSelectDataAsset["PROP_TITLE"]; ?></a></td>
                                <td> <?php echo $recSelectDataAsset['PROP_STATUS_NAME']; ?></td>
                                <td>
                                    <div align='center'><?php echo $recSelectDataAsset['ASSET_PRICE'] != "0" ? $recSelectDataAsset['ASSET_PRICE'] : "-"; ?></div>
                                </td>
                                <?php

                                $sql_owner = "SELECT *FROM WH_CIVIL_CASE_ASSET_OWNER b 
                                                                        JOIN " . Convert::ConvertTable('WH_CIVIL_CASE_PERSON') . " c ON b.WH_CIVIL_ID =c.WH_CIVIL_ID AND b.PERSON_NAME =c.FULL_NAME 
                                                                        WHERE 1=1 
                                                                        AND b.ASSET_ID ='" . $recSelectDataAsset['ASSET_ID'] . "'";
                                ?>
                                <td>
                                    <table>
                                        <?php
                                        $queryowner = db::query($sql_owner);
                                        while ($rec_owner = db::fetch_array($queryowner)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $rec_owner['FULL_NAME']; ?></td>
                                                <td><?php echo $rec_owner['CONCERN_NAME']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                            </tr>

                        <?php
                            $T++;
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- ส่วนของทรัพย์ END -->


        <!-- ทางเดินสำนวน START -->
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content tabs">
                    <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
                        <thead class="thead-dark">
                            <tr>
                                <th style="background-color: #d9adb2;color: white;" width="10%">ลำดับ</th>
                                <th style="background-color: #d9adb2;color: white;" width="10%">วันที่ดำเนินการ</th>
                                <th style="background-color: #d9adb2;color: white;" width="10%">เวลา</th>
                                <th style="background-color: #d9adb2;color: white;" width="10%">รหัสบัญชี</th>
                                <th style="background-color: #d9adb2;color: white;" width="20%">รายการ</th>
                            </tr>
                        </thead>
                        <?php


                        $n_R = 0;
                        $sql_R = "SELECT a.CIVIL_CODE ,b.ACCOUNT_NO ,b.DOSS_DEPT_CODE ,b.DOSS_DEPT_NAME ,c.ACT_DESC ,c.CREATE_DATE,c.CREATE_TIME  ,c.ACT_DESC
                        FROM WH_CIVIL_CASE a 
                        JOIN WH_CIVIL_DOSS b ON a.WH_CIVIL_ID =b.WH_CIVIL_ID 
                        INNER JOIN WH_CIVIL_ROUTE c ON b.DOSS_CONTROL_GEN = c.DOSS_CONTROL_GEN
                        WHERE 1=1
                        AND a.CIVIL_CODE ='" . $_POST['civilCode'] . "' 
                        AND b.DOSS_DEPT_CODE ='" . $_POST['deptCode'] . "'
                        AND b.DOSS_CONTROL_GEN ='" . $_POST['controlGen'] . "'
                        ORDER BY  c.CREATE_DATE ASC,(c.CREATE_TIME) ASC ";




                        $queryR = db::query($sql_R);
                        $total_ROUTE = db::num_rows($queryR);
                        if ($total_ROUTE > 0) {
                            while ($recR = db::fetch_array($queryR)) {
                                $n_R++;
                        ?>
                                <tr style="background-color: #f0f0f5;">
                                    <td>
                                        <div align='center'><?php echo $n_R; ?></div>
                                    </td>
                                    <td>
                                        <div><?php echo date_AK65(date("Y-m-d", strtotime($recR['CREATE_DATE']))); ?></div>
                                    </td>
                                    <td>
                                        <div><?php echo $recR['CREATE_TIME'] == '00:00:00' ? "" : $recR['CREATE_TIME']; ?></div>
                                    </td>
                                    <td>
                                        <div><?php echo $recR['ACCOUNT_NO']; ?></div>
                                    </td>
                                    <td>
                                        <div><?php echo $recR['ACT_DESC']; ?></div>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td>ไม่พบข้อมูล</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    <?php
        break;
    case 'checkPerson':
        /* print_pre($_POST);
        exit; */
        $person = array();
        $_POST['LIST_REGISTER_CODE'];

        $arraySize = count($_POST['LIST_REGISTER_CODE']);

        $array_data = array();
        //print_pre($_POST['LIST_REGISTER_CODE']);
        foreach ($_POST['LIST_REGISTER_CODE'] as $ar1 => $sr1) {
            $arrayCMD_TYPE_PERSON = array();
            $arrayCASE_TYPE_PERSON = array();
            $dataCMD_TYPE_PERSON = "";
            $dataCASE_TYPE_PERSON = "";
            if ($sr1 != 'null') {
                foreach ($_POST['CMD_TYPE_PERSON'] as $aar1 => $ssr1) {
                    if ($sr1 == $aar1) {
                        $arrayCMD_TYPE_PERSON[$aar1] = $ssr1;
                        $dataCMD_TYPE_PERSON = $ssr1;
                    }
                }
                foreach ($_POST['CASE_TYPE_PERSON'] as $qqr1 => $wwr1) {
                    if ($sr1 == $qqr1) {
                        $arrayCASE_TYPE_PERSON[$qqr1] = $wwr1;
                        $dataCASE_TYPE_PERSON = $wwr1;
                    }
                }
                $person[] = [
                    'IDCARD' => $sr1,
                    //'CMD_TYPE_PERSON' => $arrayCMD_TYPE_PERSON,
                    //'CASE_TYPE_PERSON' => $arrayCASE_TYPE_PERSON,
                    'dataCMD_TYPE_PERSON' => $dataCMD_TYPE_PERSON,
                    'dataCASE_TYPE_PERSON' => $dataCASE_TYPE_PERSON
                ];
            }
        }
        foreach ($_POST['ASSET_ID'] as $ar1 => $sr1) {
            $dataCMD_TYPE = "";
            $dataCASE_TYPE = "";
            foreach ($_POST['CMD_TYPE'] as $aar1 => $ssr1) {
                if ($sr1 == $aar1) {
                    $dataCMD_TYPE = $ssr1;
                }
            }
            foreach ($_POST['CASE_TYPE'] as $qqr1 => $wwr1) {
                if ($sr1 == $qqr1) {
                    $dataCASE_TYPE = $wwr1;
                }
            }
            $Asset[] = [
                'Asset_id' => $sr1,
                //'CMD_TYPE_PERSON' => $arrayCMD_TYPE_PERSON,
                //'CASE_TYPE_PERSON' => $arrayCASE_TYPE_PERSON,
                'dataCMD_TYPE' => $dataCMD_TYPE,
                'dataCASE_TYPE' => $dataCASE_TYPE
            ];
        }

        $nPerson = 0;
       // print_pre($_POST['CMD_TYPE_PERSON']);
        foreach ($person as $ar => $br) {
            if ($br['dataCMD_TYPE_PERSON'] == '') {
                $nPerson++;
            }
            if ($br['dataCASE_TYPE_PERSON'] == '') {
                $nPerson++;
            }
        }

        $nAsset = 0;
        foreach ($Asset as $ar => $br) {
            if ($br['dataCMD_TYPE'] == '') {
                $nAsset++;
            }
            if ($br['dataCASE_TYPE'] == '') {
                $nAsset++;
            }
        }



        $AllcountPerson = empty($_POST['GET_PREFIX_NAME']) ? 0 : count($_POST['GET_PREFIX_NAME']); //จำนวนคนทั้งหมด
        $AllcountPerson = ($AllcountPerson == '' || $AllcountPerson == 0) ? 0 : $AllcountPerson;
        $AllcountAsset = count($_POST['ASSET_TYPE_ID']); //จำนวนทรัพย์ที่มี
        $AllcountAsset = ($AllcountAsset == '' || $AllcountAsset == 0) ? 0 : $AllcountAsset;

        $countPerson = empty($_POST['LIST_REGISTER_CODE']) ? 0 : count($_POST['LIST_REGISTER_CODE']); //จำนวนคนที่เลือก
        $countPerson = ($countPerson == '' || $countPerson == 0) ? 0 : $countPerson;
        $countAsset = count($_POST['ASSET_ID']); //จำนวนทรัพย์ที่เลือก
        $countAsset = ($countAsset == '' || $countAsset == 0) ? 0 : $countAsset;

        $check_person = "";
        $check_asset = "";
        if ($AllcountPerson > 0 && $countPerson <= 0) { //เมื่อมีคนทั้งหมดมากกว่า0 เเละ ไม่ได้เลือกคน
            $check_person = 'targetPerson';
        }
        if ($AllcountAsset > 0 && $countAsset <= 0) { //เมื่อมีทรัพย์ทั้งหมดมากกว่า0 เเละ ไม่ได้เลือกทรัพย์
            $check_asset = 'targetAssets';
        }

        $numAlert = [
            'nPerson' => $nPerson,
            'nAsset' => $nAsset,
            'check_person' => $check_person,
            'check_asset' => $check_asset
        ];

        echo json_encode($numAlert);
        /* echo "<pre>";
        print_r([$numAlert]);
        echo "</pre>"; */
        /*     echo "<pre>";
        print_r([$person]);
        echo "</pre>";
        echo "<pre>";
        print_r([$Asset]);
        echo "</pre>";
        exit; */
        break;
    case 'modalLog':
        $sql = "SELECT *FROM M_COMMAND_HISTORY a
		WHERE a.ID_OF_M_DOC_CMD ='" . $_POST['ID'] . "'
		ORDER BY a.ID_COMMAND ASC";
        $query = db::query($sql);
        $html = "";
        function get_data_log($data)
        {
            if ($data == 'add') {
                return 'สร้างคำสั่ง';
            } else if ($data == 'edit') {
                return 'เเก้ไขคำสั่ง';
            } else {
            }
        }
        function get_status_log($data)
        {
            if ($data == '1') {
                return 'อนุมัติ';
            } else if ($data == '2') {
                return 'ส่งกลับเเก้ไข';
            } else if ($data == '3') {
                return 'อนุมัติส่งต่อ';
            }
        }
        function getUsrMain($IdCard)
        {
            $sql = "SELECT a.USR_ID ,a.USR_OPTION9 ,a.USR_PREFIX ,a.USR_FNAME ,a.USR_LNAME 
                    FROM USR_MAIN a WHERE a.USR_OPTION9 ='" . $IdCard . "'";
            $query = db::query($sql);
            $rec = db::fetch_array($query);
            return $rec['USR_PREFIX'] . $rec['USR_FNAME'] . " " . $rec['USR_LNAME'];
        }


    ?>
        <table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
            <thead class="bg-primary">
                <tr class="bg-primary">
                    <th style="width: 5%;" class="text-center">ลำดับ</th>
                    <th style="width: 10%;" class="text-center">วันที่</th>
                    <th style="width: 10%;" class="text-center">เวลา</th>
                    <th style="width: 15%;" class="text-center">รายละเอียด</th>
                    <th style="width: 15%;" class="text-center">รายละเอียดการส่งกลับเเก้ไข</th>
                    <th style="width: 10%;" class="text-center">สถานะการสร้างเเละเเก้ไข</th>
                    <th style="width: 10%;" class="text-center">สร้างโดย13หลัก</th>
                    <th style="width: 20%;" class="text-center">ชื่อ</th>
                </tr>
            </thead>

            <?php
            $i = 1;

            while ($rec = db::fetch_array($query)) {
            ?>
                <tr>
                    <td>
                        <div><?php echo $i; ?></div>
                    </td>
                    <td>
                        <div><?php echo date_AK_year($rec['CMD_DOC_DATE']); ?>
                    </td>
                    <td>
                        <div><?php echo $rec['CMD_DOC_TIME']; ?>
                    </td>
                    <td>
                        <div><?php echo $rec['CMD_NOTE']; ?>
                    </td>
                    <td>
                        <div><?php echo $rec['COMMENT_EDIT']; ?>
                    </td>
                    <td>
                        <div align="center"><?php echo ($rec['PROC'] == "" ? get_status_log($rec['APPROVE_STATUS']) : get_data_log($rec['PROC'])); ?>
                    </td>
                    <td>
                        <div><?php echo ($rec['TO_PERSON_ID']); ?>
                    </td>
                    <td>
                        <div><?php echo getUsrMain($rec['TO_PERSON_ID']); ?>
                    </td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </table>
<?php
        break;
    case 'log_searchPerson':
        function get_data_person($IDCARD = "", $nameFill = "") //หาชื่อคนค้นข้อมูล
        {
            $sql = "SELECT a.USR_PREFIX ,a.USR_FNAME ,a.USR_LNAME FROM USR_MAIN a WHERE a.USR_USERNAME ='" . $IDCARD . "'";
            $query = db::query($sql);
            $array_data = [];
            $rec = db::fetch_array($query);
            return $rec[$nameFill];
        }
        unset($fields);
        $fields["DATE_SEARCH"] = date("Y-m-d"); //วันที่ค้นหา
        $fields["TIME_SEARCH"] = date("H:i:s"); //เวลาที่ค้นหา
        $fields["IDCARD"]      = $_POST["TO_PERSON_ID"]; // 13หลักของคนที่ค้นหา
        $fields["FIRST_NAME"]  = get_data_person($_POST["TO_PERSON_ID"], "USR_FNAME"); //ชื่อ 
        $fields["LAST_NAME"]   = get_data_person($_POST["TO_PERSON_ID"], "USR_LNAME"); //นามสกุล
        $fields["DATA_SEARCH"] = $_POST['idCard'];
        db::db_insert("M_LOG_SEARCH_PERSON ", $fields, 'ID_LOG', 'ID_LOG');
        break;
    case "DBD":
        $IDCARD = $_POST['IDCARD'];
        $url = $_POST['url'];
        $postData = array(
            "username" => "sriniva",
            "password" => "1234",
            "juristicID" => $IDCARD,
            "idcard" => $IDCARD,
        );

        //  echo json_encode(func::sendHttpPostRequest($url, $postData));
        $res = array();
        $row = array();
        $res = (func::sendHttpPostRequest($url, $postData));

        $address = $res['addressInformation'][0]['juristicFullAddress'];
        $province = $res['addressInformation'][0]['juristicProvince'];
        $amphur = $res['addressInformation'][0]['juristicAmpur'];
        $tambol = $res['addressInformation'][0]['juristicTumbol'];

        $ADDR_NO = $res['addressInformation'][0]['juristicAddressNo'];
        $MOO = $res['addressInformation'][0]['juristicMoo'];
        $SOI = $res['addressInformation'][0]['juristicSoi'];
        $ROAD = $res['addressInformation'][0]['juristicRoad'];
        $data_table = "";
        $description = "";
        if ($res['ResponseCode'][0]['ResCode'] == '000') {
            $prefixName = "";
            if ($array_data['juristicType'] == 'บริษัทมหาชนจำกัด' || $array_data['juristicType'] == 'บริษัทจำกัด') {
                $prefixName = "บริษัท ";
            }
            $row['status']                = $res['ResponseCode'][0]['ResMeassage'];
            $row['juristicNameTh']        = $prefixName . $res['juristicNameTh'];
            $row['juristicStatus']        = $res['juristicStatus'];
            $row['juristicType']        = $res['juristicType'];
            $row['registerDate']        = $res['registerDate'];
            $row['registerCapital']        = $res['registerCapital'];
            $row['juristicFullAddress']    = $address;
            $row['juristicProvince']    = $province;
            $row['juristicOldID']        = $res['juristicOldID'];

            $row['juristicAddressNo']    = $res['addressInformation'][0]['juristicAddressNo'];
            $row['juristicMoo']            = $res['addressInformation'][0]['juristicMoo'];
            $row['juristicSoi']            = $res['addressInformation'][0]['juristicSoi'];
            $row['juristicRoad']        = $res['addressInformation'][0]['juristicRoad'];
            $row['juristicPhone']        = $res['addressInformation'][0]['Phone'];
            $row['juristicEmail']        = $res['addressInformation'][0]['Email'];

            $sql_provice = db::query("SELECT * FROM G_PROVINCE WHERE PROVINCE_NAME = '" . $province . "'");
            $rec_provice = db::fetch_array($sql_provice);
            $row['juristicProvinceCode']    = $rec_provice['PROVINCE_CODE'];
            $row['juristicAmpur']        = $amphur;
            $sql_amphur = db::query("SELECT * FROM G_AMPHUR WHERE AMPHUR_NAME = REPLACE('" . $amphur . "','เขต','')");
            $rec_amphur = db::fetch_array($sql_amphur);
            $row['juristicAmpurCode']        = $rec_provice['PROVINCE_CODE'] . $rec_amphur['AMPHUR_CODE'];
            $row['juristicTumbol']        = $tambol;
            $sql_tumbon = db::query("SELECT * FROM G_TAMBON WHERE TAMBON_NAME = '" . $tambol . "'");
            $rec_tumbon = db::fetch_array($sql_tumbon);
            $row['juristicTumbolCode']        = $rec_provice['PROVINCE_CODE'] . $rec_amphur['AMPHUR_CODE'] . $rec_tumbon['TAMBON_CODE'];

            foreach ($res['authorizeDescription'] as $k => $v) {
                $description .= $v['description'];
            }
            $i = 1;


            $data_table .= "  <div class=\"card-block\">
                                    <div class=\"wf-left\">
                                        <h1><label class=\"label bg-primary\">
                                                <font size=\"2\">รายชื่อหุ้นส่วน/คณะกรรมการ</font>
                                            </label></h1>
                                    </div>
                                        <div class=\"table-responsive col-md-6\" data-pattern=\"priority-columns\" id=\"export_data\">
                                            <div class=\"showborder\">";
            $data_table .= "  <table cellspacing=\"0\" id=\"tech-companies-1\" class=\"table table-bordered sorted_table\">
                                <thead class=\"bg-primary\">
                                    <tr class=\"bg-primary\">
                                        <th style=\"width: 5%;\" class=\"text-center\"> ลำดับ</th>
                                        <th style=\"width:20%;\" class=\"text-center\">หมายเลขประจำตัวประชาชน</th>
                                        <th style=\"width:;\" class=\"text-center\">ชื่อ - นามสกุล</th>
                                    </tr>
                                </thead>
                            <tbody>";
            foreach ($res['juristicCommittee'] as $k => $v) {
                $data_table .= "<tr>";
                $data_table .= "<td class='text-center'>" . $i . "</td>";
                $data_table .= "<td class='text-center'>" . (!empty($v['citizenID']) ? $v['citizenID'] : "-") . "</td>";
                $data_table .= "<td>" . $v['titleName'] . $v['firstName'] . "  " . $v['lastName'] . "</td>";
                $data_table .= "</tr>";
                $i++;
            }
            $data_table .= "     </tbody>
                        </table>";
            $data_table .= "        </div>
                                </div>
                            </div>";


            $row['juristicDescription']        = $description;

            $row['board']        = $data_table;
        }
        echo json_encode($row);

        break;
    case "TO_SEND":
        $arrData = array();
        $arrData["registerCode"] = $_POST["REGISTERCODE"];
        $dataString = json_encode($arrData);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.208.27.224:81/led_service_api/service/GetPersonCaseList.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $dataString,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $dataReturn = json_decode($response, true);
        $html = "";
        $html .= " <table cellspacing=\"0\" id=\"tech-companies-1\" class=\"table table-bordered sorted_table\">
<thead class=\"bg-primary\">
    <th class=\"text-center\">ลำดับ</th>
    <th class=\"text-center\">เลขบัตรประชาชน</th>
    <th class=\"text-center\">ชื่อ-สกุล</th>
    <th class=\"text-center\">สถานะ</th>
    <th class=\"text-center\">เลขคดีดำ/ปี</th>
    <th class=\"text-center\">เลขคดีแดง/ปี</th>
    <th class=\"text-center\">ศาล</th>
    <th class=\"text-center\">จัดการ</th>
</thead>";
        $num_row = count($dataReturn['Data']);
        if ($num_row > 0) {
            foreach ($dataReturn['Data'] as $sh1 => $ch1) {
                $num_a = 1;
                $num_a1 = 1;
                $show_word = '';
                if ($sh1 == 'Mediate') {
                    $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบไกล่เกลี่ย';
                } else if ($sh1 == 'Bankrupt') {
                    $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบล้มละลาย';
                    $_POST["SYSTEM_ID"] = 2;
                } else if ($sh1 == 'Revive') {
                    $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบฟื้นฟู';
                } else if ($sh1 == 'Backoffice') {
                    $show_word = 'Backoffice';
                } else if ($sh1 == 'Civil') {
                    $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในแพ่ง';
                    $_POST["SYSTEM_ID"] = 1;
                }
                $html .= " <tr><td colspan=\"10\" style=\"background-color:#dc3545 ;color:aliceblue;\">" . $show_word . "</td></tr>";
                foreach ($ch1 as $sh2 => $ch2) {
                    $html .= "<tr style=\"background-color: #E6E6FA;\">";
                    $html .= "<div>";
                    $html .= "<td><div align='center'>" . $num_a . "</div></td>";
                    $html .= "<td>" . $ch2['registerCode'] . "</td>";
                    $html .= "<td>" . $ch2['prefixName'] . " " . $ch2['firstName'] . " " . $ch2['lastName'] . "</td>";
                    $html .= "<td>" . $ch2['concernName'] . "</td>";
                    $A = ($ch2['blackCase'] != '' && $ch2['blackYy'] != '') ? "/" : "";
                    $B = ($ch2['redCase'] != '' && $ch2['redYy'] != '') ? "/" : "";
                    $html .= "<td>" . $ch2['prefixBlackCase'] . $ch2['blackCase'] . $A . $ch2['blackYy'] . "</td>";
                    $html .= "<td>" . $ch2['prefixRedCase'] . $ch2['redCase'] . $B . $ch2['redYy'] . "</td>";
                    $html .= "<td>" . $ch2['courtName'] . "</td>";
                    $html .= " <td></td>";
                    $html .= "</div>";
                    $html .= "</tr>";
                    $html .= "";
                    $html .= "";
                    $html .= "";
                    $num_a++;
                }
            }
        } else {
            $html .= "  <tr>
                            <td colspan=\"10\">
                                <div align='center'><?php echo 'ไม่มีข้อมูล'; ?></div>
                            </td>
                        </tr>";
        }
        $html .= " </table>";
        $array_data['html'] = $html;
        $array_data['post'] = $_POST;
        $array_data['SQL_DATA'] = $SQL_DATA;
        echo json_encode($array_data);
        break;


    case "btn_search_data":
        //คำสั่งหลัก
        unset($fields);
        /* Nop start  */
        $fields["REGISTERCODE"]         =         $_POST["REGISTERCODE"];
        /* Nop stop */
        $fields["CMD_DOC_DATE"]         =         $_POST["CMD_DOC_DATE"];
        $fields["CMD_DOC_TIME"]         =         $_POST["CMD_DOC_TIME"];
        $fields["COURT_CODE"]             =         $_POST["COURT_CODE"];
        $fields["COURT_NAME"]             =         getcourtName($_POST["COURT_CODE"]);
        $fields["F_BLACK_CASE"]         =         $_POST["T_BLACK_CASE"] . $_POST["BLACK_CASE"] . "/" . $_POST["BLACK_YY"];
        $fields["T_BLACK_CASE"]         =         $_POST["T_BLACK_CASE"];
        $fields["BLACK_CASE"]             =         $_POST["BLACK_CASE"];
        $fields["BLACK_YY"]             =         $_POST["BLACK_YY"];

        $fields["F_RED_CASE"]             =         $_POST["T_RED_CASE"] . $_POST["RED_CASE"] . "/" . $_POST["RED_YY"];
        $fields["T_RED_CASE"]             =         $_POST["T_RED_CASE"];
        $fields["RED_CASE"]             =         $_POST["RED_CASE"];
        $fields["RED_YY"]                 =         $_POST["RED_YY"];

        $fields["SEND_TO"]                 =         $_POST["SEND_TO"];
        $fields["REF_ID"]                 =         $_POST["REF_ID"];

        $fields["COURT_CODE"]             =         $_POST["COURT_CODE"]; //ศาล

        $fields["CASE_TYPE"]             =         $_POST["CASE_TYPE"];
        $fields["CASE_TYPE_NAME"]         =         getCaseName($_POST["CASE_TYPE"]);

        $fields["SEND_STATUS"]             =         0;

        $fields["CMD_NOTE"]             =         $_POST["CMD_NOTE"];

        $fields["OFFICE_IDCARD"]         =         $_POST["OFFICE_IDCARD"];
        $fields["OFFICE_NAME"]             =         $_POST["OFFICE_NAME"];


        $fields["APPROVE_STATUS"]         =         0;
        $fields["PLAINTIFF"]             =         $_POST["D_C"];
        $fields["DEFENDANT"]             =         $_POST["D_NAME"];

        $fields["SEND_TO_PERSON"]         =         $_POST["sendToPerson"];

        $fields["CMD_READ_STATUS"]         =         0;
        $fields["CMD_DETAIL"]             =         $_POST["CMD_NOTE"];


        $fields["CMD_SYSTEM"]             =         $_POST["SYSTEM_ID"];
        $fields["CMD_SYSTEM_ID"]         =         $_POST["SYSTEM_ID"];
        $fields["SYSTEM_NAME"]             =         getsystemName($_POST["SYSTEM_ID"]);
        $fields["SYS_NAME"]             =         $_POST["SYSTEM_ID"];

        $fields["CMD_TYPE"]             =         $_POST["CMD_TYPE"];
        //$fields["CMD_NAME_ORDER"] 		= 		getCmdName($_POST["CMD_TYPE"]);



        $fields["APPROVE_PERSON"]         =         $_POST["APPROVE_PERSON"];
        $fields["TO_T_BLACK_CASE"]         =         $_POST["TO_T_BLACK_CASE"];
        $fields["TO_BLACK_CASE"]        =         $_POST["TO_BLACK_CASE"];
        $fields["TO_BLACK_YY"]             =         $_POST["TO_BLACK_YY"];

        $fields["TO_T_RED_CASE"]         =         $_POST["TO_T_RED_CASE"];
        $fields["TO_RED_CASE"]             =         $_POST["TO_RED_CASE"];
        $fields["TO_RED_YY"]             =         $_POST["TO_RED_YY"];

        $fields["TO_COURT_CODE"]         =         $_POST["TO_COURT_CODE"];
        $fields["TO_COURT_NAME"]         =         getcourtName($_POST["TO_COURT_CODE"]);

        $fields["TO_PLAINTIFF"]         =         $_POST["TO_PLAINTIFF"];
        $fields["TO_DEFENDANT"]         =         $_POST["TO_DEFENDANT"];

        $fields["PCC_CASE_GEN"]         =         $_POST["PCC_CASE_GEN"];
        $fields["CMD_MANUAL_STATUS"]     =         $_POST["CMD_MANUAL_STATUS"];
        $fields["GET_PER_TYPE"]         =         $_POST["GET_PER_TYPE"];

        $filter = "";
        if ($_POST["T_BLACK_CASE"] != "") {
            $filter .= " and PREFIX_BLACK_CASE = '" . $_POST['T_BLACK_CASE'] . "'	";
        }
        if ($_POST["BLACK_CASE"] != "") {
            $filter .= " and BLACK_CASE = '" . $_POST['BLACK_CASE'] . "'	";
        }
        if ($_POST["BLACK_YY"] != "") {
            $filter .= " and BLACK_YY = '" . $_POST['BLACK_YY'] . "'	";
        }
        if ($_POST["T_RED_CASE"] != "") {
            $filter .= " and PREFIX_RED_CASE = '" . $_POST['T_RED_CASE'] . "'	";
        }
        if ($_POST["RED_CASE"] != "") {
            $filter .= " and RED_CASE = '" . $_POST['RED_CASE'] . "'	";
        }
        if ($_POST["RED_YY"] != "") {
            $filter .= " and RED_YY = '" . $_POST['RED_YY'] . "'	";
        }
        if ($_POST["TO_COURT_CODE"] != "") {
            if ($_POST["SEND_TO"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
                $filter .= " and COURT_ID = '" . $_POST['TO_COURT_CODE'] . "'	";
            } else if ($_POST["SEND_TO"] == 2) {
                $filter .= " and COURT_CODE = '010030'	";
            } else {
                $filter .= " and COURT_CODE = '" . $_POST['TO_COURT_CODE'] . "'	";
            }
        }
        if ($_REQUEST["REF_ID"] > 0) {

            $filterTo = "";
            if ($_POST["TO_T_BLACK_CASE"] != "") {
                $filterTo .= " and PREFIX_BLACK_CASE = '" . $_POST['TO_T_BLACK_CASE'] . "'	";
            }
            if ($_POST["TO_BLACK_CASE"] != "") {
                $filterTo .= " and BLACK_CASE = '" . $_POST['TO_BLACK_CASE'] . "'	";
            }
            if ($_POST["TO_BLACK_YY"] != "") {
                $filterTo .= " and BLACK_YY = '" . $_POST['TO_BLACK_YY'] . "'	";
            }
            if ($_POST["TO_T_RED_CASE"] != "") {
                $filterTo .= " and PREFIX_RED_CASE = '" . $_POST['TO_T_RED_CASE'] . "'	";
            }
            if ($_POST["TO_RED_CASE"] != "") {
                $filterTo .= " and RED_CASE = '" . $_POST['TO_RED_CASE'] . "'	";
            }
            if ($_POST["TO_RED_YY"] != "") {
                $filterTo .= " and RED_YY = '" . $_POST['TO_RED_YY'] . "'	";
            }
            if ($_POST["TO_COURT_CODE"] != "") {
                if ($_POST["SEND_TO"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
                    $filterTo .= " and COURT_ID = '" . $_POST['TO_COURT_CODE'] . "'	";
                } else if ($_POST["SEND_TO"] == 2) {
                    $filterTo .= " and COURT_CODE = '010030'	";
                } else {
                    $filterTo .= " and COURT_CODE = '" . $_POST['TO_COURT_CODE'] . "'	";
                }
            }

            if ($_POST["DOSS_OWNER_ID"] == "") {
                if ($_POST["SEND_TO"] == 1) { //ระบบงานบังคับคดีแพ่ง
                    $sqlSelectData = "	select 		DOSS_OWNER_ID
										from 		WH_CIVIL_CASE a 
										inner join 	WH_CIVIL_DOSS b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
										where		1=1 {$filterTo}";
                } else if ($_POST["SEND_TO"] == 2) { //ระบบงานบังคับคดีล้มละลาย
                    $sqlSelectData = "	select 	DOSS_OWNER_ID
										from 	WH_BANKRUPT_CASE_DETAIL
										where	1=1 {$filterTo}	";
                } else if ($_POST["SEND_TO"] == 3) { //ระบบงานฟื้นฟูกิจการของลูกหนี้
                    $sqlSelectData = "	select 	PLAINTIFF2 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT
										from 	WH_REHABILITATION_CASE_DETAIL
										where	1=1 {$filterTo}	";
                } else if ($_POST["SEND_TO"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
                    $sqlSelectData = "
										select 	PLAINTIFF_FNAME as PLAINTIFF,DEFENDANT_FNAME as DEFFENDANT
										from 	WH_MEDIATE_CASE
										where	1=1 	{$filterTo}	";
                }
                // echo $sqlSelectData;
                // exit();
                $querySelectData = db::query($sqlSelectData);
                $recSelectData = db::fetch_array($querySelectData);

                $fields["TO_PERSON_ID"]         =         $recSelectData["DOSS_OWNER_ID"];
            } else {
                $fields["TO_PERSON_ID"]         =         $_POST["DOSS_OWNER_ID"];
            }
        } else {
            if ($_POST["SEND_TO"] == 1) { //ระบบงานบังคับคดีแพ่ง
                $sqlSelectData = "	select 		DOSS_OWNER_ID
									from 		WH_CIVIL_CASE a 
									inner join 	WH_CIVIL_DOSS b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
									where		1=1 {$filter}";
            } else if ($_POST["SEND_TO"] == 2) { //ระบบงานบังคับคดีล้มละลาย
                $sqlSelectData = "	select 	DOSS_OWNER_ID
									from 	WH_BANKRUPT_CASE_DETAIL
									where	1=1 {$filter}	";
            } else if ($_POST["SEND_TO"] == 3) { //ระบบงานฟื้นฟูกิจการของลูกหนี้
                $sqlSelectData = "	select 	PLAINTIFF2 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT
									from 	WH_REHABILITATION_CASE_DETAIL
									where	1=1 {$filter}	";
            } else if ($_POST["SEND_TO"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
                $sqlSelectData = "
									select 	PLAINTIFF_FNAME as PLAINTIFF,DEFENDANT_FNAME as DEFFENDANT
									from 	WH_MEDIATE_CASE
									where	1=1 	{$filter}	";
            }
            $querySelectData = db::query($sqlSelectData);
            $recSelectData = db::fetch_array($querySelectData);

            if ($_POST["SEND_TO"] == 2) {
                $recSelectData["DOSS_OWNER_ID"] = "3100903272320";
            } else if ($_POST["SEND_TO"] == 3) {
                $recSelectData["DOSS_OWNER_ID"] = "1103411005612";
            } else if ($_POST["SEND_TO"] == 4) {
                $recSelectData["DOSS_OWNER_ID"] = "1103411005612";
            } else {
                $recSelectData["DOSS_OWNER_ID"] = "3920300038603";
            }

            $fields["TO_PERSON_ID"]         =         $recSelectData["DOSS_OWNER_ID"]; //$_POST["TO_PERSON_ID"];
        }

        $fields["CMD_FIX_DATE_STATUS"] = $_POST["CMD_FIX_DATE_STATUS"];
        if ($_POST["CMD_FIX_DATE_STATUS"] == 'Y') {
            $fields["CMD_FIX_DOC_DATE"] = date2db($_POST["CMD_FIX_DOC_DATE"]);
        }

        $CMD_ID = db::db_insert("M_DOC_CMD", $fields, 'ID', 'ID');

        //รายละเอียดคำสั่ง
        unset($fields);
        $fields["CMD_ID"]     =     $CMD_ID;
        $fields["CMD_NOTE"] =    $_POST["CMD_NOTE"];
        db::db_insert("M_CMD_DETAILS", $fields, 'CMD_DETAIL_ID', 'CMD_DETAIL_ID');

        //รายการทรัพย์ในคำสั่ง
        if (count($_POST["ASSET_ID"]) > 0) {
            foreach ($_POST["ASSET_ID"] as $key => $val) {
                unset($fields);
                $fields["CMD_ID"]                 =     $CMD_ID;
                $fields["ASSET_ID"]             =     $val;
                $fields["PROP_DET"]             =     $_POST["PROP_TITLE"][$key];
                $fields["TYPE_CODE"]             =     $_POST["TYPE_CODE"][$key];
                $fields["TYPE_DESC"]             =     $_POST["TYPE_DESC"][$key];
                $fields["PROP_STATUS"]             =     $_POST["PROP_STATUS"][$key];
                $fields["PROP_STATUS_NAME"]     =     $_POST["PROP_STATUS_NAME"][$key];
                $fields["CFC_CAPTION_GEN"]         =     $_POST["CFC_CAPTION_GEN"][$key];
                $fields["ASSET_CMD_TYPE"]         =     $_POST["CMD_TYPE"][$key];
                $fields["ASSET_CASE_TYPE"]         =     $_POST["CASE_TYPE"][$key];
                db::db_insert("M_CMD_ASSET", $fields, 'CMD_ASSET_ID', 'CMD_ASSET_ID');
            }
        }

        //คนในคำสั่ง
        if (count($_POST["LIST_REGISTER_CODE"]) > 0) {
            foreach ($_POST["LIST_REGISTER_CODE"] as $key => $val) {
                unset($fields);
                $fields["CMD_ID"]                 =     $CMD_ID;
                $fields["ID_CARD"]                 =     $val;
                $fields["PREFIX_NAME"]             =     $_POST["GET_PREFIX_NAME"][$val];
                $fields["FIRST_NAME"]             =     $_POST["GET_FIRST_NAME"][$val];
                $fields["LAST_NAME"]             =     $_POST["GET_LAST_NAME"][$val];
                $fields["FULL_NAME"]             =     $_POST["GET_PREFIX_NAME"][$val] . $_POST["GET_FIRST_NAME"][$val] . " " . $_POST["GET_LAST_NAME"][$val];
                $fields["ADDRESS"]                 =     $val["address"];
                $fields["PHONE"]                 =     $val["phone"];
                $fields["FAX"]                     =     $val["fax"];
                $fields["MOBILE"]                 =     $val["mobile"];
                $fields["EMAIL"]                 =     $val["email"];
                $fields["PERSON_CMD_TYPE"]         =     $_POST["CMD_TYPE_PERSON"][$key];
                $fields["PERSON_CASE_TYPE"]     =     $_POST["CASE_TYPE_PERSON"][$key];
                db::db_insert("M_CMD_PERSON", $fields, 'PERSON_ID', 'PERSON_ID');
            }
        }


        db::query("UPDATE FRM_CMD_FILE SET WFR_ID = " . $CMD_ID . " WHERE WFR_ID = '" . $_POST["attachid"] . "' ");

        getDataToWhAlert($_POST["APPROVE_PERSON"]);
        echo json_encode($_POST);
        break;

    case "search_data_cmd_reply":
        /*  echo "ทำงาน";
        exit; */
        //คำสั่งหลัก
        unset($fields);
        $fields["CMD_DOC_DATE"]         =         $_POST["CMD_DOC_DATE"];
        $fields["CMD_DOC_TIME"]         =         $_POST["CMD_DOC_TIME"];
        $fields["COURT_CODE"]             =         $_POST["COURT_CODE"];
        $fields["COURT_NAME"]             =         getcourtName($_POST["COURT_CODE"]);
        $fields["F_BLACK_CASE"]         =         $_POST["T_BLACK_CASE"] . $_POST["BLACK_CASE"] . "/" . $_POST["BLACK_YY"];
        $fields["T_BLACK_CASE"]         =         $_POST["T_BLACK_CASE"];
        $fields["BLACK_CASE"]             =         $_POST["BLACK_CASE"];
        $fields["BLACK_YY"]             =         $_POST["BLACK_YY"];

        $fields["F_RED_CASE"]             =         $_POST["T_RED_CASE"] . $_POST["RED_CASE"] . "/" . $_POST["RED_YY"];
        $fields["T_RED_CASE"]             =         $_POST["T_RED_CASE"];
        $fields["RED_CASE"]             =         $_POST["RED_CASE"];
        $fields["RED_YY"]                 =         $_POST["RED_YY"];

        $fields["SEND_TO"]                 =         $_POST["SEND_TO"];
        $fields["REF_ID"]                 =         $_POST["REF_ID"];

        $fields["COURT_CODE"]             =         $_POST["COURT_CODE"]; //ศาล

        $fields["CASE_TYPE"]             =         $_POST["CASE_TYPE"];
        $fields["CASE_TYPE_NAME"]         =         getCaseName($_POST["CASE_TYPE"]);

        $fields["SEND_STATUS"]             =         0;

        $fields["CMD_NOTE"]             =         $_POST["CMD_NOTE"];

        $fields["OFFICE_IDCARD"]         =         $_POST["OFFICE_IDCARD"];
        $fields["OFFICE_NAME"]             =         $_POST["OFFICE_NAME"];


        $fields["APPROVE_STATUS"]         =         0;
        $fields["PLAINTIFF"]             =         $_POST["D_C"];
        $fields["DEFENDANT"]             =         $_POST["D_NAME"];

        $fields["SEND_TO_PERSON"]         =         $_POST["sendToPerson"];

        $fields["CMD_READ_STATUS"]         =         0;
        $fields["CMD_DETAIL"]             =         $_POST["CMD_NOTE"];


        $fields["CMD_SYSTEM"]             =         $_POST["SYSTEM_ID"];
        $fields["CMD_SYSTEM_ID"]         =         $_POST["SYSTEM_ID"];
        $fields["SYSTEM_NAME"]             =         getsystemName($_POST["SYSTEM_ID"]);
        $fields["SYS_NAME"]             =         $_POST["SYSTEM_ID"];

        $fields["CMD_TYPE"]             =         $_POST["CMD_TYPE"];
        //$fields["CMD_NAME_ORDER"] 		= 		getCmdName($_POST["CMD_TYPE"]);



        $fields["APPROVE_PERSON"]         =         $_POST["APPROVE_PERSON"];
        $fields["TO_T_BLACK_CASE"]         =         $_POST["TO_T_BLACK_CASE"];
        $fields["TO_BLACK_CASE"]        =         $_POST["TO_BLACK_CASE"];
        $fields["TO_BLACK_YY"]             =         $_POST["TO_BLACK_YY"];

        $fields["TO_T_RED_CASE"]         =         $_POST["TO_T_RED_CASE"];
        $fields["TO_RED_CASE"]             =         $_POST["TO_RED_CASE"];
        $fields["TO_RED_YY"]             =         $_POST["TO_RED_YY"];

        $fields["TO_COURT_CODE"]         =         $_POST["TO_COURT_CODE"];
        $fields["TO_COURT_NAME"]         =         getcourtName($_POST["TO_COURT_CODE"]);

        $fields["TO_PLAINTIFF"]         =         $_POST["TO_PLAINTIFF"];
        $fields["TO_DEFENDANT"]         =         $_POST["TO_DEFENDANT"];

        $fields["PCC_CASE_GEN"]         =         $_POST["PCC_CASE_GEN"];
        $fields["CMD_MANUAL_STATUS"]     =         $_POST["CMD_MANUAL_STATUS"];
        $fields["GET_PER_TYPE"]         =         $_POST["GET_PER_TYPE"];

        $filter = "";
        if ($_POST["T_BLACK_CASE"] != "") {
            $filter .= " and PREFIX_BLACK_CASE = '" . $_POST['T_BLACK_CASE'] . "'	";
        }
        if ($_POST["BLACK_CASE"] != "") {
            $filter .= " and BLACK_CASE = '" . $_POST['BLACK_CASE'] . "'	";
        }
        if ($_POST["BLACK_YY"] != "") {
            $filter .= " and BLACK_YY = '" . $_POST['BLACK_YY'] . "'	";
        }
        if ($_POST["T_RED_CASE"] != "") {
            $filter .= " and PREFIX_RED_CASE = '" . $_POST['T_RED_CASE'] . "'	";
        }
        if ($_POST["RED_CASE"] != "") {
            $filter .= " and RED_CASE = '" . $_POST['RED_CASE'] . "'	";
        }
        if ($_POST["RED_YY"] != "") {
            $filter .= " and RED_YY = '" . $_POST['RED_YY'] . "'	";
        }
        if ($_POST["TO_COURT_CODE"] != "") {
            if ($_POST["SEND_TO"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
                $filter .= " and COURT_ID = '" . $_POST['TO_COURT_CODE'] . "'	";
            } else if ($_POST["SEND_TO"] == 2) {
                $filter .= " and COURT_CODE = '010030'	";
            } else {
                $filter .= " and COURT_CODE = '" . $_POST['TO_COURT_CODE'] . "'	";
            }
        }
        if ($_REQUEST["REF_ID"] > 0) {

            $filterTo = "";
            if ($_POST["TO_T_BLACK_CASE"] != "") {
                $filterTo .= " and PREFIX_BLACK_CASE = '" . $_POST['TO_T_BLACK_CASE'] . "'	";
            }
            if ($_POST["TO_BLACK_CASE"] != "") {
                $filterTo .= " and BLACK_CASE = '" . $_POST['TO_BLACK_CASE'] . "'	";
            }
            if ($_POST["TO_BLACK_YY"] != "") {
                $filterTo .= " and BLACK_YY = '" . $_POST['TO_BLACK_YY'] . "'	";
            }
            if ($_POST["TO_T_RED_CASE"] != "") {
                $filterTo .= " and PREFIX_RED_CASE = '" . $_POST['TO_T_RED_CASE'] . "'	";
            }
            if ($_POST["TO_RED_CASE"] != "") {
                $filterTo .= " and RED_CASE = '" . $_POST['TO_RED_CASE'] . "'	";
            }
            if ($_POST["TO_RED_YY"] != "") {
                $filterTo .= " and RED_YY = '" . $_POST['TO_RED_YY'] . "'	";
            }
            if ($_POST["TO_COURT_CODE"] != "") {
                if ($_POST["SEND_TO"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
                    $filterTo .= " and COURT_ID = '" . $_POST['TO_COURT_CODE'] . "'	";
                } else if ($_POST["SEND_TO"] == 2) {
                    $filterTo .= " and COURT_CODE = '010030'	";
                } else {
                    $filterTo .= " and COURT_CODE = '" . $_POST['TO_COURT_CODE'] . "'	";
                }
            }

            if ($_POST["DOSS_OWNER_ID"] == "") {
                if ($_POST["SEND_TO"] == 1) { //ระบบงานบังคับคดีแพ่ง
                    $sqlSelectData = "	select 		DOSS_OWNER_ID
                                            from 		WH_CIVIL_CASE a 
                                            inner join 	WH_CIVIL_DOSS b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
                                            where		1=1 {$filterTo}";
                } else if ($_POST["SEND_TO"] == 2) { //ระบบงานบังคับคดีล้มละลาย
                    $sqlSelectData = "	select 	DOSS_OWNER_ID
                                            from 	WH_BANKRUPT_CASE_DETAIL
                                            where	1=1 {$filterTo}	";
                } else if ($_POST["SEND_TO"] == 3) { //ระบบงานฟื้นฟูกิจการของลูกหนี้
                    $sqlSelectData = "	select 	PLAINTIFF2 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT
                                            from 	WH_REHABILITATION_CASE_DETAIL
                                            where	1=1 {$filterTo}	";
                } else if ($_POST["SEND_TO"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
                    $sqlSelectData = "
                                            select 	PLAINTIFF_FNAME as PLAINTIFF,DEFENDANT_FNAME as DEFFENDANT
                                            from 	WH_MEDIATE_CASE
                                            where	1=1 	{$filterTo}	";
                }
                // echo $sqlSelectData;
                // exit();
                $querySelectData = db::query($sqlSelectData);
                $recSelectData = db::fetch_array($querySelectData);

                $fields["TO_PERSON_ID"]         =         $recSelectData["DOSS_OWNER_ID"];
            } else {
                $fields["TO_PERSON_ID"]         =         $_POST["DOSS_OWNER_ID"];
            }
        } else {
            if ($_POST["SEND_TO"] == 1) { //ระบบงานบังคับคดีแพ่ง
                $sqlSelectData = "	select 		DOSS_OWNER_ID
                                        from 		WH_CIVIL_CASE a 
                                        inner join 	WH_CIVIL_DOSS b on a.WH_CIVIL_ID = b.WH_CIVIL_ID
                                        where		1=1 {$filter}";
            } else if ($_POST["SEND_TO"] == 2) { //ระบบงานบังคับคดีล้มละลาย
                $sqlSelectData = "	select 	DOSS_OWNER_ID
                                        from 	WH_BANKRUPT_CASE_DETAIL
                                        where	1=1 {$filter}	";
            } else if ($_POST["SEND_TO"] == 3) { //ระบบงานฟื้นฟูกิจการของลูกหนี้
                $sqlSelectData = "	select 	PLAINTIFF2 as PLAINTIFF,DEFFENDANT1 as DEFFENDANT
                                        from 	WH_REHABILITATION_CASE_DETAIL
                                        where	1=1 {$filter}	";
            } else if ($_POST["SEND_TO"] == 4) { //ระบบงานไกล่เกลี่ยข้อพิพาท
                $sqlSelectData = "
                                        select 	PLAINTIFF_FNAME as PLAINTIFF,DEFENDANT_FNAME as DEFFENDANT
                                        from 	WH_MEDIATE_CASE
                                        where	1=1 	{$filter}	";
            }
            $querySelectData = db::query($sqlSelectData);
            $recSelectData = db::fetch_array($querySelectData);

            if ($_POST["SEND_TO"] == 2) {
                $recSelectData["DOSS_OWNER_ID"] = "3100903272320";
            } else if ($_POST["SEND_TO"] == 3) {
                $recSelectData["DOSS_OWNER_ID"] = "1103411005612";
            } else if ($_POST["SEND_TO"] == 4) {
                $recSelectData["DOSS_OWNER_ID"] = "1103411005612";
            } else {
                $recSelectData["DOSS_OWNER_ID"] = "3920300038603";
            }

            $fields["TO_PERSON_ID"]         =         $recSelectData["DOSS_OWNER_ID"]; //$_POST["TO_PERSON_ID"];
        }

        $fields["CMD_FIX_DATE_STATUS"] = $_POST["CMD_FIX_DATE_STATUS"];
        if ($_POST["CMD_FIX_DATE_STATUS"] == 'Y') {
            $fields["CMD_FIX_DOC_DATE"] = date2db($_POST["CMD_FIX_DOC_DATE"]);
        }
        /* Nop start*/
        $fields["PARENT"]             =         $_POST["ID"];
        $fields["PARENT_SEND"]             =         $_POST["SYSTEM_NAME"];
        $fields["PARENT_TO"]             =         $_POST["SEND_TO_NAME"];
        $fields["PARENT_NUM"]             =         ($_POST["PARENT_NUM"] == '' ? '1' : $_POST["PARENT_NUM"]++);
        /* Nop stop */
        $CMD_ID = db::db_insert("M_DOC_CMD", $fields, 'ID', 'ID');

        //รายละเอียดคำสั่ง
        unset($fields);
        $fields["CMD_ID"]     =     $CMD_ID;
        $fields["CMD_NOTE"] =    $_POST["CMD_NOTE"];
        db::db_insert("M_CMD_DETAILS", $fields, 'CMD_DETAIL_ID', 'CMD_DETAIL_ID');

        //รายการทรัพย์ในคำสั่ง
        if (count($_POST["ASSET_ID"]) > 0) {
            foreach ($_POST["ASSET_ID"] as $key => $val) {
                unset($fields);
                $fields["CMD_ID"]                 =     $CMD_ID;
                $fields["ASSET_ID"]             =     $val;
                $fields["PROP_DET"]             =     $_POST["PROP_TITLE"][$key];
                $fields["TYPE_CODE"]             =     $_POST["TYPE_CODE"][$key];
                $fields["TYPE_DESC"]             =     $_POST["TYPE_DESC"][$key];
                $fields["PROP_STATUS"]             =     $_POST["PROP_STATUS"][$key];
                $fields["PROP_STATUS_NAME"]     =     $_POST["PROP_STATUS_NAME"][$key];
                $fields["CFC_CAPTION_GEN"]         =     $_POST["CFC_CAPTION_GEN"][$key];
                $fields["ASSET_CMD_TYPE"]         =     $_POST["CMD_TYPE"][$key];
                $fields["ASSET_CASE_TYPE"]         =     $_POST["CASE_TYPE"][$key];
                db::db_insert("M_CMD_ASSET", $fields, 'CMD_ASSET_ID', 'CMD_ASSET_ID');
            }
        }

        //คนในคำสั่ง
        if (count($_POST["LIST_REGISTER_CODE"]) > 0) {
            foreach ($_POST["LIST_REGISTER_CODE"] as $key => $val) {
                unset($fields);
                $fields["CMD_ID"]                 =     $CMD_ID;
                $fields["ID_CARD"]                 =     $val;
                $fields["PREFIX_NAME"]             =     $_POST["GET_PREFIX_NAME"][$val];
                $fields["FIRST_NAME"]             =     $_POST["GET_FIRST_NAME"][$val];
                $fields["LAST_NAME"]             =     $_POST["GET_LAST_NAME"][$val];
                $fields["FULL_NAME"]             =     $_POST["GET_PREFIX_NAME"][$val] . $_POST["GET_FIRST_NAME"][$val] . " " . $_POST["GET_LAST_NAME"][$val];
                $fields["ADDRESS"]                 =     $val["address"];
                $fields["PHONE"]                 =     $val["phone"];
                $fields["FAX"]                     =     $val["fax"];
                $fields["MOBILE"]                 =     $val["mobile"];
                $fields["EMAIL"]                 =     $val["email"];
                $fields["PERSON_CMD_TYPE"]         =     $_POST["CMD_TYPE_PERSON"][$key];
                $fields["PERSON_CASE_TYPE"]     =     $_POST["CASE_TYPE_PERSON"][$key];
                db::db_insert("M_CMD_PERSON", $fields, 'PERSON_ID', 'PERSON_ID');
            }
        }


        db::query("UPDATE FRM_CMD_FILE SET WFR_ID = " . $CMD_ID . " WHERE WFR_ID = '" . $_POST["attachid"] . "' ");

        getDataToWhAlert($_POST["APPROVE_PERSON"]);
        echo json_encode($_POST);
        break;
    case "add_information_tor":
        function generateUniqueFilename($original_filename)
        {
            $extension = pathinfo($original_filename, PATHINFO_EXTENSION);
            $unique_name = uniqid() . '_' . mt_rand(1000, 9999) . '.' . $extension;
            return $unique_name;
        }
        print_r_pre($_POST);
        /* อัพข้อมูล start */
        unset($fields);
        $fields["NAME_PAGE"] =   $_POST['NAME_PAGE'];
        $fields["CODE_PAGE"] =   $_POST['CODE_PAGE'];
        $fields["NUMBER_PAGE"] =   $_POST['NUMBER_PAGE'];
        $fields["DETIAL_PAGE"] =   $_POST['DETIAL_PAGE'];
        $fields["COMMENT_IN_PAGE"] =   $_POST['COMMENT_IN_PAGE'];
        $fields["LINK"] =   $_POST['LINK'];
        $fields["DATE_INFO"] =   date("Y-m-d");
        $fields["CMD_SYSTEM"] =   $_POST['CMD_SYSTEM'];
        $ID_INFO = db::db_insert("M_INFORMATION_TOR", $fields, 'ID_INFO', 'ID_INFO');
        /* อัพข้อมูล stop */

        if (isset($_FILES["FILE_more"])) {
            $file_count = '';
            $file_name = '';
            $file_type = '';
            $file_temp = '';
            $file_size = '';
            $unique_filename = '';
            $destination = '';
            $file_count = count($_FILES["FILE_more"]["name"]);
            for ($i = 0; $i < $file_count; $i++) {
                $file_name = $_FILES["FILE_more"]["name"][$i];
                $file_type = $_FILES["FILE_more"]["type"][$i];
                $file_temp = $_FILES["FILE_more"]["tmp_name"][$i];
                $file_size = $_FILES["FILE_more"]["size"][$i];

                // Generate a unique filename (you can use any method you prefer)
                $unique_filename = generateUniqueFilename($file_name);

                // Upload the file to the specified folder with the unique filename
                $destination = './uploads/' . $unique_filename;
                if (move_uploaded_file($file_temp, $destination)) {
                    echo "ไฟล์ $file_name อัปโหลดและเก็บไฟล์ลงในโฟลเดอร์เรียบร้อยแล้ว<br>";
                    // Save file information in the database
                    unset($fields);
                    $fields["FILE_TEMP"] = $file_name;
                    $fields["FILE_NAME"] = $unique_filename;
                    $fields["FILE_SIZE"] = $file_size;
                    $fields["FILE_DATE"] = date("Y-m-d");
                    // $fields["FILE_TIME"] = date("H:i:s");
                    $fields["NAME_ID"] = "ADD_INFORMATION_TOR"; // เปลี่ยนเเค่นี้
                    $fields["DETIAL"] = "FILE_more";
                    $fields["ID"] = $ID_INFO; // เปลี่ยนเเค่นี้
                    db::db_insert("M_FILE_UPLOAD", $fields, 'ID_FILE_UPLOAD', 'ID_FILE_UPLOAD');
                } else {
                    echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ $file_name<br>";
                }
            }
        }

        if (isset($_FILES["FILE_MAIN"])) {
            $file_count = '';
            $file_name = '';
            $file_type = '';
            $file_temp = '';
            $file_size = '';
            $unique_filename = '';
            $destination = '';
            $file_count = count($_FILES["FILE_more"]["name"]);
            for ($i = 0; $i < $file_count; $i++) {
                $file_name = $_FILES["FILE_MAIN"]["name"][$i];
                $file_type = $_FILES["FILE_MAIN"]["type"][$i];
                $file_temp = $_FILES["FILE_MAIN"]["tmp_name"][$i];
                $file_size = $_FILES["FILE_MAIN"]["size"][$i];

                // Generate a unique filename (you can use any method you prefer)
                $unique_filename = generateUniqueFilename($file_name);

                // Upload the file to the specified folder with the unique filename
                $destination = './uploads/' . $unique_filename;
                if (move_uploaded_file($file_temp, $destination)) {
                    echo "ไฟล์ $file_name อัปโหลดและเก็บไฟล์ลงในโฟลเดอร์เรียบร้อยแล้ว<br>";
                    // Save file information in the database
                    unset($fields);
                    $fields["FILE_TEMP"] = $file_name;
                    $fields["FILE_NAME"] = $unique_filename;
                    $fields["FILE_SIZE"] = $file_size;
                    $fields["FILE_DATE"] = date("Y-m-d");
                    // $fields["FILE_TIME"] = date("H:i:s");
                    $fields["NAME_ID"] = "ADD_INFORMATION_TOR"; // เปลี่ยนเเค่นี้
                    $fields["DETIAL"] = "FILE_MAIN";
                    $fields["ID"] = $ID_INFO; // เปลี่ยนเเค่นี้
                    db::db_insert("M_FILE_UPLOAD", $fields, 'ID_FILE_UPLOAD', 'ID_FILE_UPLOAD');
                } else {
                    echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ $file_name<br>";
                }
            }
        }

        break;
    case "comment_user_WFR":

        unset($fields);
        $fields["COMMENT_USER"] = $_POST['COMMENT_USER'];
        $fields["STATUS_TOR"] = $_POST['STATUS_TOR'];
        db::db_update("M_INFO_TOR", $fields, array('INFO_ID' => $_POST["WFR"]));
        echo json_encode('1');
        break;
    case "show_action":

        $sql_CMD_TYPE_CODE = "SELECT DISTINCT
           A.CMD_TYPE_NAME,A.CMD_TYPE_CODE,A.ACTION
          FROM M_SERVICE_CMD A
          LEFT JOIN M_CMD_SYSTEM B ON A.CMD_SYS_ID = B.CMD_SYSTEM_ID
          LEFT JOIN M_CMD_TYPE C ON A.CMD_TYPE_ID = C.CMD_TYPE_ID
          WHERE A.CMD_TYPE_CODE='" . $_POST['CMD_TYPE_CODE'] . "'";
        $queryCMD_TYPE_CODE = db::query($sql_CMD_TYPE_CODE);
        $rec = db::fetch_array($queryCMD_TYPE_CODE);
        echo json_encode($rec['ACTION']);
        break;
    case "search_view":
        $sql = "SELECT
										A.*,
										DF.FILE_SAVE_NAME,
										DF.FILE_NAME,
										DF.FILE_EXT,
										DF.FILE_ID,
										DF.WFS_FIELD_NAME,
										DF.FILE_SIZE,
										DF.FILE_TYPE
									  FROM FRM_CMD_FILE A
									  LEFT JOIN WF_FILE DF ON DF.WFR_ID = A.F_ID AND DF.WF_MAIN_ID = '109'
									  WHERE
										 A.WF_MAIN_ID = '110' AND
										(A.WFR_ID = '" . $_POST['ID'] . "' OR A.F_TEMP_ID = '" . $_POST['ID'] . "')
									  ORDER BY A.F_ID ASC
									  ";
        $query = db::query($sql);
        $num_DOC = db::num_rows($query);
        echo  $num_DOC;
        break;
    case "show_detial_btn":
        if ($_POST['SYSTEM_TYPE'] == 'Bankrupt') {
            $sql = "SELECT *FROM WH_BANKRUPT_CASE_DETAIL WHERE WH_BANKRUPT_ID ='" . $_POST['WH_ID'] . "'";
        }
        if ($_POST['SYSTEM_TYPE'] == 'Revive') {
            $sql = "";
        }
        if ($_POST['SYSTEM_TYPE'] == 'Civil') {
            $sql = "SELECT *FROM WH_CIVIL_CASE WHERE WH_CIVIL_ID ='" . $_POST['WH_ID'] . "'";
        }
        if ($_POST['SYSTEM_TYPE'] == 'Mediate') {
            $sql = "SELECT *FROM WH_MEDIATE_CASE WHERE WH_MEDAITE_ID ='" . $_POST['WH_ID'] . "'";
        }

        $query = db::query($sql);
        $array_data = [];
        while ($rec = db::fetch_array($query)) {
            $array_data = $rec;
        }
        echo json_encode($sql);
        break;
}
