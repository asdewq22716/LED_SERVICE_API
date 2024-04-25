<?php
class civilCasePersonAction{
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new civilCasePersonResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>