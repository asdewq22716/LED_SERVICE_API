<?php
class mediateDocAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new mediateDocResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>