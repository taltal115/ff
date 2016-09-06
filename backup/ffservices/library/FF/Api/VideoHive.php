<?php

/**
 * Description of VideoHive
 *
 * @author sajidhussain
 */
require_once "envato/Envato_marketplaces.php";

class FF_Api_VideoHive {
    //put your code here

    /**
     *
     * @return FF_Api_VideoHive
     */
     
    public $searchType = "VideoHive";
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
        $videoHive = new Envato_marketplaces(FF_Config::VIDEO_HIVE_API_KEY,FF_Config::VIDEO_HIVE_URI);
        $serviceResults = $videoHive->search($searchObj->searchText, 'videohive','',$searchObj->items_per_page);
        
        if(!isset ($serviceResults))
            return $this->getSearchEmpty($searchObj);  

        //  $videoHive->item_details()
        //                    var_dump($resultsVH);
        //                    exit;
        
        $resultSet = new FF_DTO_ResultSetDTO($searchObj,$this->searchType);
       
        $resultSet->totalPages=$this->generateTotalPages(count($serviceResults), $searchObj);
        $videoId = 1;
        
        foreach ($serviceResults as $serviceResult) {
            $videoItem = $videoHive->item_details($serviceResult->id);
            //$videoItem = get_object_vars($videoItem);
            // echo "<pre>";
            
            $videoObject = new FF_DTO_VideoObjectDTO();
            $videoObject->videoId = $videoId++;
            $videoObject->videoServiceId = $videoItem->id;//$videoItem['id'];
            $videoObject->videoName = $videoItem->item;//$videoItem['item'];
            $videoObject->creator_name = $videoItem->user;//$videoItem['user'];
            $videoObject->videoFlvURL = $videoItem->live_preview_video_url;//$videoItem['live_preview_video_url'];
            $videoObject->videoDollor = $videoItem->url;//$videoItem['url'];
            $videoObject->thumbURL = $videoItem->thumbnail;//$videoItem['thumbnail'];
            //$videoObject->videoHeight = $serviceResult[ 'thumbnail_110_height' ];
            //$videoObject->videoWidth = $serviceResult[ 'thumbnail_110_width' ];
            //Setting Objects in Array
           
            $resultSet->videoObjects[] = $videoObject;
        }

        
        //var_dump($resultSet);
        if ($searchObj->searchType != 'All') {
            $jsonObjects = Zend_Json_Encoder::encode($resultSet);

            return $jsonObjects;
        }
        return $resultSet;
    }

}

?>
