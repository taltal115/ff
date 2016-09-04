<!doctype html>
<html>
	<head >
        <meta name="description" content="Search Wisely Browse Widely - Footage Search Engine with Free clips from around the web / Royalty free footage and Video backgrounds">
        <meta name="keywords" content="Footage, video footage, free video footage, stock footage, royalty free, hd, vj, timelapse, 4k footage, free 4k footage, video, background, PowerPoint background, Keynote background, presentation background, motion background, loop, motion graphics ,visuals, background visuals, video search, footage search engine ">
        
        <!-- https://developers.facebook.com/tools/debug/og/object/ -->
        <meta property="og:title" content="Finding Footage" /> 
        <meta property="og:image" content="http://www.findingfootage.com/videogridengine/images/logo.png" /> 
        <meta property="og:description" content="gives you fast and easy access to multiple video stocks at once, and expand your results. join us to find dozens of free clips online..." /> 
    
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
        
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
        <link rel="shortcut icon" href="http://www.findingfootage.com/videogridengine/images/fficon.png?v=1" />

        <!-- ITSIK 30.06.2015 script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript" src="http://s.sharethis.com/loader.js"></script -->
 
        <link rel="stylesheet" href="/wp-content/themes/fftheme/style.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="/wp-content/themes/fftheme/bp-default.css" type="text/css" media="screen"/>
        <!-- link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" / -->

        
        
        <!-- script type="text/javascript"  src="/videogridengine/css/fftheme/js/cufon/cufon-yui.js"></script>
        <script type="text/javascript" src="/videogridengine/css/fftheme/js/cufon/Eras_Demi_ITC_400.font.js"></script -->
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
       
        <?php
        
        wp_head(); 
       
        ?>
 
        <script type="text/javascript">   
            function loadData(url, id, sync, type) { 
                var origHtml = $( "#"+id ).html();
                var async = true;
                if(sync) async = false;
                if(!type) type = "GET";
                $( "#"+id ).empty();
                $( "#"+id ).append( $( "#loading" ).html());
                
                $.ajax({
                    type: type,
                    async: async,
                    url: url,
                    data: ""
                })
                .done(function( html ) {
                    if(html != "") 
                        setBoxHtml(id,html);
                    else 
                        setBoxHtml(id,origHtml);
                })
                .fail(function( jqXHR, textStatus ,errorThrown) {
                    alert( "Request failed: " + errorThrown );
                    setBoxHtml(id,origHtml);
                });
                
                
            } 
            function getData(url) { 
                var data = "";
                
                $.ajax({
                    type: "GET",
                    async: false,
                    url: url,
                    data: ""
                })
                .done(function( html ) {
                    data = html;  
                })
                .fail(function( jqXHR, textStatus ,errorThrown) {
                    //alert( "Request failed: " + errorThrown );
                });
                
                return data;
            }
            function getBoxHtml(url,id) {
                var html = getData(url);  
                setBoxHtml(id,html);
            }
            function setBoxHtml(id,html) {
                if(html != "") {
                    $( "#"+id ).empty();
                    $( "#"+id ).append( html );
                }    
            }
            function searchVideo(e)
            {
                

                if (e.keyCode == 13) {
                    
                    var searchKeyword = document.getElementById("searchItem").value;

                    if(searchKeyword != "") {
                        StartSearch(searchKeyword);
                        return true;
                    }
                    else
                    {
                        var searchKeyword = document.getElementById("searchItem").value="Search";

                    }
                }

            }
            
            function StartSearch(text) {
                gotoUrl="/videogridengine/index.php/search?SearchBarForm%5BsearchKeywords%5D="+text;
                mainsite="<?php echo get_site_url(); ?>";
                //alert(gotoUrl);
                window.window.location.href=mainsite+gotoUrl+"&direction=h";
            }
        
            function SwapImage(ImageUrl,Control)
            {
                Control.src = ImageUrl;
              
            }
            
            $( document ).ready(function() {
                
                $("#open").click(function(){ 
                 $("div#iRPanel").slideDown("slow");
                 }); 
                 $("#close").click(function(){ 
                     $("div#iRPanel").slideUp("slow");
                 }); 
                 $("#toggle a").click(function () { 
                     $("#toggle a").toggle();
                 });
            });
              
        
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-57796105-1', 'auto');
          ga('send', 'pageview');

        </script>
        <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>   
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '605851989567219');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=605851989567219&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
	</head>
    
    <body class="ffbody">
        
        <div id="mask">
            <p>
            <!-- img width="100px" height="100px" src="<?php bloginfo( "template_url" ); ?>/images/loader.gif" / -->
        </p>
        </div>
            
        <div class="selector"></div>
        <?php //do_action( 'bp_before_header' ) ?>
        <div id="LoginSlider">
        <?
            $user = wp_get_current_user();
            print_r(file_get_contents(home_url("/videogridengine/index.php/footage/_home_login?user_id=".$user->id)));?>
        </div>
        <header><!-- Start header -->
            <div class="header-wrap">
                <div class="header-top">
                </div>
                <div class="logo-area">
                    <div class="header-area-left">
                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/ff.png" alt="ff" width="63" height="62"/></a>
                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/fi.png" align="fi" width="63" height="62"/></a>
                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/fa.png" align="fa" width="63" height="62"/></a>
                        <a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/fs.png" align="fs" width="63" height="62"/></a>
                    </div>
                    <div class="logo" style="padding-right:3%">
                        <a href="<?php echo home_url( '/index.php' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/logo.png" alt="logo" width="308" height="172" /></a>
                    </div>
                </div>
            </div>
            <?php // do_action( 'bp_header' ) ?>
        </header> <!-- End Of header -->
    <div class="clear"></div>
       <nav> <!-- Navigation  Convert this into Wordpress paging -->
            <div class="nav-wrap">
                <div class="nav-links-left">
                    <ul style="padding-left:1%">
                        <li class="links"><a href="<?php echo home_url( '/index.php' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/home-icon.png" alt="home" width="51" height="47" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/images/home-icon.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/images/home-icon-hv.png',this);"></a></li>
                        <li><a href="
                                <?php
                                    if (is_user_logged_in()) 
                                    {
                                        echo  home_url( '/videogridengine/index.php/user');
                                   }else
                                        {
                                            echo get_site_url() . '/wp-login.php';
                                        }?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/user-icon.png" alt="user" width="51" height="47" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/images/user-icon.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/images/user-icon-hv.png',this);"></a></li>
                        <li><a href="<?php echo home_url( '/index.php' ).'/buy'; ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/cart-icon.png" alt="cart" width="51" height="47" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/images/cart-icon.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/images/cart-icon-hv.png',this);"></a></li>
                        <li><a href="<?php echo home_url( '/videogridengine/index.php/foundboxes' )?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/star-icon.png" alt="star" width="51" height="47" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/images/star-icon.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/images/star-icon-hv.png',this);"></a></li>
                        <li class="search"><input id="searchItem" type="text" onBlur="this.value==''?this.value='Search multiple stock...':''" onClick="this.value=='Search multiple stock...'?this.value='':''" value="Search multiple stock..." class="input-box"  onkeypress="return searchVideo(event)" title="Search multiple stock..." />
                            <button id="searchBTN" onclick="StartSearch($('#searchItem').val())">SEARCH</button></li>
                        <li class="dropdown"><div class="drop-text">Sort</div></li>
                        <li class="right-icon"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/nav-icon1.png" alt="icon1" width="37" height="38" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon1.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon1-hv.png',this);"></a></li>
                        <li class="right-icon"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/nav-icon2.png" alt="icon2" width="39" height="38" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon2.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon2-hv.png',this);"></a></li>
                        <li class="right-icon"><a href="#"><img src="<?php bloginfo( 'template_url' ); ?>/images/nav-icon3.png" alt="icon3" width="38" height="38" onmouseout  ="SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon3.png',this);" onmouseover = "SwapImage('<?php bloginfo( 'template_url' ); ?>/css/fftheme/images/nav-icon3-hv.png',this);"></a></li>
                        <li class="advance-search" style="width:200px">&nbsp;</li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of Navigation -->
         <?php do_action( 'bp_before_container' ) ?>
         
 
