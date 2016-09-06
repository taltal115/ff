<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <link rel="stylesheet" type="text/css" href="/videogridengine/assets/233ee368/jui/css/base/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="/videogridengine/assets/bf7dff19/pager.css" />
        <script type="text/javascript" src="/videogridengine/css/fftheme/js/jquery.js"></script>
        <script type="text/javascript" src="/videogridengine/css/fftheme/js/flowplayer-3.2.6.min.js"></script>
        <script type="text/javascript" src="/videogridengine/css/fftheme/js/jquery_tinyscrollbar.pack.js"></script>
        <script type="text/javascript" src="/videogridengine/css/fftheme/js/videogridengine.js"></script>
        <script type="text/javascript" src="/videogridengine/css/fftheme/js/jquery.tmpl.js"></script>
        <script type="text/javascript" src="/videogridengine/css/fftheme/js/flowplayer-3.2.6.min.js  "></script>
        <title>Finding Footage Video Searching - Search</title>
        <script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "086adda6-4aac-4cee-bbdc-b87d90f733cc", doNotHash: false, doNotCopy: false, hashAddressBar: false,onhover: false});</script>

        <script type='text/javascript' src="http://findingfootage.com/ffrc/findingfootage/wp-includes/js/jquery/jquery.form.js?ver=2.73"></script>
        <script type="text/javascript" src="/videogridengine/css/fftheme/js/slide.js"></script>

        <link href="/videogridengine/css/fftheme/style.css" rel="stylesheet" type="text/css">
        <link href="/videogridengine/css/fftheme/tooltip.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/videogridengine/css/fftheme/ie7/skin.css"/>
        <link rel="stylesheet" type="text/css" href="/videogridengine/css/fftheme/tango/skin.css" />
        <link rel="stylesheet" type="text/css" href="/videogridengine/css/fftheme/ie7/skin.css" />
        <link rel="stylesheet" type="text/css" href="/videogridengine/css/fftheme/scrollbar.css" />

        <script type="text/javascript" src="/videogridengine/css/fftheme/js/cufon/cufon-yui.js"></script>
        <script type="text/javascript" src="/videogridengine/css/fftheme/js/cufon/Eras_Demi_ITC_400.font.js"></script>
        <script type="text/javascript" src="/videogridengine/css/fftheme/js/cufon/Eras_Bold_ITC_400.font.js"></script>
        <script type="text/javascript">
                Cufon.replace('h3, .sign-up', {fontFamily:'Eras Demi ITC'});
                Cufon.replace('.bolg-title, .bolg-right-title, h2', {fontFamily:'Eras Bold ITC'});
        </script>
        <script type="text/javascript" src="http://www.findingfootage.com/ffrc/findingfootage/videogridengine/css/fftheme/js/jquery.tinysort.min.js"></script>

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
  
  
  
        <link type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/jquery-ui.css" rel="Stylesheet" />
        <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/js/main_1.js"></script>
        <script type="text/javascript">
            
           var playerVar="http://<?php echo $_SERVER['HTTP_HOST']?>/ffrc/findingfootage/videogridengine/css/fftheme/player/flowplayer-3.2.7.swf";

        </script>
        
        <link rel="stylesheet" type="text/css" href="/videogridengine/css/fftheme/search.css" />
    </head> 
    <body>
 
<div class="video-list">
    <div id="Allcontainer" class="video-container">
        
        <div id="Allscroll" class="scrollbar" >
            <div class="track">

                <div class="thumb">
                    <div class="end"></div>  
                </div>

            </div>
        </div>

        <div class="videos viewport">
    
            
            <div id="Allloader" class="loading" style="text-align: center;margin-top: 30%;">
                <p>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/fftheme/images/loader.gif" />
                </p>
            </div>
            
            
            <ul id="AllThumb" class="videos-containers overview">
             

            </ul>
        </div>
    </div>
</div>
                
<script id="videoTemplate" type="text/x-jquery-tmpl"> 
    <li class="video" id="${videoServiceId}">
        <div class="img"  id="${videoFlvURL}" title=""> 
            <a target='_blank' onclick='openVideoDetailDialog("<?php echo CHtml::normalizeUrl(Yii::app()->createUrl('videodetail/videodetail')); ?>","${videoServiceId}");'>
                <img  src="${thumbURL}" onmouseover="imagePreview()" class="${videoServiceId}"  title=""   />
            </a>
        </div>

        <div class="options">
            <table border="0" cellspacing="1" cellpadding="5">
                <tr>
                    <td>
                        <a class="fav" 
                           onclick='openAddFavDialog("${videoServiceId}")'
                           title="" 
                           rel="" 
                           href="#"/>
                    </td>
                    <td>
                        <span  
                            id="${videoServiceId}_share" 
                            class="st_sharethis_custom" 
                            st_url=${videoDollor}"
                            st_title=${videoName}"
                            st_image=${thumbURL}"
                            st_summary="Sharing is great! Its fun to share Videos from www.findingfootage.com">
                        </span>
                    </td>
                    <td> 
                        <a class="dollar" target="_blank" 
                           href="${videoDollor}"
                           ></a> 
                    </td>
                    <td>
                        <a target='_blank'
                           class="info" 
                           onclick='openVideoDetailDialog("<?php echo CHtml::normalizeUrl(Yii::app()->createUrl('videodetail/videodetail')); ?>","${videoServiceId}");'
                           >
                        </a>
                    </td>
                    <td>                                              
                    </td>
                    <td style="padding-left:2px"><input
                            class="thumb_checkBox"
                            id="${videoServiceId}_checkbox"
                            type="checkbox" />
                    </td>
                </tr>
            </table>

        </div>
    </li>
</script>

<script type="text/javascript">
    //Creating Object for Pagination
    servicPanelAll =
    {
        //sortOrder : undefined,
        searchText : '',
        searchType : 'All',
        items_per_page : '10',
        current_page : '1'
    }
        
     $(document).ready(function() {
        // Handler for .ready() called.
        var text = '<?= Yii::app()->request->getQuery('searchKeywords'); ?>';  
        if(StartSearch)
            StartSearch(text); 
        /*
        setTimeout(function(){ 
            StartSearch(text);  
        }, 3000);
        */ 
    });
    function StartSearch(text)
    {
        if(typeof servicPanelAll !== 'undefined') {
            servicPanelAll.searchText = text;
            submitAjaxRequest(servicPanelAll,servicPanelAll.searchType,'');
        } 
    }  
</script>
</body>
<?
     Yii::app()->end();
 ?>




