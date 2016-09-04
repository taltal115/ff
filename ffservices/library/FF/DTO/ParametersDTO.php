<?php

/**
 * Description of ParametersDTO
 *
 * @author sajidhussain
 */
class FF_DTO_ParametersDTO {
    
    public $isAdvanceSearch=false;
    public $sortOrder = null;
   
    public $searchText = null;
    public $searchType = null;
    public $serviceType = null;
    public $noOfColumns = null;
    public $searchLanguage = null;
    //Paginaton Parameters
    public $items_per_page = 50; //Number of items per page
    public $current_page = 1;
    public $offset = 1;
    public $load_first_page = false;
    
    public $agencies = array();
    public $sortSearchBy = null;
    public $producerSearch = null;
    public $hdSearch = 0;
     public $dateSortOrder = 0;
    //public $searchFromPublicFoundboxes = 0;
    public $creatorName = null;
    //public $title = null;
    //public $format = array();
    //public $resolution = array();
    //public $methods = array();s
    //public $aspectRatio = array();
    //public $codecs = array();
    //public $sourceVideos = array();
    //public $nonStandardResolution = array();

    //http://www.findingservices.com.local:90/public/index.php?sortOrder=10&searchText=sajid&current_page=2&dash=23



    public function setFieldsFromArray($parameters) {
        //Before going in loop remove unknown properties of array

        if (is_array($parameters)) {
            foreach ($parameters as $key => $value) {
                if (property_exists($this, $key)) {

                    $this->$key = $value;
                }
            }
        }
    }

}

?>