<div id="moreTexts" style="display: none;">   
        <p> 
            <span style="text-decoration: underline;">Finding Footage</span>
    gives you fast and easy access to multiple video stocks at once, and expand your results.
    Join us to find dozens of free clips online...

</div>
    
<script type="text/javascript">
    // ITSIK 30.06.2015
    //stLight.options({publisher: "72d16b20-e6f2-4082-8f6a-88b2b96c919e"}); 

    //var options={ "publisher": "72d16b20-e6f2-4082-8f6a-88b2b96c919e", "position": "left","z-index": "-1 !important", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "googleplus", "linkedin"]}};
    //var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>  

<style type="text/css">
    
    #sthoverbuttons .sthoverbuttons-top-l {
        background: none ;
        width: 10%;
    }
    #sthoverbuttons .sthoverbuttons-shade-l {
        background: none ;
        width: 10%;
    }
    #sthoverbuttons .sthoverbuttons-bottom-l {
        background:none;
        width: 10%;
    }
    #sthoverbuttons #sthoverbuttons-background {
        float: left;
        width: 30px;
    }
    #sthoverbuttons #sthoverbuttonsMain {
        float: right;
    }

</style> 

<div style="width: 100%; height:15px;">


</div>

<!-- Google Code for Home page visits Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 880493337;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "OAABCOiIlGcQmYbtowM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/880493337/?label=OAABCOiIlGcQmYbtowM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

