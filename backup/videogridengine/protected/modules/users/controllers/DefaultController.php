<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
            
            $this->render('index');
		//$this->render('/users/index');
              // $this->redirect(Yii::app()->homeUrl.'/users/foundbox/admin');
	}
        
        public function actionLogout()
	{
		Yii::app()->user->logout();
                wp_logout();
		$this->redirect(get_site_url());
	}
}