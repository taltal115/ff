<?php
/*
 * Template Name: Finding Home Page
 *
 * A custom page template without sidebar.
 *
 * @package BuddyPress
 * @subpackage BP_Default
 * @since 1.5
 */

get_header('ff');
?>

<div id="homefboxwidget" style="width: 100%;top: 0;position: absolute;float: right;">
    <div id="mainWrapper">
        <a href="<?php echo home_url( '/index.php' ); ?>">
            <div id="logoImage"></div>
        </a>
<!--        <img src="http://localhost/wp-content/themes/fftheme/images/new/DesktopSlicing/home-banner.jpg" alt="">-->
        <video style="width: 100%;" playsinline autoplay muted loop id="bgvid">
            <source src="https://player.vimeo.com/external/178742158.hd.mp4?s=f0cbce173cac9ac85ca59b2a96d34fbafcc1d801&profile_id=119" type="video/mp4">
        </video>
    </div>
    <div class="FFsearch">
        <h1>Search for Stock Video</h1>
        <h4>Find Royalty Free footage from multiple websites</h4>
        <input id="searchItem" type="text" onBlur="this.value==''?this.value='Find Footage':''" onClick="this.value=='Find Footage'?this.value='':''" value="Find Footage" class="input-box"  onkeypress="return searchVideo(event)" title="Find Footage" />
        <div id="searchBTN" onclick="StartSearch($('#searchItem').val())">
            Search
        </div>
    </div>
    <div id="gallery">
        <div id="loading" style="display: none;"><img style="display: block;margin-top: 20px; margin-left: auto; margin-right: auto;" src='/videogridengine/css/fftheme/images/loader.gif'></div>
        <?php
        $urlFreeClips = home_url("/videogridengine/index.php/footage/FreeClipsHtml");
        $urlHomeBox = home_url("/videogridengine/index.php/footage/HomeBoxsHtml");
        ?>
        <div id="freeclips">
            <?php print_r(file_get_contents($urlFreeClips));?>
        </div>
        <div id="foundboxs">
            <?php print_r(file_get_contents($urlHomeBox));?>
        </div>
    </div>
    <div id="videoBox" style="display:none;" title="">
        video will be here
    </div>

    <!-- ----------------------- END OF REPLACEMENT OF FRAME -------------------- -->

</div>
<div class="clear"></div>
    <img id="midHomeImg" src="http://stage.findingfootage.com/wp-content/themes/fftheme/images/new/DesktopSlicing/keywords-bg.jpg" alt="">
<div id="txthome2" class="home_content">

    <?php
        if (have_posts()) : while (have_posts()) : the_post();
            endwhile;
        endif;
    ?>
    
    
    <?php  the_content(); ?>

<!--    <iframe style="border: none; background: #fff; overflow: hidden; width: 292px; height: 258px;" src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FFindingFootage&amp;width=292&amp;height=258&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=false" frameborder="0" scrolling="no" width="320" height="240"></iframe>-->
</div>


    <?php
        $tags = get_tags();
        $html = '<div class="post_tags">';
        foreach ( $tags as $tag ) {
            $tag_link = get_tag_link( $tag->term_id );

            $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
            $html .= "{$tag->name}</a>";
        }
        $html .= '</div>';
        echo $html;
        ?>


<?php get_footer('ff'); ?>