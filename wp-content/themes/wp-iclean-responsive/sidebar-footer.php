<?php
/**
 * The Footer Sidebar. This sidebar contains the three footer widget areas.
 *
 * If no active widgets are in either sidebar, they will be hidden completely.
 *
 * @package WP iClean Responsive
 * @since 1.0
 */



$footer_clmn = wp_iclean_responsive_get_theme_mod( 'footer_col' );
?>
<?php if ( is_active_sidebar('wpcrt-footer-sidebar-1') || is_active_sidebar('wpcrt-footer-sidebar-2') || is_active_sidebar('wpcrt-footer-sidebar-3') || is_active_sidebar('wpcrt-footer-sidebar-4')) { ?>
<div class="footer-sidebar-container clearfix">
	<div class="footer_wrap row">		
		<?php if ( is_active_sidebar('wpcrt-footer-sidebar-1') && ($footer_clmn >=1 && $footer_clmn <= 4) ) : ?>
        <div class="wpcrt-footer-sidebar-1">
	        <div class="<?php echo esc_attr(wp_iclean_responsive_ftr_sidbr_cls()); ?> columns">
				<?php dynamic_sidebar( 'wpcrt-footer-sidebar-1' ); ?>
	        </div>
	    </div><!-- end .wpcrt-footer-sidebar-1 -->
        <?php endif; ?>

        <?php if ( is_active_sidebar('wpcrt-footer-sidebar-2') && ($footer_clmn >=2 && $footer_clmn <= 4) ) : ?>
        <div class="wpcrt-footer-sidebar-2">
	        <div class="<?php echo esc_attr(wp_iclean_responsive_ftr_sidbr_cls()); ?> columns">
				<?php dynamic_sidebar( 'wpcrt-footer-sidebar-2' ); ?>
	        </div>
	    </div><!-- end .wpcrt-footer-sidebar-2 -->
        <?php endif; ?>

        <?php if ( is_active_sidebar('wpcrt-footer-sidebar-3') && ($footer_clmn >=3 && $footer_clmn <= 4) ) : ?>
        <div class="wpcrt-footer-sidebar-3">
	        <div class="<?php echo esc_attr(wp_iclean_responsive_ftr_sidbr_cls()); ?> columns">
				<?php dynamic_sidebar( 'wpcrt-footer-sidebar-3' ); ?>
	        </div>
	    </div><!-- end .wpcrt-footer-sidebar-3 -->
        <?php endif; ?>

        <?php if ( is_active_sidebar('wpcrt-footer-sidebar-4') && ($footer_clmn == 4) ) : ?>
        <div class="wpcrt-footer-sidebar-4">
	        <div class="<?php echo esc_attr(wp_iclean_responsive_ftr_sidbr_cls()); ?> columns">
				<?php dynamic_sidebar( 'wpcrt-footer-sidebar-4' ); ?>
	        </div>
	    </div><!-- end .wpcrt-footer-sidebar-4 -->
        <?php endif; ?>

	</div><!-- end .footer_wrap row -->
</div><!-- end .footer-sidebar-container -->
<?php } ?>

