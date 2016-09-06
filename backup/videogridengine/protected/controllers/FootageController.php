<?php

class FootageController extends Controller {       
    private $FreeClipsID = 234;
    
    public function actionPost(){ 
        if(is_user_logged_in()) {    
            
            $postAction = isset($_POST['postAction'])?$_POST['postAction']:"";
            $getAction = isset($_GET['getAction'])?$_GET['getAction']:"";
            
            //$_SESSION['Debug'] = json_encode($_POST);
            //$_SESSION['Debug'] = json_encode($_GET);
            
            $retVal = "";
            switch($postAction) {
                case "REMOVE_PROFILE":
                    $retVal = "0";
                    $current_user = wp_get_current_user();
                    $userID = $current_user->ID ;
                    if($userID > 1){
                        $sql = "UPDATE wp_foundbox SET wp_users_ID = 1,privacy = 0 WHERE wp_users_ID = $userID";
                        try { 
                            $retVal = Yii::app()->db->createCommand($sql)->queryAll();  
                        } catch (Exception $ex) {
                            //echo $ex->getMessage();
                        }
                        require_once(ABSPATH.'wp-admin/includes/user.php' );
                        if(wp_delete_user( $userID ))
                            $retVal = 1;
                    }
                    break;
                 case "EVENT":
                    $retVal = "";
                    break;
                                  
            }
            
            switch($getAction) {    
                case "EVENT":   
                    $retVal = "";
                    break;
                default:
                    break;
            }
            echo $retVal;
        }
    }
    
    public function actionTest() {
        //$this->generateFoundBoxThumb(228);
    }
    
    public function actionCookies() {
        //echo "<iframe src='http://www.pond5.com/holidays' ></iframe>";
        //echo "<iframe src='http://www.pond5.com/siggraph2013' ></iframe>";
        //echo "<iframe src='http://www.pond5.com/samandniko' ></iframe>";
    }
    
