<?php
/**
 * Recommendation Class
 * 
 * Handles the recommended plugin functionality.
 * 
 * @package WP iClean Responsive
 * @since 1.0
 */

// Plugin recomendation class
require_once( WP_ICLEAN_RESPONSIVE_DIR . '/includes/plugins/class-tgm-plugin-activation.php' );

class Wp_Iclean_Responsive_Recommendation {

	function __construct() {
		
		// Action to add recomended plugins
		add_action( 'tgmpa_register', array($this, 'wp_iclean_responsive_recommend_plugin') );
	}

	/**
	 * Recommend Plugins
	 * 
	 * @package WP iClean Responsive
	 * @since 1.0
	 */
	function wp_iclean_responsive_recommend_plugin() {
	    $plugins = array(
	        array(
	            'name'               => 'WP Slick Slider and Image Carousel',
	            'slug'               => 'wp-slick-slider-and-image-carousel',
	            'required'           => false,
	        ),
	        array(
	            'name'               => 'WP Featured Content and Slider',
	            'slug'               => 'wp-featured-content-and-slider',
	            'required'           => false,
	        ),
	        array(
	            'name'               => 'WP Testimonials with rotator widget',
	            'slug'               => 'wp-testimonial-with-widget',
	            'required'           => false,
	        ),
	        array(
	            'name'               => 'WP Logo Showcase Responsive Slider',
	            'slug'               => 'wp-logo-showcase-responsive-slider-slider',
	            'required'           => false,
	        ),
	        array(
	            'name'               => 'WP Responsive Recent Post Slider',
	            'slug'               => 'wp-responsive-recent-post-slider',
	            'required'           => false,
	        ),
	        array(
	            'name'               => 'WP Team Showcase and Slider',
	            'slug'               => 'wp-team-showcase-and-slider',
	            'required'           => false,
	        ),
	        array(
	            'name'               => 'WP Team Showcase and Slider',
	            'slug'               => 'wp-team-showcase-and-slider',
	            'required'           => false,
	        ),
	        array(
	            'name'               => 'Portfolio and Projects',
	            'slug'               => 'portfolio-and-projects',
	            'required'           => false,
	        ),
	        array(
	            'name'               => 'Instagram Slider and Carousel Plus Widget',
	            'slug'               => 'slider-and-carousel-plus-widget-for-instagram',
	            'required'           => false,
	        )
	    );
	    tgmpa( $plugins);
	}
}

$wp_iclean_responsive_recommendation = new Wp_Iclean_Responsive_Recommendation();