<?php

/**
 * Description of ParametersDTO
 *
 * @author sajidhussain
 */
class ParametersDTO extends CModel{


        public $id=0;   
        public $name='';
        public $sortOrder = 0;
         public $hdSearch = 0;
       public $dateSortOrder = 0;
        public $searchText = null;
        public $searchType = null;
        public $serviceType = null;
        public $noOfColumns = null;
        //public $searchLanguage = null;
        //Paginaton Parameters
        public $items_per_page = 25; //Number of items per page
        public $num_display_entries = 11; //Number of pagination links shown
        public $current_page = 1;
        public $offset = 1;
        //public $load_first_page = false;
        //public $XDEBUG_SESSION_START = 'netbeans-xdebug';

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
        public function getArray() {
            return get_object_vars($this);
            
        }
        public function attributeNames()
               {
                  return array( 'id', 'name', 'address' );
               }

}

?>
