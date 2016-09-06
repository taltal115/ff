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
 
<div id="txthome2" class="home_content">
	<?php 
        if (have_posts()) : while (have_posts()) : the_post(); 
            endwhile;
        endif; 
    ?>
    
    
    <?php  the_content(); ?>
	
    <iframe style="border: none; background: #fff; overflow: hidden; width: 292px; height: 258px;" src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FFindingFootage&amp;width=292&amp;height=258&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=false" frameborder="0" scrolling="no" width="320" height="240"></iframe>
</div>

<style type="text/css">
   
    #gallery {
/*        margin: 0 auto;
        height: 200px   ;
        width: 66%;
        margin-left: auto;
        margin-right: auto;
        overflow-y: visible;
        filter: progid:DXImageTransform.Microsoft.Shadow(color='#272229', Direction=135, Strength=10);     */
        /*height: 520px;*/
        margin: 0 auto;
        /*overflow-y: scroll;*/
        overflow: hidden;
        width:76%;
    }

    

    /* This is the pic to display when the hover action occur over the li that contains the thumbnail  */
    #gallery ul li .mini{
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
        /*filter:progid:DXImageTransform.Microsoft.Shadow(color='#272229', Direction=135, Strength=5); */
        /* box shadow effect in Browsers that support it, Opera 10.5 pre-alpha release*/
        box-shadow:#272229 2px 2px 10px;
    }


    #gallery ul li .mini:hover{
        cursor:pointer;
    }


    /* This create the desired effect of showing the imagen when we mouseover the thumbnail*/
    #gallery ul li:hover .pic {
        /* width and height is how much the picture is going to growth with the effect */
        width:200px; 
        height:200px;
        opacity:1; 
        visibility:visible; 
        float:right;
    }
    #preview{
        position:absolute;
        z-index:999;
        width:50px;
        height:50px;
        border:1px solid #ccc;
        background:#333;
        padding:5px;
        display:none;
        color:#fff;
        border-radius:8px;
        width: 310px;
        height: 174px;
    } 
    #preview img{  
        width: 200px;
        height: 200px;
    }

    .loading {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 30%;
        left: 45%;
    }
</style>



<div id="homefboxwidget"  style="width:55%; height:180px; float: right;">
      
    <div id="gallery">
        <div id="loading" style="display: none;"><img style="display: block;margin-top: 20px; margin-left: auto; margin-right: auto;" src='/videogridengine/css/fftheme/images/loader.gif'></div>
        <?
        $urlFreeClips = home_url("/videogridengine/index.php/footage/FreeClipsHtml");
        $urlHomeBox = home_url("/videogridengine/index.php/footage/HomeBoxsHtml");
        ?>
        <div id="freeclips">
            <? print_r(file_get_contents($urlFreeClips));?>      
        </div>         
        <div id="foundboxs">
            <? print_r(file_get_contents($urlHomeBox));?>    
        </div>
        <script type="text/javascript">
            var m_HomeBoxTotal = <?=file_get_contents("$urlHomeBox?index=-1");?>;
            var m_HomeBoxIndex = 0;
            
            $( document ).ready(function() {
                //getBoxHtml(urlFreeClips + "?index=0",idFreeClips);
                //getBoxHtml(urlHomeBox + "?index=0",idHomeBox); 
                //m_HomeBoxTotal = getData(urlHomeBox + "?index=-1")
            });
            
            
            function loadHomeBox(action) {
                var url = "/videogridengine/index.php/footage/HomeBoxsHtml";
                var id = "foundboxs";  
                if(action == "prevous") {
                    m_HomeBoxIndex--;
                    if(m_HomeBoxIndex < 0)
                        m_HomeBoxIndex = m_HomeBoxTotal-1;
                }
                else if(action == "next"){
                    m_HomeBoxIndex++;
                    if(m_HomeBoxIndex >= m_HomeBoxTotal)
                        m_HomeBoxIndex = 0;
                }     
                url += "?index=" + (m_HomeBoxIndex)
                loadData(url,id); 
            }
        </script>
        
    </div>
    <div id="videoBox" style="display:none;" title="">
        video will be here
    </div>
    
<!-- ----------------------- END OF REPLACEMENT OF FRAME -------------------- -->

</div>



<?php get_footer('ff'); ?>

