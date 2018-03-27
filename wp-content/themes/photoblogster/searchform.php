<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * Please browse readme.txt for credits and forking information
 * @package photoblogster
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html( 'Search for:', 'label', 'photoblogster' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_html( 'Search &hellip;', 'placeholder', 'photoblogster' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr( 'Search for:', 'label', 'photoblogster' ); ?>" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo esc_html( 'Search', 'submit button', 'photoblogster' ); ?></span></button>
</form>
