<?php

if ($update_wf) {
   foreach ($update_wf as $key => $val) {
      $update_wf[$key] = conText($val);
   }
}

if (isset($_POST['USR_PASSWORD'])) {
   $feild['USR_PASSWORD'] = md5($_POST['USR_PASSWORD']);
   db::db_update("USER_API_SERVICE", $feild, array('USR_ID' => $_POST['WFR']));
   $update_wf['USR_PASSWORD'] = $feild['USR_PASSWORD'];
} else {
   $sql = db::query("SELECT USR_PASSWORD FROM  USER_API_SERVICE WHERE USR_ID = '" . $_POST['WFR'] . "'");
   $data_sql = db::fetch_array($sql);
   $update_wf['USR_PASSWORD'] = $data_sql['USR_PASSWORD'];
}
