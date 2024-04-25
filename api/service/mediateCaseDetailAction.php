<?php
class mediateCaseDetailAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new mediateCaseDetailResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>