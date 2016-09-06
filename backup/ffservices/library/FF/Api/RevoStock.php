<?php


/**
* Description of RevoStock
*
* @author sajidhussain
*/
class FF_Api_RevoStock {

     //put your code here

     /**
      *
      * @return FF_Api_RevoStock
      */
      
     public $searchType = "RevoStock";
     
     public static function instance()
     {
         $classname = __CLASS__;
         return new $classname();

     }

     public function getSearchEmpty(FF_DTO_ParametersDTO $searchObj) {
        $dateSortOrder = "relevance";
        $resultSet = new FF_DTO_ResultSetDTO($searchObj,$this->searchType);
        
        if ($searchObj->searchType != 'All') {
            $jsonObjects = Zend_Json_Encoder::encode($resultSet);
            return $jsonObjects;
        }
        return $resultSet;
    }

     public function getSearchResults( FF_DTO_ParametersDTO $searchObj )
     {
         return $this->getSearchEmpty($searchObj);
        
         /* 
        // $revoURL='http://'.FF_Config::REVOSTOCK_USER.':'.FF_Config::REVOSTOCK_PASSWORD.'@'.FF_Config::REVOSTOCK_URI;
        Zend_Service_Abstract::getHttpClient()->setAuth(FF_Config::REVOSTOCK_USER, FF_Config::REVOSTOCK_PASSWORD);     
        
        $process = curl_init(FF_Config::REVOSTOCK_URI.'/new');                                                                         
        curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));              
        curl_setopt($process, CURLOPT_HEADER, 1);                                                                           
        curl_setopt($process, CURLOPT_USERPWD, FF_Config::REVOSTOCK_USER . ":" . FF_Config::REVOSTOCK_PASSWORD);                                                
        curl_setopt($process, CURLOPT_TIMEOUT, 30);                                                                         
        //curl_setopt($process, CURLOPT_GET, 1);                                                                             
        //curl_setopt($process, CURLOPT_POSTFIELDS, $payloadName);                                                            
        // curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);                                                                
        $return = curl_exec($process);
        var_dump($return);
        exit;
       
        $resultSet = new FF_DTO_ResultSetDTO($searchObj,$this->searchType);  
        
        $resultSet->totalResults = $serviceResults[ 'nb_results' ];
        $count = 1;
        foreach ( $serviceResults as $serviceResult )
        {
            if ( is_array( $serviceResult ) )
            {
                $videoObject = new FF_DTO_VideoObjectDTO();
                $videoObject->videoId = $count ++;
                $videoObject->videoServiceId = $serviceResult[ 'id' ];
                $videoObject->videoName = $serviceResult[ 'title' ];
                $videoObject->creator_name = $serviceResult[ 'creator_name' ];
                $videoObject->videoFlvURL = $serviceResult[ 'flv_url' ];
                $videoObject->videoDollor = $serviceResult[ 'affiliation_link' ];
                $videoObject->thumbURL = $serviceResult[ 'thumbnail_110_url' ];
                $videoObject->videoHeight = $serviceResult[ 'thumbnail_110_height' ];
                $videoObject->videoWidth = $serviceResult[ 'thumbnail_110_width' ];

                //Setting Objects in Array
                $resultSet->videoObjects[ ] = $videoObject;
            }
        }
        */
     }
}


?>
