<?php
class civilCaseReceiptAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new civilCaseReceiptResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>