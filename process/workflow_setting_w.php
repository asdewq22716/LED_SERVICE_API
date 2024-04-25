<?php
include("../include/com_top_admin.php");

$sql_data = $db->query("SELECT * FROM wf_main WHERE wf_main_id = '".$_GET["W"]."' ");
if($db->db_num_rows($sql_data) == 1){
$R = $db->db_fetch_array($sql_data);
?> 
<script language="javascript" type="text/javascript">
	function OpenPopupCenter(pageURL, title, w, h) {
		var left = (screen.width - w) / 2;
		var top = (screen.height - h) / 4;  // for 25% - devide by 4  |  for 33% - devide by 3
		var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
	}	
</script>
 <nav>
		<div id="jCrumbs" class="breadCrumb module">
			<ul>
				<li>
					<a href="home.php"><i class="icon-home"></i></a>
				</li>
				<li>
					<a href="workflow.php">บริหาร Workflow</a>
				</li>
				<li>ตั้งค่าสิทธิ์<?php echo $R["wf_main_name"]; ?></li>
			</ul>
		</div>
	</nav>
 
<h3 class="pull-left"><img src="../img/gCons/agent.png" alt="" />สิทธิ์รายบุคคล</h3>
<span class="pull-right">
<a href="#" onclick="OpenPopupCenter('workflow_setting_add_department.php?CODE=WFM&ACESS_REF_ID=<?php echo $R["wf_main_id"];?>&TYPE=U', '', 900, 600);" class="btn btn-small btn-success"><i class="splashy-contact_grey_add"></i> เพิ่มสิทธิ์รายบุคคล </a> 
</span>
<img src="../img/news-group_18.png" style="width:100%;height:6px;" alt=""/>
<div class="row-fluid">
    <div class="span12">
		<?php
             $sql_per_u = $db->query("SELECT * FROM USR_ACCESS WHERE USR_TYPE = 'U' AND ACCESS_TYPE = 'WFM' AND ACCESS_REF_ID = '".$R["wf_main_id"]."'  ");
			 if($db->db_num_rows($sql_per_u) > 0){
                    ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ชื่อ นามสกุล</th>
                    </tr>
                </thead>
                <tbody>
                <?php
				while($F=$db->db_fetch_array($sql_per_u)){ 
				
				$sql_u = $db->query("SELECT * FROM USR_MAIN WHERE USR_ID = '".$F["USR_REF_ID"]."' ");
					while($U=$db->db_fetch_array($sql_u)){ 
					?>
				 <tr>
				<td><?php echo $U["USR_NAME"];?> <?php echo $U["USR_SNAME"];?></td>
				</tr>
				<?php }} ?>
                </tbody>
            </table>
			<?php }else{ ?>
			<code><i class="splashy-warning_triangle_small"></i>ไม่มีข้อมูลการตั้งค่าสิทธิ์รายบุคคล</code>
			<br /><br /><br />
			<?php } ?>
	</div>
</div>


<h3 class="pull-left"><img src="../img/gCons/home.png" alt="" />สิทธิ์รายหน่วยงาน</h3>
<span class="pull-right">
<a href="#" onclick="OpenPopupCenter('workflow_setting_add_department.php?CODE=WFM&ACESS_REF_ID=<?php echo $R["wf_main_id"];?>&TYPE=D', '', 900, 600);" class="btn btn-small btn-success"><i class="splashy-contact_grey_add"></i> เพิ่มสิทธิ์รายหน่วยงาน</a> 
</span>
<img src="../img/news-group_18.png" style="width:100%;height:6px;" alt=""/>
<div class="row-fluid">
    <div class="span12">
            <?php
             $sql_per_d = $db->query("SELECT * FROM USR_ACCESS WHERE USR_TYPE = 'D' AND ACCESS_TYPE = 'WFM' AND ACCESS_REF_ID = '".$R["wf_main_id"]."' ");
			 if($db->db_num_rows($sql_per_d) > 0){
                    ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>หน่วยงาน</th>
                    </tr>
                </thead>
                <tbody>
                <?php
				while($F=$db->db_fetch_array($sql_per_d)){ 
				
				$sql_d = $db->query("SELECT * FROM USR_DEPARTMENT WHERE DEP_ID = '".$F["USR_REF_ID"]."' ");
					while($D=$db->db_fetch_array($sql_d)){ 
				?>
				<tr>
				<td><?php echo $D["DEP_NAME"];?></td>
				</tr>	
				<?php }} ?>
                </tbody>
            </table>
			<?php }else{ ?>
			<code><i class="splashy-warning_triangle_small"></i>ไม่มีข้อมูลการตั้งค่าสิทธิ์รายหน่วยงาน</code>
			<br /><br /><br />
			<?php } ?>
	</div>
</div>

<h3 class="pull-left"><img src="../img/gCons/male-user.png" alt="" />สิทธิ์รายตำแหน่ง</h3>
<span class="pull-right">
<a href="#" onclick="OpenPopupCenter('workflow_setting_add_department.php?CODE=WFM&ACESS_REF_ID=<?php echo $R["wf_main_id"];?>&TYPE=P', '', 900, 600);" class="btn btn-small btn-success"><i class="splashy-contact_grey_add"></i> เพิ่มสิทธิ์รายตำแหน่ง</a> 
</span>
<img src="../img/news-group_18.png" style="width:100%;height:6px;" alt=""/>
<div class="row-fluid">
    <div class="span12">
            <?php
             $sql_per_d = $db->query("SELECT * FROM USR_ACCESS WHERE USR_TYPE = 'P' AND ACCESS_TYPE = 'WFM' AND ACCESS_REF_ID = '".$R["wf_main_id"]."' ");
			 if($db->db_num_rows($sql_per_d) > 0){
                    ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ตำแหน่ง</th>
                    </tr>
                </thead>
                <tbody>
                <?php
				while($F=$db->db_fetch_array($sql_per_d)){ 
				
					$sql_p = $db->query("SELECT * FROM USR_POSITION WHERE POS_ID = '".$F["USR_REF_ID"]."' ");
					while($P=$db->db_fetch_array($sql_p)){ 
					?>
				<tr>
				<td><?php echo $P["POS_NAME"];?></td>
				</tr>	
				<?php }} ?>
                </tbody>
            </table>
			<?php }else{ ?>
			<code><i class="splashy-warning_triangle_small"></i>ไม่มีข้อมูลการตั้งค่าสิทธิ์รายตำแหน่ง</code>
			<br /><br /><br />
			<?php } ?>
	</div>
</div>

<h3 class="pull-left"><img src="../img/gCons/multi-agents.png" alt="" />สิทธิ์รายกลุ่ม</h3>
<span class="pull-right">
<a href="#" onclick="OpenPopupCenter('workflow_setting_add_department.php?CODE=WFM&ACESS_REF_ID=<?php echo $R["wf_main_id"];?>&TYPE=G', '', 900, 600);" class="btn btn-small btn-success"><i class="splashy-contact_grey_add"></i> เพิ่มสิทธิ์รายกลุ่ม</a> 
</span>
<img src="../img/news-group_18.png" style="width:100%;height:6px;" alt=""/>
<div class="row-fluid">
    <div class="span12">
            <?php
             $sql_per_d = $db->query("SELECT * FROM USR_ACCESS WHERE USR_TYPE = 'G' AND ACCESS_TYPE = 'WFM' AND ACCESS_REF_ID = '".$R["wf_main_id"]."' ");
			 if($db->db_num_rows($sql_per_d) > 0){
                    ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ตำแหน่ง</th>
                    </tr>
                </thead>
                <tbody>
                <?php
				while($F=$db->db_fetch_array($sql_per_d)){ 
					$sql_g = $db->query("SELECT * FROM USR_GROUP WHERE GROUP_ID = '".$F["USR_REF_ID"]."' ");
					while($G=$db->db_fetch_array($sql_g)){ 
					?>
				<tr>
				<td><?php echo $G["GROUP_NAME"];?></td>
				</tr>	
				<?php }} ?>
                </tbody>
            </table>
			<?php }else{ ?>
			<code><i class="splashy-warning_triangle_small"></i>ไม่มีข้อมูลการตั้งค่าสิทธิ์รายกลุ่ม</code>
			<br /><br /><br />
			<?php } ?>
	</div>
</div>
<?php
}
include("../include/com_bottom_admin.php");
?>