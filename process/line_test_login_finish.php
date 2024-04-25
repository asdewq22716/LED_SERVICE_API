<?php

include '../include/include.php';

$W = $_GET['W'];
?>
<br><br><br><br><br><br><br><br><br><br>
<div class="container">
	<div class="row">
		<div class="col">
			<?php 
			print_r($_GET);
			print_r($_POST);
			?>
		</div>
	</div>
</div>
<?php include '../include/combottom_admin.php'; ?>