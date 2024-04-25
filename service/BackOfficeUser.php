<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?php echo $TITLE;?></title>
</head>
<body>
<?php
include '../include/include.php';
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
  // include "../include/config_header_top.php";
  // include "../include/config.php";
  // include '../include/include.php';
  // include '../include/func.php';
  // include '../include/config_web.php';
  // include '../include/paging.php';

  // error_reporting(0);
  @session_start();

  $path = '../';
  // include($path."include/config.php");
  // include($path.'include/include.php');
  // include($path.'include/func.php');
  // include($path.'include/config_web.php');
  // include($path.'include/paging.php');
  // require ('../mailer/class.phpmailer.php');

  include 'inlclude/connect_db_service_back.php';
  include "inlclude/config_db_service_back.php";

     $sql = "SELECT
            *
          FROM PER_PROFILE
          WHERE 1=1 ".$filter;
    $query= db2::query($sql);
    while($rec = db2::fetch_array($query)){
      unset($data);
      $data['PER_ID'] = $rec['PER_ID'];
      $data['PREFIX_ID'] = $rec['PREFIX_ID'];
      $data['PER_IDCARD'] = $rec['PER_IDCARD'];
      $data['PREFIX_NAME_TH'] = $rec['PREFIX_NAME_TH'];
      $data['PER_FIRST_NAME_TH'] = $rec['PER_FIRSTNAME_TH'];
      $data['PER_FIRST_NAME_EN'] = $rec['PER_FIRSTNAME_EN'];
      $data['PER_LAST_NAME_TH'] = $rec['PER_LASTNAME_TH'];
      $data['PER_LAST_NAME_EN'] = $rec['PER_LASTNAME_EN'];
      $data['PER_DATE_BIRTH'] = $rec['PER_DATE_BIRTH'];
      $data['POSTYPE_ID'] = $rec['POSTYPE_ID'];

      $data['TYPE_ID'] = $rec['TYPE_ID'];
      $data['LINE_ID'] = $rec['LINE_ID'];
      $data['LEVEL_ID'] = $rec['LEVEL_ID'];
      $data['MANAGE_ID'] = $rec['MANAGE_ID'];
      $data['ORG_ID1'] = $rec['ORG_ID1'];
      $data['ORG_ID2'] = $rec['ORG_ID2'];
      $data['ORG_ID3'] = $rec['ORG_ID3'];
      $data['ORG_ID4'] = $rec['ORG_ID4'];
      $data['POSTYPE_NAME_TH'] = $rec['POSTYPE_NAME_TH'];
      $data['TYPE_NAME_TH'] =  $rec['TYPE_NAME_TH'];

      $data['LINE_NAME_TH'] = $rec['LINE_NAME_TH'];
      $data['LEVEL_NAME_TH'] = $rec['LEVEL_NAME_TH'];
      $data['MANAGE_NAME_TH'] = $rec['MANAGE_NAME_TH'];
      $data['ORG1_NAME_TH'] = $rec['Org1NameTh'];
      $data['ORG2_NAME_TH'] = $rec['Org2NameTh'];
      $data['ORG3_NAME_TH'] = $rec['Org3NameTh'];
      $data['ORG4_NAME_TH'] = $rec['Org4NameTh'];
      $data['ACTIVE_STATUS'] = $rec['ACTIVE_STATUS'];
      $data['UPDATE_DATE'] = $rec['UPDATE_DATE'];
	  
      db::db_insert("WH_BACK_OFFICE_USER", $data, $pkSelectMax = "", $outID = "");
    }

?>
</body>
