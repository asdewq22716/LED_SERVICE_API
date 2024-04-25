<?php

class manualResponse {
	
	public function getResponse($request){
		
		$constr = $request['manualApiName'].'Json';
		$object = new $constr();
		
		
		return  $object->getJson();
		
		
		
	}

}
?>