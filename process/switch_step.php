<?php
$HIDE_HEADER = "Y";
include '../include/comtop_admin.php';
$W = conText($_GET['W']);
$WFD = conText($_GET['WFD']);
?>
<form action="#" name="form_modal" id="form_modal" method="post" target="modal_save">
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr class="bg-primary">
					<th style="width: 10%;" class="text-center">เลือก</th>
					<th style="width: 90%;" class="text-center">ขั้นตอน</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$detail_in_wf = build_data('WF_DETAIL', 'WFD_ID', 'WFD_NAME', "WF_MAIN_ID = '".$W."' and WFD_ID != '".$WFD."' ");
				$i=1;
				foreach($detail_in_wf as $_key => $_val)
				{
					?>
					<tr>
						<td align="center">
							<div class="radio-color checkbox-primary">
								<input name="chk_step" id="chk_step<?php echo $i; ?>" type="radio" value="Y" >
								<label for="chk_step<?php echo $i; ?>">
									เลือก
								</label>
							</div>
							<input type="hidden" name="WFD_ID<?php echo $i; ?>" id="WFD_ID<?php echo $i; ?>" value="<?php echo $_key; ?>">
						</td>
						<td align="left"><?php echo $_val; ?></td>
					</tr>
				<?php $i++; } ?>
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="text-center">&nbsp;
				<button type="submit" class="btn btn-md btn-success active waves-effect waves-light"><i class="icofont icofont-tick-mark"></i> บันทึก</button>
			</div>
		</div>
	</div>

</form>