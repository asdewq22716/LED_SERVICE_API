<?php

include '../include/comtop_admin.php';

$W = $_GET['W'];
?>

<div class="container-fluid">
	<div class="row">
		<div class="col">
			<button onclick="Auth();" class="btn btn-info">Line Notify</button>
		</div>
	</div>
</div>


 <script>
        function Auth() {
            var URL = 'https://notify-bot.line.me/oauth/authorize?';
            URL += 'response_type=code';
            URL += '&client_id=alzfzwhpTIDnWheBbJrhVq';
            URL += '&redirect_uri=http://103.208.27.224/workflow_master4/process/line_test_login_finish.php';//ถ้า login แล้ว เลือกกลุ่มหรือตัวเอง ให้กลับมาหน้านี้
            URL += '&scope=notify';
            URL += '&state=Neung';//กำหนด  user หรือ อะไรก็ได้ที่สามารถบอกถึงว่าเป็น user ในระบบ
            window.location.href = URL;
        }
    </script>
<?php include '../include/combottom_admin.php'; ?>