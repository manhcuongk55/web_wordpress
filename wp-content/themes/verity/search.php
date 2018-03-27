<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Verity
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) : ?>

				<div class="archive-posts-wrapper search-result-wrapper">
					<div class="archive-heading-wrapper">
						<header class="page-header">
							<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'verity' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header><!-- .page-header -->
						<div class="square"><?php echo verity_get_svg( array( 'icon' => 'square' ) ); ?><span class="screen-reader-text"><?php esc_html_e( 'Square', 'verity' ); ?></span></div>
					</div><!-- .archive-heading-wrapper -->	

					<div id="infinite-post-wrap" class="archive-post-search-result archive-post-wrap section-content-wrap">
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content/content', 'search' );

						endwhile; ?>
					</div><!-- #infinite-post-wrap -->

					<?php verity_content_nav(); ?>

				</div><!-- .archive-posts-wrapper -->

			<?php else :

				get_template_part( 'template-parts/content/content', 'none' );

			endif; ?>
			
		</main><!-- #main -->
	</section><!-- #primary -->
<?php
get_sidebar();
get_footer();