 
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
    width: 64%;
    position: absolute;
    left: 0;
    right: 0;
    margin: 0 auto;
    background: #fff;
    max-width: 894px;
    height: 360px;
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
#videos {
    position: absolute;
    left: 0;
    right: 0;
    text-align: left;
    margin: 0 auto;
}
.foundboxs ul
{
    /*white-space: normal;*/
    /*list-style: none;*/
    /*position: relative;*/
    /*left: 50%;*/
}
.foundboxs li
{
    display: inline;
    list-style-type: none;
    float: left;
    margin: 0 20px 0 0;
}
.foundboxs .title
{
    background-color: #564406;
    margin: 22px 36px 12px 36px; 
    padding: 5px 0 5px 0;
    text-align: center;
}
.new_title {
    text-align: center;
    margin: 20px 0;
}
.new_title h1 {
    font-size: 24px;
}
.new_title h4 {
    font-size: 16px;
}
</style>

<?php

if (isset($box)) {
    if($box->id > 0){
        $foundboxTitle = $box->title;   
        $foundboxId = $box->id;
    }
}
?>
<div class="foundboxs">

    <div class="new_title">
        <h1>Stock</h1>
        <h4 style="color: #521a78;">Video Collection</h4>
    </div>
    <div class="videos">
    <?php
        $this->renderPartial('_home_box', array(
            'box' => $box));
    ?>
    </div>
</div>