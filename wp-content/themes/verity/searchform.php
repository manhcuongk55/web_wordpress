<?php
/**
 * Template for displaying search forms in Verity
 *
* @package Verity
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'verity' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'verity' ); ?>" value="<?php the_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><?php echo verity_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'verity' ); ?></span></button>
</form>
