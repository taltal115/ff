<?php
/*
 * Template Name: Finding Clear Page
 *
 * A custom page template without sidebar.
 *
 * @package BuddyPress
 * @subpackage BP_Default
 * @since 1.5
 */

get_header('ff');
?>
<div style="margin-left: 15%; margin-bottom: 30px; width: 70%; float: left; text-align: justify;">
<?
if (have_posts()) : while (have_posts()) : the_post(); 
    endwhile;
endif; 
        
the_content();
?>
</div>
<?
get_footer('ff');
?>

