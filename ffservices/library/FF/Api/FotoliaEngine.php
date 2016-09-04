<?php

/**
 * Description of FotoliaEngine
 *
 * @author sajidhussain
 */
class FF_Api_FotoliaEngine {

    /**
     *
     * @return FF_Api_FotoliaEngine
     */
    
    public $searchType = "Fotolia"; 
    public $services;
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
        /** Todo Set Paging
         * We need to set paging for this , may we do this in JQ like last shwon results and total records etc
         */
         
         // -- http://www.fotolia.com/Services/API/Rest/Method/getSearchResults#a02 --//
        try {
            $dateSortOrder = "relevance";
            // if($searchObj->dateSortOrder==1)
            // {
            //     $dateSortOrder="creation";
            // }
            
            $resultSet = new FF_DTO_ResultSetDTO($searchObj,$this->searchType);
            
            $totalPages = 0;
            $totalResults = 0;
            
            /*  OLD CODE 
            $restClient = new Zend_XmlRpc_Client(FF_Config::FOTOLIA_API_KEY."@".FF_Config::FOTOLIA_URI);
            
            $search_params = array('words' => $searchObj->searchText,
               // 'language_id' => $searchObj->searchLanguage,//'order'=>$dateSortOrder,
                'offset' => $this->getOffsetFromPage($searchObj), 'limit' => $searchObj->items_per_page,
                'filters' => (array('content_type:video' => 1, 'license_V_HD720:on' => $searchObj->hdSearch, 'license_V_HD1080:on' => $searchObj->hdSearch))
            );

            $serviceResults = $restClient->call('getSearchResults', array(FF_Config::FOTOLIA_API_KEY, $search_params));
            */
            
            $search_params = array('search_parameters'=>array('words' => $searchObj->searchText,
               // 'language_id' => $searchObj->searchLanguage,//'order'=>$dateSortOrder,
                'offset' => $this->getOffsetFromPage($searchObj),
                'filters' => (array('content_type:video' => 1)), 
                'limit' => $searchObj->items_per_page
            ));

            $url = FF_Config::FOTOLIA_URI."/getSearchResults?".http_build_query($search_params, '', '&');
            
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL,$url); 
            curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
            if($args) 
            { 
                curl_setopt($ch, CURLOPT_POST, 1); 
                curl_setopt($ch, CURLOPT_POSTFIELDS,$args); 
            } 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            $result = curl_exec ($ch); 
            curl_close ($ch); 
            
            $serviceResults = json_decode($result,true);
            
//            if ($searchObj->isAdvanceSearch)
//                $serviceResults = $this->resultsFilter($searchObj, $serviceResults);       

            $totalPages = $this->generateTotalPages($serviceResults['nb_results'], $searchObj); 
            $totalResults = $serviceResults['nb_results'];
            
            $videoId = 1;
            $test = "";
            foreach ($serviceResults as $serviceResult) {
                
                if (is_array($serviceResult)) {
                    $videoObject = new FF_DTO_VideoObjectDTO();
                    $videoObject->videoId = $videoId++;
                    $videoObject->videoServiceId = $serviceResult['id'];
                    $videoObject->videoName = $serviceResult['title'];
                    $videoObject->creator_name = $serviceResult['creator_name'];
                    $videoObject->videoFlvURL = $serviceResult['video_url'];
                    $videoObject->videoDollor = $serviceResult['affiliation_link'];
                    $videoObject->thumbURL = $serviceResult['thumbnail_110_url'];
                    $videoObject->videoHeight = $serviceResult['thumbnail_110_height'];
                    $videoObject->videoWidth = $serviceResult['thumbnail_110_width'];
                    
                    $test = $serviceResult['video_data'];
                   
                    //Setting Objects in Array
                    $resultSet->videoObjects[] = $videoObject;
                }
            }
            
            $resultSet->totalPages = $totalPages;
            $resultSet->totalResults = $totalResults;
            
            //print_r($test);
            //var_dump($resultSet);
            if ($searchObj->searchType != 'All') {
                // echo "<pre>";
                //print_r($resultSet);
                $jsonObjects = Zend_Json_Encoder::encode($resultSet);
                return $jsonObjects;
            }
            return $resultSet;
        } catch (Zend_Exception $e) {
            echo $e->getMessage();
        }
    }
    
    //// FUNCTION FOR SORTING RESULLTANT ARRAY
     public function subval_sort($a,$subkey,$sort_type) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
        if($sort_type=='DESC')
        {
	arsort($b);
     }
     else
     {
         asort($b);
     }
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}


    public function resultsFilter(FF_DTO_ParametersDTO $searchObj, $resultsArray) {
        //where is code 
        //you need to implment this methd  you have search queries and you have  results
        // results mai se tum search kero ge search within search 
        // search following 
        //$resultsArrayFilterd=array();
        //for each loop on $resultsArray{
        //==
        //if($result['creator_name'] like $searchObj->creatorName or $result['title'] like $searchObj->title )
        //$resultsArrayFilterd[]=$result;
        //}
       // $counter=0;
     //  var_dump($resultsArray);
        $resultArrayFilterd = array();
        //     print_r($searchObj);
        $count=0;
        foreach ($resultsArray as $key=>$result) {
            
            //we need to get keys too  like this nb_results for  ka look laka do with count on resultsarray ok
            if (is_array($result)) {
                if ( (strpos($result['creator_name'],$searchObj->creatorName))!==false or (strpos($result['title'], $searchObj->title)) !== false) {
                    
                    $resultArrayFilterd[$key] = $result;
                    $count++;
                    
                }
         
            }
     else
       { 
         $resultArrayFilterd[$key] = $result;
             
 }
        }
        //return $resultArrayFilterd;
        
       // var_dump($resultArrayFilterd);
//var_dump($resultArrayFilterd);
//return $resultArrayFilterd;

        
        
        
       
//aasort($$resultsArray,"title");


        
        
        
        
        
        
        
        
        
        //var_dump($this->aasort($resultsArray,"title"));
       //PASS THREE PAREMETER 1ST FOR ARRAY 2ND FOR FIELD/ATTRIBUTE 
       //AND 3RD ONE FOR TYPE OF ORDER ACCENDING/DECENDING
        $sort_result = $this->subval_sort($resultsArray,'country_name',''); 
        //var_dump($resultsArray);
        var_dump($sort_result);
        exit;
    }

    public function getVideoDetail($videserviceid) {
//call the api and get its details and return as jsob object
        $restClient = new Zend_XmlRpc_Client(FF_Config::FOTOLIA_URI);
//echo 'calling function';
//
        $search_params = array('media_id' => $videserviceid,
            'filters' => (array('content_type:video' => 1))
        );
        $serviceResults = $restClient->call('xmlrpc.getSearchResults', array(FF_Config::FOTOLIA_API_KEY, $search_params));
        echo "<pre>";
        print_r($serviceResults);
    }

}

?>
