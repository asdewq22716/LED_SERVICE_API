<?php
$command = db::query("SELECT * FROM WH_BANKRUPT_DOCKET WHERE BANKRUPT_CODE = '".$_GET['WFR']."'");
?>
<div class="col-md-12"></div>
<table class="table table-bordered sorted_table">
	<thead class="bg-primary">
		<tr class="bg-primary">
			<th class="text-center">ลำดับ</th>
			<th class="text-center">สำนวน</th>
			<th class="text-center">จพท.ผู้ดูแลสำนวน</th>
			<th class="text-center">เพิ่มเติม</th>
		</tr>
	</thead>
	<?php
	$i = 1;
	$num = db::num_rows($command);
	if($num > 0){
		while ($data = db::fetch_array($command)) {
			echo "<tr>
				<td class=\"text-center\">".$i."</td>
				<td class=\"text-center\">".$data['DOCKET_NAME']."</td>
				<td class=\"text-center\">".$data['DOCKET_OWNER']."</td>
				<td style=\"width:15%;\" class=\"text-center\">
					<a class=\"btn btn-info btn-mini\" href=\"\" onclick=\"open_modal('../all_modal/idiom_info.php?id=".$data['DOCKET_ID']."', '','')\" data-toggle=\"modal\" data-target=\"#bizModal\">
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
