<?php
/**
 * WP iClean Responsive functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see https://codex.wordpress.org/Theme_Development and
 * https://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 *
 * @package WP iClean Responsive
 * @since 1.0
 */

// Defining Some Variable
if( !defined( 'WP_ICLEAN_RESPONSIVE_VERSION' ) ) {
	define('WP_ICLEAN_RESPONSIVE_VERSION', '1.1.10'); // Theme Version
}
if( !defined( 'WP_ICLEAN_RESPONSIVE_DIR' ) ) {
	define( 'WP_ICLEAN_RESPONSIVE_DIR', dirname( __FILE__ ) );	// Theme dir
}
if( !defined( 'WP_ICLEAN_RESPONSIVE_URL' ) ) {
	define( 'WP_ICLEAN_RESPONSIVE_URL', get_template_directory_uri() );	// Theme url
}

/**
 * WP iClean Responsive setup.
 *
 * Sets up theme defaults and registers the various WordPress features that WP iClean Responsive supports.
 *
 * @package WP iClean Responsive
 * @since 1.0
 */
function wp_iclean_responsive_setup() {

	// Content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1170; /* pixels */
	}
	
	/*
	 * Makes Theme available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on WP iClean Responsive, use a find and replace
	 * to change 'wp-iclean-responsive' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wp-iclean-responsive', get_template_directory() . '/languages' );
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	// Add Title Tag support
	add_theme_support( 'title-tag' );

	// Add logo support
	add_theme_support( 'custom-logo', array(
	   'height'      => 70,
	   'width'       => 300,
	   'flex-width' => true,
	));
	
	$defaults = array(
	'default-image'          => '',
	'width'                  => 1400,
	'height'                 => 500,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $defaults );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Add woocommerce support
	add_theme_support( 'woocommerce' );

	// HTML 5 theme supports
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'link', 'quote', 'status', 'video', 'audio' ) );
	
	// Registring Menus
	register_nav_menus( array(
		'top-menu' 		=> __( 'Top Menu', 'wp-iclean-responsive' ),
		'primary' 		=> __( 'Primary Menu', 'wp-iclean-responsive' ),		
		'responsive'    => __( 'Responsive Menu', 'wp-iclean-responsive' ),
	));
	
	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'wp_iclean_responsive_setup' );


/**
 * Extend the default WordPress body classes.
 *
 * @package WP iClean Responsive
 * @since 1.0
 */
function wp_iclean_responsive_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	// Page template classes
	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'wpcrt-front-design-1';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( is_page_template('page-templates/front-page-two.php') ) {
		$classes[] = 'wpcrt-front-design-2';
	} elseif ( is_page_template('page-templates/front-page-three.php') ) {
		$classes[] = 'wpcrt-front-design-3';
	}

	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
			$classes[] = 'custom-background-white';
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'wpcrt-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'wp_iclean_responsive_body_class' );

/**
 * Remove .sticky from the post_class array
 */
if ( ! function_exists( 'wp_iclean_responsive_filter_post_class' ) ) {
	function wp_iclean_responsive_filter_post_class( $classes ) {
	    if ( ( $key = array_search( 'sticky', $classes ) ) !== false ) {
	        unset( $classes[$key] );
	        $classes[] = 'sticky-post';
	    }
	    return $classes;
	}
	add_filter( 'post_class', 'wp_iclean_responsive_filter_post_class', 20 );
}

// Script Class
require_once( WP_ICLEAN_RESPONSIVE_DIR . '/includes/class-wpcrt-theme-customizer.php' );

// Functions file
require_once( WP_ICLEAN_RESPONSIVE_DIR . '/includes/wpcrt-functions.php' );

// Template Tags HTML
require_once( WP_ICLEAN_RESPONSIVE_DIR . '/includes/wpcrt-template-tags.php' );

// Nav Walker Class
require_once( WP_ICLEAN_RESPONSIVE_DIR . '/includes/class-wpcrt-nav-walker.php' );

// Script Class
require_once( WP_ICLEAN_RESPONSIVE_DIR . '/includes/class-wpcrt-script.php' );

// Widget Class
require_once( WP_ICLEAN_RESPONSIVE_DIR . '/includes/widgets/class-wpcrt-widgets.php' );

// Plugin recomendation class
require_once( WP_ICLEAN_RESPONSIVE_DIR . '/includes/plugins/class-wpcrt-recommendation.php' );

/**
 * Theme default var
 * 
 * @package WP iClean Responsive
 * @since 1.0
 */
 global $wp_iclean_responsive_options;
 
$wp_iclean_responsive_options = wp_iclean_responsive_default_settings();


//------------------

/**
 * Load tab dashboard
 */
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require get_template_directory() . '/includes/dashboard/wpiclt-how-it-work.php';
    
}

if(!function_exists('wpiclt_backend_theme_activation'))
{
	function wpiclt_backend_theme_activation()
	{
		global $pagenow;
		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
		{
			wp_redirect(admin_url().'themes.php?page=wp-iclean-responsive');
		}
	}
	add_action('admin_init','wpiclt_backend_theme_activation');
}