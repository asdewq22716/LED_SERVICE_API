<?php
include '../include/comtop_admin.php';
$color = "bg-blue";
?>
<style>
.bg-blue {
    background-color: #D1F2EB !important;
}
</style>
<link rel="stylesheet" type="text/css" href="../assets/plugins/jqpagination/css/jqpagination.css">
<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Row Starts -->
		<div class="row" id="animationSandbox">
			<div class="col-sm-12">
				<div class="main-header">
					<h4>Help</h4>
					<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item">
							<a href="index.php"><i class="icofont icofont-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							Help
						</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- Row end -->
		
		<!-- Row Starts -->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<!--<div class="card-header">
						<h5 class="card-header-text"><i class="icofont icofont-numbered"></i> Help</h5>
					</div>-->
					 <div class="card-block accordion-block">
						<div class="color-accordion" id="color-accordion">
							
							<a class="accordion-msg <?php echo $color;?>" ><i class="fa fa-folder-open-o"></i> การใช้ SESSION ของระบบ</a> 
							<div class="accordion-desc">
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
									<thead>
										<tr class="bg-primary">
											<th style="width: 40%;" class="text-center" >SESSION NAME</th>
											<th style="width: 60%;" class="text-center" >เก็บข้อมูล</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>WF_USER_ID</td>
											<td>รหัส USER ที่ login</td>
										</tr>
										<tr>
											<td>WF_USERNAME</td>
											<td>USER ที่ login</td>
										</tr>
										<tr>
											<td>WF_USER_NAME</td>
											<td>ชื่อ-นามสกุล ผู้ login</td>
										</tr>
										<tr>
											<td>DEP_ID</td>
											<td>รหัสหน่วยงานของ USER ที่ login</td>
										</tr>
										<tr>
											<td>POS_ID</td>
											<td>รหัสตำแหน่งของ USER ที่ login</td>
										</tr>
										<tr>
											<td>USR_OPTION1-10</td>
											<td>OPTION ที่มีการตั้งค่าเฉพาะ ของแต่ละโครงการ</td>
										</tr>
									</tbody>
								</table>
								<h6>การเรียกใช้ สามารถเรียกผ่านตัวแปร โดยใช้เครื่องหมาย  <code>@@SESSION!! </code></h6>
								<h6>ตัวอย่าง ต้องการกำหนดให้เห็นงานของคนที่เป็นคนเพิ่มข้อมูล	 <code>WFR_UID = '@@WF_USER_ID!!' </code></h6>
							</div>
						
							<a class="accordion-msg <?php echo $color;?>" ><i class="fa fa-folder-open-o"></i> การใช้ Class ในการ Connect Database</a> 
							<div class="accordion-desc">
								<div class="row">
									<div class="col-md-12"><h6>การเขียน Coding เองต้อง Include File ที่ใช้ Connect Database ดังนี้ </h6></div>
								</div>
								<div class="row" style="padding-left: 2.50rem;">
									<div class="col-md-12">
										<ul class="mega-list row">
											<li class="col-sm-12">
												<ul> 
													<li>
														<i class="icon-arrow-right"></i> <code>include '../include/comtop_user.php';</code>
													</li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12"><h6>การเขียน Coding เองต้อง Include File ที่ใช้ Close Connect Database ดังนี้ </h6></div>
								</div>
								<div class="row"  style="padding-left: 2.50rem;">
									<div class="col-md-12">
									
										<ul class="mega-list row">
											<li class="col-sm-12">
												<ul> 
													<li>
														<i class="icon-arrow-right"></i> <code>include '../include/combottom_user.php';	</code> หรือ <code>	db::db_close();</code>
													</li> 
												</ul>
											</li>
										</ul>
									</div>
								</div>
								<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
									<thead>
										<tr class="bg-primary">
											<th class="text-center" width="30%" >ฟังก์ชัน</th>
											<th class="text-center" width="30%">คำอธิบาย</th>
											<th class="text-center" width="40%">คำอธิบาย Parameter ของฟังก์ชัน</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><code>db::query($sql);</code></td>
											<td>ใช้สำหรับ Query Statement </td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$sql</dt>
													<dd class="col-sm-9">Sql Statement</dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>db::query_limit($sql, $offset, $limit);</code></td>
											<td>ใช้สำหรับ Query Statement และกำหนดจำนวน Record ของข้อมูล</td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$sql</dt>
													<dd class="col-sm-9">Sql Statement</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$offset</dt>
													<dd class="col-sm-9">จุดเริ่มต้นแถวของข้อมูล</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$limit</dt>
													<dd class="col-sm-9">จุดสิ้นสุดแถวของข้อมูล</dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>db::fetch_array($query);</code></td>
											<td>ใช้สำหรับ Fetch ข้อมูลที่ได้จากการ Query แล้ว Return ค่าเป็น Array</td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$query</dt>
													<dd class="col-sm-9">ตัวแปรที่เก็บค่าของการ Query Sql Statement  </dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>db::num_rows();</code></td>
											<td>ใช้สำหรับนับจำนวนข้อมูลที่ได้จากการ Query</td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$query</dt>
													<dd class="col-sm-9">ตัวแปรที่เก็บค่าของการ Query Sql Statement  </dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>db::db_insert($tbName, $data, $pkSelectMax = "", $outID = "")</code></td>
											<td>เป็นคำสั่งใช้ Insert ข้อมูลลง Database</td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$tbName</dt>
													<dd class="col-sm-9">ชื่อตารางที่ต้องการ Insert (บังคับใส่ Parameter)</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$data</dt>
													<dd class="col-sm-9">ข้อมูลที่จะ Insert เป็น Array โดย Key คือชื่อ Field, Value (บังคับใส่ Parameter)<br>Ex. $data["field1"] = 'value1'<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data["field2"] = 'value2'</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$pkSelectMax</dt>
													<dd class="col-sm-9">PK ของตารางที่ต้องการ Select Max (ไม่บังคับใส่ Parameter)</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$outID</dt>
													<dd class="col-sm-9">ต้องการเลข PK ล่าสุดที่ Insert ข้อมูลต้องใส่ค่าเป็น Y  (ไม่บังคับใส่ Parameter)</dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>db::db_update($tbName, $data, $cond)</code></td>
											<td>เป็นคำสั่งใช้ Update ข้อมูลลง Database</td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$tbName</dt>
													<dd class="col-sm-9">ชื่อตารางที่ต้องการ Update (บังคับใส่ Parameter)</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$data</dt>
													<dd class="col-sm-9">ข้อมูลที่จะ Update เป็น Array โดย Key คือชื่อ Field, Value (บังคับใส่ Parameter)<br>Ex. $data["field1"] = 'value1'<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$data["field2"] = 'value2'</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$cond</dt>
													<dd class="col-sm-9">เงื่อนไขเป็น Array โดย Key คือชื่อ Field ที่จะ Where, Value คือ ข้อมูลที่จะ Where (บังคับใส่ Parameter)</dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>db::db_delete($tbName, $cond)</code></td>
											<td>เป็นคำสั่งใช้ delete ข้อมูลจาก Database</td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$tbName</dt>
													<dd class="col-sm-9">ชื่อตารางที่ต้องการ Delete (บังคับใส่ Parameter)</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$cond</dt>
													<dd class="col-sm-9">เงื่อนไขเป็น Array โดย Key คือชื่อ Field ที่จะ Where, Value คือ ข้อมูลที่จะ Where</dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>db::show_field($tables)</code></td>
											<td>เป็นคำสั่งใช้ดึง Field ของตารางที่ต้องการ</td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$tables</dt>
													<dd class="col-sm-9">ชื่อตารางที่ต้องการ Show Fields (บังคับใส่ Parameter)</dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>db::get_max($table, $fieldGetMax, $cond = array())</code></td>
											<td>หาค่า ID ของ Field PK ที่มากสุด</td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$tables</dt>
													<dd class="col-sm-9">ชื่อตารางที่ต้องการหาค่า Max (บังคับใส่ Parameter)</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$fieldGetMax</dt>
													<dd class="col-sm-9">ชื่อ Field ที่ต้องการหาค่า Max (บังคับใส่ Parameter)</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$cond</dt>
													<dd class="col-sm-9">เงื่อนไข เป็น Array โดย Key คือชื่อ Field ที่จะ Where, Value คือ ข้อมูลที่จะ Where</dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>conText($text, $format = "")</code></td>
											<td>ใช้สำหรับแปลงรูปแบบการรับค่าจาก Input</td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$text</dt>
													<dd class="col-sm-9">ชื่อตัวแปรที่รับค่ามาจากการ Submit Form (บังคับใส่ Parameter)<br>Ex.conText($_POST["FILED_NAME"])</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$format</dt>
													<dd class="col-sm-9">Format ที่ต้องการแปลง (ไม่บังคับใส่ Parameter)<br>Format ที่มีในระบบ คือ <code>number</code> จะตัด , (Comma)ให้ และ <code>date</code> จะแปลงค่าวันที่จากการกรอกที่หน้าเว็บให้เป็น Format ของแต่ละฐานข้อมูล </dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>date2db($value='')</code></td>
											<td>แปลงรูปแบบวันที่จากการกรอกข้อมูลเข้าแต่ละฐานข้อมูล </td>
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$value</dt>
													<dd class="col-sm-9">วันที่ที่ต้องการแปลง โดย Format ที่รับค่าเข้า Function เป็น 01/12/2560</dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>db2date($value)</code></td>
											<td>แปลงรูปแบบวันที่จากฐานข้อมูลไปแสดงใน Date Picker </td> 
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$value</dt>
													<dd class="col-sm-9">วันที่ที่ต้องการแปลง Format จากฐานข้อมูลและแสดงเป็น รูปแบบ 01/12/2560 </dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>db2date_show($value)</code></td>
											<td>แปลงรูปแบบวันที่จากฐานข้อมูลแสดงในรูปแบบเดือนภาษาไทยเป็นตัวย่อและปีพ.ศ.</td> 
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$value</dt>
													<dd class="col-sm-9">วันที่ที่ต้องการแปลง Format จากฐานข้อมูลและแสดงเป็น 01 ธ.ค. 2560</dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>conDateText($value,$type)</code></td>
											<td>แปลงรูปแบบวันที่เป็นรูปแบบต่างๆ</td> 
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$value</dt>
													<dd class="col-sm-9">วันที่ที่ต้องการแปลง Format ที่รับค่าเข้า Function เป็น 2017-12-01 </dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$type</dt>
													<dd class="col-sm-9">ค่าของตัวแปร $type มีค่าดังนี้ต่อไปนี้ <br>
													<code>S</code>&nbsp;&nbsp; = 01 ธ.ค. 60<br>
													<!--<code>E</code> = 01 ธันวาคม 2560<br>-->
													<code>MC</code> = ธันวาคม<br>
													<code>MS</code> = ธ.ค.<br>
													<code>Y</code>&nbsp;&nbsp;   = 2560 (return เฉพาะปีของวันที่)<br>
													<code>BY</code> = 2561 (ตย.01 ธ.ค. 60 จะ return เป็นปีงบประมาณคือ 2561)<br>
													</dd>
												</dl>
											</td>
										</tr>
										<tr>
											<td><code>redirect($url, $text = false)</code></td>
											<td>เป็นฟังก์ชันใช้สำหรับ Redirect หลังจากบันทึกข้อมูลในหน้า Save</td> 
											<td>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$url</dt>
													<dd class="col-sm-9">Path url ที่ต้องการให้ Redirect ไป</dd>
												</dl>
												<dl class="dl-horizontal row">
													<dt class="col-sm-3">$text</dt>
													<dd class="col-sm-9">ข้อมูลที่ต้องการให้ Alert ก่อนที่จะ Redirect ไป url ที่ต้องการ
													</dd>
												</dl>
											</td>
										</tr>
										
									</tbody>
								</table>
							</div>
							
							<a class="accordion-msg <?php echo $color;?>" ><i class="fa fa-folder-open-o"></i> Icons</a> 
							<div class="accordion-desc">
								<ul class="mega-list row">
									<li class="col-sm-12">
										<ul> 
											<li>
												<a class="waves-effect waves-dark" href="icons_font_awesome.php" ><i class="icon-arrow-right"></i> Font-Awesome Icons</a>
											</li>
											<li>
												<a class="waves-effect waves-dark" href="icons_material_design.php"><i class="icon-arrow-right"></i> Material Design Icons</a>
											</li>
											<li>
												<a class="waves-effect waves-dark" href="icons_simple_line.php"><i class="icon-arrow-right"></i> Simple Line Icons</a>
											</li>
											<li>
												<a class="waves-effect waves-dark" href="icons_ion.php"><i class="icon-arrow-right"></i> Ion Icons</a>
											</li>
											<li>
												<a class="waves-effect waves-dark" href="icons_icofonts.php"><i class="icon-arrow-right"></i> Ico Fonts Icons</a>
											</li>
											<li>
												<a class="waves-effect waves-dark" href="icons_typicons.php"><i class="icon-arrow-right"></i> TypIcons</a>
											</li>
										</ul>
									</li>
								  </ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
			<!--<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-block">
							<div class="form-group row">
								<div class="col-md-12">
									<div class="table-responsive" data-pattern="priority-columns">
										<div class="card-header">
											<h4 class="card-header-text">
												<i class="fa fa-folder-open-o"></i> การใช้ SESSION ของระบบ
											</h4>
											
										</div>
										<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
											<thead>
												<tr class="bg-primary">
													<th style="width: 40%;" class="text-center" >SESSION NAME</th>
													<th style="width: 60%;" class="text-center" >เก็บข้อมูล</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>WF_USER_ID</td>
													<td>รหัส USER ที่ login</td>
												</tr>
												<tr>
													<td>WF_USERNAME</td>
													<td>USER ที่ login</td>
												</tr>
												<tr>
													<td>WF_USER_NAME</td>
													<td>ชื่อ-นามสกุล ผู้ login</td>
												</tr>
												<tr>
													<td>DEP_ID</td>
													<td>รหัสหน่วยงานของ USER ที่ login</td>
												</tr>
												<tr>
													<td>POS_ID</td>
													<td>รหัสตำแหน่งของ USER ที่ login</td>
												</tr>
												<tr>
													<td>USR_OPTION1-10</td>
													<td>OPTION ที่มีการตั้งค่าเฉพาะ ของแต่ละโครงการ</td>
												</tr>
											</tbody>
										</table>
										<h6>การเรียกใช้ สามารถเรียกผ่านตัวแปร โดยใช้เครื่องหมาย  @@SESSION!!</h6>
										<h6>ตัวอย่าง ต้องการกำหนดให้เห็นงานของคนที่เป็นคนเพิ่มข้อมูล	WFR_UID = '@@WF_USER_ID!!'</h6>
										</div>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-block">
							<div class="form-group row">
								<div class="col-md-12">
									<div class="card-header">
										<h4 class="card-header-text">
											<i class="fa fa-folder-open-o"></i> Icons
										</h4>
									</div>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-11">
									<ul class="mega-list row">
										<li class="col-sm-12">
											<ul>
												<li>
													<a class="waves-effect waves-dark" href="icons_font_awesome.php" ><i class="icon-arrow-right"></i> Font-Awesome Icons</a>
												</li>
												<li>
													<a class="waves-effect waves-dark" href="icons_material_design.php"><i class="icon-arrow-right"></i> Material Design Icons</a>
												</li>
												<li>
													<a class="waves-effect waves-dark" href="icons_simple_line.php"><i class="icon-arrow-right"></i> Simple Line Icons</a>
												</li>
												<li>
													<a class="waves-effect waves-dark" href="icons_ion.php"><i class="icon-arrow-right"></i> Ion Icons</a>
												</li>
												<li>
													<a class="waves-effect waves-dark" href="icons_icofonts.php"><i class="icon-arrow-right"></i> Ico Fonts Icons</a>
												</li>
												<li>
													<a class="waves-effect waves-dark" href="icons_typicons.php"><i class="icon-arrow-right"></i> TypIcons</a>
												</li>
                                            </ul>
                                        </li>
                                      </ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>-->
	</div>
</div>

<script type="text/javascript" src="../assets/pages/accordion.js"></script>
<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>