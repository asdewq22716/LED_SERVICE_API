<?php
class manualAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new manualResponse();
		 self::$_response = $objResPonse->getResponse($request);
		
		return  self::$_response;
	}
	
}
?>