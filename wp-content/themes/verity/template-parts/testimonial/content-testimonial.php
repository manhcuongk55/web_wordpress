<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Verity
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="testimonial-thumbnail">
			<?php the_post_thumbnail( 'verity-featured-archive-image' ); ?>
		</div>
	<?php endif; ?>

	<?php edit_post_link( esc_html__( 'Edit', 'verity' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article>
