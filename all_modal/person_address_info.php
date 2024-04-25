<?php

$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
if($_GET['plaintiff']){
  $personId = $_GET['plaintiff'];
  $type = "โจทก์/เจ้าหนี้";
}
if($_GET['defendant']){
  $personId = $_GET['defendant'];
  $type = "จำเลย/ลูกหนี้";
}
if($_GET['sys'] == "mediate"){
  $add = db::query("SELECT * FROM WH_MEDIATE_PERSON_ADDR WHERE WH_PERSON_ID = '".$personId."'");
  $per = db::query("SELECT * FROM WH_MEDIATE_PERSON WHERE WH_PERSON_ID = '".$personId."'");
  $data = db::fetch_array($per);
}
if($_GET['sys'] == "civil"){
  $add = db::query("SELECT * FROM WH_CIVIL_CASE_PERSON_ADDR WHERE WH_PERSON_ID = '".$personId."'");
  $per = db::query("SELECT * FROM WH_CIVIL_CASE_PERSON WHERE WH_PERSON_ID = '".$personId."'");
  $data = db::fetch_array($per);
}
if($_GET['sys'] == "revive"){
  $add = db::query("SELECT * FROM WH_REHABILITATION_PER_ADDR WHERE WH_PERSON_ID = '".$personId."'");
  $per = db::query("SELECT * FROM WH_REHABILITATION_PERSON WHERE WH_PERSON_ID = '".$personId."'");
  $data = db::fetch_array($per);
}
if($_GET['sys'] == "bankrupt"){
  // $add = db::query("SELECT * FROM WH_MEDIATE_PERSON_ADDR WHERE WH_PERSON_ID = '".$personId."'");
}
?>
<div class="row">
  <div class="col-md-12">
    <div class="form-group row">
      <div class="col-md-1 media-body text-left">
        <h4 class="text-left">รายละเอียดที่อยู่ของ<?php echo $type;?></h4>
      </div>
    </div>
    <div class="card">
      <div class="card-block">
        <div class="form-group row">
          <div class="col-md-2">
            <label class="form-control-label wf-right">ชื่อ-สกุล :</label>
          </div>
          <div class="col-md-4">
            <label class="form-control-label wf-left"><?php echo $data['PREFIX_NAME'].$data['FIRST_NAME']." ".$data['LAST_NAME'];?></label>
          </div>
          <div class="col-md-3">
            <label class="form-control-label wf-right">เลขบัตรประชาชน :</label>
          </div>
          <div class="col-md-3">
            <label class="form-control-label wf-left">
              <?php
              if($data['REGISTER_CODE']){
        				$countStr = strlen($data['REGISTER_CODE']);
        				for($j = 1; $j <= $countStr; $j++){
        					$t = substr($data['REGISTER_CODE'],-14 + $j,1);
        					if($j == 2 || $j == 6 || $j == 11 || $j == 13){
        						$registerCode .= "-".$t;
        					}else{
        						$registerCode .= $t;
        					}
        				}
        			}else{
        				$registerCode = "-";
        			}
              echo $registerCode;
              ?>
            </label>
          </div>
        </div>
        <div class="form-group row">
          <table class="table table-bordered sorted_table">
          	<thead class="bg-primary">
          		<tr class="bg-primary">
          			<th class="text-center">ลำดับ</th>
                <th class="text-center">ที่อยู่</th>
          			<th class="text-center">สถานะ</th>
          		</tr>
          	</thead>
          	<tbody>
          		<?php
          		$i = 1;
          		while ($address = db::fetch_array($add)) {
                if($address['ADDRESS']){
                  $ad = $address['ADDRESS'];
                }else{
                  $ad = "-";
                }
                if($address['MOO']){
                  $moo = $address['MOO'];
                }else{
                  $moo = "-";
                }
                if($address['SOI']){
                  $soi = $address['SOI'];
                }else{
                  $soi = "-";
                }
                if($address['ROAD']){
                  $road = $address['ROAD'];
                }else{
                  $road = "-";
                }
                if($address['TUM_NAME']){
                  $tumbon = $address['TUM_NAME'];
                }else{
                  $tumbon = "-";
                }
                if($address['AMP_NAME']){
                  $amphur = $address['AMP_NAME'];
                }else{
                  $amphur = "-";
                }
                if($address['PROV_NAME']){
                  $province = $address['PROV_NAME'];
                }else{
                  $province = "-";
                }
                if($address['ZIP_CODE']){
                  $zipCode = $address['ZIP_CODE'];
                }else{
                  $zipCode = "-";
                }
                if($address['ADDR_FINAL_FLAG'] != 0){
                  if($address['ADDR_FINAL_FLAG'] == 1){
                    $status = "ที่อยู่ตามทะเบียนบ้าน";
                  }else{
                    $status = "ที่อยู่ติดต่อได้";
                  }
                }else{
                  $status = "ไม่ใช้งาน";
                }
                $textAdd = "เลขที่ ".$ad." หมู่ที่ ".$moo." ซอย ".$soi." ถนน ".$road." แขวง ".$tumbon." เขต ".$amphur." จังหวัด ".$province." ไปรษณีย์ ".$zipCode;
          			echo "<tr>
                  <td class=\"text-center\">".$i."</td>
                  <td class=\"text-left\"><nobr>".$textAdd."</nobr></td>
                  <td class=\"text-left\">".$status."</td>
          			</tr>";
          			$i++;
          		}
          		?>
          	</tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
