
<?php
session_start();
include 'include/comtop_user.php';
include 'comtop.php';?>
    <!--::header part start::-->
    <?php include 'header.php';?>
    <!-- Header part end-->
    <link rel="stylesheet" href="css/select2.min.css">
<style>
    .error {
    width: 92%;
    margin: 0px auto;
    padding: 20px 10px 10px;
    border: 1px solid #a94442;
    color: #a94442;
    background: #f2dede;
    border-radius: 5px;
    text-align: center;
}

</style>
    <!-- breadcrumb start -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>ลงทะเบียนสมัครใช้งาน WebService API กรมบังคับคดี</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->


    <section id="tabs">
    	<div class="container">
      		<div class="row">
    			<div class="col-lg-12">
    				<nav>
    					<div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
    						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><span class="badge label-no">1</span> เงื่อนไข/Condition</a>
    						<a class="nav-item nav-link disabled" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><span class="badge label-no">2</span> ลงทะเบียน</a>
<!--
    						<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><span class="badge label-no">3</span> ลงทะเบียน E-Filing</a>
    						<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false"><span class="badge label-no">4</span> ยืนยันตัวตน E-Filing LED</a>
-->
    					</div>
    				</nav>
    				<div class="tab-content px-3 px-sm-0" id="nav-tabContent">
    					<div class="tab-pane fade  show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    						<div class="padding-20 shadow text-center">
                  <h4 class="mt-3 mb-5 bold">เงื่อนไขข้อตกลงการสมัครใช้งาน WebService API</h4>
                  กรมบังคับคดีได้จัดทำขึ้นเพื่อเป็นแนวทางและแนวปฏิบัติในการใช้บริการเว็บไซต์ของผู้ใช้บริการจะอยู่ภายใต้เงื่อนไขและข้อกำหนดดังต่อไปนี้ ผู้ใช้บริการจึงควรศึกษาเงื่อนไข และข้อกำหนดการใช้งานเว็บไซต์ และ/หรือเงื่อนไขและข้อตกลงอื่นใดที่ (หน่วยงาน/เว็บไซต์) ได้แจ้งให้ทราบบนเว็บไซต์โดยละเอียดก่อนการเข้าใช้บริการ ทั้งนี้ ในการใช้บริการให้ถือว่าผู้ใช้บริการได้ตกลงที่จะปฏิบัติตามเงื่อนไขและข้อกำหนดการให้บริการที่กำหนดไว้นี้ หากผู้ใช้บริการไม่ประสงค์ที่จะผูกพันตามข้อกำหนดและเงื่อนไขการให้บริการ ขอความกรุณาท่านยุติการเข้าชมและใช้งานเว็บไซต์นี้ในทันที
                <table>
                    <h5 class="mt-3 mb-2 bold"  align="left">เงื่อนไขและข้อกำหนดการใช้งานเว็บไซต์</h5>

                    <td align="left">1.	ผู้ใช้บริการอาจได้รับ เข้าถึง สร้าง ส่งหรือแสดงข้อมูล เช่น ไฟล์ข้อมูล ข้อความลายลักษณ์อักษร ซอฟต์แวร์คอมพิวเตอร์ ดนตรี ไฟล์เสียง หรือเสียงอื่นๆ ภาพถ่าย วิดีโอ หรือรูปภาพอื่นๆ โดยเป็นส่วนหนึ่งของบริการหรือโดยผ่านการใช้บริการ ซึ่งต่อไปนี้เรียกว่า “เนื้อหา”
                                <br> 2.	เนื้อหาที่นำเสนอต่อผู้ใช้บริการ อาจได้รับการคุ้มครองโดยสิทธิในทรัพย์สินทางปัญญาของเจ้าของเนื้อหานั้น ผู้ใช้บริการไม่มีสิทธิเปลี่ยนแปลงแก้ไข จำหน่ายจ่ายโอนหรือสร้างผลงานต่อเนื่องโดยอาศัยเนื้อหาดังกล่าวไม่ว่าจะทั้งหมดหรือบางส่วน เว้นแต่ผู้ใช้บริการจะได้รับอนุญาตโดยชัดแจ้งจากเจ้าของเนื้อหานั้น
                                <br> 3.	กรมบังคับคดีทรงไว้ซึ่งสิทธิในการคัดกรอง ตรวจทาน ทำเครื่องหมาย เปลี่ยนแปลง แก้ไข ปฏิเสธ หรือลบเนื้อหาใดๆ ที่ไม่เหมาะสมออกจากบริการ ซึ่งกรมบังคับคดีอาจจัดเตรียมเครื่องมือในการคัดกรองเนื้อหาอย่างชัดเจน โดยไม่ขัดต่อกฎหมาย กฎระเบียบของทางราชการที่เกี่ยวข้อง
                                <br> 4.	กรมบังคับคดีอาจหยุดให้บริการเป็นการชั่วคราวหรือถาวร หรือยกเลิกการให้บริการแก่ผู้ใช้บริการรายใดเป็นการเฉพาะ หากการให้บริการดังกล่าวส่งผลกระทบต่อผู้ใช้บริการอื่นๆ หรือขัดแย้งต่อกฎหมาย โดยไม่ต้องแจ้งให้ผู้ใช้บริการทราบล่วงหน้า
                                <br> 5.	การหยุดหรือการยกเลิกบริการตามข้อ 2.5 ผู้ใช้บริหารจะไม่สามารถเข้าใช้บริการ และเข้าถึงรายละเอียดบัญชีของผู้ใช้บริการ หรือเนื้อหาอื่นๆ ที่อยู่ในบัญชีของผู้ใช้บริการได้
                                <br> 6.	ในกรณีที่กรมบังคับคดีหยุดให้บริการเป็นการถาวร หรือยกเลิกบริการแก่ผู้ใช้บริการ กรมบังคับคดีมีสิทธิในการลบข้อมูลต่างๆ ที่อยู่ในบัญชีของผู้ใช้บริการได้ โดยไม่ต้องแจ้งให้ผู้ใช้บริการทราบล่วงหน้า
                    </td>
                </table>
                <table>
                    <h5 class="mt-3 mb-2 bold"  align="left">สิทธิ หน้าที่ และความรับผิดชอบของผู้ใช้บริการ</h5>

                    <td align="left">1.	ผู้ใช้บริการจะให้ข้อมูลเกี่ยวกับตนเอง เช่น ข้อมูลระบุตัวตนหรือรายละเอียดการติดต่อ ที่ถูกต้อง เป็นจริง และเป็นปัจจุบันเสมอ แก่กรมบังคับคดี อันเป็นส่วนหนึ่งของกระบวนการลงทะเบียนใช้บริการ หรือการใช้บริการที่ต่อเนื่อง
                                <br> 2.	ผู้ใช้บริการจะใช้บริการเว็บไซต์นี้ เพื่อวัตถุประสงค์ที่ได้รับอนุญาตตามข้อกำหนดของกรมบังคับคดี และไม่ขัดต่อกฎหมาย กฎ ระเบียบ ข้อบังคับ หลักปฏิบัติที่เป็นที่ยอมรับโดยทั่วไป
                                <br> 3.	ผู้ใช้บริการจะไม่เข้าใช้หรือพยายามเข้าใช้บริการหนึ่งบริการใดโดยวิธีอื่น รวมถึงการใช้วิธีอัตโนมัติ (การใช้สคริปต์) นอกจากช่องทางที่จัดเตรียมไว้ให้เว้นแต่ผู้ใช้บริการจะได้รับอนุญาตจากกรมบังคับคดี โดยชัดแจงให้ทำเช่นนั้นได้
                                <br> 4.	ผู้ใช้บริการจะไม่ทำหรือมีส่วนร่วมในการขัดขวางหรือรบกวนบริการของกรมบังคับคดี รวมทั้งเครื่องแม่ข่ายและเครือข่ายที่เชื่อมต่อกับบริการ
                                <br> 5.	ผู้ใช้บริการจะไม่ทำสำเนา คัดลอก ทำซ้ำ ขาย แลกเปลี่ยน หรือขายต่อบริการเพื่อวัตถุประสงค์ใดๆ
                                <br> 6.	ผู้ใช้บริการมีหน้าที่ในการรักษาความลับของรหัสผ่านที่เชื่อมโยงกับบัญชีใดๆ ที่ใช้ในการเข้าถึงบริการ
                                <br> 7.	ผู้ใช้บริการจะเป็นผู้รับผิดชอบแต่เพียงผู้เดียวต่อบุคคลใดๆ รวมถึง กรมบังคับคดีในความเสียหายอันเกิดจากการละเมิดข้อกำหนด
                    </td>
                </table>
                <table>
                    <h5 class="mt-3 mb-2 bold"  align="left">การเชื่อมโยงกับเว็บไซต์อื่นๆ</h5>

                    <td align="left">กรณีต้องการเชื่อมโยงมายังเว็บไซต์ของกรมบังคับคดี ผู้ใช้บริการสามารถเชื่อมโยงมายังหน้าแรกของเว็บไซต์ของกรมบังคับคดีได้ โดยแจ้งความประสงค์เป็นหนังสือ แต่หากต้องการเชื่อมโยงมายังภายในของเว็บไซต์นี้
                    จะต้องได้รับความยินยอมเป็นหนังสือจากกรมบังคับคดีแล้วเท่านั้น และในการให้ความยินยอมดังกล่าว กรมบังคับคดีขอสงวนสิทธิที่จะกำหนดเงื่อนไขใดๆ ไว้ด้วยก็ได้ ในการที่เว็บไซต์อื่น ที่เชื่อมโยงมายังเว็บไซต์ของกรมบังคับคดี
                    จะไม่รับผิดชอบต่อเนื้อหาใดๆ ที่แสดงบนเว็บไซต์ที่เชื่อมโยงเว็บไซต์ของกรมบังคับคดี หรือต่อความเสียหายใดๆ ที่เกิดขึ้นจากการใช้เว็บไซต์เหล่านั้น
                    </td>
                </table>
                
                  <div class="form-group form-check mt-3 mb-3 ">
                    <input type="checkbox" class="form-check-input" id="Check1" >
                    <label class="form-check-label" for="exampleCheck1"> คลิกตกลงยอมรับเงื่อนไขข้อตกลงการใช้</label>
                  </div>
                        <div class="text-center">
                            <!-- <a type="button" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"  class="btn btn-primary shadow">ตกลงยอมรับ</a> -->
                            <button type="button" id="btnsubmit" class="btn btn-primary shadow">ตกลงยอมรับ</button>
                        </div>
                
                </div>
    					</div>
    					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="padding-20 shadow" >
                  <h4  class="mt-3 mb-5 bold">ลงทะเบียน</h4>
                  <form action="save_user_register.php"  method="post" >
                    <div class="form-row">
                      <div class="form-group col-md-6 col-sm-4" >
                        <label for="inputfistnameth" class=" title-label">หน่วยงาน/บริษัท/อื่นๆ *</label>
                 
                        <select class="js-example-basic-single"  name="SYS_TYPE" id="SYS_TYPE"  required>
                            <option value="">เลือก</option>
                            <?php
                                $sql_sys = db::query("SELECT * FROM M_SYSTEM WHERE SYS_TYPE = 2 AND SYS_STATUS = 1");
                                while($row = db::fetch_array($sql_sys)){ ?>
                                <option value="<?php echo $row['SYSTEM_ID']; ?>">
                                    <?php echo $row['SYS_NAME']; ?></option>
                                <?php } ?>
                        </select>
                       </div>

                      
                        <!-- <div class="form-group col-md-3 col-sm-4">
                          <label for="inputlastnameth" class=" title-label">อีเมล *</label>
                          <input type="text"  name="USR_EMAIL" id="USR_EMAIL" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                           required class="single-input"><span id="sEmail"></span>
                         </div> -->
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-3 col-sm-4">
                         <label for="ID_CARD" class=" title-label">เลขประจำตัวประชาชน *</label>
                         <input type="text" name="ID_CARD" id="ID_CARD" pattern='[0-9]{13}'
                          required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-5">
                        <label for="inputfirstnameen" class=" title-label">คำนำหน้าชื่อ*</label>
                        <div>
                          <select class="js-example-basic-single" name="USR_PREFIX" id="USR_PREFIX" >
                            <option value="">เลือก</option>
                            <?php
                            $sql_pre = db::query("SELECT * FROM M_PREFIX_MAP ORDER BY P_ID DESC");
                            while($pre_name = db::fetch_array($sql_pre)){ ?>
                              <option value="<?php echo $pre_name['P_NAME_BOF']; ?>">
                                  <?php echo $pre_name['P_NAME_BOF']; ?></option>
                              <?php } ?>
                          </select>
                          </div>
                        <!-- <input type="text" name="inputfirstnameen" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                         required class="single-input"> -->
                      </div>
                      <div class="form-group col-md-3 col-sm-5">
                        <label for="inputfirstnameen" class=" title-label">ชื่อ *</label>
                        <input type="text" name="USR_FNAME" id="USR_FNAME" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                         required class="single-input">
                       </div>
                       <div class="form-group col-md-3 col-sm-5">
                         <label for="inputmiddlenameen" class=" title-label">นามสกุล *</label>
                         <input type="text" name="USR_LNAME" id="USR_LNAME"  placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                          required class="single-input">
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3 col-sm-4">
                            <label for="inputlastnameth" class=" title-label">อีเมล *</label>
                            <input type="text"  name="USR_EMAIL" id="USR_EMAIL" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                            required class="single-input"><span id="sEmail"></span>
                        </div>
                        <div class="form-group col-md-3 col-sm-4">
                            <label for="USR_USERNAME" class=" title-label">บัญชีผู้ใช้ *</label>
                            <input type="text" name="USR_USERNAME" id="USR_USERNAME" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                            required class="single-input"><span id="sUser" ></span>
                        </div>
                        <div class="form-group col-md-3 col-sm-5">
                          <label for="inputlastnameen" class=" title-label">พาสเวิร์ด *</label>
                          <input type="text"  autocomplete="off" name="USR_PASSWORD" id="USR_PASSWORD" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                           required class="single-input">
                         </div>
                        <div class="form-group col-md-3 col-sm-5">
                          <label for="inputlastnameen" class=" title-label">ยืนยันพาสเวิร์ด *</label>
                          <input type="text"  autocomplete="off" name="USR_PASSWORD1" id="USR_PASSWORD1" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                           required class="single-input"><span id="sPass"></span>
                         </div>
                        
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" name="reg_user" id="reg_user" class="btn btn-primary  border-radius-5 shadow"><em class="fa fa-save"></em> บันทึกข้อมูล</button>
<!--                        <button type="submit" class="btn btn-secondary  border-radius-5 shadow">ทำรายการต่อไป <em class="fas fa-long-arrow-alt-right"></em></button>-->


                    </div>
                  </form>
                </div>
    		</div>


    					<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="padding-20 shadow">

                  <!-- Start แสดงข้อมูลส่วนที่ 1 ดึงมาแสดงเลย -->
                  <div class="bg-gray">
                    <div class="row">
                      <div class="col-md-3 label--tittle ">
                        ประเภทบุคคล (Person type)
                      </div>
                      <div class="col-md-9 label--text bold">
                      บุคคลธรรมดา
                      </div>
                      <div class="col-md-3 label--tittle ">
                        เลือก (Choose)
                      </div>
                      <div class="col-md-3 label--text bold">
                        บัตรประจำตัวประชาชน (3321100093041111)
                      </div>

                      <div class="col-md-3 label--tittle">
                        ไฟล์แนบ
                      </div>
                      <div class="col-md-3 label--text bold">
                        <button type="button" class="btn btn-success">  Download <em class="fa fa-download"></em></button>

                      </div>
                      <div class="col-md-3 label--tittle">
                        ชื่อ-สกุล
                      </div>
                      <div class="col-md-3 label--text bold">
                        นาย ณเดช เบรี่ คูกิคากิ
                      </div>
                      <div class="col-md-3 label--tittle">
                        Name-Lastname
                      </div>
                      <div class="col-md-3 label--text bold">
                        Mr. Nadash Berry KukiKaki
                      </div>
                      <div class="col-md-3 label--tittle">
                        วันเกิด (Date of birth)
                      </div>
                      <div class="col-md-3 label--text bold">
                        01/12/2530
                      </div>
                      <div class="col-md-3 label--tittle">
                        อายุ (age)
                      </div>
                      <div class="col-md-3 label--text bold">
                        30 ปี
                      </div>
                      <div class="col-md-3 label--tittle">
                        โทรศัพท์ (Phone)
                      </div>
                      <div class="col-md-3 label--text bold">
                        +6609812354xxx
                      </div>
                      <div class="col-md-3 label--tittle">
                        อีเมล (email)
                      </div>
                      <div class="col-md-3 label--text bold">
                        nadash.k@gmail.com
                      </div>
                    </div>
                  </div>
                  <!-- End แสดงข้อมูลส่วนที่ 1 -->
                  <br />

                  <div class="text-center"><h4 class="mt-3 mb-3 bold">ลงทะเบียน E-Filing</h4></div>
                  <!-- Start แบบฟอร์มข้อมูลส่วนที่ 1 ที่อยู่ตามทะเบียนราษฏร์ -->
                  <form>
                  <span class="badge label-no">1</span><span class="bold">ที่อยู่ตามทะเบียนราษฏร์</span>
                  <div class="mt-3 mb-3">
                      <div class="form-row">
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputaddressno" class="title-label">ที่อยู่ (Address)</label>
                          <input type="text" name="inputaddressno" placeholder="กรอกที่อยู่" onfocus="this.placeholder = ''" onblur="this.placeholder = 'กรอกที่อยู่'"
          								 required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputVillage" class="title-label">หมู่ที่ (Village no. (Moo))</label>
                          <input type="text" name="inputVillage" placeholder="หมู่ที่ " onfocus="this.placeholder = ''" onblur="this.placeholder = 'หมู่ที่'"
          								 required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputUnitno" class="title-label">ห้องเลขที่ (Unit no.)</label>
                          <input type="text" name="inputUnitno" placeholder="ห้องเลขที " onfocus="this.placeholder = ''" onblur="this.placeholder = 'ห้องเลขที่'"
          								 required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputFloor" class="title-label">ชั้น (Floor)</label>
                          <input type="text" name="inputFloor" placeholder="ชั้น  " onfocus="this.placeholder = ''" onblur="this.placeholder = 'ชั้น'"
          								 required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputBuilding" class="title-label">อาคาร (Building)</label>
                          <input type="text" name="inputBuilding" placeholder="อาคาร" onfocus="this.placeholder = ''" onblur="this.placeholder = 'อาคาร'"
          								 required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputSoi" class="title-label">ซอย (Alley (Soi))</label>
                          <input type="text" name="inputSoi" placeholder="ซอย" onfocus="this.placeholder = ''" onblur="this.placeholder = 'ซอย'"
          								 required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputRoad" class="title-label">ถนน (Road)</label>
                          <input type="text" name="inputRoad" placeholder="ถนน" onfocus="this.placeholder = ''" onblur="this.placeholder = 'ถนน'"
          								 required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPassword4" class="title-label">จังหวัด (Province)</label>
                          <div class="form-select" id="default-select">
          		                <select>
          						<option value="1">กรุงเทพมหานคร</option>
          						<option value="1">กระบี่</option>
          						<option value="1">Dilli</option>
          						<option value="1">Newyork</option>
          						<option value="1">Islamabad</option>
                                <option>Value 1</option>
                                  <option>Value 2</option>
                                  <option>Value 3</option>
                                  <option>Value 4</option>
                                  <option>Value 5</option>
                                  <option>Value 6</option>
                                  <option>Value 7</option>
                                  <option>Value 8</option>
                                  <option>Value 9</option>
                                  <option>Value 10</option>
                                  <option>Value 11</option>
                                  <option>Value 12</option>
                                    <option>Value 5</option>
                                  <option>Value 6</option>
                                  <option>Value 7</option>
                                  <option>Value 8</option>
                                  <option>Value 9</option>
                                  <option>Value 10</option>
                                  <option>Value 11</option>
                                  <option>Value 12</option>
                                    <option>Value 5</option>
                                  <option>Value 6</option>
                                  <option>Value 7</option>
                                  <option>Value 8</option>
                                  <option>Value 9</option>
                                  <option>Value 10</option>
                                  <option>Value 11</option>
                                  <option>Value 12</option>
          		                </select>
          		            </div>

                        </div>


                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPassword4" class="title-label">อำเภอ/เขต (District)</label>
                          <div class="form-select" id="default-select">
          						<select>
          						<option value="1">บางโพงพาง</option>
          						<option value="1">Dhaka</option>
          						<option value="1">Dilli</option>
          						<option value="1">Newyork</option>
          						<option value="1">Islamabad</option>
                                  <option value="1">Dhaka</option>
                                  <option value="1">Dilli</option>
                                  <option value="1">Newyork</option>
                                  <option value="1">Islamabad</option>
                                  <option value="1">Dhaka</option>
                                  <option value="1">Dilli</option>
                                  <option value="1">Newyork</option>
                                  <option value="1">Islamabad</option>
                                  <option value="1">Dhaka</option>
                                  <option value="1">Dilli</option>
                                  <option value="1">Newyork</option>
                                  <option value="1">Islamabad</option>
                                  <option value="1">Dhaka</option>
                                  <option value="1">Dilli</option>
                                  <option value="1">Newyork</option>
                                  <option value="1">Islamabad</option>
                                  <option value="1">Dhaka</option>
                                  <option value="1">Dilli</option>
                                  <option value="1">Newyork</option>
                                  <option value="1">Islamabad</option>
          									    </select>
          								</div>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPassword4" class="title-label">ตำบล/แขวง (Subdistrict)</label>
                          <div class="form-select" id="default-select">
          											<select>
          												<option value="1">ยานนาวา</option>
          									      <option value="1">Dhaka</option>
          									      <option value="1">Dilli</option>
          									      <option value="1">Newyork</option>
          									      <option value="1">Islamabad</option>
          									    </select>
          								</div>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPostal" class="title-label">รหัสไปรษณีย์ (Postal code)</label>
                          <input type="text" name="inputPostal" placeholder="รหัสไปรษณีย์" onfocus="this.placeholder = ''" onblur="this.placeholder = 'รหัสไปรษณีย์'"
          								 required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPhone" class="title-label">โทรศัพท์ (Phone)</label>
                          <input type="text" name="inputPhone" placeholder="โทรศัพท์" onfocus="this.placeholder = ''" onblur="this.placeholder = 'โทรศัพท์'"
          								 required class="single-input">
                        </div>
                      </div>

                  </div>
                  <!-- End แบบฟอร์มข้อมูลส่วนที่ 1 ที่อยู่ตามทะเบียนราษฏร์ -->
                  <!-- Start แบบฟอร์มข้อมูลส่วนที่ 2 ที่อยู่จัดส่งเอกสาร -->
                  <span class="badge label-no">2</span><span class="bold">ที่อยู่จัดส่งเอกสาร (Delivery address)</span>
                  <div class="mt-3 mb-3">
                      <div class="form-row">
                        <div class="switch-wrap d-flex col-md-12 mb-3">
          								<div class="primary-checkbox">
          									<input type="checkbox" id="default-checkbox">
          									<label for="default-checkbox"></label>
          								</div>
                          ใช้ที่อยู่เดียวกัน (Same as address above)
          							</div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputaddressno" class="title-label">ที่อยู่ (Address)</label>
                          <input type="text" name="inputaddressno" placeholder="กรอกที่อยู่" onfocus="this.placeholder = ''" onblur="this.placeholder = 'กรอกที่อยู่'"
                           required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputVillage" class="title-label">หมู่ที่ (Village no. (Moo))</label>
                          <input type="text" name="inputVillage" placeholder="หมู่ที่ " onfocus="this.placeholder = ''" onblur="this.placeholder = 'หมู่ที่'"
                           required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputUnitno" class="title-label">ห้องเลขที่ (Unit no.)</label>
                          <input type="text" name="inputUnitno" placeholder="ห้องเลขที " onfocus="this.placeholder = ''" onblur="this.placeholder = 'ห้องเลขที่'"
                           required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputFloor" class="title-label">ชั้น (Floor)</label>
                          <input type="text" name="inputFloor" placeholder="ชั้น  " onfocus="this.placeholder = ''" onblur="this.placeholder = 'ชั้น'"
                           required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputBuilding" class="title-label">อาคาร (Building)</label>
                          <input type="text" name="inputBuilding" placeholder="อาคาร" onfocus="this.placeholder = ''" onblur="this.placeholder = 'อาคาร'"
                           required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputSoi" class="title-label">ซอย (Alley (Soi))</label>
                          <input type="text" name="inputSoi" placeholder="ซอย" onfocus="this.placeholder = ''" onblur="this.placeholder = 'ซอย'"
                           required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputRoad" class="title-label">ถนน (Road)</label>
                          <input type="text" name="inputRoad" placeholder="ถนน" onfocus="this.placeholder = ''" onblur="this.placeholder = 'ถนน'"
                           required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPassword4" class="title-label">จังหวัด (Province)</label>
                          <div class="form-select" id="default-select">
                                <select>
                                  <option value="1">กรุงเทพมหานคร</option>
                                  <option value="1">กระบี่</option>
                                  <option value="1">Dilli</option>
                                  <option value="1">Newyork</option>
                                  <option value="1">Islamabad</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPassword4" class="title-label">อำเภอ/เขต (District)</label>
                          <div class="form-select" id="default-select">
                                 <select>
                                  <option value="1">บางโพงพาง</option>
                                  <option value="1">Dhaka</option>
                                  <option value="1">Dilli</option>
                                  <option value="1">Newyork</option>
                                  <option value="1">Islamabad</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPassword4" class="title-label">ตำบล/แขวง (Subdistrict)</label>
                          <div class="form-select" id="default-select">
                                <select>
                                  <option value="1">ยานนาวา</option>
                                  <option value="1">Dhaka</option>
                                  <option value="1">Dilli</option>
                                  <option value="1">Newyork</option>
                                  <option value="1">Islamabad</option>
                                </select>
                          </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPostal" class="title-label">รหัสไปรษณีย์ (Postal code)</label>
                          <input type="text" name="inputPostal" placeholder="รหัสไปรษณีย์" onfocus="this.placeholder = ''" onblur="this.placeholder = 'รหัสไปรษณีย์'"
                           required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPhone" class="title-label">โทรศัพท์ (Phone)</label>
                          <input type="text" name="inputPhone" placeholder="โทรศัพท์" onfocus="this.placeholder = ''" onblur="this.placeholder = 'โทรศัพท์'"
                           required class="single-input">
                        </div>
                      </div>

                  </div>
                  <!-- End แบบฟอร์มข้อมูลส่วนที่ 2 ที่อยู่จัดส่งเอกสาร -->
                  <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary  border-radius-5 shadow"><em class="fa fa-save"></em> บันทึกข้อมูล</button>
                        <button type="submit" class="btn btn-secondary  border-radius-5 shadow">ทำรายการต่อไป <em class="fas fa-long-arrow-alt-right"></em></button>
                    </div>
                  </form>
                </div>

    					</div>
    					<div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                <div class="padding-20 shadow">
                  <!-- Start แสดงข้อมูลส่วนที่ 1 ดึงมาแสดงเลย -->
                  <div class="bg-gray">


                    <div class="row">
                      <div class="col-md-3 label--tittle ">
                        ประเภทบุคคล (Person type)
                      </div>
                      <div class="col-md-9 label--text bold">
                      บุคคลธรรมดา
                      </div>
                      <div class="col-md-3 label--tittle ">
                        เลือก (Choose)
                      </div>
                      <div class="col-md-3 label--text bold">
                        บัตรประจำตัวประชาชน (3321100093041111)
                      </div>

                      <div class="col-md-3 label--tittle">
                        ไฟล์แนบ
                      </div>
                      <div class="col-md-3 label--text bold">
                        <button type="button" class="btn btn-success">  Download <em class="fa fa-download"></em></button>

                      </div>
                      <div class="col-md-3 label--tittle">
                        ชื่อ-สกุล
                      </div>
                      <div class="col-md-3 label--text bold">
                        นาย ณเดช เบรี่ คูกิคากิ
                      </div>
                      <div class="col-md-3 label--tittle">
                        Name-Lastname
                      </div>
                      <div class="col-md-3 label--text bold">
                        Mr. Nadash Berry KukiKaki
                      </div>
                      <div class="col-md-3 label--tittle">
                        วันเกิด (Date of birth)
                      </div>
                      <div class="col-md-3 label--text bold">
                        01/12/2530
                      </div>
                      <div class="col-md-3 label--tittle">
                        อายุ (age)
                      </div>
                      <div class="col-md-3 label--text bold">
                        30 ปี
                      </div>
                      <div class="col-md-3 label--tittle">
                        โทรศัพท์ (Phone)
                      </div>
                      <div class="col-md-3 label--text bold">
                        +6609812354xxx
                      </div>
                      <div class="col-md-3 label--tittle">
                        อีเมล (email)
                      </div>
                      <div class="col-md-3 label--text bold">
                        nadash.k@gmail.com
                      </div>
                    </div>

                  </div>
                  <!-- End แสดงข้อมูลส่วนที่ 1 -->
                  <br />
                  <div class="text-center"><h4 class="mt-3 mb-3 bold">ยืนยันตัวตน E-Filing LED</h4></div>
                  <!-- Start แบบฟอร์มข้อมูลส่วนที่ 1 ยืนยันตัวตน -->
                  <div class="row">
                      <div class="col-md-8">
                        <form>

                          <div class="form-group row">
                              <label for="inputPassword" class="col-sm-6 col-form-label title-label">Laser ID หลังบัตรประจำตัวประชาชน</label>
                              <div class="col-sm-6">
                                <input type="text" name="inputfistnameth" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                                 required class="single-input" >
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-6 col-form-label title-label">ระบุเบอร์มือถือที่ต้องการส่ง OTP</label>
                                <div class="col-sm-6">
                                  <input type="text" name="inputfistnameth" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                                   required class="single-input" >

                                </div>
                              </div>
                              <div class="form-group row">
                                  <label for="inputPassword" class="col-sm-6 col-form-label title-label"></label>
                                  <div class="col-sm-6">
                                     <button type="submit" class="btn btn-primary mb-2 mt-63">ส่ง OTP</button>
                                  </div>
                                </div>
                              <div class="form-group row">
                                  <label for="inputPassword" class="col-sm-6 col-form-label title-label">ระบุ OTP</label>
                                  <div class="col-sm-6">
                                    <input type="text" name="inputfistnameth" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                                     required class="single-input" >
                                    </div>
                              </div>
                              <div class="form-group row">
                                  <label for="inputPassword" class="col-sm-6 col-form-label title-label">รูปถ่ายยืนยันตัวตน</label>
                                  <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                           รูปถ่ายบัตรประชาชนชัดเจน
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">
                                          ใบหน้าชัดเจน
                                        </label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="inputPassword" class="col-sm-6 col-form-label title-label">แนบไฟล์เอกสาร</label>
                                  <div class="col-sm-6">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="customFile">
                                      <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>

                                  </div>
                              </div>
                        </form>
                      </div>
                      <div class="col-md-4 text-center">
                        <img src="images/id-card.png" class="img-fluid"/>
                      </div>

                  </div>
                  <div class="text-center mt-3">
                    <small>หมายเหตุ : กรณีไม่สามารถ Authen ผ่าน E-fling ท่านต้องดำเนินการนำบัตรประจำตัวประชาชนไปยืนยันตัวตนด้วยตัวท่านเองอีกครั้งที่ <br />ณ สำนักงานบังคับคดี กรมบังคับคดี ใกล้บ้านท่าน ท่านก็จะได้รหัสผ่านก็ต่อเมื่อ ยืนยันตน ณ สำนักงานบังคับคดี กรมบังคับคดี</small>
                  </div>
                  <!-- End แบบฟอร์มข้อมูลส่วนที่ 1 ยืนยันตัวตน -->
                  <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary  border-radius-5 shadow"><em class="fa fa-save"></em> บันทึกข้อมูล</button>
                        <!-- <button type="submit" class="btn btn-secondary  border-radius-5 shadow">ทำรายการต่อไป <em class="fas fa-long-arrow-alt-right"></em></button> -->
                    </div>
                </div>
              </div>

          </div>
        </div>
    		</div>
    	</div>
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
<script>


  $("#btnsubmit").click(function() {
    if($("#Check1").prop('checked') == true ){
      $("#nav-home-tab").removeClass("active");
      $("#nav-profile-tab").removeClass("disabled").trigger('click');
      }else{
        $("#nav-profile-tab").addClass("disabled");
      }
  });
 
  // function checkPassword(form) { 
	// 	USR_PASSWORD = form.USR_PASSWORD.value; 
	// 	USR_PASSWORD1 = form.USR_PASSWORD1.value; 

	// 	// ถ้าช่่องรหัสผ่านไม่ถูกกรอก
	// 	if (USR_PASSWORD == '') 
	// 		alert ("Please enter Password"); 
					
	// 	// ถ้าช่่องยืนยันรหัสผ่านไม่ถูกกรอก
	// 	else if (USR_PASSWORD1 == '') 
	// 		alert ("Please enter confirm password"); 
						
	// 	//ถ้าทั้งสองช่องไม่ตรงกัน   ให้แจ้งผู้ใช้  และ  return false
	// 	else if (USR_PASSWORD != USR_PASSWORD1) { 
	// 		alert ("รหัสผ่านไม่ถูกต้อง") 
	// 		return false; 
	// 		} 

	// 	//ถ้าทั้งสองช่องตรงกัน  return true
	// 	else{ 
			
	// 		alert("ลงทะเบียนเสร็จสิ้น") 
	// 			return true; 
	// 		} 
	// } 
    
