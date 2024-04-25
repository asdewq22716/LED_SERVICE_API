<?php
$qry = db::query("SELECT
										c.*,
										d.*
									FROM
										WH_CIVIL_CASE_MAP_GEN a
										INNER JOIN WH_CIVIL_CASE_ASSET_OWNER b ON a.WH_MAP_CASE_GEN_ID = b.WH_MAP_CASE_GEN_ID
										INNER JOIN WH_CIVIL_CASE_ASSETS c ON b.WH_ASSET_ID = c.WH_ASSET_ID
										INNER JOIN ".Convert::ConvertTable('WH_CIVIL_CASE_PERSON')." d ON a.WH_PERSON_ID = d.WH_PERSON_ID AND a.CONCERN_CODE = 11
									WHERE
										a.WH_CIVIL_ID = '".$_GET['WFR']."'");
?>
<div class="col-md-12"></div>
<table class="table table-bordered sorted_table">
	<thead class="bg-primary">
		<tr class="bg-primary">
			<th class="text-center">ลำดับ</th>
			<th class="text-center">ประเภททรัพย์</th>
			<th class="text-center">รายละเอียดทรัพย์</th>
			<th class="text-center">ผู้ถือกรรมสิทธิ์/เจ้าของทรัพย์</th>
			<th class="text-center">ภาระทรัพย์</th>
      <th class="text-center">ราคาประเมิน</th>
      <!-- <th class="text-center">ครั้งที่ยึด</th>
      <th class="text-center">วันที่ยึด</th> -->
      <th class="text-center">สถานะทรัพย์</th>
      <th class="text-center">เพิ่มเติม</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		$num = db::num_rows($qry);
		if($num > 0){
			while ($asset = db::fetch_array($qry)) {
				echo "<tr>
				<td style=\"width:;\" class=\"text-center\">".$i."</td>
				<td style=\"width:;\" class=\"text-left\">".$asset['TYPE_CODE']."</td>
				<td style=\"width:;\" class=\"text-left\">".$asset['PROP_TITLE']."</td>
        <td style=\"width:;\" class=\"text-left\">".$asset['PREFIX_NAME'].$asset['FIRST_NAME']." ".$asset['LAST_NAME']."</td>
				<td style=\"width:;\" class=\"text-left\">".$asset['COMMIT_TYPE']."</td>
        <td style=\"width:;\" class=\"text-left\">".$asset['EST_PRICE_AMOUNT']."</td>
        <td style=\"width:;\" class=\"text-left\">".$asset['PROP_STATUS']."</td>
					<a class=\"btn btn-info btn-mini\" href=\"\" onclick=\"open_modal('../all_modal/asset_info.php?id=".$asset['ASSET_ID']."', '','')\" data-toggle=\"modal\" data-target=\"#bizModal\">
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
