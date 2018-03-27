<?php
/**
 * The static front page template
 *
 * @package Verity
 */

get_header(); ?>

	<?php get_template_part( 'template-parts/portfolio/portfolio' ); ?>

	<?php get_template_part( 'template-parts/content/content', 'hero' ); ?>

	<?php get_template_part( 'template-parts/featured-content/featured-content' ); ?>

	<?php get_template_part( 'template-parts/testimonial/testimonial' ); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php
			if ( 'posts' == get_option( 'show_on_front' ) ) :

				if ( have_posts() ) :
					get_template_part( 'template-parts/recent-posts/recent-posts' );
				else :
					get_template_part( 'template-parts/content/content', 'none' );

				endif;

			else :

				/* Start the Loop for A static page */
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.

				if ( get_theme_mod( 'verity_enable_static_page_posts' ) ) {
					get_template_part( 'template-parts/recent-posts/recent-posts-front-page' );
				}

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
