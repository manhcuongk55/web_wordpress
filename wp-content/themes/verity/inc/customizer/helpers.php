<?php

/**
 * Returns an array of visibility options for featured sections
 *
 * @since Verity 0.2
 */
function verity_section_visibility_options() {
    $options = array(
        'homepage'    => esc_html__( 'Homepage / Frontpage', 'verity' ),
        'entire-site' => esc_html__( 'Entire Site', 'verity' ),
        'disabled'    => esc_html__( 'Disabled', 'verity' ),
    );

    return apply_filters( 'verity_section_visibility_options', $options );
}

/**
 * Returns an array of section types
 *
 * @since Verity 0.2
 */
function verity_section_type_options() {
    $options = array(
        'demo'     => esc_html__( 'Demo', 'verity' ),
        'page'     => esc_html__( 'Page', 'verity' ),
    );

    return apply_filters( 'verity_section_type_options', $options );
}

/**
 * Returns an array of color schemes registered for catchresponsive.
 *
 * @since Verity 0.2
 */
function verity_get_pagination_types() {
    $pagination_types = array(
        'default'                => esc_html__( 'Default(Older Posts/Newer Posts)', 'verity' ),
        'numeric'                => esc_html__( 'Numeric', 'verity' ),
        'infinite-scroll-click'  => esc_html__( 'Infinite Scroll (Click)', 'verity' ),
        'infinite-scroll-scroll' => esc_html__( 'Infinite Scroll (Scroll)', 'verity' ),
    );

    return apply_filters( 'verity_get_pagination_types', $pagination_types );
}