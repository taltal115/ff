<style>
    #videos .box_category {
        position: relative;
        top: -43px;
        left: 5px;
        color: #fff;
        font-weight: bold;
        background: rgba(51, 51, 51, 0.54);
        height: 40px;
        margin: 0 -5px;
        width: 150px;
        line-height: 2.5;
    }
    
</style>
<?php

if (isset($box)) {
    if($box->id > 0){
        $foundboxTitle = $box->title;
        $foundboxId = $box->id;
        $limit = 1;
        $condition = "wp_foundbox_id = $box->id";
        $criteria = new CDbCriteria(array(
            'condition' => $condition,
            'limit' => $limit
        ));
        $boxVideos = Foundboxvideos::model()->findAll($criteria);
    }
}
?>
<div id="videos">
    <ul>
        <li>
            <a href="videogridengine/index.php/foundboxesvideos/index/238" title="" target="" class="img" id="http://st.depositphotos.com/1795861/1635/v/450/depositphotos_16351095-Time-Lapse-of-LA-Downtown-Buildings-and-Freeway-Los-Angeles.mp4">
                <img class="mini" width="150px" height="150px" src="http://st.depositphotos.com/1795861/1635/v/110/depositphotos_16351095-Time-Lapse-of-LA-Downtown-Buildings-and-Freeway-Los-Angeles.jpg" alt="gallery thumbnail">
                <p class="box_category">Timelapse cities</p>
            </a>
        </li>
        <li>
            <a href="videogridengine/index.php/foundboxesvideos/index/241" title="" target="" class="img" id="http://thumbs.dreamstime.com/videothumb_4120/41203623.flv">
                <img class="mini" width="150px" height="150px" src="http://thumbs.dreamstime.com/m/botanical-garden-k-kiev-dslr-raw-quality-time-lapse-41203623.jpg" alt="gallery thumbnail">
                <p class="box_category">4K footage</p>
            </a>
        </li>
        <li>
            <a href="videogridengine/index.php/foundboxesvideos/index/253" title="" target="" class="img" id="https://sstatic.fotolia.com/jpg/00/65/99/27/400_F_65992789_p6XAwLMFBegeqiSweuSVqExIT5qy849n.flv">
                <img class="mini" width="150px" height="150px" src="https://t2.ftcdn.net/jpg/00/65/99/27/110_F_65992789_p6XAwLMFBegeqiSweuSVqExIT5qy849n.jpg" alt="gallery thumbnail">
                <p class="box_category">Sun rising</p>
            </a>
        </li>
        <li>
            <a href="videogridengine/index.php/foundboxesvideos/index/257" title="" target="" class="img" id="http://d3macfshcnzosd.cloudfront.net/000526868_prev_l.flv">
                <img class="mini" width="150px" height="150px" src="http://d3thflcq1yqzn0.cloudfront.net/000526868_icon.jpeg" alt="gallery thumbnail">
                <p class="box_category">Spring Autumn</p>
            </a>
        </li>
        <li>
            <a href="videogridengine/index.php/foundboxesvideos/index/316" title="" target="" class="img" id="http://thumbs.dreamstime.com/videothumb_4320/43207961.mp4">
                <img class="mini" width="150px" height="150px" src="http://thumbs.dreamstime.com/m/th-july-independence-day-full-hd-43207961.jpg" alt="gallery thumbnail">
                <p class="box_category">4th of July - Independence day</p>
            </a>
        </li>
    </ul> 
</div>