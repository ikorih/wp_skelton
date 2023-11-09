<?php
/**
 * functions and definitions
 *
 * @package Wordpress
 */


if ( ! function_exists( 'wp_theme_setup' ) ) :

  /**
   * Set the content width in pixels, based on the theme's design and stylesheet.
   *
   * Priority 0 to make it available to lower priority callbacks.
   *
   * @global int $content_width
   */
  function wp_theme_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'wp_theme_content_width', 980 );
  }
  add_action( 'after_setup_theme', 'wp_theme_content_width', 0 );

  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function wp_theme_setup() {

    require get_template_directory() . '/lib/navwalker.php';

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    //デフォルトで表示されるタイトルの文字を変更する
    function custom_document_title_parts($title_parts)
    {
      //全ページ共通で変更する場合（''の間に変更するタイトルを入れる）
      // $title_parts['title'] = '';       //ページのタイトルを変更
      // $title_parts['tagline'] = '';     //キャッチフレーズを変更
      // $title_parts['site'] = '';        //サイト名を変更
      //大トップページではタイトルの右側にキャッチフレーズがデフォルトで付与されるのを変更
      if (is_home() || is_front_page() || is_page('home')): //アーカイブページの場合
        $title_parts['tagline'] = '';
      endif;
      return $title_parts;
    }
    add_filter('document_title_parts', 'custom_document_title_parts');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
      'global-nav' => esc_html__('グローバルメニュー'),
    ) );

    function custom_global_nav(){
      if (has_nav_menu('global-nav')) {
        wp_nav_menu(array(
          'container' => false,                           // remove nav container
          'container_class' => '',           // class of container (should you choose to use it)
          'menu' => __('グローバルメニュー'),  // nav name
          'menu_class' => 'l-nav__list',  // adding custom nav class
          'theme_location' => 'global-nav',                 // where it's located in the theme
          'before' => '',                                 // before the menu
          'after' => '',                                  // after the menu
          'link_before' => '',                            // before each link
          'link_after' => '',                             // after each link
          'depth' => 2,                                   // limit the depth of the nav
          'walker' => new Global_Nav()              // for gnavi
        ));
      }
    }

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ) );

    // Set up the WordPress core custom background feature.
    // add_theme_support( 'custom-background', apply_filters( 'wp_test_custom_background_args', array(
    // 	'default-color' => 'ffffff',
    // 	'default-image' => '',
    // ) ) );

    // Add theme support for selective refresh for widgets.
    // add_theme_support( 'customize-selective-refresh-widgets' );

  }
endif;
add_action( 'after_setup_theme', 'wp_theme_setup' );



/**
 * Enqueue scripts and styles.
 */
function load_scripts_and_styles()
{
  global $wp_styles;
  if (!is_admin()) {
    wp_register_style('main-stylesheet', get_stylesheet_directory_uri() . '/dist/css/style.css', array(), null, 'all'); // メインCSS
    wp_enqueue_style('main-stylesheet');

    wp_deregister_script('jquery'); // WordpressデフォルトのjQueryを読み込ませない
    $jsCore = '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'; //jQuery CDN
    wp_enqueue_script('jquery', $jsCore, array(), null, true);

    wp_register_script('main-js', get_stylesheet_directory_uri() . '/dist/js/app.bundle.js', null, null, true); // メインJS
    wp_enqueue_script('main-js');
  }
}
add_action('wp_enqueue_scripts', 'load_scripts_and_styles', 999);

// スクリプトを読み込むときに自動で挿入される［type属性］を削除する
function remove_script_type($tag) {
  return str_replace("type='text/javascript' ", "", $tag);
}
add_filter('script_loader_tag','remove_script_type');



