<?php
if ( ! function_exists( 'shopline_get_category_list' ) ) :
    function shopline_get_category_list($arr='',$all=true){
        $cats = array();
        if($all == true){
            $cats[0] = 'All Categories';
        }
        foreach ( get_categories($arr) as $categories => $category ){
            $cats[$category->term_id] = $category->name;
         }
         return $cats;
    }
endif;
//  = Default Theme Customizer Settings  =
function shopline_lite_customize_register( $wp_customize ) {
$color_palette = array('rgb(150, 50, 220)', // RGB, RGBa, and hex values supported
       'rgba(50,50,50,0.8)',
        'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
        '#00CC99' // Mix of color types = no problem
                );
$palette = array('rgb(0, 0, 0, 0)'); 
// dummy data on/off
   $wp_customize->add_section('section_dummydata', array(
        'title'    => __('Dummy Data Hide/Show', 'shopline'),
        'priority' => 1,
    ));

   $wp_customize->add_setting('dummydata_hide_show', array(
            'default'        =>'show',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
    $wp_customize->add_control('dummydata_hide_show', array(
            'settings' => 'dummydata_hide_show',
            'label'   => __('Dummmy Data Hide / SHow','shopline'),
            'section' => 'section_dummydata',
            'type'    => 'radio',
            'choices'    => array(
                'show'        => __('Dummy Data Show','shopline'),
                'hide'      => __('Dummy Data Hide','shopline'),
            ),
        ));

/****************************************************************/
/************         Theme Settings      ************/
/****************************************************************/
 $wp_customize->add_panel( 'settings_theme_options', array(
        'priority'       => 4,
        'title'          => __('Theme Option', 'shopline'),
    ) );
/***********************  Global-setting    ************************/
$wp_customize->add_section('global_set', array(
        'title'    => __('Global Setting', 'shopline'),
        'priority' => 1,
        'panel'  => 'settings_theme_options',
));
 // page layout settings
$wp_customize->add_setting( 'shopline_layout',
    array(
              'sanitize_callback' => 'sanitize_text_field',
              'default'           => 'right',
               
              )
         );
$wp_customize->add_control( 'shopline_layout',
        array(
        'type'        => 'select',
        'label'       => esc_html__('Page Layout', 'shopline'),
        'description'       => esc_html__('Choose sidebar option for inner pages (non-home)', 'shopline'),
        'section'     => 'global_set',
        'choices' => array(
        'right' => esc_html__('Right sidebar', 'shopline'),
        'left' => esc_html__('Left sidebar', 'shopline'),
        'no-sidebar' => esc_html__('No sidebar', 'shopline'),
                    )
                )
            );
// Disable fixed Header
            $wp_customize->add_setting( 'shopline_sticky_header_disable',
                array(
                    'sanitize_callback' => 'themehunk_sanitize_checkbox',
                    'default'  => '',
                )
            );
            $wp_customize->add_control( 'shopline_sticky_header_disable',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Disable Fixed Header?', 'shopline'),
                    'section'     => 'global_set',
                    'description' => esc_html__('Check here to disable Fixed header and activate Normal header.', 'shopline')
                )
            );
// Disable parallax effect in all site
            $wp_customize->add_setting( 'parallax_opt',
                array(
                    'sanitize_callback' => 'themehunk_sanitize_checkbox',
                    'default'           => '',
                )
            );
            $wp_customize->add_control( 'parallax_opt',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Disable Parallax effect ?', 'shopline'),
                    'section'     => 'global_set',
                    'description' => esc_html__('Check here to disable Parallax effect ', 'shopline')
                )
            );
// Disable Animation
            $wp_customize->add_setting( 'shopline_animation_disable',
                array(
                    'sanitize_callback' => 'themehunk_sanitize_checkbox',
                    'default'           => '',
                )
            );
            $wp_customize->add_control( 'shopline_animation_disable',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Disable animation effect?', 'shopline'),
                    'section'     => 'global_set',
                    'description' => esc_html__('Check here to disable homepage section animation.', 'shopline')
                )
            );
   // Disable back to top button
            $wp_customize->add_setting( 'shopline_backtotop_disable',
                array(
                    'sanitize_callback' => 'themehunk_sanitize_checkbox',
                    'default'           => '',
                )
            );
            $wp_customize->add_control( 'shopline_backtotop_disable',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Hide back to top button ?', 'shopline'),
                    'section'     => 'global_set',
                    'description' => esc_html__('Check here to disable Back To Top button.', 'shopline')
                )
            ); 
// enable rtl-transform
            $wp_customize->add_setting( 'shopline_rtl_optn',
                array(
                    'sanitize_callback' => 'themehunk_sanitize_checkbox',
                    'default'           => '',
                )
            );
            $wp_customize->add_control( 'shopline_rtl_optn',
                array(
                    'type'        => 'checkbox',
                    'label'       => esc_html__('Enable Rtl Transform ?', 'shopline'),
                    'section'     => 'global_set',
                    'description' => esc_html__('Check here to enable right to left transform in your site.', 'shopline')
                )
            ); 
//  Genral Settings 
  $wp_customize->get_section('title_tagline')->panel = 'settings_theme_options';
  $wp_customize->get_section('title_tagline')->title = esc_html__('Theme Logo & favicon', 'shopline');
   $wp_customize->get_section('title_tagline')->priority = 2;

/*************************************/
// Header-setting
/*************************************/
$wp_customize->add_section('header_setting', array(
        'title'    => __('Header Setting', 'shopline'),
        'priority' => 3,
        'panel'  => 'settings_theme_options',
));
//header transparent
    $wp_customize->add_setting( 'hdr_bg_trnsparent_active',
              array(
            'sanitize_callback' => 'themehunk_sanitize_checkbox',
            'default'           => '',
                )
            );
    $wp_customize->add_control( 'hdr_bg_trnsparent_active',
                array(
                'type'        => 'checkbox',
                'label'       => esc_html__('Header Transparent', 'shopline'),
                'section'     => 'header_setting',
                'description' => esc_html__('(Only applied for front page template.)','shopline')
                )
            );
//header-toggle
    $wp_customize->add_setting('hdr_toggle_active', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'
    ));
    $wp_customize->add_control('hdr_toggle_active', array(
        'settings' => 'hdr_toggle_active',
        'label'     => __( 'Header Visibility','shopline'),
        'description' => esc_html__('(Check here to header will toggle on front page)', 'shopline'),
        'section' => 'header_setting',
        'type'    => 'checkbox',
    ) );
// custom-last-menu-button    
$wp_customize->add_setting( 'last_menu_btn',
              array(
                    'sanitize_callback' => 'themehunk_sanitize_checkbox',
                    'default'           => '',
                )
            );
$wp_customize->add_control( 'last_menu_btn',
                array(
                'type'        => 'checkbox',
                'label'       => esc_html__('Custom Button', 'shopline'),
                'description' => esc_html__('(Check here to style last Menu Item as a Custom Button)', 'shopline'),
                'section'     => 'header_setting',
                
                )
            );
// header-setting-color-option
//break 
$wp_customize->add_setting('header_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new themehunk_break_Misc_Control(
            $wp_customize,'header_break_color',array(
            'section' => 'header_setting',
            'description' => __( 'Header Color', 'shopline' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
            ))); 
// background-color
$wp_customize->add_setting('headr_bckg',
        array(
            'default'     => 'rgba(0, 0, 0,0)',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            
        ) );

$wp_customize->add_control(
        new Customize_themehunk_Color_Control($wp_customize,
            'headr_bckg',
            array(
                'label'     => __('Header Background','shopline'),
                'section'   => 'header_setting',
                'settings'  => 'headr_bckg',
                'palette'   => $palette
            )
        )
    );
// shrink header bg
$wp_customize->add_setting('shrnk_headr_bckg',
        array(
            'default'     => 'rgba(255, 255, 255,1)',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            
        ) );

$wp_customize->add_control(
        new Customize_themehunk_Color_Control($wp_customize,
            'shrnk_headr_bckg',
            array(
                'label'     => __('Header Shrink Background','shopline'),
                'section'   => 'header_setting',
                'settings'  => 'shrnk_headr_bckg',
                'palette'   => $palette
            )
        )
    );
// site-title
$wp_customize->add_setting('site_title_color', array(
        'default'        => '#080808',
        'capability'     => 'edit_theme_options', 
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'site_title_color', 
    array(
    'label' => __('Site Title','shopline'),
        'section'    => 'header_setting',
        'settings'   => 'site_title_color',
    ) ) );
// sub-title
$wp_customize->add_setting('site_desc_color', array(
        'default'        => '#666666',
        'capability'     => 'edit_theme_options', 
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'site_desc_color', 
    array(
    'label' => __('Title Description','shopline'),
        'section'    => 'header_setting',
        'settings'   => 'site_desc_color',
    ) ) );
//break 
$wp_customize->add_setting('menu_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new themehunk_break_Misc_Control(
            $wp_customize,'menu_break_color',array(
            'section' => 'header_setting',
            'description' => __( 'Menu Color', 'shopline' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
            ))); 
 $wp_customize->add_setting('top_menu_color', array(
        'default'        => '#080808',
        'capability'     => 'edit_theme_options', 
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'top_menu_color', 
    array(
    'label' => __('Menu Link','shopline'),
        'section'    => 'header_setting',
        'settings'   => 'top_menu_color',
    ) ) ); 

    $wp_customize->add_setting('top_menu_hvr_color', array(
        'default'        => '#e7c09c',
        'capability'     => 'edit_theme_options', 
        
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'top_menu_hvr_color', 
    array(
    'label' => __('Menu Link Hover/Active','shopline'),
        'section'    => 'header_setting',
        'settings'   => 'top_menu_hvr_color',
    ) ) ); 
    // responsive menu icon button color 
   $wp_customize->add_setting('mob_icon_color', array(
        'default'        => '#575757',
        'capability'     => 'edit_theme_options', 
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'mob_icon_color', 
    array(
    'label' => __('Responsive Menu Icon','featuredlite'),
        'section'    => 'header_setting',
        'settings'   => 'mob_icon_color',
) ) );   
//break 
$wp_customize->add_setting('icon_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new themehunk_break_Misc_Control(
            $wp_customize,'icon_break_color',array(
            'section' => 'header_setting',
            'description' => __( 'Icon Color', 'shopline' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
            )));
$wp_customize->add_setting('top_icon_color', array(
        'default'        => '#080808',
        'capability'     => 'edit_theme_options', 
    ));
    $wp_customize->add_control( 
    new WP_Customize_Color_Control(
    $wp_customize, 
    'top_icon_color', 
    array(
    'label' => __('Icon','featuredlite'),
        'section'    => 'header_setting',
        'settings'   => 'top_icon_color',
) ) );                           
// Page Container Setting 
        $wp_customize->add_section('contn_setng', array(
        'title'    => __('Page Container Setting', 'shopline'),
        'priority' => 61,
        'panel'    =>'settings_theme_options'
         ));
        $wp_customize->add_setting('contn_size', array(
        'default'           => '1200',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('contn_size', array(
        'label'    => __('Container Size (In Pixel)', 'shopline'),
        'description' => __('(For all theme pages)','shopline'),
        'section'  => 'contn_setng',
        'settings' => 'contn_size',
         'type'       => 'text',
         ));
/*************************************************************************/

                    //Contact-us-tempalte-option//

/**************************************************************************/   
$wp_customize->add_section( 'contact_sectn', array(
        'priority'       => 62,
        'title'          => __('Contact Page Setting', 'shopline'),
        'panel'          => 'settings_theme_options',
    ));
$wp_customize->add_setting('contact_txt', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'contact_txt',
            array(
        'section'  => 'contact_sectn',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'These settings will be applicable for page with <a target="_blank" href="//themehunk.com/docs/shopline-theme/#custom-setting">contact template</a> selected.','shopline' ),
        'priority'       => 0,
    ))); 
//pages-sidebar-settting
 $wp_customize->add_setting('contact_tel', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'
            ));
        $wp_customize->add_control('contact_tel', array(
            'label'    => __('Mobile', 'shopline'),
            'section'  => 'contact_sectn',
            'settings' => 'contact_tel',
             'type'       => 'text',
              'priority' => 5,
            ));

