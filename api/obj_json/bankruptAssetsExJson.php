<?php
class civilCaseJson{
	
	private $objJson;
	private $objJsonPerson; 
	
	public function getJson(){
		
		$this->objJson = array(
              
			"code" => "",
			"service_name" => "",
			"service_info" => "",
			"request" => array(

			),
			"response" => array(
                
            )

        );
			
		return $this->objJson;
	
    }
    
	public function getJsonPerson(){

		$this->objJson = array(
              
			"code" => "",
			"service_name" => "",
			"service_info" => "",
			"request" => array(

			),
			"response" => array(
                
            )

        );
            
    }
    
}

?>