<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Verity
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-container">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta-wrapper">
				<?php get_template_part( 'template-parts/content/content', 'meta' ); ?>
			</div>
		<?php endif; ?>

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->
		<div class="square"><?php echo verity_get_svg( array( 'icon' => 'square' ) ); ?><span class="screen-reader-text"><?php esc_html_e( 'Square', 'verity' ); ?></span></div>

		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'verity' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

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

		<?php verity_entry_footer(); ?>

	</div><!-- .entry-container -->

</article><!-- #post-## -->