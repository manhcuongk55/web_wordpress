<?php
/**
 * Template part for displaying Recent Posts in the front page template
 *
 * @package Verity
 */

//Get just the first sticky post, if none get the last post published
$args = array(
	'posts_per_page' => 1,
	'post__in'  => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1,
	'paged' => ''
);

// Filter categories if selected in theme options
$cats = get_theme_mod( 'verity_front_page_category' );

if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
	$args['category__in'] = $cats;
}

$first_post_query = new WP_Query( $args );

if( $first_post_query -> have_posts() ) :

	$blog_display	= get_option( 'jetpack_content_blog_display');

	if ( 'content' == $blog_display ) : ?>

		<div class="singular-content-wrap first-post">
			<?php while ( $first_post_query -> have_posts() ) : $first_post_query -> the_post();

				get_template_part( 'template-parts/content/content' );

			endwhile; ?>
		</div>

	<?php else : ?>

		<div id="first-post-wrap" class="first-post">

			<?php while ( $first_post_query -> have_posts() ) : $first_post_query -> the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-thumbnail archive-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'verity-first-image' ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="entry-container">

						<?php if ( 'post' === get_post_type() ) :
							get_template_part( 'template-parts/content/content', 'meta' );
						endif; ?>

						<header class="entry-header">
							<?php
								the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
						</header>

						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div>

						<?php verity_entry_footer(); ?>

					</div><!-- .entry-container -->

				</article><!-- #post-## -->

			<?php endwhile; ?>

		</div><!-- .first-post-wrapper -->

	<?php endif;

	wp_reset_postdata();

endif;
