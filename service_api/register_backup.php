
<?php include 'comtop.php';?>
    <!--::header part start::-->
    <?php include 'header.php';?>
    <!-- Header part end-->

    <!-- breadcrumb start -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>ลงทะเบียนยืนยันตัวตน</h2>
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
    						<a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><span class="badge label-no">1</span> เงื่อนไข/Condition</a>
    						<a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><span class="badge label-no">2</span> ลงทะเบียน Sigle Form</a>
    						<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><span class="badge label-no">3</span> ลงทะเบียน E-Filing</a>
    						<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false"><span class="badge label-no">4</span> ยืนยันตัวตน E-Filing LED</a>
    					</div>
    				</nav>
    				<div class="tab-content px-3 px-sm-0" id="nav-tabContent">
    					<div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    						<div class="padding-20 shadow text-center">
                  <h4 class="mt-3 mb-5 bold">เงื่อนไขข้อตกลงการใช้งาน Sigle Form</h4>
                  การสมัครสมาชิกนี้ เพื่อส่งข้อมูลเบื้องต้นให้กับกรมบังคับคดี  และเพื่อให้ท่านได้ตรวจสอบเงื่อนไขการใช้บริการให้ครบถ้วนทั้งนี้ท่านต้องดำเนินการนำบัตรประจำตัวประชาชนไปยืนยันตัวตนด้วยตัวท่านเองอีกครั้งที่ ณ สำนักงานบังคับคดี กรมบังคับคดี ใกล้บ้านท่าน ท่านก็จะได้รหัสผ่านก็ต่อเมื่อ ยืนยันตน ณ สำนักงานบังคับคดี กรมบังคับคดี
                  <div class="form-group form-check mt-3 mb-3 ">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1"> คลิกตกลงยอมรับเงื่อนไขข้เงื่อนไขข้อตกลงการใช้</label>
                  </div>
                  <div class="text-center">
                        <button type="submit" class="btn btn-primary shadow">ตกลงยอมรับ</button>
                      </div>

                </div>
    					</div>
    					<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="padding-20 shadow">
                  <h4 class="mt-3 mb-5 bold">ลงทะเบียน Sigle Form</h4>
                  <form>
                    <div class="form-row">
                      <div class="form-group col-md-8 col-sm-12">
                        <label for="inputaddressno" class=" title-label">ประเภทบุคคล*</label>
                          <div class="form-group">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                              บุคคลธรรมดา (Individual)
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option1">
                            <label class="form-check-label" for="exampleRadios2">
                            นิติบุคคล (Legal entity)
                            </label>
                          </div>
                      </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4 col-sm-6">
                        <label for="inputaddressno" class=" title-label">เอกสารประกอบ *</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" checked>
                          <label class="form-check-label" for="exampleRadios3">
                            เลขบัตรประชาชน (National ID Card)
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="option4">
                          <label class="form-check-label" for="exampleRadios4">
                          หนังสือเดินทาง (Passport)
                          </label>
                        </div>
                      </div>
                      <div class="form-group col-md-4 col-sm-6">
                        <label for="inputDocumentno" class=" title-label">เลขเอกสาร </label>
                        <input type="text" name="inputDocumentno" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                         required class="single-input">
                       </div>
                      <div class="form-group col-md-4 col-sm-6">
                        <label for="inputaddressno" class=" title-label">แนบไฟล์เอกสาร *</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="customFile">
                          <label class="custom-file-label" for="customFile">เลือกไฟล์</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-8 col-sm-12">
                        <label for="inputaddressno" class=" title-label">คำนำหน้า (Title)*</label>
                        <div class="form-group">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5" value="option5" checked>
                          <label class="form-check-label" for="exampleRadios5">
                            นาย (Mr.)
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="option6">
                          <label class="form-check-label" for="exampleRadios6">
                            นาง (Miss)
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios7" value="option7">
                          <label class="form-check-label" for="exampleRadios7">
                            นางสาว (Mrs.)
                          </label>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4 col-sm-4">
                        <label for="inputfistnameth" class=" title-label">ชื่อ (ไทย)*</label>
                        <input type="text" name="inputfistnameth" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                         required class="single-input">
                       </div>
                       <div class="form-group col-md-4 col-sm-4">
                         <label for="inputmiddlenameth" class=" title-label">ชื่อกลาง (ไทย)</label>
                         <input type="text" name="inputmiddlenameth" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                          required class="single-input">
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                          <label for="inputlastnameth" class=" title-label">นามสกุล (ไทย)*</label>
                          <input type="text" name="inputlastnameth" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                           required class="single-input">
                         </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4 col-sm-4">
                        <label for="inputfirstnameen" class=" title-label">Fisrt name (EN)*</label>
                        <input type="text" name="inputfirstnameen" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                         required class="single-input">
                       </div>
                       <div class="form-group col-md-4 col-sm-4">
                         <label for="inputmiddlenameen" class=" title-label">Middle name (EN)</label>
                         <input type="text" name="inputmiddlenameen" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                          required class="single-input">
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                          <label for="inputlastnameen" class=" title-label">Last name (EN)*</label>
                          <input type="text" name="inputlastnameen" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                           required class="single-input">
                         </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3 col-sm-6">
                        <label for="inputDate" class=" title-label">วันเกิด (Date of birth)*</label>
                        <!-- <input type="text" name="inputDate" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                         required class="single-input"> -->
                         <div class="input-group input-daterange">
                           <input type="text" id="start" class="form-control text-left mr-2">
                           <span class="fa fa-calendar" id="fa-1"></span>
                         </div>

                       </div>

                       <div class="form-group col-md-3 col-sm-6">
                         <label for="inputAge" class=" title-label">อายุ (Age)*</label>
                         <input type="text" name="inputAge" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                          required class="single-input">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                          <label for="inputPhone" class=" title-label">โทรศัพท์ (Phone)*</label>
                          <input type="text" name="inputPhone" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                           required class="single-input">
                         </div>
                         <div class="form-group col-md-3 col-sm-6">
                           <label for="inputmail" class=" title-label">อีเมล (e-mail)*</label>
                           <input type="text" name="inputmail" placeholder="" onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
                            required class="single-input">
                          </div>
                    </div>

                  </form>
                  <div class="text-center mt-5">
                    <small>* หมายเหตุ - กรณี Register Single Form Username จะเป็นเลขบัตรประชาชน Password จะเป็นวันเดือนปีเกิด ตัวอย่าง 01012534</small>
                  </div>
                  <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary  border-radius-5 shadow"><em class="fa fa-save"></em> บันทึกข้อมูล</button>
                        <button type="submit" class="btn btn-secondary  border-radius-5 shadow">ทำรายการต่อไป <em class="fas fa-long-arrow-alt-right"></em></button>
                      </div>

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
