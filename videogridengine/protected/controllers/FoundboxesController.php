<?php

class FoundboxesController extends Controller
{
	public function actionIndex()
	{
        $model = new Foundbox('search');
		$model->unsetAttributes();

		if (isset($_GET['Foundbox']))
			$model->setAttributes($_GET['Foundbox']);
            $this->render('index', array('model' => $model));
         
	}
    public function actionGetFBoxOptions(){
            if (Yii::app()->user->name == "admin") {
                $dataProvider=Foundbox::model()->findAll();
            }else{
                $dataProvider=Foundbox::model()->findAll('wp_users_ID=:id',array('id'=>Yii::app()->user->id));
            }
            echo CJSON::encode($dataProvider);
        }
    public function actionSearchSuggestions()
	{
            
            $res =array();

	        if (isset($_GET['term'])) {
            
                 $fbox=new Foundbox();
                 $fbox->privacy=1;
                 $fbox->title=$_GET['term'];
                 $dataProvider=$fbox->searchFoundBoxessuggestions();
                // print_r($dataProvider);
             
             
	        }

	        echo CJSON::encode($dataProvider);
	        Yii::app()->end();
               // exit;
		        //$this->render('search');
	}
        
    public function search() {
		$model = new Foundbox('search');
		$model->unsetAttributes();

		if (isset($_GET['Foundbox']))
			$model->setAttributes($_GET['Foundbox']);

		$this->render('admin', array(
			'model' => $model,
		));
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