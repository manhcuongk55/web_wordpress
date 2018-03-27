<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Verity
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function verity_jetpack_setup() {
	/**
	 * Setup Infinite Scroll using JetPack if navigation type is set
	 */
	$pagination_type	= get_theme_mod( 'verity_pagination_type', 'default' );

	if( 'infinite-scroll-click' == $pagination_type ) {
		add_theme_support( 'infinite-scroll', array(
			'type'           => 'click',
			'container'      => '#infinite-post-wrap',
			'posts_per_page' => 12,
			'wrapper'        => false,
			'render'         => 'verity_infinite_scroll_render',
			'footer'         => false,
			'footer_widgets' => array( 'sidebar-2', 'sidebar-3', 'sidebar-4', 'sidebar-5' ),
		) );
	}
	else if ( 'infinite-scroll-scroll' == $pagination_type ) {
		//Override infinite scroll disable scroll option
    	update_option('infinite_scroll', true);

		add_theme_support( 'infinite-scroll', array(
			'type'           => 'scroll',
			'container'      => '#infinite-post-wrap',
			'posts_per_page' => 12,
			'wrapper'        => false,
			'render'         => 'verity_infinite_scroll_render',
		) );
	}

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for testimonials
	add_theme_support( 'jetpack-testimonial' );

	/*
	 * Adding theme support for Jetpack Portfolio CPT.
	 * Not essential to add this but this does a few nice things.
	 * 1. Turns the CPT on when the theme is activated.
	 * 2. Displays an admin notice if the option is turned off, but the theme is activated.
	 * 3. When the theme is switched away, if no CPTs are populated, it turns it back off.
	 */
	add_theme_support( 'jetpack-portfolio', array(
		'title'          => true,
		'content'        => true,
		'featured-image' => true,
	) );

	/**
	 * Add theme support for Featured Content.
	 * See: http://jetpack.me/support/featured-content/
	 */
	add_theme_support( 'featured-content', array(
		'filter'      => 'verity_get_featured_posts',
		'description' => esc_html__( 'The featured content section displays on the front page above the header.', 'verity' ),
		'max_posts'   => 3,
		'post_types'  => array( 'post', 'page' ),
	) );
}
add_action( 'after_setup_theme', 'verity_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function verity_infinite_scroll_render() {
	$blog_display	= get_option( 'jetpack_content_blog_display');

	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content/content', 'search' );
		elseif ( is_post_type_archive( 'jetpack-testimonial' ) ) :
			get_template_part( 'template-parts/testimonial/content', 'testimonial' );
		elseif ( is_post_type_archive( 'jetpack-portfolio' ) ) :
			get_template_part( 'template-parts/portfolio/content', 'portfolio' );
		else :
			if ( 'content' == $blog_display ) :
				get_template_part( 'template-parts/content/content' );
			else :
				get_template_part( 'template-parts/content/content', 'archive' );
			endif;
		endif;
	}
}

/**
 * Return early if Author Bio is not available.
 */
function verity_author_bio() {
	if ( ! function_exists( 'jetpack_author_bio' ) ) {
		return;
	} else {
		jetpack_author_bio();
	}
}

/**
 * Author Bio Avatar Size.
 */
function verity_author_bio_avatar_size() {
	return 90;
}
add_filter( 'jetpack_author_bio_avatar_size', 'verity_author_bio_avatar_size' );

/**
 * Featured Content Getter Function
 */
function verity_get_featured_posts() {
	return apply_filters( 'verity_get_featured_posts', false );
}


/**
 * Portfolio Title.
 */
function verity_portfolio_title( $before = '', $after = '' ) {
	$jetpack_portfolio_title = get_option( 'jetpack_portfolio_title' );
	$title = '';

	if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
		if ( isset( $jetpack_portfolio_title ) && '' != $jetpack_portfolio_title ) {
			$title = esc_html( $jetpack_portfolio_title );
		} else {
			$title = post_type_archive_title( '', false );
		}
	} elseif ( is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
		$title = single_term_title( '', false );
	}

	echo $before . $title . $after;
}

/**
 * Portfolio Content.
 */
function verity_portfolio_content( $before = '', $after = '' ) {
	$jetpack_portfolio_content = get_option( 'jetpack_portfolio_content' );

	if ( is_tax() && get_the_archive_description() ) {
		echo $before . get_the_archive_description() . $after;
	} else if ( isset( $jetpack_portfolio_content ) && '' != $jetpack_portfolio_content ) {
		$content = convert_chars( convert_smilies( wptexturize( stripslashes( wp_kses_post( addslashes( $jetpack_portfolio_content ) ) ) ) ) );
		echo $before . $content . $after;
	}
}


/**
 * Show/Hide Featured Image outside of the loop.
 */
function verity_jetpack_featured_image_display() {
	$id = null;

	/**
	 * Disable header image if page/post does not have featured image
	 * Check $id for shop page
	 */
	if ( ! has_post_thumbnail( $id ) ) {
		return false;
	}

	/**
	 * Disable header image if not in singular page or shop page
	 */
	if ( ! is_singular() ) {
		return false;
	}

	/**
	 * Disable header image on front page
	 */
	if ( verity_is_frontpage() ) {
		return false;
	}

	if ( ! function_exists( 'jetpack_featured_images_remove_post_thumbnail' ) ) {
        return true;
    } else {
        $options         = get_theme_support( 'jetpack-content-options' );
        $featured_images = ( ! empty( $options[0]['featured-images'] ) ) ? $options[0]['featured-images'] : null;

        $settings = array(
            'post-default' => ( isset( $featured_images['post-default'] ) && false === $featured_images['post-default'] ) ? '' : 1,
            'page-default' => ( isset( $featured_images['page-default'] ) && false === $featured_images['page-default'] ) ? '' : 1,
        );

        $settings = array_merge( $settings, array(
            'post-option'  => get_option( 'jetpack_content_featured_images_post', $settings['post-default'] ),
            'page-option'  => get_option( 'jetpack_content_featured_images_page', $settings['page-default'] ),
        ) );

        if ( ( ! $settings['post-option'] && is_single() )
            || ( ! $settings['page-option'] && is_singular() && is_page() ) ) {
            return false;
        } else {
            return true;
        }
    }
}
