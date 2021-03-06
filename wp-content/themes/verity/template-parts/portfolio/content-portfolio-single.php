<?php
/**
 * @package Verity
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-container">

		<header class="entry-header">
			<div class="entry-meta-wrapper">
				<?php get_template_part( 'template-parts/content/content', 'meta' ); ?>
			</div>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<div class="square"><?php echo verity_get_svg( array( 'icon' => 'square' ) ); ?><span class="screen-reader-text"><?php esc_html_e( 'Square', 'verity' ); ?></span></div>
		
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
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

	</div><!-- .entry-container -->
</article><!-- #post-## -->	

<div class="single-footer-meta-wrapper">
	<div class="footer-meta-area">
		<div id="footer-meta" class="footer-meta-columns">
			<footer class="entry-footer">
				<div class="cat-tags-links">
					<?php
					/* translators: used between list items, there is a space after the comma */
					$separate_meta = esc_html__( ', ', 'verity' );
					$categories_list = get_the_term_list( $post->ID, 'jetpack-portfolio-type', '', esc_html__( ', ', 'verity' ) );

					echo '<span class="cat-links"><span class="categories-label">'. esc_html__( 'Categories: ', 'verity' ) . '</span>' . $categories_list . '</span>'; ?>

					<?php
						/* translators: used between list items, there is a space after the comma */
						$tags_list = get_the_term_list( $post->ID, 'jetpack-portfolio-tag', '', esc_html__( ', ', 'verity' ) );
						if ( $tags_list ) :

						echo '<span class="tags-links"><span class="tags-label">'. esc_html__( 'Tags:  ', 'verity' ) . '</span>' . $tags_list . '</span>'; ?>	
					<?php endif; ?>
				</div>

				<?php edit_post_link( esc_html__( 'Edit', 'verity' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-footer -->

		<div id="footer-author-bio" class="footer-meta-columns">
			<?php verity_author_bio(); ?>
		</div>

		<div id="footer-nagivation" class="footer-meta-columns">
			<?php 
			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav">' . esc_html__( 'Next Post ', 'verity' ) . '</span><span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav">' . esc_html__( 'Previous Post ', 'verity' ) . '</span> ' . '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'verity' ) . '</span><span class="post-title">%title</span>',
			) );
			?>
		</div>

	</div><!-- .footer-meta-area -->
</div><!-- .singular-footer-meta -->