//adderess
$wp_customize->add_setting('contact_add', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea',
            
            ));
        $wp_customize->add_control('contact_add', array(
            'label'    => __('Address', 'shopline'),
            'section'  => 'contact_sectn',
            'settings' => 'contact_add',
             'type'       => 'textarea',
            'priority' => 5,
            ));
//time
$wp_customize->add_setting('contact_time', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea',
            
            ));
        $wp_customize->add_control('contact_time', array(
            'label'    => __('Time', 'shopline'),
            'section'  => 'contact_sectn',
            'settings' => 'contact_time',
             'type'       => 'textarea',
            'priority' => 5,
            ));
// shortcode
$wp_customize->add_setting('contact_shrcd', array(
        'default'           => '[lead-form form-id=1 title=Contact Us]',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'
            ));
       $wp_customize->add_control('contact_shrcd', array(
            'label'    => __('Shortcode', 'shopline'),
            'description'    => __('Install recommended <a target="_blank" href="//wordpress.org/plugins/lead-form-builder/">Contact Form & Lead Form Builder</a> Plugin for Contact Us form.', 'shopline'),
            'section'  => 'contact_sectn',
            'settings' => 'contact_shrcd',
             'type'       => 'textarea',
             'priority' => 5,
            )); 
/************         ORDERING & SECTION ON/OFF      ************/
 $wp_customize->add_section('section_onoff', array(
        'title'    => __('Section on/off', 'shopline'),
        'priority' => 4,
        'panel'    =>'settings_theme_options',
        
    ));
       //= Choose Post Meta  =
     $wp_customize->add_setting('section_on_off', array(
        'default'        =>array(),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_checkbox_explode'
    ));
    $wp_customize->add_control(new themehunk_Customize_Control_Checkbox_Multiple(
         $wp_customize,'section_on_off', array(
        'settings' => 'section_on_off',
        'label'   => __( 'Section On/Off Options', 'shopline' ),
        'section' => 'section_onoff',
          'choices' => array(
                    'slider'      => __( '1 Slider Section',      'shopline' ),
                    'search'      => __( '2 Search Section',        'shopline' ),
                    'woocate'     => __( '3 Woocommerce Category Slider Section',      'shopline' ),
                    'ribbon'      => __( '4 Ribbon Section',      'shopline' ),
                    'wooproduct'  => __( '5 Woocommerce Product Section',   'shopline' ),
                    'testimonial' => __( '6 Testimonial Section', 'shopline' ),
                    'aboutus'     => __( '7 About Us Section', 'shopline' ),
                    'blog'        => __( '8 Latest Blog Section', 'shopline' ),
                    'adsecond'    => __( '9 Three Column Section',       'shopline' ),
                    
    ) ) ) );
 //===============================
//= section ordering pro feature Settings =
//=============================
  $wp_customize->add_section('section_oder', array(
        'title'    => __('Section ordering', 'shopline'),
        'priority' => 90,
        'panel'    =>'settings_theme_options',
        
    )); 
$wp_customize->add_setting('more_grd_lyt_1', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'more_grd_lyt_1',
            array(
        'section'  => 'section_oder',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'Check out <a target="_blank" href="//themehunk.com/product/shopline-pro-multipurpose-shopping-theme/">ShoplinePro</a>  for full control over <strong>section ordering!</strong>','shopline' )
    )));  
/*
*******************************************************************/
/***************             SLIDER SECTION           ***************/
/********************************************************************/
// normal slider
$wp_customize->add_panel( 'normal_slider_panel', array(
        'priority'       => 5,
        'title'          => __('Slider', 'shopline'),
) );   
// slider-setting
$wp_customize->add_section('normal_color', array(
        'title'    => __('Slider Setting', 'shopline'),
        'priority' => 1,
        'panel'  => 'normal_slider_panel',
));
$wp_customize->add_setting('normal_slider_speed', array(
        'default'           => 3000,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_int'
    ));
    $wp_customize->add_control('normal_slider_speed', array(
        'label'    => __('Slider Speed', 'shopline'),
        'description'=> __('(Increase or decrease the value in multiple of thousand to change slide speed. For example 3000 equals to 3 second. )', 'shopline'),
        'section'  => 'normal_color',
        'settings' => 'normal_slider_speed',
         'type'       => 'text',
    ));
// overlay-color
           $wp_customize->add_setting(
                'normal_slider_bg_overly',
                array(
                    'default'     => 'rgba(0, 0, 0, 0)',
                    'type'        => 'theme_mod',
                    'capability'  => 'edit_theme_options',
                    'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
                    )       
            );
            $wp_customize->add_control(
                new Customize_themehunk_Color_Control(
                    $wp_customize,
                    'normal_slider_bg_overly',
                    array(
                        'label'         => __( 'Overlay Color', 'shopline' ),
                        'section'       => 'normal_color',
                        'settings'      => 'normal_slider_bg_overly',
                        'show_opacity'  => true, // Optional.
                        'palette'   => $palette
                    )
                )
            );

   $wp_customize->add_setting('sldr_heading_clr', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'sldr_heading_clr', array(
            'label'      => __('Heading Color', 'shopline' ),
            'section'    => 'normal_color',
            'settings'   => 'sldr_heading_clr',
        ) ) );
   $wp_customize->add_setting('sldr_subheading_clr', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'sldr_subheading_clr', array(
            'label'      => __('Sub Heading Color', 'shopline' ),
            'section'    => 'normal_color',
            'settings'   => 'sldr_subheading_clr',
        ) ) );

   // slider-button 
    $wp_customize->add_setting(
                'slider_bg_clr',
                array(
                    'default'     => 'rgba(0, 0, 0, 0)',
                    'type'        => 'theme_mod',
                    'capability'  => 'edit_theme_options',
                    'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
                    )       
            );
            $wp_customize->add_control(
                new Customize_themehunk_Color_Control(
                    $wp_customize,
                    'slider_bg_clr',
                    array(
                        'label'         => __( 'Button Background Color', 'shopline' ),
                        'section'       => 'normal_color',
                        'settings'      => 'slider_bg_clr',
                        'show_opacity'  => true, // Optional.
                        'palette'   => $palette
                    )
                )
            );

  $wp_customize->add_setting('sldr_btn_txt_clr', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'sldr_btn_txt_clr', array(
            'label'      => __('Button Text Color', 'shopline' ),
            'section'    => 'normal_color',
            'settings'   => 'sldr_btn_txt_clr',
        ) ) );

    $wp_customize->add_setting('sldr_btn_brd_clr', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'sldr_btn_brd_clr', array(
            'label'      => __('Button Border Color', 'shopline' ),
            'section'    => 'normal_color',
            'settings'   => 'sldr_btn_brd_clr',
        ) ) );

$wp_customize->add_setting(
                'slider_bg_hvr_clr',
                array(
                    'default'     => '#ffffff',
                    'type'        => 'theme_mod',
                    'capability'  => 'edit_theme_options',
                    'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
                    )       
            );
            $wp_customize->add_control(
                new Customize_themehunk_Color_Control(
                    $wp_customize,
                    'slider_bg_hvr_clr',
                    array(
                        'label'         => __( 'Button Background Hover Color', 'shopline' ),
                        'section'       => 'normal_color',
                        'settings'      => 'slider_bg_hvr_clr',
                        'show_opacity'  => true, // Optional.
                        'palette'   => $palette
                    )
                )
            );

    $wp_customize->add_setting('sldr_btn_hvr_txt_clr', array(
            'default'        => '#e7c09c',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'sldr_btn_hvr_txt_clr', array(
            'label'      => __('Button Text Hover Color', 'shopline' ),
            'section'    => 'normal_color',
            'settings'   => 'sldr_btn_hvr_txt_clr',
        ) ) );

$wp_customize->add_setting('sldr_btn_hvr_brd_clr', array(
            'default'        => '#ffff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'sldr_btn_hvr_brd_clr', array(
            'label'      => __('Button Border Hover Color', 'shopline' ),
            'section'    => 'normal_color',
            'settings'   => 'sldr_btn_hvr_brd_clr',
        ) ) );

