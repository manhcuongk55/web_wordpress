<?php
/**
 * Displays footer widgets if assigned
 *
 * @package Verity
 */

?>

<?php
if ( is_active_sidebar( 'sidebar-2' ) ||
	 is_active_sidebar( 'sidebar-3' ) ||
	 is_active_sidebar( 'sidebar-4' ) ) :
?>

	<aside id="tertiary" <?php verity_footer_sidebar_class(); ?> role="complementary">
		<div class="curve"><?php echo verity_get_svg( array( 'icon' => 'curve' ) ); ?><span class="screen-reader-text"><?php esc_html_e( 'Curve', 'verity' ); ?></span></div>
		<?php
		if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<div class="widget-column footer-widget-1">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
		<?php }
		if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
			<div class="widget-column footer-widget-2">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div>
		<?php }
		if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
			<div class="widget-column footer-widget-3">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div>	
		<?php }
		?>
	</aside><!-- .widget-area -->

<?php endif; ?>