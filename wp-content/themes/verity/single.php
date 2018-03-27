<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Verity
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<div class="singular-content-wrap">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content/content', 'single' ) ?>

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
