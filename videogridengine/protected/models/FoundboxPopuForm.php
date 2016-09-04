<?php

/**
 * FoundboxPopuForm class.
 * FoundboxPopuForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class FoundboxPopuForm extends CFormModel
{
	public $selectedFBox="no";
	public $isNewFBox;
        public $foundBoxVideos;
        public  $title="Title";
         public  $description="Description";
         public  $privacy;
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
     
                return array(
			// name, email, subject and body are required
			//array('searchKeywords, sorting ','required'),
                        array('selectedFBox,foundBoxVideos,privacy','required'),
                      array('title,description,privacy','required'), //if we wnt set validator so it wont take the data
                       array('isNewFBox', 'boolean'),
                       // array('isNewFBox','boolean'),
                        array('isNewFBox,foundBoxVideos', 'safe'),
                    

			
		);
                
      
	}
        
        public function submitFFForm()
        {
            if(!$this->isNewFBox)
            {
                echo $this->selectedFBox;
                exit();
            }
        }
        

	
}