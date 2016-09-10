<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shapely
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Search Wisely Browse Widely - Footage Search Engine with Free clips from around the web / Royalty free footage and Video backgrounds">
    <meta name="keywords" content="Footage, video footage, free video footage, stock footage, royalty free, hd, vj, timelapse, 4k footage, free 4k footage, video, background, PowerPoint background, Keynote background, presentation background, motion background, loop, motion graphics ,visuals, background visuals, video search, footage search engine ">
    <meta property="og:title" content="Finding Footage" />
    <meta property="og:image" content="http://www.findingfootage.com/videogridengine/images/logo.png" />
    <meta property="og:description" content="gives you fast and easy access to multiple video stocks at once, and expand your results. join us to find dozens of free clips online..." />

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" href="/wp-content/themes/shapely/css/main.css" type="text/css" media="screen"/>

    <link rel="shortcut icon" href="http://www.findingfootage.com/videogridengine/images/fficon.png?v=1" />

<!--    <link rel="stylesheet" href="/wp-content/themes/fftheme/css/main.css" type="text/css" media="screen"/>-->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="/wp-content/themes/shapely/js/main.js"></script>


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'shapely' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
        <div class="nav-container">
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <div class="container nav-bar">
                        <div class="row">
                            <div class="module left site-title-container">
                                <?php shapely_get_header_logo(); ?>
                            </div>
                            <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
                                <i class="fa fa-bars"></i>
                            </div>
                            <div class="module-group right">
                                <div class="module left">
                                    <?php shapely_header_menu(); // main navigation ?>
                                </div>
                                <!--end of menu module-->
                                <div class="module widget-handle search-widget-handle left hidden-xs hidden-sm">
                                    <div class="search">
                                        <i class="fa fa-search"></i>
                                        <span class="title"><?php _e("Site Search", 'shapely'); ?></span>
                                    </div>
                                    <div class="function"><?php
                                        get_search_form(); ?>
                                    </div>
                                </div>
                            </div>
                            <!--end of module group-->
                        </div>
                </div>
            </nav><!-- #site-navigation -->
        </div>
	</header><!-- #masthead -->
    
	<div id="content" class="main-container">
<!--    //( is_page_template('template-home.php') ) ? '' : shapely_top_callout();    -->
        <div id="FFsearch">
            <h1>Search for Stock Video</h1>
            <h4>Find Royalty Free footage from multiple websites</h4>
            <div class="input-group">
                <input type="text" class="search-input form-control" id="inputGroupSuccess2" aria-describedby="inputGroupSuccess2Status">
                <div class="search-button input-group-addon">
                    <span id="searchBTN" onclick="StartSearch($('#searchItem').val())">
                        Search
                    </span>
                </div>
            </div>
        </div>
        <div id="mainWrapper">
            <a href="<?php echo home_url( '/index.php' ); ?>">
                <div id="logoImage"></div>
            </a>
            <img src="http://localhost/wp-content/themes/fftheme/images/new/DesktopSlicing/home-banner.jpg" alt="">
        </div>
        <section class="content-area <?php echo ( get_theme_mod('top_callout', true ) ) ? '' : ' pt0 ' ?>">
            <div id="main" class="<?php echo ( !is_page_template( 'template-home.php' )) ? 'container': ''; ?>" role="main">
                <div class="row">
                    <img id="midHomeImg" src="http://stage.findingfootage.com/wp-content/themes/fftheme/images/new/DesktopSlicing/keywords-bg.jpg" alt="">


