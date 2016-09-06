<?php

class WidgetsController extends Controller
{
      // public $VideoJsonData;
    
	public function actionCreate()
	{
		$this->render('create');
	}

	public function actionDemos()
	{
		$this->render('demos');
	}

	public function actionGetwidgetdata($foundboxID)
	{
            
            $foundbox=Foundbox::model()->findByPk((int)$foundboxID);
            if($foundbox->privacy==1){
                
            $criteria = new CDbCriteria;

            $criteria->compare('wp_foundbox_id', $foundboxID, true);

            $foundboxes = Foundboxvideos::model()->findAll($criteria);
             // $this->render('getwidgetdata');
              $VideoJsonData= CJSON::encode($foundboxes);
              $this->render('getwidgetdata', array('VideoJson' => $VideoJsonData));
             
            
           //$data=array();
//           foreach ($foundboxes as $foundboxe) {
//
//               
//         $foundboxe->id;
//	 $foundboxe->vid_src_url;
//	 $foundboxe->vid_flv_path;
//	 $foundboxe->vid_src_id;
//	 $foundboxe->vid_thumb_url;
//	 $foundboxe->wp_service_id;
//         
//
//          } //end foreach
                
            }
            
            else {
                
                return;
            }
		//$this->render('getwidgetdata');
	}

	public function actionIndex()
	{
            
		$this->render('index');
	}

	public function actionShow()
	{
		$this->render('show');
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