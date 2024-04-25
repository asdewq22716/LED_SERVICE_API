<?php
class mediateCaseAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new mediateCaseResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>