

<?php
$this->breadcrumbs=array(
	'Widgets'=>array('/widgets'),
	'Getwidgetdata',
);

  
$JsonData=stripslashes($VideoJson);
$JsonArray=CJSON::decode($JsonData);
//var_dump($JsonData);


//foreach ($JsonArray as $FoundBoxVideo) {
//
//  echo "video id=".  $FoundBoxVideo['id'];
//  echo "video url=".    $FoundBoxVideo['vid_src_url'];
//  echo "video vid_flv_path=".    $FoundBoxVideo['vid_flv_path'];
//  echo "video vid_src_id=".    $FoundBoxVideo['vid_src_id'];
//  echo "video vid_thumb_url=".    $FoundBoxVideo['vid_thumb_url'];
//    
//}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<!--<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">-->
<head>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/widgetstyles/main.css ?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        
    function getEmbededSource1(foundboxid){
        
            document.getElementById("embedSource1").value="<iframe src='http://localhost/findingfootageproject1/findingfootage/FoundboxWidget1.php?foundboxId="+foundboxid+"' width='700px' height='550px'  />";
            document.getElementById("embedSource1").style.visibility="visible";
    }
      function getEmbededSource2(foundboxid){
        
            document.getElementById("embedSource2").value="<iframe src='http://localhost/findingfootageproject1/findingfootage/FoundboxWidget2.php?foundboxId="+foundboxid+"' width='700px' height='550px'  />";
            document.getElementById("embedSource2").style.visibility="visible";
    }
    
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

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

.photo ul.topic li a:hover ul li a:hover img, 
.photo ul.topic li:hover ul li a:hover img 
{position:absolute; left:-50px; top:-32px; width:200px; height:150px; border-color:#fff;}


/*div.gallery
{display:block; position:absolute; left:0; top:31px; list-style:none; padding:0; margin:0; height:375px; background:#ddd; width:464px; padding:40px 60px; border:20px solid #bbb; z-index:1;}
{display:block; position:absolute; background:#000000; border:50px solid #803CAD; border-radius:25px; z-index:1;}*/
  
#gallery {
                border: 10px solid #803CAD;
                height: auto;
                width: 600px;
                margin-left: auto;
                margin-right: auto;
                overflow: visible;
                background: #272229;
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
               margin-left:50px; 
            }
       
       
            #gallery ul li {
                /* In order to create the proper effect with hover we should use display inline-table
                    This will display the big picture right next to its thumbnail
                */
                list-style:none; display:inline-table; padding:10px;
            }
                 
                 
            /* This is the pic to display when the hover action occur over the li that contains the thumbnail  */
            #gallery ul li .pic{
                /* Animation with transition in Safari and Chrome */
               -webkit-transition: all 0.6s ease-in-out;
               /* Animation with transition in Firefox (No supported Yet) */
               -moz-transition: all 0.6s ease-in-out;
               /* Animation with transition in Opera (No supported Yet)*/
               -o-transition: all 0.6s ease-in-out;
                /* The the opacity to 0 to create the fadeOut effect*/
               opacity:0;
               visibility:hidden; 
               position:absolute; 
               margin-top:10px; 
               margin-left:-20px; 
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
            }
</style>

</head>

<body>

  
<div class="photo" style="display:none">
<ul class="topic">
<li class="active"><a class="set" href="#">Foundbox Videos</a>
	<!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul>
			
                        <?php
                        foreach ($JsonArray as $FoundBoxVideo) {
                            
                        ?>
                    <li><a href="#"><img src="<?php echo $FoundBoxVideo['vid_thumb_url'];?>" alt="<?php $FoundBoxVideo['id'] ?>" title="<?php $FoundBoxVideo['id'] ?>" /></a></li>
                    <?php
    
}//end loop
                            ?>
                   <textarea id="embedSource1" rows="8px" cols="60px" style="visibility:hidden;"></textarea>
		</ul>

	<!--[if lte IE 6]></td></tr></table></a><![endif]-->
	</li>
           
<a href="#" onClick="getEmbededSource1('<?php echo $FoundBoxVideo['wp_foundbox_id']?>');">Get This Widget</a>

</ul>
    
<br class="clear" />

<!--   <div class="gallery">
       <header tabindex="0">
           Foundbox Videos
        </header>
     
        <?php
            $count=0;
                        foreach ($JsonArray as $FoundBoxVideo) {
                          $count++;
                        ?>
            <a tabindex="<?php echo $count ?>">
                <img src="<?php echo $FoundBoxVideo['vid_thumb_url']; ?>"/></a>
            <?php
    
}//end loop
                            ?>
<textarea id="embedSource2" rows="8px" cols="60px" style="visibility:hidden;"></textarea>
   </div>-->

</div>
<div id="containerbase">
<div id="container">
<div class="p5h18px"><!-- --></div><div style="padding:0 0 0 18px;"><div class="box" style="margin-bottom:0;"><div class="inner" style="padding-bottom:16px;"><table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
<tr><td style="width:50%;"><h1 style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:22px">Spread the Word About pond5 and Earn Money</h1><br />
<p style="color:#000; padding:10px 10px 10px 5px; line-height:22px">The referral program is easy and worthwhile for all users of findingfootage.com. Simply place one of the following links to findingfootage.com on your website, and anyone who follows that link will be considered your referral.</p>
<p  style="color:#000; padding:10px 10px 10px 5px; line-height:22px">If the user signs up, you will receive 5% of all the sales and 5% of all the purchases the new user makes during their first year. With your help, findingfootage's community can continue to grow, which means more content and more potential buyers.</p></td><td><img alt="pedagogic image" src="../../css/fftheme/images/add.jpg" /></td></tr></table></div></div></div><div id="forum" style="font-weight: bold;"><div class="box"></div></div></div></div>

     <div id="gallery" style="width:800px">
         <div style="float:right">
<a href="#" onClick="getEmbededSource2('<?php echo $FoundBoxVideo['wp_foundbox_id']?>');" style="border:0px solid red; padding:7px; background:#803cad; color:#fff; text-decoration:none; font-weight:bold">Get This Widget</a>
</div>
        <ul style="margin-left:22px">
             <?php
        
                        foreach ($JsonArray as $FoundBoxVideo) {
                     
                        ?>
            <li style="padding:40px 10px 10px 10px;">
                    <img src="<?php echo $FoundBoxVideo['vid_thumb_url']; ?>" class="mini" width="100" height="100" alt="" /><img src="<?php echo $FoundBoxVideo['vid_thumb_url']; ?>" class="pic"  />
                </li>
            <?php
    
}//end loop
                            ?>
        </ul>
     

<textarea id="embedSource2" rows="2px" cols="97px" style="visibility:hidden;"></textarea>
 </div>
</body>
</html>
