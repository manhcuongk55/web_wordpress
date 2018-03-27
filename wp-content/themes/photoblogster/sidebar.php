<?php
/**
 * The sidebar containing the main widget area.
 *
 * Please browse readme.txt for credits and forking information
 * @package photoblogster
 */
?>

<div id="secondary" class="col-md-4 sidebar widget-area" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
<div class="secondary-inner">
		<?php do_action( 'photoblogster_before_sidebar' ); ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary .widget-area -->
<?php endif; ?>
</div>


