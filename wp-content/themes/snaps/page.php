<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Snaps
 * @since Snaps 1.0
 */

get_header(); ?>

<?php
function url_get_contents ($Url) {
	if (!function_exists('curl_init')){
		die('CURL is not installed!');
	}
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $Url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}
?>

	<div id="gallery">
		<div id="loading" style="display: none;"><img style="display: block;margin-top: 20px; margin-left: auto; margin-right: auto;" src='/videogridengine/css/fftheme/images/loader.gif'></div>
		<?php
		$urlFreeClips = home_url("/videogridengine/index.php/footage/FreeClipsHtml");
		$urlHomeBox = home_url("/videogridengine/index.php/footage/HomeBoxsHtml");
		?>
		<div id="freeclips">
			<?php print_r(url_get_contents($urlFreeClips));?>
		</div>
		<div id="foundboxs">
			<?php print_r(url_get_contents($urlHomeBox));?>
		</div>
		<script type="text/javascript">
			var m_HomeBoxTotal = <?=url_get_contents("$urlHomeBox?index=-1");?>;
			var m_HomeBoxIndex = 0;
			console.log('222222222222222222');
			$( document ).ready(function() {
				//getBoxHtml(urlFreeClips + "?index=0",idFreeClips);
				//getBoxHtml(urlHomeBox + "?index=0",idHomeBox);
				//m_HomeBoxTotal = getData(urlHomeBox + "?index=-1")
			});


			function loadHomeBox(action) {
				var url = "/videogridengine/index.php/footage/HomeBoxsHtml";
				var id = "foundboxs";
				if(action == "prevous") {
					m_HomeBoxIndex--;
					if(m_HomeBoxIndex < 0)
						m_HomeBoxIndex = m_HomeBoxTotal-1;
				}
				else if(action == "next"){
					m_HomeBoxIndex++;
					if(m_HomeBoxIndex >= m_HomeBoxTotal)
						m_HomeBoxIndex = 0;
				}
				url += "?index=" + (m_HomeBoxIndex);
				loadData(url,id);
			}
		</script>

	</div>
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>