<?php

/**
 * Description of DepositPhotos
 *
 * @author itsik profeta
 */

class FF_Api_Base {
    
    public $searchType = "";
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
}
?>