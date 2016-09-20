<style type="text/css">
.freeclips {

    margin: -3px auto;
}
.freeclips h3 {
    color: purple !important;
    margin: 5px 0 0 0 !important;
}
.freeclips h3 a {
    text-decoration: none;
    color: purple !important;
    margin: 5px 0 0 0 !important;
}
.freeclips ul
{
    position: relative;
    white-space:nowrap;
}
.freeclips li
{
    display: inline;
    list-style-type: none;
    padding-right: 5px;
    width: 20%;
    margin: 0px -5px 0px;
}

.freeclips .leftArrow {
    float: left;
    margin-top: 5px;
    z-index: 1;
    padding: 0 5px;
}
.freeclips .rightArrow {
    float: right;
    margin-top: 5px;
    z-index: 1;
    padding: 0 5px;
}

.freeclips .title {
    padding: 0 5px;
}
#freeclips_in .mini {
    height: 150px;
    width: 150px;
}
    #freeTag {
        position: absolute;
        width: 10%;
    }
</style>
<?php
/*
<a href="<?php echo Yii::app()->getBaseUrl() .'/index.php'?>/foundboxesvideos/index/<?php echo $data->id ?>">
<?=$data->title?> 
</a>
*/  
$foundboxTitle = $data->title;   
$foundboxId = $data->id;
$criteria = new CDbCriteria;
$criteria->compare('wp_foundbox_id',$data->id, true);
$boxVideos = Foundboxvideos::model()->findAll($criteria);

$boxUrl = "videogridengine/index.php/foundboxesvideos/index/$foundboxId"; 
?>
<script type="text/javascript">
    function movefreeclips(action) {
        var space = 10;
        var paneOut = $("#freeclips_out");
        var paneIn = $("#freeclips_in"); 
        var paneOutLeft = paneOut.offset().left;
        var paneOutRight = paneOutLeft + paneOut.width();
        var offsetLeft = paneIn.offset().left - paneOutLeft;
        var lastVideo = null;
        var isSet = false;
       
        $("#freeclips_in li").each(function() {
            if(!isSet) {
                var videoWidth = $(this).width();
                var videoLeft = $(this).offset().left; 
                var videoRight = videoLeft + videoWidth;
                
                if(action == "prevous") {
                    if(videoLeft > paneOutLeft && lastVideo != null) {
                        offsetLeft += (paneOutLeft - lastVideo.offset().left) + space; 
                        isSet = true;
                    }
                }
                else if(action == "next"){
                    
                    if(videoRight > paneOutRight) {
                        offsetLeft += (paneOutRight - videoRight) - space; 
                        isSet = true;
                    }
                }
                lastVideo = $(this);
            }
        });
        
        paneIn.animate({
            left : offsetLeft
       });
    }
</script>
<div class="freeclips">
<!--    <div class="leftArrow">-->
<!--        <img alt="" src="/videogridengine/css/fftheme/images/video_left.png" onclick="movefreeclips('prevous')" onmouseout="SwapImage('localhost/videogridengine/css/fftheme/images/video_left.png',this);" onmouseover="SwapImage('/videogridengine/css/fftheme/images/video_left_hv.png',this);" style="cursor:pointer">-->
<!--    </div>-->
<!--    <div class="rightArrow">-->
<!--        <img alt="" src="/videogridengine/css/fftheme/images/video_right.png" onclick="movefreeclips('next')" onmouseout="SwapImage('localhost/videogridengine/css/fftheme/images/video_right.png',this);" onmouseover="SwapImage('/videogridengine/css/fftheme/images/video_right_hv.png',this);" style="cursor:pointer">-->
<!--    </div>-->
    <div id="freeclips_out" style="overflow: hidden">
        <ul id="freeclips_in">
        <?php
        foreach ($boxVideos as $video) {
            $title = " ";
            $description = $video->description;
            $vid_src_url = $video->vid_src_url;
            $vid_flv_path = $video->vid_flv_path;
            $vid_src_id = $video->vid_src_id;
            $vid_thumb_url = $video->vid_thumb_url;
        ?>
            <li>
                <img id="freeTag" src="http://stage.findingfootage.com/wp-content/themes/fftheme/images/new/DesktopSlicing/free-tag.png" alt="">
                <a href="<?=$boxUrl?>" title="<?php echo $title;?>" target="" class="img" id="<?php echo $vid_flv_path ?>"><img class="mini" width="110px" height="62px" src="<?php echo $vid_thumb_url ?>" alt="gallery thumbnail" /></a>
            </li>
        <?php
        }   
        ?>
        </ul>
    </div>
</div>