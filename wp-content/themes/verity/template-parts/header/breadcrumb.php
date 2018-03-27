<?php
/**
 * Displays Jetpack Breadcrumb
 *
 * @package CatchThemes
 * @subpackage Verity
 * @since 1.0
 * @version 1.0
 */

$enable_breadcrumb = get_theme_mod( 'verity_breadcrumb_option', 1 );

if ( $enable_breadcrumb ) :
        verity_breadcrumb();
endif; ?>