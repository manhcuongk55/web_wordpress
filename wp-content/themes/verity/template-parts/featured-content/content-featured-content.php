<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Verity
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-content-thumbnail post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'verity-featured-archive-image' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<header class="featured-content-entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

		<?php
			$show_content = get_theme_mod( 'verity_featured_content_show' );

			if ( 'excerpt' == $show_content ) {
				echo '<div class="entry-summary"><p>';
				the_excerpt();
				echo '</p></div><!-- .entry-summary -->';
			}
			elseif ( 'full-content' == $show_content ) {
				echo '<div class="entry-content">';
				the_content();
				echo '</div><!-- .entry-content -->';
			}
		?>

		<?php verity_entry_categories(); ?>
	</header>
</article>