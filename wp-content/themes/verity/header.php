<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Verity
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'verity' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
			<div class="site-header-main">
				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
				<?php get_template_part( 'template-parts/navigation/navigation', 'primary' ); ?>
			</div><!-- .site-header-main -->
		</header><!-- #masthead -->
		
		<div class="below-site-header">

			<?php get_template_part( 'template-parts/header/header', 'media' ); ?>

			<?php get_template_part( 'template-parts/header/breadcrumb' ); ?>

			<div id="content" class="site-content">