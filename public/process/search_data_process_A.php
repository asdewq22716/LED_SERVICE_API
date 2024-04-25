<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

/* echo "test";
echo "<pre>";
print_r($_POST);
echo "</pre>";
exit; */
/* include "../../include/connect_db.php";
include "../../../function/config_db.php"; */
include '../include/comtop_user.php';
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
function ctext($txt, $converted = 0)
{
    $strOut = strip_tags($txt);
    $strOut = htmlspecialchars($strOut, ENT_QUOTES);
    $strOut = stripslashes($strOut);
    $strOut = str_replace("'", " ", $strOut);
    $strOut = trim($strOut);

    //return iconv("utf-8","tis-620",$strOut);
    return ($converted == 0) ? $strOut : iconv("utf-8", "tis-620", $strOut);
}

/* db::db_delete_ALL("WF_CASE_TEM1");  */ // ลบข้อมูลทั้งหมด
/* db::db_delete_ALL("WF_CASE_TEM1");  */
db::query("delete FROM WF_CASE_TEM1");
$S = 0;
/* อัดข้อมูลใส่DB start*/
foreach ($dataReturn['Data'] as $AA1 => $BB1) {
    foreach ($BB1 as $AA2 => $BB2) {
        unset($fields);
        $S++;
        $fields["ID_TEM"]   =       $S;
        $fields["PREFIXBLACKCASE"]   =      $BB2['prefixBlackCase'];
        $fields["blackCase"]         =      $BB2['blackCase'];
        $fields["blackYy"]           =      $BB2['blackYy'];
        $fields["prefixRedCase"]     =      $BB2['prefixRedCase'];
        $fields["redCase"]           =      $BB2['redCase'];
        $fields["redYy"]           =      $BB2['redYy'];
        $fields["CourtCode"]           =      $BB2['CourtCode'];
        $fields["courtName"]           =      $BB2['courtName'];
        $fields["registerCode"]           =      $BB2['registerCode'];
        $fields["prefixName"]           =      $BB2['prefixName'];
        $fields["firstName"]           =      $BB2['firstName'];
        $fields["lastName"]           =      $BB2['lastName'];
        $fields["fullName"]           =      $BB2['fullName'];
        $fields["personType"]           =      $BB2['personType'];
        $fields["concernName"]           =      $BB2['concernName'];
        $fields["address"]           =      $BB2['address'];
        $fields["tumName"]           =      $BB2['tumName'];
        $fields["ampName"]           =      $BB2['ampName'];
        $fields["provName"]           =      $BB2['provName'];
        $fields["zipCode"]           =      $BB2['zipCode'];
        $fields["concernNo"]           =      $BB2['concernNo'];
        $fields["lockPersonStatus"]           =      $BB2['lockPersonStatus'];
        $fields["lockPersonStatusText"]           =      $BB2['lockPersonStatusText'];
        $fields["orderStatus"]           =      $BB2['orderStatus'];
        $fields["comPayDeptDate"]           =      $BB2['comPayDeptDate'];
        $fields["personPlaintiff"]           =      $BB2['personPlaintiff'];
        $fields["personDefendant"]           =      $BB2['personDefendant'];
        $fields["personCapital"]           =      $BB2['personCapital'];
        $fields["deptName"]           =     ($BB2['deptName']);
        $fields["D_TYPE"]           =      ctext($AA1);
        $fields["DEL"]           =      ctext(1);
        db::db_insert("WF_CASE_TEM1", $fields);
    }
}
echo json_encode($fields);
/* exit; */

$SQL_DATA = " SELECT*FROM WF_CASE_TEM1 A 
WHERE 1=1 
AND A.D_TYPE NOT IN ('Backoffice')
ORDER BY A.D_TYPE DESC";
$qry_DATA = db::query($SQL_DATA);

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

while ($rec_data = db::fetch_array($qry_DATA)) {
    if ($D_TYPE_RE != $rec_data['D_TYPE']) {
        if ($rec_data['D_TYPE'] == 'Mediate') {
            $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบไกล่เกลี่ย';
        } else if ($rec_data['D_TYPE'] == 'Bankrupt') {
            $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบล้มละลาย';
        } else if ($rec_data['D_TYPE'] == 'Revive') {
            $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในระบบฟื้นฟู';
        } else if ($rec_data['D_TYPE'] == 'Backoffice') {
            $show_word = 'Backoffice';
        } else if ($rec_data['D_TYPE'] == 'Civil') {
            $show_word = 'ข้อมูลที่เกี่ยวข้องกับบุคคลในแพ่ง';
        }
        $D_TYPE_RE = $rec_data['D_TYPE'];
        $html .= " <tr>
        <td colspan=\"10\" style=\"background-color:#dc3545 ;color:aliceblue;\">" . $show_word . "</td>
                  </tr>";
        $a = 1;
        $html .= "   <tr style=\"background-color: #E6E6FA;\">";
                $html .= " <td><div align='center'>" .  $a . "</div></td>";
                $html .= "<td>" . $rec_data['REGISTERCODE'] . "</td>";
                $html .= " <td>" . $rec_data['PREFIXNAME'] . " " . $rec_data['FIRSTNAME'] . " " . $rec_data['LASTNAME'] . "</td>";
                $html .= "  <td>" . $rec_data['CONCERNNAME'] . "</td>";
        $A = ($rec_data['BLACKCASE'] != '' && $rec_data['BLACKYY'] != '') ? "/" : "";
        $B = ($rec_data['REDCASE'] != '' && $rec_data['REDYY'] != '') ? "/" : "";
                $html .= "  <td>" . $rec_data['PREFIXBLACKCASE'] . $rec_data['BLACKCASE'] . $A . $rec_data['BLACKYY'] . "</td>";
                $html .= "  <td>" . $rec_data['PREFIXREDCASE'] . $rec_data['REDCASE'] . $B . $rec_data['REDYY'] . "</td>";
                $html .= "  <td><?php echo $rec_data['COURTNAME']; ?></td>";
        $html .= " </tr>";
        $html .= " </table>";
        $html .= "";
        $html .= "";
        $html .= "";
        $html .= "";
        $html .= "";
        $a++;
    }
}

?>

