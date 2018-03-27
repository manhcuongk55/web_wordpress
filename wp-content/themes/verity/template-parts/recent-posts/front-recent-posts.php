<?php
/**
 * Template part for displaying Recent Posts in the front page template
 *
 * @package Verity
 */

// Get just the first sticky post, if none get the last post published.
$args = array(
	'posts_per_page'      => 1,
	'post__in'            => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1,
	'paged'               => '',
);

// Filter categories if selected in theme options
$cats = get_theme_mod( 'verity_front_page_category' );

if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
	$args['category__in'] = $cats;
}

$first_post_query = new WP_Query( $args );

if ( $first_post_query -> have_posts() ) : ?>

	<div id="first-post-wrap" class="first-post">

		<?php while ( $first_post_query -> have_posts() ) : $first_post_query -> the_post(); ?>
			<?php $first_post_id = get_the_ID(); // For later use in next loop. ?>

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

	<?php

	wp_reset_postdata();

endif;
?>

<div id="infinite-post-wrap" class="archive-post-wrap">
	<?php

	$args = array(
		'posts_per_page'      => 4,
		'ignore_sticky_posts' => true,
		'paged'               => '',
	);

	isset( $first_post_id ) ? $args['post__not_in'] = array( $first_post_id ) : '';

	// Filter categories if selected in theme options
	if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
		$args['category__in'] = $cats;
	}

	/**
	 * Show eight latest posts excluding first one
	 */
	$recent_posts = new WP_Query( $args );

	/* Start the Loop */
	while ( $recent_posts->have_posts() ) :
		$recent_posts->the_post();

		get_template_part( 'template-parts/content/content', 'archive' );

	endwhile;

	wp_reset_postdata();
	?>
	<div class="posts-navigation">
		<div class="nav-links">
			<a class="more-recent-posts button" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
				<?php esc_html_e( 'More Posts', 'verity' ); ?>
			</a>
		</div><!-- .nav-links -->
	</div><!-- .posts-navigation -->
</div><!-- .archive-post-wrap -->
