<?php
$HIDE_HEADER = 'Y';
include '../include/comtop_admin.php';


$sql_w = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME,WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'W' AND WF_MAIN_TYPE = 'W' ORDER BY WF_MAIN_ORDER ASC");
$num_rows_w = db::num_rows($sql_w);

$sql_m = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME,WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'M' AND WF_MAIN_TYPE = 'W' ORDER BY WF_MAIN_ORDER ASC"); 
$num_rows_m = db::num_rows($sql_m);

$sql_f = db::query("select WF_MAIN_ID,WF_TYPE,WF_MAIN_NAME,WF_MAIN_SHORTNAME from WF_MAIN where WF_MAIN_STATUS = 'Y' AND WF_TYPE = 'F' AND WF_MAIN_TYPE = 'W' ORDER BY WF_MAIN_ORDER ASC"); 
$num_rows_f = db::num_rows($sql_f);

?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-block">
				<?php
				if($num_rows_w > 0)
				{
					?>
					<div class="form-group row">
						<div class="col">
							<h5>Workflow</h5>
						</div>
					</div>
					<div class="form-group row">
						<?php
						$i = 1;
						while($rec_w = db::fetch_array($sql_w))
						{
							?>
							<div class="col-xs-4">
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="WF_SELECT[]" id="WF_SELECT<?php echo $i; ?>" value="<?php echo $rec_w["WF_MAIN_ID"]; ?>" onclick="choose_table_other('<?php echo $rec_w['WF_MAIN_ID']; ?>', '<?php echo $rec_w["WF_MAIN_SHORTNAME"]; ?>', '<?php echo $rec_w["WF_TYPE"]; ?>', '<?php echo $rec_w["WF_MAIN_NAME"]; ?>');">
										<i class="helper"></i>
										<?php echo $rec_w["WF_MAIN_NAME"]; ?> <br><small class="label label-info"><i class="fa fa-database"></i> <?php echo $rec_w["WF_MAIN_SHORTNAME"]; ?></small>
									</label>
								</div>
							</div>
							<?php
							if($i % 3 == 0)
							{
								echo '<div class="clearfix"></div>';
							}
							$i++;
						}
						?>
					</div>
					<?php
				}
				if($num_rows_m > 0)
				{
					?>
					<hr>
					<div class="form-group row">
						<div class="col">
							<h5>Master</h5>
						</div>
					</div>
					<div class="form-group row">
						<?php
						$i = 1;
						while($rec_m = db::fetch_array($sql_m))
						{
							?>
							<div class="col-xs-4">
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="WF_SELECT[]" id="WF_SELECT<?php echo $i; ?>" value="<?php echo $rec_m["WF_MAIN_ID"]; ?>" onclick="choose_table_other('<?php echo $rec_m['WF_MAIN_ID']; ?>', '<?php echo $rec_m["WF_MAIN_SHORTNAME"]; ?>', '<?php echo $rec_m["WF_TYPE"]; ?>', '<?php echo $rec_m["WF_MAIN_NAME"]; ?>');">
										<i class="helper"></i>
										<?php echo $rec_m["WF_MAIN_NAME"]; ?> <br><small class="label label-info"><i class="fa fa-database"></i> <?php echo $rec_m["WF_MAIN_SHORTNAME"]; ?></small>
									</label>
								</div>
							</div>
							<?php
							if($i % 3 == 0)
							{
								echo '<div class="clearfix"></div>';
							}
							$i++;
						}
						?>
					</div>
					<?php
				}

				if($num_rows_f > 0)
				{
					?>
					<hr>
					<div class="form-group row">
						<div class="col">
							<h5>Form</h5>
						</div>
					</div>
					<div class="form-group row">
						<?php
						$i = 1;
						while($rec_f = db::fetch_array($sql_f))
						{
							?>
							<div class="col-xs-4">
								<div class="radio radio-inline">
									<label>
										<input type="radio" name="WF_SELECT[]" id="WF_SELECT<?php echo $i; ?>" value="<?php echo $rec_f["WF_MAIN_ID"]; ?>" onclick="choose_table_other('<?php echo $rec_f['WF_MAIN_ID']; ?>', '<?php echo $rec_f["WF_MAIN_SHORTNAME"]; ?>', '<?php echo $rec_f["WF_TYPE"]; ?>', '<?php echo $rec_f["WF_MAIN_NAME"]; ?>');">
										<i class="helper"></i>
										<?php echo $rec_f["WF_MAIN_NAME"]; ?> <br><small class="label label-info"><i class="fa fa-database"></i> <?php echo $rec_f["WF_MAIN_SHORTNAME"]; ?></small>
									</label>
								</div>
							</div>
							<?php
							if($i % 3 == 0)
							{
								echo '<div class="clearfix"></div>';
							}
							$i++;
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>

<script>
	function choose_table_other(w_id, w_name, w_type, flag)
	{
		load_help_field(w_id, w_name, w_type, flag);
		$('#bizModal').modal('toggle');
	}
</script>

<?php
include '../include/combottom_js.php';
include '../include/combottom_admin.php'; ?>
