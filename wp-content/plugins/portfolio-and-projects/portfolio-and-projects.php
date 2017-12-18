<?php
/**
 * Plugin Name: Portfolio and Projects
 * Plugin URI: http://www.wponlinesupport.com/
 * Description: Display Portfolio OR Projects in a grid view. 
 * Author: WP Online Support 
 * Text Domain: portfolio-and-projects
 * Domain Path: /languages/
 * Version: 1.0.3
 * Author URI: http://www.wponlinesupport.com/
 *
 * @package WordPress
 * @author SP Technolab
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( !defined( 'WP_PAP_VERSION' ) ) {
	define( 'WP_PAP_VERSION', '1.0.3' ); // Version of plugin
}
if( !defined( 'WP_PAP_DIR' ) ) {
    define( 'WP_PAP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WP_PAP_URL' ) ) {
    define( 'WP_PAP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WP_PAP_POST_TYPE' ) ) {
    define( 'WP_PAP_POST_TYPE', 'wpos_portfolio' ); // Plugin post type
}
if( !defined( 'WP_PAP_CAT' ) ) {
    define( 'WP_PAP_CAT', 'wppap_portfolio_cat' ); // Plugin post type
}
if( !defined( 'WP_PAP_META_PREFIX' ) ) {
    define( 'WP_PAP_META_PREFIX', '_wp_pap_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Portfolio and Projects
 * @since 1.0.0
 */
function wp_pap_load_textdomain() {
	load_plugin_textdomain( 'portfolio-and-projects', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}
add_action('plugins_loaded', 'wp_pap_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Portfolio and Projects
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wp_pap_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Portfolio and Projects
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wp_pap_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * set default values for the plugin options.
 * 
 * @package Portfolio and Projects
 * @since 1.0.0
 */
function wp_pap_install() {
    
    // Register post type function
    wp_pap_register_post_type();

    // Register Taxonomies
    wppap_register_taxonomies();
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package Portfolio and Projects
 * @since 1.0.0
 */
function wp_pap_uninstall() {
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

// Functions File
require_once( WP_PAP_DIR . '/includes/wp-pap-functions.php' );

// Plugin Post Type File
require_once( WP_PAP_DIR . '/includes/wp-pap-post-types.php' );

// Script File
require_once( WP_PAP_DIR . '/includes/class-wp-pap-script.php' );

// Admin Class File
require_once( WP_PAP_DIR . '/includes/admin/class-wp-pap-admin.php' );

// Shortcode File
require_once( WP_PAP_DIR . '/includes/shortcode/wp-pap-gallery-slider.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( WP_PAP_DIR . '/includes/admin/pap-how-it-work.php' );
}