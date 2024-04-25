<?php
class civilCaseDetailAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new civilCaseDetailResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>