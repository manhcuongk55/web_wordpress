<?php
/**
 * Verity Hero Content Options
 * @package Verity
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function verity_hero_content_options( $wp_customize ) {
    $wp_customize->add_section( 'verity_hero_content_options', array(
        'title' => esc_html__( 'Hero Content Options', 'verity' ),
        'panel' => 'verity_theme_options'
    ) );

    /* Hero Content Selector */
    $wp_customize->add_setting( 'verity_hero_content', array(
        'sanitize_callback' => 'absint',
    ) );
    
    $wp_customize->add_control( 'verity_hero_content', array(
        'label'           => esc_html__( 'Select Page', 'verity' ),
        'section'         => 'verity_hero_content_options',
        'type'            => 'dropdown-pages'
    ) );
}
add_action( 'customize_register', 'verity_hero_content_options' );