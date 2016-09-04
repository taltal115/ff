

<style type="text/css">
.itemfoundboxs {
    width: 100%;
    margin: 20px 0; 
    padding: 0;
}
 
.itemfoundboxs .boxs { 
    position: relative;
    margin-left: 5px;
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

</script>  
<div class="top_titles">
        MY BOXES:</div> 
<div class="itemfoundboxs">
    
    <div class="boxs">
            <?
            foreach ($boxs as $box) {
            ?>
            <div class="box">
                <?
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
                        <?
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
                            <?
                            }  
                        } 
                        ?>
                    </ul> 
                </div>
            </div>
            <?
            }
            ?>
    </div> 
   
</div>