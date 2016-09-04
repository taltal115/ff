<?php

/**
 * Description of DepositPhotos
 *
 * @author itsik profeta
 */

class FF_Api_Dreamstime {
    
    /**
     *
     * @return FF_Api_DepositPhotos
     */
     
    public $searchType = "Dreamstime";
    public $totalPages;
    
    public static function instance() {
        $classname = __CLASS__;
        return new $classname();
    }
    
    public function getTotalPages() {
        return $this->totalPages;
    }

    private function generateTotalPages($totalRecords, FF_DTO_ParametersDTO $search) {

        $this->totalPages = ceil($totalRecords / $search->items_per_page);
        return $this->totalPages;
    }
    
    public function getOffsetFromPage(FF_DTO_ParametersDTO $searchObj) {
        if ($searchObj->current_page == "1")
            return $offset = 0;
        $offset = ($searchObj->items_per_page * $searchObj->current_page) - $searchObj->items_per_page + 1;
        return $offset;
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
    public function getSearchResults(FF_DTO_ParametersDTO $searchObj) {
        //return $this->getSearchEmpty($searchObj);
        
        $search_params = array(
            'username' => FF_Config::DREAMSTIME_USER,
            'password' => FF_Config::DREAMSTIME_PASSWORD,
            'type' => 'get',
            'request' => 'search',
            'srh_field' => $searchObj->searchText,
            'video' => 'only',
            'pg' => $searchObj->current_page,
            'ipp' => $searchObj->items_per_page 
        );
    
        $http = new Zend_Http_Client(FF_Config::DREAMSTIME_URI);
        $http->setParameterGet($search_params);
        $body = $http->request(Zend_Http_Client::POST)->getBody();
        $xmlReader = new Zend_Config_Xml($body);
        $serviceResults = $xmlReader->items->item;
        //-- $xml = $xmlReader->toArray();
        //-- return $body;
        
        if(!isset ($serviceResults))
            return $this->getSearchEmpty($searchObj);
        
        $resultSet = new FF_DTO_ResultSetDTO($searchObj,$this->searchType);
        $resultSet->totalResults = count($serviceResults);
        $resultSet->totalPages = $this->generateTotalPages(count($serviceResults), $searchObj);
        
        $videoId = 1;
        
        foreach ($serviceResults as $key=>$serviceResult) {
            if($videoId > $searchObj->items_per_page) break;
            
            if(isset($serviceResult->title)){ 
                $videoObject = new FF_DTO_VideoObjectDTO();
                $videoObject->videoId = $videoId++;
                $videoObject->videoServiceId = $serviceResult->imageID;
                $videoObject->videoName = $serviceResult->title;
                $videoObject->creator_name = ""; // $serviceResult->?;
                $flvUrl = $serviceResult->videoMediumThumb;
                $mp4Url = str_replace(".flv",".mp4",$flvUrl);
                $videoObject->videoFlvURL = $mp4Url;
                $videoObject->videoDollor = $serviceResult->imageURL;
                $videoObject->thumbURL = $serviceResult->mediumThumb;
                // $videoObject->videoHeight = $serviceResult->?;
                // $videoObject->videoWidth = $serviceResult->?;
                
                //Setting Objects in Array
                $resultSet->videoObjects[] = $videoObject;
            }else{
                if(!isset($videoObject)){
                    $videoObject = new FF_DTO_VideoObjectDTO();
                    $videoObject->videoId = $videoId;
                }
                switch($key){
                    case "imageID": $videoObject->videoServiceId = $serviceResult; break;
                    case "title": $videoObject->videoName = $serviceResult; break;
                    case "videoMediumThumb": $videoObject->videoFlvURL = $serviceResult; break;
                    case "imageURL": $videoObject->videoDollor = $serviceResult; break;
                    case "mediumThumb": $videoObject->thumbURL = $serviceResult; break;  
                }  
            }
        }
        if($videoId == 1 && isset($videoObject))
            $resultSet->videoObjects[] = $videoObject;

        if ($searchObj->searchType != 'All') {
            $jsonObjects = Zend_Json_Encoder::encode($resultSet);

            return $jsonObjects;
        }
        return $resultSet;
    }

}

?>
