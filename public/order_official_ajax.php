<?php
$HIDE_HEADER = 'Y';
include "../include/comtop_user.php";

// include '../service/include/connect_db_service.php';
// include '../service/include/config_db_service.php';

?>

<?php
// echo $_POST['TEMP'];
// print_pre($_POST);
if ($_POST['fn'] == 'save') {
  $sql_person = "SELECT * FROM M_CMD_PERSON WHERE ID_CARD = '" . $_POST['DEPT_CODE'] . "'";
  $rec_person = db::fetch_array($sql_person);
  $num_person = db::num_rows($sql_person);
  if ($num_person == 0) {
    unset($field);
    $field['FIRST_NAME'] = $_POST['PERSON_NAME'];
    $field['ID_CARD'] = $_POST['DEPT_CODE'];
    $person_id = db::db_insert("M_CMD_PERSON", $field, "PERSON_ID", "PERSON_ID");
  } else {
    $person_id = $rec_person['PERSON_ID'];
  }


  $data['OFFICE_IDCARD'] = $_POST['OFFICE_IDCARD'];
  $data['OFFICE_NAME'] = $_POST['OFFICE_NAME'];
  $data['CMD_DOC_DATE'] = date2db($_POST['CMD_DOC_DATE']);
  $data['CMD_DOC_TIME'] = $_POST['CMD_DOC_TIME'];
  $data['CMD_UPDATE_DATE'] = date2db($_POST['CMD_DOC_DATE']);
  $data['CMD_UPDATE_TIME'] = $_POST['CMD_DOC_TIME'];
  // $data['CIVIL_CODE'] = $_POST['CIVIL_CODE'];
  $data['COURT_NAME'] = $_POST['COURT_NAME'];
  $data['T_BLACK_CASE'] = $_POST['T_BLACK_CASE'];
  $data['BLACK_CASE'] = $_POST['BLACK_CASE'];
  $data['BLACK_YY'] = $_POST['BLACK_YY'];
  $data['T_RED_CASE'] = $_POST['T_RED_CASE'];
  $data['RED_CASE'] = $_POST['RED_CASE'];
  $data['RED_YY'] = $_POST['RED_YY'];
  $data['TO_COURT_NAME'] = $_POST['TO_COURT_NAME'];
  $data['TO_T_BLACK_CASE'] = $_POST['TO_T_BLACK_CASE'];
  $data['TO_BLACK_CASE'] = $_POST['TO_BLACK_CASE'];
  $data['TO_BLACK_YY'] = $_POST['TO_BLACK_YY'];
  $data['TO_T_RED_CASE'] = $_POST['TO_T_RED_CASE'];
  $data['TO_RED_CASE'] = $_POST['TO_RED_CASE'];
  $data['TO_RED_YY'] = $_POST['TO_RED_YY'];
  $data['TO_PLAINTIFF'] = $_POST['TO_PLAINTIFF'];
  $data['TO_DEFENDANT'] = $_POST['TO_DEFENDANT'];
  $data['CASE_TYPE'] = $_POST['CASE_TYPE'];
  $data['SEND_TO'] = $_POST['SEND_TO'];
  // $data['CMD_NOTE'] = $_POST['CMD_NOTE'];
  $data['APPROVE_PERSON'] = $_POST['APPROVE_PERSON'];
  $data['CMD_SYSTEM_ID'] = $_POST['SYSTEM_ID'];
  $data['DEPT_NAME'] = $_POST['DEPT_NAME'];
  $data['PLAINTIFF'] = $_POST['PLAINTIFF'];
  $data['DEFENDANT'] = $_POST['DEFENDANT'];
  $data['SEND_STATUS'] = "1";


  $data['SYS_NAME'] = $_POST['SYS_NAME'];
  $data['CMD_TYPE'] = $_POST['CMD_TYPE'];


  $data['PERSON_ID'] = $person_id;
  $cmd_id = db::db_insert("M_DOC_CMD", $data, "ID", "ID");

  //เก็บ cmd_detail
  $sql = "SELECT * FROM USR_MAIN WHERE USR_ID = " . $_POST['USER'];
  $qry = db::query($sql);
  $handle = db::fetch_array($qry);
  $det['CMD_NOTE'] = $_POST['CMD_NOTE'];
  $det['CMD_DETAIL_DATE'] = date2db($_POST['CMD_DOC_DATE']);
  $det['CMD_DETAIL_TIME'] = $_POST['CMD_DOC_TIME'];
  $det['CMD_ID'] = $cmd_id;
  $det['HANDLE_NAME'] = $handle['USR_PREFIX'] . $handle['USR_FNAME'] . " " . $handle['USR_LNAME'];
  db::db_insert("M_CMD_DETAILS", $det, "CMD_DETAIL_ID");

  //update wfr_id เพื่อให้เห็นไฟล์ที่คู่กับคดี
  $sql = db::query("SELECT * FROM FRM_CMD_FILE WHERE WF_MAIN_ID = 116 AND F_TEMP_ID = '" . $_POST['TEMP'] . "'");
  $rec = db::fetch_array($sql);
  $count = db::num_rows($rec);
  if ($count > 0) {
    $cond_file['WF_MAIN_ID'] = 116;
    $cond_file['F_TEMP_ID'] = $_POST['TEMP'];
    $field_update['WFR_ID'] = $cmd_id;
    $field_update['F_TEMP_ID'] = $cmd_id;
    $field_update['APPROVE_STATUS'] = 1;

    db::db_update("FRM_CMD_FILE", $field_update, $cond_file);
  }
} else if ($_POST['fn'] == 'data_form') {
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
          LEFT JOIN WF_FILE DF ON DF.WFR_ID = A.F_ID AND DF.WF_MAIN_ID = '117'
          WHERE
             A.WF_MAIN_ID = '116' AND
            (A.WFR_ID = '" . $_POST['wfr'] . "' OR A.F_TEMP_ID = '" . $_POST['wfr'] . "')
          ORDER BY A.F_ID ASC
          ";
  $query = db::query($sql);
  $i = 0;
  while ($rec = db::fetch_array($query)) {
    // print_pre($rec);
?>
    <tr id="bsf_f_id<?php echo $rec['F_ID']; ?>">
      <td class="text-center"><?php echo ++$i; ?></td>
      <td class="text-left"><?php echo $rec['CMD_FILE_TYPE']; ?><input type="hidden" value="<?php echo $rec['CMD_FILE_TYPE']; ?>"></td>
      <td class="text-center">
        <div class="row">
          <div class="data_table_main icon-list-demo">
            <div id="BSA_FILE725" class="to-do-list col-sm-12" title="<?php echo $rec['FILE_NAME']; ?>">
              <?php
              if ($rec['FILE_EXT'] == 'pdf') {
              ?>
                <b class="fa fa-file-pdf-o text-danger"></b>
              <?php
              } else if ($rec['FILE_EXT'] == 'doc' || $rec['FILE_EXT'] == 'docx') {
              ?>
                <b class="fa fa-file-word-o text-info"></b>
              <?php
              }
              ?>
              <a href="../attach/w117/<?php echo $rec['FILE_SAVE_NAME']; ?>" target="_blank">
                <?php echo $rec['FILE_NAME']; ?>
              </a>
              <input hidden id="FILE_SAVE_NAME" name="FILE_SAVE_NAME[]" value="<?php echo $rec['FILE_SAVE_NAME']; ?>" />
              <input hidden id="FILE_NAME" name="FILE_NAME[]" value="<?php echo $rec['FILE_NAME']; ?>" />
              <input hidden id="FILE_EXT" name="FILE_EXT[]" value="<?php echo $rec['FILE_EXT']; ?>" />
              <input hidden id="FILE_ID" name="FILE_ID[]" value="<?php echo $rec['FILE_ID']; ?>" />
              <input hidden id="WFS_FIELD_NAME" name="WFS_FIELD_NAME[]" value="<?php echo $rec['WFS_FIELD_NAME']; ?>" />
              <input hidden id="FILE_SIZE" name="FILE_SIZE[]" value="<?php echo $rec['FILE_SIZE']; ?>" />
              <input hidden id="FILE_TYPE" name="FILE_TYPE[]" value="<?php echo $rec['FILE_TYPE']; ?>" />
              <input hidden id="WFR_ID" name="WFR_ID[]" value="<?php echo $rec['WFR_ID']; ?>" />
            </div>
          </div>
        </div>
        <input type="hidden" value="">
      </td>
      <td class="text-center">
        <nobr>
          <a href="#!" class="btn btn-success btn-mini" title="" data-toggle="modal" data-target="#bizModal_3440" onclick="open_modal('../workflow/form_mgt.php?W=117&WFS=<?php echo $rec['WFS_ID']; ?>&WFD=0&WFR_ID=<?php echo $rec['WFR_ID'] ?>&WFR_ID=<?php echo $rec['WFR_ID'] ?>&F_TEMP_ID=<?php echo $rec['F_TEMP_ID']; ?>&WFR=<?php echo $rec['F_ID']; ?>&wfp=', '','_3440')">
            <!-- <a href="#!" class="btn btn-success btn-mini" title="" data-toggle="modal" data-target="#bizModal_3440" onclick="open_modal('form_mgt.php?W=117&amp;WFS=3440&amp;WFD=0&amp;WFR_ID=0&amp;WFR_ID=0&amp;F_TEMP_ID=3709618&amp;WFR=3&amp;wfp=', '','_3440')"> -->
            <i class="icofont icofont-ui-edit"></i> แก้ไข
          </a> &nbsp;
          <a href="#!" class="btn btn-danger btn-mini" title="" onclick="bsf_del_form('117','<?php echo $rec['WFS_ID']; ?>','<?php echo $rec['WFR_ID']; ?>','<?php echo $rec['F_TEMP_ID']; ?>','0','<?php echo $rec['F_ID']; ?>');">
            <!-- <a href="#!" class="btn btn-danger btn-mini" title="" onclick="bsf_del_form('117','3440','<?php // echo $_POST['wfr']
                                                                                                            ?>','<? php // echo $_POST['wfr']
                                                                                                                  ?>','0','<? php // echo $rec['FID']
                                                                                                                            ?>');"> -->
            <i class="icofont icofont-trash"></i> ลบ
          </a>
        </nobr>
      </td>
    </tr>
  <?php
  }
} else if ($_POST['fn'] == 'get_service') {
  $sql = "SELECT DISTINCT
		CMD_GRP_NAME,B.CMD_TYPE_ID
		FROM
		M_CMD_TYPE A
		LEFT JOIN M_SERVICE_CMD B ON A.CMD_TYPE_ID = B.CMD_TYPE_ID
		LEFT JOIN M_CMD_SYSTEM C ON B.CMD_SYS_NAME = C.CMD_SYSTEM_ID
		WHERE CMD_SYSTEM_ID = '" . $_POST['id'] . "'
		ORDER BY
		A.CMD_GRP_NAME ASC
	   ";
  $query = db::query($sql);
  $i = 0;
  ?>
  <option value="" disabled selected>เลือกประเภทคำสั่ง</option>
  <?php
  while ($rec = db::fetch_array($query)) {
  ?>
    <option value="<?php echo $rec['CMD_TYPE_ID']; ?>"><?php echo $rec['CMD_GRP_NAME']; ?></option>
  <?php
  }
} else if ($_POST['fn2'] == 'get_service2') {
  $sql2 = "SELECT DISTINCT
	CMD_TYPE_NAME,CMD_TYPE_CODE
   FROM M_SERVICE_CMD A
   LEFT JOIN M_CMD_SYSTEM B ON A.CMD_SYS_ID = B.CMD_SYSTEM_ID
   LEFT JOIN M_CMD_TYPE C ON A.CMD_TYPE_ID = C.CMD_TYPE_ID
   WHERE
	A.CMD_TYPE_ID = '" . $_POST['id'] . "'AND CMD_STATUS = 1 and b.CMD_SYSTEM_ID = " . $_POST["code"] . "
   ORDER BY A.CMD_TYPE_NAME ASC";
  $query2 = db::query($sql2);
  $i = 0;
  //echo $sql2;
  ?>
  <style>
    .select2{
      width: 400PX;
      max-width: 400PX;
    }
  </style>
  <option value="" disabled selected>เลือกคำสั่ง</option>
  <?php
  while ($dataqry = db::fetch_array($query2)) {
  ?>
    <option value="<?php echo $dataqry['CMD_TYPE_CODE']; ?>"><?php echo $dataqry['CMD_TYPE_NAME']; ?></option>
  <?php
  }
} else if ($_POST['fn2'] == 'get_serviceEdit') {
  if (!empty($_POST['CMD_TYPE_CODE'])) {
    $fill = "AND A.CMD_TYPE_CODE ='" . $_POST['CMD_TYPE_CODE'] . "'";
  }
  $sql2 = "SELECT DISTINCT
	CMD_TYPE_NAME,CMD_TYPE_CODE
   FROM M_SERVICE_CMD A
   LEFT JOIN M_CMD_SYSTEM B ON A.CMD_SYS_ID = B.CMD_SYSTEM_ID
   LEFT JOIN M_CMD_TYPE C ON A.CMD_TYPE_ID = C.CMD_TYPE_ID
   WHERE
	A.CMD_TYPE_ID = '" . $_POST['id'] . "'AND CMD_STATUS = 1 and b.CMD_SYSTEM_ID = " . $_POST["code"] . "
  {$fill}
   ORDER BY A.CMD_TYPE_NAME ASC";
  $query2 = db::query($sql2);
  $i = 0;
  //echo $sql2;
  ?>
  <option value="" disabled selected>เลือกคำสั่ง</option>
  <?php
  while ($dataqry = db::fetch_array($query2)) {
  ?>
    <option value="<?php echo $dataqry['CMD_TYPE_CODE']; ?>" <?php echo ($dataqry['CMD_TYPE_CODE'] == $_POST['CMD_TYPE_CODE'] ? "selected" : "") ?>><?php echo $dataqry['CMD_TYPE_NAME']; ?></option>
  <?php
  }
  ?>
  
<?php
}
?>