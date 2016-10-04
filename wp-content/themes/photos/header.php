<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
<link rel="stylesheet" href="/wp-content/themes/photos/css/main.css">
</head>

<body <?php body_class('push-menu-push'); ?>>
	<div class="wrapper">
		<nav class="push-menu push-menu-vertical push-menu-left" id="push-menu-id">
			<h3 id="hideLeftPush"><?php _e( 'Menu', 'photos' ); ?></h3>
			<?php
			wp_nav_menu(array(
				'theme_location' => 'primary',
				'menu' => __( 'Primary Menu', 'photos' ),
				'items_wrap' => '<ul class="photos-push-menu">%3$s</ul>'
			));
			?>
		</nav>

		<span class="glyphicon glyphicon-menu-hamburger" id="showLeftPush" aria-hidden="true"></span>

		<header class="header" style="no-repeat scroll 0% 0% / cover;">
			<div class="jumbotron text-center">
				<div class="container">
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<a href="#content" class="btn btn-circle page-scroll">
						<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
					</a>
				</div>
			</div>
			<div id="homefboxwidget" style="width: 100%;top: 0;position: absolute;float: right;">
				<div id="mainWrapper">
					<a href="<?php echo home_url( '/index.php' ); ?>">
						<div id="logoImage"></div>
					</a>
					<!--        <img src="http://localhost/wp-content/themes/fftheme/images/new/DesktopSlicing/home-banner.jpg" alt="">-->
					<video playsinline autoplay muted loop id="bgvid">
						<source src="https://player.vimeo.com/external/178742158.hd.mp4?s=f0cbce173cac9ac85ca59b2a96d34fbafcc1d801&profile_id=119" type="video/mp4">
					</video>
				</div>
				<div class="FFsearch">
					<h1>Search for Stock Video</h1>
					<h4>Find Royalty Free footage from multiple websites</h4>
					<div class="search-input">
						<input id="searchItem" type="text" onBlur="this.value==''?this.value='Find Footage':''" onClick="this.value=='Find Footage'?this.value='':''" value="Find Footage" class="input-box"  onkeypress="return searchVideo(event)" title="Find Footage" />
						<div id="searchBTN" onclick="StartSearch($('#searchItem').val())">
							Search
						</div>
					</div>
				</div>
				<div id="gallery">
					<div id="loading" style="display: none;"><img style="display: block;margin-top: 20px; margin-left: auto; margin-right: auto;" src='/videogridengine/css/fftheme/images/loader.gif'></div>
					<?php
					$urlFreeClips = home_url("/videogridengine/index.php/footage/FreeClipsHtml");
					$urlHomeBox = home_url("/videogridengine/index.php/footage/HomeBoxsHtml");
					?>
					<div id="freeclips">
						<?php print_r(file_get_contents($urlFreeClips));?>
					</div>
					<div id="foundboxs">
						<?php print_r(file_get_contents($urlHomeBox));?>
					</div>
				</div>
				<div id="videoBox" style="display:none;" title="">
					video will be here
				</div>
			</div>
		</header>
