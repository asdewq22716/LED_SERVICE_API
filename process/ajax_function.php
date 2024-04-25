<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$process = $_REQUEST['process'];

if($process == "chk_username")
{
	$username = conText($_GET['username']);
	$id = conText($_GET['id']);

	if($id != "")
	{
		$filter = "and USR_ID != '".$id."' ";
	}

	$sql = db::query("select count(*) as TOTAL from USR_MAIN where USR_USERNAME = '".$username."' AND USR_STATUS='Y' ".$filter);
	$rec = db::fetch_array($sql);

	echo $rec['TOTAL'];
}
elseif($process == "help_field")
{
	$W = $_GET['w_id'];
	$WF_TYPE = $_GET['w_type'];
	$WF_ARR_FIELD = array();
	$WF_ARR_NAME = array();
	$WF_ARR_FIELD = db::show_field($_GET['w_name']);

	$query_main = db::query("SELECT WF_MAIN_SHORTNAME,WF_FIELD_PK,WF_TYPE FROM WF_MAIN WHERE WF_MAIN_ID='".$W."'");
	$rec_data = db::fetch_array($query_main);

	foreach($WF_ARR_FIELD as $key => $value)
	{
		$query_step_form = db::query("SELECT WFS_ID,WSF.WFS_FIELD_NAME,WSF.WFS_NAME 
											FROM WF_STEP_FORM WSF 
											WHERE WSF.WF_MAIN_ID = '".$W."' 
											AND WF_TYPE = '{$WF_TYPE}'
											AND (WFS_FIELD_NAME IS NOT NULL OR WFS_FIELD_NAME != '' ) 
											AND WFS_FIELD_NAME='".$value."'");
		$step_form = db::fetch_array($query_step_form);
		if($step_form["WFS_ID"] == '' && $rec_data["WF_FIELD_PK"] == '' && $value != 'WFR_ID' && $value != 'F_ID')
		{
			$drop = 'Y';
		}
		else
		{
			$drop = 'N';
		}
		?>

		<div class="media friendlist-box" id="H_<?php echo $value;?>">
			<div class="media-body">
				<div class="friend-header"><span id="field_help_<?php echo $value;?>"><code>##<?php echo $value;?>!!</code> <a href="#!"  data-toggle="modal" data-target="#bizModal" title="แก้ไข Field" onclick="open_modal('setting_step_edit_field.php?W=<?php echo $W;?>&WFS=<?php echo $step_form["WFS_ID"];?>&FIELD=<?php echo $value;?>&OBJ_HTML=field_help_<?php echo $value;?>&HELP=Y','แก้ไข Field');"><i class="fa fa-edit"></i></a></span> <p class="text-muted"><?php echo $step_form["WFS_NAME"];?></p>
				</div>
			</div>

		</div>

		<?php 	array_push($WF_ARR_NAME,$step_form["WFS_NAME"]);

	}
}

db::db_close();
?>