<?php include '../include/comtop_admin.php'; ?>
<!--link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">-->
    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <!-- Row Starts -->
            <div class="row">
                <div class="col-sm-7">
                    <div class="main-header">
                        <h4>Title</h4>
						<h5>Description</h5>
                        <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icofont icofont-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Icons</a>
                            </li>
                            <li class="breadcrumb-item"><a href="test.php">Grid-Stack</a>
                            </li>
                        </ol>
                    </div>
                </div>
				<div class="col-sm-5">
                    <div class="main-header f-right">
                        <h5>Title</h5>
						<h6>Title</h6>
                    </div>
                </div>
            </div>
            <!-- Row end -->
			<form method="post" enctype="multipart/form-data" id="form_wf">
            <!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">
										ข้อมูล
                            </h5>
                        </div> 
                        <div class="card-block">
                            <div class="form-group row">
								<div class="col-md-2">
									<label class="form-control-label wf-right">วันที่ไทย <?php echo conDateText("2019-06-13","F"); ?></label>
							    </div>
							  <div class="col-md-2">
									<label class="input-group">
										<input type="text" id="EEE" class="form-control datepicker_new" placeholder="วว/ดด/ปปปป" />
											<span class="input-group-addon bg-primary">
												<span class="icofont icofont-ui-calendar"></span>
											</span>
									</label>
							  </div>
                                <div class="col-md-2">
									<label class="form-control-label wf-right">วันที่อังกฤษ</label>
							    </div>
							  <div class="col-md-2">
									<label class="input-group">
										<input type="text" id="EEE" class="form-control datepicker_new_en" placeholder="DD/MM/YYYY" />
											<span class="input-group-addon bg-primary">
												<span class="icofont icofont-ui-calendar"></span>
											</span>
									</label>
							  </div>
							  <div class="col-md-2">
									<label class="form-control-label wf-right">วันที่ไทย</label>
							    </div>
							  <div class="col-md-2">
									<label class="input-group">
										<input type="text" id="CCC" class="form-control datepicker" placeholder="วว/ดด/ปปปป" />
											<span class="input-group-addon bg-primary">
												<span class="icofont icofont-ui-calendar"></span>
											</span>
									</label>
							  </div>
							</div>
							<div class="form-group row">
							  <div class="col-md-2">
								  <label for="InputNormal" class="form-control-label wf-right">คำนำหน้า<span class="text-danger">*</span></label>
							  </div>
							  <div class="col-md-2">
								  <select name="TEST_TITLE" id="TEST_TITLE" class="select3" wfs="223" required aria-required="true">
										<option value="">เลือก</option>
										<option value="AL">นาย</option>
										<option value="WY">นาง</option>
										<option value="WY">นางสาว</option>
								</select>
							  </div>
							  <div class="col-md-1">
								  <label for="InputNormal" class="form-control-label wf-right">ชื่อ<span class="text-danger">*</span></label>
							  </div>
							  <div class="col-md-3">
								  <input type="text" class="form-control" id="InputNormal"  placeholder="Normal"  oninvalid="this.setCustomValidity('กรุณากรอกข้อมูล')" required>
							  </div>
							<!--</div>
							<div class="form-group row">-->
							  <div class="col-md-1">
								  <label for="InputNormal" class="form-control-label wf-right">นามสกุล</label>
							  </div>
							  <div class="col-md-3">
								  <input type="file" class="form-control" id="InputNormal22"  placeholder="Normal" single>
							  </div>
							</div>
							<div class="form-group row">
							  <div class="col-md-2">
								  <label for="InputNormal" class="form-control-label wf-right">บ้านเลขที่</label>
								  
							  </div>
							  <div class="col-md-3">
								  <input type="text" class="form-control" id="InputNormal"  placeholder="Normal">
							  </div>
							<!--</div>
							<div class="form-group row">-->
							  <div class="col-md-2">
								  <label for="InputNormal" class="form-control-label wf-right">ถนน</label>
							  </div>
							  <div class="col-md-3">
								  <input type="text" class="form-control" id="InputNormal"  placeholder="Normal">
							  </div>
							</div>
							<div class="form-group row">
							  <div class="col-md-2">
								  <label for="InputNormal" class="form-control-label wf-right">ราคา</label>
							  </div>
							  <div class="col-md-5">
									<div class="input-group">
										<span class="input-group-addon">฿</span>
										<input type="text" id="alighaddon2" class="form-control" placeholder="Percentage" aria-describedby="basic-addon2">
											<span class="input-group-addon">บาท</span>
									</div>
							  </div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-2">
								  <label class="form-control-label wf-right">อีเมล์</label>
							  </div>
								
							  <div class="col-md-5">
								  <label class="label bg-primary">narongsak@easywebtime.com narongsak@easywebtime.com narongsak@easywebtime.com narongsak@easywebtime.com narongsak@easywebtime.com narongsak@easywebtime.com narongsak@easywebtime.com narongsak@easywebtime.com narongsak@easywebtime.com  </label>
							  </div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label class="form-control-label wf-right">เพศ</label>
								</div>
								<div class="col-md-10">
									<div id="radio" class="form-radio">
										<div class="radio radio-inline"> <!-- radio-inline -->
											<label>
												<input type="radio" name="radio" id="radio" value="M" required aria-required="true" data-toggle="validator">
												<i class="helper"></i> ชาย</input>
											</label>
										</div>
										<div class="radio radio-inline">
											<label>
												<input type="radio" name="radio" id="radio" value="F" required aria-required="true" data-toggle="validator">
												<i class="helper">
												</i> หญิง</input>
											</label>
										</div>
									</div>
									<span class="messages"></span>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-2">
									<label class="form-control-label wf-right">เพศ with checkbox3</label>
								</div>
								<div class="col-md-10">
										<div class="radio3 radio-primary radio-inline"> <!-- radio-inline -->
											<input type="radio" name="radio3" id="radio31" value="M" required aria-required="true" data-toggle="validator">
											<label for="radio31">
												ชาย
											</label>
										</div>
										<div class="radio3 radio-primary radio-inline">
											<input type="radio" name="radio3" id="radio32" value="F" required aria-required="true" data-toggle="validator">
											<label for="radio32">
												หญิง
											</label>
										</div>
									<span class="messages"></span>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-2">
							    </div>
								
							  <div class="col-md-5">  
								<div class="checkbox-color checkbox-primary col-xs-12">
									<input id="checkbox2" type="checkbox" checked="" required>
										<label for="checkbox2">
											ใช้ข้อมูลตามที่ลงทะเบียนไว้
										</label>
								</div>
								<div class="checkbox-color checkbox-primary col-xs-12">
									<input id="checkbox2" type="checkbox" checked="" required>
										<label for="checkbox2">
											ใช้ข้อมูลตามที่ลงทะเบียนไว้
										</label>
								</div> 
							  </div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-2">
							    </div>
								
							  <div class="col-md-5">
									<div data-toggle="buttons">
									<div class="btn-group">
										<label class="btn btn-info active">
											<input type="radio" name="type" id="type" value="admin" checked><i class="fa fa-align-left"></i>
										</label>
										<label class="btn btn-info">
											<input type="radio" name="type" id="type" value="user" ><i class="fa fa-align-center"></i>
										</label>
										<label class="btn btn-info">
											<input type="radio" name="type" id="type" value="user" ><i class="fa fa-align-right"></i>
										</label>
									</div>
									</div>
							  </div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-2">
									<label class="form-control-label wf-right">วันที่ลงทะเบียน</label>
							    </div>
								
							  <div class="col-md-2">
									<label class="input-group">
										<input type="text" id="EEE" class="form-control datepicker" placeholder="วว/ดด/ปปปป" onChange="checkDate()" />
											<span class="input-group-addon bg-primary">
												<span class="icofont icofont-ui-calendar"></span>
											</span>
									</label>
							  </div>
							</div>
							<script>
							 function checkDate() {

            var EnteredDate = $("#EEE").val(); // For JQuery

            var date = EnteredDate.substring(0, 2);
            var month = EnteredDate.substring(3, 5);
            var year = EnteredDate.substring(6, 10);

            var myDate = new Date(year -543, month - 1, date);

            var today = new Date();

            if (myDate > today) {
                alert("No");
            }
            else {
                alert("OK");
            }
        }
							</script>
							<div class="form-group row">
							  <div class="col-md-2">
									<label class="form-control-label wf-right">เอกสารแนบ</label>
							  </div>
							  <div class="col-md-4">
								<div class="md-group-add-on">
									<span class="md-add-on-file">
										<button class="btn btn-primary waves-effect waves-light"><i class="zmdi zmdi-attachment-alt"></i> เลือกไฟล์</button>
									</span>
									<div class="md-input-file">
										<input type="file" name="file[]" id="file" class=""  single />
										<input type="text" class="md-form-control md-form-file">
										<label class="md-label-file"></label>
									</div>
								</div>    
							  </div>
							</div>
							
							<div class="form-group row">
							  <div class="col-md-2">
									<label class="form-control-label wf-right">เลือกไฟล์</label>
							  </div>
							  <div class="col-md-8">
								<input type="file" name="file[]" id="file_n"   multiple />		
								<script>
								$("input[type='file'][multiple]").change(function (e,v){
								  var input = document.getElementById(this.id);
				var img_name = [];
				for (var x = 0; x < input.files.length; x++) {
					img_name[x] = input.files[x].name;
				}
				$(this).parent().children('.md-form-file').val(img_name.join(', '));

								});
								$("input[type='file'][single]").change(function (e,v){
				var pathArray = $(this).val().split('\\');
			  var img_name=pathArray[pathArray.length - 1];
			   $(this).parent().children('.md-form-file').val(img_name);
								});

								</script>
							  </div>
							</div>
							
							<div class="form-group row">
							  <div class="col-md-2">
									<label class="form-control-label wf-right">รายละเอียดเพิ่มเติม</label>
							  </div>
							  <div class="col-md-8">
								<textarea class="form-control max-textarea" maxlength="255" rows="4"></textarea>	
							  </div>
							  <?php
							  $string = "";
							  $num = preg_replace('/[^0-9.]/', '', $string);
							  echo $num;
							  ?>
							</div>

							
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
			
			<!-- Row Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">
                                GridStack
                            </h5>
                        </div>
						<div class="card-header">
                            <h5 class="card-header-text">
								หัวข้อ
                            </h5>
                        </div>
                        <div class="card-block">
					<table id="right-fix" class="table stripe row-border table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>First name</th>
                                                                    <th>Last name</th>
                                                                    <th>Position</th>
                                                                    <th>Office</th>
                                                                    <th>Age</th>
                                                                    <th>Start date</th>
                                                                    <th>Salary</th>
                                                                    <th>Extn.</th>
                                                                    <th>E-mail</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Tiger</td>
                                                                    <td>Nixon</td>
                                                                    <td>System Architect</td>
                                                                    <td>Edinburgh</td>
                                                                    <td>61</td>
                                                                    <td>2011/04/25</td>
                                                                    <td>$320,800</td>
                                                                    <td>5421</td>
                                                                    <td>t.nixon@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Garrett</td>
                                                                    <td>Winters</td>
                                                                    <td>Accountant</td>
                                                                    <td>Tokyo</td>
                                                                    <td>63</td>
                                                                    <td>2011/07/25</td>
                                                                    <td>$170,750</td>
                                                                    <td>8422</td>
                                                                    <td>g.winters@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Ashton</td>
                                                                    <td>Cox</td>
                                                                    <td>Junior Technical Author</td>
                                                                    <td>San Francisco</td>
                                                                    <td>66</td>
                                                                    <td>2009/01/12</td>
                                                                    <td>$86,000</td>
                                                                    <td>1562</td>
                                                                    <td>a.cox@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cedric</td>
                                                                    <td>Kelly</td>
                                                                    <td>Senior Javascript Developer</td>
                                                                    <td>Edinburgh</td>
                                                                    <td>22</td>
                                                                    <td>2012/03/29</td>
                                                                    <td>$433,060</td>
                                                                    <td>6224</td>
                                                                    <td>c.kelly@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Airi</td>
                                                                    <td>Satou</td>
                                                                    <td>Accountant</td>
                                                                    <td>Tokyo</td>
                                                                    <td>33</td>
                                                                    <td>2008/11/28</td>
                                                                    <td>$162,700</td>
                                                                    <td>5407</td>
                                                                    <td>a.satou@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Brielle</td>
                                                                    <td>Williamson</td>
                                                                    <td>Integration Specialist</td>
                                                                    <td>New York</td>
                                                                    <td>61</td>
                                                                    <td>2012/12/02</td>
                                                                    <td>$372,000</td>
                                                                    <td>4804</td>
                                                                    <td>b.williamson@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Herrod</td>
                                                                    <td>Chandler</td>
                                                                    <td>Sales Assistant</td>
                                                                    <td>San Francisco</td>
                                                                    <td>59</td>
                                                                    <td>2012/08/06</td>
                                                                    <td>$137,500</td>
                                                                    <td>9608</td>
                                                                    <td>h.chandler@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Rhona</td>
                                                                    <td>Davidson</td>
                                                                    <td>Integration Specialist</td>
                                                                    <td>Tokyo</td>
                                                                    <td>55</td>
                                                                    <td>2010/10/14</td>
                                                                    <td>$327,900</td>
                                                                    <td>6200</td>
                                                                    <td>r.davidson@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Colleen</td>
                                                                    <td>Hurst</td>
                                                                    <td>Javascript Developer</td>
                                                                    <td>San Francisco</td>
                                                                    <td>39</td>
                                                                    <td>2009/09/15</td>
                                                                    <td>$205,500</td>
                                                                    <td>2360</td>
                                                                    <td>c.hurst@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Sonya</td>
                                                                    <td>Frost</td>
                                                                    <td>Software Engineer</td>
                                                                    <td>Edinburgh</td>
                                                                    <td>23</td>
                                                                    <td>2008/12/13</td>
                                                                    <td>$103,600</td>
                                                                    <td>1667</td>
                                                                    <td>s.frost@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jena</td>
                                                                    <td>Gaines</td>
                                                                    <td>Office Manager</td>
                                                                    <td>London</td>
                                                                    <td>30</td>
                                                                    <td>2008/12/19</td>
                                                                    <td>$90,560</td>
                                                                    <td>3814</td>
                                                                    <td>j.gaines@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Quinn</td>
                                                                    <td>Flynn</td>
                                                                    <td>Support Lead</td>
                                                                    <td>Edinburgh</td>
                                                                    <td>22</td>
                                                                    <td>2013/03/03</td>
                                                                    <td>$342,000</td>
                                                                    <td>9497</td>
                                                                    <td>q.flynn@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Charde</td>
                                                                    <td>Marshall</td>
                                                                    <td>Regional Director</td>
                                                                    <td>San Francisco</td>
                                                                    <td>36</td>
                                                                    <td>2008/10/16</td>
                                                                    <td>$470,600</td>
                                                                    <td>6741</td>
                                                                    <td>c.marshall@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Haley</td>
                                                                    <td>Kennedy</td>
                                                                    <td>Senior Marketing Designer</td>
                                                                    <td>London</td>
                                                                    <td>43</td>
                                                                    <td>2012/12/18</td>
                                                                    <td>$313,500</td>
                                                                    <td>3597</td>
                                                                    <td>h.kennedy@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tatyana</td>
                                                                    <td>Fitzpatrick</td>
                                                                    <td>Regional Director</td>
                                                                    <td>London</td>
                                                                    <td>19</td>
                                                                    <td>2010/03/17</td>
                                                                    <td>$385,750</td>
                                                                    <td>1965</td>
                                                                    <td>t.fitzpatrick@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Michael</td>
                                                                    <td>Silva</td>
                                                                    <td>Marketing Designer</td>
                                                                    <td>London</td>
                                                                    <td>66</td>
                                                                    <td>2012/11/27</td>
                                                                    <td>$198,500</td>
                                                                    <td>1581</td>
                                                                    <td>m.silva@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Paul</td>
                                                                    <td>Byrd</td>
                                                                    <td>Chief Financial Officer (CFO)</td>
                                                                    <td>New York</td>
                                                                    <td>64</td>
                                                                    <td>2010/06/09</td>
                                                                    <td>$725,000</td>
                                                                    <td>3059</td>
                                                                    <td>p.byrd@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gloria</td>
                                                                    <td>Little</td>
                                                                    <td>Systems Administrator</td>
                                                                    <td>New York</td>
                                                                    <td>59</td>
                                                                    <td>2009/04/10</td>
                                                                    <td>$237,500</td>
                                                                    <td>1721</td>
                                                                    <td>g.little@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bradley</td>
                                                                    <td>Greer</td>
                                                                    <td>Software Engineer</td>
                                                                    <td>London</td>
                                                                    <td>41</td>
                                                                    <td>2012/10/13</td>
                                                                    <td>$132,000</td>
                                                                    <td>2558</td>
                                                                    <td>b.greer@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Dai</td>
                                                                    <td>Rios</td>
                                                                    <td>Personnel Lead</td>
                                                                    <td>Edinburgh</td>
                                                                    <td>35</td>
                                                                    <td>2012/09/26</td>
                                                                    <td>$217,500</td>
                                                                    <td>2290</td>
                                                                    <td>d.rios@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jenette</td>
                                                                    <td>Caldwell</td>
                                                                    <td>Development Lead</td>
                                                                    <td>New York</td>
                                                                    <td>30</td>
                                                                    <td>2011/09/03</td>
                                                                    <td>$345,000</td>
                                                                    <td>1937</td>
                                                                    <td>j.caldwell@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Yuri</td>
                                                                    <td>Berry</td>
                                                                    <td>Chief Marketing Officer (CMO)</td>
                                                                    <td>New York</td>
                                                                    <td>40</td>
                                                                    <td>2009/06/25</td>
                                                                    <td>$675,000</td>
                                                                    <td>6154</td>
                                                                    <td>y.berry@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Caesar</td>
                                                                    <td>Vance</td>
                                                                    <td>Pre-Sales Support</td>
                                                                    <td>New York</td>
                                                                    <td>21</td>
                                                                    <td>2011/12/12</td>
                                                                    <td>$106,450</td>
                                                                    <td>8330</td>
                                                                    <td>c.vance@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Doris</td>
                                                                    <td>Wilder</td>
                                                                    <td>Sales Assistant</td>
                                                                    <td>Sidney</td>
                                                                    <td>23</td>
                                                                    <td>2010/09/20</td>
                                                                    <td>$85,600</td>
                                                                    <td>3023</td>
                                                                    <td>d.wilder@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Angelica</td>
                                                                    <td>Ramos</td>
                                                                    <td>Chief Executive Officer (CEO)</td>
                                                                    <td>London</td>
                                                                    <td>47</td>
                                                                    <td>2009/10/09</td>
                                                                    <td>$1,200,000</td>
                                                                    <td>5797</td>
                                                                    <td>a.ramos@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gavin</td>
                                                                    <td>Joyce</td>
                                                                    <td>Developer</td>
                                                                    <td>Edinburgh</td>
                                                                    <td>42</td>
                                                                    <td>2010/12/22</td>
                                                                    <td>$92,575</td>
                                                                    <td>8822</td>
                                                                    <td>g.joyce@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jennifer</td>
                                                                    <td>Chang</td>
                                                                    <td>Regional Director</td>
                                                                    <td>Singapore</td>
                                                                    <td>28</td>
                                                                    <td>2010/11/14</td>
                                                                    <td>$357,650</td>
                                                                    <td>9239</td>
                                                                    <td>j.chang@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Brenden</td>
                                                                    <td>Wagner</td>
                                                                    <td>Software Engineer</td>
                                                                    <td>San Francisco</td>
                                                                    <td>28</td>
                                                                    <td>2011/06/07</td>
                                                                    <td>$206,850</td>
                                                                    <td>1314</td>
                                                                    <td>b.wagner@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fiona</td>
                                                                    <td>Green</td>
                                                                    <td>Chief Operating Officer (COO)</td>
                                                                    <td>San Francisco</td>
                                                                    <td>48</td>
                                                                    <td>2010/03/11</td>
                                                                    <td>$850,000</td>
                                                                    <td>2947</td>
                                                                    <td>f.green@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Shou</td>
                                                                    <td>Itou</td>
                                                                    <td>Regional Marketing</td>
                                                                    <td>Tokyo</td>
                                                                    <td>20</td>
                                                                    <td>2011/08/14</td>
                                                                    <td>$163,000</td>
                                                                    <td>8899</td>
                                                                    <td>s.itou@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Michelle</td>
                                                                    <td>House</td>
                                                                    <td>Integration Specialist</td>
                                                                    <td>Sidney</td>
                                                                    <td>37</td>
                                                                    <td>2011/06/02</td>
                                                                    <td>$95,400</td>
                                                                    <td>2769</td>
                                                                    <td>m.house@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Suki</td>
                                                                    <td>Burks</td>
                                                                    <td>Developer</td>
                                                                    <td>London</td>
                                                                    <td>53</td>
                                                                    <td>2009/10/22</td>
                                                                    <td>$114,500</td>
                                                                    <td>6832</td>
                                                                    <td>s.burks@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Prescott</td>
                                                                    <td>Bartlett</td>
                                                                    <td>Technical Author</td>
                                                                    <td>London</td>
                                                                    <td>27</td>
                                                                    <td>2011/05/07</td>
                                                                    <td>$145,000</td>
                                                                    <td>3606</td>
                                                                    <td>p.bartlett@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gavin</td>
                                                                    <td>Cortez</td>
                                                                    <td>Team Leader</td>
                                                                    <td>San Francisco</td>
                                                                    <td>22</td>
                                                                    <td>2008/10/26</td>
                                                                    <td>$235,500</td>
                                                                    <td>2860</td>
                                                                    <td>g.cortez@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Martena</td>
                                                                    <td>Mccray</td>
                                                                    <td>Post-Sales support</td>
                                                                    <td>Edinburgh</td>
                                                                    <td>46</td>
                                                                    <td>2011/03/09</td>
                                                                    <td>$324,050</td>
                                                                    <td>8240</td>
                                                                    <td>m.mccray@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Unity</td>
                                                                    <td>Butler</td>
                                                                    <td>Marketing Designer</td>
                                                                    <td>San Francisco</td>
                                                                    <td>47</td>
                                                                    <td>2009/12/09</td>
                                                                    <td>$85,675</td>
                                                                    <td>5384</td>
                                                                    <td>u.butler@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Howard</td>
                                                                    <td>Hatfield</td>
                                                                    <td>Office Manager</td>
                                                                    <td>San Francisco</td>
                                                                    <td>51</td>
                                                                    <td>2008/12/16</td>
                                                                    <td>$164,500</td>
                                                                    <td>7031</td>
                                                                    <td>h.hatfield@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Hope</td>
                                                                    <td>Fuentes</td>
                                                                    <td>Secretary</td>
                                                                    <td>San Francisco</td>
                                                                    <td>41</td>
                                                                    <td>2010/02/12</td>
                                                                    <td>$109,850</td>
                                                                    <td>6318</td>
                                                                    <td>h.fuentes@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Vivian</td>
                                                                    <td>Harrell</td>
                                                                    <td>Financial Controller</td>
                                                                    <td>San Francisco</td>
                                                                    <td>62</td>
                                                                    <td>2009/02/14</td>
                                                                    <td>$452,500</td>
                                                                    <td>9422</td>
                                                                    <td>v.harrell@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Timothy</td>
                                                                    <td>Mooney</td>
                                                                    <td>Office Manager</td>
                                                                    <td>London</td>
                                                                    <td>37</td>
                                                                    <td>2008/12/11</td>
                                                                    <td>$136,200</td>
                                                                    <td>7580</td>
                                                                    <td>t.mooney@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jackson</td>
                                                                    <td>Bradshaw</td>
                                                                    <td>Director</td>
                                                                    <td>New York</td>
                                                                    <td>65</td>
                                                                    <td>2008/09/26</td>
                                                                    <td>$645,750</td>
                                                                    <td>1042</td>
                                                                    <td>j.bradshaw@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Olivia</td>
                                                                    <td>Liang</td>
                                                                    <td>Support Engineer</td>
                                                                    <td>Singapore</td>
                                                                    <td>64</td>
                                                                    <td>2011/02/03</td>
                                                                    <td>$234,500</td>
                                                                    <td>2120</td>
                                                                    <td>o.liang@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bruno</td>
                                                                    <td>Nash</td>
                                                                    <td>Software Engineer</td>
                                                                    <td>London</td>
                                                                    <td>38</td>
                                                                    <td>2011/05/03</td>
                                                                    <td>$163,500</td>
                                                                    <td>6222</td>
                                                                    <td>b.nash@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Sakura</td>
                                                                    <td>Yamamoto</td>
                                                                    <td>Support Engineer</td>
                                                                    <td>Tokyo</td>
                                                                    <td>37</td>
                                                                    <td>2009/08/19</td>
                                                                    <td>$139,575</td>
                                                                    <td>9383</td>
                                                                    <td>s.yamamoto@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Thor</td>
                                                                    <td>Walton</td>
                                                                    <td>Developer</td>
                                                                    <td>New York</td>
                                                                    <td>61</td>
                                                                    <td>2013/08/11</td>
                                                                    <td>$98,540</td>
                                                                    <td>8327</td>
                                                                    <td>t.walton@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Finn</td>
                                                                    <td>Camacho</td>
                                                                    <td>Support Engineer</td>
                                                                    <td>San Francisco</td>
                                                                    <td>47</td>
                                                                    <td>2009/07/07</td>
                                                                    <td>$87,500</td>
                                                                    <td>2927</td>
                                                                    <td>f.camacho@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Serge</td>
                                                                    <td>Baldwin</td>
                                                                    <td>Data Coordinator</td>
                                                                    <td>Singapore</td>
                                                                    <td>64</td>
                                                                    <td>2012/04/09</td>
                                                                    <td>$138,575</td>
                                                                    <td>8352</td>
                                                                    <td>s.baldwin@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Zenaida</td>
                                                                    <td>Frank</td>
                                                                    <td>Software Engineer</td>
                                                                    <td>New York</td>
                                                                    <td>63</td>
                                                                    <td>2010/01/04</td>
                                                                    <td>$125,250</td>
                                                                    <td>7439</td>
                                                                    <td>z.frank@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Zorita</td>
                                                                    <td>Serrano</td>
                                                                    <td>Software Engineer</td>
                                                                    <td>San Francisco</td>
                                                                    <td>56</td>
                                                                    <td>2012/06/01</td>
                                                                    <td>$115,000</td>
                                                                    <td>4389</td>
                                                                    <td>z.serrano@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jennifer</td>
                                                                    <td>Acosta</td>
                                                                    <td>Junior Javascript Developer</td>
                                                                    <td>Edinburgh</td>
                                                                    <td>43</td>
                                                                    <td>2013/02/01</td>
                                                                    <td>$75,650</td>
                                                                    <td>3431</td>
                                                                    <td>j.acosta@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cara</td>
                                                                    <td>Stevens</td>
                                                                    <td>Sales Assistant</td>
                                                                    <td>New York</td>
                                                                    <td>46</td>
                                                                    <td>2011/12/06</td>
                                                                    <td>$145,600</td>
                                                                    <td>3990</td>
                                                                    <td>c.stevens@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Hermione</td>
                                                                    <td>Butler</td>
                                                                    <td>Regional Director</td>
                                                                    <td>London</td>
                                                                    <td>47</td>
                                                                    <td>2011/03/21</td>
                                                                    <td>$356,250</td>
                                                                    <td>1016</td>
                                                                    <td>h.butler@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lael</td>
                                                                    <td>Greer</td>
                                                                    <td>Systems Administrator</td>
                                                                    <td>London</td>
                                                                    <td>21</td>
                                                                    <td>2009/02/27</td>
                                                                    <td>$103,500</td>
                                                                    <td>6733</td>
                                                                    <td>l.greer@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jonas</td>
                                                                    <td>Alexander</td>
                                                                    <td>Developer</td>
                                                                    <td>San Francisco</td>
                                                                    <td>30</td>
                                                                    <td>2010/07/14</td>
                                                                    <td>$86,500</td>
                                                                    <td>8196</td>
                                                                    <td>j.alexander@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Shad</td>
                                                                    <td>Decker</td>
                                                                    <td>Regional Director</td>
                                                                    <td>Edinburgh</td>
                                                                    <td>51</td>
                                                                    <td>2008/11/13</td>
                                                                    <td>$183,000</td>
                                                                    <td>6373</td>
                                                                    <td>s.decker@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Michael</td>
                                                                    <td>Bruce</td>
                                                                    <td>Javascript Developer</td>
                                                                    <td>Singapore</td>
                                                                    <td>29</td>
                                                                    <td>2011/06/27</td>
                                                                    <td>$183,000</td>
                                                                    <td>5384</td>
                                                                    <td>m.bruce@datatables.net</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Donna</td>
                                                                    <td>Snider</td>
                                                                    <td>Customer Support</td>
                                                                    <td>New York</td>
                                                                    <td>27</td>
                                                                    <td>2011/01/25</td>
                                                                    <td>$112,000</td>
                                                                    <td>4226</td>
                                                                    <td>d.snider@datatables.net</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

 
		<?php
