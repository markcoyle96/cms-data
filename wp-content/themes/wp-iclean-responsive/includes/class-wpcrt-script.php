<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP iClean Responsive
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Iclean_Responsive_Script {
	
	function __construct() {
		// Action to add style in front end
		add_action( 'wp_enqueue_scripts', array($this, 'wp_iclean_responsive_front_styles'), 1 );

		// Action to add script in front end
		add_action( 'wp_enqueue_scripts', array($this, 'wp_iclean_responsive_front_scripts'), 1 );
	}


	/**
	 * Enqueue styles for front-end
	 * 
	 * @package WP iClean Responsive
	 * @since 1.0
	 */
	function wp_iclean_responsive_front_styles() {
		global $wp_styles;

		// Font Awesome CSS
		wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), WP_ICLEAN_RESPONSIVE_VERSION);
		wp_enqueue_style( 'font-awesome' );

		// Font Awesome CSS
		wp_register_style( 'wp-iclean-responsive-google-fonts', 'https://fonts.googleapis.com/css?family=Oswald|Roboto:400,500,700', array(), WP_ICLEAN_RESPONSIVE_VERSION);
		wp_enqueue_style( 'wp-iclean-responsive-google-fonts' );	

		// Foundation CSS
		wp_register_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css', array(), WP_ICLEAN_RESPONSIVE_VERSION);
		wp_enqueue_style( 'normalize' );

		// Foundation CSS
		wp_register_style( 'foundation-style', get_template_directory_uri() . '/assets/css/foundation.css', array(), WP_ICLEAN_RESPONSIVE_VERSION);
		wp_enqueue_style( 'foundation-style' );

		// flypanel CSS
		wp_register_style( 'flyPanels-style', get_template_directory_uri() . '/assets/css/flyPanels.css', array(), WP_ICLEAN_RESPONSIVE_VERSION);
		wp_enqueue_style( 'flyPanels-style' );

		// Theme CSS
		wp_register_style( 'wp-iclean-responsive-theme-style', get_template_directory_uri() . '/assets/css/theme.css', array(), WP_ICLEAN_RESPONSIVE_VERSION);
		wp_enqueue_style( 'wp-iclean-responsive-theme-style' );

		// Loads theme main stylesheet
		wp_enqueue_style( 'wp-iclean-responsive-style', get_stylesheet_uri(), array(), WP_ICLEAN_RESPONSIVE_VERSION);
		
		// Loads the Internet Explorer specific stylesheet.
		wp_enqueue_style( 'ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'wp-iclean-responsive-style' ), '20121010' );
		$wp_styles->add_data( 'ie', 'conditional', 'lt IE 9' );
	}

	/**
	 * Enqueue scripts for front-end
	 * 
	 * @package WP iClean Responsive
	 * @since 1.0
	 */
	function wp_iclean_responsive_front_scripts() {
		
		/*
		 * Adds JavaScript to pages with the comment form to support
		 * sites with threaded comments (when in use).
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
			wp_enqueue_script( 'comment-reply' );
		}
		
		// Foundation Js
		wp_register_script( 'foundation-js', get_template_directory_uri() . '/assets/js/foundation.min.js', array('jquery'), WP_ICLEAN_RESPONSIVE_VERSION, true);
		wp_enqueue_script( 'foundation-js' );
		
		// Modernizr Js
		wp_register_script( 'modernizr-js', get_template_directory_uri() . '/assets/js/vendor/modernizr.js', array('jquery'), WP_ICLEAN_RESPONSIVE_VERSION, true);
		wp_enqueue_script( 'modernizr-js' );

		// flypanel Js
		wp_register_script( 'kitUtils-js', get_template_directory_uri() . '/assets/js/flypanels/kitUtils.js', array('jquery'), WP_ICLEAN_RESPONSIVE_VERSION, true);
		wp_enqueue_script( 'kitUtils-js' );
		wp_register_script( 'flypanels-js', get_template_directory_uri() . '/assets/js/flypanels/jquery.flypanels.js', array('jquery'), WP_ICLEAN_RESPONSIVE_VERSION, true);
		wp_enqueue_script( 'flypanels-js' );
		wp_register_script( 'fastclick-js', get_template_directory_uri() . '/assets/js/flypanels/fastclick.min.js', array('jquery'), WP_ICLEAN_RESPONSIVE_VERSION, true);
		wp_enqueue_script( 'fastclick-js' );

		// Public Js
		wp_register_script( 'wp-iclean-responsive-public-js', get_template_directory_uri() . '/assets/js/public.js', array('jquery'), WP_ICLEAN_RESPONSIVE_VERSION, true);	
		wp_enqueue_script( 'wp-iclean-responsive-public-js' );
	}
}

$wp_iclean_responsive_script = new Wp_Iclean_Responsive_Script();