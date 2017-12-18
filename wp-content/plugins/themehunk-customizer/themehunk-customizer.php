<?php
/*
  Plugin Name: ThemeHunk Customizer
  Description: With the help of ThemeHunk unlimited addon you can add unlimited number of columns for services, Testimonial, and Team with color options for each.
  Version: 2.0.5
  Author: ThemeHunk
  Text Domain: themehunk-customizer
  Author URI: http://www.themehunk.com/
 */
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
  
// Version constant for easy CSS refreshes
define('THEMEHUNK_CUSTOMIZER_VERSION', '1.0.0');
define('THEMEHUNK_CUSTOMIZER_PLUGIN_URL', plugin_dir_url(__FILE__));

function theme_text_domain(){
	$theme = wp_get_theme();
	$themeArr=array();
	 $themeArr[] = $theme->get( 'TextDomain' );
	 $themeArr[] = $theme->get( 'Template' );
	return $themeArr;
}

function themehunk_customizer_load_file(){
	include_once(plugin_dir_path(__FILE__) . 'themehunk/customizer-font-selector/class/class-oneline-font-selector.php' );
    include_once(plugin_dir_path(__FILE__) . 'themehunk/customizer-range-value/class/class-oneline-customizer-range-value-control.php' );
    $font_selector_functions = plugin_dir_path(__FILE__) . 'themehunk/customizer-font-selector/functions.php';
    if ( file_exists( $font_selector_functions ) ) {
    	include_once( $font_selector_functions );
	}
}

add_action('after_setup_theme', 'themehunk_customizer_load_plugin');
function themehunk_customizer_load_plugin() {
	include_once( plugin_dir_path(__FILE__) . 'themehunk/widget.php' );
	include_once( plugin_dir_path(__FILE__) . 'themehunk/custom-customizer.php' );
	include_once( plugin_dir_path(__FILE__) . 'themehunk/color-picker/color-picker.php' );

		$theme = theme_text_domain(); 
	if(in_array("oneline-lite", $theme)){
		include_once( plugin_dir_path(__FILE__) . 'oneline-lite/include.php' );
		
	}elseif(in_array("featuredlite", $theme)){
		include_once( plugin_dir_path(__FILE__) . 'featuredlite/include.php' );
	}elseif(in_array("shopline", $theme)){
		include_once( plugin_dir_path(__FILE__) . 'shopline/include.php' );
	}elseif(in_array("elanzalite", $theme)){
		themehunk_customizer_load_file();
		include_once( plugin_dir_path(__FILE__) . 'elanzalite/include.php' );
	}
}
?>