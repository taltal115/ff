<?php

/**
 * Description of DepositPhotos
 *
 * @author itsik profeta
 */

class FF_Api_DepositPhotos {
    
    /**
     *
     * @return FF_Api_DepositPhotos
     */
     
    public $searchType = "DepositPhotos";
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
        /*
        http://api.depositphotos.com?
            dp_command=search&            
            dp_apikey=2442125a8cfaeedb3b27bc8c7ef0d8fe28e6a0c8&
            dp_search_query=woman+hands&
            dp_search_sort=4&                
            dp_search_limit=20&
            dp_search_offset=100&            
            dp_search_categories=30+36&
            dp_search_color=12&
            dp_search_nudity=true&
            dp_search_extended=true&
            dp_search_exclusive=true&
            dp_search_user=1000942&
            dp_search_date1=2010-01-01&
            dp_search_date2=2010-05-01&
            dp_search_orientation=all&    
            dp_search_imagesize=m&            
            dp_search_photo=true&
            dp_search_vector=true
        */
        
        $search_params = array(
            'dp_command' => "search",
            'dp_apikey' => FF_Config::DEPOSIT_PHOTOS_API_KEY,
            'dp_search_query' => $searchObj->searchText,
            'dp_search_limit' => $searchObj->items_per_page,
            'dp_search_offset' => $this->getOffsetFromPage($searchObj),
            'dp_search_photo' => 'false',
            'dp_search_vector' => 'false',
            'dp_search_video' => 'true',
            'dp_search_nudity' => 'true',
            'dp_search_extended' =>'true',
            'dp_search_exclusive' => 'true',  
        );
        
        /*
        $client = new Zend_Rest_Client(FF_Config::DEPOSIT_PHOTOS_URI);  
        $result = $client->restGet( '' , $search_params );
        */
        
        $http = new Zend_Http_Client(FF_Config::DEPOSIT_PHOTOS_URI);
        //$http->setEncType('application/json');
        $http->setParameterPost($search_params);
        $body = $http->request(Zend_Http_Client::POST)->getBody();
        $result = json_decode($body, true);
        $serviceResults = $result['result'];
        
        //-- return $body;
        
        if(!isset ($serviceResults))
            return;
        
        $resultSet = new FF_DTO_ResultSetDTO($searchObj,$this->searchType);
        $resultSet->totalResults = count($serviceResults);
        $resultSet->totalPages = $this->generateTotalPages(count($serviceResults), $searchObj);
        
        $videoId = 1;
        foreach ($serviceResults as $serviceResult) {

            $videoObject = new FF_DTO_VideoObjectDTO();
            $videoObject->videoId = $videoId++;
            $videoObject->videoServiceId = $serviceResult['id'];
            $videoObject->videoName = $serviceResult['title'];
            $videoObject->creator_name = $serviceResult['username'];
            $videoObject->videoFlvURL = $serviceResult['mp4'];
            $videoObject->videoDollor = $serviceResult['itemurl'];
            $videoObject->thumbURL = $serviceResult['thumbnail'];
            $videoObject->videoHeight = $serviceResult[ 'width' ];
            $videoObject->videoWidth = $serviceResult[ 'height' ];
            //Setting Objects in Array
            $resultSet->videoObjects[] = $videoObject;
        }


        if ($searchObj->searchType != 'All') {
            $jsonObjects = Zend_Json_Encoder::encode($resultSet);

            return $jsonObjects;
        }
        return $resultSet;
    }

}

?>
