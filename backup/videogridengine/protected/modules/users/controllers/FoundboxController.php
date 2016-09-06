<?php

class FoundboxController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			
			array('allow', 
				'actions'=>array('admin','delete','minicreate', 'create','update','index','view'),
				'users'=>array('@'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Foundbox'),
		));
	}

	public function actionCreate() {
		$model = new Foundbox;

		$this->performAjaxValidation($model, 'foundbox-form');

		if (isset($_POST['Foundbox'])) {
			$model->setAttributes($_POST['Foundbox']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Foundbox');

		$this->performAjaxValidation($model, 'foundbox-form');

		if (isset($_POST['Foundbox'])) {
			$model->setAttributes($_POST['Foundbox']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Foundbox')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
            
            if(Yii::app()->user->name == "admin"){
		$dataProvider = new CActiveDataProvider('Foundbox');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
            }else
            {
              $dataProvider = new CActiveDataProvider('Foundbox', array(
    'criteria'=>array(
        'condition'=>'wp_users_ID='.Yii::app()->user->id,
    )));
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));  
                
                
                
                
            }
	}
        
         

	public function actionAdmin() {
		$model = new Foundbox('search');
		$model->unsetAttributes();

		if (isset($_GET['Foundbox']))
			$model->setAttributes($_GET['Foundbox']);

		$this->render('admin', array(
			'model' => $model,
		));
	}
        
        

}