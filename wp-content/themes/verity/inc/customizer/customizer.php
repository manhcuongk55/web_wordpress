<?php
/**
 * Verity Theme Customizer
 *
 * @package Verity
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function verity_customize_register( $wp_customize ) {
	//Important Links
    class VerityImportantLinks extends WP_Customize_Control {
        public $type = 'important-links';

        public function render_content() {
            //Add Theme instruction, Support Forum, Changelog links
            $important_links = array(
                'theme_instructions' => array(
                    'link'  => esc_url( 'https://catchthemes.com/theme-instructions/verity/' ),
                    'text'  => esc_html__( 'Theme Instructions', 'verity' ),
                ),
                'support' => array(
                    'link'  => esc_url( 'https://catchthemes.com/support/' ),
                    'text'  => esc_html__( 'Support', 'verity' ),
                ),
                'changelog' => array(
                    'link'  => esc_url( 'https://catchthemes.com/changelogs/verity-theme/' ),
                    'text'  => esc_html__( 'Changelog', 'verity' ),
                ),
            );

            foreach ( $important_links as $important_link) {
                echo '<p><a target="_blank" href="' . $important_link['link'] .'" >' . $important_link['text'] .' </a></p>';
            }
        }
    }

    //Custom control for dropdown category multiple select
    class VerityCustomizeDropdownCategoriesControl extends WP_Customize_Control {
        public $type = 'dropdown-categories';

        public $name;

        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'             => $this->name,
                    'echo'             => 0,
                    'hide_empty'       => false,
                    'show_option_none' => false,
                    'hide_if_empty'    => false,
                    'show_option_all'  => esc_html__( 'All Categories', 'verity' )
                )
            );

            $dropdown = str_replace('<select', '<select multiple = "multiple" style = "height:95px;" ' . $this->get_link(), $dropdown );

            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );

            echo '<p class="description">'. esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'verity' ) . '</p>';
        }
    }

    //Custom control for any note, use label as output description
    class VerityNoteControl extends WP_Customize_Control {
        public $type = 'description';

        public function render_content() {
            echo '<h2 class="description">' . $this->label . '</h2>';
        }
    }

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    $wp_customize->get_control( 'header_textcolor' )->description = esc_html__( 'Applied when there is no Header Background Media', 'verity' );

    $control = $wp_customize->get_control( 'jetpack_content_blog_display' );
    if ( $control ) {
        //Set JetPack Content Blog Display to refresh customizer page
        $wp_customize->get_setting( 'jetpack_content_blog_display' )->transport = 'refresh';
    }

    /* Add option to Colors for our custom color */
    $wp_customize->add_setting( 'verity_header_textcolor_bg_media', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'verity_header_textcolor_bg_media', array(
        'label'       => esc_html__( 'Header Text Color', 'verity' ),
        'description' => esc_html__( 'Applied when there is Header Background Media', 'verity' ),
        'section'     => 'colors',
        'priority'    => 1
    ) ) );

    /* Add option to JetPack Featured Content Section */
    /* Featured Content Headline */
    $wp_customize->add_setting( 'verity_featured_content_archive_title', array(
        'default'           => esc_html__( 'Featured', 'verity' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'verity_featured_content_archive_title', array(
        'label'    => esc_html__( 'Featured Content Archive Title', 'verity' ),
        'section'  => 'featured_content',
        'type'     => 'text',
        'priority' => '25'
    ) );

    /* Add option to JetPack Testimonial Section */
    /* Testimonial Number */
    $wp_customize->add_setting( 'verity_testimonial_number', array(
        'default'           => '3',
        'sanitize_callback' => 'verity_sanitize_select',
        'active_callback'   => 'is_front_page',
    ) );

    $wp_customize->add_control( 'verity_testimonial_number', array(
        'label'    => esc_html__( 'Number of items to show on front', 'verity' ),
        'section'  => 'jetpack_testimonials',
        'type'     => 'radio',
        'choices'  => array(
            '3'  => esc_html__( '3', 'verity' ),
            '6'  => esc_html__( '6', 'verity' ),
            '9'  => esc_html__( '9', 'verity' ),
            '12' => esc_html__( '12', 'verity' ),
            '0'  => esc_html__( 'Disable', 'verity' ),
        ),
        'priority' => 100
    ) );

    /* Add option to JetPack Portfolio Section */
    /* Portfolio Number */
    $wp_customize->add_setting( 'verity_portfolio_number', array(
        'default'           => '3',
        'sanitize_callback' => 'verity_sanitize_select',
        'active_callback'   => 'is_front_page',
    ) );

    $wp_customize->add_control( 'verity_portfolio_number', array(
        'label'    => esc_html__( 'Number of items to show on frontpage', 'verity' ),
        'section'  => 'jetpack_portfolio',
        'type'     => 'radio',
        'choices'  => array(
            '3'  => esc_html__( '3', 'verity' ),
            '6'  => esc_html__( '6', 'verity' ),
            '9'  => esc_html__( '9', 'verity' ),
            '12' => esc_html__( '12', 'verity' ),
            '0'  => esc_html__( 'Disable', 'verity' ),
        ),
        'priority' => 100
    ) );

    // Reset all settings to default
    $wp_customize->add_section( 'verity_reset_all', array(
        'description'   => esc_html__( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'verity' ),
        'title'         => esc_html__( 'Reset all settings', 'verity' ),
        'priority'      => 998,
    ) );

    $wp_customize->add_setting( 'verity_reset_all_settings', array(
        'sanitize_callback' => 'verity_sanitize_checkbox',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'verity_reset_all_settings', array(
        'label'    => esc_html__( 'Check to reset all settings to default', 'verity' ),
        'section'  => 'verity_reset_all',
        'type'     => 'checkbox',
    ) );
    // Reset all settings to default end

    $wp_customize->add_section( 'verity_important_links', array(
        'priority'      => 999,
        'title'         => esc_html__( 'Important Links', 'verity' ),
    ) );

    /**
     * Has dummy Sanitizaition function as it contains no value to be sanitized
     */
    $wp_customize->add_setting( 'verity_important_links', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new VerityImportantLinks( $wp_customize, 'verity_important_links', array(
        'label'     => __( 'Important Links', 'verity' ),
        'section'   => 'verity_important_links',
        'type'      => 'verity_important_links',
    ) ) );
    //Important Links End
}
add_action( 'customize_register', 'verity_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function verity_customize_preview_js() {
	wp_enqueue_script( 'verity-customizer', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'verity_customize_preview_js' );

/**
 * Include Theme Options
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer/theme-options.php';

/**
 * Include Hero Content
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer/hero-content.php';

/**
 * Include Customizer Helper Functions
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer/helpers.php';

/**
 * Include Sanitization functions
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer/sanitize-functions.php';

/**
 * Include Active Callback functions
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer/active-callbacks.php';

/**
 * Include Upgrade To Pro Button
 */
require trailingslashit( get_template_directory() ) . 'inc/upgrade-button/class-customize.php';


/**
 * Function to reset date with respect to condition
 */
function verity_reset_data() {
    if ( get_theme_mod( 'verity_reset_all_settings' ) ) {
        remove_theme_mods();

        return;
    }
}
add_action( 'customize_save_after', 'verity_reset_data' );
