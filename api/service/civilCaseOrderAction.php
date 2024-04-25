<?php
class civilCaseOrderAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new civilCaseOrderResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>