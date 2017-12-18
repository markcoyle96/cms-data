<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section
 *
 * @package WP iClean Responsive
 * @since 1.0.0
 */

 ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="flypanels-container preload">
	 <div class="offcanvas flypanels-left">
  <div class="panelcontent" data-panel="treemenu">
    <nav class="flypanels-treemenu" role="navigation">

      <?php wp_nav_menu( array(
      'theme_location'  => 'primary',
      'container'     => false,
      'depth'       => 0,
      'items_wrap'    => '<ul class="right">%3$s</ul>',
            'fallback_cb'     => '', // workaround to show a message to set up a menu
            'walker' => new Wp_Iclean_Responsive_Nv_Wkr_Flymenu( array(
              'in_top_bar' => true,
              'item_type' => 'li',
              'menu_type' => 'main-menu'
              )),
            ));
        ?>
    </nav>
  </div>
</div>

<div class="flypanels-main">	
	<div class="inner-wrap flypanels-content">				
	<header class="wpcrt-header-container">		
		<div class="wpcrt-header-top">
			<div class="header_wrap row">				
			<?php     
                                  $enable_soc_hdr   = wp_iclean_responsive_get_theme_mod( 'enable_soc_hdr' );				  
				  $soc_facebook     = wp_iclean_responsive_get_theme_mod( 'soc_facebook' );	
				  $soc_twitter      = wp_iclean_responsive_get_theme_mod( 'soc_twitter' );
				  $soc_linkedin     = wp_iclean_responsive_get_theme_mod( 'soc_linkedin' );
				  $soc_behance      = wp_iclean_responsive_get_theme_mod( 'soc_behance' );	
				  $soc_dribbble     = wp_iclean_responsive_get_theme_mod( 'soc_dribbble' );
				  $soc_instagram    = wp_iclean_responsive_get_theme_mod( 'soc_instagram' );
				  $soc_youtube      = wp_iclean_responsive_get_theme_mod( 'soc_youtube' );

				if(!empty($enable_soc_hdr) ) { ?>			
					<div class="medium-4 columns wpcrt-social-networks wpcrt-social-networks-header">
						<?php if(!empty($soc_facebook) ) { ?>	
                         <a href="<?php echo esc_url($soc_facebook); ?>" title="<?php esc_attr_e( 'Facebook', 'wp-iclean-responsive' ); ?>" target="_blank" class="wpcrt-social-network-icon wpcrt-facebook-icon"><i class="fa fa-facebook"></i></a>
						<?php } 
						if(!empty($soc_twitter) ) { ?>	
							<a href="<?php echo esc_url($soc_twitter); ?>" title="<?php esc_attr_e( 'Twitter', 'wp-iclean-responsive' ); ?>" target="_blank" class="wpcrt-social-network-icon wpcrt-twitter-icon"><i class="fa fa-twitter"></i></a>
						<?php } 
						if(!empty($soc_linkedin) ) { ?>	
							<a href="<?php echo esc_url($soc_linkedin); ?>" title="<?php esc_attr_e( 'LinkedIn', 'wp-iclean-responsive' ); ?>" target="_blank" class="wpcrt-social-network-icon wpcrt-linkedin-icon"><i class="fa fa-linkedin"></i></a>
						<?php } 
						if(!empty($soc_youtube)) { ?>		
							<a href="<?php echo esc_url($soc_youtube); ?>" title="<?php esc_attr_e( 'YouTube', 'wp-iclean-responsive' ); ?>" target="_blank" class="wpcrt-social-network-icon wpcrt-youtube-icon"><i class="fa fa-youtube"></i></a>				
						<?php } 
						if(!empty($soc_instagram) ) { ?>		
							<a href="<?php echo esc_url($soc_instagram); ?>" title="<?php esc_attr_e( 'instagram', 'wp-iclean-responsive' ); ?>" target="_blank" class="wpcrt-social-network-icon wpcrt-instagram-icon"><i class="fa fa-instagram"></i></a>				
						<?php } 
						if(!empty($soc_behance) ) { ?>		
							<a href="<?php echo esc_url($soc_behance); ?>" title="<?php esc_attr_e( 'behance', 'wp-iclean-responsive' ); ?>" target="_blank" class="wpcrt-social-network-icon wpcrt-behance-icon"><i class="fa fa-behance"></i></a>				
						<?php } 
						if(!empty($soc_dribbble) ) { ?>		
							<a href="<?php echo esc_url($soc_dribbble); ?>" title="<?php esc_attr_e( 'dribbble', 'wp-iclean-responsive' ); ?>" target="_blank" class="wpcrt-social-network-icon wpcrt-dribbble-icon"><i class="fa fa-dribbble"></i></a>				
						<?php } ?>				
					</div>
				<?php } ?>			

				<nav class="medium-8 columns hide-for-small-only right wpcrt-header-top-menu" data-topbar role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'wp-iclean-responsive' ); ?>">
					<section class="top-bar-section clearfix">
                                            
						<?php wp_nav_menu( array(
							'theme_location'	=> 'top-menu',
							'container' 		=> false,
							'depth' 			=> 0,
							'items_wrap' 		=> '<ul class="right">%3$s</ul>',
                                                        'fallback_cb' 		=> '', // workaround to show a message to set up a menu
                                                        'walker' => new Wp_Iclean_Responsive_Nv_Wkr( array(
                                                            'in_top_bar' => true,
                                                            'item_type' => 'li',
                                                            'menu_type' => 'main-menu'
                                                            )),
                                                        ));
						?>
                                            
					</section><!-- end .top-bar-section -->
				</nav>

			</div><!-- end .header_wrap -->
		</div><!-- end .wpcrt-header-top -->		
		<div class="wpcrt-header" data-sticky-container>
			<div class="header-inner" data-sticky data-options="marginTop:0;">
					<div class="header_wrap row" >
						<div class="small-2 columns show-for-small-only">
						<a class="flypanels-button-left icon-menu" data-panel="treemenu" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
						</div>
						<div class="small-8 medium-3 large-3 columns wpcrt-logo">
							<?php 
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							if($custom_logo_id){
								if ( function_exists( 'the_custom_logo' ) ) {
									the_custom_logo();
								}
							} 
                                                        
                                                        if(display_header_text()) { ?>
							<hgroup>
                                                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                                                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
							</hgroup>
							<?php } ?>
                                                    
						</div><!-- end wpcrt-logo -->
						
						<?php get_template_part("content-nav"); // Navigation ?>
						
					</div><!-- end .content_wrap -->	
				</div>
		</div><!-- end .wpcrt-header -->
		
	</header><!-- end .wpcrt-header -->
	
	<?php
	$slidersetting      = wp_iclean_responsive_get_theme_mod( 'slidersetting' ); 
	$slider_shortcode   = wp_iclean_responsive_get_theme_mod( 'slider_shortcode' ); 
        $header_img         = get_header_image();
	
	if (( is_page_template('page-templates/front-page.php') || is_front_page()) && !empty($slidersetting)) { ?>	
		<div class="wpcrt-header-slider-wrap">
			<?php  echo do_shortcode( wp_kses_post($slider_shortcode) ); ?>
		</div>	
	 <?php  }  elseif ( (is_page_template('page-templates/front-page.php') || is_front_page()) && !empty($header_img) ){ ?>
        <img src="<?php echo esc_url($header_img); ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" /> 
	<?php }
	
	// Page title with featured image background
	if( !is_front_page() && !is_page_template('page-templates/front-page.php') && is_singular('page') ) {

		$feat_cls 	= '';
		$feat_style	= '';

		if( has_post_thumbnail() ) {
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
			$feat_style = "style='background-image: url({$feat_image});'";
			$feat_cls   = 'has-post-thumbnail';
		}
	?>
                        <div class="wpcrt-inner-header <?php echo esc_attr($feat_cls); ?>" <?php echo esc_attr($feat_style); ?> >
		<div class="content_wrap row">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</div><!-- end .wpcrt-inner-header -->
	<?php } ?>

	<?php 
	if(is_home()){
		$our_title = get_the_title( get_option('page_for_posts', true) );
		?>
		<div class="wpcrt-inner-header" >
			<div class="content_wrap row">
                            <h1 class="entry-title"><?php echo esc_html($our_title);?></h1>
			</div>
		</div>
		<?php
	}
	?>
	<div id="content-container" class="content-container">
		<?php if(!is_page_template('page-templates/front-page.php')) { ?>
		<div class="content_wrap row">
		<?php } ?>