<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
* Please browse readme.txt for credits and forking information
 * @package photoblogster
 */

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width" />
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="page" class="hfeed site">
    <header id="masthead">
      <nav class="navbar lh-nav-bg-transform navbar-default navbar-fixed-top navbar-left"> 
        <!-- Brand and toggle get grouped for better mobile display --> 
        <div class="container" id="navigation_menu">
          <div class="navbar-header"> 
            <?php if ( has_nav_menu( 'primary' ) ) { ?>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> 
              <span class="sr-only"><?php echo esc_html('Toggle Navigation', 'photoblogster') ?></span> 
              <span class="icon-bar"></span> 
              <span class="icon-bar"></span> 
              <span class="icon-bar"></span> 
            </button> 
            <?php } ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <?php 
              if (!has_custom_logo()) { 
                echo '<div class="navbar-brand">'; bloginfo('name'); echo '</div>';
              } else {
                the_custom_logo();
              } ?>
            </a>
          </div> 
          <?php if ( has_nav_menu( 'primary' ) ) {
              photoblogster_header_menu(); // main navigation 
            }
            ?>

          </div><!--#container-->
        </nav>
        <?php if ( is_front_page() ) { ?>
        <div class="site-header">
          <div class="site-branding"> 
            <span class="home-link">
            <span class="frontpage-site-title site-title"><?php bloginfo( 'name' ); ?></span>
        <span class="frontpage-site-description site-description"><?php bloginfo( 'description' ); ?></span>
    </span>

  </div><!--.site-branding-->
</div><!--.site-header--> 
<?php } ?>


</header>    

<div id="content" class="site-content">