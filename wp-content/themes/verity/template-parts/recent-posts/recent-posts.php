<?php
/**
 * The template for displaying recent posts in front-page.php
 *
 * @package Verity
 */
?>

<div class="archive-posts-wrapper section">
	<div class="section-heading-wrap">
		<h2 class="section-title"><?php esc_html_e( 'Recent Posts', 'verity' ); ?></h2>
	</div><!-- .section-heading-wrap -->
	<div class="section-content-wrap">
		<div class="curve"><?php echo verity_get_svg( array( 'icon' => 'curve' ) ); ?><span class="screen-reader-text"><?php esc_html_e( 'Curve', 'verity' ); ?></span></div>

		<?php

		$paged = intval( ( get_query_var('paged') ) ? get_query_var('paged') : 1 );

		if ( 1 == $paged ) :
			/**
			 * Show special first post only in first page
			 */
			?>

			<?php  get_template_part( 'template-parts/recent-posts/content', 'first-recent-posts' ); ?>

		<?php endif; ?>

		<?php
			$blog_display = get_option( 'jetpack_content_blog_display' );

			if ( 'content' == $blog_display ) : ?>

				<div id="infinite-post-wrap" class="singular-content-wrap">
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content/content' );

					endwhile;
					?>
				</div><!-- .singular-content-wrap -->

			<?php else : ?>

				<div id="infinite-post-wrap" class="archive-post-wrap">
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content/content', 'archive' );

					endwhile;
					?>
				</div><!-- .archive-post-wrap -->

			<?php endif;

			verity_content_nav();
		?>
	</div><!-- .section-content-wrap -->
</div><!-- .section -->
