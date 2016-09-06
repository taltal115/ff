<?php

class FF_DTO_GenericParametersDTO {

    private $resultsPerPage = null;
    private $pageNo = null;
    private $sortOrder = null;
    private $noOfColumns = null;
    private $searchText = null;

    public function getResultsPerPage() {
        return $this->resultsPerPage;
    }

    public function setResultsPerPage($resultsPerPage) {
        $this->resultsPerPage = $resultsPerPage;
    }

    public function getPageNo() {
        return $this->pageNo;
    }

    public function setPageNo($pageNo) {
        $this->pageNo = $pageNo;
    }

    public function getSortOrder() {
        return $this->sortOrder;
    }

    public function setSortOrder($sortOrder) {
        $this->sortOrder = $sortOrder;
    }

    public function getNoOfColumns() {
        return $this->noOfColumns;
    }

    public function setNoOfColumns($noOfColumns) {
        $this->noOfColumns = $noOfColumns;
    }

    public function getSearchText() {
        return $this->searchText;
    }

    public function setSearchText($searchText) {
        $this->searchText = $searchText;
    }

}

?>
