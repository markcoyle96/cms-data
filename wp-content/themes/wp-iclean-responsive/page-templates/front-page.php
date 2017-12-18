<?php
/**
 * Template Name: Front Page Design
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in WP iClean Responsive consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @subpackage WP iClean Responsive
 * @since 1.0
 */

get_header();

$featured_cont_enable           = wp_iclean_responsive_get_theme_mod( 'enable_featured_cont' ); 
$featured_cont_title            = wp_iclean_responsive_get_theme_mod( 'featured_cont_h');
$featured_cont_sub_title        = wp_iclean_responsive_get_theme_mod( 'featured_cont_hs' );
$featured_cont_shortcode        = wp_iclean_responsive_get_theme_mod( 'featured_cont_scode' );
$page_content_enable            = wp_iclean_responsive_get_theme_mod( 'page_cont' ); 
$front_page_id                  = (int)get_option( 'page_on_front' );



$testimonials_enable            = wp_iclean_responsive_get_theme_mod( 'enable_testimonials_cont' ); 
$testimonials_title             = wp_iclean_responsive_get_theme_mod( 'testimonials_cont_h' );
$testimonials_sub_title         = wp_iclean_responsive_get_theme_mod( 'testimonials_cont_hs' );
$testimonials_shortcode         = wp_iclean_responsive_get_theme_mod( 'testimonials_cont_scode' );

$logoslider_enable              = wp_iclean_responsive_get_theme_mod( 'enable_logoslider_cont' ); 
$logoslider_title               = wp_iclean_responsive_get_theme_mod( 'logoslider_cont_h' );
$logoslider_sub_title           = wp_iclean_responsive_get_theme_mod( 'logoslider_cont_hs' );
$logoslider_shortcode           = wp_iclean_responsive_get_theme_mod( 'logoslider_cont_scode');

$teamslider_enable              = wp_iclean_responsive_get_theme_mod( 'enable_teamslider_cont' ); 
$teamslider_title               = wp_iclean_responsive_get_theme_mod( 'teamslider_cont_h' );
$teamslider_sub_title           = wp_iclean_responsive_get_theme_mod( 'teamslider_cont_hs' );
$teamslider_shortcode           = wp_iclean_responsive_get_theme_mod( 'teamslider_cont_scode');

$ourwork_enable                 = wp_iclean_responsive_get_theme_mod( 'enable_ourwork_cont' ); 
$ourwork_title                  = wp_iclean_responsive_get_theme_mod( 'ourwork_cont_h' );
$ourwork_sub_title              = wp_iclean_responsive_get_theme_mod( 'ourwork_cont_hs' );
$ourwork_shortcode              = wp_iclean_responsive_get_theme_mod( 'ourwork_cont_scode');

$ourblog_enable                 = wp_iclean_responsive_get_theme_mod( 'enable_ourblog_cont' ); 
$ourblog_title                  = wp_iclean_responsive_get_theme_mod( 'ourblog_cont_h' );
$ourblog_sub_title              = wp_iclean_responsive_get_theme_mod( 'ourblog_cont_hs' );
$ourblog_shortcode              = wp_iclean_responsive_get_theme_mod( 'ourblog_cont_scode');

$call_to_action_enable              = wp_iclean_responsive_get_theme_mod( 'call_to_act_cont' ); 
$all_to_action_content              = wp_iclean_responsive_get_theme_mod( 'call_to_act_cont_scode' );
$all_to_action_button_title         = wp_iclean_responsive_get_theme_mod( 'call_to_act_btn_t' );
$all_to_action_button_title_link    = wp_iclean_responsive_get_theme_mod( 'call_to_act_btn_lnk');

$insta_enable                       = wp_iclean_responsive_get_theme_mod( 'insta_feed_cont' );
$insta_shortcode                    = wp_iclean_responsive_get_theme_mod( 'insta_feed_cont_scode' );

 ?>
