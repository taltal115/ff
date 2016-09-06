<?php

class SearchController extends Controller {

    public $searchKeyword;

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'list' and 'show' actions
                'actions' => array('index'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('foundbox'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

//public function filters() {
//        return array(
//            'accessControl',
//        );
//    }
//
//    public function accessRules() {
//        return array(
//            array('allow',
//                'actions' => array('foundbox'),
//                'users' => array('@'),
//            ),
//            array('allow',
//                'actions' => array('advance', 'index', 'results'),
//                'users' => array('admin'),
//            ),
//            array('deny',
//                'users' => array('*'),
//            ),
//        );
//    }

    public function actionAdvance() {
        $this->render('advance');
    }

    public function actionIndex() {
         
        $model = new SearchBarForm();

        $jsonResults = array();
        if (isset($_GET['SearchBarForm'])) {
            // collects user input data
            $model->attributes = $_GET['SearchBarForm'];
            if (!$model->validate()) {
                $this->redirect(Yii::app()->user->returnUrl, array('model' => $model));
            } else {
                try {

                    $searchRequest = new ParametersDTO();
                    $searchRequest->searchText = $model->searchKeywords;
                    $currentPage = Yii::app()->request->getQuery('page');
                    if ($currentPage == "")
                        $currentPage = 1;

                    $searchRequest->current_page = $currentPage;
                    $searchRequest->items_per_page = Yii::app()->params['selected_num_item'];

                    $searchRequest->searchType = "Empty";
                    $videoServices = Yii::app()->videoservices;
                  
                    $jsonResults = $videoServices->searchVideos($searchRequest);
                    
                    $this->render('index', array('jsondata' => $jsonResults));
                    return;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    exit;
                }
            }
        }
        $this->render('index', array('model' => $model));
        //$this->render('index');
    }

    public function actionResults() {
        $this->render('results');
    }

    public function actionFoundbox() {
        $ret = false;
        if(isset($_GET['TEST'])) {
            // $this->test();
        }
        else {
            if($_POST) {
                $fBoxData = $_POST['FoundboxPopuForm'];
                if(isset($fBoxData)) {
                    
                    $fBoxVideos = $fBoxData['foundBoxVideos'];
                    $fBoxData = str_replace('\\', '', $fBoxData);
                    $model = new FoundboxPopuForm;
                    $model->attributes = $fBoxData;
                    
                    $foundBoxVidoesJsons = CJSON::decode($model->foundBoxVideos); // $fBoxVideos;
                    //$_SESSION["TEST"] = CJSON::decode($model->foundBoxVideos);
                    if ($model->isNewFBox) {
                        $newFBoxId = $this->createNewFoundBox($model);
                        if ($newFBoxId) {
                            if($this->createFoundBoxVideos($newFBoxId, $foundBoxVidoesJsons)){
                                //$this->generateFoundBoxThumb($newFBoxId);
                                $ret = true;
                            }
                            else {
                                $this->removeBox($newFBoxId);    
                            }
                        }
                    } else {
                        $fBoxId = $fBoxData['selectedFBox'];
                        if($this->createFoundBoxVideos($fBoxId, $foundBoxVidoesJsons)){
                            //$this->generateFoundBoxThumb($fBoxId);
                            $ret = true;
                        }
                    }
                }
            }
            else {
                print_r($_SESSION["TEST"]);
                $_SESSION["TEST"] = "";
            }
        }
        return $ret;
    }
    public function test() {
       // $this->generateFoundBoxThumb(228);
    }
    
    public function _actionFoundbox() {
        if($_POST) {
            $alldata = $_POST;
            $fboxdata = $_POST['FoundboxPopuForm'];
            $fboxdata = str_replace('\\', '', $fboxdata);
            $model = new FoundboxPopuForm;
            if (isset($_POST['FoundboxPopuForm'])) {


                $model->attributes = $fboxdata; //with     json string not working
                //$model->title="TITEL";
                //$model->description="description";
                $model->foundBoxVideos=$_POST['FoundboxPopuForm']['foundBoxVideos'];
                if ($model->validate()) { // chk if the FoundboxPopuForm is validated then do ur work
                    $foundboxJsonString = stripslashes($model->foundBoxVideos);
                    print_r($model->title);
                  
                    $foundBoxVidoesJsons = CJSON::decode($model->foundBoxVideos);

                    print_r($foundBoxVidoesJsons);
                    echo "is new foundbox " . $model->isNewFBox;

                    if ($model->isNewFBox) {

                        $newFBoxId = $this->createNewFoundBox($model);
                        if ($newFBoxId) {
                            if($this->createFoundBoxVideos($newFBoxId, $foundBoxVidoesJsons)){
                                //$this->generateFoundBoxThumb($model->selectedFBox);
                            }else{
                                $this->removeBox($newFBoxId);    
                            } 
                        }
                    } else {
                        if($this->createFoundBoxVideos($model->selectedFBox, $foundBoxVidoesJsons)){
                            //$this->generateFoundBoxThumb($model->selectedFBox);    
                        }
                    }
                } else {
                    echo "Model of FoundBoxPopup has errors ";
                    print_r($model->getErrors());
                    exit;
                }

            }
        }
        else {
            //$this->render('_Foundbox');
            $fboxModel = Foundbox::model()->findByPk(138);
            $fboxModelJsons = CJSON::encode($fboxModel);
            print_r($fboxModelJsons);
        }
    }
    
    public function removeBox($boxID){
        $ret = false;
        // -- Remove The Box -- //    
        $fboxModel = Foundbox::model()->findByPk($boxID);
        if(isset($fboxModel)) {
            $fboxModel->delete();
            $errors = $fboxModel->getErrors();
            $ret = !$this->printError($errors);
        }
        return $ret;
    }
    
    public function url_exists($url) {
        $exists = false;
        $file_headers = @get_headers($url);
        if(isset($file_headers[0])) {
            $exists = true;
        }
        return $exists;
    }
    public function createThumb($src, $foundboxID) {
        $imgBuf = array();
        foreach ($src as $link) {
            if($this->url_exists($link))
            {
                switch (substr($link, strrpos($link, ".") + 1)) {
                    case 'png':
                        $iTmp = imagecreatefrompng($link); break;
                    case 'gif':
                        $iTmp = imagecreatefromgif($link); break;
                    case 'jpeg':
                    case 'jpg':
                        $iTmp = imagecreatefromjpeg($link); break;
                } 
                array_push($imgBuf, $iTmp);
            }
        }
        
        $iOut = null;
        $thumbX = 10;
        $thumbY = 10;
        $thumbWidth = 60;
        $thumbHeight = 60;

        $count = count($imgBuf);

        if ($count > 16) {
            $count = 16;
        }

        $thumbWidth = 43;
        $thumbHeight = 22;

        $iOut = imagecreatetruecolor("200", "153");
        $bg = imagecolorallocate($iOut, 255, 255, 255);
        imagefill($iOut, 0, 0, $bg);
        for ($i = 0; $i < $count; $i++) {

            $new_image = imagecreatetruecolor($thumbWidth, $thumbHeight);
            imagecopyresampled($new_image, $imgBuf[$i], 0, 0, 0, 0, $thumbWidth, $thumbHeight, imagesx($imgBuf[$i]), imagesy($imgBuf[$i]));

            imagecopy($iOut, $new_image, $thumbX, $thumbY, 0, 0, $thumbWidth, $thumbHeight);
            imagedestroy($imgBuf[$i]);
            imagedestroy($new_image);

            if ($thumbX >= 148) {

                $thumbX = 10;
                $thumbY = $thumbY + 32;
            } else {
                $thumbX = $thumbX + 46;
            }//end else
        }//end for

        $fboxModel = Foundbox::model()->findByPk($foundboxID);

        $thumbY = $thumbY + 32;

        $textcolor = imagecolorallocate($iOut, 0, 0, 0);
        $foundTitle = substr($fboxModel->title, 0, 20);
        imagestring($iOut, 3, 10, 130, $foundTitle, $textcolor);


        imagejpeg($iOut, "./videothumbs/foundboxthumb" . $foundboxID . ".jpg");

        $fboxModel->widget_thumb_url = "./videothumbs/foundboxthumb" . $foundboxID . ".jpg";
        $fboxModel->update();
    }


    public function generateFoundBoxThumb($foundboxID) {
        /*
        $criteria = new CDbCriteria;
        $criteria->compare('wp_foundbox_id', $foundboxID, true);
        $foundboxes = Foundboxvideos::model()->findAll($criteria);
        $src = array();
        foreach ($foundboxes as $foundbox) {
            $src[] = $foundbox->vid_thumb_url;
        }
        
        $this->createThumb($src, $foundboxID);
        */
    }

    public function createNewFoundBox(FoundboxPopuForm $fboxPopupFormModel) {

        $fboxModel = new Foundbox();
        $fboxModel->description = $fboxPopupFormModel->description;
        $fboxModel->title = $fboxPopupFormModel->title;
        $fboxModel->privacy = $fboxPopupFormModel->privacy;
        $fboxModel->widget_thumb_url = "myurl";
        $fboxModel->date_created = $fboxModel->date_modified = new CDbExpression('NOW()');
        $fboxModel->average_rank = 0;
        if(!isset($fboxModel->description) || trim($fboxModel->description) == "")
                $fboxModel->description = $fboxModel->title;
        
        if (Yii::app()->user->isGuest) {

            $this->redirect(get_site_url() . '/wp-login.php');
        } else {
            $fboxModel->wp_users_ID = Yii::app()->user->id;
            if ($fboxModel->validate()) {

                $fboxModel->save(); //New Foundbox has been created
                $errors = $fboxModel->getErrors();
                $this->printError($errors);
                return $fboxModel->id;
            } else {
                $errors = $fboxModel->getErrors();
                $this->printError($errors);
                return false;
            }
        }//end else if logged
    }

    public function createFoundBoxVideos($fBoxId, $selectedFoundBoxVideos) {
        foreach ($selectedFoundBoxVideos as $selectedFoundBoxVideo) {
            if(isset($selectedFoundBoxVideo)){
                $ret = $this->createNewFoundBoxVideo($fBoxId, $selectedFoundBoxVideo);
                if(!$ret) return false;
            }
        }
        return true;
    }

    public function createNewFoundBoxVideo($fBoxId, $fboxVideoData) {
        
        $fBoxVideo = new Foundboxvideos();
        $fBoxVideo->title = $fboxVideoData['videoName'];
        $fBoxVideo->description = $fBoxVideo->title;
        $fBoxVideo->date_created = new CDbExpression('NOW()');
        $fBoxVideo->vid_flv_path = $fboxVideoData['videoFlvURL'];
        $fBoxVideo->vid_src_id = $fboxVideoData['videoServiceId'];
        $fBoxVideo->vid_src_url = $fboxVideoData['videoDollor'];
        $fBoxVideo->vid_thumb_url = $fboxVideoData['thumbURL'];
        $fBoxVideo->wp_foundbox_id = $fBoxId;
        $fBoxVideo->save();
        $errors = $fBoxVideo->getErrors();
        $this->printError($errors);
        return count($errors)>0?false:true;
        //var_dump($fBoxVideo->id);
    }

    function printError($errors) {
        $ret = false;
        if(count($errors) > 0) {
            foreach($errors as $error){
                print_r($error[0]);
                break;
            }
            $ret = true;
        }
        return $ret;
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
