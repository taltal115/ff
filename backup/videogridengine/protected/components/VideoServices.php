<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VideoServices
 *
 * @author sajid
 */
class VideoServices extends CApplicationComponent{
    //put your code here
   
    public $jsonResults;
    public function searchVideos(ParametersDTO $searchRequest) {
        
        
     
//       var_dump( $searchRequest->getArray());
  ;
        $resultJsonString = Yii::app()->CURL->run(Yii::app()->params['apiservicesurl'],false,$searchRequest->getArray());
           
         //print_r($resultJsonString);
//         var_dump($resultJsonString);
//        exit;
        $this->jsonResults=  CJSON::decode($resultJsonString);
      
        return $this->jsonResults;
    // renderview(viewname,data);
        //print_r($jsonResults);            
    }
    
    public function getResults()
    {
     return $this->jsonResults;   
    }
    
}

?>
