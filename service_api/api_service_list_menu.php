<div class="form-group">
  <select class="form-control select2" id="exampleFormControlSelect1" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
    <option disabled selected>เลือก service</option>
    <option value="http://103.208.27.224:81/led_service_api/public/api_service_list.php">ตั้งค่ารายการ Service API</option>
    <optgroup label="ระบบงานบังคับคดีแพ่ง">
      <?php
      $civil_data = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานบังคับคดีแพ่ง'");
      while ($rec_civil = db::fetch_array($civil_data)) {
        echo "<option value=\"http://103.208.27.224:81/led_service_api/public/user_doc_api_1.php?SERVICE_ID=".$rec_civil['SERVICE_MANAGE_ID']."\">".$rec_civil['SERVICE_CODE']." : ".$rec_civil['SERVICE_DESC']."</option>";
      }?>
    </option>
    <optgroup label="ระบบงานบังคับคดีล้มละลาย">
      <?php
      $bankrupt_data = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานบังคับคดีล้มละลาย'");
      while ($rec_bankrupt = db::fetch_array($bankrupt_data)) {
        echo "<option value=\"http://103.208.27.224:81/led_service_api/public/user_doc_api_1.php?SERVICE_ID=".$rec_bankrupt['SERVICE_MANAGE_ID']."\">".$rec_bankrupt['SERVICE_CODE']." : ".$rec_bankrupt['SERVICE_DESC']."</option>";
      }?>
    </option>
    <optgroup label="ระบบงานฟื้นฟูกิจการของลูกหนี้">
      <?php
      $revive_data = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานฟื้นฟูกิจการของลูกหนี้'");
      while ($rec_revive = db::fetch_array($revive_data)) {
        echo "<option value=\"http://103.208.27.224:81/led_service_api/public/user_doc_api_1.php?SERVICE_ID=".$rec_revive['SERVICE_MANAGE_ID']."\">".$rec_revive['SERVICE_CODE']." : ".$rec_revive['SERVICE_DESC']."</option>";
      }?>
    </option>
    <optgroup label="ระบบงานไกล่เกลี่ยข้อพิพาท">
      <?php
      $mediate_data = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบงานไกล่เกลี่ยข้อพิพาท'");
      while ($rec_mediate = db::fetch_array($mediate_data)) {
        echo "<option value=\"http://103.208.27.224:81/led_service_api/public/user_doc_api_1.php?SERVICE_ID=".$rec_mediate['SERVICE_MANAGE_ID']."\">".$rec_mediate['SERVICE_CODE']." : ".$rec_mediate['SERVICE_DESC']."</option>";
      }?>
    </option>
    <optgroup label="ระบบ Back office">
      <?php
      $back_data = db::query("SELECT * FROM M_SERVICE_MANAGE WHERE SYS_DETAIL = 'ระบบ Back office'");
      while ($rec_back = db::fetch_array($back_data)) {
        echo "<option value=\"http://103.208.27.224:81/led_service_api/public/user_doc_api_1.php?SERVICE_ID=".$rec_back['SERVICE_MANAGE_ID']."\">".$rec_back['SERVICE_CODE']." : ".$rec_back['SERVICE_DESC']."</option>";
      }?>
    </option>
  </select>
</div>
