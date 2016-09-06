<?php

class AdSearchController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
//
//            $ajaxContext = $this->_helper->getHelper('AjaxContext');
//	    $ajaxContext->addActionContext('index', 'html')
//	                ->initContext();
    }

    public function test1Action() {
        
    }

    public function indexAction() {

        //            exit;
        //Fetch Parameters

        //Writing up Advacne search Methods 
        
        $searchObj = new FF_DTO_ParametersDTO();
        $searchObj->searchText = "woman";
        $searchObj->searchType = "RevoStock";
        $searchObj->items_per_page = 50;
        $searchObj->setFieldsFromArray($this->getRequest()->getParams());
//        $searchObj->agencies = null;
//        $searchObj->sortSearchBy = null;
//        $searchObj->producerSearch = null;
//        $searchObj->searchFromPublicFoundboxes = 0;
//        $searchObj->format = null;
//        $searchObj->resolution = null;
//        $searchObj->methods = null;
//        $searchObj->aspectRatio = null;
//        $searchObj->codecs = null;
//        $searchObj->sourceVideos = null;
//        $searchObj->nonStandardResolution = null;

        
        FF_SearchServices::instance()->advanceSearchVideos($searchObj); //On fly 
        //Factory Pattern

    }


}

