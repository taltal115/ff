<?php

class FoundboxRankingController extends Controller
{
	public function actionFoundboxRanking()
	{
                 $foundboxID= isset($_POST['foundboxID']) ? $_POST['foundboxID'] : 0;
		 $rating=isset($_POST['rate']) ? $_POST['rate'] : 0;
                 $user_id=Yii::app()->user->id;
                 $criteria = new CDbCriteria;
                 $criteria->compare('foundboxId', $foundboxID, true);

                 $foundboxRankingModel= FoundboxRanking::model()->findAll($criteria);
                 
                 foreach ($foundboxRankingModel as $foundboxRanking) {

                     if($foundboxRanking->user_id==$user_id){
                         
                         echo "Sorry You have already voted for this foundbox !";
                         exit;
                     }
                     
                   }//end foreach
                   
                 $foundboxRankingModel=new FoundboxRanking();
                 $foundboxRankingModel->rank_score= $rating;
                 $foundboxRankingModel->foundboxId= $foundboxID;
                 $foundboxRankingModel->user_id=$user_id;
                 $foundboxRankingModel->save();
                 
                 $criteria = new CDbCriteria;
                 $criteria->compare('foundboxId', $foundboxID, true);
                 $foundboxRankingModel= FoundboxRanking::model()->findAll($criteria);
                 $count=0;
                 $total_score=0;
                 $average_score=0;
                 foreach ($foundboxRankingModel as $foundboxRanking) {
                     $count=$count+1;
                     $total_score=$total_score+$foundboxRanking->rank_score;
                     
                   }//end foreach
                   
                  $average_score=$total_score/$count;
                  
                  $foundboxRModel= Foundbox::model()->findByPk($foundboxID);
                  $foundboxRModel->average_rank=$average_score;
                  $foundboxRModel->update();
              
                    echo "Thank you for voting!";
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