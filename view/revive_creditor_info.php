<?php
$creditor = db::query("SELECT
                        	a.*,
                          c.*
                        FROM
                        	WH_REHABILITATION_PERSON a
                        	INNER JOIN WH_REHABILITATION_MAP_GEN b ON a.WH_PERSON_ID = b.WH_PERSON_ID
                        	LEFT JOIN WH_REHABILITATION_CREDITOR c ON b.WH_REB_MAP_GEN_ID = c.WH_REB_MAP_GEN_ID
                        WHERE
                        	b.WH_REHAB_ID = '".$_GET['WFR']."'
                        	AND b.CONCERN_NAME = 'โจทก์'");
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
    $num = db::num_rows($creditor);
    if($num > 0){
      while ($cred = db::fetch_array($creditor)) {
  			if($cred['REGISTER_CODE']){
  				$registerCode = "";
  				$countStr = strlen($cred['REGISTER_CODE']);
  				for($j = 1; $j <= $countStr; $j++){
  					$t = substr($cred['REGISTER_CODE'],-14 + $j,1);
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
  			<td style=\"width:30%;\" class=\"text-left\">".$cred['PREFIX_NAME'].$cred['FIRST_NAME']." ".$cred['LAST_NAME']."</td>
  			<td style=\"width:15%;\" class=\"text-center\">
  				<a class=\"btn btn-info btn-mini\" href=\"\" onclick=\"open_modal('../all_modal/person_address_info.php?plaintiff=".$cred['WH_PERSON_ID']."&sys=revive', '','')\" data-toggle=\"modal\" data-target=\"#bizModal\">
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
