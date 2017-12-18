<?php
/**
 * Theme customizer File
 *
 * @package WP iClean Responsive
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wp_iclean_responsive_customize_register( $wp_customize ) {

		global $wp_iclean_responsive_options;

		$wp_customize->add_section( 'textcolors' , array(
			'title' =>  __( 'Website Color Scheme', 'wp-iclean-responsive' ),
		) );
		// main color ( site title, h1, h2, h4. h6, widget headings, nav links, footer headings )
		$txtcolors[] = array(
			'slug'=>'color_scheme_1', 
			'default' => $wp_iclean_responsive_options['color_scheme_1'],
			'label' => __( 'Main Color', 'wp-iclean-responsive' ),
		);
		 
		// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
		$txtcolors[] = array(
			'slug'=>'color_scheme_2', 
			'default' => $wp_iclean_responsive_options['color_scheme_2'],
			'label' => __( 'Secondary Color', 'wp-iclean-responsive' ),
		);
		 
		// link color
		$txtcolors[] = array(
			'slug'=>'link_color', 
			'default' => $wp_iclean_responsive_options['link_color'],
			'label' => __( 'Link Color', 'wp-iclean-responsive' ),
		);
		 
		// link color ( hover, active )
		$txtcolors[] = array(
			'slug'=>'hover_link_color', 
			'default' => $wp_iclean_responsive_options['hover_link_color'], 
			'label' => __( 'Link Color (on hover)', 'wp-iclean-responsive' ),
		);
		// add the settings and controls for each color
		foreach( $txtcolors as $txtcolor ) {
		 
			// SETTINGS
			$wp_customize->add_setting(
				$txtcolor['slug'], array(
					'default' => $txtcolor['default'],
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);
			// CONTROLS
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$txtcolor['slug'], 
					array('label' => $txtcolor['label'], 
					'section' => 'textcolors',
					'settings' => $txtcolor['slug'])
				)
			);
		}
	
	
	/**************************************
	Front Page Design
	***************************************/	

	$wp_customize->add_panel(
		'panel_frontpage', array(			
			'capability' => 'edit_theme_options',
			'title'      => __( 'Front Page Design', 'wp-iclean-responsive' ),
		)
	);
	/**
	Slider setting 
	**/
	$wp_customize->add_section(
		'wp_iclean_responsive_frontpage_section', array(
			'title'    => __( 'Slider Setting', 'wp-iclean-responsive' ),
			'priority' => 1,
			'panel'    => 'panel_frontpage',
		)
	);
	/**Slider setting Inside **/
		$wp_customize->add_setting(
			'slidersetting', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',				
			)
		);

		$wp_customize->add_control(
			'slidersetting', array(
				'label'    	=> __( 'Enable Slider', 'wp-iclean-responsive' ),
				'description'   => __( 'If Enabled, Header image setting overide with Slider', 'wp-iclean-responsive' ),
				'section' 	=> 'wp_iclean_responsive_frontpage_section',
				'priority' 	=> 1,
				'type'       	=> 'checkbox',
			)
		);
		$wp_customize->add_setting(
			'slider_shortcode', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',	
				'default'           => $wp_iclean_responsive_options['slider_shortcode'],
			)
		);
		$wp_customize->add_control(
			'slider_shortcode', array(
				'label'    	 => __( 'Shortcode', 'wp-iclean-responsive' ),
				'description'    => __( 'To check shortcode please go to Slick Slider-> How It Work ', 'wp-iclean-responsive' ),	
				'section' 	 => 'wp_iclean_responsive_frontpage_section',
				'priority' 	 => 2,
				'type'       	 => 'textarea',				
			)
		);	
	/**
	Featured Content
	**/	
	$wp_customize->add_section(
		'wp_iclean_responsive_frontpage_fs_section', array(
			'title'    => __( 'Featured Content', 'wp-iclean-responsive' ),
			'priority' => 2,
			'panel'    => 'panel_frontpage',
		)
	);
	
	/**Featured Content Inside **/
		$wp_customize->add_setting(
			'enable_featured_cont', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',				
			)
		);

		$wp_customize->add_control(
			'enable_featured_cont', array(
				'label'    	  => __( 'Disable Featured Content', 'wp-iclean-responsive' ),
				'description'     => __( 'If Disabled - This will hide Featured Content section from home page', 'wp-iclean-responsive' ),	
				'section' 	  => 'wp_iclean_responsive_frontpage_fs_section',
				'priority' 	  => 1,
				'type'       	  => 'checkbox',
				
			)
		);	
		
		$wp_customize->add_setting(
			'featured_cont_h', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				'default' 	    => $wp_iclean_responsive_options['featured_cont_h'],
			)
		);

		$wp_customize->add_control(
			'featured_cont_h', array(
				'label'    	  => __( 'Title', 'wp-iclean-responsive' ),				
				'section' 	  => 'wp_iclean_responsive_frontpage_fs_section',
				'priority' 	  => 1,
				'type'       	  => 'text',				
			)
		);
		$wp_customize->add_setting(
			'featured_cont_hs', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          => $wp_iclean_responsive_options['featured_cont_hs'],
			)
		);

		$wp_customize->add_control(
			'featured_cont_hs', array(
				'label'    	  => __( 'Sub Title', 'wp-iclean-responsive' ),				
				'section' 	  => 'wp_iclean_responsive_frontpage_fs_section',
				'priority' 	  => 2,
				'type'       	  => 'text',				
			)
		);	
		$wp_customize->add_setting(
			'featured_cont_scode', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          => $wp_iclean_responsive_options['featured_cont_scode'],
			)
		);

		$wp_customize->add_control(
			'featured_cont_scode', array(
				'label'    	 => __( 'Shortcode', 'wp-iclean-responsive' ),
				'description'    => __( 'To check shortcode please go to Featured Content-> How It Work ', 'wp-iclean-responsive' ),	
				'section' 	 => 'wp_iclean_responsive_frontpage_fs_section',
				'priority' 	 => 2,
				'type'       	 => 'textarea',				
			)
		);	

	/**
	Page Content
	**/	
	$wp_customize->add_section(
		'wp_iclean_responsive_pagecontent_section', array(
			'title'    => __( 'Page Content', 'wp-iclean-responsive' ),
			'priority' => 3,
			'panel'    => 'panel_frontpage',
		)
	);
	
	/**Page Content Inside **/
		$wp_customize->add_setting(
			'page_cont', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',
				
			)
		);

		$wp_customize->add_control(
			'page_cont', array(
				'label'    	  => __( 'Disable Page Content', 'wp-iclean-responsive' ),
				'description'     => __( 'If Enabled - This will show page content of the page selected as a front page and page tecplate selected FRONT PAGE', 'wp-iclean-responsive' ),	
				'section' 	  => 'wp_iclean_responsive_pagecontent_section',
				'priority' 	  => 1,
				'type'       	  => 'checkbox',
				
			)
		);	
		
	/**
	Testimonials Content
	**/	
	$wp_customize->add_section(
		'wp_iclean_responsive_testimonials_section', array(
			'title'    => __( 'Testimonials', 'wp-iclean-responsive' ),
			'priority' => 4,
			'panel'    => 'panel_frontpage',
		)
	);
	
	/**Testimonials Content Inside **/
		$wp_customize->add_setting(
			'enable_testimonials_cont', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',				
			)
		);

		$wp_customize->add_control(
			'enable_testimonials_cont', array(
				'label'    	  => __( 'Disable Testimonials', 'wp-iclean-responsive' ),
				'description'     => __( 'If Disabled - This will hide Testimonials section from home page', 'wp-iclean-responsive' ),	
				'section' 	  => 'wp_iclean_responsive_testimonials_section',
				'priority' 	  => 1,
				'type'       	  => 'checkbox',
				
			)
		);	
		
		$wp_customize->add_setting(
			'testimonials_cont_h', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				'default'           => $wp_iclean_responsive_options['testimonials_cont_h'],	
			)
		);

		$wp_customize->add_control(
			'testimonials_cont_h', array(
				'label'    		  => __( 'Title', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_testimonials_section',
				'priority' 		  => 2,
				'type'       	  => 'text',				
			)
		);
		$wp_customize->add_setting(
			'testimonials_cont_hs', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          => $wp_iclean_responsive_options['testimonials_cont_hs'],
			)
		);

		$wp_customize->add_control(
			'testimonials_cont_hs', array(
				'label'    		  => __( 'Sub Title', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_testimonials_section',
				'priority' 		  => 3,
				'type'                    => 'text',				
			)
		);	
		$wp_customize->add_setting(
			'testimonials_cont_scode', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          => $wp_iclean_responsive_options['testimonials_cont_scode'],
			)
		);

		$wp_customize->add_control(
			'testimonials_cont_scode', array(
				'label'          => __( 'Shortcode', 'wp-iclean-responsive' ),
				'description'    => __( 'To check shortcode please go to Testimonials -> How It Work ', 'wp-iclean-responsive' ),	
				'section' 	 => 'wp_iclean_responsive_testimonials_section',
				'priority' 	 => 4,
				'type'       	 => 'textarea',				
			)
		);

	/**
	Logo Showcase
	**/	
	$wp_customize->add_section(
		'wp_iclean_responsive_logoslider_section', array(
			'title'    => __( 'Logo Showcase', 'wp-iclean-responsive' ),
			'priority' => 5,
			'panel'    => 'panel_frontpage',
		)
	);
	
	/**Logo Showcase Content Inside **/
		$wp_customize->add_setting(
			'enable_logoslider_cont', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',				
			)
		);

		$wp_customize->add_control(
			'enable_logoslider_cont', array(
				'label'    		  => __( 'Disable Logo Slider', 'wp-iclean-responsive' ),
				'description'     => __( 'If Disabled - This will hide Logo Slider section from home page', 'wp-iclean-responsive' ),	
				'section' 		  => 'wp_iclean_responsive_logoslider_section',
				'priority' 		  => 1,
				'type'       	  => 'checkbox',
				
			)
		);	
		
		$wp_customize->add_setting(
			'logoslider_cont_h', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				'default'           => $wp_iclean_responsive_options['logoslider_cont_h'],
			)
		);

		$wp_customize->add_control(
			'logoslider_cont_h', array(
				'label'    		  => __( 'Title', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_logoslider_section',
				'priority' 		  => 2,
				'type'       	  => 'text',				
			)
		);
		$wp_customize->add_setting(
			'logoslider_cont_hs', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          => $wp_iclean_responsive_options['logoslider_cont_hs'],
			)
		);

		$wp_customize->add_control(
			'logoslider_cont_hs', array(
				'label'    		  => __( 'Sub Title', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_logoslider_section',
				'priority' 		  => 3,
				'type'                    => 'text',				
			)
		);	
		$wp_customize->add_setting(
			'logoslider_cont_scode', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          =>  $wp_iclean_responsive_options['logoslider_cont_scode'],
			)
		);

		$wp_customize->add_control(
			'logoslider_cont_scode', array(
				'label'             => __( 'Shortcode', 'wp-iclean-responsive' ),
				'description'       => __( 'To check shortcode please go to Logo Showcase -> How It Work ', 'wp-iclean-responsive' ),	
				'section'           => 'wp_iclean_responsive_logoslider_section',
				'priority'          => 4,
				'type'              => 'textarea',				
			)
		);

	/**
	Our Team
	**/	
	$wp_customize->add_section(
		'wp_iclean_responsive_teamslider_section', array(
			'title'    => __( 'Team Showcase', 'wp-iclean-responsive' ),
			'priority' => 5,
			'panel'    => 'panel_frontpage',
		)
	);
	
	/**Logo Our Team Inside **/
		$wp_customize->add_setting(
                                'enable_teamslider_cont', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',				
			)
		);

		$wp_customize->add_control(
			'enable_teamslider_cont', array(
				'label'    		  => __( 'Disable Team Showcase', 'wp-iclean-responsive' ),
				'description'     => __( 'If Disabled - This will hide Team Showcase section from home page', 'wp-iclean-responsive' ),	
				'section' 		  => 'wp_iclean_responsive_teamslider_section',
				'priority' 		  => 1,
				'type'       	  => 'checkbox',
				
			)
		);	
		
		$wp_customize->add_setting(
			'teamslider_cont_h', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				'default'           => $wp_iclean_responsive_options['teamslider_cont_h'],
			)
		);

		$wp_customize->add_control(
			'teamslider_cont_h', array(
				'label'    		  => __( 'Title', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_teamslider_section',
				'priority' 		  => 2,
				'type'                    => 'text',				
			)
		);
		$wp_customize->add_setting(
			'teamslider_cont_hs', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          => $wp_iclean_responsive_options['teamslider_cont_hs'],
			)
		);

		$wp_customize->add_control(
			'teamslider_cont_hs', array(
				'label'    		  => __( 'Sub Title', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_teamslider_section',
				'priority' 		  => 3,
				'type'                    => 'text',				
			)
		);	
		$wp_customize->add_setting(
			'teamslider_cont_scode', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          => $wp_iclean_responsive_options['teamslider_cont_scode'],
			)
		);

		$wp_customize->add_control(
			'teamslider_cont_scode', array(
				'label'             => __( 'Shortcode', 'wp-iclean-responsive' ),
				'description'       => __( 'To check shortcode please go to Team Showcase -> How It Work ', 'wp-iclean-responsive' ),	
				'section'           => 'wp_iclean_responsive_teamslider_section',
				'priority'          => 4,
				'type'              => 'textarea',				
			)
		);	
	
	/**
	Our Work
	**/	
	$wp_customize->add_section(
		'wp_iclean_responsive_ourwork_section', array(
			'title'    => __( 'Portfilo', 'wp-iclean-responsive' ),
			'priority' => 5,
			'panel'    => 'panel_frontpage',
		)
	);
	
	/**Our Work Inside **/
		$wp_customize->add_setting(
			'enable_ourwork_cont', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',				
			)
		);

		$wp_customize->add_control(
			'enable_ourwork_cont', array(
				'label'    		  => __( 'Disable Portfolio', 'wp-iclean-responsive' ),
				'description'             => __( 'If Disabled - This will hide Portfolio section from home page', 'wp-iclean-responsive' ),	
				'section' 		  => 'wp_iclean_responsive_ourwork_section',
				'priority' 		  => 1,
				'type'                    => 'checkbox',
				
			)
		);	
		
		$wp_customize->add_setting(
			'ourwork_cont_h', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				'default' 			=> $wp_iclean_responsive_options['ourwork_cont_h'],
			)
		);

		$wp_customize->add_control(
			'ourwork_cont_h', array(
				'label'    		  => __( 'Title', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_ourwork_section',
				'priority' 		  => 2,
				'type'                    => 'text',				
			)
		);
		$wp_customize->add_setting(
			'ourwork_cont_hs', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default' 			=> $wp_iclean_responsive_options['ourwork_cont_hs'],
			)
		);

		$wp_customize->add_control(
			'ourwork_cont_hs', array(
				'label'    		  => __( 'Sub Title', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_ourwork_section',
				'priority' 		  => 3,
				'type'                      => 'text',				
			)
		);	
		$wp_customize->add_setting(
			'ourwork_cont_scode', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          => $wp_iclean_responsive_options['ourwork_cont_scode'],
			)
		);

		$wp_customize->add_control(
			'ourwork_cont_scode', array(
				'label'    	 => __( 'Shortcode', 'wp-iclean-responsive' ),
				'description'    => __( 'To check shortcode please go to Portfolio -> How It Work ', 'wp-iclean-responsive' ),	
				'section' 	 => 'wp_iclean_responsive_ourwork_section',
				'priority' 	 => 4,
				'type'       	 => 'textarea',				
			)
		);

	/**
	Latest From Blog
	**/	
	$wp_customize->add_section(
		'wp_iclean_responsive_ourblog_section', array(
			'title'    => __( 'Blog Post Section', 'wp-iclean-responsive' ),
			'priority' => 6,
			'panel'    => 'panel_frontpage',
		)
	);
	
	/**Our Work Inside **/
		$wp_customize->add_setting(
			'enable_ourblog_cont', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',				
			)
		);

		$wp_customize->add_control(
			'enable_ourblog_cont', array(
				'label'    		  => __( 'Disable Blog Section', 'wp-iclean-responsive' ),
				'description'     => __( 'If Disabled - This will hide Blog post section from home page', 'wp-iclean-responsive' ),	
				'section' 		  => 'wp_iclean_responsive_ourblog_section',
				'priority' 		  => 1,
				'type'       	  => 'checkbox',
				
			)
		);	
		
		$wp_customize->add_setting(
			'ourblog_cont_h', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				'default' 			=> $wp_iclean_responsive_options['ourblog_cont_h'],
			)
		);

		$wp_customize->add_control(
			'ourblog_cont_h', array(
				'label'    		  => __( 'Title', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_ourblog_section',
				'priority' 		  => 2,
				'type'                    => 'text',				
			)
		);
		$wp_customize->add_setting(
			'ourblog_cont_hs', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default' 			=> $wp_iclean_responsive_options['ourblog_cont_hs'],
			)
		);

		$wp_customize->add_control(
			'ourblog_cont_hs', array(
				'label'    		  => __( 'Sub Title', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_ourblog_section',
				'priority' 		  => 3,
				'type'            => 'text',				
			)
		);	
		$wp_customize->add_setting(
			'ourblog_cont_scode', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          =>  $wp_iclean_responsive_options['ourblog_cont_scode'],
			)
		);

		$wp_customize->add_control(
			'ourblog_cont_scode', array(
				'label'    		 => __( 'Shortcode', 'wp-iclean-responsive' ),
				'description'    => __( 'To check shortcode please go to Portfolio -> How It Work ', 'wp-iclean-responsive' ),	
				'section' 	 	 => 'wp_iclean_responsive_ourblog_section',
				'priority' 		 => 4,
				'type'       	 => 'textarea',				
			)
		);

	/**
	Call to Action 
	**/	
	$wp_customize->add_section(
		'wp_iclean_responsive_call_to_action_section', array(
			'title'    => __( 'Call to Action ', 'wp-iclean-responsive' ),
			'priority' => 6,
			'panel'    => 'panel_frontpage',
		)
	);
	
	/**Call to Action  Inside **/
		$wp_customize->add_setting(
			'call_to_act_cont', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',				
			)
		);

		$wp_customize->add_control(
			'call_to_act_cont', array(
				'label'    		  => __( 'Disable Call to Action', 'wp-iclean-responsive' ),
				'description'     => __( 'If Disabled - This will hide Call to Action section from home page', 'wp-iclean-responsive' ),	
				'section' 		  => 'wp_iclean_responsive_call_to_action_section',
				'priority' 		  => 1,
				'type'       	  => 'checkbox',
				
			)
		);	
		
		$wp_customize->add_setting(
			'call_to_act_cont_scode', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default'          => $wp_iclean_responsive_options['call_to_act_cont_scode'],
			)
		);

		$wp_customize->add_control(
			'call_to_act_cont_scode', array(
				'label'    		  => __( 'Call to Action Content', 'wp-iclean-responsive' ),			
				'section' 		  => 'wp_iclean_responsive_call_to_action_section',
				'priority' 		  => 2,
				'type'                    => 'textarea',				
			)
		);		
		
		$wp_customize->add_setting(
			'call_to_act_btn_t', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				'default'           => $wp_iclean_responsive_options['call_to_act_btn_t'],
			)
		);

		$wp_customize->add_control(
			'call_to_act_btn_t', array(
				'label'    		  => __( 'Button Text', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_call_to_action_section',
				'priority' 		  => 3,
				'type'                    => 'text',				
			)
		);
		$wp_customize->add_setting(
			'call_to_act_btn_lnk', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				'default'           => $wp_iclean_responsive_options['call_to_act_btn_lnk'],
			)
		);

		$wp_customize->add_control(
			'call_to_act_btn_lnk', array(
				'label'    		  => __( 'Button_link', 'wp-iclean-responsive' ),				
				'section' 		  => 'wp_iclean_responsive_call_to_action_section',
				'priority' 		  => 4,
				'type'       	  => 'url',				
			)
		);
			
		/**
	Instagram Feed 
	**/	
	$wp_customize->add_section(
		'wp_iclean_responsive_instagram_feed_section', array(
			'title'    => __( 'Instagram Feed', 'wp-iclean-responsive' ),
			'priority' => 6,
			'panel'    => 'panel_frontpage',
		)
	);
	
	/**Instagram Feed  Inside **/
		$wp_customize->add_setting(
			'insta_feed_cont', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',				
			)
		);

		$wp_customize->add_control(
			'insta_feed_cont', array(
				'label'    	  => __( 'Disable Instagram Feed', 'wp-iclean-responsive' ),
				'description'     => __( 'If Disabled - This will hide Instagram Feed section from home page', 'wp-iclean-responsive' ),	
				'section'         => 'wp_iclean_responsive_instagram_feed_section',
				'priority'        => 1,
				'type'       	  => 'checkbox',
				
			)
		);			
		
		$wp_customize->add_setting(
			'insta_feed_cont_scode', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
				'transport'         => 'refresh',
				 'default' 			=> $wp_iclean_responsive_options['insta_feed_cont_scode'],
			)
		);

		$wp_customize->add_control(
			'insta_feed_cont_scode', array(
				'label'    	 => __( 'Shortcode', 'wp-iclean-responsive' ),
				'description'    => __( 'To check shortcode please go to WPOS Instagram -> How It Work ', 'wp-iclean-responsive' ),	
				'section' 	 => 'wp_iclean_responsive_instagram_feed_section',
				'priority' 	 => 2,
				'type'       	 => 'textarea',				
			)
		);	
			
	/**
	 * Socials FEED
	 */
	$wp_customize->add_section(
		'wp_iclean_responsive_general_socials_section', array(
			'title'    => __( 'Social Icons', 'wp-iclean-responsive' ),			
			
		)
	);
	
	$wp_customize->add_setting(
			'enable_soc_hdr', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',
				'default' 			=> $wp_iclean_responsive_options['enable_soc_hdr'],
			)
		);

		$wp_customize->add_control(
			'enable_soc_hdr', array(
				'label'    		  => __( 'Enable Socials Icons on Header', 'wp-iclean-responsive' ),					
				'section' 		  => 'wp_iclean_responsive_general_socials_section',
				'priority' 		  => 1,
				'type'                    => 'checkbox',
				
			)
		);	
	$wp_customize->add_setting(
			'enable_soc_ftr', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_checkbox',
				'transport'         => 'refresh',
				'default'           => $wp_iclean_responsive_options['enable_soc_ftr'],
			)
		);

		$wp_customize->add_control(
			'enable_soc_ftr', array(
				'label'    	  => __( 'Enable Socials Icons on Footer', 'wp-iclean-responsive' ),					
				'section' 	  => 'wp_iclean_responsive_general_socials_section',
				'priority'	  => 2,
				'type'       	  => 'checkbox',
				
			)
		);			
	
	
	/* Facebook */
	$wp_customize->add_setting(
		'soc_facebook', array(
			'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
			'transport'         => 'refresh',
			'default' 	   => $wp_iclean_responsive_options['soc_facebook'],
		)
	);

	$wp_customize->add_control(
		'soc_facebook', array(
			'label'    => __( 'Facebook link', 'wp-iclean-responsive' ),
			'section'  => 'wp_iclean_responsive_general_socials_section',
			'priority' => 4,
		)
	);

	/* Twitter */
	$wp_customize->add_setting(
		'soc_twitter', array(
			'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
			'transport'         => 'refresh',
			'default' 	    => $wp_iclean_responsive_options['soc_twitter'],
		)
	);

	$wp_customize->add_control(
		'soc_twitter', array(
			'label'    => __( 'Twitter link', 'wp-iclean-responsive' ),
			'section'  => 'wp_iclean_responsive_general_socials_section',
			'priority' => 5,
		)
	);

	/* Linkedin */
	$wp_customize->add_setting(
		'soc_linkedin', array(
			'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
			'transport'         => 'refresh',
			'default' 			=> $wp_iclean_responsive_options['soc_linkedin'],
		)
	);
	$wp_customize->add_control(
		'soc_linkedin', array(
			'label'    => __( 'Linkedin link', 'wp-iclean-responsive' ),
			'section'  => 'wp_iclean_responsive_general_socials_section',
			'priority' => 6,
		)
	);

	/* Behance */
	$wp_customize->add_setting(
		'soc_behance', array(
			'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
			'transport'         => 'refresh',
			'default' 			=> $wp_iclean_responsive_options['soc_behance'],
		)
	);

	$wp_customize->add_control(
		'soc_behance', array(
			'label'    => __( 'Behance link', 'wp-iclean-responsive' ),
			'section'  => 'wp_iclean_responsive_general_socials_section',
			'priority' => 7,
		)
	);

	/* Dribbble */
	$wp_customize->add_setting(
		'soc_dribbble', array(
			'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
			'transport'         => 'refresh',
			'default'           => $wp_iclean_responsive_options['soc_dribbble'],
		)
	);

	$wp_customize->add_control(
		'soc_dribbble', array(
			'label'    => __( 'Dribbble link', 'wp-iclean-responsive' ),
			'section'  => 'wp_iclean_responsive_general_socials_section',
			'priority' => 8,
		)
	);

	/* Instagram */
	$wp_customize->add_setting(
		'soc_instagram', array(
			'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
			'transport'         => 'refresh',
			'default'           => $wp_iclean_responsive_options['soc_instagram'],
		)
	);

	$wp_customize->add_control(
		'soc_instagram', array(
			'label'    => __( 'Instagram link', 'wp-iclean-responsive' ),
			'section'  => 'wp_iclean_responsive_general_socials_section',
			'priority' => 9,
		)
	);
	/* Instagram */
	$wp_customize->add_setting(
		'soc_youtube', array(
			'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
			'transport'         => 'refresh',
			'default'           => $wp_iclean_responsive_options['soc_youtube'],
		)
	);

	$wp_customize->add_control(
		'soc_youtube', array(
			'label'    => __( 'YouTube link', 'wp-iclean-responsive' ),
			'section'  => 'wp_iclean_responsive_general_socials_section',
			'priority' => 10,
		)
	);
	/**
	 * FOOTER OPTIONS
	 */

	$wp_customize->add_section(
		'wp_iclean_responsive_general_footer_section', array(
			'title'    => __( 'Footer Content', 'wp-iclean-responsive' ),			
		)
	);

	/* COPYRIGHT */
	$wp_customize->add_setting(
		'copyright', array(
			'sanitize_callback' => 'wp_iclean_responsive_sanitize_clean',
			'transport'         => 'refresh',
			'default'           => $wp_iclean_responsive_options['copyright'],
		)
	);

	$wp_customize->add_control(
		'copyright', array(
			'label'    => __( 'Footer Copyright', 'wp-iclean-responsive' ),
			'section'  => 'wp_iclean_responsive_general_footer_section',
			'priority' => 1,
		)
	);
	
	/* Footer Col */
	$wp_customize->add_setting(
		'footer_col', array(
			'sanitize_callback' => 'wp_iclean_responsive_sanitize_select',
			'transport'         => 'refresh',
			'default'           => $wp_iclean_responsive_options['footer_col'],
		)
	);

	$wp_customize->add_control(
		'footer_col', array(
			'label'    => __( 'Select Footer Widget Columns', 'wp-iclean-responsive' ),
			'description' => __( 'We have given 4 footer widget in this theme. You need to select in the select box ie how many columns you need.', 'wp-iclean-responsive' ),
			'section'  => 'wp_iclean_responsive_general_footer_section',
			'priority' => 2,
			'type'       	  => 'select',
				'choices'    	  => array(
					'1'   => 'Footer col 1',
					'2'   => 'Footer col 2',	
					'3'   => 'Footer col 3',	
					'4'   => 'Footer col 4',	
				)
		)
	);

	/* Address - ICON */
	if ( current_user_can( 'edit_theme_options' ) ) {
		$wp_customize->add_setting(
			'address_icon', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
				'default'           => $wp_iclean_responsive_options['address_icon'],
				'transport'         => 'refresh',
			)
		);
	} else {
		$wp_customize->add_setting(
			'address_icon', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
				'transport'         => 'refresh',
			)
		);
	}

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'address_icon', array(
				'label'    => __( 'Address section - icon', 'wp-iclean-responsive' ),
				'section'  => 'wp_iclean_responsive_general_footer_section',
				'priority' => 3,
			)
		)
	);

	/* Address */
	if ( current_user_can( 'edit_theme_options' ) ) {
		$wp_customize->add_setting(
			'address', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_nohtml_kses',
				'default'           => $wp_iclean_responsive_options['address'],
				'transport'         => 'refresh',
			)
		);
	} else {
		$wp_customize->add_setting(
			'address', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_nohtml_kses',
				'transport'         => 'refresh',
			)
		);
	}

	$wp_customize->add_control(
		'address', array(
			'label'    => __( 'Address', 'wp-iclean-responsive' ),
			'type'     => 'textarea',
			'section'  => 'wp_iclean_responsive_general_footer_section',
			'priority' => 4,
		)
	);

	/* Email - ICON */
	if ( current_user_can( 'edit_theme_options' ) ) {
		$wp_customize->add_setting(
			'email_icon', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
				'default' 			=> $wp_iclean_responsive_options['email_icon'],
				'transport'         => 'refresh',
			)
		);
	} else {
		$wp_customize->add_setting(
			'email_icon', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
				'transport'         => 'refresh',
			)
		);
	}

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'email_icon', array(
				'label'    => __( 'Email section - icon', 'wp-iclean-responsive' ),
				'section'  => 'wp_iclean_responsive_general_footer_section',
				'priority' => 5,
			)
		)
	);

	/* Email */
	if ( current_user_can( 'edit_theme_options' ) ) {
		$wp_customize->add_setting(
			'email', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_email',
				'default'           => $wp_iclean_responsive_options['email'],
				'transport'         => 'refresh',
			)
		);
	} else {
		$wp_customize->add_setting(
			'email', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_email',
				'transport'         => 'refresh',
			)
		);
	}

	$wp_customize->add_control(
		'email', array(
			'label'    => __( 'Email', 'wp-iclean-responsive' ),
			'type'     => 'textarea',
			'section'  => 'wp_iclean_responsive_general_footer_section',
			'priority' => 6,
		)
	);

	/* Phone number - ICON */
	if ( current_user_can( 'edit_theme_options' ) ) {
		$wp_customize->add_setting(
                                'phone_icon', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
				'default' 			=> $wp_iclean_responsive_options['phone_icon'],
				'transport'         => 'refresh',
			)
		);
	} else {
		$wp_customize->add_setting(
			'phone_icon', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_url',
				'transport'         => 'refresh',
			)
		);
	}

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'phone_icon', array(
				'label'    => __( 'Phone number section - icon', 'wp-iclean-responsive' ),
				'section'  => 'wp_iclean_responsive_general_footer_section',
				'priority' => 7,
			)
		)
	);

	/* Phone number */
	if ( current_user_can( 'edit_theme_options' ) ) {
		$wp_customize->add_setting(
			'phone', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_nohtml_kses',
				'default'           => $wp_iclean_responsive_options['phone'],
				'transport'         => 'refresh',
			)
		);
	} else {
		$wp_customize->add_setting(
			'phone', array(
				'sanitize_callback' => 'wp_iclean_responsive_sanitize_nohtml_kses',
				'transport'         => 'refresh',
			)
		);
	}

	$wp_customize->add_control(
		'phone', array(
			'label'    => __( 'Phone number', 'wp-iclean-responsive' ),
			'type'     => 'textarea',
			'section'  => 'wp_iclean_responsive_general_footer_section',
			'priority' => 8,
		)
	);
	
}
function wp_iclean_responsive_customize_colors() {		
		// main color
		$color_scheme_1 = wp_iclean_responsive_get_theme_mod( 'color_scheme_1' );
		 
		// secondary color
		$color_scheme_2 = wp_iclean_responsive_get_theme_mod( 'color_scheme_2' );
		 
		// link color
		$link_color = wp_iclean_responsive_get_theme_mod( 'link_color' );
		 
		// hover or active link color
		$hover_link_color = wp_iclean_responsive_get_theme_mod( 'hover_link_color' );
		?>
<style>
#site-title a, h1, h2, h2.page-title, h2.post-title, h2 a:link, h2 a:visited, .menu.main a:link, .menu.main a:visited, footer h3 { 
    color:  <?php echo esc_attr($color_scheme_1); ?>; 
}
/* secondary color */
#site-description, .title .entry-title a, .sidebar h3, h3, h5, .menu.main a:active, .menu.main a:hover {
    color:  <?php echo esc_attr($color_scheme_2); ?>; 
}
.menu.main,
.fatfooter {
    border-top: 1px solid <?php echo esc_attr($color_scheme_2); ?>;
}
.menu.main {
    border-bottom: 1px solid <?php echo esc_attr($color_scheme_2); ?>;  
}
.fatfooter {
    border-bottom: 1px solid <?php echo esc_attr($color_scheme_2); ?>;
}
a:link, a:visited { 
    color:  <?php echo esc_attr($link_color); ?>; 
}
a:hover, a:active {
    color:  <?php echo esc_attr($hover_link_color); ?>; 
}

