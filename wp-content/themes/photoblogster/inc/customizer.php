<?php
/**
 * photoblogster Theme Customizer
 *
 * Please browse readme.txt for credits and forking information
 *
 * @package photoblogster
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photoblogster_customize_register( $wp_customize ) {
	$color_scheme = photoblogster_get_color_scheme();
	$current_color_scheme = photoblogster_current_color_scheme_default_color();
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_section('header_image')->title = __( 'Front Page Header', 'photoblogster' );
	$wp_customize->get_section('colors')->title = __( 'Background Color', 'photoblogster' );

	$wp_customize->add_setting( 'header_bg_color', array(
		'default'           => '#1b1b1b',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
		'label'       => __( 'Header Background Color', 'photoblogster' ),
		'description' => __( 'Applied to header background.', 'photoblogster' ),
		'section'     => 'header_image',
		'settings'    => 'header_bg_color',
		) ) );

	$wp_customize->add_section( 'site_identity' , array(
		'priority'   => 3,
		));

	$wp_customize->add_section( 'header_image' , array(
		'title'      => __('Front Page Header', 'photoblogster'),
		'priority'   => 4,
		));

	$wp_customize->add_setting( 'header_image_text_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_image_text_color', array(
		'label'       => __( 'Header Image Headline Color', 'photoblogster' ),
		'description' => __( 'Choose a color for the header image headline.', 'photoblogster' ),
		'priority' 			=> 2,
		'section'     => 'header_image',
		'settings'    => 'header_image_text_color',
		) ) );


	$wp_customize->add_section(
		'photoblogster_help_and_support_today',
		array(
			'title' => __('Support & Premium Version', 'photoblogster'),
			'priority' => 0,
			'description' => __('Have questions or need help? ', 'photoblogster') . '<a href="https://lighthouseseooptimization.github.io/wordpress/photoblogster/#contact" target="_blank">Email us here</a> or write to us directly at: Beseenseo@gmail.com<br><br><br><a href="https://lighthouseseooptimization.github.io/wordpress/photoblogster/" target="_blank"><img src="' . get_template_directory_uri() . '/images/features.png"></a>',
			)
		);  

	$wp_customize->add_setting('photoblogster_help_and_support_today_tabs_sec', array(
		'sanitize_callback' => 'unneeded',
		'type' => 'info_control',
		'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'help_and_support_today_tab', array(
		'section' => 'photoblogster_help_and_support_today',
		'settings' => 'photoblogster_help_and_support_today_tabs_sec',
		'type' => 'none',
		'priority' => 0
		) )
	);   


	$wp_customize->add_setting( 'header_image_tagline_color', array(
		'default'           => '#f04d75',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_image_tagline_color', array(
		'label'       => __( 'Header Image Tagline Color', 'photoblogster' ),
		'description' => __( 'Choose a color for the header tagline headline.', 'photoblogster' ),
		'section'     => 'header_image',
		'priority'   => 2,
		'settings'    => 'header_image_tagline_color',
		) ) );

	$wp_customize->add_control( 'header_textcolor', array(
		'section'  => 'color_settings',
		) );
	$wp_customize->add_control( 'hero_image_subtitle', array(
		'label'    => __( "Header Image Tagline", 'photoblogster' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 1,
		) );

	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'photoblogster_sanitize_color_scheme',
		'transport'         => 'postMessage',
		) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Predefined Colors', 'photoblogster' ),
		'section'  => 'accent_color_option',
		'type'     => 'select',
		'choices'  => photoblogster_get_color_scheme_choices(),
		'priority' => 3,
		) );

	$wp_customize->add_setting( 'accent_color', array(
		'default'           => $current_color_scheme[0],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
		) );



	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'       => __( 'Theme Color', 'photoblogster' ),
		'description' => __( 'Applied to highlight elements, buttons and much more.', 'photoblogster' ),
		'section'     => 'accent_color_option',
		'settings'    => 'accent_color',
		) ) );

	$wp_customize->add_setting('post_display_option', array(
		'default'        => 'post-excerpt',
		'sanitize_callback' => 'photoblogster_sanitize_post_display_option',
		'transport'         => 'refresh'
		));

	$wp_customize->add_control('post_display_types', array(
		'label'      => __('How would you like to dipaly a post on post listing page?', 'photoblogster'),
		'section'    => 'post_options',
		'settings'   => 'post_display_option',
		'type'       => 'radio',
		'choices'    => array(
			'post-excerpt' => __('Post excerpt','photoblogster'),
			'full-post' => __('Full post','photoblogster'),            
			),
		));
}

add_action( 'customize_register', 'photoblogster_customize_register' );

/**
 * Register color schemes for photoblogster.
 *
 * @return array An associative array of color scheme options.
 */
