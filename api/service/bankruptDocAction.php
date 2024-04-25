<?php
class bankruptDocAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new bankruptDocResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>