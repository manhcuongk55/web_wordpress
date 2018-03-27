<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * Please browse readme.txt for credits and forking information
 * @package photoblogster
 */

get_header(); ?>
		<div class="container">
   			<div class="row">
				<div id="primary" class="col-md-8 content-area">
					<main id="main" class="site-main" role="main">

						<section class="error-404 not-found">
							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'photoblogster' ); ?></h1>
							</header><!-- .page-header -->

							<div class="page-content">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'photoblogster' ); ?></p>

								<?php get_search_form(); ?>

								</div><!-- .page-content -->
						</section><!-- .error-404 -->

					</main><!-- #main -->
				</div><!-- #primary -->

				<?php get_sidebar('sidebar-1'); ?>

			</div> <!--.row-->            
        </div><!--.container-->
		<?php get_footer(); ?>