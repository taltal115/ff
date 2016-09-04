
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title> </title>
        <meta name="Author" content="Stu Nicholls" />


    
   <style type="text/css">


a {color:#000;}
a:hover {text-decoration:none;}
a:visited {color:#000;}

/* slides styling */

.photo {width:635px; text-align:left; position:relative; margin:0 auto;}

.photo ul.topic {padding:0; margin:0; list-style:none; width:635px; height:auto; position:relative; z-index:10;}

.photo ul.topic li {display:block; width:125px; height:31px; float:left;}
.photo ul.topic li a.set {display:block; font-size:11px; width:124px; height:30px; text-align:center; line-height:30px; color:#000; text-decoration:none; border:1px solid #fff; border-width:1px 1px 0 0; background:#ccc; font-family:verdana, arial, sans-serif;}

.photo ul.topic li a ul, 
.photo ul.topic li ul 
{display:none;}

.photo ul.topic li.active a
/*{color:#000; background:#bbb;}*/
{color:#000; background:#803CAD;}

.photo ul.topic li a:hover,
.photo ul.topic li:hover a
/*{color:#fff; background:#aaa;}*/
{color:#fff; background:#803CAD;}
.photo ul.topic li.active ul
/*{display:block; position:absolute; left:0; top:31px; list-style:none; padding:0; margin:0; height:375px; background:#ddd; width:464px; padding:40px 60px; border:20px solid #bbb; z-index:1;}*/
{display:block; position:absolute; left:0; top:31px; list-style:none; padding:0; margin:0; height:auto; background:#000000; width:464px; padding:40px 60px; border:20px solid #803CAD; border-radius:25px; z-index:1;}

.photo ul.topic li a:hover ul, 
.photo ul.topic li:hover ul
/*{display:block; position:absolute; left:0; top:31px; list-style:none; padding:0; margin:0; height:375px; background:#ddd; width:464px; padding:40px 60px; border:20px solid #aaa; z-index:100;}*/
{display:block; position:absolute; left:0; top:31px; list-style:none; padding:0; margin:0; height:auto; background:#000000; width:464px; padding:40px 60px; border:20px dotted #803CAD; border-radius:25px; z-index:100;}

.photo ul.topic li ul li
{display:inline; width:112px; height:87px; float:left; border:1px solid #fff; margin:1px;}

.photo ul.topic li ul li a
{display:block; width:110px; height:85px; cursor:default; float:left; text-decoration:none; background:#444; border:1px solid #888;}

.photo ul.topic li ul li a img
{display:block; width:100px; height:75px; border:5px solid #eee;}

.photo ul.topic li a:hover ul li a:hover, 
.photo ul.topic li:hover ul li a:hover 
{white-space:normal; position:relative;}

/*.photo ul.topic li a:hover ul li a:hover img, 
.photo ul.topic li:hover ul li a:hover img 
{position:absolute; left:-50px; top:-32px; width:200px; height:150px; border-color:#fff;}*/
</style>

        <script src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/flowplayer-3.2.6.min.js" type="text/javascript"></script>    
 <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery.js"></script>
    <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery-ui.min.js"></script>
    <link type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/jquery-ui.css" rel="Stylesheet" />

<script type="text/javascript">

   var playerVar="http://<?php echo $_SERVER['HTTP_HOST']?>/findingfootage/videogridengine/css/fftheme/player/flowplayer-3.2.7.swf";

    $(document).ready(function () {
         
        $f("videoBox", playerVar , '');

    });
     
        function mIn(videoURL){
               
         var x =window.XPOS;
         var y =window.YPOS;
    //$f("videoBox", playerVar , videoURL);
    
      $f("videoBox", playerVar, {
    clip: {
        url: videoURL,
        autoPlay: true,
        autoBuffering: true
    },
    plugins: {
        controls: null
    },
    onLoad: function(){
        //alert("player loaded");
    }
});
      $('#videoplayer').attr('href', videoURL);
          $("#videoBox" ).dialog({ height: 260, width: 320 });
          $("#videoBox").dialog( "option", "position", [x,y]);
          
        // $('#videoBox').dialog({ show: "fade", hide: "fade" });
         $(".ui-dialog-titlebar").hide();
         
          $("#videoBox").dialog("open");
         return false;
    
}


          function mOut(){
      
            $('#videoBox').dialog('close');
            return false;
}

</script>

    </head>

    <body>


        <div class="photo">
            <ul class="topic">


                <li class="active"><a class="set" href="#">Foundbox Videos</a>
                <!--[if lte IE 6]><table><tr><td><![endif]-->
                    <ul>

                        <?php
                        $username = "root";
                        $password = "root";
                        $database = "findingfootage";
                         $foundboxId = $_GET["foundboxId"];                    
                        mysql_connect("localhost", $username, $password);
                        @mysql_select_db($database) or die("Unable to select database");
                        $query = "SELECT * FROM wp_foundboxvideos where wp_foundbox_id= '" . $foundboxId . "'";
                        $result = mysql_query($query);

                        $num = mysql_numrows($result);

                        mysql_close();


                        $i = 0;
                        while ($i < $num) {

                            $id = mysql_result($result, $i, "id");
                            $title = mysql_result($result, $i, "title");
                            $description = mysql_result($result, $i, "description");
                            $vid_src_url = mysql_result($result, $i, "vid_src_url");
                            $vid_flv_path = mysql_result($result, $i, "vid_flv_path");
                            $vid_src_id = mysql_result($result, $i, "vid_src_id");
                            $vid_thumb_url = mysql_result($result, $i, "vid_thumb_url");
                            ?>


                            <li><a href="#"><img src="<?php echo "$vid_thumb_url" ?>" onmouseover='mIn("<?php echo $vid_flv_path ?>")' onmouseout="mOut()" alt="<?php echo "$title" ?>" title="<?php echo "$title" ?>" /></a></li>
<!--                            <li><img id="widgetthumb" src="<?php echo "$vid_thumb_url" ?>" onmouseover='mIn("<?php echo $vid_flv_path ?>")' onmouseout="mOut()" alt="<?php echo "$title" ?>" title="<?php echo "$title" ?>" /></li>-->

                            <?php
                            $i++;
                        }
                        ?>
                    </ul>
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                </li>


            </ul>
             <div id="videoBox" style="display:none;" title="">
        video will be here
    </div>
            <br class="clear" />
        </div>


    </body>
</html>
