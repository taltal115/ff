<?php

Yii::import('application.modules.users.models._base.BaseFoundbox');

class Foundbox extends BaseFoundbox {

    public static function model($className=__CLASS__) {
        return parent::model($className);
        }

      
        protected function beforeSave() {
            
            
                
     // echo "I am in ";
        if (parent::beforeSave()) {
            
//            if(!Yii::app()->user->name=="admin")
//                $this->Users=Users::model()->findByPk(3);//2;//Yii::app()->user->id;
                
            if ($this->isNewRecord) {
                $this->date_created = $this->date_modified = new CDbExpression('NOW()');
                return true;//var_dump($this);
            } else {
                $this->date_modified = new CDbExpression('NOW()');
                // echo "I am in else as updated ";
                return true;
                
            }
        } else {
              //echo "I am in else as doing nothing ";
            return false;
        }
        
        
    }
    
    function privacyParser($data) {
 if (GxHtml::encode($data->privacy) == 1)
 return "Public";
 else {
 return "Private";
 }
 }

}