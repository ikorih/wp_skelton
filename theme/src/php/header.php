<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content" class="site__content">
 *
 */
$ua = getenv('HTTP_USER_AGENT');
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="IE=edge" http-equiv=X-UA-Compatible>
    <meta name="format-detection" content="telephone=no">
    <script>
    window.lazySizesConfig = window.lazySizesConfig || {};
    window.lazySizesConfig.customMedia = {
    'sm': '(max-width: 576px)',
      'md': '(max-width: 768px)',
      'lg': '(max-width: 992px)',
      'xl': '(max-width: 1200px)',
      'xxl': '(max-width: 2400px)',
    };
    </script>
    <?php if (strstr($ua, 'Edge')) { ?>
    <!-- polyfill for object-fit (only needed in browsers that don't support object-fit) -->
    <script src="<?php echo get_template_directory_uri(); ?>/dist/js/libs/ls.object-fit.min.js" ></script>
    <?php } elseif (strstr($ua, 'Trident') || strstr($ua, 'MSIE')) { ?>
    <!-- polyfill for node foreach (only needed in browsers that don't support foreach for nodelist) -->
    <script src="<?php echo get_template_directory_uri(); ?>/dist/js/libs/polyfills/polyfil-ie11-nodelist-foreach.js" ></script>
    <!-- polyfill for node object assign (only needed in browsers that don't support object-assign ) -->
    <script src="<?php echo get_template_directory_uri(); ?>/dist/js/libs/polyfills/object-assign.js" ></script>
    <!-- polyfill for object-fit (only needed in browsers that don't support object-fit) -->
    <script src="<?php echo get_template_directory_uri(); ?>/dist/js/libs/ls.object-fit.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/picturefill/3.0.3/picturefill.js"></script>
    <?php } ?>
    <script src="<?php echo get_template_directory_uri(); ?>/dist/js/libs/lazysizes.min.js" async=""></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700&display=swap&subset=japanese" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <!-- [ HEADER-AREA ] -->
    <header id="masthead" class="l-header">
      <div class="l-header__innr">

        <div class="l-header__logo">
<?php
if ( is_front_page() && is_home() ) :
?>
<h1 class="l-header__logo-title"><a class="l-header__logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="l-header__logo-img" src="<?php echo get_template_directory_uri(); ?>/dist/images/sample-logo@2x.png" alt="<?php bloginfo( 'name' ); ?>"></a></h1>
<?php
  else :
?>
<p class="l-header__logo-title"><a class="l-header__logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="l-header__logo-img" src="<?php echo get_template_directory_uri(); ?>/dist/images/sample-logo@2x.png" alt="<?php bloginfo( 'name' ); ?>"></a></p>
<?php
    endif;
?>
        </div><!-- .header__logo -->
        <div class="l-header__nav">
<?php
if ( has_nav_menu( 'global-nav' ) ) :
?>
<nav id="gNav" class="l-nav" aria-label="<?php esc_attr_e( 'Top Menu' ); ?>">
  <div class="l-nav__innr">
    <?php custom_global_nav(); ?>
  </div>
</nav>
<?php
  else :
?>
<?php
    endif;
?>
        </div>

      </div><!-- /.header-inner -->
    </header>
    <!-- /[ HEADER-AREA ] -->

    <!-- [ CONTENT-AREA ] -->
    <div id="content" class="l-content">
