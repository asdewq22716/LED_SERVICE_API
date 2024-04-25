<?php
$command = db::query("SELECT * FROM WH_REHABILITATION_COURT WHERE WH_REHAB_ID = '".$_GET['WFR']."'");
?>
<div class="col-md-12"></div>
<table class="table table-bordered sorted_table">
	<thead class="bg-primary">
		<tr class="bg-primary">
			<th class="text-center">ลำดับ</th>
			<th class="text-center">วันที่ศาลมีคำสั่ง</th>
			<th class="text-center">คำสั่งศาล</th>
			<th class="text-center">เพิ่มเติม</th>
		</tr>
	</thead>
	<?php
	$i = 1;
	$num = db::num_rows($command);
	if($num > 0){
		while ($cmd = db::fetch_array($command)) {
			echo "<tr>
				<td class=\"text-center\">".$i."</td>
				<td class=\"text-center\">".db2date($cmd['COURT_ORDER_DATE'])."</td>
				<td class=\"text-center\">".$cmd['COURT_ORDER_NAME']."</td>
				<td style=\"width:15%;\" class=\"text-center\">
					<a class=\"btn btn-info btn-mini\" href=\"\" onclick=\"open_modal('../all_modal/cmd_info.php?id=".$cmd['WH_COURT_REB_ID']."', '','')\" data-toggle=\"modal\" data-target=\"#bizModal\">
						<i class=\"icofont icofont-search\"></i> ดูรายละเอียด
					</a>
				</td>
			</tr>";
		}
	}else{
		echo "<tr>
			<td class=\"text-center\" colspan=\"4\">ไม่พบข้อมูล</td>
		</tr>";
	}
	?>
	<tbody>
	</tbody>
</table>
