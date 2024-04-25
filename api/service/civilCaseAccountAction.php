<?php
class civilCaseAccountAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new civilCaseAccountResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>