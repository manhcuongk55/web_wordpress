<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Verity
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="archive-posts-wrapper">
				<?php
				if ( have_posts() ) : ?>

					<div class="archive-heading-wrapper">
						<header class="page-header">
							<h1 class="page-title"><?php single_post_title(); ?></h1>
						</header><!-- .page-header -->
						<div class="square"><?php verity_get_svg( array(
							'icon' => 'square',
						), true ); ?></div>

						<div class="archive-description">
							<?php  echo apply_filters( 'the_content', get_post_field( 'post_content', get_option( 'page_for_posts' ) ) ); ?>
						</div>
					</div><!-- .archive-heading-wrapper -->

					<div id="infinite-post-wrap" class="archive-post-wrap">
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content/content', 'archive' );

						endwhile;
						?>
					</div><!-- .archive-post-wrap -->

					<?php
					verity_content_nav();

				else :

					get_template_part( 'template-parts/content/content', 'none' );

				endif; ?>
			</div><!-- .archive-posts-wrapper -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
