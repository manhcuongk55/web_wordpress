<?php
/**
 * Displays header media
 *
 * @package CatchThemes
 * @subpackage Verity
 * @since 1.0
 * @version 1.0
 */

?>

<?php

$def_text = esc_html__( 'This is Header Media Text.', 'verity' );

if ( current_user_can( 'edit_theme_options' ) ) {
	$def_text .= '&nbsp;' . esc_html__( 'You can edit this from Appearance -> Customize -> Theme Options -> Header Media Options -> Header Media Text', 'verity' );
}

$header_media_text = get_theme_mod( 'verity_header_media_text', $def_text );

if ( is_front_page() && ( has_custom_header() || '' !== $header_media_text ) ) : ?>
	<div class="custom-header">
		<?php
		if ( has_custom_header() ) : ?>
			<div class="custom-header-media">
				<?php the_custom_header_markup(); ?>
			</div>
		<?php endif; ?>

		<div class="custom-header-content sections header-media-section">
		<?php if ( '' !== $header_media_text ) : ?>
			<h2 class="section-title"><?php echo esc_html( $header_media_text ); ?></h2>
		<?php endif; ?>
		</div>
		<?php if ( ! has_custom_header() ) : ?>
			<div class="square"><?php echo verity_get_svg( array(
				'icon' => 'square',
			) ); ?><span class="screen-reader-text"><?php esc_html_e( 'Square', 'verity' ); ?></span></div>
		<?php endif; ?>

	</div><!-- .custom-header -->
<?php else :
	if ( is_post_type_archive( 'jetpack-testimonial' ) ) :

		$jetpack_options = get_theme_mod( 'jetpack_testimonials' );
		if ( isset( $jetpack_options['featured-image'] ) && '' !== $jetpack_options['featured-image'] ) : ?>
			<div class="post-thumbnail archive-header-image">
				<?php echo wp_get_attachment_image( (int) $jetpack_options['featured-image'], 'post-thumbnail' ); ?>
			</div>
		<?php endif;

	elseif ( is_post_type_archive( 'jetpack-portfolio' ) ) :

		$jetpack_portfolio_featured_image = get_option( 'jetpack_portfolio_featured_image' );
		if ( '' !== $jetpack_portfolio_featured_image ) : ?>
			<div class="post-thumbnail archive-header-image">
				<?php echo wp_get_attachment_image( (int) $jetpack_portfolio_featured_image, 'post-thumbnail' ); ?>
			</div>
		<?php endif;

	elseif ( verity_jetpack_featured_image_display() ) : ?>
		<div class="post-thumbnail singular-header-image">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->
	<?php endif;

endif;
