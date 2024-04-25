<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
// print_pre($_GET);
$qry_group = db::query("SELECT * FROM M_PRIVILEGE_GROUP WHERE PRIVILEGE_GROUP_STATUS = 1");
?>
<div class="row" id="animationSandbox">
  <div class="col-sm-12">
    <div class="main-header">
      <div class="media m-b-12">
        <div class="media-body text-left">
          <h4 class="text-left">ตั้งค่ากลุ่มสิทธิ์ผู้ใช้งาน</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-block">
          <div class="form-group row">
            <div class="col-md-4">
              <label class="form-control-label wf-right">เลือกกลุ่มสิทธิ์ผู้ใช้</label>
            </div>
            <div class="col-md-4">
              <select name="usr_group" id="usr_group" class="form-control select2">
                <option value="" disabled selected>เลือกประเภทกลุ่มสิทธิ์ผู้ใช้งาน</option>
                <?php
                while($rec_group = db::fetch_array($qry_group)) {?>
                  <option value="<?php echo $rec_group['PRIVILEGE_GROUP_ID'];?>"><?php echo $rec_group['PRIVILEGE_GROUP_NAME'];?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-12 text-center">
            <button class="btn btn-success" onclick="save_usr_group();">บันทึก</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function save_usr_group(){
  var group_id = $('#usr_group').val();
  var usr_id = '<?php echo $_GET['ID']?>';

  // alert(group_id+","+usr_id);
  $.ajax({
  		type: "POST",
  		// processData: false,
  		// contentType: false,
  		url:'../save/save_usr_group.php',
  		data: {
        group_id : group_id,
        usr_id  : usr_id
      },
  		success: function(data) {
        $('#bizModal').modal('hide');
  		}
  });
}
$('.select2').select2();
</script>
