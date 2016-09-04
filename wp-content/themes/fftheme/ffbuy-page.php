<?php
/*
 * Template Name: Finding Buy Page
 *
 * A custom page template without sidebar.
 *
 * @package BuddyPress
 * @subpackage BP_Default
 * @since 1.5
 */

get_header('ff');
?>

<div style="color: black; margin-left: 15%; margin-bottom: 30px; width: 70%; float: left; text-align: justify;">
	<?php 
        if (have_posts()) : while (have_posts()) : the_post(); 
            endwhile;
        endif; 
    ?>
    <!-- h3 id="homeheader1" style="color: purple !important;">We are truly believed that multiple search can benefit to any RF footage searcher</h3 -->
    <?php the_content(); ?>

</div>


<?php get_footer('ff'); ?>
