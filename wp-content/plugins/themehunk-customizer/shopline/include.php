<?php
if ( ! function_exists( 'shopline_is_woocommerce_activated' ) ) :
function shopline_is_woocommerce_activated() {
  return class_exists( 'woocommerce' ) ? true : false;
}
endif;

 require_once( plugin_dir_path(__FILE__) . 'inc/constant.php' );
 require_once( plugin_dir_path(__FILE__) . 'inc/custom-style.php' );
 require_once( plugin_dir_path(__FILE__) . 'inc/testimonial.php' );
 require_once( plugin_dir_path(__FILE__) . 'inc/shortcode.php' );
 require_once( plugin_dir_path(__FILE__) . '/customizer/custom-customizer.php' );

 require_once(plugin_dir_path(__FILE__) . 'customizer/customizer-font-selector/class/class-oneline-font-selector.php' );
 require_once(plugin_dir_path(__FILE__) . 'customizer/customizer-range-value/class/class-oneline-customizer-range-value-control.php' );
 $font_selector_functions = plugin_dir_path(__FILE__) . 'customizer/customizer-font-selector/functions.php';
 if ( file_exists( $font_selector_functions ) ) {
    require_once( $font_selector_functions );
 }
require_once( plugin_dir_path(__FILE__) . '/customizer/customizer.php' );
require_once( plugin_dir_path(__FILE__) . '/woo/woo-inc.php' );

// woocommerce functions
add_action( 'wp_enqueue_scripts', 'shopline_scripts' );
add_action( 'shopline_checkout', 'shopline_checkout', 60);
add_action( 'shopline_myaccount', 'shopline_my_account', 60);
add_action( 'shopline_header', 'shopline_header_cart', 60);
add_action( 'shopline_cart', 'shopline_menu_woo_cart_product');
add_action( 'shopline_featured', 'shopline_featured_products', 40);
add_action( 'shopline_product', 'shopline_woo_product', 50);
add_action( 'shopline_cate_image', 'shopline_category_image', 2);

if ( ! function_exists( 'shopline_show_dummy_data' ) ) :
function shopline_show_dummy_data(){
        $return = false;

if(get_theme_mod('dummydata_hide_show','show') == 'show'):
    $return = true;
endif;

    return $return;
}
endif;

/*
 * Include assets
 */
function themehunk_customizer_admin_assets() {
 wp_enqueue_media();
wp_enqueue_script('themehunk-customizer-widget-script', THEMEHUNK_CUSTOMIZER_PLUGIN_URL. 'themehunk/js/widget.js', array( 'jquery', 'wp-color-picker' ), THEMEHUNK_CUSTOMIZER_VERSION, true);
}
add_action('admin_enqueue_scripts', 'themehunk_customizer_admin_assets');
?>