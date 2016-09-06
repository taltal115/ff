<?php

/**
 * Description of FFApi
 *
 * @author sajidhussain
 */
class FF_Api
{

    /**
     *
     * @return FF_Api
     */
    public static function instance ()
    {
        $classname = __CLASS__;
        return new $classname();
    }
    
    public function searchEmptyServices ( FF_DTO_ParametersDTO $searchObj )
    {        
        $this->searchAllServices( $searchObj, true );
    }
    public function searchAllServices ( FF_DTO_ParametersDTO $searchObj, $Empty = false )
    {
        // here we would combine all results of each service
        // But before that we need to make each service method which must work with Parameters

        try {
            
            $apiItems = array( 
                new FF_Api_Dreamstime(),
                new FF_Api_DepositPhotos(),
                new FF_Api_FotoliaEngine(),
                new FF_Api_PondEngine(),
                new FF_Api_ClipDealer(),
                new FF_Api_VideoHive()
                //new FF_Api_RevoStock()
            );
            $apiResults = array( );
            $totalPages = 0;
            $resultsObjects = array( );

            foreach($apiItems as $apiItem) {
                if(isset($apiItem)) {
                    if($Empty)
                        $apiResult = $apiItem->getSearchEmpty( $searchObj );
                    else
                        $apiResult = $apiItem->getSearchResults( $searchObj );
                    
                    if (isset( $apiResult ))
                    {
                        $apiResults[ ] = $apiResult->totalPages;
                        $resultsObjects[ ] = $apiResult;
                        unset( $apiResult );
                    } 
                }
            }
             
            // -- Total -- //
            $totalPages = max( $apiResults );
            if ( count( $resultsObjects ) != 0 )
            {
                $resultSet = new FF_DTO_ResultSetDTO();
                $resultSet->current_page = $searchObj->current_page;
                $resultSet->items_per_page = $searchObj->items_per_page;
                $resultSet->searchType = "All";
                $resultSet->searchText = $searchObj->searchText;
                $resultSet->totalPages = $totalPages;
                $resultSet->videoObjects = $resultsObjects;
                
                $jsonObjects = Zend_Json_Encoder::encode( $resultSet );
                
                // -- Print jsonObjects -- //
                echo $jsonObjects;
            }
            else
            {
                echo $jsonObjects = "";
            }
             
        }
            
        catch ( Exception $e )
            {
            echo 'Message: ' . $e->getTraceAsString();
            exit;
            }
    }

