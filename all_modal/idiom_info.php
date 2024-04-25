<!-- โครงไว้กลับมาทำใหม่ในอนาคต cumming soon  (-_-) -->
<?php
// $HIDE_HEADER = "Y";
// include '../include/comtop_user.php';
// $data = db::query("SELECT * FROM WH_REHABILITATION_ANC WHERE WH_COURT_REB_ID = '".$_GET['id']."'");
// $command = db::query("SELECT * FROM WH_REHABILITATION_COURT WHERE WH_REHAB_ID = '".$_GET['id']."'");
// $cmd = db::fetch_array($command);
// print_r($cmd);
 ?>
 <!-- <div class="row">
   <div class="col-md-12">
     <div class="form-group row">
       <div class="col-md-1 media-body text-left">
         <h4 class="text-left">รายละเอียดคำสั่งศาล</h4>
       </div>
     </div>
     <div class="card">
       <div class="card-block">
         <div class="form-group row">
           <div class="col-md-2">
             <label class="form-control-label wf-right">คำสั่ง :</label>
           </div>
           <div class="col-md-4">
             <label class="form-control-label wf-left"><?php echo $cmd['COURT_ORDER_NAME'];?></label>
           </div>
           <div class="col-md-3">
             <label class="form-control-label wf-right">วันที่มีคำสั่ง :</label>
           </div>
           <div class="col-md-3"><label class="form-control-label wf-left"><?php echo db2date($cmd['COURT_ORDER_DATE']);?></label></div>
         </div>
         <div class="form-group row">
           <table class="table table-bordered sorted_table">
           	<thead class="bg-primary">
           		<tr class="bg-primary">
           			<th class="text-center">ลำดับ</th>
                 <th class="text-center">เลขที่หนังสือ</th>
                 <th class="text-center">วันที่ลงราชกิจจานุเบกษา</th>
                 <th class="text-center">รายละเอียด</th>
                 <th class="text-center">หน้า/ตอน/เล่ม</th>
           		</tr>
           	</thead>
           	<tbody>
           		<?php
           		// $i = 1;
           		// while ($detail = db::fetch_array($data)) {
           		// 	echo "<tr>
              //     <td class=\"text-center\">".$i."</td>
              //     <td class=\"text-center\">".$detail['ANC_DOC_NO']."</td>
              //     <td class=\"text-center\">".db2date($detail['ANC_DOC_DATE'])."</td>
              //     <td class=\"text-left\">".$detail['ANC_DETAILS']."</td>
              //     <td class=\"text-center\">".$detail['ANC_NUM_1']."/".$detail['ANC_NUM_2']."/".$detail['ANC_NUM_3']."</td>
              //   </tr>";
           		// 	$i++;
           		// }
           		?>
           	</tbody>
           </table>
         </div>
       </div>
     </div>
   </div>
 </div> -->
