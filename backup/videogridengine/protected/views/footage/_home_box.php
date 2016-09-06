
<?

if (isset($box)) {
    if($box->id > 0){
        $foundboxTitle = $box->title;   
        $foundboxId = $box->id;
        $limit = 30;
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
                    <?/* -- NOT IN USE -- <a href="javascript:void(0)" title="<?php echo $title;?>" onClick="window.open('<?php echo $vid_src_url; ?>', '_blank', 'location=yes,height=580,width=820,top=70,left=600, scrollbars=yes,status=yes');" target="" class="img" id="<?php echo $vid_flv_path ?>"><img class="mini" width="65px" height="65px" src="<?php echo $vid_thumb_url ?>" alt="gallery thumbnail" /></a>*/?> 
                    <a href="videogridengine/index.php/foundboxesvideos/index/<?=$foundboxId?>" title="<?php echo $title;?>" target="" class="img" id="<?php echo $vid_flv_path ?>"><img class="mini" width="65px" height="65px" src="<?php echo $vid_thumb_url ?>" alt="gallery thumbnail" /></a>
                </li>
            <?
            }  
        } 
        ?>
    </ul> 
</div>