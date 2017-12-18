<?php
/**
 * Widget Class
 * 
 * Handles the widget functionality
 * 
 * @package WP iClean Responsive
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Iclean_Responsive_Widget {
	
	function __construct() {
		
		// Action to register sidebar
		add_action( 'widgets_init', array($this, 'wp_iclean_responsive_widgets_init' ) );
	}

	/**
	 * Register sidebars.
	 * Registers our main widget area and the front page widget areas.
	 *
	 * @package WP iClean Responsive
	 * @since 1.0
	 */
	function wp_iclean_responsive_widgets_init() {

		// Main sidebar
		register_sidebar( array(
			'name' 	=> __( 'Main Sidebar', 'wp-iclean-responsive' ),
			'id' 	=> 'sidebar-1',
			'description' 	=> __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'wp-iclean-responsive' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		) );

		// Footer Sidebar 1
		register_sidebar( array(
			'name' 	=> __( 'First Footer Widget Area', 'wp-iclean-responsive' ),
			'id' 	=> 'wpcrt-footer-sidebar-1',
			'description' 	=> __( 'Appears in a first column of footer.', 'wp-iclean-responsive' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		) );

		// Footer Sidebar 2
		register_sidebar( array(
			'name' 	=> __( 'Second Footer Widget Area', 'wp-iclean-responsive' ),
			'id' 	=> 'wpcrt-footer-sidebar-2',
			'description' 	=> __( 'Appears in a second column of footer.', 'wp-iclean-responsive' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		) );

		// Footer Sidebar 3
		register_sidebar( array(
			'name' 	=> __( 'Third Footer Widget Area', 'wp-iclean-responsive' ),
			'id' 	=> 'wpcrt-footer-sidebar-3',
			'description' 	=> __( 'Appears in a third column of footer.', 'wp-iclean-responsive' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		) );

		// Footer Sidebar 4
		register_sidebar( array(
			'name' 	=> __( 'Forth Footer Widget Area', 'wp-iclean-responsive' ),
			'id' 	=> 'wpcrt-footer-sidebar-4',
			'description' 	=> __( 'Appears in a forth column of footer.', 'wp-iclean-responsive' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		) );
	}
}

$wp_iclean_responsive_widget = new Wp_Iclean_Responsive_Widget();