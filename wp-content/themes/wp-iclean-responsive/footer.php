<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WP iClean Responsive
 * @since 1.0
 */
 $address_icon  = wp_iclean_responsive_get_theme_mod( 'address_icon' );
 $address       = wp_iclean_responsive_get_theme_mod( 'address' );
 $email_icon    = wp_iclean_responsive_get_theme_mod( 'email_icon' );
 $email         = wp_iclean_responsive_get_theme_mod( 'email' );
 $phone_icon    = wp_iclean_responsive_get_theme_mod( 'phone_icon' );
 $phone         = wp_iclean_responsive_get_theme_mod( 'phone' );
?>

		<?php if(!is_page_template('page-templates/front-page.php')) { ?>
		</div><!-- .content_wrap -->
		<?php } ?>

	</div><!-- .content-container -->

	<footer class="footer-container clearfix">
             <?php if(!empty($address) || !empty($email) || !empty($phone)){ ?>
		<div class="footer-top-area clearfix">
			<div class="footer_wrap row">
                            <?php if(!empty($address)){ ?>
				<div class="medium-4 columns text-center">
					<div class="wpcrt-theme-icon"><img src="<?php echo esc_url($address_icon); ?>" alt="<?php esc_attr_e( 'address', 'wp-iclean-responsive' ); ?>" /></div>
                                        <div class="wpcrt-theme-icon-text"><?php echo nl2br( $address ); ?></div>
				</div>
                            <?php } ?>
                            <?php if(!empty($email)){ ?>
				<div class="medium-4 columns text-center">
					<div class="wpcrt-theme-icon"><img src="<?php echo esc_url($email_icon); ?>" alt="<?php esc_attr_e( 'email', 'wp-iclean-responsive' ); ?>" /></div>
					<div class="wpcrt-theme-icon-text"><?php echo esc_html($email); ?></div>
				</div>
                            <?php } ?>
                            <?php if(!empty($phone)){ ?>
				<div class="medium-4 columns text-center">
					<div class="wpcrt-theme-icon"><img src="<?php echo esc_url($phone_icon); ?>" alt="<?php esc_attr_e( 'phone', 'wp-iclean-responsive' ); ?>" /></div>
					<div class="wpcrt-theme-icon-text"><?php echo esc_html($phone); ?></div>
				</div>
                            <?php } ?>
			</div>
		</div>
                 <?php } ?>
		<?php  get_sidebar('footer');  ?>		
		
		<div class="footer-copyright-area clearfix">
			<div class="footer_wrap row">
                                <?php $footer_copyright_text = wp_iclean_responsive_get_theme_mod( 'copyright' );
                                
                                if(! empty($footer_copyright_text)){ ?>
				<div class="medium-8 columns wpcrt-footer-copyright-text">
                                        <?php echo wp_kses_data( $footer_copyright_text ); ?>
				</div>
                                <?php } ?>
			<?php 
                                  $enable_soc_ftr  = wp_iclean_responsive_get_theme_mod( 'enable_soc_ftr' );
				  $soc_facebook    = wp_iclean_responsive_get_theme_mod( 'soc_facebook' );	
				  $soc_twitter     = wp_iclean_responsive_get_theme_mod( 'soc_twitter' );
				  $soc_linkedin    = wp_iclean_responsive_get_theme_mod( 'soc_linkedin' );
				  $soc_behance     = wp_iclean_responsive_get_theme_mod( 'soc_behance' );	
				  $soc_dribbble    = wp_iclean_responsive_get_theme_mod( 'soc_dribbble' );
				  $soc_instagram   = wp_iclean_responsive_get_theme_mod( 'soc_instagram' );
				  $soc_youtube     = wp_iclean_responsive_get_theme_mod( 'soc_youtube' );
			
			if(!empty($enable_soc_ftr) ) { ?>		
				<div class="medium-4 columns wpcrt-social-networks wpcrt-social-networks-footer wpcrt-text-right">
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
			</div><!-- end .footer_wrp -->
		</div><!-- end .footer-copyright-area -->

	</footer><!-- .footer-container -->

	<!-- Go to top -->
	
	<div class="wpcrt-go-to-top-container" id="wpcrt-go-to-top">
		<i class="fa fa-chevron-up"></i>
	</div>
	</div><!-- end .inner-wrap -->
</div> <!-- end .flypanels-main-->
</div><!-- end .off-flypanel-canvas-wrap -->
<?php wp_footer(); ?>
</body>
</html>