    public function actionRun() { 
        // http://www.findingfootage.com/videogridengine/index.php/footage/run
       
        $fboxModel = new Foundbox();
        $tblName = $fboxModel->tableSchema->name;
        //$sql = "update $tblName set vid_src_id = id where vid_src_id = 0";        
        
        //$sql = "SHOW TABLES FROM findingf_live";
        //$sql = "SHOW COLUMNS FROM $tblName";
        //$sql = "ALTER TABLE $tblName ADD cookie_url varchar(250);";
        //$sql = "delete from $tblName where id=2946;";
        
        //$sql = "delete from wp_usermeta WHERE user_id <> 1";
        //$sql = "delete from wp_users WHERE ID <> 1";
        //$sql = "delete from wp_comments";
        //$sql = "delete from wp_bp_activity";
        
        //$sql = "SELECT * FROM wp_users";
        //$sql = "UPDATE wp_users SET user_pass = 'Administrator' WHERE ID = 8141";
        //$sql = "SELECT * FROM wp_bp_activity";
        try { 
            $sql = "UPDATE wp_foundbox SET wp_users_ID = 1 WHERE wp_users_ID = 2";
            if(isset($sql))
                $ret = Yii::app()->db->createCommand($sql)->queryAll();    
        } catch (Exception $ex) {
            echo $ex->getMessage();
            
        }
        print_r($ret); 
        print_r("<BR><BR>".count($ret)); 
    }
    
    
    public function actionIndex() {
        $jsonResults = array();
        try {            
            $searchText = Yii::app()->request->getQuery('searchKeywords');
            if($searchText != "") {
                $searchRequest = new ParametersDTO();
                $searchRequest->searchText = $searchText;
                
                $items_per_page = Yii::app()->request->getQuery('items'); 
                if($items_per_page <= 0) $items_per_page = 50;
                
                $searchRequest->current_page = 1;
                $searchRequest->items_per_page = $items_per_page;

                $searchRequest->searchType = "Empty";
                $videoServices = Yii::app()->videoservices;
              
                $jsonResults = $videoServices->searchVideos($searchRequest);
                
                $this->render('index', array('jsondata' => $jsonResults));
            }
            return;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
    
    public function get_flv_path($vid_flv_path){
        $vid_flv_path = str_replace('"',"'",$vid_flv_path);
        if (preg_match("/<.*?src='(.*?)'/", $vid_flv_path, $matches))
            $vid_flv_path = $matches[1]."&__iframe__";
        return $vid_flv_path;
    }
    
    public function actionLoadClips() {
        // http://www.findingfootage.com/videogridengine/index.php/footage/loadclips //
        $dest_path = null;
        $delete_all = false;
        if(Yii::app()->user->name == "admin"){  
            $model = new UploadForm();
            $userMsg = "";
            if(isset($_POST['UploadForm']))
            {
                $model->attributes = $_POST['UploadForm'];
                $delete_all = $_POST['UploadForm']['delete_all'];
                $model->upload_file = CUploadedFile::getInstance($model,'upload_file');
                $file_name = $model->upload_file->name;
                $file_ext = substr($file_name,strlen($file_name)-4,4);  
                if(isset($model->upload_file) && ($file_ext == ".xls" || $file_ext == "xlsx"))
                {
                    $dest_path = Yii::app()->basePath.'/temp/'. $file_name;
                    $model->upload_file->saveAs($dest_path);
                    
                    // redirect to success page 
                }
            }
            
            if(isset($dest_path)){
                $xlsx = new XLSXReader($dest_path);
                $sheetNames = $xlsx->getSheetNames();
                $sheetName = $sheetNames[1];
                $sheet = $xlsx->getSheet($sheetName);
                if(isset($sheet)){
                    $data = $sheet->getData();
                    
                    $titles = array("Discrpition KeyWords","Embed","Image","Name","URL","Affilate","Cockie");
                    $titleFound = false;
                    $titleError = "";
                    $rowStart = 0;
                    foreach($data as $row) {
                        $rowStart++;
                        if($row[0]==$titles[0]){
                            $titleFound = true;
                            $cellCount = 0;   
                            foreach($titles as $title) {  
                                if(trim($row[$cellCount]) != trim($title)){
                                    $titleError .= "The title '".$row[$cellCount]."' should be '".$title."'<BR>";
                                }
                                $cellCount++;
                            }
                            break;
                        }
                    }
                    if($titleFound && $titleError == ""){
                        $this->saveVideosFromData($data,$rowStart,$delete_all);    
                    }
                    else {
                        if(!$titleFound)
                            $userMsg = "Title row not found, should be: '".implode("', '",$titles)."'";
                        else
                            $userMsg = $titleError;
                    }
                    //$this->array2Table();
                    
                }
            }
            
            $this->render('loadclips',array('model'=>$model,"userMsg"=>$userMsg,"delete_all"));
        }else{
            die;
        }  
    }
    
    public function saveVideosFromData($data,$rowStart,$deleteAll=false){
        $fBoxVideo = null;
        $rowCount = 0;
        if($deleteAll){
            Foundboxvideos::model()->deleteAll("wp_foundbox_id =" . $this->FreeClipsID);
        }
        foreach($data as $row) {
            if($rowCount >= $rowStart){
                if(trim($row[3]) != ""){
                    $fBoxVideo = new Foundboxvideos();
                    $fBoxVideo->date_created = new CDbExpression('NOW()');
                    $fBoxVideo->description = $row[0];
                    $fBoxVideo->vid_flv_path = $this->get_flv_path($row[1]);
                    $fBoxVideo->vid_thumb_url = $row[2];
                    $fBoxVideo->title = $row[3];
                    $fBoxVideo->vid_src_url = $row[4];
                    $fBoxVideo->cookie_url = $row[6];
                    $fBoxVideo->wp_foundbox_id = $this->FreeClipsID;
                    $fBoxVideo->vid_src_id = 0;
                   
                    //print_r($fBoxVideo->title); print_r("<BR>");
                    
                    $fBoxVideo->save();
                    $errors = $fBoxVideo->getErrors();
                    
                    if(count($errors) > 0) {
                        foreach($errors as $error){
                            print_r($error[0]);
                            break;
                        }
                    }else {
                        $fBoxVideo->vid_src_id =  $fBoxVideo->id; 
                        $fBoxVideo->save();
                    }
                   
                }
            }
            $rowCount++;
        }
    }

    public function array2Table($data) {
        echo '<table>';
        foreach($data as $row) {
            echo "<tr>";
            foreach($row as $cell) {
                echo "<td>" . $cell . "</td>";
            }
            echo "</tr>";
        }
        echo '</table>';
    }

    
    public function actionFreeClips() {
        $fboxModel = Foundbox::model()->findByPk($this->FreeClipsID);
        $fboxModelJsons = CJSON::encode($fboxModel);
        print_r($fboxModelJsons);    
    }
    
    public function actionFreeClipsHtml() {
        $data = Foundbox::model()->findByPk($this->FreeClipsID);
        if($data->id > 0) 
            $this->renderPartial("_free_clips", array("data" => $data)); 
    }
    
    private function getHomeBoxs($index = 0){
        //$criteria = new CDbCriteria;  
        //$criteria->compare('privacy', 2, true);
        //$criteria->compare('wp_users_ID',703, true);
        
        // $totalItems = Foundbox::model()->count($condition);
        $condition = "privacy = 2";
        $criteria = new CDbCriteria(array(
            'condition' => $condition
        ));
        $boxs = Foundbox::model()->findAll($criteria);
        return $boxs;
    }
    private function getHomeBox($index = 0){
        $box = null;
        $boxs = $this->getHomeBoxs($index);
        if(isset($boxs) && isset($index) && isset($boxs[$index]))
            $box = $boxs[$index];  
        return $box;
    }
    public function actionHomeBoxsHtml($index = 0) {
        if( $index == -1 ) {
            $boxs = $this->getHomeBoxs($index);
            if(isset($boxs)) 
                print_r(count($boxs));
        }
        else {
            $box = $this->getHomeBox($index);
            if(isset($box) && $box->id > 0) 
                $this->renderPartial("_home_boxs", array("box" => $box)); 
        }
    }
    public function actionHomeBoxHtml($index = 0) {
        $box = $this->getHomeBox($index);
        if(isset($box) && $box->id > 0) 
            $this->renderPartial("_home_box", array("box" => $box)); 
    }
    
    private function getBoxs($text){
        $criteria = new CDbCriteria;      
                 
        if(Yii::app()->user->name != "admin"){
            $user_id = Yii::app()->user->id;
            $condition = 'privacy > 0';
            if($user_id > 0) {  
                if($show_myboxs)
                    $condition = 'wp_users_ID = '.$user_id;
                else
                    $condition .= ' or wp_users_ID = '.$user_id;
            }
            $criteria->condition = $condition;
        }
        
        //$criteria->compare('title', $text, true);
        //$criteria->compare('description', $text, true, 'OR');
        
        $condition = "";
        $strings = split(" ",$text);
        if(count($strings) > 1) {
            foreach($strings as $string) {
                $condition .= " or title REGEXP '[[:<:]]".$string."[[:>:]]'";
                $condition .= " or description REGEXP '[[:<:]]".$string."[[:>:]]'";
                //$criteria->compare('title', $string, false , 'OR', true);
                //$criteria->compare('description', $string, false, 'OR', true);
            }
        }
        if($criteria->condition != "")
            $criteria->condition = "(".$criteria->condition.") AND (title LIKE '%$text%' $condition)"; 
        else
            $criteria->condition = "(title LIKE '%$text%' $condition)";
        //print_r($criteria->condition); 
                   
        $criteria->order = 'average_rank DESC';
        $boxs = Foundbox::model()->findAll($criteria);
        return $boxs;
    }
    public function actionBoxsHtml($text = "") {
        $boxs = $this->getBoxs($text);
        //print_r(count($boxs));
        if(count($boxs) > 0)
            $this->renderPartial("_search_boxs", array("boxs" => $boxs));     
    }
    
    private function getUserBoxs($userId){
        if($userId > 0){
            $currUserId = Yii::app()->user->id;
            if($currUserId == $userId) {  
                $condition = 'wp_users_ID = '.$userId;
            } else {
                $condition .= 'privacy > 0 and wp_users_ID = '.$userId;
            }
            
            $criteria = new CDbCriteria;
            $criteria->condition = $condition;
            $criteria->order = 'average_rank DESC';
            $boxs = Foundbox::model()->findAll($criteria);
            return $boxs;
        }
    }
    public function actionUserBoxsHtml($userId = 0) {
        $boxs = $this->getUserBoxs($userId);
        if(count($boxs) > 0)
            $this->renderPartial("_user_boxs", array("boxs" => $boxs));     
    }
    
    // -- for test only -- //
    public function actionEditBox() {
        if($_POST) {
            //
        }
        else {
            $fboxModel = Foundbox::model()->findByPk(138);
            $fboxModelJsons = CJSON::encode($fboxModel);
            $this->render('editbox', array('jsondata' => $fboxModel));  
        } 
    }
    
    public function actionAddBoxForm() {
        
        if(isset($_GET['TEST'])) {
            
            $this->test();
        }
        else {
            if($_POST) {
                $fBoxData = $_POST['FoundboxPopuForm'];
                //$_SESSION["TEST"] = $fBoxData;
                if(isset($fBoxData)) {
                    $fBoxId = $fBoxData['selectedFBox'];
                    $fBoxVideos = $fBoxData['foundBoxVideos'];
                    $isNewFBox = $fBoxData['isNewFBox'];
                    
                    $foundBoxVidoesJsons = CJSON::decode($fBoxVideos);
                    if ($isNewFBox) {
                        
                        $model = new FoundboxPopuForm;
                        $model->attributes = $fBoxData;
                        $newFBoxId = $this->createNewFoundBox($model);
                        if ($newFBoxId) {
                            $this->createFoundBoxVideos($newFBoxId, $foundBoxVidoesJsons);
                            $this->generateFoundBoxThumb($newFBoxId);
                        }
                    
                    } else {
                        
                        $this->createFoundBoxVideos($fBoxId, $foundBoxVidoesJsons);
                        $this->generateFoundBoxThumb($fBoxId);
                    }
                }
            }
            else {
                print_r($_SESSION["TEST"]);
                $_SESSION["TEST"] = "";
            }
        }
    }
    
    public function actionEditBoxForm() {
        if($_POST) {
            //$_SESSION["TEST"] = $_POST;
            $data = $_POST["Foundbox"];
            $id = $data["id"];
            if($id > 0) {
                $fboxModel = Foundbox::model()->findByPk($id);
                
                if(isset($fboxModel)) {
                    $fboxModel->title = $data["title"]; 
                    $fboxModel->description = $data["description"]; 
                    $fboxModel->privacy = $data["privacy"]; 
                    $fboxModel->update();
                    
                    $this->generateFoundBoxThumb($id);
                }
            }
        }
        else {
            if(isset($_GET['TEST'])) {
                $this->test();
            }
            print_r($_SESSION["TEST"]);
            $_SESSION["TEST"] = "";
        }
    }
    
    public function actionAddClipForm() {
        if(isset($_GET['TEST'])) {
            
        }
        else {
            if($_POST) {
                $data = $_POST['Foundboxvideos'];
                $fBoxId = $_POST['FoundboxId'];
                $affiliate = $_POST['Affiliate'];
                $url = $data['vid_src_url'];
                if(isset($affiliate)) $url= "$url$affiliate";
                   
                $fBoxVideo = new Foundboxvideos();
                $fBoxVideo->title = $data['title'];
                $fBoxVideo->description = $data['description'];
                $fBoxVideo->date_created = new CDbExpression('NOW()');
                $fBoxVideo->vid_flv_path = $this->get_flv_path($data['vid_flv_path']);
                $fBoxVideo->vid_src_id = 0;
                $fBoxVideo->vid_src_url = $url;
                $fBoxVideo->vid_thumb_url = $data['vid_thumb_url'];
                $fBoxVideo->cookie_url = $data['cookie_url'];
                $fBoxVideo->wp_foundbox_id = $fBoxId;
                $fBoxVideo->save();
                $errors = $fBoxVideo->getErrors();
                
                if(count($errors) > 0) {
                    foreach($errors as $error){
                        print_r($error[0]);
                        break;
                    }
                }else {
                    $fBoxVideo->vid_src_id =  $fBoxVideo->id; 
                    $fBoxVideo->save();
                }
            }
            else {
                print_r($_SESSION["TEST"]);
                $_SESSION["TEST"] = "";
            }
        }
    }
    
    public function actionRemoveClipsForm() { 
        if($_POST) {
            $data = $_POST["Foundbox"];
            $fBoxVideos = $data["removeClips"];
            $foundBoxVidoesJsons = CJSON::decode($fBoxVideos);

            foreach ($foundBoxVidoesJsons as $videoJsons) {
                $video = CJSON::decode($videoJsons);
                $video_id = $video["wp_video_id"]; 
                $fBoxVideo = Foundboxvideos::model()->findByPk($video_id);
                if(isset($fBoxVideo))
                    $fBoxVideo->delete();
                
                $errors = $fBoxVideo->getErrors();
                
                $this->printError($errors);
            }
               
        }
        else {  
            if(isset($_GET['TEST'])) {
                
                $criteria = new CDbCriteria;
                $criteria->compare('wp_foundbox_id', 229, true);
                $fBoxVideos = Foundboxvideos::model()->findAll($criteria);
                foreach ($fBoxVideos as $fBoxVideo) {
                    print_r($fBoxVideo->id."<BR>");
                }
                $video_id = 2605;
                $fBoxVideo = Foundboxvideos::model()->findByPk($video_id);
                
                if(isset($fBoxVideo))
                    $fBoxVideo->delete();
            }
            print_r($_SESSION["TEST"]);
            //$_SESSION["TEST"] = "";
        }
    }
    
    public function actionRemoveBoxForm() { 
        if($_POST) {
            $data = $_POST["Foundbox"];
            $foundboxID = $data["id"];
            if($foundboxID > 0 && $foundboxID != $this->FreeClipsID) {
                // -- Remove Box Videos -- //
                $criteria = new CDbCriteria;
                $criteria->compare('wp_foundbox_id', $foundboxID, true);
                $fBoxVideos = Foundboxvideos::model()->findAll($criteria);
                foreach ($fBoxVideos as $fBoxVideo) {
                    $fBoxVideo->delete();
                }
                
                // -- Remove The Box -- //
                $fboxModel = Foundbox::model()->findByPk($foundboxID);
                if(isset($fboxModel)) {
                    $fboxModel->delete();
                }
                $errors = $fboxModel->getErrors();
                $this->printError($errors);
            }  
        }
        else {  
            if(isset($_GET['TEST'])) {
                //
            }
            print_r($_SESSION["TEST"]);
            $_SESSION["TEST"] = "";
        }
    }
    
    public function action_home_login() { 
        $this->renderPartial("_home_login");  
        if($_POST){
               
        }else{
            //$this->redirect(get_site_url());
        }
    }
    
    public function createNewFoundBox(FoundboxPopuForm $fboxPopupFormModel) {
        if (Yii::app()->user->isGuest) {
            $this->redirect(get_site_url() . '/wp-login.php');
        } else {
            $fboxModel = new Foundbox();
            $fboxModel->description = $fboxPopupFormModel->description;
            $fboxModel->title = $fboxPopupFormModel->title;
            $fboxModel->privacy = $fboxPopupFormModel->privacy;
            $fboxModel->widget_thumb_url = "myurl";
            $fboxModel->date_created = $fboxModel->date_modified = new CDbExpression('NOW()');
            $fboxModel->average_rank = 0;
            $fboxModel->wp_users_ID = Yii::app()->user->id;
            if(!isset($fboxModel->description) || trim($fboxModel->description) == "")
                $fboxModel->description = $fboxModel->title;
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
        }
    }
    
    public function createFoundBoxVideos($fBoxId, $selectedFoundBoxVideos) {

        //print_r($selectedFoundBoxVideos);
        foreach ($selectedFoundBoxVideos as $selectedFoundBoxVideo) {

            $this->createNewFoundBoxVideo($fBoxId, $selectedFoundBoxVideo);
        }
        
        $this->generateFoundBoxThumb($fBoxId);
    }

    public function createNewFoundBoxVideo($fBoxId, $fboxVideoData) {
        $errors = array();
        
        $fBoxVideo = new Foundboxvideos();
        $fBoxVideo->title = $fboxVideoData['videoName'];
        $fBoxVideo->description = "no discription yet..";
        $fBoxVideo->date_created = new CDbExpression('NOW()');
        $fBoxVideo->vid_flv_path = $fboxVideoData['videoFlvURL'];
        $fBoxVideo->vid_src_id = $fboxVideoData['videoServiceId'];
        $fBoxVideo->vid_src_url = $fboxVideoData['videoDollor'];
        $fBoxVideo->vid_thumb_url = $fboxVideoData['thumbURL'];
        $fBoxVideo->wp_foundbox_id = $fBoxId;
        $fBoxVideo->save();
        
        $errors = $fBoxVideo->getErrors(); 

        print_r($errors);
        var_dump($fBoxVideo->id);
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
    
    function printError($errors) {
        if(count($errors) > 0) {
            foreach($errors as $error){
                print_r($error[0]);
                break;
            }
        }
    }
}