<?php

Yii::import('zii.widgets.CPortlet');

class PaginationBar extends CPortlet
{
    public function init()
    {
        //$this->title=CHtml::encode(Yii::app()->user->name);
        parent::init();
    }
    
        

    protected function renderContent()
    {
        $controllerID=$this->getController()->getUniqueId();
           if($controllerID=="search")
            $this->render('PaginationBarView');
           else
               $this->render('PaginationBarViewblank');
               
    }
}
?>
