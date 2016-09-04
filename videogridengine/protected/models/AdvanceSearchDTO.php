    <?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdvanceSearchDTO
 *
 * @author AHMEDALISHAIKH
 */
class AdvanceSearchDTO extends CModel{
    
    public $agencies = array();
    public $sortSearchBy=null;
    public $producerSearch = null;
    public $searchFromPublicFoundboxes = 0;
    public $format = array();
    public $resolution = array();
    public $methods = array();
    public $aspectRatio = array();
    public $codecs = array();
    public $sourceVideos = array();
    public $nonStandardResolution = array();
    public function getArray() {
            return get_object_vars($this);
            
        }
        public function attributeNames()
               {
                  return array( 'id', 'name', 'address' );
               }
}

?>
