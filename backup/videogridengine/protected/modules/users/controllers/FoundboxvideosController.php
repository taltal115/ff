<?php

class FoundboxvideosController extends GxController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('minicreate', 'create', 'update', 'admin', 'delete', 'index', 'view'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Foundboxvideos'),
        ));
    }

    public function actionCreate() {
        $model = new Foundboxvideos;

        $this->performAjaxValidation($model, 'foundboxvideos-form');

        if (isset($_POST['Foundboxvideos'])) {
            $model->setAttributes($_POST['Foundboxvideos']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Foundboxvideos');

        $this->performAjaxValidation($model, 'foundboxvideos-form');

        if (isset($_POST['Foundboxvideos'])) {
            $model->setAttributes($_POST['Foundboxvideos']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id, $wp_foundbox_id) {


        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Foundboxvideos')->delete();

            $this->redirect(array('/users/foundboxvideos/index/id/'.$wp_foundbox_id)); exit;
            if (!Yii::app()->getRequest()->getIsAjaxRequest())
            //$this->redirect(array('index'));
            // $dataProvider = new CActiveDataProvider('Foundboxvideos');
                $dataProvider = new CActiveDataProvider('Foundboxvideos', array(
                            'criteria' => array(
                                'condition' => 'wp_foundbox_id=' . $wp_foundbox_id,
                            ),
                        ));
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        } else
            $this->loadModel($id, 'Foundboxvideos')->delete();
$this->redirect(array('/users/foundboxvideos/index/id/'.$wp_foundbox_id)); exit;
        if (!Yii::app()->getRequest()->getIsAjaxRequest())
        //$this->redirect(array('index'));
        // $this->redirect(array('view', 'id' => $model->id));
        // $dataProvider = new CActiveDataProvider('Foundboxvideos');
            $dataProvider = new CActiveDataProvider('Foundboxvideos', array(
                        'criteria' => array(
                            'condition' => 'wp_foundbox_id=' . $wp_foundbox_id,
                        ),
                    ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
        //throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
        ?>
        <!--                <script type="text/javascript">alert('Foundbox Video Successfully Removed...');</script>-->

        <?php
        $this->generateFoundBoxThumb($wp_foundbox_id);
    }

    public function actionIndex($id) {

        //if not admin create criteria object and pass to ActiveDataProvider like in model search method 
        if (Yii::app()->user->name == "admin") {
            if($id=="all"){
                $dataProvider = new CActiveDataProvider('Foundboxvideos');
            }else{
            
            $dataProvider = new CActiveDataProvider('Foundboxvideos',array(
                            'criteria' => array(
                                'condition' => 'wp_foundbox_id=' . $id,
                                )));
            }
            $this->render('index', array(
                'dataProvider' => $dataProvider,
            ));
        } else {
            if ($id == "all") {
                $criteria = new CDbCriteria;
                $criteria->together = true;
                $criteria->with = array('wpFoundbox');
                //$criteria->addSearchCondition('wpFoundbox.wp_users_ID', Yii::app()->user->id, true,'AND','LIKE');
                $criteria->compare('wpFoundbox.wp_users_ID', Yii::app()->user->id, true);

                $dataProvider = new CActiveDataProvider('Foundboxvideos', array(
                            'criteria' => $criteria));
                $this->render('index', array(
                    'dataProvider' => $dataProvider,
                ));
            } else {
                $foundBoxmodel = Foundbox::model()->findByPk($id);

                $fbTitle = ucwords(strtolower($foundBoxmodel->title));
                $dataProvider = new CActiveDataProvider('Foundboxvideos', array(
                            'criteria' => array(
                                'condition' => 'wp_foundbox_id=' . $id,
                                ))); // privacy is public
                $this->render('index', array(
                    'dataProvider' => $dataProvider, 'title' => $fbTitle,
                ));
            }
        }
    }

    public function actionAdmin() {
        $model = new Foundboxvideos('search');
        $model->unsetAttributes();

        if (isset($_GET['Foundboxvideos']))
            $model->setAttributes($_GET['Foundboxvideos']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function generateFoundBoxThumb($foundboxID) {

        $criteria = new CDbCriteria;

        $criteria->compare('wp_foundbox_id', $foundboxID, true);

        $foundboxes = Foundboxvideos::model()->findAll($criteria);
        $src = array();
        foreach ($foundboxes as $foundbox) {
            $src[] = $foundbox->vid_thumb_url;
        }

        $this->createThumb($src, $foundboxID);
    }

    public function createThumb($src, $foundboxID) {

        $imgBuf = array();
        foreach ($src as $link) {
            switch (substr($link, strrpos($link, ".") + 1)) {
                case 'png':
                    $iTmp = imagecreatefrompng($link);
                    break;
                case 'gif':
                    $iTmp = imagecreatefromgif($link);
                    break;
                case 'jpeg':
                case 'jpg':
                    $iTmp = imagecreatefromjpeg($link);
                    break;
            }
            array_push($imgBuf, $iTmp);
        }
        var_dump("1 " . $src);
        $iOut = null;
        $thumbX = 10;
        $thumbY = 10;
        $thumbWidth = 60;
        $thumbHeight = 60;

        $count = count($src);

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
        ?>
        <script type="text/javascript">alert('Foundbox Video Successfully Removed...');</script>

        <?php
    }

}