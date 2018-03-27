<?php
/**
 * The template used for displaying hero content
 *
 * @package Verity
 */

$hero_page_id = absint( get_theme_mod( 'verity_hero_content' ) );
// If $page_id is an ID of a published page, return false
if ( 0 == $hero_page_id || ! 'publish' == get_post_status( $page_id ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$hero_query = new WP_Query( ( array( 'page_id' => $hero_page_id ) ) );

while ( $hero_query->have_posts() ) : $hero_query->the_post() ?>
	<div class="hero-content-wrapper section">
		<div class="section-content-wrap">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail hero-image">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'verity-hero-image' ); ?>
						</a>
					</div><!-- .hero-image -->
				<?php endif; ?>
				<div class="entry-container">
					<header class="entry-header">
						<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php
							the_content();

							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'verity' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span class="page-number">',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'verity' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );
						?>
					</div><!-- .entry-content -->

					<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer">
							<?php
								edit_post_link(
									sprintf(
										/* translators: %s: Name of current post */
										esc_html__( 'Edit %s', 'verity' ),
										the_title( '<span class="screen-reader-text">"', '"</span>', false )
									),
									'<span class="edit-link">',
									'</span>'
								);
							?>
						</footer><!-- .entry-footer -->
					<?php endif; ?>
				</div><!-- .entry-container -->
			</article><!-- #post-## -->
		</div><!-- .section-content-wrap -->	
	</div><!-- .section -->	

<?php
endwhile;
wp_reset_postdata();