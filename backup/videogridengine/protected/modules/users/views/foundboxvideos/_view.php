

<?php /*<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('date_created')); ?>:
	<?php echo GxHtml::encode($data->date_created); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('description')); ?>:
	<?php echo GxHtml::encode($data->description); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('vid_src_url')); ?>:
	<?php echo GxHtml::encode($data->vid_src_url); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('vid_flv_path')); ?>:
	<?php echo GxHtml::encode($data->vid_flv_path); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('vid_src_id')); ?>:
	<?php echo GxHtml::encode($data->vid_src_id); ?>
	<br />
	
	<?php echo GxHtml::encode($data->getAttributeLabel('vid_thumb_url')); ?>:
	<?php echo GxHtml::encode($data->vid_thumb_url); ?>
	<br />
       
	<?php echo GxHtml::encode($data->getAttributeLabel('wp_foundbox_id')); ?>:
	<?php echo GxHtml::encode(GxHtml::valueEx($data->wpFoundbox)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('wp_service_id')); ?>:
	<?php echo GxHtml::encode(GxHtml::valueEx($data->wpService)); ?>
	<br />
	

</div>
 * 
 */?>
<!-------------------------- FOR VIDEO THUMBNAILS ---------------------------------->

 <script src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/flowplayer-3.2.6.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery-ui.min.js"></script>
<link type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/jquery-ui.css" rel="Stylesheet" />
<script type="text/javascript">
   var playerVar="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/player/flowplayer-3.2.7.swf";
</script>

<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/main_1.js"></script>



        <style type="text/css">

                #preview{
	position:absolute;
        border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
        width: 300px;
        height: 220px;
        top:auto;
        left: auto;
        margin: auto;
        border-radius:8px;
	} 
        </style>
  

<!--------------------------  eND FOR VIDEO THUMBNAILS ---------------------------------->

<li class="video" id="<?php echo $foundboxvideo->id ?>HHHHThumb">
    <div class="user-name">
    </div>

    <div class="img"  id="<?php echo $data->vid_flv_path ?>">
        <?php  echo CHtml::link('<img src="'.GxHtml::encode($data->vid_thumb_url).'" />', GxHtml::encode($data->vid_src_url),array('id'=>$data->id,'target'=>'_blank'));
        ?>                                 
    </div>   

    <div class="user_options">
        <?php echo GxHtml::link("", array('update', 'id' => $data->id));?>
          <?php  echo CHtml::link('<img src="'.GxHtml::encode(Yii::app()->request->baseUrl."/css/fftheme/images/delete.png").'" />',array('foundboxvideos/delete','id'=>$data->id,'wp_foundbox_id'=>$data->wp_foundbox_id));?>
     </div>
       <a class="dollars" target="_blank" href="<?php echo GxHtml::encode($data->vid_src_url); ?>">
       <img src="<?php echo GxHtml::encode(Yii::app()->request->baseUrl."/css/fftheme/images/dollaricon.png") ?>"/>
        </a>
</li>

