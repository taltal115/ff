 
<!-------------------------- FOR VIDEO THUMBNAILS ---------------------------------->
<script type="text/javascript" src="/videogridengine/css/fftheme/js/flowplayer-3.2.6.min.js"></script>    
<script type="text/javascript" src="/videogridengine/css/fftheme/js/player.js"></script>  
<script type="text/javascript">
    var playerVar="/videogridengine/css/fftheme/player/flowplayer-3.2.7.swf";
</script>
<!--------------------------  END FOR VIDEO THUMBNAILS ---------------------------------->


<style type="text/css">
.foundboxs {
    width: 100%; 
    height: 700px;
    margin: 0 auto; 
}

.foundboxs .leftArrow {
    float: left;
    height: 100%;
    margin-top: 55px;
    padding: 0 5px;
    z-index: 1;
}
.foundboxs .rightArrow {
    float: right;
    height: 100%;
    margin-top: 55px;
    padding: 0 5px;
    z-index: 1;
}
.foundboxs .videos {
    overflow: hidden; 
    padding-left: 0px;  
}

.foundboxs h3 {
    color: purple !important;
    margin: 5px 0 0 0 !important;
}
.foundboxs h3 a {
    text-decoration: none;
    color: white !important;
    margin: 5px 0 0 0 !important;
}
.foundboxs ul
{
    position: relative;
    white-space: normal;
}
.foundboxs li
{
    display: inline;
    list-style-type: none;
    padding-right: 5px;
}
.foundboxs .title
{
    background-color: #564406;
    margin: 22px 36px 12px 36px; 
    padding: 5px 0 5px 0;
    text-align: center;
}

</style>

<?

if (isset($box)) {
    if($box->id > 0){
        $foundboxTitle = $box->title;   
        $foundboxId = $box->id;
    }
}
?>
<div class="foundboxs">
    <div class="title" ><h3><a href="videogridengine/index.php/foundboxesvideos/index/<?=$foundboxId?>"><?=$foundboxTitle ?></a></h3></div>
    <div class="leftArrow">
        <img alt="" src="/videogridengine/css/fftheme/images/video_left.png" onclick="loadHomeBox('prevous')" onmouseout="SwapImage('/videogridengine/css/fftheme/images/video_left.png',this);" onmouseover="SwapImage('/videogridengine/css/fftheme/images/video_left_hv.png',this);" style="cursor:pointer">
    </div> 
    <div class="rightArrow">
        <img alt="" src="/videogridengine/css/fftheme/images/video_right.png" onclick="loadHomeBox('next')" onmouseout="SwapImage('/videogridengine/css/fftheme/images/video_right.png',this);" onmouseover="SwapImage('/videogridengine/css/fftheme/images/video_right_hv.png',this);" style="cursor:pointer">
    </div>
    <div class="videos">
    <?
        $this->renderPartial('_home_box', array(
            'box' => $box));
    ?>
    </div>
</div>