

<html>
    <head>
        
   
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/flowplayer-3.2.6.min.js" type="text/javascript"></script>    
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery.js"></script>
    <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery-ui.min.js"></script>
    
    <link type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/jquery-ui.css" rel="Stylesheet" />

    

<script type="text/javascript">

   var playerVar="http://<?php echo$_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/player/flowplayer-3.2.7.swf";

    $(document).ready(function () {
         
        $f("videoBox", playerVar , '');

    });
     
        function mIn(videoURL){
               
             var x =150;//window.XPOS;
             var y =500;//window.YPOS-window.pageYOffset+50;
    
    
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
          $("#videoBox" ).dialog({ height: 140, width: 220 });
          $("#videoBox").dialog( "option", "position", [y,x]);
          
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

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/main.js"></script>



        <style type="text/css">
        #sthoverbuttons { 
                z-index: 1 !important;
        }
   
            #gallery {
/*                float: right;*/
                border: 10px solid #803CAD;
                height: auto;
                width: 95%;
                margin-left: auto;
                margin-right: auto;
                overflow: visible;
                background: #d3d3d3;
                /* box shadow effect in Safari and Chrome*/
                -webkit-box-shadow: #272229 10px 10px 20px;
                /* box shadow effect in Firefox*/
                -moz-box-shadow: #272229 10px 10px 20px;
                /* box shadow effect in IE*/
                filter: progid:DXImageTransform.Microsoft.Shadow(color='#272229', Direction=135, Strength=10);     
                /* box shadow effect in Browsers that support it, Opera 10.5 pre-alpha release*/
                 box-shadow: #272229 10px 10px 20px;
            
            }
          
		  
            #gallery ul{
               /* This position the ul content in the middle of the gallery*/
/*               margin-left:0px; */
            }
       
       
            #gallery ul li {
                /* In order to create the proper effect with hover we should use display inline-table
                    This will display the big picture right next to its thumbnail
                */
                list-style:none; display:inline-table; padding:2px;
            }
                 
               #gallery ul li .mini{
            	width: 65px;
            	height:65px;

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
            
            /* This is the pic to display when the hover action occur over the li that contains the thumbnail  */
/*            #gallery ul li .pic{
                 Animation with transition in Safari and Chrome 
               -webkit-transition: all 0.6s ease-in-out;
                Animation with transition in Firefox (No supported Yet) 
               -moz-transition: all 0.6s ease-in-out;
                Animation with transition in Opera (No supported Yet)
               -o-transition: all 0.6s ease-in-out;
                 The the opacity to 0 to create the fadeOut effect
               opacity:0;
               visibility:hidden; 
               position:absolute; 
               margin-top:10px; 
               margin-left:0px; margin-right: auto;
               border:1px solid black;
                box shadow effect in Safari and Chrome
               -webkit-box-shadow:#272229 2px 2px 10px;
                 box shadow effect in Firefox
               -moz-box-shadow:#272229 2px 2px 10px;
                box shadow effect in IE
               filter:progid:DXImageTransform.Microsoft.Shadow(color='#272229', Direction=135, Strength=5);
                  box shadow effect in Browsers that support it, Opera 10.5 pre-alpha release
               box-shadow:#272229 2px 2px 10px;
                float:right;
            }*/
            

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
                margin-left: 100px;
            }
               #preview{
  position:absolute;
   z-index:999;
/*  width:50px;
    height:50px;*/
  border:1px solid #ccc;
  background:#333;
  padding:5px;
  display:none;
  color:#fff;
    border-radius:8px;
        width: 220px;
        height: 180px;
        float: right;
       
  } 
        #preview img{  
        width: 200px;
        height: 200px;
        }
                
        </style>
  
    </head>

    <body>

<script type="text/javascript">stLight.options({publisher: "72d16b20-e6f2-4082-8f6a-88b2b96c919e"});</script>
<script>
var options={ "publisher": "72d16b20-e6f2-4082-8f6a-88b2b96c919e", "position": "left","z-index": "-1 !important", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "googleplus", "linkedin"]}};
var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>
<!--<div id="dialog1" title="">
            <p>This dialog using 'slide/explode' methods to show/hide, plus, can be closed by 'close' button, by 'x' icon and by 'esc' button. This dialog window can be moved using mouse.</p>
        </div>-->
