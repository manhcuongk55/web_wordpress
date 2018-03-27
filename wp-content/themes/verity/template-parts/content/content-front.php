<?php
/**
 * Template part for displaying page content in front-page.php
 *
 * @package Verity
 */

?>

<div class="singular-content-wrap">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail front-page-image">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->
		<?php endif; ?>

		<div class="entry-container">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
</div><!-- .singular-content-wrap -->