<?php

/**
 * SearchBarForm class.
 * SearchBarForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class SearchBarForm extends CFormModel {

    public $agencies;
    public $sortSearchBy;
    public $producerSearch;
    public $searchFromPublicFoundboxes;
    public $formats;
    public $resolution;
    public $methods;
    public $aspectRatio;
    public $codecs;
    public $sourceVideos;
    public $nonStandardResolution;
    
    public $searchKeywords;
    //public $currentpage=1;
    //public $direction='h';
//	public $subject;
//	public $body;
//	public $verifyCode;
 

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // name, email, subject and body are required
            //array('searchKeywords, sorting ','required'),
            array('searchKeywords', 'required'),
        );
    }

}