<!--<div class="video" style="background-image:url(images/splash_01.jpg)">
        <a href="#" rel="#orel">
            <img src="images/play.png" alt="play" title="play" border="0">
        </a>
       
    </div>-->
    
    <script language="JavaScript">
        $(function() {
          
           $("a[rel]").overlay({
            
            effect: 'apple',		
		    expose: '#111',				
		
            onLoad: function(content) {
                this.getOverlay().find("a.player").flowplayer(0).load();
            },
		
            onClose: function(content) {
                $f().unload();
            }
        });				
	
	// install flowplayers
	$("a.player").flowplayer("http://<?php echo $_SERVER['HTTP_HOST/']?>/ffrc/findingfootage/videogridengine/css/fftheme/player/flowplayer-3.2.7.swf"); 
        });  
    </script>

    

    <div id="gallery">
        <ul>
                        <?php
                        $username = "findingf_beta";
                        $password = "Dacoders0333";
                        $database = "findingf_ff";
                         $foundboxId = $_GET["foundboxId"];                    
                        mysql_connect("localhost", $username, $password);

                      /*  $username = "root";
                        $password = "root";
                        $database = "findingfootage";
                         $foundboxId = $_GET["foundboxId"];                    
                        mysql_connect("localhost", $username, $password); */
                        @mysql_select_db($database) or die("Unable to select database");
//                        $query = "SELECT * FROM wp_foundboxvideos where wp_foundbox_id= '" . $foundboxId . "'";
                        $query = "SELECT * FROM wp_foundboxvideos where wp_foundbox_id= '" . $foundboxId . "'Limit 0,12";
                        $result = mysql_query($query);

                        $num = mysql_numrows($result);

                        mysql_close();


                        $i = 0;
                        while ($i < $num) {
//                        while ($i < $num) {

                            $id = mysql_result($result, $i, "id");
                            $title = mysql_result($result, $i, "title");
                            $description = mysql_result($result, $i, "description");
                            $vid_src_url = mysql_result($result, $i, "vid_src_url");
                            $vid_flv_path = mysql_result($result, $i, "vid_flv_path");
                            $vid_src_id = mysql_result($result, $i, "vid_src_id");
                            $vid_thumb_url = mysql_result($result, $i, "vid_thumb_url");
                            ?>

<!--<li>
     <a href="#" rel="#orel<?php echo $id ?>">
         
    <img src="<?php echo $vid_thumb_url ?>" class="mini" width="100" height="100" alt="" /><img src="<?php echo $vid_thumb_url ?>" class="pic"  />
                  </a>
    <div id="orel<?php echo $id ?>" class="overlay" style="position: absolute; height:220px;width:320px;"><a href="<?php echo $vid_flv_path; ?>" class="player"></a></div>
   
</li>-->

<!--<li>
     <a href="#" rel="#orel<?php echo $id ?>">
         
    <img src="<?php echo $vid_thumb_url ?>" class="mini" width="100" height="100" alt="" />
                  </a>
    <div id="orel<?php echo $id ?>" class="overlay" style="position: absolute; height:220px;width:320px;"><a href="<?php echo $vid_flv_path; ?>" class="player"></a></div>
   
</li>-->
  <a href="<?php echo $vid_flv_path ?>" class="preview"><img class="mini" width="50" height="50" src="<?php echo $vid_thumb_url ?>" alt="gallery thumbnail" /></a>
   <!-- <img src="<?php echo $vid_thumb_url ?>" onmouseover='mIn("<?php echo $vid_flv_path ?>")' onmouseout="mOut()" class="mini" width="50" height="50" alt="" /> -->

   
  <!--  <img src="<?php echo $vid_thumb_url ?>" onmouseover='mIn("<?php echo $vid_flv_path ?>")' onmouseout="mOut()" class="mini" width="50" height="50" alt="" />  -->

 </li>


                            <?php
                            $i++;
                        }
                        ?>
            

<!--</div>-->
        </ul>
    </div>
     <div id="videoBox" style="display:none; margin-left: 100px" title="">
        video will be here
    </div>

  
    

    </body>
</html>