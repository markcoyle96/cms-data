<?php
/**
 * Loads the child theme textdomain.
 */
function onepagepower_child_theme_setup() {
    load_child_theme_textdomain('onepagepower');
}
add_action( 'after_setup_theme', 'onepagepower_child_theme_setup' );

function onepagepower_child_enqueue_styles() {
    $parent_style = 'onepagepower-parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	 wp_enqueue_style( 'onepagepower-style',get_stylesheet_directory_uri() . '/onepagepower.css');
}
add_action( 'wp_enqueue_scripts', 'onepagepower_child_enqueue_styles',99);
?>