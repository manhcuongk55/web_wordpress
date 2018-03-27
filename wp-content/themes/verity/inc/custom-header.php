<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Verity
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses verity_header_style()
 */
function verity_custom_header_setup() {
	$default_image =  '%s/assets/images/header.jpg';
	
	if ( function_exists( 'get_parent_theme_file_uri' ) ) {
		$default_image =  get_parent_theme_file_uri( '/assets/images/header.jpg' );
	}

	add_theme_support( 'custom-header', apply_filters( 'verity_custom_header_args', array(
			'default-image'    => $default_image,
			'default-text-color' => '222222',
			'width'              => 1332, /* 16:9 Aspect Ratio */
			'height'             => 749,
			'flex-width'         => true,
			'flex-height'        => true,
			'wp-head-callback'   => 'verity_header_style',
			'video'              => true,
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header.jpg',
			'thumbnail_url' => '%s/assets/images/header.jpg',
			'description'   => esc_html__( 'Default Header Image', 'verity' ),
		),
	) );	
}
add_action( 'after_setup_theme', 'verity_custom_header_setup' );

if ( ! function_exists( 'verity_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see verity_custom_header_setup().
 */
function verity_header_style() {
 	$header_text_color = get_header_textcolor();
 	$abs_header_text_color = get_theme_mod( 'verity_header_textcolor_bg_media' );
    $header_image = get_header_image();	

    if ( $header_image ) : ?>
        <style type="text/css">
            .custom-header:before {
                background-image: url( <?php echo esc_url( $header_image ); ?>);
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				content: "";
				display: block;
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				z-index: -1;
            }
        </style>
    <?php
    endif;

    /*
     * If no custom options for text are set, let's bail.
     */
    if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
        return;
    }
    
    // If we get this far, we have custom styles. Let's do this.
    ?>
    <style type="text/css">
    <?php
        // Has the text been hidden?
        if ( ! display_header_text() ) :
    ?>
        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }
    <?php
        // If the user has set a custom color for the text use that.
        else :

        	if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color ) :
			?>
		        .site-title a,
		        .site-description {
		            color: #<?php echo esc_attr( $header_text_color ); ?>;
		        }
		    <?php endif;
		    

			if ( $abs_header_text_color && '#ffffff' != $abs_header_text_color ) :
			?>
				.absolute-header .site-title a,
				.absolute-header .site-description {
					color: <?php echo esc_attr( $abs_header_text_color ); ?>;
				}
			<?php endif;
		
    endif; ?>
    </style>     

	<?php
}
endif;

/**
 * Customize video play/pause button in the custom header.
 */
function verity_video_controls( $settings ) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'verity' ) . '</span>' . verity_get_svg( array( 'icon' => 'play' ) );
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'verity' ) . '</span>' . verity_get_svg( array( 'icon' => 'pause' ) );
	return $settings;
}
add_filter( 'header_video_settings', 'verity_video_controls' );