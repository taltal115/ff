<?php


     class IndexController extends Zend_Controller_Action {


             public function init()
             {
                     /* Initialize action controller here */
                     $this->_helper->viewRenderer->setNoRender();
                     $this->_helper->getHelper( 'layout' )->disableLayout();
//
//            $ajaxContext = $this->_helper->getHelper('AjaxContext');
//	    $ajaxContext->addActionContext('index', 'html')
//	                ->initContext();

             }

             public function StartSearch()
             {
                $searchObj = new FF_DTO_ParametersDTO();
                $searchObj->searchText = "vision";
                $searchObj->searchType = "All";
                $searchObj->items_per_page = 50;
                // $searchObj->isAdvanceSearch=true;
                //// $searchObj->title="door opening";

                // $searchObj->hdSearch=1; //full hd
                //  $searchObj->agencies=array('fotolia','pond5');
                //this method fill the fields which has been sent from requet like query string or post 
                //but right now we are not passing anything as we testing 
                // clear ? yes
                $searchObj->setFieldsFromArray( $this->getRequest()->getParams() );

                //dummy record testing 
                /// $searchObj->isAdvanceSearch=true;

                if($searchObj->isAdvanceSearch)
                {
                    //this would call our adva`nce search method ok ? ok
                    FF_SearchServices::instance()->advanceSearchVideos( $searchObj ); //On fly 

                }
                else
                {
                    FF_SearchServices::instance()->searchVideos( $searchObj ); //On fly 

                }
             }
             
             public function test1Action()
             {

             }


             public function indexAction()
             {

                $this->StartSearch();     
                     
             }


// indxexPondg()
// {}

     }

     