    public function searchAllAdvanceServices( FF_DTO_ParametersDTO $searchObj )
    {
        // this is advacne searches
        try
            {


            $apiResults = array( );
            $totalPages = 0;
            $resultsObjects = array( );

            //check if it has fotolia in searching 

            if ( $this->isSearchEngineExists( "fotolia",$searchObj->agencies ) )
            {
                $ffApi = new FF_Api_FotoliaEngine();
                $ffApiResults = $ffApi->getSearchResults( $searchObj );

                if ( isset( $ffApiResultgus ) )
                {
                    $apiResults[ ] = $ffApiResults->totalPages;
                    //$totalPages= max($apiResults)+1;
                    //$totalPages+=$ffApiResults->totalPages;
                    //Before putting object into Array check does its videoobject array count is above 0
                    if ( count( $ffApiResults->videoObjects ) > 0 ) $resultsObjects[ ] = $ffApiResults;

                    unset( $ffApiResults );
                }
            }

            if ( $this->isSearchEngineExists( "clipdealer",$searchObj->agencies ) )
            {
                $fClip = new FF_Api_ClipDealer();
                $fClipResults = $fClip->getSearchResults( $searchObj );

                if ( isset( $fClipResults ) )
                {
                    // $totalPages+=$fClipResults->totalPages;
                    $apiResults[ ] = $fClipResults->totalPages;
                    if ( count( $fClipResults->videoObjects ) > 0 ) $resultsObjects[ ] = $fClipResults;
                    unset( $fClipResults );
                }
            }
            
            if ( $this->isSearchEngineExists( "videohive",$searchObj->agencies ) )
            {
                $fVhive = new FF_Api_VideoHive();
                $fVhiveResults = $fVhive->getSearchResults( $searchObj );
                if ( isset( $fVhiveResults ) )
                {
                    $totalPages+=$fVhiveResults->totalPages;
                    if ( count( $fVhiveResults->videoObjects ) > 0 ) $resultsObjects[ ] = $fVhiveResults;
                    unset( $fVhiveResults );
                }
            }

            if ( $this->isSearchEngineExists( "pon5",$searchObj->agencies ) )
            {
                $fPond = new FF_Api_PondEngine();
                $fPondResults = $fPond->getSearchResults( $searchObj );
                if ( isset( $fPondResults ) )
                {
                    $totalPages+=$fPondResults->totalPages;
                    if ( count( $fPondResults->videoObjects ) > 0 ) $resultsObjects[ ] = $fPondResults;
                    unset( $fPondResults );
                }
            }
            // $resultsObjects[ ] = FF_Api_VideoHive::instance()->getSearchResult($searchObj);
            $totalPages = max( $apiResults );
            if ( count( $resultsObjects ) != 0 )
            {

                $resultSet = new FF_DTO_ResultSetDTO();
                $resultSet->current_page = $searchObj->current_page;
                $resultSet->items_per_page = $searchObj->items_per_page;
                $resultSet->searchType = "All";
                $resultSet->searchText = $searchObj->searchText;
                $resultSet->totalPages = $totalPages;


                $resultSet->videoObjects = $resultsObjects;

                $jsonObjects = Zend_Json_Encoder::encode( $resultSet );

                echo $jsonObjects;
            }
            else
            {
                echo $jsonObjects = "";
            }
        }
        catch ( Exception $e ) {
            echo 'Message: ' . $e->getTraceAsString();
            exit;
        }
    }

    public function searchFotolia ( FF_DTO_ParametersDTO $searchObj )
    {
        echo FF_Api_FotoliaEngine::instance()->getSearchResults( $searchObj );
    }

    public function searchClipDealer ( FF_DTO_ParametersDTO $searchObj )
    {
        echo FF_Api_ClipDealer::instance()->getSearchResults( $searchObj );
    }

    public function searchClipCanvas ( FF_DTO_ParametersDTO $searchObj )
    {
        echo FF_Api_ClipCanvas::instance()->getSearchResults( $searchObj );
    }

    public function searchPond ( FF_DTO_ParametersDTO $searchObj )
    {
        echo FF_Api_PondEngine::instance()->getSearchResults( $searchObj );
    }

    public function searchVideohive ( FF_DTO_ParametersDTO $searchObj )
    {

        echo FF_Api_VideoHive::instance()->getSearchResults( $searchObj );
    }

    public function searchRevoStock ( FF_DTO_ParametersDTO $searchObj )
    {
        echo FF_Api_RevoStock::instance()->getSearchResults( $searchObj );
    }
    
    public function searchDepositPhotos ( FF_DTO_ParametersDTO $searchObj )
    {
        echo FF_Api_DepositPhotos::instance()->getSearchResults( $searchObj );
    }
    
    public function searchDreamstime ( FF_DTO_ParametersDTO $searchObj )
    {
        echo FF_Api_Dreamstime::instance()->getSearchResults( $searchObj );
    }

    //public function searchOther()
    
    
    public function getVideoDetails ( $serviceName,$videserviceid )
    {
        //get video detaisl of the service with its service id
        FF_Api_FotoliaEngine::instance()->getVideoDetail( $videserviceid );
        
    }
    
    public function isSearchEngineExists ( $value,$options )
    {
        return in_array( $value,$options ) ? true : false;
    }
    
    public function resultsFilter ( FF_DTO_ParametersDTO $searchObj , $resultsArray )
    {
        //you need to implment this methd  you have search queries and you have  results
        // results mai se tum search kero ge search within search 
        var_dump($resultsArray);
    }
}

?>
