<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Verity
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function verity_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_singular() ) {
		$classes[] = 'singular';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( has_custom_header() && is_front_page() ) {
		$classes[] = 'absolute-header';
	} else {
		if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
			$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

			if ( isset( $jetpack_options['featured-image'] ) && '' !== $jetpack_options['featured-image'] ) {
				$classes[] = 'has-custom-header';
			}
		} elseif ( is_post_type_archive( 'jetpack-portfolio' ) ) {
			$jetpack_portfolio_featured_image = get_option( 'jetpack_portfolio_featured_image' );

			if ( '' !== $jetpack_portfolio_featured_image ) {
				$classes[] = 'has-custom-header';
			}
		} elseif ( verity_jetpack_featured_image_display() ) {
			$classes[] = 'has-custom-header';
		}
	}

	// Adds a class of navigation-(default|classic) to blogs.
	if ( 'classic' === get_theme_mod( 'verity_menu_type' ) ) {
		$classes[] = 'navigation-classic';
	} else {
		$classes[] = 'navigation-default';
	}

	$classes[] = 'boxed-layout';

	// Adds a class with respect to layout selected.
	if ( ! is_front_page() && is_singular() ) {
		$layout  = get_theme_mod( 'verity_default_layout', 'no-sidebar' );

		if ( 'left-sidebar' === $layout ) {
			if ( is_active_sidebar( 'sidebar-1' ) ) {
				$classes[] = 'two-columns content-right';
			}
		}
	}

	return $classes;
}
add_filter( 'body_class', 'verity_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function verity_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'verity_pingback_header' );

/**
 * Checks to see if we're on the homepage or not.
 */
function verity_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Remove first post from blog as it is already show via recent post template
 */
function verity_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		/**
		 * Remove first post from main query as it is shown in recent posts prioritizing the sticky posts
		 */
		$paged = intval( ( get_query_var('paged') ) ? get_query_var('paged') : 1 );

		if ( 1 == $paged && is_front_page() ) {
			$latest_post = get_posts( array(
				'posts_per_page' => 1,
				'post__in'  => get_option( 'sticky_posts' ),
				'paged' => '')
			);

			$query->set( 'post__not_in', array( $latest_post[0]->ID ) );
		}

		// Ignore Sticky Posts on main query
		$query->set( 'ignore_sticky_posts', 1 );

		$cats = get_theme_mod( 'verity_front_page_category' );

		if ( is_array( $cats ) && !in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] =  $cats;
		}
	}
}
add_action( 'pre_get_posts', 'verity_alter_home' );

/**
 * Function to add Scroll Up icon
 */
function verity_scrollup() {
	$verity_disable_scrollup = get_theme_mod( 'verity_disable_scrollup' );

	if ( $verity_disable_scrollup ) {
		return;
	}

	echo '<a href="#masthead" id="scrollup">' .verity_get_svg( array( 'icon' => 'angle-down' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'verity' ) . '</span></a>' ;

}
add_action( 'wp_footer', 'verity_scrollup', 1 );

if ( ! function_exists( 'verity_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Verity 0.2
	 */
	function verity_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$length = get_theme_mod( 'verity_excerpt_length', 30 );
		return absint( $length );
	}
endif; //verity_excerpt_length
add_filter( 'excerpt_length', 'verity_excerpt_length' );


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer.
 * @return string option from customizer prepended with an ellipsis.
 */
if ( ! function_exists( 'verity_excerpt_more' ) ) :
	function verity_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text  = get_theme_mod( 'verity_excerpt_more_text',  esc_html__( 'Continue reading', 'verity' ) );

		$link = sprintf( '<a href="%1$s" class="more-link"><span>%2$s</span></a>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

		return ' &hellip; ' . $link;
	}
endif;
add_filter( 'excerpt_more', 'verity_excerpt_more' );


if ( ! function_exists( 'verity_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Verity 0.2
	 */
	function verity_custom_excerpt( $output ) {

		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = get_theme_mod( 'verity_excerpt_more_text', esc_html__( 'Continue reading', 'verity' ) );

			$link = sprintf( '<a href="%1$s" class="more-link"><span>%2$s</span></a>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

			$link = ' &hellip; ' . $link;

			$output .= $link;
		}

		return $output;
	}
endif; //verity_custom_excerpt
add_filter( 'get_the_excerpt', 'verity_custom_excerpt' );


if ( ! function_exists( 'verity_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Verity 0.2
	 */
	function verity_more_link( $more_link, $more_link_text ) {
		$more_tag_text = get_theme_mod( 'verity_excerpt_more_text', esc_html__( 'Continue reading', 'verity' ) );

		return ' &hellip; ' . str_replace( $more_link_text, $more_tag_text, $more_link );
	}
endif; //verity_more_link
add_filter( 'the_content_more_link', 'verity_more_link', 10, 2 );


if ( ! function_exists( 'verity_content_nav' ) ) :
	/**
	 * Display navigation/pagination when applicable
	 *
	 * @since Verity 0.2
	 */
	function verity_content_nav() {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$pagination_type = get_theme_mod( 'verity_pagination_type', 'default' );

		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		/**
		 * Check if navigation type is numeric and if Wp-PageNavi Plugin is enabled
		 */
		if ( 'numeric' == $pagination_type && function_exists( 'wp_pagenavi' ) ) {
			echo '<nav class="navigation pagination-pagenavi" role="navigation">';
				wp_pagenavi();
			echo '</nav><!-- .pagination-pagenavi -->';
		}
		elseif ( 'numeric' == $pagination_type && function_exists( 'the_posts_pagination' ) ) {
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous', 'verity' ),
				'next_text'          => esc_html__( 'Next', 'verity' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'verity' ) . ' </span>',
			) );
		}
		else {
			the_posts_navigation();
		}
	}
endif; // verity_content_nav

/**
 * Check if a section is enabled or not based on the $value parameter
 * @param  string $value Value of the section that is to be checked
 * @return boolean return true if section is enabled otherwise false
 */
function verity_check_section( $value ) {
	global $wp_query;

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	// Front page displays in Reading Settings
	$page_for_posts = get_option('page_for_posts');

	return ( 'entire-site' == $value  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $value ) );
}

/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Verity 0.2
 */

function verity_get_first_image( $postID, $size, $attr ) {
	ob_start();

	ob_end_clean();

	$image  = '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if( isset( $matches [1] [0] ) ) {
		//Get first image
		$first_img = $matches [1] [0];

		return '<img class="pngfix wp-post-image" src="'. esc_url( $first_img ) .'">';
	}

	return false;
}
