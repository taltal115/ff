<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Snaps
 * @since Snaps 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="http://gmpg.org/xfn/11" />

	<link rel="shortcut icon" href="http://www.findingfootage.com/videogridengine/images/fficon.png?v=1" />

<!--	<link rel="stylesheet" href="/wp-content/themes/fftheme/style.css" type="text/css" media="screen"/>-->
<!--	<link rel="stylesheet" href="/wp-content/themes/fftheme/css/main.css" type="text/css" media="screen"/>-->
<!--	<link rel="stylesheet" href="/wp-content/themes/fftheme/bp-default.css" type="text/css" media="screen"/>-->

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="/wp-content/themes/fftheme/js/main.js"></script>


	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<?php $header_image = get_header_image(); ?>
	<link rel="stylesheet" href="/wp-content/themes/fftheme/css/main.css" type="text/css" media="screen"/>

	<div id="mainWrapper">
		<a href="<?php echo home_url( '/index.php' ); ?>">
			<div id="logoImage"></div>
		</a>
		<img src="http://localhost/wp-content/themes/fftheme/images/new/DesktopSlicing/home-banner.jpg" alt="">
	</div>
	<div class="FFsearch">
		<h1>Search for Stock Video</h1>
		<h4>Find Royalty Free footage from multiple websites</h4>
		<input id="searchItem" type="text" onBlur="this.value==''?this.value='Find Footage':''" onClick="this.value=='Find Footage'?this.value='':''" value="Find Footage" class="input-box"  onkeypress="return searchVideo(event)" title="Find Footage" />
		<div id="searchBTN" onclick="StartSearch($('#searchItem').val())">
			Search
		</div>
	</div>
	<div id="main" class="site-main">

		<nav id="anchor" role="navigation" class="site-navigation main-navigation">
			<h1 class="assistive-text"><?php _e( 'Menu', 'snaps' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'snaps' ); ?>"><?php _e( 'Skip to content', 'snaps' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

		</nav><!-- .site-navigation .main-navigation -->

