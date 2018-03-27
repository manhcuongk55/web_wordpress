<?php
/**
 * The Template for displaying all single portfolio posts
 *
 * @package Lodestar
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">
			
			<div class="singular-content-wrap">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/portfolio/content', 'portfolio-single' ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div><!-- #single-content-wrap -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();