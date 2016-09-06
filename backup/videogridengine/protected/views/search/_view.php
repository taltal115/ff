
<li class="videofbox" id="<?php echo $foundbox->id ?>Thumb">
  
    <?php 
  $page=$_GET['Foundbox_page'];
    
  if(isset ($page)){
?>
    <a href="index?Foundbox_page=<?php 
    if($page>1){
      $page=$page-1;  
    }
    echo $page;
    ?>">
    <?php }else{?>
    <a href="#">
    <?php
    
    }
    ?>
    
    
   <div class="p-arrow-leftfb sliderss"><img alt="Scroll Left" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png" mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.png" mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-left.pngg"></div>
    </a>
<!--  title-->
    <div class="foundboxes">
        <?php  
 
      //new code for videourls
        $criteria = new CDbCriteria;
        $criteria->compare('wp_foundbox_id',$data->id, true);
        $foundboxes = Foundboxvideos::model()->findAll($criteria);
        $flvpath=array();
        $flvpath="";

        foreach ($foundboxes as $foundbox) {

         $flvpath.=$foundbox->vid_flv_path.",";

}

  
     //echo CHtml::link('<img src=".'.GxHtml::encode($data->widget_thumb_url).'" />', array('view', 'id'=>$data->id));
      // echo Yii::app()->getBaseUrl(); $("#result").html(msg);
       // echo("<h1>.".GxHtml::encode($data->widget_thumb_url)."</h1>");
      //  echo CHtml::link('<img src=".'.GxHtml::encode($data->widget_thumb_url).'" />', array('/foundboxesvideos/index', 'id'=>$data->id));
  ?>

    <a href="<?php echo Yii::app()->getBaseUrl() .'/index.php'?>/foundboxesvideos/index/<?php echo $data->id ?>">
  <img src="<?php echo Yii::app()->getBaseUrl()."/".$data->widget_thumb_url ?>" onmouseover='playOnMouseOver("<?php echo $flvpath ?>","<?php echo Yii::app()->request->baseUrl . '/css/fftheme/player/flowplayer-3.2.7.swf'; ?>"); return false;' onmouseout='closeOnMouseOut(); return false;' alt="<?php echo "" ?>" title="<?php echo "" ?>" />
    </a>
<!--  <img src="<?php echo Yii::app()->getBaseUrl()."/".$data->widget_thumb_url ?>" onmouseover='playOnMouseOver("<?php echo $flvpath ?>","<?php echo Yii::app()->request->baseUrl . '/css/fftheme/player/flowplayer-3.2.7.swf'; ?>"); return false;' alt="<?php echo "" ?>" title="<?php echo "" ?>" />-->
 

 <?php
      //  echo CHtml::link('<img src="'.Yii::app()->getBaseUrl()."/".$data->widget_thumb_url.'" />', array('/foundboxesvideos/index', 'id'=>$data->id));
     
     
        ?>      
   
               
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


//echo "<br/>";
echo "<h3><div id='".$data->id."'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$foundboxRModel->average_rank." avg</div></h3>";
//echo "<div id='result'></div>";
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
    echo "<h3><div id='".$data->id."'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$foundboxRModel->average_rank." avg</div></h3>";
}//end else

//echo "<span class='tooltip'>";
//echo "<div id='".$data->id."'>".$foundboxRModel->average_rank." avg</div>";
//echo "<div id='result' style='color:black;border:0px solid red; padding:5px; height:auto'></div></span><br><br>";
 
     // echo CHtml::link('<img src="'.Yii::app()->getBaseUrl()."/images/widgeticon.jpg".'" />', array('Widgets/getwidgetdata', 'foundboxID'=>$data->id),array('target'=>'_blank'));                                 
?>

	<?php /*?><?php echo "saj".GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('description')); ?>:
	<?php echo GxHtml::encode($data->description); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('privacy')); ?>:
	<?php echo GxHtml::encode($data->privacy); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('widget_thumb_url')); ?>:
	<?php echo GxHtml::encode($data->widget_thumb_url); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('date_created')); ?>:
	<?php echo GxHtml::encode($data->date_created); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('date_modified')); ?>:
	<?php echo GxHtml::encode($data->date_modified); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('wp_users_ID')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->wpUsers)); ?>
	<br />
	*/ ?>

<?php 
if(isset ($page)){
?>
<a href="index?Foundbox_page=<?php 

      $page=$page+1;  
  
    echo$page;?>">
    <?php 
}else{?>
    <a href="<?php
    echo($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http". "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>/index?Foundbox_page=2">
    <?php
    
    }
    ?>
 <div class="p-arrow-rightfb sliders"><img alt="Scroll Right" src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png" mouseoutpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png" mouseinpic="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/p-arrow-right.png"></div>
 
</a>
 
  </li>
  
  
  
      



  
  