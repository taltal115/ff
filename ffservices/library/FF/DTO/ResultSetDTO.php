<?php


     /*
      * To change this template, choose Tools | Templates
      * and open the template in the editor.
      */

     /**
      * Description of ResultSetDTO
      *
      * @author sajidhussain
      */
     class FF_DTO_ResultSetDTO {
        //-itsik
        function __construct(FF_DTO_ParametersDTO $searchObj = null, $serviceName = "") {
            if(isset($searchObj)) {
                $this->serviceType = $serviceName;
                $this->searchText = $searchObj->searchText;
                $this->current_page = $searchObj->current_page;
                $this->items_per_page = $searchObj->items_per_page;
                
                $this->totalPages = 0;
                $this->totalResults = 0;
            }       
        }
        
             //put your code here
             //Public Variables
            // public $sortOrder = null;
             public $searchText = null;
             public $searchType = null;
             public $serviceType = null;
             public $noOfColumns = null;
            // public $searchLanguage = null;
             public $totalPages = null;
             //Paginaton Parameters
             public $items_per_page = 10; //Number of items per page
             public $num_display_entries = 11; //Number of pagination links shown
             public $totalResults = null; //Number of pagination links shown
             public $current_page = 0;
             public $offset = 0;
             public $load_first_page = false;
             public $videoObjects = array ( ); //Services Pannels and Video Objects


     }


?>
