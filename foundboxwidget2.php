

<html>
    <head>

<!--        <script src="http://--><?php //echo $_SERVER['HTTP_HOST'] ?><!--/ffrc/findingfootage/videogridengine/css/fftheme/js/flowplayer-3.2.6.min.js" type="text/javascript"></script>    -->
<!--        <script type="text/javascript" src="http://--><?php //echo $_SERVER['HTTP_HOST'] ?><!--/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery.js"></script>-->
        <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery-ui.min.js"></script>
        <link type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/ffrc/findingfootage/videogridengine/css/fftheme/jquery-ui.css" rel="Stylesheet" />
        <script type="text/javascript">
            var playerVar="http://<?php echo $_SERVER['HTTP_HOST'] ?>/ffrc/findingfootage/videogridengine/css/fftheme/player/flowplayer-3.2.7.swf";
        </script>

        <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/ffrc/findingfootage/videogridengine/css/fftheme/js/main_1.js"></script>

        <!--------------------------  eND FOR VIDEO THUMBNAILS ---------------------------------->



        <script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>


        <style type="text/css">
            #sthoverbuttons { 
                z-index: 1 !important;
            }

            #gallery {
                height: 390;
                width: 75%;
                margin-left: 100px;
                margin-right: auto;
                overflow: hidden;
                filter: progid:DXImageTransform.Microsoft.Shadow(color='#272229', Direction=135, Strength=10);     
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
                border:1px solid #ccc;
                background:#333;
                padding:5px;
                display:none;
                color:#fff;
                border-radius:8px;
                width: 240px;
                height: 200px;
                float: right;
                margin-left: -200px;
                margin-top: 20px;

            } 
            #preview img{  
                width: 200px;
                height: 200px;

            }
            .preview img{
                border: 1px solid #000000;
                box-shadow: 2px 2px 10px #272229;

            }


        </style>

    </head>

    <body>

        <script type="text/javascript">stLight.options({publisher: "72d16b20-e6f2-4082-8f6a-88b2b96c919e"});</script>
        <script>
            var options={ "publisher": "72d16b20-e6f2-4082-8f6a-88b2b96c919e", "position": "left","z-index": "-1 !important", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "googleplus", "linkedin"]}};
            var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
        </script>
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
                $("a.player").flowplayer("http://<?php echo $_SERVER['HTTP_HOST/'] ?>/ffrc/findingfootage/videogridengine/css/fftheme/player/flowplayer-3.2.7.swf"); 
            });  
        </script>



        <div id="gallery">
            <ul>
                <?php
                $username = "'findingf_live";
//                $username = "'root";
                $password = "'D@coders0333";
//                $password = "'1q2w3e4r";
//                $database = "findingf_live";
                $database = "findingf_tal";

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
                    <li>
                        <a href="javascript:void(0)" onClick="window.open('<?php echo $vid_src_url; ?>', '_blank', 'location=yes,height=580,width=820,top=70,left=600, scrollbars=yes,status=yes');" target="_blank" class="img" id="<?php echo $vid_flv_path ?>">
                            <img class="mini" width="50" height="50" src="<?php echo $vid_thumb_url ?>" alt="gallery thumbnail" /></a>
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