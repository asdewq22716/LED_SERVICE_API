<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
$qry = db::query("SELECT * FROM WH_CIVIL_CASE_ASSETS WHERE ASSET_ID = '".$_GET['id']."'");
$data = db::query($qry);
?>
<div class="row">
 <div class="col-md-12">
   <div class="form-group row">
     <div class="col-md-1 media-body text-left">
       <h4 class="text-left">ข้อมูลทรัพย์</h4>
     </div>
   </div>
   <div class="card-block">
     <div class="form-group row">
       <div class="col-md-2">
         <label class="form-control-label wf-right">ประเภททรัพย์ :</label>
       </div>
       <div class="col-md-4">
         <label class="form-control-label wf-left"><?php echo $data['TYPE_CODE'];?></label>
       </div>
     </div>
     <div class="form-group row">
       <div class="col-md-2">
         <label class="form-control-label wf-right">รายละเอียดทรัพย์ :</label>
       </div>
       <div class="col-md-4">
         <label class="form-control-label wf-left"><?php echo $data['PROP_TITLE'];?></label>
       </div>
     </div>
     <div class="form-group row">
       <div class="col-md-2">
         <label class="form-control-label wf-right">สถานะทรัพย์ :</label>
       </div>
       <div class="col-md-4">
         <label class="form-control-label wf-left"><?php echo $data['PROP_STATUS'];?></label>
       </div>
     </div>
     <div class="table-responsive">
       <table class="table table-bordered sorted_table">
         <thead class="bg-primary">
           <tr class="bg-primary">
             <td class="text-center">ลำดับ</td>
             <td class="text-center">เกี่ยวข้องกับทรัพย์เป็น</td>
             <td class="text-center">ชื่อ-นามสกุล</td>
             <td class="text-center">อัตราส่วนในทรัพย์</td>
           </tr>
         </thead>
         <tbody>
           <?php
           $i = 1;
           $qry = db::query("SELECT
                            	a.*,
                              b.CONCERN_NAME,
                              c.HOLDING_TYPE
                            FROM
                            	WH_CIVIL_CASE_PERSON a
                            	INNER JOIN WH_CIVIL_CASE_MAP_GEN b ON a.WH_PERSON_ID = b.WH_PERSON_ID
                            	INNER JOIN WH_CIVIL_CASE_ASSET_OWNER c ON b.WH_MAP_CASE_GEN_ID = c.WH_MAP_CASE_GEN_ID
                            WHERE
                            	c.WH_ASS_ID = '".$_GET['id']."'");
            $num = db::num_rows($qry);
            if($num > 0){
              while ($own = db::fetch_array($qry)) {
                echo "<tr>
                  <td class=\"text-center\">".$own['CONCERN_NAME']."</td>
                  <td class=\"text-center\">".$own['HOLDING_TYPE']."</td>
                  <td class=\"text-center\">".$own['HOLDING_AMOUNT']."</td>
                </tr>";
                $i++;
              }
            }else{
              echo "<tr>
                <td class=\"text-center\" colspan=\"4\">ไม่พบข้อมูล</td>
              </tr>";
            }
           ?>
         </tbody>
       </table>
     </div>
     <div class="form-group row">
       <div class="col-md-6">&nbsp;</div>
       <div class="col-md-2">
         <label class="form-control-label wf-right">ราคาประเมินของสำนักงานวางทรัพย์ (ราคาประเมินของสำนักงานวางทรัพย์กลาง) :</label>
       </div>
       <div class="col-md-4">
         <label class="form-control-label wf-left"><?php echo $data['EST_VANG_SUB'];?></label>
       </div>
     </div>
     <div class="form-group row">
       <div class="col-md-6">&nbsp;</div>
       <div class="col-md-2">
         <label class="form-control-label wf-right">ราคาประเมินของคณะกรรมการกำหนดราคา (ราคาที่กำหนดโดยคณะกรรมการกำหนดราคาทรัพย์)์ :</label>
       </div>
       <div class="col-md-4">
         <label class="form-control-label wf-left"><?php echo $data['EST_GROUP_AMOUNT'];?></label>
       </div>
     </div>
     <div class="form-group row">
       <div class="col-md-6">&nbsp;</div>
       <div class="col-md-2">
         <label class="form-control-label wf-right">ราคาประเมินของคณะอณุกรรมการกำหนดราคา (ราคาประเมินของเจ้าหนี้ตามคำพิพากษา เจ้าของทรัพย์ ผู้รับจำนำ หรือผู้รับจำนอง) :</label>
       </div>
       <div class="col-md-4">
         <label class="form-control-label wf-left"><?php echo $data['EST_SUB_AMOUNT'];?></label>
       </div>
     </div>
     <div class="form-group row">
       <div class="col-md-6">&nbsp;</div>
       <div class="col-md-2">
         <label class="form-control-label wf-right">ราคาประเมินของเจ้าพนักงานกรมที่ดิน (ราคาประเมินของสำนักประเมินราคาทรัพย์สิน กรมธนารักษ์) :</label>
       </div>
       <div class="col-md-4">
         <label class="form-control-label wf-left"><?php echo $data['EST_DOL'];?></label>
       </div>
     </div>
     <div class="form-group row">
       <div class="col-md-6">&nbsp;</div>
       <div class="col-md-2">
         <label class="form-control-label wf-right">ราคาประเมิน สรุปที่ระบบจะนำไปใช้ :</label>
       </div>
       <div class="col-md-4">
         <label class="form-control-label wf-left"><?php echo $data['EST_PRICE_AMOUNT'];?></label>
       </div>
     </div>
     <div class="form-group row">
       <div class="col-md-6">&nbsp;</div>
       <div class="col-md-2">
         <label class="form-control-label wf-right">ราคาขายได้ :</label>
       </div>
       <div class="col-md-4">
         <label class="form-control-label wf-left"><?php echo $data['SALE_PRICE'];?></label>
       </div>
     </div>
   </div>
 </div>
</div>
