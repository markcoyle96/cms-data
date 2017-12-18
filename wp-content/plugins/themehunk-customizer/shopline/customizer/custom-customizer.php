<?php

/**
 * Add controls for arbitrary heading, description, line
 *
 * @package     Customizer_Library
 * @author      Devin Price
 */
if ( ! function_exists( 'shopline_registers' ) ) :

function shopline_registers() {
wp_enqueue_script( 'shopline_customizer_script', THEMEHUNK_CUSTOMIZER_PLUGIN_URL . '/shopline/customizer/js/customizer.js', array("jquery"), '', true  );
}
add_action( 'customize_controls_enqueue_scripts', 'shopline_registers' );

endif;
if ( ! function_exists( 'shopline_customizer_styles' ) ) :

function shopline_customizer_styles() {
    wp_enqueue_style('shopline_customizer_styles', THEMEHUNK_CUSTOMIZER_PLUGIN_URL . '/shopline/customizer/customizer_styles.css');

}
add_action('customize_controls_print_styles', 'shopline_customizer_styles');

endif;

if ( ! function_exists( 'shopline_checkbox_filter' ) ) :

// single page post meta
function shopline_checkbox_filter($search,$theme_mod,$default=false){
 $filter = get_theme_mod($theme_mod);
$value = (!empty($filter) && !empty($filter[0]))?in_array($search, $filter):$default;
return $value;
}
endif;

?>