<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '0');
include "../include/config.php";

$WF_MAIN_ID = "999";
$WFR_ID = "3";
$WFS_FIELD_NAME = "SCAN_FILE";
$scan_name = "scan.pdf";


$attach_folder = '../attach/w'.$WF_MAIN_ID;

     $file_name = 's'.date('YmdHis').'_'.bsf_random(10).'.pdf';
     
    // copy($_FILES[$BSF_DET["WFS_FIELD_NAME"]]["tmp_name"][$a], $attach_folder.'/'.$file_name);
    // @chmod($attach_folder.'/'.$file_name,0777);
      $insert_opt = array();
      $insert_opt['WFS_FIELD_NAME'] = $WFS_FIELD_NAME;
      $insert_opt['WFR_ID'] = $WFR_ID;
      $insert_opt['FILE_NAME'] = $scan_name;
      $insert_opt['FILE_SAVE_NAME'] = $file_name;
      $insert_opt['FILE_EXT'] = "pdf";
      $insert_opt['FILE_SIZE'] = "";
      $insert_opt['FILE_TYPE'] = "";
      $insert_opt['FILE_DATE'] = date2db(date("d/m/").(date("Y")+543));
      $insert_opt['FILE_TIME'] = date("H:i:s");
      $insert_opt['FILE_STATUS'] = 'Y';
      $insert_opt['WF_MAIN_ID'] = $WF_MAIN_ID;
    //  $insert_opt['USR_ID'] = $_SESSION['WF_USER_ID'];
      db::db_insert("WF_FILE", $insert_opt, "FILE_ID");
      unset($insert_opt);
 

db::db_close();
?>