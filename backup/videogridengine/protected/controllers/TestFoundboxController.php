<?php

class TestFoundboxController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Foundbox'),
		));
	}

	public function actionCreate() {
		$model = new Foundbox;


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
		$dataProvider = new CActiveDataProvider('Foundbox');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
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