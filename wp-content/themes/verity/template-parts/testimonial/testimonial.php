<?php
/** 
 * The template for displaying testimonial items
 *
 * @package Verity
 */

$number = get_theme_mod( 'verity_testimonial_number', 3 );

if ( 0 == $number ) {
	// If number is 0, then this section is disabled
	return;
}
$testimonial_query = new WP_Query( array(
	'post_type'      => 'jetpack-testimonial',
	'posts_per_page' => absint( $number ),
	'no_found_rows'  => true,
) );

// Get Jetpack options for testimonial.
$jetpack_options = get_theme_mod( 'jetpack_testimonials' );

if ( post_type_exists( 'jetpack-testimonial' ) && $testimonial_query -> have_posts() ) : ?>

	
	<?php if ( isset( $jetpack_options['page-title'] ) && $jetpack_options['page-title'] ) : ?>
		<div class="testimonial-wrapper section">
			<div class="section-heading-wrap">
				<h2 class="section-title"><?php echo esc_html( $jetpack_options['page-title'] ); ?></h2>
			</div><!-- .section-heading-wrap -->
		<?php else : ?>
		<div class="testimonial-wrapper section no-headline">	
	<?php endif; ?>

		<div class="section-content-wrap">	
			<?php /* Start the Loop */ ?>
			<?php while ( $testimonial_query -> have_posts() ) : $testimonial_query -> the_post(); ?>

				<?php get_template_part( 'template-parts/testimonial/content', 'testimonial' ); ?>

			<?php endwhile; 
			wp_reset_postdata(); ?>
		</div><!-- .section-content-wrap -->
	</div><!-- .testimonial-wrapper -->

<?php endif; ?>