<?php
/**
 * functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 */

/*
    lib/setup.php
	- Let WordPress manage the document title.
	- Enable support for Post Thumbnails on posts and pages.
	- wp_nav_menu()
	- Support to output valid HTML5
	- Set content_width
	- Enqueue scripts and styles.
*/
require get_template_directory() . '/lib/setup.php';

/*
    lib/cleanup.php
	- Remove Unnecessary “Junk” from head tag
*/
require get_template_directory() . '/lib/cleanup.php';


/*
    lib/dashboard.php
	- dashboard customize
*/
require get_template_directory() . '/lib/dashboard.php';

