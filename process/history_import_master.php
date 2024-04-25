<?php
include '../include/comtop_admin.php';

$txt_system_name = 'รายการนำเข้าข้อมูล';
$sql_h = db::query("select * from WF_IMPORT_HISTORY order by WIH_DATE desc");
$num_rows_h = db::num_rows($sql_h);

?>
	<div class="content-wrapper">
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<!-- Row Starts -->
			<div class="row" id="animationSandbox">
				<div class="col-sm-8">
					<div class="main-header">
						<h4><?php echo $txt_system_name; ?></h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
						<li class="breadcrumb-item">
							<a href="index.php"><i class="icofont icofont-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="master.php">บริหาร Master</a>
						</li>
						<li class="breadcrumb-item">
							<a href="master_import.php">นำเข้าข้อมูล</a>
						</li>
						<li class="breadcrumb-item">
							<a href="">รายการนำเข้าข้อมูล</a>
						</li>
					</ol>
					</div>
				</div>
			</div>
			<form method="post" id="form_history_import" action="#" >
			<!-- Row end -->
				<!-- Row Starts -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="table-responsive" data-pattern="priority-columns">
									<table cellspacing="0" id="tech-companies-1" class="table table-bordered table-striped sorted_table">
										<thead>
											<tr class="bg-primary">
												<th class="text-center" data-priority="2" style="width:10%">ลำดับ</th>
												<th class="text-center" data-priority="2" style="width:15%">วันที่ / เวลา</th>
												<th class="text-center" data-priority="1" style="width:35%">ตาราง</th>
												<th class="text-center" data-priority="1" style="width:30%">ชื่อไฟล์</th>
												<th style="width:10%" class="text-center" data-priority="3"></th>
											</tr>
										</thead>
										<tbody>
										<?php
										if($num_rows_h > 0){
											$j=1;
											while($rec_h = db::fetch_array($sql_h))
											{
										?>
											<tr class="wf_keyword-box" id="h_import<?php echo $rec_h['WIH_ID'];?>">
												<td ><?php echo $j;?></td>
												<td class="text-center">
													<?php
													 echo db2date($rec_h["WIH_DATE"]).' '.$rec_h["WIH_TIME"];
													?>
												</td>
												<th>
													<?php
													$sql_main = db::query("SELECT WF_MAIN_NAME,WF_MAIN_SHORTNAME FROM WF_MAIN WHERE WF_MAIN_ID='".$rec_h["WF_MAIN_ID"]."'");
													$rec_main = db::fetch_array($sql_main);
													echo $rec_main["WF_MAIN_SHORTNAME"].'<br>'.$rec_main["WF_MAIN_NAME"];
													?>
												</th>
												<th>
													<?php echo $rec_h['WIH_FILE_NAME']; ?>
												</th>
												<td class="text-center">
													<nobr>
														<a href="#!" class="btn btn-danger btn-mini" title="ยกเลิกข้อมูลนำเข้า" onclick="delete_import_data('<?php echo $rec_h["WIH_ID"];?>','<?php echo $rec_h['WF_MAIN_ID'];?>')">
															<i class="icofont icofont-trash"></i> ยกเลิกข้อมูลนำเข้า
														</a>
													</nobr>
												</td>
											</tr>
											<?php $j++;}
										}else{?>
											<tr class="wf_keyword-box">
												<td class="text-center" colspan="5">ไม่มีข้อมูล</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Row end -->
			</form>
			<!-- Container-fluid ends -->
		</div>
	</div>
 <script>
	function delete_import_data(id,w){
		swal({
					title: "",
					text: "คุณต้องการลบข้อมูลนี้หรือไม่?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "ยืนยันการลบ",
					cancelButtonText: "ยกเลิก",
					closeOnConfirm: true
				},
			function(){
			var dataString = 'process=delete&h='+id+'&w='+w;
			$.ajax({
				type: "GET",
				url: "master_import_function.php",
				data: dataString,
				cache: false,
				success: function(html){
					if(html == 'Y'){
						$('#h_import'+id).hide();
					}
				} 
			 });
			});
	}
</script>
<?php include '../include/combottom_js.php'; ?>
<?php include '../include/combottom_admin.php'; ?>