$(document).ready(function() {
    $('.js-example-basic-single').select2();
	
	$("#USR_USERNAME").blur(function(){
		var USR_USERNAME = $("#USR_USERNAME").val();
		$.ajax({
					type: "POST",
					url: "ajax_register.php",
					data: { proc: 'chk_username', 
                            sUser: USR_USERNAME},
					cache: false,
					success: function(data){ 
						if(data > 0){
							$("#sUser").text('บัญชีผู้ใช้นี้มีในระบบแล้ว').attr( "style", "color: red");
                            
						} else {
                            $("#sUser").text('').removeAttr( "style");
                        }
                        		
                        
					}
		});
	}); 

    $("#USR_EMAIL").blur(function(){
		var USR_EMAIL = $("#USR_EMAIL").val();
		$.ajax({
					type: "POST",
					url: "ajax_register.php",
					data: { proc: 'chk_Email', 
                            sEmail: USR_EMAIL},
					cache: false,
					success: function(data){ 
						if(data > 0){
							$("#sEmail").text('อีเมล์นี้มีอยู่แล้ว').attr( "style", "color: red");
                            
						} else {
                            $("#sEmail").text('').removeAttr( "style");
                        }
                        		
                        
					}
		});
	}); 

    $("#USR_PASSWORD1").blur(function(){
		var USR_PASSWORD1 = $("#USR_PASSWORD1").val();
        var USR_PASSWORD = $("#USR_PASSWORD").val();
            if(USR_PASSWORD != USR_PASSWORD1){
                $("#sPass").text('พาสเวิร์ดไม่ถูกต้อง').attr( "style", "color: red");
                $("#USR_PASSWORD").val('');
                $("#USR_PASSWORD1").val('');
            } else {
                $("#sPass").text('').removeAttr( "style");
            }
                        		
					
	
	}); 



 /*  $("#USR_USERNAME,#USR_EMAIL").change(function(){

      $("#sUser").empty();
      $("#sEmail").empty();
      // var sEmail = $('#sEmail').val();
      // var sUser = $('#sUser').val();

      $.ajax({ 
        url: 'save_user_register.php' ,
        type: 'post',
        data: {
          sEmail: USR_USERNAME,
          sUser: USR_EMAIL,
          
      },
      
      success: function(result) { 

          var obj = jQuery.parseJSON(result);

          if(obj != '')
          {
              $.each(obj, function(key, inval) {

                  if($("#USR_USERNAME").val() == inval["ชื่อผู้ใช้งาน"])
                  {
                    $("#sUser").html(" <font color='red'>ชื่อมีอยู่แล้ว</font>");
                  }

                  if($("#USR_EMAIL").val() == inval["อีเมล"])
                  {
                    $("#sEmail").html(" <font color='red'>อีเมล์นี้มีอยู่แล้ว</font>");
                  }

              });
          }

      }
    });
  }); */

});
</script>
