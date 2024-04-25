<?php
class debtRehabilitationCourtOrderAction {
	
	protected static $_response;
		
	public static function dataResPonse($request){
		 
		 $objResPonse = new debtRehabilitationCourtOrderResponse($request);
		 self::$_response = $objResPonse->getResponse();
		
		return self::$_response;
	}
	
}
?>