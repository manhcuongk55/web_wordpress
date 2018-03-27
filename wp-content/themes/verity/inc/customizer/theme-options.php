<?php
/**
 * Verity Theme Options
 *
 * @package Verity
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function verity_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'verity_theme_options', array(
        'title'    => esc_html__( 'Theme Options', 'verity' ),
        'priority' => 130,
    ) );

    // Breadcrumb Option
    $wp_customize->add_section( 'verity_breadcrumb_options', array(
        'description'   => esc_html__( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance. You can enable/disable them on homepage and entire site.', 'verity' ),
        'panel'         => 'verity_theme_options',
        'title'         => esc_html__( 'Breadcrumb', 'verity' ),
    ) );

    $wp_customize->add_setting( 'verity_breadcrumb_option', array(
        'default'           => 1,
        'sanitize_callback' => 'verity_sanitize_checkbox'
    ) );

    $wp_customize->add_control( 'verity_breadcrumb_option', array(
        'label'    => esc_html__( 'Check to enable Breadcrumb', 'verity' ),
        'section'  => 'verity_breadcrumb_options',
        'type'     => 'checkbox',
    ) );
    // Breadcrumb Option End

    $wp_customize->add_section( 'verity_header_media_options', array(
        'title' => esc_html__( 'Header Media Options', 'verity' ),
        'panel' => 'verity_theme_options'
    ) );

    $wp_customize->add_setting( 'verity_header_media_text', array(
        'default'           => esc_html__( 'This is Header Media Text.', 'verity' ),
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'verity_header_media_text', array(
        'label'   => esc_html__( 'Header Media Text', 'verity' ),
        'section' => 'verity_header_media_options',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_section( 'verity_menu_options', array(
        'title' => esc_html__( 'Menu Options', 'verity' ),
        'panel' => 'verity_theme_options'
    ) );

    /* Menu Type */
    $wp_customize->add_setting( 'verity_menu_type', array(
        'default'           => 'default',
        'sanitize_callback' => 'verity_sanitize_select',
    ) );

    $wp_customize->add_control( 'verity_menu_type', array(
        'label'    => esc_html__( 'Menu Type', 'verity' ),
        'section'  => 'verity_menu_options',
        'type'     => 'radio',
        'choices'  => array(
            'default' => esc_html__( 'Default', 'verity' ),
            'classic' => esc_html__( 'Classic', 'verity' ),
        ),
    ) );

    $wp_customize->add_section( 'verity_layout_options', array(
        'title' => esc_html__( 'Layout Options', 'verity' ),
        'panel' => 'verity_theme_options'
    ) );

    /* Default Layout */
    $wp_customize->add_setting( 'verity_default_layout', array(
        'default'           => 'no-sidebar',
        'sanitize_callback' => 'verity_sanitize_select',
    ) );

    $wp_customize->add_control( 'verity_default_layout', array(
        'description'       => esc_html__( 'Layout for Singular Post Types like Post, Page', 'verity' ),
         'label'    => esc_html__( 'Singular Content Layout', 'verity' ),
        'section'  => 'verity_layout_options',
        'type'     => 'radio',
        'choices'  => array(
            'left-sidebar'          => esc_html__( 'Left Sidebar ( Primary Sidebar, Content )', 'verity' ),
            'no-sidebar'            => esc_html__( 'No Sidebar', 'verity' ),
        ),
    ) );

    // Excerpt Options
    $wp_customize->add_section( 'verity_excerpt_options', array(
        'panel'     => 'verity_theme_options',
        'title'     => esc_html__( 'Excerpt Options', 'verity' ),
    ) );

    $wp_customize->add_setting( 'verity_excerpt_length', array(
        'default'           => '30',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'verity_excerpt_length', array(
        'description' => esc_html__('Excerpt length. Default is 30 words', 'verity'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'width: 60px;'
            ),
        'label'    => esc_html__( 'Excerpt Length (words)', 'verity' ),
        'section'  => 'verity_excerpt_options',
        'type'     => 'number',
        )
    );

    $wp_customize->add_setting( 'verity_excerpt_more_text', array(
        'default'           => esc_html__( 'Continue reading', 'verity' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'verity_excerpt_more_text', array(
        'label'    => esc_html__( 'Read More Text', 'verity' ),
        'section'  => 'verity_excerpt_options',
        'type'     => 'text',
    ) );
    // Excerpt Options End

    //Homepage / Frontpage Options
    $wp_customize->add_section( 'verity_homepage_options', array(
        'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'verity' ),
        'panel'       => 'verity_theme_options',
        'title'       => esc_html__( 'Homepage / Frontpage Options', 'verity' ),
    ) );

    $wp_customize->add_setting( 'verity_front_page_category', array(
        'default'           => array(),
        'sanitize_callback' => 'verity_sanitize_category_list',
    ) );

    $wp_customize->add_control( new VerityCustomizeDropdownCategoriesControl( $wp_customize, 'verity_front_page_category', array(
        'label'             => esc_html__( 'Select Categories', 'verity' ),
        'name'              => 'verity_front_page_category',
        'section'           => 'verity_homepage_options',
        'type'              => 'dropdown-categories',
    ) ) );

    // Disable Recent post in static frontpage
    $wp_customize->add_setting( 'verity_enable_static_page_posts', array(
        'sanitize_callback' => 'verity_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'verity_enable_static_page_posts', array(
        'label'           => esc_html__( 'Check to Enable Recent Posts on Static Frontpage', 'verity' ),
        'section'         => 'verity_homepage_options',
        'type'            => 'checkbox',
    ) );
    //Homepage / Frontpage Settings End


    // Pagination Options
    $nav_desc = sprintf( esc_html__( 'Infinite Scroll Options requires %1$sJetPack Plugin%2$s with Infinite Scroll module Enabled.', 'verity' ), '<a target="_blank" href="' . esc_url( 'https://wordpress.org/plugins/jetpack/' ) . '">', '</a>' );

    $wp_customize->add_section( 'verity_pagination_options', array(
        'description'   => $nav_desc,
        'panel'         => 'verity_theme_options',
        'title'         => esc_html__( 'Pagination Options', 'verity' ),
    ) );

    $wp_customize->add_setting( 'verity_pagination_type', array(
        'default'           => 'default',
        'sanitize_callback' => 'verity_sanitize_select',
    ) );

    $wp_customize->add_control( 'verity_pagination_type', array(
        'choices'  => verity_get_pagination_types(),
        'label'    => esc_html__( 'Pagination type', 'verity' ),
        'section'  => 'verity_pagination_options',
        'type'     => 'select',
    ) );
    // Pagination Options End

    /* Scrollup Options */
    $wp_customize->add_section( 'verity_scrollup', array(
        'panel'    => 'verity_theme_options',
        'title'    => esc_html__( 'Scrollup Options', 'verity' ),
    ) );

    $wp_customize->add_setting( 'verity_disable_scrollup', array(
        'sanitize_callback' => 'verity_sanitize_checkbox',
    ) );

    $wp_customize->add_control( 'verity_disable_scrollup', array(
        'label'     => esc_html__( 'Check to disable Scroll Up', 'verity' ),
        'section'   => 'verity_scrollup',
        'type'      => 'checkbox',
    ) );
}
add_action( 'customize_register', 'verity_theme_options' );