/* background colors */
.header-background-on .header-wrapper {
    background-color: <?php echo esc_attr($color_scheme_1); ?>;
}
.header-background-on #site-title a, .header-background-on #site-description {
    color: #fff;
}
.header-background-on header a:active, .header-background-on header a:hover {
    text-decoration: none;
}
.header-background-on .menu.main {
    border: none;
}
 
/* footer */
.footer-background-on footer { 
    background-color: <?php echo esc_attr($color_scheme_1); ?>;
}
.footer-background-on footer, .footer-background-on footer h3, .footer-background-on footer a:link, .footer-background-on footer a:visited, .footer-background-on footer a:active, .footer-background-on footer a:hover {
    color: #fff;
}
.footer-background-on footer a:link, .footer-background-on footer a:visited {
    text-decoration: underline;
}
.footer-background-on footer a:active, .footer-background-on footer a:hover {
    text-decoration: none;          
}
.footer-background-on .fatfooter {
    border: none;
}
 
</style>
     
<?php
}

add_action( 'wp_head', 'wp_iclean_responsive_customize_colors' );
add_action( 'customize_register', 'wp_iclean_responsive_customize_register' );


function wp_iclean_responsive_get_theme_mod( $mod = '' ) {
	
    global $wp_iclean_responsive_options;

    $default_val = isset($wp_iclean_responsive_options[ $mod ]) ? $wp_iclean_responsive_options[ $mod ] : '';
    return get_theme_mod( $mod, $default_val );
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @package WP iClean Responsive
 * @since 1.0
 */
function wp_iclean_responsive_sanitize_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'wp_iclean_responsive_sanitize_clean', $var );
	} else {
		$data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		return wp_unslash($data);
	}
}

/**
 * Sanitize URL
 * 
 * @package WP iClean Responsive
 * @since 1.0
 */
function wp_iclean_responsive_sanitize_url( $url ) {
	return esc_url_raw( trim($url) );
}

/**
 * Strip Html Tags
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package WP iClean Responsive
 * @since 1.0
 */
function wp_iclean_responsive_sanitize_nohtml_kses($data = array()) {

	if ( is_array($data) ) {

	$data = array_map('wp_iclean_responsive_sanitize_nohtml_kses', $data);

	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_nohtml_kses($data);
	}

	return $data;
}

/**
 * Email sanitization callback.
 *
 */
function wp_iclean_responsive_sanitize_email( $email, $setting ) {
	$email = sanitize_email( $email );
	return ( ! is_null( $email ) ? $email : $setting->default );
}

/**
 * Checkbox sanitization callback.
 */
function wp_iclean_responsive_sanitize_checkbox( $checked ) {
	return ( ( !empty( $checked ) ) ? true : false );
}

/**
 * Select sanitization callback.
 *
 */
function wp_iclean_responsive_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
