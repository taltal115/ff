 
<li class="videofbox" id="<?php echo $data->id ?>Thumb">
  

<!--  title-->
<div class="foundboxes">
        <?php  
        $limit = 20;
        $condition = "wp_foundbox_id = $data->id";
        $criteria = new CDbCriteria(array(
            'condition' => $condition,
            'limit' => $limit
        ));
        $boxVideos = Foundboxvideos::model()->findAll($criteria);
  ?>
    <div id="<?php echo "BOX_$data->id"; ?>">  
    <ul>
    <?
    foreach ($boxVideos as $video) {
    ?>
    <li>
        <a class="img" id="<?php echo $video->vid_flv_path ?>" href="<?php echo Yii::app()->getBaseUrl() .'/index.php'?>/foundboxesvideos/index/<?php echo $data->id ?>">
        <img class="mini" id="<?php echo $video->id ?>" width="45px" height="45px" src="<?=GxHtml::encode($video->vid_thumb_url)?>" alt="<?php echo "" ?>" title="<?php echo "" ?>" />
        </a>
    </li>
    <?
    }   
    ?>
    </ul>
    <?
    /* -- OLD
   <img  width="50px" height="50px" src="<?php echo Yii::app()->getBaseUrl()."/".$data->widget_thumb_url ?>"   alt="<?php echo "" ?>" title="<?php echo "" ?>" /> 
    */
    ?>
    </div>  
</div>  
<div class="box_title">   
<a href="<?php echo Yii::app()->getBaseUrl() .'/index.php'?>/foundboxesvideos/index/<?php echo $data->id ?>">
<?=$data->title?> 
</a>
</div>        
    <?php
    
$foundboxRModel= Foundbox::model()->findByPk($data->id);
if(Yii::app()->user->isGuest){
$this->widget('CStarRating',array(
    'name'=>''.$data->id,
    'minRating'=>1, //minimal value
        'maxRating'=>5,//max value
        'starCount'=>5, //number of stars
    'value'=> ceil($foundboxRModel->average_rank),
    'readOnly'=>true,
    'callback'=>'
        function(){
                $.ajax({
                    type: "POST",
                    url: "'.Yii::app()->createUrl('FoundboxRanking/foundboxRanking').'",
                    data: "'.Yii::app()->request->csrfTokenName.'='.Yii::app()->request->getCsrfToken().'&foundboxID='.$data->id.'&rate=" + $(this).val(),
                    success: function(msg){
                              alert(msg);
                               
                        }})}'
  ));


echo "<h3><div id='".$data->id."'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".number_format($foundboxRModel->average_rank,'1')." avg</div></h3>";
}else{
    
    $this->widget('CStarRating',array(
    'name'=>''.$data->id,
    'minRating'=>1, //minimal value
        'maxRating'=>5,//max value
        'starCount'=>5, //number of stars
    'value'=> ceil($foundboxRModel->average_rank),
    'callback'=>'
        function(){
                $.ajax({
                    type: "POST",
                    url: "'.Yii::app()->createUrl('FoundboxRanking/foundboxRanking').'",
                    data: "'.Yii::app()->request->csrfTokenName.'='.Yii::app()->request->getCsrfToken().'&foundboxID='.$data->id.'&rate=" + $(this).val(),
                    success: function(msg){
                            alert(msg);
                                
                        }})}'
  ));
    echo "<h3><div id='".$data->id."'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".number_format($foundboxRModel->average_rank,'1')." avg</div></h3>";
}//end else

 ?>

</li>




  