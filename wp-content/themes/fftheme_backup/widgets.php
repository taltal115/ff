<?php
/*
 * Template Name: widgets Home page
 *
 * A custom page template without sidebar.
 *
 * @package BuddyPress
 * @subpackage BP_Default
 * @since 1.5
 */

 ?>


		<?php //do_action( 'bp_before_blog_page' ) ?>



			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


			<?php endwhile; endif; ?>



		<?php //do_action( 'bp_after_blog_page' ) ?>


						<?php the_content( __( '<p class="serif">Read the rest of this page &rarr;</p>', 'buddypress' ) ); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages: ', 'buddypress' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
						<?php edit_post_link( __( 'Edit this page.', 'buddypress' ), '<p class="edit-link">', '</p>'); ?>
