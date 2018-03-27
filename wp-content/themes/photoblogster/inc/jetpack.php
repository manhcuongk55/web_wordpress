<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * Please browse readme.txt for credits and forking information
 * @package photoblogster
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function photoblogster_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'photoblogster_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function photoblogster_jetpack_setup
add_action( 'after_setup_theme', 'photoblogster_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function photoblogster_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function photoblogster_infinite_scroll_render
