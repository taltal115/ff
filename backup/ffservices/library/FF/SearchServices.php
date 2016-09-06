<?php

 /**
  * Description of Services
  *
  * @author sajidhussain
  */
 class FF_SearchServices {

         /**
          * @FF_SearchServices
          * @return FF_SearchServices
          */
         public static function instance()
         {
                 $classname = __CLASS__;
                 return new $classname();

         }


         public function searchVideos( FF_DTO_ParametersDTO $searchObj)
         {
                 $searchObj->searchLanguage = 1;
                 // -- Test -- //
                 // -- http://www.findingfootage.com/ffservices/public/test.php -- //
                 //-- $searchObj->items_per_page = 1;
                 // -- Switch the Services Type and do like that -- //
				 switch ( $searchObj->searchType ) {
                    case "Empty":
                        $searchObj->searchType = "All";
                        FF_Api::instance()->searchEmptyServices( $searchObj ); break;
                    case "All":
                         FF_Api::instance()->searchAllServices( $searchObj ); break;
                    case "Fotolia":
                         FF_Api::instance()->searchFotolia( $searchObj ); break;
                    case "ClipCanvas":
                         FF_Api::instance()->searchClipCanvas( $searchObj ); break;
                    case "Pond5":
                         FF_Api::instance()->searchPond( $searchObj ); break; 
                    case "ClipDealer":
                         FF_Api::instance()->searchClipDealer( $searchObj ); break;
                    case "VideoHive": 
                         FF_Api::instance()->searchVideohive( $searchObj ); break;
                    case "RevoStock":
                         FF_Api::instance()->searchRevoStock( $searchObj ); break;
                    case "DepositPhotos":
                         FF_Api::instance()->searchDepositPhotos( $searchObj ); break;
                    case "Dreamstime":
                         FF_Api::instance()->searchDreamstime( $searchObj ); break;
                    default: break;
                 }

                 /*
                 //Collect search from everyservice add them as AssoviativeArray
                 //      FF_Api::instance()->searchFotolia($searchObj);
                 //        FF_Api::instance()->searchClipCanvas($paramters);
                 //ServicesApi_Api::makeApi()->searchFotolia($search);
                 */
         }
        
         
         public function advanceSearchVideos( FF_DTO_ParametersDTO $searchObj )
         {
               //this method would be called we dong this bcos we want to chk our code flow ok ? now see wht this code do  for ur self mai aata ho 5 min debug kero acutly u would know
                 
                 $searchObj->searchLanguage = 1;
                 //Switch the Services Type and do like that
                /**
                * 
                * @return FF_Api
                */
                 FF_Api::instance()->searchAllServices( $searchObj );
                 

              
         }

 }


?>
