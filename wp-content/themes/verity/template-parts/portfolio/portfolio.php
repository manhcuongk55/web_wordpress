<?php
/** 
 * The template for displaying portfolio items
 *
 * @package Verity
 */

$number = get_theme_mod( 'verity_portfolio_number', 3 );

if ( 0 == $number ) {
	// If number is 0, then this section is disabled
	return;
}

$portfolio_query = new WP_Query( array(
	'post_type'      => 'jetpack-portfolio',
	'posts_per_page' => absint( $number ),
	'no_found_rows'  => true,
) );

$jetpack_portfolio_title = get_option( 'jetpack_portfolio_title', esc_html__( 'Portfolio', 'verity' ) );

if ( post_type_exists( 'jetpack-portfolio' ) && $portfolio_query -> have_posts() ) : ?>

	<div class="portfolio-wrapper section">
		<?php if ( '' != $jetpack_portfolio_title ) : ?>
			<div class="section-heading-wrap">
				<h2 class="section-title"><?php echo esc_html( $jetpack_portfolio_title ); ?></h2>
			</div><!-- .section-heading-wrap -->
		<?php endif; ?>

		<div class="section-content-wrap">
			<div class="curve"><?php echo verity_get_svg( array( 'icon' => 'curve' ) ); ?><span class="screen-reader-text"><?php esc_html_e( 'Curve', 'verity' ); ?></span></div>
			<?php /* Start the Loop */ ?>
			<?php while ( $portfolio_query -> have_posts() ) : $portfolio_query -> the_post(); ?>

				<?php get_template_part( 'template-parts/portfolio/content', 'portfolio' ); ?>

			<?php endwhile; 
			wp_reset_postdata(); ?>
		</div><!-- .section-content-wrap -->
	</div><!-- .section -->

<?php endif; ?>