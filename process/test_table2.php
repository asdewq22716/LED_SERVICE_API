<?php
//$HIDE_HEADER = 'P';
include '../include/comtop_user.php';

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
<style>
	#header-fixed {
		position: fixed;
		top: 97px;
		display:none;
	}

</style>
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
				<div class="col-md-12">
					<table class="table table-bordered " id="table-1"  cellspacing="0">
						<thead>
							<tr class="bg-info">
								<th style="width: 5%;">#</th>
								<th style="width: 20%;">A</th>
								<th style="width: 20%;">B</th>
								<th style="width: 20%;">C</th>
								<th style="width: 20%;">D</th>
								<th style="width: 20%;">E</th>
							</tr>
						</thead>
						<tbody>
							<?php
							for($i=1; $i<=100; $i++){
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td ><?php echo GenerateSentence(); ?></td>
									<td ><?php echo GenerateSentence(); ?></td>
									<td nowrap=""><?php echo GenerateSentence(); ?></td>
									<td ><?php echo GenerateSentence(); ?></td>
									<td ><?php echo GenerateSentence(); ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<table id="header-fixed" class="table table-bordered"></table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		var tableWidth = $('#table-1').width();
		var tableOffset = $("#table-1").offset().top;
		var $header = $("#table-1 > thead").clone();
		var $fixedHeader = $("#header-fixed").append($header).width(tableWidth);

		var i_clone = 0;
		$('#table-1 thead tr th').each(function(){
			var thWidth = $(this).width();
			$('#header-fixed thead tr th:eq('+i_clone+')').width(thWidth);

			i_clone++;
		});

		$(window).bind("scroll", function() {
			var offset = $(this).scrollTop();

			if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
				$fixedHeader.show();
			}
			else if (offset < tableOffset) {
				$fixedHeader.hide();
			}
		});
	});
</script>

<?php include '../include/combottom_admin.php'; ?>