<?php if(empty($featured_cont_enable)) { ?>	
<div class="wpcrt-home-part-cnt-wrp clearfix wpcrt-featured-content">
	<div class="content_wrap row">
		<div class="medium-12 columns">							
					<div class="wpcrt-title">
						<h2 class="front-page-title"><?php echo esc_html($featured_cont_title); ?></h2>
						<p class="front-page-sub-title"><?php echo esc_html($featured_cont_sub_title); ?></p>
					</div><!-- end .wpcrt-title-->
					<?php  echo do_shortcode( wp_kses_post($featured_cont_shortcode) );  ?>
		</div>
	</div>						
</div>
<?php } if(empty($page_content_enable)) { ?>
<div class="wpcrt-home-part-cnt-wrp clearfix wpcrt-page-content">
	<div class="content_wrap row">
		<div class="medium-12 columns">	
			<?php 
                        $args = array (
                            'page_id' => $front_page_id,
                        );
                        $the_query = new WP_Query($args);
                        while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                               <div class="wpcrt-title">
                                       <h2 class="front-page-title"><?php the_title(); ?></h2>						
                               </div><!-- end .wpcrt-title-->
                               <?php the_content(); ?>
                        <?php endwhile; ?>	
		</div>
	</div>						
</div>
<?php } if(empty($testimonials_enable)) { ?>
<div class="wpcrt-home-part-cnt-wrp clearfix wpcrt-testimonials-content">
	<div class="content_wrap row">
		<div class="medium-12 columns">							
					<div class="wpcrt-title">
						<h2 class="front-page-title"><?php echo esc_html($testimonials_title); ?></h2>
						<p class="front-page-sub-title"><?php echo esc_html($testimonials_sub_title); ?></p>
					</div><!-- end .wpcrt-title-->
					<?php  echo do_shortcode( wp_kses_post($testimonials_shortcode) );  ?>
		</div>
	</div>						
</div>
<?php } if(empty($logoslider_enable)) { ?>
<div class="wpcrt-home-part-cnt-wrp clearfix wpcrt-logoslider-content">
	<div class="content_wrap row">
		<div class="medium-12 columns">							
					<div class="wpcrt-title">
						<h2 class="front-page-title"><?php echo esc_html($logoslider_title); ?></h2>
						<p class="front-page-sub-title"><?php echo esc_html($logoslider_sub_title); ?></p>
					</div><!-- end .wpcrt-title-->
					<?php  echo do_shortcode( wp_kses_post($logoslider_shortcode) );  ?>
		</div>
	</div>						
</div>
<?php } if(empty($teamslider_enable)) { ?>
<div class="wpcrt-home-part-cnt-wrp clearfix wpcrt-teamslider-content">
	<div class="content_wrap row">
		<div class="medium-12 columns">							
					<div class="wpcrt-title">
						<h2 class="front-page-title"><?php echo esc_html($teamslider_title); ?></h2>
						<p class="front-page-sub-title"><?php echo esc_html($teamslider_sub_title); ?></p>
					</div><!-- end .wpcrt-title-->
					<?php  echo do_shortcode( wp_kses_post($teamslider_shortcode) );  ?>
		</div>
	</div>						
</div>
<?php } if(empty($ourwork_enable)) { ?>
<div class="wpcrt-home-part-cnt-wrp clearfix wpcrt-portfolio-content">
	<div class="content_wrap row">
		<div class="medium-12 columns">							
					<div class="wpcrt-title">
						<h2 class="front-page-title"><?php echo esc_html($ourwork_title); ?></h2>
						<p class="front-page-sub-title"><?php echo esc_html($ourwork_sub_title); ?></p>
					</div><!-- end .wpcrt-title-->
					<?php  echo do_shortcode( wp_kses_post($ourwork_shortcode) );  ?>
		</div>
	</div>						
</div>
<?php } if(empty($ourblog_enable)) { ?>
<div class="wpcrt-home-part-cnt-wrp clearfix wpcrt-blog-content">
	<div class="content_wrap row">
		<div class="medium-12 columns">							
					<div class="wpcrt-title">
						<h2 class="front-page-title"><?php echo esc_html($ourblog_title); ?></h2>
						<p class="front-page-sub-title"><?php echo esc_html($ourblog_sub_title); ?></p>
					</div><!-- end .wpcrt-title-->
					<?php  echo do_shortcode( wp_kses_post($ourblog_shortcode) );  ?>
		</div>
	</div>						
</div>
<?php } if(empty($call_to_action_enable)) { ?>
<div class="wpcrt-home-part-cnt-wrp wpcrt-home-part-cta clearfix">
	<div class="content_wrap row">
			<div class="medium-9 columns">
							<h4><?php  echo esc_html($all_to_action_content); ?></h4>
							</div>

							<?php if( !empty($all_to_action_button_title) ) { ?>
							<div class="medium-3 columns">
								<a href="<?php echo esc_url($all_to_action_button_title_link); ?>" class="button wpcrt-cta-btn right"><?php echo esc_html($all_to_action_button_title); ?></a>
							</div>
							<?php } ?>

	</div><!-- end .content_wrap -->
</div>	

<?php } if(empty($insta_enable)) { ?>
<div class="wpcrt-home-part-cnt-wrp wpcrt-home-part-cnt-insta clearfix">
				<?php  echo do_shortcode( wp_kses_post($insta_shortcode) );  ?>							
</div>	
<?php } ?>
<?php get_footer(); 