/*define('APACHE_MIME_TYPES_URL','http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types');

function generateUpToDateMimeArray($url){
    $s=array();
	$m=1;
    foreach(@explode("\n",@file_get_contents($url))as $x)
        if(isset($x[0])&&$x[0]!=='#'&&preg_match_all('#([^\s]+)#',$x,$out)&&isset($out[1])&&($c=count($out[1]))>1)
            for($i=1;$i<$c;$i++){
                $s[]='&nbsp;&nbsp;&nbsp;\''.$out[1][$i].'\' => \''.$out[1][0].'\'';
				db::query("INSERT INTO G_MIME_TYPES (MIME_ID,FIEL_TYPE,FILE_MIME) VALUES ('".$m."','".$out[1][$i]."','".$out[1][0]."')");
				$m++;
			}
			
			print_pre($s);
			//
    return @sort($s)?'$mime_types = array(<br />'.implode($s,',<br />').'<br />);':false;
}

echo
generateUpToDateMimeArray(APACHE_MIME_TYPES_URL); */
?>
		 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
			<div class="row">
				<div class="col-md-12">    
					<div class="f-left">
						<button type="button" class="btn btn-md btn-primary active waves-effect waves-light"><i class="icofont icofont-home"></i> กลับหน้าหลัก</button>
					</div>
                    <div class="wf-right">&nbsp;
						<button type="button" class="btn btn-md btn-danger active waves-effect waves-light"><i class="icofont icofont-arrow-left"></i> ย้อนขั้นตอน</button>&nbsp;
						<button type="button" class="btn btn-md btn-warning active waves-effect waves-light"><i class="icofont icofont-diskette"></i> บันทึกชั่วคราว</button>&nbsp;
                        <button type="submit" class="btn btn-md btn-success active waves-effect waves-light"><i class="icofont icofont-tick-mark"></i> บันทึก</button>
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="main-header">
				</div>
			</div>
		</form>

        <!-- Container-fluid ends -->
     </div>
