<?php
/**
 * The template used for displaying portfolio on front page
 *
 * @package Verity
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="portfolio-thumbnail post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'verity-featured-archive-image' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<header class="portfolio-entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<?php echo get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<span class="entry-meta portfolio-entry-meta">', esc_html_x(', ', 'Used between list items, there is a space after the comma.', 'verity' ), '</span>' ); ?>
	</header>
</article>