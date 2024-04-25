<?php

include '../include/comtop_admin.php';

$W = $_GET['W'];

function GenerateWord()
{
	//Get a random word
	$nb = rand(3, 10);
	$w = '';
	for($i = 1;$i <= $nb;$i++)
	{
		$w .= chr(rand(ord('a'), ord('z')));
	}

	return $w;
}

function GenerateSentence()
{
	//Get a random sentence
	$nb = rand(1, 10);
	$s = '';
	for($i = 1;$i <= $nb;$i++)
	{
		$s .= GenerateWord().' ';
	}

	return substr($s, 0, -1);
}
	?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.4/css/fixedColumns.bootstrap4.min.css">
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script>

	<br><br>
<div class="container-fluid" >
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-text text-success">
				<i class="fa fa-check-circle"></i> Test Fix Column & Row Tablesadsad
			</h5>
		</div>
		<div class="card-block">
			<div class="row">
				<div class="col">
					<table class="table table-bordered " id="tb_fix_col"  cellspacing="0">
						<thead>
							<tr class="bg-info">
								<th>#</th>
								<th>A</th>
								<th>B</th>
								<th>C</th>
								<th>D</th>
								<th>E</th>
							</tr>
						</thead>
						<tbody>
							<?php
							for($i=1; $i<=100; $i++){
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo GenerateSentence(); ?></td>
									<td><?php echo GenerateSentence(); ?></td>
									<td><?php echo GenerateSentence(); ?></td>
									<td><?php echo GenerateSentence(); ?></td>
									<td><?php echo GenerateSentence(); ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var table = $('#tb_fix_col').DataTable( {
			scrollY:        "500px",
			scrollX:        true,
			scrollCollapse: true,
			paging:         false,
			fixedColumns:   true,
			searching: false,
			ordering: false,
			info: false
		} );
	} );
</script>

<?php include '../include/combottom_admin.php'; ?>