</div>
<?php include '../include/combottom_js.php'; ?>
<script src="../assets/plugins/data-table/js/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/data-table/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/data-table/js/dataTables.fixedColumns.min.js"></script>
	<script type="text/javascript" src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
$(document).ready(function() {
$('.datepicker_new').datepicker({
	format: "dd/mm/yyyy",
	language: "th-th",
	autoclose: true,
	todayHighlight: true
});
$('.datepicker_new_en').datepicker({
	format: "dd/mm/yyyy",
	autoclose: true,
	todayHighlight: true
});
	var table = $('#left-right-fix').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 1,
            rightColumns: 1
        }
    });
    var table = $('#right-fix').DataTable({
		scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 0,
            rightColumns: 1
        }
    });
    
});
</script>
<script>
$(".select3").select2({
			  ajax: {
					url: "../workflow/wf_autocom.php",
					dataType: 'json',
					delay: 250,
					data: function(params) { 
						return {
							qa: params.term,
							wfs:$(this).attr('wfs')
						};
					},
					cache: true
				},
				minimumInputLength: 2
});

$('#J_BRAND').change(function(){
				var val = $('#J_BRAND').val();
				var url = "../workflow/wf_onchange.php";
				var dataString = 'TARGET=8185&VAL='+val+'&W=43';
				$.ajax({
					   type: "GET",
					   url: url,
					   data: dataString, // serializes the form's elements.
					   cache: false,
					   success: function(html)
					   {
							$('#J_MODEL').html('').select2({data: [{id:'', text: 'เลือกรถ',disabled: true,selected:true}]});

							$('#J_MODEL').select2({
								allowClear: true,
								data: html
							});
												   }
					 });
			});
</script>
<?php include '../include/combottom_admin.php'; ?>