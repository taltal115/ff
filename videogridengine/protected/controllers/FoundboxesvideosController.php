<?php

class FoundboxesvideosController extends GxController
{
	public function actionIndex($id)
	{
            
            $foundBoxmodel=  Foundbox::model()->findByPk($id);
           $fbUserID=$foundBoxmodel->wp_users_ID;
           
            $fbTitle=  ucwords(strtolower($foundBoxmodel->title));
            $is_owner=0;
 
            if(intval($fbUserID)==intval(YII::app()->user->id))
            {
                $is_owner=$id;
            }
            
            $dataProvider = new CActiveDataProvider('Foundboxvideos', array(
                        'criteria' => array('condition' => 'wp_foundbox_id=' . $id),
                        'pagination' => array('pageSize' => 500)
                        )); // privacy is public
            
            $fboxModel = Foundbox::model()->findByPk($id);
            $this->render('index', array(
                'dataProvider' => $dataProvider, 'title' => $fbTitle,'is_owner' => $is_owner,'jsondata' => $fboxModel, 'fbUserID'=>$fbUserID
            ));
            
	}
    public function actionEditBoxForm() {
    }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}