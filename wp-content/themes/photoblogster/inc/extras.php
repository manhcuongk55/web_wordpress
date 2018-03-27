<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package photoblogster
 *
 * Please browse readme.txt for credits and forking information
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function photoblogster_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  return $classes;
}
add_filter( 'body_class', 'photoblogster_body_classes' );

if ( ! function_exists( 'photoblogster_header_menu' ) ) :
    /**
     * Header menu (should you choose to use one)
     */
  function photoblogster_header_menu() {
      // display the WordPress Custom Menu if available
    wp_nav_menu(array(
      'theme_location'    => 'primary',
      'depth'             => 2,
      'container'         => 'div',
      'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
      'menu_class'        => 'nav navbar-nav',
      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
      'walker'            => new wp_bootstrap_navwalker()
      ));
  } /* end header menu */
  endif;



/**
 * Adds the URL to the top level navigation menu item
 */
function  photoblogster_add_top_level_menu_url( $atts, $item, $args ){
  if ( isset($args->has_children) && $args->has_children  ) {
    $atts['href'] = ! empty( $item->url ) ? $item->url : '';
  }
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'photoblogster_add_top_level_menu_url', 99, 3 );

/**
 * Insert the styles.
 */
function photoblogster_backendfunctions_styles( $hook ) {
  if ( 'appearance_page_photoblogster-infopage' !== $hook ) {
    return;
  }
  wp_enqueue_style( 'photoblogster-infopagecss', get_template_directory_uri() . '/css/admin.css', false, '3.0' );
}
add_action( 'admin_enqueue_scripts', 'photoblogster_backendfunctions_styles' );



/**
 * Insert the theme page.
 */

add_action( 'admin_menu', 'photoblogster_backendfunctions_wrapper' );
function photoblogster_backendfunctions_wrapper() {
  add_theme_page( __('PhotoBlogster Info', 'photoblogster'), __('PhotoBlogster', 'photoblogster'), 'edit_theme_options', 'photoblogster-infopage.php', 'photoblogster_backendfunctions_text');
}

function photoblogster_backendfunctions_text(){ ?>
<div class="text-centering">
  <div class="backend-css customize-photoblogster">
    <h2><?php echo __( 'Welcome to PhotoBlogster', 'photoblogster' ); ?></p></h2>
    <p><?php echo __( 'If you have questions or need help with anything theme related please', 'photoblogster' ); ?><br> <a href="https://lighthouseseooptimization.github.io/wordpress/photoblogster#contact" target="_blank"><?php echo __( 'Email us here', 'photoblogster' ); ?></a> or <?php echo __( 'write to us directly at: Beseenseo@gmail.com', 'photoblogster' ); ?></p>
  </div>
</div>
<div class="text-centering">
  <div class="backend-css customize-photoblogster">
    <h2><?php echo __( 'Do you like PhotoBlogster?', 'photoblogster' ); ?></p></h2>
    <p>
      <?php echo __( 'We work hard & do our best to give you an awesome theme.', 'photoblogster' ); ?><br>
      <?php echo __( 'If you like photoblogster then let the developer know, he gets so happy! ', 'photoblogster' ); ?>
    </p> 
    <a href="https://wordpress.org/support/theme/photoblogster/reviews/" class="review-button" target="_blank"><?php echo __( 'Rate PhotoBlogster', 'photoblogster' ); ?></a>
  </div>
</div>
<h2 class="headline-second"><?php echo __( 'Quick Links', 'photoblogster' ); ?></h2>
<div class="text-centering">
 <div class="backend-css">
   <a class="wide-button-photoblogster" href="<?php echo esc_url(admin_url('/customize.php')); ?>" target="_blank"><?php echo __( 'Customize Theme Design', 'photoblogster' ); ?></a><br>
   <a class="wide-button-photoblogster" href="https://lighthouseseooptimization.github.io/wordpress/photoblogster/" target="_blank"><?php echo __( 'Read About PhotoBlogster Pro', 'photoblogster' ); ?></a><br>
   <a class="wide-button-photoblogster" href="https://lighthouseseooptimization.github.io/wordpress/photoblogster#contact" target="_blank"><?php echo __( 'Contact Us', 'photoblogster' ); ?></a>
 </div>
</div>
<div class="text-centering"><br><br>
  <a href="https://lighthouseseooptimization.github.io/wordpress/photoblogster/" target="_blank">
<?php echo '<a href="https://lighthouseseooptimization.github.io/wordpress/photoblogster/#contact" target="_blank">Email us here</a> or write to us directly at: Beseenseo@gmail.com<br><br><br><a href="https://lighthouseseooptimization.github.io/wordpress/photoblogster/" target="_blank"><img src="' . get_template_directory_uri() . '/images/features.png"></a>'; ?>
  </a>
</div>
<?php }