//First slider image
$wp_customize->add_section('section_slider_first', array(
        'title'    => __('First Slide', 'shopline'),
        'priority' => 1,
         'panel'  => 'normal_slider_panel',
    ));
    $wp_customize->add_setting('first_slider_image', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'first_slider_image', array(
        'label'    => __('Slider Image Upload', 'shopline'),
        'section'  => 'section_slider_first',
        'settings' => 'first_slider_image',
    )));
    $wp_customize->add_setting('first_slider_heading', array(
        'default'           => 'Heading 1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('first_slider_heading', array(
        'label'    => __('Slider Heading', 'shopline'),
        'section'  => 'section_slider_first',
        'settings' => 'first_slider_heading',
         'type'       => 'text',
    ));
 
    $wp_customize->add_setting('first_slider_desc', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_textarea',
        'transport'         => 'postMessage'

    ));
    $wp_customize->add_control('first_slider_desc', array(
        'label'    => __('Description for slider', 'shopline'),
        'section'  => 'section_slider_first',
        'settings' => 'first_slider_desc',
         'type'       => 'textarea',
    ));
       $wp_customize->add_setting('first_slider_link', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('first_slider_link', array(
        'label'    => __('Link for slider', 'shopline'),
        'section'  => 'section_slider_first',
        'settings' => 'first_slider_link',
         'type'       => 'text',
    ));

         $wp_customize->add_setting('first_button_text', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('first_button_text', array(
        'label'    => __('Text for button', 'shopline'),
        'section'  => 'section_slider_first',
        'settings' => 'first_button_text',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('first_button_link', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('first_button_link', array(
        'label'    => __('Link for button', 'shopline'),
        'section'  => 'section_slider_first',
        'settings' => 'first_button_link',
         'type'       => 'text',
    ));
//Second slider image

     $wp_customize->add_section('section_slider_second', array(
        'title'    => __('Second Slide', 'shopline'),
        'priority' => 2,
         'panel'  => 'normal_slider_panel',
    ));
    $wp_customize->add_setting('second_slider_image', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'second_slider_image', array(
        'label'    => __('Slider Image Upload', 'shopline'),
        'section'  => 'section_slider_second',
        'settings' => 'second_slider_image',
    )));
    $wp_customize->add_setting('second_slider_heading', array(
        'default'           => 'Heading 1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('second_slider_heading', array(
        'label'    => __('Slider Heading', 'shopline'),
        'section'  => 'section_slider_second',
        'settings' => 'second_slider_heading',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('second_slider_desc', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_textarea',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('second_slider_desc', array(
        'label'    => __('Description for slider', 'shopline'),
        'section'  => 'section_slider_second',
        'settings' => 'second_slider_desc',
         'type'       => 'textarea',
    ));
    $wp_customize->add_setting('second_slider_link', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('second_slider_link', array(
        'label'    => __('Link for slider', 'shopline'),
        'section'  => 'section_slider_second',
        'settings' => 'second_slider_link',
         'type'       => 'text',
    ));

    $wp_customize->add_setting('second_button_text', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('second_button_text', array(
        'label'    => __('Text for button', 'shopline'),
        'section'  => 'section_slider_second',
        'settings' => 'second_button_text',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('second_button_link', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('second_button_link', array(
        'label'    => __('Link for button', 'shopline'),
        'section'  => 'section_slider_second',
        'settings' => 'second_button_link',
         'type'       => 'text',
    ));
 //Third slider image

     $wp_customize->add_section('section_slider_third', array(
        'title'    => __('Third Slide', 'shopline'),
        'priority' => 4,
        'panel'  => 'normal_slider_panel',
    ));
    $wp_customize->add_setting('third_slider_image', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_upload'
    ));
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'third_slider_image', array(
        'label'    => __('Slider Image Upload', 'shopline'),
        'section'  => 'section_slider_third',
        'settings' => 'third_slider_image',
    )));
    $wp_customize->add_setting('third_slider_heading', array(
        'default'           => 'Heading 1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('third_slider_heading', array(
        'label'    => __('Slider Heading', 'shopline'),
        'section'  => 'section_slider_third',
        'settings' => 'third_slider_heading',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('third_slider_desc', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_textarea',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('third_slider_desc', array(
        'label'    => __('Description for slider', 'shopline'),
        'section'  => 'section_slider_third',
        'settings' => 'third_slider_desc',
         'type'       => 'textarea',
    ));
    $wp_customize->add_setting('third_slider_link', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('third_slider_link', array(
        'label'    => __('Link for slider', 'shopline'),
        'section'  => 'section_slider_third',
        'settings' => 'third_slider_link',
         'type'       => 'text',
    ));

    $wp_customize->add_setting('third_button_text', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('third_button_text', array(
        'label'    => __('Text for button', 'shopline'),
        'section'  => 'section_slider_third',
        'settings' => 'third_button_text',
         'type'       => 'text',
    ));

     $wp_customize->add_setting('third_button_link', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control('third_button_link', array(
        'label'    => __('Link for button', 'shopline'),
        'section'  => 'section_slider_third',
        'settings' => 'third_button_link',
         'type'       => 'text',
    ));
// add-more-slider-pro       
$wp_customize->add_section('more_slidr_', array(
        'title'    => __('For More Slide', 'shopline'),
        'priority' => 5,
        'panel'  => 'normal_slider_panel',
    ));
   $wp_customize->add_setting('slide_more', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'slide_more',
            array(
        'section'  => 'more_slidr_',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'Check out <a target="_blank" href="//themehunk.com/product/shopline-pro-multipurpose-shopping-theme/">ShoplinePro</a> for six slide to show','shopline' )
    )));
/****************************************************************/
/************               SEARCH BOX               ************/
/****************************************************************/    
    $wp_customize->add_section('search_box_setting', array(
        'title'    => __('Search Box (WooCommerce)', 'shopline'),
        'priority' => 5,
    ));
    $wp_customize->add_setting('search_box_text', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('search_box_text', array(
        'label'    => __('Search Box Placeholder Text', 'shopline'),
        'section'  => 'search_box_setting',
        'settings' => 'search_box_text',
         'type'       => 'text',
    ));

    $wp_customize->add_setting('search_box_bg_color', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'search_box_bg_color', array(
            'label'      => __('Background Color', 'shopline' ),
            'section'    => 'search_box_setting',
            'settings'   => 'search_box_bg_color',
        ) ) );
    $wp_customize->add_setting('search_box_border_color', array(
            'default'        => '#bbb',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'search_box_border_color', array(
            'label'      => __('Border Color', 'shopline' ),
            'section'    => 'search_box_setting',
            'settings'   => 'search_box_border_color',
        ) ) );
    $wp_customize->add_setting('search_box_text_color', array(
            'default'        => '#bbb',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'search_box_text_color', array(
            'label'      => __('Placeholder Text Color', 'shopline' ),
            'section'    => 'search_box_setting',
            'settings'   => 'search_box_text_color',
        ) ) );
    $wp_customize->add_setting('search_box_btn_bg_color', array(
            'default'        => '#e7c09c',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'search_box_btn_bg_color', array(
            'label'      => __('Button Background Color', 'shopline' ),
            'section'    => 'search_box_setting',
            'settings'   => 'search_box_btn_bg_color',
        ) ) );
    $wp_customize->add_setting('search_box_icon_color', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'search_box_icon_color', array(
            'label'      => __('Search Icon Color', 'shopline' ),
            'section'    => 'search_box_setting',
            'settings'   => 'search_box_icon_color',
        ) ) );

/****************************************************************/
/************           WOO CATEGORY SLIDER         ************/
/****************************************************************/    
$wp_customize->add_panel( 'woo_cate_slider_panel', array(
        'priority'       => 6,
        'title'          => __('Category Slider (WooCommerce)', 'shopline'),
    ) );
    $wp_customize->add_section('woo_cate_slider_setting', array(
        'title'    => __('Main Heading & Subheading', 'shopline'),
        'priority' => 1,
        'panel'    =>'woo_cate_slider_panel'
    ));
    $wp_customize->add_setting('woo_cate_slider_heading', array(
        'default'           => '',
        'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'
    ));
   $wp_customize->add_control('woo_cate_slider_heading', array(
        'label'    => __('Heading', 'shopline'),
        'section'  => 'woo_cate_slider_setting',
        'settings' => 'woo_cate_slider_heading',
         'type'       => 'text',
    )); 
    $wp_customize->add_setting('woo_cate_slider_subheading', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'

    ));
    $wp_customize->add_control('woo_cate_slider_subheading', array(
        'label'    => __('Sub Heading', 'shopline'),
        'section'  => 'woo_cate_slider_setting',
        'settings' => 'woo_cate_slider_subheading',
        'type'       => 'textarea',
    )); 
    $wp_customize->add_section('woo_cate_slider_filter', array(
        'title'    => __('Category Filter', 'shopline'),
        'priority' => 2,
        'panel'    => 'woo_cate_slider_panel' 
    ));
    $wp_customize->add_setting('woo_cate_slider_list', array(
        'default'        => array(0),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_checkbox_explode',
    ));
    $wp_customize->add_control(new themehunk_Customize_Control_Checkbox_Multiple(
            $wp_customize,'woo_cate_slider_list', array(
        'settings' => 'woo_cate_slider_list',
        'label'   => __('Product Category','shopline'),
        'description' => __('Choose Category Display Product. (By Default All Categories Product Will Display)','shopline'),
        'section' => 'woo_cate_slider_filter',
        'choices' => shopline_get_category_list(array('taxonomy' =>'product_cat'),false),
    )));
//colorsclr
    $wp_customize->add_section('woo_cate_color', array(
        'title'    => __('Setting', 'shopline'),
        'priority' => 4,
        'panel'    =>'woo_cate_slider_panel'
    ));
     // autoplay on/off
    $wp_customize->add_setting('cat_play', array(
            'default'        =>'on',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
    $wp_customize->add_control('cat_play', array(
            'settings' => 'cat_play',
            'label'   => __('Slider Autoplay','shopline'),
            'section' => 'woo_cate_color',
            'type'    => 'radio',
            'choices'    => array(
                'on'        => 'On',
                'off'      => 'Off',
            ),
        ));
   $wp_customize->add_setting('woo_cate_slider_speed', array(
            'default'           => __('3000','shopline'),
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'      ));
    $wp_customize->add_control('woo_cate_slider_speed', array(
                'label'    => __('Slider Speed', 'shopline'),
                'section'  => 'woo_cate_color',
                'settings' => 'woo_cate_slider_speed',
                 'type'       => 'text',
    )); 
    //= Choose Post Meta  =
    $wp_customize->add_setting('woo_cate_image_bg', array(
            'default'        =>'color',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
    
    $wp_customize->add_control( 'woo_cate_image_bg', array(
            'settings' => 'woo_cate_image_bg',
            'label'   => __('Choose Background','shopline'),
            'section' => 'woo_cate_color',
            'type'    => 'radio',
            'choices'    => array(
                'color'        => 'Color',
                'image'      => 'Image',
            ),
        ));

        $wp_customize->add_setting('woo_cate_slider_bg_image', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 'woo_cate_slider_bg_image', array(
        'label'    => __('Upload Background Image', 'shopline'),
        'section'  => 'woo_cate_color',
        'settings' => 'woo_cate_slider_bg_image',
    )));

// overlay-color
    $wp_customize->add_setting(
        'woo_cate_slider_overly',
        array(
            'default'     => '#fff',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
            )       
    );
    $wp_customize->add_control(
        new Customize_themehunk_Color_Control(
            $wp_customize,
            'woo_cate_slider_overly',
            array(
                'label'         => __( 'Background Color ', 'shopline' ),
                'description'=> __( '(Set background color for section or set color with transparency for section overlay)', 'shopline' ),
                'section'       => 'woo_cate_color',
                'settings'      => 'woo_cate_slider_overly',
                'show_opacity'  => true, // Optional.
                'palette'   => $palette
            )));

    $wp_customize->add_setting('woo_cate_heading_color', array(
        'default'        => '#080808',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'woo_cate_heading_color', array(
        'label'      => __('Heading Color','shopline' ),
        'section'    => 'woo_cate_color',
        'settings'   => 'woo_cate_heading_color',
    ) ) );
    $wp_customize->add_setting('woo_cate_subheading_color', array(
        'default'        => '#666666',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'woo_cate_subheading_color', array(
        'label'      => __('Sub Heading Color','shopline' ),
        'section'    => 'woo_cate_color',
        'settings'   => 'woo_cate_subheading_color',
    ) ) );
    $wp_customize->add_setting('woo_cate_line_color', array(
        'default'        => '#e7c09c',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'woo_cate_line_color', array(
        'label'      => __('Title Underline Color','shopline' ),
        'section'    => 'woo_cate_color',
        'settings'   => 'woo_cate_line_color',
    ) ) );
// end woo_cat section

/****************************************************************/
/************  RIBBON SECTION  ************/
/****************************************************************/    
    $wp_customize->add_panel( 'ribbon_panel', array(
        'priority'       => 6,
        'title'          => __('Ribbon Section', 'shopline'),
    ) );
    $wp_customize->add_section('ribbon_sittings', array(
        'title'    => __('Main Heading & Subheading', 'shopline'),
        'priority' => 1,
        'panel'    =>'ribbon_panel'
    ));
    $wp_customize->add_setting('ribbon_heading', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('ribbon_heading', array(
        'label'    => __('Heading', 'shopline'),
        'section'  => 'ribbon_sittings',
        'settings' => 'ribbon_heading',
        'type'       => 'text',
    ));
    $wp_customize->add_setting('ribbon_subheading', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea',
        ));
        $wp_customize->add_control('ribbon_subheading', array(
            'label'    => __('Sub Heading', 'shopline'),
            'section'  => 'ribbon_sittings',
            'settings' => 'ribbon_subheading',
             'type'       => 'textarea',
        ));

// Color
    $wp_customize->add_section('ribbon_color', array(
        'title'    => __('Setting', 'shopline'),
        'priority' => 4,
        'panel'    =>'ribbon_panel'
    ));
   //background option
    $wp_customize->add_setting('ribbon_bg_options', array(
            'default'        =>'color',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
    
    $wp_customize->add_control('ribbon_bg_options', array(
            'settings' => 'ribbon_bg_options',
            'label'   => __('Choose Background','shopline'),
            'section' => 'ribbon_color',
            'type'    => 'radio',
            'choices'    => array(
                'color'      => 'Color',
                'image'      => 'Image',
                'video'      => 'Video'
            ),
        ));
    $wp_customize->add_setting('ribbon_bg_image', array(
        'default'        => SHOPLINE_RIBBON_BG_IMAGE,
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 'ribbon_bg_image', array(
        'label'    => __('Upload Background Image', 'shopline'),
        'section'  => 'ribbon_color',
        'settings' => 'ribbon_bg_image',
    )));
    $wp_customize->add_setting('ribbon_bg_video', array(
       'default'        => '',
       'sanitize_callback' => 'sanitize_text_field'
   ));
   $wp_customize->add_control( new WP_Customize_Upload_Control(
       $wp_customize, 'ribbon_bg_video', array(
       'label'    => __('Upload Background Video', 'shopline'),
       'section'  => 'ribbon_color',
       'settings' => 'ribbon_bg_video',
   )));
   $wp_customize->add_setting('ribbon_video_bg_image', array(
        'default'        => SHOPLINE_RIBBON_BG_IMAGE,
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 'ribbon_video_bg_image', array(
        'label'    => __('Upload Background Image', 'shopline'),
        'description' => __('Display Mobile view BG Image','shopline'),
        'section'  => 'ribbon_color',
        'settings' => 'ribbon_video_bg_image',
    )));
   // muted
   $wp_customize->add_setting('video_muted', array(
       'default'        => '',
       'capability'     => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_text_field'
   ));
   $wp_customize->add_control( 'video_muted', array(
       'settings' => 'video_muted',
       'label'   => __('Muted Audio','shopline'),
       'section' => 'ribbon_color',
       'type'    => 'checkbox',
       'choices'    => array(
       'muted'      => 'Video Audio Muted',
       ),
   ));
 // overlay-color
    $wp_customize->add_setting(
        'ribbn_img_overly_color',
        array(
            'default'     => '#7D7D7D',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
            )       
    );
    $wp_customize->add_control(
        new Customize_themehunk_Color_Control(
            $wp_customize,
            'ribbn_img_overly_color',
            array(
                'label'         => __( 'Background Color', 'shopline' ),
                'description'=> __( '(Set background color for section or set color with transparency for section overlay)', 'shopline' ),
                'section'       => 'ribbon_color',
                'settings'      => 'ribbn_img_overly_color',
                'show_opacity'  => true, // Optional.
                'palette'   => $palette
            )));

    $wp_customize->add_setting('ribbon_heading_color', array(
        'default'        => '#fff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'ribbon_heading_color', array(
        'label'      => __('Heading Color', 'shopline' ),
        'section'    => 'ribbon_color',
        'settings'   => 'ribbon_heading_color',
    ) ) );
    $wp_customize->add_setting('ribbon_subheading_color', array(
        'default'        => '#fff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'ribbon_subheading_color', array(
        'label'      => __('Sub Heading Color', 'shopline' ),
        'section'    => 'ribbon_color',
        'settings'   => 'ribbon_subheading_color',
    ) ) );
    $wp_customize->add_setting('ribbon_line_color', array(
        'default'        => '#e7c09c',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'ribbon_line_color', array(
        'label'      => __('Title Underline Color', 'shopline' ),
        'section'    => 'ribbon_color',
        'settings'   => 'ribbon_line_color',
    ) ) );
// end ribbon

/****************************************************************/
/************           WOO PRODUCT         ************/
/****************************************************************/    
    $wp_customize->add_panel( 'woo_cate_product_panel', array(
        'priority'       => 7,
        'title'          => __('Product Section (WooCommerce)', 'shopline'),
    ) );
    
         
       //= Choose Product Category Filter = 

    $wp_customize->add_section('woo_cate_product_filter', array(
        'title'    => __('Product Filter', 'shopline'),
        'priority' => 2,
        'panel'    => 'woo_cate_product_panel' 
    ));

       $wp_customize->add_setting('woo_cate_product_filter_type', array(
        'default'        =>'cate',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'woo_cate_product_filter_type', array(
        'settings' => 'woo_cate_product_filter_type',
        'label'   => __('Product Type','shopline'),
        'section' => 'woo_cate_product_filter',
        'type'    => 'radio',
        'choices'           => array(
            'cate'          => 'Category Product',
            'recent'        => 'Recent Product',
        ),
    ));
     $wp_customize->add_setting('woo_cate_product_layout', array(
        'default'        =>'grid',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 'woo_cate_product_layout', array(
        'settings' => 'woo_cate_product_layout',
        'label'    => __('Product Layout','shopline'),
        'section'  => 'woo_cate_product_filter',
        'type'     => 'radio',
        'choices'           => array(
            'grid'          => 'Grid Layout',
        ),
    ));
     $wp_customize->add_setting('woo_cate_product_count', array(
        'default'           => 8,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
    $wp_customize->add_control('woo_cate_product_count', array(
        'settings'  => 'woo_cate_product_count',
        'label'     => __('Number of Product','shopline'),
        'section'   => 'woo_cate_product_filter',
        'type'      => 'number',
       'input_attrs' => array('min' => 1,'max' => 100) ));
     $wp_customize->add_setting('woo_cate_product_list', array(
        'default'        => array(0),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_checkbox_explode',
    ));
    $wp_customize->add_control(new themehunk_Customize_Control_Checkbox_Multiple(
            $wp_customize,'woo_cate_product_list', array(
        'settings' => 'woo_cate_product_list',
        'label'   => __('Product Category','shopline'),
        'description' => __('Choose Category Display Product. (By Default All Categories Product Will Display)','shopline'),
        'section' => 'woo_cate_product_filter',
        'choices' => shopline_get_category_list(array('taxonomy' =>'product_cat'),false),
    )));
$wp_customize->add_setting('section_order', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'section_order',
            array(
        'section'  => 'woo_cate_product_filter',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'Check out <a target="_blank" href="//themehunk.com/product/shopline-pro-multipurpose-shopping-theme/">ShoplinePro</a> for advance <strong>Product layout</strong>!','shopline' )
    )));            
    //color
        $wp_customize->add_section('woo_cate_product_color', array(
            'title'    => __('Setting', 'shopline'),
            'priority' => 4,
            'panel'    =>'woo_cate_product_panel'
        ));
        $wp_customize->add_setting('woo_cate_product_heading', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
       $wp_customize->add_control('woo_cate_product_heading', array(
            'label'    => __('Main Heading', 'shopline'),
            'section'  => 'woo_cate_product_color',
            'settings' => 'woo_cate_product_heading',
             'type'       => 'text',
        ));
        $wp_customize->add_setting('woo_cate_product_options', array(
            'default'        =>'color',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
    
        $wp_customize->add_control( 'woo_cate_product_options', array(
            'settings' => 'woo_cate_product_options',
            'label'   => __('Choose Background','shopline'),
            'section' => 'woo_cate_product_color',
            'type'    => 'radio',
            'choices'    => array(
                'color'      => 'Color',
                'image'      => 'Image',
            ),
        ));

        $wp_customize->add_setting('woo_cate_product_bg_image', array(
            'default'        => '',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize, 'woo_cate_product_bg_image', array(
            'label'    => __('Upload Background Image', 'shopline'),
            'section'  => 'woo_cate_product_color',
            'settings' => 'woo_cate_product_bg_image',
        )));
        
// overlay-color
    $wp_customize->add_setting(
        'woo_cate_product_overly',
        array(
            'default'     => '#fff',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
            )       
    );
    $wp_customize->add_control(
        new Customize_themehunk_Color_Control(
            $wp_customize,
            'woo_cate_product_overly',
            array(
                'label'         => __( 'Background Color', 'shopline' ),
                'description'=> __( '(Set background color for section or set color with transparency for section overlay)', 'shopline' ),
                'section'       => 'woo_cate_product_color',
                'settings'      => 'woo_cate_product_overly',
                'show_opacity'  => true, // Optional.
                'palette'   => $palette
            )
        )
    );

        $wp_customize->add_setting('woo_cate_product_heading_color', array(
            'default'        => '#080808',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_heading_color', array(
            'label'      => __('Heading Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_heading_color',
        ) ) );
        $wp_customize->add_setting('woo_cate_product_line_color', array(
            'default'        => '#e7c09c',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_line_color', array(
            'label'      => __('Title Underline Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_line_color',
        ) ) );

        

        $wp_customize->add_setting('woo_cate_product_cate_text_hover_color', array(
            'default'        => '#7c7c80',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_cate_text_hover_color', array(
            'label'      => __('Category Text Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_cate_text_hover_color',
        ) ) );
        $wp_customize->add_setting('woo_cate_product_border_color', array(
            'default'           => '#e7c09c',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_border_color', array(
            'label'      => __('Category Border & hover Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_border_color',
        ) ) );
         $wp_customize->add_setting('woo_cate_product_line_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new themehunk_break_Misc_Control(
            $wp_customize,'woo_cate_product_line_break_color',array(
            'section' => 'woo_cate_product_color',
            'description' => __( 'Product Color Option', 'shopline' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
            )));

        $wp_customize->add_setting('woo_cate_product_text_color', array(
            'default'        => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_text_color', array(
            'label'      => __('Text Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_text_color',
        ) ) );

        $wp_customize->add_setting('woo_cate_product_desc_color', array(
            'default'        => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_desc_color', array(
            'label'      => __('Description Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_desc_color',
        ) ) );

        $wp_customize->add_setting('woo_cate_product_price_color', array(
            'default'        => '#1e1e23',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_price_color', array(
            'label'      => __('Pricing Text Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_price_color',
        ) ) );

        $wp_customize->add_setting('woo_cate_product_cart_btn_color', array(
            'default'        => '#232531',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_cart_btn_color', array(
            'label'      => __('Icon Background Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_cart_btn_color',
        ) ) );

        $wp_customize->add_setting('woo_cate_product_cart_text_color', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_cart_text_color', array(
            'label'      => __('Icon Text Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_cart_text_color',
        ) ) );

        $wp_customize->add_setting('woo_cate_product_sale_btn_color', array(
            'default'        => '#232531',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_sale_btn_color', array(
            'label'      => __('Sale Button Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_sale_btn_color',
        ) ) );

        $wp_customize->add_setting('woo_cate_product_sale_text_color', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'woo_cate_product_sale_text_color', array(
            'label'      => __('Sale Button Text Color', 'shopline' ),
            'section'    => 'woo_cate_product_color',
            'settings'   => 'woo_cate_product_sale_text_color',
        ) ) );

/****************************************************************/
/************                TESTIMONIAL            ************/
/****************************************************************/ 

    $wp_customize->add_panel( 'testimonial_panel', array(
        'priority'       => 9,
        'title'          => __('Testimonial Section', 'shopline'),
        ));
$wp_customize->add_section('testim_setting', array(
        'title'    => __('Main Heading & Subheading', 'shopline'),
        'priority' => 1,
        'panel'    =>'testimonial_panel'
    ));
    $wp_customize->add_setting('our_testm_heading', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
   $wp_customize->add_control('our_testm_heading', array(
        'label'    => __('Heading', 'shopline'),
        'section'  => 'testim_setting',
        'settings' => 'our_testm_heading',
         'type'       => 'text',
    )); 
    $wp_customize->add_setting('our_testm_subheading', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'

    ));
    $wp_customize->add_control('our_testm_subheading', array(
        'label'    => __('Sub Heading', 'shopline'),
        'section'  => 'testim_setting',
        'settings' => 'our_testm_subheading',
        'type'       => 'textarea',
    ));  

    //color
        $wp_customize->add_section('testimonial_color', array(
            'title'    => __('Setting', 'shopline'),
            'priority' => 4,
            'panel'    =>'testimonial_panel'
        ));
        // autoplay on/off
    $wp_customize->add_setting('testm_play', array(
            'default'        =>'on',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
    $wp_customize->add_control('testm_play', array(
            'settings' => 'testm_play',
            'label'   => __('Autoplay','shopline'),
            'section' => 'testimonial_color',
            'type'    => 'radio',
            'choices'    => array(
                'on'        => 'On',
                'off'      => 'Off',
            ),
        ));
   $wp_customize->add_setting('testm_slider_speed', array(
            'default'           => __('3000','shopline'),
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'      ));
    $wp_customize->add_control('testm_slider_speed', array(
                'label'    => __('Speed', 'shopline'),
                'section'  => 'testimonial_color',
                'settings' => 'testm_slider_speed',
                 'type'       => 'text',
    ));    
        $wp_customize->add_setting('testimonial_options', array(
            'default'        =>'color',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 'testimonial_options', array(
            'settings' => 'testimonial_options',
            'label'   => __('Choose Background','shopline'),
            'section' => 'testimonial_color',
            'type'    => 'radio',
            'choices'    => array(
                'color'      => 'Color',
                'image'      => 'Image',
            ),
        ));
         $wp_customize->add_setting('testimonial_bg_image', array(
            'default'        => '',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize, 'testimonial_bg_image', array(
            'label'    => __('Upload Background Image', 'shopline'),
            'section'  => 'testimonial_color',
            'settings' => 'testimonial_bg_image',
        )));
        
        // overlay-color
            $wp_customize->add_setting(
                'tst_img_overly_color',
                array(
                    'default'     => '#e7e8e9',
                    'type'        => 'theme_mod',
                    'capability'  => 'edit_theme_options',
                    'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
                    )       
            );
        $wp_customize->add_control(
        new Customize_themehunk_Color_Control(
            $wp_customize,
            'tst_img_overly_color',
            array(
                'label'         => __( 'Background Color', 'shopline' ),
                'description'=> __( '(Set background color for section or set color with transparency for section overlay)', 'shopline' ),
                'section'       => 'testimonial_color',
                'settings'      => 'tst_img_overly_color',
                'show_opacity'  => true, // Optional.
                'palette'   => $palette
            )));

        $wp_customize->add_setting('testimonial_heading_color', array(
            'default'        => '#080808',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'testimonial_heading_color', array(
            'label'      => __('Heading Color', 'shopline' ),
            'section'    => 'testimonial_color',
            'settings'   => 'testimonial_heading_color',
        ) ) );

        $wp_customize->add_setting('testimonial_subheading_color', array(
            'default'        => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'testimonial_subheading_color', array(
            'label'      => __('Sub Heading Color', 'shopline' ),
            'section'    => 'testimonial_color',
            'settings'   => 'testimonial_subheading_color',
        ) ) );

        $wp_customize->add_setting('testimonial_line_color', array(
        'default'        => '#e7c09c',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( 
        new WP_Customize_Color_Control($wp_customize,'testimonial_line_color', array(
        'label'      => __('Title Underline Color', 'shopline' ),
        'section'    => 'testimonial_color',
        'settings'   => 'testimonial_line_color',
    ) ) );
/****************************************************************/
/************            ABOUT US SECTION           ************/
/****************************************************************/ 
    $wp_customize->add_panel( 'aboutus_panel', array(
        'priority'       => 10,
        'title'          => __('About Us Section', 'shopline'),
        ));
    //header
        $wp_customize->add_section('aboutus_setting', array(
            'title'    => __('Setting', 'shopline'),
            'panel'    =>'aboutus_panel',
            'priority' => 1,
            ));
         $wp_customize->add_setting('about_rgt_line_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new themehunk_break_Misc_Control(
            $wp_customize,'about_rgt_line_break_color',array(
            'section' => 'aboutus_setting',
            'description' => __( 'Right Column', 'shopline' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
            )));

       $wp_customize->add_setting('aboutus_image', array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'themehunk_customizer_sanitize_upload'
            ));
              $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'aboutus_image', array(
                'label'    => __('Image Upload', 'shopline'),
                'section'  => 'aboutus_setting',
                'settings' => 'aboutus_image',
            )));
       
       $wp_customize->add_setting('about_line_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new themehunk_break_Misc_Control(
            $wp_customize,'about_line_break_color',array(
            'section' => 'aboutus_setting',
            'description' => __( 'Left Column', 'shopline' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
            )));
$wp_customize->add_setting('aboutus_heading', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
            ));
       $wp_customize->add_control('aboutus_heading', array(
            'label'    => __('Main Heading', 'shopline'),
            'section'  => 'aboutus_setting',
            'settings' => 'aboutus_heading',
             'type'       => 'text',
            ));

        $wp_customize->add_setting('aboutus_shortdesc', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'
            ));
        $wp_customize->add_control('aboutus_shortdesc', array(
            'label'    => __('Short Description', 'shopline'),
            'section'  => 'aboutus_setting',
            'settings' => 'aboutus_shortdesc',
             'type'       => 'textarea',
            ));
        $wp_customize->add_setting('aboutus_longdesc', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'
            ));
        $wp_customize->add_control('aboutus_longdesc', array(
            'label'    => __('Description', 'shopline'),
            'section'  => 'aboutus_setting',
            'settings' => 'aboutus_longdesc',
             'type'       => 'textarea',
            ));
         $wp_customize->add_setting('aboutus_btn_text', array(
                'default'           => '',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));
        $wp_customize->add_control('aboutus_btn_text', array(
                'label'    => __('Button Text', 'shopline'),
                'section'  => 'aboutus_setting',
                'settings' => 'aboutus_btn_text',
                 'type'       => 'text',
            ));
            
       $wp_customize->add_setting('aboutus_btn_link', array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            ));
        $wp_customize->add_control('aboutus_btn_link', array(
            'label'    => __('Button Link', 'shopline'),
            'section'  => 'aboutus_setting',
            'settings' => 'aboutus_btn_link',
             'type'       => 'text',
            ));
     
    //color
        $wp_customize->add_section('aboutus_color', array(
            'title'    => __('Color', 'shopline'),
            'priority' => 4,
            'panel'    =>'aboutus_panel'
        ));

        $wp_customize->add_setting('aboutus_options', array(
            'default'        =>'color',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
    
        $wp_customize->add_control( 'aboutus_options', array(
            'settings' => 'aboutus_options',
            'label'   => __('Choose Background','shopline'),
            'section' => 'aboutus_color',
            'type'    => 'radio',
            'choices'    => array(
                'color'      => 'Color',
                'image'      => 'Image',
            ),
        ));
       $wp_customize->add_setting('aboutus_bg_image', array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize, 'aboutus_bg_image', array(
            'label'    => __('Upload Background Image', 'shopline'),
            'section'  => 'aboutus_color',
            'settings' => 'aboutus_bg_image',
        )));
      
    // overlay-color
        $wp_customize->add_setting(
            'aboutus_overly',
            array(
                'default'     => '#fff',
                'type'        => 'theme_mod',
                'capability'  => 'edit_theme_options',
                'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
                )       
        );
        $wp_customize->add_control(
            new Customize_themehunk_Color_Control(
                $wp_customize,
                'aboutus_overly',
                array(
                    'label'         => __( 'Background Color', 'shopline' ),
                    'description'=> __( '(Set background color for section or set color with transparency for section overlay)', 'shopline' ),
                    'section'       => 'aboutus_color',
                    'settings'      => 'aboutus_overly',
                    'show_opacity'  => true, // Optional.
                    'palette'   => $palette
                )));

      $wp_customize->add_setting('headingq_line_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new themehunk_break_Misc_Control(
            $wp_customize,'headingq_line_break_color',array(
            'section' => 'aboutus_color',
            'description' => __( 'Color', 'shopline' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
            )));
        $wp_customize->add_setting('aboutus_heading_color', array(
            'default'        => '#080808',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'aboutus_heading_color', array(
            'label'      => __('Heading Color', 'shopline' ),
            'section'    => 'aboutus_color',
            'settings'   => 'aboutus_heading_color',
        ) ) );

        $wp_customize->add_setting('aboutus_shortdesc_color', array(
            'default'        => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'aboutus_shortdesc_color', array(
            'label'      => __('Short Description Color', 'shopline' ),
            'section'    => 'aboutus_color',
            'settings'   => 'aboutus_shortdesc_color',
        ) ) );

         $wp_customize->add_setting('aboutus_longdesc_color', array(
            'default'        => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'aboutus_longdesc_color', array(
            'label'      => __('Long Description Color', 'shopline' ),
            'section'    => 'aboutus_color',
            'settings'   => 'aboutus_longdesc_color',
        ) ) );

         $wp_customize->add_setting('button_line_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new themehunk_Misc_Control(
            $wp_customize,'button_line_break_color',array(
            'section' => 'aboutus_color',
            'description' => __( 'Button Color', 'shopline' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
            )));

        $wp_customize->add_setting('aboutus_btn_color', array(
            'default'        => '#e7c09c',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'aboutus_btn_color', array(
            'label'      => __('Button Border and Hover Color', 'shopline' ),
            'section'    => 'aboutus_color',
            'settings'   => 'aboutus_btn_color',
        ) ) );

        $wp_customize->add_setting('aboutus_btn_text_color', array(
            'default'        => '#e7c09c',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'aboutus_btn_text_color', array(
            'label'      => __('Button Text Color', 'shopline' ),
            'section'    => 'aboutus_color',
            'settings'   => 'aboutus_btn_text_color',
        ) ) );
        $wp_customize->add_setting('aboutus_btn_shadow_color', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'aboutus_btn_shadow_color', array(
            'label'      => __('Button Text Hover Color', 'shopline' ),
            'section'    => 'aboutus_color',
            'settings'   => 'aboutus_btn_shadow_color',
        ) ) );

/****************************************************************/
/************           LATEST POST SECTION         ************/
/****************************************************************/ 
    $wp_customize->add_panel( 'blog_panel', array(
        'priority'       => 11,
        'title'          => __('Latest Blog Section', 'shopline'),
        ));
    //header
        $wp_customize->add_section('blog_setting', array(
            'title'    => __('Main Heading & Sub Heading', 'shopline'),
            'priority' => 1,
            'panel'    =>'blog_panel'
            ));
        $wp_customize->add_setting('blog_heading', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'
            ));
       $wp_customize->add_control('blog_heading', array(
            'label'    => __('Main Heading', 'shopline'),
            'section'  => 'blog_setting',
            'settings' => 'blog_heading',
             'type'       => 'text',
            )); 
        $wp_customize->add_setting('blog_subheading', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'
            ));
        $wp_customize->add_control('blog_subheading', array(
            'label'    => __('Sub Heading', 'shopline'),
            'section'  => 'blog_setting',
            'settings' => 'blog_subheading',
             'type'       => 'textarea',
            ));
    

    
// blog-setting
    $wp_customize->add_section('blog_slider_set', array(
        'title'    => __('Post Setting', 'shopline'),
        'priority' => 3,
        'panel'    =>'blog_panel'
    ));  
    //= Choose All Category  =   
     $wp_customize->add_setting('slider_cate', array(
        'default'        => 0,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
    $wp_customize->add_control('slider_cate', array(
        'settings' => 'slider_cate',
        'label'   => __('Latest Post Category','shopline'),
        'section' => 'blog_slider_set',
        'type' => 'select',
        'choices' => shopline_get_category_list(),
    ) );
    $wp_customize->add_setting('slider_cate_count', array(
        'default'        => 4,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
    $wp_customize->add_control('slider_cate_count', array(
        'settings'  => 'slider_cate_count',
        'label'     => __('Number of Post','shopline'),
        'section'   => 'blog_slider_set',
        'type'      => 'number',
       'input_attrs' => array('min' => 1,'max' => 10)
    ) );
 $wp_customize->add_setting('read_more_txt', array(
        'default'        => 'Read More',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
$wp_customize->add_control('read_more_txt', array(
        'settings'  => 'read_more_txt',
        'label'     => __('Change Read More Text','shopline'),
        'description'=> __('Enter a text below that you want to show instead of Read More','shopline'),
        'section'   => 'blog_slider_set',
        'type'      => 'text',
       
    ) );
    
//color
        $wp_customize->add_section('blog_color', array(
            'title'    => __('Setting', 'shopline'),
            'priority' => 4,
            'panel'    =>'blog_panel'
        ));
        // autoplay on/off
    $wp_customize->add_setting('blog_play', array(
            'default'        =>'on',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
    $wp_customize->add_control('blog_play', array(
            'settings' => 'blog_play',
            'label'   => __('Autoplay','shopline'),
            'section' => 'blog_color',
            'type'    => 'radio',
            'choices'    => array(
                'on'        => 'On',
                'off'      => 'Off',
            ),
        ));
  $wp_customize->add_setting('blog_slider_speed', array(
            'default'           => __('3000','shopline'),
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_textarea'      ));
    $wp_customize->add_control('blog_slider_speed', array(
                'label'    => __('Speed', 'shopline'),
                'section'  => 'blog_color',
                'settings' => 'blog_slider_speed',
                 'type'       => 'text',
    )); 
$wp_customize->add_setting('blog_options', array(
            'default'        =>'color',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
    
        $wp_customize->add_control( 'blog_options', array(
            'settings' => 'blog_options',
            'label'   => __('Choose Background','shopline'),
            'section' => 'blog_color',
            'type'    => 'radio',
            'choices'    => array(
                'color'      => 'Color',
                'image'      => 'Image',
            ),
        ));
        $wp_customize->add_setting('blog_bg_image', array(
            'default'        => '',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize, 'blog_bg_image', array(
            'label'    => __('Upload Background Image', 'shopline'),
            'section'  => 'blog_color',
            'settings' => 'blog_bg_image',
        )));
        
// overlay-color
        $wp_customize->add_setting(
        'blog_overly',
        array(
            'default'     => '#e7e8e9',
            'type'        => 'theme_mod',
            'capability'  => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
            )       
        );
        $wp_customize->add_control(new Customize_themehunk_Color_Control(
            $wp_customize,
            'blog_overly',
            array(
                'label'         => __( 'Background Color', 'shopline' ),
                'description'=> __( '(Set background color for section or set color with transparency for section overlay)', 'shopline' ),
                'section'       => 'blog_color',
                'settings'      => 'blog_overly',
                'show_opacity'  => true, // Optional.
                'palette'   => $palette
        ) ) );


        $wp_customize->add_setting('blog_heading_color', array(
            'default'        => '#080808',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'blog_heading_color', array(
            'label'      => __('Heading Color', 'shopline' ),
            'section'    => 'blog_color',
            'settings'   => 'blog_heading_color',
        ) ) );
        $wp_customize->add_setting('blog_subheading_color', array(
            'default'        => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'blog_subheading_color', array(
            'label'      => __('Sub Heading Color', 'shopline' ),
            'section'    => 'blog_color',
            'settings'   => 'blog_subheading_color',
        ) ) );
         $wp_customize->add_setting('blog_line_color', array(
        'default'        => '#e7c09c',
        'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'blog_line_color', array(
            'label'      => __('Title Underline Color', 'shopline' ),
            'section'    => 'blog_color',
            'settings'   => 'blog_line_color',
        ) ) );

         $wp_customize->add_setting('blog_line_break_color', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new themehunk_break_Misc_Control(
            $wp_customize,'blog_line_break_color',array(
            'section' => 'blog_color',
            'description' => __( 'Post Color Options', 'shopline' ),
            'type' => 'content',
            'input_attrs' => array('divider' => true),
            )));

        $wp_customize->add_setting('blog_datetxt_color', array(
            'default'        => '#bbb',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'blog_datetxt_color', array(
            'label'      => __('Date Text Color', 'shopline' ),
            'section'    => 'blog_color',
            'settings'   => 'blog_datetxt_color',
        ) ) );

        $wp_customize->add_setting('blog_text_heading_color', array(
            'default'        => '#111',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'blog_text_heading_color', array(
            'label'      => __('Title Color', 'shopline' ),
            'section'    => 'blog_color',
            'settings'   => 'blog_text_heading_color',
        ) ) );

        $wp_customize->add_setting('blog_text_desc_color', array(
            'default'        => '#666',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'blog_text_desc_color', array(
            'label'      => __('Description Color', 'shopline' ),
            'section'    => 'blog_color',
            'settings'   => 'blog_text_desc_color',
        ) ) ); 
/****************************************************************/
/************             THREE COLUMN ADS             ************/
/****************************************************************/    
    $wp_customize->add_panel( 'three_column_ads_panel', array(
        'priority'       => 12,
        'title'          => __('Three Column Ad', 'shopline'),
    ) );
    // first ads
    $wp_customize->add_section( 'three_column_ads_first_column', array(
         'title'          => __( 'First Ad','shopline' ),
         'panel'          => 'three_column_ads_panel',
         'priority'       => 1,
    ) );
    
    $wp_customize->add_setting('three_column_ads_first_image', array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_upload'
        ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'three_column_ads_first_image', array(
            'label'    => __('Upload Image', 'shopline'),
            'section'  => 'three_column_ads_first_column',
            'settings' => 'three_column_ads_first_image',
        )));
    $wp_customize->add_setting('three_column_ads_first_url', array(
            'default'           => '#',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw'
        ));
    $wp_customize->add_control('three_column_ads_first_url', array(
            'label'    => __('Image Link', 'shopline'),
            'section'  => 'three_column_ads_first_column',
            'settings' => 'three_column_ads_first_url',
             'type'       => 'text',
        ));
  // first overlay-color
            $wp_customize->add_setting(
                'three_column_img_fst_color',
                array(
                    'default'     => 'rgba(0, 0, 0, 0)',
                    'type'        => 'theme_mod',
                    'capability'  => 'edit_theme_options',
                    'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
                    )       
            );
        $wp_customize->add_control(
        new Customize_themehunk_Color_Control(
            $wp_customize,
            'three_column_img_fst_color',
            array(
                'label'         => __( 'First Image Overlay Color', 'shopline' ),
                'section'       => 'three_column_ads_first_column',
                'settings'      => 'three_column_img_fst_color',
                'show_opacity'  => true, // Optional.
                'palette'   => $palette
            )));

    // second ads
    $wp_customize->add_section( 'three_column_ads_second_column', array(
         'title'          => __( 'Second Ad','shopline' ),
         'panel'          => 'three_column_ads_panel',
         'priority'       => 1,
    ) );
    
    $wp_customize->add_setting('three_column_ads_second_image', array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_upload'
        ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'three_column_ads_second_image', array(
            'label'    => __('Upload Image', 'shopline'),
            'section'  => 'three_column_ads_second_column',
            'settings' => 'three_column_ads_second_image',
        )));
    $wp_customize->add_setting('three_column_ads_second_url', array(
            'default'           => '#',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw'
        ));
    $wp_customize->add_control('three_column_ads_second_url', array(
            'label'    => __('Image Link', 'shopline'),
            'section'  => 'three_column_ads_second_column',
            'settings' => 'three_column_ads_second_url',
             'type'       => 'text',
        ));
// second overlay-color
            $wp_customize->add_setting(
                'three_column_img_scnd_color',
                array(
                    'default'     => 'rgba(0, 0, 0, 0)',
                    'type'        => 'theme_mod',
                    'capability'  => 'edit_theme_options',
                    'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
                    )       
            );
        $wp_customize->add_control(
        new Customize_themehunk_Color_Control(
            $wp_customize,
            'three_column_img_scnd_color',
            array(
                'label'         => __( 'Second Image Overlay Color', 'shopline' ),
                'section'       => 'three_column_ads_second_column',
                'settings'      => 'three_column_img_scnd_color',
                'show_opacity'  => true, // Optional.
                'palette'   => $palette
            )));

     // Third ads
    $wp_customize->add_section( 'three_column_ads_third_column', array(
         'title'          => __( 'Third Ad','shopline' ),
         'panel'          => 'three_column_ads_panel',
         'priority'       => 1,
    ) );
    
    $wp_customize->add_setting('three_column_ads_third_image', array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_upload'
        ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'three_column_ads_third_image', array(
            'label'    => __('Upload Image', 'shopline'),
            'section'  => 'three_column_ads_third_column',
            'settings' => 'three_column_ads_third_image',
        )));
    $wp_customize->add_setting('three_column_ads_third_url', array(
            'default'           => '#',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw'
        ));
    $wp_customize->add_control('three_column_ads_third_url', array(
            'label'    => __('Image Link', 'shopline'),
            'section'  => 'three_column_ads_third_column',
            'settings' => 'three_column_ads_third_url',
             'type'       => 'text',
        ));
// third overlay-color
            $wp_customize->add_setting(
                'three_column_img_thr_color',
                array(
                    'default'     => 'rgba(0, 0, 0, 0)',
                    'type'        => 'theme_mod',
                    'capability'  => 'edit_theme_options',
                    'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
                    )       
            );
        $wp_customize->add_control(
        new Customize_themehunk_Color_Control(
            $wp_customize,
            'three_column_img_thr_color',
            array(
                'label'         => __( 'Three Image Overlay Color', 'shopline' ),
                'section'       => 'three_column_ads_third_column',
                'settings'      => 'three_column_img_thr_color',
                'show_opacity'  => true, // Optional.
                'palette'   => $palette
            )));

    //colors
    $wp_customize->add_section( 'three_column_ads_color', array(
         'title'          => __( 'Color','shopline' ),
         'panel'  => 'three_column_ads_panel',
         'priority'       => 5,
    ) );

   $wp_customize->add_setting('three_column_ads_bg_color', array(
           'default'        => '#fff',
           'sanitize_callback' => 'sanitize_hex_color'
       ));
       $wp_customize->add_control( 
           new WP_Customize_Color_Control($wp_customize,'three_column_ads_bg_color', array(
           'label'      => __('Background Color', 'shopline' ),
           'section'    => 'three_column_ads_color',
           'settings'   => 'three_column_ads_bg_color',
       ) ) );
       
// three column ads end
 /****************************************************************/
/************              SHOP-PAGES SETTING         ************/
/****************************************************************/ 
 $wp_customize->add_panel( 'shop_panel', array(
        'priority'       => 14,
        'title'          => __('Shop Pages Setting (WooCommerce)', 'shopline'),
        ));
//pages-sidebar-settting
 $wp_customize->add_section('sidebar_set', array(
            'title'    => __('Sidebar Setting', 'shopline'),
            'priority' => 1,
            'panel'    =>'shop_panel'
            ));
// single-sidebar choose option
$wp_customize->add_setting('sngle_sidebar_set', array(
            'default'           =>'no-sidebar',
            'capability'        =>'edit_theme_options',
            'sanitize_callback' =>'sanitize_text_field'
        ));
$wp_customize->add_control('sngle_sidebar_set', array(
            'settings' => 'sngle_sidebar_set',
            'label'    => __('Product Single Page','shopline'),
            'section'  => 'sidebar_set',
            'type'     => 'radio',
            'choices'  => array(
                'left'       => 'Left',
                'right'      => 'Right',
                'no-sidebar' => 'No-Sidebar',
            ),
));  
// shop-sidebar choose option
$wp_customize->add_setting('shop_sidebar', array(
            'default'           =>'no-sidebar',
            'capability'        =>'edit_theme_options',
            'sanitize_callback' =>'sanitize_text_field'
        ));
$wp_customize->add_control('shop_sidebar', array(
            'settings' => 'shop_sidebar',
            'label'    => __('Shop / Category / Archieve Page','shopline'),
            'section'  => 'sidebar_set',
            'type'     => 'radio',
            'choices'  => array(
                'left'       => 'Left',
                'right'      => 'Right',
                'no-sidebar' => 'No-Sidebar',
            ),
));  
//= Choose woo-Grid Layout  =
    $wp_customize->add_section('woo_grid_set', array(
            'title'    => __('Page Layout', 'shopline'),
            'priority' => 2,
            'panel'    =>'shop_panel'
            ));
    $wp_customize->add_setting('woo_grid', array(
        'default'        => 'columns-4',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
    $wp_customize->add_control( 'woo_grid', array(
        'settings' => 'woo_grid',
        'label'   => __('Choose Product Layout','shopline'),
        'section' => 'woo_grid_set',
        'type'    => 'select',
        'choices'    => array(
            
            'columns-2'  => __('Two Grid','shopline'),
            'columns-3'  => __('Three Grid','shopline'),
            'columns-4'  => __('Four Grid','shopline'),
            'columns-5'  => __('Five Grid','shopline'),
            
        ),
    ));
// product show shop page
    $wp_customize->add_setting('shop_product_show', array(
        'default'        => 10,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ));
    $wp_customize->add_control('shop_product_show', array(
        'settings'  => 'shop_product_show',
        'label'     => __('Number of Product','shopline'),
        'section'   => 'woo_grid_set',
        'type'      => 'number',
    ) );
 // add-more-layout-pro       
   $wp_customize->add_setting('more_grd_lyt', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'more_grd_lyt',
            array(
        'section'  => 'woo_grid_set',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'Check out <a target="_blank" href="//themehunk.com/product/shopline-pro-multipurpose-shopping-theme/">ShoplinePro</a> for choose a multiple product layout','shopline' )
    )));   
// color
$wp_customize->add_section('color_set', array(
            'title'    => __('Color', 'shopline'),
            'priority' => 2,
            'panel'    =>'shop_panel'
            ));

// title
$wp_customize->add_setting('shop_title_color', array(
            'default'        => '#080808',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'shop_title_color', array(
            'label'      => __('Title Color', 'shopline' ),
            'section'    => 'color_set',
            'settings'   => 'shop_title_color',
        ) ) );
// rating
$wp_customize->add_setting('shop_rating_color', array(
            'default'        => '#f2c618',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'shop_rating_color', array(
            'label'      => __('Rating Color', 'shopline' ),
            'section'    => 'color_set',
            'settings'   => 'shop_rating_color',
        ) ) );
 // price 
 $wp_customize->add_setting('shop_price_color', array(
            'default'        => '#e7c09c',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'shop_price_color', array(
            'label'      => __('Price Color', 'shopline' ),
            'section'    => 'color_set',
            'settings'   => 'shop_price_color',
        ) ) );
// text
 $wp_customize->add_setting('shop_txt_color', array(
            'default'        => '#666666',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'shop_txt_color', array(
            'label'      => __('Text Color', 'shopline' ),
            'section'    => 'color_set',
            'settings'   => 'shop_txt_color',
        ) ) );  
// button
$wp_customize->add_setting('shop_btn_color', array(
            'default'        => '#e7c09c',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'shop_btn_color', array(
            'label'      => __('Button Color', 'shopline' ),
            'section'    => 'color_set',
            'settings'   => 'shop_btn_color',
        ) ) );  
 // wishlist 
$wp_customize->add_setting('shop_whslst_color', array(
            'default'        => '#bbb',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'shop_whslst_color', array(
            'label'      => __('wishlist Icon Color', 'shopline' ),
            'section'    => 'color_set',
            'settings'   => 'shop_whslst_color',
        ) ) );   
 // sale
 $wp_customize->add_setting('shop_sale_color', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'shop_sale_color', array(
            'label'      => __('Sale Text Color', 'shopline' ),
            'section'    => 'color_set',
            'settings'   => 'shop_sale_color',
        ) ) );  
$wp_customize->add_setting('shop_sale_bg_color', array(
            'default'        => '#232531',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'shop_sale_bg_color', array(
            'label'      => __('Sale Background Color', 'shopline' ),
            'section'    => 'color_set',
            'settings'   => 'shop_sale_bg_color',
        ) ) ); 
 // zoom-icon        
 $wp_customize->add_setting('shop_zoomicn_color', array(
            'default'        => '#080808',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'shop_zoomicn_color', array(
            'label'      => __('Zoom Icon Color', 'shopline' ),
            'section'    => 'color_set',
            'settings'   => 'shop_zoomicn_color',
        ) ) );    
  $wp_customize->add_setting('shop_zoomicn_bg_color', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'shop_zoomicn_bg_color', array(
            'label'      => __('Zoom Icon Background Color', 'shopline' ),
            'section'    => 'color_set',
            'settings'   => 'shop_zoomicn_bg_color',
        ) ) );             
/****************************************************************/
/************              FOOTER SECTION            ************/
/****************************************************************/ 
    $wp_customize->add_panel( 'footer_panel', array(
        'priority'       => 15,
        'title'          => __('Footer Setting', 'shopline'),
        ));
//footer-logo
$wp_customize->add_section('footer_logo', array(
            'title'    => __('Logo', 'shopline'),
            'priority' => 1,
            'panel'    =>'footer_panel'
            ));
        $wp_customize->add_setting('copyright_upload', array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_upload'
        ));
          $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'copyright_upload', array(
            'label'    => __('Footer Top Section Image Upload', 'shopline'),
            'section'  => 'footer_logo',
            'settings' => 'copyright_upload',
        )));

    //copyright
        $wp_customize->add_section('copyright_setting', array(
            'title'    => __('Copyright Text', 'shopline'),
            'priority' => 1,
            'panel'    =>'footer_panel'
            ));

        $wp_customize->add_setting('copyright_text', array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
            ));
       $wp_customize->add_control('copyright_text', array(
            'label'    => __('Copyright Text', 'shopline'),
            'section'  => 'copyright_setting',
            'settings' => 'copyright_text',
             'type'       => 'text',
            )); 
    //social icon        
       $wp_customize->add_section('social_option', array(
            'title'    => __('Social Icon', 'shopline'),
            'priority' => 3,
            'panel'    =>'footer_panel'
            ));
       $wp_customize->add_setting('social_link_facebook', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control('social_link_facebook', array(
        'label'    => __('Facebook URL', 'shopline'),
        'section'  => 'social_option',
        'settings' => 'social_link_facebook',
         'type'       => 'text',
        ));

        $wp_customize->add_setting('social_link_google', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control('social_link_google', array(
        'label'    => __('Google+ URL', 'shopline'),
        'section'  => 'social_option',
        'settings' => 'social_link_google',
         'type'       => 'text',
        ));
        $wp_customize->add_setting('social_link_linkedin', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control('social_link_linkedin', array(
        'label'    => __('Linkedin URL', 'shopline'),
        'section'  => 'social_option',
        'settings' => 'social_link_linkedin',
         'type'       => 'text',
        ));
        $wp_customize->add_setting('social_link_pintrest', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control('social_link_pintrest', array(
        'label'    => __(' Pinterest URL', 'shopline'),
        'section'  => 'social_option',
        'settings' => 'social_link_pintrest',
         'type'       => 'text',
        ));
        $wp_customize->add_setting('social_link_twitter', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage'
        ));
        $wp_customize->add_control('social_link_twitter', array(
        'label'    => __('Twitter URL', 'shopline'),
        'section'  => 'social_option',
        'settings' => 'social_link_twitter',
         'type'       => 'text',
        ));                
      //color
        $wp_customize->add_section('footer_color', array(
            'title'    => __('Setting', 'shopline'),
            'priority' => 5,
            'panel'    =>'footer_panel'
        ));

      $wp_customize->add_setting('footer_options', array(
        'default'        =>'color',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
        $wp_customize->add_control( 'footer_options', array(
            'settings' => 'footer_options',
            'label'   => __('Choose Background','shopline'),
            'section' => 'footer_color',
            'type'    => 'radio',
            'choices'    => array(
                'color'      => 'Color',
                'image'      => 'Image',
            ),
        ));

   $wp_customize->add_setting('footer_image_upload', array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'themehunk_customizer_sanitize_upload'
        ));
          $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'footer_image_upload', array(
            'label'    => __('Footer Background Image', 'shopline'),
            'section'  => 'footer_color',
            'settings' => 'footer_image_upload',
        )));
 
    // overlay-color
        $wp_customize->add_setting(
            'footer_imager_overly',
            array(
                'default'     => '#232531',
                'type'        => 'theme_mod',
                'capability'  => 'edit_theme_options',
                'sanitize_callback' => 'themehunk_customizer_sanitize_hex_rgba_color'
                )       
        );
        $wp_customize->add_control(
            new Customize_themehunk_Color_Control(
                $wp_customize,
                'footer_imager_overly',
                array(
                    'label'         => __( 'Background Color', 'shopline' ),
                    'description'=> __( '(Set background color for section or set color with transparency for section overlay)', 'shopline' ),
                    'section'       => 'footer_color',
                    'settings'      => 'footer_imager_overly',
                    'show_opacity'  => true, // Optional.
                    'palette'   => $palette
        )));

        $wp_customize->add_setting('footer_widget_menu_color', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'footer_widget_menu_color', array(
            'label'      => __('Footer Menu Color', 'shopline' ),
            'section'    => 'footer_color',
            'settings'   => 'footer_widget_menu_color',
        ) ) );

        $wp_customize->add_setting('footer_widget_title_color', array(
            'default'        => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'footer_widget_title_color', array(
            'label'      => __('Widget Title Color', 'shopline' ),
            'section'    => 'footer_color',
            'settings'   => 'footer_widget_title_color',
        ) ) );
        $wp_customize->add_setting('footer_widget_text_color', array(
            'default'        => '#bbb',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'footer_widget_text_color', array(
            'label'      => __('Widget Text Color', 'shopline' ),
            'section'    => 'footer_color',
            'settings'   => 'footer_widget_text_color',
        ) ) );

         $wp_customize->add_setting('footer_copyright_text_color', array(
            'default'        => '#bbb',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'footer_copyright_text_color', array(
            'label'      => __('Copyright Text Color', 'shopline' ),
            'section'    => 'footer_color',
            'settings'   => 'footer_copyright_text_color',
        ) ) );
        $wp_customize->add_setting('footer_hr_line_color', array(
            'default'        => '#1b1c26',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control($wp_customize,'footer_hr_line_color', array(
            'label'      => __('Top & Bottom Horizontal Line Color', 'shopline' ),
            'section'    => 'footer_color',
            'settings'   => 'footer_hr_line_color',
        ) ) );
       
//===============================
//= section newssssss-letter pro feature Settings =
//=============================
  $wp_customize->add_section('section_newsletter', array(
        'title'    => __('News Letter', 'shopline'),
        'priority' => 90,
        'panel'    =>'footer_panel',
        
    )); 
$wp_customize->add_setting('more_news_1', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'more_news_1',
            array(
        'section'  => 'section_newsletter',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'Check out <a target="_blank" href="//themehunk.com/product/shopline-pro-multipurpose-shopping-theme/">ShoplinePro</a>  for <strong>News Letter!</strong>','shopline' )
    )));

    /****************************************************************/
    /************           Theme Color                  ************/
    /****************************************************************/ 
    $wp_customize->add_setting('theme_color', array(
        'default'        => '#e7c09c',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize, 'theme_color', array(
        'label'      => __( 'Theme Color', 'shopline' ),
        'section'    => 'colors',
        'settings'   => 'theme_color',
        'priority'       => 1,
    ) ) ); 
     $wp_customize->add_section( 'header_image', array(
   'title'          => __( 'Header Image', 'shopline' ),
   'theme_supports' => 'custom-background',
   'priority'       => 60,
   'panel' =>'settings_theme_options',
   ) );  
    $wp_customize->get_section('colors')->title = esc_html__('Site Color', 'shopline');
    $wp_customize->get_section('colors')->priority = 59;
    $wp_customize->get_section('colors')->panel = 'settings_theme_options';
   // background
    $wp_customize->add_section( 'background_image', array(
   'title'          => __( 'Body Background Image', 'shopline' ),
   'theme_supports' => 'custom-background',
   'priority'       => 80,
   'panel' =>'settings_theme_options',
   ) );  
     
    $wp_customize->get_section('custom_css')->priority = 17;

/*************************************************************************/

                    //Gloabal-typograpgy//

/**************************************************************************/
$wp_customize->register_control_type( 'Themehunk_Customizer_Range_Value_Control' );
$wp_customize->add_panel( 'theme_tygrphy', array(
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Typography', 'shopline'),
    'description'    => '',
) );
$wp_customize->add_section(
        'shopline_fontsubset_typography', array(
            'title' => esc_html__( 'Font Subsets', 'shopline' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );
if ( class_exists( 'themehunk_Customize_Control_Checkbox_Multiple' ) ) {

        $wp_customize->add_setting(
            'shopline_font_subsets', array(
                'default' => array( 'latin' ),
                'sanitize_callback' => 'themehunk_checkbox_explode',
            )
        );

        $wp_customize->add_control(
            new themehunk_Customize_Control_Checkbox_Multiple(
                $wp_customize, 'shopline_font_subsets', array(
                    'section' => 'shopline_fontsubset_typography',
                    'label' => esc_html__( 'Font Subsets', 'shopline' ),
                    'choices' => array(
                        'latin' => 'latin',
                        'latin-ext' => 'latin-ext',
                        'cyrillic' => 'cyrillic',
                        'cyrillic-ext' => 'cyrillic-ext',
                        'greek' => 'greek',
                        'greek-ext' => 'greek-ext',
                        'vietnamese' => 'vietnamese',
                        'arabic' => 'arabic',
                    ),
                    'priority' => 10,
                )
            )
        );
    }
$wp_customize->add_section(
        'shopline_typography', array(
            'title' => esc_html__( 'Body', 'shopline' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );

    if ( class_exists( 'Themehunk_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'shopline_body_font', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Themehunk_Font_Selector(
                $wp_customize, 'shopline_body_font', array(
        'label' => esc_html__( 'Font family', 'shopline' ),
                    'section'           => 'shopline_typography',
                    'priority'          => 2,
                    'type'              => 'select',
                )
            )
        );
    }
    if ( class_exists( 'Themehunk_Customizer_Range_Value_Control' ) ) {

        $wp_customize->add_setting(
            'shopline_body_font_size', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 14,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_body_font_size', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 20,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_body_font_size_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 14,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_body_font_size_tb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 20,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_body_font_size_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 14,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
            $wp_customize, 'shopline_body_font_size_mb', array(
           'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 20,
                        'step' => 0.1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // line-height
      $wp_customize->add_setting(
            'shopline_body_line_height', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 22,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_body_line_height', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 50,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );

        // tab
        $wp_customize->add_setting(
            'shopline_body_line_height_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 22,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_body_line_height_tb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 50,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_body_line_height_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 22,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_body_line_height_mb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 50,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // letter-spacing
       $wp_customize->add_setting(
            'shopline_body_letter_spacing', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 0.4,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_body_letter_spacing', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_body_letter_spacing_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 0.4,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_body_letter_spacing_tb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_body_letter_spacing_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 0.4,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_body_letter_spacing_mb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 25,
                )
            )
        );
   } // body(end)

//***********************************************//
// heading-h1
//***********************************************//
$wp_customize->add_section(
        'shopline_h1_typography', array(
            'title' => esc_html__( 'Heading 1 (H1)', 'shopline' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );

    if ( class_exists( 'Themehunk_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'shopline_h1_font', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Themehunk_Font_Selector(
                $wp_customize, 'shopline_h1_font', array(
        'label'  => esc_html__( 'Font family', 'shopline' ),

                    'section'           => 'shopline_h1_typography',
                    'priority'          => 1,
                    'type'              => 'select',
                )
            )
        );
    }// End if().

    $wp_customize->add_setting('h1_typo_detail', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'h1_typo_detail',
            array(
        'section'  => 'shopline_h1_typography',
        'type'        => 'custom_message',
        'description' => wp_kses_post('(Applicable for all h1 heading like page title, product title in single page.)','shopline' ),
        'priority'          => 0,

    )));

    if ( class_exists( 'Themehunk_Customizer_Range_Value_Control' ) ){
        $wp_customize->add_setting(
            'shopline_h1_font_size', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 26,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h1_font_size', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h1_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h1_font_size_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 26,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h1_font_size_tb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h1_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h1_font_size_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 26,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h1_font_size_mb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h1_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // line-height
        $wp_customize->add_setting(
            'shopline_h1_line_height', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h1_line_height', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h1_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h1_line_height_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h1_line_height_tb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h1_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h1_line_height_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h1_line_height_mb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h1_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // letter-spacing
        $wp_customize->add_setting(
            'shopline_h1_letter_spacing', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h1_letter_spacing', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h1_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h1_letter_spacing_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h1_letter_spacing_tb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h1_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h1_letter_spacing_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h1_letter_spacing_mb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h1_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
    }
//***********************************************//
// heading-h2
//***********************************************//
$wp_customize->add_section(
        'shopline_h2_typography', array(
            'title' => esc_html__( 'Heading 2 (H2)', 'shopline' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );
   $wp_customize->add_setting('h2_typo_detail', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'h2_typo_detail',
            array(
        'section'  => 'shopline_h2_typography',
        'type'        => 'custom_message',
        'description' => wp_kses_post('(Applicable for all h2 heading like slider heading, section heading.)','shopline' ),
        'priority'          => 0,

    )));
    if ( class_exists( 'Themehunk_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'shopline_h2_font', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Themehunk_Font_Selector(
                $wp_customize, 'shopline_h2_font', array(
        'label'  => esc_html__( 'Font family', 'shopline' ),
                    'section'           => 'shopline_h2_typography',
                    'priority'          => 1,
                    'type'              => 'select',
                )
            )
        );
    }// End if().
    if ( class_exists( 'Themehunk_Customizer_Range_Value_Control' ) ){
        $wp_customize->add_setting(
            'shopline_h2_font_size', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 22,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h2_font_size', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h2_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h2_font_size_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 22,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h2_font_size_tb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h2_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h2_font_size_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 22,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h2_font_size_mb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h2_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // line-height
        $wp_customize->add_setting(
            'shopline_h2_line_height', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h2_line_height', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h2_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h2_line_height_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h2_line_height_tb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h2_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h2_line_height_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h2_line_height_mb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h2_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // letter-spacing
        $wp_customize->add_setting(
            'shopline_h2_letter_spacing', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h2_letter_spacing', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h2_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h2_letter_spacing_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h2_letter_spacing_tb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h2_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h2_letter_spacing_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h2_letter_spacing_mb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h2_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
    }
//***********************************************//
// heading-h3
//***********************************************//
$wp_customize->add_section(
        'shopline_h3_typography', array(
            'title' => esc_html__( 'Heading 3 (H3)', 'shopline' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );
$wp_customize->add_setting('h3_typo_detail', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'h3_typo_detail',
            array(
        'section'  => 'shopline_h3_typography',
        'type'        => 'custom_message',
        'description' => wp_kses_post('(Applicable for all h3 heading like product title, blog title.)','shopline' ),
        'priority'          => 0,

    )));
    if ( class_exists( 'Themehunk_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'shopline_h3_font', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Themehunk_Font_Selector(
                $wp_customize, 'shopline_h3_font', array(
        'label'  => esc_html__( 'Font family', 'shopline' ),
                    'section'           => 'shopline_h3_typography',
                    'priority'          => 1,
                    'type'              => 'select',
                )
            )
        );
    }// End if().
    if ( class_exists( 'Themehunk_Customizer_Range_Value_Control' ) ){
        $wp_customize->add_setting(
            'shopline_h3_font_size', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 20,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h3_font_size', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h3_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h3_font_size_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 20,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h3_font_size_tb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h3_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h3_font_size_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 20,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h3_font_size_mb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h3_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // line-height
        $wp_customize->add_setting(
            'shopline_h3_line_height', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h3_line_height', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h3_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h3_line_height_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h3_line_height_tb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h3_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h3_line_height_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h3_line_height_mb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h3_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // letter-spacing
        $wp_customize->add_setting(
            'shopline_h3_letter_spacing', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h3_letter_spacing', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h3_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h3_letter_spacing_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h3_letter_spacing_tb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h3_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h3_letter_spacing_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h3_letter_spacing_mb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h3_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
    }
//***********************************************//
// heading-h4
//***********************************************//
$wp_customize->add_section(
        'shopline_h4_typography', array(
            'title' => esc_html__( 'Heading 4 (H4)', 'shopline' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );
$wp_customize->add_setting('h4_typo_detail', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'h4_typo_detail',
            array(
        'section'  => 'shopline_h4_typography',
        'type'        => 'custom_message',
        'description' => wp_kses_post('(Applicable for all h4 heading like footer widget title, sidebar widget title.)','shopline' ),
        'priority'          => 0,

    )));
    if ( class_exists( 'Themehunk_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'shopline_h4_font', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Themehunk_Font_Selector(
                $wp_customize, 'shopline_h4_font', array(
        'label'  => esc_html__( 'Font family', 'shopline' ),
                    'section'           => 'shopline_h4_typography',
                    'priority'          => 1,
                    'type'              => 'select',
                )
            )
        );
    }// End if().
    if ( class_exists( 'Themehunk_Customizer_Range_Value_Control' ) ){
        $wp_customize->add_setting(
            'shopline_h4_font_size', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 18,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h4_font_size', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h4_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h4_font_size_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 18,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h4_font_size_tb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h4_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h4_font_size_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 18,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h4_font_size_mb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h4_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // line-height
        $wp_customize->add_setting(
            'shopline_h4_line_height', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h4_line_height', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h4_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h4_line_height_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h4_line_height_tb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h4_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h4_line_height_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h4_line_height_mb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h4_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // letter-spacing
        $wp_customize->add_setting(
            'shopline_h4_letter_spacing', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h4_letter_spacing', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h4_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h4_letter_spacing_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h4_letter_spacing_tb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h4_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h4_letter_spacing_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h4_letter_spacing_mb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h4_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
    }
//***********************************************//
// heading-h5
//***********************************************//
$wp_customize->add_section(
        'shopline_h5_typography', array(
            'title' => esc_html__( 'Heading 5 (H5)', 'shopline' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );
$wp_customize->add_setting('h5_typo_detail', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'h5_typo_detail',
            array(
        'section'  => 'shopline_h5_typography',
        'type'        => 'custom_message',
        'description' => wp_kses_post('(Applicable for all h5 heading.)','shopline' ),
        'priority'          => 0,

    )));
    if ( class_exists( 'Themehunk_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'shopline_h5_font', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Themehunk_Font_Selector(
                $wp_customize, 'shopline_h5_font', array(
        'label'  => esc_html__( 'Font family', 'shopline' ),
                    'section'           => 'shopline_h5_typography',
                    'priority'          => 1,
                    'type'              => 'select',
                )
            )
        );
    }// End if().
    if ( class_exists( 'Themehunk_Customizer_Range_Value_Control' ) ){
        $wp_customize->add_setting(
            'shopline_h5_font_size', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 16,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h5_font_size', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h5_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h5_font_size_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 16,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h5_font_size_tb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h5_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h5_font_size_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 16,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h5_font_size_mb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h5_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // line-height
        $wp_customize->add_setting(
            'shopline_h5_line_height', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h5_line_height', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h5_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h5_line_height_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h5_line_height_tb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h5_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h5_line_height_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h5_line_height_mb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h5_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // letter-spacing
        $wp_customize->add_setting(
            'shopline_h5_letter_spacing', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h5_letter_spacing', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h5_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h5_letter_spacing_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h5_letter_spacing_tb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h5_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h5_letter_spacing_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h5_letter_spacing_mb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h5_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
    }
//***********************************************//
// heading-h6
//***********************************************//
$wp_customize->add_section(
        'shopline_h6_typography', array(
            'title' => esc_html__( 'Heading 6 (H6)', 'shopline' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );
$wp_customize->add_setting('h6_typo_detail', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'h6_typo_detail',
            array(
        'section'  => 'shopline_h6_typography',
        'type'        => 'custom_message',
        'description' => wp_kses_post('(Applicable for all h6 heading.)','shopline' ),
        'priority'          => 0,

    )));
    if ( class_exists( 'Themehunk_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'shopline_h6_font', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Themehunk_Font_Selector(
                $wp_customize, 'shopline_h6_font', array(
        'label'  => esc_html__( 'Font family', 'shopline' ),
                    'section'           => 'shopline_h6_typography',
                    'priority'          => 1,
                    'type'              => 'select',
                )
            )
        );
    }// End if().
    if ( class_exists( 'Themehunk_Customizer_Range_Value_Control' ) ){
        $wp_customize->add_setting(
            'shopline_h6_font_size', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 14,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h6_font_size', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h6_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h6_font_size_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 14,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h6_font_size_tb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h6_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h6_font_size_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 14,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h6_font_size_mb', array(
                    'label' => esc_html__( 'Font size', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h6_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 2,
                )
            )
        );
        // line-height
        $wp_customize->add_setting(
            'shopline_h6_line_height', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h6_line_height', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h6_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h6_line_height_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h6_line_height_tb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h6_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h6_line_height_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 35,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h6_line_height_mb', array(
                    'label' => esc_html__( 'Line height', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h6_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'priority' => 3,
                )
            )
        );
        // letter-spacing
        $wp_customize->add_setting(
            'shopline_h6_letter_spacing', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h6_letter_spacing', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h6_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // tab
        $wp_customize->add_setting(
            'shopline_h6_letter_spacing_tb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h6_letter_spacing_tb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h6_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
        // mob
        $wp_customize->add_setting(
            'shopline_h6_letter_spacing_mb', array(
                'sanitize_callback' => 'themehunk_sanitize_range_value',
                'default' => 1,
                
            )
        );

        $wp_customize->add_control(
            new Themehunk_Customizer_Range_Value_Control(
                $wp_customize, 'shopline_h6_letter_spacing_mb', array(
                    'label' => esc_html__( 'Letter-spacing ', 'shopline' ) . ' ( ' . esc_html__( 'px','shopline' ) . ' )',
                    'section' => 'shopline_h6_typography',
                    'type' => 'range-value',
                    'input_attr' => array(
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ),
                    'priority' => 4,
                )
            )
        );
    }
//***********************************************//
// a-anchor
//***********************************************//
$wp_customize->add_section(
        'shopline_a_typography', array(
            'title' => esc_html__( 'Anchor (a)', 'shopline' ),
            'priority' => 25,
            'panel' => 'theme_tygrphy',
        )
    );
$wp_customize->add_setting('a_typo_detail', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'a_typo_detail',
            array(
        'section'  => 'shopline_a_typography',
        'type'        => 'custom_message',
        'description' => wp_kses_post('(Applicable for all Anchor link.)','shopline' ),
        'priority'          => 0,

    )));
    if ( class_exists( 'Themehunk_Font_Selector' ) ) {
        $wp_customize->add_setting(
            'shopline_a_font', array(
                'type'              => 'theme_mod',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            new Themehunk_Font_Selector(
                $wp_customize, 'shopline_a_font', array(
        'label'  => esc_html__( 'Font family', 'shopline' ),
                    'section'           => 'shopline_a_typography',
                    'priority'          => 1,
                    'type'              => 'select',
                )
            )
        );
    }// End if().    
// typo-end
//===============================
//= pro-typography =
//=============================
  $wp_customize->add_section('pro_typo', array(
        'title'    => __('Section Typography', 'shopline'),
        'priority' => 10,
        'panel'     => 'theme_tygrphy',
        
    )); 
$wp_customize->add_setting('pro_typo_adv', array(
        'sanitize_callback' => 'themehunk_sanitize_text',
    ));
   $wp_customize->add_control( new themehunk_Misc_Control( $wp_customize, 'pro_typo_adv',
            array(
        'section'  => 'pro_typo',
        'type'        => 'custom_message',
        'description' => wp_kses_post( 'Check out <a target="_blank" href="//themehunk.com/product/shopline-pro-multipurpose-shopping-theme/">ShoplinePro</a>  for full control over <strong>Section Typography!</strong>','shopline' )
    ))); 
}
add_action('customize_register','shopline_lite_customize_register');
/**
 * Check if a string is in json format
 *
 * @param  string $string Input.
 *
 * @since 1.1.38
 * @return bool
 */
function themehunk_is_json( $string ) {
    return is_string( $string ) && is_array( json_decode( $string, true ) ) ? true : false;
}
?>