function photoblogster_get_color_schemes() {
	return apply_filters( 'photoblogster_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'photoblogster' ),
			'colors' => array(
				'#f04d75',			
				),
			),
		'pink'    => array(
			'label'  => __( 'Pink', 'photoblogster' ),
			'colors' => array(
				'#FF4081',				
				),
			),
		'orange'  => array(
			'label'  => __( 'Orange', 'photoblogster' ),
			'colors' => array(
				'#FF5722',
				),
			),
		'green'    => array(
			'label'  => __( 'Green', 'photoblogster' ),
			'colors' => array(
				'#8BC34A',
				),
			),
		'red'    => array(
			'label'  => __( 'Red', 'photoblogster' ),
			'colors' => array(
				'#FF5252',
				),
			),
		'yellow'    => array(
			'label'  => __( 'yellow', 'photoblogster' ),
			'colors' => array(
				'#FFC107',
				),
			),
		'blue'   => array(
			'label'  => __( 'Blue', 'photoblogster' ),
			'colors' => array(
				'#03A9F4',
				),
			),
		) );
}

if(!function_exists('photoblogster_current_color_scheme_default_color')):
/**
 * Get the default hex color value for current color scheme
 *
 *
 * @return array An associative array of current color scheme hex values.
 */
function photoblogster_current_color_scheme_default_color(){
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	
	$color_schemes       = photoblogster_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; //photoblogster_current_color_scheme_default_color

if ( ! function_exists( 'photoblogster_get_color_scheme' ) ) :
/**
 * Get the current photoblogster color scheme.
 *
 *
 * @return array An associative array of currently set color hex values.
 */
function photoblogster_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$accent_color = get_theme_mod('accent_color','#f04d75');
	$color_schemes       = photoblogster_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		$color_schemes[ $color_scheme_option ]['colors'] = array($accent_color);
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // photoblogster_get_color_scheme

if ( ! function_exists( 'photoblogster_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for photoblogster.
 *
 *
 * @return array Array of color schemes.
 */
function photoblogster_get_color_scheme_choices() {
	$color_schemes                = photoblogster_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // photoblogster_get_color_scheme_choices

if ( ! function_exists( 'photoblogster_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function photoblogster_sanitize_color_scheme( $value ) {
	$color_schemes = photoblogster_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default';
	}

	return $value;
}
endif; // photoblogster_sanitize_color_scheme

if ( ! function_exists( 'photoblogster_sanitize_post_display_option' ) ) :
/**
 * Sanitization callback for post display option.
 *
 *
 * @param string $value post display style.
 * @return string post display style.
 */

function photoblogster_sanitize_post_display_option( $value ) {
	if ( ! in_array( $value, array( 'post-excerpt', 'full-post' ) ) )
		$value = 'post-excerpt';

	return $value;
}
endif; // photoblogster_sanitize_post_display_option
/**
 * Enqueues front-end CSS for color scheme.
 *
 *
 * @see wp_add_inline_style()
 */
function photoblogster_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	
	$color_scheme = photoblogster_get_color_scheme();

	$color = array(
		'accent_color'            => $color_scheme[0],
		);

	$color_scheme_css = photoblogster_get_color_scheme_css( $color);

	wp_add_inline_style( 'photoblogster-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'photoblogster_color_scheme_css' );

/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function photoblogster_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'accent_color'            => '',
		) );

	$css = <<<CSS
	/* Color Scheme */

	/* Accent Color */
	a,a:visited,a:active,a:hover,a:focus,#secondary .widget #recentcomments a, #secondary .widget .rsswidget {
		color: {$colors['accent_color']};
	}

	@media (min-width:767px) {
		.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus {	    
			background-color: {$colors['accent_color']} !important;
			color:#fff !important;
		}
		.dropdown-menu .current-menu-item.current_page_item a, .dropdown-menu .current-menu-item.current_page_item a:hover, .dropdown-menu .current-menu-item.current_page_item a:active, .dropdown-menu .current-menu-item.current_page_item a:focus {
			background: {$colors['accent_color']} !important;
			color:#fff !important
		}
	}
	@media (max-width:767px) {
		.dropdown-menu .current-menu-item.current_page_item a, .dropdown-menu .current-menu-item.current_page_item a:hover, .dropdown-menu .current-menu-item.current_page_item a:active, .dropdown-menu .current-menu-item.current_page_item a:focus, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .navbar-default .navbar-nav .open .dropdown-menu > li.active > a {
			border-left: 3px solid {$colors['accent_color']};
		}
	}
	.btn, .btn-default:visited, .btn-default:active:hover, .btn-default.active:hover, .btn-default:active:focus, .btn-default.active:focus, .btn-default:active.focus, .btn-default.active.focus {
		background: {$colors['accent_color']};
	}
	.cat-links a, .tags-links a {
		color: {$colors['accent_color']};
	}
	.navbar-default .navbar-nav > li > .dropdown-menu > li > a:hover, .navbar-default .navbar-nav > li > .dropdown-menu > li > a:focus {
		color: #fff;
		background-color: {$colors['accent_color']};
	}
	h5.entry-date a:hover {
		color: {$colors['accent_color']};
	}
	#respond input#submit {
	background-color: {$colors['accent_color']};
	background: {$colors['accent_color']};
}
blockquote {
	border-left: 5px solid {$colors['accent_color']};
}
.entry-title a:hover,.entry-title a:focus{
	color: {$colors['accent_color']};
}
.entry-header .entry-meta::after{
	background: {$colors['accent_color']};
}
.readmore-btn, .readmore-btn:visited, .readmore-btn:active, .readmore-btn:hover, .readmore-btn:focus {
	background: {$colors['accent_color']};
}
.post-password-form input[type="submit"],.post-password-form input[type="submit"]:hover,.post-password-form input[type="submit"]:focus,.post-password-form input[type="submit"]:active,.search-submit,.search-submit:hover,.search-submit:focus,.search-submit:active {
	background-color: {$colors['accent_color']};
	background: {$colors['accent_color']};
	border-color: {$colors['accent_color']};
}
.fa {
	color: {$colors['accent_color']};
}
.btn-default{
	border-bottom: 1px solid {$colors['accent_color']};
}
.btn-default:hover, .btn-default:focus{
	border-bottom: 1px solid {$colors['accent_color']};
	background-color: {$colors['accent_color']};
}
.nav-previous:hover, .nav-next:hover{
	border: 1px solid {$colors['accent_color']};
	background-color: {$colors['accent_color']};
}
.next-post a:hover,.prev-post a:hover{
	color: {$colors['accent_color']};
}
.posts-navigation .next-post a:hover .fa, .posts-navigation .prev-post a:hover .fa{
	color: {$colors['accent_color']};
}
	#secondary .widget a:hover,	#secondary .widget a:focus{
color: {$colors['accent_color']};
}
	#secondary .widget_calendar tbody a {
