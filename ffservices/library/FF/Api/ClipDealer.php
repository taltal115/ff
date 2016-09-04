<?php


 /**
  * Description of ClipDealer
  *
  * @author sajidhussain
  */
 class FF_Api_ClipDealer {

         //put your code here

         /**
          *
          * @return FF_Api_ClipDealer
          */
          
      public $searchType = "ClipDealer";
      public $totalPages;
    
         public static function instance()
         {
                 $classname = __CLASS__;
                 return new $classname(); 
         }
         
         public function getTotalPages()
         {
             return $this->totalPages;
         }
         
         private function generateTotalPages($totalRecords,FF_DTO_ParametersDTO $search) {
             
             $this->totalPages=ceil($totalRecords/$search->items_per_page);
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

         public function getSearchResults( FF_DTO_ParametersDTO $search )
         {
    
            $curl_postfields = array ( 'type_id' => 1 , 'q' => $search->searchText , 'number' => $search->items_per_page , 'page' => $search->current_page );
            $pid = '9254';
            $pwd = 'foovIdQuav';
            $url = "https://en.clipdealer.com/api/query";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(

                'Expect:',

                'Accept: text/json'

            ));
            curl_setopt($ch, CURLOPT_FAILONERROR, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $pid . ':' . $pwd);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_postfields);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1 );

            $result = curl_exec($ch);
            if ($result === false) {

                print curl_error($ch) . "\n";

            } else {
                
                $serviceResults = json_decode($result,true);  
                //$serviceResults = Zend_Json_Decoder::decode( $result );
                
                $resultSet = new FF_DTO_ResultSetDTO($search,$this->searchType);
                if(count($serviceResults) > 0){
                    $resultSet->totalResults = $serviceResults[ 'total' ];
                    //generate total no of pages
                    $resultSet->totalPages = $this->generateTotalPages($serviceResults[ 'total' ], $search);
                    
                     $videoId = 1;
                     foreach ( $serviceResults[ 'result' ] as $serviceResult )
                     {
                             if ( is_array( $serviceResult ) )
                             {

                                     $videoObject = new FF_DTO_VideoObjectDTO();
                                     $videoObject->videoId = $videoId++;
                                     $videoObject->videoServiceId = $serviceResult[ 'media_id' ];
                                     $videoObject->videoName = $serviceResult[ 'media_name' ];
                                     $videoObject->creator_name = $serviceResult[ 'media_creator' ];
                                     $videoObject->videoFlvURL = $serviceResult[ 'media_preview' ][ 'url' ];
                                     $videoObject->videoDollor = $serviceResult[ 'affiliate_url' ];
                                     $videoObject->thumbURL = $serviceResult[ 'media_thumbnail' ][ 'url' ];
                                     $videoObject->videoHeight = $serviceResult[ 'media_thumbnail' ][ 'height' ];
                                     $videoObject->videoWidth = $serviceResult[ 'media_thumbnail' ][ 'width' ];

                                     //Setting Objects in Array
                                     $resultSet->videoObjects[ ] = $videoObject;        
                             }
                     }
                     if($search->searchType!='All')
                     {
                        $jsonObjects = Zend_Json_Encoder::encode( $resultSet );
                        return $jsonObjects;
                     } 
                } else {
                    $resultSet = $this->getSearchEmpty($search);
                    //print $result . "\n";
                }
                return $resultSet;
             }

     }


 }


?>
