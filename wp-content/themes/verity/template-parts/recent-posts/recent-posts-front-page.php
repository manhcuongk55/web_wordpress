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
		<div class="curve"><?php echo verity_get_svg( array(
			'icon' => 'curve',
		), true ); ?></div>

		<?php get_template_part( 'template-parts/recent-posts/front-recent-posts' ); ?>

	</div><!-- .section-content-wrap -->
</div><!-- .section -->
