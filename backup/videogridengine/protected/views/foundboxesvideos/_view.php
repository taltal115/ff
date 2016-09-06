
<?php
    /*
    if(!isset($_SESSION["cookiesUrls"])) $_SESSION["cookiesUrls"] = array();
    if(isset($_SESSION["cookiesUrls"]) && $data->cookie_url != "") {
        $_SESSION["cookiesUrls"][] = $data->cookie_url;
    }
    */
    $boxId = $_GET['id'];
    $freeClipsId = '234';
    $cookie_url = $data->cookie_url;
?>
<li class="video"
    id="<?php echo GxHtml::encode($data->vid_src_id); ?>" data-video-id="<?php echo GxHtml::encode($data->id); ?>">
    <!-- USE FOR actionRemoveClipsForm -->
    <? $videoObjectJSON = '{"__className":"FF_DTO_VideoObjectDTO","videoId":"'.$data->vid_src_id.'","date_created":"'.$data->date_created.'","videoName":"'.$data->title.'","description":"'.$data->description.'","videoDollor":"'.$data->vid_src_url.'","videoFlvURL":"'.urlencode(str_replace('"',"'",$data->vid_flv_path)).'","videoServiceId":"'.$data->vid_src_id.'","thumbURL":"'.$data->vid_thumb_url.'","wp_foundbox_id":"'.$data->wp_foundbox_id.'","wp_video_id":"'.$data->id.'","cookie_url":"'.$data->cookie_url.'","wp_service_id":"null"}'; ?>
    <div id="data<?php echo GxHtml::encode($data->vid_src_id); ?>" style="display: none"  ><?php echo $videoObjectJSON //CJSON::encode($data); ?></div>

    <script>
        $(document).ready(function(){
            $('#<?php echo GxHtml::encode($data->vid_src_id); ?>').data('videoData',<?= $videoObjectJSON ?> );
            
         }) 
    </script>
    <div class="img" id="<?php echo GxHtml::encode((str_replace('"',"'",$data->vid_flv_path))); ?>">
        <?
        $infoOnClick = "openVideoDetailDialog('".CHtml::normalizeUrl(Yii::app()->createUrl('videodetail/videodetail'))."','".GxHtml::encode($data->vid_src_id)."')";
        if($boxId == $freeClipsId || true){
            $imgOnClick = $infoOnClick;
        }else{
            $imgOnClick = "imgClick('".GxHtml::encode($data->vid_src_url)."','".$cookie_url."')";
        }  
        ?>
        <?php echo CHtml::link('<img src="' . GxHtml::encode($data->vid_thumb_url) . '" />', 'javascript:void(0)', array('id' => $data->id,  'target' => '','onClick'=>$imgOnClick)); ?>
        
    </div>
    
    <div class="options">
        <table border="0" cellspacing="1" cellpadding="5"> 
        <tr>
        <td>
            <a class="fav" onclick='openAddFavDialog(<?php echo GxHtml::encode($data->vid_src_id); ?>)' title="" rel="" href="#"></a>
        </td>
        <td>
            <span  id="<?php echo GxHtml::encode($data->vid_src_id); ?>_share" class="st_sharethis_custom"
               st_url="<?php echo GxHtml::encode($data->vid_src_url); ?>"  st_title="<?php echo GxHtml::encode($data->title); ?>" st_image="<?php echo GxHtml::encode($data->vid_thumb_url); ?>" st_summary="Sharing is great! Its fun to share Videos from www.findingfootage.com"

               ></span>
        </td>
        <td>
        <? if($boxId == $freeClipsId || true){ ?>
        <a
            class="dollar" style="cursor: pointer;"
            onclick="<?=$infoOnClick?>"
            >
        </a>
        <?}else{?>
        <a class="dollar" target="_blank"
           href="<?php echo GxHtml::encode($data->vid_src_url);?>">
        </a>
        <?}?>
        </td>
        <td>
        <a
            class="info"
            onclick="<?=$infoOnClick?>"
            >
        </a>
        </td>
        <td>
        <input class="thumb_checkBox" id="<?php echo GxHtml::encode($data->vid_src_id); ?>_checkbox" data-id="<?=$data->id?>" type="checkbox" />
        </td>
        </tr>
        </table>
        <?php //print_r($videoObject) ?>
    </div>
</li>

