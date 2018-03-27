<?php
/**
 * The template for adding Custom Sidebars and Widgets
 *
 * @package Catch Themes
 * @subpackage Verity
 * @since Verity 0.2
 */

/**
 * Register widgetized area
 *
 * @since Verity 0.2
 */
function verity_widgets_init() {
	//Primary Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'verity' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'verity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'verity' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'verity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'verity' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'verity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'verity' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'verity' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'verity_widgets_init' );

/**
 * Loads up Necessary JS Scripts for widgets
 *
 * @since Verity 0.2
 */
function verity_widgets_scripts( $hook) {
	if ( 'widgets.php' == $hook ) {
		wp_enqueue_style( 'verity-widgets-styles', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/css/widgets.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'verity_widgets_scripts' );

/**
 * Return registered image sizes.
 *
 * Return a two-dimensional array of just the additionally registered image sizes, with width, height and crop sub-keys.
 *
 * @since Verity 1.0.1
 *
 * @global array $_wp_additional_image_sizes Additionally registered image sizes.
 *
 * @return array Two-dimensional, with width, height and crop sub-keys.
 */
function verity_get_additional_image_sizes() {
	global $_wp_additional_image_sizes;

	if ( $_wp_additional_image_sizes )
		return $_wp_additional_image_sizes;

	return array();
}


if ( ! function_exists( 'verity_get_highlight_meta' ) ) :
	/**
	 * Returns HTML with meta information for the categories, tags, date and author.
	 *
	 * @param [boolean] $hide_category Adds screen-reader-text class to category meta if true
	 * @param [boolean] $hide_tags Adds screen-reader-text class to tag meta if true
	 * @param [boolean] $hide_posted_by Adds screen-reader-text class to date meta if true
	 * @param [boolean] $hide_author Adds screen-reader-text class to author meta if true
	 *
	 * @since Verity 0.2
	 */
	function verity_get_highlight_meta( $hide_category = false, $hide_tags = false, $hide_posted_by = false, $hide_author = false ) {
		$output = '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {

			$class = $hide_category ? 'screen-reader-text' : '';

			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'verity' ) );
			if ( $categories_list && verity_categorized_blog() ) {
				$output .= sprintf( '<span class="cat-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'verity' ) ),
					$categories_list
				);
			}

			$class = $hide_tags ? 'screen-reader-text' : '';

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'verity' ) );
			if ( $tags_list ) {
				$output .= sprintf( '<span class="tags-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'verity' ) ),
					$tags_list
				);
			}

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$class = $hide_posted_by ? 'screen-reader-text' : '';

			$output .= sprintf( '<span class="posted-on ' . $class . '">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
				sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'verity' ) ),
				esc_url( get_permalink() ),
				$time_string
			);

			if ( is_singular() || is_multi_author() ) {
				$class = $hide_author ? 'screen-reader-text' : '';

				$output .= sprintf( '<span class="byline ' . $class . '"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
					sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'verity' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				);
			}
		}

		$output .= '</p><!-- .entry-meta -->';

		return $output;
	}
endif; //verity_get_highlight_meta

// Load Featured Post Widget
include trailingslashit( get_template_directory() ) . 'inc/widgets/featured-posts.php';

// Load Instagram Widget
include trailingslashit( get_template_directory() ) . 'inc/widgets/instagram.php';

// Load Social Icon Widget
include trailingslashit( get_template_directory() ) . 'inc/widgets/social-icons.php';
