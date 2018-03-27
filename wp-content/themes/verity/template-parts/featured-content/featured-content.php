<?php
/**
 * The template for displaying featured content
 *
 * @package Verity
 */

$featured_posts = verity_get_featured_posts();
				 
if ( empty( $featured_posts ) ) {
	return;
}			

$title = get_theme_mod( 'verity_featured_content_archive_title', esc_html__( 'Featured', 'verity' ) );
?>

<div class="featured-content-wrapper section layout-three">

	<?php if ( '' != $title ) : ?>
		<div class="section-heading-wrap">
			<h2 class="section-title"><?php echo wp_kses_post( $title ); ?></h2>
		</div><!-- .section-heading-wrap -->
	<?php endif; ?>

	<div class="section-content-wrap">
		<div class="curve"><?php echo verity_get_svg( array( 'icon' => 'curve' ) ); ?><span class="screen-reader-text"><?php esc_html_e( 'Curve', 'verity' ); ?></span></div>
		<?php

			foreach ( $featured_posts as $post ) {
				setup_postdata( $post );

				// Include the featured content template.
				get_template_part( 'template-parts/featured-content/content', 'featured-content' );
			}

			wp_reset_postdata();
		?>
	</div><!-- .section-content-wrap -->
</div><!-- .section -->