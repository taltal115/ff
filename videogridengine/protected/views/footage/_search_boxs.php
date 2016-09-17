

<style type="text/css">
.itemfoundboxs {
    width: 100%;
    margin: 20px 0; 
    padding: 0;
}

.itemfoundboxs .leftArrow {
    float: left;
    height: 100%;
    padding: 35px 5px;
    margin: 0;
    z-index: 1;
}
.itemfoundboxs .rightArrow {
    float: left;
    height: 100%;
    padding: 35px 5px;
    margin: 0;
    z-index: 1;
}

.itemfoundboxs .boxs { 
    position: relative;
    margin-left: 5px;
    overflow-x: hidden;
    overflow-y:  hidden;
    height: 180px;
}
.itemfoundboxs .box {
    float: left;
    
    margin-bottom: 5px;
    position: relative;
    overflow: hidden;
    width: 210px;
}
.itemfoundboxs .title {
    color: purple;
    margin: 0 0 5px 0;
    text-align: left;
    font-weight: bold;
    font-size: 14pt;
    height: 20px;
    overflow: hidden;
}
.itemfoundboxs .title a {
    text-decoration: none;
    color: purple !important;
    margin: 5px 0 0 0 !important;
}

.itemfoundboxs .videos {
    margin: 0;
}
.itemfoundboxs ul
{
   list-style: none outside none;
   padding-left: 0;
}
.itemfoundboxs li
{
    padding: 0px 2px !important;
    float: left;
}

.itemfoundboxs ul li .mini{
    /* Animation with transition in Safari and Chrome */
    -webkit-transition: all 0.6s ease-in-out;
    /* Animation with transition in Firefox (No supported Yet) */
    -moz-transition: all 0.6s ease-in-out;
    /* Animation with transition in Opera (No supported Yet)*/
    -o-transition: all 0.6s ease-in-out;
    /* The the opacity to 0 to create the fadeOut effect*/
    border:1px solid black;
    /* box shadow effect in Safari and Chrome*/
    -webkit-box-shadow:#272229 2px 2px 10px;
    /* box shadow effect in Firefox*/
    -moz-box-shadow:#272229 2px 2px 10px;
    /* box shadow effect in IE*/
    filter:progid:DXImageTransform.Microsoft.Shadow(color='#272229', Direction=135, Strength=5);
    /* box shadow effect in Browsers that support it, Opera 10.5 pre-alpha release*/
    box-shadow:#272229 2px 2px 10px;
}
</style>
 
<script type="text/javascript">
    // starting the script on page load
    $(document).ready(function(){
        imagePreview();
    }); 

    function movefreeclips(action) {
        var space = 5;
        var paneOut = $(".outer");
        var paneIn = $(".boxs"); 
        var paneOutLeft = paneOut.offset().left;
        var paneOutRight = paneOutLeft + paneOut.width();
        var offsetLeft = paneIn.offset().left - paneOutLeft;
        var lastBox = null;
        var isSet = false;
       
        $(".box").each(function() {
            
            if(!isSet) {
                var videoWidth = $(this).width();
                var videoLeft = $(this).offset().left; 
                var videoRight = videoLeft + videoWidth;
                
                if(action == "prevous") {
                    if(videoLeft > paneOutLeft && lastBox != null) {
                        offsetLeft += (paneOutLeft - lastBox.offset().left) + space; 
                        isSet = true;
                    }
                }
                else if(action == "next"){
                    
                    if(videoRight > paneOutRight) {
                        offsetLeft += (paneOutRight - videoRight) - space; 
                        isSet = true;
                    }
                }
                lastBox = $(this);
            }
        });
        
        paneIn.animate({
            left : offsetLeft
       });
    }
</script>
<div class="itemfoundboxs">
    <!-- div class="leftArrow">
        <img alt="" src="/videogridengine/css/fftheme/images/video_left.png" onclick="movefreeclips('prevous')" onmouseout="SwapImage('/videogridengine/css/fftheme/images/video_left.png',this);" onmouseover="SwapImage('/videogridengine/css/fftheme/images/video_left_hv.png',this);" style="cursor:pointer">
    </div --> 
    
    <div class="boxs">
            <?php
            foreach ($boxs as $box) {
            ?>
            <div class="box">
                <?php
                if (isset($box)) {
                    if($box->id > 0){
                        $foundboxId = $box->id;
                        $boxUrl = "/videogridengine/index.php/foundboxesvideos/index/$foundboxId";
                        $foundboxTitle = $box->title;   
                        $limit = 12;
                        $condition = "wp_foundbox_id = $box->id";
                        $criteria = new CDbCriteria(array(
                            'condition' => $condition,
                            'limit' => $limit
                        ));
                        $boxVideos = Foundboxvideos::model()->findAll($criteria);
                    }
                }
                ?>
                <div class="title"><a href="<?=$boxUrl?>"><?=$foundboxTitle ?></a></div>
                <div class="videos">
                    <ul>
                        <?php
                        if(isset($boxVideos)) {
                            foreach ($boxVideos as $video) {
                                $title = " ";
                                $description = $video->description;
                                $vid_src_url = $video->vid_src_url;
                                $vid_flv_path = $video->vid_flv_path;
                                $vid_src_id = $video->vid_src_id;
                                $vid_thumb_url = $video->vid_thumb_url;
                            ?>
                                 <li>
                                    <a href="<?=$boxUrl?>" title="<?php echo $title;?>" target="" class="img" id="<?php echo $vid_flv_path ?>"><img class="mini" width="45px" height="45px" src="<?php echo $vid_thumb_url ?>" alt="gallery thumbnail" /></a>
                                </li>
                            <?php
                            }  
                        } 
                        ?>
                    </ul> 
                </div>
            </div>
            <?php
            }
            ?>
    </div> 
    
    <!-- div class="rightArrow">
        <img alt="" src="/videogridengine/css/fftheme/images/video_right.png" onclick="movefreeclips('next')" onmouseout="SwapImage('/videogridengine/css/fftheme/images/video_right.png',this);" onmouseover="SwapImage('/videogridengine/css/fftheme/images/video_right_hv.png',this);" style="cursor:pointer">
    </div -->
</div>