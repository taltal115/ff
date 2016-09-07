<!doctype html>
<html>
	<head >
        <meta name="description" content="Search Wisely Browse Widely - Footage Search Engine with Free clips from around the web / Royalty free footage and Video backgrounds">
        <meta name="keywords" content="Footage, video footage, free video footage, stock footage, royalty free, hd, vj, timelapse, 4k footage, free 4k footage, video, background, PowerPoint background, Keynote background, presentation background, motion background, loop, motion graphics ,visuals, background visuals, video search, footage search engine ">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- https://developers.facebook.com/tools/debug/og/object/ -->
        <meta property="og:title" content="Finding Footage" /> 
        <meta property="og:image" content="http://www.findingfootage.com/videogridengine/images/logo.png" /> 
        <meta property="og:description" content="gives you fast and easy access to multiple video stocks at once, and expand your results. join us to find dozens of free clips online..." /> 
    
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
        
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
        <link rel="shortcut icon" href="http://www.findingfootage.com/videogridengine/images/fficon.png?v=1" />

        <link rel="stylesheet" href="/wp-content/themes/fftheme/style.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="/wp-content/themes/fftheme/css/main.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="/wp-content/themes/fftheme/bp-default.css" type="text/css" media="screen"/>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="/wp-content/themes/fftheme/js/main.js"></script>

        <?php
        
        wp_head(); 
       
        ?>

	</head>
    
    <body class="ffbody">
        
        <div id="mask">
            <p>
            <img width="100px" height="100px" src="<?php bloginfo( "template_url" ); ?>/images/loader.gif">
        </p>
        </div>
            
        <div class="selector"></div>

        <header><!-- Start header -->
            <div class="header-wrap">
                <nav> <!-- Navigation  Convert this into Wordpress paging -->
                    <div class="nav-wrap">
                        <div class="nav-links-right">
                            <a href="<?php echo home_url( '/index.php' ); ?>">Home</a>
                            <a href="
                            <?php
                            if (is_user_logged_in())
                            {
                                echo  home_url( '/videogridengine/index.php/user');
                            }else
                            {
                                echo get_site_url() . '/wp-login.php';
                            }?>">Profile</a>
                            <a href="<?php echo home_url( '/index.php' ).'/buy'; ?>">Packages</a>
                            <a href="<?php echo home_url( '/videogridengine/index.php/foundboxes' )?>">Collections</a>
                            <div id="signIn">
                                <a href="<?php echo get_site_url() . '/wp-login.php'; ?>">Sign up</a>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="logo-area">
                    <div id="mainWrapper">
                        <div id="logoImage"></div>
                        <div id="bigImage"></div>
                    </div>
                    <div class="logo" style="padding-right:3%">
                        <a href="<?php echo home_url( '/index.php' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/new/DesktopSlicing/logo.png" alt="logo" width="308" height="172" /></a>
                    </div>
                </div>
            </div>
            <?php // do_action( 'bp_header' ) ?>
        </header> <!-- End Of header -->
    <div class="clear"></div>


        <div class="search">
            <h1>Search for Stock Video</h1>
            <h4>Find Royalty Free footage from multiple websites</h4>
            <input id="searchItem" type="text" onBlur="this.value==''?this.value='Find Footage':''" onClick="this.value=='Find Footage'?this.value='':''" value="Find Footage" class="input-box"  onkeypress="return searchVideo(event)" title="Find Footage" />
            <div id="searchBTN" onclick="StartSearch($('#searchItem').val())">
                Search
            </div>
        </div>

        <!-- End of Navigation -->
         <?php do_action( 'bp_before_container' ) ?>
         
 
<div id="moreTexts" style="display: none;">   
        <p> 
            <span style="text-decoration: underline;">Finding Footage</span>
    gives you fast and easy access to multiple video stocks at once, and expand your results.
    Join us to find dozens of free clips online...

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
    <script type="text/javascript">

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
               src="https://www.facebook.com/tr?id=605851989567219&ev=PageView&noscript=1"/></noscript>
    <!-- End Facebook Pixel Code -->
