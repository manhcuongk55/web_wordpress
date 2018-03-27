<?php
/**
 * Verity functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Verity
 */

if ( ! function_exists( 'verity_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function verity_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Verity, use a find and replace
		 * to change 'verity' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'verity', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 1332, 666, true );

		add_image_size( 'verity-first-image', 666, 666, true );
		add_image_size( 'verity-featured-archive-image', 444, 444, true );
		add_image_size( 'verity-hero-image', 488, 528, true );
		add_image_size( 'verity-thumbnail-avatar', 90, 90, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'      => esc_html__( 'Primary', 'verity' ),
			'social-menu' => esc_html__( 'Social Menu', 'verity' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'verity_custom_background_args', array(
			'default-color' => 'f2f2f2',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for Custom Logo
		add_theme_support( 'custom-logo', array(
			'height'     => 100,
			'width'      => 100,
			'flex-width' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'verity_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function verity_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'verity_content_width', 792 );
}
add_action( 'after_setup_theme', 'verity_content_width', 0 );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Catch Responsive 1.0
 */
function verity_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-5' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="widget-area footer-widget-area ' . $class . '"';
}


if ( ! function_exists( 'verity_fonts_url' ) ) :
/**
 * Register Google fonts for Verity.
 *
 * Create your own verity_fonts_url() function to override in a child theme.
 *
 * @since Verity 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function verity_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'verity' ) ) {
		$fonts[] = 'Lato:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'verity' ) ) {
		$fonts[] = 'Playfair Display:400,700,400italic,700italic';
	}

	/* translators: If there are characters in your language that are not supported by Amatic SC, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Amatic SC font: on or off', 'verity' ) ) {
		$fonts[] = 'Amatic SC:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function verity_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'verity-fonts', verity_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'verity-style', get_stylesheet_uri() );

	// Load the html5 shiv.
	wp_enqueue_script( 'verity-html5', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'verity-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'verity-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'verity-keyboard-image-navigation', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20160816' );
	}

	wp_register_script( 'jquery-match-height', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.matchHeight.min.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'verity-script', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/functions.min.js', array( 'jquery', 'jquery-match-height' ), '20150507', true );

	wp_localize_script( 'verity-script', 'verityScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'verity' ),
		'collapse' => esc_html__( 'collapse child menu', 'verity' ),
		'icon'     => verity_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) )
	) );

	// Enqueue fitvid if JetPack is not installed
	if ( ! class_exists( 'Jetpack' ) ) {
		wp_enqueue_script( 'jquery-fitvids', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/fitvids.min.js', array( 'jquery' ), '1.1', true );
	}

}
add_action( 'wp_enqueue_scripts', 'verity_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_parent_theme_file_path( '/inc/extras.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_parent_theme_file_path( '/inc/jetpack.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Include Breadcrumb
 */
require get_parent_theme_file_path( '/inc/breadcrumb.php' );

/**
 * Include Widgets
 */
require get_parent_theme_file_path( '/inc/widgets/widgets.php' );
