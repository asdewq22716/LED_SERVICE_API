<?php
$qry = db::query("SELECT
										*
									FROM
										WH_CIVIL_CASE_RECEIPT a
										INNER JOIN WH_CIVIL_CASE b ON a.CIVIL_CODE = b.CIVIL_CODE
									WHERE
										b.WH_CIVIL_ID = '".$_GET['WFR']."'");
?>
<div class="col-md-12"></div>
<table class="table table-bordered sorted_table">
	<thead class="bg-primary">
		<tr class="bg-primary">
			<th class="text-center">ลำดับ</th>
			<th class="text-center">เลขที่ใบเสร็จรับเงิน</th>
			<th class="text-center">เลขบัญชี</th>
			<th class="text-center"></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		$num = db::num_rows($qry);
		if($num > 0){
			while ($data = db::fetch_array($qry)) {
				echo "<tr>
				<td style=\"width:;\" class=\"text-center\">".$i."</td>
				<td style=\"width:;\" class=\"text-left\">".$data['TYPE_CODE']."</td>
					<a class=\"btn btn-info btn-mini\" href=\"\" onclick=\"open_modal('../all_modal/asset_info.php?id=".$data['ASSET_ID']."', '','')\" data-toggle=\"modal\" data-target=\"#bizModal\">
						<i class=\"icofont icofont-search\"></i> ดูรายละเอียด
					</a>
				</td>
				</tr>";
				$i++;
			}
		}else{
			echo "<tr>
				<td class=\"text-center\" colspan=\"9\">ไม่พบข้อมูล</td>
			</tr>";
		}
		?>
	</tbody>
</table>
