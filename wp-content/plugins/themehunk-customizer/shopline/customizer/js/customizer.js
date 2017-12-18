jQuery(document).ready(function() {

// woo cate option
    wp.customize( 'woo_cate_image_bg', function( value ) {
        var filter_type = value.bind( function( to ) {
        if(to=='color'){
            jQuery( '#customize-control-woo_cate_slider_bg_image' ).css('display','none' );
             
            } else if(to=='image'){
            jQuery( '#customize-control-woo_cate_slider_bg_image' ).css('display','block' );
               
            }
        } );
        if(filter_type()=='color'){
                jQuery( '#customize-control-woo_cate_slider_bg_image' ).css('display','none' );
                
            } else if(filter_type()=='image'){
                jQuery( '#customize-control-woo_cate_slider_bg_image' ).css('display','block' );
               

            }   

    } );
  // shop-page-grid-layout-disable  
 jQuery('#customize-control-woo_grid option').attr('disabled','disabled').eq(2).removeAttr('disabled');

// ribbon option
     wp.customize( 'ribbon_bg_options', function( value ) {
        var filter_type = value.bind( function( to ) {
            if(to=='color'){
             jQuery( '#customize-control-ribbon_bg_image' ).css('display','none' );
             jQuery( '#customize-control-ribbon_bg_video' ).css('display','none' );
             jQuery( '#customize-control-video_muted' ).css('display','none' );
             jQuery( '#customize-control-ribbn_parallax' ).css('display','none' );
             jQuery( '#customize-control-ribbon_video_bg_image' ).css('display','none' );
            } else if(to=='image'){
                jQuery( '#customize-control-ribbon_bg_image' ).css('display','block' );
                jQuery( '#customize-control-ribbon_bg_video' ).css('display','none' );
                jQuery( '#customize-control-video_muted' ).css('display','none' );
                jQuery( '#customize-control-ribbn_parallax' ).css('display','block' );
                jQuery( '#customize-control-ribbon_video_bg_image' ).css('display','none' );
            } else if(to=='video'){
                jQuery( '#customize-control-ribbon_bg_image' ).css('display','none' );
                jQuery( '#customize-control-ribbon_bg_video' ).css('display','block' );
                jQuery( '#customize-control-video_muted' ).css('display','block' );
                jQuery( '#customize-control-ribbn_parallax' ).css('display','none' );
                jQuery( '#customize-control-ribbon_video_bg_image' ).css('display','block' );
            }
        } );

           if(filter_type()=='color'){
             jQuery( '#customize-control-ribbon_bg_image' ).css('display','none' );
             jQuery( '#customize-control-ribbon_bg_video' ).css('display','none' );
             jQuery( '#customize-control-video_muted' ).css('display','none' );
             jQuery( '#customize-control-ribbn_parallax' ).css('display','none' );
             jQuery( '#customize-control-ribbon_video_bg_image' ).css('display','none' );
            } else if(filter_type()=='image'){
                jQuery( '#customize-control-ribbon_bg_image' ).css('display','block' );
                jQuery( '#customize-control-ribbon_bg_video' ).css('display','none' );
                jQuery( '#customize-control-video_muted' ).css('display','none' );
                jQuery( '#customize-control-ribbn_parallax' ).css('display','block' );
                jQuery( '#customize-control-ribbon_video_bg_image' ).css('display','none' );
            } else if(filter_type()=='video'){
                jQuery( '#customize-control-ribbon_bg_image' ).css('display','none' );
                jQuery( '#customize-control-ribbon_bg_video' ).css('display','block' );
                jQuery( '#customize-control-video_muted' ).css('display','block' );
                jQuery( '#customize-control-ribbn_parallax' ).css('display','none' );
                jQuery( '#customize-control-ribbon_video_bg_image' ).css('display','block' );
            } 
    } );
// woo product option
    wp.customize( 'woo_cate_product_options', function( value ) {
        var filter_type = value.bind( function( to ) {
            if(to=='color'){
             jQuery( '#customize-control-woo_cate_product_bg_image' ).css('display','none' );
             jQuery( '#customize-control-prdct_parallax' ).css('display','none' );
            } else if(to=='image'){
                jQuery( '#customize-control-woo_cate_product_bg_image' ).css('display','block' );
                jQuery( '#customize-control-prdct_parallax' ).css('display','block' );
            }
        } );
            if(filter_type()=='color'){
                jQuery( '#customize-control-woo_cate_product_bg_image' ).css('display','none' );
                jQuery( '#customize-control-prdct_parallax' ).css('display','none' );
            } else if(filter_type()=='image'){
                jQuery( '#customize-control-woo_cate_product_bg_image' ).css('display','block' );
                jQuery( '#customize-control-prdct_parallax' ).css('display','block' );

            }   
    } );

    // Testimonial option
    wp.customize( 'testimonial_options', function( value ) {
        var filter_type = value.bind( function( to ) {
            if(to=='color'){
            jQuery( '#customize-control-testimonial_bg_image' ).css('display','none' );
            jQuery( '#customize-control-testimonial_parallax' ).css('display','none' );
            } else if(to=='image'){
            jQuery( '#customize-control-testimonial_bg_image' ).css('display','block' );
            jQuery( '#customize-control-testimonial_parallax' ).css('display','block' );
            }
        } );
            if(filter_type()=='color'){
                jQuery( '#customize-control-testimonial_bg_image' ).css('display','none' );
                jQuery( '#customize-control-testimonial_parallax' ).css('display','none' );
            } else if(filter_type()=='image'){
                jQuery( '#customize-control-testimonial_bg_image' ).css('display','block' );
                jQuery( '#customize-control-testimonial_parallax' ).css('display','block' );

            }   
    } );
   // two-coloum-first
    wp.customize( 'two_coloum_bg_options', function( value ) {
        var filter_type = value.bind( function( to ) {
            if(to=='img'){
             jQuery( '#customize-control-two_column_img_first_image' ).css('display','block' );
             jQuery( '#customize-control-two_column_img_first_video' ).css('display','none' );
             jQuery( '#customize-control-two_column_img_first_text' ).css('display','block' );

            } else if(to=='ifrm'){
                jQuery( '#customize-control-two_column_img_first_image' ).css('display','none' );
                jQuery( '#customize-control-two_column_img_first_video' ).css('display','block' );
                jQuery( '#customize-control-two_column_img_first_text' ).css('display','none' );
            }
        } );
            if(filter_type()=='img'){
                jQuery( '#customize-control-two_column_img_first_image' ).css('display','block' );
                jQuery( '#customize-control-two_column_img_first_video' ).css('display','none' );
                jQuery( '#customize-control-two_column_img_first_text' ).css('display','block' );
            } else if(filter_type()=='ifrm'){
                jQuery( '#customize-control-two_column_img_first_image' ).css('display','none' );
                jQuery( '#customize-control-two_column_img_first_video' ).css('display','block' );
                jQuery( '#customize-control-two_column_img_first_text' ).css('display','none' );

            }   
    } );
    // two-coloum-second
    wp.customize( 'two_coloum_scnd_bg_options', function( value ) {
        var filter_type = value.bind( function( to ) {
            if(to=='img'){
            jQuery( '#customize-control-two_column_ads_second_image' ).css('display','block' );
            jQuery( '#customize-control-two_column_img_second_video' ).css('display','none' );
            jQuery( '#customize-control-two_column_img_second_text' ).css('display','block' );
            } else if(to=='ifrm'){
            jQuery( '#customize-control-two_column_ads_second_image' ).css('display','none' );
            jQuery( '#customize-control-two_column_img_second_video' ).css('display','block' );
            jQuery( '#customize-control-two_column_img_second_text' ).css('display','none' );
            }
        } );
            if(filter_type()=='img'){
            jQuery( '#customize-control-two_column_ads_second_image' ).css('display','block' );
            jQuery( '#customize-control-two_column_img_second_video' ).css('display','none' );
            jQuery( '#customize-control-two_column_img_second_text' ).css('display','block' );
            } else if(filter_type()=='ifrm'){
                jQuery( '#customize-control-two_column_ads_second_image' ).css('display','none' );
                jQuery( '#customize-control-two_column_img_second_video' ).css('display','block');
                jQuery( '#customize-control-two_column_img_second_text' ).css('display','none' );

            }   
    } );
    // aboutus option
    wp.customize( 'aboutus_options', function( value ) {
        var filter_type = value.bind( function( to ) {
            if(to=='color'){
             jQuery( '#customize-control-aboutus_bg_image' ).css('display','none' );
             jQuery( '#customize-control-aboutus_parallax' ).css('display','none' );
            } else if(to=='image'){
                jQuery( '#customize-control-aboutus_bg_image' ).css('display','block' );
                jQuery( '#customize-control-aboutus_parallax' ).css('display','block' );
            }
        } );
            if(filter_type()=='color'){
                jQuery( '#customize-control-aboutus_bg_image' ).css('display','none' );
                jQuery( '#customize-control-aboutus_parallax' ).css('display','none' );
            } else if(filter_type()=='image'){
                jQuery( '#customize-control-aboutus_bg_image' ).css('display','block' );
                jQuery( '#customize-control-aboutus_parallax' ).css('display','block' );

            }   
    } );

    // Blog option
    wp.customize( 'blog_options', function( value ) {
        var filter_type = value.bind( function( to ) {
            if(to=='color'){
             jQuery( '#customize-control-blog_bg_image' ).css('display','none' );
             jQuery( '#customize-control-blog_parallax' ).css('display','none' );
            } else if(to=='image'){
                jQuery( '#customize-control-blog_bg_image' ).css('display','block' );
                jQuery( '#customize-control-blog_parallax' ).css('display','block' );
            }
        } );
            if(filter_type()=='color'){
                jQuery( '#customize-control-blog_bg_image' ).css('display','none' );
                jQuery( '#customize-control-blog_parallax' ).css('display','none' );
            } else if(filter_type()=='image'){
                jQuery( '#customize-control-blog_bg_image' ).css('display','block' );
                       jQuery( '#customize-control-blog_parallax' ).css('display','block' );
                       jQuery( '#customize-control-blog_parallax' ).css('display','block' );

            }   
    } );

//brand option
    wp.customize( 'brand_options', function( value ) {
        var filter_type = value.bind( function( to ) {
            if(to=='color'){
             jQuery( '#customize-control-brand_bg_image' ).css('display','none' );
              jQuery( '#customize-control-brand_parallax' ).css('display','none' );
             
             } else if(to=='image'){
                jQuery( '#customize-control-brand_bg_image' ).css('display','block' );
                 jQuery( '#customize-control-brand_parallax' ).css('display','block' );
            }
        } );
            if(filter_type()=='color'){
                jQuery( '#customize-control-brand_bg_image' ).css('display','none' );
                jQuery( '#customize-control-brand_parallax' ).css('display','none' );
                
            } else if(filter_type()=='image'){
                jQuery( '#customize-control-brand_bg_image' ).css('display','block' );
                jQuery( '#customize-control-brand_parallax' ).css('display','block' );
               

            }   
    } );

    // footer option
    wp.customize( 'footer_options', function( value ) {
        var filter_type = value.bind( function( to ) {
            if(to=='color'){
             jQuery( '#customize-control-footer_image_upload' ).css('display','none' );
              jQuery( '#customize-control-footer_parallax' ).css('display','none' );
             
             } else if(to=='image'){
                jQuery( '#customize-control-footer_image_upload' ).css('display','block' );
                 jQuery( '#customize-control-footer_parallax' ).css('display','block' );
            }
        } );
            if(filter_type()=='color'){
                jQuery( '#customize-control-footer_image_upload' ).css('display','none' );
                jQuery( '#customize-control-footer_parallax' ).css('display','none' );
                
            } else if(filter_type()=='image'){
                jQuery( '#customize-control-footer_image_upload' ).css('display','block' );
                jQuery( '#customize-control-footer_parallax' ).css('display','block' );
               

            }   
    } );

    
        // woo widget
    wp.customize( 'woo_widget_options', function( value ) {
        var filter_type = value.bind( function( to ) {
            if(to=='color'){
             jQuery( '#customize-control-woo_widget_bg_image' ).css('display','none' );
             jQuery( '#customize-control-woo_widget_parallax' ).css('display','none' );
            } else if(to=='image'){
                jQuery( '#customize-control-woo_widget_bg_image' ).css('display','block' );
             jQuery( '#customize-control-woo_widget_parallax' ).css('display','block' );
            }
        } );
            if(filter_type()=='color'){
                jQuery( '#customize-control-woo_widget_bg_image' ).css('display','none' );
            jQuery( '#customize-control-woo_widget_parallax' ).css('display','none' );
            } else if(filter_type()=='image'){
jQuery( '#customize-control-woo_widget_bg_image' ).css('display','block' );
 jQuery( '#customize-control-woo_widget_parallax' ).css('display','block' );
             }   
    } );

// top-sider-option-autoplay
wp.customize( 'da_play', function( value ) {
        var filter_type = value.bind( function( to ) {
        if(to=='off'){
             jQuery( '#customize-control-da_slider_speed' ).css('display','none' );
            } else if(to=='on'){
                jQuery( '#customize-control-da_slider_speed' ).css('display','block' );
            }
        } );
        if(filter_type()=='off'){
                jQuery( '#customize-control-da_slider_speed' ).css('display','none' );
            } else if(filter_type()=='on'){
                jQuery( '#customize-control-da_slider_speed' ).css('display','block' );

            }   

    } );
// woo_cat-sider-option-autoplay
wp.customize( 'cat_play', function( value ) {
        var filter_type = value.bind( function( to ) {
        if(to=='off'){
             jQuery( '#customize-control-woo_cate_slider_speed' ).css('display','none' );
            } else if(to=='on'){
                jQuery( '#customize-control-woo_cate_slider_speed' ).css('display','block' );
            }
        } );
        if(filter_type()=='off'){
                jQuery( '#customize-control-woo_cate_slider_speed' ).css('display','none' );
            } else if(filter_type()=='on'){
                jQuery( '#customize-control-woo_cate_slider_speed' ).css('display','block' );

            }   

    } );
// testimonial-sider-option-autoplay  
  wp.customize( 'testm_play', function( value ) {
        var filter_type = value.bind( function( to ) {
        if(to=='off'){
             jQuery( '#customize-control-testm_slider_speed' ).css('display','none' );
            } else if(to=='on'){
                jQuery( '#customize-control-testm_slider_speed' ).css('display','block' );
            }
        } );
        if(filter_type()=='off'){
                jQuery( '#customize-control-testm_slider_speed' ).css('display','none' );
            } else if(filter_type()=='on'){
                jQuery( '#customize-control-testm_slider_speed' ).css('display','block' );

            }   

    } );
// blog-sider-option-autoplay 
wp.customize( 'blog_play', function( value ) {
        var filter_type = value.bind( function( to ) {
        if(to=='off'){
             jQuery( '#customize-control-blog_slider_speed' ).css('display','none' );
            } else if(to=='on'){
                jQuery( '#customize-control-blog_slider_speed' ).css('display','block' );
            }
        } );
        if(filter_type()=='off'){
                jQuery( '#customize-control-blog_slider_speed' ).css('display','none' );
            } else if(filter_type()=='on'){
                jQuery( '#customize-control-blog_slider_speed' ).css('display','block' );

            }   

    } );
// brand-sider-option-autoplay 
wp.customize( 'brand_play', function( value ) {
        var filter_type = value.bind( function( to ) {
        if(to=='off'){
             jQuery( '#customize-control-brand_slider_speed' ).css('display','none' );
            } else if(to=='on'){
                jQuery( '#customize-control-brand_slider_speed' ).css('display','block' );
            }
        } );
        if(filter_type()=='off'){
                jQuery( '#customize-control-brand_slider_speed' ).css('display','none' );
            } else if(filter_type()=='on'){
                jQuery( '#customize-control-brand_slider_speed' ).css('display','block' );

            }   

    } );
 /* Move our focus widgets in the our focus panel */

	/*Documentation link and Upgrade to PRO link */
    /* === Checkbox Multiple Control === */
    jQuery( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on(
        'change',
        function() {
   // alert('');
            checkbox_values = jQuery( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                function() {
                    return this.value;
                }
            ).get().join( ',' );

            jQuery( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        }
    );

        // section sorting
    jQuery( "#sortable" ).sortable({ 
            placeholder: "ui-sortable-placeholder" 
    });

    jQuery( "#sortable" ).sortable({
        cursor: 'move',
        opacity: 0.65,
        stop: function ( event, ui){
        var data = jQuery(this).sortable('toArray');
            //  console.log(data); // This should print array of IDs, but returns empty string/array      
            jQuery( this ).parents( '.customize-control').find( 'input[type="hidden"]' ).val( data ).trigger( 'change' );
        }
    });
    // testimonial widget
    wp.customize.section( 'sidebar-widgets-testimonial-widget' ).panel('testimonial_panel');
    wp.customize.section( 'sidebar-widgets-testimonial-widget' ).priority('5');

    
     // typography
jQuery( 'body' ).bind( 'click', '.devices button', function ( e ) {
if(jQuery('.devices-wrapper .preview-desktop').hasClass('active')){
// body
jQuery('#customize-control-shopline_body_font_size' ).css('display','block' );
jQuery('#customize-control-shopline_body_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_body_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_body_line_height' ).css('display','block' );
jQuery('#customize-control-shopline_body_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_body_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_body_letter_spacing' ).css('display','block' );
jQuery('#customize-control-shopline_body_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_body_letter_spacing_mb' ).css('display','none' );
// H1
jQuery('#customize-control-shopline_h1_font_size' ).css('display','block' );
jQuery('#customize-control-shopline_h1_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h1_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h1_line_height' ).css('display','block' );
jQuery('#customize-control-shopline_h1_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h1_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h1_letter_spacing' ).css('display','block' );
jQuery('#customize-control-shopline_h1_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h1_letter_spacing_mb' ).css('display','none' );
// H2
jQuery('#customize-control-shopline_h2_font_size' ).css('display','block' );
jQuery('#customize-control-shopline_h2_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h2_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h2_line_height' ).css('display','block' );
jQuery('#customize-control-shopline_h2_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h2_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h2_letter_spacing' ).css('display','block' );
jQuery('#customize-control-shopline_h2_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h2_letter_spacing_mb' ).css('display','none' );
// H3
jQuery('#customize-control-shopline_h3_font_size' ).css('display','block' );
jQuery('#customize-control-shopline_h3_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h3_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h3_line_height' ).css('display','block' );
jQuery('#customize-control-shopline_h3_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h3_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h3_letter_spacing' ).css('display','block' );
jQuery('#customize-control-shopline_h3_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h3_letter_spacing_mb' ).css('display','none' );
// H4
jQuery('#customize-control-shopline_h4_font_size' ).css('display','block' );
jQuery('#customize-control-shopline_h4_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h4_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h4_line_height' ).css('display','block' );
jQuery('#customize-control-shopline_h4_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h4_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h4_letter_spacing' ).css('display','block' );
jQuery('#customize-control-shopline_h4_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h4_letter_spacing_mb' ).css('display','none' );
// H5
jQuery('#customize-control-shopline_h5_font_size' ).css('display','block' );
jQuery('#customize-control-shopline_h5_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h5_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h5_line_height' ).css('display','block' );
jQuery('#customize-control-shopline_h5_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h5_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h5_letter_spacing' ).css('display','block' );
jQuery('#customize-control-shopline_h5_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h5_letter_spacing_mb' ).css('display','none' );
// H6
jQuery('#customize-control-shopline_h6_font_size' ).css('display','block' );
jQuery('#customize-control-shopline_h6_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h6_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h6_line_height' ).css('display','block' );
jQuery('#customize-control-shopline_h6_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h6_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h6_letter_spacing' ).css('display','block' );
jQuery('#customize-control-shopline_h6_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h6_letter_spacing_mb' ).css('display','none' );

}
if(jQuery('.devices-wrapper .preview-tablet').hasClass('active')){
// body
jQuery('#customize-control-shopline_body_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_body_font_size_tb' ).css('display','block' );
jQuery('#customize-control-shopline_body_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_body_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_body_line_height_tb' ).css('display','block' );
jQuery('#customize-control-shopline_body_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_body_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_body_letter_spacing_tb' ).css('display','block' );
jQuery('#customize-control-shopline_body_letter_spacing_mb' ).css('display','none' );
// H1
jQuery('#customize-control-shopline_h1_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h1_font_size_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h1_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h1_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h1_line_height_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h1_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h1_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h1_letter_spacing_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h1_letter_spacing_mb' ).css('display','none' );
// H2
jQuery('#customize-control-shopline_h2_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h2_font_size_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h2_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h2_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h2_line_height_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h2_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h2_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h2_letter_spacing_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h2_letter_spacing_mb' ).css('display','none' );
// H3
jQuery('#customize-control-shopline_h3_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h3_font_size_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h3_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h3_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h3_line_height_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h3_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h3_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h3_letter_spacing_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h3_letter_spacing_mb' ).css('display','none' );
// H4
jQuery('#customize-control-shopline_h4_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h4_font_size_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h4_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h4_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h4_line_height_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h4_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h4_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h4_letter_spacing_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h4_letter_spacing_mb' ).css('display','none' );
// H5
jQuery('#customize-control-shopline_h5_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h5_font_size_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h5_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h5_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h5_line_height_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h5_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h5_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h5_letter_spacing_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h5_letter_spacing_mb' ).css('display','none' );
// H6
jQuery('#customize-control-shopline_h6_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h6_font_size_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h6_font_size_mb' ).css('display','none' );        
jQuery('#customize-control-shopline_h6_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h6_line_height_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h6_line_height_mb' ).css('display','none' );
jQuery('#customize-control-shopline_h6_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h6_letter_spacing_tb' ).css('display','block' );
jQuery('#customize-control-shopline_h6_letter_spacing_mb' ).css('display','none' );

}
if(jQuery('.devices-wrapper .preview-mobile').hasClass('active')){
// body    
jQuery('#customize-control-shopline_body_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_body_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_body_font_size_mb' ).css('display','block' );        
jQuery('#customize-control-shopline_body_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_body_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_body_line_height_mb' ).css('display','block' );
jQuery('#customize-control-shopline_body_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_body_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_body_letter_spacing_mb' ).css('display','block' );     
//h1   
jQuery('#customize-control-shopline_h1_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h1_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h1_font_size_mb' ).css('display','block' );        
jQuery('#customize-control-shopline_h1_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h1_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h1_line_height_mb' ).css('display','block' );
jQuery('#customize-control-shopline_h1_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h1_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h1_letter_spacing_mb' ).css('display','block' ); 
//h2   
jQuery('#customize-control-shopline_h2_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h2_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h2_font_size_mb' ).css('display','block' );        
jQuery('#customize-control-shopline_h2_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h2_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h2_line_height_mb' ).css('display','block' );
jQuery('#customize-control-shopline_h2_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h2_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h2_letter_spacing_mb' ).css('display','block' ); 
//h3   
jQuery('#customize-control-shopline_h3_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h3_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h3_font_size_mb' ).css('display','block' );        
jQuery('#customize-control-shopline_h3_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h3_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h3_line_height_mb' ).css('display','block' );
jQuery('#customize-control-shopline_h3_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h3_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h3_letter_spacing_mb' ).css('display','block' ); 
//h4   
jQuery('#customize-control-shopline_h4_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h4_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h4_font_size_mb' ).css('display','block' );        
jQuery('#customize-control-shopline_h4_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h4_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h4_line_height_mb' ).css('display','block' );
jQuery('#customize-control-shopline_h4_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h4_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h4_letter_spacing_mb' ).css('display','block' ); 
//h5  
jQuery('#customize-control-shopline_h5_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h5_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h5_font_size_mb' ).css('display','block' );        
jQuery('#customize-control-shopline_h5_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h5_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h5_line_height_mb' ).css('display','block' );
jQuery('#customize-control-shopline_h5_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h5_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h5_letter_spacing_mb' ).css('display','block' ); 
//h6  
jQuery('#customize-control-shopline_h6_font_size' ).css('display','none' );
jQuery('#customize-control-shopline_h6_font_size_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h6_font_size_mb' ).css('display','block' );        
jQuery('#customize-control-shopline_h6_line_height' ).css('display','none' );
jQuery('#customize-control-shopline_h6_line_height_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h6_line_height_mb' ).css('display','block' );
jQuery('#customize-control-shopline_h6_letter_spacing' ).css('display','none' );
jQuery('#customize-control-shopline_h6_letter_spacing_tb' ).css('display','none' );
jQuery('#customize-control-shopline_h6_letter_spacing_mb' ).css('display','block' ); 

}
});

});