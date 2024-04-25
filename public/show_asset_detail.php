<?php
$HIDE_HEADER = "Y";
include '../include/comtop_user.php';
include '../include/func_Nop.php';

$form_field['assetId'] = $_GET['ASSET_ID'];
$data = api_led_service('getAssetDetail.php', $form_field);




?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
<link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
<link rel="stylesheet" type="text/css" href="../assets/css/?c=e55ea2" id="color">
<style>
	.card-header {
		border-bottom: 0px;
	}

	.bg-primary {
		background-color: #A8164E!important;
		/* เปลี่ยนสีตามที่คุณต้องการ */
}
</style>
<div class="container-fluid">
	<!-- Row Starts -->
	<div class="row" id="animationSandbox">
		<div class="col-sm-12">
			<div class="main-header">
				<div class="media m-b-12">
					<div class="media-body">
						<h4> <img src="../icon/icon7.png"> รายละเอียดการยึดทรัพย์สิน </h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Workflow row start-->
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"></div>
				<div class="card-block"><br>
					<div class="wf-left">
						<label class="label bg-primary">จำเลยและผู้ถือกรรมสิทธิ์ร่วม</label>
					</div>
					<br>
					<div class="table-responsive" data-pattern="priority-columns" id="export_data2">
						<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
							<thead class="bg-primary">
								<tr class="bg-primary">
									<th style="width: 5%;" class="text-center">ลำดับ</th>
									<th style="width: 70%;" class="text-center">ชื่อ-นามสกุล</th>
									<th style="width: 25%;" class="text-center">อัตราส่วน</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (count($data["Data"]["01"]) > 0) {
									$i = 1;
									foreach ($data["Data"]["01"] as $key => $val) {
								?>
										<tr>
											<td align="center"><?php echo $i; ?></td>
											<td><?php echo $val["PERSON_NAME"] ?></td>
											<td><?php echo $val["HOLDING_TYPE"] ?></td>
										</tr>
								<?php
										$i++;
									}
								} else {
									echo "<tr><td colspan=\"3\" align=\"center\">ไม่มีจำเลยและผู้ถือกรรมสิทธิ์ร่วม</td></tr>";
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="wf-left">
						<label class="label bg-primary">ทายาท ผู้จัดการมรดก หรือบุคคนอื่นๆที่เกี่ยวข้อง</label>
					</div>
					<br>
					<div class="table-responsive" data-pattern="priority-columns" id="export_data2">
						<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
							<thead class="bg-primary">
								<tr class="bg-primary">
									<th style="width: 5%;" class="text-center">ลำดับ</th>
									<th style="width: 70%;" class="text-center">ชื่อ-นามสกุล</th>
									<th style="width: 25%;" class="text-center">อัตราส่วน</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (count($data["Data"]["02"]) > 0) {
									$i = 1;
									foreach ($data["Data"]["02"] as $key => $val) {
								?>
										<tr>
											<td align="center"><?php echo $i; ?></td>
											<td><?php echo $val["PERSON_NAME"] ?></td>
											<td><?php echo $val["HOLDING_TYPE"] ?></td>
										</tr>
								<?php
										$i++;
									}
								} else {
									echo "<tr><td colspan=\"3\" align=\"center\">ไม่มีทายาท ผู้จัดการมรดก หรือบุคคนอื่นๆที่เกี่ยวข้อง</td></tr>";
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="wf-left">
						<label class="label bg-primary">ผู้รับจำนอง</label>
					</div>
					<br>
					<div class="table-responsive" data-pattern="priority-columns" id="export_data2">
						<table cellspacing="0" id="tech-companies-1" class="table table-bordered sorted_table">
							<thead class="bg-primary">
								<tr class="bg-primary">
									<th style="width: 5%;" class="text-center">ลำดับ</th>
									<th style="width: 95%;" class="text-center">ชื่อ-นามสกุล</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (count($data["Data"]["03"]) > 0) {
									$i = 1;
									foreach ($data["Data"]["03"] as $key => $val) {
								?>
										<tr>
											<td align="center"><?php echo $i; ?></td>
											<td><?php echo $val["PERSON_NAME"] ?></td>
										</tr>
								<?php
										$i++;
									}
								} else {
									echo "<tr><td colspan=\"2\" align=\"center\">ไม่มีผู้รับจำนอง</td></tr>";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include '../include/combottom_js_user.php';
include '../include/combottom_user.php';
?>