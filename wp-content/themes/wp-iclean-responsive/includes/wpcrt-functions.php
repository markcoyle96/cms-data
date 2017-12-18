<?php
/**
 * Functions File
 *
 * @package WP iClean Responsive
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package WP iClean Responsive
 * @since 1.0
 */
function wp_iclean_responsive_default_settings() {
	
	$wp_iclean_responsive_options = array(		
                                                'slidersetting'                                         => '',
                                                'slider_shortcode'                                      => '[slick-slider design="design-2" autoplay_interval="4000" speed="3000"]',
                                                'enable_featured_cont'                                  => '',
                                                'featured_cont_h'                                       => esc_html__( 'Featured Content Section', 'wp-iclean-responsive' ),
                                                'featured_cont_hs'                                      => '',
                                                'featured_cont_scode'                                   => '[featured-content grid="3" limit="6" design="design-4" image_style="circle" fa_icon_color="#fff"]',
                                                'page_cont'                                             => '',
                                                'enable_testimonials_cont'                              => '',
                                                'testimonials_cont_h'                                   => esc_html__( 'Testimonials Content', 'wp-iclean-responsive' ),
                                                'testimonials_cont_hs'                                  => '',
                                                'testimonials_cont_scode'                               => '[sp_testimonials_slider slide slides_column="2"]',
                                                'enable_logoslider_cont'                                => '',
                                                'logoslider_cont_h'                                     => esc_html__( 'Logo Slider Content', 'wp-iclean-responsive' ),
                                                'logoslider_cont_hs'                                    => '',
                                                'logoslider_cont_scode'                                 => '[logoshowcase]',
                                                'enable_teamslider_cont'                                => '',
                                                'teamslider_cont_h'                                     =>  esc_html__( 'Our Team', 'wp-iclean-responsive' ),
                                                'teamslider_cont_hs'                                    => '',
                                                'teamslider_cont_scode'                                 => '[wp-team design="design-1" grid="3" limit="3"] ',
                                                'enable_ourwork_cont'                                   => '',
                                                'ourwork_cont_h'                                        =>  esc_html__( 'Our Work', 'wp-iclean-responsive' ),
                                                'ourwork_cont_hs'                                       => '',
                                                'ourwork_cont_scode'                                    => '[pap_portfolio]',
                                                'enable_ourblog_cont'                                   => '',
                                                'ourblog_cont_h'                                        => esc_html__( 'Latest From Blog ', 'wp-iclean-responsive' ),
                                                'ourblog_cont_hs'                                       => '',
                                                'ourblog_cont_scode'                                    => '[recent_post_slider speed="3000" design="design-4"]',
                                                'call_to_act_cont'                                      => '',
                                                'call_to_act_btn_t'                                     => esc_html__( 'Contact Us', 'wp-iclean-responsive' ),
                                                'call_to_act_btn_lnk'                                   => '',
                                                'call_to_act_cont_scode'                                => '',
                                                'insta_feed_cont'                                       => '',
                                                'insta_feed_cont_scode'                                 => '[iscwp-grid username="instagram" grid="10" limit="10"]',
                                                'enable_soc_hdr'                                        => 'socials-header-on',
                                                'enable_soc_ftr'                                        => 'socials-footer-on',
                                                'soc_facebook'                                          => '',
                                                'soc_twitter'                                           => '',
                                                'soc_linkedin'                                          => '',
                                                'soc_behance'                                           => '',
                                                'soc_dribbble'                                          => '',
                                                'soc_instagram'                                         => '',
                                                'soc_youtube'                                           => '',
                                                'footer_col'                                            => '4',
                                                'copyright'                                             => esc_html__( 'Copyright &copy; All rights reserved.', 'wp-iclean-responsive' ),
                                                'address_icon'                                          => get_template_directory_uri() . '/assets/images/map25-redish.png',
                                                'address'                                               => '',
                                                'email_icon'                                            => get_template_directory_uri() . '/assets/images/envelope4-green.png',
                                                'email'                                                 => '',
                                                'phone_icon'                                            => get_template_directory_uri() . '/assets/images/telephone65-blue.png',
                                                'phone'                                                 => '',
												'color_scheme_1'                                        => '#000000',
												'color_scheme_2'                                        => '#000000',
												'link_color'                                        	=> '#000000',
												'hover_link_color'                                      => '#9e4059',
                                            );
	
	return apply_filters('wp_iclean_responsive_opt_deflt_vals', $wp_iclean_responsive_options );
}

/**
 * Function to get post format class
 * 
 * @package WP iClean Responsive
 * @since 1.0
 */

function wp_iclean_responsive_post_format_cls( $format = '' ) {

	switch ($format) {
		case 'aside':
			$class = 'fa fa-file-text';
			break;
		case 'image':
			$class = 'fa fa-picture-o';
			break;
		case 'gallery':
			$class = 'fa fa-camera-retro';
			break;
		case 'link':
			$class = 'fa fa-link';
			break;
		case 'quote':
			$class = 'fa fa-quote-left';
			break;
		case 'status':
			$class = 'fa fa-commenting';
			break;
		case 'video':
			$class = 'fa fa-film';
			break;
		case 'audio':
			$class = 'fa fa-music';
			break;
		default:
			$class = 'fa fa-thumb-tack';
			break;
	}
	return $class;
}
/**
 * Function to get footer sidebar class according to settings
 * 
 * @package WP iClean Responsive
 * @since 1.0
 */
function wp_iclean_responsive_ftr_sidbr_cls(){

	$footer_widget_column = wp_iclean_responsive_get_theme_mod( 'footer_col' );

	switch ($footer_widget_column) {
		case '1':
			$class = 'medium-12';
			break;
		case '2':
			$class = 'medium-6';
			break;
		case '3':
			$class = 'medium-4';
			break;
		default:
			$class = 'medium-3';
			break;
	}
	return $class;
}

/**
 * Handles the numeric pagination
 * 
 * @package WP iClean Responsive
 * @since 1.0
 */
function wp_iclean_responsive_paginate_links( $args = array() ) {

	global $wp_query;

	$paging = apply_filters('wp_iclean_responsive_paging_args', array(
                                        'mid_size'      => isset($args['mid_size']) ? $args['mid_size'] :'1',   
					'prev_text'	=> isset($args['prev_text']) ? $args['prev_text'] : '&laquo; '.__('Previous', 'wp-iclean-responsive'),
					'next_text'	=> isset($args['next_text']) ? $args['next_text'] : __('Next', 'wp-iclean-responsive').' &raquo;',
	));
        
        the_posts_pagination( $paging );
}