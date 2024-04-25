<?php
$petitioner = db::query("SELECT
                        	b.*
                        FROM
                        	WH_REHABILITATION_MAP_GEN a
                        	INNER JOIN WH_REHABILITATION_PERSON b ON a.WH_PERSON_ID = b.WH_PERSON_ID
                        WHERE
                        	a.WH_REHAB_ID = '".$_GET['WFR']."'
                          AND a.CONCERN_NAME = 'จำเลย'");
?>
<div class="col-md-12"></div>
<table class="table table-bordered sorted_table">
	<thead class="bg-primary">
		<tr class="bg-primary">
			<th class="text-center">ลำดับ</th>
			<th class="text-center">เลขประจำตัวประชาชน/เลขนิติบุคค</th>
			<th class="text-center">ชื่อ-นามสกุล</th>
			<th class="text-center">เพิ่มเติม</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
    $num = db::num_rows($petitioner);
    if($num > 0){
      while ($petition = db::fetch_array($petitioner)) {
  			if($petition['REGISTER_CODE']){
  				$registerCode = "";
  				$countStr = strlen($petition['REGISTER_CODE']);
  				for($j = 1; $j <= $countStr; $j++){
  					$t = substr($petition['REGISTER_CODE'],-14 + $j,1);
  					if($j == 2 || $j == 6 || $j == 11 || $j == 13){
  						$registerCode .= "-".$t;
  					}else{
  						$registerCode .= $t;
  					}
  				}
  			}else{
  				$registerCode = "-";
  			}
  			echo "<tr>
  			<td style=\"width:15%;\" class=\"text-center\">".$i."</td>
  			<td style=\"width:40%;\" class=\"text-center\">".$registerCode."</td>
  			<td style=\"width:30%;\" class=\"text-left\">".$petition['PREFIX_NAME'].$petition['FIRST_NAME']." ".$petition['LAST_NAME']."</td>
  			<td style=\"width:15%;\" class=\"text-center\">
  				<a class=\"btn btn-info btn-mini\" href=\"\" onclick=\"open_modal('../all_modal/person_address_info.php?plaintiff=".$petition['WH_PERSON_ID']."&sys=revive', '','')\" data-toggle=\"modal\" data-target=\"#bizModal\">
  					<i class=\"icofont icofont-search\"></i> ดูรายละเอียด
  				</a>
  			</td>
  			</tr>";
  			$i++;
  		}
    }else{
      echo "<tr>
  			<td class=\"text-center\" colspan=\"4\">ไม่พบข้อมูล</td>
  		</tr>";
    }
		?>
	</tbody>
</table>
