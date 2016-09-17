<!doctype html>
<html>
	<head>
        <meta name="description" content="Search Wisely Browse Widely - Footage Search Engine with Free clips from around the web / Royalty free footage and Video backgrounds">
        <meta name="keywords" content="Footage, video footage, free video footage, stock footage, royalty free, hd, vj, timelapse, 4k footage, free 4k footage, video, background, PowerPoint background, Keynote background, presentation background, motion background, loop, motion graphics ,visuals, background visuals, video search, footage search engine ">
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
                <div id="mainWrapper">
                    <a href="<?php echo home_url( '/index.php' ); ?>">
                        <div id="logoImage"></div>
                    </a>
                    <img src="http://localhost/wp-content/themes/fftheme/images/new/DesktopSlicing/home-banner.jpg" alt="">
                </div>

            </div>
            <?php // do_action( 'bp_header' ) ?>
        </header> <!-- End Of header -->


        <div class="FFsearch">
            <h1>Search for Stock Video</h1>
            <h4>Find Royalty Free footage from multiple websites</h4>
            <input id="searchItem" type="text" onBlur="this.value==''?this.value='Find Footage':''" onClick="this.value=='Find Footage'?this.value='':''" value="Find Footage" class="input-box"  onkeypress="return searchVideo(event)" title="Find Footage" />
            <div id="searchBTN" onclick="StartSearch($('#searchItem').val())">
                Search
            </div>
        </div>

    <div class="clear"></div>
        <!-- End of Navigation -->
         <?php do_action( 'bp_before_container' ) ?>
