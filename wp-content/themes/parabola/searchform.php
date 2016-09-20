<?php
/**
 * The searchform
 *
 * @package Parabola
 */
?> 

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" placeholder="<?php _e( 'SEARCH', 'parabola' ); ?>" name="s" class="s" value="<?php echo get_search_query(); ?>" />
	<input type="submit" class="searchsubmit" value="" />
</form>