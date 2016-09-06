<?php

Yii::import('zii.widgets.CPortlet');

class SearchBar extends CPortlet
{
    public function init()
    {
        //$this->title=CHtml::encode(Yii::app()->user->name);
        parent::init();
    }

    protected function renderContent()
    {

      $model=new SearchBarForm;
        if(isset($_GET['SearchBarForm']))
        {
           // echo 'I got data from post';
            $model->attributes=$_GET['SearchBarForm'];
            if(!$model->validate())
                echo 'something is wrong' ;
        }
       // echo 'I am not in post';
        $this->render('searchBarView',array('model'=>$model));
       // $this->render('searchBarView');
    }
}