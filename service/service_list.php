<?php
include '../include/include.php';

?>
<table border="1" width="80%" cellspacing="0" cellpadding="3" align="center">
	<tr>
		<td width="7%" align="center"><strong>ลำดับ</strong></td>
		<td width="15%" align="center"><strong>ชื่อ</strong></td>
		<td width="15%" align="center"><strong>ไฟล์</strong></td>
		<td width="15%" align="center"><strong>ตัวอย่าง</strong></td>
		<td width="15%" align="center"><strong>Request</strong></td>
		<td width="7%" align="center"><strong>ระบบแพ่ง</strong></td>
		<td width="7%" align="center"><strong>ไกล่เกลี่ย</strong></td>
		<td width="7%" align="center"><strong>ฟื้นฟู</strong></td>
		<td width="7%" align="center"><strong>ล้มละลาย</strong></td>
		<td width="7%" align="center"><strong>Back office</strong></td>
	</tr>
	<?php
	$sql = "SELECT		*
			FROM 		WH_SERVICE_LIST
			ORDER BY 	SERVICE_LIST_ID ASC";
	$i=1;
	$query = db::query($sql);
	while($rec = db::fetch_array($query)){
		?>
		<tr style="height:35;">
			<td align="center"><?php echo $i;?></td>
			<td><?php echo $rec["SERVICE_LIST_NAME"];?></td>
			<td>
				<a href="./example/<?php echo $rec["SERVICE_LIST_FILE"];?>" target="_blank"><?php echo $rec["SERVICE_LIST_FILE"];?></a>
			</td>
			<td align="left">
				<a href="./example/show_file_example.php?sevice_file=<?php echo $rec["SERVICE_LIST_FILE"];?>" target="_blank"><?php echo $rec["SERVICE_LIST_FILE"];?></a>
			</td>
			<td align="left">
				<?php
				if($rec["SERVICE_LIST_ID"]==2){
					echo "<a href=\"./example/".$rec["SERVICE_LIST_FILE"]."?registerCode=0135558001347\" target=\"_blank\">1.ทุกสถานะ</a><br>";
					echo "<a href=\"./example/".$rec["SERVICE_LIST_FILE"]."?registerCode=0135558001347&registerCode2=0205558010221\" target=\"_blank\">2.โจทก์เป็นโจทก์</a><br>";
					echo "<a href=\"./example/".$rec["SERVICE_LIST_FILE"]."?registerCode=0135558001347&registerCode2=0125553015536\" target=\"_blank\">3.จำเลยเป็นโจทก์</a><br>";
					echo "<a href=\"./example/".$rec["SERVICE_LIST_FILE"]."?registerCode=0135558001347&registerCode2=0125553015536\" target=\"_blank\">4.โจทก์เป็นจำเลย</a><br>";
				}
				if($rec["SERVICE_LIST_ID"]==8){
					?>
					<a href="Doc_cmd_example.pdf" target="_blank">ตัวอย่างการใช้งานระบบคำสั่งเจ้าพนักงาน</a>
					<?php
				}
				?>
			</td>
			<td align="center">
				<?php
				if($rec["SERVICE_CIL_STATUS"]==1){
					?>
					<img src="./example/file_att2.png" width="15px;">
					<?php
				}
				?>
			</td>
			<td align="center">
				<?php
				if($rec["SERVICE_MED_STATUS"]==1){
					?>
					<img src="./example/file_att2.png" width="15px;">
					<?php
				}
				?>
			</td>
			<td align="center">
				<?php
				if($rec["SERVICE_REH_STATUS"]==1){
					?>
					<img src="./example/file_att2.png" width="15px;">
					<?php
				}
				?>
			</td>
			<td align="center">
				<?php
				if($rec["SERVICE_BAN_STATUS"]==1){
					?>
					<img src="./example/file_att2.png" width="15px;">
					<?php
				}
				?>
			</td>
			<td align="center">
				<?php
				if($rec["SERVICE_OFF_STATUS"]==1){
					?>
					<img src="./example/file_att2.png" width="15px;">
					<?php
				}
				?>
			</td>
		</tr>
		<?php
		$i++;
	}
	?>
</table>