background-color: {$colors['accent_color']};
color: #fff;
padding: 0.2em;
}
	#secondary .widget_calendar tbody a:hover{
background-color: {$colors['accent_color']};
color: #fff;
padding: 0.2em;
}	
CSS;

return $css;
}



/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 */
function photoblogster_customize_control_js() {
	wp_enqueue_script( 'photoblogster-color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
	wp_localize_script( 'photoblogster-color-scheme-control', 'colorScheme', photoblogster_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'photoblogster_customize_control_js' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function photoblogster_customize_preview_js() {
	wp_enqueue_script( 'photoblogster_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'photoblogster_customize_preview_js' );



if(! function_exists('photoblogster_usercsschanges' ) ):
function photoblogster_usercsschanges(){
	?>
	<style type="text/css">
	span.readmore-button,span.featured-button { background: <?php echo esc_attr(get_theme_mod( 'topleft_icon_color')); ?>; }
	.site-header { padding-top: <?php echo esc_attr(get_theme_mod( 'header_top_padding')); ?>px; }
	.site-header { padding-bottom: <?php echo esc_attr(get_theme_mod( 'header_bottom_padding')); ?>px; }
	.site-header { background: <?php echo esc_attr(get_theme_mod( 'header_bg_color')); ?>; }
	.footer-widgets h3 { color: <?php echo esc_attr(get_theme_mod( 'footer_widget_title_colors')); ?>; }
	.site-footer { background: <?php echo esc_attr(get_theme_mod( 'footer_copyright_background_color')); ?>; }
	.footer-widget-wrapper { background: <?php echo esc_attr(get_theme_mod( 'footer_colors')); ?>; }
	.copy-right-section { color: <?php echo esc_attr(get_theme_mod( 'footer_copyright_text_color')); ?>; }
	#secondary h3.widget-title, #secondary h4.widget-title { color: <?php echo esc_attr(get_theme_mod( 'sidebar_headline_colors')); ?>; }
	.secondary-inner { background: <?php echo esc_attr(get_theme_mod( 'sidebar_background_color')); ?>; }
	#secondary .widget a, #secondary .widget a:focus, #secondary .widget a:hover, #secondary .widget a:active, #secondary .widget #recentcomments a, #secondary .widget #recentcomments a:focus, #secondary .widget #recentcomments a:hover, #secondary .widget #recentcomments a:active, #secondary .widget .rsswidget, #secondary .widget .rsswidget:focus, #secondary .widget .rsswidget:hover, #secondary .widget .rsswidget:active { color: <?php echo esc_attr(get_theme_mod( 'sidebar_link_color')); ?>; }
	.navbar-default,.navbar-default li>.dropdown-menu, .navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dr { background-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; }
	.home .lh-nav-bg-transform li>.dropdown-menu:after { border-bottom-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; }
	.navbar-default .navbar-nav>li>a, .navbar-default li>.dropdown-menu>li>a, .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:active, .navbar-default .navbar-nav>li>a:visited, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus { color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; }
	.navbar-default .navbar-brand, .navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus { color: <?php echo esc_attr(get_theme_mod( 'navigation_logo_color')); ?>; }
	h1.entry-title, .entry-header .entry-title a, .page .container article h2, .page .container article h3, .page .container article h4, .page .container article h5, .page .container article h6, .single article h1, .single article h2, .single article h3, .single article h4, .single article h5, .single article h6, .page .container article h1, .single article h1, .single h2.comments-title, .single .comment-respond h3#reply-title, .page h2.comments-title, .page .comment-respond h3#reply-title { color: <?php echo esc_attr(get_theme_mod( 'headline_color')); ?>; }
	.single .entry-content, .page .entry-content, .single .entry-summary, .page .entry-summary, .page .post-feed-wrapper p, .single .post-feed-wrapper p, .single .post-comments, .page .post-comments, .single .post-comments p, .page .post-comments p, .single .next-article a p, .single .prev-article a p, .page .next-article a p, .page .prev-article a p, .single thead, .page thead { color: <?php echo esc_attr(get_theme_mod( 'post_content_color')); ?>; }
	.page .container .entry-date, .single-post .container .entry-date, .single .comment-metadata time, .page .comment-metadata time { color: <?php echo esc_attr(get_theme_mod( 'author_line_color')); ?>; }
	.top-widgets { background: <?php echo esc_attr(get_theme_mod( 'top_widget_background_color')); ?>; }
	.top-widgets h3 { color: <?php echo esc_attr(get_theme_mod( 'top_widget_title_color')); ?>; }
	.top-widgets, .top-widgets p { color: <?php echo esc_attr(get_theme_mod( 'top_widget_text_color')); ?>; }
	.bottom-widgets { background: <?php echo esc_attr(get_theme_mod( 'bottom_widget_background_color')); ?>; }
	.bottom-widgets h3 { color: <?php echo esc_attr(get_theme_mod( 'bottom_widget_title_color')); ?>; }
	.frontpage-site-title, .frontpage-site-title:hover, .frontpage-site-title:active, .frontpage-site-title:focus { color: <?php echo esc_attr(get_theme_mod( 'header_image_text_color')) ?>; }
	.frontpage-site-description, .frontpage-site-description:focus, .frontpage-site-description:hover, .frontpage-site-description:active { color: <?php echo esc_attr(get_theme_mod( 'header_image_tagline_color')) ?>; }
	.bottom-widgets, .bottom-widgets p { color: <?php echo esc_attr(get_theme_mod( 'bottom_widget_text_color')); ?>; }
	.footer-widgets, .footer-widgets p { color: <?php echo esc_attr(get_theme_mod( 'footer_widget_text_color')); ?>; }
	.home .lh-nav-bg-transform .navbar-nav>li>a, .home .lh-nav-bg-transform .navbar-nav>li>a:hover, .home .lh-nav-bg-transform .navbar-nav>li>a:active, .home .lh-nav-bg-transform .navbar-nav>li>a:focus, .home .lh-nav-bg-transform .navbar-nav>li>a:visited { color: <?php echo esc_attr(get_theme_mod( 'navigation_frontpage_menu_color')); ?>; }
	.home .lh-nav-bg-transform.navbar-default .navbar-brand, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover, .home .lh-nav-bg-transform.navbar-default .navbar-brand:active, .home .lh-nav-bg-transform.navbar-default .navbar-brand:focus, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover { color: <?php echo esc_attr(get_theme_mod( 'navigation_frontpage_logo_color')); ?>; }
	body, #secondary h4.widget-title { background-color: <?php echo esc_attr(get_theme_mod( 'background_elements_color')); ?>; }
	.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus{color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; }
	#secondary, #secondary .widget, #secondary p{color: <?php echo esc_attr(get_theme_mod( 'sidebar_text_color')); ?>; }
	.footer-widgets, .footer-widgets p{color: <?php echo esc_attr(get_theme_mod( 'footer_widget_text_colors')); ?>; }
	.footer-widgets a, .footer-widgets li a{color: <?php echo esc_attr(get_theme_mod( 'footer_widget_link_colors')); ?>; }
	.copy-right-section{border-top: 1px solid <?php echo esc_attr(get_theme_mod( 'footer_copyright_border_color')); ?>; }
	.copy-right-section{border-top: 1px solid <?php echo esc_attr(get_theme_mod( 'footer_copyright_border_color')); ?>; }
	.single .entry-content a, .page .entry-content a, .single .post-comments a, .page .post-comments a, .single .next-article a, .single .prev-article a, .page .next-article a, .page .prev-article a {color: <?php echo esc_attr(get_theme_mod( 'post_link_color')); ?>; }
	.single .post-content, .page .post-content, .single .comments-area, .page .comments-area, .single .post-comments, .page .single-post-content, .single .post-comments .comments-area, .page .post-comments .comments-area, .single .next-article a, .single .prev-article a, .page .next-article a, .page .prev-article a, .page .post-comments {background: <?php echo esc_attr(get_theme_mod( 'post_background_color')); ?>; }
	.article-grid-container article{background: <?php echo esc_attr(get_theme_mod( 'post_feed_post_background')); ?>; }
	.article-grid-container .post-feed-wrapper p{color: <?php echo esc_attr(get_theme_mod( 'post_feed_post_text')); ?>; }
	.post-thumbnail-wrap.no-img .entry-title a, .post-thumbnail-wrap.no-img .entry-title a:hover, .post-thumbnail-wrap.no-img .entry-title a:active, .post-thumbnail-wrap.no-img .entry-title a:focus, .post-thumbnail-wrap.no-img .entry-title a:visited{color: <?php echo esc_attr(get_theme_mod( 'post_feed_post_headline')); ?>; }
	.post-thumbnail-wrap .entry-date{color: <?php echo esc_attr(get_theme_mod( 'post_feed_post_date_noimage')); ?>; }
	.article-grid-container .post-thumbnail-wrap .entry-date{color: <?php echo esc_attr(get_theme_mod( 'post_feed_post_date_withimage')); ?>; }
	.blog .next-post a, .blog .prev-post a{background: <?php echo esc_attr(get_theme_mod( 'post_feed_post_button')); ?>; }
	.blog .next-post a, .blog .prev-post a, .blog .next-post a i.fa, .blog .prev-post a i.fa, .blog .posts-navigation .next-post a:hover .fa, .blog .posts-navigation .prev-post a:hover .fa{color: <?php echo esc_attr(get_theme_mod( 'post_feed_post_button_text')); ?>; }
	@media (max-width:767px){	
		.home .lh-nav-bg-transform { background-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?> !important; }
		.navbar-default .navbar-nav .open .dropdown-menu>li>a, .navbar-default .navbar-nav .open .dropdown-menu>li>a, .navbar-default .navbar-nav .open .dropdown-menu>li>a,.navbar-default .navbar-nav .open .dropdown-menu>li>a,:focus, .navbar-default .navbar-nav .open .dropdown-menu>li>a,:visited, .home .lh-nav-bg-transform .navbar-nav>li>a, .home .lh-nav-bg-transform .navbar-nav>li>a:hover, .home .lh-nav-bg-transform .navbar-nav>li>a:visited, .home .lh-nav-bg-transform .navbar-nav>li>a:focus, .home .lh-nav-bg-transform .navbar-nav>li>a:active, .navbar-default .navbar-nav .open .dropdown-menu>li>a:active, .navbar-default .navbar-nav .open .dropdown-menu>li>a:focus, .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover, .navbar-default .navbar-nav .open .dropdown-menu>li>a:visited, .navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:active, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover {color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; }
		.home .lh-nav-bg-transform.navbar-default .navbar-brand, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover, .home .lh-nav-bg-transform.navbar-default .navbar-brand:focus, .home .lh-nav-bg-transform.navbar-default .navbar-brand:active { color: <?php echo esc_attr(get_theme_mod( 'navigation_logo_color')); ?>; }
		.navbar-default .navbar-toggle .icon-bar, .navbar-default .navbar-toggle:focus .icon-bar, .navbar-default .navbar-toggle:hover .icon-bar{ background-color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; }
		.navbar-default .navbar-nav .open .dropdown-menu > li > a {border-left-color: <?php echo esc_attr(get_theme_mod( 'navigation_text_color')); ?>; }
	}
	
	<?php if ( get_theme_mod( 'toggle_header_frontpage' ) == '1' ) : ?>
	.navbar-default .navbar-brand, .navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus { color: <?php echo esc_attr(get_theme_mod( 'navigation_logo_color')); ?> !important; }
	.home .lh-nav-bg-transform.navbar-default .navbar-brand, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover, .home .lh-nav-bg-transform.navbar-default .navbar-brand:active, .home .lh-nav-bg-transform.navbar-default .navbar-brand:focus, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover { color: <?php echo esc_attr(get_theme_mod( 'navigation_frontpage_logo_color')); ?> !important; }
	.lh-nav-bg-transform li>.dropdown-menu:after { border-bottom-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?>; }

	@media (max-width:767px){	
		.lh-nav-bg-transform { background-color: <?php echo esc_attr(get_theme_mod( 'navigation_background_color')); ?> !important; }
		.home .lh-nav-bg-transform.navbar-default .navbar-brand, .home .lh-nav-bg-transform.navbar-default .navbar-brand:hover, .home .lh-nav-bg-transform.navbar-default .navbar-brand:focus, .home .lh-nav-bg-transform.navbar-default .navbar-brand:active { color: <?php echo esc_attr(get_theme_mod( 'navigation_logo_color')); ?> !important; }

	}
	<?php endif; ?>

	</style>
	<?php }
	add_action( 'wp_head', 'photoblogster_usercsschanges' );
	endif;


/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 */
function photoblogster_color_scheme_css_template() {
	$colors = array(
		'accent_color'            => '{{ data.accent_color }}',
		);
		?>
		<script type="text/html" id="tmpl-photoblogster-color-scheme">
		<?php echo esc_html(photoblogster_get_color_scheme_css( $colors )); ?>
		</script>
		<?php
	}
	add_action( 'customize_controls_print_footer_scripts', 'photoblogster_color_scheme_css_template' );
