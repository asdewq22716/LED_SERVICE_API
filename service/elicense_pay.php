<?php
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");

  $HIDE_HEADER = "Y";
  include '../include/include.php';
 
  if(!empty($_POST['bookBank'])){
	  $bookBank = $_POST['bookBank'];
  }else{
	  $bookBank = "0581093275";
  }
?>
<form id="payFormCcard" name="payFormCcard" method="post" action="https://uatktbfastpay.ktb.co.th/SIT/eng/payment/payForm.jsp">
	<input type="hidden" name="merchantId" value="900000065">
	<input type="hidden" name="amount" value="500" >
	<input type="hidden" name="orderRef" value="001">
	<input type="hidden" name="currCode" value="764">
	<input type="hidden" name="successUrl" value="https://ledpaymentgw.led.go.th/Success.php?id=2&wfr=<?php echo $_POST["wfr"];?>">
	<input type="hidden" name="failUrl" value="https://ledpaymentgw.led.go.th/Fail.php?id=2&wfr=<?php echo $_POST["wfr"];?>">
	<input type="hidden" name="cancelUrl" value="https://ledpaymentgw.led.go.th/Cancel.php?id=2&wfr=<?php echo $_POST["wfr"];?>">
	<input type="hidden" name="payType" value="N"> 
	<input type="hidden" name="lang" value="T">
	<input type="hidden" name="orderRef1" value="001">
	<input type="hidden" name="orderRef2" value="002">
	<input type="hidden" name="orderRef3" value="">
	<input type="hidden" name="orderRef4" value="">
	<input type="hidden" name="orderRef5" value="">
	<input type="hidden" name="orderRef6" value="">
	<input type="hidden" name="washAccount" value="1">
	<input type="hidden" name="washAmount" value="">
	<input type="hidden" name="washMerchant" value="">
	<input type="hidden" name="remark" value="remark">
</form>
<script type="text/javascript">
	document.getElementById("payFormCcard").submit();
</script>
